<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\ServiceModel;
use App\Models\UserModel;

class Booking extends BaseController
{
    protected ServiceModel $services;
    protected BookingModel $bookings;
    protected UserModel $users;

    public function __construct()
    {
        $this->services = new ServiceModel();
        $this->bookings = new BookingModel();
        $this->users    = new UserModel();
    }

    /**
     * Tampilkan form booking.
     */
    public function index()
    {
        $data = [
            'title'      => 'Booking Service - Bengkel PrimaMotor',
            'services'   => $this->services->active(),
            'time_slots' => BookingModel::TIME_SLOTS,
            'min_date'   => date('Y-m-d'),
            'validation' => session()->getFlashdata('validation'),
            'old'        => session()->getFlashdata('old') ?? [],
        ];

        return view('booking/index', $data);
    }

    /**
     * Endpoint AJAX: kembalikan ketersediaan slot dalam format JSON.
     * Dipanggil saat user memilih tanggal agar jam penuh otomatis disabled.
     */
    public function slots()
    {
        $date = $this->request->getGet('date');

        // Validasi format tanggal sederhana untuk mencegah input tidak valid.
        $parsed = \DateTime::createFromFormat('Y-m-d', (string) $date);

        if (! $parsed || $parsed->format('Y-m-d') !== $date) {
            return $this->response->setStatusCode(400)
                ->setJSON(['error' => 'Format tanggal tidak valid.']);
        }

        return $this->response->setJSON([
            'date'  => $date,
            'slots' => $this->bookings->slotAvailability($date),
        ]);
    }

    /**
     * Proses submit booking.
     */
    public function store()
    {
        // Aturan validasi ketat (juga menjadi proteksi terhadap input berbahaya).
        $rules = [
            'name'          => 'required|min_length[3]|max_length[120]',
            'phone'         => 'required|min_length[8]|max_length[20]|regex_match[/^[0-9+\-\s]+$/]',
            'email'         => 'permit_empty|valid_email|max_length[150]',
            'service_id'    => 'required|is_natural_no_zero',
            'booking_date'  => 'required|valid_date[Y-m-d]',
            'time_slot'     => 'required',
            'vehicle_model' => 'permit_empty|max_length[150]',
            'plate_number'  => 'permit_empty|max_length[20]|regex_match[/^[A-Za-z0-9\s]*$/]',
            'notes'         => 'permit_empty|max_length[500]',
        ];

        $messages = [
            'phone' => [
                'regex_match' => 'Nomor HP hanya boleh berisi angka, spasi, +, atau -.',
            ],
            'plate_number' => [
                'regex_match' => 'Nomor plat hanya boleh berisi huruf, angka, dan spasi.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()
                ->with('validation', $this->validator)
                ->with('old', $this->request->getPost());
        }

        $post = $this->request->getPost();

        // Validasi: pastikan layanan benar-benar ada & aktif.
        $service = $this->services->where('is_active', 1)->find((int) $post['service_id']);
        if (! $service) {
            return redirect()->back()->withInput()
                ->with('error', 'Layanan yang dipilih tidak tersedia.');
        }

        // Validasi: slot waktu harus salah satu jam operasional.
        if (! in_array($post['time_slot'], BookingModel::TIME_SLOTS, true)) {
            return redirect()->back()->withInput()
                ->with('error', 'Jam yang dipilih tidak valid.');
        }

        // Validasi: tidak boleh booking untuk tanggal yang sudah lewat.
        if ($post['booking_date'] < date('Y-m-d')) {
            return redirect()->back()->withInput()
                ->with('error', 'Tanggal booking tidak boleh di masa lalu.');
        }

        // Normalisasi jam ke format HH:MM:SS.
        $timeSlot = $post['time_slot'] . ':00';

        // Cek ulang ketersediaan slot di sisi server (mencegah race / bypass).
        if (! $this->bookings->isSlotAvailable($post['booking_date'], $timeSlot)) {
            return redirect()->back()->withInput()
                ->with('error', 'Maaf, slot pada jam tersebut sudah penuh. Silakan pilih jam lain.');
        }

        // Simpan / temukan pelanggan.
        $userId = $this->users->findOrCreate([
            'name'  => trim($post['name']),
            'phone' => trim($post['phone']),
            'email' => ! empty($post['email']) ? trim($post['email']) : null,
        ]);

        $code = $this->bookings->generateCode();

        $this->bookings->insert([
            'user_id'       => $userId,
            'service_id'    => (int) $post['service_id'],
            'booking_date'  => $post['booking_date'],
            'time_slot'     => $timeSlot,
            'vehicle_model' => ! empty($post['vehicle_model']) ? trim($post['vehicle_model']) : null,
            'plate_number'  => ! empty($post['plate_number']) ? strtoupper(trim($post['plate_number'])) : null,
            'notes'         => ! empty($post['notes']) ? trim($post['notes']) : null,
            'status'        => 'pending',
            'booking_code'  => $code,
        ]);

        return redirect()->to(site_url('booking/success/' . $code));
    }

    /**
     * Halaman konfirmasi setelah booking berhasil.
     */
    public function success(string $code)
    {
        $booking = $this->bookings->withRelations();
        $found   = null;

        foreach ($booking as $b) {
            if ($b['booking_code'] === $code) {
                $found = $b;
                break;
            }
        }

        if (! $found) {
            return redirect()->to(site_url('booking'))
                ->with('error', 'Data booking tidak ditemukan.');
        }

        return view('booking/success', [
            'title'   => 'Booking Berhasil - Bengkel PrimaMotor',
            'booking' => $found,
        ]);
    }
}

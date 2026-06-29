<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'user_id',
        'service_id',
        'booking_date',
        'time_slot',
        'vehicle_model',
        'plate_number',
        'notes',
        'status',
        'booking_code',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Batas maksimum mobil yang bisa ditangani per slot jam.
     * Sesuaikan dengan jumlah teknisi / lift bengkel.
     */
    public const MAX_PER_SLOT = 3;

    /**
     * Jam operasional bengkel (slot kedatangan).
     */
    public const TIME_SLOTS = [
        '08:00', '09:00', '10:00', '11:00',
        '13:00', '14:00', '15:00', '16:00',
    ];

    /**
     * Hitung jumlah booking aktif pada tanggal + slot tertentu.
     * Booking yang dibatalkan tidak dihitung.
     */
    public function countForSlot(string $date, string $time): int
    {
        return $this->where('booking_date', $date)
            ->where('time_slot', $time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->countAllResults();
    }

    /**
     * Apakah slot pada tanggal+jam tertentu masih tersedia?
     */
    public function isSlotAvailable(string $date, string $time): bool
    {
        return $this->countForSlot($date, $time) < self::MAX_PER_SLOT;
    }

    /**
     * Kembalikan status ketersediaan untuk seluruh slot pada satu tanggal.
     * Dipakai oleh endpoint AJAX agar jam penuh otomatis disabled di UI.
     *
     * @return array<int, array{time:string, remaining:int, available:bool}>
     */
    public function slotAvailability(string $date): array
    {
        $result = [];

        foreach (self::TIME_SLOTS as $slot) {
            $used      = $this->countForSlot($date, $slot);
            $remaining = max(0, self::MAX_PER_SLOT - $used);

            $result[] = [
                'time'      => $slot,
                'remaining' => $remaining,
                'available' => $remaining > 0,
            ];
        }

        return $result;
    }

    /**
     * Ambil seluruh booking lengkap dengan data pelanggan & layanan.
     * Mendukung filter status opsional.
     */
    public function withRelations(?string $status = null): array
    {
        $builder = $this->select('
                bookings.*,
                users.name AS customer_name,
                users.phone AS customer_phone,
                users.email AS customer_email,
                services.name AS service_name,
                services.price_estimate AS service_price
            ')
            ->join('users', 'users.id = bookings.user_id')
            ->join('services', 'services.id = bookings.service_id')
            ->orderBy('bookings.booking_date', 'DESC')
            ->orderBy('bookings.time_slot', 'ASC');

        if ($status !== null && $status !== '') {
            $builder->where('bookings.status', $status);
        }

        return $builder->findAll();
    }

    /**
     * Statistik ringkas untuk kartu dashboard.
     */
    public function stats(): array
    {
        return [
            'total'     => $this->countAllResults(false),
            'pending'   => $this->where('status', 'pending')->countAllResults(false),
            'confirmed' => $this->where('status', 'confirmed')->countAllResults(false),
            'completed' => $this->where('status', 'completed')->countAllResults(false),
        ];
    }

    /**
     * Buat kode booking unik yang mudah dibaca, mis. BPM-7F3A9K.
     */
    public function generateCode(): string
    {
        do {
            $code = 'BPM-' . strtoupper(bin2hex(random_bytes(3)));
        } while ($this->where('booking_code', $code)->countAllResults() > 0);

        return $code;
    }
}

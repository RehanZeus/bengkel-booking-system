<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\BookingModel;

class Admin extends BaseController
{
    protected AdminModel $admins;
    protected BookingModel $bookings;

    public function __construct()
    {
        $this->admins   = new AdminModel();
        $this->bookings = new BookingModel();
    }

    /**
     * Form login admin.
     */
    public function login()
    {
        if (session()->get('isAdminLoggedIn')) {
            return redirect()->to(site_url('admin/dashboard'));
        }

        return view('admin/login', [
            'title' => 'Login Admin - Bengkel PrimaMotor',
        ]);
    }

    /**
     * Proses login.
     */
    public function attemptLogin()
    {
        $rules = [
            'username' => 'required|max_length[60]',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                ->with('error', 'Username dan password wajib diisi.');
        }

        $admin = $this->admins->verify(
            $this->request->getPost('username'),
            $this->request->getPost('password')
        );

        if (! $admin) {
            return redirect()->back()->withInput()
                ->with('error', 'Username atau password salah.');
        }

        session()->set([
            'isAdminLoggedIn' => true,
            'adminId'         => $admin['id'],
            'adminName'       => $admin['full_name'] ?? $admin['username'],
        ]);

        return redirect()->to(site_url('admin/dashboard'));
    }

    /**
     * Dashboard daftar booking.
     */
    public function dashboard()
    {
        $status = $this->request->getGet('status');

        $data = [
            'title'    => 'Dashboard Admin - Bengkel PrimaMotor',
            'bookings' => $this->bookings->withRelations($status),
            'stats'    => $this->bookings->stats(),
            'filter'   => $status,
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Ubah status booking (pending/confirmed/completed/cancelled).
     */
    public function updateStatus(int $id)
    {
        $status  = $this->request->getPost('status');
        $allowed = ['pending', 'confirmed', 'completed', 'cancelled'];

        if (! in_array($status, $allowed, true)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $booking = $this->bookings->find($id);
        if (! $booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        $this->bookings->update($id, ['status' => $status]);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }

    /**
     * Logout admin.
     */
    public function logout()
    {
        session()->remove(['isAdminLoggedIn', 'adminId', 'adminName']);

        return redirect()->to(site_url('admin/login'))
            ->with('success', 'Anda telah keluar.');
    }

    /**
     * Helper sekali pakai: membuat/ulang akun admin default dengan hash valid.
     * Hapus method ini di lingkungan produksi.
     * Akses: /admin/seed  ->  username: admin | password: admin123
     */
    public function seed()
    {
        $existing = $this->admins->where('username', 'admin')->first();
        $hash     = password_hash('admin123', PASSWORD_DEFAULT);

        if ($existing) {
            $this->admins->update($existing['id'], ['password' => $hash]);
            $msg = 'Password admin direset. Login: admin / admin123';
        } else {
            $this->admins->insert([
                'username'  => 'admin',
                'password'  => $hash,
                'full_name' => 'Administrator Bengkel',
            ]);
            $msg = 'Akun admin dibuat. Login: admin / admin123';
        }

        return $this->response->setJSON([
            'ok'      => true,
            'message' => $msg,
        ]);
    }
}

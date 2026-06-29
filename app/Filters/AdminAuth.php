<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Filter proteksi area admin.
 * Mengalihkan ke halaman login jika sesi admin belum terautentikasi.
 */
class AdminAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (! $session->get('isAdminLoggedIn')) {
            $session->setFlashdata('error', 'Silakan login terlebih dahulu untuk mengakses dashboard.');

            return redirect()->to(site_url('admin/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah request.
    }
}

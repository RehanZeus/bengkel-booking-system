<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ---------------------------------------------------------------------
// Halaman Publik (Profil + Booking)
// ---------------------------------------------------------------------
$routes->get('/', 'Home::index');

// Booking pelanggan
$routes->get('booking', 'Booking::index');
$routes->post('booking', 'Booking::store');
$routes->get('booking/success/(:segment)', 'Booking::success/$1');

// Endpoint AJAX: cek slot waktu yang masih tersedia untuk tanggal tertentu
$routes->get('booking/slots', 'Booking::slots');

// ---------------------------------------------------------------------
// Area Admin
// ---------------------------------------------------------------------
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/login', 'Admin::attemptLogin');
$routes->get('admin/logout', 'Admin::logout');

// Helper sekali pakai untuk membuat ulang akun admin default (admin / admin123)
$routes->get('admin/seed', 'Admin::seed');

// Halaman admin yang diproteksi filter "adminauth"
$routes->group('admin', ['filter' => 'adminauth'], static function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->post('booking/(:num)/status', 'Admin::updateStatus/$1');
});

# Bengkel PrimaMotor — Website Profil & Booking (CodeIgniter 4)

Aplikasi web bengkel mobil: landing page profil, sistem booking service dengan validasi slot waktu, dan dashboard admin untuk mengelola booking. Dibangun dengan **CodeIgniter 4**, **MySQL/MariaDB**, dan **Tailwind CSS (CDN)**.

> Catatan: preview v0 menjalankan Next.js, jadi aplikasi PHP ini tidak tampil di preview tersebut. Jalankan secara lokal mengikuti langkah di bawah.

## Fitur

- **Profil bengkel**: hero, tentang kami, daftar layanan (dari database), keunggulan, CTA.
- **Booking pelanggan**:
  - Form dengan validasi server-side ketat (proteksi terhadap input berbahaya / SQL injection via query builder berparameter).
  - Slot jam otomatis dinonaktifkan saat penuh (AJAX), dengan pengecekan ulang di server.
  - Batas maksimal mobil per jam dapat diatur (`BookingModel::MAX_PER_SLOT`).
  - Kode booking unik + halaman konfirmasi.
- **Dashboard admin**:
  - Login dengan password ter-hash (`password_hash`), sesi terproteksi filter.
  - Statistik ringkas + filter status + ubah status booking (pending / confirmed / completed / cancelled).
- **Proteksi CSRF** aktif secara global.

## Prasyarat

- PHP 8.1+ dengan ekstensi `intl`, `mbstring`, `mysqlnd`/`mysqli`
- Composer
- MySQL / MariaDB (mis. via XAMPP, Laragon, atau Docker)

## Instalasi

1. **Pasang framework CodeIgniter 4.**
   File `app/` dan `database/` di repo ini sudah lengkap, tetapi inti framework (`system/`, `public/index.php`, `spark`, dll.) perlu di-install via Composer:

   ```bash
   composer install
   ```

   Jika folder `vendor/` / `system/` belum ada, cara termudah adalah membuat appstarter lalu menyalin folder `app/`, `database/`, dan `public/images/` dari repo ini ke dalamnya:

   ```bash
   composer create-project codeigniter4/appstarter primamotor
   # lalu salin folder app/, database/, public/images/, dan file env ke proyek primamotor
   ```

2. **Konfigurasi environment.**

   ```bash
   cp env .env
   ```

   Sesuaikan kredensial database dan `app.baseURL` di `.env`.

3. **Buat database & tabel.**
   Import skema beserta data awal:

   ```bash
   mysql -u root -p < database/schema.sql
   ```

   Ini membuat database `bengkel_primamotor`, tabel `users`, `services`, `bookings`, `admins`, dan mengisi 4 layanan default.

4. **Jalankan server.**

   ```bash
   php spark serve
   ```

   Buka http://localhost:8080

5. **Aktifkan akun admin.**
   Kunjungi sekali: http://localhost:8080/admin/seed
   Akun: **admin / admin123** (ganti password & hapus method `seed()` di produksi).

## Struktur Penting

```
app/
  Config/Routes.php       # definisi route publik & admin
  Config/Database.php     # koneksi MySQL
  Config/Filters.php      # registrasi filter adminauth
  Controllers/
    Home.php              # landing page
    Booking.php           # form, AJAX slot, simpan booking
    Admin.php             # login, dashboard, ubah status, seed
  Filters/AdminAuth.php   # proteksi area admin
  Models/                 # UserModel, ServiceModel, BookingModel, AdminModel
  Views/
    layout/               # header & footer
    home/index.php        # profil bengkel
    booking/              # form & halaman sukses
    admin/                # login & dashboard
database/schema.sql       # skema + seed
public/images/            # aset gambar
```

## Halaman

| URL                         | Keterangan                          |
| --------------------------- | ----------------------------------- |
| `/`                         | Profil bengkel                      |
| `/booking`                  | Form booking pelanggan              |
| `/booking/success/{kode}`   | Konfirmasi booking                  |
| `/admin/login`              | Login admin                         |
| `/admin/dashboard`          | Kelola booking (perlu login)        |
| `/admin/seed`               | Buat/reset akun admin (sekali pakai)|

## Catatan Keamanan & Pengembangan Lanjutan

- Semua query memakai Query Builder CI4 (parameterized) — aman dari SQL injection.
- Validasi input + CSRF aktif. Untuk produksi: nonaktifkan `DBDebug`, hapus route `/admin/seed`, dan set `CI_ENVIRONMENT = production`.
- Ide pengembangan: notifikasi WhatsApp/email ke admin, perhitungan ulang durasi pengerjaan secara dinamis, dan dashboard riwayat service per pelanggan.

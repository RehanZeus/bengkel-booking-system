-- =====================================================================
-- Skema Database: Bengkel PrimaMotor
-- Engine: MySQL / MariaDB
-- Charset: utf8mb4 (mendukung emoji & karakter internasional)
-- =====================================================================

CREATE DATABASE IF NOT EXISTS bengkel_primamotor
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE bengkel_primamotor;

-- ---------------------------------------------------------------------
-- Tabel: users (Data pelanggan)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name        VARCHAR(120)  NOT NULL,
  phone       VARCHAR(25)   NOT NULL,
  email       VARCHAR(150)  DEFAULT NULL,
  created_at  DATETIME      DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_users_phone (phone)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Tabel: services (Jenis layanan + estimasi durasi pengerjaan)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS services (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name            VARCHAR(150) NOT NULL,
  slug            VARCHAR(160) NOT NULL,
  description     TEXT         DEFAULT NULL,
  duration_minutes INT UNSIGNED NOT NULL DEFAULT 60,
  price_estimate  DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  is_active       TINYINT(1)   NOT NULL DEFAULT 1,
  created_at      DATETIME     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_services_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Tabel: bookings (Janji temu service)
-- status: pending | confirmed | completed | cancelled
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS bookings (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id       INT UNSIGNED NOT NULL,
  service_id    INT UNSIGNED NOT NULL,
  booking_date  DATE         NOT NULL,
  time_slot     TIME         NOT NULL,
  vehicle_model VARCHAR(150) DEFAULT NULL,
  plate_number  VARCHAR(20)  DEFAULT NULL,
  notes         TEXT         DEFAULT NULL,
  status        ENUM('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  booking_code  VARCHAR(20)  NOT NULL,
  created_at    DATETIME     DEFAULT CURRENT_TIMESTAMP,
  updated_at    DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_booking_code (booking_code),
  KEY idx_booking_slot (booking_date, time_slot),
  KEY fk_bookings_user (user_id),
  KEY fk_bookings_service (service_id),
  CONSTRAINT fk_bookings_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT fk_bookings_service FOREIGN KEY (service_id) REFERENCES services (id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Tabel: admins (Login dashboard admin)
-- password disimpan sebagai hash (password_hash / PHP)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS admins (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username    VARCHAR(60)  NOT NULL,
  password    VARCHAR(255) NOT NULL,
  full_name   VARCHAR(120) DEFAULT NULL,
  created_at  DATETIME     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_admin_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================================
-- DATA AWAL (SEED)
-- =====================================================================

-- Layanan utama bengkel
INSERT INTO services (name, slug, description, duration_minutes, price_estimate, is_active) VALUES
('Periodic Maintenance (Service Berkala)', 'periodic-maintenance', 'Perawatan berkala menyeluruh: ganti oli, filter, cek kampas rem, dan tune-up ringan.', 90, 350000.00, 1),
('Computerized Diagnostic (Scanner OBD)', 'computerized-diagnostic', 'Pemindaian elektronik menggunakan scanner OBD untuk mendeteksi error code pada ECU.', 45, 150000.00, 1),
('Understeel & Brake System', 'understeel-brake', 'Pemeriksaan dan perbaikan kaki-kaki, suspensi, serta sistem pengereman.', 120, 500000.00, 1),
('AC & Electrical Repair', 'ac-electrical', 'Servis AC mobil, isi freon, dan perbaikan sistem kelistrikan kendaraan.', 90, 400000.00, 1);

-- Akun admin default
-- username: admin
-- password: admin123  (HASH di bawah dibuat dengan password_hash('admin123', PASSWORD_DEFAULT))
INSERT INTO admins (username, password, full_name) VALUES
('admin', '$2y$10$wHcQ0pXq3sJv2u4y6cN0aOeHnqkXr0qf1nQ8s3yWcF4xY7zV8bDpe', 'Administrator Bengkel');

-- CATATAN PENTING:
-- Hash di atas adalah placeholder. Setelah instalasi, buka /admin/seed satu kali
-- (route bawaan aplikasi) untuk membuat ulang akun admin dengan hash yang valid,
-- ATAU jalankan query berikut setelah membuat hash sendiri di PHP:
--   UPDATE admins SET password = '<hash_baru>' WHERE username = 'admin';

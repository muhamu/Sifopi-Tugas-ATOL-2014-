-- SIFOPI - Sistem Informasi Akademik SMK PI
-- Database Schema with Modern Security & Best Practices
-- Created: 2026-04-21

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET COLLATION_CONNECTION = utf8mb4_unicode_ci;

-- Drop existing tables if they exist (for clean setup)
DROP TABLE IF EXISTS activity_logs;
DROP TABLE IF EXISTS nilai;
DROP TABLE IF EXISTS absen;
DROP TABLE IF EXISTS jadwal;
DROP TABLE IF EXISTS pelajaran_kelas;
DROP TABLE IF EXISTS kurikulum;
DROP TABLE IF EXISTS pembayaran_lain_siswa;
DROP TABLE IF EXISTS pembayaran_lain;
DROP TABLE IF EXISTS spp;
DROP TABLE IF EXISTS seleksi;
DROP TABLE IF EXISTS daftar;
DROP TABLE IF EXISTS akademik;
DROP TABLE IF EXISTS kenaikan;
DROP TABLE IF EXISTS buku_perpustakaan;
DROP TABLE IF EXISTS siswa;
DROP TABLE IF EXISTS guru;
DROP TABLE IF EXISTS kelas;
DROP TABLE IF EXISTS mapel;
DROP TABLE IF EXISTS tahun_ajaran;
DROP TABLE IF EXISTS user;

-- Create Tables

-- User (authentication - supports all 5 roles)
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    role ENUM('ADMIN', 'GURU', 'SISWA', 'TATA_USAHA', 'WALI_SISWA') NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    photo VARCHAR(255),
    is_active BOOLEAN DEFAULT true,
    last_login DATETIME,
    password_changed_at DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Academic Year (Tahun Ajaran)
CREATE TABLE tahun_ajaran (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tahun_ajaran VARCHAR(20) NOT NULL UNIQUE,
    keterangan VARCHAR(100),
    is_active BOOLEAN DEFAULT false,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Teacher (Guru) - Must be created before Kelas
CREATE TABLE guru (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL UNIQUE,
    nip VARCHAR(20) UNIQUE,
    nama VARCHAR(100) NOT NULL,
    tgl_lahir DATE,
    jenis_kelamin ENUM('LAKI-LAKI', 'PEREMPUAN'),
    agama VARCHAR(20),
    alamat TEXT,
    no_telepon VARCHAR(20),
    email VARCHAR(100) UNIQUE,
    photo VARCHAR(255),
    tgl_masuk DATE,
    status ENUM('AKTIF', 'CUTI', 'RESIGN') DEFAULT 'AKTIF',
    golongan_darah VARCHAR(3),
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    UNIQUE KEY unique_nip (nip),
    INDEX idx_nama (nama),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Class (Kelas)
CREATE TABLE kelas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_kelas VARCHAR(50) NOT NULL,
    no_ruangan VARCHAR(10),
    id_guru_wali INT,
    tahun_ajaran_id INT NOT NULL,
    kurikulum VARCHAR(100),
    capacity INT DEFAULT 40,
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_guru_wali) REFERENCES guru(id),
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran(id),
    UNIQUE KEY unique_class (nama_kelas, tahun_ajaran_id),
    INDEX idx_guru_wali (id_guru_wali),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Student (Siswa) - renamed from murid
CREATE TABLE siswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    no_induk VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    tgl_lahir DATE,
    jenis_kelamin ENUM('LAKI-LAKI', 'PEREMPUAN'),
    agama VARCHAR(20),
    alamat TEXT,
    no_telepon VARCHAR(20),
    email VARCHAR(100) UNIQUE,
    status ENUM('AKTIF', 'LULUS', 'KELUAR', 'SUSPENDED') DEFAULT 'AKTIF',
    kelas_id INT,
    tahun_ajaran_id INT,
    tanggal_masuk DATE,
    nama_ayah VARCHAR(100),
    nama_ibu VARCHAR(100),
    pekerjaan_ayah VARCHAR(100),
    pekerjaan_ibu VARCHAR(100),
    no_telepon_wali VARCHAR(20),
    nama_wali VARCHAR(100),
    alamat_wali TEXT,
    pekerjaan_wali VARCHAR(100),
    golongan_darah VARCHAR(3),
    anak_ke INT,
    status_anak VARCHAR(20),
    nama_sekolah_asal VARCHAR(100),
    alamat_sekolah_asal TEXT,
    foto VARCHAR(255),
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE SET NULL,
    FOREIGN KEY (kelas_id) REFERENCES kelas(id),
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran(id),
    UNIQUE KEY unique_no_induk (no_induk),
    INDEX idx_nama (nama),
    INDEX idx_kelas (kelas_id),
    INDEX idx_status (status),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Subject (Mata Pelajaran)
CREATE TABLE mapel (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode_mapel VARCHAR(20) UNIQUE,
    mata_pelajaran VARCHAR(100) NOT NULL,
    kategori_pelajaran VARCHAR(50),
    jam_pembelajaran INT,
    kurikulum VARCHAR(100),
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_nama (mata_pelajaran),
    INDEX idx_kategori (kategori_pelajaran),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Curriculum (Kurikulum)
CREATE TABLE kurikulum (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kelas_id INT NOT NULL,
    mapel_id INT NOT NULL,
    tahun_ajaran_id INT NOT NULL,
    urutan INT,
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kelas_id) REFERENCES kelas(id),
    FOREIGN KEY (mapel_id) REFERENCES mapel(id),
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran(id),
    UNIQUE KEY unique_curriculum (kelas_id, mapel_id, tahun_ajaran_id),
    INDEX idx_kelas (kelas_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Teacher-Subject-Class Assignment (Pelajaran Kelas)
CREATE TABLE pelajaran_kelas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kelas_id INT NOT NULL,
    mapel_id INT NOT NULL,
    guru_id INT NOT NULL,
    tahun_ajaran_id INT NOT NULL,
    jam_mulai TIME,
    jam_selesai TIME,
    ruangan VARCHAR(10),
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kelas_id) REFERENCES kelas(id),
    FOREIGN KEY (mapel_id) REFERENCES mapel(id),
    FOREIGN KEY (guru_id) REFERENCES guru(id),
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran(id),
    UNIQUE KEY unique_assignment (kelas_id, mapel_id, tahun_ajaran_id),
    INDEX idx_guru (guru_id),
    INDEX idx_kelas (kelas_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Schedule (Jadwal)
CREATE TABLE jadwal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pelajaran_kelas_id INT NOT NULL,
    hari ENUM('SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU') NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (pelajaran_kelas_id) REFERENCES pelajaran_kelas(id),
    INDEX idx_hari (hari),
    INDEX idx_pelajaran_kelas (pelajaran_kelas_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Attendance (Absen)
CREATE TABLE absen (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT NOT NULL,
    pelajaran_kelas_id INT NOT NULL,
    tanggal DATE NOT NULL,
    status ENUM('HADIR', 'SAKIT', 'IZIN', 'ALPHA') DEFAULT 'HADIR',
    keterangan TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (pelajaran_kelas_id) REFERENCES pelajaran_kelas(id),
    UNIQUE KEY unique_attendance (siswa_id, pelajaran_kelas_id, tanggal),
    INDEX idx_siswa (siswa_id),
    INDEX idx_tanggal (tanggal),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Grade (Nilai)
CREATE TABLE nilai (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT NOT NULL,
    pelajaran_kelas_id INT NOT NULL,
    tahun_ajaran_id INT NOT NULL,
    semester INT,
    tugas DECIMAL(5,2),
    uts DECIMAL(5,2),
    uas DECIMAL(5,2),
    rata_rata DECIMAL(5,2),
    grade VARCHAR(2),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (pelajaran_kelas_id) REFERENCES pelajaran_kelas(id),
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran(id),
    UNIQUE KEY unique_grade (siswa_id, pelajaran_kelas_id, tahun_ajaran_id, semester),
    INDEX idx_siswa (siswa_id),
    INDEX idx_pelajaran (pelajaran_kelas_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Promotion (Kenaikan)
CREATE TABLE kenaikan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT NOT NULL,
    tahun_ajaran_dari INT NOT NULL,
    tahun_ajaran_ke INT,
    status ENUM('NAIK', 'TIDAK_NAIK', 'KELUAR') DEFAULT 'NAIK',
    keterangan TEXT,
    decided_by INT,
    decided_at DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (tahun_ajaran_dari) REFERENCES tahun_ajaran(id),
    FOREIGN KEY (tahun_ajaran_ke) REFERENCES tahun_ajaran(id),
    FOREIGN KEY (decided_by) REFERENCES user(id),
    UNIQUE KEY unique_promotion (siswa_id, tahun_ajaran_dari),
    INDEX idx_siswa (siswa_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Academic Calendar (Akademik)
CREATE TABLE akademik (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE,
    kegiatan TEXT,
    tahun_ajaran_id INT NOT NULL,
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran(id),
    INDEX idx_tanggal (tanggal_mulai),
    INDEX idx_tahun_ajaran (tahun_ajaran_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- New Student Registration (Daftar)
CREATE TABLE daftar (
    id INT PRIMARY KEY AUTO_INCREMENT,
    no_registrasi VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    no_telepon VARCHAR(20),
    program_studi VARCHAR(100),
    tanggal_daftar DATE NOT NULL,
    status ENUM('PENDING', 'DITERIMA', 'DITOLAK') DEFAULT 'PENDING',
    keterangan TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_tanggal (tanggal_daftar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admission Selection (Seleksi)
CREATE TABLE seleksi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    daftar_id INT,
    siswa_id INT,
    status ENUM('DITERIMA', 'DITOLAK', 'CADANGAN') DEFAULT 'DITERIMA',
    tanggal_hasil DATE,
    no_induk VARCHAR(20),
    tahun_ajaran_id INT,
    keterangan TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (daftar_id) REFERENCES daftar(id),
    FOREIGN KEY (siswa_id) REFERENCES siswa(id),
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran(id),
    INDEX idx_status (status),
    INDEX idx_daftar (daftar_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- School Fee Payment (SPP/Iuran)
CREATE TABLE spp (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT NOT NULL,
    bulan INT NOT NULL,
    tahun INT NOT NULL,
    nominal DECIMAL(10,2) NOT NULL,
    status ENUM('BELUM_LUNAS', 'LUNAS', 'CICIL') DEFAULT 'BELUM_LUNAS',
    tanggal_bayar DATE,
    metode_bayar VARCHAR(50),
    catatan TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE,
    UNIQUE KEY unique_spp (siswa_id, bulan, tahun),
    INDEX idx_siswa (siswa_id),
    INDEX idx_status (status),
    INDEX idx_tanggal (tanggal_bayar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Other Payment Types (Pembayaran Lain)
CREATE TABLE pembayaran_lain (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_pembayaran VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    nominal DECIMAL(10,2) NOT NULL,
    tanggal_mulai DATE,
    tanggal_berakhir DATE,
    denda_per_hari DECIMAL(10,2),
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Other Payment Records
CREATE TABLE pembayaran_lain_siswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT NOT NULL,
    pembayaran_lain_id INT NOT NULL,
    nominal DECIMAL(10,2) NOT NULL,
    status ENUM('BELUM_LUNAS', 'LUNAS', 'CICIL') DEFAULT 'BELUM_LUNAS',
    tanggal_bayar DATE,
    metode_bayar VARCHAR(50),
    catatan TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (pembayaran_lain_id) REFERENCES pembayaran_lain(id),
    INDEX idx_siswa (siswa_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Library Books (Perpustakaan)
CREATE TABLE buku_perpustakaan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul_buku VARCHAR(200) NOT NULL,
    kode_buku VARCHAR(20) UNIQUE,
    pengarang VARCHAR(100),
    penerbit VARCHAR(100),
    isbn VARCHAR(20) UNIQUE,
    tahun_terbit INT,
    kategori VARCHAR(50),
    jumlah_buku INT DEFAULT 1,
    jumlah_tersedia INT DEFAULT 1,
    lokasi_rak VARCHAR(20),
    tanggal_masuk DATE,
    keterangan TEXT,
    is_active BOOLEAN DEFAULT true,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_judul (judul_buku),
    INDEX idx_pengarang (pengarang),
    INDEX idx_kategori (kategori),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Activity Log
CREATE TABLE activity_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    entity_type VARCHAR(50),
    entity_id INT,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE SET NULL,
    INDEX idx_user (user_id),
    INDEX idx_created (created_at),
    INDEX idx_entity (entity_type, entity_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Useful Views

-- View: Student Full Grade Info
CREATE VIEW v_nilai_siswa AS
SELECT
    s.id as siswa_id,
    s.no_induk,
    s.nama,
    k.nama_kelas,
    m.mata_pelajaran,
    g.nama as guru_nama,
    n.tugas,
    n.uts,
    n.uas,
    n.rata_rata,
    n.grade,
    n.semester,
    ta.tahun_ajaran
FROM nilai n
JOIN siswa s ON n.siswa_id = s.id
JOIN pelajaran_kelas pk ON n.pelajaran_kelas_id = pk.id
JOIN kelas k ON pk.kelas_id = k.id
JOIN mapel m ON pk.mapel_id = m.id
JOIN guru g ON pk.guru_id = g.id
JOIN tahun_ajaran ta ON n.tahun_ajaran_id = ta.id;

-- View: Student Attendance Summary
CREATE VIEW v_absen_siswa AS
SELECT
    s.id as siswa_id,
    s.no_induk,
    s.nama,
    k.nama_kelas,
    MONTH(a.tanggal) as bulan,
    YEAR(a.tanggal) as tahun,
    SUM(CASE WHEN a.status = 'HADIR' THEN 1 ELSE 0 END) as hadir,
    SUM(CASE WHEN a.status = 'SAKIT' THEN 1 ELSE 0 END) as sakit,
    SUM(CASE WHEN a.status = 'IZIN' THEN 1 ELSE 0 END) as izin,
    SUM(CASE WHEN a.status = 'ALPHA' THEN 1 ELSE 0 END) as alpha
FROM absen a
JOIN siswa s ON a.siswa_id = s.id
JOIN pelajaran_kelas pk ON a.pelajaran_kelas_id = pk.id
JOIN kelas k ON pk.kelas_id = k.id
GROUP BY s.id, MONTH(a.tanggal), YEAR(a.tanggal);

-- View: Promotion Decisions
CREATE VIEW v_kenaikan AS
SELECT
    k.id,
    s.id as siswa_id,
    s.no_induk,
    s.nama,
    kl.nama_kelas,
    ta_dari.tahun_ajaran as tahun_ajaran_dari,
    ta_ke.tahun_ajaran as tahun_ajaran_ke,
    k.status,
    k.keterangan
FROM kenaikan k
JOIN siswa s ON k.siswa_id = s.id
JOIN kelas kl ON s.kelas_id = kl.id
JOIN tahun_ajaran ta_dari ON k.tahun_ajaran_dari = ta_dari.id
LEFT JOIN tahun_ajaran ta_ke ON k.tahun_ajaran_ke = ta_ke.id;

-- View: Class Schedule
CREATE VIEW v_jadwal_kelas AS
SELECT
    j.id,
    k.nama_kelas,
    m.mata_pelajaran,
    g.nama as guru_nama,
    j.hari,
    j.jam_mulai,
    j.jam_selesai,
    pk.ruangan,
    ta.tahun_ajaran
FROM jadwal j
JOIN pelajaran_kelas pk ON j.pelajaran_kelas_id = pk.id
JOIN kelas k ON pk.kelas_id = k.id
JOIN mapel m ON pk.mapel_id = m.id
JOIN guru g ON pk.guru_id = g.id
JOIN tahun_ajaran ta ON pk.tahun_ajaran_id = ta.id;

-- View: Outstanding Payments
CREATE VIEW v_pembayaran_tertunggak AS
SELECT
    s.id as siswa_id,
    s.no_induk,
    s.nama,
    k.nama_kelas,
    'SPP' as jenis_pembayaran,
    SUM(spp.nominal) as total_tunggak,
    COUNT(*) as bulan_tunggak
FROM siswa s
JOIN kelas k ON s.kelas_id = k.id
JOIN spp ON s.id = spp.siswa_id
WHERE spp.status != 'LUNAS'
GROUP BY s.id
UNION
SELECT
    s.id as siswa_id,
    s.no_induk,
    s.nama,
    k.nama_kelas,
    pl.nama_pembayaran,
    pls.nominal as total_tunggak,
    1 as bulan_tunggak
FROM siswa s
JOIN kelas k ON s.kelas_id = k.id
JOIN pembayaran_lain_siswa pls ON s.id = pls.siswa_id
JOIN pembayaran_lain pl ON pls.pembayaran_lain_id = pl.id
WHERE pls.status != 'LUNAS';

-- Indexes for Performance
CREATE INDEX idx_user_role_active ON user(role, is_active);
CREATE INDEX idx_siswa_kelas_tahun ON siswa(kelas_id, tahun_ajaran_id);
CREATE INDEX idx_pelajaran_kelas_tahun ON pelajaran_kelas(tahun_ajaran_id);
CREATE INDEX idx_absen_siswa_tanggal ON absen(siswa_id, tanggal);
CREATE INDEX idx_nilai_siswa_pelajaran ON nilai(siswa_id, pelajaran_kelas_id);
CREATE INDEX idx_spp_siswa_status ON spp(siswa_id, status);

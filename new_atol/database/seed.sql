-- Seed Data for SIFOPI System
-- Realistic dummy data for testing

-- Academic Years
INSERT INTO tahun_ajaran (tahun_ajaran, keterangan, is_active) VALUES
('2025/2026', 'Tahun Ajaran 2025-2026', true),
('2024/2025', 'Tahun Ajaran 2024-2025', false),
('2023/2024', 'Tahun Ajaran 2023-2024', false);

-- Users (passwords will be hashed with bcrypt in the application)
-- Admin: admin/password (bcrypt hash)
INSERT INTO user (username, email, password_hash, fullname, role, phone, is_active) VALUES
('admin', 'admin@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Administrator', 'ADMIN', '082123456789', true),
('tata_usaha', 'tu@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Staff Tata Usaha', 'TATA_USAHA', '082123456790', true);

-- Teachers (Guru)
INSERT INTO user (username, email, password_hash, fullname, role, phone, is_active) VALUES
('guru_budi', 'budi@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Budi Santoso', 'GURU', '082987654321', true),
('guru_siti', 'siti@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Siti Nurhaliza', 'GURU', '082987654322', true),
('guru_ahmad', 'ahmad@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Ahmad Wijaya', 'GURU', '082987654323', true),
('guru_dewi', 'dewi@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Dewi Lestari', 'GURU', '082987654324', true);

-- Insert Guru records
INSERT INTO guru (user_id, nip, nama, tgl_lahir, jenis_kelamin, agama, alamat, no_telepon, email, tgl_masuk, status) VALUES
(3, '19780512200001', 'Budi Santoso', '1978-05-12', 'LAKI-LAKI', 'Islam', 'Jl. Merdeka No. 123, Bandung', '082987654321', 'budi@smk-pi.sch.id', '2005-07-01', 'AKTIF'),
(4, '19850318200002', 'Siti Nurhaliza', '1985-03-18', 'PEREMPUAN', 'Islam', 'Jl. Sudirman No. 456, Bandung', '082987654322', 'siti@smk-pi.sch.id', '2008-08-15', 'AKTIF'),
(5, '19800721200003', 'Ahmad Wijaya', '1980-07-21', 'LAKI-LAKI', 'Islam', 'Jl. Gatot Subroto No. 789, Bandung', '082987654323', 'ahmad@smk-pi.sch.id', '2006-09-01', 'AKTIF'),
(6, '19870602200004', 'Dewi Lestari', '1987-06-02', 'PEREMPUAN', 'Kristen', 'Jl. Diponegoro No. 234, Bandung', '082987654324', 'dewi@smk-pi.sch.id', '2009-07-01', 'AKTIF');

-- Classes (Kelas)
INSERT INTO kelas (nama_kelas, no_ruangan, id_guru_wali, tahun_ajaran_id, kurikulum, capacity, is_active) VALUES
('X TKJ A', '101', 1, 1, 'K13', 40, true),
('X TKJ B', '102', 2, 1, 'K13', 40, true),
('XI TKJ A', '201', 3, 1, 'K13', 40, true),
('XI TKJ B', '202', 4, 1, 'K13', 40, true),
('XII TKJ A', '301', 1, 1, 'K13', 40, true);

-- Subjects (Mata Pelajaran)
INSERT INTO mapel (kode_mapel, mata_pelajaran, kategori_pelajaran, jam_pembelajaran, kurikulum, is_active) VALUES
('MTK001', 'Matematika', 'Umum', 4, 'K13', true),
('IND001', 'Bahasa Indonesia', 'Umum', 3, 'K13', true),
('ING001', 'Bahasa Inggris', 'Umum', 3, 'K13', true),
('PKN001', 'Pendidikan Kewarganegaraan', 'Umum', 2, 'K13', true),
('PAI001', 'Pendidikan Agama Islam', 'Umum', 2, 'K13', true),
('JRG001', 'Jaringan Dasar', 'Produktif', 4, 'K13', true),
('SIS001', 'Sistem Operasi', 'Produktif', 4, 'K13', true),
('DAD001', 'Database', 'Produktif', 4, 'K13', true),
('WEB001', 'Web Programming', 'Produktif', 6, 'K13', true),
('UJK001', 'Ujian Kompetensi', 'Produktif', 2, 'K13', true);

-- Curriculum (Kurikulum) - Map subjects to classes
INSERT INTO kurikulum (kelas_id, mapel_id, tahun_ajaran_id, urutan, is_active) VALUES
(1, 1, 1, 1, true),
(1, 2, 1, 2, true),
(1, 3, 1, 3, true),
(1, 4, 1, 4, true),
(1, 5, 1, 5, true),
(1, 6, 1, 6, true),
(1, 7, 1, 7, true),
(3, 1, 1, 1, true),
(3, 2, 1, 2, true),
(3, 3, 1, 3, true),
(3, 8, 1, 4, true),
(3, 9, 1, 5, true);

-- Teacher-Subject-Class Assignments (Pelajaran Kelas)
INSERT INTO pelajaran_kelas (kelas_id, mapel_id, guru_id, tahun_ajaran_id, jam_mulai, jam_selesai, ruangan, is_active) VALUES
(1, 1, 1, 1, '07:30:00', '09:10:00', '101', true),
(1, 6, 2, 1, '09:30:00', '11:50:00', '101', true),
(1, 7, 3, 1, '12:30:00', '15:00:00', 'Lab A', true),
(3, 1, 1, 1, '07:30:00', '09:10:00', '201', true),
(3, 8, 4, 1, '09:30:00', '11:50:00', 'Lab B', true),
(3, 9, 2, 1, '12:30:00', '15:00:00', '201', true);

-- Schedules (Jadwal)
INSERT INTO jadwal (pelajaran_kelas_id, hari, jam_mulai, jam_selesai) VALUES
(1, 'SENIN', '07:30:00', '09:10:00'),
(1, 'SELASA', '07:30:00', '09:10:00'),
(1, 'RABU', '07:30:00', '09:10:00'),
(1, 'KAMIS', '07:30:00', '09:10:00'),
(1, 'JUMAT', '07:30:00', '09:10:00'),
(2, 'SENIN', '09:30:00', '11:50:00'),
(2, 'RABU', '09:30:00', '11:50:00'),
(2, 'JUMAT', '09:30:00', '11:50:00'),
(3, 'SELASA', '12:30:00', '15:00:00'),
(3, 'KAMIS', '12:30:00', '15:00:00');

-- Students (Siswa) - Create user accounts first
INSERT INTO user (username, email, password_hash, fullname, role, phone, is_active) VALUES
('siswa_001', 'siswa001@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Aldi Pratama', 'SISWA', '081234567890', true),
('siswa_002', 'siswa002@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Bella Saphira', 'SISWA', '081234567891', true),
('siswa_003', 'siswa003@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Citra Dewi', 'SISWA', '081234567892', true),
('siswa_004', 'siswa004@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Doni Rahman', 'SISWA', '081234567893', true),
('siswa_005', 'siswa005@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Erika Putri', 'SISWA', '081234567894', true),
('siswa_006', 'siswa006@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Fajar Hadinata', 'SISWA', '081234567895', true),
('siswa_007', 'siswa007@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Gita Novelia', 'SISWA', '081234567896', true),
('siswa_008', 'siswa008@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Hendra Kusuma', 'SISWA', '081234567897', true),
('siswa_009', 'siswa009@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Indah Nurwati', 'SISWA', '081234567898', true),
('siswa_010', 'siswa010@smk-pi.sch.id', '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy', 'Joko Setiawan', 'SISWA', '081234567899', true);

-- Insert Siswa records
INSERT INTO siswa (user_id, no_induk, nama, tgl_lahir, jenis_kelamin, agama, alamat, no_telepon, email, status, kelas_id, tahun_ajaran_id, tanggal_masuk) VALUES
(7, '2025001001', 'Aldi Pratama', '2007-03-15', 'LAKI-LAKI', 'Islam', 'Jl. Ahmad Yani No. 11, Bandung', '081234567890', 'siswa001@smk-pi.sch.id', 'AKTIF', 1, 1, '2025-07-01'),
(8, '2025001002', 'Bella Saphira', '2007-05-22', 'PEREMPUAN', 'Islam', 'Jl. Raya Bandung No. 22, Bandung', '081234567891', 'siswa002@smk-pi.sch.id', 'AKTIF', 1, 1, '2025-07-01'),
(9, '2025001003', 'Citra Dewi', '2007-07-18', 'PEREMPUAN', 'Kristen', 'Jl. Setia Budi No. 33, Bandung', '081234567892', 'siswa003@smk-pi.sch.id', 'AKTIF', 1, 1, '2025-07-01'),
(10, '2025001004', 'Doni Rahman', '2007-09-10', 'LAKI-LAKI', 'Islam', 'Jl. Cihampelas No. 44, Bandung', '081234567893', 'siswa004@smk-pi.sch.id', 'AKTIF', 1, 1, '2025-07-01'),
(11, '2025001005', 'Erika Putri', '2007-11-25', 'PEREMPUAN', 'Katolik', 'Jl. Astana Anyar No. 55, Bandung', '081234567894', 'siswa005@smk-pi.sch.id', 'AKTIF', 1, 1, '2025-07-01'),
(12, '2025003001', 'Fajar Hadinata', '2006-04-08', 'LAKI-LAKI', 'Islam', 'Jl. Dago No. 66, Bandung', '081234567895', 'siswa006@smk-pi.sch.id', 'AKTIF', 3, 1, '2024-07-01'),
(13, '2025003002', 'Gita Novelia', '2006-06-14', 'PEREMPUAN', 'Islam', 'Jl. Lembang No. 77, Bandung', '081234567896', 'siswa007@smk-pi.sch.id', 'AKTIF', 3, 1, '2024-07-01'),
(14, '2025003003', 'Hendra Kusuma', '2006-08-20', 'LAKI-LAKI', 'Budha', 'Jl. Bukit Dago No. 88, Bandung', '081234567897', 'siswa008@smk-pi.sch.id', 'AKTIF', 3, 1, '2024-07-01'),
(15, '2025003004', 'Indah Nurwati', '2006-10-30', 'PEREMPUAN', 'Islam', 'Jl. Riau No. 99, Bandung', '081234567898', 'siswa009@smk-pi.sch.id', 'AKTIF', 3, 1, '2024-07-01'),
(16, '2025003005', 'Joko Setiawan', '2006-12-05', 'LAKI-LAKI', 'Islam', 'Jl. Setra Dago No. 100, Bandung', '081234567899', 'siswa010@smk-pi.sch.id', 'AKTIF', 3, 1, '2024-07-01');

-- Academic Calendar (Akademik)
INSERT INTO akademik (nama, tanggal_mulai, tanggal_selesai, kegiatan, tahun_ajaran_id, is_active) VALUES
('Semester Gasal', '2025-07-01', '2025-12-15', 'Pembelajaran Semester 1', 1, true),
('UTS Gasal', '2025-09-15', '2025-09-26', 'Ujian Tengah Semester Gasal', 1, true),
('UAS Gasal', '2025-11-24', '2025-12-05', 'Ujian Akhir Semester Gasal', 1, true),
('Liburan Akhir Tahun', '2025-12-16', '2026-01-03', 'Libur Akhir Tahun', 1, true),
('Semester Genap', '2026-01-04', '2026-06-15', 'Pembelajaran Semester 2', 1, true);

-- Grades (Nilai)
INSERT INTO nilai (siswa_id, pelajaran_kelas_id, tahun_ajaran_id, semester, tugas, uts, uas, rata_rata, grade) VALUES
(1, 1, 1, 1, 85.0, 80.0, 82.0, 82.33, 'B'),
(1, 2, 1, 1, 90.0, 88.0, 89.0, 89.0, 'A'),
(1, 3, 1, 1, 78.0, 75.0, 76.0, 76.33, 'C'),
(2, 1, 1, 1, 88.0, 85.0, 86.0, 86.33, 'A'),
(2, 2, 1, 1, 92.0, 90.0, 91.0, 91.0, 'A'),
(2, 3, 1, 1, 80.0, 78.0, 79.0, 79.0, 'B'),
(6, 4, 1, 1, 85.0, 82.0, 84.0, 83.67, 'B'),
(6, 5, 1, 1, 88.0, 86.0, 87.0, 87.0, 'A'),
(6, 6, 1, 1, 92.0, 90.0, 91.0, 91.0, 'A');

-- Attendance (Absen)
INSERT INTO absen (siswa_id, pelajaran_kelas_id, tanggal, status, keterangan) VALUES
(1, 1, '2025-09-01', 'HADIR', NULL),
(1, 1, '2025-09-02', 'HADIR', NULL),
(1, 1, '2025-09-03', 'HADIR', NULL),
(1, 1, '2025-09-04', 'SAKIT', 'Demam'),
(1, 1, '2025-09-05', 'HADIR', NULL),
(2, 1, '2025-09-01', 'HADIR', NULL),
(2, 1, '2025-09-02', 'HADIR', NULL),
(2, 1, '2025-09-03', 'IZIN', 'Ada keluarga'),
(2, 1, '2025-09-04', 'HADIR', NULL),
(2, 1, '2025-09-05', 'HADIR', NULL);

-- School Fees (SPP)
INSERT INTO spp (siswa_id, bulan, tahun, nominal, status, tanggal_bayar, metode_bayar) VALUES
(1, 7, 2025, 450000, 'LUNAS', '2025-07-05', 'Transfer Bank'),
(1, 8, 2025, 450000, 'LUNAS', '2025-08-03', 'Transfer Bank'),
(1, 9, 2025, 450000, 'BELUM_LUNAS', NULL, NULL),
(2, 7, 2025, 450000, 'LUNAS', '2025-07-02', 'Transfer Bank'),
(2, 8, 2025, 450000, 'LUNAS', '2025-08-08', 'Tunai'),
(2, 9, 2025, 450000, 'LUNAS', '2025-09-01', 'Transfer Bank'),
(6, 7, 2025, 450000, 'LUNAS', '2025-07-04', 'Transfer Bank'),
(6, 8, 2025, 450000, 'BELUM_LUNAS', NULL, NULL),
(6, 9, 2025, 450000, 'BELUM_LUNAS', NULL, NULL);

-- Other Payment Types (Pembayaran Lain)
INSERT INTO pembayaran_lain (nama_pembayaran, deskripsi, nominal, tanggal_mulai, tanggal_berakhir, denda_per_hari, is_active) VALUES
('Dana Pengembangan', 'Untuk pengembangan sarana & prasarana sekolah', 500000, '2025-07-01', '2025-12-31', 10000, true),
('Dana Kegiatan Siswa', 'Untuk kegiatan ekstrakurikuler & acara siswa', 300000, '2025-07-01', '2025-12-31', 5000, true),
('Seragam Sekolah', 'Pembelian seragam sesuai dengan dress code', 350000, '2025-07-01', '2025-09-30', 0, true);

-- Library Books (Perpustakaan)
INSERT INTO buku_perpustakaan (judul_buku, kode_buku, pengarang, penerbit, isbn, tahun_terbit, kategori, jumlah_buku, jumlah_tersedia, lokasi_rak, tanggal_masuk) VALUES
('Pemrograman Web Dasar', 'B001', 'Budi Raharjo', 'Penerbit Informatika', '978-602-262-123-4', 2020, 'Teknik Komputer', 5, 3, 'A1', '2020-08-15'),
('Jaringan Komputer Fundamental', 'B002', 'Andrew S. Tanenbaum', 'Pearson', '978-0-133-95368-5', 2013, 'Teknik Komputer', 3, 1, 'A2', '2020-09-10'),
('Database Design', 'B003', 'C.J. Date', 'Addison-Wesley', '978-0-321-88485-4', 2012, 'Teknik Komputer', 2, 2, 'A3', '2020-10-05'),
('Linux Administrator', 'B004', 'Sander van Vugt', 'Packt', '978-1-789-95430-6', 2019, 'Sistem Operasi', 4, 2, 'B1', '2021-01-20'),
('Bahasa Indonesia Terpadu', 'B005', 'Martono', 'Pusat Kurikulum', '978-602-256-089-0', 2018, 'Umum', 10, 8, 'C1', '2019-06-15'),
('Matematika Kelas X', 'B006', 'Sukino', 'Erlangga', '978-979-068-870-9', 2017, 'Umum', 8, 5, 'C2', '2019-07-10'),
('Pendidikan Kewarganegaraan', 'B007', 'Somantri', 'Grafindo', '978-979-748-341-1', 2018, 'Umum', 12, 10, 'C3', '2019-08-20');

-- New Student Applications (Daftar)
INSERT INTO daftar (no_registrasi, nama, email, no_telepon, program_studi, tanggal_daftar, status, keterangan) VALUES
('REG/2025/001', 'Reno Adrianto', 'reno@gmail.com', '081555555501', 'Teknik Komputer & Jaringan', '2025-05-10', 'PENDING', NULL),
('REG/2025/002', 'Sinta Wijaya', 'sinta@gmail.com', '081555555502', 'Teknik Otomotif', '2025-05-12', 'DITERIMA', 'Lulus seleksi'),
('REG/2025/003', 'Taufik Rahman', 'taufik@gmail.com', '081555555503', 'Teknik Komputer & Jaringan', '2025-05-15', 'DITOLAK', 'Nilai tidak memenuhi standar');

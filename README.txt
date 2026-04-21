
SIFOPI — Sistem Informasi Akademik SMK PI 52 Bandung Tugas ATOL 2014  ·  Direvitalisasi 2026                              


  Proyek ini awalnya adalah tugas kelompok mata kuliah ATOL (Analisis &
  Teknik Orientasi Lab) tahun 2014 — sebuah Sistem Informasi Pendidikan
  untuk SMK Prakarya Internasional (SMK PI) 52 Bandung yang sempat
  terbengkalai selama bertahun-tahun.

  Kini di-refactor ulang dari nol dengan php terbaru


  TENTANG PROYEK


  Nama        : SIFOPI (Sistem Informasi Akademik SMK PI)
  Versi       : 2.0 (Refactor 2026)
  Asal        : Tugas kelompok ATOL — 2014
  Sekolah     : SMK Prakarya Internasional 52, Bandung


  TEKNOLOGI


  Backend     PHP 8.x + PDO (tanpa framework)
  Database    MySQL 8.x (22 tabel, 5 views)
  Frontend    HTML5 · CSS3 (Flexbox/Grid) · Vanilla JavaScript ES6+
  Server      PHP Built-in Development Server

  Tidak ada npm. Tidak ada Composer. Tidak ada framework.
  Murni vanilla — bisa jalan di mesin manapun yang ada PHP & MySQL.


  FITUR


  [+] Login multi-role  (Admin / Guru / Siswa / Tata Usaha / Wali Siswa)
  [+] Manajemen Siswa   (CRUD, pencarian, pagination)
  [+] Manajemen Guru    (CRUD)
  [+] Nilai & Rapor     (input tugas/UTS/UAS, hitung rata-rata otomatis)
  [+] Absensi           (rekap per bulan, persentase kehadiran)
  [+] Jadwal Pelajaran
  [+] Pembayaran SPP    (status lunas / cicil / belum)
  [+] Dashboard per role
  [+] Keamanan          (bcrypt, prepared statement, CSRF token, XSS-safe)


  CARA MENJALANKAN


  1. Import database:
       Buka MySQL Workbench / phpMyAdmin
       Jalankan:  new_atol/database/schema.sql
       Lalu:      new_atol/database/seed.sql

  2. Jalankan server:
       cd new_atol
       php start.php

  3. Buka browser:
       http://localhost:8000

  4. Login dengan akun demo:
       admin       / password   (Administrator)
       guru_budi   / password   (Guru)
       siswa_001   / password   (Siswa)
       tata_usaha  / password   (Tata Usaha)

  Detail lengkap: new_atol/SETUP.md


  STRUKTUR FOLDER


  new_atol/
  ├── config/          Konfigurasi (database, konstanta, helper functions)
  ├── database/        Schema SQL + seed data
  ├── public/          Entry point & aset statis (CSS, JS, gambar)
  ├── src/
  │   ├── controllers/ Handler request per modul
  │   └── models/      Entitas database & query methods
  └── views/           Template HTML per modul


  KEAMANAN


  [x] SQL Injection  — PDO Prepared Statements
  [x] XSS            — htmlspecialchars() pada semua output
  [x] CSRF           — Token validasi pada setiap form POST
  [x] Password       — Bcrypt hash (cost 10)
  [x] Session        — Timeout 30 menit, HttpOnly cookie


  CATATAN


  Folder lama (Atol_kelompok10_*) masih ada sebagai arsip — berisi kode
  PHP 4/5 era dengan mysql_* extension yang sudah tidak didukung PHP 7+.
  Jangan dijalankan di lingkungan produksi.

  Default password untuk semua akun: "password"
  Ganti sebelum deploy ke produksi!


  github.com/muhamu  ·  SMK PI 52 Bandung  ·  2014 → 2026



# SIFOPI — Sistem Informasi Akademik SMK PI

Aplikasi manajemen akademik berbasis PHP untuk SMK Prakarya Internasional 52 Bandung.

## Prasyarat

- PHP 8.1+ (dengan ekstensi `pdo_mysql`)
- MySQL 5.7+ atau MariaDB

## Cara Menjalankan

**1. Import database**

```sql
-- Buat database
CREATE DATABASE atol_akademik_smk_pi;

-- Import schema + data
mysql -u root atol_akademik_smk_pi < database/schema.sql
mysql -u root atol_akademik_smk_pi < database/seed.sql
```

**2. Jalankan server**

```bat
run-server.bat
```

Atau manual:

```bash
php -S localhost:8000 -t public public/index.php
```

**3. Buka browser** → `http://localhost:8000`

## Akun Login Default

| Role | Username | Password |
|---|---|---|
| Administrator | `admin` | `password` |
| Guru | `guru_budi` | `password` |
| Tata Usaha | `tata_usaha` | `password` |

## Fitur

- Manajemen Siswa, Guru, Kelas, Mata Pelajaran
- Input & rekap Nilai dan Absensi
- Pembayaran SPP / Iuran
- Jadwal Pelajaran
- Dashboard statistik real-time
- Multi-role: Admin, Guru, Siswa, Tata Usaha, Wali Siswa

-- Fix password hashes for all users
-- Run this if you already imported seed.sql with wrong hashes
-- Password for all accounts: 'password'

USE atol_akademik_smk_pi;

UPDATE user SET password_hash = '$2y$10$i0Kj4Jk5mmhTSrfacSLY3ehW5aTCcCaOF/MBggwCDqjudDHIr1Fgy'
WHERE username IN ('admin', 'tata_usaha', 'guru_budi', 'guru_siti', 'guru_ahmad', 'guru_dewi',
                   'siswa_001', 'siswa_002', 'siswa_003', 'siswa_004', 'siswa_005',
                   'siswa_006', 'siswa_007', 'siswa_008', 'siswa_009', 'siswa_010');

-- Verify
SELECT username, role, LEFT(password_hash, 20) as hash_preview FROM user;

<?php
/**
 * Global Application Constants
 */

// User Roles (5 roles as approved)
define('ROLE_ADMIN', 'ADMIN');
define('ROLE_GURU', 'GURU');
define('ROLE_SISWA', 'SISWA');
define('ROLE_TATA_USAHA', 'TATA_USAHA');
define('ROLE_WALI_SISWA', 'WALI_SISWA');

const USER_ROLES = [
    'ADMIN' => 'Administrator',
    'GURU' => 'Guru/Pengajar',
    'SISWA' => 'Siswa',
    'TATA_USAHA' => 'Staff Tata Usaha (Keuangan)',
    'WALI_SISWA' => 'Wali Siswa (Orang Tua)',
];

// Student Status
const STUDENT_STATUS = [
    'AKTIF' => 'Aktif',
    'LULUS' => 'Lulus',
    'KELUAR' => 'Keluar',
    'SUSPENDED' => 'Dikeluarkan',
];

// Attendance Status
const ATTENDANCE_STATUS = [
    'HADIR' => 'Hadir',
    'SAKIT' => 'Sakit',
    'IZIN' => 'Izin',
    'ALPHA' => 'Alpa',
];

// Promotion Status
const PROMOTION_STATUS = [
    'NAIK' => 'Naik Kelas',
    'TIDAK_NAIK' => 'Tidak Naik',
    'KELUAR' => 'Keluar',
];

// Application Status
const APPLICANT_STATUS = [
    'PENDING' => 'Menunggu',
    'DITERIMA' => 'Diterima',
    'DITOLAK' => 'Ditolak',
];

// Grade Categories
const GRADE_CATEGORY = [
    'TUGAS' => 'Tugas',
    'UTS' => 'Ujian Tengah Semester',
    'UAS' => 'Ujian Akhir Semester',
];

// Payment Status
const PAYMENT_STATUS = [
    'BELUM_LUNAS' => 'Belum Lunas',
    'LUNAS' => 'Lunas',
    'CICIL' => 'Cicilan',
];

// Time Formats
const DATE_FORMAT = 'Y-m-d';
const TIME_FORMAT = 'H:i:s';
const DATETIME_FORMAT = 'Y-m-d H:i:s';
const DISPLAY_DATE_FORMAT = 'd/m/Y';
const DISPLAY_DATETIME_FORMAT = 'd/m/Y H:i';

// File Upload
const MAX_FILE_SIZE = 5242880; // 5MB in bytes
const ALLOWED_UPLOAD_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
const ALLOWED_UPLOAD_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

// Security
const CSRF_TOKEN_LENGTH = 32;
const PASSWORD_MIN_LENGTH = 8;
const SESSION_LIFETIME = 1800; // 30 minutes
const SESSION_TIMEOUT_WARNING = 300; // 5 minutes before timeout

// Pagination
const ITEMS_PER_PAGE = 15;
const MAX_ITEMS_PER_PAGE = 100;

// School Info
const SCHOOL_NAME = 'SMK Prakarya Internasional (SMK PI) 52 Bandung';
const SCHOOL_ADDRESS = 'Jl. Inhoftank No. 46-146, Terusan Otista, Tegalega, Bandung';
const SCHOOL_PHONE = '(022) 520-4537 / (022) 520-2834';
const SCHOOL_EMAIL = 'info@smk-pi.sch.id';

// Design System - Colors
const COLOR_PRIMARY = '#0066CC';
const COLOR_SECONDARY = '#FF6B35';
const COLOR_SUCCESS = '#00AA44';
const COLOR_WARNING = '#FFAA00';
const COLOR_ERROR = '#CC0000';
const COLOR_INFO = '#0066CC';
const COLOR_LIGHT_BG = '#EEEEEE';
const COLOR_DARK_TEXT = '#333333';
const COLOR_BORDER = '#CCCCCC';

// Design System - Spacing (base unit: 8px)
const SPACING_XS = '4px';
const SPACING_SM = '8px';
const SPACING_MD = '16px';
const SPACING_LG = '24px';
const SPACING_XL = '32px';
const SPACING_2XL = '40px';

// HTTP Status Codes
const HTTP_OK = 200;
const HTTP_CREATED = 201;
const HTTP_BAD_REQUEST = 400;
const HTTP_UNAUTHORIZED = 401;
const HTTP_FORBIDDEN = 403;
const HTTP_NOT_FOUND = 404;
const HTTP_CONFLICT = 409;
const HTTP_UNPROCESSABLE_ENTITY = 422;
const HTTP_INTERNAL_SERVER_ERROR = 500;

// Messages
const MSG_SUCCESS = 'Operasi berhasil dilakukan';
const MSG_ERROR = 'Terjadi kesalahan. Silakan coba lagi';
const MSG_UNAUTHORIZED = 'Anda tidak memiliki akses ke halaman ini';
const MSG_NOT_FOUND = 'Data tidak ditemukan';
const MSG_INVALID_INPUT = 'Data yang Anda masukkan tidak valid';
const MSG_DUPLICATE = 'Data sudah ada di sistem';

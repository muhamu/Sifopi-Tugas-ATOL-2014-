<?php
/**
 * Helper Functions
 * Common utilities for security, validation, and application logic
 */

// Guard against multiple inclusions
if (function_exists('safe')) {
    return;
}

// Sanitization & Output Encoding

function safe(mixed $value): string {
    if (is_array($value) || is_object($value)) {
        return htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
    }
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function sanitize(string $value): string {
    return trim(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
}

function sanitizeArray(array $data): array {
    $sanitized = [];
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $sanitized[$key] = sanitizeArray($value);
        } else {
            $sanitized[$key] = sanitize($value);
        }
    }
    return $sanitized;
}

// Password Hashing & Verification

function hashPassword(string $password): string {
    if (strlen($password) < PASSWORD_MIN_LENGTH) {
        throw new Exception('Password must be at least ' . PASSWORD_MIN_LENGTH . ' characters');
    }
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function verifyPassword(string $password, string $hash): bool {
    return password_verify($password, $hash);
}

// CSRF Token Management

function generateCsrfToken(): string {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(CSRF_TOKEN_LENGTH));
    }
    return $_SESSION['csrf_token'];
}

function validateCsrfToken(string $token): bool {
    if (!isset($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

function regenerateCsrfToken(): string {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(CSRF_TOKEN_LENGTH));
    return $_SESSION['csrf_token'];
}

// Redirect & Response Utilities

function redirect(string $path): never {
    header('Location: ' . $path);
    exit;
}

function redirectBack(string $message = '', string $type = 'info'): never {
    $referer = $_SERVER['HTTP_REFERER'] ?? '/';
    if ($message) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }
    redirect($referer);
}

function jsonResponse(mixed $data, int $code = 200): never {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}

function apiSuccess(mixed $data = null, string $message = 'Success', int $code = 200): never {
    jsonResponse([
        'success' => true,
        'message' => $message,
        'data' => $data,
    ], $code);
}

function apiError(string $message = 'Error', mixed $errors = null, int $code = 400): never {
    jsonResponse([
        'success' => false,
        'message' => $message,
        'errors' => $errors,
    ], $code);
}

// Flash Messages

function setFlash(string $message, string $type = 'success'): void {
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

function getFlash(): ?array {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'] ?? 'info';
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
        return ['message' => $message, 'type' => $type];
    }
    return null;
}

function hasFlash(): bool {
    return isset($_SESSION['flash_message']);
}

// Validation Helpers

function validateEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validatePhone(string $phone): bool {
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    return strlen($phone) >= 10 && strlen($phone) <= 15;
}

function validateDate(string $date, string $format = 'Y-m-d'): bool {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function validateFileUpload(array $file): array {
    $errors = [];

    if (!isset($file['name']) || $file['name'] === '') {
        $errors[] = 'File tidak dipilih';
        return $errors;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Gagal upload file: ' . getUploadError($file['error']);
        return $errors;
    }

    if ($file['size'] > MAX_FILE_SIZE) {
        $errors[] = 'Ukuran file terlalu besar (maksimal ' . formatBytes(MAX_FILE_SIZE) . ')';
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime_type, ALLOWED_UPLOAD_TYPES)) {
        $errors[] = 'Tipe file tidak diizinkan';
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ALLOWED_UPLOAD_EXTENSIONS)) {
        $errors[] = 'Ekstensi file tidak diizinkan';
    }

    return $errors;
}

function getUploadError(int $code): string {
    return match($code) {
        UPLOAD_ERR_INI_SIZE => 'File terlalu besar (limit server)',
        UPLOAD_ERR_FORM_SIZE => 'File terlalu besar (limit form)',
        UPLOAD_ERR_PARTIAL => 'File hanya terupload sebagian',
        UPLOAD_ERR_NO_FILE => 'File tidak dipilih',
        UPLOAD_ERR_NO_TMP_DIR => 'Folder temp tidak tersedia',
        UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file',
        UPLOAD_ERR_EXTENSION => 'Upload dihentikan extension',
        default => 'Error upload tidak diketahui',
    };
}

// File Utilities

function formatBytes(int $bytes, int $precision = 2): string {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, $precision) . ' ' . $units[$pow];
}

function saveUploadedFile(array $file, string $directory): string {
    $originalName = basename($file['name']);
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $filename = uniqid('upload_') . '.' . $extension;

    $filepath = __DIR__ . '/../public/' . $directory . '/' . $filename;

    if (!is_dir(dirname($filepath))) {
        mkdir(dirname($filepath), 0755, true);
    }

    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        throw new Exception('Gagal menyimpan file');
    }

    return $directory . '/' . $filename;
}

// Array & String Utilities

function arrayKey(array $array, string $key, mixed $default = null): mixed {
    return $array[$key] ?? $default;
}

function arrayGet(array $array, string $key, mixed $default = null): mixed {
    $keys = explode('.', $key);
    $value = $array;

    foreach ($keys as $k) {
        if (is_array($value) && isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $default;
        }
    }

    return $value;
}

function slugify(string $text): string {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

// Date & Time Utilities

function formatDate(string|int $date, string $format = DISPLAY_DATE_FORMAT): string {
    if (is_string($date)) {
        $timestamp = strtotime($date);
    } else {
        $timestamp = $date;
    }
    return date($format, $timestamp);
}

function formatDateTime(string|int $datetime, string $format = DISPLAY_DATETIME_FORMAT): string {
    if (is_string($datetime)) {
        $timestamp = strtotime($datetime);
    } else {
        $timestamp = $datetime;
    }
    return date($format, $timestamp);
}

function getDaysInMonth(int $month, int $year): int {
    return (int)date('t', mktime(0, 0, 0, $month, 1, $year));
}

function isToday(string $date): bool {
    return date(DATE_FORMAT, strtotime($date)) === date(DATE_FORMAT);
}

function isPast(string $date): bool {
    return strtotime($date) < strtotime('today');
}

function isFuture(string $date): bool {
    return strtotime($date) > strtotime('today');
}

// String Utilities

function truncate(string $text, int $length = 100, string $suffix = '...'): string {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . $suffix;
}

function excerpt(string $text, int $length = 100): string {
    $text = strip_tags($text);
    return truncate($text, $length);
}

// Environment & Request Utilities

function envValue(string $key, mixed $default = null): mixed {
    return $_ENV[$key] ?? $default;
}

function isAjax(): bool {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function getMethod(): string {
    return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
}

function isPost(): bool {
    return getMethod() === 'POST';
}

function isGet(): bool {
    return getMethod() === 'GET';
}

function isPut(): bool {
    return getMethod() === 'PUT';
}

function isDelete(): bool {
    return getMethod() === 'DELETE';
}

function getClientIp(): string {
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return filter_var($ip, FILTER_VALIDATE_IP) ?: 'unknown';
}

// Pagination Helper

function getPaginationLinks(int $page, int $pages, string $baseUrl): string {
    if ($pages <= 1) return '';

    $html = '<nav class="pagination"><ul>';

    if ($page > 1) {
        $html .= '<li><a href="' . $baseUrl . '?page=1">First</a></li>';
        $html .= '<li><a href="' . $baseUrl . '?page=' . ($page - 1) . '">Previous</a></li>';
    }

    for ($i = max(1, $page - 2); $i <= min($pages, $page + 2); $i++) {
        if ($i === $page) {
            $html .= '<li class="active"><span>' . $i . '</span></li>';
        } else {
            $html .= '<li><a href="' . $baseUrl . '?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    if ($page < $pages) {
        $html .= '<li><a href="' . $baseUrl . '?page=' . ($page + 1) . '">Next</a></li>';
        $html .= '<li><a href="' . $baseUrl . '?page=' . $pages . '">Last</a></li>';
    }

    $html .= '</ul></nav>';
    return $html;
}

// Logging Helper

function log_error(string $message, array $context = []): void {
    $timestamp = date('Y-m-d H:i:s');
    $logFile = __DIR__ . '/../storage/logs/error.log';

    if (!is_dir(dirname($logFile))) {
        mkdir(dirname($logFile), 0755, true);
    }

    $logMessage = "[$timestamp] $message";
    if (!empty($context)) {
        $logMessage .= "\nContext: " . json_encode($context);
    }
    $logMessage .= "\n\n";

    error_log($logMessage, 3, $logFile);
}

function log_action(string $action, string $entity, int $entityId, string $userId = ''): void {
    $timestamp = date('Y-m-d H:i:s');
    $logFile = __DIR__ . '/../storage/logs/activity.log';

    if (!is_dir(dirname($logFile))) {
        mkdir(dirname($logFile), 0755, true);
    }

    $logMessage = "[$timestamp] [$userId] $action $entity #$entityId\n";
    error_log($logMessage, 3, $logFile);
}

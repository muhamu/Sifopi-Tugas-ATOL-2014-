#!/usr/bin/env php
<?php
/**
 * SIFOPI Development Server Starter
 * Runs built-in PHP development server on port 8000
 *
 * Usage: php start.php
 */

$host = 'localhost';
$port = 8000;
$docroot = __DIR__ . '/public';

// Check if port is available
$socket = @fsockopen($host, $port, $errno, $errstr, 1);
if ($socket) {
    fclose($socket);
    echo "❌ Error: Port $port is already in use.\n";
    echo "Try: php -S {$host}:8001 -t public\n";
    exit(1);
}

echo "\n";
echo "═══════════════════════════════════════════════════════════════\n";
echo "  🎓 SIFOPI - Sistem Informasi Akademik SMK PI\n";
echo "═══════════════════════════════════════════════════════════════\n";
echo "\n";
echo "🚀 Starting development server...\n";
echo "   Address:  http://{$host}:{$port}\n";
echo "   Document: {$docroot}\n";
echo "\n";
echo "📝 Login with:\n";
echo "   Admin:    admin / password\n";
echo "   Teacher:  guru_budi / password\n";
echo "   Student:  siswa_001 / password\n";
echo "   Staff:    tata_usaha / password\n";
echo "\n";
echo "Press Ctrl+C to stop the server\n";
echo "═══════════════════════════════════════════════════════════════\n\n";

// Start the development server
// Router script needed so all URLs route through index.php
$php_executable = PHP_BINARY;
$router = $docroot . '/index.php';
$cmd = "\"{$php_executable}\" -S {$host}:{$port} -t \"{$docroot}\" \"{$router}\"";

passthru($cmd);

@echo off
REM SIFOPI Development Server Launcher for Windows
REM This script finds PHP and starts the development server

echo.
echo ═════════════════════════════════════════════════════════════════
echo   🎓 SIFOPI - Sistem Informasi Akademik SMK PI
echo ═════════════════════════════════════════════════════════════════
echo.

REM Check if PHP is in PATH
php --version >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo ✓ PHP found in PATH
    php start.php
    exit /b
)

REM Check common installation locations
setlocal enabledelayedexpansion

set "PHP_PATHS=C:\php C:\php8.2 C:\php8.1 C:\Program Files\php C:\xampp\php"

for %%P in (%PHP_PATHS%) do (
    if exist "%%P\php.exe" (
        echo ✓ PHP found at: %%P
        "%%P\php" start.php
        exit /b
    )
)

REM PHP not found
echo.
echo ✗ PHP not found!
echo.
echo Please download and install PHP:
echo   📥 https://www.php.net/downloads.php
echo.
echo Or extract to: C:\php
echo.
echo See SETUP_PHP_WINDOWS.md for detailed instructions.
echo.
pause
exit /b 1

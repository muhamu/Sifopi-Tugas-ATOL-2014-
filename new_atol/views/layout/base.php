<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= safe($pageTitle ?? SCHOOL_NAME) ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/theme.css">
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.ico">

    <!-- Meta Tags -->
    <meta name="theme-color" content="<?= COLOR_PRIMARY ?>">
    <meta name="description" content="SIFOPI - Sistem Informasi Akademik SMK PI">
    <meta name="author" content="SMK PI">

    <!-- Security Headers -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; img-src 'self' data:;">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <h1 class="navbar-title">SMK PI</h1>
            </div>
            <div class="navbar-menu">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="navbar-user">
                        <span class="user-role"><?= safe(USER_ROLES[$_SESSION['user']['role']] ?? $_SESSION['user']['role']) ?></span>
                        <span class="user-name"><?= safe($_SESSION['user']['fullname']) ?></span>
                        <a href="/logout" class="btn-logout">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <?php if (isset($_SESSION['user'])): ?>
            <!-- Sidebar Navigation -->
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <ul>
                        <li><a href="/dashboard" class="nav-link <?= $activePage === 'dashboard' ? 'active' : '' ?>">Dashboard</a></li>

                        <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'GURU', 'TATA_USAHA'])): ?>
                            <li class="nav-section">Data Akademik</li>
                            <li><a href="/siswa" class="nav-link <?= $activePage === 'siswa' ? 'active' : '' ?>">Siswa</a></li>
                            <li><a href="/guru" class="nav-link <?= $activePage === 'guru' ? 'active' : '' ?>">Guru</a></li>
                            <li><a href="/kelas" class="nav-link <?= $activePage === 'kelas' ? 'active' : '' ?>">Kelas</a></li>
                            <li><a href="/mapel" class="nav-link <?= $activePage === 'mapel' ? 'active' : '' ?>">Mata Pelajaran</a></li>
                        <?php endif; ?>

                        <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'GURU', 'SISWA'])): ?>
                            <li class="nav-section">Akademik</li>
                            <li><a href="/nilai" class="nav-link <?= $activePage === 'nilai' ? 'active' : '' ?>">Nilai</a></li>
                            <li><a href="/absen" class="nav-link <?= $activePage === 'absen' ? 'active' : '' ?>">Absensi</a></li>
                            <li><a href="/jadwal" class="nav-link <?= $activePage === 'jadwal' ? 'active' : '' ?>">Jadwal</a></li>
                        <?php endif; ?>

                        <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                            <li class="nav-section">Keuangan</li>
                            <li><a href="/iuran" class="nav-link <?= $activePage === 'iuran' ? 'active' : '' ?>">SPP/Iuran</a></li>
                            <li><a href="/pembayaran-lain" class="nav-link">Pembayaran Lain</a></li>
                        <?php endif; ?>

                        <li class="nav-section">Lainnya</li>
                        <li><a href="/profile" class="nav-link <?= $activePage === 'profile' ? 'active' : '' ?>">Profile</a></li>
                    </ul>
                </nav>
            </aside>
        <?php endif; ?>

        <!-- Main Content -->
        <main class="content <?= !isset($_SESSION['user']) ? 'full-width' : '' ?>">
            <!-- Flash Messages -->
            <?php
            $flash = getFlash();
            if ($flash):
            ?>
                <div class="alert alert-<?= safe($flash['type']) ?>">
                    <p><?= safe($flash['message']) ?></p>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <?php echo $pageContent ?? ''; ?>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <?= date('Y') ?> <?= safe(SCHOOL_NAME) ?> - SIFOPI v2.0</p>
            <p class="footer-address">
                <?= safe(SCHOOL_ADDRESS) ?> | <?= safe(SCHOOL_PHONE) ?>
            </p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/form.js"></script>
    <script src="/assets/js/modal.js"></script>
    <script src="/assets/js/table.js"></script>
    <script src="/assets/js/auth.js"></script>

    <?php if (!isAjax()): ?>
        <script>
            // Initialize page
            document.addEventListener('DOMContentLoaded', function() {
                // Setup CSRF token for fetch requests
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (csrfToken) {
                    window.csrfToken = csrfToken;
                }
            });
        </script>
    <?php endif; ?>
</body>
</html>

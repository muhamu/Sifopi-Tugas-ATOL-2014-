<?php 
$pageTitle = 'Profile'; 
$activePage = 'profile'; 
$db = Database::getInstance();
$user_id = $_SESSION['user']['id'];
$user = $db->query("SELECT * FROM user WHERE id = ?", [$user_id])->fetch();

// Generate Placeholder Initials
$names = explode(' ', trim($user['fullname']));
$initials = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));

// SVG Placeholder encoding
$svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect width="100" height="100" fill="#1a73e8"/><text x="50" y="50" fill="white" font-family="Arial, sans-serif" font-size="40" font-weight="bold" text-anchor="middle" alignment-baseline="central" dominant-baseline="central">' . $initials . '</text></svg>';
$placeholderUrl = 'data:image/svg+xml;base64,' . base64_encode($svg);

// Determine Photo URL
$photoUrl = !empty($user['photo']) ? safe($user['photo']) : $placeholderUrl;

// A Facebook-style default cover photo
$coverUrl = "https://images.unsplash.com/photo-1579546929518-9e396f3cc809?auto=format&fit=crop&w=1200&q=80";
?>

<style>
.profile-container {
    max-width: 1000px;
    margin: 0 auto;
    font-family: inherit;
    padding-bottom: 40px;
}
.profile-cover {
    height: 350px;
    background: #1a73e8 url('<?= $coverUrl ?>') center/cover no-repeat;
    border-radius: 12px 12px 0 0;
    position: relative;
}
.profile-header {
    background: white;
    padding: 0 32px 24px;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    margin-bottom: 24px;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.profile-picture-wrapper {
    margin-top: -100px;
    margin-bottom: 16px;
    position: relative;
}
.profile-picture {
    width: 168px;
    height: 168px;
    border-radius: 50%;
    border: 4px solid white;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    object-fit: cover;
}
.profile-name {
    font-size: 2rem;
    font-weight: 700;
    color: #1c1e21;
    margin: 0 0 4px 0;
}
.profile-role {
    font-size: 1rem;
    color: #65676b;
    margin-bottom: 20px;
}
.profile-nav {
    display: flex;
    gap: 8px;
    border-top: 1px solid #e4e6eb;
    width: 100%;
    justify-content: center;
    padding-top: 16px;
}
.profile-nav-item {
    font-weight: 600;
    color: #1a73e8;
    padding: 10px 16px;
    border-radius: 6px;
    background: #e8f0fe;
    text-decoration: none;
    transition: background 0.2s;
}
.profile-nav-item:hover {
    background: #d4e3fc;
}
.profile-nav-item.secondary {
    background: #f0f2f5;
    color: #050505;
}
.profile-nav-item.secondary:hover {
    background: #e4e6eb;
}
.profile-grid {
    display: grid;
    grid-template-columns: 360px 1fr;
    gap: 16px;
}
@media (max-width: 768px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }
    .profile-cover {
        height: 200px;
    }
    .profile-picture {
        width: 140px;
        height: 140px;
        margin-top: -70px;
    }
}
.profile-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 16px;
}
.profile-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #050505;
    margin-bottom: 16px;
}
.info-row {
    display: flex;
    margin-bottom: 16px;
    font-size: 0.95rem;
    align-items: flex-start;
}
.info-row:last-child {
    margin-bottom: 0;
}
.info-icon {
    width: 24px;
    color: #8c939d;
    margin-right: 12px;
    font-size: 1.25rem;
    display: flex;
    justify-content: center;
    margin-top: -2px;
}
.info-text {
    color: #050505;
    line-height: 1.4;
}
.info-label {
    color: #65676b;
    font-size: 0.85rem;
    margin-top: 2px;
}
</style>

<div class="profile-container">
    <!-- Header Section -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); margin-bottom: 16px;">
        <div class="profile-cover"></div>
        <div class="profile-header">
            <div class="profile-picture-wrapper">
                <img src="<?= $photoUrl ?>" alt="Profile Picture" class="profile-picture">
            </div>
            <h1 class="profile-name"><?= safe($user['fullname']) ?></h1>
            <div class="profile-role">
                <span class="badge badge-primary" style="font-size: 0.9rem; padding: 6px 12px;">
                    <?= safe(USER_ROLES[$user['role']] ?? $user['role']) ?>
                </span>
            </div>
            
            <div class="profile-nav">
                <a href="#" class="profile-nav-item">Tentang</a>
                <a href="#" class="profile-nav-item secondary" onclick="alert('Fitur edit foto dalam pengembangan'); return false;">Edit Foto</a>
                <a href="/logout" class="profile-nav-item secondary">Keluar</a>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="profile-grid">
        <!-- Sidebar / Intro -->
        <div>
            <div class="profile-card">
                <h2 class="profile-card-title">Intro</h2>
                
                <div class="info-row">
                    <div class="info-icon">👤</div>
                    <div>
                        <div class="info-text"><strong><?= safe($user['username']) ?></strong></div>
                        <div class="info-label">Username Akun</div>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-icon">✉️</div>
                    <div>
                        <div class="info-text"><?= safe($user['email'] ?? 'Belum diisi') ?></div>
                        <div class="info-label">Alamat Email</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-icon">📱</div>
                    <div>
                        <div class="info-text"><?= safe($user['phone'] ?? 'Belum diisi') ?></div>
                        <div class="info-label">Nomor Telepon</div>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-icon">📍</div>
                    <div>
                        <div class="info-text"><?= safe($user['address'] ?? 'Belum ada informasi alamat') ?></div>
                        <div class="info-label">Alamat Tinggal</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div>
            <div class="profile-card">
                <h2 class="profile-card-title">Aktivitas & Keamanan</h2>
                <div class="info-row" style="align-items: center;">
                    <div class="info-icon" style="color: #1877f2; font-size: 1.5rem;">🕒</div>
                    <div>
                        <div class="info-text" style="font-weight: 600;">Sesi aktif saat ini</div>
                        <div class="info-label">Anda masuk sejak <?= date('d F Y, H:i', $_SESSION['user']['logged_in_at'] ?? time()) ?></div>
                    </div>
                </div>
                <div class="info-row" style="align-items: center; margin-top: 24px;">
                    <div class="info-icon" style="color: #34a853; font-size: 1.5rem;">🛡️</div>
                    <div>
                        <div class="info-text" style="font-weight: 600;">Status Akun</div>
                        <div class="info-label">Akun aktif dan terverifikasi oleh sistem</div>
                    </div>
                </div>
                <div class="info-row" style="align-items: center; margin-top: 24px;">
                    <div class="info-icon" style="color: #f59e0b; font-size: 1.5rem;">📅</div>
                    <div>
                        <div class="info-text" style="font-weight: 600;">Bergabung Sejak</div>
                        <div class="info-label"><?= date('d F Y', strtotime($user['created_at'])) ?></div>
                    </div>
                </div>
            </div>
            
            <!-- Tambahan panel untuk estetika timeline style -->
            <div class="profile-card" style="text-align: center; padding: 40px 20px;">
                <div style="font-size: 3rem; margin-bottom: 16px;">🎓</div>
                <h3 style="margin-bottom: 8px; font-size: 1.1rem;">Selamat Datang di SIFOPI</h3>
                <p style="color: #65676b; font-size: 0.95rem; max-width: 400px; margin: 0 auto;">
                    Sistem Informasi Akademik SMK PI memberikan kemudahan akses informasi pembelajaran dan akademik Anda di satu tempat.
                </p>
            </div>
        </div>
    </div>
</div>

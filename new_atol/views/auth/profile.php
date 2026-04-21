<?php $pageTitle = 'Profile'; $activePage = 'profile'; $user = $_SESSION['user']; ?>

<div class="page-header">
    <h1 class="page-title">Profile</h1>
    <p class="page-subtitle">Informasi akun Anda</p>
</div>

<div class="grid grid-2">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Akun</h3>
        </div>
        <div class="card-body">
            <div style="display: flex; flex-direction: column; gap: var(--spacing-md);">
                <div>
                    <div style="font-size: var(--font-size-sm); color: var(--color-gray-500); margin-bottom: 2px;">Username</div>
                    <div><strong><?= safe($user['username']) ?></strong></div>
                </div>
                <div>
                    <div style="font-size: var(--font-size-sm); color: var(--color-gray-500); margin-bottom: 2px;">Nama Lengkap</div>
                    <div><?= safe($user['fullname']) ?></div>
                </div>
                <div>
                    <div style="font-size: var(--font-size-sm); color: var(--color-gray-500); margin-bottom: 2px;">Email</div>
                    <div><?= safe($user['email'] ?? '-') ?></div>
                </div>
                <div>
                    <div style="font-size: var(--font-size-sm); color: var(--color-gray-500); margin-bottom: 2px;">Role</div>
                    <div>
                        <span class="badge badge-primary">
                            <?= safe(USER_ROLES[$user['role']] ?? $user['role']) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sesi Login</h3>
        </div>
        <div class="card-body">
            <div style="display: flex; flex-direction: column; gap: var(--spacing-md);">
                <div>
                    <div style="font-size: var(--font-size-sm); color: var(--color-gray-500); margin-bottom: 2px;">Login Sejak</div>
                    <div><?= date('d M Y H:i', $user['logged_in_at'] ?? time()) ?></div>
                </div>
                <div>
                    <div style="font-size: var(--font-size-sm); color: var(--color-gray-500); margin-bottom: 2px;">Status</div>
                    <div><span class="badge badge-success">Aktif</span></div>
                </div>
            </div>
            <div style="margin-top: var(--spacing-xl);">
                <a href="/logout" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </div>
</div>
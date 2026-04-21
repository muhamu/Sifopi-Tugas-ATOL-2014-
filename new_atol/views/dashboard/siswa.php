<?php $activePage = 'dashboard'; $pageTitle = 'Dashboard - Siswa'; ?>

<div class="page-header">
    <h1 class="page-title">Dashboard Siswa</h1>
    <p class="page-subtitle">Selamat datang, <?= safe($_SESSION['user']['fullname']) ?></p>
</div>

<div class="alert alert-info">
    <strong>ℹ️ Info:</strong> Lihat jadwal, nilai, dan status pembayaran Anda di menu di samping.
</div>

<div class="grid grid-2">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Akademik</h3>
        </div>
        <div class="card-body">
            <p><strong>Kelas:</strong> X TKJ A</p>
            <p><strong>Status:</strong> <span class="badge badge-success">Aktif</span></p>
            <p><strong>Nomor Induk:</strong> 2025001001</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nilai Rata-rata</h3>
        </div>
        <div class="card-body">
            <div style="text-align: center; padding: var(--spacing-lg) 0;">
                <div style="font-size: 48px; font-weight: bold; color: var(--color-primary);">8.5</div>
                <div style="color: var(--color-gray-600); margin-top: var(--spacing-md);">Sangat Baik</div>
            </div>
        </div>
    </div>
</div>

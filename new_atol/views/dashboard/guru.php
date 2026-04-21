<?php $activePage = 'dashboard'; $pageTitle = 'Dashboard - Guru'; ?>

<div class="page-header">
    <h1 class="page-title">Dashboard Guru</h1>
    <p class="page-subtitle">Selamat datang, <?= safe($_SESSION['user']['fullname']) ?></p>
</div>

<div class="grid grid-2">
    <div class="stat-card primary">
        <div class="stat-label">Kelas yang Diampu</div>
        <div class="stat-value">3</div>
    </div>

    <div class="stat-card secondary">
        <div class="stat-label">Jumlah Siswa</div>
        <div class="stat-value">120</div>
    </div>
</div>

<div class="card" style="margin-top: var(--spacing-xl);">
    <div class="card-header">
        <h3 class="card-title">Menu Guru</h3>
    </div>
    <div class="card-body">
        <a href="/nilai" class="list-item">
            <span class="list-item-primary">Input Nilai</span>
        </a>
        <a href="/absen" class="list-item">
            <span class="list-item-primary">Input Absensi</span>
        </a>
        <a href="/jadwal" class="list-item">
            <span class="list-item-primary">Lihat Jadwal</span>
        </a>
    </div>
</div>

<?php $activePage = 'dashboard'; $pageTitle = 'Dashboard - Tata Usaha'; ?>

<div class="page-header">
    <h1 class="page-title">Dashboard Tata Usaha</h1>
    <p class="page-subtitle">Manajemen Keuangan Sekolah</p>
</div>

<div class="grid grid-3">
    <div class="stat-card primary">
        <div class="stat-label">Total SPP Masuk</div>
        <div class="stat-value">Rp<?= number_format(25400000) ?></div>
    </div>

    <div class="stat-card success">
        <div class="stat-label">SPP Tertagih</div>
        <div class="stat-value">142/150</div>
    </div>

    <div class="stat-card warning">
        <div class="stat-label">Tunggakan</div>
        <div class="stat-value">8 siswa</div>
    </div>
</div>

<div class="card" style="margin-top: var(--spacing-xl);">
    <div class="card-header">
        <h3 class="card-title">Menu Keuangan</h3>
    </div>
    <div class="card-body">
        <a href="/iuran" class="list-item">
            <span class="list-item-primary">Kelola SPP</span>
        </a>
        <a href="/pembayaran-lain" class="list-item">
            <span class="list-item-primary">Pembayaran Lain</span>
        </a>
    </div>
</div>

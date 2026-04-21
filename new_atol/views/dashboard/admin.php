<?php $pageTitle = 'Dashboard'; $activePage = 'dashboard'; ?>

<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Selamat datang, <?= safe($_SESSION['user']['fullname']) ?></p>
</div>

<div class="grid grid-4">
    <div class="stat-card primary">
        <div class="stat-icon">🎓</div>
        <div class="stat-label">Siswa Aktif</div>
        <div class="stat-value"><?= $stats['total_siswa'] ?></div>
        <div class="stat-change"><a href="/siswa" style="color:inherit;">Lihat semua →</a></div>
    </div>
    <div class="stat-card secondary">
        <div class="stat-icon">👨‍🏫</div>
        <div class="stat-label">Guru Aktif</div>
        <div class="stat-value"><?= $stats['total_guru'] ?></div>
        <div class="stat-change"><a href="/guru" style="color:inherit;">Lihat semua →</a></div>
    </div>
    <div class="stat-card success">
        <div class="stat-icon">🏫</div>
        <div class="stat-label">Total Kelas</div>
        <div class="stat-value"><?= $stats['total_kelas'] ?></div>
        <div class="stat-change"><a href="/kelas" style="color:inherit;">Kelola kelas →</a></div>
    </div>
    <div class="stat-card warning">
        <div class="stat-icon">⚠️</div>
        <div class="stat-label">Tunggakan SPP</div>
        <div class="stat-value"><?= $stats['tunggakan'] ?></div>
        <div class="stat-change negative"><a href="/iuran?status=BELUM_LUNAS" style="color:inherit;">Tagihan belum lunas →</a></div>
    </div>
</div>

<div class="grid grid-2" style="margin-top: var(--spacing-xl);">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Menu Cepat</h3></div>
        <div class="card-body">
            <a href="/siswa/create" class="list-item"><span class="list-item-primary">+ Tambah Siswa Baru</span><span>→</span></a>
            <a href="/guru/create" class="list-item"><span class="list-item-primary">+ Tambah Guru Baru</span><span>→</span></a>
            <a href="/nilai/create" class="list-item"><span class="list-item-primary">+ Input Nilai</span><span>→</span></a>
            <a href="/absen/create" class="list-item"><span class="list-item-primary">+ Input Absensi</span><span>→</span></a>
            <a href="/iuran/create" class="list-item"><span class="list-item-primary">+ Tambah Tagihan SPP</span><span>→</span></a>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h3 class="card-title">Informasi Sistem</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:12px;">
            <div><span style="color:var(--color-gray-500);font-size:13px;">Sekolah</span><br><?= safe(SCHOOL_NAME) ?></div>
            <div><span style="color:var(--color-gray-500);font-size:13px;">Tahun Ajaran</span><br>2025/2026</div>
            <div><span style="color:var(--color-gray-500);font-size:13px;">Status Sistem</span><br><span class="badge badge-success">Aktif</span></div>
        </div>
    </div>
</div>

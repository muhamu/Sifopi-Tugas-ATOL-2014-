<?php $pageTitle = 'Dashboard'; $activePage = 'dashboard'; ?>

<div class="g1-dashboard">
    
    <!-- Hero Section ala Google One -->
    <div class="g1-hero">
        <h1 class="g1-title">Selamat datang, <?= safe($_SESSION['user']['fullname']) ?></h1>
        <p class="g1-subtitle">Kelola dan pantau seluruh aktivitas akademik di satu tempat yang aman.</p>

        <div class="g1-meter-container">
            <div class="g1-meter-labels">
                <span><?= $stats['total_siswa'] ?? '0' ?> Siswa Aktif terdaftar</span>
                <span>Kapasitas 2000</span>
            </div>
            <!-- Progress bar meniru meteran Google One -->
            <div class="g1-progress-track">
                <!-- Visualisasi porsi (misal porsi normal vs mutasi/baru, di-hardcode persentase visualnya) -->
                <div class="g1-progress-fill-1" style="width: <?= min((($stats['total_siswa'] ?? 0) / 2000) * 100, 100) ?>%;"></div>
            </div>
            
            <div class="g1-legend">
                <div class="g1-legend-item"><div class="g1-dot blue"></div>Siswa Reguler</div>
                <div class="g1-legend-item"><div class="g1-dot gray"></div>Kapasitas Tersedia</div>
            </div>
        </div>

        <div class="g1-actions">
            <a href="/siswa/create" class="g1-btn g1-btn-primary">Tambah Siswa</a>
            <a href="/siswa" class="g1-btn g1-btn-outline">Lihat Detail Ruang</a>
        </div>
    </div>

    <!-- Grid "Benefits" ala Google One -->
    <div class="g1-grid">
        <a href="/guru" class="g1-card">
            <div class="g1-card-icon g1-bg-green">👨‍🏫</div>
            <h2 class="g1-card-title">Guru & Staf Aktif</h2>
            <div class="g1-card-value"><?= $stats['total_guru'] ?? '0' ?></div>
            <p class="g1-card-desc">Kelola data tenaga pengajar, mutasi, dan pembagian wali kelas.</p>
            <span class="g1-card-link">Kelola Guru &rarr;</span>
        </a>

        <a href="/kelas" class="g1-card">
            <div class="g1-card-icon g1-bg-yellow">🏫</div>
            <h2 class="g1-card-title">Rombongan Belajar</h2>
            <div class="g1-card-value"><?= $stats['total_kelas'] ?? '0' ?></div>
            <p class="g1-card-desc">Pengaturan pembagian kelas, jadwal mata pelajaran, dan wali kelas.</p>
            <span class="g1-card-link">Lihat Daftar Kelas &rarr;</span>
        </a>

        <a href="/iuran?status=BELUM_LUNAS" class="g1-card">
            <div class="g1-card-icon g1-bg-red">⚠️</div>
            <h2 class="g1-card-title">Tunggakan SPP</h2>
            <div class="g1-card-value"><?= $stats['tunggakan'] ?? '0' ?></div>
            <p class="g1-card-desc">Rekapitulasi tagihan Iuran/SPP siswa yang masih berstatus tertunda.</p>
            <span class="g1-card-link">Cek Keuangan &rarr;</span>
        </a>
    </div>
</div>

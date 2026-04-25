<?php $pageTitle = 'Input Absensi'; $activePage = 'absen'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Input Absensi Harian</h1>
        <p class="g-form-subtitle">Catat kehadiran siswa untuk mata pelajaran pada hari tertentu.</p>
    </div>

    <form action="/absen/store" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group full-width">
                <select id="siswa_id" name="siswa_id" class="g-input" data-validate="required" required>
                    <option value="" disabled selected></option>
                    <?php foreach ($siswa_list ?? [] as $siswa): ?>
                        <option value="<?= $siswa['id'] ?>"><?= safe($siswa['nama']) ?> (NIS: <?= safe($siswa['no_induk']) ?>)</option>
                    <?php endforeach; ?>
                </select>
                <label for="siswa_id" class="g-label">Pilih Siswa</label>
            </div>

            <div class="g-form-group full-width">
                <select id="pelajaran_kelas_id" name="pelajaran_kelas_id" class="g-input" data-validate="required" required>
                    <option value="" disabled selected></option>
                    <?php foreach ($pk_list ?? [] as $pk): ?>
                        <option value="<?= $pk['id'] ?>"><?= safe($pk['mata_pelajaran']) ?> - Kelas <?= safe($pk['nama_kelas']) ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="pelajaran_kelas_id" class="g-label">Mata Pelajaran & Kelas</label>
            </div>

            <div class="g-form-group">
                <input type="date" id="tanggal" name="tanggal" class="g-input" placeholder=" " value="<?= date('Y-m-d') ?>" data-validate="required" required>
                <label for="tanggal" class="g-label">Tanggal Absensi</label>
            </div>

            <div class="g-form-group">
                <select id="status" name="status" class="g-input" required>
                    <option value="HADIR" selected>Hadir</option>
                    <option value="SAKIT">Sakit</option>
                    <option value="IZIN">Izin</option>
                    <option value="ALPHA">Alpa</option>
                </select>
                <label for="status" class="g-label">Status Kehadiran</label>
            </div>
            
            <div class="g-form-group full-width">
                <input type="text" id="keterangan" name="keterangan" class="g-input" placeholder=" ">
                <label for="keterangan" class="g-label">Keterangan / Alasan (Opsional)</label>
            </div>
        </div>
        <div class="g-form-actions">
            <a href="/absen" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Absensi</button>
        </div>
    </form>
</div>
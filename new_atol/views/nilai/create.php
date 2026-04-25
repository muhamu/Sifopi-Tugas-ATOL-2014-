<?php $pageTitle = 'Input Nilai Siswa'; $activePage = 'nilai'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Input Nilai Akademik</h1>
        <p class="g-form-subtitle">Masukkan nilai Tugas, UTS, dan UAS siswa untuk mata pelajaran tertentu.</p>
    </div>

    <form action="/nilai/store" method="POST">
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
                <select id="tahun_ajaran_id" name="tahun_ajaran_id" class="g-input" required>
                    <?php foreach ($tahun_list ?? [] as $tahun): ?>
                        <option value="<?= $tahun['id'] ?>"><?= safe($tahun['tahun']) ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="tahun_ajaran_id" class="g-label">Tahun Ajaran</label>
            </div>

            <div class="g-form-group">
                <select id="semester" name="semester" class="g-input" required>
                    <option value="1">Ganjil (1)</option>
                    <option value="2">Genap (2)</option>
                </select>
                <label for="semester" class="g-label">Semester</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="tugas" name="tugas" class="g-input" placeholder=" " value="0" min="0" max="100" data-validate="required,number">
                <label for="tugas" class="g-label">Nilai Tugas</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="uts" name="uts" class="g-input" placeholder=" " value="0" min="0" max="100" data-validate="required,number">
                <label for="uts" class="g-label">Nilai UTS</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="uas" name="uas" class="g-input" placeholder=" " value="0" min="0" max="100" data-validate="required,number">
                <label for="uas" class="g-label">Nilai UAS</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/nilai" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Nilai</button>
        </div>
    </form>
</div>
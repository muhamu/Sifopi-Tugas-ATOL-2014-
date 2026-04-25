<?php $pageTitle = 'Edit Nilai Siswa'; $activePage = 'nilai'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Perbarui Nilai Akademik</h1>
        <p class="g-form-subtitle">Edit nilai Tugas, UTS, atau UAS yang sudah diinput sebelumnya.</p>
    </div>

    <form action="/nilai/update?id=<?= $nilai['id'] ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group full-width">
                <select class="g-input" disabled>
                    <?php foreach ($siswa_list ?? [] as $siswa): ?>
                        <option value="<?= $siswa['id'] ?>" <?= ($siswa['id'] == $nilai['siswa_id']) ? 'selected' : '' ?>><?= safe($siswa['nama']) ?> (NIS: <?= safe($siswa['no_induk']) ?>)</option>
                    <?php endforeach; ?>
                </select>
                <label class="g-label">Siswa Terpilih</label>
            </div>

            <div class="g-form-group full-width">
                <select class="g-input" disabled>
                    <?php foreach ($pk_list ?? [] as $pk): ?>
                        <option value="<?= $pk['id'] ?>" <?= ($pk['id'] == $nilai['pelajaran_kelas_id']) ? 'selected' : '' ?>><?= safe($pk['mata_pelajaran']) ?> - Kelas <?= safe($pk['nama_kelas']) ?></option>
                    <?php endforeach; ?>
                </select>
                <label class="g-label">Mata Pelajaran & Kelas</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="tugas" name="tugas" class="g-input" placeholder=" " value="<?= safe($nilai['tugas'] ?? '0') ?>" min="0" max="100" data-validate="required,number">
                <label for="tugas" class="g-label">Nilai Tugas</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="uts" name="uts" class="g-input" placeholder=" " value="<?= safe($nilai['uts'] ?? '0') ?>" min="0" max="100" data-validate="required,number">
                <label for="uts" class="g-label">Nilai UTS</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="uas" name="uas" class="g-input" placeholder=" " value="<?= safe($nilai['uas'] ?? '0') ?>" min="0" max="100" data-validate="required,number">
                <label for="uas" class="g-label">Nilai UAS</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/nilai" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
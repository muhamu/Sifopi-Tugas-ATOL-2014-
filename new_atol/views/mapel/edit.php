<?php $pageTitle = 'Edit Mata Pelajaran'; $activePage = 'mapel'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Perbarui Mata Pelajaran</h1>
        <p class="g-form-subtitle">Edit informasi akademik mata pelajaran <strong><?= safe($mapel['mata_pelajaran'] ?? '') ?></strong>.</p>
    </div>

    <form action="/mapel/update?id=<?= $mapel['id'] ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <input type="text" id="kode_mapel" name="kode_mapel" class="g-input" placeholder=" " value="<?= safe($mapel['kode_mapel'] ?? '') ?>" data-validate="required">
                <label for="kode_mapel" class="g-label">Kode Mapel</label>
            </div>
            
            <div class="g-form-group">
                <input type="number" id="kkm" name="kkm" class="g-input" placeholder=" " value="<?= safe($mapel['kkm'] ?? '75') ?>" data-validate="required,number">
                <label for="kkm" class="g-label">Nilai KKM Minimum</label>
            </div>

            <div class="g-form-group full-width">
                <input type="text" id="mata_pelajaran" name="mata_pelajaran" class="g-input" placeholder=" " value="<?= safe($mapel['mata_pelajaran'] ?? '') ?>" data-validate="required">
                <label for="mata_pelajaran" class="g-label">Nama Mata Pelajaran</label>
            </div>
            
            <div class="g-form-group full-width">
                <input type="text" id="kelompok" name="kelompok" class="g-input" placeholder=" " value="<?= safe($mapel['kelompok'] ?? 'Umum') ?>">
                <label for="kelompok" class="g-label">Kelompok (cth: Muatan Nasional)</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/mapel" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
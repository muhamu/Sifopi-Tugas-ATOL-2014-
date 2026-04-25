<?php $pageTitle = 'Tambah Mata Pelajaran'; $activePage = 'mapel'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Mata Pelajaran Baru</h1>
        <p class="g-form-subtitle">Tambahkan mata pelajaran akademik ke dalam kurikulum.</p>
    </div>

    <form action="/mapel/store" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <input type="text" id="kode_mapel" name="kode_mapel" class="g-input" placeholder=" " data-validate="required">
                <label for="kode_mapel" class="g-label">Kode Mapel (cth: MTK, BING)</label>
            </div>
            
            <div class="g-form-group">
                <input type="number" id="kkm" name="kkm" class="g-input" placeholder=" " value="75" data-validate="required,number">
                <label for="kkm" class="g-label">Nilai KKM Minimum</label>
            </div>

            <div class="g-form-group full-width">
                <input type="text" id="mata_pelajaran" name="mata_pelajaran" class="g-input" placeholder=" " data-validate="required">
                <label for="mata_pelajaran" class="g-label">Nama Mata Pelajaran</label>
            </div>
            
            <div class="g-form-group full-width">
                <input type="text" id="kelompok" name="kelompok" class="g-input" placeholder=" " value="Umum">
                <label for="kelompok" class="g-label">Kelompok (cth: Muatan Nasional, Produktif)</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/mapel" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Mapel</button>
        </div>
    </form>
</div>
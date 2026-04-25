<?php $pageTitle = 'Buat Kategori Pembayaran'; $activePage = 'pembayaran-lain'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Kategori Pembayaran Baru</h1>
        <p class="g-form-subtitle">Buat master data baru untuk kategori pembayaran di luar SPP sekolah.</p>
    </div>

    <form action="/pembayaran-lain/store" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <input type="text" id="nama_pembayaran" name="nama_pembayaran" class="g-input" placeholder=" " data-validate="required">
                <label for="nama_pembayaran" class="g-label">Nama Pembayaran (cth: Seragam)</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="nominal" name="nominal" class="g-input" placeholder=" " data-validate="required,number">
                <label for="nominal" class="g-label">Nominal Tarif (Rp)</label>
            </div>

            <div class="g-form-group">
                <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" class="g-input" placeholder=" " required>
                <label for="tanggal_berakhir" class="g-label">Tenggat Waktu Pelunasan</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="denda_per_hari" name="denda_per_hari" class="g-input" placeholder=" " data-validate="number">
                <label for="denda_per_hari" class="g-label">Denda / Hari (Rp)</label>
            </div>

            <div class="g-form-group full-width">
                <textarea id="deskripsi" name="deskripsi" class="g-input" placeholder=" " style="height: 80px;"></textarea>
                <label for="deskripsi" class="g-label">Deskripsi / Rincian Singkat</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/pembayaran-lain" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Master Data</button>
        </div>
    </form>
</div>
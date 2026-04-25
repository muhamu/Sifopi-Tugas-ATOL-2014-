<?php $pageTitle = 'Edit Tagihan Lain'; $activePage = 'pembayaran-lain'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Edit Kategori Pembayaran</h1>
        <p class="g-form-subtitle">Perbarui nominal, rincian, atau aturan denda untuk <strong><?= safe($tagihan['nama_pembayaran']) ?></strong>.</p>
    </div>

    <form action="/pembayaran-lain/update?id=<?= $tagihan['id'] ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <input type="text" id="nama_pembayaran" name="nama_pembayaran" class="g-input" placeholder=" " value="<?= safe($tagihan['nama_pembayaran'] ?? '') ?>" data-validate="required">
                <label for="nama_pembayaran" class="g-label">Nama Pembayaran</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="nominal" name="nominal" class="g-input" placeholder=" " value="<?= safe($tagihan['nominal'] ?? '') ?>" data-validate="required,number">
                <label for="nominal" class="g-label">Nominal Tarif (Rp)</label>
            </div>

            <div class="g-form-group">
                <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" class="g-input" placeholder=" " value="<?= safe($tagihan['tanggal_berakhir'] ?? '') ?>" required>
                <label for="tanggal_berakhir" class="g-label">Tenggat Waktu Pelunasan</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="denda_per_hari" name="denda_per_hari" class="g-input" placeholder=" " value="<?= safe($tagihan['denda_per_hari'] ?? 0) ?>" data-validate="number">
                <label for="denda_per_hari" class="g-label">Denda / Hari (Rp)</label>
            </div>

            <div class="g-form-group full-width">
                <textarea id="deskripsi" name="deskripsi" class="g-input" placeholder=" " style="height: 80px;"><?= safe($tagihan['deskripsi'] ?? '') ?></textarea>
                <label for="deskripsi" class="g-label">Deskripsi / Rincian Singkat</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/pembayaran-lain" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
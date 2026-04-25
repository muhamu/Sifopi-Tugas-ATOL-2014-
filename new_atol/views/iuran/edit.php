<?php $pageTitle = 'Edit Tagihan SPP'; $activePage = 'iuran'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Perbarui Tagihan SPP</h1>
        <p class="g-form-subtitle">Edit nominal atau ubah status tagihan SPP untuk siswa ini.</p>
    </div>

    <form action="/iuran/update?id=<?= $spp['id'] ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group full-width">
                <input type="text" class="g-input" placeholder=" " value="Periode Tagihan: Bulan <?= safe($spp['bulan']) ?> / Tahun <?= safe($spp['tahun']) ?>" disabled>
                <label class="g-label">Info Tagihan</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="nominal" name="nominal" class="g-input" placeholder=" " value="<?= safe($spp['nominal'] ?? '') ?>" data-validate="required,number">
                <label for="nominal" class="g-label">Nominal Tagihan (Rp)</label>
            </div>

            <div class="g-form-group">
                <select id="status" name="status" class="g-input" required>
                    <option value="BELUM_LUNAS" <?= ($spp['status'] ?? '') === 'BELUM_LUNAS' ? 'selected' : '' ?>>Belum Lunas</option>
                    <option value="LUNAS" <?= ($spp['status'] ?? '') === 'LUNAS' ? 'selected' : '' ?>>Lunas</option>
                </select>
                <label for="status" class="g-label">Status Pembayaran</label>
            </div>

            <div class="g-form-group full-width">
                <input type="text" id="catatan" name="catatan" class="g-input" placeholder=" " value="<?= safe($spp['catatan'] ?? '') ?>">
                <label for="catatan" class="g-label">Catatan Tambahan (Opsional)</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/iuran" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
<?php $pageTitle = 'Terima Pembayaran SPP'; $activePage = 'iuran'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Konfirmasi Pembayaran</h1>
        <p class="g-form-subtitle">Terima pembayaran SPP/Iuran dari <strong class="text-primary"><?= safe($spp['siswa_nama']) ?></strong> untuk periode bulan <strong><?= safe($spp['bulan']) ?> / <?= safe($spp['tahun']) ?></strong>.</p>
    </div>

    <form action="/iuran/process?id=<?= $spp['id'] ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <input type="text" class="g-input" placeholder=" " value="Rp <?= number_format($spp['nominal'], 0, ',', '.') ?>" style="background: #f8f9fa; font-weight: bold; color: #1a73e8;" disabled>
                <label class="g-label">Total Tagihan Yang Harus Dibayar</label>
            </div>

            <div class="g-form-group">
                <select id="metode_bayar" name="metode_bayar" class="g-input" required>
                    <option value="TUNAI" selected>Uang Tunai (Cash)</option>
                    <option value="TRANSFER">Transfer Bank / E-Wallet</option>
                </select>
                <label for="metode_bayar" class="g-label">Metode Pembayaran</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/iuran" class="g1-btn g1-btn-outline">Kembali</a>
            <button type="submit" class="g1-btn g1-btn-primary">Konfirmasi & Tandai Lunas</button>
        </div>
    </form>
</div>
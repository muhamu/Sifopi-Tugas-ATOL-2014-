<?php $pageTitle = 'Buat Tagihan SPP'; $activePage = 'iuran'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Terbitkan Tagihan SPP</h1>
        <p class="g-form-subtitle">Buat tagihan SPP bulanan baru untuk siswa yang terdaftar.</p>
    </div>

    <form action="/iuran/store" method="POST">
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

            <div class="g-form-group">
                <select id="bulan" name="bulan" class="g-input" required>
                    <option value="" disabled selected></option>
                    <?php for($i=1; $i<=12; $i++): ?>
                        <option value="<?= $i ?>"><?= date('F', mktime(0, 0, 0, $i, 10)) ?></option>
                    <?php endfor; ?>
                </select>
                <label for="bulan" class="g-label">Periode Bulan</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="tahun" name="tahun" class="g-input" placeholder=" " value="<?= date('Y') ?>" data-validate="required,number">
                <label for="tahun" class="g-label">Tahun</label>
            </div>

            <div class="g-form-group">
                <input type="number" id="nominal" name="nominal" class="g-input" placeholder=" " data-validate="required,number">
                <label for="nominal" class="g-label">Nominal Tagihan (Rp)</label>
            </div>

            <div class="g-form-group">
                <select id="status" name="status" class="g-input" required>
                    <option value="BELUM_LUNAS" selected>Belum Lunas</option>
                    <option value="LUNAS">Lunas</option>
                </select>
                <label for="status" class="g-label">Status Pembayaran</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/iuran" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Terbitkan Tagihan</button>
        </div>
    </form>
</div>
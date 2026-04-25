<?php $pageTitle = 'Edit Kelas'; $activePage = 'kelas'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Edit Rombongan Belajar</h1>
        <p class="g-form-subtitle">Perbarui informasi kelas <strong><?= safe($kelas['nama_kelas']) ?></strong>.</p>
    </div>

    <form action="/kelas/update?id=<?= $kelas['id'] ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <input type="text" id="nama_kelas" name="nama_kelas" class="g-input" placeholder=" " value="<?= safe($kelas['nama_kelas'] ?? '') ?>" data-validate="required">
                <label for="nama_kelas" class="g-label">Nama Kelas (cth: RPL 1)</label>
            </div>
            
            <div class="g-form-group">
                <input type="text" id="no_ruangan" name="no_ruangan" class="g-input" placeholder=" " value="<?= safe($kelas['no_ruangan'] ?? '') ?>">
                <label for="no_ruangan" class="g-label">No. Ruangan (Opsional)</label>
            </div>

            <div class="g-form-group full-width">
                <select id="id_guru_wali" name="id_guru_wali" class="g-input" required>
                    <option value="" disabled></option>
                    <?php foreach ($guru_list ?? [] as $guru): ?>
                        <option value="<?= $guru['id'] ?>" <?= ($guru['id'] == $kelas['id_guru_wali']) ? 'selected' : '' ?>><?= safe($guru['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_guru_wali" class="g-label">Pilih Wali Kelas</label>
            </div>

            <div class="g-form-group full-width">
                <input type="number" id="capacity" name="capacity" class="g-input" placeholder=" " value="<?= safe($kelas['capacity'] ?? '40') ?>" data-validate="required,number">
                <label for="capacity" class="g-label">Kapasitas Maksimal Siswa</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/kelas" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
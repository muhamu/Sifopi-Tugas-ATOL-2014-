<?php $pageTitle = 'Edit Data Guru'; $activePage = 'guru'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Perbarui Profil Guru</h1>
        <p class="g-form-subtitle">Edit informasi data pribadi dan kontak untuk <strong><?= safe($guru['nama']) ?></strong>.</p>
    </div>

    <form action="/guru/update?id=<?= $guru['id'] ?>" method="POST" id="form-edit-guru">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <input type="text" id="nip" name="nip" class="g-input" placeholder=" " value="<?= safe($guru['nip'] ?? '') ?>" data-validate="required,number">
                <label for="nip" class="g-label">NIP / NIK</label>
            </div>

            <div class="g-form-group">
                <input type="text" id="nama" name="nama" class="g-input" placeholder=" " value="<?= safe($guru['nama'] ?? '') ?>" data-validate="required">
                <label for="nama" class="g-label">Nama Lengkap (beserta gelar)</label>
            </div>

            <div class="g-form-group">
                <select id="jenis_kelamin" name="jenis_kelamin" class="g-input" data-validate="required" required>
                    <option value="" disabled></option>
                    <option value="L" <?= ($guru['jenis_kelamin'] ?? '') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= ($guru['jenis_kelamin'] ?? '') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
                <label for="jenis_kelamin" class="g-label">Jenis Kelamin</label>
            </div>

            <div class="g-form-group">
                <input type="tel" id="no_telepon" name="no_telepon" class="g-input" placeholder=" " value="<?= safe($guru['no_telepon'] ?? '') ?>" data-validate="phone">
                <label for="no_telepon" class="g-label">Nomor Telepon / WhatsApp</label>
            </div>

            <div class="g-form-group full-width">
                <input type="email" id="email" name="email" class="g-input" placeholder=" " value="<?= safe($guru['email'] ?? '') ?>" data-validate="email">
                <label for="email" class="g-label">Alamat Email (Opsional)</label>
            </div>

            <div class="g-form-group full-width">
                <input type="text" id="bidang_studi" name="bidang_studi" class="g-input" placeholder=" " value="<?= safe($guru['bidang_studi'] ?? '') ?>">
                <label for="bidang_studi" class="g-label">Bidang Studi / Keahlian Utama</label>
            </div>

            <div class="g-form-group full-width">
                <textarea id="alamat" name="alamat" class="g-input" placeholder=" " style="height: 80px;"><?= safe($guru['alamat'] ?? '') ?></textarea>
                <label for="alamat" class="g-label">Alamat Rumah</label>
            </div>

            <div class="g-form-group full-width">
                <select id="status" name="status" class="g-input" required>
                    <option value="AKTIF" <?= ($guru['status'] ?? '') === 'AKTIF' ? 'selected' : '' ?>>Aktif Mengajar</option>
                    <option value="TIDAK_AKTIF" <?= ($guru['status'] ?? '') !== 'AKTIF' ? 'selected' : '' ?>>Tidak Aktif / Keluar</option>
                </select>
                <label for="status" class="g-label">Status Kepegawaian</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/guru" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
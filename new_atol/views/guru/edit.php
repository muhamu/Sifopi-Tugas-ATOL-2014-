<?php $pageTitle = 'Edit Guru'; $activePage = 'guru'; ?>

<div class="page-header">
    <h1 class="page-title">Edit Data Guru</h1>
    <p class="page-subtitle"><?= safe($guru['nama']) ?></p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/guru/edit?id=<?= $guru['id'] ?>" class="form-row">
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" value="<?= safe($guru['nip'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap *</label>
                <input type="text" id="nama" name="nama" required value="<?= safe($guru['nama']) ?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= safe($guru['tgl_lahir'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">-- Pilih --</option>
                    <option value="LAKI-LAKI" <?= ($guru['jenis_kelamin'] ?? '') === 'LAKI-LAKI' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="PEREMPUAN" <?= ($guru['jenis_kelamin'] ?? '') === 'PEREMPUAN' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="agama">Agama</label>
                <select id="agama" name="agama">
                    <option value="">-- Pilih --</option>
                    <?php foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag): ?>
                        <option value="<?= $ag ?>" <?= ($guru['agama'] ?? '') === $ag ? 'selected' : '' ?>><?= $ag ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= safe($guru['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="no_telepon">No Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" value="<?= safe($guru['no_telepon'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="AKTIF" <?= ($guru['status'] ?? '') === 'AKTIF' ? 'selected' : '' ?>>Aktif</option>
                    <option value="CUTI"  <?= ($guru['status'] ?? '') === 'CUTI'  ? 'selected' : '' ?>>Cuti</option>
                    <option value="RESIGN"<?= ($guru['status'] ?? '') === 'RESIGN' ? 'selected' : '' ?>>Resign</option>
                </select>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"><?= safe($guru['alamat'] ?? '') ?></textarea>
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/guru" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

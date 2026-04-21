<?php $pageTitle = 'Tambah Siswa'; $activePage = 'siswa'; ?>

<div class="page-header">
    <h1 class="page-title">Tambah Siswa Baru</h1>
    <p class="page-subtitle">Login otomatis: No Induk / password123</p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/siswa/create" class="form-row">
            <div class="form-group">
                <label for="no_induk">No Induk *</label>
                <input type="text" id="no_induk" name="no_induk" required value="<?= safe($_POST['no_induk'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap *</label>
                <input type="text" id="nama" name="nama" required value="<?= safe($_POST['nama'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= safe($_POST['tgl_lahir'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">-- Pilih --</option>
                    <option value="LAKI-LAKI" <?= ($_POST['jenis_kelamin'] ?? '') === 'LAKI-LAKI' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="PEREMPUAN" <?= ($_POST['jenis_kelamin'] ?? '') === 'PEREMPUAN' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="agama">Agama</label>
                <select id="agama" name="agama">
                    <option value="">-- Pilih --</option>
                    <?php foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag): ?>
                        <option value="<?= $ag ?>" <?= ($_POST['agama'] ?? '') === $ag ? 'selected' : '' ?>><?= $ag ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= safe($_POST['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="no_telepon">No Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" value="<?= safe($_POST['no_telepon'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select id="kelas_id" name="kelas_id">
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelas_list as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= ($_POST['kelas_id'] ?? '') == $k['id'] ? 'selected' : '' ?>><?= safe($k['nama_kelas']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tahun_ajaran_id">Tahun Ajaran</label>
                <select id="tahun_ajaran_id" name="tahun_ajaran_id">
                    <?php foreach ($tahun_list as $t): ?>
                        <option value="<?= $t['id'] ?>" <?= $t['is_active'] ? 'selected' : '' ?>><?= safe($t['tahun_ajaran']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"><?= safe($_POST['alamat'] ?? '') ?></textarea>
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/siswa" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

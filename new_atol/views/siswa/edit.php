<?php $pageTitle = 'Edit Siswa'; $activePage = 'siswa'; ?>

<div class="page-header">
    <h1 class="page-title">Edit Data Siswa</h1>
    <p class="page-subtitle"><?= safe($siswa['nama']) ?> — <?= safe($siswa['no_induk']) ?></p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/siswa/edit?id=<?= $siswa['id'] ?>" class="form-row">
            <div class="form-group">
                <label>No Induk</label>
                <input type="text" value="<?= safe($siswa['no_induk']) ?>" disabled>
                <small>Tidak dapat diubah</small>
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap *</label>
                <input type="text" id="nama" name="nama" required value="<?= safe($siswa['nama']) ?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= safe($siswa['tgl_lahir'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">-- Pilih --</option>
                    <option value="LAKI-LAKI" <?= ($siswa['jenis_kelamin'] ?? '') === 'LAKI-LAKI' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="PEREMPUAN" <?= ($siswa['jenis_kelamin'] ?? '') === 'PEREMPUAN' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="agama">Agama</label>
                <select id="agama" name="agama">
                    <option value="">-- Pilih --</option>
                    <?php foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag): ?>
                        <option value="<?= $ag ?>" <?= ($siswa['agama'] ?? '') === $ag ? 'selected' : '' ?>><?= $ag ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= safe($siswa['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="no_telepon">No Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" value="<?= safe($siswa['no_telepon'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select id="kelas_id" name="kelas_id">
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelas_list as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= $k['id'] == $siswa['kelas_id'] ? 'selected' : '' ?>><?= safe($k['nama_kelas']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <?php foreach (STUDENT_STATUS as $val => $label): ?>
                        <option value="<?= $val ?>" <?= ($siswa['status'] ?? 'AKTIF') === $val ? 'selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"><?= safe($siswa['alamat'] ?? '') ?></textarea>
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/siswa" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?php $pageTitle = 'Tambah Kelas'; $activePage = 'kelas'; ?>

<div class="page-header">
    <h1 class="page-title">Tambah Kelas Baru</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/kelas/create" class="form-row">
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas *</label>
                <input type="text" id="nama_kelas" name="nama_kelas" required placeholder="Contoh: X TKJ 1" value="<?= safe($_POST['nama_kelas'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="no_ruangan">No. Ruangan</label>
                <input type="text" id="no_ruangan" name="no_ruangan" placeholder="Contoh: R.101" value="<?= safe($_POST['no_ruangan'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="id_guru_wali">Wali Kelas</label>
                <select id="id_guru_wali" name="id_guru_wali">
                    <option value="">-- Pilih Guru --</option>
                    <?php foreach ($guru_list as $g): ?>
                        <option value="<?= $g['id'] ?>" <?= ($_POST['id_guru_wali'] ?? '') == $g['id'] ? 'selected' : '' ?>><?= safe($g['nama']) ?></option>
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
            <div class="form-group">
                <label for="kurikulum">Kurikulum</label>
                <input type="text" id="kurikulum" name="kurikulum" placeholder="Contoh: Merdeka Belajar" value="<?= safe($_POST['kurikulum'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="capacity">Kapasitas</label>
                <input type="number" id="capacity" name="capacity" min="1" max="50" value="<?= safe($_POST['capacity'] ?? '40') ?>">
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/kelas" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

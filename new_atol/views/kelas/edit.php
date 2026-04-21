<?php $pageTitle = 'Edit Kelas'; $activePage = 'kelas'; ?>

<div class="page-header">
    <h1 class="page-title">Edit Kelas</h1>
    <p class="page-subtitle"><?= safe($kelas['nama_kelas']) ?></p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/kelas/edit?id=<?= $kelas['id'] ?>" class="form-row">
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas *</label>
                <input type="text" id="nama_kelas" name="nama_kelas" required value="<?= safe($kelas['nama_kelas']) ?>">
            </div>
            <div class="form-group">
                <label for="no_ruangan">No. Ruangan</label>
                <input type="text" id="no_ruangan" name="no_ruangan" value="<?= safe($kelas['no_ruangan'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="id_guru_wali">Wali Kelas</label>
                <select id="id_guru_wali" name="id_guru_wali">
                    <option value="">-- Pilih Guru --</option>
                    <?php foreach ($guru_list as $g): ?>
                        <option value="<?= $g['id'] ?>" <?= $g['id'] == $kelas['id_guru_wali'] ? 'selected' : '' ?>><?= safe($g['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kurikulum">Kurikulum</label>
                <input type="text" id="kurikulum" name="kurikulum" value="<?= safe($kelas['kurikulum'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="capacity">Kapasitas</label>
                <input type="number" id="capacity" name="capacity" min="1" max="50" value="<?= safe($kelas['capacity'] ?? 40) ?>">
            </div>
            <div class="form-group">
                <label>Status</label>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" <?= $kelas['is_active'] ? 'checked' : '' ?>> Aktif
                </label>
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/kelas" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

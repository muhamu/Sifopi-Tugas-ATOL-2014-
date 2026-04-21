<?php $pageTitle = 'Edit Mapel'; $activePage = 'mapel'; ?>

<div class="page-header">
    <h1 class="page-title">Edit Mata Pelajaran</h1>
    <p class="page-subtitle"><?= safe($mapel['mata_pelajaran']) ?></p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/mapel/edit?id=<?= $mapel['id'] ?>" class="form-row">
            <div class="form-group">
                <label for="kode_mapel">Kode Mapel</label>
                <input type="text" id="kode_mapel" name="kode_mapel" value="<?= safe($mapel['kode_mapel'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="mata_pelajaran">Nama Mata Pelajaran *</label>
                <input type="text" id="mata_pelajaran" name="mata_pelajaran" required value="<?= safe($mapel['mata_pelajaran']) ?>">
            </div>
            <div class="form-group">
                <label for="kategori_pelajaran">Kategori</label>
                <select id="kategori_pelajaran" name="kategori_pelajaran">
                    <option value="">-- Pilih --</option>
                    <?php foreach (['Umum','Kejuruan','Muatan Lokal','Pengembangan Diri'] as $kat): ?>
                        <option value="<?= $kat ?>" <?= ($mapel['kategori_pelajaran'] ?? '') === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jam_pembelajaran">Jam/Minggu</label>
                <input type="number" id="jam_pembelajaran" name="jam_pembelajaran" min="1" max="20" value="<?= safe($mapel['jam_pembelajaran'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="kurikulum">Kurikulum</label>
                <input type="text" id="kurikulum" name="kurikulum" value="<?= safe($mapel['kurikulum'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Status</label>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" <?= $mapel['is_active'] ? 'checked' : '' ?>> Aktif
                </label>
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/mapel" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

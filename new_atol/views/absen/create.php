<?php $pageTitle = 'Input Absensi'; $activePage = 'absen'; ?>

<div class="page-header">
    <h1 class="page-title">Input Absensi</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/absen/create" class="form-row">
            <div class="form-group">
                <label for="tanggal">Tanggal *</label>
                <input type="date" id="tanggal" name="tanggal" required value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group">
                <label for="siswa_id">Siswa *</label>
                <select id="siswa_id" name="siswa_id" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php foreach ($siswa_list as $s): ?>
                        <option value="<?= $s['id'] ?>"><?= safe($s['nama']) ?> (<?= safe($s['no_induk']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="pelajaran_kelas_id">Mata Pelajaran & Kelas *</label>
                <select id="pelajaran_kelas_id" name="pelajaran_kelas_id" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($pk_list as $pk): ?>
                        <option value="<?= $pk['id'] ?>"><?= safe($pk['mata_pelajaran']) ?> — <?= safe($pk['nama_kelas']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status Kehadiran *</label>
                <select id="status" name="status">
                    <?php foreach (ATTENDANCE_STATUS as $val => $label): ?>
                        <option value="<?= $val ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="2" placeholder="Opsional"></textarea>
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/absen" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

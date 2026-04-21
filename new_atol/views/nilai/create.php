<?php $pageTitle = 'Input Nilai'; $activePage = 'nilai'; ?>

<div class="page-header">
    <h1 class="page-title">Input Nilai Siswa</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/nilai/create" class="form-row">
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
                <label for="tahun_ajaran_id">Tahun Ajaran</label>
                <select id="tahun_ajaran_id" name="tahun_ajaran_id">
                    <?php foreach ($tahun_list as $t): ?>
                        <option value="<?= $t['id'] ?>" <?= $t['is_active'] ? 'selected' : '' ?>><?= safe($t['tahun_ajaran']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <select id="semester" name="semester">
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tugas">Nilai Tugas (0–100)</label>
                <input type="number" id="tugas" name="tugas" min="0" max="100" step="0.5" value="0">
            </div>
            <div class="form-group">
                <label for="uts">Nilai UTS (0–100)</label>
                <input type="number" id="uts" name="uts" min="0" max="100" step="0.5" value="0">
            </div>
            <div class="form-group">
                <label for="uas">Nilai UAS (0–100)</label>
                <input type="number" id="uas" name="uas" min="0" max="100" step="0.5" value="0">
            </div>
            <div class="form-group">
                <label>Rata-rata (otomatis)</label>
                <input type="text" id="preview_rata" disabled placeholder="Dihitung otomatis">
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/nilai" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Nilai</button>
            </div>
        </form>
    </div>
</div>
<script>
['tugas','uts','uas'].forEach(id => {
    document.getElementById(id).addEventListener('input', () => {
        const t = parseFloat(document.getElementById('tugas').value)||0;
        const u = parseFloat(document.getElementById('uts').value)||0;
        const a = parseFloat(document.getElementById('uas').value)||0;
        const avg = ((t+u+a)/3).toFixed(2);
        const grade = avg>=90?'A':avg>=80?'B':avg>=70?'C':avg>=60?'D':'E';
        document.getElementById('preview_rata').value = avg + ' (' + grade + ')';
    });
});
</script>

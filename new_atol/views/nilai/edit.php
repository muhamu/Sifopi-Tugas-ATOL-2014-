<?php $pageTitle = 'Edit Nilai'; $activePage = 'nilai'; ?>

<div class="page-header">
    <h1 class="page-title">Edit Nilai</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/nilai/edit?id=<?= $nilai['id'] ?>" class="form-row">
            <div class="form-group">
                <label for="tugas">Nilai Tugas (0–100)</label>
                <input type="number" id="tugas" name="tugas" min="0" max="100" step="0.5" value="<?= safe($nilai['tugas'] ?? 0) ?>">
            </div>
            <div class="form-group">
                <label for="uts">Nilai UTS (0–100)</label>
                <input type="number" id="uts" name="uts" min="0" max="100" step="0.5" value="<?= safe($nilai['uts'] ?? 0) ?>">
            </div>
            <div class="form-group">
                <label for="uas">Nilai UAS (0–100)</label>
                <input type="number" id="uas" name="uas" min="0" max="100" step="0.5" value="<?= safe($nilai['uas'] ?? 0) ?>">
            </div>
            <div class="form-group">
                <label>Rata-rata saat ini</label>
                <input type="text" disabled value="<?= safe($nilai['rata_rata'] ?? '-') ?> (<?= safe($nilai['grade'] ?? '-') ?>)">
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/nilai" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

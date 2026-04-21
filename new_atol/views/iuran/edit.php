<?php $pageTitle = 'Edit SPP'; $activePage = 'iuran';
$bulanNama = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
$siswaNow = null;
foreach ($siswa_list as $s) { if ($s['id'] == $spp['siswa_id']) { $siswaNow = $s; break; } }
?>

<div class="page-header">
    <h1 class="page-title">Edit SPP</h1>
    <p class="page-subtitle"><?= safe($siswaNow['nama'] ?? '-') ?> — <?= $bulanNama[$spp['bulan']] ?? $spp['bulan'] ?> <?= $spp['tahun'] ?></p>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/iuran/edit?id=<?= $spp['id'] ?>" class="form-row">
            <div class="form-group">
                <label>Siswa</label>
                <input type="text" disabled value="<?= safe($siswaNow['nama'] ?? '-') ?>">
            </div>
            <div class="form-group">
                <label>Periode</label>
                <input type="text" disabled value="<?= $bulanNama[$spp['bulan']] ?? $spp['bulan'] ?> <?= $spp['tahun'] ?>">
            </div>
            <div class="form-group">
                <label for="nominal">Nominal (Rp) *</label>
                <input type="number" id="nominal" name="nominal" required min="0" step="1000" value="<?= safe($spp['nominal']) ?>">
            </div>
            <div class="form-group">
                <label for="status">Status Pembayaran *</label>
                <select id="status" name="status" required>
                    <?php foreach (PAYMENT_STATUS as $v => $l): ?>
                        <option value="<?= $v ?>" <?= $spp['status'] === $v ? 'selected' : '' ?>><?= $l ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_bayar">Tanggal Bayar</label>
                <input type="date" id="tanggal_bayar" name="tanggal_bayar" value="<?= safe($spp['tanggal_bayar'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="metode_bayar">Metode Bayar</label>
                <select id="metode_bayar" name="metode_bayar">
                    <option value="">-- Pilih --</option>
                    <?php foreach (['Tunai','Transfer Bank','QRIS','Kartu Debit'] as $m): ?>
                        <option value="<?= $m ?>" <?= ($spp['metode_bayar'] ?? '') === $m ? 'selected' : '' ?>><?= $m ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label for="catatan">Catatan</label>
                <input type="text" id="catatan" name="catatan" value="<?= safe($spp['catatan'] ?? '') ?>">
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/iuran" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

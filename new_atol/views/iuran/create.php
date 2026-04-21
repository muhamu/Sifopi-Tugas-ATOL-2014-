<?php $pageTitle = 'Tambah Tagihan SPP'; $activePage = 'iuran';
$bulanNama = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
?>

<div class="page-header">
    <h1 class="page-title">Tambah Tagihan SPP</h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/iuran/create" class="form-row">
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
                <label for="bulan">Bulan *</label>
                <select id="bulan" name="bulan" required>
                    <?php foreach ($bulanNama as $num => $nama): ?>
                        <option value="<?= $num ?>" <?= $num == date('n') ? 'selected' : '' ?>><?= $nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun *</label>
                <input type="number" id="tahun" name="tahun" required min="2020" max="2030" value="<?= date('Y') ?>">
            </div>
            <div class="form-group">
                <label for="nominal">Nominal (Rp) *</label>
                <input type="number" id="nominal" name="nominal" required min="0" step="1000" placeholder="Contoh: 150000">
            </div>
            <div class="form-group">
                <label for="status">Status Pembayaran</label>
                <select id="status" name="status">
                    <?php foreach (PAYMENT_STATUS as $v => $l): ?>
                        <option value="<?= $v ?>"><?= $l ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_bayar">Tanggal Bayar</label>
                <input type="date" id="tanggal_bayar" name="tanggal_bayar">
            </div>
            <div class="form-group">
                <label for="metode_bayar">Metode Bayar</label>
                <select id="metode_bayar" name="metode_bayar">
                    <option value="">-- Pilih --</option>
                    <?php foreach (['Tunai','Transfer Bank','QRIS','Kartu Debit'] as $m): ?>
                        <option value="<?= $m ?>"><?= $m ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <input type="text" id="catatan" name="catatan" placeholder="Opsional">
            </div>
            <div class="form-actions" style="grid-column:1/-1;">
                <a href="/iuran" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

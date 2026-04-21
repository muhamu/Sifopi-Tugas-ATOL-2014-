<?php $pageTitle = 'SPP / Iuran'; $activePage = 'iuran';
$bulanNama = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
?>

<div class="page-header" style="display:flex;justify-content:space-between;align-items:center;">
    <div>
        <h1 class="page-title">SPP / Iuran</h1>
        <p class="page-subtitle">Kelola pembayaran SPP siswa</p>
    </div>
    <a href="/iuran/create" class="btn btn-secondary">+ Tambah Tagihan</a>
</div>

<div class="search-bar">
    <form method="GET" action="/iuran" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <input type="text" name="search" class="search-input" placeholder="Cari nama siswa..." value="<?= safe($search ?? '') ?>">
        <select name="status" class="search-input" style="max-width:180px;">
            <option value="">Semua Status</option>
            <?php foreach (PAYMENT_STATUS as $v => $l): ?>
                <option value="<?= $v ?>" <?= ($status ?? '') === $v ? 'selected' : '' ?>><?= $l ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="/iuran" class="btn btn-outline">Reset</a>
    </form>
</div>

<?php if (!empty($result['data'])): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Siswa</th><th>Bulan/Tahun</th><th>Nominal</th><th>Status</th><th>Tgl Bayar</th><th>Metode</th><th style="width:130px;">Aksi</th></tr>
            </thead>
            <tbody>
                <?php foreach ($result['data'] as $s):
                    $sc = match($s['status']) { 'LUNAS'=>'success','CICIL'=>'warning',default=>'danger' };
                    $sl = PAYMENT_STATUS[$s['status']] ?? $s['status'];
                ?>
                    <tr>
                        <td><?= safe($s['nama_siswa'] ?? '-') ?><br><small><?= safe($s['no_induk'] ?? '') ?></small></td>
                        <td><?= $bulanNama[$s['bulan']] ?? $s['bulan'] ?> <?= $s['tahun'] ?></td>
                        <td>Rp <?= number_format($s['nominal'], 0, ',', '.') ?></td>
                        <td><span class="badge badge-<?= $sc ?>"><?= $sl ?></span></td>
                        <td><?= safe($s['tanggal_bayar'] ?? '-') ?></td>
                        <td><?= safe($s['metode_bayar'] ?? '-') ?></td>
                        <td class="table-actions">
                            <a href="/iuran/edit?id=<?= $s['id'] ?>" class="btn btn-small action-edit">Edit</a>
                            <form method="POST" action="/iuran/delete?id=<?= $s['id'] ?>" style="display:inline;" onsubmit="return confirm('Hapus tagihan ini?')">
                                <button class="btn btn-small action-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($result['pages'] > 1): ?>
        <div class="pagination"><ul>
            <?php if ($result['has_prev']): ?><li><a href="/iuran?page=<?= $result['page']-1 ?>&search=<?= urlencode($search??'') ?>&status=<?= urlencode($status??'') ?>">← Prev</a></li><?php endif; ?>
            <?php for ($i = max(1,$result['page']-2); $i <= min($result['pages'],$result['page']+2); $i++): ?>
                <li><?php if ($i===$result['page']): ?><span class="active"><?= $i ?></span><?php else: ?><a href="/iuran?page=<?= $i ?>&search=<?= urlencode($search??'') ?>&status=<?= urlencode($status??'') ?>"><?= $i ?></a><?php endif; ?></li>
            <?php endfor; ?>
            <?php if ($result['has_next']): ?><li><a href="/iuran?page=<?= $result['page']+1 ?>&search=<?= urlencode($search??'') ?>&status=<?= urlencode($status??'') ?>">Next →</a></li><?php endif; ?>
        </ul></div>
    <?php endif; ?>
<?php else: ?>
    <div class="empty-state">
        <div class="empty-state-icon">💰</div>
        <h3 class="empty-state-title">Belum Ada Data SPP</h3>
        <a href="/iuran/create" class="btn btn-primary">+ Tambah Tagihan</a>
    </div>
<?php endif; ?>

<?php $pageTitle = 'Absensi'; $activePage = 'absen'; ?>

<div class="page-header" style="display:flex;justify-content:space-between;align-items:center;">
    <div>
        <h1 class="page-title">Absensi</h1>
        <p class="page-subtitle">Rekap kehadiran siswa</p>
    </div>
    <?php if (in_array($_SESSION['user']['role'], ['ADMIN','GURU'])): ?>
        <a href="/absen/create" class="btn btn-secondary">+ Input Absen</a>
    <?php endif; ?>
</div>

<div class="search-bar">
    <form method="GET" action="/absen" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <input type="date" name="tanggal" value="<?= safe($tanggal ?? '') ?>" class="search-input" style="max-width:180px;">
        <select name="kelas_id" class="search-input" style="max-width:200px;">
            <option value="">Semua Kelas</option>
            <?php foreach ($kelas_list as $k): ?>
                <option value="<?= $k['id'] ?>" <?= ($kelas_id ?? 0) == $k['id'] ? 'selected' : '' ?>><?= safe($k['nama_kelas']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="/absen" class="btn btn-outline">Reset</a>
    </form>
</div>

<?php if (!empty($result['data'])): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Tanggal</th><th>Siswa</th><th>Kelas</th><th>Mata Pelajaran</th><th>Status</th><th>Keterangan</th><th style="width:80px;">Aksi</th></tr>
            </thead>
            <tbody>
                <?php foreach ($result['data'] as $a):
                    $sc = match($a['status'] ?? 'HADIR') { 'HADIR'=>'success','SAKIT'=>'warning','IZIN'=>'primary', default=>'danger' };
                ?>
                    <tr>
                        <td><?= safe($a['tanggal']) ?></td>
                        <td><?= safe($a['nama_siswa'] ?? '-') ?><br><small><?= safe($a['no_induk'] ?? '') ?></small></td>
                        <td><?= safe($a['nama_kelas'] ?? '-') ?></td>
                        <td><?= safe($a['mata_pelajaran'] ?? '-') ?></td>
                        <td><span class="badge badge-<?= $sc ?>"><?= safe($a['status'] ?? 'HADIR') ?></span></td>
                        <td><?= safe($a['keterangan'] ?? '-') ?></td>
                        <td class="table-actions">
                            <?php if (in_array($_SESSION['user']['role'], ['ADMIN','GURU'])): ?>
                            <form method="POST" action="/absen/delete?id=<?= $a['id'] ?>" style="display:inline;" onsubmit="return confirm('Hapus data absen ini?')">
                                <button class="btn btn-small action-delete">Hapus</button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($result['pages'] > 1): ?>
        <div class="pagination"><ul>
            <?php if ($result['has_prev']): ?><li><a href="/absen?page=<?= $result['page']-1 ?>&tanggal=<?= urlencode($tanggal??'') ?>&kelas_id=<?= $kelas_id??0 ?>">← Prev</a></li><?php endif; ?>
            <?php for ($i = max(1,$result['page']-2); $i <= min($result['pages'],$result['page']+2); $i++): ?>
                <li><?php if ($i===$result['page']): ?><span class="active"><?= $i ?></span><?php else: ?><a href="/absen?page=<?= $i ?>&tanggal=<?= urlencode($tanggal??'') ?>&kelas_id=<?= $kelas_id??0 ?>"><?= $i ?></a><?php endif; ?></li>
            <?php endfor; ?>
            <?php if ($result['has_next']): ?><li><a href="/absen?page=<?= $result['page']+1 ?>&tanggal=<?= urlencode($tanggal??'') ?>&kelas_id=<?= $kelas_id??0 ?>">Next →</a></li><?php endif; ?>
        </ul></div>
    <?php endif; ?>
<?php else: ?>
    <div class="empty-state">
        <div class="empty-state-icon">📋</div>
        <h3 class="empty-state-title">Belum Ada Data Absensi</h3>
        <p class="empty-state-text">Coba ubah filter atau tambah data baru</p>
        <?php if (in_array($_SESSION['user']['role'], ['ADMIN','GURU'])): ?>
            <a href="/absen/create" class="btn btn-primary">+ Input Absen</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

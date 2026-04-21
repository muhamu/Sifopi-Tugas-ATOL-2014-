<?php $pageTitle = 'Daftar Siswa'; $activePage = 'siswa'; ?>

<div class="page-header" style="display:flex;justify-content:space-between;align-items:center;">
    <div>
        <h1 class="page-title">Daftar Siswa</h1>
        <p class="page-subtitle">Kelola data siswa sekolah</p>
    </div>
    <?php if (in_array($_SESSION['user']['role'], ['ADMIN','TATA_USAHA'])): ?>
        <a href="/siswa/create" class="btn btn-secondary">+ Tambah Siswa</a>
    <?php endif; ?>
</div>

<div class="search-bar">
    <form method="GET" action="/siswa" style="display:flex;gap:8px;align-items:center;">
        <input type="text" name="search" class="search-input" placeholder="Cari nama atau no induk..." value="<?= safe($search ?? '') ?>">
        <button type="submit" class="btn btn-primary">Cari</button>
        <?php if (!empty($search)): ?><a href="/siswa" class="btn btn-outline">Reset</a><?php endif; ?>
    </form>
</div>

<?php if (!empty($result['data'])): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No Induk</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $kelasMap = [];
                foreach ($kelas_list as $k) $kelasMap[$k['id']] = $k['nama_kelas'];
                foreach ($result['data'] as $s):
                ?>
                    <tr>
                        <td><strong><?= safe($s['no_induk']) ?></strong></td>
                        <td><?= safe($s['nama']) ?></td>
                        <td><?= safe($kelasMap[$s['kelas_id']] ?? '-') ?></td>
                        <td><?= safe($s['email'] ?? '-') ?></td>
                        <td><span class="badge badge-<?= $s['status'] === 'AKTIF' ? 'success' : 'secondary' ?>"><?= safe($s['status']) ?></span></td>
                        <td class="table-actions">
                            <a href="/siswa/edit?id=<?= $s['id'] ?>" class="btn btn-small action-edit">Edit</a>
                            <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                            <form method="POST" action="/siswa/delete?id=<?= $s['id'] ?>" style="display:inline;" onsubmit="return confirm('Hapus siswa <?= safe($s['nama']) ?>?')">
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
            <?php if ($result['has_prev']): ?><li><a href="/siswa?page=<?= $result['page']-1 ?>&search=<?= urlencode($search??'') ?>">← Prev</a></li><?php endif; ?>
            <?php for ($i = max(1,$result['page']-2); $i <= min($result['pages'],$result['page']+2); $i++): ?>
                <li><?php if ($i===$result['page']): ?><span class="active"><?= $i ?></span><?php else: ?><a href="/siswa?page=<?= $i ?>&search=<?= urlencode($search??'') ?>"><?= $i ?></a><?php endif; ?></li>
            <?php endfor; ?>
            <?php if ($result['has_next']): ?><li><a href="/siswa?page=<?= $result['page']+1 ?>&search=<?= urlencode($search??'') ?>">Next →</a></li><?php endif; ?>
        </ul></div>
    <?php endif; ?>
<?php else: ?>
    <div class="empty-state">
        <div class="empty-state-icon">📚</div>
        <h3 class="empty-state-title">Belum Ada Data Siswa</h3>
        <p class="empty-state-text"><?= !empty($search) ? "Tidak ditemukan untuk \"$search\"" : 'Mulai dengan menambahkan siswa baru' ?></p>
        <?php if (in_array($_SESSION['user']['role'], ['ADMIN','TATA_USAHA'])): ?>
            <a href="/siswa/create" class="btn btn-primary">+ Tambah Siswa</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php $pageTitle = 'Daftar Guru'; $activePage = 'guru'; ?>

<div class="page-header" style="display:flex;justify-content:space-between;align-items:center;">
    <div>
        <h1 class="page-title">Daftar Guru</h1>
        <p class="page-subtitle">Kelola data guru sekolah</p>
    </div>
    <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
        <a href="/guru/create" class="btn btn-secondary">+ Tambah Guru</a>
    <?php endif; ?>
</div>

<div class="search-bar">
    <form method="GET" action="/guru" style="display:flex;gap:8px;align-items:center;">
        <input type="text" name="search" class="search-input" placeholder="Cari nama atau NIP..." value="<?= safe($search ?? '') ?>">
        <button type="submit" class="btn btn-primary">Cari</button>
        <?php if (!empty($search)): ?><a href="/guru" class="btn btn-outline">Reset</a><?php endif; ?>
    </form>
</div>

<?php if (!empty($result['data'])): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>NIP</th><th>Nama</th><th>Email</th><th>No. Telepon</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
            </thead>
            <tbody>
                <?php foreach ($result['data'] as $g): ?>
                    <tr>
                        <td><strong><?= safe($g['nip'] ?? '-') ?></strong></td>
                        <td><?= safe($g['nama']) ?></td>
                        <td><?= safe($g['email'] ?? '-') ?></td>
                        <td><?= safe($g['no_telepon'] ?? '-') ?></td>
                        <td><span class="badge badge-<?= ($g['status'] ?? '') === 'AKTIF' ? 'success' : 'secondary' ?>"><?= safe($g['status'] ?? 'AKTIF') ?></span></td>
                        <td class="table-actions">
                            <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                            <a href="/guru/edit?id=<?= $g['id'] ?>" class="btn btn-small action-edit">Edit</a>
                            <form method="POST" action="/guru/delete?id=<?= $g['id'] ?>" style="display:inline;" onsubmit="return confirm('Hapus guru <?= safe($g['nama']) ?>?')">
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
            <?php if ($result['has_prev']): ?><li><a href="/guru?page=<?= $result['page']-1 ?>">← Prev</a></li><?php endif; ?>
            <?php for ($i = max(1,$result['page']-2); $i <= min($result['pages'],$result['page']+2); $i++): ?>
                <li><?php if ($i===$result['page']): ?><span class="active"><?= $i ?></span><?php else: ?><a href="/guru?page=<?= $i ?>"><?= $i ?></a><?php endif; ?></li>
            <?php endfor; ?>
            <?php if ($result['has_next']): ?><li><a href="/guru?page=<?= $result['page']+1 ?>">Next →</a></li><?php endif; ?>
        </ul></div>
    <?php endif; ?>
<?php else: ?>
    <div class="empty-state">
        <div class="empty-state-icon">👨‍🏫</div>
        <h3 class="empty-state-title">Belum Ada Data Guru</h3>
        <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
            <a href="/guru/create" class="btn btn-primary">+ Tambah Guru</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

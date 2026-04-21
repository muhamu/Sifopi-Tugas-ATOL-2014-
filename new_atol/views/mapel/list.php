<?php $pageTitle = 'Mata Pelajaran'; $activePage = 'mapel'; ?>

<div class="page-header" style="display:flex;justify-content:space-between;align-items:center;">
    <div>
        <h1 class="page-title">Mata Pelajaran</h1>
        <p class="page-subtitle">Kelola data mata pelajaran</p>
    </div>
    <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
        <a href="/mapel/create" class="btn btn-secondary">+ Tambah Mapel</a>
    <?php endif; ?>
</div>

<?php if (!empty($result)): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Kode</th><th>Mata Pelajaran</th><th>Kategori</th><th>Jam/Minggu</th><th>Kurikulum</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
            </thead>
            <tbody>
                <?php foreach ($result as $m): ?>
                    <tr>
                        <td><strong><?= safe($m['kode_mapel'] ?? '-') ?></strong></td>
                        <td><?= safe($m['mata_pelajaran']) ?></td>
                        <td><?= safe($m['kategori_pelajaran'] ?? '-') ?></td>
                        <td><?= safe($m['jam_pembelajaran'] ?? '-') ?></td>
                        <td><?= safe($m['kurikulum'] ?? '-') ?></td>
                        <td><span class="badge badge-<?= $m['is_active'] ? 'success' : 'secondary' ?>"><?= $m['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
                        <td class="table-actions">
                            <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                            <a href="/mapel/edit?id=<?= $m['id'] ?>" class="btn btn-small action-edit">Edit</a>
                            <form method="POST" action="/mapel/delete?id=<?= $m['id'] ?>" style="display:inline;" onsubmit="return confirm('Nonaktifkan <?= safe($m['mata_pelajaran']) ?>?')">
                                <button class="btn btn-small action-delete">Hapus</button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="empty-state">
        <div class="empty-state-icon">📖</div>
        <h3 class="empty-state-title">Belum Ada Mata Pelajaran</h3>
        <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
            <a href="/mapel/create" class="btn btn-primary">+ Tambah Mapel</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php $pageTitle = 'Daftar Kelas'; $activePage = 'kelas'; ?>

<div class="page-header" style="display:flex;justify-content:space-between;align-items:center;">
    <div>
        <h1 class="page-title">Daftar Kelas</h1>
        <p class="page-subtitle">Kelola data kelas sekolah</p>
    </div>
    <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
        <a href="/kelas/create" class="btn btn-secondary">+ Tambah Kelas</a>
    <?php endif; ?>
</div>

<?php
$guruMap = [];
foreach ($guru_list as $g) $guruMap[$g['id']] = $g['nama'];
?>

<?php if (!empty($result)): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Nama Kelas</th><th>Ruangan</th><th>Wali Kelas</th><th>Kurikulum</th><th>Kapasitas</th><th>Status</th><th style="width:130px;">Aksi</th></tr>
            </thead>
            <tbody>
                <?php foreach ($result as $k): ?>
                    <tr>
                        <td><strong><?= safe($k['nama_kelas']) ?></strong></td>
                        <td><?= safe($k['no_ruangan'] ?? '-') ?></td>
                        <td><?= safe($guruMap[$k['id_guru_wali']] ?? '-') ?></td>
                        <td><?= safe($k['kurikulum'] ?? '-') ?></td>
                        <td><?= safe($k['capacity'] ?? 40) ?> siswa</td>
                        <td><span class="badge badge-<?= $k['is_active'] ? 'success' : 'secondary' ?>"><?= $k['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
                        <td class="table-actions">
                            <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                            <a href="/kelas/edit?id=<?= $k['id'] ?>" class="btn btn-small action-edit">Edit</a>
                            <form method="POST" action="/kelas/delete?id=<?= $k['id'] ?>" style="display:inline;" onsubmit="return confirm('Nonaktifkan kelas <?= safe($k['nama_kelas']) ?>?')">
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
        <div class="empty-state-icon">🏫</div>
        <h3 class="empty-state-title">Belum Ada Data Kelas</h3>
        <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
            <a href="/kelas/create" class="btn btn-primary">+ Tambah Kelas</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

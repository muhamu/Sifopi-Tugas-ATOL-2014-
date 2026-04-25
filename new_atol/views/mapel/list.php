<?php $pageTitle = 'Mata Pelajaran'; $activePage = 'mapel'; ?>

<div class="g-list-card">
    <div class="g-list-header">
        <h2 class="g-list-title">Mata Pelajaran (Kurikulum)</h2>
        <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
            <a href="/mapel/create" class="g1-btn g1-btn-primary" style="padding: 8px 16px; height: 36px; display: inline-flex; align-items: center;">+ Tambah Mapel</a>
        <?php endif; ?>
    </div>

    <div class="g-table-responsive">
        <table class="g-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Mata Pelajaran</th>
                    <th>KKM</th>
                    <th>Kelompok</th>
                    <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                        <th style="text-align: right;">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($result)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 48px; color: #5f6368;"><i>Tidak ada data mata pelajaran.</i></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td style="font-family: monospace; color: #5f6368;"><?= safe($row['kode_mapel']) ?></td>
                            <td style="font-weight: 500;"><?= safe($row['mata_pelajaran'] ?? '') ?></td>
                            <td><span class="g-badge g-badge-warning"><?= safe($row['kkm'] ?? '75') ?></span></td>
                            <td><?= safe($row['kelompok'] ?? 'Umum') ?></td>
                            
                            <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                                <td style="text-align: right;">
                                    <a href="/mapel/edit?id=<?= $row['id'] ?>" class="g-btn-icon" title="Edit">✎</a>
                                    <form action="/mapel/delete?id=<?= $row['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?');">
                                        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                                        <button type="submit" class="g-btn-icon delete" title="Hapus">🗑</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if (isset($result['pages']) && $result['pages'] > 1): ?>
    <div class="g-pagination"><!-- Paginasi --><a href="?page=<?= $result['page'] + 1 ?>" class="g-pagination-btn">❯</a></div>
    <?php endif; ?>
</div>
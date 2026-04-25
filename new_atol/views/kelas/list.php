<?php $pageTitle = 'Daftar Kelas'; $activePage = 'kelas'; ?>

<div class="g-list-card">
    <div class="g-list-header">
        <h2 class="g-list-title">Rombongan Belajar (Kelas)</h2>
        <?php if (in_array($_SESSION['user']['role'], ['ADMIN'])): ?>
            <a href="/kelas/create" class="g1-btn g1-btn-primary" style="padding: 8px 16px; height: 36px; display: inline-flex; align-items: center;">+ Tambah Kelas</a>
        <?php endif; ?>
    </div>

    <div class="g-table-responsive">
        <table class="g-table">
            <thead>
                <tr>
                    <th>Tingkat</th>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Kapasitas</th>
                    <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                        <th style="text-align: right;">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($result)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 48px; color: #5f6368;"><i>Belum ada kelas yang terdaftar.</i></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><span class="g-badge g-badge-info">Tingkat <?= safe($row['tingkat']) ?></span></td>
                            <td style="font-weight: 500; color: #202124;"><?= safe($row['nama_kelas']) ?></td>
                            <td><?= safe($row['wali_kelas_nama'] ?? 'Belum Ditentukan') ?></td>
                            <td><?= safe($row['jumlah_siswa'] ?? '0') ?> Siswa</td>
                            
                            <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                                <td style="text-align: right;">
                                    <a href="/kelas/edit?id=<?= $row['id'] ?>" class="g-btn-icon" title="Edit">✎</a>
                                    <form action="/kelas/delete?id=<?= $row['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kelas ini?');">
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
    <div class="g-pagination">
        <span>Hal <?= $result['page'] ?> dari <?= $result['pages'] ?></span>
        <?php if ($result['has_prev']): ?><a href="?page=<?= $result['page'] - 1 ?>" class="g-pagination-btn">❮</a><?php endif; ?>
        <?php if ($result['has_next']): ?><a href="?page=<?= $result['page'] + 1 ?>" class="g-pagination-btn">❯</a><?php endif; ?>
    </div>
    <?php endif; ?>
</div>
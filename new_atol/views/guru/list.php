<?php $pageTitle = 'Daftar Guru'; $activePage = 'guru'; ?>

<div class="g-list-card">
    <div class="g-list-header" style="flex-wrap: wrap; gap: 16px;">
        <h2 class="g-list-title">Tenaga Pengajar Aktif</h2>
        <div style="display: flex; gap: 12px; align-items: center;">
            <form action="/guru" method="GET" style="margin: 0; display: flex; gap: 8px;">
                <input type="text" name="search" class="g-input" placeholder="Cari nama / NIP..." value="<?= safe($search ?? '') ?>" style="height: 36px; min-height: 0; padding: 4px 16px; border-radius: 18px; border-color: #dadce0;">
                <button type="submit" class="g1-btn g1-btn-outline" style="height: 36px; padding: 0 16px; display: inline-flex; align-items: center; border-color: #dadce0; color: #5f6368;">Cari</button>
            </form>
            
            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                <a href="/guru/create" class="g1-btn g1-btn-primary" style="height: 36px; padding: 0 16px; display: inline-flex; align-items: center;">+ Tambah Guru</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="g-table-responsive">
        <table class="g-table">
            <thead>
                <tr>
                    <th>NIP/NIK</th>
                    <th>Nama Lengkap</th>
                    <th>L/P</th>
                    <th>No. Telepon</th>
                    <th>Bidang Studi</th>
                    <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                        <th style="text-align: right;">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($result['data'])): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 48px; color: #5f6368; font-size: 0.95rem;">
                            <i>Tidak ada data tenaga pengajar.</i>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($result['data'] as $row): ?>
                        <tr>
                            <td><?= safe($row['nip']) ?></td>
                            <td style="font-weight: 500; color: #1a73e8;"><div style="display:flex; align-items:center; gap:8px;"><div class="g1-dot green"></div><?= safe($row['nama']) ?></div></td>
                            <td><?= safe($row['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan') ?></td>
                            <td><?= safe($row['no_telepon']) ?></td>
                            <td><?= safe($row['bidang_studi']) ?></td>
                            
                            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                                <td style="text-align: right;">
                                    <a href="/guru/edit?id=<?= $row['id'] ?>" class="g-btn-icon" title="Edit">✎</a>
                                    <form action="/guru/delete?id=<?= $row['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
        <div style="display: flex; gap: 8px;">
            <?php if ($result['has_prev']): ?><a href="?page=<?= $result['page'] - 1 ?>&search=<?= urlencode($search ?? '') ?>" class="g-pagination-btn">❮</a><?php endif; ?>
            <?php if ($result['has_next']): ?><a href="?page=<?= $result['page'] + 1 ?>&search=<?= urlencode($search ?? '') ?>" class="g-pagination-btn">❯</a><?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
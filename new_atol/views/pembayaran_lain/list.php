<?php $pageTitle = 'Pembayaran Lain-lain'; $activePage = 'pembayaran-lain'; ?>

<div class="g-list-card">
    <div class="g-list-header">
        <h2 class="g-list-title">Master Data Pembayaran Lain</h2>
        <div style="display: flex; gap: 12px;">
            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                <a href="/pembayaran-lain/create" class="g1-btn g1-btn-primary" style="padding: 8px 16px; height: 36px; display: inline-flex; align-items: center;">+ Kategori Pembayaran Baru</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="g-table-responsive">
        <table class="g-table">
            <thead>
                <tr>
                    <th>Nama Pembayaran</th>
                    <th>Deskripsi</th>
                    <th>Nominal (Rp)</th>
                    <th>Tenggat Waktu</th>
                    <th>Denda / Hari (Rp)</th>
                    <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                        <th style="text-align: right;">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($result['data'])): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 48px; color: #5f6368;"><i>Tidak ada data master pembayaran lain.</i></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($result['data'] as $row): ?>
                        <tr>
                            <td style="font-weight: 500;"><span class="g-badge g-badge-info"><?= safe($row['nama_pembayaran']) ?></span></td>
                            <td style="color: #5f6368; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= safe($row['deskripsi']) ?></td>
                            <td style="color: #d93025; font-weight: 500;"><?= number_format($row['nominal'], 0, ',', '.') ?></td>
                            <td><?= $row['tanggal_berakhir'] ? date('d M Y', strtotime($row['tanggal_berakhir'])) : '-' ?></td>
                            <td><?= $row['denda_per_hari'] > 0 ? number_format($row['denda_per_hari'], 0, ',', '.') : '-' ?></td>
                            
                            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                                <td style="text-align: right;">
                                    <a href="/pembayaran-lain/edit?id=<?= $row['id'] ?>" class="g-btn-icon" title="Edit Master Data">✎</a>
                                    <form action="/pembayaran-lain/delete?id=<?= $row['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Nonaktifkan kategori pembayaran ini?');">
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
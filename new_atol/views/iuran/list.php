<?php $pageTitle = 'Pembayaran SPP / Iuran'; $activePage = 'iuran'; ?>

<div class="g-list-card">
    <div class="g-list-header" style="flex-wrap: wrap; gap: 16px;">
        <h2 class="g-list-title">Catatan SPP & Iuran Sekolah</h2>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <form action="/iuran" method="GET" style="margin: 0; display: flex; gap: 8px;">
                <input type="text" name="search" class="g-input" placeholder="Cari nama siswa..." value="<?= safe($search ?? '') ?>" style="height: 36px; min-height: 0; padding: 4px 16px; border-radius: 18px; border-color: #dadce0;">
                <select name="status" class="g-input" style="height: 36px; min-height: 0; padding: 4px 32px 4px 16px; border-radius: 18px; border-color: #dadce0;">
                    <option value="">Semua Status</option>
                    <option value="LUNAS" <?= ($status ?? '') === 'LUNAS' ? 'selected' : '' ?>>Lunas</option>
                    <option value="BELUM_LUNAS" <?= ($status ?? '') === 'BELUM_LUNAS' ? 'selected' : '' ?>>Belum Lunas</option>
                </select>
                <button type="submit" class="g1-btn g1-btn-outline" style="height: 36px; padding: 0 16px; display: inline-flex; align-items: center; border-color: #dadce0; color: #5f6368;">Filter</button>
            </form>
            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                <a href="/iuran/create" class="g1-btn g1-btn-primary" style="height: 36px; padding: 0 16px; display: inline-flex; align-items: center;">+ Buat Tagihan</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="g-table-responsive">
        <table class="g-table">
            <thead>
                <tr>
                    <th>Periode Bulan</th>
                    <th>Nama Siswa</th>
                    <th>Nominal Tagihan</th>
                    <th>Status Bayar</th>
                    <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                        <th style="text-align: right;">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($result['data'])): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 48px; color: #5f6368;"><i>Catatan iuran kosong.</i></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($result['data'] as $row): 
                        $isLunas = $row['status'] === 'LUNAS';
                    ?>
                        <tr style="<?= $isLunas ? 'opacity: 0.7;' : '' ?>">
                            <td><strong><?= safe($row['bulan']) ?> <?= safe($row['tahun']) ?></strong></td>
                            <td style="color: #1a73e8;"><?= safe($row['siswa_nama']) ?></td>
                            <td>Rp <?= number_format($row['nominal'], 0, ',', '.') ?></td>
                            <td><span class="g-badge <?= $isLunas ? 'g-badge-success' : 'g-badge-danger' ?>"><?= safe($row['status']) ?></span></td>
                            
                            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                                <td style="text-align: right;">
                                    <?php if (!$isLunas): ?>
                                        <a href="/iuran/pay?id=<?= $row['id'] ?>" class="g1-btn g1-btn-primary" style="padding: 4px 12px; font-size: 0.8rem;">Terima Bayar</a>
                                    <?php else: ?>
                                        <a href="/iuran/print?id=<?= $row['id'] ?>" class="g-btn-icon" title="Cetak Kuitansi">🖨</a>
                                    <?php endif; ?>
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
            <?php if ($result['has_prev']): ?><a href="?page=<?= $result['page'] - 1 ?>&search=<?= urlencode($search ?? '') ?>&status=<?= urlencode($status ?? '') ?>" class="g-pagination-btn">❮</a><?php endif; ?>
            <?php if ($result['has_next']): ?><a href="?page=<?= $result['page'] + 1 ?>&search=<?= urlencode($search ?? '') ?>&status=<?= urlencode($status ?? '') ?>" class="g-pagination-btn">❯</a><?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
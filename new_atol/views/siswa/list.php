<?php $pageTitle = 'Daftar Siswa'; $activePage = 'siswa'; ?>

<div class="g-list-card">
    <div class="g-list-header" style="flex-wrap: wrap; gap: 16px;">
        <h2 class="g-list-title">Data Siswa Aktif</h2>
        <div style="display: flex; gap: 12px; align-items: center;">
            <!-- Form Pencarian -->
            <form action="/siswa" method="GET" style="margin: 0; display: flex; gap: 8px;">
                <input type="text" name="search" class="g-input" placeholder="Cari nama / NIS..." value="<?= safe($search ?? '') ?>" style="height: 36px; min-height: 0; padding: 4px 16px; border-radius: 18px; border-color: #dadce0;">
                <button type="submit" class="g1-btn g1-btn-outline" style="height: 36px; padding: 0 16px; display: inline-flex; align-items: center; border-color: #dadce0; color: #5f6368;">Cari</button>
            </form>
            
            <!-- Tombol Tambah (Hanya Admin & Tata Usaha) -->
            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                <a href="/siswa/create" class="g1-btn g1-btn-primary" style="height: 36px; padding: 0 16px; display: inline-flex; align-items: center;">+ Tambah Siswa</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="g-table-responsive">
        <table class="g-table">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>L/P</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                        <th style="text-align: right;">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($result['data'])): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 48px; color: #5f6368; font-size: 0.95rem;">
                            <i>Tidak ada data siswa yang ditemukan.</i>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($result['data'] as $row): 
                        // Mencari Nama Kelas
                        $namaKelas = '-';
                        foreach ($kelas_list as $k) {
                            if ($k['id'] == $row['kelas_id']) {
                                $namaKelas = $k['nama_kelas'];
                                break;
                            }
                        }
                        $jk = $row['jenis_kelamin'] === 'L' ? 'Laki-laki' : ($row['jenis_kelamin'] === 'P' ? 'Perempuan' : '-');
                        $badgeClass = $row['status'] === 'AKTIF' ? 'g-badge-success' : 'g-badge-danger';
                    ?>
                        <tr>
                            <td><?= safe($row['no_induk']) ?></td>
                            <td style="font-weight: 500; color: #1a73e8;"><?= safe($row['nama']) ?></td>
                            <td><?= safe($jk) ?></td>
                            <td><?= safe($namaKelas) ?></td>
                            <td><span class="g-badge <?= $badgeClass ?>"><?= safe($row['status']) ?></span></td>
                            
                            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'TATA_USAHA'])): ?>
                                <td style="text-align: right;">
                                    <a href="/siswa/edit?id=<?= $row['id'] ?>" class="g-btn-icon" title="Edit Data">✎</a>
                                    <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
                                        <form action="/siswa/delete?id=<?= $row['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus permanen data siswa ini?');">
                                            <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                                            <button type="submit" class="g-btn-icon delete" title="Hapus Data">🗑</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginasi Ala Material -->
    <?php if ($result['pages'] > 1): ?>
    <div class="g-pagination">
        <span>Menampilkan halaman <?= $result['page'] ?> dari <?= $result['pages'] ?> (Total <?= $result['total'] ?> Siswa)</span>
        <div style="display: flex; gap: 8px;">
            <?php if ($result['has_prev']): ?>
                <a href="?page=<?= $result['page'] - 1 ?><?= $search ? '&search='.urlencode($search) : '' ?>" class="g-pagination-btn" title="Halaman Sebelumnya">❮</a>
            <?php endif; ?>
            
            <?php if ($result['has_next']): ?>
                <a href="?page=<?= $result['page'] + 1 ?><?= $search ? '&search='.urlencode($search) : '' ?>" class="g-pagination-btn" title="Halaman Selanjutnya">❯</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
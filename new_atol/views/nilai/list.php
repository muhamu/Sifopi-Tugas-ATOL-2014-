<?php $pageTitle = 'Rekapitulasi Nilai'; $activePage = 'nilai'; ?>

<div class="g-list-card">
    <div class="g-list-header">
        <h2 class="g-list-title">Rekapitulasi Nilai Siswa</h2>
        <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'GURU'])): ?>
            <a href="/nilai/create" class="g1-btn g1-btn-primary" style="padding: 8px 16px; height: 36px; display: inline-flex; align-items: center;">+ Input Nilai</a>
        <?php endif; ?>
    </div>

    <div class="g-table-responsive">
        <table class="g-table">
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Akhir (Grade)</th>
                    <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'GURU'])): ?>
                        <th style="text-align: right;">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($result['data'])): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 48px; color: #5f6368;"><i>Belum ada nilai yang diinput.</i></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($result['data'] as $row): ?>
                        <tr>
                            <td style="font-weight: 500; color: #1a73e8;"><?= safe($row['nama_siswa']) ?></td>
                            <td><?= safe($row['mata_pelajaran']) ?> <span style="color:#5f6368; font-size:0.85em;">(Kelas <?= safe($row['nama_kelas']) ?>)</span></td>
                            <td><?= safe($row['tugas'] ?? '-') ?></td>
                            <td><?= safe($row['uts'] ?? '-') ?></td>
                            <td><?= safe($row['uas'] ?? '-') ?></td>
                            <td>
                                <strong><?= safe($row['rata_rata'] ?? '-') ?></strong> 
                                <span class="g-badge <?= ($row['grade'] ?? '') == 'A' ? 'g-badge-success' : 'g-badge-warning' ?>"><?= safe($row['grade'] ?? '-') ?></span>
                            </td>
                            
                            <?php if (in_array($_SESSION['user']['role'], ['ADMIN', 'GURU'])): ?>
                                <td style="text-align: right;">
                                    <a href="/nilai/edit?id=<?= $row['id'] ?>" class="g-btn-icon" title="Edit">✎</a>
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
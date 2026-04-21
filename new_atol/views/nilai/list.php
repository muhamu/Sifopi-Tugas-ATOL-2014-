<?php $pageTitle = 'Daftar Nilai'; $activePage = 'nilai'; ?>

<div class="page-header" style="display:flex;justify-content:space-between;align-items:center;">
    <div>
        <h1 class="page-title">Daftar Nilai</h1>
        <p class="page-subtitle">Data nilai akademik siswa</p>
    </div>
    <?php if (in_array($_SESSION['user']['role'], ['ADMIN','GURU'])): ?>
        <a href="/nilai/create" class="btn btn-secondary">+ Input Nilai</a>
    <?php endif; ?>
</div>

<?php if (!empty($result['data'])): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Siswa</th><th>Mata Pelajaran</th><th>Kelas</th><th>Smt</th><th>Tugas</th><th>UTS</th><th>UAS</th><th>Rata-rata</th><th>Grade</th><th style="width:100px;">Aksi</th></tr>
            </thead>
            <tbody>
                <?php foreach ($result['data'] as $n):
                    $grade = $n['grade'] ?? '-';
                    $gc = in_array($grade,['A','A+']) ? 'success' : (in_array($grade,['B','B+']) ? 'primary' : (in_array($grade,['C','C+']) ? 'warning' : 'secondary'));
                ?>
                    <tr>
                        <td><?= safe($n['nama_siswa'] ?? '-') ?><br><small><?= safe($n['no_induk'] ?? '') ?></small></td>
                        <td><?= safe($n['mata_pelajaran'] ?? '-') ?></td>
                        <td><?= safe($n['nama_kelas'] ?? '-') ?></td>
                        <td><?= safe($n['semester']) ?></td>
                        <td><?= $n['tugas'] !== null ? number_format($n['tugas'],1) : '-' ?></td>
                        <td><?= $n['uts'] !== null ? number_format($n['uts'],1) : '-' ?></td>
                        <td><?= $n['uas'] !== null ? number_format($n['uas'],1) : '-' ?></td>
                        <td><strong><?= $n['rata_rata'] !== null ? number_format($n['rata_rata'],1) : '-' ?></strong></td>
                        <td><span class="badge badge-<?= $gc ?>"><?= safe($grade) ?></span></td>
                        <td class="table-actions">
                            <?php if (in_array($_SESSION['user']['role'], ['ADMIN','GURU'])): ?>
                            <a href="/nilai/edit?id=<?= $n['id'] ?>" class="btn btn-small action-edit">Edit</a>
                            <form method="POST" action="/nilai/delete?id=<?= $n['id'] ?>" style="display:inline;" onsubmit="return confirm('Hapus nilai ini?')">
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
            <?php if ($result['has_prev']): ?><li><a href="/nilai?page=<?= $result['page']-1 ?>">← Prev</a></li><?php endif; ?>
            <?php for ($i = max(1,$result['page']-2); $i <= min($result['pages'],$result['page']+2); $i++): ?>
                <li><?php if ($i===$result['page']): ?><span class="active"><?= $i ?></span><?php else: ?><a href="/nilai?page=<?= $i ?>"><?= $i ?></a><?php endif; ?></li>
            <?php endfor; ?>
            <?php if ($result['has_next']): ?><li><a href="/nilai?page=<?= $result['page']+1 ?>">Next →</a></li><?php endif; ?>
        </ul></div>
    <?php endif; ?>
<?php else: ?>
    <div class="empty-state">
        <div class="empty-state-icon">📝</div>
        <h3 class="empty-state-title">Belum Ada Data Nilai</h3>
        <?php if (in_array($_SESSION['user']['role'], ['ADMIN','GURU'])): ?>
            <a href="/nilai/create" class="btn btn-primary">+ Input Nilai</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

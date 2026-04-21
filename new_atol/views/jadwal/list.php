<?php $pageTitle = 'Jadwal Pelajaran'; $activePage = 'jadwal';
$hariList = ['SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU'];
$byHari = [];
foreach ($result as $j) $byHari[$j['hari']][] = $j;
?>

<div class="page-header">
    <h1 class="page-title">Jadwal Pelajaran</h1>
    <p class="page-subtitle">Jadwal kegiatan belajar mengajar</p>
</div>

<?php if (!empty($byHari)): ?>
    <?php foreach ($hariList as $hari): if (empty($byHari[$hari])) continue; ?>
        <div class="card" style="margin-bottom:16px;">
            <div class="card-header"><h3 class="card-title"><?= $hari ?></h3></div>
            <div class="card-body" style="padding:0;">
                <table class="table" style="margin:0;">
                    <thead>
                        <tr><th>Jam</th><th>Mata Pelajaran</th><th>Kelas</th><th>Guru</th><th>Ruangan</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($byHari[$hari] as $j): ?>
                            <tr>
                                <td><?= safe($j['jam_mulai']) ?> – <?= safe($j['jam_selesai']) ?></td>
                                <td><?= safe($j['mata_pelajaran'] ?? '-') ?></td>
                                <td><?= safe($j['nama_kelas'] ?? '-') ?></td>
                                <td><?= safe($j['nama_guru'] ?? '-') ?></td>
                                <td><?= safe($j['ruangan'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="empty-state">
        <div class="empty-state-icon">🗓️</div>
        <h3 class="empty-state-title">Belum Ada Jadwal</h3>
        <p class="empty-state-text">Data jadwal pelajaran belum tersedia</p>
    </div>
<?php endif; ?>

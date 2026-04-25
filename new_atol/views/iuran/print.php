<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi Pembayaran SPP - <?= safe($spp['siswa_nama']) ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; color: #333; line-height: 1.6; }
        .receipt-container { max-width: 800px; margin: 40px auto; padding: 40px; border: 1px solid #ccc; position: relative; }
        .receipt-header { display: flex; justify-content: space-between; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 20px; }
        .receipt-title { font-size: 24px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .school-name { font-size: 18px; font-weight: bold; }
        .details-grid { display: grid; grid-template-columns: 180px 1fr; gap: 12px; margin-bottom: 30px; font-size: 15px; }
        .total-box { background: #f1f3f4; padding: 20px; font-size: 20px; font-weight: bold; text-align: center; border: 1px solid #dadce0; border-radius: 4px; }
        .signature { margin-top: 60px; display: flex; justify-content: flex-end; text-align: center; }
        .stamp { margin-top: 80px; border-top: 1px solid #333; width: 200px; padding-top: 10px; font-weight: bold; }
        @media print { body { -webkit-print-color-adjust: exact; } .no-print { display: none; } .receipt-container { border: none; margin: 0; padding: 0; } }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt-container">
        <div class="no-print" style="margin-bottom: 20px; text-align: right;">
            <button onclick="window.history.back()" style="padding: 10px 20px; background: #fff; color: #333; border: 1px solid #ccc; border-radius: 4px; cursor: pointer; margin-right: 8px;">Kembali</button>
            <button onclick="window.print()" style="padding: 10px 20px; background: #1a73e8; color: #fff; border: none; border-radius: 4px; cursor: pointer;">🖨 Cetak Sekarang</button>
        </div>

        <div class="receipt-header">
            <div>
                <div class="school-name"><?= safe(SCHOOL_NAME) ?></div>
                <div style="font-size: 14px; color: #666; max-width: 250px;"><?= safe(SCHOOL_ADDRESS) ?></div>
            </div>
            <div style="text-align: right;">
                <div class="receipt-title">Kuitansi Resmi</div>
                <div style="color: #5f6368;">No. Ref: INV/<?= date('Ymd', strtotime($spp['tanggal_bayar'] ?? 'now')) ?>/<?= str_pad($spp['id'], 5, '0', STR_PAD_LEFT) ?></div>
            </div>
        </div>

        <div class="details-grid">
            <strong>Telah terima dari</strong><span>: <?= safe($spp['siswa_nama']) ?> (NIS: <?= safe($spp['no_induk']) ?>)</span>
            <strong>Uang sejumlah</strong><span>: <i>Rp <?= number_format($spp['nominal'], 0, ',', '.') ?>,-</i></span>
            <strong>Untuk Pembayaran</strong><span>: Iuran SPP Bulan <?= safe($spp['bulan']) ?> Tahun <?= safe($spp['tahun']) ?></span>
            <strong>Metode Pembayaran</strong><span>: <?= safe($spp['metode_bayar'] ?? 'TUNAI') ?></span>
        </div>

        <div class="total-box">
            TOTAL PEMBAYARAN LUNAS: Rp <?= number_format($spp['nominal'], 0, ',', '.') ?>,-
        </div>

        <div class="signature">
            <div>
                <p>Bandung, <?= date('d F Y', strtotime($spp['tanggal_bayar'] ?? 'now')) ?></p>
                <p>Penerima / Tata Usaha,</p>
                <div class="stamp">
                    <?= safe($_SESSION['user']['fullname'] ?? 'Admin') ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
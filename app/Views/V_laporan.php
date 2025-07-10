<h3 style="text-align:center;">Laporan Pendapatan</h3>
<p style="text-align:center;">Periode: <?= esc($tanggal_awal) ?> s/d <?= esc($tanggal_akhir) ?></p>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>User</th>
            <th>Total Harga</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php if (!empty($pendapatan)) : ?>
            <?php foreach ($pendapatan as $i => $row) : ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><?= $row['username'] ?? '-' ?></td>
                    <td><?= number_format($row['total_harga'],0,',','.') ?></td>
                    <td><?= ($row['status'] == 3 ? 'Paid' : '-') ?></td>
                </tr>
                <?php $total += $row['total_harga']; ?>
            <?php endforeach; ?>
            <tr style="background:#fff8dc;font-weight:bold;">
                <td colspan="4">Total Pendapatan</td>
                <td colspan="2"><?= number_format($total,0,',','.') ?></td>
            </tr>
        <?php else: ?>
            <tr><td colspan="6" style="text-align:center;">Tidak ada data</td></tr>
        <?php endif; ?>
    </tbody>
</table>

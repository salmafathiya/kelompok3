<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h3>Laporan Pendapatan</h3>
<hr>
<form method="get" class="row g-3 mb-3">
    <div class="col-md-3">
        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
        <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= esc($_GET['tanggal_awal'] ?? date('Y-m-d')) ?>">
    </div>
    <div class="col-md-3">
        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= esc($_GET['tanggal_akhir'] ?? date('Y-m-d')) ?>">
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <a href="<?= base_url('laporan/pendapatan/pdf?tanggal_awal=' . esc($_GET['tanggal_awal'] ?? date('Y-m-d')) . '&tanggal_akhir=' . esc($_GET['tanggal_akhir'] ?? date('Y-m-d'))) ?>" target="_blank" class="btn btn-danger me-2">Cetak PDF</a>
        <a href="<?= base_url('laporan/pendapatan/excel?tanggal_awal=' . esc($_GET['tanggal_awal'] ?? date('Y-m-d')) . '&tanggal_akhir=' . esc($_GET['tanggal_akhir'] ?? date('Y-m-d'))) ?>" target="_blank" class="btn btn-success">Export Excel</a>
    </div>
</form>
<div class="table-responsive">
    <table class="table table-bordered">
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
                        <td><?= number_to_currency($row['total_harga'], 'IDR') ?></td>
                        <td><?= ($row['status'] == 3 ? 'Paid' : '-') ?></td>
                    </tr>
                    <?php $total += $row['total_harga']; ?>
                <?php endforeach; ?>
                <tr style="background:#fff8dc;font-weight:bold;">
                    <td colspan="4">Total Pendapatan</td>
                    <td colspan="2"><?= number_to_currency($total, 'IDR') ?></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<strong>History Transaksi</strong>
<hr>

<a href="<?= base_url('transaksi/download') ?>" class="btn btn-success">
    Cetak Data Transaksi
</a>

<div class="table-responsive">
    <!-- Table with stripped rows -->
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Alamat</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Ongkir</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            if (!empty($transactions)) :
                foreach ($transactions as $index => $item) :
            ?>
                    <tr>
                        <th scope="row"><?php echo $counter++ ?></th>
                        <td><?php echo $item['username'] ?></td>
                        <td><?php echo $item['alamat'] ?></td>
                        <td><?php echo number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?php echo $item['ongkir'] ?></td>
                        <td><?php echo [
                                0 => 'Menunggu Pembayaran',
                                1 => 'Sudah Dibayar',
                                2 => 'Sedang Dikirim',
                                3 => 'Sudah Selesai',
                                4 => 'Dibatalkan'
                                ][$item['status']] ?? 'Status Tidak Diketahui' ?></td>
                        <td><?php echo $item['created_at'] ?></td>
                    </tr>
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
</div>

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours();
            document.getElementById("menit").innerHTML = waktu.getMinutes();
            document.getElementById("detik").innerHTML = waktu.getSeconds();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

<?= $this->endSection() ?>
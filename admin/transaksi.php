<div class="container mt-3">
    <h2 class="display-5">Daftar Transaksi</h2>
    <hr>
    <?php
    $querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
    $resulttransaksi = mysqli_fetch_all($querytransaksi, MYSQLI_ASSOC);
    $hasil = [];
    foreach ($resulttransaksi as $value) {
        $hasil[] = $value;
    }
    $reversehasil = array_reverse($hasil);
    ?>
    <?php foreach ($reversehasil as $value) : ?>
        <div class="row text-center" style="background-color: white; margin: 10px 0; padding: 10px; border-radius: 10px;">
            <div class="col-6 col-md-2" style="display: flex;">
                <p style="margin: 0; margin-left: 10px;"><?= $value["tanggal"]; ?></p>
            </div>
            <div class="col-6 col-md-2">
                <p style="margin: 0;"><?= $value["no_invoice"]; ?></p>
            </div>
            <?php
            $warna_status = 'null';
            if ($value["status_pengiriman"] == "Belum Dibayar") {
                $warna_status = "danger";
            } elseif ($value["status_pengiriman"] == "Sudah Dibayar") {
                $warna_status = "warning";
            } elseif ($value["status_pengiriman"] == "Sedang Diproses") {
                $warna_status = "info";
            } elseif ($value["status_pengiriman"] == "Selesai") {
                $warna_status = "success";
            }
            ?>
            <div class="col-6 col-md-2">
                <p class="bg-<?= $warna_status; ?>" style=" padding: 5px 5px;  border-radius: 5px; margin: 0; color: white;"><?= $value["status_pengiriman"]; ?></p>
            </div>
            <div class="col-6 col-md-3">
                <?php
                $id_pelanggan = $value['id_pelanggan'];
                $querypelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
                $resultpelanggan = mysqli_fetch_assoc($querypelanggan);
                ?>
                <p style="margin: 0;"><?= $value['nama_penerima']; ?></p>
            </div>
            <div class="col-6 col-md-2">
                <p style="margin: 0;">Rp<?= number_format($value['jumlah_harga'], 0, '', '.'); ?></p>
            </div>
            <div class="col-md-1">
                <a class="btn btn-link btn-sm" href="index.php?halaman=transaksiproduk&id=<?= $value['id_transaksi']; ?>">Detail</a>
            </div>

        </div>
    <?php endforeach; ?>


</div>
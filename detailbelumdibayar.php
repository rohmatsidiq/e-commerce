<?php 
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$id_transaksi = $_GET["id"];

$querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
$resulttransaksi = mysqli_fetch_assoc($querytransaksi);
?>


<div class=" mt-3 mb-3" style="width: 100%;">
    <h2 class="text-success">Detail Pesanan</h2>
    <div style="display: flex; justify-content: space-between;">
        <div>
            <div>
                <small>Penerima : <?= $resulttransaksi['nama_penerima']; ?></small>
            </div>
            <div>
                <small>No HP : <?= $resulttransaksi['no_hp']; ?></small>
            </div>
            <div>
                <small>Alamat pengiriman:</small>
            </div>
            <div>
                <small><?= $resulttransaksi['alamat_pengiriman']; ?></small>
            </div>
        </div>
        <div style="text-align: end;">
            <div>
                <small style="margin: 0;"><?= $resulttransaksi['tanggal']; ?></small>
            </div>
            <div>
                <small style="margin: 0;"><?= $resulttransaksi['no_invoice']; ?></small>
            </div>
        </div>
    </div>

    <?php 
    $querytransaksiproduk = mysqli_query($koneksi, "SELECT * FROM transaksi_produk WHERE id_transaksi='$id_transaksi'");
    $resulttransaksiproduk = mysqli_fetch_all($querytransaksiproduk, MYSQLI_ASSOC);
    ?>

    <?php foreach ($resulttransaksiproduk as $value) : ?>
        <?php
        $id_produk = $value['id_produk'];
        $queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
        $resultproduk = mysqli_fetch_assoc($queryproduk);
        ?>
        <div class="row" style="background-color: white; margin: 10px 0; padding: 5px; border-radius: 10px;">
            <div class="col-2 col-md-1">
                <img src="./fotoproduk/<?= $resultproduk['gambar_produk']; ?>" style="width: 100%;" alt="">
            </div>
            <div class="col-6 col-md-8">
                <p class="text-success" style="font-weight: bold; margin: 0;"><?= $value['nama_produk']; ?></p>
                <small style="margin: 0;"><?= $value['jumlah_produk']; ?> x Rp<?= number_format($value['harga_produk'], 0, '', '.'); ?></small>
            </div>
            <div class="col-4 col-md-3">
                <p style="margin: 0; text-align: end;">Rp<?= number_format($value['sub_total_harga'], 0, '', '.'); ?></p>
            </div>
        </div>
    <?php endforeach ?>
    <div class="row" style="margin: 0; padding: 5px 10px;">
        <div class="col-8" style="margin: 0;">
            <p style="margin: 0; text-align: end;">Total harga produk</p>
        </div>
        <div class="col-4" style="margin: 0;">
            <p style="margin: 0; text-align: end;">Rp<?= number_format($resulttransaksi['jumlah_harga'], 0, '', '.'); ?></p>
        </div>
    </div>
    <div class="row" style="margin: 0; padding: 5px 10px;">
        <div class="col-8" style="margin: 0;">
            <p style="margin: 0; text-align: end;">Ongkos kirim <?= $resulttransaksi['ekspedisi']; ?></p>
        </div>
        <div class="col-4" style="margin: 0;">
            <p style="margin: 0; text-align: end;">Rp<?= number_format($resulttransaksi['ongkir'], 0, '', '.'); ?></p>
        </div>
    </div>
    <div class="row" style="margin: 0; padding: 5px 10px;">
        <div class="col-8" style="margin: 0;">
            <p style="margin: 0; text-align: end; font-weight: bold;">Total pesanan</p>
        </div>
        <div class="col-4" style="margin: 0;">
            <?php $totalpesanan = $resulttransaksi['jumlah_harga'] + $resulttransaksi['ongkir'] ?>
            <p style="margin: 0; text-align: end; font-weight: bold;">Rp<?= number_format($totalpesanan, 0, '', '.'); ?></p>
        </div>
    </div>
    <div class="alert alert-success mt-3" role="alert">
        <div class="row">
            <div class="col-6" style="text-align: left;">
                <smal style="margin: 0;">No rekening kami</smal>
                <p style="margin: 0;">BSI : 8945885329583</p>
                <p style="margin: 0;">BCA : 3343202955</p>
                <p style="margin: 0;">BNI : 88750049211</p>
            </div>
            <div class="col-6" style="text-align: end;">
                <p style="margin: 0;">Silahkan lakukan pembayaran sebesar </p>
                <h5 style="font-weight: bold;">Rp<?= number_format($totalpesanan, 0, '', '.'); ?></h5>
            </div>
        </div>
    </div>
    <div style="display: flex; justify-content: end;">
        <a class="btn btn-success" href="konfirmasi.php?id=<?= $id_transaksi; ?>">Konfirmasi Pembayaran</a>
    </div>
</div>
<?php

session_start();
include "koneksi.php";
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>location='login.php'</script>";
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$querykeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
$resultkeranjang = mysqli_fetch_all($querykeranjang, MYSQLI_ASSOC);
$ada = mysqli_num_rows($querykeranjang);

$stock_ready = true;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
        a {
            text-decoration: none;
            color: black;
        }
    </style>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body style="background-color: whitesmoke;">

    <!-- NAVIGASI -->
    <?php include('navigasi.php') ?>

    <div class="container mt-3 mb-3" style=" width: 100vw; min-height: 100vh;">
        <h3>Keranjang Belanja</h3>
        <?php $totalharga = 0; ?>
        <?php $totalberat = 0; ?>
        <?php if ($ada > 0) { ?>
            <div class="row">
                <?php foreach ($resultkeranjang as $value) : ?>
                    <?php
                    $id_produk = $value["id_produk"];
                    $queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                    $resultproduk = mysqli_fetch_assoc($queryproduk);
                    ?>
                    <div class="col-12" style=" background-color: white; margin: 5px 0; padding: 20px; border-radius: 10px;">
                        <div class="row">
                            <div class="col-4 col-md-1">
                                <img src="./fotoproduk/<?= $resultproduk['gambar_produk']; ?>" width="100%" alt="">
                            </div>
                            <div class="col-8 col-md-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p style="font-weight: bold; margin-bottom: 3px;"><?= $resultproduk['nama_produk']; ?></p>
                                        <p style="margin: 0;">Jumlah : <?= $value["jumlah_produk"]; ?> pcs</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p style="margin: 0;">Berat : <?= number_format($resultproduk["berat_produk"]); ?> gr</p>
                                        <?php $subtotalberat = $resultproduk['berat_produk'] * $value["jumlah_produk"] ?>
                                        <p style="margin: 0;">Sub-Berat : <?= $subtotalberat; ?> gr</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p style="margin: 0;">Harga : Rp<?= number_format($resultproduk['harga_produk'], 0, '', '.'); ?></p>
                                        <?php $subharga = $resultproduk["harga_produk"] * $value['jumlah_produk'] ?>
                                        <p style="margin: 0;">Sub-Harga : Rp<?= number_format($subharga, 0, '', '.'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-1 text-center">
                                <a class="btn text-success" href="tambahitem.php?id=<?= $id_produk; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg>
                                </a>
                                <a class="btn text-success" href="kurangiitem.php?id=<?= $id_produk; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <?php if ($resultproduk['stock_produk'] <= 0) : ?>
                            <div class="alert alert-warning mb-0" role="alert">
                                <p style="margin: 0;">Produk Kosong</p>
                            </div>
                            <?php $stock_ready = false; ?>
                        <?php endif ?>
                    </div>
                    <?php $totalharga += $subharga ?>
                    <?php $totalberat += $subtotalberat ?>
                <?php endforeach ?>

                <div class="alert alert-success mt-3" role="alert">
                    <p>Total harga : <strong>Rp<?= number_format($totalharga, 0, '', '.'); ?></strong></p>
                    <p>Total berat : <strong><?= number_format($totalberat, 0, '', '.'); ?> gr</strong></p>
                </div>
                <?php if ($stock_ready) : ?>
                    <div style="display: flex; justify-content: end;">
                        <a style="margin: 0;" class="btn btn-success" href="checkout.php?key=true">Checkout</a>
                    </div>
                <?php else : ?>
                    <div style="display: flex; justify-content: end;">
                        <p name="lanjutkan" class="btn btn-success">Tidak Bisa Checkout</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                Keranjang Belanja Anda Kosong
            </div>
        <?php } ?>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php') ?>

    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
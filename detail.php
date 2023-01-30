<?php

session_start();
include "koneksi.php";
$id = $_GET["id"];
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id'");
$result = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko</title>
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

    <div class="container mt-3" style="width: 100vw; min-height: 100vh;">
        <div class="row" style="background-color: white; padding: 20px; border-radius: 10px;">
            <div class="col-12 col-md-6">
                <img style="width: 100%;" src="./fotoproduk/<?= $result['gambar_produk']; ?>" alt="<?= $result['nama_produk']; ?>">
            </div>
            <div class="col-12 col-md-6">
                <h3 class="text-success"><?= $result['nama_produk']; ?></h3>
                <p style="margin: 0;">Rp<?= number_format($result['harga_produk'], 0, '', '.'); ?></p>
                <div>
                    <small>Stock : <?= $result['stock_produk']; ?></small>
                </div>
                <?php if ($result['stock_produk'] >= 1) { ?>
                    <a class="btn btn-outline-success mt-2" href="add.php?id=<?= $id; ?>">Add to cart</a>
                <?php } else if ($result['stock_produk'] <= 0) { ?>
                    <p class="btn btn-outline-success mt-2">STOCK HABIS</p>
                <?php } ?>
                <p class="mt-2"><?= $result['deskripsi_produk']; ?></p>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php') ?>

    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
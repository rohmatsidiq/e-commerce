<?php

session_start();
include "koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM produk");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

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
</head>

<body style="background-color: whitesmoke;">
    <!-- NAVIGASI -->
    <?php include('navigasi.php') ?>

    <div class="container mt-3" style="width: 100vw; min-height: 100vh;">
        <h1>Produk</h1>

        <div class="row">
            <?php foreach ($result as $key => $value) : ?>
                <div data-aos="zoom-out-right" class="col-6 col-md-3" style=" padding: 5px;">
                    <div style="background-color: white; padding: 20px; border-radius: 10px;">
                        <a href="detail.php?id=<?= $value['id_produk']; ?>">
                            <img src="./fotoproduk/<?= $value['gambar_produk']; ?>" style="width: 100%;" alt="">
                            <h5><?= $value['nama_produk']; ?></h5>
                            <p style="margin: 0;">Harga : Rp<?= number_format($value['harga_produk'], 0, '', '.'); ?></p>
                            <div>
                                <small>Stock : <?= $value["stock_produk"]; ?></small>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    
    <!-- FOOTER -->
    <?php include 'footer.php' ?>

    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
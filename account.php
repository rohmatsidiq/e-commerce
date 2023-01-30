<?php
session_start();
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>location='login.php'</script>";
}
include('koneksi.php');
$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

$querypelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$resultpelanggan = mysqli_fetch_assoc($querypelanggan);

// user upload foto profil
if (empty($resultpelanggan["foto_profil"])) {
    $fotoprofil = "rohmat.jpg";
} else {
    $fotoprofil = $resultpelanggan["foto_profil"];
}

if (!isset($_GET["halaman"]) || $_GET["halaman"] == "belumdibayar" || $_GET["halaman"] == "detailbelumdibayar") {
    $warnabelumdibayar = "danger";
    $warnasedangdiproses = "outline-secondary";
    $warnasedangdipacking = "outline-secondary";
    $warnasudahdikirim = "outline-secondary";
} else if ($_GET["halaman"] == "sedangdiproses") {
    $warnabelumdibayar = "outline-secondary";
    $warnasedangdiproses = "warning";
    $warnasedangdipacking = "outline-secondary";
    $warnasudahdikirim = "outline-secondary";
} else if ($_GET["halaman"] == "sedangdipacking") {
    $warnabelumdibayar = "outline-secondary";
    $warnasedangdiproses = "outline-secondary";
    $warnasedangdipacking = "info";
    $warnasudahdikirim = "outline-secondary";
} else if ($_GET["halaman"] == "sudahdikirim") {
    $warnabelumdibayar = "outline-secondary";
    $warnasedangdiproses = "outline-secondary";
    $warnasedangdipacking = "outline-secondary";
    $warnasudahdikirim = "success";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
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

    <div class="container mt-3" style="min-height: 100vh;">
        <div class="row">
            <div class="col -4col-md-2 p-4">
                <img style="width: 100%; border-radius: 100%;" src="./fotoprofil/<?= $fotoprofil; ?>" alt="">
            </div>
            <div class="col-8 col-md-10 p-3">
                <h3><?= $resultpelanggan["nama_pelanggan"]; ?></h3>
                <p style="margin: 0;"><?= $resultpelanggan["email_pelanggan"]; ?></p>
                <p style="margin: 0;"><?= $resultpelanggan["alamat_pelanggan"]; ?></p>
                <p style="margin: 0;"><?= $resultpelanggan["no_hp"]; ?></p>
                <a style="padding-left: 0;" class="btn btn-link mt-1" href="editprofil.php?id=<?= $id_pelanggan; ?>">Edit Profil</a>
            </div>
        </div>

        <nav class="mt-3">
            <div class="row">
                <div class="col-6 col-md-3 mb-3">
                    <a style="display: block;" class="btn btn-<?= $warnabelumdibayar; ?>" href="account.php?halaman=belumdibayar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                        </svg>
                        <p>Belum Dibayar</p>
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a style="display: block;" class="btn btn-<?= $warnasedangdiproses; ?>" href="account.php?halaman=sedangdiproses">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                        </svg>
                        <p>Sedang Diproses</p>
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a style="display: block;" class="btn btn-<?= $warnasedangdipacking; ?>" href="account.php?halaman=sedangdipacking">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                        </svg>
                        <p>Sedang Dipacking</p>
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a style="display: block;" class="btn btn-<?= $warnasudahdikirim; ?>" href="account.php?halaman=sudahdikirim">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                        <p>Sudah Dikirim</p>
                    </a>
                </div>
            </div>
        </nav>
        <hr>

        <?php
        if (!isset($_GET["halaman"]) || $_GET["halaman"] == "belumdibayar") {
            include("belumdibayar.php");
        } else if ($_GET["halaman"] == "sedangdiproses") {
            include("sedangdiproses.php");
        } else if ($_GET["halaman"] == "sedangdipacking") {
            include("sedangdipacking.php");
        } else if ($_GET["halaman"] == "sudahdikirim") {
            include("sudahdikirim.php");
        }else if ($_GET["halaman"] == "detailbelumdibayar") {
            include("detailbelumdibayar.php");
        }


        ?>



    </div>
    <!-- FOOTER -->
    <?php include 'footer.php' ?>

    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
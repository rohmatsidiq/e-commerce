<?php
session_start();
include "koneksi.php";

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwor2 = $_POST["password2"];

    $querypelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username='$username'");
    $usernamefound = mysqli_num_rows($querypelanggan);

    if ($usernamefound > 0) {
        echo '<script>alert("Username sudah digunakan")</script>';
    }

    if ($password != $passwor2) {
        echo '<script>alert("Password harus sama")</script>';
    }

    mysqli_query($koneksi, "INSERT INTO pelanggan (username, nama_pelanggan, email_pelanggan, password_pelanggan, alamat_pelanggan, no_hp)
                            VALUES ('$username', '', '$email', '$password', '', '')");

    $queryregister = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username='$username'");
    $resultregister = mysqli_fetch_assoc($queryregister);

    $_SESSION['pelanggan'] = $resultregister;

    echo '<script>alert("Regiater berhasil")</script>';
    echo '<script>location="index.php"</script>';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body>
    <div style="width: 100vw; min-height: 100vh; background-color: whitesmoke;">
        <nav class="navbar navbar-expand-lg bg-success container-fluid" style="position: sticky; top: 0; z-index: 1;">
            <div class="container">
                <a class="navbar-brand  text-white" href="index.php">Nama Toko</a>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class=" nav-link text-white" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION["pelanggan"])) { ?>
                                <?php
                                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                                $querykeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
                                $item =  mysqli_num_rows($querykeranjang);
                                ?>
                                <?php if ($item > 0) { ?>
                                    <a class=" nav-link text-white" aria-current="page" href="keranjang.php">Keranjang<span class="badge text-bg-warning"><?= $item; ?></span></a>
                                <?php } else { ?>
                                    <a class=" nav-link text-white" aria-current="page" href="keranjang.php">Keranjang</a>
                                <?php } ?>
                            <?php } else if (!isset($_SESSION["pelanggan"])) { ?>
                                <a class=" nav-link text-white" aria-current="page" href="keranjang.php">Keranjang</a>
                            <?php } ?>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION["pelanggan"])) : ?>
                                <a class=" nav-link text-white" href="logout.php">Logout</a>
                            <?php else : ?>
                                <a class=" nav-link text-white" href="login.php">Login</a>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div style="display: flex; justify-content: center; align-items: center; height: 100vh; width: 100%;">
            <div style=" padding: 30px; background-color: white; border-radius: 10px; box-shadow: 3px 3px 7px gray; max-width: 400px;">
                <h1 class="text-center">Register</h1>
                <form action="" class="mt-3" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password2">Ulangi Password</label>
                        <input class="form-control" type="password" name="password2" id="password2" required>
                    </div>
                    <button name="register" class="btn btn-success mt-3" style="width: 100%;">Register</button>
                </form>
                <div style="display: flex; justify-content: space-between; align-items: center;" class="mt-3">
                    <p style="margin: 0;">Sudah punya akun?</p>
                    <a href="login.php" class="btn btn-link">Login</a>
                </div>
            </div>
        </div>
    </div>
    <footer style="background-color: white;" class="mt-3 border-top  border-success pt-3 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 style="margin: 0;" class="text-success">Alamat</h5>
                    <p style="margin: 0;">Jl Jengger No 7 Sariharjo, Ngaglik</p>
                    <p style="margin: 0;">Sleman,Yogyakarta</p>
                    <br>
                    <h5 style="margin: 0;" class="text-success">No hp/WA</h5>
                    <p style="margin: 0;">0823 2828 6385</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 style="margin: 0;" class="text-success mb-3">Pengiriman</h5>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <img src="./logo/wahana.png" width="75px" alt="">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="./logo/jne.png" width="75px" alt="">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="./logo/tiki.png" width="75px" alt="">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="./logo/pos.png" width="75px" alt="">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="./logo/lion.svg" width="75px" alt="">
                        </div>
                        <div class="col-4 mb-3">
                            <img src="./logo/jnt.png" width="75px" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 style="margin: 0;" class="text-success">Ikuti Kami</h5>
                    <div class="row">
                        <div class="col-4">
                            <a href="">
                                <img src="./logo/instagram.png" alt="">
                                Instagram
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="">
                            <img src="./logo/facebook.png" alt="">
                                Facebook
                            </a>
                        </div>
                    </div>
                    <br>
                    <h5 style="margin: 0;" class="text-success">E-commecre</h5>
                    <div class="row">
                        <div class="col-4">
                            <a href="">
                                <img src="./logo/shopee.png" width="16px" alt=""> Shopee
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="">
                                <img src="./logo/tokopedia.png" width="17px" alt=""> Tokopedia
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
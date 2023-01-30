<?php
session_start();
include('koneksi.php');

if (isset($_POST["login"])) {
    $key = $_POST["key"];
    $password = $_POST["password"];
    $queryusername = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username='$key' AND password_pelanggan='$password'");
    $usernamefound = mysqli_num_rows($queryusername);

    $queryemail = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email_pelanggan='$key' AND password_pelanggan='$password'");
    $emailfound = mysqli_num_rows($queryemail);

    if ($usernamefound == 1 || $emailfound == 1) {
        // berhasil login
        $result = mysqli_fetch_assoc($queryusername);
        $_SESSION["pelanggan"] = $result;
        header("Location: index.php");
    } else {
        //gagal login
        echo "<script>alert('Username/email/password salah')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div style="width: 100vw; min-height: 100vh; background-color: whitesmoke;">

        <!-- NAVIGASI -->
        <?php include('navigasi.php') ?>

        <div style="display: flex; justify-content: center; align-items: center; height: 100vh; width: 100%;">
            <div style=" padding: 30px; background-color: white; border-radius: 10px; box-shadow: 3px 3px 7px gray; max-width: 350px;">
                <h1 class="text-center">Login</h1>
                <form action="" class="mt-3" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="key">Username / Email</label>
                        <input class="form-control" type="text" name="key" id="key" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <button name="login" class="btn btn-success mt-3" style="width: 100%;">Login</button>
                </form>
                <div style="display: flex; justify-content: space-between; align-items: center;" class="mt-3">
                    <p style="margin: 0;">Belum punya akun?</p>
                    <a href="register.php" class="btn btn-link">Daftar</a>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include('footer.php') ?>

    </div>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
<?php 
session_start();
include '../koneksi.php';

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username_admin = '$username' AND password_admin = '$password'");
    $result = mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query) == 1){
        header("Location: index.php");

        $_SESSION['admin'] = $result;
    } else {
        echo "<script>alert('Username/password salah.')</script>";
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
    <link rel="stylesheet" href="../css/bootstrap.css">

</head>

<body style="background-color: whitesmoke;">

    <div style="display: flex; justify-content: center; align-items: center; width: 100vw; height: 100vh;">
        <div style=" padding: 30px; background-color: white; border-radius: 10px; box-shadow: 3px 3px 7px gray;">
            <h1 class="text-center">Login</h1>
            <form action="" class="mt-3" method="post">
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" required>
                </div>
                <button name="login" class="btn mt-3" style="width: 100%; background-color: #20c997;">Login</button>
            </form>
        </div>
    </div>

    <script src="../js/bootstrap.js"></script>
</body>

</html>
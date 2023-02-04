<?php
session_start();
include('koneksi.php');
$id_pelanggan = $_GET["id"];


$querypelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$resultpelanggan = mysqli_fetch_assoc($querypelanggan);

if (empty($resultpelanggan["foto_profil"])) {
    $fotoprofil = "rohmat.jpg";
} else {
    $fotoprofil = $resultpelanggan["foto_profil"];
}

if (isset($_POST["simpan"])) {
    $username = $_POST["username"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $email_pelanggan = $_POST["email_pelanggan"];
    $alamat_pelanggan = $_POST["alamat_pelanggan"];
    $no_hp = $_POST["no_hp"];
    $namegambar = $_FILES["foto_profil"]["name"];
    $tmp_name = $_FILES["foto_profil"]["tmp_name"];

    $ekstensigambar = explode("." , $namegambar);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if(!empty($_FILES["foto_profil"]["name"])){
        $foto_profil = uniqid();
        $foto_profil.= ".";
        $foto_profil .= $ekstensigambar;
    } else {
        $foto_profil = "";
    }

    if (!empty($resultpelanggan["foto_profil"])){
        unlink("./fotoprofil/$fotoprofil");
    }
    move_uploaded_file("$tmp_name", "./fotoprofil/$foto_profil");

    mysqli_query($koneksi, "UPDATE pelanggan SET username='$username', nama_pelanggan='$nama_pelanggan', email_pelanggan='$email_pelanggan', alamat_pelanggan='$alamat_pelanggan', no_hp='$no_hp', foto_profil='$foto_profil' WHERE id_pelanggan='$id_pelanggan'");

    echo '<script>alert("Data berhasil diubah")</script>';
    echo '<script>window.location.href="account.php?id=$id_pelanggan"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body style="padding: 0; margin: 0;">
    <?php include('navigasi.php'); ?>
    <div style="min-width: 100vw; min-height: 100vh; background-color: whitesmoke; padding: 0; margin: 0;">
        <div class="container pt-3" style="margin-bottom: 0; padding-bottom: 0;">
            <h3 class="text-center">Edit Profil</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="row" style="margin-bottom: 0; padding: 0;">
                    <div class="col-md-3">
                        <img class="print" style="width: 100%; border-radius: 100%;" src="./fotoprofil/<?= $fotoprofil; ?>" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input class="form-control" type="text" name="username" id="username" value="<?= $resultpelanggan['username']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email_pelanggan">Email</label>
                                    <input class="form-control" type="email" name="email_pelanggan" id="email_pelanggan" value="<?= $resultpelanggan['email_pelanggan']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_pelanggan">Nama</label>
                                    <input class="form-control" type="text" name="nama_pelanggan" id="nama_pelanggan" value="<?= $resultpelanggan['nama_pelanggan']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="no_hp">No HP</label>
                                    <input class="form-control" type="number" name="no_hp" id="no_hp" value="<?= $resultpelanggan['no_hp']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="foto_profil">Foto profil</label>
                            <input class="form-control" type="file" name="foto_profil" id="foto_profil">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat_palanggan">Alamat</label>
                            <textarea class="form-control" name="alamat_pelanggan" id="alamat_pelanggan" cols="30" rows="10"><?= $resultpelanggan['alamat_pelanggan']; ?></textarea>
                        </div>
                        <div class="mt-3 mb-3" style="display: flex; justify-content: end;">
                            <button name="simpan" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </form>
    <?php include('footer.php'); ?>

    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
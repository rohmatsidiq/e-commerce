<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>location='login.php'</script>";
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$id_transaksi = $_GET["id"];

$querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
$resulttransaksi = mysqli_fetch_assoc($querytransaksi);

// id pelanggan di table transaki
$id_pelanggan_di_transaksi = $resulttransaksi['id_pelanggan'];

// validasi jika id login tidak sama dengan id pelanggan di table transaksi
if ($id_pelanggan != $id_pelanggan_di_transaksi) {
    echo "<script>alert('Anda tidak bisa konfirmasi di transaksi ini')</script>";
    echo "<script>location='index.php'</script>";
}

$querypelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$resultpelanggan = mysqli_fetch_assoc($querypelanggan);

if (isset($_POST["konfirmasi"])) {
    $bank_asal = $_POST["bank_asal"];
    $bank_tujuan = $_POST["bank_tujuan"];
    $status_pengiriman = $_POST["status_pengiriman"];
    $tanggal_transfer = $_POST["tanggal_transfer"];

    // file gambar
    $nama_gambar = $_FILES['bukti_transfer']['name'];
    $lokasiawal = $_FILES['bukti_transfer']['tmp_name'];

    // ambil ekstensi gambar
    $ekstensigambar = explode('.', $nama_gambar);
    $ekstensigambar = strtolower(end($ekstensigambar));

    // buat nama gambar baru
    $bukti_transfer = uniqid();
    $bukti_transfer .= '.';
    $bukti_transfer .= $ekstensigambar;

    // upload gambar
    move_uploaded_file($lokasiawal, "./buktitransfer/$bukti_transfer");

    // simpan data ke table konfirmsi
    mysqli_query($koneksi, "INSERT INTO konfirmasi (id_transaksi, bank_asal, bank_tujuan, bukti_transfer, tanggal_transfer) VALUES ('$id_transaksi', '$bank_asal', '$bank_tujuan', '$bukti_transfer', '$tanggal_transfer')");

    // ubah status di table transaksi
    mysqli_query($koneksi, "UPDATE transaksi SET status_pengiriman='$status_pengiriman' WHERE id_transaksi='$id_transaksi'");

    // kirim notifikasi email ke pembeli


    // kirim notifikasi email ke penjual



    // kasih notif dan lempar halaman ke index untuk sementara
    echo "<script>alert('Konfirmasi pembayaran telah berhasil')</script>";
    echo "<script>location='index.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
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

    <div style="min-height: 100vh; min-width: 100cw;">
        <div class="container mt-3 mb-3">
            <h3 class="text-center">Konfirmasi Pembayaran</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label" for="nama_pelanggan">Nama</label>
                    <input required class="form-control" type="text" name="nama_pelanggan" id="nama_pelanggan" value="<?= $resultpelanggan["nama_pelanggan"]; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tanggal_transfer">Tanggal Transfer</label>
                    <input class="form-control" type="date" name="tanggal_transfer" id="tanggal_transfer">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bank_asal">Bank Asal</label>
                    <input required class="form-control" type="text" name="bank_asal" id="bank_asal">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bank_tujuam">Bank Tujuan</label>
                    <select class="form-select" name="bank_tujuan" aria-label="Default select example">
                        <option selected>-- Pilih Bank Tujuan --</option>
                        <option value="BSI 2323244">BSI 2323244</option>
                        <option value="Mandiri 6756575756">Mandiri 6756575756</option>
                        <option value="BCA 1232362131">BCA 1232362131</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bukti_transfer">Bukti Transfer</label>
                    <input required class="form-control" type="file" name="bukti_transfer" id="bukti_transfer">
                </div>
                <input type="hidden" name="status_pengiriman" id="status_pengiriman" value="Sudah Dibayar">
                <div class="mb-3">
                    <button class="btn btn-success" name="konfirmasi">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>


    <!-- FOOTER -->
    <?php include('footer.php') ?>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
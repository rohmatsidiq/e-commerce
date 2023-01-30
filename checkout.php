<?php

session_start();
include "koneksi.php";
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>location='login.php'</script>";
}

$key = isset($_GET["key"]) ? $_GET["key"] : false;
if (!$key) {
    echo "<script>location='keranjang.php'</script>";
}


$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$querykeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
$resultkeranjang = mysqli_fetch_all($querykeranjang, MYSQLI_ASSOC);
$ada = mysqli_num_rows($querykeranjang);
if ($ada < 1) {
    echo "<script>alert('Tidak ada data')</script>";
    echo "<script>location='index.php'</script>";
}


$querypelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$resultpelanggan = mysqli_fetch_assoc($querypelanggan);
$nama_pelanggan = $_SESSION['pelanggan']["nama_pelanggan"];
$alamat_pelanggan = $_SESSION['pelanggan']["alamat_pelanggan"];
$no_hp_pelanggan = $_SESSION['pelanggan']['no_hp'];

$ongkos_kirim = 30000;
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
</head>

<body style="background-color: whitesmoke;">
    <!-- NAVIGASI -->
    <?php include('navigasi.php') ?>

    <div class="container mt-3 mb-3" style="width: 100vw; min-height: 100vh;">
        <h3>Checkout</h3>
        <?php $totalharga = 0; ?>

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
                        <div class="col-8 col-md-11">
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
                    </div>
                    <?php if ($resultproduk['stock_produk'] <= 0) : ?>
                        <div class="alert alert-warning mb-0" role="alert">
                            <p style="margin: 0;">Produk Kosong, silahkan hapus di keranjang terlebih dahulu.</p>
                        </div>
                        <?php $stock_ready = false; ?>
                    <?php endif ?>
                </div>

                <?php $totalharga += $subharga ?>
            <?php endforeach ?>

            <div class="alert alert-success mt-3" role="alert">
                <p>Total harga barang : <strong>Rp<?= number_format($totalharga, 0, '', '.'); ?></strong></p>
            </div>

            <form action="" method="post">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="nama_penerima">Nama Penerima</label>
                            <input class="form-control" type="text" name="nama_penerima" id="nama_penerima" value="<?= $nama_pelanggan; ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="no_hp">No HP</label>
                            <input class="form-control" type="text" name="no_hp" id="no_hp" value="<?= $no_hp_pelanggan; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="alamat_pengiriman">Alamat Pengiriman</label>
                    <textarea required class="form-control" name="alamat_pengiriman" id="alamat_pengiriman" cols="30" rows="10"><?= $alamat_pelanggan; ?></textarea>
                </div>
                <input required class="form-control mb-3" type="text" name="ekspedisi" value="Wahana">
                <input required class="form-control mb-3" type="text" name="ongkir" value="<?= $ongkos_kirim; ?>">
                <input type="hidden" name="status_pengiriman" id="status_pengiriman" value="Belum Dibayar">
                <?php if ($stock_ready) : ?>
                    <div style="display: flex; justify-content: end;">
                        <button name="lanjutkan" class="btn btn-success">Buat Pesanan</button>
                    </div>
                <?php else : ?>
                    <div style="display: flex; justify-content: end;">
                        <p name="lanjutkan" class="btn btn-success">Tidak Bisa Lanjutkan</p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <?php
        if (isset($_POST["lanjutkan"])) {

            $jumlah_harga = $totalharga;
            $ekspedisi = $_POST["ekspedisi"];
            $ongkir = $_POST["ongkir"];
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('y-m-d');
            $no_invoice = "INV" . $id_pelanggan . time();
            $nama_penerima = $_POST["nama_penerima"];
            $no_hp = $_POST["no_hp"];
            $alamat_pengiriman = $_POST["alamat_pengiriman"];
            $status_pengiriman = $_POST["status_pengiriman"];

            // insert data ke transaksi
            mysqli_query($koneksi, "INSERT INTO transaksi (no_invoice, tanggal, id_pelanggan, jumlah_harga, ekspedisi, ongkir, nama_penerima, no_hp, alamat_pengiriman, status_pengiriman, resi_pengiriman)
            VALUES ('$no_invoice', '$tanggal', '$id_pelanggan', '$jumlah_harga', '$ekspedisi', '$ongkir', '$nama_penerima', '$no_hp', '$alamat_pengiriman', '$status_pengiriman', '')");

            $id_transaksi_terakhir = mysqli_insert_id($koneksi);

            foreach ($resultkeranjang as $value) {

                $id_produk = $value['id_produk'];

                $queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
                $resultproduk = mysqli_fetch_assoc($queryproduk);
                $nama_produk = $resultproduk["nama_produk"];
                $harga_produk = $resultproduk["harga_produk"];
                $jumlah_produk = $value["jumlah_produk"];
                $sub_total_harga = $jumlah_produk * $harga_produk;
                $berat_produk = $resultproduk["berat_produk"];
                $sub_total_berat = $jumlah_produk * $berat_produk;
                $stock_produk = $resultproduk["stock_produk"];
                $stock_update = $stock_produk - $jumlah_produk;

                // insert data ke transaksi produk
                mysqli_query($koneksi, "INSERT INTO transaksi_produk (id_transaksi, id_pelanggan, id_produk, nama_produk, harga_produk, jumlah_produk, sub_total_harga, berat_produk, sub_total_berat) VALUES ('$id_transaksi_terakhir', '$id_pelanggan', '$id_produk', '$nama_produk', '$harga_produk', '$jumlah_produk', '$sub_total_harga', '$berat_produk', '$sub_total_berat')");

                // kurangi stock produk
                mysqli_query($koneksi, "UPDATE produk SET stock_produk='$stock_update' WHERE id_produk='$id_produk'");

                // hapus data di keranjang
                mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_produk='$id_produk'");
            }

            // kirim email notifikasi ke pelanggan





            echo "<script>alert('Berhasil checkout')</script>";
            echo "<script>location='invoice.php?id=$id_transaksi_terakhir'</script>";
        }

        ?>
    </div>

    <!-- FOOTER -->
    <?php include('footer.php') ?>

    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
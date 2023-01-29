<?php
session_start();
// jika belum login
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>location='login.php'</script>";
}

include("koneksi.php");
$id_produk = $_GET["id"];
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

// query keranjang
$querykeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
$resultkeranjang = mysqli_fetch_all($querykeranjang, MYSQLI_ASSOC);

// query produk
$queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
$resultproduk = mysqli_fetch_assoc($queryproduk);

if (!isset($resultkeranjang[0]['id_produk']) == $id_produk) {

    $jumlah_produk = 1;
    mysqli_query($koneksi, "INSERT INTO keranjang (id_pelanggan, id_produk, jumlah_produk)
                            VALUES ('$id_pelanggan', '$id_produk', '$jumlah_produk')");
} else {

    // lakukan pengecekan
    foreach ($resultkeranjang as $value) {
        $idprodukkeranjang = $value['id_produk'];

        // cek apakah ada produk di database
        if ($idprodukkeranjang == $id_produk) {
            // sudah sudah terdapat di db, lakikan update data
            $jumlahprodukkeranjang = $value["jumlah_produk"];
            $id_keranjang = $value['id_keranjang'];
            $stock_produk = $resultproduk['stock_produk'];
            if ($stock_produk == $jumlahprodukkeranjang) {
                echo "<script>alert('Stock tinggal $stock_produk dan Anda sudah memasukkan ke keranjang belanja.')</script>";
                echo "<script>location='detail.php?id=$id_produk'</script>";
                exit();
            }
            $jumlahtambahproduk = $jumlahprodukkeranjang + 1;
            mysqli_query($koneksi, "UPDATE keranjang SET jumlah_produk='$jumlahtambahproduk' WHERE id_produk = '$id_produk' AND id_keranjang='$id_keranjang'");
            echo "<script>alert('Produk berhasil ditambahkan ke keranjang')</script>";
            echo "<script>location='detail.php?id=$id_produk'</script>";
            exit();
        }
    }
    if ($idprodukkeranjang != $id_produk) {
        $jumlah_produk = 1;
        mysqli_query($koneksi, "INSERT INTO keranjang (id_pelanggan, id_produk, jumlah_produk)
                            VALUES ('$id_pelanggan', '$id_produk', '$jumlah_produk')");
    }
}
echo "<script>alert('Produk berhasil ditambahkan ke keranjang')</script>";
echo "<script>location='detail.php?id=$id_produk'</script>";

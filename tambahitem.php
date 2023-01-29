<?php
session_start();
include "koneksi.php";
$id_produk = $_GET["id"];
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
$resultproduk = mysqli_fetch_assoc($queryproduk);

$querykeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan' AND id_produk='$id_produk'");
$resultkeranjang = mysqli_fetch_all($querykeranjang, MYSQLI_ASSOC);
$jumlah_produk = $resultkeranjang[0]['jumlah_produk'];
$stock_produk = $resultproduk['stock_produk'];
if ($stock_produk == $jumlah_produk) {
    echo "<script>alert('Stock tinggal $stock_produk')</script>";
    echo "<script>location='keranjang.php'</script>";
    exit();
}
$tambahproduk = $jumlah_produk + 1;

mysqli_query($koneksi, "UPDATE keranjang SET jumlah_produk='$tambahproduk' WHERE id_pelanggan='$id_pelanggan' AND id_produk='$id_produk'");


header("Location: keranjang.php");

<?php
session_start();
include "koneksi.php";
$id_produk = $_GET["id"];
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$querykeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan' AND id_produk='$id_produk'");
$resultkeranjang = mysqli_fetch_all($querykeranjang, MYSQLI_ASSOC);
$jumlah_produk = $resultkeranjang[0]['jumlah_produk'];

if($jumlah_produk >= 2){
    $kurangijumlah = $jumlah_produk - 1;
    mysqli_query($koneksi, "UPDATE keranjang SET jumlah_produk='$kurangijumlah' WHERE id_pelanggan='$id_pelanggan' AND id_produk='$id_produk'");
} else {
    mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_pelanggan='$id_pelanggan' AND id_produk='$id_produk'");
}


header("Location: keranjang.php");

<?php
include('koneksi.php');
$id_transaksi = $_GET["id"];
$querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
$resulttransaksi = mysqli_fetch_assoc($querytransaksi);

$querytransaksiproduk = mysqli_query($koneksi, "SELECT * FROM transaksi_produk WHERE id_transaksi='$id_transaksi'");
$resulttransaksiproduk = mysqli_fetch_all($querytransaksiproduk, MYSQLI_ASSOC);
?>

<?php foreach ($resulttransaksiproduk as $value) : ?>
<?php 
$id_produk = $value['id_produk'];
$jumlah_produk = $value['jumlah_produk'];

$queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
$resultproduk = mysqli_fetch_assoc($queryproduk);
$stock_produk = $resultproduk["stock_produk"];

$stock_update = $stock_produk + $jumlah_produk;

// kembalikan stock
mysqli_query($koneksi, "UPDATE produk SET stock_produk='$stock_update' WHERE id_produk='$id_produk'");

// hapus data di tabel transaksi produk
mysqli_query($koneksi, "DELETE FROM transaksi_produk WHERE id_transaksi='$id_transaksi'");

// hapus data di tabel transaksi
mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'");


header("Location: account.php");
?>
<?php endforeach; ?>
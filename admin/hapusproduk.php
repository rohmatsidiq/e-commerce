<?php
$id = $_GET["id"];
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id'");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
$gambarproduk = $result[0]['gambar_produk'];

unlink("../fotoproduk/$gambarproduk");

mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id'");

echo '<script>window.location.href="index.php?halaman=produk"</script>';

<?php
$id_transaksi = $_GET["id"];

mysqli_query($koneksi, "UPDATE transaksi SET status_pengiriman='Sedang Diproses' WHERE id_transaksi='$id_transaksi'");

// kirim notifikasi email ke pembeli


echo "<script>alert('Pesanan sedang diproses')</script>";
echo "<script>location='index.php?halaman=transaksiproduk&id=$id_transaksi'</script>";

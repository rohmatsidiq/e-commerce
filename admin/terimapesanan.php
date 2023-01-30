<?php
$id_transaksi = $_GET["id"];

mysqli_query($koneksi, "UPDATE transaksi SET status_pengiriman='Sedang Dipacking' WHERE id_transaksi='$id_transaksi'");

// kirim notifikasi email ke pembeli


echo "<script>alert('Anda telah menerima pesanan, segera kirimkan barang.')</script>";
echo "<script>location='index.php?halaman=transaksiproduk&id=$id_transaksi'</script>";

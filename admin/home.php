<?php 
include('../koneksi.php');

$querybelumbayar = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status_pengiriman='Belum Dibayar'");
$totalbelumbayar = mysqli_num_rows($querybelumbayar);

$querysedangdiproses = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status_pengiriman='Sedang Diproses'");
$totalsedangdiproses = mysqli_num_rows($querysedangdiproses);

$querysedangdipacking = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status_pengiriman='Sedang Dipacking'");
$totalsedangdipacking = mysqli_num_rows($querysedangdipacking);

$queryselesai = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status_pengiriman='Selesai'");
$totalselesai = mysqli_num_rows($queryselesai);

?>

<div class="container mt-3">
    <h2 class="display-5">Welcome</h2>
    <hr>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="bg-white rounded p-3">
                <p>Pesanan Belum Dibayar</p>
                <h2><?= $totalbelumbayar; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="bg-white rounded p-3">
                <p>Pesanan Sedang Diproses</p>
                <h2><?= $totalsedangdiproses; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="bg-white rounded p-3">
                <p>Pesanan Sedang Dipacking</p>
                <h2><?= $totalsedangdipacking; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="bg-white rounded p-3">
                <p>Pesanan Selesai</p>
                <h2><?= $totalselesai; ?></h2>
            </div>
        </div>
    </div>

</div>
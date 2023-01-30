<?php
$querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pelanggan='$id_pelanggan' AND status_pengiriman='Sedang Dipacking'");
$adatransaksi = mysqli_num_rows($querytransaksi);
if ($adatransaksi < 1) {
    exit();
} else {
    $resulttransaksi = mysqli_fetch_all($querytransaksi, MYSQLI_ASSOC);
    $hasil = [];
    foreach ($resulttransaksi as $value) {
        $hasil[] = $value;
    }
    $reversehasil = array_reverse($hasil);
}
?>

<?php foreach ($reversehasil as $value) : ?>
    <?php $jumlahtotal = $value["jumlah_harga"] + $value["ongkir"] ?>
    <div style="background-color: white; padding: 10px; border-radius: 10px;" class="row mb-3">
        <div class="col-md-1">
            <p style="margin: 0;"><?= $value["tanggal"]; ?></p>
        </div>
        <div class="col-md-2">
            <p style="margin: 0;"><?= $value["no_invoice"]; ?></p>
        </div>
        <div class="col-md-2">
            <p style="margin: 0;">Rp<?= number_format($jumlahtotal, 0, '', '.'); ?></p>
        </div>
        <div class="col-md-7">
            <div style="display: flex; justify-content: end;">
                <a class="btn btn-link btn-sm" href="">Detail</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
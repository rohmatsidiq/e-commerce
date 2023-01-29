<?php
$id_transaksi = $_GET["id"];

$querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
$resulttransaksi = mysqli_fetch_assoc($querytransaksi);
$ekspedisi = $resulttransaksi["ekspedisi"];

if (isset($_POST["kirim"])) {

    $ekspedisi = $_POST["ekspedisi"];
    $resipengiriman = $_POST["resi_pengiriman"];

    mysqli_query($koneksi, "UPDATE transaksi SET status_pengiriman='Selesai', resi_pengiriman='$resipengiriman' WHERE id_transaksi='$id_transaksi'");

    // kirim notifikasi email ke pembeli



    echo "<script>alert('Pesanan selesai')</script>";
    echo "<script>location='index.php?halaman=transaksi'</script>";
}
?>
<div class="container">
    <h3>Input Nomor Resi</h3>
    <form method="post">
        <div class="mb-3">
            <label class="form-label" for="ekspedisi">Ekpedisi</label>
            <input class="form-control" type="text" name="ekspedisi" id="ekspedisi" value="<?= $ekspedisi; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="resi_pengiriman">Resi Pengiriman</label>
            <input class="form-control" type="text" name="resi_pengiriman" id="resi_pengiriman">
        </div>
        <div class="mb-3">
            <button class="btn" style="background-color: #25a881; color: white; " name="kirim">Kirim</button>
        </div>
    </form>
</div>
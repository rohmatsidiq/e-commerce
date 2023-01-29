<div class="container">
    <h2 class="display-5">Bukti Transfer</h2>
    <hr>
    <?php
    $id_transaksi = $_GET["id"];
    $querykonfirmasi = mysqli_query($koneksi, "SELECT * FROM konfirmasi WHERE id_transaksi='$id_transaksi'");
    $resultkonfirmasi = mysqli_fetch_assoc($querykonfirmasi);
    $sudahbayar = mysqli_num_rows($querykonfirmasi);
    ?>

    <?php if ($sudahbayar < 1) : ?>
        <div class="alert alert-warning" role="alert">
            <p style="margin: 0;">Belum konfirmasi pembayaran</p>
        </div>
        <?php exit(); ?>
    <?php endif; ?>

    <?php
    $querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
    $resulttransaksi = mysqli_fetch_assoc($querytransaksi);
    $id_pelanggan = $resulttransaksi['id_pelanggan'];

    $querypelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
    $resultpelanggan = mysqli_fetch_assoc($querypelanggan);
    $nama_pelanggan = $resultpelanggan["nama_pelanggan"];
    ?> <h4 style="color: #25a881;"><?= $nama_pelanggan; ?></h4>
    <p style="margin: 0;">Bank Asal : <?= $resultkonfirmasi["bank_asal"]; ?></p>
    <p style="margin: 0;">Bank Tujuan : <?= $resultkonfirmasi["bank_tujuan"]; ?></p>
    <p style="margin: 0;">Tanggal transfer : <?= $resultkonfirmasi["tanggal_transfer"]; ?></p>
    <img style="max-width: 350px;" src="../buktitransfer/<?= $resultkonfirmasi['bukti_transfer']; ?>" alt="">

</div>
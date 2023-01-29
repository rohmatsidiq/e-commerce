<div class="container mt-3 mb-3">
    <h2 class="display-5">Detail Transaksi</h2>
    <hr>
    <?php
    $id_transaksi = $_GET["id"];
    $querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
    $resulttransaksi = mysqli_fetch_assoc($querytransaksi);
    $id_pelanggan = $resulttransaksi['id_pelanggan'];

    $querypelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
    $resultpelanggan = mysqli_fetch_assoc($querypelanggan);

    $querytransaksiproduk = mysqli_query($koneksi, "SELECT * FROM transaksi_produk WHERE id_transaksi='$id_transaksi'");
    $resulttransaksiproduk = mysqli_fetch_all($querytransaksiproduk, MYSQLI_ASSOC);

    $warna_status = 'null';
    if ($resulttransaksi["status_pengiriman"] == "Belum Dibayar") {
        $warna_status = "danger";
    } elseif ($resulttransaksi["status_pengiriman"] == "Sudah Dibayar") {
        $warna_status = "warning";
    } elseif ($resulttransaksi["status_pengiriman"] == "Sedang Diproses") {
        $warna_status = "info";
    } elseif ($resulttransaksi["status_pengiriman"] == "Selesai") {
        $warna_status = "success";
    }

    ?>

    <div style="display: flex; justify-content: space-between;">
        <div>
            <p style="margin: 0;">Penerima : <?= $resulttransaksi['nama_penerima']; ?></p>
            <p style="margin: 0;">No HP : <?= $resulttransaksi['no_hp']; ?></p>
            <p style="margin: 0;">Alamat pengiriman:</p>
            <p style="margin: 0;"><?= $resulttransaksi['alamat_pengiriman']; ?></p>
            <div style="margin-top: 10px; margin-bottom: 10px;">
                <small class="bg-<?= $warna_status; ?>" style="color: white; padding: 8px 10px;  border-radius: 5px;">Pesanan <?= $resulttransaksi['status_pengiriman']; ?></small>
            </div>
        </div>
        <div style="text-align: end;">
            <div>
                <small style="margin: 0;"><?= $resulttransaksi['tanggal']; ?></small>
            </div>
            <div>
                <small style="margin: 0;"><?= $resulttransaksi['no_invoice']; ?></small>
            </div>

            <div style="display: flex; justify-content: end; gap: 10px; flex-direction: column;">
                <!-- jika status sudah bayar -->
                <?php if ($resulttransaksi["status_pengiriman"] == "Sudah Dibayar") { ?>
                    <a class="btn btn-sm" style="background-color: #25a881; color: white; " href="index.php?halaman=buktitransfer&id=<?= $id_transaksi; ?>">Bukti Transfer</a>
                    <a href="index.php?halaman=terimapesanan&id=<?= $id_transaksi; ?>" style="background-color: #25a881; color: white;" class="btn btn-sm">Terima Pesanan</a>
                <?php } else if ($resulttransaksi["status_pengiriman"] == "Sedang Diproses") { ?>
                    <a class="btn btn-sm" style="background-color: #25a881; color: white; " href="index.php?halaman=buktitransfer&id=<?= $id_transaksi; ?>">Bukti Transfer</a>
                    <a class="btn btn-sm" style="background-color: #25a881; color: white; " href="index.php?halaman=kirim&id=<?= $id_transaksi; ?>">Kirim Pesanan</a>
                <?php } else if ($resulttransaksi["status_pengiriman"] == "Selesai") { ?>
                    <div>
                        <small style="margin: 0;">Resi Pengiriman : <?= $resulttransaksi['resi_pengiriman']; ?></small>
                    </div>
                    <a class="btn btn-sm" style="background-color: #25a881; color: white; " href="index.php?halaman=buktitransfer&id=<?= $id_transaksi; ?>">Bukti Transfer</a>
                <?php } ?>
            </div>
        </div>
    </div>


    <?php foreach ($resulttransaksiproduk as $value) : ?>
        <?php
        $id_produk = $value['id_produk'];
        $queryproduk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
        $resultproduk = mysqli_fetch_assoc($queryproduk);
        ?>
        <div class="row" style="background-color: white; margin: 10px 0; padding: 10px; border-radius: 10px;">
            <div class="col-2 col-md-1">
                <img src="../fotoproduk/<?= $resultproduk['gambar_produk']; ?>" style="width: 100%;" alt="">
            </div>
            <div class="col-7 col-md-8">
                <p style="font-weight: bolder; margin: 0; color: #25a881;"><?= $value['nama_produk']; ?></p>
                <small style="margin: 0;"><?= $value['jumlah_produk']; ?> x Rp<?= number_format($value['harga_produk'], 0, '', '.'); ?></small>
            </div>
            <div class="col-3 col-md-3">
                <p style="margin: 0; text-align: end;">Rp<?= number_format($value['sub_total_harga'], 0, '', '.'); ?></p>
            </div>
        </div>
    <?php endforeach ?>
    <div class="row" style="margin: 0; padding: 5px 10px;">
        <div class="col-9" style="margin: 0;">
            <p style="margin: 0; text-align: end;">Total harga produk</p>
        </div>
        <div class="col-3" style="margin: 0;">
            <p style="margin: 0; text-align: end;">Rp<?= number_format($resulttransaksi['jumlah_harga'], 0, '', '.'); ?></p>
        </div>
    </div>
    <div class="row" style="margin: 0; padding: 5px 10px;">
        <div class="col-9" style="margin: 0;">
            <p style="margin: 0; text-align: end;">Ongkos kirim <?= $resulttransaksi['ekspedisi']; ?></p>
        </div>
        <div class="col-3" style="margin: 0;">
            <p style="margin: 0; text-align: end;">Rp<?= number_format($resulttransaksi['ongkir'], 0, '', '.'); ?></p>
        </div>
    </div>
    <div class="row" style="margin: 0; padding: 5px 10px;">
        <div class="col-9" style="margin: 0;">
            <p style="margin: 0; text-align: end; font-weight: bold; color: #25a881;">Total pesanan</p>
        </div>
        <div class="col-3" style="margin: 0;">
            <?php $totalpesanan = $resulttransaksi['jumlah_harga'] + $resulttransaksi['ongkir'] ?>
            <p style="margin: 0; text-align: end; font-weight: bold; color: #25a881;">Rp<?= number_format($totalpesanan, 0, '', '.'); ?></p>
        </div>
    </div>

</div>
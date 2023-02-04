<?php
include("../koneksi.php");
$id_transaksi = $_GET["id"];
$querytransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
$resulttransaksi = mysqli_fetch_assoc($querytransaksi);

$nama_penerima = $resulttransaksi["nama_penerima"];
$alamat_pengiriman = $resulttransaksi["alamat_pengiriman"];
$no_hp = $resulttransaksi["no_hp"];
$ekspedisi = $resulttransaksi["ekspedisi"];
$ongkir = $resulttransaksi["ongkir"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Alamat</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <div style="margin-top: 20px; padding: 0 10px;">
            <table class="table table-bordered">
                <tbody>
                    <tr style="text-align: end; font-style: italic;">
                        <td colspan="2">
                            <small>
                                <?= $ekspedisi; ?> - <?= $ongkir; ?>
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-success" style="margin-bottom: 0;">Kepada : </h5>
                        </td>
                        <td>
                            <h5 class="text-success" style="padding-left: 0; margin-bottom: 0;"><?= $nama_penerima; ?> (<?= $no_hp; ?>)</h5>
                            <p><?= $alamat_pengiriman; ?></p>
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td>
                            <h5 class="text-success" style="margin-bottom: 0;">Dari : </h5>
                        </td>
                        <td>
                            <h5 class="text-success" style="padding-left: 0; margin-bottom: 0;">Nama Toko Anda (312342445)</h5>
                            <p>Alamat Toko di mana silahkan ditulis disini ya</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <small>
                                www.tokoanda.com | IG:tokoanda | FB:tokoanda
                            </small>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="display: flex; justify-content: end;">
                <button class="print btn btn-primary" onclick="window.print()">Cetak</button>
            </div>
        </div>
        <style>
            @media print {
                .print {
                    display: none;
                }
            }
        </style>

        <script src="../js/bootstrap.min.js"></script>
</body>

</html>
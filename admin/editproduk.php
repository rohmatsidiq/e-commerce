<?php
$id = $_GET["id"];
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id'");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
$gambarlama = $result[0]['gambar_produk'];

if (isset($_POST["simpan"])) {
    $nama = htmlspecialchars($_POST["nama_produk"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi_produk"]);
    $berat = htmlspecialchars($_POST["berat_produk"]);
    $harga = htmlspecialchars($_POST["harga_produk"]);
    $stock = htmlspecialchars($_POST["stock_produk"]);
    $gambar = $_FILES["gambar_produk"]["name"];
    $tempatsementara = $_FILES["gambar_produk"]["tmp_name"];

    if (!empty($tempatsementara)) {
        $ekstensigambar = explode(".", $gambar);
        $ekstensigambar = strtolower(end($ekstensigambar));

        $namagambarbaru = uniqid();
        $namagambarbaru .= ".";
        $namagambarbaru .= $ekstensigambar;

        unlink("../fotoproduk/$gambarlama");
        move_uploaded_file("$tempatsementara", "../fotoproduk/$namagambarbaru");
        mysqli_query($koneksi, "UPDATE produk SET nama_produk = '$nama', deskripsi_produk = '$deskripsi', gambar_produk = '$namagambarbaru', berat_produk = '$berat', harga_produk = '$harga', stock_produk = '$stock' WHERE id_produk = '$id' ");
    } else {
        mysqli_query($koneksi, "UPDATE produk SET nama_produk = '$nama', deskripsi_produk = '$deskripsi', berat_produk = '$berat', harga_produk = '$harga', stock_produk = '$stock' WHERE id_produk = '$id' ");
    }


    echo "<script>alert('Data berhasil diedit')</script>";
    echo '<script>window.location.href="index.php?halaman=produk"</script>';
}

?>

<div class="container mt-3 mb-5">
    <h2 class="display-5">Tambah Produk</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="nama_produk">Nama Produk</label>
            <input class="form-control" type="text" name="nama_produk" id="nama_produk" value="<?= $result[0]['nama_produk']; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="deskripsi_produk">Deskripsi</label>
            <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="10"><?= $result[0]['deskripsi_produk']; ?></textarea>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-md-4">
                <label class="form-label" for="berat_produk">Berat</label>
                <input class="form-control" type="number" name="berat_produk" id="berat_produk" value="<?= $result[0]['berat_produk']; ?>">
            </div>
            <div class="mb-3 col-12 col-md-4">
                <label class="form-label" for="harga_produk">Harga</label>
                <input class="form-control" type="number" name="harga_produk" id="harga_produk" value="<?= $result[0]['harga_produk']; ?>">
            </div>
            <div class="mb-3 col-12 col-md-4">
                <label class="form-label" for="stock_produk">Jumlah Stock</label>
                <input class="form-control" type="number" name="stock_produk" id="stock_produk" value="<?= $result[0]['stock_produk']; ?>">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="gambar_produk">Gambar</label>
            <img src="../fotoproduk/<?= $gambarlama; ?>" width="50px" alt="">
            <input class="form-control" type="file" name="gambar_produk" id="gambar_produk">
        </div>

        <button type="submit" name="simpan" class="btn" style="background-color: #6bdbba;">Simpan</button>
    </form>
</div>
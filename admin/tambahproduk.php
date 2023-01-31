<?php
if (isset($_POST["simpan"])) {
    $nama = htmlspecialchars($_POST["nama_produk"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi_produk"]);
    $berat = htmlspecialchars($_POST["berat_produk"]);
    $harga = htmlspecialchars($_POST["harga_produk"]);
    $stock = htmlspecialchars($_POST["stock_produk"]);
    $gambar = htmlspecialchars($_FILES["gambar_produk"]["name"]);
    $tempatsementara = $_FILES["gambar_produk"]["tmp_name"];

    $ekstensigambar = explode(".",$gambar);
    $ekstensigambar = strtolower(end($ekstensigambar));
    
    $namagambarbaru = uniqid();
    $namagambarbaru .= ".";
    $namagambarbaru .= $ekstensigambar;

    move_uploaded_file("$tempatsementara", "../fotoproduk/$namagambarbaru");

    mysqli_query($koneksi, "INSERT INTO produk (nama_produk, deskripsi_produk, gambar_produk, berat_produk, harga_produk, stock_produk)
                            VALUES ('$nama', '$deskripsi', '$namagambarbaru', '$berat', '$harga', '$stock')
                            ");
                            
    echo '<script>alert("Produk Berhasil Disimpan")</script>';
    echo '<script>window.location.href="index.php?halaman=produk"</script>';
}

?>

<div class="container mt-3 mb-3">
    <h2 class="display-5">Tambah Produk</h2>
    <hr>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="nama_produk">Nama Produk</label>
            <input class="form-control" type="text" name="nama_produk" id="nama_produk" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="deskripsi_produk">Deskripsi</label>
            <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="10" required></textarea>
        </div>
        <div class="row">
            <div class="mb-3 col-12 col-md-4">
                <label class="form-label" for="berat_produk">Berat (gr)</label>
                <input class="form-control" type="number" name="berat_produk" id="berat_produk" required>
            </div>
            <div class="mb-3 col-12 col-md-4">
                <label class="form-label" for="harga_produk">Harga</label>
                <input class="form-control" type="number" name="harga_produk" id="harga_produk" required>
            </div>
            <div class="mb-3 col-12 col-md-4">
                <label class="form-label" for="stock_produk">Jumlah Stock</label>
                <input class="form-control" type="number" name="stock_produk" id="stock_produk" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="gambar_produk">Gambar</label>
            <input class="form-control" type="file" name="gambar_produk" id="gambar_produk" required>
        </div>

        <button type="submit" name="simpan" class="btn" style="background-color: #6bdbba;">Simpan</button>
    </form>
</div>
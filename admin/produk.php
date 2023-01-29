<div class="container mt-3 mb-5">

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM produk");
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    ?>
    <div style="display: flex; justify-content: space-between;">
        <h2 class="display-5">Daftar Produk</h2>
        <div>
            <a class="btn tombol-hover" style="background-color: #6bdbba;" href="index.php?halaman=tambahproduk">Tambah Produk</a>
        </div>
    </div>
    <hr>

    <?php foreach ($result as $value) : ?>
        <div class="row p-3 mt-3" style="background-color: white;">
            <div class="col-12 col-md-9" style="display: flex; gap: 20px; align-items: flex-start;">
                <div style="display: flex; flex-direction: row; align-items: center;">
                    <div style="width: 75px;">
                        <img src="../fotoproduk/<?= htmlspecialchars($value['gambar_produk']); ?>" style="width: inherit;" alt="">
                    </div>
                    <div class="p-3" style="margin-left: 10px;">
                        <h3><?= $value['nama_produk']; ?></h3>
                        <p style="margin: 0;">Rp. <?= number_format($value['harga_produk']); ?></p>
                        <p style="margin: 0;">Stock : <?= $value['stock_produk']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3" style="display: flex; align-items: center; gap: 10px; justify-content: center;">
                <a class="btn btn-outline-warning" href="index.php?halaman=editproduk&id=<?= $value['id_produk']; ?>">Edit</a>
                <a onclick="return confirm('Yakin hapus?')" class="btn btn-outline-danger" href="index.php?halaman=hapusproduk&id=<?= $value['id_produk']; ?>">Hapus</a>
            </div>
        </div>
    <?php endforeach ?>

</div>
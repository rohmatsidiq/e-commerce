<div class="container mt-3">
    <h2 class="display-5">Daftar Pelanggan</h2>
    <hr>

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    ?>
    <?php foreach ($result as $value) : ?>
        <div class="row" style="background-color: white; margin: 10px 0; padding: 10px; border-radius: 10px;">
            <div class=" col-md-2">
                <p style="color: #25a881; font-weight: bold; margin: 0;"><?= $value['nama_pelanggan']; ?></p>
            </div>
            <div class="col-md-3">
                <p style="margin: 0;"><?= $value['email_pelanggan']; ?></p>
            </div>
            <div class="col-md-5">
                <p style="margin: 0;"><?= $value['alamat_pelanggan']; ?></p>
            </div>
            <div class="col-md-2">
                <a class="btn btn-sm" style="background-color: #6bdbba;" href="">Hapus</a>
                <a class="btn btn-sm" href="" style="background-color: #6bdbba;">Edit</a>
            </div>
        </div>
    <?php endforeach ?>
</div>
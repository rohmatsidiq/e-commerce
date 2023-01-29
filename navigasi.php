<nav class="navbar navbar-expand-lg bg-success container-fluid" style="position: sticky; top: 0; z-index: 1;">
        <div class="container">
            <a class="navbar-brand  text-white" href="index.php">Nama Toko</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class=" nav-link text-white" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION["pelanggan"])) { ?>
                            <?php
                            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                            $querykeranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
                            $item =  mysqli_num_rows($querykeranjang);
                            ?>
                            <?php if ($item > 0) { ?>
                                <a class=" nav-link text-white" aria-current="page" href="keranjang.php">Keranjang<span class="badge text-bg-warning"><?= $item; ?></span></a>
                            <?php } else { ?>
                                <a class=" nav-link text-white" aria-current="page" href="keranjang.php">Keranjang</a>
                            <?php } ?>
                        <?php } else if (!isset($_SESSION["pelanggan"])) { ?>
                            <a class=" nav-link text-white" aria-current="page" href="keranjang.php">Keranjang</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION["pelanggan"])) : ?>
                            <a class=" nav-link text-white" href="logout.php">Logout</a>
                        <?php else : ?>
                            <a class=" nav-link text-white" href="login.php">Login</a>
                        <?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php

session_start();
if (!$_SESSION['admin']) {
    header("Location: login.php");
    exit();
}

include "../koneksi.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Online</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        nav a:hover {
            background-color: #8de0c8;
        }
    </style>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div style="display: flex; flex-direction: row;">
        <div style="min-height: 100vh; width: 250px; background-color: #6bdbba;">
            <p style="margin-top: 20px;" class="display-5 text-center">Admin</p>
            <nav>
                <a style="display: block; padding: 20px 30px; text-decoration: none; color: black;" href="index.php?halaman=home">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-houses-fill" viewBox="0 0 16 16">
                        <path d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0 .708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.51 2.51 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354L7.207 1Z" />
                        <path d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Z" />
                    </svg>
                    Home
                </a>
                <a style="display: block; padding: 20px 30px; text-decoration: none; color: black;" href="index.php?halaman=produk">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-database-fill-check" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1Z" />
                        <path d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12.31 12.31 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7Zm6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.552 4.552 0 0 1 .23-2.002Zm-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.507 4.507 0 0 1-1.3-1.905Z" />
                    </svg>
                    Produk
                </a>
                <a style="display: block; padding: 20px 30px; text-decoration: none; color: black;" href="index.php?halaman=pelanggan">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z" />
                    </svg>
                    Pelanggan
                </a>
                <a style="display: block; padding: 20px 30px; text-decoration: none; color: black;" href="index.php?halaman=transaksi">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 16 16">
                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z" />
                        <path d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z" />
                    </svg>
                    Transaksi
                </a>
                <a style="display: block; padding: 20px 30px; text-decoration: none; color: black;" href="logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                        <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                    Logout
                </a>
            </nav>
        </div>

        <div style="background-color: whitesmoke; min-height: 100vh; width: 100%;">
            <?php
            if (isset($_GET["halaman"])) {
                if ($_GET["halaman"] == 'home') {
                    include 'home.php';
                } else if ($_GET["halaman"] == 'produk') {
                    include 'produk.php';
                } else if ($_GET["halaman"] == 'pelanggan') {
                    include 'pelanggan.php';
                } else if ($_GET["halaman"] == 'transaksi') {
                    include 'transaksi.php';
                } else if ($_GET["halaman"] == 'tambahproduk') {
                    include 'tambahproduk.php';
                } else if ($_GET["halaman"] == 'hapusproduk') {
                    include 'hapusproduk.php';
                } else if ($_GET["halaman"] == 'editproduk') {
                    include 'editproduk.php';
                } else if ($_GET["halaman"] == 'transaksiproduk') {
                    include 'transaksiproduk.php';
                } else if ($_GET["halaman"] == 'buktitransfer') {
                    include 'buktitransfer.php';
                } else if ($_GET["halaman"] == 'terimapesanan') {
                    include 'terimapesanan.php';
                } else if ($_GET["halaman"] == 'kirim') {
                    include 'kirim.php';
                }
            } else {
                include 'home.php';
            }

            ?>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>

</html>
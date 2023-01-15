<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$searchValueInHeader = "";
if (isset($_GET["search"])) {

    $searchValueInHeader = $_GET["search"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BroBaits - Minőségi pelletek és etetőanyagok</title>
    <link rel="icon" type="image/x-icon" href="img/logovariations/brobaits_favicon.png">
    <!-- BootStrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- DM Sans font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        <?php include('styles/style.css');
        include('styles/fishbook.css'); ?>
    </style>
</head>

<body>
    <a href="#brobaits-header" class="go-top-button dffc">
        <i class="bi bi-caret-up-fill"></i>
        <span>A legtetejére!</span>
    </a>

    <header class="header" id="brobaits-header">

        <div class="header-row dfsb maxw">
            <div class="header-row-image-container">
                <a href="index.php" class="header-row-link"><img src="img/logovariations/brobaits_logo-dark.png" alt="brobaits-logo"></a>
            </div>
            <div class="header-row-link-container">
                <a href="index.php" class="header-row-link">Főoldal</a>
                <a href="shop.php" class="header-row-link">Webshop</a>
                <a href="partners.php" class="header-row-link">Partnereink</a>
                <a href="contact.php" class="header-row-link">Kapcsolat</a>
                <a href="about.php" class="header-row-link">Rólunk</a>
            </div>
            <div class="header-row-social-container">
                <a href="cart.php" class="header-row-link"><i class="bi bi-cart-fill"></i></a>
                <?php if (isset($_SESSION["userName"])) : ?>
                    <a href="profile.php" class="header-row-link user-profile-active">
                        <i class="bi bi-person-fill"></i></a>
                <?php else : ?>
                    <a href="profile.php" class="header-row-link"><i class="bi bi-person-fill"></i></a>
                <?php endif ?>
                <input type="checkbox" class="header-row-link header-search">
                <i class="bi bi-search"></i>
                <form action="shop.php?search=<?= $searchValueInHeader ?>" method="GET" class="header-search-bar dffc">
                    <input type="text" name="search" placeholder="Ide írd be amit keresel...">
                    <input type="submit" class="button-green" value="mehet">
                    <span></span>
                </form>
            </div>
        </div>

    </header>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php

require_once("components/header.php");
require_once("db/database.php");
require_once("db/secrets.php");
Database::connect();

if (isset($_GET["id"])) {
  $productId = $_GET["id"];

  if (isset($_SESSION["cart"][$productId])) {
    $_SESSION["cart"][$productId] = $_SESSION["cart"][$productId] + 1;
  } else {
    $_SESSION["cart"][$productId] = 1;
  }

  header("Location: cart.php");
  ob_end_flush();
  exit();
} else if (isset($_GET["remove"])) {
  $productId = $_GET["remove"];

  if (isset($_SESSION["cart"][$productId])) {
    if ($_SESSION["cart"][$productId] > 1) {
      $_SESSION["cart"][$productId] = $_SESSION["cart"][$productId] - 1;
    } else {
      unset($_SESSION["cart"][$productId]);
    }
  }

  header("Location: cart.php");
  ob_end_flush();
  exit();
} else if (isset($_GET["delete"])) {
  $productId = $_GET["delete"];

  if (isset($_SESSION["cart"][$productId])) {
    unset($_SESSION["cart"][$productId]);
  }

  header("Location: cart.php");
  die();
}

if (isset($_SESSION["cart"])) {
  $cartIDs = $_SESSION["cart"];
} else {
  $cartIDs = [];
}

$cart = [];

foreach ($cartIDs as $cartID => $count) {
  $cart[] = [
    "product" => Database::getProductById($cartID),
    "count" => $count,
  ];
}

$sum = 0;

foreach ($cart as $cartItem) {

  $product = $cartItem["product"];
  $count = $cartItem["count"];

  if ($product->discount > 0) {
    $discPrice = 100 - $product->discount;
    $discPrice = $discPrice * 0.01;
    $discPrice = $discPrice * $product->price;

    $sum += $discPrice * $count;
  } else {
    $sum += $product->price * $count;
  }
}


?>

<section id="cart-main-section" class="section whitebg">
  <div class="homepage-main maxw dfsb">
    <div class="homepage-main-hero section-text-button cart-left-container">
      <div class="homepage-main-title">
        <h4 class="title-firstline">Az én</h4>
        <h1 class="title-secondline-h1 greencolor">Kosaram</h1>
      </div>
      <p class="section-paragraph-gray">A legtöbb termék esetében a kiszállítási idő 1-3 napot vesz igénybe, amely szám a megtett távolságtól és a készleten lévő darabszámtól is függ. Minden termékre (beleértve a forgalmazóktól érkező pellet- és etetőanyagcsomagokat) 1 év garanciát vállalunk, amely akció igénybevételéhez a terméknek sértetlen, bontatlan csomagolásban kell visszaérkeznie központi raktárunkba - ez alól természetesen kivételt képeznek a lejárt, avagy rossz minőségű pellet- és etetőanyagcsomagok.</p>
    </div>
    <div class="cart-right-container">


      <?php if ($cart) : ?>
        <p style="color:#777;" class="section-paddinglow dffs">10 000 Ft feletti vásárlás esetén a szállítás ingyenes!<i class="bi bi-truck"></i></p>
        <div class="cart-subpage-item-fullcontainer dfcc">
          <div class="cart-subpage-item dfcc">

            <div class="cart-subpage-title-firstrow dfsb">
              <h4>Megnevezés</h4>
              <h4>Súly/db</h4>
              <h4>Ár/db</h4>
              <h4>Kilós ár</h4>
              <h4>Darabszám</h4>
            </div>
            <?php
            foreach ($cart as $cartItem) {

              $product = $cartItem["product"];
              $count = $cartItem["count"];

              if ($product->discount > 0) {
                $discPrice = 100 - $product->discount;
                $discPrice = $discPrice * 0.01;
                $discPrice = $discPrice * $product->price;

                echo "
                  <div class='cart-subpage-item-titlebox dffs'>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p style='font-weight: bold;'>{$product->name}</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->weight} g</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$discPrice} Ft <span style='color:#65A850;'>(Akció!)</span></p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->unitPrice} (Ft/kg)</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                      <div class='dffc'>
                        <a class='dffc' href='cart.php?remove={$product->id}' type='button'><span class='dffc'><i class='bi bi-dash-circle'></i></span></a>
                        <input type='text' readonly
                        value='{$count}'>
                        <a class='dffc' href='cart.php?id={$product->id}' type='button'><span class='dffc'><i class='bi bi-plus-circle'></i></span></a>
                        <a class='dffc' href='cart.php?delete={$product->id}' class='btn btn-outline-secondary ms-2' type='button'><i class='bi bi-x'></i></a>
                      </div>
                    </div>
                  </div>
              ";
              } else {
                echo "
                  <div class='cart-subpage-item-titlebox dffs'>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p style='font-weight: bold;'>{$product->name}</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->weight} g</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->price} Ft</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->unitPrice} (Ft/kg)</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                      <div class='dffc'>
                        <a class='dffc' href='cart.php?remove={$product->id}' type='button'><span class='dffc'><i class='bi bi-dash-circle'></i></span></a>
                        <input type='text' readonly
                        value='{$count}'>
                        <a class='dffc' href='cart.php?id={$product->id}' type='button'><span class='dffc'><i class='bi bi-plus-circle'></i></span></a>
                        <a class='dffc' href='cart.php?delete={$product->id}' class='btn btn-outline-secondary ms-2' type='button'><i class='bi bi-x'></i></a>
                      </div>
                    </div>
                  </div>
              ";
              }
            }
            ?>
          </div>


          <div class="cart-subpage-checkout dfsb">

            <div class="cart-subpage-checkout-td dfcc">
              <h4>Szállítási költség</h4>

              <?php if ($sum > 10000) {

                echo "<p style='color:#65A850;'>Ingyenes!</p>";
              } else if ($sum < 10000) {
                $sum = $sum + $deliveryPrice;

                echo "<p>$deliveryPrice Ft</p>";
              } else if ($sum = 10000) {
                echo "<p style='color:#65A850;'>Ingyenes!</p>";
              }
              ?>

            </div>
            <div class="cart-subpage-checkout-td dfcc">
              <h4>Végösszeg</h4>
              <p><?= $sum ?> Ft</p>
            </div>
            <div class="cart-subpage-checkout-td">
              <?php if (empty($cart)) : ?>
                <a class="button-green" disabled>RENDELÉS</a>
              <?php else : ?>
                <a class="button-green" href="checkout.php">RENDELÉS<i class="bi bi-bag-heart"></i></a>
              <?php endif ?>
            </div>
          </div>
        </div>

      <?php else : ?>
        <div class="cart-noitem dfsb">
          <h4>Nincs termék a kosaradban! Irány vásárolni!</h4>
          <a href="shop.php" class="button-green">termékek<i class="bi bi-bag-heart"></i></a>
        </div>
      <?php endif ?>

    </div>
  </div>



  </div>
  </div>
  </div>
</section>
<?php require_once("components/footer.php") ?>
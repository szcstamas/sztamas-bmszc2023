<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("components/header.php") ?>

<?php

require_once("db/database.php");


if (isset($_SESSION["loginAdmin"])) {
  $user = $_SESSION["loginAdmin"];
}

//csatlakozás az adatbázishoz
Database::connect();

if (isset($_POST["signout"])) {

  //szedje ki az adataimat a munkamenetből
  //munkamenet megszüntetése
  session_unset();
  session_destroy();
  $_SESSION = array();
}

//if deleteproduct is set in url, call deleteProductById from db.php
if (isset($_GET["deleteproduct"])) {
  $deleteProductId = $_GET["deleteproduct"];
  Database::deleteProductById($deleteProductId);
  header("Location: admin.php");
  ob_end_flush();
  exit();
}

//if recoverproduct is set in url, call recoverProductById from db.php
if (isset($_GET["recoverproduct"])) {
  $recoverProductId = $_GET["recoverproduct"];
  Database::recoverProductById($recoverProductId);
  header("Location: admin.php");
  ob_end_flush();
  exit();
}

//if recoverproduct is set in url, call recoverProductById from db.php
if (isset($_GET["restockproduct"])) {
  $restockProductId = $_GET["restockproduct"];
  Database::restockProductById($restockProductId);
  header("Location: admin.php");
  ob_end_flush();
  exit();
}

//if deleteorder is set in url, call deleteOrderById from db.php
if (isset($_GET["completeorder"])) {
  $completeOrderId = $_GET["completeorder"];
  Database::completeOrderById($completeOrderId);
  header("Location: admin.php");
  ob_end_flush();
  exit();
}

//if deleteorder is set in url, call deleteOrderById from db.php
if (isset($_GET["deleteorder"])) {
  $deleteOrderId = $_GET["deleteorder"];
  Database::deleteOrderById($deleteOrderId);
  header("Location: admin.php");
  ob_end_flush();
  exit();
}

//az összes item megjelenítése az adatbázisból
$products = Database::getAllProductsOnAdmin();
$orders = Database::getAllOrders();

?>

<?php if (!isset($_SESSION["loginAdmin"])) : ?>

  <section class='section maxw admin-section admin-login-error'>
    <h2>Bejelentkezés szükséges!</h2>
    <p>A gomb segítségével látogass el a bejelentkezési felületre!</p>
    <a href='adminlogin.php'><button class='button-green'>bejelentkezés</button></a>
  </section>

<?php else : ?>

  <section class='section-paddinglow maxw admin-section dfsb'>
    <h2>Bejelentkezve mint: <span style="color:#65A850;"><?= $user ?></span></h2>
    <form method="POST">
      <button type="submit" name="signout" class="button-gray">kijelentkezés</button>
    </form>
  </section>

  <hr class="maxw">

  <div class='section-paddinglow maxw admin-section admin-login-error'>
    <h2>Rendelések</h2>
    <table class="admin-products-list">
      <?php foreach ($orders as $order) : ?>
        <tr>
          <th>ID</th>
          <th>Termék neve</th>
          <th>Darabszám</th>
          <th>Megrendelő neve</th>
          <th>Megrendelés dátuma</th>
          <th>Megrendelő e-mail címe</th>
          <th>Fizetett összeg</th>
          <th>Szállítási cím (irányítószám)</th>
          <th>Szállítási cím (város)</th>
          <th class="admin-product-action">Rendelés interakciók</th>
        </tr>
        <tr>
          <td>
            <div class="dffc" style="background-color:#f2f2f2;width:40px;height:40px;border-radius:50%;margin:auto;"><b><?= $order->id ?></b></div>
          </td>
          <td><?= $order->productName ?></td>
          <td><?= $order->productQuantity ?></td>
          <td><?= $order->name ?></td>
          <td><?= $order->date ?></td>
          <td><?= $order->email ?></td>
          <td><?= $order->totalPrice ?> Ft</td>
          <td><?= $order->deliveryPostcode ?></td>
          <td><?= $order->deliveryCity ?></td>
          <td rowspan="3" style="text-align:right;">

            <?php
            if ($order->completed === 1) {
              echo "
              <div class='dfc'>
              <a class='admin-btn' role='link' aria-disabled='true' style='opacity:0.5;cursor:default;' href='completeorder.php?id=$order->id'>
                <i class='bi bi-check-lg'></i>
              </a>
              <a class='admin-btn' title='Rendelés törlése' href='?deleteorder=$order->id'>
                <i class='bi bi-trash'></i>
              </a>
              </div>  
          ";
            } else if ($order->completed === 0) {
              echo "
              <div class='dfc'>
              <a class='admin-btn' title='Rendelés teljesítése' href='?completeorder=$order->id'>
                <i class='bi bi-check-lg'></i>
              </a>
              <a class='admin-btn' title='Rendelés törlése' href='?deleteorder=$order->id'>
                <i class='bi bi-trash'></i>
              </a>
              </div>
          ";
            }
            ?>
          </td>
        </tr>

        <tr>
          <th>Szállítási cím (utca/házszám)</th>
          <th>Számlázási cím (irányítószám)</th>
          <th>Számlázási cím (város)</th>
          <th>Számlázási cím (utca/házszám)</th>
          <th>Megjegyzés</th>
          <th>Készen van?</th>
          <th>Kézbesítés dátuma</th>
          <th>Regisztrált ügyfél?</th>
          <th>Felhasználónév</th>
        </tr>

        <tr>
          <td><?= $order->deliveryStreet ?></td>
          <td><?= $order->billPostcode ?></td>
          <td><?= $order->billCity ?></td>
          <td><?= $order->billStreet ?></td>
          <td>
            <div style="height:100px; overflow:scroll;"><?= $order->comment ?></div>
          </td>
          <td><?= $order->completed > 0 ? "<span class='dffs' style='color:#65A850;font-weight:bold;'>Igen <i class='bi bi-check-square' style='color:#65A850;'></i></span>" : "Nem" ?></td>
          <td><?= $order->completedAt === '0000-00-00' ?  $order->completedAt : "<span class='dffs' style='color:#65A850;font-weight:bold;'>$order->completedAt</span>" ?></td>
          <td><?= $order->isUser > 0 ? "Igen" : "Nem" ?></td>
          <td><?= $order->username = "no-user" ? "-" : $order->username ?></td>
        </tr>
        <tr>
          <td colspan="10" style="background-color:#f2f2f2;padding:1rem;border:1px solid #f2f2f2;border-bottom: 1px solid #65A850;"></td>
        </tr>
      <?php endforeach ?>
    </table>

    <div class='section-paddinglow maxw admin-section admin-login-error'>
      <div class="dffs">
        <h2>Termékek</h2>
        <a href="newproduct.php" class="button-green">Termékek hozzáadása</a>
      </div>
      <table class="admin-products-list">
        <?php foreach ($products as $product) : ?>
          <tr>
            <th>Kép</th>
            <th>ID</th>
            <th>Név</th>
            <th>Leírás részlete</th>
            <th>Ár(Ft)</th>
            <th>Darabszám</th>
            <th>Elérhető?</th>
            <th>Súly(g)</th>
            <th>Ár(Ft/kg)</th>
            <th class="admin-product-action">Termék szerkesztése</th>
          </tr>
          <tr>
            <td rowspan="3"><img style="max-width:150px;" src="img/products/<?= $product->image ?>" alt="<?= $product->image ?>"></td>
            <td style="text-align:center;">
              <div class="dffc" style="background-color:#f2f2f2;width:40px;height:40px;border-radius:50%;margin:auto;"><b><?= $product->id ?></b></div>
            </td>
            <td><?= $product->name ?></td>
            <td>
              <div style="height:100px; overflow:scroll;"><?= $product->description ?></div>
            </td>
            <td><?= $product->price ?></td>
            <td><?= $product->quantity ?></td>
            <td><?= $product->quantity > 0 ? "Igen" : "Nem" ?></td>
            <td><?= $product->weight ?></td>
            <td><?= $product->unitPrice ?></td>
            <td style="text-align:right;">

              <?php
              if ($product->deletedAt != "0000-00-00") {
                echo "
          <div class='dffc'>
                <span style='margin-right:10px;color: #dc3545;'>Inaktív</span>
          <a class='admin-btn' role='link' aria-disabled='true' style='opacity:0.5;cursor:default;'>
            <i class='bi bi-pencil'></i>
          </a>
          <a class='admin-btn' role='link' aria-disabled='true' style='opacity:0.5;cursor:default;'>
            <i class='bi bi-trash'></i>
          </a>
          <a class='admin-btn' title='Alapértelmezett árufeltöltés(50)' href='?recoverproduct=$product->id'>
            <i class='bi bi-arrow-clockwise'></i>
          </a>
          </div>
          ";
              } else if ($product->quantity === 0) {
                echo "
          <div class='dffc'>
                <span style='margin-right:10px;color: #dc3545;'>Elfogyott</span>
          <a class='admin-btn' role='link' aria-disabled='true' style='opacity:0.5;cursor:default;'>
            <i class='bi bi-pencil'></i>
          </a>
          <a class='admin-btn' role='link' aria-disabled='true' style='opacity:0.5;cursor:default;'>
            <i class='bi bi-trash'></i>
          </a>
          <a class='admin-btn' title='Alapértelmezett árufeltöltés(50)' href='?restockproduct=$product->id'>
            <i class='bi bi-arrow-clockwise'></i>
          </a>
          </div>
          ";
              } else {
                echo "
                <div class='dfc'>
          <a class='admin-btn' title='Termék szerkesztése' href='editproduct.php?id=$product->id'>
            <i class='bi bi-pencil'></i>
          </a>
          <a class='admin-btn' title='Termék törlése' href='?deleteproduct=$product->id'>
            <i class='bi bi-trash'></i>
          </a>
          </div>
          ";
              }
              ?>
            </td>
          </tr>

          <tr>
            <th>Pelletek mérete</th>
            <th>Íz</th>
            <th>Szín</th>
            <th>Összetevők</th>
            <th>Kategória</th>
            <th>Preferált halak</th>
            <th>Aktuális kedvezmény(%)</th>
            <th>Hozzáadás dátuma</th>
            <th>Törlés dátuma</th>
          </tr>

          <tr>
            <td><?= $product->unitSize ?></td>
            <td><?= $product->flavour ?></td>
            <td><?= $product->colour ?></td>
            <td><?= $product->components ?></td>
            <td><?= $product->category ?></td>
            <td><?= $product->preFishes ?></td>
            <td><?= $product->discount ?></td>
            <td><?= $product->createdAt ?></td>
            <td><?= $product->deletedAt ?></td>
          </tr>
          <tr>
            <td colspan="10" style="background-color:#f2f2f2;padding:1rem;border:1px solid #f2f2f2;border-bottom: 1px solid #65A850;"></td>
          </tr>
        <?php endforeach ?>
      </table>
    </div>
  </div>
<?php endif ?>

<?php require_once("components/footer.php") ?>
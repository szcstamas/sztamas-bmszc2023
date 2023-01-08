<?php session_start(); ?>
<?php require_once("components/header.php") ?>

<?php

require_once("db/database.php");


if (isset($_SESSION["loginAdmin"])) {
  $user = $_SESSION["loginAdmin"];
}

//connect to database
Database::connect();

if (isset($_POST["signout"])) {

  //szedje ki az adataimat a munkamenetből
  session_unset();
  session_destroy();
  $_SESSION = array();
}

//if deleteproduct is set in url, call deleteProductById from db.php
if (isset($_GET["deleteproduct"])) {
  $deleteProductId = $_GET["deleteproduct"];
  Database::deleteProductById($deleteProductId);
  header("Location: admin.php");
  exit();
}

//if recoverproduct is set in url, call recoverProductById from db.php
if (isset($_GET["recoverproduct"])) {
  $recoverProductId = $_GET["recoverproduct"];
  Database::recoverProductById($recoverProductId);
  header("Location: admin.php");
  exit();
}

//if deleteorder is set in url, call deleteOrderById from db.php
if (isset($_GET["deleteorder"])) {
  $deleteOrderId = $_GET["deleteorder"];
  Database::deleteOrderById($deleteOrderId);
  header("Location: admin.php");
  exit();
}

//display orders from table called "webshop-orders" in our database
// $orders = Database::getAllOrders();

//display products from table called "products" in our database
$products = Database::getAllProductsOnAdmin();

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
    <div class="dfc">
      <h2>Rendelések</h2>
    </div>

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
            <th>Ár</th>
            <th>Darabszám</th>
            <th>Elérhető?</th>
            <th>Súly</th>
            <th>Ár/kg</th>
            <th class="admin-product-action">Termék szerkesztése</th>
          </tr>
          <tr>
            <td rowspan="3"><img style="max-width:150px;" src="img/products/<?= $product->image ?>" alt="<?= $product->image ?>"></td>
            <td style="text-align:center;">
              <div class="dffc" style="background-color:#f2f2f2;width:40px;height:40px;border-radius:50%;margin:auto;"><b><?= $product->id ?></b></div>
            </td>
            <td><?= $product->name ?></td>
            <td>
              <div style="height:100px; overflow:hidden"><?= $product->description ?></div>
            </td>
            <td><?= $product->price ?></td>
            <td><?= $product->quantity ?></td>
            <td><?= $product->onStock == 1 ? "Igen" : "Nem" ?></td>
            <td><?= $product->weight ?></td>
            <td><?= $product->unitPrice ?></td>
            <td style="text-align:right;">

              <?php
              if ($product->deletedAt != "0000-00-00") {
                echo "
          <span style='margin-right:10px;color: #dc3545;'>Disabled</span>
          <a class='btn btn-sm btn-warning me-1' role='link' aria-disabled='true' style='opacity:0.5;cursor:default;'>
            <i class='bi bi-pencil'></i>
          </a>
          <a class='btn btn-sm btn-danger me-1' role='link' aria-disabled='true' style='opacity:0.5;cursor:default;'>
            <i class='bi bi-trash'></i>
          </a>
          <a class='btn btn-sm btn-secondary' title='Recover item' href='?recoverproduct=$product->id'>
            <i class='bi bi-arrow-clockwise'></i>
          </a>
          ";
              } else {
                echo "
          <a class='btn btn-sm btn-warning me-1' title='Edit item' href='editproduct.php?id=$product->id'>
            <i class='bi bi-pencil'></i>
          </a>
          <a class='btn btn-sm btn-danger' title='Delete item' href='?deleteproduct=$product->id'>
            <i class='bi bi-trash'></i>
          </a>
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
            <th>Aktuális kedvezmény</th>
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
            <td colspan="10" style="background-color:#f2f2f2;padding:1rem;border:1px solid #f2f2f2;"></td>
          </tr>
        <?php endforeach ?>
      </table>
    </div>
  </div>
<?php endif ?>

<?php require_once("components/footer.php") ?>
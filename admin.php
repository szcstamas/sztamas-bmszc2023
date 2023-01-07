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
  setcookie(session_name(), '', 100);
  session_unset();
  session_destroy();
  $_SESSION = array();
  //irányítson vissza
  // header("Location: /sztamas-bmszc2023/admin.php");
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
// $products = Database::getAllProductsOnAdmin();

?>

<?php if (!isset($_SESSION["loginAdmin"])) : ?>

  <div class='section maxw admin-section admin-login-error'>
    <h2>Bejelentkezés szükséges!</h2>
    <p>A gomb segítségével látogass el a bejelentkezési felületre!</p>
    <a href='adminlogin.php'><button class='button-green'>bejelentkezés</button></a>
  </div>

<?php else : ?>

  <div class='section maxw admin-section admin-login-error'>
    <h2>Bejelentkezve mint: <?= $user ?></h2>
    <p>A gomb segítségével kijelentkezhetsz!</p>
    <form method="POST">
      <button type="submit" name="signout" class="button-danger">kijelentkezés</button>
    </form>
  </div>

  <h4>Orders</h4>

  <?php if (!$orders) : ?>
    <p style="margin: 20px 0;">There are no orders.</p>

  <?php else : ?>
    <table class="table table-sm">
      <thead>
        <th>ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Address</th>
        <th>Total</th>
        <th>Date</th>
        <th></th>
      </thead>

      <?php foreach ($orders as $order) : ?>
        <tr>
          <td><?= $order->id ?></td>
          <td><?= $order->email ?></td>
          <td><?= $order->name ?></td>
          <td><?= $order->address ?></td>
          <td><?= $order->total ?></td>
          <td><?= $order->date ?></td>
          <td style="text-align:right;">
            <a class="btn btn-sm btn-danger" href="?deleteorder=<?= $order->id ?>">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach ?>
    </table>

  <?php endif ?>

  <h4>Products</h4>
  <a href="newproduct.php" class="btn btn-primary">Add Product</a>
  <table class="table table-sm">
    <thead>
      <th>ID</th>
      <th>Name</th>
      <th>In Stock</th>
      <th>Created At</th>
      <th></th>
    </thead>

    <?php foreach ($products as $product) : ?>
      <tr>
        <td><?= $product->id ?></td>
        <td><?= $product->name ?></td>
        <td><?= $product->inStock == 1 ? "Yes" : "No" ?></td>
        <td><?= $product->createdAt ?></td>
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
    <?php endforeach ?>
  </table>
<?php endif ?>

<?php require_once("components/footer.php") ?>
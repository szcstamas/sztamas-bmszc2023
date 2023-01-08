<?php require_once("components/header.php") ?>

<?php

$error = "";
require_once("model/product.php");
require_once("db/database.php");

//authentikáció
if (isset($_SESSION["loginAdmin"])) {
  $user = $_SESSION["loginAdmin"];
}

//csatlakozás az adatbázishoz 
Database::connect();

if (isset($_GET["id"])) {
  $productId = $_GET["id"];
  $product = Database::getProductById($productId);
}

if (isset($_GET["category"])) {
  $category = $_GET["category"];
} else {
  $category = "unknown";
}

if (
  isset($_POST["id"]) &&
  isset($_POST["name"]) &&
  isset($_POST["price"]) &&
  isset($_POST["category"]) &&
  isset($_POST["description"])
) {

  $id = $_POST["id"];
  $name = $_POST["name"];
  $price = $_POST["price"];
  $category = $_POST["category"];
  $description = $_POST["description"];

  //if new image is chosen with file-input and checkbox is CHECKED under it
  if ($_FILES["image"]["size"] != 0 && isset($_POST['image-delete'])) {

    //delete images when uploading new image for same item with same name
    $dir = 'img/';
    $files1 = scandir($dir);

    foreach ($files1 as $filename) {
      $pos = strpos($filename, $name);

      if ($pos !== false) {
        unlink("img/$filename");
      }
    }

    //convert name of image to the following: nameOfItem_date.jpg (spaces are changed to underscore)
    $filename = strtolower(str_replace(" ", "_", $_POST["name"])) . "_" . date('m_d_y_h_i_s') . ".jpg";

    //put uploaded image to "/img" folder
    $target = "img/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
  } else {
    $filename = $product->image;
  }
  //if new image is set with input file and checkbox is NOT checked under it
  if ($_FILES["image"]["size"] != 0 && !isset($_POST['image-delete'])) {
    //convert name of image to the following: nameOfItem_date.jpg (spaces are changed to underscore)
    $filename = strtolower(str_replace(" ", "_", $_POST["name"])) . "_" . date('m_d_y_h_i_s') . ".jpg";

    //put uploaded image to "/img" folder
    $target = "img/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
  }

  switch ($category) {
    case "pellet": {

        $editedProduct = new Product($id, $name, $description, $image, $price, $quantity, $onStock, $weight, $unitPrice, $unitSize, $flavour, $colour, $components, $category, $preFishes, $discount, $createdAt, $deletedAt);
        break;
      }
    case "feed": {

        $editedProduct = new Product($id, $name, $description, $image, $price, $quantity, $onStock, $weight, $unitPrice, $unitSize, $flavour, $colour, $components, $category, $preFishes, $discount, $createdAt, $deletedAt);
        break;
      }
  }

  Database::updateProduct($editedProduct);

  header("Location: admin.php");
  exit();
}

?>

<?php if (!isset($_SESSION["loginAdmin"])) : ?>
  <section class='section maxw admin-section admin-login-error'>
    <h2>Bejelentkezés szükséges!</h2>
    <p>A gomb segítségével látogass el a bejelentkezési felületre!</p>
    <a href='adminlogin.php'><button class='button-green'>bejelentkezés</button></a>
  </section>
<?php else : ?>
  <section class='section maxw admin-section admin-login-error'>
    <div class="dfc">
      <h1>Termék szerkesztése</h1>
      <p class="text-danger"><?= $error ?></p>
    </div>
    <!--az enctype az image feltöltése miatt kell, máskülönben nem adhatunk hozzá képet-->
    <form class="product-form-grid" method="POST" enctype="multipart/form-data">
      <div class="product-form-container">
        <label for="id" class="product-form-label">ID</label>
        <input type="id" id="id" class="product-form-input" readonly name="id" value="<?= $product->id ?>">
      </div>
      <div class="product-form-container">
        <label for="name" class="product-form-label">Név</label>
        <input type="name" id="name" class="product-form-input" name="name" value="<?= $product->name ?>">
      </div>
      <div class="product-form-container">
        <label for="price" class="product-form-label">Ár</label>
        <input type="number" id="price" class="product-form-input" name="price" value="<?= $product->price ?>">
      </div>
      <div class="product-form-container">
        <label for="unitPrice" class="product-form-label">Ár/kg</label>
        <input type="number" id="unitPrice" class="product-form-input" name="unitPrice" value="<?= $product->unitPrice ?>">
      </div>
      <div class="product-form-container">
        <label for="description" class="product-form-label">Leírás</label>
        <input type="text" id="description" class="product-form-input" name="description" value="<?= htmlspecialchars($product->description) ?>">
      </div>
      <div class="product-form-container">
        <label for="createdAt" class="product-form-label">Feltöltve ekkor</label>
        <input type="text" readonly id="createdAt" class="product-form-input" value="<?= $product->createdAt ?>">
      </div>
      <div class="product-form-container">
        <label for="image" class="product-form-label">Kép</label>
        <input id="image" type="file" name="image" class="product-form-input" value="<?= $product->image ?>">
      </div>
      <div class="product-form-container">
        <input id="image-delete" type="checkbox" name="image-delete" style="margin-right:8px;" class="product-check-input">
        <label for="image-delete" class="product-check-label">Azonos elnevezésű képek törlése</label>
      </div>
      <div class="product-form-container">
        <label for="quantity" class="product-form-label">Darabszám</label>
        <input type="number" id="quantity" class="product-form-input" name="quantity" value="<?= $product->quantity ?>">
      </div>
      <div class="product-form-container">
        <label for="weight" class="product-form-label">Súly</label>
        <input type="number" id="weight" class="product-form-input" name="weight" value="<?= $product->weight ?>">
      </div>
      <div class="product-form-container">
        <label for="unitSize" class="product-form-label">Szemcsék mérete</label>
        <select class="product-select" name="unitSize">
          <option value="2-6" <?= $product->unitSize == "2-6" ? "selected" : "" ?>>2-6</option>
          <option value="4-8" <?= $product->unitSize == "4-8" ? "selected" : "" ?>>4-8</option>
          <option value="6-8" <?= $product->unitSize == "6-8" ? "selected" : "" ?>>6-8</option>
          <option value="10-12" <?= $product->unitSize == "10-12" ? "selected" : "" ?>>10-12</option>
          <option value="14-16" <?= $product->unitSize == "14-16" ? "selected" : "" ?>>14-16</option>
        </select>
      </div>
      <div class="product-form-container">
        <label for="flavour" class="product-form-label">Íz</label>
        <input type="text" id="flavour" class="product-form-input" name="flavour" value="<?= $product->flavour ?>">
      </div>
      <div class="product-form-container">
        <label for="colour" class="product-form-label">Szín</label>
        <input type="text" id="colour" class="product-form-input" name="colour" value="<?= $product->colour ?>">
      </div>
      <div class="product-form-container">
        <label for="components" class="product-form-label">Összetevők</label>
        <input type="text" id="components" class="product-form-input" name="components" value="<?= $product->components ?>">
      </div>
      <div class="product-form-container">
        <label for="preFishes" class="product-form-label">Preferált halfajták</label>
        <input type="text" id="preFishes" class="product-form-input" name="preFishes" value="<?= $product->preFishes ?>">
      </div>
      <div class="product-form-container">
        <label for="discount" class="product-form-label">Aktuális kedvezmény</label>
        <input type="number" id="discount" class="product-form-input" name="discount" value="<?= $product->discount ?>">
      </div>
      <!-- <input type="hidden" name="category" value="camera"> -->
      <!-- <input type="hidden" name="category" value="monitor"> -->
      <!-- <input type="hidden" name="category" value="clothing"> -->
      <button type="submit" class="button-green">Save</button>
    </form>
  </section>


<?php endif ?>
<?php require_once("components/footer.php") ?>
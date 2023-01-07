<?php require_once("components/header.php") ?>

<?php

$error = "";

require_once("model/camera.php");
require_once("model/monitor.php");
require_once("model/clothing.php");
require_once("db/database.php");

// 1. legyen levedve felhasznalonev/jelszoval az oldal
if (
  isset($_SERVER['PHP_AUTH_USER']) &&
  isset($_SERVER['PHP_AUTH_PW']) &&
  $_SERVER['PHP_AUTH_USER'] == "admin" &&
  $_SERVER['PHP_AUTH_PW'] == "webshop123"
) {
} else {
  header('WWW-Authenticate: Basic realm="webshop"');
  header('HTTP/1.0 401 Unauthorized');
  echo 'You cannot access the Admin console';
  exit();
}

// 2. olvassuk be az "id" parametert
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
    case "monitor": {
        $displaySize = $_POST["display-size"];
        $refreshRate = $_POST["refresh-rate"];
        $resolutionH = $_POST["resolution-h"];
        $resolutionV = $_POST["resolution-v"];

        $editedProduct = new Monitor($id, $name, $price, true, $description, $filename, NULL, NULL, $displaySize, $refreshRate, $resolutionH, $resolutionV);
        break;
      }
    case "camera": {
        $resolution = $_POST["resolution"];
        $ilc = $_POST["ilc"];
        $weight = $_POST["weight"];
        $batteryLife = $_POST["battery-life"];

        $editedProduct = new Camera($id, $name, $price, true, $description, $filename, NULL, NULL, $resolution, $ilc, $weight, $batteryLife);
        break;
      }
    case "clothing": {
        $size = $_POST["size"];
        $colour = $_POST["colour"];

        $editedProduct = new Clothing($id, $name, $price, true, $description, $filename, NULL, NULL, $size, $colour);
        break;
      }
  }

  Database::updateProduct($editedProduct);

  header("Location: admin.php");
  exit();
}

?>

<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-body">
        <h1>Edit Product</h1>
        <p class="text-danger"><?= $error ?></p>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="id" id="id" class="form-control" readonly name="id" value="<?= $product->id ?>">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" id="name" class="form-control" name="name" value="<?= $product->name ?>">
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" class="form-control" name="price" value="<?= $product->price ?>">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" class="form-control" name="description" value="<?= htmlspecialchars($product->description) ?>">
          </div>
          <div class="mb-3">
            <label for="created-at" class="form-label">Created At</label>
            <input type="text" readonly id="created-at" class="form-control" value="<?= $product->createdAt ?>">
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input id="image" type="file" name="image" class="form-control" value="<?= $product->image ?>">
          </div>
          <div class="mb-3">
            <input id="image-delete" type="checkbox" name="image-delete" style="margin-right:8px;" class="form-check-input">
            <label for="image-delete" class="form-check-label">Delete previous images</label>
          </div>

          <hr>

          <?php if ($product instanceof Camera) : ?>
            <div class="mb-3">
              <label for="resolution" class="form-label">Resolution</label>
              <input type="number" id="resolution" class="form-control" name="resolution" value="<?= $product->resolution ?>">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" id="ilc" name="ilc" class="form-check-input" <?= $product->ilc ? "checked" : "" ?>>
              <label class="form-check-label" for="ilc">ILC</label>
            </div>
            <div class="mb-3">
              <label for="weight" class="form-label">Weight</label>
              <input type="number" id="weight" class="form-control" name="weight" value="<?= $product->weight ?>">
            </div>
            <div class="mb-3">
              <label for="battery-life" class="form-label">Battery Life</label>
              <input type="number" id="battery-life" class="form-control" name="battery-life" value="<?= $product->batteryLife ?>">
            </div>
            <input type="hidden" name="category" value="camera">
          <?php elseif ($product instanceof Monitor) : ?>
            <div class="mb-3">
              <label for="display-size" class="form-label">Display Size</label>
              <input type="number" id="display-size" class="form-control" name="display-size" value="<?= $product->size ?>">
            </div>
            <div class=" mb-3">
              <label for="refresh-rate" class="form-label">Refresh Rate</label>
              <input type="number" id="refresh-rate" class="form-control" name="refresh-rate" value="<?= $product->refreshRate ?>">
            </div>
            <div class=" mb-3">
              <label for="resolution-h" class="form-label">Horizontal Resolution</label>
              <input type="number" id="resolution-hdisplay-size" class="form-control" name="resolution-h" value="<?= $product->resolutionH ?>">
            </div>
            <div class=" mb-3">
              <label for="resolution-v" class="form-label">Vertical Resolution</label>
              <input type="number" id="resolution-v" class="form-control" name="resolution-v" value="<?= $product->resolutionV ?>">
            </div>
            <input type="hidden" name="category" value="monitor">
          <?php elseif ($product instanceof Clothing) : ?>
            <div class=" mb-3">
              <label for="display-size" class="form-label">Size</label>
              <select class="form-select mb-3" name="size">
                <option value="xs" <?= $product->size == "xs" ? "selected" : "" ?>>XS</option>
                <option value="s" <?= $product->size == "s" ? "selected" : "" ?>>S</option>
                <option value="m" <?= $product->size == "m" ? "selected" : "" ?>>M</option>
                <option value="l" <?= $product->size == "l" ? "selected" : "" ?>>L</option>
                <option value="xl" <?= $product->size == "xl" ? "selected" : "" ?>>XL</option>
                <option value="xxl" <?= $product->size == "xxl" ? "selected" : "" ?>>XXL</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="colour" class="form-label">Colour</label>
              <input type="text" id="colour" class="form-control" name="colour" value="<?= $product->colour ?>">
            </div>
            <input type="hidden" name="category" value="clothing">
          <?php endif ?>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once("components/footer.php") ?>
<?php require_once("components/footer.php") ?>
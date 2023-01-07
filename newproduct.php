<?php require_once("components/header.php") ?>

<?php

$error = "";

require_once("model/camera.php");
require_once("model/monitor.php");
require_once("model/clothing.php");
require_once("db/database.php");

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

if (isset($_GET["category"])) {
  $category = $_GET["category"];
} else {
  $category = "unknown";
}


if (
  isset($_POST["name"]) &&
  isset($_POST["price"]) &&
  isset($_POST["description"]) &&
  isset($_POST["category"])
) {
  $name = $_POST["name"];

  if ($_FILES["image"]["size"] != 0) {

    $filename = strtolower(str_replace(" ", "_", $_POST["name"])) . "_" . date('m_d_y_h_i_s') . ".jpg";

    $target = "img/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
  } else {
    $filename = "noimage.jpg";
  }

  $price = $_POST["price"];
  $description = $_POST["description"];
  $category = $_POST["category"];

  switch ($category) {
    case "monitor": {
        $displaySize = $_POST["display-size"];
        $refreshRate = $_POST["refresh-rate"];
        $resolutionH = $_POST["resolution-h"];
        $resolutionV = $_POST["resolution-v"];

        $newProduct = new Monitor(0, $name, $price, true, $description, $filename, NULL, NULL, $displaySize, $refreshRate, $resolutionH, $resolutionV);

        break;
      }
    case "camera": {
        $resolution = $_POST["resolution"];
        $ilc = $_POST["ilc"];
        $weight = $_POST["weight"];
        $batteryLife = $_POST["battery-life"];

        $newProduct = new Camera(0, $name, $price, true, $description, $filename, NULL, NULL, $resolution, $ilc, $weight, $batteryLife);
        break;
      }
    case "clothing": {
        $size = $_POST["size"];
        $colour = $_POST["colour"];

        $newProduct = new Clothing(0, $name, $price, true, $description, $filename, NULL, NULL, $size, $colour);
        break;
      }
  }

  Database::connect();

  Database::createProduct($newProduct);

  header("Location: admin.php");
  exit();
}

?>

<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-body">
        <h1>New Product</h1>
        <p class="text-danger"><?= $error ?></p>
        <?php if ($category != "unknown") : ?>
          <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="id" class="form-label">ID</label>
              <input type="id" id="id" class="form-control" readonly name="id">
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="name" id="name" class="form-control" name="name">
            </div>
            <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number" id="price" class="form-control" name="price">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <input type="text" id="description" class="form-control" name="description">
            </div>
            <div class="mb-3">
              <label for="created-at" class="form-label">Created At</label>
              <input type="text" readonly id="created-at" class="form-control">
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <input id="image" type="file" name="image" class="form-control">
            </div>



            <hr>

            <?php if ($category == "camera") : ?>
              <div class="mb-3">
                <label for="resolution" class="form-label">Resolution</label>
                <input type="number" id="resolution" class="form-control" name="resolution">
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" id="ilc" name="ilc" class="form-check-input">
                <label class="form-check-label" for="ilc">ILC</label>
              </div>
              <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" id="weight" class="form-control" name="weight">
              </div>
              <div class="mb-3">
                <label for="battery-life" class="form-label">Battery Life</label>
                <input type="number" id="battery-life" class="form-control" name="battery-life">
              </div>
            <?php elseif ($category == "monitor") : ?>
              <div class="mb-3">
                <label for="display-size" class="form-label">Display Size</label>
                <input type="number" id="display-size" class="form-control" name="display-size">
              </div>
              <div class="mb-3">
                <label for="refresh-rate" class="form-label">Refresh Rate</label>
                <input type="number" id="refresh-rate" class="form-control" name="refresh-rate">
              </div>
              <div class="mb-3">
                <label for="resolution-h" class="form-label">Horizontal Resolution</label>
                <input type="number" id="resolution-hdisplay-size" class="form-control" name="resolution-h">
              </div>
              <div class="mb-3">
                <label for="resolution-v" class="form-label">Vertical Resolution</label>
                <input type="number" id="resolution-v" class="form-control" name="resolution-v">
              </div>
            <?php elseif ($category == "clothing") : ?>
              <div class="mb-3">
                <label for="display-size" class="form-label">Size</label>
                <select class="form-select mb-3" name="size">
                  <option value="xs">XS</option>
                  <option value="s">S</option>
                  <option value="m">M</option>
                  <option value="l">L</option>
                  <option value="xl">XL</option>
                  <option value="xxl">XXL</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="colour" class="form-label">Colour</label>
                <input type="text" id="colour" class="form-control" name="colour">
              </div>
            <?php endif ?>
            <input type="hidden" name="category" value="<?= $category ?>">
            <button type="submit" name="checkout" class="btn btn-primary">Save</button>
          </form>
        <?php else : ?>
          <form method="GET">
            <select class="form-select mb-3" name="category">
              <option value="camera">Camera</option>
              <option value="monitor">Monitor</option>
              <option value="clothing">Clothing</option>
            </select>
            <button type="submit" class="btn btn-primary">Create</button>
          </form>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<?php require_once("components/footer.php") ?>
<?php require_once("components/footer.php") ?>
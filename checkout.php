<?php session_start() ?>
<?php require_once("components/header.php") ?>

<?php

require_once("db/database.php");
require_once("model/order.php");
Database::connect();

if (isset($_SESSION["cart"])) {
    $cartIDs = $_SESSION["cart"];
} else {
    $cartIDs = [];
}

if (empty($cartIDs)) {
    header("Location: cart.php");
    die();
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
    $sum += $cartItem["product"]->price * $cartItem["count"];
}

$error = "";

if (isset($_POST["checkout"])) {
    if (
        isset($_POST["email"]) &&
        isset($_POST["name"]) &&
        isset($_POST["address"]) &&
        isset($_POST["cardname"]) &&
        isset($_POST["cardnum"]) &&
        isset($_POST["cvv"]) &&
        isset($_POST["tnc"])
    ) {
        $order = new WebshopOrder(0, $_POST["email"], $_POST["name"], $_POST["address"], $sum, null);
        Database::createOrder($order);
        header("Location: checkout.php?success=1");
        unset($_SESSION["cart"]);
        die();
    } else {
        $error = "Kérjük, hogy töltsd ki az összes mezőt, majd a rendelés véglegesítéséhez fogadd el Felhasználói Feltételeinket. Köszönjük!";
    }
}
?>

<section id="checkout-section" class="section whitebg">
    <div class="homepage-main maxw">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Rendelés véglegesítése</h4>
            </div>
        </div>
        <p class="text-danger"><?= $error ?></p>
        <form method="POST">

            <div class="dffc">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="email" class="form-control" name="email">
            </div>
            <div class="dffc">
                <label for="name" class="form-label">Name</label>
                <input type="name" id="name" class="form-control" name="name">
            </div>
            <div class="dffc">
                <label for="address" class="form-label">Address</label>
                <input type="address" id="address" class="form-control" name="address">
            </div>

            <h4>Card Details</h4>
            <div class="dffc">
                <label for="cardname" class="form-label">Name on Card</label>
                <input type="name" id="cardname" class="form-control" name="cardname">
            </div>
            <div class="dffc">
                <label for="cardnum" class="form-label">Card Number</label>
                <input type="number" id="cardnum" class="form-control" name="cardnum">
            </div>
            <div class="dffc">
                <label for="cvv" class="form-label">CVV</label>
                <input type="number" id="cvv" class="form-control" name="cvv">
            </div>
            <div class="dffc form-check">
                <input type="checkbox" id="tnc" name="tnc" class="form-check-input">
                <label class="form-check-label" for="tnc">I accept the Terms and Conditions</label>
            </div>

            <h4>Total: $ <?= $sum ?> </h4>
            <button type="submit" name="checkout" class="btn btn-primary">Confirm Payment</button>
        </form>
    </div>
</section>

<?php require_once("components/footer.php") ?>
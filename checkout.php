<?php ob_start(); ?>
<?php require_once("components/header.php") ?>

<?php

require_once("db/database.php");
require_once("db/secrets.php");
require_once("model/order.php");
Database::connect();

if (isset($_SESSION["cart"])) {
    $cartIDs = $_SESSION["cart"];
} else {
    $cartIDs = [];
}

if (empty($cartIDs)) {
    header("Location: cart.php");
    ob_end_flush();
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

    $product = $cartItem["product"];
    $count = $cartItem["count"];

    if ($product->discount > 0) {
        $discPrice = 100 - $product->discount;
        $discPrice = $discPrice * 0.01;
        $discPrice = $discPrice * $product->price;
        $discPrice = round($discPrice);
        $discPrice = ceil($discPrice / 10) * 10;

        $sum += $discPrice * $count;
    } else {
        $sum += $product->price * $count;
    }
}

$error = "";

if (isset($_POST["checkout"])) {
    if (
        isset($_POST["name"]) &&
        isset($_POST["email"]) &&
        isset($_POST["deliveryPostalcode"]) &&
        isset($_POST["deliveryCity"]) &&
        isset($_POST["deliveryStreet"]) &&
        isset($_POST["billPostalcode"]) &&
        isset($_POST["billCity"]) &&
        isset($_POST["billStreet"]) &&
        isset($_POST["cardname"]) &&
        isset($_POST["cardnum"]) &&
        isset($_POST["cvv"]) &&
        isset($_POST["tnc"])
    ) {

        if (isset($_SESSION["userName"])) {

            $userName = $_SESSION["userName"];

            if (isset($_POST["comment"]) && !empty($_POST["comment"])) {

                foreach ($cart as $cartItem) {

                    $product = $cartItem["product"];
                    $count = $cartItem["count"];

                    if ($product->discount > 0) {
                        $discPrice = 100 - $product->discount;
                        $discPrice = $discPrice * 0.01;
                        $discPrice = $discPrice * $product->price;
                        $discPrice = round($discPrice);
                        $discPrice = ceil($discPrice / 10) * 10;

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($discPrice * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], $_POST["comment"], 0, null, 1, $userName);
                        Database::createOrder($order);
                    } else {

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($cartItem["product"]->price * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], $_POST["comment"], 0, null, 1, $userName);
                        Database::createOrder($order);
                    }
                }

                header("Location: success.php");
                ob_end_flush();
                die();
            } else {

                foreach ($cart as $cartItem) {

                    $product = $cartItem["product"];
                    $count = $cartItem["count"];

                    if ($product->discount > 0) {
                        $discPrice = 100 - $product->discount;
                        $discPrice = $discPrice * 0.01;
                        $discPrice = $discPrice * $product->price;
                        $discPrice = round($discPrice);
                        $discPrice = ceil($discPrice / 10) * 10;

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($discPrice * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], "No comment", 0, null, 1, $userName);
                        Database::createOrder($order);
                    } else {

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($cartItem["product"]->price * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], "No comment", 0, null, 1, $userName);
                        Database::createOrder($order);
                    }
                }
                header("Location: success.php");
                ob_end_flush();
                die();
            }
        } else {

            if (isset($_POST["comment"]) && !empty($_POST["comment"])) {


                foreach ($cart as $cartItem) {

                    $product = $cartItem["product"];
                    $count = $cartItem["count"];

                    if ($product->discount > 0) {
                        $discPrice = 100 - $product->discount;
                        $discPrice = $discPrice * 0.01;
                        $discPrice = $discPrice * $product->price;
                        $discPrice = round($discPrice);
                        $discPrice = ceil($discPrice / 10) * 10;

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($discPrice * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], $_POST["comment"], 0, null, 0, "no-user");
                        Database::createOrder($order);
                    } else {

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($cartItem["product"]->price * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], $_POST["comment"], 0, null, 0, "no-user");
                        Database::createOrder($order);
                    }
                }

                header("Location: success.php");
                ob_end_flush();
                die();
            } else {

                foreach ($cart as $cartItem) {

                    $product = $cartItem["product"];
                    $count = $cartItem["count"];

                    if ($product->discount > 0) {
                        $discPrice = 100 - $product->discount;
                        $discPrice = $discPrice * 0.01;
                        $discPrice = $discPrice * $product->price;
                        $discPrice = round($discPrice);
                        $discPrice = ceil($discPrice / 10) * 10;

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($discPrice * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], "No comment", 0, null, 0, "no-user");
                        Database::createOrder($order);
                    } else {

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($cartItem["product"]->price * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], "No comment", 0, null, 0, "no-user");
                        Database::createOrder($order);
                    }
                }
                header("Location: success.php");
                ob_end_flush();
                die();
            }
        }
    } else {
        $error = "Kérjük, hogy töltsd ki az összes mezőt, majd a rendelés véglegesítéséhez fogadd el Felhasználói Feltételeinket. Köszönjük!";
    }
}
?>

<section id="checkout-section" class="section whitebg">
    <div class="homepage-main checkout-maxw">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline checkout-first">Rendelés véglegesítése</h4>
            </div>
        </div>
        <p style="padding-bottom: 1rem;color:#f59042;"><?= $error ?></p>
        <form method="POST" class="checkout-form dfcc">
            <div class="dfsb checkout-firstrow">
                <div class="dfcc">
                    <label for="name" class="">Megrendelő neve<span class="star">*</span></label>
                    <input type="text" id="name" class="" name="name">
                </div>
                <div class="dfcc">
                    <label for="email" class="">Megrendelő e-mail címe<span class="star">*</span></label>
                    <input type="email" id="email" class="" name="email">
                </div>
            </div>
            <div class="checkout-description-container">
                <div class="dfcc">
                    <label for="comment" class="">Megjegyzés</label>
                    <textarea id="comment" class="" name="comment" placeholder="Megjegyzés írása..."></textarea>
                </div>
            </div>
            <div class="dfsb checkout-secondrow">

                <div class="checkout-form-left dfcc">
                    <h4>Szállítási adatok</h4>
                    <div class="dffc">
                        <div class="dfcc">
                            <label for="deliveryPostalcode" class="">Irányítószám<span class="star">*</span></label>
                            <input type="number" id="deliveryPostalcode" class="" name="deliveryPostalcode">
                        </div>
                        <div class="dfcc">
                            <label for="deliveryCity" class="">Város<span class="star">*</span></label>
                            <input type="text" id="deliveryCity" class="" name="deliveryCity">
                        </div>
                    </div>
                    <div class="dffc">
                        <div class="dfcc">
                            <label for="deliveryStreet" class="">Utca, házszám (emelet)<span class="star">*</span></label>
                            <input type="text" id="deliveryStreet" class="" name="deliveryStreet">
                        </div>
                        <div class="dfcc">
                            <label for="copydelivery" class="">Számlázási cím megegyezik a szállítási címmel</label>
                            <div class="check-box">
                                <input type="checkbox" type="checkbox" id="copydelivery" class="copydelivery" name="copydelivery">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout-form-right dfcc">
                    <h4>Számlázási adatok</h4>
                    <div class="dffc">
                        <div class="dfcc">
                            <label for="billPostcode" class="">Irányítószám<span class="star">*</span></label>
                            <input type="number" id="billPostcode" class="" name="billPostalcode">
                        </div>
                        <div class="dfcc">
                            <label for="billCity" class="">Város<span class="star">*</span></label>
                            <input type="text" id="billCity" class="" name="billCity">
                        </div>
                    </div>
                    <div class="dffc checkout-billstreet">
                        <div class="dfcc">
                            <label for="billStreet" class="">Utca, házszám (emelet)<span class="star">*</span></label>
                            <input type="text" id="billStreet" class="" name="billStreet">
                        </div>
                    </div>

                </div>
            </div>
            <div class="dffc checkout-thirdrow">
                <div class="checkout-form-payment dfcc">
                    <div class="dfcc">
                        <label for="cardnum" class="form-label">Kártyaszám<span class="star">*</span></label>
                        <input type="number" id="cardnum" class="" name="cardnum">
                    </div>
                    <div class="dfcc">
                        <label for="cardname" class="form-label">Kártyán szereplő név<span class="star">*</span></label>
                        <input type="text" id="cardname" class="" name="cardname">
                    </div>
                    <div class="dfcc">
                        <label for="cvv" class="form-label">CVV<span class="star">*</span></label>
                        <input type="number" id="cvv" class="" name="cvv">
                    </div>
                    <div class="dffc">
                        <label for="discountItem" class="container">
                            <div class="check-box">
                                <input type="checkbox" id="tnc" name="tnc">
                            </div>
                            <span style="text-align:left;">Elfogadom a <a style="color:#4c7e3c;text-decoration:underline;" href="termsconditions.php" target="_blank">felhasználói feltételeket.</a></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="dfsb checkout-paymentrow">
                <p>Levonásra kerülő összeg: <span style="color:#65A850;font-weight:bold;"><?= $_SESSION["totalprice"] ?> Ft</span></p>
                <button type="submit" name="checkout" class="button-green">fizetés és rendelés leadása<i class="bi bi-credit-card"></i></button>
            </div>
        </form>
    </div>
</section>

<?php require_once("components/footer.php") ?>
<?php ob_start(); ?>
<?php require_once("components/header.php") ?>

<?php

require_once("db/database.php");
require_once("db/secrets.php");
require_once("model/order.php");
Database::connect();

//ha a cart be van állítva a munkamenetben
if (isset($_SESSION["cart"])) {
    //akkor vegye ki ezt a tömböt egy változóba
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

//majd töltse fel az üres cart tömböt a munkamenetből már kiszedett cartID product és count paramétereivel
foreach ($cartIDs as $cartID => $count) {
    $cart[] = [
        "product" => Database::getProductById($cartID),
        "count" => $count,
    ];
}

//ez a végösszeg
$sum = 0;

//a felvett termékek bejárása
foreach ($cart as $cartItem) {

    $product = $cartItem["product"];
    $count = $cartItem["count"];

    if ($product->discount > 0) {
        //ha a termék akciós, tehát van discountja (nagyobb mint 0), akkor végezze el az akciós ár kiszámítását, majd ezt adja hozzá a végösszeghez
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

//errormessage változója
$error = "";

//ha a checkout be van állítva (form submit)
if (isset($_POST["checkout"])) {
    //és minden szükséges input mező is ki van töltve
    if (
        isset($_POST["name"]) && !empty($_POST["name"]) &&
        isset($_POST["email"]) && !empty($_POST["email"]) &&
        isset($_POST["deliveryPostalcode"]) && !empty($_POST["deliveryPostalcode"]) &&
        isset($_POST["deliveryCity"]) && !empty($_POST["deliveryCity"]) &&
        isset($_POST["deliveryStreet"]) && !empty($_POST["deliveryStreet"]) &&
        isset($_POST["billPostalcode"]) && !empty($_POST["billPostalcode"]) &&
        isset($_POST["billCity"]) && !empty($_POST["billCity"]) &&
        isset($_POST["billStreet"]) && !empty($_POST["billStreet"]) &&
        isset($_POST["cardname"]) && !empty($_POST["cardname"]) &&
        isset($_POST["cardnum"]) && !empty($_POST["cardnum"]) &&
        isset($_POST["cvv"]) && !empty($_POST["cvv"]) &&
        isset($_POST["tnc"])
    ) {
        //ha a username be van állítva (tehát be van jelentkezve a user)
        if (isset($_SESSION["userName"])) {

            $userName = $_SESSION["userName"];

            //ha fűzött hozzá kommentet is
            if (isset($_POST["comment"]) && !empty($_POST["comment"])) {

                //termékek bejárása
                foreach ($cart as $cartItem) {

                    $product = $cartItem["product"];
                    $count = $cartItem["count"];

                    //ha akciós a termék, akkor számítsa ki az értékét, majd adja hozzá ezt egy új rendeléshez (class), majd a rendelést adja hozzá az adatbázishoz az adott API requesten keresztül
                    if ($product->discount > 0) {
                        $discPrice = 100 - $product->discount;
                        $discPrice = $discPrice * 0.01;
                        $discPrice = $discPrice * $product->price;
                        $discPrice = round($discPrice);
                        $discPrice = ceil($discPrice / 10) * 10;

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($discPrice * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], $_POST["comment"], 0, null, 1, $userName);
                        Database::createOrder($order);
                    }
                    //ha nincs akció a terméken
                    else {

                        $order = new Order(0, $cartItem["product"]->name, $cartItem["count"], $_POST["name"], null, $_POST["email"], ($cartItem["product"]->price * $cartItem["count"]), $_POST["deliveryPostalcode"], $_POST["deliveryCity"], $_POST["deliveryStreet"], $_POST["billPostalcode"], $_POST["billCity"], $_POST["billStreet"], $_POST["comment"], 0, null, 1, $userName);
                        Database::createOrder($order);
                    }
                }

                //átirányítás a success aloldalra
                header("Location: success.php");
                ob_end_flush();
                die();
            }
            //ha nincs komment (vagyis megjegyzés)
            else {

                //végezze el ugyanazt a műveletet, csak az új rendelés létrehozásánál "no-comment" lesz beállítva a database komment oszlopában
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
            //ha nincs bejelentkezve a user, akkor a fent említett validációk történnek meg, csak az új rendelés létrehozásánál "0" jelenik meg az isUser oszlopban, illetve "no-user" a username oszlopban 
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
    }
    //ha nincsenek kitöltve a megfelelő inputok
    else {
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
                    <input type="text" class='checkout-name' placeholder="pl. Gipsz Jakab" id="name" pattern="[a-zA-Z\W+]{0,}" name="name">
                </div>
                <div class="dfcc">
                    <label for="email" class="">Megrendelő e-mail címe<span class="star">*</span></label>
                    <input type="email" id="email" class="" placeholder="pl. info@brobaits.hu" name="email" required>
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
                            <input type="text" id="deliveryPostalcode" class="del-postal" pattern="[0-9]{0,4}" name="deliveryPostalcode">
                        </div>
                        <div class="dfcc">
                            <label for="deliveryCity" class="">Város<span class="star">*</span></label>
                            <input type="text" id="deliveryCity" class="del-city" pattern="[a-zA-Z\W+]{0,}" name="deliveryCity">
                        </div>
                    </div>
                    <div class="dffc">
                        <div class="dfcc">
                            <label for="deliveryStreet" class="">Utca, házszám (emelet)<span class="star">*</span></label>
                            <input type="text" id="deliveryStreet" class="" name="deliveryStreet" required>
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
                            <input type="text" id="billPostcode" class="bill-postal" pattern="[0-9]{0,4}" name="billPostalcode">
                        </div>
                        <div class="dfcc">
                            <label for="billCity" class="">Város<span class="star">*</span></label>
                            <input type="text" id="billCity" class="bill-city" pattern="[a-zA-Z\W+]{0,}" name="billCity">
                        </div>
                    </div>
                    <div class="dffc checkout-billstreet">
                        <div class="dfcc">
                            <label for="billStreet" class="">Utca, házszám (emelet)<span class="star">*</span></label>
                            <input type="text" id="billStreet" class="" name="billStreet" required>
                        </div>
                    </div>

                </div>
            </div>
            <div class="dffc checkout-thirdrow">
                <div class="checkout-form-payment dfcc">
                    <div class="dfcc">
                        <label for="cardnum" class="form-label">Kártyaszám<span class="star">*</span></label>
                        <input type="text" id="cardnum" class="card-number" pattern="[0-9\s]{0,24}" name="cardnum" maxlength="24" placeholder="XXXXXXXX - XXXXXXXX - XXXXXXXX">
                    </div>
                    <div class="dfcc">
                        <label for="cardname" class="form-label">Kártyán szereplő név<span class="star">*</span></label>
                        <input type="text" id="cardname" class="card-name" placeholder="pl. Gipsz Jakab" pattern="[a-zA-Z\W+]{0,}" name="cardname">
                    </div>
                    <div class="dfcc">
                        <label for="cvv" class="form-label">CVV<span class="star">*</span></label>
                        <input type="text" id="cvv" class="cvv-checkout" placeholder="XXX" pattern="[0-9]{0,3}" name="cvv">
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
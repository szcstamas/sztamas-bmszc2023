<?php ob_start(); ?>
<?php require_once('components/header.php');

require_once("db/database.php");
//csatlakozás az adatbázishoz
Database::connect();

if (isset($_SESSION["userId"])) {
    $user = $_SESSION["userId"];
    $userName = $_SESSION["userName"];
    $orders = Database::getOrdersByUser($userName);
}
if (isset($_POST["signout-user"])) {

    //szedje ki az adataimat a munkamenetből
    //munkamenet megszüntetése
    session_unset();
    session_destroy();
    $_SESSION = array();
    header("Location: profile.php");
}

//ha az action be van állítva (form submit), és a submit értéke regisztráció 
if (isset($_POST["action"]) && $_POST["action"] === "regisztráció") {

    //értékek ellenőrzése
    $username = $_POST["username"];
    $email = $_POST["useremail"];
    $password = $_POST["userpassword"];

    //ha üres a username, email vagy jelszó mező, akkor jelenítsen meg egy hibát az adott url-en keresztül
    if (empty($username) || empty($email) || empty($password)) {
        header("Location: profile.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
        ob_end_flush();
        exit();
    }
    //ha az email és a username formátuma nem felel meg
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: profile.php?error=invalidmailuid");
        ob_end_flush();
        exit();
    }
    //ha csak az email formátuma nem felel meg
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: profile.php?error=invalidmail&uid=" . $username);
        ob_end_flush();
        exit();
    }
    //ha csak a username nem jó
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: profile.php?error=invaliduid&mail=" . $email);
        ob_end_flush();
        exit();
    }
    //ha minden stimmel, akkor regisztrálja a usert az adatbázisba
    else {
        Database::registerUser($username, $password, $email);
    }
}

//ha az action be van állítva (form submit), és a submit értéke bejelentkezés
else if (isset($_POST["action"]) && $_POST["action"] === "bejelentkezés") {

    $username = $_POST['username'];
    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];

    //ha a username, pw és email mezője üres, akkor irányítson át egy hibaüzenetre
    if (empty($username) || empty($password) || empty($email)) {
        header("Location: profile.php?error=emptylogin");
        exit();
    }
    //egyébként meg jelentkeztesse be a usert
    else {
        Database::loginUser($username, $password, $email);
    }
}
?>
<!-- ha nincs user beállítva (nincs bejelentkezve) -->
<?php if (!isset($_SESSION["userId"])) : ?>

    <section class='section maxw admin-section profile-user-subpage-login-section dfsb'>
        <div class="subpage-login-container dfcc">
            <div class="profile-user-subpage-title">
                <h2 class="profile-user-subpage-title-h2">Jelentkezz be felhasználói fiókodba,</h2>
                <h4 class="profile-user-subpage-title-h4">vagy regisztrálj oldalunkra!</h4>

                <?php

                if (isset($_GET['error'])) {

                    switch ($_GET['error']) {

                        case "emptyfields":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>A regisztrációhoz kérjük, hogy töltsd ki az összes mezőt!</p>";
                            break;

                        case "invalidmail":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>Helytelen email-formátum!</p>";
                            break;

                        case "invalidmailuid":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>Helytelen e-mail és felhasználónév! A felhasználónév nem tartalmazhat ékezetet vagy speciális karaktereket!</p>";
                            break;

                        case "invaliduid":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>Helytelen felhasználónév! A felhasználónév nem tartalmazhat ékezetet vagy speciális karaktereket!</p>";
                            break;

                        case "sqlerror":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>Hiba az adatbázisban!</p>";
                            break;

                        case "emptylogin":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>Üres adatokkal sajnos nem lehet bejelentkezni! Kérjük, hogy tölsd ki az összes mezőt!</p>";
                            break;

                        case "usertaken":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>A megadott adatokkal már létezik felhasználó!</p>";
                            break;

                        case "nouser":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>A megadott adatokkal nem létezik ilyen felhasználó!</p>";
                            break;
                    }
                } else if (isset($_GET['login'])) {

                    switch ($_GET['login']) {

                        case "wrongpassword":
                            echo "<p style='color:#f59042;' class='section-paragraph-gray'>Helytelen jelszó!</p>";
                            break;

                        case "success":
                            echo "<p style='color:#65A850;' class='section-paragraph-gray'>Sikeres belépés! Üdvözlünk $username!</p>";
                            header("Location: profile.php");
                            break;
                    }
                } else if (isset($_GET['signup'])) {

                    switch ($_GET['signup']) {

                        case "success":
                            echo "<p style='color:#65A850;' class='section-paragraph-gray'>Sikeres regisztráció! Most már bejelentkezhetsz az adataiddal!</p>";
                            break;
                    }
                } else {
                    echo " <p class='section-paragraph-gray'>A kért adatok beírását követően kattins a <em>Bejelentkezés</em>, vagy újonnan érkező vásárlóként a <em>Regisztráció</em> gombra.</p>";
                }

                ?>
            </div>
            <form method="POST" class="dfcc profile-login-form">
                <label>Felhasználónév:</label>
                <input name="username" type="text" placeholder="pl. halvadasz123..."></input>
                <label>E-mail cím:</label>
                <input name="useremail" type="email" placeholder="Ide írd az email-címedet..."></input>
                <label>Jelszó:</label>
                <input name="userpassword" type="password" placeholder="Ide pedig a jelszavadat!"></input>
                <div class="dfsb login-form-buttons">
                    <input class="button-green" type="submit" name="action" value="bejelentkezés" />
                    <input class="button-gray" type="submit" name="action" value="regisztráció" />
                </div>

            </form>
        </div>
        <div class="profile-user-subpage-heroimg">
            <img src="img/main/blue.jpg" alt="blue fishing">
        </div>
    </section>

<?php else : ?>

    <section id="profile-subpage-user-section" class="section whitebg">
        <div class="homepage-main maxw dfsb">
            <div class="homepage-main-hero section-text-button">
                <div class="homepage-main-title">
                    <h4 class="title-firstline">Üdvözlünk a profilodban,</h4>
                    <h1 class="title-secondline-h1 greencolor"><?= $_SESSION["userName"] ?>!</h1>
                </div>
                <p class="section-paragraph-gray">Kiváló partnereinknek köszönhetően folyamatosan bővítjük oldalunk kínálatát, így ügyfeleink a megbízhatóság és elégedettség mellett vadonatúj termékcsomagokkal és kapitális fogásokkal gazdagodhatnak. Árusítani szeretnéd a BroBaits© pelletcsomagjait? Viszonteladásra kínálnád jobbnál jobb termékeidet? Vedd fel velünk a kapcsolatot, és tárgyaljuk meg a részleteket!</p>
                <div class="dfc" style="align-items:stretch!important;">
                    <a class="button-green" href="shop.php">Rendelek! <i class="bi bi-bag-heart"></i></a>
                    <form method="POST">
                        <span class="button-border">
                            <input type="submit" name="signout-user" class="signout-user" value="Kijelentkezés"><i style='color:#000;font-size:1.25rem;' class="bi bi-box-arrow-left"></i>
                        </span>
                    </form>
                </div>
            </div>
            <div class="profile-subpage-running-order">
                <h2>Rendeléseid:</h2>
                <div class="profile-subpage-order-container dfcc">
                    <?php if ($orders) : ?>

                        <?php

                        //ha vannak a usernek rendelései, akkor az orders tömböt járja be
                        foreach ($orders as $order) {

                            $status = $order->completed;

                            //ha a rendelés státusza 1, akkor teljesített, ha 0, akkor még kiszállítás alatt van
                            if ($status === 1) {
                                $status = 'Teljesítve';
                            } else if ($status === 0) {
                                $status = 'Kiszállítás alatt';
                            }
                            echo
                            "
                            <div class='user-orders-list'>
                            <div class='dfc'>
                                <div class='order-part-box'>
                                    <h4>Megrendelés sorszáma</h4>
                                    <p class='user-order-id'>$order->id</p>
                                </div>
                                <div class='order-part-box'>
                                    <h4>Termék neve</h4>
                                    <p>$order->productName</p>
                                </div>
                                <div class='order-part-box'>
                                    <h4>Rendelt darabszám</h4>
                                    <p>$order->productQuantity</p>
                                </div>
                                <div class='order-part-box'>
                                    <h4>Fizetett összeg</h4>
                                    <p>$order->totalPrice Ft</p>
                                </div>
                                <div class='order-part-box'>
                                    <h4>Rendelés dátuma</h4>
                                    <p>$order->date</p>
                                </div>
                            </div>

                            <input id='secondrow-down-input' type='checkbox'>
                            <i id='secondrow-down-icon' class='bi bi-arrow-down-circle-fill'></i>

                            <div class='order-second-row dfc'>
                                <div class='order-part-box'>
                                    <h4>Megrendelő neve</h4>
                                    <p>$order->name</p>
                                </div>
                                <div class='order-part-box'>
                                    <h4>Szállítási cím</h4>
                                    <p>$order->deliveryPostcode, $order->deliveryCity, $order->deliveryStreet</p>
                                </div>
                                <div class='order-part-box'>
                                    <h4>Számlázási cím</h4>
                                    <p>$order->billPostcode, $order->billCity, $order->billStreet</p>
                                </div>
                                <div class='order-part-box'>
                                    <h4>Megjegyzés (ha volt)</h4>
                                    <p>$order->comment</p>
                                </div>
                                <div class='order-part-box'>
                                    <h4>Státusz</h4>
                                    <p>$status</p>
                                </div>
                            </div>
                            </div>
                            
                            ";
                        }


                        ?>
                </div>

                <!-- ha nincs rendelése a usernek -->
            <?php else : ?>

                <div class="cart-noitem dfsb">
                    <h4>Nincs jelenleg aktív rendelésed! Nézz körül webshopunkban!</h4>
                    <a href="shop.php" class="button-green">termékek<i class="bi bi-bag-heart"></i></a>
                </div>
            <?php endif ?>
            </div>
        </div>
    </section>

<?php endif ?>

<?php require_once('components/footer.php') ?>
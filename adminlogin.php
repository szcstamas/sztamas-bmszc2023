<?php

require_once("components/header.php");
require_once("db/secrets.php");

//alapvető értékek felvétele
$message = "Adj meg egy felhasználónevet és jelszót!";
$colour = "#272727";

//ha a username és a password be van állítva (form submitnál)
if (
    isset($_POST["username"]) &&
    !empty($_POST["username"]) &&
    isset($_POST["password"]) &&
    !empty($_POST["password"])
) {

    $usern = $_POST["username"];
    $password = $_POST["password"];

    //ha az action be van állítva (submit) és az értéke a "bejelentkezés"
    if (isset($_POST["action"]) && $_POST["action"] === "bejelentkezés") {
        if (
            //ha be van állítva az admin tömb a munkamenetbe, és a beírt username és pw megegyezik ezekkel az értékekkel, 
            isset($_SESSION["admin"]) &&
            $usern === $_SESSION["admin"]["username"] &&
            $password === $_SESSION["admin"]["password"]
        ) {
            //akkor a bejelentkezés megtörtént, success text:
            $message = "Sikeres bejelentkezés! Üdv <b>{$_SESSION["admin"]["username"]}</b>!";
            //a munkamenetbe állítsa be a loginAdmin tömböt, username és token értékekkel
            $_SESSION["loginAdmin"] = [
                "username" => $_SESSION["admin"]["username"],
                "token" => $_SESSION["admin"]["token"]
            ];
            $colour = "#65A850";
        }
        //ha pedig a megadott inputok értéke nem egyezik meg a beírt adatokkal, akkor errormessage jelenjen meg
        else if (
            isset($_SESSION["admin"]) &&
            $usern != $_SESSION["admin"]["username"] &&
            $password != $_SESSION["admin"]["password"]
        ) {
            $message = "Helytelen felhasználónév vagy jelszó!";
            $colour = "red";
        }
    }
}
?>

<div class='section maxw admin-section dfcc'>
    <h2>
        Bejelentkezés az admin panelbe
    </h2>
    <!-- üzenet (hibaüzenetté alakul ha gond van) -->
    <p style="color: <?= $colour ?>">
        <?= $message ?>
    </p>

    <form method="POST" class="dfcc">
        <label>Admin felhasználónév:</label>
        <input name="username" type="text"></input>
        <label>Jelszó:</label>
        <input name="password" type="password"></input>
        <div class="dfc">
            <!-- bejelentkezés gomb, amire nem lehet rákattintani ha már be vagy jelentkezve -->
            <input class="button-green" <?php if (!isset($_SESSION["admin"])) {
                                            print("disabled");
                                        } ?> type="submit" name="action" value="bejelentkezés" />
            <!-- ha nincs beállítva a loginAdmin tömb a munkamenetben, akkor nem lehet rákattintani a Tovább gombra (egyébként meg igen) -->
            <?php if (!isset($_SESSION["loginAdmin"])) {

                print("<a style='opacity:0.5;cursor:default;' disabled role='link' class='button-green'>tovább</a>");
            } else {
                print("<a href='admin.php' class='button-green'>tovább</a>");
            } ?>
        </div>

    </form>
</div>

<?php require_once("components/footer.php") ?>
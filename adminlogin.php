<?php session_start(); ?>
<?php

require_once("components/header.php");
require_once("db/secrets.php");

$message = "Adj meg egy felhasználónevet és jelszót!";
$colour = "#272727";

if (
    isset($_POST["username"]) &&
    !empty($_POST["username"]) &&
    isset($_POST["password"]) &&
    !empty($_POST["password"])
) {

    $usern = $_POST["username"];
    $password = $_POST["password"];

    if (isset($_POST["action"]) && $_POST["action"] === "bejelentkezés") {
        if (
            isset($_SESSION["user"]) &&
            $usern === $_SESSION["user"]["username"] &&
            $password === $_SESSION["user"]["password"]
        ) {
            $message = "Sikeres bejelentkezés! Üdv <b>{$_SESSION["user"]["username"]}</b>!";
            $_SESSION["loginAdmin"] = $_SESSION["user"]["username"];
            $colour = "#65A850";
        } else if (
            isset($_SESSION["user"]) &&
            $usern != $_SESSION["user"]["username"] &&
            $password != $_SESSION["user"]["password"]
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

    <p style="color: <?= $colour ?>">
        <?= $message ?>
    </p>

    <form method="POST" class="dfcc">
        <label>Username</label>
        <input name="username" type="text"></input>
        <label>Password</label>
        <input name="password" type="password"></input>
        <div class="dfc">
            <input class="button-green" <?php if (!isset($_SESSION["user"])) {
                                            print("disabled");
                                        } ?> type="submit" name="action" value="bejelentkezés" />
            <?php if (!isset($_SESSION["loginAdmin"])) {

                print("<a style='opacity:0.5;cursor:default;' disabled role='link' class='button-green'>tovább</a>");
            } else {
                print("<a href='admin.php' class='button-green'>tovább</a>");
            } ?>
        </div>

    </form>
</div>

<?php require_once("components/footer.php") ?>
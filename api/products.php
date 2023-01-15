<?php
require('../db/secrets.php');

//adatbázis kapcsolat
$pdo = new PDO('mysql:host=localhost;dbname=' . $secrets['mysqlDB'], $secrets['mysqlUser'], $secrets['mysqlPass']);

//ha GET a http req metódusa
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //ha products és deletedAt van az URL-ben, jelenítse meg az összes olyan itemet a products listából, aminek a deletedAt értéke nincs beállítva
    if (isset($_GET['products']) && isset($_GET['deletedAt'])) {
        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `deletedAt` = '0000-00-00'");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return;
    }
    //ha products és az id is benne van a paraméterben, jelenítse meg a megfelelő itemet
    else if (isset($_GET['products']) && isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `id` = $id");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return;
    }
    //ha products, a startRowAtIndex és a renderItemAsCount is be van állítva mint paraméter, jelenítse meg az adott itemeket LIMITÁLT darabszámmal (ezt használja a webshop aloldal a pagination beállításához)
    else if (isset($_GET['products']) && isset($_GET['startRowAtIndex']) && isset($_GET['renderItemAsCount'])) {
        $startRowAtIndex = $_GET['startRowAtIndex'];
        $renderItemAsCount = $_GET['renderItemAsCount'];

        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `deletedAt` = '0000-00-00' LIMIT $startRowAtIndex,$renderItemAsCount");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return;
    }
    //ezzel a szintaxissal számolja meg a webshop aloldal, hogy pontosan hány sor van az adatbázisban (tehát hány olyan item van, aminek a deletedAt értéke nincs beállítva)
    else if (isset($_GET['products']) && isset($_GET['countRow'])) {
        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `deletedAt` = '0000-00-00'");
        $stmt->execute();
        $data = $stmt->rowCount();
        return;
    }
    //az összes product lekérése (csak adminfelületen, ezért authentikációt kér az auth.php aloldalon)
    else if (isset($_GET['products'])) {
        $stmt = $pdo->prepare('SELECT * FROM products');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return;
    }
}

//ha POST a kérelem
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //ha a products szerepel a kérelemben
    if (isset($_GET["products"])) {
        //a request body lekérése
        $data = json_decode(file_get_contents('php://input'));

        //sql hívás elindítása
        $stmt = $pdo->prepare('INSERT INTO `products` (`name`, `description`, `image`, `price`, `quantity`, `onStock`, `weight`, `unitPrice`, `unitSize`, `flavour`, `colour`, `components`, `category`, `preFishes`, `discount`, `createdAt`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP);');

        //sql hívás végrehajtása az adott paraméterek alapján
        $stmt->execute([$data->name, $data->description, $data->image, $data->price, $data->quantity, $data->onStock, $data->weight, $data->unitPrice, $data->unitSize, $data->flavour, $data->colour, $data->components, $data->category, $data->preFishes, $data->discount]);

        //új ID beállítása
        $data->id = $pdo->lastInsertId();
        return;
    }
}

//ha PUT a kérelem
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    //inaktív item visszaállítása (a deletedAt oszlop visszaállítása 0000-00-00 értékre)
    if (isset($_GET['products']) && isset($_GET['deletedAt']) && $_GET['deletedAt'] === 'recover' && isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("UPDATE `products` SET `deletedAt` = '0000-00-00' WHERE `products`.`id` = $id");
        $stmt->execute();
        $data = "Recovery of item was successful! - BroBaits©";
        return;
    }
    //item inaktiválása (a deletedAt oszlop beállítása az aktuális dátumra)
    else if (isset($_GET['products']) && isset($_GET['deletedAt']) && $_GET['deletedAt'] === 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("UPDATE `products` SET `deletedAt` = CURRENT_TIMESTAMP WHERE `products`.`id` = $id");
        $data = $stmt->execute();
        $data = "Delete-time of item was set! Item is now shown as 'deleted'! - BroBaits©";
        return;
    }
    //a kifogyott item darabszámának default értékre való beállítása (ami 50 darabot jelent)
    else if (isset($_GET['products']) && isset($_GET['deletedAt']) && $_GET['deletedAt'] === 'restock' && isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("UPDATE `products` SET `quantity` = 50 WHERE `products`.`id` = $id");
        $data = $stmt->execute();
        $data = "Restocking of item was done! A default value (50) is now set to product! - BroBaits©";
        return;
    }
    //item frissítése a beküldött body alapján (id szerint)
    else if (isset($_GET['products']) && isset($_GET['updateProduct'])) {
        $data = json_decode(file_get_contents('php://input'));

        $stmt = $pdo->prepare("UPDATE `products` SET `name` = ?, `description` = ?, `image` = ?, `price` = ?, `quantity` = ?, `onStock` = ?, `weight` = ?,  `unitPrice` = ?, `unitSize` = ?, `flavour` = ?, `colour` = ?, `components` = ?, `preFishes` = ?, `discount` = ? WHERE `products`.`id` = ?;");

        $stmt->execute([$data->name, $data->description, $data->image, $data->price, $data->quantity, $data->onStock, $data->weight, $data->unitPrice, $data->unitSize, $data->flavour, $data->colour, $data->components, $data->preFishes, $data->discount, $data->id]);

        return;
    }
}

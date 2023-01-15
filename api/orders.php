<?php
require('../db/secrets.php');

//adatbázis kapcsolat
$pdo = new PDO('mysql:host=localhost;dbname=' . $secrets['mysqlDB'], $secrets['mysqlUser'], $secrets['mysqlPass']);

//ha GET a http kérelem
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //ha az orders be van állítva paraméterként, akkor jelenítse meg az összes rendelést (admin)
    if (isset($_GET['orders'])) {
        $stmt = $pdo->prepare('SELECT * FROM `orders`;');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return;
    }
}

//ha POST a http kérelem
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //rendelés feladása a checkout véglegesítésénél
    if (isset($_GET["orders"])) {
        $data = json_decode(file_get_contents('php://input'));

        $stmt = $pdo->prepare('INSERT INTO `orders` (`productName`, `productQuantity`, `name`, `date`, `email`, `totalPrice`, `deliveryPostcode`, `deliveryCity`, `deliveryStreet`, `billPostcode`, `billCity`, `billStreet`, `comment`, `completed`, `completedAt`, `isUser`, `username`) VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, "0000-00-00", ?, ?);');

        $stmt->execute([$data->productName, $data->productQuantity, $data->name, $data->email, $data->totalPrice, $data->deliveryPostcode, $data->deliveryCity, $data->deliveryStreet, $data->billPostcode, $data->billCity, $data->billStreet, $data->comment, $data->isUser, $data->username]);

        $data->id = $pdo->lastInsertId();
        return;
    }
}

//ha PUT a http kérelem
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    //rendelés teljesítése (admin)
    if (isset($_GET['orders']) && isset($_GET['completed']) && isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("UPDATE `orders` SET `completed` = '1', `completedAt` = CURRENT_TIMESTAMP WHERE `orders`.`id` = $id");
        $data = $stmt->execute();
        $data = "Completion of order was successful! - BroBaits©";
        return;
    }
}

//ha DELETE a http kérelem
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    //rendelés törlése (admin)
    if (isset($_GET['orders']) && isset($_GET['delete']) && isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("DELETE FROM `orders` WHERE `orders`.`id` = $id;");
        $data = $stmt->execute();
        $data = "Remove of order was successful! - BroBaits©";
        return;
    }
}

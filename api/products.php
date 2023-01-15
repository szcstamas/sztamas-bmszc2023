<?php
require('../db/secrets.php');

$pdo = new PDO('mysql:host=localhost;dbname=' . $secrets['mysqlDB'], $secrets['mysqlUser'], $secrets['mysqlPass']);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['products']) && isset($_GET['deletedAt'])) {
        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `deletedAt` = '0000-00-00'");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return;
    } else if (isset($_GET['products']) && isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `id` = $id");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return;
    } else if (isset($_GET['products']) && isset($_GET['countRow'])) {
        $stmt = $pdo->prepare("SELECT * FROM `products` WHERE `deletedAt` = '0000-00-00'");
        $stmt->execute();
        $data = $stmt->rowCount();
        return;
    } else if (isset($_GET['products'])) {
        $stmt = $pdo->prepare('SELECT * FROM products');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'));
    $stmt = $pdo->prepare('INSERT INTO products (category, name, description, picture, price, stock) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$data->category, $data->name, $data->description, $data->picture, $data->price, $data->stock]);
    $data->id = $pdo->lastInsertId();
    return;
}

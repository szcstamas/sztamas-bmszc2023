<?php
require('./db/secrets.php');

//csatlakozás az adatbázishoz
$pdo = new PDO('mysql:host=localhost;dbname=' . $secrets['mysqlDB'], $secrets['mysqlUser'], $secrets['mysqlPass']);

//hibák jelentése
if ($development) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$resource = strtok($_SERVER['QUERY_STRING'], '=');
// require('auth.php');

if ($resource == 'products') {
    require('products.php');
}
if ($resource == 'users') {
    require('users.php');
}

echo json_encode($data);

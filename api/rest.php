<?php
require('../db/secrets.php');

//hibák jelentése
if ($development) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

//authentikáció meghívása minden kérelemhez
$resource = strtok($_SERVER['QUERY_STRING'], '=');
require('auth.php');

//keresés: az adott string megtalálható az URL-ben?
$prodWasFoundInUrl = strpos($resource, 'products');
$orderWasFoundInUrl = strpos($resource, 'orders');

//products.php meghívása kérelem esetén
if ($prodWasFoundInUrl = true) {
    require('products.php');
}
//users.php meghívása kérelem esetén
if ($resource == 'users') {
    require('users.php');
}
//orders.php meghívása kérelem esetén
if ($orderWasFoundInUrl = true) {
    require('orders.php');
}

//a fetchelt adat megjelenítése JSON formátumban
echo json_encode($data);

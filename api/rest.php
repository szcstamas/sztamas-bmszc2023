<?php
require('../db/secrets.php');

//hibák jelentése
if ($development) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$resource = strtok($_SERVER['QUERY_STRING'], '=');
// require('auth.php');

$prodWasFoundInUrl = strpos($resource, 'products');

if ($prodWasFoundInUrl = true) {
    require('products.php');
}
if ($resource == 'users') {
    require('users.php');
}

echo json_encode($data);

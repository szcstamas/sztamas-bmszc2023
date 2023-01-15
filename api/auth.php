<?php

// minden OPTIONS request engedélyezése
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    return true;
}

//az alapvető változók amik a GET kérelmekben szerepelnek majd
$id = "";
$startRowAtIndex = "";
$renderItemAsCount = "";

//ha a paraméterek be vannak állítva, a változók vegyék fel az értéküket
if (isset($_GET['products']) && isset($_GET['id'])) {
    $id = $_GET['id'];
} else if (isset($_GET['products']) && isset($_GET['startRowAtIndex']) && isset($_GET['renderItemAsCount'])) {
    $startRowAtIndex = $_GET['startRowAtIndex'];
    $renderItemAsCount = $_GET['renderItemAsCount'];
}
// annak az url paramétereknek a listája amikhez nem kell authentikáció
$noAuthResources = [
    'GET' => ['products&deletedAt', 'products&id=' . $id, 'products&countRow', 'products&startRowAtIndex=' . $startRowAtIndex . '&renderItemAsCount=' . $renderItemAsCount, 'countRow'],
    'POST' => ['users=login', 'orders'],
    'PUT' => [],
    'PATCH' => [],
    'DELETE' => []
];

//lista ellenőrzése a kérelem hívásakor
if (in_array($_SERVER['QUERY_STRING'], $noAuthResources[$_SERVER['REQUEST_METHOD']])) {
    return true;
}

//token ellenőrzése
$token = isset(apache_request_headers()['Token']) ? apache_request_headers()['Token'] : null;

//ha a token megegyezik az admin tokennel
if ($token === $_SESSION["admin"]["token"]) {
    //akkor az authorizáció megtörtént
    return true;
}

//egyébként meg 401-es hibakódot adjon egy hibaüzenettel
http_response_code(401);
die('Authorization error');

<?php

//hibák jelzése a használt oldalakon
$development = true;

//adatbázis kapcsolat
$secrets = [

    'mysqlUser' => 'root',
    'mysqlPass' => '',
    'mysqlDB' => 'sztamas',
];

//admin belépés adatai
$_SESSION["admin"] = [
    "username" => "admin",
    "password" => "12345",
    "token" => "admin12345token",
];

//magicnum (szállítási költség)
$DELIVERY_PRICE = 1650;

<?php

//hibák jelzése a használt oldalakon
$development = true;

//adatbázis kapcsolat
$secrets = [

    'mysqlUser' => 'sztamas',
    'mysqlPass' => '(_m2X0uMXfoZMTKl',
    'mysqlDB' => 'sztamas',
];

//admin belépés adatai
$_SESSION["admin"] = [
    "username" => "admin",
    "password" => "12345",
    "token" => "admin12345token",
];

//magicnum (szállítási költség)
$deliveryPrice = 1650;

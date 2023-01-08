<?php

require_once("model/product.php");

class Database
{

    private static $conn;

    public static function connect()
    {
        require('secrets.php');

        //csatlakozás az adatbázishoz PDO segítségével
        self::$conn = new PDO('mysql:host=localhost;dbname=' . $secrets['mysqlDB'], $secrets['mysqlUser'], $secrets['mysqlPass']);
    }

    public static function getAllProducts()
    {

        //az összes olyan termék kiválasztása amiből több van mint 0, és még nem törölték (nincsen valid dátum beállítva a deleted_at propertynél)
        $sql = "SELECT * FROM `products` WHERE `quantity` > 0 AND `deletedAt` = '0000-00-00 00:00:00';";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();
        //ebben a tömbben fognak eltárolódni a fetchelt termékek
        $products = [];
        //kapott sql-adat fetchelése
        $data = $result->fetchAll();

        //adatok megjelenítése (a kapott tömbön keresztül loopol)
        foreach ($data as $row) {
            switch ($row["category"]) {
                case "pellet": {
                        $products[] = new Product($row["id"], $row["name"], $row["description"], $row["image"], $row["price"], $row["quantity"], $row["onStock"], $row["weight"], $row["unitPrice"], $row["unitSize"], $row["flavour"], $row["colour"], $row["components"], $row["category"], $row["preFishes"], $row["discount"], $row["createdAt"], $row["deletedAt"]);
                        break;
                    }
                case "feed": {
                        $products[] = new Product($row["id"], $row["name"], $row["description"], $row["image"], $row["price"], $row["quantity"], $row["onStock"], $row["weight"], $row["unitPrice"], $row["unitSize"], $row["flavour"], $row["colour"], $row["components"], $row["category"], $row["preFishes"], $row["discount"], $row["createdAt"], $row["deletedAt"]);
                        break;
                    }
                default: {
                        echo "Ismeretlen kategória!";
                    }
            }
        }

        return $products;
    }

    public static function getAllProductsOnAdmin()
    {

        //az összes termék kiválasztása
        $sql = "SELECT * FROM `products`";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();
        //ebben a tömbben fognak eltárolódni a fetchelt termékek
        $products = [];
        //kapott sql-adat fetchelése
        $data = $result->fetchAll();

        //adatok megjelenítése (a kapott tömbön keresztül loopol)
        foreach ($data as $row) {
            switch ($row["category"]) {
                case "pellet": {
                        $products[] = new Product($row["id"], $row["name"], $row["description"], $row["image"], $row["price"], $row["quantity"], $row["onStock"], $row["weight"], $row["unitPrice"], $row["unitSize"], $row["flavour"], $row["colour"], $row["components"], $row["category"], $row["preFishes"], $row["discount"], $row["createdAt"], $row["deletedAt"]);
                        break;
                    }
                case "feed": {
                        $products[] = new Product($row["id"], $row["name"], $row["description"], $row["image"], $row["price"], $row["quantity"], $row["onStock"], $row["weight"], $row["unitPrice"], $row["unitSize"], $row["flavour"], $row["colour"], $row["components"], $row["category"], $row["preFishes"], $row["discount"], $row["createdAt"], $row["deletedAt"]);
                        break;
                    }
                default: {
                        echo "Ismeretlen kategória!";
                    }
            }
        }

        return $products;
    }

    public static function getProductById($id)
    {

        $sql = "SELECT * FROM `products` WHERE `id` = $id";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();
        //kapott sql-adat fetchelése
        $data = $result->fetchAll();

        //keresztül loopolás
        foreach ($data as $row) {
            switch ($row["category"]) {
                case "pellet": {
                        return new Product($row["id"], $row["name"], $row["description"], $row["image"], $row["price"], $row["quantity"], $row["onStock"], $row["weight"], $row["unitPrice"], $row["unitSize"], $row["flavour"], $row["colour"], $row["components"], $row["category"], $row["preFishes"], $row["discount"], $row["createdAt"], $row["deletedAt"]);
                        break;
                    }
                case "feed": {
                        return new Product($row["id"], $row["name"], $row["description"], $row["image"], $row["price"], $row["quantity"], $row["onStock"], $row["weight"], $row["unitPrice"], $row["unitSize"], $row["flavour"], $row["colour"], $row["components"], $row["category"], $row["preFishes"], $row["discount"], $row["createdAt"], $row["deletedAt"]);
                        break;
                    }
                default: {
                        echo "Ismeretlen kategória!";
                    }
            }
        }
    }

    public static function deleteProductById($id)
    {
        $sql = "UPDATE `products` SET `deletedAt` = CURRENT_TIMESTAMP WHERE `products`.`id` = $id";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();

        return $result;
    }

    public static function recoverProductById($id)
    {
        $sql = "UPDATE `products` SET `deletedAt` = '0000-00-00' WHERE `products`.`id` = $id";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();

        return $result;
    }

    public static function updateProduct($product)
    {
        $onStock = self::boolToSQL($product->onStock);

        $sql = "UPDATE `products` SET `name` = '$product->name', `description` = '$product->description', `image` = '$product->image', `price` = '$product->price', `quantity` = '$product->quantity', `onStock` = '$onStock', `weight` = '$product->weight',  `unitPrice` = '$product->unitPrice', `unitSize` = '$product->unitSize', `flavour` = '$product->flavour', `colour` = '$product->colour', `components` = '$product->components', `preFishes` = '$product->preFishes', `discount` = '$product->discount' WHERE `products`.`id` = $product->id;";

        $result = self::$conn->prepare($sql);
        $result->execute();

        return $result;
    }

    private static function boolToSQL($bool)
    {
        if ($bool == true) {
            return 1;
        } else {
            return 0;
        }
    }
}

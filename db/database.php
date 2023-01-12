<?php

require_once("model/product.php");
require_once("model/order.php");

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
        $sql = "SELECT * FROM `products` WHERE `deletedAt` = '0000-00-00 00:00:00';";

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

    public static function searchProductByName($name)
    {

        //az összes olyan termék kiválasztása amiből több van mint 0, és még nem törölték (nincsen valid dátum beállítva a deleted_at propertynél)
        $sql = "SELECT * FROM `products` WHERE `name` LIKE '%$name%'";

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

    public static function restockProductById($id)
    {
        $sql = "UPDATE `products` SET `quantity` = 50 WHERE `products`.`id` = $id";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();

        return $result;
    }

    public static function createProduct($product, $category)
    {
        $onStock = self::boolToSQL($product->onStock);

        $sql = "INSERT INTO `products` (`name`, `description`, `image`, `price`, `quantity`, `onStock`, `weight`, `unitPrice`, `unitSize`, `flavour`, `colour`, `components`, `category`, `preFishes`, `discount`, `createdAt`) VALUES ('$product->name', '$product->description', '$product->image', '$product->price', '$product->quantity', '$onStock', '$product->weight', '$product->unitPrice', '$product->unitSize', '$product->flavour', '$product->colour', '$product->components', '$category', '$product->preFishes', '$product->discount', current_timestamp());";

        $result = self::$conn->prepare($sql);
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

    public static function createOrder($order)
    {

        $sql = "INSERT INTO `orders` (`productName`, `productQuantity`, `name`, `date`, `email`, `totalPrice`, `deliveryPostcode`, `deliveryCity`, `deliveryStreet`, `billPostcode`, `billCity`, `billStreet`, `comment`, `completed`, `completedAt`, `username`) VALUES ('{$order->productName}', '{$order->productQuantity}', '{$order->name}', current_timestamp(), '{$order->email}', '{$order->totalPrice}', '{$order->deliveryPostcode}', '{$order->deliveryCity}', '{$order->deliveryStreet}', '{$order->billPostcode}', '{$order->billCity}', '{$order->billStreet}', '{$order->comment}', 0, '0000-00-00', '{$order->username}');";

        $result = self::$conn->prepare($sql);
        $result->execute();

        return $result;
    }

    public static function getAllOrders()
    {

        //az összes olyan termék kiválasztása amiből több van mint 0, és még nem törölték (nincsen valid dátum beállítva a deleted_at propertynél)
        $sql = "SELECT * FROM `orders`";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();
        //ebben a tömbben fognak eltárolódni a fetchelt termékek
        $orders = [];
        //kapott sql-adat fetchelése
        $data = $result->fetchAll();

        //adatok megjelenítése (a kapott tömbön keresztül loopol)
        foreach ($data as $row) {

            $orders[] = new Order($row["id"], $row["productName"], $row["productQuantity"], $row["name"], $row["date"], $row["email"], $row["totalPrice"], $row["deliveryPostcode"], $row["deliveryCity"], $row["deliveryStreet"], $row["billPostcode"], $row["billCity"], $row["billStreet"], $row["comment"], $row["completed"], $row["completedAt"], $row["isUser"], $row["username"],);
        }

        return $orders;
    }

    public static function deleteOrderById($id)
    {
        $sql = "DELETE FROM `orders` WHERE `orders`.`id` = $id;";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();

        return $result;
    }

    public static function completeOrderById($id)
    {
        $sql = "UPDATE `orders` SET `completed` = '1', `completedAt` = CURRENT_TIMESTAMP WHERE `orders`.`id` = $id";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        //sql parancs végrehajtása
        $result->execute();

        return $result;
    }

    public static function registerUser($username, $password, $email)
    {
        $sql = "SELECT userName FROM users WHERE userName=:userName";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);

        if (!$result) {
            header("Location: profile.php?error=sqlerror");
            exit();
        } else {
            $result->bindParam(':userName', $username);
            $result->execute();
            $resultCheck = $result->fetchColumn();

            if ($resultCheck > 0) {
                header("Location: profile.php?error=usertaken&mail=" . $email);
                exit();
            } else {
                $sql = "INSERT INTO users (userName, userEmail, userPwd) VALUES (:userName, :userEmail, :userPwd)";
                $result = self::$conn->prepare($sql);
                if (!$result) {
                    header("Location: profile.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    $result->bindParam(':userName', $username);
                    $result->bindParam(':userEmail', $email);
                    $result->bindParam(':userPwd', $hashedPwd);
                    $result->execute();
                    header("Location: profile.php?signup=success");
                    exit();
                }
            }
        }
    }

    public static function loginUser($username, $password, $email)
    {
        $sql = "SELECT * FROM users WHERE userName=:userName AND userEmail=:userEmail;";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);

        if (!$result) {
            header("Location: profile.php?error=sqlerror");
            exit();
        } else {

            $result->bindParam(':userName', $username);
            $result->bindParam(':userEmail', $email);
            $result->execute();

            if ($result) {
                $data = $result->fetchAll();

                foreach ($data as $row) {
                    $pwdCheck = password_verify($password, $row['userPwd']);
                    if ($pwdCheck == false) {
                        header("Location: profile.php?login=wrongpassword");
                        exit();
                    } else if ($pwdCheck == true) {
                        $_SESSION['userId'] = $row['id'];
                        $_SESSION['userName'] = $row['userName'];

                        header("Location: profile.php?login=success");
                        exit();
                    }
                }
            } else {
                header("Location: profile.php?error=nouser");
                exit();
            }
        }
    }

    public static function getOrdersByUser($username)
    {

        $sql = "SELECT * FROM `orders` WHERE `username` = :username";

        //csatlakozás az adatbázishoz, majd az sql parancs elküldése
        $result = self::$conn->prepare($sql);
        $result->bindParam(':username', $username);
        //sql parancs végrehajtása
        $result->execute();
        $rows = $result->fetchAll();

        //egy üres tömb, amit feltöltünk a user megrendeléseivel
        $orders = [];

        //keresztül loopolás
        foreach ($rows as $row) {
            $orders[] = new Order($row["id"], $row["productName"], $row["productQuantity"], $row["name"], $row["date"], $row["email"], $row["totalPrice"], $row["deliveryPostcode"], $row["deliveryCity"], $row["deliveryStreet"], $row["billPostcode"], $row["billCity"], $row["billStreet"], $row["comment"], $row["completed"], $row["completedAt"], $row["isUser"], $row["username"],);
        }

        return $orders;
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

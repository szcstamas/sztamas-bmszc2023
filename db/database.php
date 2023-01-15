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

    //API KÉSZ
    public static function getAllProducts()
    {
        //cURL meghívása
        $curl = curl_init();

        //cURL beállítása (az adott URL-nek intézett kérelem)
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products&deletedAt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        //kérelem végrehajtása (annak eltárolása egy változóba)
        $response = curl_exec($curl);
        //kérelem bezárása
        curl_close($curl);

        //kapott json-adat dekódolása
        $data = json_decode($response);
        //tömb definiálása
        $products = [];

        //products tömb feltöltése a kapott, dekódolt json-adatokkal
        foreach ($data as $row) {
            switch ($row->category) {
                case "pellet": {
                        $products[] = new Product($row->id, $row->name, $row->description, $row->image, $row->price, $row->quantity, $row->onStock, $row->weight, $row->unitPrice, $row->unitSize, $row->flavour, $row->colour, $row->components, $row->category, $row->preFishes, $row->discount, $row->createdAt, $row->deletedAt);
                        break;
                    }
                case "feed": {
                        $products[] = new Product($row->id, $row->name, $row->description, $row->image, $row->price, $row->quantity, $row->onStock, $row->weight, $row->unitPrice, $row->unitSize, $row->flavour, $row->colour, $row->components, $row->category, $row->preFishes, $row->discount, $row->createdAt, $row->deletedAt);
                        break;
                    }
                default: {
                        echo "Ismeretlen kategória!";
                    }
            }
        }

        return $products;
    }

    //API KÉSZ
    public static function countProductsRows()
    {
        //cURL meghívása
        $curl = curl_init();

        //cURL beállítása (az adott URL-nek intézett kérelem)
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products&countRow',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        //kérelem végrehajtása (annak eltárolása egy változóba)
        $response = curl_exec($curl);
        //kérelem bezárása
        curl_close($curl);

        //kapott json-adat dekódolása
        $data = json_decode($response);

        return $data;
    }

    //API KÉSZ
    public static function getAllProductsWithLimit($startRowAtIndex, $renderItemAsCount)
    {

        //cURL meghívása
        $curl = curl_init();

        //cURL beállítása (az adott URL-nek intézett kérelem)
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products&startRowAtIndex=' . $startRowAtIndex . '&renderItemAsCount=' . $renderItemAsCount,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        //kérelem végrehajtása (annak eltárolása egy változóba)
        $response = curl_exec($curl);
        //kérelem bezárása
        curl_close($curl);

        //kapott json-adat dekódolása
        $data = json_decode($response);
        //tömb definiálása
        $products = [];

        //products tömb feltöltése a kapott, dekódolt json-adatokkal
        foreach ($data as $row) {
            switch ($row->category) {
                case "pellet": {
                        $products[] = new Product($row->id, $row->name, $row->description, $row->image, $row->price, $row->quantity, $row->onStock, $row->weight, $row->unitPrice, $row->unitSize, $row->flavour, $row->colour, $row->components, $row->category, $row->preFishes, $row->discount, $row->createdAt, $row->deletedAt);
                        break;
                    }
                case "feed": {
                        $products[] = new Product($row->id, $row->name, $row->description, $row->image, $row->price, $row->quantity, $row->onStock, $row->weight, $row->unitPrice, $row->unitSize, $row->flavour, $row->colour, $row->components, $row->category, $row->preFishes, $row->discount, $row->createdAt, $row->deletedAt);
                        break;
                    }
                default: {
                        echo "Ismeretlen kategória!";
                    }
            }
        }

        return $products;
    }

    //API KÉSZ
    public static function getAllProductsOnAdmin($token)
    {
        //cURL meghívása
        $curl = curl_init();

        //cURL beállítása (az adott URL-nek intézett kérelem)
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Token:' . ' ' . $token
            ),
        ));

        //kérelem végrehajtása (annak eltárolása egy változóba)
        $response = curl_exec($curl);
        //kérelem bezárása
        curl_close($curl);

        //kapott json-adat dekódolása
        $data = json_decode($response);
        //tömb definiálása
        $products = [];

        //products tömb feltöltése a kapott, dekódolt json-adatokkal
        foreach ($data as $row) {
            switch ($row->category) {
                case "pellet": {
                        $products[] = new Product($row->id, $row->name, $row->description, $row->image, $row->price, $row->quantity, $row->onStock, $row->weight, $row->unitPrice, $row->unitSize, $row->flavour, $row->colour, $row->components, $row->category, $row->preFishes, $row->discount, $row->createdAt, $row->deletedAt);
                        break;
                    }
                case "feed": {
                        $products[] = new Product($row->id, $row->name, $row->description, $row->image, $row->price, $row->quantity, $row->onStock, $row->weight, $row->unitPrice, $row->unitSize, $row->flavour, $row->colour, $row->components, $row->category, $row->preFishes, $row->discount, $row->createdAt, $row->deletedAt);
                        break;
                    }
                default: {
                        echo "Ismeretlen kategória!";
                    }
            }
        }

        return $products;
    }

    //API KÉSZ
    public static function getProductById($id)
    {
        //cURL meghívása
        $curl = curl_init();

        //cURL beállítása (az adott URL-nek intézett kérelem)
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products&id=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        //kérelem végrehajtása (annak eltárolása egy változóba)
        $response = curl_exec($curl);
        //kérelem bezárása
        curl_close($curl);

        //kapott json-adat dekódolása
        $data = json_decode($response);

        //products tömb feltöltése a kapott, dekódolt json-adatokkal
        foreach ($data as $row) {
            switch ($row->category) {
                case "pellet": {
                        return new Product($row->id, $row->name, $row->description, $row->image, $row->price, $row->quantity, $row->onStock, $row->weight, $row->unitPrice, $row->unitSize, $row->flavour, $row->colour, $row->components, $row->category, $row->preFishes, $row->discount, $row->createdAt, $row->deletedAt);
                        break;
                    }
                case "feed": {
                        return new Product($row->id, $row->name, $row->description, $row->image, $row->price, $row->quantity, $row->onStock, $row->weight, $row->unitPrice, $row->unitSize, $row->flavour, $row->colour, $row->components, $row->category, $row->preFishes, $row->discount, $row->createdAt, $row->deletedAt);
                        break;
                    }
                default: {
                        echo "Ismeretlen kategória!";
                    }
            }
        }
    }

    //API KÉSZ
    public static function deleteProductById($id, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products&deletedAt=delete&id=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Token:' . ' ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    //API KÉSZ
    public static function recoverProductById($id, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products&deletedAt=recover&id=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Token:' . ' ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    //API KÉSZ
    public static function restockProductById($id, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products&deletedAt=restock&id=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Token:' . ' ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    //API KÉSZ
    public static function createProduct($product, $token)
    {
        $postData = [
            "name" => $product->name,
            "description" => $product->description,
            "image" => $product->image,
            "price" => $product->price,
            "quantity" => $product->quantity,
            "onStock" => $product->onStock,
            "weight" => $product->weight,
            "unitPrice" => $product->unitPrice,
            "unitSize" => $product->unitSize,
            "flavour" => $product->flavour,
            "colour" => $product->colour,
            "components" => $product->components,
            "category" => $product->category,
            "preFishes" => $product->preFishes,
            "discount" => $product->discount
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Token:' . ' ' . $token
            ),
        ));

        curl_exec($curl);
        curl_close($curl);
    }

    //API KÉSZ
    public static function updateProduct($product, $token)
    {
        $postData = [
            "name" => $product->name,
            "description" => $product->description,
            "image" => $product->image,
            "price" => $product->price,
            "quantity" => $product->quantity,
            "onStock" => $product->onStock,
            "weight" => $product->weight,
            "unitPrice" => $product->unitPrice,
            "unitSize" => $product->unitSize,
            "flavour" => $product->flavour,
            "colour" => $product->colour,
            "components" => $product->components,
            "preFishes" => $product->preFishes,
            "discount" => $product->discount,
            "id" => $product->id
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?products&updateProduct',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Token:' . ' ' . $token
            ),
        ));

        //kérelem végrehajtása
        curl_exec($curl);
        //kérelem bezárása
        curl_close($curl);
    }

    //API KÉSZ
    public static function createOrder($order)
    {

        $postData = [
            "productName" => $order->productName,
            "productQuantity" => $order->productQuantity,
            "name" => $order->name,
            "email" => $order->email,
            "totalPrice" => $order->totalPrice,
            "deliveryPostcode" => $order->deliveryPostcode,
            "deliveryCity" => $order->deliveryCity,
            "deliveryStreet" => $order->deliveryStreet,
            "billPostcode" => $order->billPostcode,
            "billCity" => $order->billCity,
            "billStreet" => $order->billStreet,
            "comment" => $order->comment,
            "isUser" => $order->isUser,
            "username" => $order->username
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        curl_exec($curl);
        curl_close($curl);
    }

    //API KÉSZ
    public static function getAllOrders($token)
    {
        //cURL meghívása
        $curl = curl_init();

        //cURL beállítása (az adott URL-nek intézett kérelem)
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Token:' . ' ' . $token
            ),
        ));

        //kérelem végrehajtása (annak eltárolása egy változóba)
        $response = curl_exec($curl);
        //kérelem bezárása
        curl_close($curl);

        //kapott json-adat dekódolása
        $data = json_decode($response);
        //tömb definiálása
        $orders = [];

        //products tömb feltöltése a kapott, dekódolt json-adatokkal
        foreach ($data as $row) {

            $orders[] = new Order($row->id, $row->productName, $row->productQuantity, $row->name, $row->date, $row->email, $row->totalPrice, $row->deliveryPostcode, $row->deliveryCity, $row->deliveryStreet, $row->billPostcode, $row->billCity, $row->billStreet, $row->comment, $row->completed, $row->completedAt, $row->isUser, $row->username);
        }

        return $orders;
    }

    //API KÉSZ
    public static function deleteOrderById($id, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?orders&delete&id=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Token:' . ' ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    //API KÉSZ
    public static function completeOrderById($id, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/sztamas-bmszc2023/api/rest.php?orders&completed&id=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Token:' . ' ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
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

    public static function searchInShop($name, $sortItems, $discountItem, $rangeItemPrice, $onStock)
    {

        //az összes olyan termék kiválasztása amiből több van mint 0, és még nem törölték (nincsen valid dátum beállítva a deleted_at propertynél)
        $sql = "SELECT * FROM `products`";

        if ($name) {
            $sql = "SELECT * FROM `products` WHERE `name` LIKE '%$name%'";

            if ($sortItems && $sortItems != []) {

                if ($discountItem && $discountItem != []) {
                    $sql = "SELECT * FROM `products` WHERE `products`.`discount` > 0";

                    if ($onStock && $onStock != []) {

                        $sql = $sql . ' ' . "AND `products`.`quantity` > 0";

                        if ($rangeItemPrice && $rangeItemPrice != []) {

                            if (str_contains($rangeItemPrice, ' ') === true) {
                                $prices = explode(" ", $rangeItemPrice);

                                $sql = $sql . ' ' . "AND `price` BETWEEN $prices[0] AND $prices[1]";
                            } else {
                                $sql = $sql . ' ' . "AND `price` > $rangeItemPrice";
                            }
                        }
                    }
                }

                switch ($sortItems) {

                    case "sortByPriceDesc":
                        $sql = $sql . ' ' . "ORDER BY `products`.`price` DESC;";
                        break;
                    case "sortByPriceAsc":
                        $sql = $sql . ' ' . "ORDER BY `products`.`price` ASC;";
                        break;
                    case "sortByDiscount":
                        $sql = $sql . ' ' . "ORDER BY `products`.`discount` DESC;";
                        break;
                }
            }
            if ($discountItem && $discountItem != []) {
                $sql = $sql . ' ' . "AND `products`.`discount` > 0;";
            }
        } else {
            if ($sortItems && $sortItems != []) {
                if ($discountItem && $discountItem != []) {
                    $sql = "SELECT * FROM `products` WHERE `products`.`discount` > 0";
                }

                switch ($sortItems) {

                    case "sortByPriceDesc":
                        $sql = $sql . ' ' . "ORDER BY `products`.`price` DESC;";
                        break;
                    case "sortByPriceAsc":
                        $sql = $sql . ' ' . "ORDER BY `products`.`price` ASC;";
                        break;
                    case "sortByDiscount":
                        $sql = $sql . ' ' . "ORDER BY `products`.`discount` DESC";
                        break;
                }
            } else if ($discountItem && $discountItem != []) {
                $sql = $sql . ' ' . "WHERE `products`.`discount` > 0";

                if ($onStock && $onStock != []) {

                    $sql = $sql . ' ' . "AND `products`.`quantity` > 0";

                    if ($rangeItemPrice && $rangeItemPrice != []) {

                        if (str_contains($rangeItemPrice, ' ') === true) {
                            $prices = explode(" ", $rangeItemPrice);

                            $sql = $sql . ' ' . "AND `price` BETWEEN $prices[0] AND $prices[1];";
                        } else {
                            $sql = $sql . ' ' . "AND `price` > $rangeItemPrice;";
                        }
                    }
                } else if ($rangeItemPrice && $rangeItemPrice != []) {

                    if (str_contains($rangeItemPrice, ' ') === true) {
                        $prices = explode(" ", $rangeItemPrice);

                        $sql = $sql . ' ' . "AND `price` BETWEEN $prices[0] AND $prices[1];";
                    } else {
                        $sql = $sql . ' ' . "AND `price` > $rangeItemPrice;";
                    }
                }
            } else if ($rangeItemPrice && $rangeItemPrice != []) {

                if (str_contains($rangeItemPrice, ' ') === true) {
                    $prices = explode(" ", $rangeItemPrice);

                    $sql = $sql . ' ' . "WHERE `price` BETWEEN $prices[0] AND $prices[1];";
                } else {
                    $sql = $sql . ' ' . "WHERE `price` > $rangeItemPrice;";
                }
            } else if ($onStock && $onStock != []) {

                $sql = $sql . ' ' . "WHERE `products`.`quantity` > 0;";
            }
        }


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
}

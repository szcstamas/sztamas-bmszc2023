<!-- header importálása -->
<?php require_once("./components/header.php") ?>

<?php

//adatbázis meghívása
require_once("db/database.php");

//adatbázis kapcsolódás
Database::connect();
//az összes item megjelenítése az adatbázisból
$numOfRows = Database::countProductsRows();

//pagination: a numOfItems változóban elmentett értéknek megfelelő mennyiségű termék fog kilistázódni az oldalon
$numOfItems = 4;
//az összes "termék-oldal" értéknek kiszámítása felfelé kerekítéssel
$totalPages = ceil(($numOfRows / $numOfItems));
//ha a page változó megtalálható az url-ben, akkor a $page változó vegye fel az értékét
if (isset($_GET["page"])) {

    $page = $_GET["page"];
    $previousPage = $page - 1;
    $nextPage = $page + 1;
} else {

    //egyébként meg ha nincsen page= az url-ben, akkor mindig legyen 1 a $page értéke (ez jelenti a kezdőoldalt)
    $page = 1;
    $nextPage = $page + 1;
}
//Az SQL szintaxis két számot vár a db.php-ban meghatározott LIMIT után: az első szám azt határozza meg, hogy hanyadik indexű terméktől kezdje el a számolást, a második pedig azt, hogy hány termékig "menjen el" az adott indexű termék után. Például a kezdőoldalnál: 1-1*4, ez azt jelenti hogy a 0-ik indexű itemnél kezdje el a számolást, második oldalnál 2-1*4, tehát a 4-ik indexű terméknél kezdje el a termékek megjelenítését. A $numOfItems mivel állandó változó, emiatt a lekérdezésben mindig 4 darab elemet kell megjelenítenie az oldalnak.
$startFrom = ($page - 1) * $numOfItems;
$products = Database::getAllProductsWithLimit($startFrom, $numOfItems);

//a keresésben használt változók felvétele
$searchName = "";
$discountItem = "";
$rangeItemPrice = "";
$sortBy = "";
$onStock = "";

//ha a KERESÉS gombra kattintunk
if (
    isset($_GET["submit-form"])
) {
    //a keresésen belül minden változót külön vizsgáltam (van-e érték a keresőmezőben, be van-e kapcsolva az Akciós, a Raktáron, vagy a dropdown menüből valamelyik menüpont ki van-e választva), ez sajnos egy kifejezetten bonyolult szintaxishoz vezetett
    if (
        isset($_GET["search"]) &&
        !empty($_GET["search"])
    ) {
        $searchName = $_GET["search"];
        $sortBy = $_GET["sortItems"];
        $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);

        if (
            isset($_GET["discountItem"]) &&
            !empty($_GET["discountItem"])
        ) {
            $discountItem = $_GET["discountItem"];
            $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);
        }
    } else if (isset($_GET["sortItems"]) && !empty($_GET["sortItems"])) {
        $sortBy = $_GET["sortItems"];
        $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);

        if (
            isset($_GET["discountItem"]) &&
            !empty($_GET["discountItem"])
        ) {
            $discountItem = $_GET["discountItem"];
            $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);

            if (
                isset($_GET["onStock"]) &&
                !empty($_GET["onStock"])
            ) {
                $onStock = $_GET["onStock"];
                $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);

                if (
                    isset($_GET["radio"]) &&
                    !empty($_GET["radio"])
                ) {
                    $rangeItemPrice = $_GET["radio"];
                    $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);
                }
            }
        }
    } else if (isset($_GET["discountItem"]) && !empty($_GET["discountItem"])) {

        if (isset($_GET["radio"]) && !empty($_GET["radio"])) {

            if (isset($_GET["onStock"]) && !empty($_GET["onStock"])) {
                $discountItem = $_GET["discountItem"];
                $onStock = $_GET["onStock"];
                $rangeItemPrice = $_GET["radio"];
                $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);
            } else {
                $discountItem = $_GET["discountItem"];
                $rangeItemPrice = $_GET["radio"];
                $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);
            }
        } else if (isset($_GET["onStock"]) && !empty($_GET["onStock"])) {
            $rangeItemPrice = $_GET["radio"];
            $discountItem = $_GET["discountItem"];
            $onStock = $_GET["onStock"];
            $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);
        } else {
            $discountItem = $_GET["discountItem"];
            $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);
        }
    } else if (isset($_GET["radio"]) && !empty($_GET["radio"])) {
        $rangeItemPrice = $_GET["radio"];
        $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);
    } else if (isset($_GET["onStock"]) && !empty($_GET["onStock"])) {
        $onStock = $_GET["onStock"];
        $products = Database::searchInShop($searchName, $sortBy, $discountItem, $rangeItemPrice, $onStock);
    }
}

?>
<section id="shop-subpage-hero" class="section whitebg">
    <div class="homepage-main maxw">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Minden</h4>
                <h1 class="title-secondline-h1 greencolor">Termék</h1>
            </div>
            <p class="section-paragraph-gray">Az általunk forgalmazott márkáknak köszönhetően folyamatosan bővítjük termékeink palettáját, így ügyfeleink a megbízhatóság és elégedettség mellett vadonatúj pelletcsomagokkal és kapitális fogásokkal is gazdagodhatnak. Nálunk szeretnéd forgalmazni jobbnál jobb termékeidet? Vedd fel velünk a kapcsolatot, és tárgyaljuk meg a részleteket!</p>
            <a href="#shop-product-list">
                <button class="button-green"><span>terméklista</span><i class="bi bi-caret-down-fill"></i></button>
            </a>
        </div>
    </div>
</section>

<section id="shop-product-list" class="section-nopad">
    <div class="homepage-main maxw dfsb">
        <div class="shop-search-bar">
            <form class="shop-search-form dfcc" method="GET" id="search-left">
                <div class="dfsb shop-subpage-search-first">
                    <input type="text" name="search" value="<?= $searchName ?>" placeholder="Keresés terméknév alapján...">
                    <a href="shop.php" class="dffc"><i class="bi bi-x"></i></a>
                </div>
                <div class="dfsb">
                    <p class="shop-search-title-main">Rendezés:</p>
                    <select class="product-select" name="sortItems" id="">
                        <option value="">Nincs rendezés</option>
                        <option value="sortByPriceAsc">Legolcsóbb elől</option>
                        <option value="sortByPriceDesc">Legdrágább elől</option>
                        <option value="sortByDiscount">Akciós elől</option>
                    </select>
                </div>
                <div class="dfcc">

                    <div class="dffs">
                        <div class="check-box dffc">
                            <input type="checkbox" type="checkbox" id="discountItem" class="discountItem" name="discountItem">
                        </div>
                        <label for="discountItem">Akciós</label>
                    </div>

                    <div class="dffs">
                        <div class="check-box dffc">
                            <input type="checkbox" type="checkbox" id="onStock" class="onStock" name="onStock">
                        </div>
                        <label for="discountItem">Raktáron</label>
                    </div>
                </div>
                <div class="dfsb">
                    <p class="shop-search-title-main">Ár</p>
                </div>
                <div class="dfcc secondpart-of-form">
                    <label class="container-radio">1 - 2000 Ft
                        <input type="radio" name="radio" value="1 2000">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container-radio">2000 - 4000 Ft
                        <input type="radio" name="radio" value="2000 4000">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container-radio">4000 - 10000 Ft
                        <input type="radio" name="radio" value="4000 10000">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container-radio">10000 Ft felett
                        <input type="radio" name="radio" value="10000">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <label for="search-form" class="dfc shop-search-box">
                    <input type="submit" class="button-green" name="submit-form" id="shop-search-box-submit" value="keresés" />
                </label>
            </form>
        </div>
        <div class="shop-subpage-product-list">
            <div class="shop-subpage-product-grid">
                <?php

                //ha nincs találat a keresésre
                if (!$products) {

                    echo
                    "
                    <div style='display:flex;justify-content:center;align-items:center;width:100%;padding:2rem;gap:1rem;'>Nincs megfelelő találat a keresésre!<i style='color:#65A850;' class='bi bi-emoji-frown '></i></div>
                    ";
                }
                //ha van találat a kifejezésre
                else {

                    //adatokkal feltöltött tömb bejárása
                    foreach ($products as $product) {

                        //ha a termék akciós
                        if ($product->discount > 0) {

                            //akciós ár kiszámítása, majd a kapott ár lekerekítése
                            $discPrice = 100 - $product->discount;
                            $discPrice = $discPrice * 0.01;
                            $discPrice = $discPrice * $product->price;
                            $discPrice = round($discPrice);

                            echo
                            "
                        <div class='shop-grid-item dfcc'>
                            <div class='shop-item-discount dffc'>-{$product->discount}%</div>
                        <div class='shop-image-container dffc'>
                            <img src='img/products/{$product->image}' alt='{$product->image}'>
                            <div class='shop-image-background'></div>
                        </div>
                        <div class='shop-item-body'>
                            <div class='dfcc'>
                            <div class='dfsb shop-item-title'>
                                <h4>{$product->name}</h4>
                                <p>{$product->weight} g</p>   
                            </div>
                            <div class='dfsb'>
                                <div class='dffc shop-item-price'>
                                    <span>{$discPrice} Ft</span>
                                    <span style='text-decoration:line-through;'>{$product->price} Ft</span>
                                </div>
                                <a href='item.php?id={$product->id}'><i style='color:#272727;' class='bi bi-caret-right-fill'></i></a>
                            </div>
                            </div>
                            <a href='cart.php?id={$product->id}' class='shop-item-tocart dffc'>Kosárba <i class='bi bi-cart-fill'></i></a>
                        </div>
                        </div>
                        ";
                        }
                        //ha a termék éppen nincsen leakciózva
                        else {

                            echo
                            "
                    <div class='shop-grid-item dfcc'>
                    <div class='shop-image-container dffc'>
                        <img src='img/products/{$product->image}' alt='{$product->image}'>
                        <div class='shop-image-background'></div>
                    </div>
                    <div class='shop-item-body'>
                        <div class='dfcc'>
                        <div class='dfsb shop-item-title'>
                            <h4>{$product->name}</h4>
                            <p>{$product->weight} g</p>   
                        </div>
                        <div class='dfsb'>
                            <div class='dffc shop-item-price'>
                                <span>{$product->price} Ft</span>
                                <span>( {$product->unitPrice} Ft/kg )</span>
                            </div>
                            <a href='item.php?id={$product->id}'><i style='color:#272727;' class='bi bi-caret-right-fill'></i></a>
                        </div>
                        </div>
                        <a href='cart.php?id={$product->id}' class='shop-item-tocart dffc'>Kosárba <i class='bi bi-cart-fill'></i></a>
                    </div>
                    </div>
                    ";
                        }
                    }
                }
                ?>
            </div>
            <div class="dffc">

                <a <?= $page > 1 ? "href='shop.php?page=$previousPage'" : "disabled" ?>><i class='bi bi-caret-left-fill'></i></a>
                <?php

                //a totalPages változó értékével megegyező oldalszámok legenerálása for loop segítségével
                for ($i = 1; $i <= $totalPages; $i++) {

                    echo "<a href='shop.php?page=$i'>$i</a>";
                }

                ?>

                <a <?= $page < $numOfItems ? "href='shop.php?page=$nextPage'" : "disabled" ?>><i class='bi bi-caret-right-fill'></i></a>
            </div>
        </div>
    </div>
</section>

<!-- footer importja -->
<?php require_once("./components/footer.php") ?>
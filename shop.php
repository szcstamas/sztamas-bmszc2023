<?php require_once("./components/header.php") ?>

<?php

require_once("db/database.php");

//adatbázis kapcsolódás
Database::connect();
//az összes item megjelenítése az adatbázisból
$products = Database::getAllProducts();

$searchName = "";

if (
    isset($_GET["search"]) &&
    !empty($_GET["search"])
) {
    $searchName = $_GET["search"];
    $products = Database::searchProductByName($searchName);
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
                <div class="dfsb">
                    <p class="shop-search-title-main">Rendezés:</p>
                    <select class="product-select" name="sortItems" id="">
                        <option value="Legolcsóbb elől">Legolcsóbb elől</option>
                        <option value="Legdrágább elől">Legdrágább elől</option>
                        <option value="Akciós elől">Akciós elől</option>
                    </select>
                </div>
                <div class="dfcc">
                    <label for="discountItem" class="container">Akciós
                        <input type="checkbox" name="discountItem" id="discountItem">
                        <span class="checkmark"></span>
                    </label>
                    <label for="onStockItem" class="container">Raktáron
                        <input type="checkbox" name="onStockItem" id="onStockItem">
                        <span class="checkmark"></span>
                    </label>
                    <label for="broBaitsItems" class="container">BroBaits termékek
                        <input type="checkbox" name="broBaitsItems" id="broBaitsItems">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="dfsb">
                    <p class="shop-search-title-main">Ár</p>
                </div>
                <div class="dfcc-secondpart-of-form">
                    <label for="discountItem" class="container2">1 - 2000 Ft
                        <input type="checkbox" name="discountItem" id="discountItem" value="1-2000">
                        <span class="checkmark2"></span>
                    </label>
                    <label for="onStockItem" class="container2">2 - 4000 Ft
                        <input type="checkbox" name="onStockItem" id="onStockItem" value="2-4000">
                        <span class="checkmark2"></span>
                    </label>
                    <label for="discountItem" class="container2">4 - 8000 Ft
                        <input type="checkbox" name="discountItem" id="broBaitsItems" value="4-8000">
                        <span class="checkmark2"></span>
                    </label>
                </div>
            </form>
        </div>
        <div class="shop-subpage-product-list">
            <form method="GET" class="dffc" id="search-right">
                <input type="text" name="search" value="<?= $searchName ?>" placeholder="Keresés terméknév alapján...">
                <a href="shop.php" class="dfcc"><i class="bi bi-x"></i></a>
                <label for="submit" class="dfc">
                    <input type="submit" value="" onclick="submitForms()" /><i class="bi bi-search"></i>
                </label>
            </form>
            <div class="shop-subpage-product-grid">

                <?php

                if (!$products) {

                    echo
                    "
                    <div style='display:flex;justify-content:center;align-items:center;width:100%;padding:2rem;gap:1rem;'>Nincs megfelelő találat a keresésre! Próbálj meg egy másik kifejezést! <i style='color:#65A850;' class='bi bi-emoji-frown '></i></div>
                    ";
                } else {

                    foreach ($products as $product) {
                        if ($product->discount > 0) {

                            $discPrice = 100 - $product->discount;
                            $discPrice = $discPrice * 0.01;
                            $discPrice = $discPrice * $product->price;

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
                        } else {

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
        </div>
    </div>
</section>


<?php require_once("./components/footer.php") ?>
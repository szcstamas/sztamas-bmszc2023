<?php require_once("./components/header.php") ?>

<?php

require_once("db/database.php");

Database::connect();
//az összes item megjelenítése az adatbázisból
$products = Database::getAllProducts();

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
            <form class="shop-search-form dfcc" action="GET">
                <div class="dfsb">
                    <p class="shop-search-title-main">Rendezés:</p>
                    <select class="product-select" name="sortItems" id="">
                        <option value="Legolcsóbb elől">Legolcsóbb elől</option>
                        <option value="Legdrágább elől">Legdrágább elől</option>
                        <option value="Akciós elől">Akciós elől</option>
                    </select>
                </div>
                <div class="dfcc">
                    <div class="dfc">
                        <label for="discountItem" class="container">Akciós
                            <input type="checkbox" name="discountItem" id="discountItem">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="dfc">
                        <label for="onStockItem" class="container">Raktáron
                            <input type="checkbox" name="onStockItem" id="onStockItem">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="dfc">
                        <label for="discountItem" class="container">BroBaits termékek
                            <input type="checkbox" name="broBaitsItems" id="broBaitsItems">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="dfsb">
                    <p class="shop-search-title-main">Ár</p>
                </div>
                <div class="dfcc">
                    <div class="dfc">
                        <label for="discountItem" class="container">1 - 2000 Ft
                            <input type="checkbox" name="discountItem" id="discountItem" value="1-2000">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="dfc">
                        <label for="onStockItem" class="container">2 - 4000 Ft
                            <input type="checkbox" name="onStockItem" id="onStockItem" value="2-4000">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="dfc">
                        <label for="discountItem" class="container">4 - 8000 Ft
                            <input type="checkbox" name="discountItem" id="broBaitsItems" value="4-8000">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="shop-subpage-product-list">
            <form action="GET" class="dffc">
                <input type="text" name="search" placeholder="Keresés terméknév alapján...">
                <a href="?deletesearch" class="dfcc"><i class="bi bi-x"></i></a>
                <label for="submit" class="dfc">
                    <input type="submit" value="" name="submit" /><i class="bi bi-search"></i>
                </label>
            </form>
            <div class="shop-subpage-product-grid">

                <?php

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
                                <a href='product.php?id={$product->id}'><i style='color:#272727;' class='bi bi-caret-right-fill'></i></a>
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
                            <a href='product.php?id={$product->id}'><i style='color:#272727;' class='bi bi-caret-right-fill'></i></a>
                        </div>
                        </div>
                        <a href='cart.php?id={$product->id}' class='shop-item-tocart dffc'>Kosárba <i class='bi bi-cart-fill'></i></a>
                    </div>
                    </div>
                    ";
                    }
                }

                ?>
            </div>
        </div>
    </div>
</section>


<?php require_once("./components/footer.php") ?>
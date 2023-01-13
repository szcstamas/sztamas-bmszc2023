<?php
require_once('components/header.php');
require_once("db/database.php");

Database::connect();

$product = "";

if (isset($_GET["id"]) && $_GET["id"] != "") {

    $id = $_GET["id"];
    $product = Database::getProductById($id);

    //a terméknév kettéosztása (hogy megfelelően megjelenhessen a kódban)
    $text = $product->name;
    //felkerekíti a névben található szavak számát
    $half = (int)ceil(count($words = str_word_count($text, 1, 'àáãç3ÁRVÍZTŰRŐTÜKÖRFÚRÓGÉPárvíztűrőtükörfúrógép')) / 2);
    //az elnevezés első szelete (a kapott érték kettéosztása az array_slice functionnel)
    $halfOfNameFirst = implode(' ', array_slice($words, 0, $half));
    //az elnevezés második szelete
    $halfOfNameSecond = implode(' ', array_slice($words, $half));
}

$otherItems = Database::getAllProducts();
?>


<?php if (!empty($product)) : ?>

    <section id="item-subpage-hero" class="section whitebg">
        <div class="homepage-main maxw dfsb">
            <div class="homepage-main-hero section-text-button item-left-row-overflow">
                <div class="dfsb item-subpage-firstrow">
                    <a href="shop.php" class="dffc" style="gap:.5rem;"><i class="bi bi-caret-left-fill"></i>TERMÉKEK</a>
                    <span style="color:#65A850;">-------------------------</span>
                    <span class="item-subpage-info"><i class="bi bi-info-circle"></i> A többi információ megtekintéséhez görgess!</span>
                </div>
                <div class="homepage-main-title">
                    <h4 class="title-firstline"><?= $halfOfNameFirst ?></h4>
                    <h1 class="title-secondline-h1 greencolor"><?= $halfOfNameSecond ?></h1>
                </div>
                <p class="section-paragraph-gray"><?= $product->description ?></p>

                <div class="dfsb item-subpage-left-row">
                    <div class="dfcc">
                        <?php if ($product->discount > 0) {

                            $discPrice = 100 - $product->discount;
                            $discPrice = $discPrice * 0.01;
                            $discPrice = $discPrice * $product->price;
                            $discPrice = round($discPrice);

                            echo "<h4 class='item-subpage-detail-title'>$discPrice Ft <span style='font-family:Bebas Neue, Arial, Helvetica, sans-serif;text-decoration:line-through;opacity:0.35;'>$product->price Ft</span></h4>";
                        } else if ($product->discount === 0) {
                            echo "<h4 class='item-subpage-detail-title'>$product->price Ft</h4>";
                        }
                        ?>
                        <p class="item-subpage-unitprice">Egységár: <?= $product->unitPrice ?> Ft/kg</p>
                    </div>
                    <div class="dffc">
                        <div class="item-subpage-counter dffc">
                            <button class='button-border decrease' style="appearance:none;border:none;box-shadow:none;" type='button'>-</button>
                            <input class="input-count" type='text' readonly aria-label='Example text with two button addons' value="1">
                            <button class='button-border increase' style="appearance:none;border:none;box-shadow:none;" type='button'>+</button>
                        </div>
                        <div class="item-subpage-cart">
                            <a href='cart.php?id=<?= $product->id ?>' class='button-green dffc'>Kosárba<i class="bi bi-cart-fill"></i></a>
                        </div>
                    </div>
                </div>

                <div class="dffs item-subpage-left-row item-subpage-common-informations">
                    <div class="dffc">
                        <?php
                        if ($product->quantity > 0) {
                            echo "<i class='bi bi-check-square'></i><span>készleten</span>";
                        } else {
                            echo "<i style='color:#f59042;' class='bi bi-x-square'></i></i><span style='color:#f59042;'>beszállítás alatt</span>";
                        }

                        ?>
                    </div>
                    <div class="dffc">
                        <i class="bi bi-credit-card"></i><span>bankkártyás fizetés</span>
                    </div>
                    <div class="dffc">
                        <i class="bi bi-truck"></i><span>kiszállítási idő: 1-3 nap</span>
                    </div>
                </div>

                <div class="dfcc item-subpage-left-row">
                    <h4 class="item-subpage-detail-title">Részletek</h4>
                    <div class="item-subpage-left-row-grids">
                        <div class="item-subpage-left-row-gridfirst">
                            <div class="item-subpage-left-row-td dfcc">
                                <p class="item-subpage-left-row-td-title">Kiszerelés</p>
                                <p class="item-subpage-left-row-td-value"><?= $product->weight ?> g</p>
                            </div>
                            <div class="item-subpage-left-row-td dfcc">
                                <?php

                                switch ($product->category) {

                                    case "pellet":
                                        echo "<p class='item-subpage-left-row-td-title'>Pellet méretei</p>
                                    <p class='item-subpage-left-row-td-value'>{$product->unitSize} mm</p>";
                                        break;
                                    case "feed":
                                        echo "<p class='item-subpage-left-row-td-title'>Szemcseméret</p>
                                    <p class='item-subpage-left-row-td-value'>{$product->unitSize}</p>";
                                        break;
                                    default:
                                        break;
                                }

                                ?>
                            </div>
                            <div class="item-subpage-left-row-td dfcc">
                                <p class="item-subpage-left-row-td-title">Termék ízesítése</p>
                                <p class="item-subpage-left-row-td-value"><?= $product->flavour ?></p>
                            </div>
                        </div>
                        <div class="item-subpage-left-row-gridsecond ">
                            <div class="item-subpage-left-row-td dfcc">
                                <p class="item-subpage-left-row-td-title">Termék színe</p>
                                <p class="item-subpage-left-row-td-value"><?= $product->colour ?></p>
                            </div>
                            <div class="item-subpage-left-row-td dfcc">
                                <p class="item-subpage-left-row-td-title">Preferált halak</p>
                                <p class="item-subpage-left-row-td-value"><?= $product->preFishes ?></p>
                            </div>
                        </div>
                        <div class="item-subpage-left-row-max">
                            <div class="item-subpage-left-row-td dfcc">
                                <p class="item-subpage-left-row-td-title">Hozzávalók</p>
                                <p class="item-subpage-left-row-td-value"><?= $product->components ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-image-container dffc">
                <img src="<?= "img/products/{$product->image}" ?>" alt="">
                <div class="item-image-container-background">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="items-other-products" class="section section-nopad whitebg">
        <div class="homepage-main maxw">
            <hr style="color: #65A850; border:none; border-bottom: 1px solid #65A850;">
            <div class="dfsb items-other-products-main" style="gap: 4rem;">
                <div class="homepage-main-hero section-text-button">
                    <div class="homepage-main-title">
                        <h4 class="title-firstline">További</h4>
                        <h1 class="title-secondline-h1 greencolor">Termékeink</h1>
                    </div>
                    <p class="section-paragraph-gray">Elképesztő termékkínálatunkban profibbnál profibb pellet- és etetőanyagcsomagok találhatóak, melyek elengedhetetlen részét képezik a minőségi horgászatnak!</p>
                    <a href="shop.php">
                        <button class="button-green"><span>További termékeink</span><i class="bi bi-caret-right-fill"></i></button>
                    </a>
                </div>
                <div class="items-other-items-grid">
                    <div class="other-item-container">
                        <?php

                        $i = 0;
                        foreach ($otherItems as $product) {
                            if ($product->discount > 0) {

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
                                        <a href='item.php?id={$product->id}'><i class='bi bi-caret-right-fill'></i></a>
                                    </div>
                                    </div>
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
                            </div>
                            </div>
                            ";
                            }

                            if (++$i == 4) break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php else : ?>
    <section id="shop-subpage-hero" class="section whitebg">
        <div class="homepage-main maxw">
            <div class="homepage-main-hero section-text-button">
                <div class="homepage-main-title">
                    <h4 class="title-firstline">Nincs ilyen</h4>
                    <h1 class="title-secondline-h1 greencolor">Termék</h1>
                </div>
                <p class="section-paragraph-gray">Az általad keresett termék nem jeleníthető meg! Kérjük hogy nézd át tüzetesen webshopunk kínálatát, majd ha sikerült választani, akkor kattints a termék neve alatt látható <b>nyíl ikonra</b>! Köszönjük!</p>
                <a href="shop.php">
                    <button class="button-green"><span>terméklista</span><i class="bi bi-caret-left-fill"></i></button>
                </a>
            </div>
        </div>
    </section>


<?php endif ?>




<?php require_once('components/subscribe.php') ?>
<?php require_once('components/footer.php') ?>
<?php require_once("./components/header.php") ?>

<?php

require_once("db/database.php");

Database::connect();
$otherItems = Database::getAllProducts();

?>

<section id="homepage-hero" class="section video-bg">
    <div class="homepage-main maxw">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Pellet?</h4>
                <img class="title-big-green-brobaits" src="/sztamas-bmszc2023/img/brobaits-big-green.svg" alt="brobaits-green-title">
            </div>
            <p class="section-paragraph-gray">Ha a klassz élmények, a remek időtöltés és a kapitális fogások mellett fontos számodra a minőség is, akkor ne habozz! Cégünk által forgalmazott pelletcsomagjaink tengerentúli kvalitással és megbízhatósággal segítik horgászatodat, hogy ne maradhass hal nélkül!</p>
            <a href="#top-products">
                <button class="button-green"><span>top termékeink</span><i class="bi bi-caret-down-fill"></i></button>
            </a>
        </div>
    </div>
</section>

<section id="top-products" class="section-nopad greenbg">
    <div class="homepage-main maxw dfsb">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Top</h4>
                <h1 class="title-secondline-h1 whitecolor">Termékeink</h1>
            </div>
            <p class="section-paragraph-white">Termékkínálatunk legjobbjai nem véletlenül foglalnak el dobogós helyeket pelleteink képzeletbeli versenyén: ezeket a pelletcsomagokat a vásárlói visszajelzéseknek köszönhetően avanzsáltuk a legjobbak legjobbjaivá. Ha élményben gazdag horgászatra vágysz, szerezd be őket azonnal!</p>
            <a href="shop.php">
                <button class="button-white"><span>összes termék</span><i class="bi bi-caret-right-fill"></i></button>
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
                        $discPrice = ceil($discPrice / 10) * 10;

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
                                    <a class='shop-link-title' style='display:inline-block;background-color:transparent;height:100%;width:100%;' href='item.php?id={$product->id}'><h4>{$product->name}</h4></a>
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
                                <a class='shop-link-title' style='display:inline-block;background-color:transparent!important;height:100%;width:100%;' href='item.php?id={$product->id}'><h4>{$product->name}</h4></a>
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
</section>

<section id="selling-and-partners" class="section-nopad whitebg">
    <div class="homepage-main maxw dfsb">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Viszonteladás és</h4>
                <h1 class="title-secondline-h1 greencolor">Partnereink</h1>
            </div>
            <p class="section-paragraph-gray">Kiváló partnereinknek köszönhetően folyamatosan bővítjük oldalunk kínálatát, így ügyfeleink a megbízhatóság és elégedettség mellett vadonatúj termékcsomagokkal és kapitális fogásokkal gazdagodhatnak. Árusítani szeretnéd a BroBaits© pelletcsomagjait? Viszonteladásra kínálnád jobbnál jobb termékeidet? Vedd fel velünk a kapcsolatot, és tárgyaljuk meg a részleteket!</p>
            <a href="partners.php">
                <button class="button-green"><span>partnereink</span><i class="bi bi-caret-right-fill"></i></button>
            </a>
        </div>
        <div class="partners-box-container">
            <div class="dfcc partners-box-column">
                <div class="partners-us-hook">
                    <span class="partners-us-reel"></span>
                    <img src="img/hook.png" alt="horog">
                </div>
                <div class="dfsb">
                    <div class="partners-box-image-container dffc"><img src="img/partners/haldorado.png" alt="Haldorádó Logó"></div>
                    <div class='partners-empty-box'></div>
                </div>
                <div class="dfsb">
                    <div class='partners-empty-box'></div>
                    <div class="partners-box-image-container dffc"><img src="img/partners/benzarmix.png" alt="Benzár mix Logó"></div>
                </div>
                <div class="dfsb">
                    <div class="partners-box-image-container dffc"><img src="img/partners/feedermania.png" alt="Feedermania Logó"></div>
                    <div class='partners-empty-box'></div>
                </div>
                <div class="dfsb">
                    <div class='partners-empty-box'></div>
                    <div class="partners-box-image-container dffc"><img src="img/partners/walterland.png" alt="Walterland Logó"></div>
                </div>
                <div class="dfsb">
                    <div class="partners-box-image-container dffc"><img src="img/partners/xfish.png" alt="Xfish Logó"></div>
                    <div class='partners-empty-box'></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="best-catches" class="section-nopad greenbg">
    <div class="homepage-main maxw dfsb">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Kedvenc</h4>
                <h1 class="title-secondline-h1 whitecolor">Fogásaink</h1>
            </div>
            <p class="section-paragraph-white">Mindig szeretettel fogadjuk az elégedett ügyfelek visszajelzéseit, kiváltképp akkor, ha szebbnél szebb fogásokkal tisztelnek meg minket. Büszke horgászaink az általunk gyártott és forgalmazott pelletcsomagokkal etettek, és ahogy azt a képek már elárulták: nem maradtak hal nélkül!</p>
            <div class="dffc">
                <a href="https://www.facebook.com" class="mainpage-social-link"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com" class="mainpage-social-link"><i class="bi bi-instagram"></i></a>
                <h4 class="whitecolor" style="font-family:'Bebas Neue', Arial, Helvetica, sans-serif;font-size:60px;letter-spacing:1px;">#BROBAITS</h4>
            </div>
        </div>

        <div class="best-catches-container">
            <div class="dfcc best-catches-column">
                <div class="dfsb">
                    <a class="best-catches-link" href="https://www.instagram.com" style="background-image: url(img/bestcatches/1.png);background-repeat:none;background-size:cover;background-position:center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a class="best-catches-link" href="https://www.instagram.com" style="background-image: url(img/bestcatches/2.png);background-repeat:none;background-size:cover;background-position:center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
                <div class="dfsb">
                    <a class="best-catches-link" href="https://www.instagram.com" style="background-image: url(img/bestcatches/3.png);background-repeat:none;background-size:cover;background-position:center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a class="best-catches-link" href="https://www.instagram.com" style="background-image: url(img/bestcatches/4.png);background-repeat:none;background-size:cover;background-position:center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
                <div class="dfsb">
                    <a class="best-catches-link" href="https://www.instagram.com" style="background-image: url(img/bestcatches/5.png);background-repeat:none;background-size:cover;background-position:center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a class="best-catches-link" href="https://www.instagram.com" style="background-image: url(img/bestcatches/6.png);background-repeat:none;background-size:cover;background-position:center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
                <div class="dfsb">
                    <a class="best-catches-link" href="https://www.instagram.com" style="background-image: url(img/bestcatches/7.png);background-repeat:none;background-size:cover;background-position:center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a class="best-catches-link" href="https://www.instagram.com" style="background-image: url(img/bestcatches/8.png);background-repeat:none;background-size:cover;background-position:center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="fish-calendar" class="section-nopad whitebg">
    <div class="homepage-main maxw dfstr">
        <div class="homepage-main-hero section-text-button" style="padding: 6rem 0;">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Hal</h4>
                <h1 class="title-secondline-h1 greencolor">Tudakozó</h1>
            </div>
            <p class="section-paragraph-gray">Oldalunk haltudakozójának segítségével a hazánkban megtalálható, leggyakoribb nemeshalakról szóló, alapvető információk tekinthetőek meg. A hivatalos adatok megtekintéséhez csak az egérkurzort kell a hal képére helyezni. <em>To choose english language, please select <b>EN</b> button.</em></p>
            <div class="language-container">
                <button class="language hungarian language-active">HU</button>
                <button class="language english">EN</button>
            </div>
        </div>
        <div class="fish-book">
            <div class="header-container">
                <p id="leiras">Vidd az egeret a hal fölé!</p>
            </div>

            <div class="main-container">

                <div class="img-container">
                    <img class="img-main" src="img/ponty.jpg" alt="">
                </div>

                <a href="#" class="img-link" target="_blank"><button><span id="img-link-fish">a pontyról</span></button></a>

                <div class="img-article">
                    <div class="img-article-h1">Ponty</div>
                    <div class="img-article-p">A ponty (Cyprinus carpio) a sugarasúszójú csontos halak közé tartozó típusfaj, a
                        pontyalakúak rendjének és a pontyfélék családjának névadója.</div>
                </div>
                <div class="img-info"><i class="fa-solid fa-circle-info"></i></div>

                <div class="img-subtext">
                    <div class="img-subtext-h1">Maximális méret</div>
                    <ul class="img-subtext-p">110 cm (3.6 ft), 38 kg (83 lb)</ul>
                    <div class="img-subtext-maxage">Maximális életkor</div>
                    <div class="img-subtext-maxage-p">38 év</div>
                </div>
            </div>

            <div class="container">
                <button class="prev-button"><i class="bi bi-caret-left-fill"></i></button>
                <span class="circle active"></span>
                <span class="circle"></span>
                <span class="circle"></span>
                <span class="circle"></span>
                <span class="circle"></span>
                <button class="next-button"><i class="bi bi-caret-right-fill"></i></button>
            </div>

            <div class="fishbook-bg"></div>
        </div>
    </div>
</section>

<?php require_once("./components/subscribe.php") ?>
<?php require_once("./components/footer.php") ?>
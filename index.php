<?php require_once("./components/header.php") ?>

<?php

require_once("db/database.php");

Database::connect();

//delete images when uploading new image for same item with same name
$dir = 'img/products/';
$files1 = scandir($dir);

foreach ($files1 as $filename) {
    $pos = strpos($filename, "sushi_mix");

    if ($pos !== false) {
        unlink("img/products/$filename");
    }
}

?>

<section class="section video-bg">
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

<section id="top-products" class="section greenbg">
    <div class="homepage-main maxw">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Top</h4>
                <h1 class="title-secondline-h1 whitecolor">Termékeink</h1>
            </div>
            <p class="section-paragraph-white">Termékkínálatunk legjobbjai nem véletlenül foglalnak el dobogós helyeket pelleteink képzeletbeli versenyén: ezeket a pelletcsomagokat a vásárlói visszajelzéseknek köszönhetően avanzsáltuk a legjobbak legjobbjaivá. Ha élményben gazdag horgászatra vágysz, szerezd be őket azonnal!</p>
            <a href="pellets.php">
                <button class="button-white"><span>összes termék</span><i class="bi bi-caret-right-fill"></i></button>
            </a>
        </div>
        <div class="top-product-list">

        </div>
    </div>
</section>

<section id="selling-and-partners" class="section whitebg">
    <div class="homepage-main maxw">
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
        <div class="top-product-list">

        </div>
    </div>
</section>

<section id="best-catches" class="section greenbg">
    <div class="homepage-main maxw">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Kedvenc</h4>
                <h1 class="title-secondline-h1 whitecolor">Fogásaink</h1>
            </div>
            <p class="section-paragraph-white">Mindig szeretettel fogadjuk az elégedett ügyfelek visszajelzéseit, kiváltképp akkor, ha szebbnél szebb fogásokkal tisztelnek meg minket. Büszke horgászaink az általunk gyártott és forgalmazott pelletcsomagokkal etettek, és ahogy azt a képek már elárulták: nem maradtak hal nélkül!</p>
            <div class="dffc">
                <a href="" class="mainpage-social-link"><i class="bi bi-facebook"></i></a>
                <a href="" class="mainpage-social-link"><i class="bi bi-instagram"></i></a>
                <h4 class="whitecolor" style="font-family:'Bebas Neue', Arial, Helvetica, sans-serif;font-size:60px;letter-spacing:1px;">#BROBAITS</h4>
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

<section id="newsletter-subscribe" class="greenbg">
    <div class="maxw dfsb">
        <h2 class="section-paddinglow">Iratkozz fel hírlevelünkre!</h2>
        <p clas="section-paddinglow">Újdonságok, hírek, vadonatúj termékek első kézből!</p>
        <form action="POST" class="subscribe-newsletter-form dfc">
            <input type="email" placeholder="pelda@peldamail.hu">
            <input type="submit" value="FELIRATKOZÁS">
        </form>
    </div>
</section>

<?php require_once("./components/footer.php") ?>
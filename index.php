<?php require_once("./components/header.php") ?>

<?php

require_once("db/database.php");

Database::connect();

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
            <a href="#top-products">
                <button class="button-white"><span>összes termék</span><i class="bi bi-caret-down-fill"></i></button>
            </a>
        </div>
        <div class="top-product-list">

        </div>
    </div>
</section>

<?php require_once("./components/footer.php") ?>
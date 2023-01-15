<?php require_once("./components/header.php") ?>
<?php
$partnersJson = file_get_contents('./js/json/partners.json');
$partnersArray = json_decode($partnersJson, true);
?>

<section id="partners-subpage-hero" class="section whitebg">
    <div class="homepage-main maxw dfsb">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Gyártók és</h4>
                <h1 class="title-secondline-h1 greencolor">Partnereink</h1>
            </div>
            <p class="section-paragraph-gray">Partnereink aloldalán a cégünkkel folyamatos kapcsolatban lévő, kis- és nagykereskedelmi gyártókat soroltatjuk fel csatlakozási sorrendben. Az itt látható profi márkák stabil céges hátterüknek és sok-sok éves szakmai tapasztalatuknak köszönhetően foglalhatták el helyüket nálunk: frappáns termékeik a mai napig beszerezhetőek a BroBaits© terméklistájáról.
                <br><br>
                Viszonteladásra kínálnád termékeidet? Esetleg érdekelnek a cégünk által forgalmazott, eredeti, minőségi BroBaits© pelletcsomagok? Vedd fel velünk a kapcsolatot, és tárgyaljuk meg a részleteket!
            </p>
            <div class="dffc">
                <a href="#partners-subpage-partnerlist">
                    <button class="button-green"><span>partnereink</span><i class="bi bi-caret-down-fill"></i></button>
                </a>
                <a href="#partners-subpage-forpartners">
                    <button class="button-gray"><span>viszonteladóknak</span><i class="bi bi-caret-down-fill"></i></button>
                </a>
                <a href="contact.php">
                    <button class="button-border"><span>kapcsolat</span><i class="bi bi-caret-right-fill"></i></button>
                </a>
            </div>
        </div>
        <div class="partners-subpage-image">
        </div>
    </div>
</section>

<section id="partners-subpage-partnerlist" class="section-nopad whitebg">
    <div class="partners-subpage-partnerlist-container dffc maxw">
        <?php

        foreach ($partnersArray as $partner) {

            echo
            "
            <div class='dfcc partners-subpage-partnerlist-box'>
                <div class='partners-subpage-imgbox dffc'>
                    <a href='{$partner["link"]}'><img src='img/partners/{$partner["image"]}'></a>
                </div>
                <div class='partners-subpage-titlebox'>
                    <a href='{$partner["link"]}'><h4>{$partner["name"]}</h4></a>
                </div>
                <div class='partners-subpage-descbox'>
                    <span>{$partner["desc"]}</span>
                </div>
            </div>
            
            ";
        }


        ?>
    </div>
</section>

<section id="partners-subpage-forpartners" class="section greenbg">
    <div class="homepage-main maxw dfsb">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Támogatás és</h4>
                <h1 class="title-secondline-h1 whitecolor">Viszonteladás</h1>
            </div>
            <p class="section-paragraph-white">A BroBaits egy teljesen friss, fiatalos márka a magyar horgászpelletek piacán. Webshopunkat kis- és nagykereskedelmi céllal hoztuk létre, hogy a legkedvezőbb áron és a leghatékonyabban szolgálhassuk ki ügyfélkörünket.
                <br><br>
                Termékeinkre jellemző <b>az egyenletes minőség, a kiváló beltartalmi érték, a kimagasló ár-érték arány és a folyamatosan bővülő termékpaletta.</b> Ha termékeink felkeltette érdeklődésedet és szeretnél tőlünk vásárolni, akkor nincs más teendőd, mint megtárgyalni velünk a viszonteladásról szóló részleteket. Ezt a Kapcsolat aloldalon teheted meg a linkre, vagy a szöveg alatti gombra kattintva.
                <br><br>
                Bízunk benne, hogy hamarosan elégedett partnereink között tudhatunk majd téged, titeket!
            </p>
            <a href="contact.php">
                <button class="button-white"><span>kapcsolat</span><i class="bi bi-caret-right-fill"></i></button>
            </a>
        </div>

        <div class="partners-subpage-forpartners-image-container dffc">
            <img src="img/boxes.png" alt="viszonteladás és partnereink">
            <div class="partners-subpage-forpartners-image-bg"></div>
        </div>
    </div>
</section>



<?php require_once("./components/footer.php") ?>
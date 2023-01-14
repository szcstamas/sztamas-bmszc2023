<?php require_once("./components/header.php") ?>

<?php

require_once("db/database.php");

Database::connect();

?>

<section id="about-subpage-hero" class="section whitebg" style="padding-bottom:3rem;">
    <div class="homepage-main maxw">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Amit tudnod kell</h4>
                <h1 class="title-secondline-h1 greencolor">Rólunk</h1>
            </div>
            <p class="section-paragraph-gray">Legyen szó bármilyen termékről vagy pelletcsomagról, a BroBaits© munkatársai számára a mai napig közös a cél: minőségi etetőanyagok előállítása megbízható ügyfélkörünk számára, hogy vásárlóink eredményesen, nagyobbnál nagyobb fogásokkal gazdagodhassanak horgászatuk során.
                Érdekel a sztorink? Vágjunk bele!</p>
            <a href="#about-subpage-main">
                <button class="button-green"><span>rólunk és gy.i.k</span><i class="bi bi-caret-down-fill"></i></button>
            </a>
        </div>
        <div class="top-product-list">

        </div>
    </div>
</section>



<section id="about-subpage-main" class="whitebg" style="padding-bottom:0rem;">

    <div class="homepage-main maxw dfcc" style="gap:0rem;border-top:1px solid #ccc;">
        <div class="about-subpage-container dffc">
            <div class="about-subpage-container-box dfcc">
                <img src="img/green-thumbsup.png" alt="">
                <h3>Minőség</h3>
                <p class="section-paragraph-gray">
                    Ha minőségről van szó, nálunk ez soha nem jelentett problémát! Válassz minket bizalommal, hogy egy felejthetetlen élményekben gazdag horgászatban legyen részed!
                </p>
            </div>
            <div class="about-subpage-container-box dfcc">
                <img src="img/green-checkmark.png" alt="">
                <h3>Garancia</h3>
                <p class="section-paragraph-gray">
                    Nem voltál megelégedve pelletcsomagoddal? Minden BroBaits© termékre <b>1 év garanciát</b> vállalunk!
                </p>
            </div>
            <div class="about-subpage-container-box dfcc">
                <img src="img/green-truck.png" alt="">
                <h3>Elérhetőség</h3>
                <p class="section-paragraph-gray">
                    Webshopunknak és
                    kiszállítási rendszerünknek köszönhetően bárhonnan rendelhetsz!
                </p>
            </div>
        </div>

        <div class="dfsb about-second-section">
            <div class="about-qa-container dfcc">
                <div class="about-qa-box dfcc">
                    <div class="about-qa-q">
                        <h4>Mikor és hol kezdtétek?</h4>
                        <input type="checkbox">
                        <i class="bi bi-x"></i>
                        <div class="about-qa-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo optio voluptates non porro temporibus modi, fugit quaerat nam accusantium sit illum dolores nisi repellat beatae.
                        </div>
                    </div>
                </div>
                <div class="about-qa-box dfcc">
                    <div class="about-qa-q">
                        <h4>Miért pont pellet és etetőanyag?</h4>
                        <input type="checkbox">
                        <i class="bi bi-x"></i>
                        <div class="about-qa-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo optio voluptates non porro temporibus modi, fugit quaerat nam accusantium sit illum dolores nisi repellat beatae.
                        </div>
                    </div>
                </div>
                <div class="about-qa-box dfcc">
                    <div class="about-qa-q">
                        <h4>Mióta horgásztok? Mekkora a legnagyobb hal amit fogtatok?</h4>
                        <input type="checkbox">
                        <i class="bi bi-x"></i>
                        <div class="about-qa-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo optio voluptates non porro temporibus modi, fugit quaerat nam accusantium sit illum dolores nisi repellat beatae.
                        </div>
                    </div>
                </div>
                <div class="about-qa-box dfcc">
                    <div class="about-qa-q">
                        <h4>Hol szerettek pecázni? Melyik a kedvenc tavatok?</h4>
                        <input type="checkbox">
                        <i class="bi bi-x"></i>
                        <div class="about-qa-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo optio voluptates non porro temporibus modi, fugit quaerat nam accusantium sit illum dolores nisi repellat beatae.
                        </div>
                    </div>
                </div>
                <div class="about-qa-box dfcc">
                    <div class="about-qa-q">
                        <h4>Milyen alapanyagokból készül a legtöbb termék?</h4>
                        <input type="checkbox">
                        <i class="bi bi-x"></i>
                        <div class="about-qa-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo optio voluptates non porro temporibus modi, fugit quaerat nam accusantium sit illum dolores nisi repellat beatae.
                        </div>
                    </div>
                </div>
                <div class="about-qa-box dfcc">
                    <div class="about-qa-q">
                        <h4>Hogyan lehetek partner és viszonteladó?</h4>
                        <input type="checkbox">
                        <i class="bi bi-x"></i>
                        <div class="about-qa-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo optio voluptates non porro temporibus modi, fugit quaerat nam accusantium sit illum dolores nisi repellat beatae.
                        </div>
                    </div>
                </div>
                <div class="about-qa-box dfcc">
                    <div class="about-qa-q">
                        <h4>Mennyi ideig tart a megrendelt termékek kiszállítása?</h4>
                        <input type="checkbox">
                        <i class="bi bi-x"></i>
                        <div class="about-qa-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo optio voluptates non porro temporibus modi, fugit quaerat nam accusantium sit illum dolores nisi repellat beatae.
                        </div>
                    </div>
                </div>
                <div class="about-qa-box dfcc">
                    <div class="about-qa-q">
                        <h4>Szeretnék képet küldeni a halról amit a nálatok vásárolt pellettel
                            fogtam. Hol tehetem ezt meg?</h4>
                        <input type="checkbox">
                        <i class="bi bi-x"></i>
                        <div class="about-qa-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo optio voluptates non porro temporibus modi, fugit quaerat nam accusantium sit illum dolores nisi repellat beatae.
                        </div>
                    </div>
                </div>

            </div>
            <div class="about-us-container">
                <div>
                    <h4 class="greencolor" style="text-transform: uppercase;font-size:1.25rem;">ezek pedig mi vagyunk!</h4>
                    <hr style="width:100%;border-top:1px solid #ccc;margin-top:10px;">
                </div>
                <div class="about-us-grid">
                    <div class="about-us-hook">
                        <span class="about-us-reel"></span>
                        <img src="img/hook.png" alt="hook">
                    </div>
                    <div class="about-us-personbox dfcc">
                        <div class="image-container">
                            <img src="img/people/szakbotond.png" alt="profil fotó">
                        </div>
                        <div class="name-container">
                            <h5>Szák Botond</h5>
                            <p>alapító, CEO</p>
                        </div>
                    </div>
                    <div class="about-us-personbox dfcc">
                        <div class="image-container">
                            <img src="img/people/vighbalazs.png" alt="profil fotó">
                        </div>
                        <div class="name-container">
                            <h5>Vígh Balázs</h5>
                            <p>ügyvezető</p>
                        </div>
                    </div>
                    <div class="about-us-personbox dfcc">
                        <div class="image-container">
                            <img src="img/people/kovacsarpad.png" alt="profil fotó">
                        </div>
                        <div class="name-container">
                            <h5>Kovács Árpád</h5>
                            <p>logisztikai manager</p>
                        </div>
                    </div>
                    <div class="about-us-personbox dfcc">
                        <div class="image-container">
                            <img src="img/people/antalgereb.png" alt="profil fotó">
                        </div>
                        <div class="name-container">
                            <h5>Antal Geréb</h5>
                            <p>product designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once("./components/subscribe.php") ?>
<?php require_once("./components/footer.php") ?>
<?php require_once("./components/header.php") ?>

<?php

require_once("db/database.php");

Database::connect();

?>

<section id="contact-section-subpage" class="section whitebg">
    <div class="homepage-main maxw dfsb">
        <div class="homepage-main-hero section-text-button">
            <div class="homepage-main-title">
                <h4 class="title-firstline">Elérhetőség és</h4>
                <h1 class="title-secondline-h1 greencolor">Kapcsolat</h1>
            </div>
            <p class="section-paragraph-gray">Kérdésed van a termékeinkkel kapcsolatban? Panaszt szeretnél tenni, esetleg kifogásolható állapotban kaptad meg pelletcsomagodat? Viszonteladáson töröd a fejedet, de nem tudod hogyan fogj hozzá? Hívd ügyfélszolgálatunkat, üzenj nekünk e-mailben, vagy csak szimplán küldj egy kedves levelet üzenetküldő-rendszerünk segítségével!</p>
            <div class="dfc">
                <a href="#">
                    <button class="button-green"><span>üzenetküldés</span><i class="bi bi-caret-right-fill"></i></button>
                </a>
                <a href="#subpage-contact-links">
                    <button class="button-border"><span>elérhetőség</span><i class="bi bi-caret-down-fill"></i></button>
                </a>
            </div>
        </div>
        <div class="subpage-contact-form-container">
            <form class="subpage-contact-form" action="POST">
                <div class="dfc">
                    <label for="">NÉV:</label>
                    <input type="text" placeholder="pl. Gipsz Jakab...">
                </div>
                <div class="dfc">
                    <label for="">EMAIL CÍM:</label>
                    <input type="email" placeholder="pl. irok@uzenetet.hu...">
                </div>
                <div class="dfc">
                    <label for="">ÜZENET TÁRGYA:</label>
                    <input type="text" placeholder="Ide írd az üzeneted tárgyát...">
                </div>
                <textarea name="content" id="" style="resize: none;" placeholder="És ide írd az üzenetedet..."></textarea>
                <input type="submit" class="button-gray" value="ELKÜLDÖM AZ ÜZENETET!">
            </form>
        </div>
    </div>
    <div id="subpage-contact-links" class="homepage-main maxw contact-section-subpage-grid">
        <a href="tel:06123123123123"><i class="bi bi-telephone-fill"></i>06 (123123) 123 123</a>
        <a href="mailto:brobaits@brobaits.hu"><i class="bi bi-send-fill"></i>info@brobaits.hu</a>
        <a href="https://www.facebook.com"><i class="bi bi-facebook"></i>BroBaits</a>
        <a href="https://www.instagram.com"><i class="bi bi-instagram"></i>@brobaits</a>
    </div>
</section>

<?php require_once("./components/subscribe.php") ?>
<?php require_once("./components/footer.php") ?>
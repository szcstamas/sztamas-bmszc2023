<?php ob_start(); ?>
<?php require_once('components/header.php');

//ha a cart tömb be van állítva a munkamenetben (jelenjen meg a html kód, majd szüntesse meg a tömböt) 
if (isset($_SESSION["cart"])) {

    echo
    "
    <section id='checkout-section-thankyou' class='section whitebg'>
        <div class='homepage-main maxw dfsb'>
            <div class='homepage-main-hero section-text-button'>
                <div class='homepage-main-title'>
                    <h4 class='title-firstline'>Köszönjük</h4>
                    <h1 class='title-secondline-h1 greencolor'>Rendelésedet!</h1>
                </div>
                <p class='section-paragraph-gray'>Hálásak vagyunk hogy megtiszteltél minket bizalmaddal, és rendelést adtál le a BroBaits&copy; hivatalos weboldalán! Rendelésed kiszállítási ideje nagyjából 1-3 napot fog igénybe venni (ez nagyban függ a termék raktárkészletétől és a megtett útvonal hosszától). Szállítói partnereink közül a következő futárszolgálatok vehetik majd fel veled a kapcsolatot: <b><em>GLS, DPD, FedEx.</em></b></p>
                <a href='index.php'>
                    <button class='button-green'><span>főoldal</span><i class='bi bi-caret-left-fill'></i></button>
                </a>
            </div>
            <div class='checkout-section-image'>
                <img src='img/main/purple.jpg' alt='thank you image' />
            </div>
        </div>
    </section>
    ";

    unset($_SESSION["cart"]);
} else if (isset($_SESSION["contact"])) {

    echo
    "
    <section id='checkout-section-thankyou' class='section whitebg'>
        <div class='homepage-main maxw dfsb'>
            <div class='homepage-main-hero section-text-button'>
                <div class='homepage-main-title'>
                    <h4 class='title-firstline'>Köszönjük hogy írtál,</h4>
                    <h1 class='title-secondline-h1 greencolor'>{$_SESSION['contact']}!</h1>
                </div>
                <p class='section-paragraph-gray'>Hamarosan felvesszük veled a kapcsolatot vagy telefon, vagy pedig e-mailen keresztül! További szép napot kívánunk!</p>
                <a href='index.php'>
                    <button class='button-green'><span>főoldal</span><i class='bi bi-caret-left-fill'></i></button>
                </a>
            </div>
            <div class='checkout-section-image'>
                <img src='img/main/green.jpg' alt='thank you image' />
            </div>
        </div>
    </section>
    ";

    unset($_SESSION["contact"]);
} else if (isset($_SESSION["subscription"])) {

    echo
    "
    <section id='checkout-section-thankyou' class='section whitebg'>
        <div class='homepage-main maxw dfsb'>
            <div class='homepage-main-hero section-text-button'>
                <div class='homepage-main-title'>
                    <h4 class='title-firstline'>Köszönjük a</h4>
                    <h1 class='title-secondline-h1 greencolor'>Feliratkozást!</h1>
                </div>
                <p class=''>A következő e-mail címmel regisztráltál fel hírlevelünkre: <b>{$_SESSION['subscription']}</b></p>
                <p class='section-paragraph-gray'>Mostantól hírleveleket és különböző marketinges tartalmakat fogsz tőlünk kapni a megadott e-mail címedre! A hírlevélről való leiratkozáshoz kattints a kapott e-mail aljában látható hivatkozásra! Köszönjük! - BroBaits©</p>
                <a href='index.php'>
                    <button class='button-green'><span>főoldal</span><i class='bi bi-caret-left-fill'></i></button>
                </a>
            </div>
            <div class='checkout-section-image'>
                <img src='img/main/softgreen2.jpg' alt='thank you image' />
            </div>
        </div>
    </section>
    ";

    unset($_SESSION["subscription"]);
} else {
    header('Location: index.php');
}
?>

<?php require_once('components/footer.php');
?>
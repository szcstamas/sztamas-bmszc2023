<?php ob_start(); ?>
<?php

require_once("components/header.php");
require_once("db/database.php");
require_once("db/secrets.php");
//csatlakozás az adatbázishoz
Database::connect();

//ha az urlben be van állítva az id paraméter 
if (isset($_GET["id"])) {
  $productId = $_GET["id"];
  //ha a cart tömb be van állítva a munkamenetbe (és van productId változó)
  if (isset($_SESSION["cart"][$productId])) {
    //adjon hozzá egyet a beállított termék darabszámához (ez a plusz gombra kattintásnál)
    $_SESSION["cart"][$productId] = $_SESSION["cart"][$productId] + 1;
  }
  //ha nincs cart tömb (először kerül bele a termék a kosárba), akkor 1 legyen a darabszám 
  else if (!isset($_GET["value"])) {
    $_SESSION["cart"][$productId] = 1;
  }
  //ez akkor kell, ha a termék aloldalán adtunk hozzá az 1 darabszámhoz valamennyit (ebben az esetben a value mint paraméter megjelenik az urlben, és elmentődik) -> ezek után szüntesse meg a countValue tömböt a munkamenetben, hogy a többi termék hozzadásánál is megtörténhessen a folyamat
  else if (isset($_GET["value"])) {
    $_SESSION["cart"][$productId] = $_GET["value"];
    unset($_SESSION["countValue"]);
  }

  header("Location: cart.php");
  ob_end_flush();
  exit();
}
//ha a remove paraméter van beállítva (tehát csökkentettem a darabszámot)
else if (isset($_GET["remove"])) {
  $productId = $_GET["remove"];

  //és a cart tömb benne van a munkamenetben a termék darabszámával
  if (isset($_SESSION["cart"][$productId])) {
    //ha a termék darabszáma nagyobb mint 1 
    if ($_SESSION["cart"][$productId] > 1) {
      //akkor vegyen el egyet belőle
      $_SESSION["cart"][$productId] = $_SESSION["cart"][$productId] - 1;
    } else {
      //ha pedig kisebb mint egy, akkor szüntesse meg és vegye ki a kosárból (megszűnik a session)
      unset($_SESSION["cart"][$productId]);
    }
  }

  header("Location: cart.php");
  ob_end_flush();
  exit();
}
//ha a delete paraméter van beállítva (tehát X-eltem a terméke)
else if (isset($_GET["delete"])) {
  $productId = $_GET["delete"];

  //akkor a productId alapján vegye ki az adott productId-val rendelkező terméket a munkamenetből
  if (isset($_SESSION["cart"][$productId])) {
    unset($_SESSION["cart"][$productId]);
  }

  header("Location: cart.php");
  die();
}

//ha a cart be van állítva az url-ben
if (isset($_SESSION["cart"])) {
  //akkor vegye ki ezt a tömböt egy változóba
  $cartIDs = $_SESSION["cart"];
} else {
  $cartIDs = [];
}

$cart = [];

//majd töltse fel az üres cart tömböt product és count paraméterekkel  
foreach ($cartIDs as $cartID => $count) {
  $cart[] = [
    "product" => Database::getProductById($cartID),
    "count" => $count,
  ];
}

//ez a végösszeg változója
$sum = 0;

//a felvett termékek bejárása
foreach ($cart as $cartItem) {

  $product = $cartItem["product"];
  $count = $cartItem["count"];

  //ha a termék akciós, tehát van discountja (nagyobb mint 0)
  if ($product->discount > 0) {
    //akkor végezze el az akciós ár kiszámítását
    $discPrice = 100 - $product->discount;
    $discPrice = $discPrice * 0.01;
    $discPrice = $discPrice * $product->price;
    $discPrice = round($discPrice);
    $discPrice = ceil($discPrice / 10) * 10;

    //ezt adja hozzá a végösszeghez
    $sum += $discPrice * $count;
  } else {
    //ha meg nem akciós, akkor csak a termék alapvető árát adja hozzá
    $sum += $product->price * $count;
  }
}


?>

<section id="cart-main-section" class="section whitebg">
  <div class="homepage-main maxw dfsb">
    <div class="homepage-main-hero section-text-button cart-left-container">
      <div class="homepage-main-title">
        <h4 class="title-firstline">Az én</h4>
        <h1 class="title-secondline-h1 greencolor">Kosaram</h1>
      </div>
      <p class="section-paragraph-gray">A legtöbb termék esetében a kiszállítási idő 1-3 napot vesz igénybe, amely szám a megtett távolságtól és a készleten lévő darabszámtól is függ. Minden termékre (beleértve a forgalmazóktól érkező pellet- és etetőanyagcsomagokat) 1 év garanciát vállalunk, amely akció igénybevételéhez a terméknek sértetlen, bontatlan csomagolásban kell visszaérkeznie központi raktárunkba - ez alól természetesen kivételt képeznek a lejárt, avagy rossz minőségű pellet- és etetőanyagcsomagok.</p>
    </div>
    <div class="cart-right-container">


      <?php if ($cart) : ?>
        <p style="color:#777;" class="section-paddinglow dffs">10 000 Ft feletti vásárlás esetén a szállítás ingyenes!<i class="bi bi-truck"></i></p>
        <div class="cart-subpage-item-fullcontainer dfcc">
          <div class="cart-subpage-item dfcc">

            <div class="cart-subpage-title-firstrow dfsb">
              <h4>Megnevezés</h4>
              <h4>Súly/db</h4>
              <h4>Ár/db</h4>
              <h4>Kilós ár</h4>
              <h4>Darabszám</h4>
            </div>
            <?php
            //cart tömb bejárása, majd a kapott elemek listázása
            foreach ($cart as $cartItem) {

              $product = $cartItem["product"];
              $count = $cartItem["count"];

              //ha akciós a termék, akkor azt az árat jelenítse meg
              if ($product->discount > 0) {
                $discPrice = 100 - $product->discount;
                $discPrice = $discPrice * 0.01;
                $discPrice = $discPrice * $product->price;
                $discPrice = round($discPrice);
                $discPrice = ceil($discPrice / 10) * 10;

                echo "
                  <div class='cart-subpage-item-titlebox dffs'>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p style='font-weight: bold;'>{$product->name}</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->weight} g</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$discPrice} Ft <span style='color:#65A850;'>(Akció!)</span></p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->unitPrice} (Ft/kg)</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                      <div class='dffc'>
                        <a class='dffc' href='cart.php?remove={$product->id}' type='button'><span class='dffc'><i class='bi bi-dash-circle'></i></span></a>
                        <input type='text' readonly
                        value='{$count}'>
                        <a class='dffc' href='cart.php?id={$product->id}' type='button'><span class='dffc'><i class='bi bi-plus-circle'></i></span></a>
                        <a class='dffc' href='cart.php?delete={$product->id}' class='btn btn-outline-secondary ms-2' type='button'><i class='bi bi-x'></i></a>
                      </div>
                    </div>
                  </div>

                  <div class='cart-list-on-mobile'>
                      <div class='dfsb cart-mobile-row'>
                          <div class='dffc cart-mobile-td'>
                            Megnevezés
                          </div>
                          <div class='dffc cart-mobile-td'>
                          {$product->name}
                          </div>
                      </div>

                      <div class='dfsb cart-mobile-row'>
                        <div class='dffc cart-mobile-td'>
                        Súly/db
                        </div>
                        <div class='dffc cart-mobile-td'>
                        {$product->weight}
                        </div>
                      </div>

                      <div class='dfsb cart-mobile-row'>
                        <div class='dffc cart-mobile-td'>
                        Ár/db
                        </div>
                        <div class='dffc cart-mobile-td'>
                        {$discPrice} Ft <span style='color:#65A850;'>(Akció!)</span>
                        </div>
                      </div>

                      <div class='dfsb cart-mobile-row'>
                        <div class='dffc cart-mobile-td'>
                        Kilós ár
                        </div>
                        <div class='dffc cart-mobile-td'>
                        {$product->unitPrice}
                        </div>
                      </div>

                      <div class='dfcc cart-mobile-row'>
                        <div class='dffc cart-mobile-td'>
                          Darabszám
                        </div>
                        <div class='dffc cart-mobile-td'>
                          <div class='dffc'>
                            <a class='dffc' href='cart.php?remove={$product->id}' type='button'><span class='dffc'><i class='bi bi-dash-circle'></i></span></a>
                            <input type='text' readonly
                            value='{$count}'>
                            <a class='dffc' href='cart.php?id={$product->id}' type='button'><span class='dffc'><i class='bi bi-plus-circle'></i></span></a>
                            <a class='dffc' href='cart.php?delete={$product->id}' class='btn btn-outline-secondary ms-2' type='button'><i class='bi bi-x'></i></a>
                          </div>
                        </div>
                      </div>
                  
                  </div>
              ";
              }
              //amúgy meg ha nincs akció, akkor az eredeti árat mutassa
              else {
                echo "
                  <div class='cart-subpage-item-titlebox dffs'>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p style='font-weight: bold;'>{$product->name}</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->weight} g</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->price} Ft</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                    <p>{$product->unitPrice} (Ft/kg)</p>
                    </div>
                    <div class='cart-subpage-item-titlebox-td dfcc'>
                      <div class='dffc'>
                        <a class='dffc' href='cart.php?remove={$product->id}' type='button'><span class='dffc'><i class='bi bi-dash-circle'></i></span></a>
                        <input type='text' readonly
                        value='{$count}'>
                        <a class='dffc' href='cart.php?id={$product->id}' type='button'><span class='dffc'><i class='bi bi-plus-circle'></i></span></a>
                        <a class='dffc' href='cart.php?delete={$product->id}' class='btn btn-outline-secondary ms-2' type='button'><i class='bi bi-x'></i></a>
                      </div>
                    </div>
                  </div>

                  <div class='cart-list-on-mobile'>
                  
                    <div class='dfsb cart-mobile-row'>
                        <div class='dffc cart-mobile-td'>
                          Megnevezés
                        </div>
                        <div class='dffc cart-mobile-td'>
                        {$product->name}
                        </div>
                    </div>

                    <div class='dfsb cart-mobile-row'>
                      <div class='dffc cart-mobile-td'>
                      Súly/db
                      </div>
                      <div class='dffc cart-mobile-td'>
                      {$product->weight}
                      </div>
                    </div>

                    <div class='dfsb cart-mobile-row'>
                      <div class='dffc cart-mobile-td'>
                      Ár/db
                      </div>
                      <div class='dffc cart-mobile-td'>
                      {$product->price} Ft
                      </div>
                    </div>

                    <div class='dfsb cart-mobile-row'>
                      <div class='dffc cart-mobile-td'>
                      Kilós ár
                      </div>
                      <div class='dffc cart-mobile-td'>
                      {$product->unitPrice}
                      </div>
                    </div>

                    <div class='dfcc cart-mobile-row'>
                      <div class='dffc cart-mobile-td'>
                        Darabszám
                      </div>
                      <div class='dffc cart-mobile-td'>
                        <div class='dffc'>
                          <a class='dffc' href='cart.php?remove={$product->id}' type='button'><span class='dffc'><i class='bi bi-dash-circle'></i></span></a>
                          <input type='text' readonly
                          value='{$count}'>
                          <a class='dffc' href='cart.php?id={$product->id}' type='button'><span class='dffc'><i class='bi bi-plus-circle'></i></span></a>
                          <a class='dffc' href='cart.php?delete={$product->id}' class='btn btn-outline-secondary ms-2' type='button'><i class='bi bi-x'></i></a>
                        </div>
                      </div>
                    </div>
              
                  </div>
              ";
              }
            }
            ?>
          </div>


          <div class="cart-subpage-checkout dfsb">

            <div class="cart-subpage-checkout-td dfcc">
              <h4>Szállítási költség</h4>
              <!-- ha a végösszeg nagyobb mint 10000, akkor ingyenes a szállítás -->
              <?php if ($sum > 10000) {

                echo "<p style='color:#65A850;'>Ingyenes!</p>";
              }
              //ha a végösszeg kisebb mint 10000, akkor van kiszállítási díj
              else if ($sum < 10000) {
                $sum = $sum + $DELIVERY_PRICE;

                echo "<p>$DELIVERY_PRICE Ft</p>";
              }
              //ha a végösszeg egyenlő 10000-el, akkor is ingyenes a szállítás
              else if ($sum = 10000) {
                echo "<p style='color:#65A850;'>Ingyenes!</p>";
              }
              ?>

            </div>
            <div class="cart-subpage-checkout-td dfcc">
              <h4>Végösszeg</h4>
              <p>
                <?php
                //végösszeg kerekítése
                $sum = ceil($sum / 10) * 10;
                //ezt a végösszeget rendelje hozzá egy totalprice tömbhöz (ami el van mentve a munkamenetben)
                $_SESSION['totalprice'] = round($sum);
                ?>
                <?= $_SESSION['totalprice'] ?> Ft</p>
            </div>
            <div class="cart-subpage-checkout-td">
              <?php if (empty($cart)) : ?>
                <a class="button-green" disabled>RENDELÉS</a>
              <?php else : ?>
                <a class="button-green" href="checkout.php">RENDELÉS<i class="bi bi-bag-heart"></i></a>
              <?php endif ?>
            </div>
          </div>
        </div>

      <?php else : ?>
        <div class="cart-noitem dfsb">
          <h4>Nincs termék a kosaradban! Irány vásárolni!</h4>
          <a href="shop.php" class="button-green">termékek<i class="bi bi-bag-heart"></i></a>
        </div>
      <?php endif ?>

    </div>
  </div>

  </div>
  </div>
  </div>
</section>
<?php require_once("components/footer.php") ?>
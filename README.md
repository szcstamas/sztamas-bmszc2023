# Dokumentáció - Fontos információk a webalkalmazással kapcsolatban
* **Kliens oldali nyelvek:** HTML5, CSS (SCSS), JavaScript
* **Szerver oldali nyelv:** PHP
* **Adatbázis:** MySQL
* **Kódszerkesztő:** Visual Studio Code
* **Localhost:** Apache (XAMPP)
* **Kérelmek ellenőrzése:** Postman
* **Tervező szoftver:** Figma
------
**Fontos!** A projekt megtekintése előtt (megelőzve az adatbázis létrehozását) le kell ellenőrizni, hogy a forrásmappa neve teljesen pontosan **sztamas-bmszc2023**. Ez azért fontos, mert az *api* mappán belül található, az alkotott REST API működéséért felelős kérelmek a *http://localhost/sztamas-bmsz2023* linken keresztül érhetőek el. Ha a mappa más néven töltődik le (valamilyen véletlen oknál fogva), akkor *sztamas-bmsz2023* néven szükséges átnevezni.

Az adatbázis elkészítéséhez szükséges fájlok (beleértve a dump.sql-t is) az *sql* elnevezésű mappában találhatóak meg. Az *init* mappában mindössze backup sql-fájlok láthatóak, ezekre az adatbázis elkészítéséhez nincsen szükség. A *demo* elnevezésű mappában néma videók szerepelnek, ezek a videófájlok hivatottak reprezentálni az oldal működését. Most pedig lássuk az alkalmazást...

# BroBaits© - Minőségi pelletek és etetőanyagok

 A webalkalmazás a BroBaits elnevezésű, horgászatra használt pelleteket és etetőanyagokat gyártó illetve forgalmazó, *fiktív* cég webáruházát és bemutatkozó oldalát mutatja be. Az alkalmazás fő célja megegyezik a mai, egyszerűbb webshopok felépítésével, működésével és céljaival: a látogató képes megvásárolni a webáruházból kiválasztott terméket egy kosár-, majd fizetési rendszer segítségével. A weboldalt regisztrált felhasználóként is van lehetőség látogatni, ebben az esetben a felhasználó nyomon követheti az éppen teljesítésre váró vagy már teljesített rendeléseit is. Az áruházban bemutatott termékeket és leadott rendeléseket az arra jogosult személyek szerkeszthetik, jóváhagyhatják és törölhetik is az adatbázisból egy kliens-oldali "adminpanel" segítségével. A site céges bemutatkozó oldalként is funkcionál, a *Főoldalon*, a *Partnereink* és a *Rólunk* aloldalon megannyi információ látható a cég felépítésével kapcsolatban.  

## Fejléc (header)

A weboldal fejlécében (components/header.php) a logó mellett az öt főbb aloldal linkje, illetve ezek mellett a vásárlói kosár (bevásárlókocsi-ikon), a felhasználói profil (ember-ikon) és a keresés látható. Az éppen aktuális oldal linkje alatt látható egy "pulzáló" gömböcske, ami a jelenleg látható oldalt hivatott indikálni. A profil aloldalt tartalmazó "ember-ikon" zöld hátteret kapva pulzál, ha egy felhasználó éppen be van jelentkezve. A kereső-gombra kattintva egy input mező ugrik elő a header alatti részen, amibe ha beírjuk az éppen aktuális kereső-kifejezést, majd entert nyomunk vagy a MEHET gombra kattintunk, akkor a Webshop aloldalra jutunk, látva a keresés eredményét.

## Főoldal

A főoldalon (index.php) a header-footer és feliratkozás-sáv elemeken kívül **öt** nagy szekciót láthatunk:
1. a **Hero** szekciót, ami egyfajta "bemutatkozó-konténerként" van jelen,
2. a **Top-termékeink** szekciót, aminél lehetőség van átjutni egy termék aloldalára annak nevére vagy a neve alatt látható, jobbra mutató nyílra kattintva (az *Összes termék* gombra kattintva a *Webshop* aloldalra navigálunk),
3. a **Viszonteladás és partnereink** szekciót, aminél a webáruház hűséges partnerei és forgalmazói láthatóak (az *Partnereink* gombra kattintva a *Partnereink* aloldalra navigálunk),
4. a **Kedvenc fogásaink** szekciót, aminél a webáruház tulajdonosai és alkalmazottai által legjobban kedvelt fogásokból láthatunk egy válogatást (a képekre kattintva különálló Instagram posztokra navigálna az oldal, de ezek a linkek jelenleg csak az Instagram főoldalára visznek),
5. végül pedig a **Haltudakozó** szekciót, ahol érdekes információkat és tényeket tudhat meg a felhasználó, ha az éppen bemutatott halra viszi az egerét. A galériát (avagy carouselt) a balra- és jobbra nyilakkal lehet léptetni, illetve rá lehet kattintani egy teljesen véletlenszerű körre is. Az EN gombot megnyomva a carousel átvált angol nyelvre.

Az ezután következő hírlevél-sáv szinte minden oldalon megtalálható, lényege hogy ha a felhasználó beírja az email-címét és rákattint a **Feliratkozás** gombra, akkor feliratkozik a cég hírleveleire és egyéb marketing-tartalmaira.

## Webshop

A **Webshop** aloldalon (shop.php) láthatóak az adatbázisban tárolt termékek (jobb felső sarokban a kiszerelés súlya, a kép alatt a termék neve, ára, kilós ára, illetve a termék aloldalára eljuttató gomb látható). A termék alatt látható Kosárba gombra kattintva a termék automatikusan bekerül a kosárba (ezzel a felhasználó átkerül a kosár aloldalára is). A webáruház aloldalán keresési funkciók is teljesülnek: keresés név szerint, rendezés legolcsóbb, legdrágább vagy akciós termék szerint, szűrés akciós vagy raktáron lévő termékek között, illetve van lehetőség egy ár-intervallum megszabására is (minimum és maximum ár). Az oldal egyszerre nyolc terméket jelenít meg, a többi termék a lista alján látható gombok segítségével tekinthető meg: egy adott számra kattintva az adott oldalára jutunk a terméklistának, a bal és jobbra nyilakkal pedig eggyel hátra vagy pedig előre tudunk menni.

## Partnereink

A **Partnereink** aloldalon (partners.php) a BroBaits céggel kooperációban működő forgalmazókról és viszonteladókról tudhat meg információkat a látogató, illetve a partnerek lista alatt van lehetőség üzenetküldésre is (a *Viszonteladás* résznél a CTA használatával átjutunk a Kapcsolat aloldalra).
 
## Kapcsolat

A **Kapcsolat** aloldalon (contact.php) lehetőség van üzenetküldésre, illetve ezen az oldalon láthatóak a cég elérhetőségei, illetve a közösségi médiában megtalálható felületei (a contact form még építés alatt van 😐). 

## Rólunk

A **Rólunk** aloldalon (about.php) a felhasználó a BroBaits céggel kapcsolatos információkat tekintheti meg. A hero-szekció és a garanciát ismertető rész után látható egy Kérdések-válaszok konténer, amiben a cégtulajdonosok a gyakran feltett kérdésekre válaszolnak. A **+** jelre kattintva gördülnek le a menük. Jobb oldalon a vállalkozást felépítő, magas beosztásban dolgozó, "fő-emberek" láthatóak.

## Kosár és vásárlás

A **Kosár** aloldal (cart.php) alapértelmezetten üres. Ha egy adott termék, vagy a webshop aloldalán látható **KOSÁRBA** gombra kattintunk, a beállított mennyiségű termék fog beérkezni a kosárba (ennek a darabszámnak az állítására csak a termék aloldalán van lehetőség, a webshop aloldalból közvetlenül a gombra kattintva MINDIG egy darab áru fog beérkezni). A rendelt termék darabszámának állítására természetesen utólag itt, a *Kosár* aloldalon is van lehetőség, ehhez csak a mínusz illetve plusz gombokra kell rányomni. Fontos: 10.000 Forint vásárlás alatt a kiszállítás ingyenes, a jelzett összeg alatti vásárlás esetén +1650 Forint szállítási díj fog hozzáadódni a rendeléshez. A termék kosárból való törlésére is van lehetőség, ehhez az **X** gombot kell megnyomni. 

## Rendelés leadása

A **Rendelés** aloldal (checkout.php) csak egy esetben jeleníthető meg: ha a felhasználónak van éppen aktív kosara. Ehhez az kell, hogy valamilyen termék szerepeljen a Kosár aloldalon (cart.php). Ha a kosár üres, úgy a checkout aloldal sem érhető el. A Rendelés aloldalon egy űrlapot (form) láthatunk, amibe bele kell írni a szükséges információkat (csillaggal jelölt), majd ha ez megvan, el kell fogadnunk a felhasználási feltételeket az űrlap alján látható gomb "bekapcsolásával". Az űrlap alatt a fizetett összeg és a rendelés befejezését jelölő gomb látható. Ha a *Rendelés véglesítésére* kattintunk (és minden mező ki van töltve), akkor egy **Köszönjük rendelésedet** aloldalra jutunk át, ekkor a rendelésünk rögzítődik az adatbázis orders táblájában. Ha a felhasználó nem fűzött a megrendeléshez megjegyzést, akkor az adatbázisban a *comment* oszlopban a "No comment" feliratot fogjuk látni, illetve ha a felhasználó nem volt bejelentkezve a rendelés pillanatában, akkor az *isUser* oszlopban 0 értéket, a *username* oszlopban pedig a "no-user" értéket látjuk.

## Felhasználói profil/bejelentkezés és regisztráció



## Keresés

Az oldalon történő keresés minden esetben a *Webshop* aloldalra elkalauzolt, a keresőkifejezés általi keresést jelenti. A felhasználónak erre jelenleg két lehetősége van: vagy a már említett *Webshop* aloldalon teszi ezt meg a terméklista mellett látható keresési mező segítségével, vagy pedig a mindegyik aloldalról elérhető, headerben szereplő, keresési funkciót veszi igénybe. A keresés minden esetben a shop.php aloldalra vezeti a használót.

## Admin felület

## Footer

A weboldal lábléce (footer.php) a fejléchez hasonlóan a BroBaits cég logóját, a Sütik, az Adatvédelmi tájékoztató és Impresszum aloldalak, illetve a közösségi médiára vezető linkeket tartalmazza. 

## REST API és Database

## JavaScript fájlok

A szükséges, minimális mennyiségű JavaScript fájlok a *js* mappában tekinthetőek meg. Itt található meg a forráskódja

* a főoldalon használt haltudakozónak (amit még régebben raktam össze gyakorló-feladatként),
* a partnerek aloldalán használt JSON fájlnak,
* a checkout aloldal által használt "checkoutvalidity.js" fájlnak (ez tiltja a felhasználónak az nem helyes billentyűk beütését, pl. speciális karakterek, név esetén számok beütését, stb stb),
* a checkout űrlapban használt "copyaddress.js" fájlnak, amely a számlázási cím átmásolását teszi lehetővé a checkbox megnyomásával,
* illetve a "currentpageclass.js" fájl is itt található meg, ami az éppen aktuális aloldal linkjére teszi rá az active-page classt (ettől jelenik meg a pulzáló, zöld gömb)
------
*fontosabb kódrészletek és kommentárok a fájlokban olvashatóak*
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

A weboldal fejlécében (components/header.php) a logó mellett az öt főbb aloldal linkje, illetve ezek mellett a vásárlói kosár (bevásárlókocsi-ikon), a felhasználói profil (ember-ikon) és a keresés látható. Az éppen aktuális oldal linkje alatt látható egy "pulzáló" gömböcske, ami a jelenleg látható oldalt hivatott indikálni. A profil aloldalt tartalmazó "ember-ikon" zöld hátteret kapva pulzál, ha egy felhasználó éppen be van jelentkezve. A kereső-gombra kattintva egy input mező ugrik elő a header alatti részen, amibe ha beírjuk az éppen aktuális kereső-kifejezést, majd entert nyomunk vagy a MEHET gombra kattintunk, akkor a Webshop aloldalra jutunk, látva a keresés eredményét. A fejlécben 450 vagy annál kevesebb pixelnyi szélességű eszköz esetében egy "hamburger-menü" jelenik meg, amire kattintva lenyílik az asztali verzióban látható menüsáv (másmilyen elrendezésben). 

## Főoldal

A főoldalon (index.php) a header-footer és feliratkozás-sáv elemeken kívül **öt** nagy szekciót láthatunk:
1. a **Hero** szekciót, ami egyfajta "bemutatkozó-konténerként" van jelen,
2. a **Top-termékeink** szekciót, aminél lehetőség van átjutni egy termék aloldalára annak nevére vagy a neve alatt látható, jobbra mutató nyílra kattintva (az *Összes termék* gombra kattintva a *Webshop* aloldalra navigálunk),
3. a **Viszonteladás és partnereink** szekciót, aminél a webáruház hűséges partnerei és forgalmazói láthatóak (az *Partnereink* gombra kattintva a *Partnereink* aloldalra navigálunk),
4. a **Kedvenc fogásaink** szekciót, aminél a webáruház tulajdonosai és alkalmazottai által legjobban kedvelt fogásokból láthatunk egy válogatást (a képekre kattintva különálló Instagram posztokra navigálna az oldal, de ezek a linkek jelenleg csak az Instagram főoldalára visznek),
5. végül pedig a **Haltudakozó** szekciót, ahol érdekes információkat és tényeket tudhat meg a felhasználó, ha az éppen bemutatott halra viszi az egerét. A galériát (avagy carouselt) a balra- és jobbra nyilakkal lehet léptetni, illetve rá lehet kattintani egy teljesen véletlenszerű körre is. Az EN gombot megnyomva a carousel átvált angol nyelvre.

Az ezután következő hírlevél-sáv szinte minden oldalon megtalálható, lényege hogy ha a felhasználó beírja az email-címét és rákattint a **Feliratkozás** gombra, akkor feliratkozik a cég hírleveleire és egyéb marketing-tartalmaira, majd az oldal átirányítja egy megköszönő-aloldalra (success.php egyik else if ága). Itt megjelenik a felhasználó számára, hogy pontosan milyen e-mail címmel is iratkozott fel.

## Webshop

A **Webshop** aloldalon (shop.php) láthatóak az adatbázisban tárolt termékek (a termék boxában a jobb felső sarokban a kiszerelés súlya, a kép alatt a termék neve, ára, kilós ára, illetve a termék aloldalára eljuttató gomb látható). A termék alatt látható *Kosárba* gombra kattintva a termék automatikusan bekerül a kosárba (ezzel a felhasználó átkerül a kosár aloldalára is). A webáruház aloldalán keresési funkciók is teljesülnek: keresés név szerint, rendezés legolcsóbb, legdrágább vagy akciós termék szerint, szűrés akciós vagy raktáron lévő termékek között, illetve van lehetőség egy ár-intervallum megszabására is (minimum és maximum ár). Az oldal egyszerre nyolc terméket jelenít meg, a többi termék a lista alján látható gombok segítségével tekinthető meg: egy adott számra kattintva az adott oldalára jutunk a terméklistának, a bal és jobbra nyilakkal pedig eggyel hátra vagy pedig eggyel előre tudunk menni (pagination).

## Partnereink

A **Partnereink** aloldalon (partners.php) a BroBaits céggel kooperációban működő forgalmazókról és viszonteladókról tudhat meg információkat a látogató, illetve a partnerek lista alatt van lehetőség üzenetküldésre is (a *Viszonteladás* résznél a CTA használatával átjutunk a Kapcsolat aloldalra).
 
## Kapcsolat

A **Kapcsolat** aloldalon (contact.php) lehetőség van üzenetküldésre, illetve ezen az oldalon láthatóak a cég elérhetőségei, illetve a közösségi médiában megtalálható felületei (a contact form még építés alatt van, egyelőre azt vizsgálja az aloldal hogy a form nem üres mezőket kap-e - ha igen, akkor hibaüzenetet dob a usernek, ha pedig sikerült kitölteni az űrlapot, akkor egy megköszönő-aloldalra (success.php egyik else if ága) jut el a felhasználó). 

## Rólunk

A **Rólunk** aloldalon (about.php) a felhasználó a BroBaits céggel kapcsolatos információkat tekintheti meg. A hero-szekció és a garanciát ismertető rész után látható egy Kérdések-válaszok konténer, amiben a cégtulajdonosok a gyakran feltett kérdésekre válaszolnak. A **+** jelre kattintva gördülnek le a menük. Jobb oldalon a vállalkozást felépítő, magas beosztásban dolgozó, "fő-emberek" láthatóak.

## Termék aloldala

Egy termék aloldalára legkönnyebben a *Webshopon* keresztül juthatunk el a termék nevére, vagy a termék neve alatt látható nyílra történő kattintással. A termék aloldalán az első szekcióban a jobbra rendezett kép mellett a termék neve, leírása, illetve lejjebb görgetve az ára, kilós ára, a kosárba rakható darabszám, a termék készlete, kiszállítási idő, és a termékről szóló fontosabb információk láthatóak. A termék alatt látható szekcióban további termék-ajánlásokat lehet észrevenni. Ha az url-ben az id paraméter mögött látható számot kicseréljük egy nem létező termék id-jára, akkor egy "Nincs ilyen termék" aloldalt kapunk.

## Kosár és vásárlás

A **Kosár** aloldal (cart.php) alapértelmezetten üres. Ha egy adott termék, vagy a webshop aloldalán látható **KOSÁRBA** gombra kattintunk, a beállított mennyiségű termék fog beérkezni a kosárba (ennek a darabszámnak az állítására csak a termék aloldalán van lehetőség, a webshop aloldalból közvetlenül a gombra kattintva MINDIG egy darab áru fog beérkezni). A rendelt termék darabszámának állítására természetesen utólag itt, a *Kosár* aloldalon is van lehetőség, ehhez csak a mínusz illetve plusz gombokra kell rányomni. Fontos: 10.000 Forint vásárlás alatt a kiszállítás ingyenes, a jelzett összeg alatti vásárlás esetén +1650 Forint szállítási díj fog hozzáadódni a rendeléshez. A termék kosárból való törlésére is van lehetőség, ehhez az **X** gombot kell megnyomni. 

## Rendelés leadása

A **Rendelés** aloldal (checkout.php) csak egy esetben jeleníthető meg: ha a felhasználónak van éppen aktív kosara. Ehhez az kell, hogy valamilyen termék szerepeljen a Kosár aloldalon (cart.php). Ha a kosár üres, úgy a checkout aloldal sem érhető el. A Rendelés aloldalon egy űrlapot (form) láthatunk, amibe bele kell írni a szükséges információkat (csillaggal jelölt), majd ha ez megvan, el kell fogadnunk a felhasználási feltételeket az űrlap alján látható gomb "bekapcsolásával". Az űrlap alatt a fizetett összeg és a rendelés befejezését jelölő gomb látható. Ha a *Rendelés véglesítésére* kattintunk (és minden mező ki van töltve), akkor egy **Köszönjük rendelésedet** aloldalra jutunk át, ekkor a rendelésünk rögzítődik az adatbázis orders táblájában. Ha a felhasználó nem fűzött a megrendeléshez megjegyzést, akkor az adatbázisban a *comment* oszlopban a "No comment" feliratot fogjuk látni, illetve ha a felhasználó nem volt bejelentkezve a rendelés pillanatában, akkor az *isUser* oszlopban 0 értéket, a *username* oszlopban pedig a "no-user" értéket látjuk.

## Felhasználói profil / bejelentkezés és regisztráció

A fejlécben látható "ember-ikonra" kattintva a profil aloldalra jutunk, ahol alapértelmezetten egy bejelentkezési felületet lát a felhasználó. A szükséges adatok beíraása után (ügyelve a felhasználónévre illetve az érvényes e-mail címre) két lehetőségünk van: vagy regisztrálunk, vagy ha már van felhasználói fiókunk, akkor bejelentkezünk. Ha már meglévő felhasználónévvel próbálunk profilt létrehozni, akkor egy hibaüzenetet kapunk, ami alapján a beírt felhasználónév már foglalt (természetesen hibaüzenetet kapunk hibás jelszó beírásakor, nem megfelelő karaktereket tartalmazó felhasználónév beírásakor, nem valid e-mail cím használatakor, stb stb). Ha sikerült bejelentkeznünk, akkor a felhasználói profilunk aloldala fog megjelenni előttünk, ahol láthatjuk a már leadott rendeléseinket - ha vannak. Rendelés leadásához ugyanazt kell tenni, mint amikor bejelentkezés nélkül rendeltünk: kosárba rakunk egy terméket, kiválasztjuk a darabszámot, majd a checkout aloldal segítségével véglesítjük a rendelést. Mivel ezúttal be voltunk jelentkezve, ezért az adatbázisban az *isUser* oszlopban 1 értéket, a *username* oszlopban pedig a felhasználónevünket látjuk majd viszont a legújabb rendelés sorában.

## Keresés

Az oldalon történő keresés minden esetben a *Webshop* aloldalra elkalauzolt, a keresőkifejezés általi keresést jelenti. A felhasználónak erre jelenleg két lehetősége van: vagy a már említett *Webshop* aloldalon teszi ezt meg a terméklista mellett látható keresési mező segítségével, vagy pedig a mindegyik aloldalról elérhető, headerben szereplő, keresési funkciót veszi igénybe. A keresés minden esetben a shop.php aloldalra vezeti a használót.

## Admin felület

Az adminfelület a *sztamas-bmszc2023/admin.php* navigálva érhető el (ez az aloldal érthető okokból nem szerepel sehol sem a weboldalon). Az oldal elérésehez be kell jelentkeznünk az adminlogin.php aloldal segítségével: meg kell adnunk a secrets.php-ban szereplő admin adatokat (felhasználónév és jelszó). Ha ez sikerült, akkor egy zöld színű szöveg jelzi a sikeres belépést, illetve rákattinthatunk a *Tovább* gombra, ami visszavisz az admin.php aloldalra, ám ekkor már megjelenik az elérni kívánt admin-konzol is. Fontos: a belépés után a munkamenet eltárolja az admin értékeit, ezzel együtt a kapott tokent is, amelyet a tokenre váró API-requestek hívásához használunk majd. Ilyen hívás például az is, ami az admin felületen kilistázza az adatbázis orders táblában látható összes rendelést, illetve a rendelések alatt a weboldalon elérhető összes terméket is. **Röviden:** minden admin felületen használt HTTP kérelemmel működő adatbázis-interakció (legyen az POST vagy PUT) authentikációt kér, amihez az admin felhasználóból származó tokenre van szükség. Ezen az oldalon lehetőségünk van
1. bármely rendelés teljesítésére vagy törlésére (pipa illetve kuka-ikon), ekkor ha az adott rendelés egy felhasználóhoz van rendelve, akkor az a rendelés a felhasználó profiljában is teljesítettként jelenik meg, illetve nem lesz benne, ha véglegesen törlésre került,
2. meglévő termék szerkesztésére (a termék ID-jának és a feltöltés dátumának kivételével) - apróság: ha új képet szeretnénk feltölteni a terméknek, és kipipáljuk az "Azonos elnevezésű képek törlése" checkboxot, akkor minden olyan kép törlődik az img/products mappából, aminek az elnevezésében megtalálható a termék neve,
3. meglévő termék "pótlására" és "törlésére" (előbbire akkor van lehetőség ha a termék elfogyott, tehát a quantity 0; utóbbi esetében pedig a termék nem törlődik teljesen az adatbázisból, csak a deletedAt oszlop értéke kapja meg az éppen aktuális dátumot -> innentől fogva a termék inaktív, és nem jelenik meg a webshopban),
4. új termék hozzáadására (a termék hozzáadása gombra kattintva), először ki kell választani a termék kategóriáját, majd a szükséges adatokat ki kell tölteni az űrlap beküldése előtt (az ID és a feltöltés dátumát a termék automatikusan kapja az adatbázisból)

## Footer

A weboldal lábléce (footer.php) a fejléchez hasonlóan a BroBaits cég logóját, a Sütik, az Adatvédelmi tájékoztató és Impresszum aloldalak, illetve a közösségi médiára vezető linkeket tartalmazza. 

## REST API és Database

Az *api* mappában öt fájl látható: **auth.php** (a kérelmek authentikációjáért felel), **orders.php** (az orders tábla kérelmeit dolgozza fel), products.php (a products tábla kérelmeit dolgozza fel), **users.php** (a users tábla kérelmeit dolgozza fel -> kezdetleges) és **rest.php**, ami az alapvető kérelmeket teszi lehetővé a kérelem elnevezésétől függően (?orders, ?products), majd JSON formátumba enkódolja azokat. Részletesebb dokumentáció a jelzett fájlokban olvasható. A *db* mappában három fájl látható: database.php, database-recover.php és secrets.php. A *database.php* fájl tartalmazza a *Database* osztályt, amelynek a gyermek-függvényei az adatbáziskapcsolatot létrehozó, API-requesteket kezelő funkciók. A *database-recover.php* egy vanilla sql hívásokat kezelő fájl (csak backup), a *secrets.php* pedig a kényes adatokat tartalmazza (adatbázis authentikáció és admin adatok, ezt jobb esetben nem szokás feltölteni semmilyen repositoryba).

## JavaScript fájlok

A szükséges, minimális mennyiségű JavaScript fájlok a *js* mappában tekinthetőek meg. Itt található meg a forráskódja

* a főoldalon használt haltudakozónak (amit még régebben raktam össze gyakorló-feladatként),
* a partnerek aloldalán használt JSON fájlnak,
* a checkout aloldal által használt "checkoutvalidity.js" fájlnak (ez tiltja a felhasználónak a nem helyes billentyűk beütését, pl. speciális karakterek, név esetén számok beütését, stb stb),
* a checkout űrlapban használt "copyaddress.js" fájlnak, amely a számlázási cím átmásolását teszi lehetővé a checkbox megnyomásával,
* illetve a "currentpageclass.js" fájl is itt található meg, ami az éppen aktuális aloldal linkjére teszi rá az active-page classt (ettől jelenik meg a pulzáló, zöld gömb)
------

## Egyéb információk:

* **components mappa:** a header, footer és newsletter-sávot tartalmazó mapppa
* **img mappa:** az oldalon használt képeket tartalmazza
* **model:** az Order és a Product osztályokat tartalmazó mappa
* **styles:** az oldalon használt css elemeket tárolja (scss és annak al-fájlai segítségével)
* **waitingforresp:** egy emlékeztető magamnak, ezt a mappát nem szükséges megtekinteni

------
*fontosabb kódrészletek és kommentárok a fájlokban olvashatóak*
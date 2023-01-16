-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sztamas
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `sztamas`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sztamas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sztamas`;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `deliveryPostcode` int(11) NOT NULL,
  `deliveryCity` varchar(255) NOT NULL,
  `deliveryStreet` varchar(255) NOT NULL,
  `billPostcode` int(11) NOT NULL,
  `billCity` varchar(255) NOT NULL,
  `billStreet` varchar(255) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `completedAt` date NOT NULL,
  `isUser` tinyint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (27,'PVA Bag',2,'Tamás Szűcs','2023-01-11 20:59:23','drdeakimre@growingmedia.io',4000,2120,'Asad','12313asdd asd',2120,'Asad','12313asdd asd','No comment',1,'2023-01-12',0,'tomi1234'),(30,'Benzár Mix - Capsuni',5,'Tamás Szűcs','2023-01-12 20:07:01','mesterszakacs@mesterszakacs.hu',12500,20202,'asdad','20202asdd',20202,'asdad','20202asdd','asdad',0,'0000-00-00',0,'no-user'),(31,'Sushi Mix',1,'Tamás Szűcs','2023-01-12 20:07:01','mesterszakacs@mesterszakacs.hu',4160,20202,'asdad','20202asdd',20202,'asdad','20202asdd','asdad',0,'0000-00-00',0,'no-user'),(32,'Sushi Mix',2,'Tamas Nincsuser','2023-01-13 07:21:25','nincsuser@nincs.hu',8320,2020,'asdsad','asdsad 1030 sadsad',2020,'asdsad','asdsad 1030 sadsad','No comment',0,'0000-00-00',0,'no-user'),(33,'PVA Bag',1,'Tamas Nincsuser','2023-01-13 07:21:25','nincsuser@nincs.hu',2000,2020,'asdsad','asdsad 1030 sadsad',2020,'asdsad','asdsad 1030 sadsad','No comment',0,'0000-00-00',0,'no-user'),(34,'Sushi Mix',2,'Halika Halika','2023-01-13 07:22:52','halika@halika.hu',8320,2020,'asdsad','2072 asdas',2020,'asdsad','2072 asdas','No comment',0,'0000-00-00',0,'halika'),(35,'PVA Bag',2,'Halika Halika Új rendelés','2023-01-13 07:26:29','halika@halika.hu',4000,2020,'asdsad','20 asd 3030',2020,'asdsad','20 asd 3030','halika commentje',0,'0000-00-00',1,'halika'),(36,'Benzár Mix - Capsuni',2,'No user','2023-01-13 07:28:05','kiss.marton@growingmedia.io',5000,2020,'asdadad','asdad 30',2020,'asdadad','asdad 30','asdad',0,'0000-00-00',0,'no-user'),(37,'PVA Bag',2,'Tamás Szűcs','2023-01-13 07:29:09','kiss.marton@growingmedia.io',4000,2020,'asdad','020 asda',2020,'asdad','020 asda','asdsadsadaddadsa',0,'0000-00-00',1,'tomi1234'),(38,'HALDORÁDÓ 4S Method Pellet Groundbait',2,'hali új','2023-01-13 16:54:25','halika@halika.hu',2985,20202,'asdsad asd','asd a123',20202,'asdsad asd','asd a123','hali hlai halimiahely',0,'0000-00-00',1,'halika'),(42,'asdad',5,'Rendelo Jozsi','2023-01-15 14:17:03','asd@asd.hu',2022020,2020,'asdasd','asdasd',0,'asdasd','asdasd','kommentes order',0,'0000-00-00',1,'tamas23'),(43,'Benzár Mix - Capsuni',4,'api próba','2023-01-15 14:19:14','api@api.hu',10000,2020,'asdad 20','0202 asd012',2020,'asdad 20','0202 asd012','api api',0,'0000-00-00',0,'no-user'),(46,'Sushi Mix',3,'Tamás Szűcs','2023-01-16 07:35:54','halika@halika.hu',12480,2020,'20 asdsad','2002 asdsad',2020,'20 asdsad','2002 asdsad','asdadsad',0,'0000-00-00',0,'no-user'),(47,'PVA Bag',1,'asd','2023-01-16 07:36:57','asdadad@tapiobivalyhonalja.com',2000,2020,'asdsad 20','asdad20',2020,'asdsad 20','asdad20','asdsasd',0,'0000-00-00',0,'no-user'),(48,'Speciál Mix - Vajsavas',1,'Tamás Szűcs','2023-01-16 07:37:55','kiss.marton@growingmedia.io',1800,2020,'sadad 20','asdasd 20',2020,'sadad 20','asdasd 20','asdsad',0,'0000-00-00',0,'no-user');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `onStock` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `unitPrice` int(11) NOT NULL,
  `unitSize` varchar(20) NOT NULL,
  `flavour` varchar(50) NOT NULL,
  `colour` varchar(50) NOT NULL,
  `components` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `preFishes` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deletedAt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Sushi Mix','                  A Sushi Mix széria a nagymennyiségű szoktató és helyben tartó etetésekhez kínál gazdaságos megoldást. Sikerült olyan jó minőségű etető pelleteket egy családba rendezni, amelynek révén nem kell kompromisszumot kötni, és mégsem kerül majd egy hosszabb túra egy vagyonba. Nehéz az itt látható pelletek kiváló aromáját, ízét a fotókon keresztül átadni, de biztosra vesszük, hogy azok, akik kézbe veszik, majd kipróbálják, megdöbbenve tapasztják, hogy mennyire fogósak, illetve mennyire kedvező az áruk!\r\n\r\n<b>Sushi Mix - Crab</b>\r\nA Sushi Mix család számos kiváló megoldást kínál, akár alapozó etetés kialakítására, kiegészítésére, akár kosaras keverékek beltartalmának dúsítására. A pellet szemek átmérője 2-6 mm, textúrájuk tömör és kemény, a vízben viszont szép lassan felpuhulnak, s közben mindvégig áramoltatják magukból csábító aromájukat. 0,8 és 2,5 kg-os gazdaságos kiszerelésekben kerül forgalomba, melyekkel a rövidebb és akár hosszabb horgásztúrák etetését is hatékonyan megoldhatjuk.','sushi_mix_01_13_23_09_36_55.jpg',5200,25,1,800,4500,'6-8','fokhagymás krill','fehér és rózsaszín','zsemlemorzsa, fokhagyma, rákliszt, tartósítószer, adalékanyagok','pellet','ponty (0-12 kg), tokhal, busa',20,'2023-01-15 14:50:16','0000-00-00'),(2,'PVA Bag','Ki ne hallott volna a koncentrált, horogcsali köré összpontosuló etetési technika sikeréről? A szerelékre akasztott, PVA hálóba csomagolt finomságokkal felkelthetjük az etetésre érkező halak figyelmét, ezzel is hozzájárulva ahhoz, hogy felvegyék a hajszálelőkén felkínált horogcsalinkat. A 2-3 mm-es pelletekből álló keverékek mindegyike magas fehérjetartalommal bír. Az Fishmeal fantázianevű Pellet Mix ízesítés nélkül, ugyanakkor magas halolajtartalma miatt lehet vonzó a halak számára a nyári hónapokban. Az M1-es ízesítésű termék az SBS népszerű aromájának és a Robin Red tartalmának köszönhetően az év bármely napján lehet elutasíthatatlan csemege a halak számára. A Scopex és Strawberry, édes ízvilágú termékek elsősorban a hideg vízben időszakokban áttörést a kapástalan időszakokban.\r\n\r\n<b>SBS - PVA Bag</b>\r\nA pelletkeverék természetesen szárazon is betölthető a PVA hálóba, de ha azt szeretnénk hogy kissé felpuhuljanak a pelletszemek, akkor 100 grammonként 5 ml folyadék hozzáadását javasoljuk!','sbs-pva-bag.png',2000,50,1,1000,2000,'10-12','hal és Robin Red','vörös','zsemlemorzsa, fokhagyma, robin red, tartósítószer, halolaj, hal, adalékanyagok','pellet','ponty (0-12 kg), tokhal, busa',0,'2023-01-15 12:52:24','0000-00-00'),(4,'Benzár Mix - Capsuni','Egyre nagyobb népszerűségnek örvendenek hazánkban a mikro pelletek. Az etetőanyagunkhoz keverve a vízben később bomlik szét, mint az etető többi alkotóeleme, ezáltal a később érkező testesebb halaknak is szolgáltat táplálékot. Keverjük az etetőnkhöz max. 30%-os arányban és a fogás nem maradhat el. Többféle színben és ízben kerül forgalomba, így bármilyen körülmények között megtalálhatjuk a számunkra és főként a halak számára megfelelőt.','benzár_mix_-_capsuni_01_15_23_02_30_51.jpg',2500,50,1,500,5000,'2-6','rák','vörös','halliszt, zsemlemorzsa, rákliszt, víz, olaj, só, garnéla','pellet','ponty, amur, keszeg és kárász',0,'2023-01-15 13:30:51','0000-00-00'),(5,'Speciál Mix - Vajsavas','Az N-Butyric Acid, azaz a vajsav az egyik legmegosztóbb, de egyben a leghatásosabb illat is a pontyok számára! A vajsav egy teljes egészében természetes sav, amit a halak már rendkívül távolról megéreznek.\r\n\r\nRájöttünk, hogy az etetőanyagunk csalogató hatását ananászos aromával kombinálva még félelmetesebb keveréket tudunk létrehozni, így azt háttérízként alkalmaztuk az etetőanyag gyártása során! Az etetőanyag 3mm-es színes mikropelletet is tartalmaz, azzal válik teljessé a csalogató hatás.\r\n\r\nEgyedi összetételű etetőanyagok, amelyek nagyon attraktívak – ez a Speciál Mix Extra etetőanyag család.\r\n\r\nA legjobb taktika, a hozzáértő horgász, és a százféle csali mit sem ér megfelelő etetőanyag nélkül! A halakat hatékony etetőanyag nélkül nem lehet eredményesen egy helyre becsalogatni.\r\n\r\nPontosan ezért hoztuk létre az Extra etetőanyag családot!','speciál_mix_-_vajsavas_01_08_23_04_37_57.jpg',2000,50,1,1000,2000,'durván rostált','ananász-vajsav','bézs','halliszt, zsemlemorzsa, vajsav-aroma, víz, olaj, só','feed','ponty, amur, keszeg és kárász',10,'2023-01-15 12:04:02','0000-00-00'),(6,'Dynamite Baits Swim Stim Betaine Green Pellet','Egy különleges, garantáltan szelektív pontyhorgászatot biztosító mikro pellet, amely meghökkentően hatékonyan működik hazai vizekben is. A Swim Stim Betaine rendkívül attraktív, hatásos étvágyfokozó. Ebben a termékcsaládban egyesülnek azok a létfontosságú, könnyen emészthető összetevők és étvágyfokozók, amik a pontyokat féktelen evésre ösztönzik, anélkül, hogy eltelnének vele. A vonzáskörzetébe kerülő halak azonnal megérzik, hogy egy nagyon tömény, kalóriadús táplálékforrás van a közelében, amely mágnesként vonzza őket. A zöld szín úgy beleolvad a mederfenékbe, hogy az a legóvatosabb nagyponty gyanakvását is elaltatja. Univerzális, egész évben használható pellet.','dynamite_baits_swim_stim_betaine_green_pellet_01_13_23_02_19_39.jpg',2490,50,1,900,2767,'2-6','betain','zöld','halliszt, betain, vajsav, só, olaj, tartósítószerek','pellet','ponty, amur, keszeg és kárász',0,'2023-01-13 13:19:39','0000-00-00'),(7,'HALDORÁDÓ 4S Method Pellet Mix','A 4S Method Pellet Mix egy olyan termékcsalád, amely alapanyagául a méltán híres Aqua Garant és Coppens pelletek szolgáltak, de ezek között is már olyan sok változat van, és annyi féleképpen lehet keverni, hogy ember legyen a talpán, aki el tud ezen igazodni és ki tudja választani az adott évszakban legeredményesebb keveréket. Az a dolgunk, hogy ebben is segítsünk és a legfogósabb, számunkra leghatékonyabb keverékeket adjuk a horgászok kezébe. Van ezek között „titkos\" versenykeverék is!\r\nElkészítése egyszerű, mindössze a megfelelő mennyiségű vizet kell hozzátenni, majd összerázni, és néhány perc múlva már tölthető is a method kosárba. Minden változat natúr, aromamentes. Ezeket természetesen a halak ízléséhez igazodva lehet ízesíteni, aromásítani!','haldorÁdÓ_4s_method_pellet_mix_01_13_23_02_53_30.jpg',1690,50,1,400,4225,'2-6','halas','natúr barna','halliszt, zsemlemorzsa, víz, olaj, só, adalékanyag és ételszínezék','pellet','ponty és amur',0,'2023-01-13 13:53:30','0000-00-00'),(8,'HALDORÁDÓ 4S Method Pellet Groundbait','A 4S Method Pellet Groundbait magas minőségű etetőanyagok fejlesztésében és tesztelésben a Haldorádó Method Feeder Team SK, azaz Rigó Péter vezette szlovák csapatunk, a Bolgár Géza által vezetett Haldorádó RO Feeder Team Radesti, és természetesen a hazai magyar teszthorgász csapatunk is részt vett. Így a 2021. évi Method Feeder VB első helyén végző magyar csapat tagjai közül Sipos Gábor és Döme Gábor, a VB harmadik helyén végző szlovák válogatott és negyedik helyen végző román válogatott tagjainak tudása és tapasztalata adódik össze ezekben a termékekben. Talán nem túlzás, ha azt állítjuk, hogy jelenleg a világ legjobb Method Feeder horgászainak, három nemzet közös munkájának eredménye ölt testet ezekben a termékekben.','haldorÁdÓ_4s_method_pellet_groundbait_01_13_23_02_24_50.jpg',1990,50,1,400,4975,'por állag','halas','natúr barna','halliszt, zsemlemorzsa, víz, olaj, só, adalékanyag és ételszínezék','feed','ponty, keszeg és kárász',25,'2023-01-15 12:00:27','0000-00-00'),(9,'HALDORÁDÓ Big Feed C6 Pellet Kiwi','A Haldorádó Big Feed széria a nagymennyiségű szoktató és helyben tartó etetésekhez kínál gazdaságos megoldást. Sikerült olyan jó minőségű etető pelleteket és bojlikat egy családba rendezni, amelynek révén nem kell kompromisszumot kötni, és mégsem kerül majd egy hosszabb túra egy vagyonba. Nehéz az itt látható pelletek és bojlik kiváló aromáját, ízét a fotókon keresztül átadni, de biztosra vesszük, hogy azok, akik kézbe veszik, majd kipróbálják, megdöbbenve tapasztják, hogy mennyire fogósak, illetve mennyire kedvező az áruk!','haldorÁdÓ_big_feed_c6_pellet_kiwi_01_13_23_02_29_00.jpg',1590,50,1,800,1988,'4-8','kiwi','sötétzöld','halliszt, betain, kiwi, só, olaj, tartósítószerek','pellet','ponty és amur',0,'2023-01-15 12:00:20','0000-00-00'),(10,'HALDORÁDÓ Big Feed C6 Pellet - Mangó','A Haldorádó Big Feed széria a nagymennyiségű szoktató és helybentartó etetésekhez kínál gazdaságos megoldást. Sikerült olyan jó minőségű etető pelleteket és bojlikat egy családba rendezni, amely során nem kell kompromisszumot kötni, és mégsem kerül majd egy hosszabb túra egy vagyonba. Nehéz az itt látható pelletek és bojlik kiváló aromáját, ízét a fotókon keresztül átadni, de biztosra vesszük, hogy azok, akik kézbe veszik, majd kipróbálják, megdöbbenve tapasztják, hogy mennyire fogósak, illetve mennyire kedvező az áruk!','haldorÁdÓ_big_feed_c6_pellet_-_mangó_01_13_23_02_28_48.jpg',1590,50,1,800,1988,'4-8','mangó','aranybarna','halliszt, betain, mangó, só, olaj, tartósítószerek','pellet','ponty és amur',0,'2023-01-13 13:28:48','0000-00-00'),(11,'HALDORÁDÓ MONSTER Pellet Box Tintahal & Áfonya','A bojlikészítésben régóta jól ismertek az olyan, emberi orr számára kevésbé kellemes adalékok, mint a vérliszt, májliszt, különböző hallisztek, vagy akár a csípős fűszerek. Nos, a MONSTER Pellet Boxok pont olyan dolgokat tartalmaznak, amelyek kellemetlen „illatuk” ellenére nagyon komoly távcsali hatással bírnak, főként a termetes pontyokra. Ezek a büdös, de borzasztóan magas tápanyagtartalmú eledelek négy különböző formában kerülnek forgalomba. A dobozokban a pelletkeveréken kívül található 100 ml aromásított folyadék, amely pont elegendő a pellet szemek felpuhításához, használatba vételéhez.\r\nA boxok használatba vétele nagyon egyszerű, mindössze a dobozban található 100 ml folyadékot kell a pellet mixre ráönteni, jól elkeverni, majd 10 perc pihentetés után etetőkosárba tömni. A többi a halakon múlik!','haldorÁdÓ_monster_pellet_box_tintahal_&_Áfonya_01_13_23_02_34_42.jpg',2990,50,1,400,7475,'2-6','tintahal és áfonya','barna, lila, rózsaszín','halliszt, betain, tintahal aroma, áfonyalé, só, olaj, tartósítószerek','pellet','ponty, amur, keszeg és kárász',10,'2023-01-13 13:34:42','0000-00-00'),(12,'HALDORÁDÓ Ready Method Pellet Édes Keksz','A Ready Method Pellet, hasonlóan Ready Method etetőanyagokhoz, nedves, használatra kész termék, amely többféle pellet mesteri kombinációja. Semmilyen előkészítést nem igényel, felbontása után azonnal method kosárba vagy PVA tasakba lehet tölteni, és már lehet is bedobni! Ugyanabban a 8 ízben kerül forgalomba, mint az etetőanyagok. Ready Method Pellet – Édes Keksz\r\nKellemes, édeskés sütemény aromájú, halas alapú pelletkeverék, amely az év minden szakában eredményes lehet. Használhatjuk természetes vizeken, de akár intenzíven telepített tavakon is bevethető!','haldorÁdÓ_ready_method_pellet_Édes_keksz_01_13_23_02_36_34.jpg',1190,50,1,400,2975,'2-6','édes keksz','barna','halliszt, keksztörmelék, só, olaj, tartósítószerek','pellet','ponty, amur, keszeg és kárász',0,'2023-01-13 13:36:34','0000-00-00'),(13,'HALDORÁDÓ Fűszeres Hal','A HALDORÁDÓ etetőanyag család tagjai Döme Gábor feeder-specialista mesterreceptjei alapján kerültek összeállításra. A különösen tartalmas, magas tápértékű, rendkívül intenzív aromájú, garantáltan friss alapanyagból készült keverékek a céltudatos nagyhal-horgászatban bizonyították rendkívüli fogósságukat. A széria talán legfeltűnőbb színezetű és aromájú tagja a FŰSZERES HAL. A zacskót kibontva a Haldorádó etetőanyagok között szokatlanul „egyszerűnek” tűnő keveréket láthatunk. Az élénkzöld színű, kellemetlenül büdös, fűszeres, hallisztes, finom szemcseméretű keverékből fluo morzsa, repce és apró pellet bújik elő. A keverék 18 alkotóelemből áll!\r\nA megszokottól eltérő módon most ennek pontos listáját nem osztjuk meg az érdeklődőkkel, mert nemcsak a gyártási folyamat tartogat meglepetéseket, hanem a különleges összetevők is, amelyet hétpecsétes titokként őrzünk. Túlzás nélkül állíthatjuk, hogy magyar etetőanyagok között nincs még egy ilyen, és e pillanatnyi előnyünket szeretnénk (még ha rövid ideig is, de) megőrizni!','haldorÁdÓ_fűszeres_hal_01_13_23_02_39_10.jpg',1490,50,1,1000,1490,'durván rostált','erős/fűszeres','zöld','halliszt, betain, fűszerek, fűszerpaprika, só, olaj, tartósítószerek','feed','ponty, amur, keszeg és kárász',10,'2023-01-13 13:39:10','0000-00-00'),(14,'Feedermania Groundbait Monkey','Prémium hallisztből és halolajból készült etetőanyag, aminosavakkal, étvágyfokozókkal, édes fűszerekkel és vitaminokkal dúsítva.','feedermania_groundbait_monkey_01_13_23_02_41_35.jpg',2390,50,1,1000,2390,'por állag','halas','sötétbarna','halliszt, aminosavak, étvágyfokozók, só, olaj, tartósítószerek','feed','ponty, amur, keszeg és kárász',0,'2023-01-13 13:41:35','0000-00-00'),(15,'Feedermania Groundbait High Carb Natural','Természetes aromájú, extra édes ízű, magas szénhidráttartalmú etetőanyat.','feedermania_groundbait_high_carb_natural_01_13_23_02_43_16.jpg',1590,50,1,1000,1590,'közepes méretű','natúr keksz','bézs, fehér','halliszt, zsemlemorzsa, víz, olaj, só, aminosavak, adalékanyag és ételszínezék','feed','ponty, amur, keszeg és kárász',0,'2023-01-13 13:43:16','0000-00-00'),(16,'SBS PVA Bag Pellet Mix','Ki ne hallott volna a koncentrált, horogcsali köré összpontosuló etetési technika sikeréről? A szerelékre akasztott, PVA hálóba csomagolt finomságokkal felkelthetjük az etetésre érkező halak figyelmét, ezzel is hozzájárulva ahhoz, hogy felvegyék a hajszálelőkén felkínált horogcsalinkat. A 2-3 mm-es pelletekből álló keverékek mindegyike magas fehérjetartalommal bír.\r\nA Fishmeal fantázianevű Pellet Mix ízesítés nélkül, ugyanakkor magas halolaj tartalma miatt lehet vonzó a halak számára a nyári hónapokban. Az M1-es ízesítésű termék az SBS népszerű aromájának és a Robin Red tartalmának köszönhetően az év bármely napján lehet elutasíthatatlan csemege a halak számára. A Scopex és Strawberry, édes ízvilágú termékek elsősorban a hideg vízben időszakokban áttörést a kapástalan időszakokban, a Squid & Octopus pedig klasszikus pontyhorgász ízesítés, tulajdonsképpen 4 évszakos csalogatóanyag.','sbs_pva_bag_pellet_mix_01_13_23_02_45_17.jpg',1490,50,1,500,2980,'2-6','tintahal és polip','barna és sárga','halliszt, zsemlemorzsa, ételaromák, víz, olaj, só, adalékanyag és ételszínezék','pellet','ponty és amur',0,'2023-01-13 13:45:17','0000-00-00'),(17,'BroBaits Sweety Buddies','A BroBaits Sweety Buddies egy olyan termékcsalád, amely alapanyagául a méltán híres Aqua Garant és Coppens pelletek szolgáltak, de ezek között is már olyan sok változat van, és annyi féleképpen lehet keverni, hogy ember legyen a talpán, aki el tud ezen igazodni és ki tudja választani az adott évszakban legeredményesebb keveréket. Az a dolgunk, hogy ebben is segítsünk és a legfogósabb, számunkra leghatékonyabb keverékeket adjuk a horgászok kezébe. Van ezek között „titkos\" versenykeverék is!\r\nElkészítése egyszerű, mindössze a megfelelő mennyiségű vizet kell hozzátenni, majd összerázni, és néhány perc múlva már tölthető is a method kosárba. Minden változat natúr, aromamentes. Ezeket természetesen a halak ízléséhez igazodva lehet ízesíteni, aromásítani! A jelenleg látható termékünk csokoládé és narancs ízesítésben kapható!','brobaits_sweety_buddies_01_13_23_02_48_38.jpg',2500,50,1,500,5000,'2-6','csokoládé és narancs','narancssárga és sötétbarna','halliszt, betain, csokoládé- és narancsaroma, só, olaj, tartósítószerek','pellet','ponty és amur',0,'2023-01-13 13:48:38','0000-00-00');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPwd` varchar(100) NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user123','usertest@gmail.hu','$2y$10$heN0K8hBBXCaQLRXrd1.o.r7jBi3sUJkZbb.RDmZNQEwKbx1U9noq','2023-01-12 18:33:23'),(3,'hali','hali@hali.hu','$2y$10$8MM46t77ykNOhuNksUX1S.kRdfh1h2yN2XG23XKIWMZWK7ZkNaUJK','2023-01-12 19:03:15'),(6,'halika','halika@hali.hu','$2y$10$tSg7S2F.hmzmqyQOXZpYB.sbWgdZlw7LsJkZYjtx/BwvfjcWImE3m','2023-01-12 19:44:24'),(7,'tomi1234','tomi@tomi.hu','$2y$10$/TYaUsjqbgRTdLlHGj4ZT.6xHA6IHaY1pMgaNPPH4Up0UNU.VD9MK','2023-01-12 21:03:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-16  9:21:40

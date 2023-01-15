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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (27,'PVA Bag',2,'Tam├ís Sz┼▒cs','2023-01-11 20:59:23','drdeakimre@growingmedia.io',4000,2120,'Asad','12313asdd asd',2120,'Asad','12313asdd asd','No comment',1,'2023-01-12',0,'tomi1234'),(30,'Benz├ír Mix - Capsuni',5,'Tam├ís Sz┼▒cs','2023-01-12 20:07:01','mesterszakacs@mesterszakacs.hu',12500,20202,'asdad','20202asdd',20202,'asdad','20202asdd','asdad',0,'0000-00-00',0,'no-user'),(31,'Sushi Mix',1,'Tam├ís Sz┼▒cs','2023-01-12 20:07:01','mesterszakacs@mesterszakacs.hu',4160,20202,'asdad','20202asdd',20202,'asdad','20202asdd','asdad',0,'0000-00-00',0,'no-user'),(32,'Sushi Mix',2,'Tamas Nincsuser','2023-01-13 07:21:25','nincsuser@nincs.hu',8320,2020,'asdsad','asdsad 1030 sadsad',2020,'asdsad','asdsad 1030 sadsad','No comment',0,'0000-00-00',0,'no-user'),(33,'PVA Bag',1,'Tamas Nincsuser','2023-01-13 07:21:25','nincsuser@nincs.hu',2000,2020,'asdsad','asdsad 1030 sadsad',2020,'asdsad','asdsad 1030 sadsad','No comment',0,'0000-00-00',0,'no-user'),(34,'Sushi Mix',2,'Halika Halika','2023-01-13 07:22:52','halika@halika.hu',8320,2020,'asdsad','2072 asdas',2020,'asdsad','2072 asdas','No comment',0,'0000-00-00',0,'halika'),(35,'PVA Bag',2,'Halika Halika ├Üj rendel├ęs','2023-01-13 07:26:29','halika@halika.hu',4000,2020,'asdsad','20 asd 3030',2020,'asdsad','20 asd 3030','halika commentje',0,'0000-00-00',1,'halika'),(36,'Benz├ír Mix - Capsuni',2,'No user','2023-01-13 07:28:05','kiss.marton@growingmedia.io',5000,2020,'asdadad','asdad 30',2020,'asdadad','asdad 30','asdad',0,'0000-00-00',0,'no-user'),(37,'PVA Bag',2,'Tam├ís Sz┼▒cs','2023-01-13 07:29:09','kiss.marton@growingmedia.io',4000,2020,'asdad','020 asda',2020,'asdad','020 asda','asdsadsadaddadsa',0,'0000-00-00',1,'tomi1234'),(38,'HALDOR├üD├ô 4S Method Pellet Groundbait',2,'hali ├║j','2023-01-13 16:54:25','halika@halika.hu',2985,20202,'asdsad asd','asd a123',20202,'asdsad asd','asd a123','hali hlai halimiahely',0,'0000-00-00',1,'halika'),(42,'asdad',5,'Rendelo Jozsi','2023-01-15 14:17:03','asd@asd.hu',2022020,2020,'asdasd','asdasd',0,'asdasd','asdasd','kommentes order',0,'0000-00-00',1,'tamas23'),(43,'Benz├ír Mix - Capsuni',4,'api pr├│ba','2023-01-15 14:19:14','api@api.hu',10000,2020,'asdad 20','0202 asd012',2020,'asdad 20','0202 asd012','api api',0,'0000-00-00',0,'no-user');
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
INSERT INTO `products` VALUES (1,'Sushi Mix','                  A Sushi Mix sz├ęria a nagymennyis├ęg┼▒ szoktat├│ ├ęs helyben tart├│ etet├ęsekhez k├şn├íl gazdas├ígos megold├íst. Siker├╝lt olyan j├│ min┼Ĺs├ęg┼▒ etet┼Ĺ pelleteket egy csal├ídba rendezni, amelynek r├ęv├ęn nem kell kompromisszumot k├Âtni, ├ęs m├ęgsem ker├╝l majd egy hosszabb t├║ra egy vagyonba. Neh├ęz az itt l├íthat├│ pelletek kiv├íl├│ arom├íj├ít, ├şz├ęt a fot├│kon kereszt├╝l ├ítadni, de biztosra vessz├╝k, hogy azok, akik k├ęzbe veszik, majd kipr├│b├ílj├ík, megd├Âbbenve tapasztj├ík, hogy mennyire fog├│sak, illetve mennyire kedvez┼Ĺ az ├íruk!\r\n\r\n<b>Sushi Mix - Crab</b>\r\nA Sushi Mix csal├íd sz├ímos kiv├íl├│ megold├íst k├şn├íl, ak├ír alapoz├│ etet├ęs kialak├şt├ís├íra, kieg├ęsz├şt├ęs├ęre, ak├ír kosaras kever├ękek beltartalm├ínak d├║s├şt├ís├íra. A pellet szemek ├ítm├ęr┼Ĺje 2-6 mm, text├║r├íjuk t├Âm├Âr ├ęs kem├ęny, a v├şzben viszont sz├ęp lassan felpuhulnak, s k├Âzben mindv├ęgig ├íramoltatj├ík magukb├│l cs├íb├şt├│ arom├íjukat. 0,8 ├ęs 2,5 kg-os gazdas├ígos kiszerel├ęsekben ker├╝l forgalomba, melyekkel a r├Âvidebb ├ęs ak├ír hosszabb horg├íszt├║r├ík etet├ęs├ęt is hat├ękonyan megoldhatjuk.','sushi_mix_01_13_23_09_36_55.jpg',5200,25,1,800,4500,'6-8','fokhagym├ís krill','feh├ęr ├ęs r├│zsasz├şn','zsemlemorzsa, fokhagyma, r├íkliszt, tart├│s├şt├│szer, adal├ękanyagok','pellet','ponty (0-12 kg), tokhal, busa',20,'2023-01-15 14:50:16','0000-00-00'),(2,'PVA Bag','Ki ne hallott volna a koncentr├ílt, horogcsali k├Âr├ę ├Âsszpontosul├│ etet├ęsi technika siker├ęr┼Ĺl? A szerel├ękre akasztott, PVA h├íl├│ba csomagolt finoms├ígokkal felkelthetj├╝k az etet├ęsre ├ęrkez┼Ĺ halak figyelm├ęt, ezzel is hozz├íj├írulva ahhoz, hogy felvegy├ęk a hajsz├ílel┼Ĺk├ęn felk├şn├ílt horogcsalinkat. A 2-3 mm-es pelletekb┼Ĺl ├íll├│ kever├ękek mindegyike magas feh├ęrjetartalommal b├şr. Az Fishmeal fant├ízianev┼▒ Pellet Mix ├şzes├şt├ęs n├ęlk├╝l, ugyanakkor magas halolajtartalma miatt lehet vonz├│ a halak sz├ím├íra a ny├íri h├│napokban. Az M1-es ├şzes├şt├ęs┼▒ term├ęk az SBS n├ępszer┼▒ arom├íj├ínak ├ęs a Robin Red tartalm├ínak k├Âsz├Ânhet┼Ĺen az ├ęv b├írmely napj├ín lehet elutas├şthatatlan csemege a halak sz├ím├íra. A Scopex ├ęs Strawberry, ├ędes ├şzvil├íg├║ term├ękek els┼Ĺsorban a hideg v├şzben id┼Ĺszakokban ├ítt├Âr├ęst a kap├ístalan id┼Ĺszakokban.\r\n\r\n<b>SBS - PVA Bag</b>\r\nA pelletkever├ęk term├ęszetesen sz├írazon is bet├Âlthet┼Ĺ a PVA h├íl├│ba, de ha azt szeretn├ęnk hogy kiss├ę felpuhuljanak a pelletszemek, akkor 100 grammonk├ęnt 5 ml folyad├ęk hozz├íad├ís├ít javasoljuk!','sbs-pva-bag.png',2000,50,1,1000,2000,'10-12','hal ├ęs Robin Red','v├Âr├Âs','zsemlemorzsa, fokhagyma, robin red, tart├│s├şt├│szer, halolaj, hal, adal├ękanyagok','pellet','ponty (0-12 kg), tokhal, busa',0,'2023-01-15 12:52:24','0000-00-00'),(4,'Benz├ír Mix - Capsuni','Egyre nagyobb n├ępszer┼▒s├ęgnek ├Ârvendenek haz├ínkban a mikro pelletek. Az etet┼Ĺanyagunkhoz keverve a v├şzben k├ęs┼Ĺbb bomlik sz├ęt, mint az etet┼Ĺ t├Âbbi alkot├│eleme, ez├íltal a k├ęs┼Ĺbb ├ęrkez┼Ĺ testesebb halaknak is szolg├íltat t├ípl├íl├ękot. Keverj├╝k az etet┼Ĺnkh├Âz max. 30%-os ar├ínyban ├ęs a fog├ís nem maradhat el. T├Âbbf├ęle sz├şnben ├ęs ├şzben ker├╝l forgalomba, ├şgy b├írmilyen k├Âr├╝lm├ęnyek k├Âz├Âtt megtal├ílhatjuk a sz├ímunkra ├ęs f┼Ĺk├ęnt a halak sz├ím├íra megfelel┼Ĺt.','benz├ír_mix_-_capsuni_01_15_23_02_30_51.jpg',2500,50,1,500,5000,'2-6','r├ík','v├Âr├Âs','halliszt, zsemlemorzsa, r├íkliszt, v├şz, olaj, s├│, garn├ęla','pellet','ponty, amur, keszeg ├ęs k├ír├ísz',0,'2023-01-15 13:30:51','0000-00-00'),(5,'Speci├íl Mix - Vajsavas','Az N-Butyric Acid, azaz a vajsav az egyik legmegoszt├│bb, de egyben a leghat├ísosabb illat is a pontyok sz├ím├íra! A vajsav egy teljes eg├ęsz├ęben term├ęszetes sav, amit a halak m├ír rendk├şv├╝l t├ívolr├│l meg├ęreznek.\r\n\r\nR├íj├Âtt├╝nk, hogy az etet┼Ĺanyagunk csalogat├│ hat├ís├ít anan├íszos arom├íval kombin├ílva m├ęg f├ęlelmetesebb kever├ęket tudunk l├ętrehozni, ├şgy azt h├ítt├ęr├şzk├ęnt alkalmaztuk az etet┼Ĺanyag gy├írt├ísa sor├ín! Az etet┼Ĺanyag 3mm-es sz├şnes mikropelletet is tartalmaz, azzal v├ílik teljess├ę a csalogat├│ hat├ís.\r\n\r\nEgyedi ├Âsszet├ętel┼▒ etet┼Ĺanyagok, amelyek nagyon attrakt├şvak ÔÇô ez a Speci├íl Mix Extra etet┼Ĺanyag csal├íd.\r\n\r\nA legjobb taktika, a hozz├í├ęrt┼Ĺ horg├ísz, ├ęs a sz├ízf├ęle csali mit sem ├ęr megfelel┼Ĺ etet┼Ĺanyag n├ęlk├╝l! A halakat hat├ękony etet┼Ĺanyag n├ęlk├╝l nem lehet eredm├ęnyesen egy helyre becsalogatni.\r\n\r\nPontosan ez├ęrt hoztuk l├ętre az Extra etet┼Ĺanyag csal├ídot!','speci├íl_mix_-_vajsavas_01_08_23_04_37_57.jpg',2000,50,1,1000,2000,'durv├ín rost├ílt','anan├ísz-vajsav','b├ęzs','halliszt, zsemlemorzsa, vajsav-aroma, v├şz, olaj, s├│','feed','ponty, amur, keszeg ├ęs k├ír├ísz',10,'2023-01-15 12:04:02','0000-00-00'),(6,'Dynamite Baits Swim Stim Betaine Green Pellet','Egy k├╝l├Ânleges, garant├íltan szelekt├şv pontyhorg├íszatot biztos├şt├│ mikro pellet, amely megh├Âkkent┼Ĺen hat├ękonyan m┼▒k├Âdik hazai vizekben is. A Swim Stim Betaine rendk├şv├╝l attrakt├şv, hat├ísos ├ętv├ígyfokoz├│. Ebben a term├ękcsal├ídban egyes├╝lnek azok a l├ętfontoss├íg├║, k├Ânnyen em├ęszthet┼Ĺ ├Âsszetev┼Ĺk ├ęs ├ętv├ígyfokoz├│k, amik a pontyokat f├ęktelen ev├ęsre ├Âszt├Ânzik, an├ęlk├╝l, hogy elteln├ęnek vele. A vonz├ísk├Ârzet├ębe ker├╝l┼Ĺ halak azonnal meg├ęrzik, hogy egy nagyon t├Âm├ęny, kal├│riad├║s t├ípl├íl├ękforr├ís van a k├Âzel├ęben, amely m├ígnesk├ęnt vonzza ┼Ĺket. A z├Âld sz├şn ├║gy beleolvad a mederfen├ękbe, hogy az a leg├│vatosabb nagyponty gyanakv├ís├ít is elaltatja. Univerz├ílis, eg├ęsz ├ęvben haszn├ílhat├│ pellet.','dynamite_baits_swim_stim_betaine_green_pellet_01_13_23_02_19_39.jpg',2490,50,1,900,2767,'2-6','betain','z├Âld','halliszt, betain, vajsav, s├│, olaj, tart├│s├şt├│szerek','pellet','ponty, amur, keszeg ├ęs k├ír├ísz',0,'2023-01-13 13:19:39','0000-00-00'),(7,'HALDOR├üD├ô 4S Method Pellet Mix','A 4S Method Pellet Mix egy olyan term├ękcsal├íd, amely alapanyag├íul a m├ęlt├ín h├şres Aqua Garant ├ęs Coppens pelletek szolg├íltak, de ezek k├Âz├Âtt is m├ír olyan sok v├íltozat van, ├ęs annyi f├ęlek├ęppen lehet keverni, hogy ember legyen a talp├ín, aki el tud ezen igazodni ├ęs ki tudja v├ílasztani az adott ├ęvszakban legeredm├ęnyesebb kever├ęket. Az a dolgunk, hogy ebben is seg├şts├╝nk ├ęs a legfog├│sabb, sz├ímunkra leghat├ękonyabb kever├ękeket adjuk a horg├íszok kez├ębe. Van ezek k├Âz├Âtt ÔÇ×titkos\" versenykever├ęk is!\r\nElk├ęsz├şt├ęse egyszer┼▒, mind├Âssze a megfelel┼Ĺ mennyis├ęg┼▒ vizet kell hozz├ítenni, majd ├Âsszer├ízni, ├ęs n├ęh├íny perc m├║lva m├ír t├Âlthet┼Ĺ is a method kos├írba. Minden v├íltozat nat├║r, aromamentes. Ezeket term├ęszetesen a halak ├şzl├ęs├ęhez igazodva lehet ├şzes├şteni, arom├ís├ştani!','haldor├üd├ô_4s_method_pellet_mix_01_13_23_02_53_30.jpg',1690,50,1,400,4225,'2-6','halas','nat├║r barna','halliszt, zsemlemorzsa, v├şz, olaj, s├│, adal├ękanyag ├ęs ├ętelsz├şnez├ęk','pellet','ponty ├ęs amur',0,'2023-01-13 13:53:30','0000-00-00'),(8,'HALDOR├üD├ô 4S Method Pellet Groundbait','A 4S Method Pellet Groundbait magas min┼Ĺs├ęg┼▒ etet┼Ĺanyagok fejleszt├ęs├ęben ├ęs tesztel├ęsben a Haldor├íd├│ Method Feeder Team SK, azaz Rig├│ P├ęter vezette szlov├ík csapatunk, a Bolg├ír G├ęza ├íltal vezetett Haldor├íd├│ RO Feeder Team Radesti, ├ęs term├ęszetesen a hazai magyar teszthorg├ísz csapatunk is r├ęszt vett. ├Źgy a 2021. ├ęvi Method Feeder VB els┼Ĺ hely├ęn v├ęgz┼Ĺ magyar csapat tagjai k├Âz├╝l Sipos G├íbor ├ęs D├Âme G├íbor, a VB harmadik hely├ęn v├ęgz┼Ĺ szlov├ík v├ílogatott ├ęs negyedik helyen v├ęgz┼Ĺ rom├ín v├ílogatott tagjainak tud├ísa ├ęs tapasztalata ad├│dik ├Âssze ezekben a term├ękekben. Tal├ín nem t├║lz├ís, ha azt ├íll├ştjuk, hogy jelenleg a vil├íg legjobb Method Feeder horg├íszainak, h├írom nemzet k├Âz├Âs munk├íj├ínak eredm├ęnye ├Âlt testet ezekben a term├ękekben.','haldor├üd├ô_4s_method_pellet_groundbait_01_13_23_02_24_50.jpg',1990,50,1,400,4975,'por ├íllag','halas','nat├║r barna','halliszt, zsemlemorzsa, v├şz, olaj, s├│, adal├ękanyag ├ęs ├ętelsz├şnez├ęk','feed','ponty, keszeg ├ęs k├ír├ísz',25,'2023-01-15 12:00:27','0000-00-00'),(9,'HALDOR├üD├ô Big Feed C6 Pellet Kiwi','A Haldor├íd├│ Big Feed sz├ęria a nagymennyis├ęg┼▒ szoktat├│ ├ęs helyben tart├│ etet├ęsekhez k├şn├íl gazdas├ígos megold├íst. Siker├╝lt olyan j├│ min┼Ĺs├ęg┼▒ etet┼Ĺ pelleteket ├ęs bojlikat egy csal├ídba rendezni, amelynek r├ęv├ęn nem kell kompromisszumot k├Âtni, ├ęs m├ęgsem ker├╝l majd egy hosszabb t├║ra egy vagyonba. Neh├ęz az itt l├íthat├│ pelletek ├ęs bojlik kiv├íl├│ arom├íj├ít, ├şz├ęt a fot├│kon kereszt├╝l ├ítadni, de biztosra vessz├╝k, hogy azok, akik k├ęzbe veszik, majd kipr├│b├ílj├ík, megd├Âbbenve tapasztj├ík, hogy mennyire fog├│sak, illetve mennyire kedvez┼Ĺ az ├íruk!','haldor├üd├ô_big_feed_c6_pellet_kiwi_01_13_23_02_29_00.jpg',1590,50,1,800,1988,'4-8','kiwi','s├Ât├ętz├Âld','halliszt, betain, kiwi, s├│, olaj, tart├│s├şt├│szerek','pellet','ponty ├ęs amur',0,'2023-01-15 12:00:20','0000-00-00'),(10,'HALDOR├üD├ô Big Feed C6 Pellet - Mang├│','A Haldor├íd├│ Big Feed sz├ęria a nagymennyis├ęg┼▒ szoktat├│ ├ęs helybentart├│ etet├ęsekhez k├şn├íl gazdas├ígos megold├íst. Siker├╝lt olyan j├│ min┼Ĺs├ęg┼▒ etet┼Ĺ pelleteket ├ęs bojlikat egy csal├ídba rendezni, amely sor├ín nem kell kompromisszumot k├Âtni, ├ęs m├ęgsem ker├╝l majd egy hosszabb t├║ra egy vagyonba. Neh├ęz az itt l├íthat├│ pelletek ├ęs bojlik kiv├íl├│ arom├íj├ít, ├şz├ęt a fot├│kon kereszt├╝l ├ítadni, de biztosra vessz├╝k, hogy azok, akik k├ęzbe veszik, majd kipr├│b├ílj├ík, megd├Âbbenve tapasztj├ík, hogy mennyire fog├│sak, illetve mennyire kedvez┼Ĺ az ├íruk!','haldor├üd├ô_big_feed_c6_pellet_-_mang├│_01_13_23_02_28_48.jpg',1590,50,1,800,1988,'4-8','mang├│','aranybarna','halliszt, betain, mang├│, s├│, olaj, tart├│s├şt├│szerek','pellet','ponty ├ęs amur',0,'2023-01-13 13:28:48','0000-00-00'),(11,'HALDOR├üD├ô MONSTER Pellet Box Tintahal & ├üfonya','A bojlik├ęsz├şt├ęsben r├ęg├│ta j├│l ismertek az olyan, emberi orr sz├ím├íra kev├ęsb├ę kellemes adal├ękok, mint a v├ęrliszt, m├íjliszt, k├╝l├Ânb├Âz┼Ĺ hallisztek, vagy ak├ír a cs├şp┼Ĺs f┼▒szerek. Nos, a MONSTER Pellet Boxok pont olyan dolgokat tartalmaznak, amelyek kellemetlen ÔÇ×illatukÔÇŁ ellen├ęre nagyon komoly t├ívcsali hat├íssal b├şrnak, f┼Ĺk├ęnt a termetes pontyokra. Ezek a b├╝d├Âs, de borzaszt├│an magas t├ípanyagtartalm├║ eledelek n├ęgy k├╝l├Ânb├Âz┼Ĺ form├íban ker├╝lnek forgalomba. A dobozokban a pelletkever├ęken k├şv├╝l tal├ílhat├│ 100 ml arom├ís├ştott folyad├ęk, amely pont elegend┼Ĺ a pellet szemek felpuh├şt├ís├íhoz, haszn├ílatba v├ętel├ęhez.\r\nA boxok haszn├ílatba v├ętele nagyon egyszer┼▒, mind├Âssze a dobozban tal├ílhat├│ 100 ml folyad├ękot kell a pellet mixre r├í├Ânteni, j├│l elkeverni, majd 10 perc pihentet├ęs ut├ín etet┼Ĺkos├írba t├Âmni. A t├Âbbi a halakon m├║lik!','haldor├üd├ô_monster_pellet_box_tintahal_&_├üfonya_01_13_23_02_34_42.jpg',2990,50,1,400,7475,'2-6','tintahal ├ęs ├ífonya','barna, lila, r├│zsasz├şn','halliszt, betain, tintahal aroma, ├ífonyal├ę, s├│, olaj, tart├│s├şt├│szerek','pellet','ponty, amur, keszeg ├ęs k├ír├ísz',10,'2023-01-13 13:34:42','0000-00-00'),(12,'HALDOR├üD├ô Ready Method Pellet ├ëdes Keksz','A Ready Method Pellet, hasonl├│an Ready Method etet┼Ĺanyagokhoz, nedves, haszn├ílatra k├ęsz term├ęk, amely t├Âbbf├ęle pellet mesteri kombin├íci├│ja. Semmilyen el┼Ĺk├ęsz├şt├ęst nem ig├ęnyel, felbont├ísa ut├ín azonnal method kos├írba vagy PVA tasakba lehet t├Âlteni, ├ęs m├ír lehet is bedobni! Ugyanabban a 8 ├şzben ker├╝l forgalomba, mint az etet┼Ĺanyagok. Ready Method Pellet ÔÇô ├ëdes Keksz\r\nKellemes, ├ędesk├ęs s├╝tem├ęny arom├íj├║, halas alap├║ pelletkever├ęk, amely az ├ęv minden szak├íban eredm├ęnyes lehet. Haszn├ílhatjuk term├ęszetes vizeken, de ak├ír intenz├şven telep├ştett tavakon is bevethet┼Ĺ!','haldor├üd├ô_ready_method_pellet_├ëdes_keksz_01_13_23_02_36_34.jpg',1190,50,1,400,2975,'2-6','├ędes keksz','barna','halliszt, kekszt├Ârmel├ęk, s├│, olaj, tart├│s├şt├│szerek','pellet','ponty, amur, keszeg ├ęs k├ír├ísz',0,'2023-01-13 13:36:34','0000-00-00'),(13,'HALDOR├üD├ô F┼▒szeres Hal','A HALDOR├üD├ô etet┼Ĺanyag csal├íd tagjai D├Âme G├íbor feeder-specialista mesterreceptjei alapj├ín ker├╝ltek ├Âssze├íll├şt├ísra. A k├╝l├Ân├Âsen tartalmas, magas t├íp├ęrt├ęk┼▒, rendk├şv├╝l intenz├şv arom├íj├║, garant├íltan friss alapanyagb├│l k├ęsz├╝lt kever├ękek a c├ęltudatos nagyhal-horg├íszatban bizony├ştott├ík rendk├şv├╝li fog├│ss├ígukat. A sz├ęria tal├ín legfelt┼▒n┼Ĺbb sz├şnezet┼▒ ├ęs arom├íj├║ tagja a F┼░SZERES HAL. A zacsk├│t kibontva a Haldor├íd├│ etet┼Ĺanyagok k├Âz├Âtt szokatlanul ÔÇ×egyszer┼▒nekÔÇŁ t┼▒n┼Ĺ kever├ęket l├íthatunk. Az ├ęl├ęnkz├Âld sz├şn┼▒, kellemetlen├╝l b├╝d├Âs, f┼▒szeres, hallisztes, finom szemcsem├ęret┼▒ kever├ękb┼Ĺl fluo morzsa, repce ├ęs apr├│ pellet b├║jik el┼Ĺ. A kever├ęk 18 alkot├│elemb┼Ĺl ├íll!\r\nA megszokott├│l elt├ęr┼Ĺ m├│don most ennek pontos list├íj├ít nem osztjuk meg az ├ęrdekl┼Ĺd┼Ĺkkel, mert nemcsak a gy├írt├ísi folyamat tartogat meglepet├ęseket, hanem a k├╝l├Ânleges ├Âsszetev┼Ĺk is, amelyet h├ętpecs├ętes titokk├ęnt ┼Ĺrz├╝nk. T├║lz├ís n├ęlk├╝l ├íll├şthatjuk, hogy magyar etet┼Ĺanyagok k├Âz├Âtt nincs m├ęg egy ilyen, ├ęs e pillanatnyi el┼Ĺny├╝nket szeretn├ęnk (m├ęg ha r├Âvid ideig is, de) meg┼Ĺrizni!','haldor├üd├ô_f┼▒szeres_hal_01_13_23_02_39_10.jpg',1490,50,1,1000,1490,'durv├ín rost├ílt','er┼Ĺs/f┼▒szeres','z├Âld','halliszt, betain, f┼▒szerek, f┼▒szerpaprika, s├│, olaj, tart├│s├şt├│szerek','feed','ponty, amur, keszeg ├ęs k├ír├ísz',10,'2023-01-13 13:39:10','0000-00-00'),(14,'Feedermania Groundbait Monkey','Pr├ęmium hallisztb┼Ĺl ├ęs halolajb├│l k├ęsz├╝lt etet┼Ĺanyag, aminosavakkal, ├ętv├ígyfokoz├│kkal, ├ędes f┼▒szerekkel ├ęs vitaminokkal d├║s├ştva.','feedermania_groundbait_monkey_01_13_23_02_41_35.jpg',2390,50,1,1000,2390,'por ├íllag','halas','s├Ât├ętbarna','halliszt, aminosavak, ├ętv├ígyfokoz├│k, s├│, olaj, tart├│s├şt├│szerek','feed','ponty, amur, keszeg ├ęs k├ír├ísz',0,'2023-01-13 13:41:35','0000-00-00'),(15,'Feedermania Groundbait High Carb Natural','Term├ęszetes arom├íj├║, extra ├ędes ├şz┼▒, magas sz├ęnhidr├íttartalm├║ etet┼Ĺanyat.','feedermania_groundbait_high_carb_natural_01_13_23_02_43_16.jpg',1590,50,1,1000,1590,'k├Âzepes m├ęret┼▒','nat├║r keksz','b├ęzs, feh├ęr','halliszt, zsemlemorzsa, v├şz, olaj, s├│, aminosavak, adal├ękanyag ├ęs ├ętelsz├şnez├ęk','feed','ponty, amur, keszeg ├ęs k├ír├ísz',0,'2023-01-13 13:43:16','0000-00-00'),(16,'SBS PVA Bag Pellet Mix','Ki ne hallott volna a koncentr├ílt, horogcsali k├Âr├ę ├Âsszpontosul├│ etet├ęsi technika siker├ęr┼Ĺl? A szerel├ękre akasztott, PVA h├íl├│ba csomagolt finoms├ígokkal felkelthetj├╝k az etet├ęsre ├ęrkez┼Ĺ halak figyelm├ęt, ezzel is hozz├íj├írulva ahhoz, hogy felvegy├ęk a hajsz├ílel┼Ĺk├ęn felk├şn├ílt horogcsalinkat. A 2-3 mm-es pelletekb┼Ĺl ├íll├│ kever├ękek mindegyike magas feh├ęrjetartalommal b├şr.\r\nA Fishmeal fant├ízianev┼▒ Pellet Mix ├şzes├şt├ęs n├ęlk├╝l, ugyanakkor magas halolaj tartalma miatt lehet vonz├│ a halak sz├ím├íra a ny├íri h├│napokban. Az M1-es ├şzes├şt├ęs┼▒ term├ęk az SBS n├ępszer┼▒ arom├íj├ínak ├ęs a Robin Red tartalm├ínak k├Âsz├Ânhet┼Ĺen az ├ęv b├írmely napj├ín lehet elutas├şthatatlan csemege a halak sz├ím├íra. A Scopex ├ęs Strawberry, ├ędes ├şzvil├íg├║ term├ękek els┼Ĺsorban a hideg v├şzben id┼Ĺszakokban ├ítt├Âr├ęst a kap├ístalan id┼Ĺszakokban, a Squid & Octopus pedig klasszikus pontyhorg├ísz ├şzes├şt├ęs, tulajdonsk├ęppen 4 ├ęvszakos csalogat├│anyag.','sbs_pva_bag_pellet_mix_01_13_23_02_45_17.jpg',1490,50,1,500,2980,'2-6','tintahal ├ęs polip','barna ├ęs s├írga','halliszt, zsemlemorzsa, ├ętelarom├ík, v├şz, olaj, s├│, adal├ękanyag ├ęs ├ętelsz├şnez├ęk','pellet','ponty ├ęs amur',0,'2023-01-13 13:45:17','0000-00-00'),(17,'BroBaits Sweety Buddies','A BroBaits Sweety Buddies egy olyan term├ękcsal├íd, amely alapanyag├íul a m├ęlt├ín h├şres Aqua Garant ├ęs Coppens pelletek szolg├íltak, de ezek k├Âz├Âtt is m├ír olyan sok v├íltozat van, ├ęs annyi f├ęlek├ęppen lehet keverni, hogy ember legyen a talp├ín, aki el tud ezen igazodni ├ęs ki tudja v├ílasztani az adott ├ęvszakban legeredm├ęnyesebb kever├ęket. Az a dolgunk, hogy ebben is seg├şts├╝nk ├ęs a legfog├│sabb, sz├ímunkra leghat├ękonyabb kever├ękeket adjuk a horg├íszok kez├ębe. Van ezek k├Âz├Âtt ÔÇ×titkos\" versenykever├ęk is!\r\nElk├ęsz├şt├ęse egyszer┼▒, mind├Âssze a megfelel┼Ĺ mennyis├ęg┼▒ vizet kell hozz├ítenni, majd ├Âsszer├ízni, ├ęs n├ęh├íny perc m├║lva m├ír t├Âlthet┼Ĺ is a method kos├írba. Minden v├íltozat nat├║r, aromamentes. Ezeket term├ęszetesen a halak ├şzl├ęs├ęhez igazodva lehet ├şzes├şteni, arom├ís├ştani! A jelenleg l├íthat├│ term├ęk├╝nk csokol├íd├ę ├ęs narancs ├şzes├şt├ęsben kaphat├│!','brobaits_sweety_buddies_01_13_23_02_48_38.jpg',2500,50,1,500,5000,'2-6','csokol├íd├ę ├ęs narancs','narancss├írga ├ęs s├Ât├ętbarna','halliszt, betain, csokol├íd├ę- ├ęs narancsaroma, s├│, olaj, tart├│s├şt├│szerek','pellet','ponty ├ęs amur',0,'2023-01-13 13:48:38','0000-00-00'),(50,'sadadad','m├│dos','sadadad_01_15_23_02_29_50.jpg',400,4000000,1,12,4000,'k├Âzepes m├ęret┼▒','12','12','asdadada','feed','12',5000,'2023-01-15 14:23:32','0000-00-00');
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

-- Dump completed on 2023-01-15 18:38:28

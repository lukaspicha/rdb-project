# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: bus_traveling
# Generation Time: 2019-04-21 09:57:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Autobus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Autobus`;

CREATE TABLE `Autobus` (
  `spz` varchar(10) NOT NULL,
  `znacka` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`spz`),
  KEY `znacka` (`znacka`),
  CONSTRAINT `autobus_ibfk_1` FOREIGN KEY (`znacka`) REFERENCES `Znacka` (`znacka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Autobus` WRITE;
/*!40000 ALTER TABLE `Autobus` DISABLE KEYS */;

INSERT INTO `Autobus` (`spz`, `znacka`)
VALUES
	('0C12340','Iveco'),
	('0G82326','Iveco'),
	('0Y72632','Iveco'),
	('3G74343','Iveco'),
	('5K10826','Iveco'),
	('7R28914','Iveco'),
	('1T37457','Karosa'),
	('5G50874','Karosa'),
	('6G79360','Karosa'),
	('6I83996','Karosa'),
	('6K35477','Karosa'),
	('6W99406','Karosa'),
	('8L33628','Karosa'),
	('8O07265','Karosa'),
	('8X33723','Karosa'),
	('0I71063','MAN'),
	('0K23942','MAN'),
	('2P91040','MAN'),
	('2V38692','MAN'),
	('6U51900','MAN'),
	('7U95952','MAN'),
	('7Z37463','MAN'),
	('9F32409','MAN'),
	('9W14100','MAN'),
	('1J87027','TEDOM'),
	('5V38715','TEDOM'),
	('7E00139','TEDOM'),
	('8E54353','TEDOM'),
	('0L33689','Volvo'),
	('2Q34441','Volvo'),
	('5C23261','Volvo'),
	('5U04067','Volvo'),
	('7L12054','Volvo'),
	('9P10328','Volvo');

/*!40000 ALTER TABLE `Autobus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Jizda
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Jizda`;

CREATE TABLE `Jizda` (
  `linka` varchar(50) NOT NULL,
  `spz` varchar(10) DEFAULT NULL,
  `cislo_rp` varchar(50) DEFAULT NULL,
  `cas` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`linka`,`cas`),
  KEY `spz` (`spz`),
  KEY `cislo_rp` (`cislo_rp`),
  CONSTRAINT `jizda_ibfk_2` FOREIGN KEY (`spz`) REFERENCES `Autobus` (`spz`),
  CONSTRAINT `jizda_ibfk_3` FOREIGN KEY (`cislo_rp`) REFERENCES `Ridic` (`cislo_rp`),
  CONSTRAINT `jizda_ibfk_4` FOREIGN KEY (`linka`) REFERENCES `Trasy` (`linka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Jizda` WRITE;
/*!40000 ALTER TABLE `Jizda` DISABLE KEYS */;

INSERT INTO `Jizda` (`linka`, `spz`, `cislo_rp`, `cas`)
VALUES
	('51T1i','6I83996','QG2664','2019-04-14 19:44:29'),
	('51T1i','3G74343','TH2458','2019-04-16 19:18:18'),
	('9zC1y','7Z37463','ZA8842','2019-04-15 05:39:22'),
	('9zC1y','9F32409','SR9966','2019-04-18 17:46:51'),
	('AbBFq','7L12054','EQ2218','2019-04-18 09:19:33'),
	('aG2ci','5K10826','ZA8842','2019-04-16 03:08:56'),
	('aG2ci','8E54353','QE1871','2019-04-17 18:48:19'),
	('CyJmX','5U04067','WR9345','2019-04-18 00:42:00'),
	('DimXk','0K23942','KO6256','2019-04-16 11:28:11'),
	('DimXk','5C23261','SR9966','2019-04-19 04:01:36'),
	('DqIKJ','2V38692','WR9345','2019-04-19 03:12:13'),
	('DqIKJ','1T37457','SR9966','2019-04-20 18:55:47'),
	('DqIKJ','1J87027','ZK6201','2019-04-21 11:38:37'),
	('DZtix','7L12054','ZA8842','2019-04-16 19:35:07'),
	('hrCFf','9W14100','NU6378','2019-04-15 04:00:09'),
	('kEzzl','2Q34441','QS1113','2019-04-17 12:04:56'),
	('lOuNA','7L12054','NU6378','2019-04-21 08:27:24'),
	('QMbCQ','2V38692','HV3806','2019-04-19 20:37:01'),
	('QMbCQ','5V38715','QE6905','2019-04-19 23:31:30'),
	('QMbCQ','7L12054','EP5838','2019-04-20 00:35:03'),
	('qYlIA','0Y72632','WF7605','2019-04-15 02:13:12'),
	('TAg5I','7E00139','QS1113','2019-04-20 06:58:39'),
	('TJffU','6K35477','WR9345','2019-04-15 20:33:46'),
	('TssN3','6W99406','ZA8842','2019-04-16 00:18:57'),
	('vhaSD','7E00139','ZK6201','2019-04-18 03:59:37'),
	('Wq8mN','5V38715','ES1498','2019-04-15 13:25:44'),
	('Wq8mN','5C23261','QS1113','2019-04-17 11:35:44'),
	('y77Bg','2V38692','KO6256','2019-04-18 02:18:24'),
	('yuLEV','8L33628','KO6256','2019-04-15 22:14:01'),
	('zBvmk','7R28914','TH9111','2019-04-17 12:11:26');

/*!40000 ALTER TABLE `Jizda` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Jizdenka
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Jizdenka`;

CREATE TABLE `Jizdenka` (
  `cislo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cas` timestamp NULL DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `linka` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cislo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Klient
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Klient`;

CREATE TABLE `Klient` (
  `email` varchar(50) NOT NULL,
  `jmeno` varchar(50) NOT NULL DEFAULT '',
  `prijmeni` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Kontakt
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Kontakt`;

CREATE TABLE `Kontakt` (
  `hodnota` varchar(50) NOT NULL DEFAULT '',
  `cislo_rp` varchar(50) NOT NULL DEFAULT '',
  `typ` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`hodnota`),
  KEY `typ` (`typ`),
  KEY `cislo_rp` (`cislo_rp`),
  CONSTRAINT `kontakt_ibfk_1` FOREIGN KEY (`typ`) REFERENCES `TypKontaktu` (`typ`),
  CONSTRAINT `kontakt_ibfk_2` FOREIGN KEY (`cislo_rp`) REFERENCES `Ridic` (`cislo_rp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Kontakt` WRITE;
/*!40000 ALTER TABLE `Kontakt` DISABLE KEYS */;

INSERT INTO `Kontakt` (`hodnota`, `cislo_rp`, `typ`)
VALUES
	('+1292365672174','QE6905','telefon'),
	('+1603559135848','WF7605','telefon'),
	('+1991635560487','TS3818','telefon'),
	('+2281460435833','EQ2218','telefon'),
	('+3282248519274','QS1113','telefon'),
	('+3307815673110','GF6508','telefon'),
	('+3887233562063','QE1871','telefon'),
	('+4141162510372','EU1441','telefon'),
	('+4358685648342','YM3113','telefon'),
	('+4427971342348','WR9345','telefon'),
	('+4980030933476','ES1498','telefon'),
	('+5518367710363','NU6378','telefon'),
	('+5627829298318','MV0580','telefon'),
	('+6190378666941','KO6256','telefon'),
	('+6974840976900','QG2664','telefon'),
	('+7118379246797','HV3806','telefon'),
	('+7184950982676','TH9111','telefon'),
	('+7390823418726','ZA8842','telefon'),
	('+7593442194370','AU6240','telefon'),
	('+7791484049760','VC4771','telefon'),
	('+7870065505724','YZ7647','telefon'),
	('+8281314800428','SR9966','telefon'),
	('+8435060798691','TH2458','telefon'),
	('+8558284684736','ZK6201','telefon'),
	('+9183606501687','EP5838','telefon'),
	('+9228950294135','XM0601','telefon'),
	('+9402738388198','PR0713','telefon'),
	('+9568480509833','YW1022','telefon'),
	('+9623239706598','TG4717','telefon'),
	('+9760166624758','RX2788','telefon'),
	('ales.sir@vasak.net','WR9345','email'),
	('bpospichal@email.cz','HV3806','email'),
	('capkova.kamila@moudra.net','GF6508','email'),
	('csuchomelova@seznam.cz','WF7605','email'),
	('david.stefanova@konicek.cz','TS3818','email'),
	('ealbrecht@yahoo.com','ZA8842','email'),
	('frantisek.stejskalova@jelinkova.com','ES1498','email'),
	('hartmanova.milena@yahoo.com','TH2458','email'),
	('ivana93@kulhava.com','TG4717','email'),
	('jan64@email.cz','NU6378','email'),
	('jindrich57@andelova.cz','MV0580','email'),
	('jitka.sevcik@holeckova.cz','YZ7647','email'),
	('krystof.bartosek@kubelka.com','XM0601','email'),
	('ksamek@post.cz','QG2664','email'),
	('kulhava.lukas@yahoo.com','QE6905','email'),
	('ladislav.matejickova@ondrackova.net','AU6240','email'),
	('ludvik40@gmail.com','TH9111','email'),
	('martina50@seznam.cz','PR0713','email'),
	('matej97@post.cz','RX2788','email'),
	('mbecvar@strejckova.org','QE1871','email'),
	('miroslav19@vlachova.cz','YM3113','email'),
	('nela.taborsky@kopriva.cz','YW1022','email'),
	('petra38@yahoo.com','EU1441','email'),
	('radim72@email.cz','KO6256','email'),
	('radim84@centrum.cz','EQ2218','email'),
	('rene.smetana@wolfova.cz','QS1113','email'),
	('rudolf.skacelova@adamkova.info','VC4771','email'),
	('smolova.dominik@kotrbova.cz','SR9966','email'),
	('vojtech10@seznam.cz','EP5838','email'),
	('zhavlicek@atlas.cz','ZK6201','email');

/*!40000 ALTER TABLE `Kontakt` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Lokalita
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Lokalita`;

CREATE TABLE `Lokalita` (
  `nazev` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`nazev`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Lokalita` WRITE;
/*!40000 ALTER TABLE `Lokalita` DISABLE KEYS */;

INSERT INTO `Lokalita` (`nazev`)
VALUES
	('Brno'),
	('Černošice'),
	('České Budějovice'),
	('Chomutov'),
	('Děčín'),
	('Frýdek-Místek'),
	('Hodonín'),
	('Jablonec nad Nisou'),
	('Krnov'),
	('Litoměřice'),
	('Most'),
	('Olomouc'),
	('Pardubice'),
	('Plzeň'),
	('Přerov'),
	('Sokolov'),
	('Teplice'),
	('Třebíč'),
	('Trutnov'),
	('Uherské Hradiště'),
	('Ústí nad Labem');

/*!40000 ALTER TABLE `Lokalita` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Mezizastavka
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Mezizastavka`;

CREATE TABLE `Mezizastavka` (
  `nazev` varchar(50) NOT NULL,
  `linka` varchar(50) NOT NULL,
  PRIMARY KEY (`nazev`,`linka`),
  KEY `linka` (`linka`),
  CONSTRAINT `mezizastavka_ibfk_1` FOREIGN KEY (`nazev`) REFERENCES `Lokalita` (`nazev`),
  CONSTRAINT `mezizastavka_ibfk_2` FOREIGN KEY (`linka`) REFERENCES `Trasy` (`linka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Mezizastavka` WRITE;
/*!40000 ALTER TABLE `Mezizastavka` DISABLE KEYS */;

INSERT INTO `Mezizastavka` (`nazev`, `linka`)
VALUES
	('Frýdek-Místek','1mxzi'),
	('Ústí nad Labem','1mxzi'),
	('Krnov','51T1i'),
	('Teplice','51T1i'),
	('Trutnov','51T1i'),
	('Černošice','5kU2J'),
	('Hodonín','5kU2J'),
	('Brno','5X59e'),
	('Černošice','5X59e'),
	('Hodonín','5X59e'),
	('Jablonec nad Nisou','5X59e'),
	('Most','5X59e'),
	('Plzeň','5X59e'),
	('Sokolov','5X59e'),
	('Trutnov','5X59e'),
	('Uherské Hradiště','5X59e'),
	('Černošice','6uBjr'),
	('Děčín','7SW35'),
	('Litoměřice','7SW35'),
	('Třebíč','7SW35'),
	('Trutnov','7SW35'),
	('Brno','9zC1y'),
	('Plzeň','9zC1y'),
	('Trutnov','9zC1y'),
	('Ústí nad Labem','9zC1y'),
	('Sokolov','AbBFq'),
	('Chomutov','aG2ci'),
	('Jablonec nad Nisou','aG2ci'),
	('Krnov','aG2ci'),
	('Litoměřice','aG2ci'),
	('Pardubice','aG2ci'),
	('Černošice','CyJmX'),
	('Hodonín','CyJmX'),
	('Most','CyJmX'),
	('Teplice','CyJmX'),
	('Brno','DimXk'),
	('Černošice','DimXk'),
	('České Budějovice','DimXk'),
	('Pardubice','DimXk'),
	('Plzeň','DimXk'),
	('Přerov','DimXk'),
	('Trutnov','DimXk'),
	('Děčín','DqIKJ'),
	('Frýdek-Místek','DqIKJ'),
	('Litoměřice','DqIKJ'),
	('Olomouc','DqIKJ'),
	('Teplice','DqIKJ'),
	('Třebíč','DqIKJ'),
	('Teplice','DZtix'),
	('Brno','EwlhL'),
	('České Budějovice','EwlhL'),
	('Děčín','EwlhL'),
	('Jablonec nad Nisou','EwlhL'),
	('Litoměřice','EwlhL'),
	('Olomouc','EwlhL'),
	('Chomutov','Hl86o'),
	('Hodonín','Hl86o'),
	('Jablonec nad Nisou','Hl86o'),
	('Most','Hl86o'),
	('Olomouc','Hl86o'),
	('Pardubice','Hl86o'),
	('Děčín','hrCFf'),
	('Krnov','hrCFf'),
	('Litoměřice','hrCFf'),
	('Pardubice','hrCFf'),
	('Trutnov','hrCFf'),
	('Ústí nad Labem','hrCFf'),
	('Černošice','IIJaF'),
	('Plzeň','IIJaF'),
	('Trutnov','IIJaF'),
	('Ústí nad Labem','IIJaF'),
	('Černošice','kEzzl'),
	('České Budějovice','kEzzl'),
	('Frýdek-Místek','kEzzl'),
	('Hodonín','kEzzl'),
	('Jablonec nad Nisou','kEzzl'),
	('Olomouc','lOuNA'),
	('Ústí nad Labem','lOuNA'),
	('Brno','QMbCQ'),
	('Jablonec nad Nisou','QMbCQ'),
	('Přerov','QMbCQ'),
	('Chomutov','qYlIA'),
	('Frýdek-Místek','qYlIA'),
	('Jablonec nad Nisou','qYlIA'),
	('Krnov','qYlIA'),
	('Litoměřice','qYlIA'),
	('Pardubice','qYlIA'),
	('Plzeň','qYlIA'),
	('Třebíč','qYlIA'),
	('Uherské Hradiště','qYlIA'),
	('České Budějovice','TAg5I'),
	('Chomutov','TAg5I'),
	('Hodonín','TAg5I'),
	('Litoměřice','TAg5I'),
	('Most','TAg5I'),
	('Třebíč','TAg5I'),
	('Ústí nad Labem','TAg5I'),
	('Chomutov','TJffU'),
	('Jablonec nad Nisou','TJffU'),
	('Most','TJffU'),
	('Pardubice','TJffU'),
	('Uherské Hradiště','TJffU'),
	('Brno','TssN3'),
	('Chomutov','TssN3'),
	('Olomouc','TssN3'),
	('Plzeň','TssN3'),
	('České Budějovice','vhaSD'),
	('Přerov','vhaSD'),
	('Teplice','vhaSD'),
	('Trutnov','vhaSD'),
	('Uherské Hradiště','vhaSD'),
	('Černošice','Wq8mN'),
	('Děčín','Wq8mN'),
	('Most','Wq8mN'),
	('Pardubice','Wq8mN'),
	('Přerov','Wq8mN'),
	('Brno','y77Bg'),
	('České Budějovice','y77Bg'),
	('Frýdek-Místek','yuLEV'),
	('Jablonec nad Nisou','yuLEV'),
	('Most','yuLEV'),
	('Přerov','yuLEV'),
	('Třebíč','yuLEV'),
	('Brno','zBvmk'),
	('České Budějovice','zBvmk'),
	('Chomutov','zBvmk'),
	('Hodonín','zBvmk'),
	('Pardubice','zBvmk'),
	('Třebíč','zBvmk'),
	('Uherské Hradiště','zBvmk'),
	('Krnov','zQQWs'),
	('Olomouc','zQQWs'),
	('Pardubice','zQQWs'),
	('Plzeň','zQQWs'),
	('Ústí nad Labem','zQQWs');

/*!40000 ALTER TABLE `Mezizastavka` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Ridic
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Ridic`;

CREATE TABLE `Ridic` (
  `cislo_rp` varchar(50) NOT NULL DEFAULT '',
  `jmeno` varchar(50) NOT NULL DEFAULT '',
  `prijmeni` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cislo_rp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Ridic` WRITE;
/*!40000 ALTER TABLE `Ridic` DISABLE KEYS */;

INSERT INTO `Ridic` (`cislo_rp`, `jmeno`, `prijmeni`)
VALUES
	('AU6240','Pavel','Heger'),
	('EP5838','Štefan','Michal'),
	('EQ2218','Vít','Dvořák'),
	('ES1498','Milan','Buček'),
	('EU1441','Jaroslav','Matyáš'),
	('GF6508','Matyáš','Hrdlička'),
	('HV3806','Emil','Jelen'),
	('KO6256','Radek','Krupka'),
	('MV0580','Štefan','Kupec'),
	('NU6378','Zdeněk','Pecha'),
	('PR0713','Aleš','Smutný'),
	('QE1871','Petr','Tureček'),
	('QE6905','Daniel','Lorenc'),
	('QG2664','Dalibor','Hanzal'),
	('QS1113','Matěj','Smetana'),
	('RX2788','Miloš','Václavek'),
	('SR9966','Radim','Steiner'),
	('TG4717','Vojtěch','Sojka'),
	('TH2458','Dalibor','Novosad'),
	('TH9111','Václav','Bajer'),
	('TS3818','Radim','Formánek'),
	('VC4771','Miloš','Hájek'),
	('WF7605','Miloslav','Sokol'),
	('WR9345','Rudolf','Kalous'),
	('XM0601','Bohumil','Franc'),
	('YM3113','Matěj','Jurčík'),
	('YW1022','Robert','Řezáč'),
	('YZ7647','Marcel','Kováč'),
	('ZA8842','Kryštof','Motyčka'),
	('ZK6201','Patrik','Matuška');

/*!40000 ALTER TABLE `Ridic` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Trasy
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Trasy`;

CREATE TABLE `Trasy` (
  `linka` varchar(50) NOT NULL,
  `odkud` varchar(50) DEFAULT NULL,
  `kam` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`linka`),
  KEY `odkud` (`odkud`),
  KEY `kam` (`kam`),
  CONSTRAINT `trasy_ibfk_1` FOREIGN KEY (`odkud`) REFERENCES `Lokalita` (`nazev`),
  CONSTRAINT `trasy_ibfk_2` FOREIGN KEY (`kam`) REFERENCES `Lokalita` (`nazev`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Trasy` WRITE;
/*!40000 ALTER TABLE `Trasy` DISABLE KEYS */;

INSERT INTO `Trasy` (`linka`, `odkud`, `kam`)
VALUES
	('1mxzi','České Budějovice','Černošice'),
	('51T1i','Třebíč','Přerov'),
	('5kU2J','Přerov','Most'),
	('5X59e','Děčín','Přerov'),
	('6uBjr','Ústí nad Labem','Děčín'),
	('7SW35','Uherské Hradiště','Krnov'),
	('9zC1y','Most','Černošice'),
	('AbBFq','Třebíč','Jablonec nad Nisou'),
	('aG2ci','České Budějovice','Olomouc'),
	('CyJmX','Litoměřice','Ústí nad Labem'),
	('DimXk','Třebíč','Děčín'),
	('DqIKJ','Hodonín','Most'),
	('DZtix','Uherské Hradiště','Děčín'),
	('EwlhL','Chomutov','Teplice'),
	('Hl86o','Uherské Hradiště','Litoměřice'),
	('hrCFf','Olomouc','Třebíč'),
	('IIJaF','Litoměřice','České Budějovice'),
	('kEzzl','Uherské Hradiště','Most'),
	('lOuNA','Chomutov','Uherské Hradiště'),
	('QMbCQ','Hodonín','Krnov'),
	('qYlIA','Trutnov','Děčín'),
	('TAg5I','Krnov','Děčín'),
	('TJffU','Ústí nad Labem','Plzeň'),
	('TssN3','Jablonec nad Nisou','Teplice'),
	('vhaSD','Jablonec nad Nisou','Hodonín'),
	('Wq8mN','Jablonec nad Nisou','Ústí nad Labem'),
	('y77Bg','Litoměřice','Černošice'),
	('yuLEV','Plzeň','Olomouc'),
	('zBvmk','Jablonec nad Nisou','Frýdek-Místek'),
	('zQQWs','Přerov','Třebíč');

/*!40000 ALTER TABLE `Trasy` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table TypKontaktu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `TypKontaktu`;

CREATE TABLE `TypKontaktu` (
  `typ` varchar(50) NOT NULL,
  PRIMARY KEY (`typ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `TypKontaktu` WRITE;
/*!40000 ALTER TABLE `TypKontaktu` DISABLE KEYS */;

INSERT INTO `TypKontaktu` (`typ`)
VALUES
	('email'),
	('telefon');

/*!40000 ALTER TABLE `TypKontaktu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Znacka
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Znacka`;

CREATE TABLE `Znacka` (
  `znacka` varchar(50) NOT NULL,
  PRIMARY KEY (`znacka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Znacka` WRITE;
/*!40000 ALTER TABLE `Znacka` DISABLE KEYS */;

INSERT INTO `Znacka` (`znacka`)
VALUES
	('Iveco'),
	('Karosa'),
	('MAN'),
	('TEDOM'),
	('Volvo');

/*!40000 ALTER TABLE `Znacka` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

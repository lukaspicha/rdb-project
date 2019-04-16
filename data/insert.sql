# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: bus_traveling
# Generation Time: 2019-04-16 13:15:14 +0000
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

LOCK TABLES `Autobus` WRITE;
/*!40000 ALTER TABLE `Autobus` DISABLE KEYS */;

INSERT INTO `Autobus` (`spz`, `znacka`)
VALUES
	('3L48439','Karosa'),
	('5L23104','MAN');

/*!40000 ALTER TABLE `Autobus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Jizda
# ------------------------------------------------------------



# Dump of table Jizdenka
# ------------------------------------------------------------



# Dump of table Klient
# ------------------------------------------------------------

LOCK TABLES `Klient` WRITE;
/*!40000 ALTER TABLE `Klient` DISABLE KEYS */;

INSERT INTO `Klient` (`email`, `jmeno`, `prijmeni`)
VALUES
	('lukas@picha.cz','Lukáš','Pícha'),
	('tomas@kosek.cz','Tomáš','Košek');

/*!40000 ALTER TABLE `Klient` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Kontakt
# ------------------------------------------------------------

LOCK TABLES `Kontakt` WRITE;
/*!40000 ALTER TABLE `Kontakt` DISABLE KEYS */;

INSERT INTO `Kontakt` (`hodnota`, `cislo_rp`, `typ`)
VALUES
	('777000777','1','telefon'),
	('lukas@picha.cz','2','email'),
	('tomas@autobus.cz','1','email'),
	('tomas@kosek.cz','1','email');

/*!40000 ALTER TABLE `Kontakt` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Lokalita
# ------------------------------------------------------------

LOCK TABLES `Lokalita` WRITE;
/*!40000 ALTER TABLE `Lokalita` DISABLE KEYS */;

INSERT INTO `Lokalita` (`nazev`)
VALUES
	('Brno'),
	('Hradec Králové'),
	('Jablonec nad Nisou'),
	('Liberec'),
	('Mladá Boleslav'),
	('Praha'),
	('Vídeň'),
	('Znojmo');

/*!40000 ALTER TABLE `Lokalita` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Mezizastavka
# ------------------------------------------------------------



# Dump of table Ridic
# ------------------------------------------------------------

LOCK TABLES `Ridic` WRITE;
/*!40000 ALTER TABLE `Ridic` DISABLE KEYS */;

INSERT INTO `Ridic` (`cislo_rp`, `jmeno`, `prijmeni`)
VALUES
	('1','Tomáš','Košek'),
	('2','Lukáš','Pícha');

/*!40000 ALTER TABLE `Ridic` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Trasy
# ------------------------------------------------------------

LOCK TABLES `Trasy` WRITE;
/*!40000 ALTER TABLE `Trasy` DISABLE KEYS */;

INSERT INTO `Trasy` (`linka`, `odkud`, `kam`)
VALUES
	('1','Jablonec nad Nisou','Liberec'),
	('2','Jablonec nad Nisou','Praha');

/*!40000 ALTER TABLE `Trasy` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table TypKontaktu
# ------------------------------------------------------------

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

# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: bus_traveling
# Generation Time: 2019-04-16 13:14:45 +0000
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



# Dump of table Jizdenka
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Jizdenka`;

CREATE TABLE `Jizdenka` (
  `linka` varchar(50) NOT NULL DEFAULT '',
  `cas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(50) DEFAULT '',
  `cislo` int(11) NOT NULL,
  PRIMARY KEY (`cislo`),
  KEY `linka` (`linka`),
  KEY `email` (`email`),
  CONSTRAINT `jizdenka_ibfk_1` FOREIGN KEY (`linka`) REFERENCES `Jizda` (`linka`),
  CONSTRAINT `jizdenka_ibfk_2` FOREIGN KEY (`email`) REFERENCES `Klient` (`email`)
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



# Dump of table Lokalita
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Lokalita`;

CREATE TABLE `Lokalita` (
  `nazev` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`nazev`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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



# Dump of table Ridic
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Ridic`;

CREATE TABLE `Ridic` (
  `cislo_rp` varchar(50) NOT NULL DEFAULT '',
  `jmeno` varchar(50) NOT NULL DEFAULT '',
  `prijmeni` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cislo_rp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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



# Dump of table TypKontaktu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `TypKontaktu`;

CREATE TABLE `TypKontaktu` (
  `typ` varchar(50) NOT NULL,
  PRIMARY KEY (`typ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Znacka
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Znacka`;

CREATE TABLE `Znacka` (
  `znacka` varchar(50) NOT NULL,
  PRIMARY KEY (`znacka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

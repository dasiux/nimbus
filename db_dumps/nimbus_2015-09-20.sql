# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.44-0ubuntu0.14.04.1)
# Datenbank: dbname
# Erstellungsdauer: 2015-09-20 19:30:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle ultrafail_nimbus_objects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ultrafail_nimbus_objects`;

CREATE TABLE `ultrafail_nimbus_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(128) NOT NULL,
  `location_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`id`,`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ultrafail_nimbus_objects` WRITE;
/*!40000 ALTER TABLE `ultrafail_nimbus_objects` DISABLE KEYS */;

INSERT INTO `ultrafail_nimbus_objects` (`id`, `parent_id`, `type`, `location_id`)
VALUES
	(1,0,'ultrafail_nimbus_universe_universe',0),
	(2,1,'ultrafail_nimbus_universe_player',0),
	(3,2,'ultrafail_nimbus_universe_planet',1);

/*!40000 ALTER TABLE `ultrafail_nimbus_objects` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle ultrafail_nimbus_universe_planet
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ultrafail_nimbus_universe_planet`;

CREATE TABLE `ultrafail_nimbus_universe_planet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `fields` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ultrafail_nimbus_universe_planet` WRITE;
/*!40000 ALTER TABLE `ultrafail_nimbus_universe_planet` DISABLE KEYS */;

INSERT INTO `ultrafail_nimbus_universe_planet` (`id`, `name`, `fields`)
VALUES
	(3,'Homeworld',2499);

/*!40000 ALTER TABLE `ultrafail_nimbus_universe_planet` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle ultrafail_nimbus_universe_player
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ultrafail_nimbus_universe_player`;

CREATE TABLE `ultrafail_nimbus_universe_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `faction_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `active_object_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ultrafail_nimbus_universe_player` WRITE;
/*!40000 ALTER TABLE `ultrafail_nimbus_universe_player` DISABLE KEYS */;

INSERT INTO `ultrafail_nimbus_universe_player` (`id`, `name`, `faction_id`, `score`, `active_object_id`)
VALUES
	(2,'siux',1,1337,0);

/*!40000 ALTER TABLE `ultrafail_nimbus_universe_player` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle ultrafail_nimbus_universe_universe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ultrafail_nimbus_universe_universe`;

CREATE TABLE `ultrafail_nimbus_universe_universe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ultrafail_nimbus_universe_universe` WRITE;
/*!40000 ALTER TABLE `ultrafail_nimbus_universe_universe` DISABLE KEYS */;

INSERT INTO `ultrafail_nimbus_universe_universe` (`id`, `name`)
VALUES
	(1,'Universe 01');

/*!40000 ALTER TABLE `ultrafail_nimbus_universe_universe` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

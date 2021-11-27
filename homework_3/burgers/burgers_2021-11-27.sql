# ************************************************************
# Sequel Ace SQL dump
# Версия 20016
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Хост: localhost (MySQL 5.7.34)
# База данных: burgers
# Generation Time: 2021-11-27 17:30:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `street` varchar(200) NOT NULL,
  `home` int(11) NOT NULL,
  `frame` int(11) NOT NULL,
  `apartment` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `comment` text NOT NULL,
  `payment_method` tinyint(1) NOT NULL,
  `no_recall` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`id`, `user_id`, `date`, `street`, `home`, `frame`, `apartment`, `floor`, `comment`, `payment_method`, `no_recall`)
VALUES
	(1,0,'2021-11-25 19:59:48','',0,0,0,0,'',0,0),
	(2,0,'2021-11-25 19:59:49','',0,0,0,0,'',0,0),
	(3,0,'2021-11-25 20:02:06','',0,0,0,0,'',0,0),
	(4,0,'2021-11-25 20:02:08','',0,0,0,0,'',0,0),
	(5,0,'2021-11-25 20:02:26','',0,0,0,0,'',0,0),
	(6,0,'2021-11-25 20:02:28','',0,0,0,0,'',0,0),
	(7,0,'2021-11-25 20:02:35','',0,0,0,0,'',0,0),
	(8,0,'2021-11-25 20:05:17','',0,0,0,0,'',0,0),
	(9,0,'2021-11-25 20:05:18','',0,0,0,0,'',0,0),
	(10,0,'2021-11-25 20:05:34','',0,0,0,0,'',0,0),
	(11,0,'2021-11-25 20:05:52','',0,0,0,0,'',0,0),
	(12,0,'2021-11-25 20:06:44','',0,0,0,0,'',0,0),
	(13,0,'2021-11-25 20:06:54','',0,0,0,0,'',0,0),
	(14,0,'2021-11-25 20:07:04','',0,0,0,0,'',0,0),
	(15,4,'2021-11-25 20:20:36','Свердлова',1,2,3,4,'Коммент',2,1),
	(16,4,'2021-11-25 20:21:10','Свердлова',1,2,3,4,'Коммент',2,1),
	(17,4,'2021-11-25 20:21:18','Свердлова',1,2,3,4,'Коммент',2,1),
	(18,4,'2021-11-25 20:21:20','Свердлова',1,2,3,4,'Коммент',2,1);

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `phone`)
VALUES
	(1,'Andrey','info@fmeow','dwidew'),
	(2,'Andrey','g68g78shdqwe','+7 (980) 809 80 98'),
	(3,'Andrey','jdihwdewdew','+7 (980) 809 80 98'),
	(4,'Andrey','smorodin-2@yandex.ru','+7 (980) 809 80 98');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

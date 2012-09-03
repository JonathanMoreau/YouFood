-- MySQL dump 10.13  Distrib 5.1.40, for apple-darwin9.5.0 (i386)
--
-- Host: localhost    Database: youfood
-- ------------------------------------------------------
-- Server version	5.1.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Board`
--

DROP TABLE IF EXISTS `Board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) DEFAULT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_999704439F2C3FAB` (`zone_id`),
  CONSTRAINT `FK_999704439F2C3FAB` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Board`
--

LOCK TABLES `Board` WRITE;
/*!40000 ALTER TABLE `Board` DISABLE KEYS */;
INSERT INTO `Board` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,2,5),(6,2,6),(7,3,7),(8,3,8);
/*!40000 ALTER TABLE `Board` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Jonathan Moreau',1),(2,'Sébastien Rabiet',1),(3,'Nicolas Dorigo',2);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Zone`
--

DROP TABLE IF EXISTS `Zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D96F39A76ED395` (`user_id`),
  CONSTRAINT `FK_D96F39A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Zone`
--

LOCK TABLES `Zone` WRITE;
/*!40000 ALTER TABLE `Zone` DISABLE KEYS */;
INSERT INTO `Zone` VALUES (1,1,'A'),(2,2,'B'),(3,3,'C');
/*!40000 ALTER TABLE `Zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D43829F712469DE2` (`category_id`),
  CONSTRAINT `FK_D43829F712469DE2` FOREIGN KEY (`category_id`) REFERENCES `food_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES (1,1,'Quenelles de brochet André Terrail','bundles/youfoodroom/images/Quenelle-de-brochet.jpg'),(2,1,'Saumon chaufroité à la Parisienne','bundles/youfoodroom/images/saumon-parisienne.jpg'),(3,2,'Dos de cabillaud, cuisiné de cocos, tomates et persil','bundles/youfoodroom/images/dos-cabillaud.jpg'),(4,2,'Millefeuille d\'agneau confit, tomates et aubergines','bundles/youfoodroom/images/millefeuille.jpg'),(5,3,'Tartelette chocolat café','bundles/youfoodroom/images/tartelette.jpg'),(6,1,'Foie gras d\'oie des Trois Empereurs, brioche au beurre salé','bundles/youfoodroom/images/foie-gras.jpg'),(7,1,'Bisque Café Anglais','bundles/youfoodroom/images/bisque.jpg'),(8,2,'Caneton de saison','bundles/youfoodroom/images/canneton.jpg'),(9,3,'Palet au miel de La Tour d\'Argent, fraises des bois, sorbet fromage blanc','bundles/youfoodroom/images/palet-miel.jpg'),(10,3,'Crêpes Belle Epoque','bundles/youfoodroom/images/crepe.jpg');
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_category`
--

DROP TABLE IF EXISTS `food_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_category`
--

LOCK TABLES `food_category` WRITE;
/*!40000 ALTER TABLE `food_category` DISABLE KEYS */;
INSERT INTO `food_category` VALUES (1,'Entrée'),(2,'Plat'),(3,'Désert');
/*!40000 ALTER TABLE `food_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `started` datetime DEFAULT NULL,
  `ended` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Tour d\'Or','Laissez-vous guider par ce menu qui surprendra vos papilles !','38.00','2012-06-13 14:04:00','2012-06-13 14:04:00',NULL,NULL),(2,'Tour Platine','Un menu d\'excellence à destination des papilles averties......','60.00','2012-06-13 14:28:00','2012-06-13 14:28:00',NULL,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_food`
--

DROP TABLE IF EXISTS `menu_food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_food` (
  `menu_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`food_id`),
  KEY `IDX_1C77D9B9CCD7E912` (`menu_id`),
  KEY `IDX_1C77D9B9BA8E87C4` (`food_id`),
  CONSTRAINT `FK_1C77D9B9BA8E87C4` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1C77D9B9CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_food`
--

LOCK TABLES `menu_food` WRITE;
/*!40000 ALTER TABLE `menu_food` DISABLE KEYS */;
INSERT INTO `menu_food` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(2,6),(2,7),(2,8),(2,9),(2,10);
/*!40000 ALTER TABLE `menu_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `youOrder`
--

DROP TABLE IF EXISTS `youOrder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `youOrder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payement` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `youOrder`
--

LOCK TABLES `youOrder` WRITE;
/*!40000 ALTER TABLE `youOrder` DISABLE KEYS */;
INSERT INTO `youOrder` VALUES (1,1,1,'326.00','2012-06-14 16:47:59','2012-06-14 16:47:59'),(2,1,1,'364.00','2012-06-14 16:48:12','2012-06-14 16:48:12'),(3,1,1,'364.00','2012-06-14 16:52:03','2012-06-14 16:52:03'),(4,1,1,'98.00','2012-06-14 16:52:24','2012-06-14 16:52:24'),(5,1,1,'98.00','2012-06-14 16:55:11','2012-06-14 16:55:11'),(6,1,1,'98.00','2012-06-15 11:05:15','2012-06-15 11:05:15');
/*!40000 ALTER TABLE `youOrder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `youOrderFood`
--

DROP TABLE IF EXISTS `youOrderFood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `youOrderFood` (
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `youOrder_id` int(11) NOT NULL,
  PRIMARY KEY (`youOrder_id`,`food_id`),
  KEY `IDX_FB8177665FBD4FA` (`youOrder_id`),
  KEY `IDX_FB81776BA8E87C4` (`food_id`),
  CONSTRAINT `FK_FB8177665FBD4FA` FOREIGN KEY (`youOrder_id`) REFERENCES `youorder` (`id`),
  CONSTRAINT `FK_FB81776BA8E87C4` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `youOrderFood`
--

LOCK TABLES `youOrderFood` WRITE;
/*!40000 ALTER TABLE `youOrderFood` DISABLE KEYS */;
INSERT INTO `youOrderFood` VALUES (1,3,1),(6,4,1),(8,1,1),(10,1,1),(1,4,2),(2,1,2),(6,4,2),(8,1,2),(10,1,2),(1,4,3),(2,1,3),(6,4,3),(8,1,3),(10,1,3),(1,1,4),(9,1,4),(1,1,5),(3,1,5),(5,1,5),(6,1,5),(8,1,5),(9,1,5),(1,1,6),(4,1,6),(6,1,6),(9,1,6);
/*!40000 ALTER TABLE `youOrderFood` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-15 13:15:58

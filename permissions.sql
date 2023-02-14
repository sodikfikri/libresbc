-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: libresbc
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL COMMENT '1. menu, 2. sub menu, 3. child',
  `is_create` int(11) DEFAULT 1 COMMENT '0. No, 1. Yes',
  `is_read` int(11) DEFAULT 1 COMMENT '0. No, 1. Yes',
  `is_update` int(11) DEFAULT 1 COMMENT '0. No, 1. Yes',
  `is_delete` int(11) DEFAULT 1 COMMENT '0. No, 1. Yes',
  `is_import` int(11) DEFAULT 1 COMMENT '0. No, 1. Yes',
  `is_export` int(11) DEFAULT 1 COMMENT '0. No, 1. Yes',
  `is_active` int(11) DEFAULT 1 COMMENT '0. inactive, 1. active',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,1,1,1,1,1,1,1,1,1,1,NULL,NULL),(2,1,2,1,1,1,1,1,1,1,1,NULL,NULL),(3,1,3,1,1,1,1,1,1,1,1,NULL,NULL),(4,1,4,1,1,1,1,1,1,1,1,NULL,NULL),(5,1,1,2,1,1,1,1,1,1,1,NULL,NULL),(6,1,2,2,1,1,1,1,1,1,1,NULL,NULL),(7,1,3,2,1,1,1,1,1,1,1,NULL,NULL),(8,1,4,2,1,1,1,1,1,1,1,NULL,NULL),(9,1,5,2,1,1,1,1,1,1,1,NULL,NULL),(10,1,6,2,1,1,1,1,1,1,1,NULL,NULL),(11,1,7,2,1,1,1,1,1,1,1,NULL,NULL),(12,1,8,2,1,1,1,1,1,1,1,NULL,NULL),(13,1,9,2,1,1,1,1,1,1,1,NULL,NULL),(14,1,10,2,1,1,1,1,1,1,1,NULL,NULL),(15,1,1,3,1,1,1,1,1,1,1,NULL,NULL),(16,1,2,3,1,1,1,1,1,1,1,NULL,NULL),(17,1,3,3,1,1,1,1,1,1,1,NULL,NULL),(18,1,4,3,1,1,1,1,1,1,1,NULL,NULL),(19,1,5,3,1,1,1,1,1,1,1,NULL,NULL),(20,1,6,3,1,1,1,1,1,1,1,NULL,NULL),(21,1,7,3,1,1,1,1,1,1,1,NULL,NULL),(22,1,8,3,1,1,1,1,1,1,1,NULL,NULL),(23,1,9,3,1,1,1,1,1,1,1,NULL,NULL),(24,1,10,3,1,1,1,1,1,1,1,NULL,NULL),(25,1,11,3,1,1,1,1,1,1,1,NULL,NULL),(26,1,12,3,1,1,1,1,1,1,1,NULL,NULL),(27,1,13,3,1,1,1,1,1,1,1,NULL,NULL),(28,1,14,3,1,1,1,1,1,1,1,NULL,NULL),(29,1,15,3,1,1,1,1,1,1,1,NULL,NULL),(30,1,16,3,1,1,1,1,1,1,1,NULL,NULL),(31,1,17,3,1,1,1,1,1,1,1,NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-14 14:20:16

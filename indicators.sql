-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: indicators
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Temporary table structure for view `180_bubble_vw`
--

DROP TABLE IF EXISTS `180_bubble_vw`;
/*!50001 DROP VIEW IF EXISTS `180_bubble_vw`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `180_bubble_vw` AS SELECT 
 1 AS `num`,
 1 AS `geo`,
 1 AS `year`,
 1 AS `labor_force_percentage`,
 1 AS `uid`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `180_map_vw`
--

DROP TABLE IF EXISTS `180_map_vw`;
/*!50001 DROP VIEW IF EXISTS `180_map_vw`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `180_map_vw` AS SELECT 
 1 AS `num`,
 1 AS `geo`,
 1 AS `year`,
 1 AS `labor_force_percentage`,
 1 AS `uid`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_tokens`
--

DROP TABLE IF EXISTS `api_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api_tokens` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `transient` tinyint(4) NOT NULL DEFAULT '0',
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_tokens_token_unique` (`token`),
  KEY `api_tokens_user_id_expires_at_index` (`user_id`,`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_tokens`
--

LOCK TABLES `api_tokens` WRITE;
/*!40000 ALTER TABLE `api_tokens` DISABLE KEYS */;
INSERT INTO `api_tokens` VALUES ('bcd418ab-14df-4ee4-b6ab-70c9e2719d53',1,'Indicators','87UieAfgRWQjqyaEGwVgsMu6T2EBBMpeWipOJzAlVHfTvzpDywJXebtkJdxy','[]',0,NULL,NULL,'2018-06-06 18:31:11','2018-06-06 18:31:11');
/*!40000 ALTER TABLE `api_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_file`
--

DROP TABLE IF EXISTS `dataset_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataset_id` int(10) unsigned NOT NULL,
  `file_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dataset_id` (`dataset_id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_file`
--

LOCK TABLES `dataset_file` WRITE;
/*!40000 ALTER TABLE `dataset_file` DISABLE KEYS */;
INSERT INTO `dataset_file` VALUES (113,65,152),(142,67,151),(94,44,152),(127,70,154),(114,22,152),(128,66,154),(117,24,154),(116,23,151),(122,72,151),(123,25,151),(129,73,154),(133,75,151),(137,76,165),(153,78,150),(179,92,181),(163,93,166),(160,94,170),(157,95,165),(164,74,178),(167,98,178),(171,100,151),(186,103,178);
/*!40000 ALTER TABLE `dataset_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_file_old`
--

DROP TABLE IF EXISTS `dataset_file_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_file_old` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `dataset_id` int(10) unsigned DEFAULT NULL,
  `file_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_file_old`
--

LOCK TABLES `dataset_file_old` WRITE;
/*!40000 ALTER TABLE `dataset_file_old` DISABLE KEYS */;
INSERT INTO `dataset_file_old` VALUES (5,16,91),(14,13,96),(16,6,8),(20,9,11),(22,11,13),(25,14,18),(32,26,112),(34,28,114),(35,29,115),(39,33,119),(42,35,121),(43,36,122),(44,37,123),(46,39,93),(47,40,94),(48,41,95),(49,42,96),(55,46,100),(56,47,101),(71,38,92),(74,4,6),(82,48,102),(89,27,113),(94,32,118),(95,50,104),(96,10,12),(100,18,32),(107,53,35),(135,45,99),(143,23,109),(166,30,116),(171,44,98),(173,24,110),(187,21,107),(189,1,108),(190,17,110),(191,49,103),(205,62,17),(210,34,120),(211,51,105),(213,22,108),(222,25,111),(223,43,107),(231,20,142),(233,15,140),(236,31,142),(245,65,151),(246,67,151);
/*!40000 ALTER TABLE `dataset_file_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_governorate`
--

DROP TABLE IF EXISTS `dataset_governorate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_governorate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) NOT NULL,
  `governorate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_governorate`
--

LOCK TABLES `dataset_governorate` WRITE;
/*!40000 ALTER TABLE `dataset_governorate` DISABLE KEYS */;
INSERT INTO `dataset_governorate` VALUES (18,32,4),(19,32,7),(20,32,9),(21,50,8),(22,10,5),(23,10,1),(28,18,1),(46,53,6),(82,45,1),(87,7,5),(88,7,8),(147,30,28),(148,30,24),(229,1,2),(230,1,1),(231,17,4),(232,17,6),(233,49,22),(234,49,17),(245,34,20),(246,34,21),(247,51,3),(253,43,6),(254,43,30),(258,15,3),(259,15,9),(260,15,4),(276,44,31),(277,44,30),(278,44,29),(279,44,28),(280,44,27),(281,44,26),(282,44,25),(283,44,23),(284,44,24),(285,44,22),(286,44,21),(287,44,20),(288,44,19),(289,44,18),(290,44,17),(300,65,5),(301,24,28),(302,24,25),(303,24,26),(304,24,22),(305,24,30),(306,24,27),(307,24,21);
/*!40000 ALTER TABLE `dataset_governorate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_indicator`
--

DROP TABLE IF EXISTS `dataset_indicator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_indicator` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_indicator`
--

LOCK TABLES `dataset_indicator` WRITE;
/*!40000 ALTER TABLE `dataset_indicator` DISABLE KEYS */;
INSERT INTO `dataset_indicator` VALUES (15,30,9),(56,21,2),(57,21,1),(58,21,4),(59,17,3),(60,17,2),(61,17,4),(62,49,11),(75,62,1),(76,62,4),(77,62,2),(78,34,7),(79,51,12),(110,15,6),(111,15,4),(112,15,3),(119,31,3),(120,31,2),(121,31,4),(125,44,10),(126,44,7),(127,44,11),(132,65,1),(133,24,7),(134,24,11),(135,25,7),(136,25,10),(137,25,8);
/*!40000 ALTER TABLE `dataset_indicator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_period`
--

DROP TABLE IF EXISTS `dataset_period`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_period` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_period`
--

LOCK TABLES `dataset_period` WRITE;
/*!40000 ALTER TABLE `dataset_period` DISABLE KEYS */;
INSERT INTO `dataset_period` VALUES (10,30,6),(21,49,10),(35,62,3),(36,62,4),(37,62,1),(44,34,4),(45,51,8),(46,51,11),(49,43,8),(64,20,6),(65,20,5),(69,22,5),(71,23,4),(72,24,5),(73,24,10),(74,73,5);
/*!40000 ALTER TABLE `dataset_period` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_post`
--

DROP TABLE IF EXISTS `dataset_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_post`
--

LOCK TABLES `dataset_post` WRITE;
/*!40000 ALTER TABLE `dataset_post` DISABLE KEYS */;
INSERT INTO `dataset_post` VALUES (32,30,29),(33,30,32),(82,21,11),(83,21,15),(84,21,14),(85,17,11),(86,17,13),(87,17,16),(88,49,27),(89,49,32),(102,62,16),(103,62,12),(104,62,14),(105,34,31),(106,34,32),(107,51,31),(137,15,11),(138,15,16),(139,15,13),(148,31,15),(149,31,14),(150,31,13),(151,31,11),(155,44,25),(156,44,29),(157,44,31),(166,65,11),(167,22,11),(168,22,15),(169,24,31),(170,24,29),(171,24,30),(172,24,32),(173,73,11),(174,73,15);
/*!40000 ALTER TABLE `dataset_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataset_topic`
--

DROP TABLE IF EXISTS `dataset_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataset_topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataset_topic`
--

LOCK TABLES `dataset_topic` WRITE;
/*!40000 ALTER TABLE `dataset_topic` DISABLE KEYS */;
INSERT INTO `dataset_topic` VALUES (17,14,1),(19,21,5),(23,25,5),(24,26,5),(26,28,5),(27,29,5),(28,30,5),(31,33,5),(33,34,5),(34,35,5),(35,36,5),(36,37,5),(38,39,4),(39,40,4),(40,41,4),(41,42,4),(47,46,1),(48,47,1),(59,20,5),(60,20,2),(75,38,4),(76,49,1),(78,4,1),(80,55,1),(81,55,3),(94,24,1),(95,24,4),(96,24,5),(97,48,1),(98,48,4),(99,48,5),(112,27,5),(114,51,1),(119,32,5),(120,50,1),(121,10,4),(122,10,3),(127,18,3),(144,53,2),(176,31,5),(186,22,5),(194,44,1),(195,44,4),(196,44,5),(197,45,1),(201,7,4),(214,15,2),(215,15,4),(216,15,3),(223,17,1),(224,17,4),(225,17,5),(228,23,5),(229,23,1),(230,43,1);
/*!40000 ALTER TABLE `dataset_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datasets`
--

DROP TABLE IF EXISTS `datasets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datasets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `preview` tinytext COLLATE utf8mb4_unicode_ci,
  `public` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `library` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datasets`
--

LOCK TABLES `datasets` WRITE;
/*!40000 ALTER TABLE `datasets` DISABLE KEYS */;
INSERT INTO `datasets` VALUES (1,'Unemployment',NULL,NULL,1,NULL,'en','[]','chartjs','a:2:{s:4:\"type\";s:3:\"bar\";s:14:\"legendPosition\";s:3:\"top\";}',10,'2018-03-06 10:19:49','2018-05-14 17:16:45',NULL,NULL),(2,'Unemployment',NULL,NULL,NULL,NULL,NULL,NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',11,'2018-03-06 13:43:45','2018-03-06 13:43:45',NULL,NULL),(4,'Building','it doesn\'t include Jerusalem',NULL,NULL,NULL,'en','[]','chartjs','a:7:{s:4:\"type\";s:4:\"line\";s:6:\"xLabel\";s:4:\"year\";s:6:\"yLabel\";s:18:\"number of building\";s:11:\"borderWidth\";s:0:\"\";s:10:\"borderDash\";s:0:\"\";s:16:\"borderDashOffset\";s:0:\"\";s:16:\"hoverBorderWidth\";s:0:\"\";}',16,'2018-03-07 06:59:42','2018-03-29 17:53:35',NULL,NULL),(6,'Building2',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-07 08:22:58','2018-03-07 08:30:31',NULL,NULL),(7,'Establishment',NULL,NULL,NULL,NULL,'en','[{\"name\":\"years\",\"code\":\"ye716\"}]','chartjs','a:2:{s:4:\"type\";s:4:\"line\";s:7:\"stacked\";b:1;}',16,'2018-03-07 08:41:30','2018-04-07 22:12:53',NULL,NULL),(8,'Population',NULL,NULL,NULL,NULL,NULL,'[]','plotly','a:3:{s:4:\"type\";s:4:\"line\";s:11:\"tableau_url\";s:96:\"https://public.tableau.com/views/WaterTeamTableauBoard/IrrigatedLand?:embed=y&:display_count=yes\";s:10:\"plotly_url\";s:24:\"//plot.ly/~BethS/6.embed\";}',16,'2018-03-07 09:53:38','2018-03-08 08:09:58',NULL,NULL),(9,'Housing_Tenure',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-12 08:31:14','2018-03-12 08:31:53',NULL,NULL),(10,'Housing_AverageHousingDensity',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-12 08:37:04','2018-03-12 08:54:34',NULL,NULL),(11,'Number of Occupied Housing Units',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-12 08:51:28','2018-03-12 08:51:56',NULL,NULL),(12,'literacy',NULL,NULL,NULL,NULL,NULL,NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',19,'2018-03-14 08:22:52','2018-03-14 08:22:52',NULL,NULL),(13,'test 2 haitham',NULL,NULL,NULL,NULL,NULL,NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',19,'2018-03-14 08:28:53','2018-03-14 08:28:53',NULL,NULL),(14,'NumberOfBuildingsByCountry',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-16 10:03:34','2018-03-16 12:49:09',NULL,NULL),(15,'Buildings by Governorate','Buildings',NULL,NULL,NULL,'en','[{\"name\":\"buildings\",\"code\":\"bu5510\"},{\"name\":\"demographics\",\"code\":\"de4168\"},{\"name\":\"population\",\"code\":\"po4382\"}]','highchart','a:8:{s:4:\"type\";s:4:\"line\";s:6:\"legend\";b:1;s:14:\"legendPosition\";s:6:\"bottom\";s:6:\"xLabel\";s:5:\"Years\";s:6:\"yLabel\";s:9:\"Buildings\";s:7:\"stacked\";b:1;s:4:\"fill\";b:0;s:6:\"height\";s:0:\"\";}',16,'2018-03-16 12:50:12','2018-06-10 19:20:02',NULL,NULL),(16,'NumberOfBuildingsByGovernorate',NULL,NULL,NULL,NULL,NULL,NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-16 12:56:32','2018-03-16 12:56:32',NULL,NULL),(17,'Number of Buildings by Region','',NULL,1,NULL,'en','[]','chartjs','a:3:{s:4:\"type\";s:3:\"bar\";s:6:\"legend\";b:1;s:14:\"legendPosition\";s:5:\"right\";}',16,'2018-03-16 13:16:07','2018-05-14 17:46:04',NULL,NULL),(18,'NumberOfBuildingsByRegion',NULL,NULL,NULL,NULL,'en','[]','chartjs','a:5:{s:4:\"type\";s:4:\"line\";s:8:\"spanGaps\";b:0;s:4:\"fill\";b:1;s:14:\"legendPosition\";s:3:\"top\";s:6:\"legend\";b:1;}',16,'2018-03-16 13:16:20','2018-03-29 20:12:26',NULL,NULL),(19,'Number of Buildings by Region',NULL,NULL,NULL,NULL,NULL,NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-16 13:34:27','2018-03-16 13:34:27',NULL,NULL),(20,'Illiteracy and Education',NULL,NULL,1,NULL,'ar','[]','highchart','a:3:{s:4:\"type\";s:4:\"line\";s:8:\"zoomtype\";s:2:\"xy\";s:6:\"height\";s:3:\"700\";}',16,'2018-03-19 07:09:48','2018-06-10 17:03:08',NULL,NULL),(21,'Average Household Size by Governorate',NULL,NULL,1,NULL,'en','[{\"name\":\"households\",\"code\":\"ho2545\"}]','chartjs','a:9:{s:4:\"type\";s:4:\"line\";s:6:\"legend\";b:1;s:14:\"legendPosition\";s:5:\"right\";s:10:\"pointStyle\";s:6:\"circle\";s:6:\"xLabel\";s:5:\"Years\";s:6:\"yLabel\";s:14:\"Household Size\";s:4:\"fill\";b:0;s:7:\"stacked\";b:0;s:11:\"pointRadius\";s:1:\"2\";}',16,'2018-03-19 07:10:38','2018-05-14 16:40:57',NULL,NULL),(22,'2D_SocialIndicators_AverageHouseholdSizeByRegion',NULL,NULL,1,NULL,'en','[]','chartjs','a:5:{s:4:\"type\";s:14:\"horizontal-bar\";s:6:\"legend\";b:1;s:14:\"legendPosition\";s:5:\"right\";s:6:\"xLabel\";s:22:\"Average Household Size\";s:6:\"yLabel\";s:5:\"Years\";}',16,'2018-03-19 07:11:17','2018-05-19 00:32:26',NULL,NULL),(23,'2D_SocialIndicators_MeanNumberOfChildrenEverBornByCountry',NULL,NULL,NULL,NULL,'en','[{\"name\":\"water\",\"code\":\"wa2601\"}]','chartjs','a:1:{s:4:\"type\";s:3:\"bar\";}',16,'2018-03-19 07:11:52','2018-03-29 17:03:33',NULL,NULL),(24,'2D_SocialIndicators_MeanNumberOfChildrenEverBornByGovernorate','أحداث مستجدات كماليات مؤشرات قابلية ',NULL,1,1,'ar','null','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:12:20','2018-10-08 09:53:50',NULL,NULL),(25,'2D_SocialIndicators_MeanNumberOfChildrenEverBornByRegion',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:12:44','2018-03-19 07:12:58',NULL,NULL),(26,'2D_SocialIndicators_MedianAgeAtFirstMarriageByCountry',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:13:05','2018-03-19 07:13:28',NULL,NULL),(27,'2D_SocialIndicators_MedianAgeAtFirstMarriageByGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:13:36','2018-03-19 07:14:01',NULL,NULL),(28,'2D_SocialIndicators_MedianAgeAtFirstMarriageByRegion',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:14:10','2018-03-19 07:14:47',NULL,NULL),(29,'2D_SocialIndicators_NumberOfDisabledPersonsByCountry',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:15:13','2018-03-19 07:15:50',NULL,NULL),(30,'2D_SocialIndicators_NumberOfDisabledPersonsByGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:15:59','2018-03-19 07:16:16',NULL,NULL),(31,'Illiterate Persons by Age, Sex, and Governorate',NULL,NULL,1,NULL,'en','[{\"name\":\"illiteracy\",\"code\":\"il1269\"}]','highchart','a:4:{s:4:\"type\";s:4:\"line\";s:6:\"height\";s:0:\"\";s:8:\"zoomtype\";s:2:\"xy\";s:8:\"rotation\";s:3:\"180\";}',16,'2018-03-19 07:16:22','2018-06-10 19:33:08',NULL,NULL),(32,'2D_SocialIndicators_SexRatioByCountry',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:16:46','2018-03-19 07:17:04',NULL,NULL),(33,'2D_SocialIndicators_SexRatioByGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:17:10','2018-03-19 07:17:27',NULL,NULL),(34,'2D_SocialIndicators_SexRatioByRegion',NULL,NULL,1,1,'ar','[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:17:34','2018-05-14 11:15:28',NULL,NULL),(35,'3D_SocialIndicators_NumberOfDisabledPersonsBySexAndCountry',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:18:36','2018-03-19 07:19:02',NULL,NULL),(36,'3D_SocialIndicators_NumberOfDisabledPersonsBySexAndGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:19:13','2018-03-19 07:19:33',NULL,NULL),(37,'3D_SocialIndicators_NumberOfDisabledPersonsBySexAndRegion',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:19:39','2018-03-19 07:19:56',NULL,NULL),(38,'3D_migration_migrationByPreviousGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:20:08','2018-03-19 07:20:41',NULL,NULL),(39,'4D_migration_migration1997BySexPreviousGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:20:47','2018-03-19 07:21:44',NULL,NULL),(40,'4D_migration_migration2007BySexPreviousGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:22:16','2018-03-19 07:22:52',NULL,NULL),(41,'4D_migration_migration2017BySexPreviousGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:22:58','2018-03-19 07:23:33',NULL,NULL),(42,'4D_migration_migrationBySexPreviousGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:23:39','2018-03-19 07:24:09',NULL,NULL),(43,'Number of Completed Buildings by Governorate','',NULL,NULL,NULL,'ar','[{\"name\":\"people\",\"code\":\"pe8055\"},{\"name\":\"buildings\",\"code\":\"bu7123\"}]','chartjs','a:4:{s:4:\"type\";s:3:\"bar\";s:6:\"legend\";b:1;s:14:\"legendPosition\";s:4:\"left\";s:10:\"pointStyle\";s:6:\"circle\";}',16,'2018-03-19 07:27:23','2018-06-06 17:17:00',NULL,NULL),(44,'2D_Building_NumberOfCompletedBuildingsByGovernorate العربية','أحداث مستجدات كماليات مؤشرات قابلية ',NULL,NULL,NULL,'ar','[{\"name\":\"\\u0645\\u0633\\u062a\\u062c\\u062f\\u0627\\u062a\",\"code\":\"\\u0645\\u06332789\"},{\"name\":\"\\u0623\\u062d\\u062f\\u0627\\u062b\",\"code\":\"\\u0623\\u062d8262\"}]','highchart','a:9:{s:4:\"type\";s:3:\"bar\";s:7:\"stacked\";b:1;s:10:\"pointStyle\";s:4:\"dash\";s:11:\"pointRadius\";s:2:\"20\";s:7:\"tension\";s:2:\"10\";s:8:\"spanGaps\";b:1;s:4:\"fill\";b:1;s:6:\"legend\";b:1;s:14:\"legendPosition\";s:6:\"bottom\";}',16,'2018-03-19 07:40:42','2018-10-08 09:50:04',NULL,'2018-10-08 09:50:04'),(45,'2D_Building_NumberOfCompletedBuildingsByRegion',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:41:35','2018-04-15 05:38:14',NULL,'2018-04-15 05:38:14'),(46,'3D_Building_TypeOfBuildingByCountry',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:42:27','2018-03-19 07:43:06',NULL,NULL),(47,'3D_Building_TypeOfBuildingByGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:43:17','2018-03-19 07:44:00',NULL,NULL),(48,'3D_Building_TypeOfBuildingByRegion',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:44:08','2018-03-19 07:44:41',NULL,NULL),(49,'3D_Building_UtilizationOfCompletedBuildingByCountry',NULL,NULL,1,1,'ar','[]','chartjs','a:1:{s:4:\"type\";s:3:\"bar\";}',16,'2018-03-19 07:45:00','2018-05-15 22:05:44',NULL,NULL),(50,'3D_Building_UtilizationOfCompletedBuildingByGovernorate',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:45:33','2018-03-19 07:45:54',NULL,NULL),(51,'3D_Building_UtilizationOfCompletedBuildingByRegion',NULL,NULL,NULL,NULL,NULL,'[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-19 07:46:00','2018-03-19 07:46:19',NULL,NULL),(52,'New dataset',NULL,NULL,NULL,NULL,NULL,NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-21 07:21:10','2018-03-21 07:21:10',NULL,NULL),(53,'no_country_label',NULL,NULL,NULL,NULL,'en','[{\"name\":\"renewable\",\"code\":\"re7585\"},{\"name\":\"electricity\",\"code\":\"el3698\"}]','chartjs','a:1:{s:4:\"type\";s:3:\"bar\";}',16,'2018-03-23 08:44:11','2018-03-29 20:42:42',NULL,NULL),(54,'Average Housing Density By Region',NULL,NULL,NULL,NULL,NULL,NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-23 09:03:39','2018-03-23 09:03:39',NULL,NULL),(55,'Average Housing Density with Label',NULL,NULL,NULL,NULL,NULL,'[{\"name\":\"housing\",\"code\":\"ho4108\"}]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-03-23 09:12:52','2018-03-29 17:54:13',NULL,NULL),(56,'Test',NULL,NULL,NULL,NULL,'en',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-04-08 11:08:37','2018-04-08 11:08:47',NULL,'2018-04-08 11:08:47'),(57,'Housing 10.04.2018',NULL,NULL,NULL,NULL,'en',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-04-10 19:28:48','2018-04-10 19:28:48',NULL,NULL),(58,'Water',NULL,NULL,NULL,NULL,'en',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-04-10 19:44:39','2018-04-10 19:44:39',NULL,NULL),(59,'water2018',NULL,NULL,NULL,NULL,'en',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-04-10 19:53:25','2018-04-10 19:53:25',NULL,NULL),(60,'Buildings by Governorate',NULL,NULL,0,0,'en','[]','highchart','a:1:{s:4:\"type\";s:3:\"bar\";}',0,'2018-05-04 17:55:55','2018-05-10 09:10:40',NULL,'2018-05-10 09:10:40'),(61,'testmoad',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-05-15 22:04:26','2018-05-15 22:04:43',NULL,'2018-05-15 22:04:43'),(62,'Illiteracy',NULL,NULL,1,1,'en','[{\"name\":\"education\",\"code\":\"ed5496\"},{\"name\":\"illiteracy\",\"code\":\"il3037\"}]','highchart','a:1:{s:4:\"type\";s:3:\"bar\";}',0,'2018-05-21 08:43:29','2018-05-21 08:44:28',NULL,NULL),(63,'cxbxcvbvcx',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-06-05 07:41:19','2018-06-05 07:41:19',NULL,NULL),(64,'long_format',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-09-25 11:48:28','2018-09-25 11:48:28',NULL,NULL),(65,'123_Long format test ','test',NULL,0,0,'ar','[]','chartjs','a:1:{s:4:\"type\";s:14:\"horizontal-bar\";}',0,'2018-10-04 12:31:48','2018-10-08 12:49:41',NULL,'2018-10-08 12:49:41'),(66,'WIDE',NULL,NULL,0,0,'','[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-10-04 13:09:22','2018-10-08 09:52:55',NULL,NULL),(67,'ABD_DST','test',NULL,0,0,'','[]','chartjs','a:5:{s:4:\"type\";s:4:\"line\";s:7:\"XColumn\";a:0:{}s:4:\"fill\";b:1;s:8:\"spanGaps\";b:1;s:7:\"stacked\";b:1;}',0,'2018-10-07 15:51:22','2018-11-26 21:25:04',NULL,NULL),(68,'Population_country_gender_year',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-10-08 08:33:39','2018-10-08 08:34:17',NULL,'2018-10-08 08:34:17'),(69,'housing units',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-10-08 08:35:02','2018-10-08 08:35:02',NULL,NULL),(70,'wide 123',NULL,NULL,0,0,'','[]','highchart','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-10-08 08:37:23','2018-10-08 10:01:55',NULL,NULL),(71,'abdo',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-10-08 12:49:58','2018-10-08 12:50:23',NULL,'2018-10-08 12:50:23'),(72,'1ABED_TEST',NULL,NULL,0,0,'','[]','chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-10-08 13:27:56','2018-10-08 13:34:56',NULL,'2018-10-08 13:34:56'),(73,'2D_SocialIndicators_AverageHouseholdSizeByRegion',NULL,NULL,1,NULL,'en','[]','chartjs','a:5:{s:4:\"type\";s:14:\"horizontal-bar\";s:6:\"legend\";b:1;s:14:\"legendPosition\";s:5:\"right\";s:6:\"xLabel\";s:22:\"Average Household Size\";s:6:\"yLabel\";s:5:\"Years\";}',0,'2018-10-09 06:00:46','2018-10-09 07:29:35',NULL,NULL),(74,'ABED_DST',NULL,NULL,0,0,'','[]','plotly','a:3:{s:4:\"type\";s:6:\"bubble\";s:7:\"XColumn\";a:0:{}s:12:\"plotly_scale\";s:5:\"0.005\";}',0,'2018-10-09 07:30:55','2018-12-18 12:19:51',NULL,NULL),(75,'1A','test for abed',NULL,0,0,'','[]','chartjs','a:7:{s:4:\"type\";s:4:\"line\";s:4:\"fill\";b:1;s:8:\"spanGaps\";b:1;s:7:\"stacked\";b:1;s:11:\"pointRadius\";s:2:\"10\";s:7:\"tension\";s:2:\"10\";s:6:\"legend\";b:1;}',0,'2018-10-09 12:39:11','2018-12-13 14:13:37',NULL,'2018-12-13 14:13:37'),(76,'11A',NULL,NULL,0,0,'','[]','highchart','a:9:{s:4:\"type\";s:3:\"bar\";s:7:\"stacked\";b:0;s:8:\"spanGaps\";b:0;s:4:\"fill\";b:0;s:7:\"XColumn\";a:0:{}s:14:\"legendPosition\";s:3:\"top\";s:6:\"legend\";b:1;s:6:\"xLabel\";s:4:\"Year\";s:6:\"yLabel\";s:6:\"Values\";}',0,'2018-11-19 11:34:21','2018-12-13 14:13:29',NULL,'2018-12-13 14:13:29'),(77,'New Dataset',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',0,'2018-11-21 12:47:48','2018-11-21 12:49:16',NULL,'2018-11-21 12:49:16'),(78,'111A',NULL,NULL,0,0,'','[]','plotly','a:7:{s:4:\"type\";s:10:\"scattergeo\";s:7:\"XColumn\";a:0:{}s:4:\"fill\";b:1;s:8:\"spanGaps\";b:1;s:7:\"stacked\";b:1;s:12:\"plotly_scale\";s:3:\"200\";s:12:\"plotly_title\";s:8:\"abed 100\";}',0,'2018-11-21 12:56:56','2018-12-10 13:31:14',NULL,'2018-12-10 13:31:14'),(79,'abed101',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',26,'2018-11-27 15:24:23','2018-11-27 15:24:23',NULL,NULL),(80,'1111B',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-11-28 07:15:17','2018-11-28 07:15:32',NULL,'2018-11-28 07:15:32'),(81,'11111B',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-11-28 07:35:01','2018-11-28 07:35:06',NULL,'2018-11-28 07:35:06'),(82,'abed2',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',26,'2018-11-28 08:08:41','2018-11-28 08:08:41',NULL,NULL),(83,'abed2',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',26,'2018-11-28 08:12:43','2018-11-28 08:12:43',NULL,NULL),(84,'abede2232323',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',26,'2018-11-28 09:11:11','2018-11-28 09:11:11',NULL,NULL),(85,'abed200',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',26,'2018-11-28 10:25:23','2018-11-28 10:25:23',NULL,NULL),(86,'abed2001',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',26,'2018-11-28 11:09:06','2018-11-28 11:09:06',NULL,NULL),(87,'Abd_20',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',27,'2018-12-10 13:32:45','2018-12-10 13:32:45',NULL,NULL),(88,'abd60',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',27,'2018-12-10 13:42:10','2018-12-10 13:42:10',NULL,NULL),(89,'abd20',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',27,'2018-12-11 07:54:21','2018-12-11 07:54:21',NULL,NULL),(90,'111A',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-12-13 08:07:20','2018-12-13 08:07:35',NULL,'2018-12-13 08:07:35'),(91,'Example_dataset',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-12-13 08:14:16','2018-12-13 08:14:16',NULL,NULL),(92,'2D long - Buildings Completed',NULL,'',0,0,'','[]','tableau','a:4:{s:4:\"type\";s:6:\"bubble\";s:7:\"XColumn\";a:0:{}s:15:\"highchart_title\";s:0:\"\";s:12:\"plotly_scale\";s:6:\"0.0005\";}',16,'2018-12-13 14:14:32','2019-01-02 11:38:39',NULL,NULL),(93,'3D long - Building Utilization',NULL,NULL,0,0,'','[]','highchart','a:2:{s:4:\"type\";s:3:\"bar\";s:7:\"XColumn\";a:0:{}}',16,'2018-12-13 14:16:02','2018-12-13 14:18:06',NULL,NULL),(94,'2D wide - Buildings Completed ',NULL,NULL,0,0,'','[]','plotly','a:2:{s:4:\"type\";s:10:\"scattergeo\";s:7:\"XColumn\";a:0:{}}',16,'2018-12-13 14:18:21','2018-12-14 07:09:12',NULL,NULL),(95,'3D wide - Building Utilization',NULL,NULL,0,0,'','[]','chartjs','a:4:{s:4:\"type\";s:4:\"line\";s:7:\"XColumn\";a:0:{}s:6:\"legend\";b:1;s:14:\"legendPosition\";s:6:\"bottom\";}',16,'2018-12-13 14:20:55','2018-12-13 14:21:43',NULL,NULL),(96,'wide',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-12-13 14:43:27','2018-12-13 14:43:27',NULL,NULL),(97,'3d ',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',16,'2018-12-14 08:10:49','2018-12-14 08:11:46',NULL,'2018-12-14 08:11:46'),(98,'Bubble Chart',NULL,NULL,0,0,'','[]','plotly','a:3:{s:4:\"type\";s:6:\"bubble\";s:7:\"XColumn\";a:0:{}s:12:\"plotly_scale\";s:5:\"0.002\";}',16,'2018-12-20 11:27:51','2018-12-20 11:31:07',NULL,NULL),(99,'buliding',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',6,'2018-12-20 11:44:47','2018-12-20 11:44:47',NULL,NULL),(100,'morad dataset',NULL,NULL,0,0,'','[]','plotly','a:2:{s:4:\"type\";s:6:\"bubble\";s:7:\"XColumn\";a:0:{}}',27,'2018-12-27 13:42:19','2018-12-27 13:53:54',NULL,NULL),(101,'morad dataset',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',27,'2019-01-02 13:35:43','2019-01-02 13:35:43',NULL,NULL),(102,'Moradest',NULL,NULL,0,0,'',NULL,'chartjs','a:1:{s:4:\"type\";s:4:\"line\";}',29,'2019-01-02 15:00:40','2019-01-02 15:00:40',NULL,NULL),(103,'1Example',NULL,NULL,0,0,'','[]','plotly','a:8:{s:4:\"type\";s:10:\"scattergeo\";s:7:\"XColumn\";a:0:{}s:1:\"X\";s:12:\"unemployment\";s:10:\"fbasevalue\";a:2:{i:0;s:3:\"gov\";i:1;s:6:\"region\";}s:9:\"faggvalue\";a:0:{}s:1:\"Y\";s:10:\"illiteracy\";s:1:\"Z\";s:3:\"pop\";s:12:\"plotly_scale\";s:3:\"200\";}',16,'2019-01-16 10:31:46','2019-01-21 13:11:03',NULL,NULL);
/*!40000 ALTER TABLE `datasets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `dataset_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (1,1,1,'2018-05-07 16:04:20','2018-05-07 16:04:20'),(12,1,31,NULL,NULL),(13,1,44,NULL,NULL),(14,1,17,NULL,NULL),(15,6,20,NULL,NULL),(23,26,7,NULL,NULL);
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dformat` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `file_data` json DEFAULT NULL,
  `file_data_text` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (2,'Unemployment',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/uneployment-with Age Gruop (2).xlsx',0,11,'2018-03-06 13:07:31','2018-03-06 13:07:31',NULL,NULL,NULL,NULL),(5,'Unemployment with Age group',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/uneployment-with Age Gruop (2).xlsx',0,11,'2018-03-06 13:39:49','2018-03-06 13:39:49',NULL,NULL,NULL,NULL),(7,'Building2March7',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/Governorate_Building3March6.xlsx',0,16,'2018-03-07 07:27:30','2018-03-07 07:27:30',NULL,NULL,NULL,NULL),(8,'Building3March7',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/Governorate_BuildingMarch6.xlsx',0,16,'2018-03-07 08:22:48','2018-03-07 08:22:48',NULL,NULL,NULL,NULL),(9,'EstablishmentMarch7',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/Governorate_NoOfEstablishmentsMarch7.xlsx',0,16,'2018-03-07 08:41:51','2018-03-07 08:41:51',NULL,NULL,NULL,NULL),(10,'PopAgeGenderGov',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/PopAgeGenderGov.xlsx',0,16,'2018-03-07 09:53:28','2018-03-07 09:53:28',NULL,NULL,NULL,NULL),(13,'Housing_NumberofOccupiedHousingUnits',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_NumberofOccupiedHousingUnits.xlsx',0,16,'2018-03-12 08:51:14','2018-03-12 08:51:14',NULL,NULL,NULL,NULL),(14,'literacy',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Illiteracy_IlliteratePersonsByCountry.xlsx',0,19,'2018-03-14 08:22:22','2018-03-14 08:22:22',NULL,NULL,NULL,NULL),(17,'test 4D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/4D_Illiteracy_IlliteratePersonsByAgeSexGovernorate.xlsx',0,19,'2018-03-15 09:51:31','2018-03-15 09:51:31',NULL,NULL,NULL,NULL),(21,'Number Of All Establishments By Country',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_CopyOfEstablishments_NumberOfAllEstablishmentsByCountry.xlsx',0,19,'2018-03-16 20:47:43','2018-03-16 20:47:43',NULL,NULL,NULL,NULL),(22,'Number Of All Establishments By Governorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_CopyOfEstablishments_NumberOfAllEstablishmentsByGovernorate.xlsx',0,19,'2018-03-16 21:01:49','2018-03-16 21:01:49',NULL,NULL,NULL,NULL),(23,'Number Of All Establishments By Region-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_CopyOfEstablishments_NumberOfAllEstablishmentsByRegion.xlsx',0,19,'2018-03-16 21:03:58','2018-03-16 21:03:58',NULL,NULL,NULL,NULL),(24,'Number Of Operating Establishments By Country-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_CopyOfEstablishments_NumberOfOperatingEstablishmentsByCountry.xlsx',0,19,'2018-03-16 21:04:52','2018-03-16 21:04:52',NULL,NULL,NULL,NULL),(25,'Number Of Operating Establishments By Governorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_CopyOfEstablishments_NumberOfOperatingEstablishmentsByGovernorate.xlsx',0,19,'2018-03-16 21:05:44','2018-03-16 21:05:44',NULL,NULL,NULL,NULL),(26,'Number Of Operating Establishments By Region-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_CopyOfEstablishments_NumberOfOperatingEstablishmentsByRegion.xlsx',0,19,'2018-03-16 21:06:38','2018-03-16 21:06:38',NULL,NULL,NULL,NULL),(30,'Average Housing Density By Country-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_AverageHousingDensityByCountry.xlsx',0,19,'2018-03-16 21:25:49','2018-03-16 21:25:49',NULL,NULL,NULL,NULL),(31,'Average Housing Density By Governorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_AverageHousingDensityByGovernorate.xlsx',0,19,'2018-03-16 21:27:49','2018-03-16 21:27:49',NULL,NULL,NULL,NULL),(32,'Average Housing Density By Region-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_AverageHousingDensityByRegion.xlsx',0,19,'2018-03-16 21:28:22','2018-03-16 21:28:22',NULL,NULL,NULL,NULL),(33,'Housing_Connection To Electricity Public Network (Occupied Housing UnitsOnly) By Country-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_ConnectionToElectricityPublicNetwork(OccupiedHousingUnitsOnly)ByCountry.xlsx',0,19,'2018-03-16 21:29:37','2018-03-16 21:29:37',NULL,NULL,NULL,NULL),(34,'Housing_Connection ToElectricityPublicNetwork (OccupiedHousingUnitsOnly) ByGovernorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_ConnectionToElectricityPublicNetwork(OccupiedHousingUnitsOnly)ByGovernorate.xlsx',0,19,'2018-03-16 21:31:32','2018-03-16 21:31:32',NULL,NULL,NULL,NULL),(35,'Housing_ConnectionToElectricityPublicNetwork(OccupiedHousingUnitsOnly)ByRegion- 2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_ConnectionToElectricityPublicNetwork(OccupiedHousingUnitsOnly)ByRegion.xlsx',0,19,'2018-03-16 21:32:02','2018-03-16 21:32:02',NULL,NULL,NULL,NULL),(36,'Number of Occupied Housing Units By Country-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_NumberofOccupiedHousingUnitsByCountry.xlsx',0,19,'2018-03-16 21:32:53','2018-03-16 21:32:53',NULL,NULL,NULL,NULL),(37,'Number of Occupied Housing Units By Governorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_NumberofOccupiedHousingUnitsByGovernorate.xlsx',0,19,'2018-03-16 21:33:40','2018-03-16 21:33:40',NULL,NULL,NULL,NULL),(38,'Number of Occupied Housing Units By Region-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_NumberofOccupiedHousingUnitsByRegion.xlsx',0,19,'2018-03-16 21:34:36','2018-03-16 21:34:36',NULL,NULL,NULL,NULL),(39,'Number Of Private Households By Country',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_NumberOfPrivateHouseholdsByCountry.xlsx',0,19,'2018-03-16 21:35:36','2018-03-16 21:35:36',NULL,NULL,NULL,NULL),(40,'Number Of Private Households By Governorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_NumberOfPrivateHouseholdsByGovernorate.xlsx',0,19,'2018-03-16 21:36:27','2018-03-16 21:36:27',NULL,NULL,NULL,NULL),(41,'Number Of Private Households By Region-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Housing_NumberOfPrivateHouseholdsByRegion.xlsx',0,19,'2018-03-16 21:37:04','2018-03-16 21:37:04',NULL,NULL,NULL,NULL),(45,'Unemployed IndividualsAged15AndAboveByCountry-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Unemployment_UnemployedIndividualsAged15AndAboveByCountry.xlsx',0,19,'2018-03-16 21:52:47','2018-03-16 21:52:47',NULL,NULL,NULL,NULL),(46,'UnemployedIndividualsAged15AndAboveByGovernorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Unemployment_UnemployedIndividualsAged15AndAboveByGovernorate.xlsx',0,19,'2018-03-16 21:53:14','2018-03-16 21:53:14',NULL,NULL,NULL,NULL),(47,'UnemployedIndividualsAged15AndAboveByRegion-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Unemployment_UnemployedIndividualsAged15AndAboveByRegion.xlsx',0,19,'2018-03-16 21:53:56','2018-03-16 21:53:56',NULL,NULL,NULL,NULL),(48,'2D_Unemployment_UnemployedIndividualsAged15AndAboveByRegion-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Unemployment_UnemployedIndividualsAged15AndAboveByRegion.xlsx',0,19,'2018-03-16 21:54:18','2018-03-16 21:54:18',NULL,NULL,NULL,NULL),(58,'IlliteratePersons By Country-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Illiteracy_IlliteratePersonsByCountry.xlsx',0,19,'2018-03-16 22:05:03','2018-03-16 22:05:03',NULL,NULL,NULL,NULL),(59,'IlliteratePersonsByGovernorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Illiteracy_IlliteratePersonsByGovernorate.xlsx',0,19,'2018-03-16 22:05:28','2018-03-16 22:05:28',NULL,NULL,NULL,NULL),(60,'IlliteratePersonsByRegion-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Illiteracy_IlliteratePersonsByRegion.xlsx',0,19,'2018-03-16 22:05:56','2018-03-16 22:05:56',NULL,NULL,NULL,NULL),(70,'PopulationByCountry-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D__Pop_Agegroup__PopulationByCountry.xlsx',0,19,'2018-03-16 22:15:35','2018-03-16 22:15:35',NULL,NULL,NULL,NULL),(71,'PopulationByGovernorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D__Pop_Agegroup__PopulationByGovernorate.xlsx',0,19,'2018-03-16 22:16:00','2018-03-16 22:16:00',NULL,NULL,NULL,NULL),(72,'PopulationByRegion-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D__Pop_Agegroup__PopulationByRegion.xlsx',0,19,'2018-03-16 22:16:22','2018-03-16 22:16:22',NULL,NULL,NULL,NULL),(85,'PopulationByGov_NumberOfPopulationByCountry-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_PopulationByGov_NumberOfPopulationByCountry.xlsx',0,19,'2018-03-16 22:23:45','2018-03-16 22:23:45',NULL,NULL,NULL,NULL),(86,'PopulationByGov_NumberOfPopulationByGovernorate-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_PopulationByGov_NumberOfPopulationByGovernorate.xlsx',0,19,'2018-03-16 22:24:08','2018-03-16 22:24:08',NULL,NULL,NULL,NULL),(87,'PopulationByGov_NumberOfPopulationByRegion-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_PopulationByGov_NumberOfPopulationByRegion.xlsx',0,19,'2018-03-16 22:24:28','2018-03-16 22:24:28',NULL,NULL,NULL,NULL),(88,'PopulationByGov_NumberOfPopulationByRegion-2D',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_PopulationByGov_NumberOfPopulationByRegion.xlsx',0,19,'2018-03-16 22:24:51','2018-03-16 22:24:51',NULL,NULL,NULL,NULL),(97,'NumberOfCompletedBuildingsByCountry',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Building_NumberOfCompletedBuildingsByCountry.xlsx',0,16,'2018-03-19 06:47:02','2018-03-19 06:47:02',NULL,NULL,NULL,NULL),(98,'NumberOfCompletedBuildingsByGovernorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Building_NumberOfCompletedBuildingsByGovernorate.xlsx',0,16,'2018-03-19 06:47:47','2018-03-19 06:47:47',NULL,NULL,NULL,NULL),(99,'NumberOfCompletedBuildingsByRegion',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_Building_NumberOfCompletedBuildingsByRegion.xlsx',0,16,'2018-03-19 06:48:03','2018-03-19 06:48:03',NULL,NULL,NULL,NULL),(100,'TypeOfBuildingByCountry',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_TypeOfBuildingByCountry.xlsx',0,16,'2018-03-19 06:48:25','2018-03-19 06:48:25',NULL,NULL,NULL,NULL),(101,'TypeOfBuildingByGovernorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_TypeOfBuildingByGovernorate.xlsx',0,16,'2018-03-19 06:48:46','2018-03-19 06:48:46',NULL,NULL,NULL,NULL),(102,'TypeOfBuildingByRegion',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_TypeOfBuildingByRegion.xlsx',0,16,'2018-03-19 06:49:06','2018-03-19 06:49:06',NULL,NULL,NULL,NULL),(103,'UtilizationOfCompletedBuildingByCountry',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_UtilizationOfCompletedBuildingByCountry.xlsx',0,16,'2018-03-19 06:49:26','2018-03-19 06:49:26',NULL,NULL,NULL,NULL),(104,'UtilizationOfCompletedBuildingByGovernorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_UtilizationOfCompletedBuildingByGovernorate.xlsx',0,16,'2018-03-19 06:49:42','2018-03-19 06:49:42',NULL,NULL,NULL,NULL),(105,'UtilizationOfCompletedBuildingByRegion',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_UtilizationOfCompletedBuildingByRegion.xlsx',0,16,'2018-03-19 06:50:15','2018-03-19 06:50:15',NULL,NULL,NULL,NULL),(106,'2D_SocialIndicators_AverageHouseholdSizeByCountry',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_AverageHouseholdSizeByCountry.xlsx',0,16,'2018-03-19 06:53:56','2018-03-19 06:53:56',NULL,NULL,NULL,NULL),(107,'2D_SocialIndicators_AverageHouseholdSizeByGovernorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_AverageHouseholdSizeByGovernorate.xlsx',0,16,'2018-03-19 06:54:05','2018-03-19 06:54:05',NULL,NULL,NULL,NULL),(108,'2D_SocialIndicators_AverageHouseholdSizeByRegion',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_AverageHouseholdSizeByRegion.xlsx',0,16,'2018-03-19 06:54:13','2018-03-19 06:54:13',NULL,NULL,NULL,NULL),(109,'2D_SocialIndicators_MeanNumberOfChildrenEverBornByCountry',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_MeanNumberOfChildrenEverBornByCountry.xlsx',0,16,'2018-03-19 06:54:25','2018-03-19 06:54:25',NULL,NULL,NULL,NULL),(110,'2D_SocialIndicators_MeanNumberOfChildrenEverBornByGovernorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_MeanNumberOfChildrenEverBornByGovernorate.xlsx',0,16,'2018-03-19 06:54:36','2018-03-19 06:54:36',NULL,NULL,NULL,NULL),(111,'2D_SocialIndicators_MeanNumberOfChildrenEverBornByRegion',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_MeanNumberOfChildrenEverBornByRegion.xlsx',0,16,'2018-03-19 06:54:43','2018-03-19 06:54:43',NULL,NULL,NULL,NULL),(112,'2D_SocialIndicators_MedianAgeAtFirstMarriageByCountry',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_MedianAgeAtFirstMarriageByCountry.xlsx',0,16,'2018-03-19 06:54:53','2018-03-19 06:54:53',NULL,NULL,NULL,NULL),(113,'2D_SocialIndicators_MedianAgeAtFirstMarriageByGovernorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_MedianAgeAtFirstMarriageByGovernorate.xlsx',0,16,'2018-03-19 06:55:05','2018-03-19 06:55:05',NULL,NULL,NULL,NULL),(114,'2D_SocialIndicators_MedianAgeAtFirstMarriageByRegion',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_MedianAgeAtFirstMarriageByRegion.xlsx',0,16,'2018-03-19 06:55:14','2018-03-19 06:55:14',NULL,NULL,NULL,NULL),(115,'2D_SocialIndicators_NumberOfDisabledPersonsByCountry',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_NumberOfDisabledPersonsByCountry.xlsx',0,16,'2018-03-19 06:55:26','2018-03-19 06:55:26',NULL,NULL,NULL,NULL),(116,'2D_SocialIndicators_NumberOfDisabledPersonsByGovernorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_NumberOfDisabledPersonsByGovernorate.xlsx',0,16,'2018-03-19 06:55:34','2018-03-19 06:55:34',NULL,NULL,NULL,NULL),(117,'2D_SocialIndicators_NumberOfDisabledPersonsByRegion',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_NumberOfDisabledPersonsByRegion.xlsx',0,16,'2018-03-19 06:55:41','2018-03-19 06:55:41',NULL,NULL,NULL,NULL),(118,'2D_SocialIndicators_SexRatioByCountry',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_SexRatioByCountry.xlsx',0,16,'2018-03-19 06:55:49','2018-03-19 06:55:49',NULL,NULL,NULL,NULL),(119,'2D_SocialIndicators_SexRatioByGovernorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_SexRatioByGovernorate.xlsx',0,16,'2018-03-19 06:55:55','2018-03-19 06:55:55',NULL,NULL,NULL,NULL),(120,'2D_SocialIndicators_SexRatioByRegion',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_SexRatioByRegion.xlsx',0,16,'2018-03-19 06:56:02','2018-03-19 06:56:02',NULL,NULL,NULL,NULL),(128,'No. of Population in Palestine.svg',NULL,'image/svg+xml','https://cdn.filestackcontent.com/gbvnPayfRJiMtlLwm4iH',0,19,'2018-04-05 10:19:56','2018-04-05 10:19:56',NULL,NULL,NULL,NULL),(129,'No. of Population in Palestine.svg.png',NULL,'image/png','https://cdn.filestackcontent.com/u6s8OjtRnep3kPPu4PFR',0,19,'2018-04-05 10:24:05','2018-04-05 10:24:05',NULL,NULL,NULL,NULL),(130,'Housing-9.4.2018',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D.4.2018_AverageHousingDensityByCountry.xlsx',0,6,'2018-04-10 07:58:36','2018-04-10 07:58:36',NULL,NULL,NULL,NULL),(133,'water',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/water 10.04.2018.xlsx',0,6,'2018-04-10 19:39:32','2018-04-10 19:39:32',NULL,NULL,NULL,NULL),(137,'water2018',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/water 42018.xlsx',0,6,'2018-04-10 19:57:23','2018-04-10 19:57:23',NULL,NULL,NULL,NULL),(138,'water2018',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/water 42018.xlsx',0,6,'2018-04-10 20:02:01','2018-04-10 20:02:01',NULL,NULL,NULL,NULL),(139,'water1',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/water 42018.xlsx',0,6,'2018-04-10 20:04:28','2018-04-10 20:04:28',NULL,NULL,NULL,NULL),(140,'3D Buildings by type of building',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_TypeOfBuildingByGovernorate.xlsx',0,1,'2018-05-04 11:15:15','2018-05-04 11:15:15',NULL,NULL,NULL,NULL),(141,'Buildings by Governorate',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_TypeOfBuildingByGovernorate.xlsx',0,1,'2018-05-04 17:56:52','2018-05-04 17:56:52',NULL,NULL,NULL,NULL),(142,'4D Illiteracy',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/4D_Illiteracy_IlliteratePersonsByAgeSexGovernorate.xlsx',0,1,'2018-05-19 01:16:05','2018-05-19 01:16:05',NULL,NULL,NULL,NULL),(143,'gender',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/3D_Building_TypeOfBuildingByGovernorate (1).xlsx',0,6,'2018-05-24 09:10:19','2018-05-24 09:10:19',NULL,NULL,NULL,NULL),(144,'gender1',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_MeanNumberOfChildrenEverBornByGovernorate.xlsx',0,6,'2018-05-24 09:15:47','2018-05-24 09:15:47',NULL,NULL,NULL,NULL),(145,'gender',NULL,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','data/2D_SocialIndicators_MeanNumberOfChildrenEverBornByGovernorate.xlsx',0,6,'2018-05-24 09:17:42','2018-05-24 09:17:42',NULL,NULL,NULL,NULL),(146,'long format',NULL,'application/vnd.ms-excel','data/long--datapoints--average_household_size--by--geo--year.csv',0,16,'2018-09-25 11:48:19','2018-09-25 11:48:19',NULL,NULL,NULL,NULL),(147,'wide_format',NULL,'application/vnd.ms-excel','data/wide--average_household_size--by--geo--year.csv',0,16,'2018-09-25 12:05:06','2018-09-25 12:05:06',NULL,NULL,NULL,NULL),(148,'Long format ',NULL,'application/vnd.ms-excel','data/ddf--datapoints--housing_units--by--geo--year.csv',2,16,'2018-10-04 12:30:09','2018-10-04 12:30:09',NULL,NULL,NULL,NULL),(149,'Saving a file',NULL,'application/vnd.ms-excel','data/ddf--datapoints--housing_units--by--geo--year.csv',2,16,'2018-10-04 13:03:48','2018-10-04 13:03:48',NULL,NULL,NULL,NULL),(150,'WIDE ',NULL,'application/vnd.ms-excel','data/households--by--geo--year.csv',1,16,'2018-10-04 13:09:16','2018-10-04 13:09:16',NULL,NULL,NULL,NULL),(151,'ABED_L_DS',NULL,'application/vnd.ms-excel','data/long--datapoints--average_household_size--by--geo--year.csv',2,26,'2018-10-07 14:26:28','2018-10-07 14:26:28',NULL,NULL,NULL,NULL),(152,'ABED_W_DS',NULL,'application/vnd.ms-excel','data/wide--average_household_size--by--geo--year.csv',1,26,'2018-10-07 14:27:01','2018-10-07 14:27:01',NULL,NULL,NULL,NULL),(153,'Population_country_gender_year',NULL,'application/vnd.ms-excel','data/ddf--datapoints--population--by--country--gender--year.csv',2,16,'2018-10-08 08:33:26','2018-10-08 08:33:26',NULL,NULL,NULL,NULL),(154,'housing units',NULL,'application/vnd.ms-excel','data/ddf--datapoints--housing_units--by--geo--year.csv',2,16,'2018-10-08 08:34:55','2018-10-08 08:34:55',NULL,NULL,NULL,NULL),(155,'housing units wide',NULL,'application/vnd.ms-excel','data/housing_units--by--geo--year.csv',1,16,'2018-10-08 08:37:15','2018-10-08 08:37:15',NULL,NULL,NULL,NULL),(156,'ABED_LN_DF',NULL,'application/vnd.ms-excel','data/long_N_dimention.csv',2,26,'2018-11-14 14:03:31','2018-11-14 14:03:31',NULL,NULL,NULL,NULL),(159,'3D_Building_TypeOfBuildingByGovernorate',NULL,'application/vnd.ms-excel','data/3D_Building_TypeOfBuildingByGovernorate.csv',1,16,'2018-11-19 11:39:03','2018-11-19 11:39:03',NULL,NULL,NULL,NULL),(163,'2D_wide_BuildingsCompleted',NULL,'application/vnd.ms-excel','data/2D_Building_NumberOfBuildingsByGovernorate.csv',1,16,'2018-11-19 12:57:10','2018-11-19 14:05:35',NULL,NULL,NULL,NULL),(165,'3D_wide_BuildingUtilization',NULL,'application/vnd.ms-excel','data/3D_wide_BuildingUtilization.csv',1,16,'2018-11-19 13:18:36','2018-11-19 13:18:36',NULL,NULL,NULL,NULL),(166,'3D_long_BuildingUtilization',NULL,'application/vnd.ms-excel','data/3D_long_BuildingUtilization.csv',2,16,'2018-11-19 13:26:12','2018-11-19 13:26:12',NULL,NULL,NULL,NULL),(168,'2D_long_BuildingsCompleted',NULL,'application/vnd.ms-excel','data/d5d1b8e334632e86763c32b6df918f8a.csv',2,16,'2018-11-21 07:31:19','2019-01-06 13:44:45',NULL,NULL,NULL,'[{\"geo2\":\"pse\",\"year\":\"1997\",\"average_household_size\":\"6.34\",\"uid\":0},{\"geo2\":\"pse\",\"year\":2007,\"average_household_size\":5.828395535610152,\"uid\":1},{\"geo2\":\"pse\",\"year\":2017,\"average_household_size\":5.085981350069279,\"uid\":2},{\"geo2\":1,\"year\":1997,\"average_household_size\":6,\"uid\":3},{\"geo2\":1,\"year\":2007,\"average_household_size\":5.5036317141698845,\"uid\":4},{\"geo2\":1,\"year\":2017,\"average_household_size\":4.889637403456913,\"uid\":5},{\"geo2\":2,\"year\":1997,\"average_household_size\":6.9,\"uid\":6},{\"geo2\":2,\"year\":2007,\"average_household_size\":6.460841552196604,\"uid\":7},{\"geo2\":2,\"year\":2017,\"average_household_size\":5.650000000000001,\"uid\":8},{\"geo2\":1101,\"year\":1997,\"average_household_size\":5.9,\"uid\":9},{\"geo2\":1101,\"year\":2007,\"average_household_size\":5.3,\"uid\":10},{\"geo2\":1101,\"year\":2017,\"average_household_size\":4.88655913191838,\"uid\":11},{\"geo2\":1105,\"year\":1997,\"average_household_size\":6.1,\"uid\":12},{\"geo2\":1105,\"year\":2007,\"average_household_size\":5.3,\"uid\":13},{\"geo2\":1105,\"year\":2017,\"average_household_size\":4.925462049759987,\"uid\":14},{\"geo2\":1110,\"year\":1997,\"average_household_size\":5.8,\"uid\":15},{\"geo2\":1110,\"year\":2007,\"average_household_size\":5.3,\"uid\":16},{\"geo2\":1110,\"year\":2017,\"average_household_size\":4.853730244708226,\"uid\":17},{\"geo2\":1120,\"year\":1997,\"average_household_size\":6.1,\"uid\":18},{\"geo2\":1120,\"year\":2007,\"average_household_size\":5.6,\"uid\":19},{\"geo2\":1120,\"year\":2017,\"average_household_size\":4.887617937780145,\"uid\":20},{\"geo2\":1125,\"year\":1997,\"average_household_size\":6,\"uid\":21},{\"geo2\":1125,\"year\":2007,\"average_household_size\":5.4,\"uid\":22},{\"geo2\":1125,\"year\":2017,\"average_household_size\":4.873009611841366,\"uid\":23},{\"geo2\":1115,\"year\":1997,\"average_household_size\":5.9,\"uid\":24},{\"geo2\":1115,\"year\":2007,\"average_household_size\":5.4,\"uid\":25},{\"geo2\":1115,\"year\":2017,\"average_household_size\":4.872989381231478,\"uid\":26},{\"geo2\":1230,\"year\":1997,\"average_household_size\":5.9,\"uid\":27},{\"geo2\":1230,\"year\":2007,\"average_household_size\":5.9,\"uid\":28},{\"geo2\":1230,\"year\":2017,\"average_household_size\":4.9032131175580025,\"uid\":29},{\"geo2\":1240,\"year\":1997,\"average_household_size\":5.4,\"uid\":30},{\"geo2\":1240,\"year\":2007,\"average_household_size\":5.4,\"uid\":31},{\"geo2\":1240,\"year\":2017,\"average_household_size\":4.852751173628528,\"uid\":32},{\"geo2\":1235,\"year\":1997,\"average_household_size\":6.2,\"uid\":33},{\"geo2\":1235,\"year\":2007,\"average_household_size\":6.2,\"uid\":34},{\"geo2\":1235,\"year\":2017,\"average_household_size\":4.896873940848128,\"uid\":35},{\"geo2\":1345,\"year\":1997,\"average_household_size\":5.8,\"uid\":36},{\"geo2\":1345,\"year\":2007,\"average_household_size\":5.3,\"uid\":37},{\"geo2\":1345,\"year\":2017,\"average_household_size\":4.062633727147174,\"uid\":38},{\"geo2\":1350,\"year\":1997,\"average_household_size\":6.7,\"uid\":39},{\"geo2\":1350,\"year\":2007,\"average_household_size\":6.140665107478395,\"uid\":40},{\"geo2\":1350,\"year\":2017,\"average_household_size\":4.9213342425159174,\"uid\":41},{\"geo2\":2455,\"year\":1997,\"average_household_size\":7.2,\"uid\":42},{\"geo2\":2455,\"year\":2007,\"average_household_size\":6.700207049815977,\"uid\":43},{\"geo2\":2455,\"year\":2017,\"average_household_size\":5.74235816346341,\"uid\":44},{\"geo2\":2413,\"year\":1997,\"average_household_size\":6.9,\"uid\":45},{\"geo2\":2413,\"year\":2007,\"average_household_size\":6.461631766279024,\"uid\":46},{\"geo2\":2413,\"year\":2017,\"average_household_size\":5.601801017528494,\"uid\":47},{\"geo2\":2465,\"year\":1997,\"average_household_size\":6.9,\"uid\":48},{\"geo2\":2465,\"year\":2007,\"average_household_size\":6.403605615845472,\"uid\":49},{\"geo2\":2465,\"year\":2017,\"average_household_size\":5.702815253328704,\"uid\":50},{\"geo2\":2470,\"year\":1997,\"average_household_size\":6.9,\"uid\":51},{\"geo2\":2470,\"year\":2007,\"average_household_size\":6.272180557496988,\"uid\":52},{\"geo2\":2470,\"year\":2017,\"average_household_size\":5.595611627665119,\"uid\":53},{\"geo2\":2475,\"year\":1997,\"average_household_size\":6.9,\"uid\":54},{\"geo2\":2475,\"year\":2007,\"average_household_size\":6.470463415581003,\"uid\":55},{\"geo2\":2475,\"year\":2017,\"average_household_size\":5.659116347416889,\"uid\":56}]'),(169,'2D_wide_BuildingsCompleted',NULL,'application/vnd.ms-excel','data/2D_wide_BuildingsCompleted (1).csv',1,16,'2018-11-21 07:34:09','2018-12-13 14:43:19',NULL,NULL,NULL,NULL),(170,'2D_long_BuildingsCompleted',NULL,'application/vnd.ms-excel','data/2D_long_BuildingsCompleted.csv',2,16,'2018-11-21 07:39:34','2018-11-21 07:39:34',NULL,NULL,NULL,NULL),(171,'ABED_WIDE_DF',NULL,'application/vnd.ms-excel','data/2D_Building_NumberOfBuildingsByGovernorate.csv',1,26,'2018-11-21 15:23:30','2018-11-21 15:23:30',NULL,NULL,NULL,NULL),(172,'testing_format2',NULL,'application/vnd.ms-excel','data/Format2.csv',2,16,'2018-12-12 09:07:01','2018-12-12 09:07:01',NULL,NULL,NULL,NULL),(173,'testing_format4',NULL,'application/vnd.ms-excel','data/Format4.csv',2,16,'2018-12-12 09:15:21','2018-12-12 09:15:21',NULL,NULL,NULL,NULL),(174,'testing_format2',NULL,'application/vnd.ms-excel','data/Format2.csv',2,16,'2018-12-12 09:24:57','2018-12-12 09:24:57',NULL,NULL,NULL,NULL),(177,'Example_file',NULL,'application/vnd.ms-excel','data/Format1.xls',1,16,'2018-12-13 07:36:21','2018-12-13 07:36:21',NULL,NULL,NULL,NULL),(178,'long_N_bubble',NULL,'application/vnd.ms-excel','data/long_N_bubble23.csv',2,26,'2018-12-18 12:16:55','2018-12-18 12:16:55',NULL,NULL,NULL,'[{\"gov\":\"Jenin\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":9061,\"illiteracy\":15432,\"pop\":203026},{\"gov\":\"Jenin\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":9885,\"illiteracy\":10920,\"pop\":256619},{\"gov\":\"Jenin\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":11941,\"illiteracy\":7458,\"pop\":314866},{\"gov\":\"Tubas\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":1356,\"illiteracy\":3535,\"pop\":36609},{\"gov\":\"Tubas\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":1275,\"illiteracy\":2570,\"pop\":50261},{\"gov\":\"Tubas\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":2138,\"illiteracy\":1845,\"pop\":60927},{\"gov\":\"Tulkarm\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":5841,\"illiteracy\":10611,\"pop\":134110},{\"gov\":\"Tulkarm\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":5903,\"illiteracy\":6762,\"pop\":157988},{\"gov\":\"Tulkarm\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":8392,\"illiteracy\":4070,\"pop\":186760},{\"gov\":\"Nablus\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":9634,\"illiteracy\":17284,\"pop\":261340},{\"gov\":\"Nablus\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":10368,\"illiteracy\":11536,\"pop\":320830},{\"gov\":\"Nablus\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":13905,\"illiteracy\":7635,\"pop\":388321},{\"gov\":\"Qalqiliya\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":2764,\"illiteracy\":5761,\"pop\":72007},{\"gov\":\"Qalqiliya\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":2964,\"illiteracy\":3768,\"pop\":91217},{\"gov\":\"Qalqiliya\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":4259,\"illiteracy\":2722,\"pop\":112400},{\"gov\":\"Salfit\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":2021,\"illiteracy\":3871,\"pop\":48538},{\"gov\":\"Salfit\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":2240,\"illiteracy\":2818,\"pop\":59570},{\"gov\":\"Salfit\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":3152,\"illiteracy\":1824,\"pop\":75444},{\"gov\":\"Ramallah & Al Bireh\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":6606,\"illiteracy\":16645,\"pop\":213582},{\"gov\":\"Ramallah & Al Bireh\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":7516,\"illiteracy\":11039,\"pop\":279730},{\"gov\":\"Ramallah & Al Bireh\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":8436,\"illiteracy\":7339,\"pop\":328861},{\"gov\":\"Jericho & Al Aghwar\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":797,\"illiteracy\":2955,\"pop\":32713},{\"gov\":\"Jericho & Al Aghwar\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":918,\"illiteracy\":2098,\"pop\":42320},{\"gov\":\"Jericho & Al Aghwar\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":1430,\"illiteracy\":1662,\"pop\":50002},{\"gov\":\"Jerusalem\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":3873,\"illiteracy\":7771,\"pop\":328601},{\"gov\":\"Jerusalem\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":4552,\"illiteracy\":4375,\"pop\":363649},{\"gov\":\"Jerusalem\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":4693,\"illiteracy\":2974,\"pop\":435483},{\"gov\":\"Bethlehem\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":5009,\"illiteracy\":9830,\"pop\":137286},{\"gov\":\"Bethlehem\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":7012,\"illiteracy\":6858,\"pop\":176235},{\"gov\":\"Bethlehem\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":8625,\"illiteracy\":5066,\"pop\":217400},{\"gov\":\"Hebron\",\"year\":1997,\"region\":\"West Bank\",\"unemployment\":12016,\"illiteracy\":32610,\"pop\":405664},{\"gov\":\"Hebron\",\"year\":2007,\"region\":\"West Bank\",\"unemployment\":18859,\"illiteracy\":24804,\"pop\":552164},{\"gov\":\"Hebron\",\"year\":2017,\"region\":\"West Bank\",\"unemployment\":29449,\"illiteracy\":18753,\"pop\":711223},{\"gov\":\"North Gaza\",\"year\":1997,\"region\":\"Gaza Strip\",\"unemployment\":6624,\"illiteracy\":13235,\"pop\":183373},{\"gov\":\"North Gaza\",\"year\":2007,\"region\":\"Gaza Strip\",\"unemployment\":20051,\"illiteracy\":9384,\"pop\":270494},{\"gov\":\"North Gaza\",\"year\":2017,\"region\":\"Gaza Strip\",\"unemployment\":41131,\"illiteracy\":7050,\"pop\":368978},{\"gov\":\"Gaza\",\"year\":1997,\"region\":\"Gaza Strip\",\"unemployment\":14810,\"illiteracy\":22781,\"pop\":367388},{\"gov\":\"Gaza\",\"year\":2007,\"region\":\"Gaza Strip\",\"unemployment\":36107,\"illiteracy\":12944,\"pop\":496692},{\"gov\":\"Gaza\",\"year\":2017,\"region\":\"Gaza Strip\",\"unemployment\":68170,\"illiteracy\":9239,\"pop\":652597},{\"gov\":\"Deir Al Balah\",\"year\":1997,\"region\":\"Gaza Strip\",\"unemployment\":8049,\"illiteracy\":10718,\"pop\":147877},{\"gov\":\"Deir Al Balah\",\"year\":2007,\"region\":\"Gaza Strip\",\"unemployment\":15900,\"illiteracy\":6991,\"pop\":205414},{\"gov\":\"Deir Al Balah\",\"year\":2017,\"region\":\"Gaza Strip\",\"unemployment\":38751,\"illiteracy\":5161,\"pop\":273200},{\"gov\":\"Khan Yunis\",\"year\":1997,\"region\":\"Gaza Strip\",\"unemployment\":12159,\"illiteracy\":14752,\"pop\":200704},{\"gov\":\"Khan Yunis\",\"year\":2007,\"region\":\"Gaza Strip\",\"unemployment\":23805,\"illiteracy\":10151,\"pop\":270828},{\"gov\":\"Khan Yunis\",\"year\":2017,\"region\":\"Gaza Strip\",\"unemployment\":50100,\"illiteracy\":7246,\"pop\":370638},{\"gov\":\"Rafah\",\"year\":1997,\"region\":\"Gaza Strip\",\"unemployment\":7115,\"illiteracy\":9252,\"pop\":122865},{\"gov\":\"Rafah\",\"year\":2007,\"region\":\"Gaza Strip\",\"unemployment\":12497,\"illiteracy\":6909,\"pop\":173539},{\"gov\":\"Rafah\",\"year\":2017,\"region\":\"Gaza Strip\",\"unemployment\":34328,\"illiteracy\":5498,\"pop\":233878}]'),(180,'1Example_Agriculture',NULL,'application/vnd.ms-excel','data/6e5d3758fa4576cb02b24bb8eb8baf07.csv',2,16,'2019-01-16 10:32:04','2019-01-19 00:22:37',NULL,NULL,NULL,'[{\"geo\":\"male\",\"year\":2002,\"labor_force_percentage\":11.9,\"uid\":0},{\"geo\":\"female2\",\"year\":2002,\"labor_force_percentage\":29.9,\"uid\":1},{\"geo\":\"male\",\"year\":2003,\"labor_force_percentage\":11.9,\"uid\":2},{\"geo\":\"female\",\"year\":2003,\"labor_force_percentage\":33.7,\"uid\":3},{\"geo\":\"male\",\"year\":2004,\"labor_force_percentage\":12,\"uid\":4},{\"geo\":\"female\",\"year\":2004,\"labor_force_percentage\":33.7,\"uid\":5},{\"geo\":\"male\",\"year\":2005,\"labor_force_percentage\":11,\"uid\":6},{\"geo\":\"female\",\"year\":2005,\"labor_force_percentage\":32.5,\"uid\":7},{\"geo\":\"male\",\"year\":2006,\"labor_force_percentage\":12,\"uid\":8},{\"geo\":\"female\",\"year\":2006,\"labor_force_percentage\":34.4,\"uid\":9},{\"geo\":\"male\",\"year\":2007,\"labor_force_percentage\":10.8,\"uid\":10},{\"geo\":\"female\",\"year\":2007,\"labor_force_percentage\":36,\"uid\":11},{\"geo\":\"male\",\"year\":2008,\"labor_force_percentage\":10.1,\"uid\":12},{\"geo\":\"female\",\"year\":2008,\"labor_force_percentage\":27.5,\"uid\":13},{\"geo\":\"male\",\"year\":2009,\"labor_force_percentage\":9.9,\"uid\":14},{\"geo\":\"female\",\"year\":2009,\"labor_force_percentage\":20.5,\"uid\":15},{\"geo\":\"male\",\"year\":2010,\"labor_force_percentage\":9.9,\"uid\":16},{\"geo\":\"female\",\"year\":2010,\"labor_force_percentage\":21.4,\"uid\":17},{\"geo\":\"male\",\"year\":2011,\"labor_force_percentage\":9.7,\"uid\":18},{\"geo\":\"female\",\"year\":2011,\"labor_force_percentage\":22.2,\"uid\":19},{\"geo\":\"male\",\"year\":2012,\"labor_force_percentage\":8.9,\"uid\":20},{\"geo\":\"female\",\"year\":2012,\"labor_force_percentage\":23.7,\"uid\":21},{\"geo\":\"male\",\"year\":2013,\"labor_force_percentage\":8.5,\"uid\":22},{\"geo\":\"female\",\"year\":2013,\"labor_force_percentage\":20.9,\"uid\":23},{\"geo\":\"male\",\"year\":2014,\"labor_force_percentage\":8.2,\"uid\":24},{\"geo\":\"female\",\"year\":2014,\"labor_force_percentage\":20.9,\"uid\":25},{\"geo\":\"male\",\"year\":2015,\"labor_force_percentage\":7.8,\"uid\":26},{\"geo\":\"female\",\"year\":2015,\"labor_force_percentage\":13.1,\"uid\":27},{\"geo\":\"male\",\"year\":2016,\"labor_force_percentage\":7,\"uid\":28},{\"geo\":\"female\",\"year\":2016,\"labor_force_percentage\":9,\"uid\":29}]'),(181,'RateNumbers2',NULL,'application/vnd.ms-excel','data/8ab2a03eb6d3119437e1cdb12729ecd8.csv',2,16,'2019-01-17 07:52:44','2019-01-17 07:56:07',NULL,NULL,NULL,'[{\"gov\":\"Jenin\",\"year\":1997,\"region\":\"West Bank\",\"pop\":203026,\"unemployment\":9061,\"illiteracy\":15432,\"unemployment rate\":0.044629752,\"illiteracy rate\":0.076009969,\"uid\":0},{\"gov\":\"Jenin\",\"year\":2007,\"region\":\"West Bank\",\"pop\":256619,\"unemployment\":9885,\"illiteracy\":10920,\"unemployment rate\":0.038520141,\"illiteracy rate\":0.042553357,\"uid\":1},{\"gov\":\"Jenin\",\"year\":2017,\"region\":\"West Bank\",\"pop\":314866,\"unemployment\":11941,\"illiteracy\":7458,\"unemployment rate\":0.037924069,\"illiteracy rate\":0.023686267,\"uid\":2},{\"gov\":\"Tubas\",\"year\":1997,\"region\":\"West Bank\",\"pop\":36609,\"unemployment\":1356,\"illiteracy\":3535,\"unemployment rate\":0.037040072,\"illiteracy rate\":0.096560955,\"uid\":3},{\"gov\":\"Tubas\",\"year\":2007,\"region\":\"West Bank\",\"pop\":50261,\"unemployment\":1275,\"illiteracy\":2570,\"unemployment rate\":0.025367581,\"illiteracy rate\":0.051133085,\"uid\":4},{\"gov\":\"Tubas\",\"year\":2017,\"region\":\"West Bank\",\"pop\":60927,\"unemployment\":2138,\"illiteracy\":1845,\"unemployment rate\":0.035091175,\"illiteracy rate\":0.030282141,\"uid\":5},{\"gov\":\"Tulkarm\",\"year\":1997,\"region\":\"West Bank\",\"pop\":134110,\"unemployment\":5841,\"illiteracy\":10611,\"unemployment rate\":0.043553799,\"illiteracy rate\":0.079121617,\"uid\":6},{\"gov\":\"Tulkarm\",\"year\":2007,\"region\":\"West Bank\",\"pop\":157988,\"unemployment\":5903,\"illiteracy\":6762,\"unemployment rate\":0.037363597,\"illiteracy rate\":0.042800719,\"uid\":7},{\"gov\":\"Tulkarm\",\"year\":2017,\"region\":\"West Bank\",\"pop\":186760,\"unemployment\":8392,\"illiteracy\":4070,\"unemployment rate\":0.044934676,\"illiteracy rate\":0.021792675,\"uid\":8},{\"gov\":\"Nablus\",\"year\":1997,\"region\":\"West Bank\",\"pop\":261340,\"unemployment\":9634,\"illiteracy\":17284,\"unemployment rate\":0.036863856,\"illiteracy rate\":0.066136068,\"uid\":9},{\"gov\":\"Nablus\",\"year\":2007,\"region\":\"West Bank\",\"pop\":320830,\"unemployment\":10368,\"illiteracy\":11536,\"unemployment rate\":0.03231618,\"illiteracy rate\":0.035956737,\"uid\":10},{\"gov\":\"Nablus\",\"year\":2017,\"region\":\"West Bank\",\"pop\":388321,\"unemployment\":13905,\"illiteracy\":7635,\"unemployment rate\":0.035808004,\"illiteracy rate\":0.019661569,\"uid\":11},{\"gov\":\"Qalqiliya\",\"year\":1997,\"region\":\"West Bank\",\"pop\":72007,\"unemployment\":2764,\"illiteracy\":5761,\"unemployment rate\":0.038385157,\"illiteracy rate\":0.080006111,\"uid\":12},{\"gov\":\"Qalqiliya\",\"year\":2007,\"region\":\"West Bank\",\"pop\":91217,\"unemployment\":2964,\"illiteracy\":3768,\"unemployment rate\":0.032493943,\"illiteracy rate\":0.04130809,\"uid\":13},{\"gov\":\"Qalqiliya\",\"year\":2017,\"region\":\"West Bank\",\"pop\":112400,\"unemployment\":4259,\"illiteracy\":2722,\"unemployment rate\":0.037891459,\"illiteracy rate\":0.024217082,\"uid\":14},{\"gov\":\"Salfit\",\"year\":1997,\"region\":\"West Bank\",\"pop\":48538,\"unemployment\":2021,\"illiteracy\":3871,\"unemployment rate\":0.04163748,\"illiteracy rate\":0.079751947,\"uid\":15},{\"gov\":\"Salfit\",\"year\":2007,\"region\":\"West Bank\",\"pop\":59570,\"unemployment\":2240,\"illiteracy\":2818,\"unemployment rate\":0.03760282,\"illiteracy rate\":0.047305691,\"uid\":16},{\"gov\":\"Salfit\",\"year\":2017,\"region\":\"West Bank\",\"pop\":75444,\"unemployment\":3152,\"illiteracy\":1824,\"unemployment rate\":0.041779333,\"illiteracy rate\":0.024176873,\"uid\":17},{\"gov\":\"Ramallah & Al Bireh\",\"year\":1997,\"region\":\"West Bank\",\"pop\":213582,\"unemployment\":6606,\"illiteracy\":16645,\"unemployment rate\":0.030929573,\"illiteracy rate\":0.077932597,\"uid\":18},{\"gov\":\"Ramallah & Al Bireh\",\"year\":2007,\"region\":\"West Bank\",\"pop\":279730,\"unemployment\":7516,\"illiteracy\":11039,\"unemployment rate\":0.026868766,\"illiteracy rate\":0.039463054,\"uid\":19},{\"gov\":\"Ramallah & Al Bireh\",\"year\":2017,\"region\":\"West Bank\",\"pop\":328861,\"unemployment\":8436,\"illiteracy\":7339,\"unemployment rate\":0.025652175,\"illiteracy rate\":0.022316419,\"uid\":20},{\"gov\":\"Jericho & Al Aghwar\",\"year\":1997,\"region\":\"West Bank\",\"pop\":32713,\"unemployment\":797,\"illiteracy\":2955,\"unemployment rate\":0.024363403,\"illiteracy rate\":0.090331061,\"uid\":21},{\"gov\":\"Jericho & Al Aghwar\",\"year\":2007,\"region\":\"West Bank\",\"pop\":42320,\"unemployment\":918,\"illiteracy\":2098,\"unemployment rate\":0.021691871,\"illiteracy rate\":0.049574669,\"uid\":22},{\"gov\":\"Jericho & Al Aghwar\",\"year\":2017,\"region\":\"West Bank\",\"pop\":50002,\"unemployment\":1430,\"illiteracy\":1662,\"unemployment rate\":0.028598856,\"illiteracy rate\":0.03323867,\"uid\":23},{\"gov\":\"Jerusalem\",\"year\":1997,\"region\":\"West Bank\",\"pop\":328601,\"unemployment\":3873,\"illiteracy\":7771,\"unemployment rate\":0.011786331,\"illiteracy rate\":0.023648741,\"uid\":24},{\"gov\":\"Jerusalem\",\"year\":2007,\"region\":\"West Bank\",\"pop\":363649,\"unemployment\":4552,\"illiteracy\":4375,\"unemployment rate\":0.012517565,\"illiteracy rate\":0.012030832,\"uid\":25},{\"gov\":\"Jerusalem\",\"year\":2017,\"region\":\"West Bank\",\"pop\":435483,\"unemployment\":4693,\"illiteracy\":2974,\"unemployment rate\":0.01077654,\"illiteracy rate\":0.006829199,\"uid\":26},{\"gov\":\"Bethlehem\",\"year\":1997,\"region\":\"West Bank\",\"pop\":137286,\"unemployment\":5009,\"illiteracy\":9830,\"unemployment rate\":0.036485876,\"illiteracy rate\":0.071602348,\"uid\":27},{\"gov\":\"Bethlehem\",\"year\":2007,\"region\":\"West Bank\",\"pop\":176235,\"unemployment\":7012,\"illiteracy\":6858,\"unemployment rate\":0.039787783,\"illiteracy rate\":0.03891395,\"uid\":28},{\"gov\":\"Bethlehem\",\"year\":2017,\"region\":\"West Bank\",\"pop\":217400,\"unemployment\":8625,\"illiteracy\":5066,\"unemployment rate\":0.039673413,\"illiteracy rate\":0.023302668,\"uid\":29},{\"gov\":\"Hebron\",\"year\":1997,\"region\":\"West Bank\",\"pop\":405664,\"unemployment\":12016,\"illiteracy\":32610,\"unemployment rate\":0.029620573,\"illiteracy rate\":0.080386724,\"uid\":30},{\"gov\":\"Hebron\",\"year\":2007,\"region\":\"West Bank\",\"pop\":552164,\"unemployment\":18859,\"illiteracy\":24804,\"unemployment rate\":0.034154708,\"illiteracy rate\":0.044921436,\"uid\":31},{\"gov\":\"Hebron\",\"year\":2017,\"region\":\"West Bank\",\"pop\":711223,\"unemployment\":29449,\"illiteracy\":18753,\"unemployment rate\":0.041406141,\"illiteracy rate\":0.026367258,\"uid\":32},{\"gov\":\"North Gaza\",\"year\":1997,\"region\":\"Gaza Strip\",\"pop\":183373,\"unemployment\":6624,\"illiteracy\":13235,\"unemployment rate\":0.036123093,\"illiteracy rate\":0.072175293,\"uid\":33},{\"gov\":\"North Gaza\",\"year\":2007,\"region\":\"Gaza Strip\",\"pop\":270494,\"unemployment\":20051,\"illiteracy\":9384,\"unemployment rate\":0.074127337,\"illiteracy rate\":0.034692082,\"uid\":34},{\"gov\":\"North Gaza\",\"year\":2017,\"region\":\"Gaza Strip\",\"pop\":368978,\"unemployment\":41131,\"illiteracy\":7050,\"unemployment rate\":0.111472771,\"illiteracy rate\":0.01910683,\"uid\":35},{\"gov\":\"Gaza\",\"year\":1997,\"region\":\"Gaza Strip\",\"pop\":367388,\"unemployment\":14810,\"illiteracy\":22781,\"unemployment rate\":0.040311605,\"illiteracy rate\":0.062008013,\"uid\":36},{\"gov\":\"Gaza\",\"year\":2007,\"region\":\"Gaza Strip\",\"pop\":496692,\"unemployment\":36107,\"illiteracy\":12944,\"unemployment rate\":0.07269495,\"illiteracy rate\":0.026060416,\"uid\":37},{\"gov\":\"Gaza\",\"year\":2017,\"region\":\"Gaza Strip\",\"pop\":652597,\"unemployment\":68170,\"illiteracy\":9239,\"unemployment rate\":0.104459567,\"illiteracy rate\":0.014157282,\"uid\":38},{\"gov\":\"Deir Al Balah\",\"year\":1997,\"region\":\"Gaza Strip\",\"pop\":147877,\"unemployment\":8049,\"illiteracy\":10718,\"unemployment rate\":0.054430371,\"illiteracy rate\":0.072479155,\"uid\":39},{\"gov\":\"Deir Al Balah\",\"year\":2007,\"region\":\"Gaza Strip\",\"pop\":205414,\"unemployment\":15900,\"illiteracy\":6991,\"unemployment rate\":0.077404656,\"illiteracy rate\":0.034033708,\"uid\":40},{\"gov\":\"Deir Al Balah\",\"year\":2017,\"region\":\"Gaza Strip\",\"pop\":273200,\"unemployment\":38751,\"illiteracy\":5161,\"unemployment rate\":0.141841142,\"illiteracy rate\":0.018890922,\"uid\":41},{\"gov\":\"Khan Yunis\",\"year\":1997,\"region\":\"Gaza Strip\",\"pop\":200704,\"unemployment\":12159,\"illiteracy\":14752,\"unemployment rate\":0.060581752,\"illiteracy rate\":0.073501276,\"uid\":42},{\"gov\":\"Khan Yunis\",\"year\":2007,\"region\":\"Gaza Strip\",\"pop\":270828,\"unemployment\":23805,\"illiteracy\":10151,\"unemployment rate\":0.087897116,\"illiteracy rate\":0.037481353,\"uid\":43},{\"gov\":\"Khan Yunis\",\"year\":2017,\"region\":\"Gaza Strip\",\"pop\":370638,\"unemployment\":50100,\"illiteracy\":7246,\"unemployment rate\":0.135172324,\"illiteracy rate\":0.019550073,\"uid\":44},{\"gov\":\"Rafah\",\"year\":1997,\"region\":\"Gaza Strip\",\"pop\":122865,\"unemployment\":7115,\"illiteracy\":9252,\"unemployment rate\":0.057909087,\"illiteracy rate\":0.075302161,\"uid\":45},{\"gov\":\"Rafah\",\"year\":2007,\"region\":\"Gaza Strip\",\"pop\":173539,\"unemployment\":12497,\"illiteracy\":6909,\"unemployment rate\":0.072012631,\"illiteracy rate\":0.039812376,\"uid\":46},{\"gov\":\"Rafah\",\"year\":2017,\"region\":\"Gaza Strip\",\"pop\":233878,\"unemployment\":34328,\"illiteracy\":5498,\"unemployment rate\":0.14677738,\"illiteracy rate\":0.023507983,\"uid\":47}]');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `governorates`
--

DROP TABLE IF EXISTS `governorates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `governorates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `sort` int(11) DEFAULT NULL,
  `language` tinytext COLLATE utf8mb4_unicode_ci,
  `geojson` longtext COLLATE utf8mb4_unicode_ci,
  `latitude` tinytext COLLATE utf8mb4_unicode_ci,
  `longitude` tinytext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `governorates`
--

LOCK TABLES `governorates` WRITE;
/*!40000 ALTER TABLE `governorates` DISABLE KEYS */;
INSERT INTO `governorates` VALUES (1,'Jenin','',0,'en','map.geojson','32.464635','35.293859',1,'2018-03-29 18:08:17','2018-05-21 09:49:03',NULL,NULL),(2,'Nablus','',0,'en','nablus.geojson','32.2243446','35.2301697',1,'2018-03-29 18:08:21','2018-11-28 12:44:06',NULL,NULL),(3,'Hebron','Hebron (Arabic: الْخَلِيل‎) is a Palestinian city located in the southern West Bank, 30 km (19 mi) south of Jerusalem. Nestled in the Judaean Mountains, it lies 930 meters (3,050 ft) above sea level. The largest city in the West Bank, and the second largest in the Palestinian territories after Gaza, it has a population of 215,452 Palestinians (2016).',0,'en',NULL,'31.532569','35.099826',1,'2018-03-29 18:08:23','2018-05-21 09:02:18',NULL,NULL),(4,'Tulkarm','Tulkarm description',0,'en',NULL,'32.319405','35.023986',1,'2018-03-29 18:54:35','2018-05-21 09:42:00',NULL,NULL),(5,'Tubas','',0,'en',NULL,'32.321086','35.369953',1,'2018-03-29 18:54:40','2018-05-19 01:13:59',NULL,NULL),(6,'Qalqilya','',NULL,'en',NULL,NULL,NULL,1,'2018-03-29 18:54:49',NULL,NULL,NULL),(7,'Salfit','',0,'en',NULL,'32.0851114','35.1720772',1,'2018-03-29 18:54:55','2018-11-28 12:46:58',NULL,NULL),(8,'Ramallah and al-Bireh','',0,'en',NULL,'31.9073861','35.1883724',1,'2018-03-29 18:55:07','2018-11-28 12:53:45',NULL,NULL),(9,'Jericho','',0,'en',NULL,'31.8595075','35.4469982',1,'2018-03-29 18:55:11','2018-11-28 12:52:04',NULL,NULL),(10,'Jerusalem','',0,'en',NULL,'31.7964453','35.1053187',1,'2018-03-29 18:55:16','2018-11-28 12:55:35',NULL,NULL),(11,'Bethlehem','',0,'en',NULL,'31.7053996','35.1936877',1,'2018-03-29 18:55:20','2018-11-28 12:57:31',NULL,NULL),(12,'Rafah','Rafah',0,'en',NULL,'31.2967975','34.2347272',6,'2018-04-10 20:14:03','2018-11-28 13:59:03',NULL,NULL),(13,'Khan Yunis','',0,'en',NULL,'31.344107846900663','34.3030071258545',6,'2018-04-10 20:15:41','2018-11-21 16:45:17',NULL,NULL),(14,'Deir Al - Balah','',0,'en',NULL,'31.4171565','34.3421762',6,'2018-04-10 20:15:53','2018-11-28 13:01:56',NULL,NULL),(15,'Gaza','',0,'en',NULL,'31.5017126','34.4580897',6,'2018-04-10 20:16:04','2018-11-28 14:03:39',NULL,NULL),(16,'North Gaza','',0,'en',NULL,'31.5513065','34.5004672',6,'2018-04-10 20:16:20','2018-11-28 14:04:52',NULL,NULL),(17,'جنين','محافظة جنين محافظة تقع في شمال الضفة الغربية التابعة للسلطة الفلسطينية ومركزها مدينة جنين.',0,'ar','map.geojson','35.29495239257812','32.46052917950643',10,'2018-05-09 09:07:25','2018-05-09 09:07:25',NULL,NULL),(18,'طوباس','محافظة طوباس ويُطلق عليها أيضًا محافظة طوباس والأغوار الشمالية هي محافظة فلسطينية، مركزها مدينة طوباس.',0,'ar','tubas.geojson','35.36773681640625','32.319633552035214',10,'2018-05-09 09:14:45','2018-05-09 09:14:45',NULL,NULL),(19,'طولكرم','حافظة طولكرم هي محافظة فلسطينية تابعة للسلطة الوطنية الفلسطينية وتقع في الضفة الغربية وتحديداً في شمال غرب الضفة الغربية. ',0,'ar','map.geojson','35.02763271331787','32.311581955172265',10,'2018-05-09 09:19:18','2018-05-09 09:19:18',NULL,NULL),(20,'نابلس','محافظة نابلس إحدى محافظات السلطة الوطنية الفلسطينية و تقع في شمال الضفة الغربية و تبعد 53 كم عن القدس. مركزها مدينة نابلس.',0,'ar','nablus.geojson','35.257530212402344','32.22049836910357',10,'2018-05-09 09:22:30','2018-05-09 09:22:30',NULL,NULL),(21,'قلقيلية','محافظة قلقيلية وهي واحدة من المحافظات التابعة للسلطة الوطنية الفلسطينية في الضفة الغربية شمال غرب البلاد. وتقع على الحدود مع الخط الأخضر.',0,'ar',NULL,'','',10,'2018-05-09 14:02:00','2018-05-09 14:02:00',NULL,NULL),(22,'سلفيت','محافظة سلفيت واحدة من المحافظات الستة عشر التابعة للسلطة الوطنية الفلسطينية، مركزها مدينة سلفيت',0,'ar',NULL,'32.0851114','35.1720772',10,'2018-05-09 14:02:32','2018-11-28 12:49:07',NULL,NULL),(23,'رام الله والبيرة','محافظة رام الله والبيرة تقسيم إداري بني على أساس أن المدينتين الشقيقتين متلاصقتين لدرجة أنهما تبدوان كمدينة واحدة. ',0,'ar',NULL,'31.9073861','35.1883724',10,'2018-05-09 14:03:09','2018-11-28 12:54:24',NULL,NULL),(24,'أريحا','محافظة أريحا هي واحدة من 16 محافظات تابعة للسلطة الوطنية الفلسطينية داخل الأراضي الفلسطينية',0,'ar',NULL,'31.8595075','35.4469982',10,'2018-05-09 14:03:48','2018-11-28 12:52:47',NULL,NULL),(25,'القدس','',0,'ar',NULL,'31.7964453','35.1053187',10,'2018-05-09 14:06:08','2018-11-28 12:56:48',NULL,NULL),(26,'بيت لحم','محافظة بيت لحم هي واحدة من 16 محافظة في الضفة الغربية وقطاع غزة داخل الأراضي الفلسطينية.',0,'ar',NULL,'31.7053996','35.1936877',10,'2018-05-09 14:06:38','2018-11-28 12:58:14',NULL,NULL),(27,'الخليل','محافظة الخليل هي محافظة فلسطينية واقعة في جنوب الضفة الغربية وتبلغ مساحتها 997 كم² ',0,'ar',NULL,'31.5325865','35.0910712',10,'2018-05-09 14:06:58','2018-11-28 12:59:36',NULL,NULL),(28,'شمال غزة','محافظة شمال غزة هي أحد المحافظات في قطاع غزة. تولت السلطة الفلسطينية إدارة المحافظة تطبيقا لاتفاق أوسلو سنة 1993 بعد أن كانت تتخذها قوات الجيش الإسرائيلي مقرا لها أثناء احتلال قطاع غزة ما بين 1967 و1994.',0,'ar',NULL,'31.5513065','34.5004672',10,'2018-05-09 14:08:26','2018-11-28 15:21:23',NULL,NULL),(29,'غزة','محافظة غزة هي واحدة من 16 محافظة من محافظات السلطة الوطنية الفلسطينية تقع في شمال قطاع غزة الذي تديره السلطة الوطنية الفلسطينية.',0,'ar',NULL,'31.5017126','34.4580897',10,'2018-05-09 14:08:57','2018-11-28 14:04:26',NULL,NULL),(30,'خان يونس','خان يونس هي مدينة فلسطينية، ومركز محافظة خان يونس. تقع في الجزء الجنوبي من قطاع غزة، وتبعد عن القدس مسافة 100 كم إلى الجنوب الغربي.',0,'ar',NULL,'31.3462181','34.2952438',10,'2018-05-09 14:09:49','2018-11-28 13:01:07',NULL,NULL),(31,'رفح','',0,'ar',NULL,'31.2967975','34.2347272',10,'2018-05-09 14:10:19','2018-11-28 14:00:03',NULL,NULL),(32,'دير البلح','0',0,'ar',NULL,'31.4171565','34.3421762',26,'2018-11-28 13:57:20','2018-11-28 13:57:20',NULL,NULL);
/*!40000 ALTER TABLE `governorates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indicators`
--

DROP TABLE IF EXISTS `indicators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indicators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indicators`
--

LOCK TABLES `indicators` WRITE;
/*!40000 ALTER TABLE `indicators` DISABLE KEYS */;
INSERT INTO `indicators` VALUES (1,'No. of Population in Palestine','1.5%','analytics.svg',0,'en',1,'2018-04-07 21:37:35','2018-05-09 14:46:48',NULL,NULL),(2,'No. of Population in Gaza Strip','1899291','bar-chart (1).svg',0,'en',1,'2018-04-07 21:37:55','2018-05-09 14:47:04',NULL,NULL),(3,'Population Density (individual/km2)','2424','bar-chart.svg',0,'en',1,'2018-04-07 21:38:03','2018-05-09 14:47:20',NULL,NULL),(4,'No. of households','929139','graph (1).svg',4,'en',6,'2018-04-10 09:35:25','2018-05-09 17:15:29',NULL,NULL),(5,'Percentage of population aged 0-17 yrs','453','graph.svg',5,'en',6,'2018-04-10 09:35:51','2018-05-09 17:16:06',NULL,NULL),(6,'Percentage of population aged 18-29 yrs','24.3','graph (2).svg',5,'en',6,'2018-04-10 09:36:38','2018-05-09 17:18:02',NULL,NULL),(7,'عدد السكان في فلسطين','1.5%','analytics.svg',0,'ar',10,'2018-04-24 23:02:02','2018-05-09 17:45:11',NULL,NULL),(8,'عدد السكان في قطاع غزة','١٨٩٩٢٩','bar-chart (1).svg',0,'ar',10,'2018-04-24 23:03:00','2018-05-09 17:45:28',NULL,NULL),(9,'الكثافة السكانية (فرد / كم 2)','٢٤٢٤','bar-chart.svg',0,'ar',10,'2018-04-24 23:03:43','2018-05-14 17:55:24',NULL,NULL),(10,'عدد الأسر','٩٢٩١٣٩','graph (1).svg',4,'ar',10,'2018-04-24 23:04:18','2018-05-09 17:45:40',NULL,NULL),(11,'نسبة السكان الذين تتراوح أعمارهم بين 0-17 سنة','٤٥٣','graph (2).svg',5,'ar',10,'2018-04-24 23:05:28','2018-05-09 17:45:47',NULL,NULL),(12,'النسبة المئوية للسكان الذين تتراوح أعمارهم بين 18-29 سنة','٢٤٫٣','graph.svg',5,'ar',10,'2018-04-24 23:06:16','2018-05-09 17:19:12',NULL,NULL),(13,'Adham Test ','20.32%','Average Household Size.svg',1,'en',6,'2018-05-14 10:14:37','2018-05-14 17:45:04',NULL,'2018-05-14 17:45:04'),(14,'ttt','ttt','bar-chart.svg',0,'en',6,'2018-05-21 10:04:55','2018-05-21 10:04:55',NULL,NULL),(15,'test','1.0','Distribution of employees in the establishments femal.svg',1,'en',6,'2018-06-05 07:50:20','2018-06-05 07:50:20',NULL,NULL);
/*!40000 ALTER TABLE `indicators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitations` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invitations_token_unique` (`token`),
  KEY `invitations_team_id_index` (`team_id`),
  KEY `invitations_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitations`
--

LOCK TABLES `invitations` WRITE;
/*!40000 ALTER TABLE `invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_created_at_index` (`created_at`),
  KEY `invoices_user_id_index` (`user_id`),
  KEY `invoices_team_id_index` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Contact','contact',NULL,'header','en',4,1,NULL,'2018-04-07 22:02:57',NULL,'2018-04-07 22:02:57'),(2,'About','/about',NULL,'primary',NULL,3,1,NULL,'2018-04-07 22:03:00',NULL,'2018-04-07 22:03:00'),(3,'Library','/library',NULL,'header','en',1,1,NULL,NULL,NULL,NULL),(4,'News','/news',NULL,'header','en',3,1,NULL,'2018-04-07 22:02:53',NULL,'2018-04-07 22:02:53'),(5,'Main PCBS Site','http://pcbs.gov.ps',NULL,'footer','en',NULL,1,NULL,NULL,NULL,NULL),(11,'News','/news',NULL,'header','en',2,1,NULL,NULL,NULL,NULL),(12,'Stories','/stories',NULL,'header','en',3,1,NULL,NULL,NULL,NULL),(13,'Topics','/topics',NULL,'header','en',4,0,'2018-04-15 07:48:54','2018-05-07 11:27:43',NULL,'2018-05-07 11:27:43'),(14,'المكتبة','/library',NULL,'header','ar',1,0,'2018-04-24 23:07:03','2018-04-24 23:07:03',NULL,NULL),(15,'موقع PCBS الرئيسي','http://pcbs.gov.ps',NULL,'footer','ar',0,0,'2018-04-24 23:13:26','2018-04-24 23:13:26',NULL,NULL),(16,'الأخبار','/news',NULL,'header','ar',2,0,'2018-04-24 23:14:05','2018-04-24 23:14:05',NULL,NULL),(17,'مقالات','/stories',NULL,'header','ar',3,0,'2018-04-24 23:14:48','2018-04-24 23:14:48',NULL,NULL),(18,'المواضيع','/topics',NULL,'header','ar',4,0,'2018-04-24 23:15:32','2018-05-09 09:09:04',NULL,'2018-05-09 09:09:04'),(19,'MENUSI','/menusi',NULL,'header','en',5,0,'2018-11-21 13:04:13','2018-11-21 13:04:31',NULL,'2018-11-21 13:04:31');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017_09_10_072707_create_performance_indicators_table',1),(2,'2017_09_10_072708_create_announcements_table',1),(3,'2017_09_10_072710_create_users_table',1),(4,'2017_09_10_072713_create_password_resets_table',1),(5,'2017_09_10_072717_create_api_tokens_table',1),(6,'2017_09_10_072722_create_subscriptions_table',1),(7,'2017_09_10_072728_create_invoices_table',1),(8,'2017_09_10_072735_create_notifications_table',1),(9,'2017_09_10_072743_create_teams_table',1),(10,'2017_09_10_072752_create_team_users_table',1),(11,'2017_09_10_072802_create_invitations_table',1),(12,'2018_04_07_100654_create_datasets_table',1),(13,'2018_04_07_101248_create_dataset_governorate_table',1),(14,'2018_04_07_101301_create_dataset_topic_table',1),(15,'2018_04_07_101312_create_dataset_file_table',1),(16,'2018_04_07_101448_create_topics_table',1),(17,'2018_04_07_101621_create_governorates_table',1),(18,'2018_04_07_101719_create_files_table',1),(19,'2018_04_07_101818_create_menus_table',1),(20,'2018_04_07_101939_create_posts_table',1),(21,'2018_04_07_102217_create_settings_table',1),(22,'2018_04_07_102256_create_widgets_table',1),(23,'2018_04_07_102857_create_social_accounts_table',1),(24,'2018_04_07_111633_create_favorites_table',1),(25,'2018_04_07_192034_create_periods_table',1),(26,'2018_04_07_192045_create_dataset_period_table',1),(27,'2018_04_15_073521_create_dataset_post_table',1),(28,'2018_04_24_082539_create_indicators_table',1),(29,'2018_05_07_110648_create_dataset_indicator_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` text COLLATE utf8mb4_unicode_ci,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_created_at_index` (`user_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `performance_indicators`
--

DROP TABLE IF EXISTS `performance_indicators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `performance_indicators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monthly_recurring_revenue` decimal(8,2) NOT NULL,
  `yearly_recurring_revenue` decimal(8,2) NOT NULL,
  `daily_volume` decimal(8,2) NOT NULL,
  `new_users` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `performance_indicators_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performance_indicators`
--

LOCK TABLES `performance_indicators` WRITE;
/*!40000 ALTER TABLE `performance_indicators` DISABLE KEYS */;
/*!40000 ALTER TABLE `performance_indicators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periods`
--

DROP TABLE IF EXISTS `periods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `sort` int(11) DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periods`
--

LOCK TABLES `periods` WRITE;
/*!40000 ALTER TABLE `periods` DISABLE KEYS */;
INSERT INTO `periods` VALUES (1,'1997 - 2017','',0,'en',1,'2018-04-07 22:11:30','2018-04-07 22:11:30',NULL,NULL),(2,'2018','',0,'en',1,'2018-04-07 22:11:34','2018-04-10 09:17:07',NULL,'2018-04-10 09:17:07'),(3,'2003','',0,'en',1,'2018-04-07 22:11:38','2018-04-07 22:11:38',NULL,NULL),(4,'1997','census 1997',0,'en',6,'2018-04-10 08:59:25','2018-04-10 08:59:25',NULL,NULL),(5,'2007','census 2007',1,'en',6,'2018-04-10 08:59:39','2018-04-10 08:59:39',NULL,NULL),(6,'2017','census 2017',2,'en',6,'2018-04-10 08:59:51','2018-04-10 08:59:51',NULL,NULL),(7,'2018','2018',10,'en',6,'2018-04-10 09:20:25','2018-04-10 09:21:19',NULL,'2018-04-10 09:21:19'),(8,'1997','1997',0,'en',6,'2018-04-10 11:55:01','2018-04-10 11:55:01',NULL,NULL),(9,'1991','1991',1,'en',6,'2018-04-10 19:41:34','2018-04-10 19:41:34',NULL,NULL),(10,'1997-2003','',0,'ar',10,'2018-05-09 10:44:17','2018-05-14 11:14:03',NULL,NULL),(11,'2000','',0,'en',10,'2018-05-09 10:46:37','2018-05-09 10:46:37',NULL,NULL);
/*!40000 ALTER TABLE `periods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subline` longtext COLLATE utf8mb4_unicode_ci,
  `summary` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `comments` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Featured Story','Morbi vel cursus','In ipsum velit, scelerisque non tortor sed, dictum mattis quam. Ut facilisis interdum nulla a lobortis. Sed ultricies, quam ut fringilla pellentesque, massa massa vulputate dolor, sit amet bibendum elit augue non erat.','<p>Nulla facilisi. In ipsum velit, scelerisque non tortor sed, dictum mattis quam. Ut facilisis interdum nulla a lobortis. Sed ultricies, quam ut fringilla pellentesque, massa massa vulputate dolor, sit amet bibendum elit augue non erat. Integer fringilla vitae odio nec laoreet. Aenean eget ligula a sem dictum tempor. Sed commodo massa convallis felis porta, nec pellentesque nibh efficitur. Sed sit amet ornare nisl. Cras sodales eros lorem, quis mollis nisi congue in. Sed eu scelerisque turpis. Nullam at quam mollis, ullamcorper orci a, ultricies lacus.</p><p>Morbi fermentum urna eu imperdiet aliquet. Proin congue elit turpis. Sed semper orci vel quam placerat posuere. Aenean velit magna, accumsan a placerat eget, fringilla in justo. Duis ac nisi non orci ullamcorper vehicula. Aliquam cursus bibendum justo, porta vehicula urna feugiat id. Curabitur ullamcorper ullamcorper viverra. Praesent vestibulum ex vitae aliquam feugiat. Pellentesque justo leo, porttitor nec ipsum eu, malesuada aliquam lectus. Mauris maximus dictum luctus. Praesent vestibulum porttitor ornare. Cras interdum, turpis in dictum rutrum, nunc leo rhoncus diam, ac suscipit risus dui ullamcorper lorem. Ut bibendum rutrum dui quis semper. Morbi sed diam a felis porttitor viverra. In sit amet diam vitae enim semper tempus porta interdum ex. Morbi non urna sit amet massa semper sodales a a tortor.</p>','en',1,1,0,'stories','ola_tv.png',1,'2018-04-07 22:04:25','2018-04-24 19:43:35',NULL,NULL),(2,'Census 2017 - Haitham','Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec commodo orci. Quisque commodo interdum leo, id pellentesque magna aliquam.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus dui eget ipsum sodales euismod. Cras pretium arcu dui. Nam convallis convallis ligula, in consequat metus posuere eu. Sed accumsan justo at fringilla aliquam. Aenean imperdiet consectetur purus nec laoreet. Integer consequat ac orci a iaculis. Nam luctus ex mi. Suspendisse potenti. Integer malesuada condimentum condimentum. Curabitur luctus dui vitae scelerisque ullamcorper.</p><p>Etiam quam arcu, vestibulum nec tortor et, lobortis lobortis elit. Maecenas porta suscipit purus bibendum elementum. Aenean nibh magna, venenatis at consequat sed, venenatis eget sem. Integer viverra velit in dui molestie, ut porttitor leo hendrerit. Cras non blandit felis. Duis interdum elementum metus a feugiat. Sed commodo, tellus sit amet semper sollicitudin, ipsum lacus luctus lacus, ut pulvinar nunc felis id velit. Nulla a sem nec libero auctor ultrices a id dolor. Vivamus in dapibus turpis, eget malesuada tortor. Curabitur ullamcorper turpis vel dolor finibus, sed venenatis enim commodo. Curabitur sagittis cursus hendrerit.</p>','en',1,0,1,'news','placeholder.jpg',19,'2018-04-07 22:04:25','2018-04-24 15:05:47',NULL,NULL),(3,'Featured Story 2','Suspendisse efficitur','Curabitur ullamcorper ullamcorper viverra. Praesent vestibulum ex vitae aliquam feugiat. Pellentesque justo leo, porttitor nec ipsum eu, malesuada aliquam lectus.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel cursus purus. Pellentesque feugiat nunc iaculis enim pharetra, ut vestibulum erat vestibulum. Aliquam vel tincidunt urna. Suspendisse efficitur egestas nisi, at rutrum arcu vulputate eu. Nulla quis ultrices odio. Suspendisse ornare odio a dolor congue, in mattis est fringilla. Pellentesque eu efficitur tortor, ut molestie quam. Fusce quis mi in nunc fermentum cursus.</p><p>Nulla facilisi. In ipsum velit, scelerisque non tortor sed, dictum mattis quam. Ut facilisis interdum nulla a lobortis. Sed ultricies, quam ut fringilla pellentesque, massa massa vulputate dolor, sit amet bibendum elit augue non erat. Integer fringilla vitae odio nec laoreet. Aenean eget ligula a sem dictum tempor. Sed commodo massa convallis felis porta, nec pellentesque nibh efficitur. Sed sit amet ornare nisl. Cras sodales eros lorem, quis mollis nisi congue in. Sed eu scelerisque turpis. Nullam at quam mollis, ullamcorper orci a, ultricies lacus.</p><p>Morbi fermentum urna eu imperdiet aliquet. Proin congue elit turpis. Sed semper orci vel quam placerat posuere. Aenean velit magna, accumsan a placerat eget, fringilla in justo. Duis ac nisi non orci ullamcorper vehicula. Aliquam cursus bibendum justo, porta vehicula urna feugiat id. Curabitur ullamcorper ullamcorper viverra. Praesent vestibulum ex vitae aliquam feugiat.</p>','en',1,1,0,'stories','placeholder.jpg',1,'2018-04-07 22:04:25','2018-04-24 19:44:59',NULL,NULL),(4,'Featured Story 3','Integer ut posuere risus','Cras malesuada mollis gravida. Donec feugiat fringilla velit eu gravida. Nam tincidunt lectus non quam lacinia, sit amet laoreet tellus dictum. Praesent laoreet lacinia est ac accumsan. Phasellus a dolor nec quam lobortis malesuada sit amet condimentum dui.','<p>Vivamus interdum orci dui, nec viverra purus luctus vel. Morbi ornare varius ornare. Nulla eget augue iaculis, dapibus lectus non, lacinia ligula. Proin ornare sollicitudin ex. Praesent justo orci, imperdiet ac tincidunt nec, viverra sit amet mi. Praesent commodo lectus consectetur dapibus porttitor. Aliquam et enim sed neque bibendum vulputate vel id mi. Pellentesque vel facilisis ipsum, non faucibus sem. Mauris sodales et ex vel viverra. Maecenas ultrices semper lacus ac convallis. Vestibulum aliquet in mauris quis auctor. Nullam cursus imperdiet lorem et consequat. Suspendisse blandit elit vitae sapien ultrices tristique.</p><p>Proin ipsum nisi, dapibus in eros at, convallis finibus ligula. Morbi non vestibulum lorem, ac finibus velit. In sagittis leo vel ipsum consectetur, non venenatis dui tristique. Quisque at mi sagittis, elementum nulla vel, pretium purus. Vivamus sit amet lorem ut metus venenatis pellentesque. Proin porta bibendum quam, eu dapibus sem ornare vitae. Praesent imperdiet turpis id erat commodo, id dignissim arcu tincidunt. Fusce euismod rutrum ipsum sit amet blandit. Donec aliquet est at volutpat imperdiet. Vivamus posuere velit id risus porta euismod. Suspendisse sodales dui id purus ultrices fringilla. Cras malesuada mollis gravida. Donec feugiat fringilla velit eu gravida. Nam tincidunt lectus non quam lacinia, sit amet laoreet tellus dictum. Praesent laoreet lacinia est ac accumsan. Phasellus a dolor nec quam lobortis malesuada sit amet condimentum dui.</p><p>Integer ut posuere risus. Etiam volutpat, nisl malesuada bibendum varius, ante mauris sollicitudin mauris, nec finibus mauris erat fringilla ipsum. Vestibulum in maximus dui, a faucibus nulla. Morbi vel eleifend eros. Donec pulvinar diam quis volutpat fringilla. Curabitur id venenatis ligula. Aenean a erat fringilla, maximus risus id, semper velit. Sed dictum vestibulum mi, eget iaculis metus iaculis iaculis. Phasellus pulvinar ac arcu id malesuada. Etiam rutrum semper luctus. Nunc at quam finibus, bibendum urna eget, feugiat magna. Maecenas sit amet convallis metus, a congue nibh. Integer finibus ipsum in velit aliquam, eget accumsan lectus ultricies. Mauris egestas maximus bibendum. Vestibulum in felis hendrerit, gravida augue ut, convallis justo.</p>','en',1,1,0,'stories','placeholder.jpg',1,'2018-04-07 22:04:25','2018-04-24 19:45:48',NULL,NULL),(5,'Featured News','Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec commodo orci. Quisque commodo interdum leo, id pellentesque magna aliquam.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus dui eget ipsum sodales euismod. Cras pretium arcu dui. Nam convallis convallis ligula, in consequat metus posuere eu. Sed accumsan justo at fringilla aliquam. Aenean imperdiet consectetur purus nec laoreet. Integer consequat ac orci a iaculis. Nam luctus ex mi. Suspendisse potenti. Integer malesuada condimentum condimentum. Curabitur luctus dui vitae scelerisque ullamcorper.</p><p>Etiam quam arcu, vestibulum nec tortor et, lobortis lobortis elit. Maecenas porta suscipit purus bibendum elementum. Aenean nibh magna, venenatis at consequat sed, venenatis eget sem. Integer viverra velit in dui molestie, ut porttitor leo hendrerit. Cras non blandit felis. Duis interdum elementum metus a feugiat. Sed commodo, tellus sit amet semper sollicitudin, ipsum lacus luctus lacus, ut pulvinar nunc felis id velit. Nulla a sem nec libero auctor ultrices a id dolor. Vivamus in dapibus turpis, eget malesuada tortor. Curabitur ullamcorper turpis vel dolor finibus, sed venenatis enim commodo. Curabitur sagittis cursus hendrerit.</p>','en',1,1,0,'news','placeholder.jpg',19,'2018-04-07 22:04:25','2018-04-24 15:06:52',NULL,NULL),(6,'Featured News 2','Duis nisi quam','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nisi quam, bibendum eu sem quis, congue euismod quam. Suspendisse porttitor mauris nunc, ac convallis neque tincidunt eget. Sed odio est.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus dui eget ipsum sodales euismod. Cras pretium arcu dui. Nam convallis convallis ligula, in consequat metus posuere eu. Sed accumsan justo at fringilla aliquam. Aenean imperdiet consectetur purus nec laoreet. Integer consequat ac orci a iaculis. Nam luctus ex mi. Suspendisse potenti. Integer malesuada condimentum condimentum. Curabitur luctus dui vitae scelerisque ullamcorper.</p><p>Etiam quam arcu, vestibulum nec tortor et, lobortis lobortis elit. Maecenas porta suscipit purus bibendum elementum. Aenean nibh magna, venenatis at consequat sed, venenatis eget sem. Integer viverra velit in dui molestie, ut porttitor leo hendrerit. Cras non blandit felis. Duis interdum elementum metus a feugiat. Sed commodo, tellus sit amet semper sollicitudin, ipsum lacus luctus lacus, ut pulvinar nunc felis id velit. Nulla a sem nec libero auctor ultrices a id dolor. Vivamus in dapibus turpis, eget malesuada tortor. Curabitur ullamcorper turpis vel dolor finibus, sed venenatis enim commodo. Curabitur sagittis cursus hendrerit.</p>','en',1,1,0,'news','placeholder.jpg',1,'2018-04-07 22:04:25','2018-04-24 15:07:44',NULL,NULL),(7,'Featured News 3','Morbi vel cursus','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec commodo orci. Quisque commodo interdum leo, id pellentesque magna aliquam.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel cursus purus. Pellentesque feugiat nunc iaculis enim pharetra, ut vestibulum erat vestibulum. Aliquam vel tincidunt urna. Suspendisse efficitur egestas nisi, at rutrum arcu vulputate eu. Nulla quis ultrices odio. Suspendisse ornare odio a dolor congue, in mattis est fringilla. Pellentesque eu efficitur tortor, ut molestie quam. Fusce quis mi in nunc fermentum cursus.</p><p>Nulla facilisi. In ipsum velit, scelerisque non tortor sed, dictum mattis quam. Ut facilisis interdum nulla a lobortis. Sed ultricies, quam ut fringilla pellentesque, massa massa vulputate dolor, sit amet bibendum elit augue non erat. Integer fringilla vitae odio nec laoreet. Aenean eget ligula a sem dictum tempor. Sed commodo massa convallis felis porta, nec pellentesque nibh efficitur. Sed sit amet ornare nisl. Cras sodales eros lorem, quis mollis nisi congue in. Sed eu scelerisque turpis. Nullam at quam mollis, ullamcorper orci a, ultricies lacus.</p><p>Morbi fermentum urna eu imperdiet aliquet. Proin congue elit turpis. Sed semper orci vel quam placerat posuere. Aenean velit magna, accumsan a placerat eget, fringilla in justo. Duis ac nisi non orci ullamcorper vehicula. Aliquam cursus bibendum justo, porta vehicula urna feugiat id. Curabitur ullamcorper ullamcorper viverra. Praesent vestibulum ex vitae aliquam feugiat. Pellentesque justo leo, porttitor nec ipsum eu, malesuada aliquam lectus. Mauris maximus dictum luctus. Praesent vestibulum porttitor ornare. Cras interdum, turpis in dictum rutrum, nunc leo rhoncus diam, ac suscipit risus dui ullamcorper lorem. Ut bibendum rutrum dui quis semper. Morbi sed diam a felis porttitor viverra. In sit amet diam vitae enim semper tempus porta interdum ex. Morbi non urna sit amet massa semper sodales a a tortor.</p>','en',1,1,0,'news','placeholder.jpg',1,'2018-04-07 22:04:25','2018-04-24 19:43:01',NULL,NULL),(8,'No. of Population in Palestine 4,780,978','No. of Population in West Bank No. of Population in Gaza Strip','4,780,978	No. of Population in Palestine\r\n2,881,687	No. of Population in West Bank\r\n1,899,291	No. of Population in Gaza Strip\r\n','<p>Sed sollicitudin, ante nec rutrum bibendum, diam purus tincidunt libero, quis hendrerit nisi massa in nisi. Fusce rutrum tincidunt erat, ut efficitur est tempus sit amet. Nullam imperdiet mi vel tortor lacinia, quis facilisis nibh posuere. Ut posuere sollicitudin mattis. Phasellus dictum arcu vitae risus malesuada, euismod iaculis quam maximus. In nunc neque, tempor non risus quis, imperdiet varius mi. Phasellus at nisl non purus vehicula elementum. Proin vitae fermentum enim, hendrerit dapibus lorem. Donec neque ligula, porta lobortis ultricies ac, lacinia sed velit.</p><p>Vivamus mattis lorem vitae justo laoreet, ac eleifend magna accumsan. Quisque lacus lacus, sodales et finibus at, hendrerit id sapien. Ut non purus consectetur nisi volutpat vulputate. Aenean fringilla odio metus, semper rhoncus enim lobortis tincidunt. Etiam a sapien mollis, tincidunt augue finibus, venenatis felis. Cras vestibulum enim in ante venenatis, non convallis enim eleifend. Pellentesque congue libero lacus, in feugiat arcu pulvinar non. Suspendisse ultrices dictum finibus. Nam semper felis metus, sed facilisis leo mattis eu. Quisque at ornare leo, in lacinia metus. Maecenas commodo efficitur ex in efficitur. Praesent ligula tortor, ullamcorper quis consectetur nec, cursus at lectus.</p>','en',1,1,0,'stories',NULL,19,'2018-04-07 22:04:25','2018-04-24 19:52:01',NULL,NULL),(9,'No. of Population in Palestine 4,780,978','','','','en',1,1,0,'news',NULL,19,'2018-04-07 22:04:25','2018-04-05 10:22:26',NULL,NULL),(10,'Test from Haitham 77777','','','','en',1,1,0,'news',NULL,19,'2018-04-07 22:04:25','2018-04-05 10:25:56',NULL,NULL),(11,'Housing','Pellentesque eu dolor','Integer felis mauris, gravida ac neque elementum, volutpat bibendum urna.','<p>Vivamus mattis lorem vitae justo laoreet, ac eleifend magna accumsan. Quisque lacus lacus, sodales et finibus at, hendrerit id sapien. Ut non purus consectetur nisi volutpat vulputate. Aenean fringilla odio metus, semper rhoncus enim lobortis tincidunt. Etiam a sapien mollis, tincidunt augue finibus, venenatis felis. Cras vestibulum enim in ante venenatis, non convallis enim eleifend. Pellentesque congue libero lacus, in feugiat arcu pulvinar non. Suspendisse ultrices dictum finibus.&nbsp;</p>','en',1,0,0,'topics','Average Household Size Gaza Strip.svg',0,'2018-04-15 07:49:41','2018-04-24 19:56:08',NULL,NULL),(12,'Illiteracy & Unemployment','Proin ornare','Maecenas ultrices semper lacus ac convallis. Vestibulum aliquet in mauris quis auctor. Nullam cursus imperdiet lorem et consequat. Suspendisse blandit elit vitae sapien ultrices tristique.','<p>Vivamus interdum orci dui, nec viverra purus luctus vel. Morbi ornare varius ornare. Nulla eget augue iaculis, dapibus lectus non, lacinia ligula. Proin ornare sollicitudin ex. Praesent justo orci, imperdiet ac tincidunt nec, viverra sit amet mi. Praesent commodo lectus consectetur dapibus porttitor. Aliquam et enim sed neque bibendum vulputate vel id mi. Pellentesque vel facilisis ipsum, non faucibus sem. Mauris sodales et ex vel viverra. Maecenas ultrices semper lacus ac convallis. Vestibulum aliquet in mauris quis auctor. Nullam cursus imperdiet lorem et consequat. Suspendisse blandit elit vitae sapien ultrices tristique.</p><p>Proin ipsum nisi, dapibus in eros at, convallis finibus ligula. Morbi non vestibulum lorem, ac finibus velit. In sagittis leo vel ipsum consectetur, non venenatis dui tristique. Quisque at mi sagittis, elementum nulla vel, pretium purus. Vivamus sit amet lorem ut metus venenatis pellentesque. Proin porta bibendum quam, eu dapibus sem ornare vitae. Praesent imperdiet turpis id erat commodo, id dignissim arcu tincidunt. Fusce euismod rutrum ipsum sit amet blandit. Donec aliquet est at volutpat imperdiet. Vivamus posuere velit id risus porta euismod. Suspendisse sodales dui id purus ultrices fringilla. Cras malesuada mollis gravida. Donec feugiat fringilla velit eu gravida. Nam tincidunt lectus non quam lacinia, sit amet laoreet tellus dictum. Praesent laoreet lacinia est ac accumsan. Phasellus a dolor nec quam lobortis malesuada sit amet condimentum dui.</p>','en',1,0,0,'topics','unemployment-rate-18-over.svg',0,'2018-04-15 07:51:36','2018-04-25 11:00:05',NULL,NULL),(13,'Migration','Mauris egestas','Integer ut posuere risus. Etiam volutpat, nisl malesuada bibendum varius, ante mauris sollicitudin mauris, nec finibus mauris erat fringilla ipsum. ','<p>Integer ut posuere risus. Etiam volutpat, nisl malesuada bibendum varius, ante mauris sollicitudin mauris, nec finibus mauris erat fringilla ipsum. Vestibulum in maximus dui, a faucibus nulla. Morbi vel eleifend eros. Donec pulvinar diam quis volutpat fringilla. Curabitur id venenatis ligula. Aenean a erat fringilla, maximus risus id, semper velit. Sed dictum vestibulum mi, eget iaculis metus iaculis iaculis. Phasellus pulvinar ac arcu id malesuada. Etiam rutrum semper luctus. Nunc at quam finibus, bibendum urna eget, feugiat magna. Maecenas sit amet convallis metus, a congue nibh. Integer finibus ipsum in velit aliquam, eget accumsan lectus ultricies. Mauris egestas maximus bibendum. Vestibulum in felis hendrerit, gravida augue ut, convallis justo.</p>','en',1,0,0,'topics','No. of Population in West Bank.svg',0,'2018-04-15 07:51:50','2018-05-10 09:14:25',NULL,NULL),(14,'Social Indicators','','','','en',1,0,0,'topics','illiteracy-rate.svg',0,'2018-04-15 07:52:03','2018-04-25 11:03:01',NULL,NULL),(15,'Population','','','','en',1,0,0,'topics','No. of Population in Palestine.svg',0,'2018-04-15 07:52:17','2018-04-25 11:01:36',NULL,NULL),(16,'Education','Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec commodo orci. Quisque commodo interdum leo, id pellentesque magna aliquam.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus dui eget ipsum sodales euismod. Cras pretium arcu dui. Nam convallis convallis ligula, in consequat metus posuere eu. Sed accumsan justo at fringilla aliquam. Aenean imperdiet consectetur purus nec laoreet. Integer consequat ac orci a iaculis. Nam luctus ex mi. Suspendisse potenti. Integer malesuada condimentum condimentum. Curabitur luctus dui vitae scelerisque ullamcorper.</p><p>Etiam quam arcu, vestibulum nec tortor et, lobortis lobortis elit. Maecenas porta suscipit purus bibendum elementum. Aenean nibh magna, venenatis at consequat sed, venenatis eget sem. Integer viverra velit in dui molestie, ut porttitor leo hendrerit. Cras non blandit felis. Duis interdum elementum metus a feugiat. Sed commodo, tellus sit amet semper sollicitudin, ipsum lacus luctus lacus, ut pulvinar nunc felis id velit. Nulla a sem nec libero auctor ultrices a id dolor. Vivamus in dapibus turpis, eget malesuada tortor. Curabitur ullamcorper turpis vel dolor finibus, sed venenatis enim commodo. Curabitur sagittis cursus hendrerit.</p>','en',1,0,0,'topics','Number of employed in the private sector.svg',0,'2018-04-15 09:02:51','2018-04-25 11:03:48',NULL,NULL),(17,'Statistics','Sed dictum','usce euismod rutrum ipsum sit amet blandit. Donec aliquet est at volutpat imperdiet. Vivamus posuere velit id risus porta euismod. Suspendisse sodales dui id purus ultrices fringilla. Cras malesuada mollis gravida. Donec feugiat fringilla velit eu gravida. Nam tincidunt lectus non quam lacinia, sit amet laoreet tellus dictum. Praesent laoreet lacinia est ac accumsan. Phasellus a dolor nec quam lobortis malesuada sit amet condimentum dui.','<p>Proin ipsum nisi, dapibus in eros at, convallis finibus ligula. Morbi non vestibulum lorem, ac finibus velit. In sagittis leo vel ipsum consectetur, non venenatis dui tristique. Quisque at mi sagittis, elementum nulla vel, pretium purus. Vivamus sit amet lorem ut metus venenatis pellentesque. Proin porta bibendum quam, eu dapibus sem ornare vitae. Praesent imperdiet turpis id erat commodo, id dignissim arcu tincidunt. Fusce euismod rutrum ipsum sit amet blandit. Donec aliquet est at volutpat imperdiet. Vivamus posuere velit id risus porta euismod. Suspendisse sodales dui id purus ultrices fringilla. Cras malesuada mollis gravida. Donec feugiat fringilla velit eu gravida. Nam tincidunt lectus non quam lacinia, sit amet laoreet tellus dictum. Praesent laoreet lacinia est ac accumsan. Phasellus a dolor nec quam lobortis malesuada sit amet condimentum dui.</p><p>Integer ut posuere risus. Etiam volutpat, nisl malesuada bibendum varius, ante mauris sollicitudin mauris, nec finibus mauris erat fringilla ipsum. Vestibulum in maximus dui, a faucibus nulla. Morbi vel eleifend eros. Donec pulvinar diam quis volutpat fringilla. Curabitur id venenatis ligula. Aenean a erat fringilla, maximus risus id, semper velit. Sed dictum vestibulum mi, eget iaculis metus iaculis iaculis. Phasellus pulvinar ac arcu id malesuada. Etiam rutrum semper luctus. Nunc at quam finibus, bibendum urna eget, feugiat magna. Maecenas sit amet convallis metus, a congue nibh. Integer finibus ipsum in velit aliquam, eget accumsan lectus ultricies. Mauris egestas maximus bibendum. Vestibulum in felis hendrerit, gravida augue ut, convallis justo.</p><p>Sed sollicitudin, ante nec rutrum bibendum, diam purus tincidunt libero, quis hendrerit nisi massa in nisi. Fusce rutrum tincidunt erat, ut efficitur est tempus sit amet. Nullam imperdiet mi vel tortor lacinia, quis facilisis nibh posuere. Ut posuere sollicitudin mattis. Phasellus dictum arcu vitae risus malesuada, euismod iaculis quam maximus. In nunc neque, tempor non risus quis, imperdiet varius mi. Phasellus at nisl non purus vehicula elementum. Proin vitae fermentum enim, hendrerit dapibus lorem. Donec neque ligula, porta lobortis ultricies ac, lacinia sed velit.</p><p>Vivamus mattis lorem vitae justo laoreet, ac eleifend magna accumsan. Quisque lacus lacus, sodales et finibus at, hendrerit id sapien. Ut non purus consectetur nisi volutpat vulputate. Aenean fringilla odio metus, semper rhoncus enim lobortis tincidunt. Etiam a sapien mollis, tincidunt augue finibus, venenatis felis. Cras vestibulum enim in ante venenatis, non convallis enim eleifend. Pellentesque congue libero lacus, in feugiat arcu pulvinar non. Suspendisse ultrices dictum finibus. Nam semper felis metus, sed facilisis leo mattis eu. Quisque at ornare leo, in lacinia metus. Maecenas commodo efficitur ex in efficitur. Praesent ligula tortor, ullamcorper quis consectetur nec, cursus at lectus.</p>','en',1,0,0,'pages','placeholder.jpg',0,'2018-04-24 20:01:25','2018-04-24 20:01:54',NULL,NULL),(18,'Suspendisse ultrices','In nunc neque',' Nam semper felis metus, sed facilisis leo mattis eu. Quisque at ornare leo, in lacinia metus. Maecenas commodo efficitur ex in efficitur.','<p>Vestibulum in maximus dui, a faucibus nulla. Morbi vel eleifend eros. Donec pulvinar diam quis volutpat fringilla. Curabitur id venenatis ligula. Aenean a erat fringilla, maximus risus id, semper velit. Sed dictum vestibulum mi, eget iaculis metus iaculis iaculis. Phasellus pulvinar ac arcu id malesuada. Etiam rutrum semper luctus. Nunc at quam finibus, bibendum urna eget, feugiat magna. Maecenas sit amet convallis metus, a congue nibh. Integer finibus ipsum in velit aliquam, eget accumsan lectus ultricies. Mauris egestas maximus bibendum. Vestibulum in felis hendrerit, gravida augue ut, convallis justo.</p><p>Sed sollicitudin, ante nec rutrum bibendum, diam purus tincidunt libero, quis hendrerit nisi massa in nisi. Fusce rutrum tincidunt erat, ut efficitur est tempus sit amet. Nullam imperdiet mi vel tortor lacinia, quis facilisis nibh posuere. Ut posuere sollicitudin mattis. Phasellus dictum arcu vitae risus malesuada, euismod iaculis quam maximus. In nunc neque, tempor non risus quis, imperdiet varius mi. Phasellus at nisl non purus vehicula elementum. Proin vitae fermentum enim, hendrerit dapibus lorem</p>','en',1,1,1,'pages','placeholder.jpg',0,'2018-04-24 20:03:55','2018-04-24 20:04:11',NULL,NULL),(19,'تعداد ٢٠١٧','المعدات ولاتّساع','كل بها مساعدة والمعدات ولاتّساع, سقطت وبعدما وانتهاءً أخذ بل. كل سكان وإقامة أما, ٣٠ لمّ المضي الجنود. مع إيو أراض للصين, هذا عن الجو علاقة انتصارهم. ٠٨٠٤ لفشل ضمنها ما وصل, تحت بـ يتمكن بريطانيا،.','<p>لمّ في وزارة عسكرياً ومحاولة, جُل حالية لهيمنة تم. لم حصدت هامش عسكرياً أسر. ثم بها قررت محاولات الأبرياء. و كلّ سقوط يتمكن بمباركة. كلّ ليبين أعمال بمعارضة أن. عدد قد الدمج بالتوقيع, بها بـ معاملة الثانية.</p><p>قد أخر لعدم أوسع المواد, عرض ماشاء النزاع ولكسمبورغ أن. عقبت إيطاليا أضف مع. أجزاء عشوائية بحث هو, خلاف بتحدّي عشوائية حول ثم, عرض من زهاء اليابانية. تلك أن عملية الأمريكي. إذ قدما الأول الثانية لكل, مع لها المحيط الضغوط وتتحمّل. العظمى العالمي بل وتم, ذلك أساسي للمجهود الدولارات من.</p>','ar',1,1,0,'news','placeholder.jpg',0,'2018-04-24 22:15:10','2018-04-24 22:44:11',NULL,NULL),(20,'الحدود اللازمة','شدّت مهمّات للإتحاد','ان إيو وترك الشمال. من الآخر وتنصيب المتاخمة دار, أن الصفحة والديون الأرضية بحق.','<p>إذ لكل عشوائية المؤلّفة. معقل نهاية المشترك كل ضرب, أن لكل والنفيس البولندي الولايات. من قبل وبعد المشترك, كثيرة الضروري وقوعها، مع بلا. هنا؟ رجوعهم بمعارضة ٣٠ وصل. عن بقصف تعديل الباهضة عدد, بلا الآخر ويتّفق ولاتّساع ثم.</p><p>انتهت الأحمر الغالي بها ان, ما أراضي المؤلّفة المتاخمة الا. عُقر وزارة جديداً بـ ومن, قامت أمدها بتحدّي كلّ ٣٠. وتم أي مقاومة الضغوط. عدد كل الشهير معزّزة الفرنسي, حول لم فكان الخارجية وباستثناء. التي ويتّفق الجنود ضرب كل, ثم لمّ نهاية اعلان محاولات.</p><p>مسارح إعادة الطريق ان أضف. عليها انتباه المشتّتون إذ أضف, قد حتى تحرير المارق. لمّ تصرّف فرنسا و. إختار الصفحات المبرمة بلا من, فقامت العناد باستحداث أن أسر. حتى ان تطوير والحزب وبريطانيا, حدى هو شدّت تكبّد التقليدية.</p>',NULL,0,0,0,'news','placeholder.jpg',0,'2018-04-24 22:28:03','2018-04-24 22:28:03',NULL,NULL),(21,'تعديل الباهضة','أراضي المؤلّفة','عليها انتباه المشتّتون إذ أضف, قد حتى تحرير المارق. لمّ تصرّف فرنسا و. إختار الصفحات المبرمة بلا من','<p>إذ لكل عشوائية المؤلّفة. معقل نهاية المشترك كل ضرب, أن لكل والنفيس البولندي الولايات. من قبل وبعد المشترك, كثيرة الضروري وقوعها، مع بلا. هنا؟ رجوعهم بمعارضة ٣٠ وصل. عن بقصف تعديل الباهضة عدد, بلا الآخر ويتّفق ولاتّساع ثم.</p><p>انتهت الأحمر الغالي بها ان, ما أراضي المؤلّفة المتاخمة الا. عُقر وزارة جديداً بـ ومن, قامت أمدها بتحدّي كلّ ٣٠. وتم أي مقاومة الضغوط. عدد كل الشهير معزّزة الفرنسي, حول لم فكان الخارجية وباستثناء. التي ويتّفق الجنود ضرب كل, ثم لمّ نهاية اعلان محاولات.</p><p>مسارح إعادة الطريق ان أضف. عليها انتباه المشتّتون إذ أضف, قد حتى تحرير المارق. لمّ تصرّف فرنسا و. إختار الصفحات المبرمة بلا من, فقامت العناد باستحداث أن أسر. حتى ان تطوير والحزب وبريطانيا, حدى هو شدّت تكبّد التقليدية.</p>','ar',1,1,0,'news','placeholder.jpg',0,'2018-04-24 22:29:26','2018-05-09 17:47:17',NULL,NULL),(22,'لغات الأثنان','تشكيل تسمّى','مع أخرى الصفحات فعل. به، ثم فمرّ الإيطالية, وصل كانتا والنفيس','<p>بحث انتهت إيطاليا عن. جيما وقبل كانتا مع تعد, تونس أعلنت كل كلا, فعل ثانية للإتحاد ماليزيا، قد. يكن قد طوكيو بلديهما وحلفاؤها. و حول ساعة للحكومة الموسوعة. واحدة بأيدي عشوائية ذات لم, مع به، هامش استدعى التجارية. تحت عل إحكام مكثّفة اتفاقية.</p><p>أفاق القادة وبعدما في كما. شيء حالية أعمال واعتلاء أن, في وقد جدول فشكّل, انه وصغار بالجانب لم. ٣٠ فصل ثمّة العاصمة, وحتّى إيطاليا اليابان عرض ان, عن بال أحدث بالعمل للسيطرة. هو الى بداية أعمال, وقامت واُسدل ومطالبة لان أن. كل ألمانيا الأوروبية يتم.</p><p>لفرنسا سليمان، قد نفس. مع أخرى الصفحات فعل. به، ثم فمرّ الإيطالية, وصل كانتا والنفيس أي, دنو عن ٢٠٠٤ المدن. إتفاقية الأمريكي وتم تم, الحرة مساعدة إتفاقية أم وفي.</p>','ar',1,1,0,'stories','news1.jpg',0,'2018-04-24 22:31:30','2018-05-10 08:39:49',NULL,NULL),(23,'دارت وسوء','قررت إعمار','قررت إعمار المشتّتون حدى كل. ٣٠ عدد التخطيط الكونجرس, كرسي كانتا والنفيس عن دنو. جهة هو تسمّى السبب, بالعمل المتحدة البشريةً وصل من, بـ عدم مكّن وقوعها،.','<p>على كل دارت وسوء اعتداء. هو بسبب أحكم هذه, هنا؟ واستمر ولكسمبورغ قد أخر, ٠٨٠٤ ماشاء ليبين عدم بل. ونتج الدّفاع باستحداث تلك بل. الجو الأمور واستمرت أضف هو, من شرسة الصين وبالتحديد، يكن. لأداء الرئيسية تم يبق, بحق الباهضة للأراضي قد.</p><p>وصل زهاء وكسبت الخطّة إذ, ببعض مسارح استبدال ثم دول. الشمال الوراء تغييرات أي كان, بقعة الدّفاع من على. ٣٠ بحث وتنامت شموليةً, مكّن فرنسا المارق أي بعض. وبعد بالرّغم ثم الا, أفاق الإتحاد دون عن. أضف مع بخطوط الجديدة، الأوروبية, أخر ما سكان الشمال. كلا عل للجزر المدن.</p>','ar',1,1,0,'stories','news2.jpg',0,'2018-04-24 22:33:41','2018-05-10 08:40:03',NULL,NULL),(24,'الإحصائيات','ميزة أو فائدة','علي الجانب الآخر نشجب ونستنكر هؤلاء الرجال المفتونون بنشوة اللحظة الهائمون في رغباتهم فلا يدركون ما يعقبها من الألم والأسي المحتم، واللوم كذلك يشمل هؤلاء الذين أخفقوا في واجباتهم','<p>لكن لا بد أن أوضح لك أن كل هذه الأفكار المغلوطة حول استنكار  النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.<br></p>','ar',1,1,0,'pages','placeholder.jpg',0,'2018-04-24 22:36:50','2018-04-24 22:44:34',NULL,NULL),(25,'الاسكان','نص شكلي','هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ ','<p>يُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف.<br></p>','ar',1,1,1,'topics','Number of housing units.svg',0,'2018-04-24 22:40:36','2018-04-25 11:09:18',NULL,NULL),(26,'الأنواع المتوفرة','لنصوص لوريم إيبسوم','الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص.','<p>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور</p><p>أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد</p><p>أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس</p>','ar',1,1,1,'stories','news3.png',0,'2018-04-24 22:43:13','2018-05-10 08:40:20',NULL,NULL),(27,'اﻟﺒﻄﺎﻟﺔ','سيت يتبيرسبايكياتيس','يواي نون نيومكيوام ايايوس موداي تيمبورا انكايديونت يوت لابوري أيت دولار ماجنام','<p>دولارس أيوس كيواي راتاشن فوليوبتاتيم سيكيواي نيسكايونت. نيكيو بوررو كيوايسكيوم</p><p>ايست,كيواي دولوريم ايبسيوم كيوا دولار سايت أميت, كونسيكتيتيور,أديبايسكاي فيلايت, سيد</p><p>كيواي نون نيومكيوام ايايوس موداي تيمبورا انكايديونت يوت لابوري أيت دولار ماجنام</p><p>ألايكيوام كيوايرات فوليوبتاتيم.</p>','ar',1,1,0,'topics','unemployment-rate-18-over.svg',0,'2018-04-24 22:47:00','2018-04-25 10:55:58',NULL,NULL),(28,'عدد السكان في فلسطين','أت فيرو ايوس ايت','كيوم سوليوتا نوبايس ايست ايلاجينداي أوبتايو كيومكيوي\r\n\r\nنايهايل ايمبيدايت كيو ماينيوس ايدي كيوود ماكسهيمي بلاسايت فاسيري بوسسايميوس','<p>أوففايكايس ديبايتايس أيوت ريريوم نيسيسسايتاتايبيوس سايبي ايفينايت يوت ايت فوليبتاتيس </p><p>ريبيودايايانداي ساينت ايت موليسفاياي نون ريكيوسانداي.اتاكيوي ايريوم ريريوم هايس تينيتور</p><p>أ ساباينتي ديليكتيوس, يوت أيوت رياسايندايس فوليوبتاتايبص مايوريس ألايس</p><p>كونسيكيواتور أيوت بيرفيريندايس دولورايبيوس أسبيرايوريس ريبيللات .</p>','ar',1,1,0,'stories','placeholder.jpg',0,'2018-04-24 22:58:08','2018-04-24 22:58:08',NULL,NULL),(29,'معدل الأمية',' ان كيولبا','كيوم سوليوتا نوبايس ايست ايلاجينداي أوبتايو كيومكيوي نايهايل ايمبيدايت كيو ماينيوس ايدي كيوود ماكسهيمي','<p>كيواي نون نيومكيوام ايايوس موداي تيمبورا انكايديونت يوت لابوري أيت دولار ماجنام</p><p>ألايكيوام كيوايرات فوليوبتاتيم. يوت اينايم أد مينيما فينيام, كيواس نوستريوم أكسيركايتاشيم</p><p>يلامكوربوريس سيوسكايبيت لابورايوسام, نايساي يوت ألايكيوايد أكس أيا كوموداي</p><p>كونسيكيواتشر؟ كيوايس أيوتيم فيل أيوم أيوري ريبريهينديرايت كيواي ان إيا فوليوبتاتي</p><p>فيلايت ايسسي كيوم نايهايل موليستايا كونسيكيواتيو,فيلايليوم كيواي دولوريم أيوم فيوجايات كيو</p><p>فوليوبتاس نيولا باراياتيو</p>','ar',1,1,0,'topics','illiteracy-rate.svg',0,'2018-04-24 23:19:14','2018-04-25 10:58:19',NULL,NULL),(30,'المؤشرات الاجتماعية','','لوريم ايبسوم دولار سيت أميت','<p>ناتيس أيررور سيت فوليبتاتيم أكيسأنتييوم دولاريمكيو لايودانتيوم,توتام ريم أبيرأم,أيكيو أبسا كيواي أب أللو أنفينتوري فيرأتاتيس ايت كياسي أرشيتيكتو بيتاي فيتاي ديكاتا سيونت أكسبليكابو. نيمو أنيم أبسام فوليوباتاتيم كيواي فوليوبتاس سايت أسبيرناتشر أيوت أودايت أيوت فيوجايت, سيد كيواي كونسيكيونتشر ماجناي دولارس أيوس كيواي راتاشن فوليوبتاتيم سيكيواي نيسكايونت.</p>','ar',1,1,0,'topics','illiteracy-rate.svg',0,'2018-04-24 23:21:15','2018-04-25 11:10:04',NULL,NULL),(31,'التعليم','عديل فهرست','لغزو احتار كل أسر, بـ هُزم النمسا الخاسر بعد, من مسرح ألمانيا البشريةً فعل. والجنوب ارتكبها وبالتحديد، فعل. الا مع قِبل أمدها جديداً. بوابة الضغوط أن ولم. قد لمّ مكثّفة دنكيرك. جهة وبعض شعار ان.','<p>وففايكايس ديبايتايس أيوت ريريوم نيسيسسايتاتايبيوس سايبي ايفينايت يوت ايت فوليبتاتيس ريبيود ايايانداي ساينت ايت موليسفاياي نون ريكيوسانداي.اتاكيوي ايريوم ريريوم هايس تينيتو ساباينتي ديليكتيوس, يوت أيوت رياسايندايس فوليوبتاتايبص مايوريس ألايس كونسيكيواتور أيوت بيرفيريندايس دولورايبيوس أسبيرايوريس ريبيللات</p>','ar',1,1,0,'topics','illiteracy-rate.svg',0,'2018-04-25 11:05:57','2018-04-25 11:05:57',NULL,NULL),(32,'الهجرة','ان كيولبا','أت فيرو ايوس ايت أكيوساميوس ايت أيوستو أودايو دايجنايسسايموس ديوكايميوس كيواي\r\n\r\nبلاندايتاييس برايسينتايوم فوليوبتاتيوم ديلينايتاي أتكيوي كورريوبتاي كيوأوس دولوريس أيت','<p>لايكيوام كيوايرات فوليوبتاتيم. يوت اينايم أد مينيما فينيام, كيواس نوستريوم أكسيركايتاشيم يلامكوربوريس سيوسكايبيت لابورايوسام, نايساي يوت ألايكيوايد أكس أيا كوموداي كونسيكيواتشر كيوايس أيوتيم فيل أيوم أيوري ريبريهينديرايت كيواي ان إيا فوليوبتاتي فيلايت ايسسي كيوم نايهايل موليستايا كونسيكيواتيو,فيلايليوم كيواي دولوريم أيوم فيوجايات كيو فوليوبتاس نيولا باراياتيور</p>','ar',1,1,0,'topics','average-household-size.svg',0,'2018-04-25 11:07:56','2018-04-25 11:07:56',NULL,NULL),(33,'المحتوى المقروء','','لايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف.','<p>خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\"&nbsp; البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>','ar',1,1,1,'news','placeholder.jpg',0,'2018-05-15 22:11:08','2018-05-15 22:11:08',NULL,NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (29,'account_name','Bla bla'),(30,'site_logo',''),(31,'default_layer',''),(32,'default_latitude',''),(33,'default_longitude',''),(34,'default_zoom',''),(35,'custom_css',''),(36,'custom_js',''),(37,'smtp_host',''),(38,'smtp_username','ibrahim@hellodeveloper.com'),(39,'smtp_password','password2'),(40,'smtp_port',''),(41,'site_name','Indicators.ps'),(42,'tag_line','Telling the Palestinian story through data.'),(43,'phone','00 (972/970) 2-298 2700'),(44,'email','diwan@pcbs.gov.ps'),(45,'facebook','https://www.facebook.com/PCBSPalestine/'),(46,'linkedin','https://www.linkedin.com/in/pcbs-palestinian-05b630135'),(47,'youtube','https://www.youtube.com/channel/UCeFbu-hKUNyhdM-G4X5VdPA'),(48,'twitter','https://twitter.com/PCBSPalestine'),(49,'analytics','UA-000'),(50,'css',''),(51,'facebook_app','126061804770706'),(52,'site_description','Telling the Palestinian story through data.'),(53,'og_image',''),(54,'fax','00 (972/970) 2-298 2710'),(55,'address','<p>P.O.Box 1647, Ramallah - Palestine<br>\r\nRamallah City, Ein Munjed Quarter, Tokyo St. opposite to UN premises and Ramallah Cultural Palace</p>'),(56,'footer_description','Telling the Palestinian story through data.'),(57,'home_title_en','Telling the Palestinian story through data.'),(58,'home_description_en','Voluptatum dolorum, soluta unde vitae quam alias, sit dolores, mollitia accusamus deleniti voluptas? Aut unde ea dolores excepturi porro impedit illum deleniti inventore beatae illo.'),(59,'home_ctas_en',' <a href=\"/library\" class=\"btn btn-primary\">Explore Library</a>'),(60,'home_title_ar','حكي القصة الفلسطينية من خلال البيانات'),(61,'home_description_ar','كما أن وقام وبدأت, لم أدوات للمجهود بلا. إذ لها الأول الستار, تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما, ليركز الهادي للأسطول ما هذا, أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما, وربع جندي الشهير الساحل. يكن لعدم الثانية عل, جديداً الخاطفة منشوريا بها تم, إذ جهة الأمم الجنوب. أي أما الحربية المعارك, قد وعلى الحربي، الأولية جعل. بحث إعادة قُدُماً ان, بحث أطراف استولت شموليةً ما. الغزو قبضتهم للسيطرة عدد أم. دون أي بالقصف العالم، للأسطول.'),(62,'home_ctas_ar','<a href=\"/library\" class=\"btn btn-primary\">تفحص المكتبة</a>'),(63,'home_featured_video_en','https://www.youtube.com/watch?v=E8iSIAUWez8'),(64,'home_featured_video_thumbnail','/storage/images/ola_tv.png'),(65,'home_featured_description_en','Voluptatum dolorum, soluta unde vitae quam alias, sit dolores, mollitia accusamus deleniti voluptas? Aut unde ea dolores excepturi porro impedit illum deleniti inventore beatae illo.'),(66,'home_featured_video_ar','https://www.youtube.com/watch?v=E8iSIAUWez8'),(67,'home_featured_description_ar','ما أن وقام وبدأت, لم أدوات للمجهود بلا. إذ لها الأول الستار, تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما, ليركز الهادي للأسطول ما هذا, أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما, وربع جندي الشهير الساحل. يكن لعدم الثانية عل, جديداً الخاطفة منشوريا بها تم, إذ جهة الأمم الجنوب'),(68,'notify_email','haitham@pcbs.gov.ps');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider_user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_accounts`
--

LOCK TABLES `social_accounts` WRITE;
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
INSERT INTO `social_accounts` VALUES (1,21,'117161681378320469252','google','https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50','2018-05-03 08:28:39','2018-05-03 08:28:39'),(2,27,'104894619044681724892','google','https://lh3.googleusercontent.com/-1bwccdcMbs4/AAAAAAAAAAI/AAAAAAAANmc/M770nIUHZE8/photo.jpg?sz=50','2018-12-01 18:46:14','2018-12-01 18:46:14'),(3,28,'111712386852026415127','google','https://lh5.googleusercontent.com/-zeE1_N1rBqM/AAAAAAAAAAI/AAAAAAAAEcc/_Fm1oHjxcv0/photo.jpg?sz=50','2018-12-13 13:11:48','2018-12-13 13:11:48'),(4,29,'113903320562208426427','google','https://lh3.googleusercontent.com/-Lsw_i-i5-mM/AAAAAAAAAAI/AAAAAAAABp8/4p68ph5umr8/photo.jpg?sz=50','2018-12-27 14:21:08','2018-12-27 14:21:08');
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_subscriptions`
--

DROP TABLE IF EXISTS `team_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_subscriptions`
--

LOCK TABLES `team_subscriptions` WRITE;
/*!40000 ALTER TABLE `team_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_users`
--

DROP TABLE IF EXISTS `team_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_users` (
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `team_users_team_id_user_id_unique` (`team_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_users`
--

LOCK TABLES `team_users` WRITE;
/*!40000 ALTER TABLE `team_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` text COLLATE utf8mb4_unicode_ci,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_billing_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_billing_information` text COLLATE utf8mb4_unicode_ci,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teams_slug_unique` (`slug`),
  KEY `teams_owner_id_index` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `sort` int(11) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_url` text COLLATE utf8mb4_unicode_ci,
  `uses_two_factor_auth` tinyint(4) NOT NULL DEFAULT '0',
  `authy_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_reset_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` int(11) DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_billing_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_billing_information` text COLLATE utf8mb4_unicode_ci,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `last_read_announcements_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ibrahim Aissam','ibrahim@hellodeveloper.com','$2y$10$Rvdq1Y8B8BqlsNbFm/X2K.8IgrrDVpvn9ltcTdrmiGj6NK3lz.BVi','admin','en','UTVOTfYpvMSHEgcNMhBohkN2jVusLx7ZBCDqnQ7svV5MrcOyPu0hTABSVY6e',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-09-21 09:26:07','2017-12-27 09:26:59','2017-09-11 09:26:07','2018-06-10 13:26:55',NULL,NULL),(2,'Mosab','mabualhayja@pcbs.gov.ps','$2y$10$spIecEhDY2QMHNe67/dC.O8JbxWZ6xjQvJmqD0nMPn1kmD9PBxC3G','editor',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-09-23 18:06:53','2017-09-13 18:09:14','2017-09-13 18:06:53',NULL,NULL,NULL),(3,'Dyala','dibrahim@pcbs.gov.ps','$2y$10$XKZ9rU4vFsv3FyoNjrK5ru2HBSwpQGEP9/SG70YWBvHg8Rf1jix8e','editor',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-09-24 05:57:40','2017-09-14 05:57:40','2017-09-14 05:57:40',NULL,NULL,NULL),(6,'haitham','haitham@pcbs.gov.ps','$2y$10$VYDCdls5742UYwezdOCnkOxox3ib27UbmLNCoF4rCQdzCV78Zpm52','admin','en','OdRbsQgpU2mTV64NTcaLMhXC6kv8673lpgyHWd4sND0srzQY4C7ig6qaLkaw',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-09-24 08:44:46','2017-09-14 11:30:21','2017-09-14 08:44:46','2019-01-15 10:25:02',NULL,NULL),(7,'sahmoud','msahmoud@pcbs.gov.ps','$2y$10$nH8RV09SGQsKKyTHsqWN1.jHf6Y1gCEBUHHWrYrkFGkno/nOSEfrC','editor',NULL,'nVU4nuyHlDNiOyY7aTkkiS01w3hsq5jL7pIEq8vJlZVDTjVXS07l8HpHoeEF',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-09-24 08:55:57','2017-09-14 08:55:57','2017-09-14 08:55:57',NULL,NULL,NULL),(10,'Moad Amrani','moad@hellodeveloper.com','$2y$10$.4z0u6eaziYPJNkoFwyy8.69O1x.PjLo0zPqQyvdG5NYb6mgGXJZm','admin','ar','WBUv7MG64DSKwYUUuPuO1Eh1Bl5T7mn0n0gc2ZZVNI3NwkbxpNKUMH2B7vQi',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-11-03 10:04:58','2017-10-24 10:04:58','2017-10-24 10:04:58','2018-06-08 14:58:49',NULL,NULL),(12,'ammar nada','anada@quartetoffice.org','$2y$10$xkJ5DxqMg9SJPh6fqMCTZuJ89X9OvmSyKt/jWxxilIH2o6qeUcMPS','member',NULL,'eCiQWMrB9lEUlYm8dYcRT4Jol01lRkx1jqpxWAdJXuJlJe6qys3Q5Iw3kzDe',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-01-15 07:38:39','2018-01-05 07:38:39','2018-01-05 07:38:39',NULL,NULL,NULL),(16,'Lour','lkuttab@quartetoffice.org','$2y$10$KzW0I0aSdlmX9bBBnSxwxOi12NXlhg/0eqWdz0dqgU5u94uaKa3py','admin','en','1f2c1wqlLeSo3yX8owxkJCAjZF6De6yUfRlDPGgoi561YdcBGMFHPMhIrwK1',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-02-09 08:04:47','2018-01-31 13:10:34','2018-01-30 08:04:47','2018-12-20 14:26:22',NULL,NULL),(19,'Haitham Hussni zeidan','jawabreh@gmail.com','$2y$10$S/JBSnbjDsXkeMGDn0Po9exvhpmSpfKH40Vu9Vnf7uka9ljCVGDju','member','en','1updh1cjOgFMUJmM3vKS7PEVHOxUpvmBTNWtUyZtEG3vppY9dwcKrZSZg42Z',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-24 08:16:51','2018-03-14 08:16:51','2018-03-14 08:16:51','2018-04-09 18:39:40',NULL,NULL),(20,'adham','adwikat@pcbs.gov.ps','$2y$10$qUbLZFkVOWhxYD2kJPADxerN318/QqYRueyLih3Biokgj0V7rFSG6','admin','en','MUwhZskYISUfaaCwuBWR9V5LOULdVkcz2OJX2L7nlZsvvqEVicKRgkGXRMzK',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-08 08:45:35','2018-04-08 08:50:19',NULL,NULL),(21,'khaled pcbs','khaledpcbs@gmail.com','','editor',NULL,'IkAHWPfuc4Zo4h8X7j13HvClAL8OXNZDxShgGJznsg2EoA2zkjZaWkYLC7dD',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-03 08:28:39','2018-05-03 08:28:39',NULL,NULL),(22,'aisar','atumeh@pcbs.gov.ps','$2y$10$CUSs4KIYuKKrpMnuhaA1o.V2lNS2DGIE70o.y842w/dMx5pJUlGe6','admin','ar','oe4uU8AJFYNVV9xj6EuZ8q2O4jOn4bLjjoU0IlaRH3IJeDUogMQTblDxq9ak',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-21 10:12:53','2018-07-30 10:27:10',NULL,NULL),(23,'haleema','haleema@pcbs.gov.ps','$2y$10$T/G5xzMC/eMHPj6zGteHTuD255z.0aqY/8yP92OnBjZNY1hLZjyUS','member','en','yiIq7OpGaOECSYVBJfHlK4pDqD7JQNBkty7CSpwPxAGEd6plmT4xbQa4GtoT',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-24 07:52:23','2018-05-24 09:16:01',NULL,NULL),(24,'aisar','aisar2000@yahoo.com','$2y$10$A34zxPoiOhzJyupZ3QXTmOPVq7ViWrGyELBbsx9hek8MQHuNcjw2K','member','en','QfB50jpa64LoJyjmAteHMpVb3MeiMbLvN5teFRxGA4kMteXvMfovT6yYTWsN',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-24 08:32:13','2018-05-30 11:20:04',NULL,NULL),(25,'Mohammad Yaghi','mohammad.yaghi@giz.de','$2y$10$bjmAbfvV7amAPqGW75Ssj.lgZpYhkAlYaGi6heXb3XwMur/zAiM0m','admin','en',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-06-19 15:18:14','2018-06-19 15:18:27',NULL,NULL),(26,'Abdullrahman ElHayek','ahayek84@gmail.com','$2y$10$.TgM.OhYexsonTMa15YKZ.Hl5Kd4FXovJ/7fihlcQ5MxBloIxt8T2','admin','en','3ZXMmb4SDyUy48sIcO38FwKefA1zfgbfvj3m3ADZSUReH9x7nkaqnhxVXFrc',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-08-30 16:24:32','2018-11-29 12:58:52',NULL,NULL),(27,'Bashar Louzon','bashar.louzon@gmail.com','','admin','en',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-12-01 18:46:14','2018-12-27 14:42:47',NULL,NULL),(28,'ammar nada','ammaribn@gmail.com','','admin','en','0IJjJsIe7b83UZgNSzdfWBm4qA6sKfXlDXh85lYMHvZTi77fyuPqzny6mmXG',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-12-13 13:09:54','2018-12-14 08:35:23',NULL,NULL),(29,'Morad Z Taleeb','morad.taleeb@gmail.com','','admin','en','uZSK2DOYHysXuoeaj620bryl9cC1ZKbndnLEt1FTdMNpOjTZ0UosBGPwzNpF',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-12-27 14:21:08','2019-01-14 20:42:12',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (1,'About Indicators','The Palestinian Central Bureau of Statistics aims to develop and enhance the Palestinian official statistical system based on legal grounds that organize the process of data collection and utilization for statistical purposes.','en',1,0,'2018-04-07 20:29:00','2018-05-14 12:12:44',NULL,NULL),(2,'Share','<div id=\"share\"></div>','en',0,0,'2018-04-07 20:30:45','2018-04-07 20:30:45',NULL,NULL),(3,'Tags','<div class=\"w-tags\">\r\n    <a href=\"#\">Census 2017</a>\r\n <a href=\"/library?q=gender\">Gender</a>\r\n    <a href=\"/library?q=indicators\">Indicators</a>\r\n    <a href=\"#\">Wholesale</a>\r\n    <a href=\"#\">Products</a>\r\n    <a href=\"#\">Demographics</a>\r\n    <a href=\"#\">Exports</a>\r\n    <a href=\"#\">Imports</a>\r\n</div>','en',3,0,'2018-04-07 20:32:32','2018-04-08 08:53:45',NULL,NULL),(4,'حول الجهاز','تطوير وتعزيز النظام الإحصائي الفلسطيني الرسمي مبني على أسس قانونية تنظم عملية جمع البيانات واستخدامها لإغراض إحصائية.','ar',1,0,'2018-04-24 21:54:06','2018-04-24 21:54:06',NULL,NULL),(5,'شارك','<div id=\"share\"></div>','ar',0,0,'2018-04-24 21:59:41','2018-04-24 21:59:41',NULL,NULL),(6,'علامات','<div class=\"w-tags\">\r\n    <a href=\"#\">تعداد ٢٠١٧</a>\r\n <a href=\"/library?q=gender\"> جنس</a>\r\n    <a href=\"/library?q=indicators\"> مؤشرات</a>\r\n    <a href=\"#\"> منتجات </a>\r\n    <a href=\"#\">البيانات السكانية</a>\r\n    <a href=\"#\">الصادرات</a>\r\n    <a href=\"#\">الواردات</a>\r\n</div>','ar',3,0,'2018-04-24 22:02:34','2018-04-24 22:09:35',NULL,NULL),(7,'test','<p>fdshgsdfhsdh</p>','en',1,0,'2018-06-05 10:14:46','2018-06-05 10:15:45',NULL,'2018-06-05 10:15:45');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `180_bubble_vw`
--

/*!50001 DROP VIEW IF EXISTS `180_bubble_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`forge`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `180_bubble_vw` AS select `rownum`() AS `num`,json_extract(`p2`(),concat('$[',`x`.`n`,'].geo')) AS `geo`,json_extract(`p2`(),concat('$[',`x`.`n`,'].year')) AS `year`,json_extract(`p2`(),concat('$[',`x`.`n`,'].labor_force_percentage')) AS `labor_force_percentage`,json_extract(`p2`(),concat('$[',`x`.`n`,'].uid')) AS `uid` from (select 0 AS `n` union select 1 AS `n` union select 2 AS `n` union select 3 AS `n` union select 4 AS `n` union select 5 AS `n` union select 6 AS `n` union select 7 AS `n` union select 8 AS `n` union select 9 AS `n` union select 10 AS `n` union select 11 AS `n` union select 12 AS `n` union select 13 AS `n` union select 14 AS `n` union select 15 AS `n` union select 16 AS `n` union select 17 AS `n` union select 18 AS `n` union select 19 AS `n` union select 20 AS `n` union select 21 AS `n` union select 22 AS `n` union select 23 AS `n` union select 24 AS `n` union select 25 AS `n` union select 26 AS `n` union select 27 AS `n` union select 28 AS `n` union select 29 AS `n`) `x` where (`x`.`n` < json_length(`p2`())) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `180_map_vw`
--

/*!50001 DROP VIEW IF EXISTS `180_map_vw`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`forge`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `180_map_vw` AS select `rownum`() AS `num`,json_extract(`p2`(),concat('$[',`x`.`n`,'].geo')) AS `geo`,json_extract(`p2`(),concat('$[',`x`.`n`,'].year')) AS `year`,json_extract(`p2`(),concat('$[',`x`.`n`,'].labor_force_percentage')) AS `labor_force_percentage`,json_extract(`p2`(),concat('$[',`x`.`n`,'].uid')) AS `uid` from (select 0 AS `n` union select 1 AS `n` union select 2 AS `n` union select 3 AS `n` union select 4 AS `n` union select 5 AS `n` union select 6 AS `n` union select 7 AS `n` union select 8 AS `n` union select 9 AS `n` union select 10 AS `n` union select 11 AS `n` union select 12 AS `n` union select 13 AS `n` union select 14 AS `n` union select 15 AS `n` union select 16 AS `n` union select 17 AS `n` union select 18 AS `n` union select 19 AS `n` union select 20 AS `n` union select 21 AS `n` union select 22 AS `n` union select 23 AS `n` union select 24 AS `n` union select 25 AS `n` union select 26 AS `n` union select 27 AS `n` union select 28 AS `n` union select 29 AS `n`) `x` where (`x`.`n` < json_length(`p2`())) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-22 12:49:26

-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.6.32

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
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `discr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Kévin Dunglas','dunglas@gmail.com','comment'),(2,'George Abitbol','gabitbol@example.com','post');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C4B89032C` (`post_id`),
  KEY `IDX_9474526CF675F31B` (`author_id`),
  CONSTRAINT `FK_9474526C4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `comment_author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,1,1,'My comment','2016-09-23 10:54:10'),(2,1,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(3,1,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(4,1,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(5,1,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(6,1,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(7,2,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(8,2,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(9,2,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(10,2,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(11,2,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(12,3,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(13,3,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(14,3,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(15,3,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(16,3,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(17,4,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(18,4,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(19,4,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(20,4,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(21,4,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(22,5,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(23,5,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(24,5,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(25,5,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(26,5,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(27,6,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(28,6,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(29,6,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(30,6,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(31,6,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(32,7,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(33,7,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(34,7,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(35,7,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(36,7,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(37,8,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(38,8,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(39,8,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(40,8,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(41,8,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(42,9,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(43,9,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(44,9,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(45,9,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(46,9,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(47,10,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(48,10,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(49,10,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(50,10,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(51,10,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(52,11,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-19 10:54:10'),(53,11,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-20 10:54:10'),(54,11,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-21 10:54:10'),(55,11,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-22 10:54:10'),(56,11,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','2016-09-23 10:54:10'),(57,1,NULL,'New Comment','2016-09-23 16:33:18'),(58,1,NULL,'New Comment','2016-09-23 16:36:25'),(59,1,NULL,'New Comment','2016-09-23 16:37:12'),(60,1,NULL,'New Comment','2016-09-23 16:37:35');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_author`
--

DROP TABLE IF EXISTS `comment_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_author` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_77BC80DABF396750` FOREIGN KEY (`id`) REFERENCES `author` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_author`
--

LOCK TABLES `comment_author` WRITE;
/*!40000 ALTER TABLE `comment_author` DISABLE KEYS */;
INSERT INTO `comment_author` VALUES (1);
/*!40000 ALTER TABLE `comment_author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8DF675F31B` (`author_id`),
  KEY `publication_date_idx` (`publication_date`),
  CONSTRAINT `FK_5A8A6C8DF675F31B` FOREIGN KEY (`author_id`) REFERENCES `post_author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,2,'Title Edited','Lorem ipsum','2016-09-23 00:00:00'),(2,NULL,'Blog post number 1','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-14 10:54:10'),(3,NULL,'Blog post number 2','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-15 10:54:10'),(4,NULL,'Blog post number 3','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-16 10:54:10'),(5,NULL,'Blog post number 4','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-17 10:54:10'),(6,NULL,'Blog post number 5','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-18 10:54:10'),(7,NULL,'Blog post number 6','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-19 10:54:10'),(8,NULL,'Blog post number 7','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-20 10:54:10'),(9,NULL,'Blog post number 8','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-21 10:54:10'),(10,NULL,'Blog post number 9','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-22 10:54:10'),(11,NULL,'Blog post number 10','Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.','2016-09-23 10:54:10'),(12,NULL,'Tomorrow Post','Lorem','2016-09-24 11:13:46');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_author`
--

DROP TABLE IF EXISTS `post_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_author` (
  `id` int(11) NOT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_8D8D3CADBF396750` FOREIGN KEY (`id`) REFERENCES `author` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_author`
--

LOCK TABLES `post_author` WRITE;
/*!40000 ALTER TABLE `post_author` DISABLE KEYS */;
INSERT INTO `post_author` VALUES (2,'L\'homme le plus classe du monde');
/*!40000 ALTER TABLE `post_author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `IDX_5ACE3AF04B89032C` (`post_id`),
  KEY `IDX_5ACE3AF0BAD26311` (`tag_id`),
  CONSTRAINT `FK_5ACE3AF04B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5ACE3AF0BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tag`
--

LOCK TABLES `post_tag` WRITE;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
INSERT INTO `post_tag` VALUES (1,1),(2,1),(2,2),(3,1),(3,2),(3,3),(4,1),(4,2),(4,3),(4,4),(5,1),(5,2),(5,3),(5,4),(5,5),(6,1),(7,1),(7,2),(8,1),(8,2),(8,3),(9,1),(9,2),(9,3),(9,4),(10,1),(10,2),(10,3),(10,4),(10,5),(11,1);
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_idx` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'tag1'),(2,'tag2'),(3,'tag3'),(4,'tag4'),(5,'tag5');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Mava','mava','info@mava.info','info@mava.info',1,'gidtzx338ao0gswwswkoocgk0sko8oo','$2y$13$j1W54LbRgq2pLEZ2W4yOI.qne.YSnS3NfMfLOXIFwSmKIoAR2jqV6','2016-09-23 16:37:42',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'blog'
--

--
-- Dumping routines for database 'blog'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-23 16:50:43

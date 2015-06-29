-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sora_db
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `cat_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_slug` varchar(200) DEFAULT NULL,
  `cat_type` varchar(45) NOT NULL,
  `slide_id` bigint(120) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Bike','bike','category',NULL,'2015-06-29 05:38:25');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_relationships`
--

DROP TABLE IF EXISTS `category_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_relationships` (
  `category_relationship_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `cont_id` bigint(120) NOT NULL,
  `cat_id` bigint(120) NOT NULL,
  `cont_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_relationship_id`),
  KEY `cat_id_idx` (`cat_id`),
  KEY `cont_id` (`cont_id`),
  CONSTRAINT `cat_id` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cont_id` FOREIGN KEY (`cont_id`) REFERENCES `content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_relationships`
--

LOCK TABLES `category_relationships` WRITE;
/*!40000 ALTER TABLE `category_relationships` DISABLE KEYS */;
INSERT INTO `category_relationships` VALUES (1,1,1,NULL);
/*!40000 ALTER TABLE `category_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id` bigint(120) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(120) DEFAULT NULL,
  `slide_id` bigint(120) DEFAULT NULL,
  `cont_lang_id` bigint(120) DEFAULT NULL,
  `cont_name` varchar(120) DEFAULT NULL,
  `cont_author` varchar(120) DEFAULT NULL,
  `cont_slug` varchar(200) NOT NULL,
  `cont_status` varchar(20) NOT NULL,
  `cont_modified` datetime DEFAULT NULL,
  `cont_type` varchar(20) DEFAULT NULL,
  `cont_mine_type` varchar(100) DEFAULT NULL,
  `cont_thumbnail` varchar(255) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id_fk_idx` (`user_id`),
  KEY `slide_id_fk_idx` (`slide_id`) USING BTREE,
  CONSTRAINT `slide_id_fk` FOREIGN KEY (`slide_id`) REFERENCES `slide` (`slide_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,1,NULL,1,'First Content','admin','first-content','published','2015-06-29 07:39:20','content',NULL,NULL,'2015-06-29 05:39:20'),(2,1,NULL,NULL,'Menu Structure','aonrobotz','','private',NULL,'menu',NULL,NULL,'2015-06-29 06:52:40');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_meta`
--

DROP TABLE IF EXISTS `content_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_meta` (
  `meta_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `cont_id` bigint(120) DEFAULT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `cont_id_fk_idx` (`cont_id`),
  CONSTRAINT `cont_id_fk` FOREIGN KEY (`cont_id`) REFERENCES `content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_meta`
--

LOCK TABLES `content_meta` WRITE;
/*!40000 ALTER TABLE `content_meta` DISABLE KEYS */;
INSERT INTO `content_meta` VALUES (1,2,'value','\n                                                        \n                                                       \n                                                        \n                                                                                                              \n                                                    <li class=\"mjs-nestedSortable-expanded mjs-nestedSortable-branch\" id=\"menuItem_20\" style=\"display: list-item;\"><div class=\"menuDiv\">  <span title=\"Click to show/hide children\" class=\"disclose ui-icon ui-icon-minusthick\">      <span></span>  </span>  <span title=\"Click to show/hide item editor\" data-id=\"20\" class=\"expandEditor ui-icon ui-icon-triangle-1-n\">      <span></span>  </span>  <span>      <span data-id=\"20\" class=\"itemTitle\">Social</span>      <span title=\"Click to delete item.\" data-id=\"20\" class=\"deleteMenu ui-icon ui-icon-closethick\">          <span></span>      </span>  </span><div id=\"menuEdit20\" class=\"menuEdit\">  <p>  </p></div></div><ol><li class=\"mjs-nestedSortable-leaf\" id=\"menuItem_18\" style=\"display: list-item;\"><div class=\"menuDiv\">  <span title=\"Click to show/hide children\" class=\"disclose ui-icon ui-icon-minusthick\">      <span></span>  </span>  <span title=\"Click to show/hide item editor\" data-id=\"18\" class=\"expandEditor ui-icon ui-icon-triangle-1-n\">      <span></span>  </span>  <span>      <span data-id=\"18\" class=\"itemTitle\">Google</span>      <span title=\"Click to delete item.\" data-id=\"18\" class=\"deleteMenu ui-icon ui-icon-closethick\">          <span></span>      </span>  </span><div id=\"menuEdit18\" class=\"menuEdit\">  <p>www.google.com  </p></div></div></li><li class=\"mjs-nestedSortable-leaf\" id=\"menuItem_19\" style=\"display: list-item;\"><div class=\"menuDiv\">  <span title=\"Click to show/hide children\" class=\"disclose ui-icon ui-icon-minusthick\">      <span></span>  </span>  <span title=\"Click to show/hide item editor\" data-id=\"19\" class=\"expandEditor ui-icon ui-icon-triangle-1-n\">      <span></span>  </span>  <span>      <span data-id=\"19\" class=\"itemTitle\">Facebook</span>      <span title=\"Click to delete item.\" data-id=\"19\" class=\"deleteMenu ui-icon ui-icon-closethick\">          <span></span>      </span>  </span><div id=\"menuEdit19\" class=\"menuEdit\">  <p>www.facebook.com  </p></div></div></li></ol></li><li class=\"mjs-nestedSortable-branch mjs-nestedSortable-expanded\" id=\"menuItem_15\" style=\"display: list-item;\"><div class=\"menuDiv ui-sortable-handle\">  <span title=\"Click to show/hide children\" class=\"disclose ui-icon ui-icon-minusthick\">      <span></span>  </span>  <span title=\"Click to show/hide item editor\" data-id=\"15\" class=\"expandEditor ui-icon ui-icon-triangle-1-n\">      <span></span>  </span>  <span>      <span data-id=\"15\" class=\"itemTitle\">A</span>      <span title=\"Click to delete item.\" data-id=\"15\" class=\"deleteMenu ui-icon ui-icon-closethick\">          <span></span>      </span>  </span><div id=\"menuEdit15\" class=\"menuEdit ui-sortable-handle\">  <p>index.php?p=content&amp;id=1  </p></div></div><ol><li class=\"mjs-nestedSortable-expanded mjs-nestedSortable-leaf\" id=\"menuItem_16\" style=\"display: list-item;\"><div class=\"menuDiv ui-sortable-handle\">  <span title=\"Click to show/hide children\" class=\"disclose ui-icon ui-icon-minusthick\">      <span></span>  </span>  <span title=\"Click to show/hide item editor\" data-id=\"16\" class=\"expandEditor ui-icon ui-icon-triangle-1-n\">      <span></span>  </span>  <span>      <span data-id=\"16\" class=\"itemTitle\">B</span>      <span title=\"Click to delete item.\" data-id=\"16\" class=\"deleteMenu ui-icon ui-icon-closethick\">          <span></span>      </span>  </span><div id=\"menuEdit16\" class=\"menuEdit ui-sortable-handle\">  <p>index.php?p=content&amp;id=1  </p></div></div></li><li class=\"mjs-nestedSortable-expanded mjs-nestedSortable-leaf\" id=\"menuItem_14\" style=\"display: list-item;\"><div class=\"menuDiv ui-sortable-handle\">  <span title=\"Click to show/hide children\" class=\"disclose ui-icon ui-icon-minusthick\">      <span></span>  </span>  <span title=\"Click to show/hide item editor\" data-id=\"14\" class=\"expandEditor ui-icon ui-icon-triangle-1-n\">      <span></span>  </span>  <span>      <span data-id=\"14\" class=\"itemTitle\">C</span>      <span title=\"Click to delete item.\" data-id=\"14\" class=\"deleteMenu ui-icon ui-icon-closethick\">          <span></span>      </span>  </span><div id=\"menuEdit14\" class=\"menuEdit ui-sortable-handle\">  <p>index.php?p=content&amp;id=1  </p></div></div></li></ol></li>   <li class=\"mjs-nestedSortable-leaf\" id=\"menuItem_17\"><div class=\"menuDiv ui-sortable-handle\">  <span title=\"Click to show/hide children\" class=\"disclose ui-icon ui-icon-minusthick\">      <span></span>  </span>  <span title=\"Click to show/hide item editor\" data-id=\"17\" class=\"expandEditor ui-icon ui-icon-triangle-1-n\">      <span></span>  </span>  <span>      <span data-id=\"17\" class=\"itemTitle\">D</span>      <span title=\"Click to delete item.\" data-id=\"17\" class=\"deleteMenu ui-icon ui-icon-closethick\">          <span></span>      </span>  </span><div id=\"menuEdit17\" class=\"menuEdit ui-sortable-handle\">  <p>index.php?p=content&amp;id=1  </p></div></div></li>                                                       \n                                                      ');
/*!40000 ALTER TABLE `content_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_translation`
--

DROP TABLE IF EXISTS `content_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_translation` (
  `trans_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `cont_id` bigint(120) DEFAULT NULL,
  `lang_id` bigint(120) DEFAULT NULL,
  `cont_title` text NOT NULL,
  `cont_content` longtext NOT NULL,
  `cont_description` varchar(200) NOT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `cont_id_idx` (`cont_id`),
  KEY `lang_code_idx` (`lang_id`),
  CONSTRAINT `content_id_fk` FOREIGN KEY (`cont_id`) REFERENCES `content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `lang_code_fk` FOREIGN KEY (`lang_id`) REFERENCES `language` (`lang_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_translation`
--

LOCK TABLES `content_translation` WRITE;
/*!40000 ALTER TABLE `content_translation` DISABLE KEYS */;
INSERT INTO `content_translation` VALUES (1,1,1,'fsaafsa','\r\n                                                    <div class=\"row\"><div class=\"column col-sm-2 col-xs-2 col-md-3\"></div>\r\n                                                        <!-- Pull in Database from english language content -->\r\n                                                    </div>\r\n                                                ','asfasfasfasfa');
/*!40000 ALTER TABLE `content_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `lang_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(8) NOT NULL,
  `lang_name` varchar(45) NOT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (1,'th','thai'),(2,'en','english');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `obj_id` bigint(120) DEFAULT NULL,
  `parent_id` bigint(120) DEFAULT NULL,
  `menu_order` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `obj_id_fk_idx` (`obj_id`),
  CONSTRAINT `obj_id_fk` FOREIGN KEY (`obj_id`) REFERENCES `object` (`obj_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,2,0,'1'),(2,6,2,'1'),(3,4,2,'2'),(4,5,2,'3'),(5,7,0,'2'),(6,3,7,'1'),(7,17,0,'3');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object`
--

DROP TABLE IF EXISTS `object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object` (
  `obj_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `obj_name` varchar(120) DEFAULT NULL,
  `obj_url` varchar(255) DEFAULT NULL,
  `obj_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`obj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object`
--

LOCK TABLES `object` WRITE;
/*!40000 ALTER TABLE `object` DISABLE KEYS */;
INSERT INTO `object` VALUES (1,'das',NULL,NULL),(2,'das',NULL,NULL),(3,'das',NULL,NULL),(4,'das',NULL,NULL),(5,'das',NULL,NULL),(6,'dasdas',NULL,NULL),(7,'das',NULL,NULL),(8,'das',NULL,NULL),(9,'das',NULL,NULL),(10,'das',NULL,NULL),(11,'',NULL,NULL),(12,'C','index.php?p=content&id=1','content'),(13,'C','index.php?p=content&id=1','content'),(14,'C','index.php?p=content&id=1','content'),(15,'A','index.php?p=content&id=1','content'),(16,'B','index.php?p=content&id=1','content'),(17,'D','index.php?p=content&id=1','content'),(18,'Google','www.google.com','link'),(19,'Facebook','www.facebook.com','link'),(20,'Social','','link');
/*!40000 ALTER TABLE `object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `slide_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `slide_type` varchar(45) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide`
--

LOCK TABLES `slide` WRITE;
/*!40000 ALTER TABLE `slide` DISABLE KEYS */;
/*!40000 ALTER TABLE `slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide_data`
--

DROP TABLE IF EXISTS `slide_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide_data` (
  `slide_data_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `slide_id` bigint(120) NOT NULL,
  `slide_data_img_url` varchar(255) NOT NULL,
  `slide_data_content` varchar(200) DEFAULT NULL,
  `slide_data_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`slide_data_id`),
  KEY `slide_ID_fok_idx` (`slide_id`),
  CONSTRAINT `slide_ID_fok` FOREIGN KEY (`slide_id`) REFERENCES `slide` (`slide_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide_data`
--

LOCK TABLES `slide_data` WRITE;
/*!40000 ALTER TABLE `slide_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `slide_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','admin','admin','2015-06-29 06:51:57');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-29 15:41:58

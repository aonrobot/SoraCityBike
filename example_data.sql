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
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Bike','bike','category','2015-06-24 11:22:03'),(2,'Kuy Category','kuy-cat','category','2015-06-24 11:22:13'),(3,'News','news','category','2015-06-24 11:22:33');
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
  CONSTRAINT `cont_id` FOREIGN KEY (`cont_id`) REFERENCES `content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cat_id` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_relationships`
--

LOCK TABLES `category_relationships` WRITE;
/*!40000 ALTER TABLE `category_relationships` DISABLE KEYS */;
INSERT INTO `category_relationships` VALUES (1,1,3,NULL),(3,3,3,NULL),(7,2,3,NULL);
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
  `cont_lang_id` bigint(120) DEFAULT NULL,
  `cont_name` varchar(120) DEFAULT NULL,
  `cont_author` varchar(120) DEFAULT NULL,
  `cont_slug` varchar(200) NOT NULL,
  `cont_status` varchar(20) NOT NULL,
  `cont_modified` datetime DEFAULT NULL,
  `cont_type` varchar(20) DEFAULT NULL,
  `cont_mine_type` varchar(100) DEFAULT NULL,
  `cont_thumbnail` varchar(45) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id_fk_idx` (`user_id`),
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,NULL,1,'News001','admin','sanook-online-001','private','2015-06-24 12:22:01','content',NULL,NULL,NULL,'2015-06-24 10:22:01'),(2,NULL,3,'News023','admin','galaxy-s6','published','2015-06-24 13:25:50','content',NULL,NULL,NULL,'2015-06-24 11:25:50'),(3,NULL,1,'News003','admin','news-003','published','2015-06-24 13:32:22','content',NULL,NULL,NULL,'2015-06-24 11:32:22');
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
  CONSTRAINT `cont_id_fk` FOREIGN KEY (`cont_id`) REFERENCES `content` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_meta`
--

LOCK TABLES `content_meta` WRITE;
/*!40000 ALTER TABLE `content_meta` DISABLE KEYS */;
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
  `cont_description` longtext NOT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `cont_id_idx` (`cont_id`),
  KEY `lang_code_idx` (`lang_id`),
  CONSTRAINT `content_id_fk` FOREIGN KEY (`cont_id`) REFERENCES `content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `lang_code_fk` FOREIGN KEY (`lang_id`) REFERENCES `language` (`lang_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_translation`
--

LOCK TABLES `content_translation` WRITE;
/*!40000 ALTER TABLE `content_translation` DISABLE KEYS */;
INSERT INTO `content_translation` VALUES (1,1,1,'Sanook Online Limited ผู้ให้บริการคอนเทนต์ออนไลน์รายใหญ่ของประเทศไทย อัพเดตแอพ Sanook!','\r\n                                                        \r\n                                                        \r\n                                                        <div class=\"row\"><div class=\"column col-md-6 col-sm-6 col-xs-6\"><!--gm-editable-region--><p>Sanook Online Limited ผู้ให้บริการคอนเทนต์ออนไลน์รายใหญ่ของประเทศไทย อัพเดตแอพ Sanook! เวอร์ชันใหม่โดยปรับปรุงทั้งฟีเจอร์การใช้งาน และอินเทอร์เฟซของแอพให้ใช้งานได้สะดวกยิ่งขึ้น</p><p>ฟีเจอร์ของ Sanook! เวอร์ชั่นใหม่ล่าสุด ประกอบไปด้วย</p><ul><li>มีการออกแบบใหม่ ให้ทันสมัย</li><li>สามารถดูข้อมูลแจ้งเตือนย้อนหลังได้</li><li>สามารถเลือกหมวดเนื้อหาที่คุณชอบได้</li><li>ปรับปรุงระบบการแจ้งเตือน และระบบการแสดงผลให้มีประสิทธิภาพมากขึ้น</li></ul><p>สำหรับของใหม่ที่เพิ่มเข้ามาเป็นอย่างไรบ้าง มาลองดูกันทีละอย่างครับ</p><h4>ออกแบบใหม่ ให้ทันสมัย</h4><p>แอพเวอร์ชันใหม่ถูกแบบใหม่ให้ทันสมัย และสะอาดสะอ้านมากขึ้น เมื่อผู้ใช้เข้ามาจะพบกับรูปภาพข่าวขนาดใหญ่ที่สามารถกดเข้าไปในข่าวได้ ทันที โดยจะมีข่าวเด่นให้ดูหลายข่าว สามารถปัดซ้ายขวา หรือปล่อยให้เลื่อนอัตโนมัติได้<br></p><!--/gm-editable-region--></div><div class=\"column col-md-6 col-sm-6 col-xs-6\"><!--gm-editable-region--><p><img class=\"img-responsive\" src=\"https://farm1.staticflickr.com/429/18918355730_8c4996ac27_o_d.png\" alt=\"\"> <img class=\"img-responsive\" src=\"https://farm4.staticflickr.com/3671/18919924019_2a564be913_o_d.png\" alt=\"\"><br></p><!--/gm-editable-region--></div></div>\r\n                                                    \r\n                                                                                                                                                                                                ','Sanook Online Limited ผู้ให้บริการคอนเทนต์ออนไลน์รายใหญ่ของประเทศไทย อัพเดตแอพ Sanook! เวอร์ชันใหม่โดยปรับปรุงทั้งฟีเจอร์การใช้งาน และอินเทอร์เฟซของแอพให้ใช้งานได้สะดวกยิ่งขึ้น'),(3,1,2,'Sanook Online Limited a provider of online conten','\r\n                                                        \r\n                                                        <div class=\"row\"><div class=\"column col-md-6 col-sm-6 col-xs-6\"><!--gm-editable-region--><p>Sanook Online Limited a provider of online content, a major update of Apple Sanook! The new version also features improved usability. And interactive interface of the app to work with them.<br><br>Features of Sanook! The latest version includes<br><br>&nbsp;&nbsp;&nbsp;&nbsp;A stylish new design<br>&nbsp;&nbsp;&nbsp;&nbsp;You can view the alerts history.<br>&nbsp;&nbsp;&nbsp;&nbsp;You can select the type of content you like.<br>&nbsp;&nbsp;&nbsp;&nbsp;Improved notification system And display system to be more efficient.<br><br>Added for the new culture. Let\'s see them one by one.<br>Stylish new design<br><br>Apple\'s new version is a new up to date. And clean up When a user enters will find photos that can be pressed into large news immediately by a news reporter for several news. You can swipe left and right Or let the automatic scroll<br></p><!--/gm-editable-region--></div><div class=\"column col-md-6 col-sm-6 col-xs-6\"><!--gm-editable-region--><p><img class=\"img-responsive\" src=\"https://farm1.staticflickr.com/429/18918355730_8c4996ac27_o_d.png\" alt=\"\"> <img class=\"img-responsive\" src=\"https://farm4.staticflickr.com/3671/18919924019_2a564be913_o_d.png\" alt=\"\"><br></p><!--/gm-editable-region--></div></div>\r\n                                                    \r\n                                                                                                                                                ','Sanook Online Limited a provider of online content, a major update of Apple Sanook! The new version also features improved usability. \r\nAnd interactive interface of the app to work with them.'),(4,2,3,'6使用Galaxy S6的主要功能，使您的生活更轻松。','\r\n                                                    <div class=\"row\"><div class=\"column col-sm-2 col-xs-2 col-md-12\"><!--gm-editable-region--><p>智能手机市场的今天。除了外观设计和材料规格前。有一件事情是吸引用户注意力转向功能。智能手机是不同的。 （而且可能是相同或非常相似），以每使单个模型。<br><br>银河S6是最新的旗舰级智能手机，其特点是独特的设计不仅看起来，材料规格的三星，但仍然是一个突出的特点。本作的主角为好。<br><br>本文将介绍六种方法银河S6的主要特征，使智能手机使用，这是一个有益的和更容易。<br>打开在短短0.7秒更容易快速启动相机。<br><br>原来的三星相机从锁屏功能。右下方的生活，但很多次报警，请按。拖动你的手指从屏幕顶端的右下角。无法捕捉到令人印象深刻或事件。<br><br>三星Galaxy S6加相机的快速启动功能增加。按Home键两次，相机将仅为0.7秒内启动。使得能够迅速捕捉的印象。<br></p><p><img class=\"img-responsive\" src=\"https://i.imgur.com/z4Ku3sE.jpg\" title=\"Galaxy S6\" height=\"372\" width=\"680\"><br></p><!--/gm-editable-region--></div>\r\n                                                        <!-- Pull in Database from english language content -->\r\n                                                    </div>\r\n                                                ','智能手机市场的今天。除了外观设计和材料规格前。有一件事情是吸引用户注意力转向功能。智能手机是不同的。 （而且可能是相同或非常相似），以每使单个模型。\r\n\r\n银河S6是最新的旗舰级智能手机，其特点是独特的设计不仅看起来，材料规格的三星，但仍然是一个突出的特点。本作的主角为好。\r\n\r\n本文将介绍六种方法银河S6的主要特征，使智能手机使用，这是一个有益的和更容易。'),(7,3,1,'กูเกิลเปิดตัวคอลเลกชันภาพ Street View แนวตั้งเป็นครั้งแรก','<div class=\"row\"><div class=\"column col-md-12 col-sm-12 col-xs-12\"><!--gm-editable-region--><p>กูเกิลเปิดตัวคอลเลกชันภาพ Street View แนวตั้งเป็นครั้งแรก โดยไปเก็บภาพบนหน้าผาอันโด่งดังอย่าง El Capitan ในอุทยานแห่งชาติ Yosemite สหรัฐเมริกา จากการร่วมมือกับนักปีนเขาระดับตำนาน Lynn Hill, Alex Honnale และ Tommy Caldwell</p><p>นักปีนเขาทั้งสามคนผู้มากด้วยประสบการณ์การปีนหน้าผา El Capitan ใช้ความช่ำชองของพวกเขาในการเก็บภาพของหน้าผาที่มีความสูงกว่า 900 เมตร และประสบการณ์ในการติดตั้งจุดยึดต่างๆ ช่วยให้การใช้กล้องเพื่อเก็บภาพมีความง่ายขึ้น นักปีนเขาได้แบ่งภาพออกเป็น 2 ชุด ภาพชุดที่หนึ่งเป็นภาพนักปีนเขากำลังปีนหน้าผา El Capitan ตามจุดต่างๆ ของหน้าผา ภาพชุดที่สองเป็นภาพเส้นทางปีนเขาในแนวตั้งของหน้าผา El Capitan ทั้งหมด</p><p>กูเกิลทำหน้าเว็บไซต์<a data-cke-saved-href=\"https://www.google.com/maps/about/behind-the-scenes/streetview/treks/yosemite/#trek\" href=\"https://www.google.com/maps/about/behind-the-scenes/streetview/treks/yosemite/#trek\">เส้นทางปีนเขา</a> พร้อมความรู้เรื่องวิธีการปีนเขาจากนักปีนเขาทั้งสามคน และพวกเขาหวังว่าโครงการนี้จะเป็นแรงบันดาลใจให้ผู้คนมาปีนเขา เดินป่า และเยี่ยมชมอุทยาน</p><p>ช่วงปลายปีกูเกิลจะพานักเรียนมาเยี่ยมชมอุทยานผ่านองค์กร NatureBridge ซึ่งเป็นส่วนหนึ่งของกิจกรรมในโครงการนี้ และกลุ่มที่ไม่สามารถมาได้จะสามารถสัมผัสประสบการณ์การท่องเที่ยวแบบเสมือน จริงได้ทาง Google Expeditions</p><p>ผู้ที่สนใจสามารถเข้าไปดูภาพได้ใน <a data-cke-saved-href=\"https://www.google.com/maps/@37.729695,-119.63677,3a,90y,339.37h,42.29t/data=%213m7%211e1%213m5%211seWxBfFZek38AAAQo8ByvQw%212e0%213e2%217i12000%218i6000\" href=\"https://www.google.com/maps/@37.729695,-119.63677,3a,90y,339.37h,42.29t/data=%213m7%211e1%213m5%211seWxBfFZek38AAAQo8ByvQw%212e0%213e2%217i12000%218i6000\">Google Maps</a><br></p><!--/gm-editable-region--></div></div>\r\n                                                    \r\n                                                ','กูเกิลเปิดตัวคอลเลกชันภาพ Street View แนวตั้งเป็นครั้งแรก โดยไปเก็บภาพบนหน้าผาอันโด่งดังอย่าง El Capitan ในอุทยานแห่งชาติ Yosemite สหรัฐเมริกา จากการร่วมมือกับนักปีนเขาระดับตำนาน Lynn Hill, Alex Honnale และ Tommy Caldwell'),(8,2,1,'6 วิธีใช้ฟีเจอร์เด่นของ Galaxy S6 ที่จะช่วยให้ชีวิตคุณง่ายขึ้น','\r\n                                                        \r\n                                                        \r\n                                                        \r\n                                                        \r\n                                                    <div class=\"row\"><div class=\"column col-sm-2 col-xs-2 col-md-12\"><!--gm-editable-region--><p>ตลาดสมาร์ทโฟนในปัจจุบัน นอกจากรูปลักษณ์ภายนอก วัสดุ ดีไซน์และสเปคแล้ว สิ่งหนึ่งที่เป็นตัวดึงดูดผู้ใช้ให้หันมาสนใจคือฟีเจอร์ต่างๆ ของสมาร์ทโฟนที่แตกต่าง (และอาจเหมือนหรือคล้าย) กันไปในแต่ละยี่ห้อ แต่ละรุ่น</p><p>Galaxy S6 ก็เป็นสมาร์ทโฟนเรือธงรุ่นล่าสุดของซัมซุงที่มีจุดเด่นไม่เฉพาะรูปลักษณ์ วัสดุ ดีไซน์ สเปค แต่ยังคงมีฟีเจอร์เด่นๆ ที่เป็นตัวชูโรงด้วยเช่นกัน</p><p>บทความนี้จะนำเสนอ 6 วิธีใช้ฟีเจอร์เด่นๆ ของ Galaxy S6 ที่จะทำให้การใช้งานสมาร์ทโฟนตัวนี้ของคุณเป็นประโยชน์และง่ายยิ่งขึ้น</p><h3>เปิดกล้องง่ายกว่าเดิม ในเวลาแค่ 0.7 วินาที ด้วย Quick Launch Camera</h3><p>เดิมซัมซุงให้ฟีเจอร์เปิดกล้องจากหน้าล็อคสกรีน ทางด้านล่างขวามาให้อยู่แล้ว แต่หลายๆ ครั้งการกดปลุกเครื่อง ลากนิ้วจากล่างขวาของหน้าจอขึ้นด้านบน อาจไม่ทันเก็บภาพความประทับใจหรือเหตุการณ์ต่างๆ</p><p>ใน Galaxy S6 นี้ ซัมซุงได้เพิ่มฟีเจอร์ Quick Launch ของกล้องเพิ่มเข้ามา โดยการกดปุ่มโฮม 2 ครั้ง กล้องจะถูกเปิดขึ้นมาในเวลาเพียง 0.7 วินาทีเท่านั้น ทำให้สามารถเก็บภาพความประทับใจได้อย่างรวดเร็วววววว<br></p><p><img src=\"https://i.imgur.com/z4Ku3sE.jpg\" title=\"Galaxy S6\" class=\"img-responsive\"></p><!--/gm-editable-region--></div>\r\n                                                        <!-- Pull in Database from english language content -->\r\n                                                    </div>\r\n                                                                                                                                                                                                                                                ','ตลาดสมาร์ทโฟนในปัจจุบัน นอกจากรูปลักษณ์ภายนอก วัสดุ ดีไซน์และสเปคแล้ว สิ่งหนึ่งที่เป็นตัวดึงดูดผู้ใช้ให้หันมาสนใจคือฟีเจอร์ต่างๆ ของสมาร์ทโฟนที่แตกต่าง (และอาจเหมือนหรือคล้าย) กันไปในแต่ละยี่ห้อ แต่ละรุ่น\r\nGalaxy S6 ก็เป็นสมาร์ทโฟนเรือธงรุ่นล่าสุดของซัมซุงที่มีจุดเด่นไม่เฉพาะรูปลักษณ์ วัสดุ ดีไซน์ สเปค แต่ยังคงมีฟีเจอร์เด่นๆ ที่เป็นตัวชูโรงด้วยเช่นกัน\r\nบทความนี้จะนำเสนอ 6 วิธีใช้ฟีเจอร์เด่นๆ ของ Galaxy S6 ที่จะทำให้การใช้งานสมาร์ทโฟนตัวนี้ของคุณเป็นประโยชน์และง่ายยิ่งขึ้น');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (1,'th','Thai'),(2,'en','English'),(3,'cn','Chinese');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `slide_id` bigint(120) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) DEFAULT NULL,
  `content` text,
  `content_url` varchar(255) DEFAULT NULL,
  `type` varchar(45) NOT NULL,
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
INSERT INTO `user` VALUES (1,'admin','admin','admin','aonrobotz@gmail.com','2015-06-24 09:53:30');
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

-- Dump completed on 2015-06-24 19:17:57

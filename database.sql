-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)

-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `announcement_comments`
--

DROP TABLE IF EXISTS `announcement_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcement_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `announcement_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcement_comments_announcement_id_foreign` (`announcement_id`),
  KEY `announcement_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `announcement_comments_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `announcement_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement_comments`
--

LOCK TABLES `announcement_comments` WRITE;
/*!40000 ALTER TABLE `announcement_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcement_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcement_course`
--

DROP TABLE IF EXISTS `announcement_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcement_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `announcement_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement_course`
--

LOCK TABLES `announcement_course` WRITE;
/*!40000 ALTER TABLE `announcement_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcement_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `marked_as_answer` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  KEY `answers_user_id_foreign` (`user_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvals`
--

DROP TABLE IF EXISTS `approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `decision` enum('approved','disapproved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `approvals_course_id_foreign` (`course_id`),
  CONSTRAINT `approvals_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
INSERT INTO `approvals` VALUES (1,1,'disapproved','Please mark at least one video course as FREE PREVIEW so that potential students can have a feel of your teaching method before they purchase. Please resubmit the course for approval once that is done.','2017-07-31 06:51:51','2017-07-31 06:51:51'),(2,1,'approved','Great, this course is good to go. You can continue to create discount coupons and share with your potential students.','2017-07-31 07:02:10','2017-07-31 07:02:10'),(3,2,'approved','Ok this course is good to go. Your video quality is terrific. Good luck with sales.','2017-08-01 02:00:07','2017-08-01 02:00:07'),(4,3,'approved','Ok great, this course is good to go. Kudos!','2017-08-02 02:41:46','2017-08-02 02:41:46'),(6,5,'approved','Nice work. Good to go','2017-08-02 03:11:53','2017-08-02 03:11:53'),(7,6,'disapproved','Sorry but you need to add some more content to this course.','2017-08-02 03:22:16','2017-08-02 03:22:16'),(8,6,'approved','Great, this is good to go.','2017-08-02 03:22:59','2017-08-02 03:22:59'),(9,7,'approved','Ok this is a great one and good to go live.','2017-08-02 03:33:42','2017-08-02 03:33:42'),(11,9,'approved','This is good to go','2017-08-02 03:57:56','2017-08-02 03:57:56');
/*!40000 ALTER TABLE `approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filetype` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filesize` int(10) unsigned NOT NULL,
  `key` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(92) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `preview_url` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` int(10) unsigned DEFAULT NULL,
  `model_type` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attachments_uuid_index` (`uuid`),
  KEY `attachments_model_id_index` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` VALUES (1,'64ha7r5yr1abbfmw2e0xyb8zv','local','attachments/64h/a7r/5yr/64ha7r5yr1abbfmw2e0xyb8zv.zip','Course_file_attached.zip','application/zip',146,'597eace4e00ad',NULL,NULL,NULL,6,'App\\Models\\Lesson',NULL,'2017-07-31 04:07:00','2017-07-31 04:07:00'),(2,'1sj5ky13eclfrj0wgy341f3d','local','attachments/1sj/5ky/13e/1sj5ky13eclfrj0wgy341f3d.zip','1501474651Course_file_attached.zip','application/zip',146,'597eaf5b7f22f',NULL,NULL,NULL,1,'App\\Models\\Lesson',NULL,'2017-07-31 04:17:31','2017-07-31 04:17:31'),(5,'79n5h44cnhfic979h2h2kdrpy','local','attachments/79n/5h4/4cn/79n5h44cnhfic979h2h2kdrpy.zip','1501642552_Course_file_attached.zip','application/zip',146,'59813f3850992',NULL,NULL,NULL,22,'App\\Models\\Lesson',NULL,'2017-08-02 02:55:52','2017-08-02 02:55:52'),(6,'e13bm693y6sahog428jny963g','local','attachments/e13/bm6/93y/e13bm693y6sahog428jny963g.zip','1501643083_Course_file_attached.zip','application/zip',146,'5981414bcb0ef',NULL,NULL,NULL,27,'App\\Models\\Lesson',NULL,'2017-08-02 03:04:43','2017-08-02 03:04:43'),(7,'9dytj0jc2c0uczwj31w2g7mn5','local','attachments/9dy/tj0/jc2/9dytj0jc2c0uczwj31w2g7mn5.zip','1501644048_Course_file_attached.zip','application/zip',146,'598145108829e',NULL,NULL,NULL,29,'App\\Models\\Lesson',NULL,'2017-08-02 03:20:48','2017-08-02 03:20:48'),(8,'9d9mr0nkqts4zm8se6ts1fs6x','local','attachments/9d9/mr0/nkq/9d9mr0nkqts4zm8se6ts1fs6x.zip','1501646063_Course_file_attached.zip','application/zip',146,'59814cef24292',NULL,NULL,NULL,41,'App\\Models\\Lesson',NULL,'2017-08-02 03:54:23','2017-08-02 03:54:23'),(9,'dn6geglnijjrqr08pvacze1ly','local','attachments/dn6/geg/lni/dn6geglnijjrqr08pvacze1ly.txt','1502678537_Readme.txt','text/plain',488,'59910e09e1d3f',NULL,NULL,NULL,14,'App\\Models\\Lesson',NULL,'2017-08-14 02:42:17','2017-08-14 02:42:17'),(10,'eojag2f8vvihemsbn9hdc0u1g','local','attachments/eoj/ag2/f8v/eojag2f8vvihemsbn9hdc0u1g.txt','1502678586_Readme.txt','text/plain',488,'59910e3a373f0',NULL,NULL,NULL,10,'App\\Models\\Lesson',NULL,'2017-08-14 02:43:06','2017-08-14 02:43:06');
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Site Pages','site-pages','2017-07-31 19:53:17','2017-07-31 19:53:17'),(2,'Student Guide','student-guide','2017-07-31 19:53:52','2017-07-31 19:53:52'),(3,'Instructor Guide','instructor-guide','2017-07-31 19:54:02','2017-07-31 19:54:02'),(4,'Blog','blog','2017-07-31 20:16:38','2017-07-31 20:16:38'),(5,'Affiliates','affiliates','2017-08-19 08:15:53','2017-08-19 08:15:53');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(10) unsigned NOT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('page','article') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'article',
  `display_main_menu` tinyint(1) NOT NULL DEFAULT '1',
  `display_footer` tinyint(1) NOT NULL DEFAULT '0',
  `featured_frontend` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_blog_category_id_foreign` (`blog_category_id`),
  CONSTRAINT `blogs_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,1,'en','Terms of Use','terms-of-use','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>',1,'page',1,1,0,'2017-07-31 19:59:42','2017-07-31 19:59:42'),(2,1,'es','Términos de Uso','terms-of-use','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>',1,'page',1,1,0,'2017-07-31 20:02:51','2017-07-31 20:02:51'),(3,1,'en','Privacy Policy','privacy-policy','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>',1,'page',1,1,0,'2017-07-31 20:08:28','2017-07-31 20:08:28'),(4,1,'es','Política de privacidad','privacy-policy','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>',1,'page',1,1,0,'2017-07-31 20:09:08','2017-07-31 20:09:08'),(5,1,'es','Sobre nosotros','about-us','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>',1,'page',1,1,0,'2017-07-31 20:09:08','2017-10-23 17:03:48'),(6,1,'en','About us','about-us','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>',1,'page',1,1,0,'2017-07-31 20:09:08','2017-10-23 17:03:48'),(7,4,'en','How it works','how-it-works','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,0,0,'2017-07-31 20:15:41','2017-08-19 08:17:05'),(8,4,'es','Cómo funciona','how-it-works','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,0,0,'2017-07-31 20:15:41','2017-08-19 08:17:05'),(9,3,'en','Creating your first course','creating-your-first-course','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,1,'2017-07-31 20:17:38','2017-07-31 20:17:38'),(10,3,'es','Creando su primer curso','creating-your-first-course','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,1,'2017-07-31 20:17:38','2017-07-31 20:17:38'),(11,3,'en','Course Content Guide for Instructors','course-content-guide-for-instructors','<p><img alt=\"\" src=\"http://tutorprov2-fgneba.c9users.io/filemanager/photos/shares/Jellyfish.jpg\" style=\"float:left; height:375px; width:500px\" /></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,1,'2017-07-31 20:19:38','2017-10-23 17:04:15'),(12,3,'es','Guía del contenido del curso para los instructores','course-content-guide-for-instructors','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,1,'2017-07-31 20:19:38','2017-10-23 17:04:15'),(13,3,'en','Course video quality and Image requirements','course-video-quality-and-image-requirements','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,1,'2017-07-31 20:22:31','2017-07-31 20:22:31'),(14,3,'es','Calidad de vídeo del curso y requisitos de imagen','course-video-quality-and-image-requirements','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,1,'2017-07-31 20:22:31','2017-07-31 20:22:31'),(15,4,'en','How to become an Author','how-to-become-an-author','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,0,'2017-07-31 20:23:40','2017-08-19 08:16:47'),(16,4,'es','Cómo convertirse en un autor','how-to-become-an-author','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,0,'2017-07-31 20:23:40','2017-08-19 08:16:47'),(17,2,'en','How to enroll to a course','how-to-enroll-to-a-course','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,0,'2017-07-31 20:24:44','2017-08-19 08:16:23'),(18,2,'es','Cómo inscribirse en un curso','how-to-enroll-to-a-course','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,0,'2017-07-31 20:24:44','2017-08-19 08:16:23'),(19,2,'en','Tips to Students on coupons','tips-to-students-on-coupons','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\n\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\n\n<p><strong>Lorem Dolor</strong></p>\n\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\n\n<ul>\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\n</ul>\n\n<p><strong>Lorem Dolor</strong></p>\n\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\n\n<p><strong>Lorem Dolor</strong></p>\n\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\n\n<ul>\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\n</ul>\n\n<p><strong>Lorem Dolor</strong></p>\n\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\n\n<ul>\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\n</ul>',1,'article',1,1,0,'2017-07-31 20:26:01','2017-08-19 08:15:00'),(20,2,'es','Consejos a los estudiantes sobre cupones','tips-to-students-on-coupons','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'article',1,1,0,'2017-07-31 20:26:01','2017-08-19 08:15:00'),(21,1,'en','Become an affiliate','become-an-affiliate','<p>We have now introduced affiliate marketing. Anyone signed up can share course links as affiliates and start earning money, and the Admin can set the affiliate commission percentage in the backend.</p>\r\n\r\n<p><img alt=\"\" src=\"http://tutorprov2-fgneba.c9users.io/filemanager/photos/shares/affiliate-hands.png\" style=\"float:right; height:266px; margin:10px; width:590px\" /></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'page',1,1,1,'2017-08-19 08:19:57','2017-08-19 08:25:52'),(22,1,'es','Conviértase en afiliado','become-an-affiliate','<p>Ahora hemos introducido la comercializaci&oacute;n del afiliado. Cualquier persona firmada puede compartir enlaces de cursos como afiliados y comenzar a ganar dinero, y el administrador puede establecer el porcentaje de comisi&oacute;n de afiliado en el backend.</p>\r\n\r\n<p><img alt=\"\" src=\"http://tutorprov2-fgneba.c9users.io/filemanager/photos/shares/affiliate-hands.png\" /></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>\r\n\r\n<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>\r\n\r\n<p><strong>Lorem Dolor</strong></p>\r\n\r\n<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>\r\n\r\n<ul>\r\n	<li>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</li>\r\n	<li>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</li>\r\n	<li>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</li>\r\n	<li>In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</li>\r\n</ul>',1,'page',1,1,1,'2017-08-19 08:22:15','2017-08-19 08:25:52');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookmarks_user_id_foreign` (`user_id`),
  KEY `bookmarks_course_id_foreign` (`course_id`),
  CONSTRAINT `bookmarks_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Business','business','2017-07-31 03:17:19','2017-07-31 03:17:19'),(2,'Animals and Pets','animals-and-pets','2017-07-31 03:17:34','2017-07-31 03:17:34'),(3,'Project Management','project-management','2017-07-31 03:17:44','2017-07-31 03:17:44'),(4,'Web Development','web-development','2017-07-31 03:18:14','2017-07-31 03:18:14'),(5,'Mobile Development','mobile-development','2017-07-31 03:18:26','2017-07-31 03:18:26');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `completions`
--

DROP TABLE IF EXISTS `completions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `completions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `completions_lesson_id_foreign` (`lesson_id`),
  KEY `completions_user_id_foreign` (`user_id`),
  CONSTRAINT `completions_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `completions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `completions`
--

LOCK TABLES `completions` WRITE;
/*!40000 ALTER TABLE `completions` DISABLE KEYS */;
/*!40000 ALTER TABLE `completions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` int(10) unsigned NOT NULL,
  `content_type` enum('video','article') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'video',
  `video_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_duration` int(11) DEFAULT NULL,
  `video_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_storage` enum('s3','local') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_src` enum('upload','embed') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_body` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `contents_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (1,2,'video',NULL,'u7D-hierarchicalqueries-introduction.mp4',12,'/uploads/videos/u7D-hierarchicalqueries-introduction.mp4','local','upload',NULL,'2017-07-31 04:00:03','2017-07-31 04:00:03'),(2,7,'video',NULL,'SA1-mergestatement-intro.mp4',18,'/uploads/videos/SA1-mergestatement-intro.mp4','local','upload',NULL,'2017-07-31 04:02:29','2017-07-31 04:02:29'),(3,6,'video',NULL,'NGT-partitionbyrightouterjoin.mp4',12,'/uploads/videos/NGT-partitionbyrightouterjoin.mp4','local','upload',NULL,'2017-07-31 04:04:25','2017-07-31 04:04:25'),(4,3,'video','vimeo',NULL,40,'https://vimeo.com/142001242',NULL,'embed',NULL,'2017-07-31 04:10:12','2017-07-31 04:10:12'),(5,1,'video','vimeo',NULL,32,'https://vimeo.com/219080767',NULL,'embed',NULL,'2017-07-31 04:11:16','2017-07-31 04:11:16'),(6,8,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p><strong>Example Text Content</strong></p><p>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</p><p><strong>Eget nulla. Egestas molestie voluptas,</strong> erat aliquam magna, neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</p><p><br></p><p>Taciti sed, <em>nunc duis</em>, dignissim quisque libero. Nibh id lorem, ligula consequat lacus. Dui montes, condimentum vel rhoncus. Sit porttitor. Felis phasellus minus. Tempor est. Mi lorem aenean. Vel id, porta pede quis</p><pre class=\"ql-syntax\" spellcheck=\"false\">$(\'.foo\').on(\'click\', function(e){\n    e.preventDefault();\n    console.log(\'I am a code snippet\');\n});\n</pre><p>Metus metus, et suscipit. Lectus dolor. Ullamcorper quisque ac. Vulputate erat nisl, lectus sed ante, nunc quam nibh. Odio turpis et.</p><p><br></p><p>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</p><p>Eget nulla.<em> Egestas molestie voluptas, erat aliquam magna,</em> neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</p><p><br></p><p>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</p><p>Eget nulla.<em> Egestas molestie voluptas, erat aliquam magna,</em> neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</p>','2017-07-31 04:21:49','2017-07-31 04:31:37'),(7,5,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p><strong>Example Text Content</strong></p><p>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</p><p><strong>Eget nulla. Egestas molestie voluptas,</strong> erat aliquam magna, neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</p><p><br></p><p>Taciti sed, <em>nunc duis</em>, dignissim quisque libero. Nibh id lorem, ligula consequat lacus. Dui montes, condimentum vel rhoncus. Sit porttitor. Felis phasellus minus. Tempor est. Mi lorem aenean. Vel id, porta pede quis</p><pre class=\"ql-syntax\" spellcheck=\"false\">$(\'.foo\').on(\'click\', function(e){\n    e.preventDefault();\n    console.log(\'I am a code snippet\');\n});\n</pre><p>Metus metus, et suscipit. Lectus dolor. Ullamcorper quisque ac. Vulputate erat nisl, lectus sed ante, nunc quam nibh. Odio turpis et.</p><p><br></p><p>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</p><p>Eget nulla.<em> Egestas molestie voluptas, erat aliquam magna,</em> neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</p><p><br></p><p>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</p><p>Eget nulla.<em> Egestas molestie voluptas, erat aliquam magna,</em> neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</p>','2017-07-31 04:27:00','2017-07-31 04:30:52'),(8,4,'video','youtube',NULL,16,'https://www.youtube.com/watch?v=YCDTYlUWkQE',NULL,'embed',NULL,'2017-07-31 04:28:19','2017-07-31 04:28:19'),(10,10,'video',NULL,'5Xd-hierarchicalqueries-introduction.mp4',22,'/uploads/videos/5Xd-hierarchicalqueries-introduction.mp4','local','upload',NULL,'2017-08-01 01:30:49','2017-08-01 01:30:49'),(11,14,'video',NULL,'6pH-partitionbyrightouterjoin-demo.mp4',14,'/uploads/videos/6pH-partitionbyrightouterjoin-demo.mp4','local','upload',NULL,'2017-08-01 01:35:41','2017-08-01 01:35:41'),(12,15,'video',NULL,'Wie-hierarchicalqueries-introduction.mp4',12,'/uploads/videos/Wie-hierarchicalqueries-introduction.mp4','local','upload',NULL,'2017-08-01 01:37:05','2017-08-01 01:37:05'),(13,13,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Si quicquam extra virtutem habeatur in bonis. Cyrenaici quidem non recusant; Negat enim summo bono afferre incrementum diem. Si sapiens, ne tum quidem miser, cum ab Oroete, praetore Darei, in crucem actus est. Hanc quoque iucunditatem, si vis, transfer in animum; Sin aliud quid voles, postea.</p><p><br></p><p>Primum quid tu dicis breve? Videsne quam sit magna dissensio? Te ipsum, dignissimum maioribus tuis, voluptasne induxit, ut adolescentulus eriperes P. Immo alio genere; Nunc de hominis summo bono quaeritur; Ego quoque, inquit, didicerim libentius si quid attuleris, quam te reprehenderim. Immo alio genere; Conferam avum tuum Drusum cum C. Ita fit cum gravior, tum etiam splendidior oratio.</p><ol><li>Et non ex maxima parte de tota iudicabis?</li><li>Sed tamen omne, quod de re bona dilucide dicitur, mihi praeclare dici videtur.</li><li>Sit hoc ultimum bonorum, quod nunc a me defenditur;</li><li>Quae cum ita sint, effectum est nihil esse malum, quod turpe non sit.</li><li>Philosophi autem in suis lectulis plerumque moriuntur.</li></ol><p><br></p><p>Et hunc idem dico, inquieta sed ad virtutes et ad vitia nihil interesse. Si alia sentit, inquam, alia loquitur, numquam intellegam quid sentiat; Vos autem cum perspicuis dubia debeatis illustrare, dubiis perspicua conamini tollere. Atqui haec patefactio quasi rerum opertarum, cum quid quidque sit aperitur, definitio est. Quo plebiscito decreta a senatu est consuli quaestio Cn. Tibi hoc incredibile, quod beatissimum. Materiam vero rerum et copiam apud hos exilem, apud illos uberrimam reperiemus. Vidit Homerus probari fabulam non posse, si cantiunculis tantus irretitus vir teneretur;</p><pre class=\"ql-syntax\" spellcheck=\"false\">$(\'.foo).on(\'click\', function(e){\n    e.preventDefault();\n    console.log(\'I am a code block\');\n});\n</pre><p><br></p><p>Nos paucis ad haec additis finem faciamus aliquando; Isto modo, ne si avia quidem eius nata non esset. Haec bene dicuntur, nec ego repugno, sed inter sese ipsa pugnant. Quo modo autem optimum, si bonum praeterea nullum est? At enim, qua in vita est aliquid mali, ea beata esse non potest. Philosophi autem in suis lectulis plerumque moriuntur.</p><p><br></p><p>Duo Reges: constructio interrete. Praeteritis, inquit, gaudeo. Sed quia studebat laudi et dignitati, multum in virtute processerat. Hinc ceteri particulas arripere conati suam quisque videro voluit afferre sententiam. Quia dolori non voluptas contraria est, sed doloris privatio. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. Videmusne ut pueri ne verberibus quidem a contemplandis rebus perquirendisque deterreantur? Qui autem esse poteris, nisi te amor ipse ceperit?</p><ul><li>Quis istud possit, inquit, negare?</li><li>Quem si tenueris, non modo meum Ciceronem, sed etiam me ipsum abducas licebit.</li><li>Bonum patria: miserum exilium.</li></ul><p><br></p><p>Quid me istud rogas? Quod iam a me expectare noli. Videamus animi partes, quarum est conspectus illustrior; Ex ea difficultate illae fallaciloquae, ut ait Accius, malitiae natae sunt. Sin aliud quid voles, postea. Ergo illi intellegunt quid Epicurus dicat, ego non intellego? Levatio igitur vitiorum magna fit in iis, qui habent ad virtutem progressionis aliquantum. Qui ita affectus, beatum esse numquam probabis;</p><p><br></p>','2017-08-01 01:42:36','2017-08-01 01:42:36'),(14,16,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Si quicquam extra virtutem habeatur in bonis. Cyrenaici quidem non recusant; Negat enim summo bono afferre incrementum diem. Si sapiens, ne tum quidem miser, cum ab Oroete, praetore Darei, in crucem actus est. Hanc quoque iucunditatem, si vis, transfer in animum; Sin aliud quid voles, postea.</p><p><br></p><p>Primum quid tu dicis breve? Videsne quam sit magna dissensio? Te ipsum, dignissimum maioribus tuis, voluptasne induxit, ut adolescentulus eriperes P. Immo alio genere; Nunc de hominis summo bono quaeritur; Ego quoque, inquit, didicerim libentius si quid attuleris, quam te reprehenderim. Immo alio genere; Conferam avum tuum Drusum cum C. Ita fit cum gravior, tum etiam splendidior oratio.</p><ol><li>Et non ex maxima parte de tota iudicabis?</li><li>Sed tamen omne, quod de re bona dilucide dicitur, mihi praeclare dici videtur.</li><li>Sit hoc ultimum bonorum, quod nunc a me defenditur;</li><li>Quae cum ita sint, effectum est nihil esse malum, quod turpe non sit.</li><li>Philosophi autem in suis lectulis plerumque moriuntur.</li></ol><p><br></p><p>Et hunc idem dico, inquieta sed ad virtutes et ad vitia nihil interesse. Si alia sentit, inquam, alia loquitur, numquam intellegam quid sentiat; Vos autem cum perspicuis dubia debeatis illustrare, dubiis perspicua conamini tollere. Atqui haec patefactio quasi rerum opertarum, cum quid quidque sit aperitur, definitio est. Quo plebiscito decreta a senatu est consuli quaestio Cn. Tibi hoc incredibile, quod beatissimum. Materiam vero rerum et copiam apud hos exilem, apud illos uberrimam reperiemus. Vidit Homerus probari fabulam non posse, si cantiunculis tantus irretitus vir teneretur;</p><pre class=\"ql-syntax\" spellcheck=\"false\">$(\'.foo).on(\'click\', function(e){\n    e.preventDefault();\n    console.log(\'I am a code block\');\n});\n</pre><p><br></p><p>Nos paucis ad haec additis finem faciamus aliquando; Isto modo, ne si avia quidem eius nata non esset. Haec bene dicuntur, nec ego repugno, sed inter sese ipsa pugnant. Quo modo autem optimum, si bonum praeterea nullum est? At enim, qua in vita est aliquid mali, ea beata esse non potest. Philosophi autem in suis lectulis plerumque moriuntur.</p><p><br></p><p>Duo Reges: constructio interrete. Praeteritis, inquit, gaudeo. Sed quia studebat laudi et dignitati, multum in virtute processerat. Hinc ceteri particulas arripere conati suam quisque videro voluit afferre sententiam. Quia dolori non voluptas contraria est, sed doloris privatio. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. Videmusne ut pueri ne verberibus quidem a contemplandis rebus perquirendisque deterreantur? Qui autem esse poteris, nisi te amor ipse ceperit?</p><ul><li>Quis istud possit, inquit, negare?</li><li>Quem si tenueris, non modo meum Ciceronem, sed etiam me ipsum abducas licebit.</li><li>Bonum patria: miserum exilium.</li></ul><p><br></p><p>Quid me istud rogas? Quod iam a me expectare noli. Videamus animi partes, quarum est conspectus illustrior; Ex ea difficultate illae fallaciloquae, ut ait Accius, malitiae natae sunt. Sin aliud quid voles, postea. Ergo illi intellegunt quid Epicurus dicat, ego non intellego? Levatio igitur vitiorum magna fit in iis, qui habent ad virtutem progressionis aliquantum. Qui ita affectus, beatum esse numquam probabis;</p><p><br></p>','2017-08-01 01:42:51','2017-08-01 01:42:51'),(15,12,'video','youtube',NULL,15,'https://www.youtube.com/watch?v=8RThQD0-7fA',NULL,'embed',NULL,'2017-08-01 01:44:12','2017-08-01 01:44:12'),(16,12,'video','youtube',NULL,15,'https://www.youtube.com/watch?v=8RThQD0-7fA',NULL,'embed',NULL,'2017-08-01 01:44:12','2017-08-01 01:44:12'),(17,11,'video','vimeo',NULL,23,'https://vimeo.com/216330684',NULL,'embed',NULL,'2017-08-01 01:45:28','2017-08-01 01:45:28'),(18,11,'video','vimeo',NULL,23,'https://vimeo.com/216330684',NULL,'embed',NULL,'2017-08-01 01:45:29','2017-08-01 01:45:29'),(19,17,'video',NULL,'5Uw-hierarchicalqueries-introduction.mp4',20,'/uploads/videos/5Uw-hierarchicalqueries-introduction.mp4','local','upload',NULL,'2017-08-02 02:35:30','2017-08-02 02:35:30'),(20,18,'video','vimeo',NULL,22,'https://vimeo.com/156239743',NULL,'embed',NULL,'2017-08-02 02:37:20','2017-08-02 02:37:20'),(21,18,'video','vimeo',NULL,22,'https://vimeo.com/156239743',NULL,'embed',NULL,'2017-08-02 02:37:20','2017-08-02 02:37:20'),(22,19,'video','youtube',NULL,15,'https://www.youtube.com/watch?v=1-SvuFIQjK8',NULL,'embed',NULL,'2017-08-02 02:38:51','2017-08-02 02:38:51'),(23,20,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote><p><br></p>','2017-08-02 02:40:00','2017-08-02 02:40:00'),(28,25,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote><p><br></p>','2017-08-02 03:01:53','2017-08-02 03:01:53'),(29,26,'video',NULL,'kow-hierarchicalqueries-introduction.mp4',15,'/uploads/videos/kow-hierarchicalqueries-introduction.mp4','local','upload',NULL,'2017-08-02 03:03:06','2017-08-02 03:03:06'),(30,27,'video','vimeo',NULL,15,'https://vimeo.com/156239743',NULL,'embed',NULL,'2017-08-02 03:04:21','2017-08-02 03:04:21'),(31,28,'video','youtube',NULL,20,'https://www.youtube.com/watch?v=hOelzCzgUG8',NULL,'embed',NULL,'2017-08-02 03:05:48','2017-08-02 03:05:48'),(32,29,'video','youtube',NULL,22,'https://www.youtube.com/watch?v=MJR-EgHTA4E',NULL,'embed',NULL,'2017-08-02 03:17:09','2017-08-02 03:17:09'),(33,30,'video','vimeo',NULL,25,'https://vimeo.com/156239743',NULL,'embed',NULL,'2017-08-02 03:17:55','2017-08-02 03:17:55'),(34,31,'video',NULL,'Mry-hierarchicalqueries-introduction.mp4',22,'/uploads/videos/Mry-hierarchicalqueries-introduction.mp4','local','upload',NULL,'2017-08-02 03:19:03','2017-08-02 03:19:03'),(35,32,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote><p><br></p>','2017-08-02 03:19:46','2017-08-02 03:19:46'),(36,33,'video',NULL,'fyI-hierarchicalqueries-introduction.mp4',12,'/uploads/videos/fyI-hierarchicalqueries-introduction.mp4','local','upload',NULL,'2017-08-02 03:29:47','2017-08-02 03:29:47'),(37,34,'video','youtube',NULL,21,'https://www.youtube.com/watch?v=HHeTfkBVhCE',NULL,'embed',NULL,'2017-08-02 03:30:24','2017-08-02 03:30:24'),(38,35,'video','vimeo',NULL,22,'https://vimeo.com/92630207',NULL,'embed',NULL,'2017-08-02 03:31:41','2017-08-02 03:31:41'),(39,36,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote><p><br></p>','2017-08-02 03:32:20','2017-08-02 03:32:20'),(44,41,'video',NULL,'hQ1-hierarchicalqueries-introduction.mp4',13,'/uploads/videos/hQ1-hierarchicalqueries-introduction.mp4','local','upload',NULL,'2017-08-02 03:54:00','2017-08-02 03:54:00'),(45,42,'video','vimeo',NULL,20,'https://vimeo.com/39516362',NULL,'embed',NULL,'2017-08-02 03:55:05','2017-08-02 03:55:05'),(46,43,'video','youtube',NULL,25,'https://www.youtube.com/watch?v=955L9-NoBoE',NULL,'embed',NULL,'2017-08-02 03:56:15','2017-08-02 03:56:15'),(47,44,'article',NULL,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"color: rgb(68, 68, 68); background-color: rgb(221, 221, 221);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote><p><br></p>','2017-08-02 03:56:55','2017-08-02 03:56:55');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expires` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `sitewide` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupons_course_id_foreign` (`course_id`),
  CONSTRAINT `coupons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,NULL,'SUMMER2017',90,1000,'2018-06-30',1,1,'2017-07-31 16:38:16','2017-07-31 16:38:29');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_review_ratings`
--

DROP TABLE IF EXISTS `course_review_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_review_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `average_rating` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_review_ratings_course_id_foreign` (`course_id`),
  CONSTRAINT `course_review_ratings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_review_ratings`
--

LOCK TABLES `course_review_ratings` WRITE;
/*!40000 ALTER TABLE `course_review_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_review_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_technology`
--

DROP TABLE IF EXISTS `course_technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_technology` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `technology_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_technology`
--

LOCK TABLES `course_technology` WRITE;
/*!40000 ALTER TABLE `course_technology` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_technology` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_user`
--

DROP TABLE IF EXISTS `course_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_user_course_id_foreign` (`course_id`),
  KEY `course_user_user_id_foreign` (`user_id`),
  CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_user`
--

LOCK TABLES `course_user` WRITE;
/*!40000 ALTER TABLE `course_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('all','beginner','intermediate','advanced') COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_user_id_foreign` (`user_id`),
  KEY `courses_category_id_foreign` (`category_id`),
  CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,2,4,'Javascript for beginners','Start enhancing your user experience with JavaScript.','javascript-for-beginners','<p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non pharetra libero, quis ultrices leo. Donec vitae tempor lacus. Pellentesque egestas lacinia justo fringilla mattis. Sed in libero porttitor, maximus risus eu, porttitor purus. Integer lorem eros, elementum in fermentum pulvinar, tincidunt at augue. Ut tortor erat, volutpat ut metus eu, dapibus semper urna. Cras rhoncus enim at eros mollis feugiat. Proin eget ante molestie, elementum lorem eu, vestibulum augue. Duis imperdiet condimentum libero nec mollis. Donec enim ligula, pulvinar vel neque eu, dictum lacinia mi. In auctor elit egestas rhoncus blandit. Donec lectus ipsum, bibendum a erat ac, mollis malesuada turpis. Nam eget lectus at lorem tincidunt ultricies quis venenatis massa. Mauris efficitur urna tempor varius suscipit.</span></p><p><br></p><p><strong style=\"color: rgb(0, 0, 0);\">What you will learn</strong></p><ul><li>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</li><li>Eget nulla. Egestas molestie voluptas, erat aliquam magna, neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</li><li>Taciti sed, nunc duis, dignissim quisque libero. Nibh id lorem, ligula consequat lacus. Dui montes, condimentum vel rhoncus. Sit porttitor. Felis phasellus minus. Tempor est. Mi lorem aenean. Vel id, porta pede quis</li><li>Metus metus, et suscipit. Lectus dolor. Ullamcorper quisque ac. Vulputate erat nisl, lectus sed ante, nunc quam nibh. Odio turpis et</li></ul><p><br></p><p><strong style=\"color: rgb(0, 0, 0);\">Prerequisite</strong></p><ul><li>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</li><li>Eget nulla. Egestas molestie voluptas, erat aliquam magna, neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</li><li>Taciti sed, nunc duis, dignissim quisque libero. Nibh id lorem, ligula consequat lacus. Dui montes, condimentum vel rhoncus. Sit porttitor. Felis phasellus minus. Tempor est. Mi lorem aenean. Vel id, porta pede quis</li><li>Metus metus, et suscipit. Lectus dolor. Ullamcorper quisque ac. Vulputate erat nisl, lectus sed ante, nunc quam nibh. Odio turpis et</li></ul>','en','1597ea465a2a82.png','beginner',1,30,1,1,'2017-07-31 03:29:24','2017-08-02 04:07:43'),(2,2,4,'Advanced Angular 4 Development','Learn advanced skills in web app development with Angular JS 4','advanced-angular-4-development','<p><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non pharetra libero, quis ultrices leo. Donec vitae tempor lacus. Pellentesque egestas lacinia justo fringilla mattis. Sed in libero porttitor, maximus risus eu, porttitor purus. Integer lorem eros, elementum in fermentum pulvinar, tincidunt at augue. Ut tortor erat, volutpat ut metus eu, dapibus semper urna. Cras rhoncus enim at eros mollis feugiat. Proin eget ante molestie, elementum lorem eu, vestibulum augue. Duis imperdiet condimentum libero nec mollis. Donec enim ligula, pulvinar vel neque eu, dictum lacinia mi. In auctor elit egestas rhoncus blandit. Donec lectus ipsum, bibendum a erat ac, mollis malesuada turpis. Nam eget lectus at lorem tincidunt ultricies quis venenatis massa. Mauris efficitur urna tempor varius suscipit.</span></p><p><br></p><p><strong style=\"color: rgb(0, 0, 0);\">What you will learn</strong></p><ul><li>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</li><li>Eget nulla. Egestas molestie voluptas, erat aliquam magna, neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</li><li>Taciti sed, nunc duis, dignissim quisque libero. Nibh id lorem, ligula consequat lacus. Dui montes, condimentum vel rhoncus. Sit porttitor. Felis phasellus minus. Tempor est. Mi lorem aenean. Vel id, porta pede quis</li><li>Metus metus, et suscipit. Lectus dolor. Ullamcorper quisque ac. Vulputate erat nisl, lectus sed ante, nunc quam nibh. Odio turpis et</li></ul><p><br></p><p><strong style=\"color: rgb(0, 0, 0);\">Prerequisite</strong></p><ul><li>Lorem ipsum dolor sit amet, massa libero sit, est aenean elit, eros tempor. Arcu tempor vel, vestibulum risus orci, eu metus laoreet. Proin tempus. Ligula elit. Et amet libero. Congue iusto. Eget donec justo. Donec leo, lorem sed ut. Sagittis eu. Nunc tortor. Nascetur luctus, nulla tincidunt, vivamus mauris. Id vestibulum, curabitur quis aliquam</li><li>Eget nulla. Egestas molestie voluptas, erat aliquam magna, neque adipiscing. Aliquam donec fames. Vivamus sapien. Et iaculis, luctus semper</li><li>Taciti sed, nunc duis, dignissim quisque libero. Nibh id lorem, ligula consequat lacus. Dui montes, condimentum vel rhoncus. Sit porttitor. Felis phasellus minus. Tempor est. Mi lorem aenean. Vel id, porta pede quis</li><li>Metus metus, et suscipit. Lectus dolor. Ullamcorper quisque ac. Vulputate erat nisl, lectus sed ante, nunc quam nibh. Odio turpis et</li></ul>','en','15980154f540e0.png','advanced',1,0,1,1,'2017-07-31 03:29:24','2017-08-14 03:29:20'),(3,2,3,'Working SMART in projects','Learn how to work S.M.A.R.T for better project management','working-smart-in-project-management','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote>','en','1598139968e70a.png','intermediate',1,90,1,1,'2017-08-02 02:31:11','2017-08-02 04:07:43'),(5,2,3,'Gantt Chart essential training','Learn how to use GANTT charts','gantt-chart-essential-training','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote>','en','1598140750835c.png','beginner',1,70,1,1,'2017-08-02 03:00:25','2017-08-02 04:07:43'),(6,5,3,'Achieving projects under budget','Learn how to achieve projects under budget','achieving-projects-under-budget','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote>','en','1598143feb8686.png','intermediate',1,50,1,1,'2017-08-02 03:14:08','2017-08-02 04:07:43'),(7,5,4,'Project manager\'s checklist','Your cheatsheet as a project manager with nothing left out','project-managers-checklist','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote>','en','1598146d6b56bd.png','advanced',1,40,1,1,'2017-08-02 03:27:56','2017-08-02 04:07:43'),(9,5,4,'Learn Ember js','Ember js for absolute beginners','learn-ember-js','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ergo hoc quidem apparet, nos ad agendum esse natos. Venit ad extremum;&nbsp;<em style=\"background-color: transparent;\">Summum ením bonum exposuit vacuitatem doloris;</em>&nbsp;Bonum integritas corporis: misera debilitas. Duo Reges: constructio interrete.&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">At enim sequor utilitatem.</code>&nbsp;<code style=\"background-color: rgb(221, 221, 221); color: rgb(68, 68, 68);\">Ita prorsus, inquam;</code>&nbsp;<strong style=\"background-color: transparent;\">Ut pulsi recurrant?</strong></p><ul><li>Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus?</li><li>Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam.</li><li>Memini vero, inquam;</li><li>Non quam nostram quidem, inquit Pomponius iocans;</li></ul><pre class=\"ql-syntax\" spellcheck=\"false\">Audebo igitur cetera, quae secundum naturam sint, bona\nappellare nec fraudare suo vetere nomine neque iam aliquod\npotius novum exquirere,virtutis autem amplitudinem quasi in\naltera librae lance ponere.\n\nHi autem ponunt illi quidem prima naturae, sed ea seiungunt\na finibus et a summa bonorum;\n</pre><p>Et harum quidem rerum facilis est et expedita distinctio. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat necesse est. Praeclarae mortes sunt imperatoriae; Itaque mihi non satis videmini considerare quod iter sit naturae quaeque progressio. Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt.</p><p>At hoc in eo M. Quare hoc videndum est, possitne nobis hoc ratio philosophorum dare. Nemo igitur esse beatus potest. Illa argumenta propria videamus, cur omnia sint paria peccata. Facile est hoc cernere in primis puerorum aetatulis. At hoc in eo M. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</p><p>Restatis igitur vos; Quae animi affectio suum cuique tribuens atque hanc, quam dico. Illa argumenta propria videamus, cur omnia sint paria peccata. Egone quaeris, inquit, quid sentiam? Non quam nostram quidem, inquit Pomponius iocans; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Illud dico, ea, quae dicat, praeclare inter se cohaerere. Claudii libidini, qui tum erat summo ne imperio, dederetur.</p><p>Quid de Platone aut de Democrito loquar? Neque enim civitas in seditione beata esse potest nec in discordia dominorum domus; Erat enim Polemonis. Hoc tu nunc in illo probas. Bona autem corporis huic sunt, quod posterius posui, similiora.</p><p>Dat enim intervalla et relaxat.&nbsp;<strong style=\"background-color: transparent;\">ALIO MODO.</strong>&nbsp;<strong style=\"background-color: transparent;\">Graece donan, Latine voluptatem vocant.</strong>&nbsp;Et ille ridens: Video, inquit, quid agas;&nbsp;Iam contemni non poteris.&nbsp;Si quicquam extra virtutem habeatur in bonis.&nbsp;<em style=\"background-color: transparent;\">Tria genera bonorum;</em>&nbsp;Hic, qui utrumque probat, ambobus debuit uti, sicut facit re, neque tamen dividit verbis. Confecta res esset.</p><p>Quare conare, quaeso. Primum cur ista res digna odio est, nisi quod est turpis?&nbsp;<em style=\"background-color: transparent;\">Ratio quidem vestra sic cogit.</em>&nbsp;Sed ego in hoc resisto;</p><ol><li>Gerendus est mos, modo recte sentiat.</li><li>Quid ei reliquisti, nisi te, quoquo modo loqueretur, intellegere, quid diceret?</li><li>Atque etiam valítudinem, vires, vacuitatem doloris non propter utilitatem solum, sed etiam ipsas propter se expetemus.</li></ol><blockquote><em>Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est.</em></blockquote>','en','159814c7c66970.png','beginner',1,20,1,1,'2017-08-02 03:51:38','2017-08-02 04:07:43');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpful_answers`
--

DROP TABLE IF EXISTS `helpful_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpful_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `helpful_answers_user_id_foreign` (`user_id`),
  KEY `helpful_answers_answer_id_foreign` (`answer_id`),
  CONSTRAINT `helpful_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `helpful_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpful_answers`
--

LOCK TABLES `helpful_answers` WRITE;
/*!40000 ALTER TABLE `helpful_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `helpful_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `entity_id` int(10) unsigned DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assets` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `history_type_id_foreign` (`type_id`),
  KEY `history_user_id_foreign` (`user_id`),
  CONSTRAINT `history_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `history_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_types`
--

DROP TABLE IF EXISTS `history_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_types`
--

LOCK TABLES `history_types` WRITE;
/*!40000 ALTER TABLE `history_types` DISABLE KEYS */;
INSERT INTO `history_types` VALUES (3,'User','2017-08-19 00:00:00','2017-08-19 00:00:00'),(4,'Role','2017-08-19 00:00:00','2017-08-19 00:00:00');
/*!40000 ALTER TABLE `history_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `preview` tinyint(1) NOT NULL DEFAULT '0',
  `lesson_type` enum('lecture','quiz') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lecture',
  `sortOrder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_section_id_foreign` (`section_id`),
  CONSTRAINT `lessons_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (1,2,'Another Vimeo lesson with attached file','17486','General overview of the course',0,'lecture',2,'2017-07-31 03:29:24','2017-07-31 06:49:33'),(2,1,'Uploaded Video to local server','2504','This video is uploaded by the author',1,'lecture',1,'2017-07-31 03:34:15','2017-07-31 06:56:02'),(3,1,'Vimeo Video Example','12098','This is an example of a Vimeo video that is embedded',0,'lecture',3,'2017-07-31 03:47:42','2017-07-31 06:48:51'),(4,1,'YouTube video embedded','18073','This is a YouTube video that is embedded as content',0,'lecture',4,'2017-07-31 03:48:59','2017-07-31 04:07:17'),(5,1,'Text lesson example','12525','This is a text lesson',1,'lecture',5,'2017-07-31 03:49:40','2017-07-31 06:50:22'),(6,1,'Lesson with attached filess (resource)','11054','This lesson can be dragged from one section to another',0,'lecture',2,'2017-07-31 03:51:18','2017-07-31 04:07:17'),(7,1,'Another uploaded video','9919','This is another uploaded video',0,'lecture',6,'2017-07-31 03:52:23','2017-07-31 06:49:16'),(8,2,'Another Text-based Lesson','2914','This is another text-based lesson',0,'lecture',1,'2017-07-31 03:52:47','2017-07-31 06:19:01'),(10,4,'Uploaded Video to local server','25045','This video is uploaded by the author',1,'lecture',1,'2017-07-31 03:34:15','2017-07-31 06:56:02'),(11,4,'Vimeo Video Example','120985','This is an example of a Vimeo video that is embedded',0,'lecture',3,'2017-07-31 03:47:42','2017-07-31 06:48:51'),(12,4,'YouTube video embedded','180735','This is a YouTube video that is embedded as content',0,'lecture',5,'2017-07-31 03:48:59','2017-08-17 22:54:53'),(13,4,'Text lesson example','125255','This is a text lesson',1,'lecture',4,'2017-07-31 03:49:40','2017-08-17 22:54:53'),(14,4,'Lesson with attached filess (resource)','110545','This lesson can be dragged from one section to another',0,'lecture',2,'2017-07-31 03:51:18','2017-07-31 04:07:17'),(15,5,'Another uploaded video','99195','This is another uploaded video',0,'lecture',2,'2017-07-31 03:52:23','2017-08-17 22:54:53'),(16,5,'Another Text-based Lesson','29145','This is another text-based lesson',0,'lecture',1,'2017-07-31 03:52:47','2017-07-31 06:19:01'),(17,6,'Uploaded video','9838',NULL,1,'lecture',1,'2017-08-02 02:31:11','2017-08-02 02:34:18'),(18,6,'Vimeo Content','14293',NULL,1,'lecture',2,'2017-08-02 02:37:07','2017-08-02 02:37:07'),(19,6,'Youtube Video','16720',NULL,0,'lecture',3,'2017-08-02 02:38:37','2017-08-02 02:38:37'),(20,7,'Text lesson','1073','This is a text lesson',0,'lecture',1,'2017-08-02 02:39:42','2017-08-02 02:39:42'),(25,10,'Introduction','11047',NULL,0,'lecture',1,'2017-08-02 03:00:25','2017-09-12 14:56:13'),(26,10,'Uploaded video','16704',NULL,1,'lecture',2,'2017-08-02 03:02:12','2017-09-12 14:56:13'),(27,11,'Vimeo lesson example','17659','This is a vimeo video with resource attachment',0,'lecture',3,'2017-08-02 03:03:58','2017-10-05 17:09:37'),(28,11,'Youtube Video','5106',NULL,1,'lecture',1,'2017-08-02 03:05:03','2017-08-02 03:06:46'),(29,12,'Youtube Video','13849',NULL,1,'lecture',1,'2017-08-02 03:14:09','2017-08-02 03:17:21'),(30,12,'Vimeo lesson example','19350',NULL,1,'lecture',2,'2017-08-02 03:17:39','2017-08-02 03:17:39'),(31,13,'Uploaded video','18455',NULL,1,'lecture',1,'2017-08-02 03:18:07','2017-08-02 03:20:18'),(32,13,'Text lesson example','6419',NULL,0,'lecture',2,'2017-08-02 03:19:30','2017-08-02 03:20:18'),(33,14,'Uploaded video','1443',NULL,1,'lecture',1,'2017-08-02 03:27:57','2017-08-02 03:28:52'),(34,14,'Youtube Video','20309','This is an example Youtube video',0,'lecture',2,'2017-08-02 03:29:50','2017-08-02 03:29:50'),(35,14,'Vimeo lesson example','9488','This is a vimeo lesson example',1,'lecture',3,'2017-08-02 03:30:51','2017-08-02 03:30:51'),(36,15,'Text lesson example','3625','This is a text lesson',0,'lecture',1,'2017-08-02 03:32:06','2017-08-02 03:32:40'),(41,18,'Uploaded video','5958','Uploaded video with attachment',1,'lecture',1,'2017-08-02 03:51:38','2017-08-02 03:53:05'),(42,18,'Vimeo lesson example','6594',NULL,0,'lecture',2,'2017-08-02 03:54:44','2017-08-02 03:54:44'),(43,19,'Youtube Video','18091',NULL,1,'lecture',2,'2017-08-02 03:55:19','2017-08-02 03:57:04'),(44,19,'Text lesson example','9324',NULL,0,'lecture',1,'2017-08-02 03:56:41','2017-08-02 03:56:41'),(51,11,'Quiz one','21028','This is a quiz',0,'quiz',2,'2017-10-05 14:27:50','2017-10-05 17:09:37'),(52,11,'Quiz 2','15126','This is a quiz',0,'quiz',4,'2017-10-22 04:27:16','2017-10-22 04:27:16');
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0000_00_00_000000_create_taggable_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2014_10_28_175635_create_threads_table',1),(5,'2014_10_28_175710_create_messages_table',1),(6,'2014_10_28_180224_create_participants_table',1),(7,'2014_11_03_154831_add_soft_deletes_to_participants_table',1),(8,'2014_12_04_124531_add_softdeletes_to_threads_table',1),(9,'2015_12_28_171741_create_social_logins_table',1),(10,'2015_12_29_015055_setup_access_tables',1),(11,'2016_06_01_000001_create_oauth_auth_codes_table',1),(12,'2016_06_01_000002_create_oauth_access_tokens_table',1),(13,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(14,'2016_06_01_000004_create_oauth_clients_table',1),(15,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(16,'2016_07_03_062439_create_history_tables',1),(17,'2017_02_21_070324_alter_attachments_table_extend_filetype',1),(18,'2017_02_21_070324_create_attachments_table',1),(19,'2017_03_30_152742_add_soft_deletes_to_messages_table',1),(20,'2017_04_04_131153_create_sessions_table',1),(21,'2017_06_14_054710_create_categories_table',1),(22,'2017_06_14_054809_create_technologies_table',1),(23,'2017_06_14_054836_create_courses_table',1),(24,'2017_06_14_055008_create_course_technology_table',1),(25,'2017_06_14_055404_create_sections_table',1),(26,'2017_06_14_055413_create_lessons_table',1),(27,'2017_06_14_055423_create_contents_table',1),(28,'2017_06_14_055439_create_coupons_table',1),(29,'2017_06_14_055449_create_payments_table',1),(30,'2017_06_15_221441_create_course_user_table',1),(31,'2017_06_16_023847_create_announcements_table',1),(32,'2017_06_16_023957_create_announcement_course_table',1),(33,'2017_06_20_023937_create_bookmarks_table',1),(34,'2017_06_20_060122_create_announcement_comments_table',1),(35,'2017_06_20_221912_create_questions_table',1),(36,'2017_06_20_222044_create_answers_table',1),(37,'2017_06_22_200844_create_question_follows_table',1),(38,'2017_06_22_210740_create_helpful_answers_table',1),(39,'2017_06_23_143833_add_bio_and_title_to_user',1),(40,'2017_06_25_204059_create_reviews_table',1),(41,'2017_06_28_034938_create_approvals_table',1),(42,'2017_06_28_064930_create_course_review_ratings_table',1),(43,'2017_06_28_183745_create_withdrawals_table',1),(44,'2017_06_29_193137_create_completions_table',1),(45,'2017_07_06_221257_create_blog_categories_table',1),(46,'2017_07_07_220916_create_blogs_table',1),(47,'2017_07_10_225017_create_notifications_table',1),(48,'2017_07_13_050605_create_system_messages_table',1),(49,'2017_07_13_051053_system_message_user',1),(50,'2017_08_18_185202_add_referral_id_to_payments',2),(52,'2017_08_19_025027_add_affiliate_earning_to_payment',3),(55,'2017_09_12_142551_create_quiz_questions_table',4),(56,'2017_09_12_142611_create_quiz_answers_table',4),(59,'2017_10_05_212841_create_quiz_attempts_table',5),(60,'2017_10_05_212853_create_quiz_attempt_details_table',5),(63,'2017_10_16_181841_add_affiliate_id_to_users',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`)
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
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('75de2c2d8f4426af7f9ab06cbc644092903e7146385fc2d99fcf1fa521b672da0d7f35c5e6430d1d',3,3,'App Token','[]',1,'2017-08-14 21:38:07','2017-08-14 21:38:07','2018-08-14 21:38:07'),('a4470499109c6eb1558bca324bc10b13d218310559690e6e2f026c58e63c33499305481750097903',2,3,'App Token','[]',1,'2017-08-14 21:34:07','2017-08-14 21:34:07','2018-08-14 21:34:07'),('cdecb4c862362955dd8947b1b573e26a0ae80709779c5661ccfa962a7ccc0624cb38d82f42391d79',1,3,'App Token','[]',0,'2017-08-14 22:56:12','2017-08-14 22:56:12','2018-08-14 22:56:12'),('db510dc2a978b6d58f009858fa9b718584902b1989a81aa191e076aa62a6fac54d8fd5c1cbcc48c5',5,3,'App Token','[]',1,'2017-08-14 21:36:07','2017-08-14 21:36:07','2018-08-14 21:36:07');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Tutor Pro Personal Access Client','hgnyIpcmGqc9hrJJyx03h9xK42rirkVQoNLFooHH','http://localhost',1,0,0,'2017-08-09 03:31:52','2017-08-09 03:31:52'),(2,NULL,'Tutor Pro Password Grant Client','qxMZWYwRa5em0id6x28PFJmNd7SYzS7hoybyEdKo','http://localhost',0,1,0,'2017-08-09 03:31:52','2017-08-09 03:31:52'),(3,NULL,'Tutor Pro Personal Access Client','XzCk084AFuIt9B09LkRPfLfwS0ZhZ7p2Zl2GSOwu','http://localhost',1,0,0,'2017-08-09 03:32:01','2017-08-09 03:32:01'),(4,NULL,'Tutor Pro Password Grant Client','32SmhfbxHXnsNEf22QVkI05tzGvcxPYgwRpZOYIw','http://localhost',0,1,0,'2017-08-09 03:32:01','2017-08-09 03:32:01');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2017-08-09 03:31:52','2017-08-09 03:31:52'),(2,3,'2017-08-09 03:32:01','2017-08-09 03:32:01');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `last_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
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
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `coupon_id` int(10) unsigned DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `author_earning` decimal(12,2) DEFAULT NULL,
  `affiliate_earning` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_course_id_foreign` (`course_id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_coupon_id_foreign` (`coupon_id`),
  CONSTRAINT `payments_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (2,3,2),(3,2,2);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view-backend','View Backend',1,'2017-07-31 02:46:52','2017-07-31 02:46:52'),(2,'manage-course','Manage Courses',2,'2017-07-31 02:46:52','2017-07-31 02:46:52'),(3,'manage-coupon','Manage Coupons',3,'2017-07-31 02:46:52','2017-07-31 02:46:52');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_follows`
--

DROP TABLE IF EXISTS `question_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_follows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_follows_user_id_foreign` (`user_id`),
  KEY `question_follows_question_id_foreign` (`question_id`),
  CONSTRAINT `question_follows_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `question_follows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_follows`
--

LOCK TABLES `question_follows` WRITE;
/*!40000 ALTER TABLE `question_follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_course_id_foreign` (`course_id`),
  KEY `questions_user_id_foreign` (`user_id`),
  CONSTRAINT `questions_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_answers`
--

DROP TABLE IF EXISTS `quiz_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  `explanation` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_answers_question_id_foreign` (`question_id`),
  CONSTRAINT `quiz_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `quiz_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_answers`
--

LOCK TABLES `quiz_answers` WRITE;
/*!40000 ALTER TABLE `quiz_answers` DISABLE KEYS */;
INSERT INTO `quiz_answers` VALUES (46,16,'Yes',0,NULL,'2017-10-05 16:31:53','2017-10-05 16:31:53'),(47,16,'No',1,NULL,'2017-10-05 16:31:53','2017-10-05 16:31:53'),(48,16,'Maybe',0,NULL,'2017-10-05 16:31:53','2017-10-05 16:31:53'),(49,17,'With some answers',1,'aasas aasas','2017-10-05 16:32:29','2017-10-05 16:32:29'),(50,17,'Ans more answers',0,NULL,'2017-10-05 16:32:29','2017-10-05 16:32:29'),(53,15,'No not at all',0,'There certainly is no explanation for this answer','2017-10-06 15:46:26','2017-10-06 15:46:26'),(54,15,'asasasasas',1,NULL,'2017-10-06 15:46:26','2017-10-06 15:46:26'),(55,18,'Justin Trudeau',1,NULL,'2017-10-22 04:28:13','2017-10-22 04:28:13'),(56,18,'Tom Mulcair',0,NULL,'2017-10-22 04:28:13','2017-10-22 04:28:13'),(57,18,'Kevin',0,NULL,'2017-10-22 04:28:13','2017-10-22 04:28:13'),(58,19,'PHP framework',0,NULL,'2017-10-22 04:29:03','2017-10-22 04:29:03'),(59,19,'Javascript framework',1,NULL,'2017-10-22 04:29:03','2017-10-22 04:29:03'),(60,19,'Backend client',0,NULL,'2017-10-22 04:29:03','2017-10-22 04:29:03');
/*!40000 ALTER TABLE `quiz_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_attempt_details`
--

DROP TABLE IF EXISTS `quiz_attempt_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_attempt_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attempt_id` int(10) unsigned NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `chosen_answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_attempt_details_attempt_id_foreign` (`attempt_id`),
  CONSTRAINT `quiz_attempt_details_attempt_id_foreign` FOREIGN KEY (`attempt_id`) REFERENCES `quiz_attempts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_attempt_details`
--

LOCK TABLES `quiz_attempt_details` WRITE;
/*!40000 ALTER TABLE `quiz_attempt_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_attempt_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_attempts`
--

DROP TABLE IF EXISTS `quiz_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_attempts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `lesson_id` int(10) unsigned NOT NULL,
  `total_attempted` int(11) NOT NULL,
  `total_correct` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_attempts_user_id_foreign` (`user_id`),
  KEY `quiz_attempts_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `quiz_attempts_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_attempts`
--

LOCK TABLES `quiz_attempts` WRITE;
/*!40000 ALTER TABLE `quiz_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` int(10) unsigned NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_lesson` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_questions_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `quiz_questions_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_questions`
--

LOCK TABLES `quiz_questions` WRITE;
/*!40000 ALTER TABLE `quiz_questions` DISABLE KEYS */;
INSERT INTO `quiz_questions` VALUES (15,51,'<p>A New Question from me also edited</p>',NULL,'2017-10-05 15:09:13','2017-10-05 16:31:34'),(16,51,'<p>This is an edited question</p>',NULL,'2017-10-05 15:33:58','2017-10-05 16:30:21'),(17,51,'<p>I can also add a question</p>',NULL,'2017-10-05 16:32:29','2017-10-05 16:32:29'),(18,52,'<p>Who is the PM of Canada?</p>',NULL,'2017-10-22 04:28:13','2017-10-22 04:28:13'),(19,52,'<p>What is Vuejs?</p>',NULL,'2017-10-22 04:29:03','2017-10-22 04:29:03');
/*!40000 ALTER TABLE `quiz_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rating` decimal(4,1) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_course_id_foreign` (`course_id`),
  CONSTRAINT `reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1),(2,2,2),(8,5,2),(9,3,3);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator',1,1,'2017-07-31 02:46:51','2017-07-31 02:46:51'),(2,'Author',0,2,'2017-07-31 02:46:51','2017-07-31 02:46:51'),(3,'User',0,3,'2017-07-31 02:46:51','2017-07-31 02:46:51');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objective` text COLLATE utf8mb4_unicode_ci,
  `sortOrder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sections_course_id_foreign` (`course_id`),
  CONSTRAINT `sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,1,'Course Introduction','Setup the tools required in the course.',1,'2017-07-31 03:29:24','2017-07-31 03:32:54'),(2,1,'Section Two of this course','Learn how to drag and drop content to reorder lessons in the application',2,'2017-07-31 03:50:38','2017-07-31 03:50:38'),(4,2,'Course Introduction','Setup the tools required in the course.',1,'2017-07-31 03:29:24','2017-07-31 03:32:54'),(5,2,'Section Two of this course','Setup the tools required in the course.',2,'2017-07-31 03:29:24','2017-07-31 03:32:54'),(6,3,'Start here','Short course objective',1,'2017-08-02 02:31:11','2017-08-02 02:31:11'),(7,3,'Section two','Learn how to do some more stuff',2,'2017-08-02 02:39:19','2017-08-02 02:39:19'),(10,5,'Start here','Short course objective',1,'2017-08-02 03:00:25','2017-08-02 03:00:25'),(11,5,'Section two',NULL,2,'2017-08-02 03:06:41','2017-08-02 03:06:41'),(12,6,'Start here','Short course objective',1,'2017-08-02 03:14:09','2017-08-02 03:14:09'),(13,6,'Second Section','This is a section section',2,'2017-08-02 03:20:09','2017-08-02 03:20:09'),(14,7,'Start here','Short course objective',1,'2017-08-02 03:27:57','2017-08-02 03:27:57'),(15,7,'This is a second section',NULL,2,'2017-08-02 03:32:35','2017-08-02 03:32:35'),(18,9,'Start here','Short course objective',1,'2017-08-02 03:51:38','2017-08-02 03:51:38'),(19,9,'Second Section',NULL,2,'2017-08-02 03:56:25','2017-08-02 03:56:25');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_logins`
--

DROP TABLE IF EXISTS `social_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_logins_user_id_foreign` (`user_id`),
  CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_logins`
--

LOCK TABLES `social_logins` WRITE;
/*!40000 ALTER TABLE `social_logins` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_message_user`
--

DROP TABLE IF EXISTS `system_message_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_message_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system_message_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `system_message_user_system_message_id_foreign` (`system_message_id`),
  KEY `system_message_user_user_id_foreign` (`user_id`),
  CONSTRAINT `system_message_user_system_message_id_foreign` FOREIGN KEY (`system_message_id`) REFERENCES `system_messages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `system_message_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_message_user`
--

LOCK TABLES `system_message_user` WRITE;
/*!40000 ALTER TABLE `system_message_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_message_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_messages`
--

DROP TABLE IF EXISTS `system_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `recipient_group` enum('everyone','authors','students','admins','inactive-users','selected-users') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_messages`
--

LOCK TABLES `system_messages` WRITE;
/*!40000 ALTER TABLE `system_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taggable_taggables`
--

DROP TABLE IF EXISTS `taggable_taggables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taggable_taggables` (
  `tag_id` int(10) unsigned NOT NULL,
  `taggable_id` int(10) unsigned NOT NULL,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taggable_taggables`
--

LOCK TABLES `taggable_taggables` WRITE;
/*!40000 ALTER TABLE `taggable_taggables` DISABLE KEYS */;
INSERT INTO `taggable_taggables` VALUES (1,1,'App\\Models\\Course','2017-07-31 03:29:39','2017-07-31 03:29:39'),(2,1,'App\\Models\\Course','2017-07-31 03:29:39','2017-07-31 03:29:39'),(3,1,'App\\Models\\Course','2017-07-31 03:29:39','2017-07-31 03:29:39'),(4,3,'App\\Models\\Course','2017-08-02 02:31:33','2017-08-02 02:31:33'),(5,3,'App\\Models\\Course','2017-08-02 02:31:33','2017-08-02 02:31:33'),(1,4,'App\\Models\\Course','2017-08-02 02:51:30','2017-08-02 02:51:30'),(4,4,'App\\Models\\Course','2017-08-02 02:51:30','2017-08-02 02:51:30'),(5,4,'App\\Models\\Course','2017-08-02 02:51:30','2017-08-02 02:51:30'),(6,4,'App\\Models\\Course','2017-08-02 02:51:30','2017-08-02 02:51:30'),(4,5,'App\\Models\\Course','2017-08-02 03:01:20','2017-08-02 03:01:20'),(5,5,'App\\Models\\Course','2017-08-02 03:01:20','2017-08-02 03:01:20'),(6,5,'App\\Models\\Course','2017-08-02 03:01:20','2017-08-02 03:01:20'),(5,6,'App\\Models\\Course','2017-08-02 03:16:25','2017-08-02 03:16:25'),(6,6,'App\\Models\\Course','2017-08-02 03:16:25','2017-08-02 03:16:25'),(7,6,'App\\Models\\Course','2017-08-02 03:16:25','2017-08-02 03:16:25'),(5,7,'App\\Models\\Course','2017-08-02 03:28:07','2017-08-02 03:28:07'),(4,7,'App\\Models\\Course','2017-08-02 03:28:07','2017-08-02 03:28:07'),(3,8,'App\\Models\\Course','2017-08-02 03:41:19','2017-08-02 03:41:19'),(8,8,'App\\Models\\Course','2017-08-02 03:41:19','2017-08-02 03:41:19'),(9,8,'App\\Models\\Course','2017-08-02 03:41:19','2017-08-02 03:41:19'),(8,9,'App\\Models\\Course','2017-08-02 03:51:47','2017-08-02 03:51:47'),(10,9,'App\\Models\\Course','2017-08-02 03:51:47','2017-08-02 03:51:47'),(1,9,'App\\Models\\Course','2017-08-02 03:51:47','2017-08-02 03:51:47'),(3,9,'App\\Models\\Course','2017-08-02 03:51:47','2017-08-02 03:51:47'),(1,10,'App\\Models\\Course','2017-08-02 04:02:11','2017-08-02 04:02:11'),(9,10,'App\\Models\\Course','2017-08-02 04:02:11','2017-08-02 04:02:11'),(8,10,'App\\Models\\Course','2017-08-02 04:02:11','2017-08-02 04:02:11'),(3,10,'App\\Models\\Course','2017-08-02 04:02:11','2017-08-02 04:02:11'),(2,10,'App\\Models\\Course','2017-08-02 04:02:11','2017-08-02 04:02:11'),(7,2,'App\\Models\\Course','2017-08-14 03:24:42','2017-08-14 03:24:42'),(5,2,'App\\Models\\Course','2017-08-14 03:24:42','2017-08-14 03:24:42'),(1,2,'App\\Models\\Course','2017-08-14 03:24:42','2017-08-14 03:24:42'),(6,10,'App\\Models\\Course','2017-10-23 21:08:49','2017-10-23 21:08:49');
/*!40000 ALTER TABLE `taggable_taggables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taggable_tags`
--

DROP TABLE IF EXISTS `taggable_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taggable_tags` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `normalized` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taggable_tags`
--

LOCK TABLES `taggable_tags` WRITE;
/*!40000 ALTER TABLE `taggable_tags` DISABLE KEYS */;
INSERT INTO `taggable_tags` VALUES (1,'javascript','javascript','2017-07-31 03:29:24','2017-07-31 03:29:24'),(2,'vuejs','vuejs','2017-07-31 03:29:24','2017-07-31 03:29:24'),(3,'jquery','jquery','2017-07-31 03:29:24','2017-07-31 03:29:24'),(4,'SMART','smart','2017-08-02 02:31:11','2017-08-02 02:31:11'),(5,'Project management','project management','2017-08-02 02:31:11','2017-08-02 02:31:11'),(6,'Gantt charts','gantt charts','2017-08-02 02:51:19','2017-08-02 02:51:19'),(7,'Budgeting','budgeting','2017-08-02 03:14:09','2017-08-02 03:14:09'),(8,'html','html','2017-08-02 03:41:07','2017-08-02 03:41:07'),(9,'css','css','2017-08-02 03:41:07','2017-08-02 03:41:07'),(10,'emberjs','emberjs','2017-08-02 03:51:38','2017-08-02 03:51:38');
/*!40000 ALTER TABLE `taggable_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technologies`
--

DROP TABLE IF EXISTS `technologies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technologies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technologies`
--

LOCK TABLES `technologies` WRITE;
/*!40000 ALTER TABLE `technologies` DISABLE KEYS */;
/*!40000 ALTER TABLE `technologies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affiliate_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '40852',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','John','admin@admin.com','$2y$10$7QbrKdgiIUBzmXLzq7hXSuGZLnTVh9TDOlp9tzM60R7DfyC4CL0qy',1,'c6bea1df210b2c7ac7a940796157faae',1,'noEwBqg7a1IA2qU2Sy29wvljhk3FIPnaoI6JuwjKwQxUJOkYyJt7cfWpEtMG','2017-07-31 02:46:51','2017-10-16 18:34:36',NULL,'admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'129887'),(2,'Author','Jane','author@author.com','$2y$10$1LxVAbnTsVszfcP2pdh7reCbM4GNVSkA5PjrNEZ1092s/SxX6mJW.',1,'2dff3a0cbff8b5491c43df6b3ef98b6d',1,'xeW6HimSlN3xXE4wVYQCUnRtPPiqkSS4p0pDGhvGAJAJvZXRKQ2WZVWn2A5M','2017-07-31 02:46:51','2017-10-16 18:34:36',NULL,'author','Application Developer','I am an application developer with several years of experience. Praesent massa nibh, facilisis ac purus vel, commodo condimentum purus. Phasellus mollis, arcu id commodo rutrum, urna mi vestibulum lectus, quis efficitur risus lectus eget nibh. Etiam lacinia tellus quis lorem lacinia commodo. Integer nisl sem, euismod vel tortor vel, imperdiet fringilla turpis. Nullam quis libero sed erat aliquet congue fringilla sit amet lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus placerat elit non lacinia mollis. Nam enim elit, viverra ut ultricies quis, tincidunt at nunc. Integer sodales mi a aliquam condimentum. Fusce ullamcorper augue ac risus finibus condimentum. Curabitur tincidunt, tortor in posuere gravida, turpis augue pharetra urna, eu semper lacus ex non justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',NULL,'#','#','#','#',NULL,'#','259774'),(3,'User','Mike','user@user.com','$2y$10$.VsNLaWlZgu6rjvMS0iC.esf0NLrqmDvl5xlx6flB/BjqcImYhpCS',1,'ce395c58e6e0df517f5a888c81be3fff',1,'z8HZbzfLQ0JQLP7ge3snlNXtMcfci5VAx1TIYawOPKH4bUtwIZrWYYAugpsw','2017-07-31 02:46:51','2017-10-18 15:57:40',NULL,'user',NULL,NULL,'59e779f4b4ce9.png',NULL,NULL,NULL,NULL,NULL,NULL,'389661'),(5,'Miguel','Joses','miguel@author.com','$2y$10$HRgAYVJ35leF.2.wCeOlj.FrC0T7dSErQANgokCGhXmB5C0PdV7l2',1,'ba335a87cf7a2ff271cba586f3037f89',1,'tjfd8kKL4XRHQKrvC5dZXXNAhA5k48Rbly8Z4zKNyXC4TRf8IHEFsHTCMrJ7','2017-08-02 02:02:07','2017-10-16 18:34:36',NULL,'miguel','Experienced Project Manager','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in commodo libero, id pellentesque elit. Fusce tortor nunc, rhoncus eu dictum et, laoreet vitae elit. Vestibulum iaculis, odio ac mollis maximus, purus justo pellentesque est, vel pharetra ipsum felis nec lorem. Donec eu dolor nec tellus rutrum aliquam ut sit amet eros. Aliquam eget neque vitae velit imperdiet fringilla vel id lacus. Quisque ac ex in urna fermentum viverra lobortis at felis. Nulla ullamcorper tellus eget leo efficitur dictum. Aliquam vel imperdiet eros, sit amet dictum turpis. Nulla facilisi. Maecenas at imperdiet dolor. Nam porta enim vel ligula suscipit tristique. Morbi tempus nisi vel velit efficitur mattis. Curabitur eu interdum libero.\r\n\r\nAliquam porta justo egestas mi rhoncus, vel semper leo auctor. Duis pretium sollicitudin nunc, non ultricies massa elementum et. Sed purus felis, fringilla a tempus non, ultrices sit amet urna. Praesent at pulvinar orci. Ut eget ex non purus semper suscipit. Mauris non urna sit amet elit interdum auctor. Quisque efficitur orci nulla, a ultrices velit semper at. Quisque imperdiet enim sit amet elit tempor, ut cursus nibh interdum.',NULL,'#',NULL,'#','#',NULL,NULL,'649435');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdrawals`
--

DROP TABLE IF EXISTS `withdrawals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `withdrawals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `paypal_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('submitted','processing','processed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdrawals_user_id_foreign` (`user_id`),
  CONSTRAINT `withdrawals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdrawals`
--

LOCK TABLES `withdrawals` WRITE;
/*!40000 ALTER TABLE `withdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdrawals` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-10 20:00:49

-- MySQL dump 10.13  Distrib 5.6.30, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: oprp
-- ------------------------------------------------------
-- Server version	5.6.30-0ubuntu0.14.04.1

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
-- Table structure for table `academic_be`
--

DROP TABLE IF EXISTS `academic_be`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academic_be` (
  `student_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `school_10` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `board_10` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `year_10` int(4) DEFAULT NULL,
  `subject_10` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `agg_10` float DEFAULT NULL,
  `img_10` varchar(10) DEFAULT NULL,
  `school_12` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `board_12` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `year_12` int(4) DEFAULT NULL,
  `subject_12` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `agg_12` float DEFAULT NULL,
  `img_12` varchar(10) DEFAULT NULL,
  `entrance` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `entrance_category` varchar(10) DEFAULT NULL,
  `rank` bigint(10) DEFAULT NULL,
  `sem_1` float DEFAULT NULL,
  `sem_2` float DEFAULT NULL,
  `sem_3` float DEFAULT NULL,
  `sem_4` float DEFAULT NULL,
  `sem_5` float DEFAULT NULL,
  `sem_6` float DEFAULT NULL,
  `sem_7` float DEFAULT NULL,
  `sem_8` float DEFAULT NULL,
  `agg` float NOT NULL DEFAULT '0',
  `dept_rank` int(5) DEFAULT NULL,
  `branch` text NOT NULL,
  `year_of_grad` int(4) NOT NULL,
  `backlog` varchar(100) DEFAULT NULL,
  `backlog_reason` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_be`
--

LOCK TABLES `academic_be` WRITE;
/*!40000 ALTER TABLE `academic_be` DISABLE KEYS */;
/*!40000 ALTER TABLE `academic_be` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `academic_mba`
--

DROP TABLE IF EXISTS `academic_mba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academic_mba` (
  `student_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `school_10` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `board_10` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `year_10` int(4) DEFAULT NULL,
  `subject_10` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `agg_10` float DEFAULT NULL,
  `img_10` varchar(10) DEFAULT NULL,
  `school_12` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `board_12` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `year_12` int(4) DEFAULT NULL,
  `subject_12` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `agg_12` float DEFAULT NULL,
  `img_12` varchar(10) DEFAULT NULL,
  `grad_course` varchar(50) DEFAULT NULL,
  `grad_univ` varchar(100) DEFAULT NULL,
  `grad_field` varchar(50) DEFAULT NULL,
  `grad_year` int(4) DEFAULT NULL,
  `grad_agg` float DEFAULT NULL,
  `grad_sub` varchar(500) DEFAULT NULL,
  `grad_doc` varchar(5) DEFAULT NULL,
  `entrance` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `entrance_category` varchar(10) DEFAULT NULL,
  `rank` bigint(10) DEFAULT NULL,
  `sem_1` float DEFAULT NULL,
  `sem_2` float DEFAULT NULL,
  `sem_3` float DEFAULT NULL,
  `sem_4` float DEFAULT NULL,
  `agg` float NOT NULL DEFAULT '0',
  `dept_rank` int(5) DEFAULT NULL,
  `branch` text NOT NULL,
  `year_of_pg` int(4) NOT NULL,
  `backlog` varchar(100) DEFAULT NULL,
  `backlog_reason` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_mba`
--

LOCK TABLES `academic_mba` WRITE;
/*!40000 ALTER TABLE `academic_mba` DISABLE KEYS */;
/*!40000 ALTER TABLE `academic_mba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `academic_me`
--

DROP TABLE IF EXISTS `academic_me`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academic_me` (
  `student_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `school_10` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `board_10` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `year_10` int(4) DEFAULT NULL,
  `subject_10` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `agg_10` float DEFAULT NULL,
  `img_10` varchar(10) DEFAULT NULL,
  `school_12` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `board_12` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `year_12` int(4) DEFAULT NULL,
  `subject_12` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `agg_12` float DEFAULT NULL,
  `img_12` varchar(10) DEFAULT NULL,
  `grad_course` varchar(50) DEFAULT NULL,
  `grad_univ` varchar(100) DEFAULT NULL,
  `grad_field` varchar(50) DEFAULT NULL,
  `grad_year` int(4) DEFAULT NULL,
  `grad_agg` float DEFAULT NULL,
  `grad_sub` varchar(500) DEFAULT NULL,
  `grad_doc` varchar(5) DEFAULT NULL,
  `entrance` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `entrance_category` varchar(10) DEFAULT NULL,
  `rank` bigint(10) DEFAULT NULL,
  `sem_1` float DEFAULT NULL,
  `sem_2` float DEFAULT NULL,
  `sem_3` float DEFAULT NULL,
  `sem_4` float DEFAULT NULL,
  `agg` float NOT NULL DEFAULT '0',
  `dept_rank` int(5) DEFAULT NULL,
  `branch` text NOT NULL,
  `year_of_pg` int(4) NOT NULL,
  `backlog` varchar(100) DEFAULT NULL,
  `backlog_reason` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_me`
--

LOCK TABLES `academic_me` WRITE;
/*!40000 ALTER TABLE `academic_me` DISABLE KEYS */;
/*!40000 ALTER TABLE `academic_me` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcement` (
  `announce_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `heading` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `content` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `attachment` varchar(50) DEFAULT NULL,
  `announce_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator_id` bigint(10) NOT NULL,
  `creator_access` bigint(10) NOT NULL,
  `year` varchar(40) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `recruiter_id` int(5) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`announce_id`),
  KEY `fk_announcement_1_idx` (`recruiter_id`),
  CONSTRAINT `fk_announcement_1` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiter` (`recruiter_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `recruiter_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` enum('Applied','Pending','Selected','Rejected') CHARACTER SET utf8 NOT NULL DEFAULT 'Applied',
  `app_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cover_letter` text CHARACTER SET utf8,
  `notes` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fk_applications_1_idx` (`recruiter_id`),
  KEY `fk_applications_2_idx` (`student_id`),
  CONSTRAINT `fk_applications_1` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiter` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_applications_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `branch_code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `branch_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `branch_course` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`branch_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES ('BIN','BIN','me'),('BT','Bio Technology','be'),('C&I','C&I','me'),('CE','Civil Engineering','be'),('CO','Computer Engineering','be'),('CTA','CTA','me'),('EC','Electronics and Comm Engineering','be'),('EE','Electrical Engineering','be'),('EN','Environmental Engineering','be'),('ENV','ENV','me'),('GTE','GTE','me'),('ISY','ISY','me'),('IT','Information Technology','be'),('MBA','MBA','mba'),('ME','Mechanical Engineering','be'),('MOC','MOC','me'),('NST','NST','me'),('PE','Production Engineering','be'),('PRD','PRD','me'),('PS','Polymer Science','be'),('PSY','PSY','me'),('PTY','PTY','me'),('SPD','SPD','me'),('STR','STR','me'),('SWE','SWE','me'),('THR','THR','me'),('VLS','VLS','me');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `company_id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `logo_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest`
--

DROP TABLE IF EXISTS `contest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest` (
  `contest_id` int(11) NOT NULL AUTO_INCREMENT,
  `contest_name` varchar(50) NOT NULL,
  `contest_value` varchar(8) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `min_marks` int(11) NOT NULL,
  `submission_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`contest_id`),
  UNIQUE KEY `contest_value` (`contest_value`),
  KEY `fk_contest_1_idx` (`user_id`),
  CONSTRAINT `fk_contest_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest`
--

LOCK TABLES `contest` WRITE;
/*!40000 ALTER TABLE `contest` DISABLE KEYS */;
/*!40000 ALTER TABLE `contest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_comment`
--

DROP TABLE IF EXISTS `forum_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_comment` (
  `comment_id` int(8) NOT NULL AUTO_INCREMENT,
  `topic_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `fk_forum_comment_1_idx` (`topic_id`),
  KEY `fk_forum_comment_2_idx` (`user_id`),
  CONSTRAINT `fk_forum_comment_1` FOREIGN KEY (`topic_id`) REFERENCES `forum_topic` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_forum_comment_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_comment`
--

LOCK TABLES `forum_comment` WRITE;
/*!40000 ALTER TABLE `forum_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_subs`
--

DROP TABLE IF EXISTS `forum_subs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_subs` (
  `topic_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  KEY `fk_forum_subs_1_idx` (`topic_id`),
  KEY `fk_forum_subs_2_idx` (`user_id`),
  CONSTRAINT `fk_forum_subs_1` FOREIGN KEY (`topic_id`) REFERENCES `forum_topic` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_forum_subs_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_subs`
--

LOCK TABLES `forum_subs` WRITE;
/*!40000 ALTER TABLE `forum_subs` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_subs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_topic`
--

DROP TABLE IF EXISTS `forum_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_topic` (
  `topic_id` int(8) NOT NULL AUTO_INCREMENT,
  `heading` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `topic_type` enum('General','Preparation','Experience','Opportunity') NOT NULL,
  `company_id` int(8) DEFAULT NULL,
  `user_id` int(8) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`topic_id`),
  KEY `fk_forum_topic_1_idx` (`user_id`),
  CONSTRAINT `fk_forum_topic_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_topic`
--

LOCK TABLES `forum_topic` WRITE;
/*!40000 ALTER TABLE `forum_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link`
--

DROP TABLE IF EXISTS `link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_value` varchar(10) NOT NULL,
  `link_name` varchar(40) DEFAULT NULL,
  `link_prog` varchar(50000) NOT NULL,
  `link_ext` varchar(8) NOT NULL,
  `link_input` text,
  `link_output` text NOT NULL,
  `exec_time` float NOT NULL,
  `link_comment` text,
  `share` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `compile_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`link_id`),
  UNIQUE KEY `link_value` (`link_value`),
  UNIQUE KEY `link_value_2` (`link_value`),
  KEY `fk_link_1_idx` (`user_id`),
  CONSTRAINT `fk_link_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link`
--

LOCK TABLES `link` WRITE;
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_1` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `training_2` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `training_3` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `training_4` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `training_5` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `training_6` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `professional_society` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `extra_curricular` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `career_objectives` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `skills_tech` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `skills_other` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `hobbies` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  CONSTRAINT `fk_projects_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `que_id` int(11) NOT NULL AUTO_INCREMENT,
  `que_value` varchar(10) NOT NULL,
  `que_title` varchar(50) NOT NULL,
  `que_description` text NOT NULL,
  `que_input` text NOT NULL,
  `que_output` text NOT NULL,
  `output_description` text,
  `exec_time` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `points` double NOT NULL,
  `universal` tinyint(1) NOT NULL,
  `contest_value` varchar(8) NOT NULL,
  `submitted_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`que_id`),
  UNIQUE KEY `que_value` (`que_value`),
  KEY `fk_question_1_idx` (`contest_value`),
  CONSTRAINT `fk_question_1` FOREIGN KEY (`contest_value`) REFERENCES `contest` (`contest_value`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recruiter`
--

DROP TABLE IF EXISTS `recruiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recruiter` (
  `recruiter_id` int(11) NOT NULL,
  `company_id` int(8) NOT NULL,
  `arrival_date` date DEFAULT NULL,
  `grade` varchar(5) NOT NULL,
  `app_date` datetime NOT NULL,
  `status` binary(1) NOT NULL DEFAULT '1',
  `branches` varchar(200) NOT NULL DEFAULT '',
  `min_score` double NOT NULL,
  `for_year` int(4) NOT NULL,
  `job_description` varchar(100) DEFAULT '',
  `contact` bigint(15) NOT NULL,
  `notes` varchar(200) DEFAULT '',
  PRIMARY KEY (`recruiter_id`),
  KEY `fk_recruiter_1_idx` (`company_id`),
  CONSTRAINT `fk_recruiter_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recruiter`
--

LOCK TABLES `recruiter` WRITE;
/*!40000 ALTER TABLE `recruiter` DISABLE KEYS */;
/*!40000 ALTER TABLE `recruiter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `roll_no` varchar(50) CHARACTER SET utf8 NOT NULL,
  `course` varchar(5) NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `guardian_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `local_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone_1` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `phone_2` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `sex` enum('Male','Female') CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `citizenship` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `home_town` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `home_state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `image_type` char(5) DEFAULT NULL,
  `mail_announce` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `roll_no` (`roll_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submission`
--

DROP TABLE IF EXISTS `submission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submission` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `submission_value` varchar(10) NOT NULL,
  `que_value` varchar(10) NOT NULL,
  `submission_prog` text NOT NULL,
  `submission_ext` varchar(10) NOT NULL,
  `submission_status` int(1) NOT NULL,
  `submission_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`submission_id`),
  UNIQUE KEY `submission_value` (`submission_value`),
  KEY `fk_submission_1_idx` (`user_id`),
  KEY `fk_submission_2_idx` (`que_value`),
  CONSTRAINT `fk_submission_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_submission_2` FOREIGN KEY (`que_value`) REFERENCES `question` (`que_value`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submission`
--

LOCK TABLES `submission` WRITE;
/*!40000 ALTER TABLE `submission` DISABLE KEYS */;
/*!40000 ALTER TABLE `submission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `access` int(3) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `Username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','abc@xyz.com','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',29);
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

-- Dump completed on 2016-05-14 22:30:42

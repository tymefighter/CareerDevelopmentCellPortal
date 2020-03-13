-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for osx10.14 (x86_64)
--
-- Host: localhost    Database: cdc
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

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
-- Table structure for table `academic_performance`
--

DROP TABLE IF EXISTS `academic_performance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academic_performance` (
  `perf_id` char(9) NOT NULL,
  `sem1` decimal(4,2) DEFAULT NULL,
  `sem2` decimal(4,2) DEFAULT NULL,
  `sem3` decimal(4,2) DEFAULT NULL,
  `sem4` decimal(4,2) DEFAULT NULL,
  `sem5` decimal(4,2) DEFAULT NULL,
  `sem6` decimal(4,2) DEFAULT NULL,
  `sem7` decimal(4,2) DEFAULT NULL,
  `sem8` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`perf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_performance`
--

LOCK TABLES `academic_performance` WRITE;
/*!40000 ALTER TABLE `academic_performance` DISABLE KEYS */;
INSERT INTO `academic_performance` VALUES ('acadperf1',9.80,9.40,9.80,9.90,9.90,NULL,NULL,NULL),('acadperf2',7.10,6.42,6.10,NULL,NULL,NULL,NULL,NULL),('acadperf3',9.10,7.20,6.54,6.30,6.10,10.00,10.00,NULL),('acadperf4',5.49,6.12,6.65,7.12,7.32,7.56,7.99,NULL);
/*!40000 ALTER TABLE `academic_performance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apply_internship`
--

DROP TABLE IF EXISTS `apply_internship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apply_internship` (
  `roll_number` char(9) NOT NULL,
  `internship_id` char(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`roll_number`,`internship_id`),
  KEY `internship_id` (`internship_id`),
  CONSTRAINT `apply_internship_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`) ON DELETE CASCADE,
  CONSTRAINT `apply_internship_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apply_internship`
--

LOCK TABLES `apply_internship` WRITE;
/*!40000 ALTER TABLE `apply_internship` DISABLE KEYS */;
INSERT INTO `apply_internship` VALUES ('111701002','intern1','2020-01-25'),('111701024','intern2','2020-01-12');
/*!40000 ALTER TABLE `apply_internship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apply_job`
--

DROP TABLE IF EXISTS `apply_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apply_job` (
  `roll_number` char(9) NOT NULL,
  `job_id` char(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`roll_number`,`job_id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `apply_job_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`) ON DELETE CASCADE,
  CONSTRAINT `apply_job_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apply_job`
--

LOCK TABLES `apply_job` WRITE;
/*!40000 ALTER TABLE `apply_job` DISABLE KEYS */;
INSERT INTO `apply_job` VALUES ('111701000','job1','2020-01-30'),('111701032','job1','2020-01-31');
/*!40000 ALTER TABLE `apply_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batch`
--

DROP TABLE IF EXISTS `batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batch` (
  `year_of_admission` int(11) NOT NULL,
  PRIMARY KEY (`year_of_admission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batch`
--

LOCK TABLES `batch` WRITE;
/*!40000 ALTER TABLE `batch` DISABLE KEYS */;
INSERT INTO `batch` VALUES (2015),(2016),(2017),(2018),(2019);
/*!40000 ALTER TABLE `batch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `belongs_to`
--

DROP TABLE IF EXISTS `belongs_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `belongs_to` (
  `roll_number` char(9) NOT NULL,
  `year_of_admission` int(11) NOT NULL,
  PRIMARY KEY (`roll_number`,`year_of_admission`),
  KEY `year_of_admission` (`year_of_admission`),
  CONSTRAINT `belongs_to_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`) ON DELETE CASCADE,
  CONSTRAINT `belongs_to_ibfk_2` FOREIGN KEY (`year_of_admission`) REFERENCES `batch` (`year_of_admission`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `belongs_to`
--

LOCK TABLES `belongs_to` WRITE;
/*!40000 ALTER TABLE `belongs_to` DISABLE KEYS */;
INSERT INTO `belongs_to` VALUES ('111701000',2016),('111701002',2017),('111701024',2018),('111701032',2016);
/*!40000 ALTER TABLE `belongs_to` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES ('civil'),('comp sc'),('electrical'),('mechanical');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdc_official`
--

DROP TABLE IF EXISTS `cdc_official`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdc_official` (
  `official_id` char(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phone_1` varchar(30) NOT NULL,
  `phone_2` varchar(30) DEFAULT NULL,
  `bldg_name` varchar(30) NOT NULL,
  `room_number` varchar(30) NOT NULL,
  PRIMARY KEY (`official_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdc_official`
--

LOCK TABLES `cdc_official` WRITE;
/*!40000 ALTER TABLE `cdc_official` DISABLE KEYS */;
INSERT INTO `cdc_official` VALUES ('official1','Hameed Sarkar','TPO','hameed@tpo.iit.com','3456432123','9654567890','ICSR office','100');
/*!40000 ALTER TABLE `cdc_official` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `cgpa`
--

DROP TABLE IF EXISTS `cgpa`;
/*!50001 DROP VIEW IF EXISTS `cgpa`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cgpa` (
  `roll_number` tinyint NOT NULL,
  `perf_id` tinyint NOT NULL,
  `cgpa` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `company_id` char(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email_id_1` varchar(320) NOT NULL,
  `email_id_2` varchar(320) DEFAULT NULL,
  `phone_1` varchar(30) NOT NULL,
  `phone_2` varchar(30) DEFAULT NULL,
  `is_startup` tinyint(1) NOT NULL,
  `type_of_organization` varchar(50) DEFAULT NULL,
  `business_domain` varchar(50) DEFAULT NULL,
  `company_overview` varchar(500) NOT NULL,
  `bldg_name` varchar(30) NOT NULL,
  `street_name` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES ('company_1','Hoogle','val@hoogle.com','vul@hoogle.in','422345678\n','435678987',0,'Sofware Company','BD1','Great Company','Mountain View Bldg','M view','LA','California','US','1234566'),('company_2','DEWA','vil@dewa.com','hul@dewa.ae','902345678\n','835678987',0,'Paints','BD2','Great Company','Twar Bldg','Twar 2','Al Twar','Dubai','UAE','5234566');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `company_internship`
--

DROP TABLE IF EXISTS `company_internship`;
/*!50001 DROP VIEW IF EXISTS `company_internship`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `company_internship` (
  `internship_id` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `company_overview` tinyint NOT NULL,
  `internship` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `stipend` tinyint NOT NULL,
  `duration` tinyint NOT NULL,
  `min_cgpa` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `company_job`
--

DROP TABLE IF EXISTS `company_job`;
/*!50001 DROP VIEW IF EXISTS `company_job`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `company_job` (
  `job_id` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `company_overview` tinyint NOT NULL,
  `job` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `ctc` tinyint NOT NULL,
  `perks` tinyint NOT NULL,
  `min_cgpa` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `company_login`
--

DROP TABLE IF EXISTS `company_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_login` (
  `company_id` char(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`company_id`,`username`),
  KEY `username` (`username`),
  CONSTRAINT `company_login_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE,
  CONSTRAINT `company_login_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login_details` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_login`
--

LOCK TABLES `company_login` WRITE;
/*!40000 ALTER TABLE `company_login` DISABLE KEYS */;
INSERT INTO `company_login` VALUES ('company_1','hoogle'),('company_2','soil');
/*!40000 ALTER TABLE `company_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `course_id` char(9) NOT NULL,
  `course_name` varchar(30) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES ('CE7194','Advanced Soil Engineering'),('CS2010','Data Structures'),('CS5308','AI'),('CS6010','Advanced Block Chain'),('CS7128','Advanced Deep Learning'),('MA6203','Advanced Prob Theory');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eligible_batch_internship`
--

DROP TABLE IF EXISTS `eligible_batch_internship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eligible_batch_internship` (
  `year_of_admission` int(11) NOT NULL,
  `internship_id` char(9) NOT NULL,
  PRIMARY KEY (`year_of_admission`,`internship_id`),
  KEY `internship_id` (`internship_id`),
  CONSTRAINT `eligible_batch_internship_ibfk_1` FOREIGN KEY (`year_of_admission`) REFERENCES `batch` (`year_of_admission`) ON DELETE CASCADE,
  CONSTRAINT `eligible_batch_internship_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eligible_batch_internship`
--

LOCK TABLES `eligible_batch_internship` WRITE;
/*!40000 ALTER TABLE `eligible_batch_internship` DISABLE KEYS */;
INSERT INTO `eligible_batch_internship` VALUES (2017,'intern1'),(2018,'intern2');
/*!40000 ALTER TABLE `eligible_batch_internship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eligible_branch_job`
--

DROP TABLE IF EXISTS `eligible_branch_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eligible_branch_job` (
  `branch_name` varchar(30) NOT NULL,
  `job_id` char(9) NOT NULL,
  PRIMARY KEY (`branch_name`,`job_id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `eligible_branch_job_ibfk_1` FOREIGN KEY (`branch_name`) REFERENCES `branch` (`name`) ON DELETE CASCADE,
  CONSTRAINT `eligible_branch_job_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eligible_branch_job`
--

LOCK TABLES `eligible_branch_job` WRITE;
/*!40000 ALTER TABLE `eligible_branch_job` DISABLE KEYS */;
INSERT INTO `eligible_branch_job` VALUES ('civil','job2'),('comp sc','job1');
/*!40000 ALTER TABLE `eligible_branch_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `has_branch`
--

DROP TABLE IF EXISTS `has_branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `has_branch` (
  `roll_number` char(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`roll_number`,`name`),
  KEY `name` (`name`),
  CONSTRAINT `has_branch_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`) ON DELETE CASCADE,
  CONSTRAINT `has_branch_ibfk_2` FOREIGN KEY (`name`) REFERENCES `branch` (`name`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `has_branch`
--

LOCK TABLES `has_branch` WRITE;
/*!40000 ALTER TABLE `has_branch` DISABLE KEYS */;
INSERT INTO `has_branch` VALUES ('111701000','comp sc'),('111701002','comp sc'),('111701024','civil'),('111701032','comp sc');
/*!40000 ALTER TABLE `has_branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `internship`
--

DROP TABLE IF EXISTS `internship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `internship` (
  `internship_id` char(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `stipend` double NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL,
  `min_cgpa` decimal(4,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`internship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internship`
--

LOCK TABLES `internship` WRITE;
/*!40000 ALTER TABLE `internship` DISABLE KEYS */;
INSERT INTO `internship` VALUES ('intern1','SDE Intern','software intern',80000,80,5.00),('intern2','Soil intern','Best internship',81000,85,5.50);
/*!40000 ALTER TABLE `internship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `is_verified`
--

DROP TABLE IF EXISTS `is_verified`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `is_verified` (
  `roll_number` char(9) NOT NULL,
  PRIMARY KEY (`roll_number`),
  CONSTRAINT `is_verified_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `is_verified`
--

LOCK TABLES `is_verified` WRITE;
/*!40000 ALTER TABLE `is_verified` DISABLE KEYS */;
INSERT INTO `is_verified` VALUES ('111701002'),('111701024'),('111701032');
/*!40000 ALTER TABLE `is_verified` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `job_id` char(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `CTC` double NOT NULL,
  `perks` varchar(200) DEFAULT NULL,
  `min_cgpa` decimal(4,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES ('job1','ML Engineer','',1500000,'',6.00),('job2','Manager','',1650000,'',5.00);
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_details`
--

DROP TABLE IF EXISTS `login_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_details` (
  `username` varchar(30) NOT NULL,
  `password` varchar(320) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_details`
--

LOCK TABLES `login_details` WRITE;
/*!40000 ALTER TABLE `login_details` DISABLE KEYS */;
INSERT INTO `login_details` VALUES ('code-to-eat','40bd001563085fc35165329ea1ff5c5ecbdbbeef'),('hoogle','aa07259ed9d427acbaa837c5d1f22d80a5b4cc87'),('iamrakesh28','a9993e364706816aba3e25717850c26c9cd0d89d'),('soil','a9993e364706816aba3e25717850c26c9cd0d89d'),('thetwo','a9993e364706816aba3e25717850c26c9cd0d89d'),('tpo','a9993e364706816aba3e25717850c26c9cd0d89d'),('tymefighter','a9993e364706816aba3e25717850c26c9cd0d89d'),('vol_user1','a9993e364706816aba3e25717850c26c9cd0d89d'),('vol_user2','a9993e364706816aba3e25717850c26c9cd0d89d');
/*!40000 ALTER TABLE `login_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `num_sem_completed`
--

DROP TABLE IF EXISTS `num_sem_completed`;
/*!50001 DROP VIEW IF EXISTS `num_sem_completed`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `num_sem_completed` (
  `roll_number` tinyint NOT NULL,
  `perf_id` tinyint NOT NULL,
  `num_sem_completed` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `official_login`
--

DROP TABLE IF EXISTS `official_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `official_login` (
  `official_id` char(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`official_id`,`username`),
  KEY `username` (`username`),
  CONSTRAINT `official_login_ibfk_1` FOREIGN KEY (`official_id`) REFERENCES `cdc_official` (`official_id`) ON DELETE CASCADE,
  CONSTRAINT `official_login_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login_details` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `official_login`
--

LOCK TABLES `official_login` WRITE;
/*!40000 ALTER TABLE `official_login` DISABLE KEYS */;
INSERT INTO `official_login` VALUES ('official1','tpo');
/*!40000 ALTER TABLE `official_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `placed_internship`
--

DROP TABLE IF EXISTS `placed_internship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `placed_internship` (
  `internship_id` char(9) NOT NULL,
  `company_id` char(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`internship_id`,`company_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `placed_internship_ibfk_1` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`) ON DELETE CASCADE,
  CONSTRAINT `placed_internship_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `placed_internship`
--

LOCK TABLES `placed_internship` WRITE;
/*!40000 ALTER TABLE `placed_internship` DISABLE KEYS */;
INSERT INTO `placed_internship` VALUES ('intern1','company_1','2020-01-21'),('intern2','company_2','2020-01-25');
/*!40000 ALTER TABLE `placed_internship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `placed_job`
--

DROP TABLE IF EXISTS `placed_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `placed_job` (
  `job_id` char(9) NOT NULL,
  `company_id` char(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`job_id`,`company_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `placed_job_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE,
  CONSTRAINT `placed_job_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `placed_job`
--

LOCK TABLES `placed_job` WRITE;
/*!40000 ALTER TABLE `placed_job` DISABLE KEYS */;
INSERT INTO `placed_job` VALUES ('job1','company_1','2020-01-01'),('job2','company_1','2020-01-01');
/*!40000 ALTER TABLE `placed_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `previous_apply_internship`
--

DROP TABLE IF EXISTS `previous_apply_internship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `previous_apply_internship` (
  `roll_number` char(9) NOT NULL,
  `internship_id` char(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`roll_number`,`internship_id`),
  KEY `internship_id` (`internship_id`),
  CONSTRAINT `previous_apply_internship_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`),
  CONSTRAINT `previous_apply_internship_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `previous_apply_internship`
--

LOCK TABLES `previous_apply_internship` WRITE;
/*!40000 ALTER TABLE `previous_apply_internship` DISABLE KEYS */;
/*!40000 ALTER TABLE `previous_apply_internship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `previous_apply_job`
--

DROP TABLE IF EXISTS `previous_apply_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `previous_apply_job` (
  `roll_number` char(9) NOT NULL,
  `job_id` char(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`roll_number`,`job_id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `previous_apply_job_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`),
  CONSTRAINT `previous_apply_job_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `previous_apply_job`
--

LOCK TABLES `previous_apply_job` WRITE;
/*!40000 ALTER TABLE `previous_apply_job` DISABLE KEYS */;
/*!40000 ALTER TABLE `previous_apply_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `previous_placed_internship`
--

DROP TABLE IF EXISTS `previous_placed_internship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `previous_placed_internship` (
  `internship_id` char(9) NOT NULL,
  `company_id` char(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`internship_id`,`company_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `previous_placed_internship_ibfk_1` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`),
  CONSTRAINT `previous_placed_internship_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `previous_placed_internship`
--

LOCK TABLES `previous_placed_internship` WRITE;
/*!40000 ALTER TABLE `previous_placed_internship` DISABLE KEYS */;
/*!40000 ALTER TABLE `previous_placed_internship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `previous_placed_job`
--

DROP TABLE IF EXISTS `previous_placed_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `previous_placed_job` (
  `job_id` char(9) NOT NULL,
  `company_id` char(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`job_id`,`company_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `previous_placed_job_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`),
  CONSTRAINT `previous_placed_job_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `previous_placed_job`
--

LOCK TABLES `previous_placed_job` WRITE;
/*!40000 ALTER TABLE `previous_placed_job` DISABLE KEYS */;
/*!40000 ALTER TABLE `previous_placed_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `required_branch_internship`
--

DROP TABLE IF EXISTS `required_branch_internship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `required_branch_internship` (
  `branch_name` varchar(30) NOT NULL,
  `internship_id` char(9) NOT NULL,
  PRIMARY KEY (`branch_name`,`internship_id`),
  KEY `internship_id` (`internship_id`),
  CONSTRAINT `required_branch_internship_ibfk_1` FOREIGN KEY (`branch_name`) REFERENCES `branch` (`name`) ON DELETE CASCADE,
  CONSTRAINT `required_branch_internship_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `required_branch_internship`
--

LOCK TABLES `required_branch_internship` WRITE;
/*!40000 ALTER TABLE `required_branch_internship` DISABLE KEYS */;
INSERT INTO `required_branch_internship` VALUES ('civil','intern2'),('comp sc','intern1');
/*!40000 ALTER TABLE `required_branch_internship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `required_course_internship`
--

DROP TABLE IF EXISTS `required_course_internship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `required_course_internship` (
  `course_id` char(9) NOT NULL,
  `internship_id` char(9) NOT NULL,
  PRIMARY KEY (`course_id`,`internship_id`),
  KEY `internship_id` (`internship_id`),
  CONSTRAINT `required_course_internship_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  CONSTRAINT `required_course_internship_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `required_course_internship`
--

LOCK TABLES `required_course_internship` WRITE;
/*!40000 ALTER TABLE `required_course_internship` DISABLE KEYS */;
INSERT INTO `required_course_internship` VALUES ('CE7194','intern2'),('CS2010','intern1');
/*!40000 ALTER TABLE `required_course_internship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `required_course_job`
--

DROP TABLE IF EXISTS `required_course_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `required_course_job` (
  `course_id` char(9) NOT NULL,
  `job_id` char(9) NOT NULL,
  PRIMARY KEY (`course_id`,`job_id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `required_course_job_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  CONSTRAINT `required_course_job_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `required_course_job`
--

LOCK TABLES `required_course_job` WRITE;
/*!40000 ALTER TABLE `required_course_job` DISABLE KEYS */;
INSERT INTO `required_course_job` VALUES ('CE7194','job2'),('CS2010','job1');
/*!40000 ALTER TABLE `required_course_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `roll_number` char(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('M','F','O') NOT NULL,
  `tenth_percentage` decimal(4,2) NOT NULL,
  `tenth_board` varchar(30) NOT NULL,
  `twelfth_percentage` decimal(4,2) NOT NULL,
  `twelfth_board` varchar(30) NOT NULL,
  `JEE_main_rank` int(11) NOT NULL,
  `JEE_advanced_rank` int(11) NOT NULL,
  `bldg_name` varchar(30) NOT NULL,
  `street_name` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `phone_1` varchar(30) NOT NULL,
  `phone_2` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`roll_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('111701000','Rithika Narula','Indian','1999-02-27','F',85.20,'CBSE',90.00,'CBSE',8500,10000,'bldg1','street3a','Kottayam','Kerala','India','123432','1234567890',NULL),('111701002','Ahmed Z D','Indian','1999-11-25','M',79.80,'CBSE',92.80,'CBSE',0,4518,'703 Link','Link Road','Mumbai','Maharashtra','India','460064','7594069315',NULL),('111701024','Rakesh Kumar','Indian','1999-04-28','M',95.00,'CBSE',92.20,'CBSE',7319,9139,'Bld 272 B','Road 6','Patna','Bihar','India','800016','8407096966',NULL),('111701032','Muhd. Yaseen','Indian','1999-10-16','M',95.00,'CBSE',95.80,'CBSE',0,0,'Poothakkuzhiyil(H)','Parathodu','Kottayam','Kerala','India','686512','9497745691',NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `student_info`
--

DROP TABLE IF EXISTS `student_info`;
/*!50001 DROP VIEW IF EXISTS `student_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `student_info` (
  `roll_number` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `dob` tinyint NOT NULL,
  `gender` tinyint NOT NULL,
  `year_of_admission` tinyint NOT NULL,
  `branch` tinyint NOT NULL,
  `cgpa` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `student_login`
--

DROP TABLE IF EXISTS `student_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_login` (
  `roll_number` char(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`roll_number`,`username`),
  KEY `username` (`username`),
  CONSTRAINT `student_login_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`) ON DELETE CASCADE,
  CONSTRAINT `student_login_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login_details` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_login`
--

LOCK TABLES `student_login` WRITE;
/*!40000 ALTER TABLE `student_login` DISABLE KEYS */;
INSERT INTO `student_login` VALUES ('111701000','thetwo'),('111701002','tymefighter'),('111701024','iamrakesh28'),('111701032','code-to-eat');
/*!40000 ALTER TABLE `student_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_performance`
--

DROP TABLE IF EXISTS `student_performance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_performance` (
  `perf_id` char(9) NOT NULL,
  `roll_number` char(9) NOT NULL,
  PRIMARY KEY (`perf_id`,`roll_number`),
  KEY `roll_number` (`roll_number`),
  CONSTRAINT `student_performance_ibfk_1` FOREIGN KEY (`perf_id`) REFERENCES `academic_performance` (`perf_id`) ON DELETE CASCADE,
  CONSTRAINT `student_performance_ibfk_2` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_performance`
--

LOCK TABLES `student_performance` WRITE;
/*!40000 ALTER TABLE `student_performance` DISABLE KEYS */;
INSERT INTO `student_performance` VALUES ('acadperf1','111701002'),('acadperf2','111701024'),('acadperf3','111701032'),('acadperf4','111701000');
/*!40000 ALTER TABLE `student_performance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_vol`
--

DROP TABLE IF EXISTS `student_vol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_vol` (
  `vol_id` char(9) NOT NULL,
  `designation` varchar(30) NOT NULL,
  PRIMARY KEY (`vol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_vol`
--

LOCK TABLES `student_vol` WRITE;
/*!40000 ALTER TABLE `student_vol` DISABLE KEYS */;
INSERT INTO `student_vol` VALUES ('studvolt1','CSE-2016'),('studvolt2','CSE-2017');
/*!40000 ALTER TABLE `student_vol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `student_vol_info`
--

DROP TABLE IF EXISTS `student_vol_info`;
/*!50001 DROP VIEW IF EXISTS `student_vol_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `student_vol_info` (
  `vol_id` tinyint NOT NULL,
  `roll_number` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `year_of_admission` tinyint NOT NULL,
  `branch` tinyint NOT NULL,
  `gender` tinyint NOT NULL,
  `dob` tinyint NOT NULL,
  `designation` tinyint NOT NULL,
  `date_join` tinyint NOT NULL,
  `cgpa` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `taken`
--

DROP TABLE IF EXISTS `taken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taken` (
  `roll_number` char(9) NOT NULL,
  `course_id` char(9) NOT NULL,
  `semester_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`roll_number`,`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `taken_ibfk_1` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`) ON DELETE CASCADE,
  CONSTRAINT `taken_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taken`
--

LOCK TABLES `taken` WRITE;
/*!40000 ALTER TABLE `taken` DISABLE KEYS */;
INSERT INTO `taken` VALUES ('111701000','CS2010',7),('111701002','CS5308',4),('111701024','CE7194',4),('111701032','CS2010',7);
/*!40000 ALTER TABLE `taken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer`
--

DROP TABLE IF EXISTS `volunteer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `volunteer` (
  `vol_id` char(9) NOT NULL,
  `roll_number` char(9) NOT NULL,
  `date_join` date NOT NULL,
  PRIMARY KEY (`vol_id`,`roll_number`),
  KEY `roll_number` (`roll_number`),
  CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`vol_id`) REFERENCES `student_vol` (`vol_id`) ON DELETE CASCADE,
  CONSTRAINT `volunteer_ibfk_2` FOREIGN KEY (`roll_number`) REFERENCES `student` (`roll_number`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer`
--

LOCK TABLES `volunteer` WRITE;
/*!40000 ALTER TABLE `volunteer` DISABLE KEYS */;
INSERT INTO `volunteer` VALUES ('studvolt1','111701032','2020-02-10'),('studvolt2','111701024','2020-01-25');
/*!40000 ALTER TABLE `volunteer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer_login`
--

DROP TABLE IF EXISTS `volunteer_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `volunteer_login` (
  `vol_id` char(9) NOT NULL,
  `username` char(9) NOT NULL,
  PRIMARY KEY (`vol_id`,`username`),
  KEY `username` (`username`),
  CONSTRAINT `volunteer_login_ibfk_1` FOREIGN KEY (`vol_id`) REFERENCES `student_vol` (`vol_id`) ON DELETE CASCADE,
  CONSTRAINT `volunteer_login_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login_details` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer_login`
--

LOCK TABLES `volunteer_login` WRITE;
/*!40000 ALTER TABLE `volunteer_login` DISABLE KEYS */;
INSERT INTO `volunteer_login` VALUES ('studvolt1','vol_user1'),('studvolt2','vol_user2');
/*!40000 ALTER TABLE `volunteer_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `cgpa`
--

/*!50001 DROP TABLE IF EXISTS `cgpa`*/;
/*!50001 DROP VIEW IF EXISTS `cgpa`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cgpa` AS select `n`.`roll_number` AS `roll_number`,`a`.`perf_id` AS `perf_id`,case when `n`.`num_sem_completed` <> 0 then (coalesce(`a`.`sem1`,0) + coalesce(`a`.`sem2`,0) + coalesce(`a`.`sem3`,0) + coalesce(`a`.`sem4`,0) + coalesce(`a`.`sem5`,0) + coalesce(`a`.`sem6`,0) + coalesce(`a`.`sem7`,0) + coalesce(`a`.`sem8`,0)) / `n`.`num_sem_completed` else 0 end AS `cgpa` from (`academic_performance` `a` join `num_sem_completed` `n`) where `a`.`perf_id` = `n`.`perf_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `company_internship`
--

/*!50001 DROP TABLE IF EXISTS `company_internship`*/;
/*!50001 DROP VIEW IF EXISTS `company_internship`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `company_internship` AS select `internship`.`internship_id` AS `internship_id`,`company`.`name` AS `name`,`company`.`company_overview` AS `company_overview`,`internship`.`name` AS `internship`,`internship`.`description` AS `description`,`internship`.`stipend` AS `stipend`,`internship`.`duration` AS `duration`,`internship`.`min_cgpa` AS `min_cgpa` from ((`company` join `internship`) join `placed_internship`) where `company`.`company_id` = `placed_internship`.`company_id` and `internship`.`internship_id` = `placed_internship`.`internship_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `company_job`
--

/*!50001 DROP TABLE IF EXISTS `company_job`*/;
/*!50001 DROP VIEW IF EXISTS `company_job`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `company_job` AS select `job`.`job_id` AS `job_id`,`company`.`name` AS `name`,`company`.`company_overview` AS `company_overview`,`job`.`name` AS `job`,`job`.`description` AS `description`,`job`.`CTC` AS `ctc`,`job`.`perks` AS `perks`,`job`.`min_cgpa` AS `min_cgpa` from ((`company` join `job`) join `placed_job`) where `company`.`company_id` = `placed_job`.`company_id` and `job`.`job_id` = `placed_job`.`job_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `num_sem_completed`
--

/*!50001 DROP TABLE IF EXISTS `num_sem_completed`*/;
/*!50001 DROP VIEW IF EXISTS `num_sem_completed`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `num_sem_completed` AS select `student_performance`.`roll_number` AS `roll_number`,`academic_performance`.`perf_id` AS `perf_id`,(case when `academic_performance`.`sem1` is null then 0 else 1 end) + (case when `academic_performance`.`sem2` is null then 0 else 1 end) + (case when `academic_performance`.`sem3` is null then 0 else 1 end) + (case when `academic_performance`.`sem4` is null then 0 else 1 end) + (case when `academic_performance`.`sem5` is null then 0 else 1 end) + (case when `academic_performance`.`sem6` is null then 0 else 1 end) + (case when `academic_performance`.`sem7` is null then 0 else 1 end) + (case when `academic_performance`.`sem8` is null then 0 else 1 end) AS `num_sem_completed` from (`academic_performance` join `student_performance`) where `academic_performance`.`perf_id` = `student_performance`.`perf_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `student_info`
--

/*!50001 DROP TABLE IF EXISTS `student_info`*/;
/*!50001 DROP VIEW IF EXISTS `student_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ahmed`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `student_info` AS select `student`.`roll_number` AS `roll_number`,`student`.`name` AS `name`,`student`.`dob` AS `dob`,`student`.`gender` AS `gender`,`belongs_to`.`year_of_admission` AS `year_of_admission`,`has_branch`.`name` AS `branch`,`cgpa`.`cgpa` AS `cgpa` from (((`student` join `belongs_to`) join `has_branch`) join `cgpa`) where `student`.`roll_number` = `belongs_to`.`roll_number` and `student`.`roll_number` = `has_branch`.`roll_number` and `student`.`roll_number` = `cgpa`.`roll_number` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `student_vol_info`
--

/*!50001 DROP TABLE IF EXISTS `student_vol_info`*/;
/*!50001 DROP VIEW IF EXISTS `student_vol_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `student_vol_info` AS select `student_vol`.`vol_id` AS `vol_id`,`student`.`roll_number` AS `roll_number`,`student`.`name` AS `name`,`belongs_to`.`year_of_admission` AS `year_of_admission`,`has_branch`.`name` AS `branch`,`student`.`gender` AS `gender`,`student`.`dob` AS `dob`,`student_vol`.`designation` AS `designation`,`volunteer`.`date_join` AS `date_join`,`cgpa`.`cgpa` AS `cgpa` from (((((`student_vol` join `student`) join `volunteer`) join `cgpa`) join `belongs_to`) join `has_branch`) where `student_vol`.`vol_id` = `volunteer`.`vol_id` and `volunteer`.`roll_number` = `student`.`roll_number` and `student`.`roll_number` = `cgpa`.`roll_number` and `student`.`roll_number` = `belongs_to`.`roll_number` and `student`.`roll_number` = `has_branch`.`roll_number` */;
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

-- Dump completed on 2020-03-13 23:07:48

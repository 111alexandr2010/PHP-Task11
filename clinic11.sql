-- MySQL dump 10.13  Distrib 5.6.38, for Win32 (AMD64)
--
-- Host: localhost    Database: clinic11
-- ------------------------------------------------------
-- Server version	5.6.38

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
-- Table structure for table `Animals`
--

DROP TABLE IF EXISTS `Animals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Animals` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `ClientID` int(11) NOT NULL,
  `Species` int(11) DEFAULT NULL,
  `Weight` int(11) DEFAULT NULL,
  `Gender` enum('м','ж') DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Animals_Species` (`Species`),
  KEY `FK_Animals_Clients` (`ClientID`),
  CONSTRAINT `FK_Animals_Clients` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ID`),
  CONSTRAINT `FK_Animals_Species` FOREIGN KEY (`Species`) REFERENCES `species` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Animals`
--

LOCK TABLES `Animals` WRITE;
/*!40000 ALTER TABLE `Animals` DISABLE KEYS */;
INSERT INTO `Animals` VALUES (19,'Мурзик',3,1,4320,'м'),(20,'Шуша',8,5,350,'ж'),(21,'Муська',2,1,3280,'ж'),
(22,'Полкан',4,2,23600,'м'),(23,'Ксюша',7,3,150,'ж'),(24,'Найда',6,2,16350,'ж'),(25,'Кеша',9,4,260,'м'),
(26,'Дозор',5,2,31300,'м'),(27,'Стасик',4,1,4550,'м'),(28,'Лора',4,2,39500,'ж'),(29,'Федор',7,6,460,'м'),
(30,'Борис',5,1,31300,'м'),(31,'Петруша',7,4,250,'м');
/*!40000 ALTER TABLE `Animals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clients` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Login` varchar(50) NOT NULL,
  `PasswordHash` varchar(32) NOT NULL,
  `PasswordSalt` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clients`
--

LOCK TABLES `Clients` WRITE;
/*!40000 ALTER TABLE `Clients` DISABLE KEYS */;
INSERT INTO `Clients` VALUES (2,'Котлярова Ирина','Kotlyarova','49261c765de2d062a7c6d2a0f7e88534','WduJh82q4X'),
(3,'Безменов Николай','Bezmenov','7f73429365c03a98de57bbbedfab5c03','lHCkYFaOrc'),(4,'Дятлов Иван','Dyatlov','6bb2d7fed3285e88744173d4a63c6e66','UegxvIGLG1'),
(5,'Смолярова Татьяна','Smolyarova','28822a00d56681a9ee31046995622be6','1b2GpvX4Ix'),(6,'Вохмянина Дарья','Vokhmyanina','70a62932704bdcf7deed43640f29b672','pVJaWy7oFB'),
(7,'Опухтина Анна','Opukhtina','4b7dd44eaedb8f2ab3c50f690988ae22','zlAmZ6MbBM'),(8,'Морзин Петр','Morzin','4d5042af7345abd97ffb456003e1172b','Q3V14e5JEc'),
(9,'Москалева Елена','Moskaleva','99c203611176a5309fdf27181948e982','EkBJcVHVQA');
/*!40000 ALTER TABLE `Clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Doctors`
--

DROP TABLE IF EXISTS `Doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Doctors` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Phone` text NOT NULL,
  `Salary` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Doctors`
--

LOCK TABLES `Doctors` WRITE;
/*!40000 ALTER TABLE `Doctors` DISABLE KEYS */;
INSERT INTO `Doctors` VALUES (1,'Докторов Петр','+79133454622',31000),(2,'Скачко Дмитрий','+79053635671',35000),(3,'Трунов Алексей','+79032235689',38000),
(4,'Иванова Екатерина','+79134365601',39000),(5,'Быстров Николай','+79037357190',25000),(6,'Долгова Анна','+79139857711',35000);
/*!40000 ALTER TABLE `Doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DoctorsToSpecialities`
--

DROP TABLE IF EXISTS `DoctorsToSpecialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DoctorsToSpecialities` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SpecialityID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_DoctorsToSpecialities_Specialities` (`SpecialityID`),
  KEY `FK_DoctorsToSpecialities_Doctors` (`DoctorID`),
  CONSTRAINT `FK_DoctorsToSpecialities_Doctors` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`ID`),
  CONSTRAINT `FK_DoctorsToSpecialities_Specialities` FOREIGN KEY (`SpecialityID`) REFERENCES `specialities` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DoctorsToSpecialities`
--

LOCK TABLES `DoctorsToSpecialities` WRITE;
/*!40000 ALTER TABLE `DoctorsToSpecialities` DISABLE KEYS */;
INSERT INTO `DoctorsToSpecialities` VALUES (3,1,4),(4,1,6),(5,2,1),(6,2,3),(7,3,2),(8,3,5);
/*!40000 ALTER TABLE `DoctorsToSpecialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Specialities`
--

DROP TABLE IF EXISTS `Specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Specialities` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Specialities`
--

LOCK TABLES `Specialities` WRITE;
/*!40000 ALTER TABLE `Specialities` DISABLE KEYS */;
INSERT INTO `Specialities` VALUES (1,'терапевт'),(2,'хирург'),(3,'эпидемиолог');
/*!40000 ALTER TABLE `Specialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Species`
--

DROP TABLE IF EXISTS `Species`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Species` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NameRussian` text NOT NULL,
  `NameLatin` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Species`
--

LOCK TABLES `Species` WRITE;
/*!40000 ALTER TABLE `Species` DISABLE KEYS */;
INSERT INTO `Species` VALUES (1,'Кошка','Koshka'),(2,'Собака','Sobaka'),(3,'Канарейка','Kanareyka'),(4,'Попугай','Popugay'),
(5,'Хомяк','Khomyak'),(6,'Крыса','Kryisa'),(7,'Корова','Korova'),(8,'Коза','Koza'),(9,'Лошадь','Loshad'),(10,'Свинья','Svinya');
/*!40000 ALTER TABLE `Species` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Visits`
--

DROP TABLE IF EXISTS `Visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Visits` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AnimalID` int(11) DEFAULT NULL,
  `ClientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `VisitTime` datetime DEFAULT NULL,
  `PaidAmount` int(11) DEFAULT NULL,
  `Comment` text,
  PRIMARY KEY (`ID`),
  KEY `FK_Visits_Animals` (`AnimalID`),
  KEY `FK_Visits_Clients` (`ClientID`),
  KEY `FK_Visits_Doctors` (`DoctorID`),
  CONSTRAINT `FK_Visits_Animals` FOREIGN KEY (`AnimalID`) REFERENCES `animals` (`ID`),
  CONSTRAINT `FK_Visits_Clients` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ID`),
  CONSTRAINT `FK_Visits_Doctors` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Visits`
--

LOCK TABLES `Visits` WRITE;
/*!40000 ALTER TABLE `Visits` DISABLE KEYS */;
INSERT INTO `Visits` VALUES (18,19,3,1,'2016-10-23 10:37:22',480,'Первичный осмотр'),(19,19,3,1,'2016-10-26 11:57:11',2850,'Стерилизация'),
(20,20,8,5,'2016-11-21 12:08:20',1500,'Прививка'),(21,21,2,3,'2017-01-20 09:27:20',680,'Первичный осмотр'),(22,21,2,3,'2017-01-27 10:43:12',2850,'Стерилизация'),
(23,22,4,6,'2017-02-17 09:43:12',500,'Первичный осмотр'),(24,22,4,2,'2017-02-19 16:33:31',1500,'Прививка'),(25,22,4,6,'2017-03-07 13:43:12',1500,'Капельница'),
(26,23,7,2,'2016-09-27 09:43:12',1500,'Прививка'),(27,24,6,1,'2016-11-17 15:22:10',500,'Первичный осмотр'),(28,24,6,1,'2016-11-18 08:55:00',5000,'Операция'),
(29,24,6,1,'2016-12-08 08:55:00',500,'Осмотр'),(30,25,9,2,'2016-11-28 08:55:00',1500,'Прививка'),(31,26,5,6,'2017-05-28 15:45:06',500,'Первичный осмотр'),
(32,26,5,6,'2017-05-29 08:45:46',2500,'Капельница'),(33,26,5,6,'2017-06-08 11:15:06',500,'Осмотр'),(34,27,4,4,'2017-06-15 09:43:44',480,'Первичный осмотр'),
(35,28,4,6,'2017-05-20 13:37:00',1500,'УЗИ'),(36,29,7,6,'2017-05-24 16:39:00',500,'Первичный осмотр'),(37,30,5,5,'2017-05-20 13:37:00',1500,'Прививка'),
(38,31,7,4,'2017-11-10 11:16:05',500,'Первичный осмотр');
/*!40000 ALTER TABLE `Visits` ENABLE KEYS */;

UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-07 20:55:06

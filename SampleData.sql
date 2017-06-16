-- MySQL dump 10.13  Distrib 5.7.11, for osx10.9 (x86_64)
--
-- Host: localhost    Database: Library
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Dumping data for table `Book`
--

LOCK TABLES `Book` WRITE;
/*!40000 ALTER TABLE `Book` DISABLE KEYS */;
INSERT INTO `Book` VALUES (1,'Herman Melville','Moby Dick',2,'root@localhost','2016-05-05 19:44:34','root@localhost','2016-05-05 19:44:34'),(2,'God','The Bible',1,'root@localhost','2016-05-05 19:54:49','root@localhost','2016-05-05 19:54:49'),(3,'Someone','Hatchet',3,'root@localhost','2016-05-05 20:11:53','root@localhost','2016-05-05 20:11:53'),(4,'Homer','The Iliad',1,'root@localhost','2016-05-05 23:20:37','root@localhost','2016-05-05 23:20:37'),(5,'Ayn Rand','Atlas Shrugged',4,'root@localhost','2016-05-06 17:05:38','root@localhost','2016-05-06 17:05:38'),(6,'Sun Tzu','The Art of War',3,'root@localhost','2016-05-06 17:06:18','root@localhost','2016-05-06 17:06:18'),(7,'Thucydides','History of the Peloponnesian War',2,'root@localhost','2016-05-06 19:08:54','root@localhost','2016-05-06 19:08:54');
/*!40000 ALTER TABLE `Book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Book_Copies`
--

LOCK TABLES `Book_Copies` WRITE;
/*!40000 ALTER TABLE `Book_Copies` DISABLE KEYS */;
INSERT INTO `Book_Copies` VALUES (1,4,1,1,'root@localhost','2016-05-05 19:47:05','root@localhost','2016-05-05 19:47:05'),(2,5,2,4,'root@localhost','2016-05-05 19:54:49','root@localhost','2016-05-05 19:54:49'),(3,13,1,2,'root@localhost','2016-05-05 20:01:49','root@localhost','2016-05-05 20:09:02'),(4,5,3,2,'root@localhost','2016-05-05 20:11:53','root@localhost','2016-05-05 20:11:53'),(5,5,4,3,'root@localhost','2016-05-05 23:20:37','root@localhost','2016-05-05 23:20:37'),(6,4,4,4,'root@localhost','2016-05-05 23:20:49','root@localhost','2016-05-05 23:20:49'),(7,2,5,1,'root@localhost','2016-05-06 17:05:38','root@localhost','2016-05-06 17:05:38'),(8,2,5,3,'root@localhost','2016-05-06 17:05:58','root@localhost','2016-05-06 17:05:58'),(9,2,6,1,'root@localhost','2016-05-06 17:06:18','root@localhost','2016-05-06 17:06:18'),(10,2,6,2,'root@localhost','2016-05-06 17:06:30','root@localhost','2016-05-06 17:06:30'),(11,1,6,3,'root@localhost','2016-05-06 17:06:49','root@localhost','2016-05-06 17:06:49'),(12,1,6,4,'root@localhost','2016-05-06 17:07:03','root@localhost','2016-05-06 17:07:03'),(13,3,7,3,'root@localhost','2016-05-06 19:08:54','root@localhost','2016-05-06 19:08:54');
/*!40000 ALTER TABLE `Book_Copies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Book_Loans`
--

LOCK TABLES `Book_Loans` WRITE;
/*!40000 ALTER TABLE `Book_Loans` DISABLE KEYS */;
INSERT INTO `Book_Loans` VALUES (1,'2016-05-06','2016-05-16',NULL,4,4,2,'root@localhost','2016-05-06 16:47:58','root@localhost','2016-05-06 16:47:58'),(2,'2016-05-06','2016-05-16',NULL,4,2,3,'root@localhost','2016-05-06 17:00:50','root@localhost','2016-05-06 17:00:50'),(3,'2016-05-06','2016-05-16',NULL,2,6,3,'root@localhost','2016-05-06 17:08:04','root@localhost','2016-05-06 17:08:04'),(4,'2016-05-06','2016-05-16','2016-05-06',3,7,4,'root@localhost','2016-05-06 19:09:11','root@localhost','2016-05-06 19:09:58'),(5,'2016-05-06','2016-05-01',NULL,3,7,1,'root@localhost','2016-05-06 19:09:34','root@localhost','2016-05-06 20:19:41'),(6,'2016-05-06','2016-05-16',NULL,4,2,4,'root@localhost','2016-05-06 19:44:37','root@localhost','2016-05-06 19:44:37'),(7,'2016-05-06','2016-05-16',NULL,1,1,1,'root@localhost','2016-05-06 20:25:51','root@localhost','2016-05-06 20:25:51'),(8,'2016-05-06','2016-05-16','2016-05-06',3,6,1,'root@localhost','2016-05-06 20:27:28','root@localhost','2016-05-06 20:32:25'),(9,'2016-05-06','2016-05-16','2016-05-06',3,6,1,'root@localhost','2016-05-06 20:32:45','root@localhost','2016-05-06 20:33:03');
/*!40000 ALTER TABLE `Book_Loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Borrower`
--

LOCK TABLES `Borrower` WRITE;
/*!40000 ALTER TABLE `Borrower` DISABLE KEYS */;
INSERT INTO `Borrower` VALUES (1,'Harry Bosch','1385 N. Hollywood Ave., Los Angeles, CA, ','818-850-9976','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(2,'Matthew Crosby','309 S. Virginia Ave., Burbank, CA','818-773-9875','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(3,'Oliver McGee','919 Columbia Blvd., New York, NY','909-284-2859','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(4,'Wallace Harrington','1593 E. Siberia St., Hanover, NH','848-984-1254','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44');
/*!40000 ALTER TABLE `Borrower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Library_Branch`
--

LOCK TABLES `Library_Branch` WRITE;
/*!40000 ALTER TABLE `Library_Branch` DISABLE KEYS */;
INSERT INTO `Library_Branch` VALUES (1,'New Amsterdam Library','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(2,'Chatham Square Library','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(3,'Jefferson Market Library','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(4,'Mulberry Street Library','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44');
/*!40000 ALTER TABLE `Library_Branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Publisher`
--

LOCK TABLES `Publisher` WRITE;
/*!40000 ALTER TABLE `Publisher` DISABLE KEYS */;
INSERT INTO `Publisher` VALUES (1,'Penguin Random House','1077 Ave of the Americas, New York, NY','646-443-3520','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(2,'Houghton Mifflin Harcourt','215 Park Ave S, New York, NY','212-420-5800','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(3,'Oxford University Press','198 Madison Ave, New York, NY','800-445-9714','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44'),(4,'Wiley','One Montgomery Street, San Francisco, CA','415-433-1740','root@localhost','2016-05-05 19:24:44','root@localhost','2016-05-05 19:24:44');
/*!40000 ALTER TABLE `Publisher` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-06 20:39:05

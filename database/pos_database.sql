
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

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `pos_database` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `pos_database`;
DROP TABLE IF EXISTS `customer_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_accounts` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `account_status` varchar(20) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `customer_accounts` WRITE;
/*!40000 ALTER TABLE `customer_accounts` DISABLE KEYS */;
INSERT INTO `customer_accounts` VALUES (1,'Juan','Dela Cruz','juan@example.com','09171234567','Manila','Active','2026-09-19 09:21:53'),(2,'Maria','Santos','maria@example.com','09181234567','Quezon City','Active','2026-09-19 09:21:53'),(3,'Carlo','Reyes','carlo@example.com','09191234567','Pasig','Active','2026-09-19 09:21:53'),(4,'Ana','Garcia','ana@example.com','09201234567','Makati','Inactive','2026-09-19 09:21:53'),(5,'Luis','Mendoza','luis@example.com','09211234567','Taguig','Active','2026-09-19 09:21:53');
/*!40000 ALTER TABLE `customer_accounts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `user_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_accounts` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `account_status` varchar(20) NOT NULL DEFAULT 'Active',
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `user_accounts` WRITE;
/*!40000 ALTER TABLE `user_accounts` DISABLE KEYS */;
INSERT INTO `user_accounts` (`user_id`,`username`,`password_hash`,`first_name`,`last_name`,`email`,`role`,`account_status`,`avatar`,`created_at`) VALUES (1,'admin01','$2y$10$1c/9DTPCq4TISbHIOVUP1uEv7n1.yf98wEPPIKUgxTQi3.uXyuUOa','John','Admin','john@pos.com','Admin','Active',NULL,'2026-09-19 09:21:53'),(2,'cashier01','$2y$10$k5VJP70cxhgg8JYBGc/YUOC6OSqmXEXGjiMctYBqYpsZgr2vHF9H2','Ella','Cruz','ella@pos.com','Cashier','Active',NULL,'2026-09-19 09:21:53'),(3,'cashier02','$2y$10$QdSuQm4Qm6pvKfS9vThsjObcdFkQ.IKEKnA8HIMsLHy7Jy3yX/28u','Mark','Tan','mark@pos.com','Cashier','Active',NULL,'2026-09-19 09:21:53'),(4,'manager01','$2y$10$OAm6FH2CufDIy7FNLNB9COF5LaKA6vDz7LKx0clx3eN6meW8sxlEe','Sofia','Lim','sofia@pos.com','Manager','Active',NULL,'2026-09-19 09:21:53'),(5,'cashier03','$2y$10$EADC89Us..G6zPYCMbIvHOpRux9l0aogGSYT2XdUbfQfSh.Pe0uAu','Paul','Ramos','paul@pos.com','Cashier','Inactive',NULL,'2026-09-19 09:21:53');
/*!40000 ALTER TABLE `user_accounts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

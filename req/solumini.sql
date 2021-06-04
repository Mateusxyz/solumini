-- MySQL dump 10.14  Distrib 5.5.64-MariaDB, for Linux (x86_64)
--
-- Host: dbthird.solutudo.com    Database: solumini
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `description` text,
  `address` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_companies_1_idx` (`category_id`),
  CONSTRAINT `fk_companies_1` FOREIGN KEY (`category_id`) REFERENCES `company_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Pizzaria Pimentel',1,'Itatinga','SP','As melhores pizzas de Itatinga','Rua Azul, Nº 121, Vila São Pablo','2021-05-25 14:26:58','2021-05-25 14:26:58'),(2,'Restaurante Dos Costa',1,'Botucatu','SP','Ambiente interno e entregas. Venha comer o Costão!','Rua Pedregulho, Nº 77, Vila Batatinha','2021-05-25 14:26:58','2021-05-25 14:26:58'),(3,'Kimura Systems',2,'Botucatu','SP','Desenvolvimento de software e sisteminhas da pesada que aprontam altas confusões.','Avenida dos Estudantes, Nº 810, Bairro Molhado','2021-05-25 14:26:58','2021-05-25 14:26:58'),(4,'Luis Soler Trambiques',2,'Botucatu','SP','Empréstimos consignados e estelionato a domicílio.','Parque dos Golpistas, Nº 171, Vila Nó Cego','2021-05-25 14:26:58','2021-05-25 14:26:58'),(5,'Solutudo',2,'Botucatu','SP','Desde 2005 ajudando a o Brasil a encontrar empresas em sua região.','Rua do Padre, Nº 192, Vila Bacana 2','2021-05-25 14:26:58','2021-05-25 14:26:58'),(6,'Disk Máscara do Papai',3,'Marília','SP','Máscaras PFF2 e para o carnaval também.','Rua Salgueiro Doce, Nº 17, Vila Mônica','2021-05-25 14:26:58','2021-05-25 14:26:58'),(7,'Hospital São Bento',4,'Avaré','SP','Tratando sempre com carinho seus pacientes.','Praça Ronald Golias, Nº 767, Vila Engraçada','2021-05-25 14:26:58','2021-05-25 14:26:58');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_categories`
--

DROP TABLE IF EXISTS `company_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_categories`
--

LOCK TABLES `company_categories` WRITE;
/*!40000 ALTER TABLE `company_categories` DISABLE KEYS */;
INSERT INTO `company_categories` VALUES (1,'Alimentação',NULL),(2,'Serviços',NULL),(3,'Comércio',NULL),(4,'Saúde',NULL);
/*!40000 ALTER TABLE `company_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_phones`
--

DROP TABLE IF EXISTS `company_phones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_phones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `number` varchar(30) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_company_phones_1_idx` (`company_id`),
  CONSTRAINT `fk_company_phones_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_phones`
--

LOCK TABLES `company_phones` WRITE;
/*!40000 ALTER TABLE `company_phones` DISABLE KEYS */;
INSERT INTO `company_phones` VALUES (1,1,'14999995678',1,'2021-05-25 14:28:59'),(2,2,'1438881234',0,'2021-05-25 14:28:59'),(3,2,'1438881234',0,'2021-05-25 14:28:59'),(4,4,'1438881234',1,'2021-05-25 14:29:00'),(5,5,'1438881234',1,'2021-05-25 14:29:00'),(6,7,'14999995678',1,'2021-05-25 14:29:00'),(7,6,'14999995678',1,'2021-05-25 14:29:01'),(8,2,'14999995678',1,'2021-05-25 14:29:01');
/*!40000 ALTER TABLE `company_phones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_owner` varchar(250) DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `seller_name` varchar(250) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contracts_1_idx` (`company_id`),
  CONSTRAINT `fk_contracts_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (1,'Bruno Kimura',3,'Emanuel Costa','2021-06-15','2020-06-15 19:31:12'),(2,'Luis H. Soler',4,'Carlos Branco','1996-01-04','1995-01-04 14:31:52');
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-25 11:43:45

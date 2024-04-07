CREATE DATABASE  IF NOT EXISTS `esmearq` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `esmearq`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: esmearq
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agencias`
--

DROP TABLE IF EXISTS `agencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `provincia` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agencias`
--

LOCK TABLES `agencias` WRITE;
/*!40000 ALTER TABLE `agencias` DISABLE KEYS */;
INSERT INTO `agencias` VALUES (1,'Agência Luanda','Rua 17','Luanda','943500282','2024-03-05 17:12:10'),(2,'Esmeark Agência','Casa 400, Rua 4','Luanda,','930841618','2024-04-06 15:21:16'),(3,'Agência Vila Nova','Av. Fidel de Castro','Luanda','92841618','2024-04-06 15:38:18'),(4,'Agencia Lubando &#039;','Luanda','Luanda','930841618','2024-04-06 22:42:29'),(5,'&lt;script&gt;alert(&#039;ola&#039;)&lt;/script&gt;','Luanda','Luanda','930841618','2024-04-06 22:43:03');
/*!40000 ALTER TABLE `agencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atividadesregistro`
--

DROP TABLE IF EXISTS `atividadesregistro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atividadesregistro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `funcionario_id` int DEFAULT NULL,
  `atividade` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('Em andamento','Concluído') COLLATE utf8mb4_general_ci DEFAULT 'Em andamento',
  `data_inicio` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_fim` datetime DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `funcionario_id` (`funcionario_id`),
  CONSTRAINT `atividadesregistro_ibfk_1` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividadesregistro`
--

LOCK TABLES `atividadesregistro` WRITE;
/*!40000 ALTER TABLE `atividadesregistro` DISABLE KEYS */;
INSERT INTO `atividadesregistro` VALUES (2,2,' actividades','Em andamento','2024-03-20 00:00:00','2024-03-30 00:00:00','concluida'),(5,3,'Fazer o levantamento das actividades','Em andamento','2024-02-27 00:00:00','2024-03-29 00:00:00','em_andamento'),(7,1,'\'ola\'\'','Em andamento','2024-05-09 00:00:00','2024-05-11 00:00:00','em_andamento'),(8,2,'\'ola\'\'','Em andamento','2024-05-02 00:00:00','2024-05-09 00:00:00','em_andamento'),(9,1,'Ola <script>Ola Mundo</script>','Em andamento','2024-04-25 00:00:00','2024-05-03 00:00:00','em_andamento'),(14,1,'&lt;script&gt;alert(&#039;Ola Mundo&#039;)&lt;/script&gt;','Em andamento','2024-05-03 00:00:00','2024-05-02 00:00:00','em_andamento'),(15,2,'&#039;ola&#039;&#039;','Em andamento','2024-05-10 00:00:00','2024-05-04 00:00:00','em_andamento'),(16,1,'&lt;script&gt;alert(&#039;Ola Mundo&#039;)&lt;/script&gt;','Em andamento','2024-05-10 00:00:00','2024-05-03 00:00:00','em_andamento'),(17,1,'Fazer o levantamento das actividades','Em andamento','2024-05-03 00:00:00','2024-05-08 00:00:00','em_andamento');
/*!40000 ALTER TABLE `atividadesregistro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancariasinformacoes`
--

DROP TABLE IF EXISTS `bancariasinformacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bancariasinformacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_conta` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `banco` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IBAN` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_conta` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `tipo_conta_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_conta_id` (`tipo_conta_id`),
  CONSTRAINT `bancariasinformacoes_ibfk_1` FOREIGN KEY (`tipo_conta_id`) REFERENCES `bancostipocontas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancariasinformacoes`
--

LOCK TABLES `bancariasinformacoes` WRITE;
/*!40000 ALTER TABLE `bancariasinformacoes` DISABLE KEYS */;
INSERT INTO `bancariasinformacoes` VALUES (1,'ESMEARK','BIC','00040300020','1234',10000000.00,1),(2,'ESMEARK VIAGENS','BFA','1223423','12252',9967.00,1),(3,'Esmeark Agencia','BFA','34131312','1223',3000.00,1);
/*!40000 ALTER TABLE `bancariasinformacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancostipocontas`
--

DROP TABLE IF EXISTS `bancostipocontas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bancostipocontas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_conta` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancostipocontas`
--

LOCK TABLES `bancostipocontas` WRITE;
/*!40000 ALTER TABLE `bancostipocontas` DISABLE KEYS */;
INSERT INTO `bancostipocontas` VALUES (1,'Conta Corrente'),(2,'Conta Poupança');
/*!40000 ALTER TABLE `bancostipocontas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_codes`
--

DROP TABLE IF EXISTS `check_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `check_codes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` datetime DEFAULT NULL,
  `used` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_codes`
--

LOCK TABLES `check_codes` WRITE;
/*!40000 ALTER TABLE `check_codes` DISABLE KEYS */;
INSERT INTO `check_codes` VALUES (1,'luciliodetales@gmail.com','759802','2024-04-07 16:33:16',NULL,0),(2,'luciliodetales@gmail.com','475990','2024-04-07 17:06:13',NULL,0),(3,'luciliodetales@gmail.com','015862','2024-04-07 17:07:32',NULL,0),(4,'luciliodetales@gmail.com','001653','2024-04-07 17:08:10',NULL,1),(5,'luciliodetales@gmail.com','645338','2024-04-07 17:39:38',NULL,1),(6,'luciliodetales@gmail.com','409738','2024-04-07 19:01:24',NULL,1),(7,'luciliodetales@gmail.com','459342','2024-04-07 19:31:45',NULL,0),(8,'luciliodetales@gmail.com','478359','2024-04-07 19:51:37',NULL,1),(9,'luciliodetales@gmail.com','304193','2024-04-07 20:35:25',NULL,1),(10,'luciliodetales@gmail.com','840908','2024-04-07 20:39:56',NULL,0),(11,'luciliodetales@gmail.com','143701','2024-04-07 20:41:28',NULL,1),(12,'luciliodetales@gmail.com','406562','2024-04-07 20:55:42',NULL,1);
/*!40000 ALTER TABLE `check_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nif` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `data_de_nascimento` date NOT NULL,
  `nacionalidade` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `estado_civil` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_freelancer` int DEFAULT NULL,
  `senha` text COLLATE utf8mb4_general_ci,
  `ativo` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'João Matoso','12321312','1998-12-12','Angola','Casado','Luanda','933231232','gomes.luciliogomes@gmail.com','2024-03-11 15:26:38',NULL,'$2y$10$rvGRzjhkwHJZXk94Gadqk.3vgogpETp7/SdxnRIkkFteyoaKFw3VW',0),(2,'Maria Manuel','123213132','2003-03-12','Brasileira','Solteiro','Luanda','930841618','gomes.luciliogomes@gmail.com','2024-03-11 16:08:38',NULL,'$2y$10$rvGRzjhkwHJZXk94Gadqk.3vgogpETp7/SdxnRIkkFteyoaKFw3VW',1),(3,'Maria Manuel','123213132','2003-03-12','Angola','','Luanda','930841618','gomes.luciliogomes@gmail.com','2024-03-11 16:09:08',NULL,'$2y$10$rvGRzjhkwHJZXk94Gadqk.3vgogpETp7/SdxnRIkkFteyoaKFw3VW',1),(4,'Emilia','12321312','2003-12-12','Angola','Solteiro','Luanda','930841618','gomes.luciliogomes@gmail.com','2024-03-11 16:12:19',NULL,'$2y$10$rvGRzjhkwHJZXk94Gadqk.3vgogpETp7/SdxnRIkkFteyoaKFw3VW',1),(5,'Gerson Eduardo','12321312','2020-03-12','Brasileira','Viúvo','Cabinda','934785726','gomes.luciliogomes@gmail.com','2024-03-11 17:30:58',NULL,'$2y$10$rvGRzjhkwHJZXk94Gadqk.3vgogpETp7/SdxnRIkkFteyoaKFw3VW',1),(6,'Vania Calombe','12321312','2024-04-05','Angola','Casado','Luanda','930984673','vania@gmail.com','2024-03-17 23:35:46',NULL,'$2y$10$opEz78wRZVVpq7f0FoXQ..XyeN1AC0eogXxslzoB2KaRYcxnFUyHy',1),(7,'Maria Silva','12321312','2024-03-21','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-17 23:38:32',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(8,'Maria Silva','12321312','2024-03-21','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-17 23:38:45',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(9,'Mariano Paquete','489303 1313','2024-03-29','Angola','Solteiro','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:40:15',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(10,'Sebastiao','59303 1313','2024-03-14','','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:42:31',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(11,'Lucas Silva','21489303 1313','2024-02-26','','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:44:37',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(12,'Victor Lukoki','21489303 1313','2024-02-28','Congoles','Divorciado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:45:32',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(13,'LUCÍLIO GOMES','21489303 1313','2024-03-08','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:48:34',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(14,'Kikulo Jorge','21489303 1313','1999-12-12','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:49:49',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(15,'Luciano Maquimba','21489303 1313','2024-03-12','Angola','Solteiro','Luanda','930841618','luciliodetales@gmail.com','2024-03-28 06:49:59',2,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(17,'Lucas Simao','21489303 1313','2024-03-30','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-29 16:41:43',4,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(18,'Cassinda Manurl','12321312','2000-12-12','Angola','Solteiro','Luanda','930841618','luciliodetales@gmail.com','2024-04-04 10:40:19',1,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(19,'Victor Armando','21489303 1313','2000-12-12','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-04-04 10:44:43',1,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(21,'Lucilia Urak','21489303 1313','2000-12-12','Angola','Casado','Luanda','930841618','lucilia@gmail.com','2024-04-06 16:10:03',NULL,'$2y$10$INvhxpbfwfIePVq3meqYu.Hg.Tx6Cidwl1FocKnQO74pDMz9E2su.',1),(22,'&lt;script&gt;alert(&#039;OLA&#039;)&lt;/script&gt;','12321312','2000-12-12','Angola','Solteiro','Luanda','930841618','luciliodetales@gmail.com','2024-04-06 22:55:45',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(23,'LUCÍLIO GOMES','21489303 1313','2000-12-12','','Divorciado','Luanda','930841618','tales@gmail.com','2024-04-07 05:45:59',NULL,'$2y$10$y94PohWKbp9KikSM4m5ntuzyS.LwcZ4F3Qc9CxOefBS.Aea2tCWGa',1),(24,'LUCÍLIO GOMES','12321312','2000-12-12','Angola','Solteiro','Luanda','930841618','luciliodetales@gmail.com','2024-04-07 05:49:34',NULL,'$2y$10$icW/8jj9ULDhYQBGPQoaPunImyc/YvQ9gWi3WIjN3n/Kfg/OSAZpm',1),(25,'AFONSO EDUARDO MPAXI','21489303 1313','1988-02-29','Angola','Casado','Casa S/ numero Sambizanga, Bairro Sao pedro da Barra zona 16','930841618','luciliodom@gmail.com','2024-04-07 05:57:20',NULL,'$2y$10$QzweoxSVBjUyiEBV9IBct.qXvJPfKNsio9cvQqKHddTUmLdAtTsZm',1),(26,'Adriano Manuel','490393013923','1999-12-12','Angola','Casado','Luanda','930841618','adriano@gmail.com','2024-04-07 06:26:29',2,'$2y$10$9hOoOS1LoBeY7dKelhtpm.B9MYJtrOlcQnrA9BgbRqkF1N4w.u8RO',1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes_documentos`
--

DROP TABLE IF EXISTS `clientes_documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes_documentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int DEFAULT NULL,
  `nome_documento` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome_arquivo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_validade` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `clientes_documentos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_documentos`
--

LOCK TABLES `clientes_documentos` WRITE;
/*!40000 ALTER TABLE `clientes_documentos` DISABLE KEYS */;
INSERT INTO `clientes_documentos` VALUES (6,1,'Bilhete Do Cliente','file65f306539259414032024151443.pdf','2024-02-20'),(9,7,'Extrato','file65f7812ea714e18032024004758.pdf',NULL),(10,7,'Bilhete','file65f7812eaa33018032024004758.pdf',NULL),(12,17,'Bilhete','file6607c728cf7bd30032024090248.pdf','2024-04-06'),(13,17,'RECIBO','file6607c728d27d630032024090248.pdf','2024-04-05'),(14,17,'RECIBO DE PAGAMENTO','file6607c8cc9c19e30032024090948.pdf','2024-03-19'),(16,9,'Bilhete','file6607cba81341a30032024092200.pdf','2024-04-29'),(17,9,'Extrato','file6607cbb3efd9d30032024092211.pdf','2024-04-04'),(19,10,'Bilhete','file6607cc285829230032024092408.pdf','2024-03-31'),(20,12,'Bilhete','file6607cc346cd2c30032024092420.pdf',NULL),(21,14,'Bilhete','file6607cc78317ea30032024092528.pdf','2024-04-06'),(22,14,'Extrato','file6607cc98c8d9230032024092600.pdf',NULL);
/*!40000 ALTER TABLE `clientes_documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultasadiadas`
--

DROP TABLE IF EXISTS `consultasadiadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultasadiadas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `agendamento_consulta_id` int DEFAULT NULL,
  `data_adiada` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agendamento_consulta_id` (`agendamento_consulta_id`),
  CONSTRAINT `consultasadiadas_ibfk_1` FOREIGN KEY (`agendamento_consulta_id`) REFERENCES `consultasagendamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultasadiadas`
--

LOCK TABLES `consultasadiadas` WRITE;
/*!40000 ALTER TABLE `consultasadiadas` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultasadiadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultasagendamento`
--

DROP TABLE IF EXISTS `consultasagendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultasagendamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `morada` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pais_destino` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_consulta` datetime NOT NULL,
  `data_prevista` date DEFAULT NULL,
  `servico_desejado` int DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_estado` int DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_consulta_idx` (`id_cliente`),
  CONSTRAINT `fk_client_consulta` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultasagendamento`
--

LOCK TABLES `consultasagendamento` WRITE;
/*!40000 ALTER TABLE `consultasagendamento` DISABLE KEYS */;
INSERT INTO `consultasagendamento` VALUES (1,NULL,NULL,NULL,NULL,'Portugal','2024-03-30 12:30:00',NULL,1,'2024-03-12 20:24:53',3,1),(2,NULL,NULL,NULL,NULL,'Brasil','2024-03-27 15:30:00',NULL,2,'2024-03-12 20:27:18',3,2),(3,NULL,NULL,NULL,NULL,'Angola','2024-03-29 06:35:00',NULL,1,'2024-03-12 23:30:04',3,3),(4,NULL,NULL,NULL,NULL,'Portugal','2024-03-30 12:40:00',NULL,2,'2024-03-12 23:35:35',2,3),(5,NULL,NULL,NULL,NULL,'Portugal','2024-03-31 20:00:00',NULL,2,'2024-03-13 15:59:58',2,3),(6,NULL,NULL,NULL,NULL,'Angola','2024-03-30 20:20:00',NULL,2,'2024-03-14 14:16:17',3,2),(7,NULL,NULL,NULL,NULL,'Portugal','2024-03-06 09:03:00',NULL,2,'2024-03-18 09:00:01',2,12),(8,NULL,NULL,NULL,NULL,'Brasil','2024-03-30 20:20:00',NULL,2,'2024-03-20 19:18:00',3,6),(9,NULL,NULL,NULL,NULL,'Angola','2024-03-30 19:00:00',NULL,2,'2024-03-26 12:59:14',3,14),(10,NULL,NULL,NULL,NULL,'Brasil','2024-04-30 05:40:00',NULL,1,'2024-04-02 22:34:13',4,6),(11,NULL,NULL,NULL,NULL,'Brasil','2024-04-30 04:15:00',NULL,1,'2024-04-02 23:12:36',1,6),(12,NULL,NULL,NULL,NULL,'Brasil','2024-04-24 20:45:00',NULL,1,'2024-04-03 18:42:26',4,6),(13,NULL,NULL,NULL,NULL,'Brasil','2024-05-08 12:01:00',NULL,1,'2024-04-04 06:01:30',1,6),(14,NULL,NULL,NULL,NULL,'Portugal','2024-05-11 12:05:00',NULL,1,'2024-04-04 06:03:59',4,6),(17,NULL,NULL,NULL,NULL,'Brasil','2024-12-12 15:50:00',NULL,3,'2024-04-05 08:48:58',1,19),(18,NULL,NULL,NULL,NULL,'Angola','2024-05-11 23:24:00',NULL,3,'2024-04-05 17:18:29',1,19),(20,NULL,NULL,NULL,NULL,'&lt;script&gt;alert(&#039;ola&#039;)&lt;/script&gt;','2024-05-11 05:27:00',NULL,1,'2024-04-06 23:27:20',1,18);
/*!40000 ALTER TABLE `consultasagendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultasestado`
--

DROP TABLE IF EXISTS `consultasestado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultasestado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultasestado`
--

LOCK TABLES `consultasestado` WRITE;
/*!40000 ALTER TABLE `consultasestado` DISABLE KEYS */;
INSERT INTO `consultasestado` VALUES (1,'em espera'),(2,'iniciado'),(3,'concluido'),(4,'cancelado'),(5,'Novo Estado'),(6,'Estado'),(7,'Novo Estado');
/*!40000 ALTER TABLE `consultasestado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultasperiodos`
--

DROP TABLE IF EXISTS `consultasperiodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultasperiodos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dia_semana` enum('Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo') COLLATE utf8mb4_general_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `consultores_disponiveis` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultasperiodos`
--

LOCK TABLES `consultasperiodos` WRITE;
/*!40000 ALTER TABLE `consultasperiodos` DISABLE KEYS */;
INSERT INTO `consultasperiodos` VALUES (1,'Segunda','08:00:00','16:00:00',5),(2,'Terça','08:00:00','16:00:00',5),(3,'Quarta','08:00:00','16:00:00',5),(4,'Quinta','08:00:00','16:00:00',5),(5,'Sexta','08:00:00','16:00:00',5),(6,'Sábado','08:00:00','16:00:00',3),(7,'Domingo','08:00:00','16:00:00',2);
/*!40000 ALTER TABLE `consultasperiodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultoriadetalhes`
--

DROP TABLE IF EXISTS `consultoriadetalhes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultoriadetalhes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `agendamento_consulta_id` int DEFAULT NULL,
  `razoes_viagem` text COLLATE utf8mb4_general_ci,
  `motivo_viagem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `esteve_embaixada` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `visto_concedido` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vezes_nao_aprovado` int DEFAULT NULL,
  `ano_visto` int DEFAULT NULL,
  `ano_vinheta_visto` int DEFAULT NULL,
  `motivo_reprovacao` text COLLATE utf8mb4_general_ci,
  `tipo_visto` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantidade_filhos` int DEFAULT NULL,
  `pessoa_responsavel` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custos_viagens` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome_responsavel` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone_responsavel` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pais_responsavel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `endereco_responsavel` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trabalhando` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome_empresa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `funcao` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `extrato` tinyint(1) DEFAULT NULL,
  `utente_legivel` tinyint(1) DEFAULT NULL,
  `recomendacao` text COLLATE utf8mb4_general_ci,
  `data_vencimento_visto` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agendamento_consulta_id` (`agendamento_consulta_id`),
  CONSTRAINT `consultoriadetalhes_ibfk_1` FOREIGN KEY (`agendamento_consulta_id`) REFERENCES `consultasagendamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultoriadetalhes`
--

LOCK TABLES `consultoriadetalhes` WRITE;
/*!40000 ALTER TABLE `consultoriadetalhes` DISABLE KEYS */;
INSERT INTO `consultoriadetalhes` VALUES (1,1,'$razoes','$motivo','sim','sim',2,2023,2023,'$razoes_nao_aprovado_input','$solicitacao_visto',2,'$responsabilidade_despesas','','$nome_outra_pessoa','$numero_outra_pessoa','','$endereco_outra_pessoa','$trabalho','$emprego_outra_pessoa','',1,2,'$recomendacao',NULL),(2,1,'$razoes','$motivo','sim','sim',1,2022,2023,'$razoes_nao_aprovado_input','$solicitacao_visto',2,'$responsabilidade_despesas','','$nome_outra_pessoa','$numero_outra_pessoa','','$endereco_outra_pessoa','$trabalho','$emprego_outra_pessoa','',1,1,'$recomendacao',NULL),(3,1,'Digite as razões','Estudo','Sim','Sim',0,0,2023,'','Singular',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'Digite as razões','Estudo','Sim','Sim',0,0,2023,'','Singular',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,2,'Digite as razões de estudo','Estudo','Sim','Sim',0,0,2023,'','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',1,1,'Joao Manuel',NULL),(6,3,'Digite as razõesalff sdf','Turismo','Sim','Não',2,2022,0,'so many reazons','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,1,'Joao Manuel',NULL),(7,3,'Digite as razõesalff sdf','Turismo','Sim','Não',2,2022,0,'so many reazons','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,2,'Joao Manuel',NULL),(8,3,'Digite as razõesalff sdf','Turismo','Sim','Não',2,2022,0,'so many reazons','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,2,'Joao Manuel',NULL),(9,4,'Razões educacionais, etc.','Estudo','Não','',2,2022,0,'Indisciplina','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',1,1,'Joao Manuel',NULL),(10,7,'Digite as razões','','','',0,0,0,'','',0,'','','','','','','','','',1,1,'',NULL),(11,6,'Digite as razõessdfds sgs','Saúde','Não','Não',2,2022,0,'so many reazons','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,1,'fewfewf',NULL),(12,1,NULL,'Estudo','Sim','Sim',0,0,2023,'','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',1,1,'Joao Manuel',NULL),(13,1,NULL,'Estudo','Sim','Sim',0,0,2023,'','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',1,1,'Joao Manuel','2024-03-30'),(14,2,NULL,'Saúde','Sim','Sim',0,0,2023,'','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,1,'Joao Manuel','2024-03-30'),(15,9,NULL,'Saúde','Sim','Sim',0,0,2023,'','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,1,'Joao Manuel','2024-04-30');
/*!40000 ALTER TABLE `consultoriadetalhes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contabilidadefinanceira`
--

DROP TABLE IF EXISTS `contabilidadefinanceira`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contabilidadefinanceira` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo` enum('Entrada','Saída') COLLATE utf8mb4_general_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `data_registro` date NOT NULL,
  `conta_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conta_id` (`conta_id`),
  CONSTRAINT `contabilidadefinanceira_ibfk_1` FOREIGN KEY (`conta_id`) REFERENCES `bancariasinformacoes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contabilidadefinanceira`
--

LOCK TABLES `contabilidadefinanceira` WRITE;
/*!40000 ALTER TABLE `contabilidadefinanceira` DISABLE KEYS */;
/*!40000 ALTER TABLE `contabilidadefinanceira` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Administração'),(2,'RH'),(3,'Financeiro'),(4,'Comercial'),(5,'Novo'),(6,'RH'),(7,'Departamento'),(8,'Departamento');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalhes_requisitos`
--

DROP TABLE IF EXISTS `detalhes_requisitos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalhes_requisitos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_requisito` int DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `menor_idade` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalhes_requisitos`
--

LOCK TABLES `detalhes_requisitos` WRITE;
/*!40000 ALTER TABLE `detalhes_requisitos` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalhes_requisitos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faturas`
--

DROP TABLE IF EXISTS `faturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int DEFAULT NULL,
  `servico_id` int DEFAULT NULL,
  `bancaria_info_id` int DEFAULT NULL,
  `data_emissao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nome_empresa` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `desconto` double DEFAULT NULL,
  `pago` tinyint(1) DEFAULT NULL,
  `valor` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faturas`
--

LOCK TABLES `faturas` WRITE;
/*!40000 ALTER TABLE `faturas` DISABLE KEYS */;
INSERT INTO `faturas` VALUES (1,1,1,1,'2024-03-16 12:27:16','JK Comercial','jk@gmail.com','930841618','Luanda',10,1,0),(2,2,3,1,'2024-03-16 12:28:22','Maria Services Ltd','maria@gmail.com','930841618','Luanda',0,1,0),(3,4,2,1,'2024-03-16 12:30:07','Doces da Emilia','emi@gmail.com','930841618','Luanda',9,1,0),(4,1,2,1,'2024-03-17 23:28:46','Maria Services Ltd','luciliodetales@gmail.com','930841618','Luanda',6,1,0),(5,6,4,1,'2024-03-18 07:53:31','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',25,1,545000),(6,3,3,1,'2024-03-18 08:06:34','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',36,1,300000),(7,5,2,1,'2024-03-26 10:07:16','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',5,1,0),(8,15,4,1,'2024-03-28 09:02:41','Maria Services Ltd','luciliodetales@gmail.com','930841618','Luanda',5,1,0),(9,16,2,1,'2024-03-29 13:50:01','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',8,1,0),(10,16,2,1,'2024-03-29 13:53:17','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',6,1,0),(11,16,3,1,'2024-03-29 13:55:53','Maria Services Ltd','luciliodetales@gmail.com','930841618','Luanda',8,1,0),(12,16,3,1,'2024-03-29 13:56:46','Maria Services Ltd','luciliodetales@gmail.com','930841618','Luanda',8,1,0),(13,16,3,1,'2024-03-29 13:57:52','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',4,1,0),(14,16,3,1,'2024-03-29 13:58:20','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',4,1,0),(15,16,2,1,'2024-03-29 14:24:18','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',5,1,0),(16,16,1,1,'2024-03-29 14:28:06','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',9,1,0),(17,16,1,1,'2024-03-29 14:33:34','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',9,1,0),(18,16,1,1,'2024-03-29 16:01:47','Maria Services Ltd','luciliodetales@gmail.com','930841618','Luanda',9,1,0),(19,16,1,1,'2024-03-29 16:06:06','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',9,1,0),(20,16,1,1,'2024-03-29 16:06:33','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',9,1,0),(21,17,1,1,'2024-03-29 16:43:11','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',10,1,0),(22,20,2,1,'2024-04-04 14:22:32','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',4,0,0),(23,18,2,1,'2024-04-06 11:46:26','Maria Services Ltd','luciliodetales@gmail.com','930841618','Luanda',3,0,0),(24,16,2,1,'2024-04-07 07:03:14','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',8,0,0);
/*!40000 ALTER TABLE `faturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freelancers`
--

DROP TABLE IF EXISTS `freelancers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelancers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `estado` int DEFAULT '1',
  `telefone` varchar(45) DEFAULT NULL,
  `comissao_percentagem` int NOT NULL DEFAULT '1',
  `nif` varchar(100) DEFAULT NULL,
  `banco` varchar(100) DEFAULT NULL,
  `iban` varchar(100) DEFAULT NULL,
  `numero_da_conta` varchar(100) DEFAULT NULL,
  `senha` text,
  `ativo` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelancers`
--

LOCK TABLES `freelancers` WRITE;
/*!40000 ALTER TABLE `freelancers` DISABLE KEYS */;
INSERT INTO `freelancers` VALUES (1,'Carlos Jorge Afonso','carlos@gmail.com',1,'932123234',1,'21489303 1313',NULL,NULL,NULL,'$2y$10$kYMTDQIdop3Iz0s2491cJ.nfF2.IK2yAtLXOIF7S3esqQzAyv83Ga',1),(2,'AFONSO EDUARDO DOMBAXI','afonso@gmail.com',1,'930841618',1,'12321312','BFA','4342','1223','$2y$10$rvGRzjhkwHJZXk94Gadqk.3vgogpETp7/SdxnRIkkFteyoaKFw3VW',1),(5,'Ana Pedro','ana@gmail.com',1,'930841618',1,'21489303 1313','BFA','0830838403','12233','$2y$10$3ktUR/Zac8xoQ33rtiosBOUvScges08cZp4ijhQ.simMib01wXHQi',1),(6,'Mario Pedro Victor','mario@gmail.com',1,'930841618',1,'4903930139233','BFA','24342','1223','$2y$10$UstGxjY/tz10VAqD0Gv/2e.h/z5dkxmEqwHFu0vKBXUWEdr7RiTm.',1),(7,'LUCÍLIO GOMES','tales@gmail.com',1,'930841618',1,'489303 1313','BFA','1312321','1223','$2y$10$6Tn7AynaQK13icJpo0og.OQdP8Rx33KM4gAjipzj8e3mIneQTSaMW',1),(8,'LUCÍLIO GOMES','luciliodetales@gmail.com',1,'930841618',1,'21489303 1313','BFA','343243','1223','$2y$10$Ye/wl8Fr5eFflXyOGz47T.g3w/n0zW2VZFPxs/OSD7K92nqpfF5WS',1);
/*!40000 ALTER TABLE `freelancers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freelancers_clientes`
--

DROP TABLE IF EXISTS `freelancers_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelancers_clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `id_freelancer` int DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_cliente_idx` (`id_cliente`),
  KEY `id_freelancer_fk_idx` (`id_freelancer`),
  CONSTRAINT `id_cliente_fk` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_freelancer_fk` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelancers_clientes`
--

LOCK TABLES `freelancers_clientes` WRITE;
/*!40000 ALTER TABLE `freelancers_clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `freelancers_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freelancers_comissoes`
--

DROP TABLE IF EXISTS `freelancers_comissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelancers_comissoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_freelancer` int DEFAULT NULL,
  `id_fatura` int DEFAULT NULL,
  `comissao` double DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pago` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_freelance_fatura_idx` (`id_fatura`),
  KEY `fk_freelance_comissoe_idx` (`id_freelancer`),
  CONSTRAINT `fk_freelance_comissoe` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_freelance_fatura` FOREIGN KEY (`id_fatura`) REFERENCES `faturas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelancers_comissoes`
--

LOCK TABLES `freelancers_comissoes` WRITE;
/*!40000 ALTER TABLE `freelancers_comissoes` DISABLE KEYS */;
INSERT INTO `freelancers_comissoes` VALUES (1,2,8,940.5,'2024-03-28 09:20:40',1),(2,2,8,940.5,'2024-03-28 09:23:27',0),(8,1,22,672,'2024-04-04 14:22:32',1);
/*!40000 ALTER TABLE `freelancers_comissoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freelancers_config`
--

DROP TABLE IF EXISTS `freelancers_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freelancers_config` (
  `id` int NOT NULL,
  `percentagem_comissao` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freelancers_config`
--

LOCK TABLES `freelancers_config` WRITE;
/*!40000 ALTER TABLE `freelancers_config` DISABLE KEYS */;
INSERT INTO `freelancers_config` VALUES (1,5);
/*!40000 ALTER TABLE `freelancers_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `papel_usuario` int NOT NULL,
  `agencia` int NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT '0.00',
  `departamento` int NOT NULL,
  `estado` enum('Ativo','Inativo') COLLATE utf8mb4_general_ci DEFAULT 'Ativo',
  `ativo` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `agencia` (`agencia`),
  KEY `departamento` (`departamento`),
  CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`agencia`) REFERENCES `agencias` (`id`),
  CONSTRAINT `funcionarios_ibfk_2` FOREIGN KEY (`departamento`) REFERENCES `departamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Lucilio Gomes','luciliodetales@gmail.com','$2y$10$3eiPzAXriDdcEeY6T8a4aOf9KVssmn6tbUTW0RbSzAG9NMOIOmuZm',1,1,'Luanda, Cazenga','943530272',3000.00,2,'',1),(2,'Manuel Jorge','manuel@gmail.com','$2y$10$v3Dh9AQVOkxPMs6gsUjsZua6LQt4X9qMQOOG/tkIrAKGxu/tOoe9C',1,1,'Luanda','943589423',30000.00,2,'Ativo',0),(3,'Jorge Silva','jorge@gmail.com','$2y$10$qvNpIUFl1Jjy1Gf/feWNNuLO2sOXkHw2biQlsv/PGVLS4CP4uPWNu',1,3,'Luanda, Cazenga','934589302',8000.00,6,'Ativo',1),(4,'Victor Armando','victor@gmail.com','$2y$10$PxfHcdugutUkj7FA2q.RgO1u0FX2T0oSRGvdyfHQh6Jf9KwVSBFO2',2,1,'Luanda, Angola','943587372',3907000.00,3,'Ativo',1),(5,'Maria Zimpevo','maria@gmail.com','$2y$10$x4rCTym2d4zED53aAYCYeuM7NKIgv49qrk9hHzY.CRoY4HSqGVF6m',1,3,'Luanda, Viana','912841618',112321.00,3,'Ativo',1),(6,'Julia Gomes','julia@gmail.com','$2y$10$XAKPduaDjzbg/TxSMX8nbODRB9CayOLZcIqvUwwBBczlzgr0eOHX.',2,2,'Luanda','930841618',16.00,1,'Ativo',1),(7,'Emilia da Costa','emilia@gmail.com','$2y$10$j9GWprsswzVASEecM3jGwOe/mcgvGCg6ZuhGWBu4Az41sEKcafVwW',2,4,'Luanda','930841618',3231.00,4,'Ativo',1),(8,'Joao Jorge','joao@gmail.com','$2y$10$iU2QzqtFc30BDr9cZgkLp.N3KAGWBC.FDGDrMlmQiMmDLGyffiiae',2,1,'Luanda','930841618',20.00,4,'Ativo',1),(9,'Claudia Gomes','claudia@gmail.com','$2y$10$JEuUKN.BrnXUnQWGkz3AQ.WcF95x5nVtcekDdUm2X6UbBOxxI7qk.',3,3,'Luanda','930841618',534243.00,4,'Ativo',1);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios_papel`
--

DROP TABLE IF EXISTS `funcionarios_papel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios_papel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios_papel`
--

LOCK TABLES `funcionarios_papel` WRITE;
/*!40000 ALTER TABLE `funcionarios_papel` DISABLE KEYS */;
INSERT INTO `funcionarios_papel` VALUES (1,'Admin'),(2,'Operador'),(3,'Papel'),(4,'Revisor');
/*!40000 ALTER TABLE `funcionarios_papel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `acao` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `detalhes` text COLLATE utf8mb4_general_ci,
  `data_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,1,'Cadastrando um processo','1-3-2-2024-03-25-2024-03-30','2024-03-15 21:42:57'),(2,1,'Actualizando  um processo','4-3-2-2024-03-15-2024-03-23','2024-03-15 21:49:28'),(3,1,'Cadastrando uma fatura','Client:1-Servico:1-Conta:1-Empresa:JK Comercial-Pago:','2024-03-16 12:27:16'),(4,1,'Cadastrando uma fatura','Client:2-Servico:3-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-03-16 12:28:22'),(5,1,'Cadastrando uma fatura','Client:4-Servico:2-Conta:1-Empresa:Doces da Emilia-Pago:','2024-03-16 12:30:07'),(6,1,'Terminando  um processo','ID:4','2024-03-16 13:42:28'),(7,1,'Terminando  um processo','ID:1','2024-03-16 13:42:56'),(8,1,'Terminando  um processo','ID:5','2024-03-16 14:50:55'),(9,1,'Terminando  um processo','ID:2','2024-03-16 15:22:35'),(10,1,'Terminando  um processo','ID:2','2024-03-16 15:24:50'),(11,1,'Terminando  um processo','ID:2','2024-03-16 15:25:37'),(12,1,'Terminando  um processo','ID:2','2024-03-16 15:26:27'),(13,1,'Terminando  um processo','ID:2','2024-03-16 15:27:37'),(14,1,'Terminando  um processo','ID:2','2024-03-16 15:28:48'),(15,1,'Terminando  um processo','ID:3','2024-03-16 17:40:19'),(16,1,'Terminando  um processo','ID:4','2024-03-16 17:41:23'),(17,1,'Terminando  um processo','ID:5','2024-03-16 17:42:28'),(18,1,'Terminando  um processo','ID:6','2024-03-16 17:43:38'),(19,1,'Terminando  um processo','ID:7','2024-03-16 17:44:24'),(20,1,'Cadastrando uma fatura','Client:1-Servico:2-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-03-17 23:28:46'),(21,1,'Cadastrando uma fatura','Client:6-Servico:4-Conta:1-Empresa:JK Comercial-Pago:','2024-03-18 07:53:31'),(22,1,'Cadastrando uma fatura','Client:3-Servico:3-Conta:1-Empresa:JK Comercial-Pago:','2024-03-18 08:06:34'),(23,1,'Cadastrando uma fatura','Client:-Servico:-Conta:-Empresa:-Pago:','2024-03-18 08:40:15'),(24,1,'Cadastrando um Cliente','Client:Sebastiao-NIF:59303 1313-NASCIMENTO:2024-03-14','2024-03-18 08:42:31'),(25,1,'Cadastrando um Cliente','Client:Lucas Silva-NIF:21489303 1313-NASCIMENTO:2024-02-26','2024-03-18 08:44:37'),(26,1,'Cadastrando um Cliente','Client:Victor Lukoki-NIF:21489303 1313-NASCIMENTO:2024-02-28','2024-03-18 08:45:32'),(27,1,'Cadastrando um Cliente','Client:LUCÍLIO GOMES-NIF:21489303 1313-NASCIMENTO:2024-03-08-FUNCIONARIO:MQ==','2024-03-18 08:48:35'),(28,1,'Cadastrando um Cliente','Client:Kikulo Jorge-NIF:21489303 1313-NASCIMENTO:1999-12-12-FUNCIONARIO:1','2024-03-18 08:49:49'),(29,1,'Editando um Cliente','Client:Maria Manuel-NIF:123213132-NASCIMENTO:2003-03-12-FUNCIONARIO:1','2024-03-18 08:53:34'),(30,1,'Editando um Cliente','Client:Maria Manuel-NIF:123213132-NASCIMENTO:2003-03-12-FUNCIONARIO:1','2024-03-18 08:55:58'),(31,1,'Cadastrando um agendamento','Client:12-SERVICE:2-DATA:2024-03-06 09:03-FUNCIONARIO:1','2024-03-18 09:00:01'),(32,1,'Iniciando um agendamento','Agendamento:7-FUNCIONARIO:1','2024-03-18 09:02:02'),(33,1,'Adicionando uma atividade','Actividade:Fazer o levantamento das actividades-INicio:2024-02-27-FIM:2024-03-29-FUNCIONARIO:1','2024-03-18 09:05:06'),(34,1,'Cadastrando um processo','13-2-1-2024-03-14-2024-03-30-FUNCIONARIO:1','2024-03-18 09:07:09'),(35,1,'Alterando um serviço','Servico:1','2024-03-20 17:45:38'),(36,1,'Iniciando um agendamento','Agendamento:6-FUNCIONARIO:1','2024-03-20 19:10:05'),(37,1,'Cadastrando um agendamento','Client:6-SERVICE:2-DATA:2024-03-30 20:20-FUNCIONARIO:1','2024-03-20 19:18:00'),(38,1,'Cadastrando uma fatura','Client:5-Servico:2-Conta:1-Empresa:JK Comercial-Pago:','2024-03-26 10:07:16'),(39,1,'Actualizando  uma fatura','Fatura=3-Cliente=4-pago=1-FUNCIONARIO:1','2024-03-26 10:55:57'),(40,1,'Iniciando um agendamento','Agendamento:1-FUNCIONARIO:1','2024-03-26 11:00:56'),(41,1,'Adicionando uma atividade','Actividade:Limpar chão-INicio:2024-03-29-FIM:2024-04-02-FUNCIONARIO:1','2024-03-26 11:52:10'),(42,1,'Cadastrando um processo','4-3-1-2024-04-04-2024-04-05-FUNCIONARIO:1','2024-03-26 12:16:11'),(43,1,'Actualizando  um processo','4-3-1-2024-04-04-2024-04-05','2024-03-26 12:17:53'),(44,1,'Iniciando um agendamento','Agendamento:1-FUNCIONARIO:1','2024-03-26 12:55:17'),(45,1,'Iniciando um agendamento','Agendamento:2-FUNCIONARIO:1','2024-03-26 12:57:38'),(46,1,'Cadastrando um agendamento','Client:14-SERVICE:2-DATA:2024-03-30 19:00-FUNCIONARIO:1','2024-03-26 12:59:14'),(47,1,'Iniciando um agendamento','Agendamento:9-FUNCIONARIO:1','2024-03-26 12:59:55'),(48,1,'Cadastrando uma Viagem','Client:','2024-03-27 06:19:25'),(49,1,'Editando uma Viagem','Viagem:2-CLIENTE:-DESTINO:Portugal-FUNCIONARIO:1','2024-03-27 06:57:16'),(50,1,'Editando uma Viagem','Viagem:2-CLIENTE:-DESTINO:Portugal-FUNCIONARIO:1','2024-03-27 06:57:23'),(51,1,'Cadastrando um Freelancer','Freelancer:-FUNCIONARIO:1','2024-03-27 22:04:21'),(52,1,'Cadastrando um Freelancer','Freelancer:AFONSO EDUARDO MPAXI-FUNCIONARIO:1','2024-03-27 22:05:57'),(53,1,'Cadastrando um Freelancer','Freelancer:Lopes Garcia-FUNCIONARIO:1','2024-03-27 22:06:11'),(54,1,'Cadastrando um Cliente de Freelancer','Client:Luciano Maquimba-NIF:21489303 1313-NASCIMENTO:2024-03-12-FUNCIONARIO:1','2024-03-28 06:49:59'),(55,1,'Actualizando  uma fatura','Fatura=2-Cliente=2-pago=1-FUNCIONARIO:1','2024-03-28 08:54:16'),(56,1,'Cadastrando uma fatura','Client:15-Servico:4-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-03-28 09:02:41'),(57,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:07:12'),(58,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:08:23'),(59,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:09:26'),(60,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:11:35'),(61,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:14:16'),(62,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:14:39'),(63,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:15:10'),(64,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:15:46'),(65,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:15:57'),(66,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:16:06'),(67,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:16:20'),(68,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:16:39'),(69,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:16:58'),(70,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:17:43'),(71,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:17:50'),(72,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:18:30'),(73,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:18:54'),(74,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:19:12'),(75,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:19:45'),(76,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:20:40'),(77,1,'Commisao de Freelancer emitada','Client:15-Fatura:8-Freelancer:','2024-03-28 09:20:40'),(78,1,'Actualizando  uma fatura','Fatura=8-Cliente=15-pago=1-FUNCIONARIO:1','2024-03-28 09:23:27'),(79,1,'Commisao de Freelancer emitida','Client:15-Fatura:8-Freelancer:2','2024-03-28 09:23:27'),(80,1,'Alterando um requisito','Requsito:5','2024-03-29 13:23:01'),(81,1,'Alterando um requisito','Requsito:5','2024-03-29 13:23:16'),(82,1,'Alterando um requisito','Requsito:4','2024-03-29 13:23:23'),(83,1,'Alterando um requisito','Requsito:4','2024-03-29 13:24:24'),(84,1,'Cadastrando um Cliente de Freelancer','Client:Dario Jorge-NIF:21489303 1313-NASCIMENTO:2024-04-03-FUNCIONARIO:1','2024-03-29 13:47:42'),(85,1,'Cadastrando uma fatura','Client:16-Servico:2-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 13:50:01'),(86,1,'Cadastrando uma fatura','Client:16-Servico:2-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 13:53:17'),(87,1,'Cadastrando uma fatura','Client:16-Servico:3-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-03-29 13:55:53'),(88,1,'Cadastrando uma fatura','Client:16-Servico:3-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-03-29 13:56:46'),(89,1,'Cadastrando uma fatura','Client:16-Servico:3-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 13:57:52'),(90,1,'Cadastrando uma fatura','Client:16-Servico:3-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 13:58:20'),(91,1,'Actualizando  uma fatura','Fatura=9-Cliente=16-pago=1-FUNCIONARIO:1','2024-03-29 13:59:04'),(92,1,'Actualizando  uma fatura','Fatura=9-Cliente=16-pago=1-FUNCIONARIO:1','2024-03-29 13:59:16'),(93,1,'Commisao de Freelancer emitida','Client:16-Fatura:9-Freelancer:3','2024-03-29 13:59:16'),(94,1,'Cadastrando uma fatura','Client:16-Servico:1-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 14:28:06'),(95,1,'Commisao de Freelancer emitida','Client:16-Fatura:16-Freelancer:3','2024-03-29 14:28:06'),(96,1,'Cadastrando uma fatura','Client:16-Servico:1-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 14:33:34'),(97,1,'Commisao de Freelancer emitida','Client:16-Fatura:17-Freelancer:3','2024-03-29 14:33:34'),(98,1,'Alteranco a percentagem de comissão dos freelancers','-FUNCIONARIO:1','2024-03-29 15:20:02'),(99,1,'Alteranco a percentagem de comissão dos freelancers','-FUNCIONARIO:1','2024-03-29 15:20:13'),(100,1,'Alteranco a percentagem de comissão dos freelancers','-FUNCIONARIO:1','2024-03-29 15:45:46'),(101,1,'Alteranco a percentagem de comissão dos freelancers','-FUNCIONARIO:1','2024-03-29 15:46:45'),(102,1,'Cadastrando uma fatura','Client:16-Servico:1-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-03-29 16:01:47'),(103,1,'Cadastrando uma fatura','Client:16-Servico:1-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 16:06:06'),(104,1,'Alteranco a percentagem de comissão dos freelancers','-FUNCIONARIO:1','2024-03-29 16:06:15'),(105,1,'Cadastrando uma fatura','Client:16-Servico:1-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 16:06:33'),(106,1,'Commisao de Freelancer emitida','Client:16-Fatura:20-Freelancer:3','2024-03-29 16:06:33'),(107,1,'Cadastrando uma Viagem','Client:','2024-03-29 16:26:49'),(108,1,'Cadastrando uma Viagem','Client:','2024-03-29 16:30:12'),(109,1,'Alterando um requisito','Requsito:6','2024-03-29 16:34:31'),(110,1,'Cadastrando um Freelancer','Freelancer:Maria Joao-FUNCIONARIO:1','2024-03-29 16:40:48'),(111,1,'Cadastrando um Cliente de Freelancer','Client:Lucas Simao-NIF:21489303 1313-NASCIMENTO:2024-03-30-FUNCIONARIO:1','2024-03-29 16:41:43'),(112,1,'Cadastrando uma fatura','Client:17-Servico:1-Conta:1-Empresa:JK Comercial-Pago:','2024-03-29 16:43:11'),(113,1,'Commisao de Freelancer emitida','Client:17-Fatura:21-Freelancer:4','2024-03-29 16:43:11'),(114,1,'Editando um Freelancer','Freelancer:Maria Joao da Silva-NIF:21489303 1313FUNCIONARIO:1','2024-03-30 15:00:22'),(115,1,'Editando um Freelancer','Freelancer:Maria Joao da Silva-NIF:21489303 1313FUNCIONARIO:1','2024-03-30 15:00:37'),(116,1,'Cadastrando um agendamento','Client:6-SERVICE:1-DATA:2024-04-30 05:40-FUNCIONARIO:1','2024-04-02 22:34:13'),(117,1,'Cadastrando um processo','6-1-1-2024-05-11-2024-05-11-FUNCIONARIO:1','2024-04-03 20:38:20'),(118,1,'Cadastrando um processo','20-2-1-2024-06-01-2024-05-11-FUNCIONARIO:1','2024-04-04 13:45:19'),(119,1,'Cadastrando um processo','20-2-2-2024-04-08-2024-04-30-FUNCIONARIO:1','2024-04-04 13:46:02'),(120,1,'Cadastrando um processo','20-3-1-2024-04-13-2024-04-30-FUNCIONARIO:1','2024-04-04 13:47:46'),(121,1,'Cadastrando uma fatura','Client:20-Servico:2-Conta:1-Empresa:JK Comercial-Pago:','2024-04-04 14:22:32'),(122,1,'Commisao de Freelancer emitida','Client:20-Fatura:22-Freelancer:1','2024-04-04 14:22:32'),(123,1,'Cadastrando uma fatura','Client:18-Servico:2-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-04-06 11:46:26'),(124,1,'Cadastrando uma Conta','Conta:ESMEARK VIAGENS-NUMERO:122334-FUNCIONARIO:1','2024-04-06 12:20:23'),(125,1,'Alterando uma Conta','Conta:ESMEARK-NUMERO:1234-FUNCIONARIO:1','2024-04-06 12:37:14'),(126,1,'Alterando uma Conta','Conta:ESMEARK VIAGENS-NUMERO:12252-FUNCIONARIO:1','2024-04-06 12:37:45'),(127,1,'Cadastrando um tipo de Conta','Tipo:Conta Poupança-FUNCIONARIO:1','2024-04-06 12:49:51'),(128,1,'Cadastrando uma Agencia','Agencia:Esmeark Agency-FUNCIONARIO:1','2024-04-06 15:21:16'),(129,1,'Alterando uma Agencia','Agencia:Agência Luanda-FUNCIONARIO:1','2024-04-06 15:34:36'),(130,1,'Alterando uma Agencia','Agencia:Esmeark Agência-FUNCIONARIO:1','2024-04-06 15:35:12'),(131,1,'Cadastrando uma Agencia','Agencia:Agência Vila Nova-FUNCIONARIO:1','2024-04-06 15:38:18'),(132,1,'Cadastrando um Freelancer','Freelancer:Ana Pedro-FUNCIONARIO:1','2024-04-06 15:43:42'),(133,1,'Cadastrando um Freelancer','Freelancer:Mario Pedro Victor-FUNCIONARIO:1','2024-04-06 16:08:25'),(134,1,'Cadastrando um Cliente','Client:Lucilia Urak-NIF:21489303 1313-NASCIMENTO:2000-12-12-FUNCIONARIO:1','2024-04-06 16:10:03'),(135,1,'Cadastrando uma Viagem','Client:','2024-04-06 16:11:57'),(136,1,'Cadastrando uma Viagem','Client:','2024-04-06 16:12:09'),(137,1,'Cadastrando uma Viagem','Client:','2024-04-06 16:12:33'),(138,1,'Adicionando uma atividade','Actividade:\'ola\'\'-INicio:2024-05-09-FIM:2024-05-11-FUNCIONARIO:1','2024-04-06 22:15:12'),(139,1,'Adicionando uma atividade','Actividade:\'ola\'\'-INicio:2024-05-02-FIM:2024-05-09-FUNCIONARIO:1','2024-04-06 22:15:26'),(140,1,'Adicionando uma atividade','Actividade:<script>Ola Mundo</script>-INicio:2024-04-25-FIM:2024-05-03-FUNCIONARIO:1','2024-04-06 22:16:24'),(141,1,'Adicionando uma atividade','Actividade:<script>Ola Mundo</script>-INicio:2024-04-26-FIM:2024-05-03-FUNCIONARIO:1','2024-04-06 22:17:47'),(142,1,'Adicionando uma atividade','Actividade:<script>aler(\'Ola Mundo\')</script>-INicio:2024-05-02-FIM:2024-05-02-FUNCIONARIO:1','2024-04-06 22:19:15'),(143,1,'Adicionando uma atividade','Actividade:<script>alert(\'Ola Mundo\')</script>-INicio:2024-05-10-FIM:2024-05-09-FUNCIONARIO:1','2024-04-06 22:20:07'),(144,1,'Adicionando uma atividade','Actividade:<script>alert(\'Ola Mundo\')</script>-INicio:2024-05-10-FIM:2024-05-11-FUNCIONARIO:1','2024-04-06 22:22:48'),(145,1,'Adicionando uma atividade','Actividade:&lt;script&gt;alert(&#039;Ola Mundo&#039;)&lt;/script&gt;-INicio:2024-05-03-FIM:2024-05-02-FUNCIONARIO:1','2024-04-06 22:24:05'),(146,1,'Adicionando uma atividade','Actividade:&#039;ola&#039;&#039;-INicio:2024-05-10-FIM:2024-05-04-FUNCIONARIO:1','2024-04-06 22:24:43'),(147,1,'Adicionando uma atividade','Actividade:&lt;script&gt;alert(&#039;Ola Mundo&#039;)&lt;/script&gt;-INicio:2024-05-10-FIM:2024-05-03-FUNCIONARIO:1','2024-04-06 22:25:43'),(148,1,'Cadastrando uma Agencia','Agencia:Agencia Lubando &#039;-FUNCIONARIO:1','2024-04-06 22:42:29'),(149,1,'Cadastrando uma Agencia','Agencia:&lt;script&gt;alert(&#039;ola&#039;)&lt;/script&gt;-FUNCIONARIO:1','2024-04-06 22:43:03'),(150,1,'Alterando uma Agencia','Agencia:<script>alert(\'ola\')</script>-FUNCIONARIO:1','2024-04-06 22:46:35'),(151,1,'Alterando uma Agencia','Agencia:&lt;script&gt;alert(&#039;ola&#039;)&lt;/script&gt;-FUNCIONARIO:1','2024-04-06 22:47:22'),(152,1,'Cadastrando um Cliente','Client:&lt;script&gt;alert(&#039;OLA&#039;)&lt;/script&gt;-NIF:12321312-NASCIMENTO:2000-12-12-FUNCIONARIO:1','2024-04-06 22:55:45'),(153,1,'Cadastrando um agendamento','Client:18-SERVICE:1-DATA:2024-05-11 05:27-FUNCIONARIO:1','2024-04-06 23:27:20'),(154,1,'Cadastrando um Cliente','Client:LUCÍLIO GOMES-NIF:21489303 1313-NASCIMENTO:2000-12-12-FUNCIONARIO:1','2024-04-07 05:45:59'),(155,1,'Cadastrando um Cliente','Client:LUCÍLIO GOMES-NIF:12321312-NASCIMENTO:2000-12-12-FUNCIONARIO:1','2024-04-07 05:49:34'),(156,1,'Cadastrando um Cliente','Client:AFONSO EDUARDO MPAXI-NIF:21489303 1313-NASCIMENTO:1988-02-29-FUNCIONARIO:1','2024-04-07 05:57:20'),(157,1,'Cadastrando um Freelancer','Freelancer:LUCÍLIO GOMES-FUNCIONARIO:1','2024-04-07 06:20:24'),(158,1,'Editando um Freelancer','Freelancer:AFONSO EDUARDO DOMBAXI-NIF:12321312FUNCIONARIO:1','2024-04-07 06:45:50'),(159,1,'Editando um Freelancer','Freelancer:AFONSO EDUARDO DOMBAXI-NIF:12321312FUNCIONARIO:1','2024-04-07 06:46:05'),(160,1,'Editando um Freelancer','Freelancer:AFONSO EDUARDO DOMBAXI-NIF:12321312FUNCIONARIO:1','2024-04-07 06:47:39'),(161,1,'Editando um Freelancer','Freelancer:AFONSO EDUARDO DOMBAXI-NIF:12321312FUNCIONARIO:1','2024-04-07 06:48:30'),(162,1,'Editando um Cliente','Client:Alice Lunda-NIF:490393013923-NASCIMENTO:2000-12-12-FUNCIONARIO:1','2024-04-07 06:55:03'),(163,1,'Editando um Cliente','Client:Alice Lunda-NIF:490393013923-NASCIMENTO:2000-12-12-FUNCIONARIO:1','2024-04-07 06:58:32'),(164,1,'Cadastrando uma fatura','Client:16-Servico:2-Conta:1-Empresa:JK Comercial-Pago:','2024-04-07 07:03:14'),(165,1,'Actualizando  uma fatura','Fatura=22-Cliente=20-pago=0-FUNCIONARIO:1','2024-04-07 07:05:01'),(166,1,'Alterando um serviço','Servico:1','2024-04-07 07:11:18'),(167,1,'Alterando um serviço','Servico:1','2024-04-07 07:13:12'),(168,1,'Cadastrando um agendamento','Client:16-SERVICE:2-DATA:2024-04-17 13:00-FUNCIONARIO:1','2024-04-07 08:58:03'),(169,1,'Cadastrando um agendamento','Client:16-SERVICE:3-DATA:2024-04-30 16:05-FUNCIONARIO:1','2024-04-07 09:02:46'),(170,1,'Adicionando uma atividade','Actividade:Fazer o levantamento das actividades-INicio:2024-05-03-FIM:2024-05-08-FUNCIONARIO:1','2024-04-07 09:19:23'),(171,1,'Cadastrando um processo','17-2-1-2024-04-26-2024-05-11-FUNCIONARIO:1','2024-04-07 09:23:23'),(172,1,'Actualizando  um processo','20-2-2-2024-06-01-2024-05-11','2024-04-07 09:24:41'),(173,1,'Cadastrando um processo','15-2-1-2024-04-02-2024-04-23-FUNCIONARIO:1','2024-04-07 09:26:32'),(174,1,'Cadastrando uma Conta','Conta:Esmeark Agency-NUMERO:1223-FUNCIONARIO:1','2024-04-07 09:28:56'),(175,1,'Alterando uma Conta','Conta:Esmeark Agencia-NUMERO:1223-FUNCIONARIO:1','2024-04-07 09:34:18'),(176,1,'Cadastrando um Freelancer','Freelancer:LUCÍLIO GOMES-FUNCIONARIO:1','2024-04-07 19:05:37');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoesporcargo`
--

DROP TABLE IF EXISTS `permissoesporcargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissoesporcargo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cargo_id` int DEFAULT NULL,
  `permissao_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cargo_id` (`cargo_id`),
  KEY `permissao_id` (`permissao_id`),
  CONSTRAINT `permissoesporcargo_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `funcionarios_papel` (`id`),
  CONSTRAINT `permissoesporcargo_ibfk_2` FOREIGN KEY (`permissao_id`) REFERENCES `permissoessistema` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoesporcargo`
--

LOCK TABLES `permissoesporcargo` WRITE;
/*!40000 ALTER TABLE `permissoesporcargo` DISABLE KEYS */;
INSERT INTO `permissoesporcargo` VALUES (1,1,3),(2,1,4),(3,1,2),(4,1,1),(5,1,3),(6,1,10),(7,1,11),(8,1,12),(9,1,13),(10,2,14),(12,1,14),(13,1,15),(14,1,16),(16,1,18),(17,1,19),(18,1,20),(19,1,21),(20,1,22),(21,1,23),(22,1,27),(23,1,25),(24,1,26),(25,1,28),(26,1,29),(27,1,30),(28,1,31),(29,1,32),(30,1,33),(31,1,34),(32,1,36),(33,1,35),(34,1,37),(35,1,38),(36,1,39),(37,1,40),(38,1,41),(39,1,42),(40,1,43),(41,1,44),(42,1,46),(43,1,45),(44,1,50),(45,1,47),(46,1,52),(47,1,51),(48,1,56);
/*!40000 ALTER TABLE `permissoesporcargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoessistema`
--

DROP TABLE IF EXISTS `permissoessistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissoessistema` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permissao` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoessistema`
--

LOCK TABLES `permissoessistema` WRITE;
/*!40000 ALTER TABLE `permissoessistema` DISABLE KEYS */;
INSERT INTO `permissoessistema` VALUES (1,'permissao'),(2,'editar agencia'),(3,'adicionar funcionario'),(4,'permissao'),(5,'permissao'),(6,'adicionar-fattura'),(7,'apagar-factura'),(8,'ver-fatura'),(9,'pesquisar-fattura'),(10,'Adicionar Factura'),(11,'Apagar Factura'),(12,'Ver Factura'),(13,'Pesquisar Factura'),(14,'Adicionar Serviço'),(15,'Ver Serviços'),(16,'Editar Serviços'),(17,'Remover Serviços'),(18,'Adicionar Clientes'),(19,'Ver Clientes'),(20,'Pesquisar Clientes'),(21,'Adicionar Documentos de Clientes'),(22,'Remover Documentos de Clientes'),(23,'Remover Clientes'),(24,'Remover Clientes'),(25,'Agendar Nova Consultoria'),(26,'Iniciar Consultoria'),(27,'Ver Lista das Consultorias'),(28,'Adicionar Processo'),(29,'Ver Processo'),(30,'Atualizar Processo'),(31,'Cadastrar Novo Estado de Processo'),(32,'Ver Estado de Processo'),(33,'Remover Estado de Processo'),(34,'Editar Estado de Processo'),(35,'Adicionar Atividade'),(36,'Ver Atividade'),(37,'Editar Atividade'),(38,'Remover Atividade'),(39,'Adicionar Transação'),(40,'Ver Transação'),(41,'Editar Transação'),(42,'Remover Transação'),(43,'Adicionar Conta Bancária'),(44,'Remover Conta Bancária'),(45,'Ver Contas Bancárias'),(46,'Editar Conta Bancárias'),(47,'Adicionar Funcionário'),(48,'Remover Funcionário'),(49,'Editar Funcionário'),(50,'Ver Funcionários'),(51,'Novo Cargo'),(52,'Ver Cargo'),(53,'Editar Cargo'),(54,'Remover Cargo'),(55,'Adicionar Agência'),(56,'Ver Agência'),(57,'Remover Agência'),(58,'Editar Agência'),(59,'Editar Permissões Por Cargo');
/*!40000 ALTER TABLE `permissoessistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processos`
--

DROP TABLE IF EXISTS `processos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int DEFAULT NULL,
  `tipo_servico_id` int DEFAULT NULL,
  `estado_processo_id` int DEFAULT NULL,
  `funcionario_responsavel_id` int DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim_previsto` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `tipo_servico_id` (`tipo_servico_id`),
  KEY `estado_processo_id` (`estado_processo_id`),
  KEY `funcionario_responsavel_id` (`funcionario_responsavel_id`),
  CONSTRAINT `processos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `processos_ibfk_2` FOREIGN KEY (`tipo_servico_id`) REFERENCES `servicos` (`id`),
  CONSTRAINT `processos_ibfk_3` FOREIGN KEY (`estado_processo_id`) REFERENCES `processosestado` (`id`),
  CONSTRAINT `processos_ibfk_4` FOREIGN KEY (`funcionario_responsavel_id`) REFERENCES `funcionarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processos`
--

LOCK TABLES `processos` WRITE;
/*!40000 ALTER TABLE `processos` DISABLE KEYS */;
INSERT INTO `processos` VALUES (9,1,3,1,1,'bm','2024-03-25 00:00:00','2024-03-30 00:00:00','2024-03-30 00:00:00'),(10,13,2,1,1,'Descricao do processo','2024-03-14 00:00:00','2024-03-30 00:00:00','2024-03-30 00:00:00'),(11,4,3,1,3,'Detalhes do processo','2024-04-04 00:00:00','2024-04-05 00:00:00','2024-04-05 00:00:00'),(16,17,2,1,9,'Processo','2024-04-26 00:00:00','2024-05-11 00:00:00','2024-05-11 00:00:00'),(17,15,2,1,7,'Processo','2024-04-02 00:00:00','2024-04-23 00:00:00','2024-04-23 00:00:00');
/*!40000 ALTER TABLE `processos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processosestado`
--

DROP TABLE IF EXISTS `processosestado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processosestado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_estado` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processosestado`
--

LOCK TABLES `processosestado` WRITE;
/*!40000 ALTER TABLE `processosestado` DISABLE KEYS */;
INSERT INTO `processosestado` VALUES (1,'Em Andamento'),(2,'terminado');
/*!40000 ALTER TABLE `processosestado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisitos`
--

DROP TABLE IF EXISTS `requisitos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requisitos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pais` varchar(45) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `taxa` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `requisitos` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisitos`
--

LOCK TABLES `requisitos` WRITE;
/*!40000 ALTER TABLE `requisitos` DISABLE KEYS */;
INSERT INTO `requisitos` VALUES (4,'Brasil',1,900000,'2024-03-29 11:07:02','Copia do Bilhete\r\nCopia do passaporte\r\nVisto Valido'),(5,'Portugal',1,500000,'2024-03-29 11:10:41','Copia do bilhete, Visto Valido, Copia do passaporte'),(6,'iTALIA',1,400000,'2024-03-29 16:34:16','Copia do BI, Copia do Visto Valido, Copia do Passaporte'),(7,'Angola',1,52,'2024-04-07 07:08:03','Requisito 1, Requisito 2');
/*!40000 ALTER TABLE `requisitos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `custo` decimal(10,2) NOT NULL,
  `prazo_dias` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1,'Servico 1 alterado',2000.00,500),(2,'Servico 2',14000.00,2),(3,'Serviço 3',5.00,2000),(4,'Serviço alterado',1000.00,900),(5,'Emissao de visto',2.00,3700);
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos_solicitados`
--

DROP TABLE IF EXISTS `servicos_solicitados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos_solicitados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_servico` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_service_client_idx` (`id_cliente`),
  KEY `FK_service_service_idx` (`id_servico`),
  CONSTRAINT `FK_service_client` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_service_service` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos_solicitados`
--

LOCK TABLES `servicos_solicitados` WRITE;
/*!40000 ALTER TABLE `servicos_solicitados` DISABLE KEYS */;
INSERT INTO `servicos_solicitados` VALUES (1,18,0,'2024-04-05 16:43:49',2),(2,18,0,'2024-04-05 17:09:01',3),(3,19,0,'2024-04-05 17:18:45',3),(4,NULL,0,'2024-04-05 17:43:43',2),(5,18,0,'2024-04-05 17:45:42',3),(6,18,0,'2024-04-05 17:45:47',2);
/*!40000 ALTER TABLE `servicos_solicitados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `todolist`
--

DROP TABLE IF EXISTS `todolist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `todolist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `funcionario_id` int DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_conclusao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Pendente','Concluído') COLLATE utf8mb4_general_ci DEFAULT 'Pendente',
  PRIMARY KEY (`id`),
  KEY `funcionario_id` (`funcionario_id`),
  CONSTRAINT `todolist_ibfk_1` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todolist`
--

LOCK TABLES `todolist` WRITE;
/*!40000 ALTER TABLE `todolist` DISABLE KEYS */;
/*!40000 ALTER TABLE `todolist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viagens`
--

DROP TABLE IF EXISTS `viagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `viagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `data_viagem` date DEFAULT NULL,
  `hora_viagem` time DEFAULT NULL,
  `realizado` int DEFAULT '0',
  `id_funcionario` int DEFAULT NULL,
  `destino` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente_idx` (`id_cliente`),
  KEY `id_funcionario_idx` (`id_funcionario`),
  CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viagens`
--

LOCK TABLES `viagens` WRITE;
/*!40000 ALTER TABLE `viagens` DISABLE KEYS */;
INSERT INTO `viagens` VALUES (4,6,'2024-04-06','17:30:00',0,NULL,'Portugal'),(5,17,'2024-05-07','23:15:00',0,NULL,'Portugal'),(7,17,'2024-04-23','22:15:00',0,NULL,'Portugal');
/*!40000 ALTER TABLE `viagens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-07 22:27:15

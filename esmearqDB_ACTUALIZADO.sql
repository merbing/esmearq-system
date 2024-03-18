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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agencias`
--

LOCK TABLES `agencias` WRITE;
/*!40000 ALTER TABLE `agencias` DISABLE KEYS */;
INSERT INTO `agencias` VALUES (1,'AGENCIA','Endereco','Luanda','943500282','2024-03-05 17:12:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividadesregistro`
--

LOCK TABLES `atividadesregistro` WRITE;
/*!40000 ALTER TABLE `atividadesregistro` DISABLE KEYS */;
INSERT INTO `atividadesregistro` VALUES (2,2,' actividades','Em andamento','2024-03-20 00:00:00','2024-03-30 00:00:00','concluida'),(5,3,'Fazer o levantamento das actividades','Em andamento','2024-02-27 00:00:00','2024-03-29 00:00:00','em_andamento');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancariasinformacoes`
--

LOCK TABLES `bancariasinformacoes` WRITE;
/*!40000 ALTER TABLE `bancariasinformacoes` DISABLE KEYS */;
INSERT INTO `bancariasinformacoes` VALUES (1,'ESMEARK','BFA','00040300020','1234',10000000.00,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancostipocontas`
--

LOCK TABLES `bancostipocontas` WRITE;
/*!40000 ALTER TABLE `bancostipocontas` DISABLE KEYS */;
INSERT INTO `bancostipocontas` VALUES (1,'Conta Corrente');
/*!40000 ALTER TABLE `bancostipocontas` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'João Matoso','12321312','1998-12-12','Angola','Casado','Luanda','933231232','gomes.luciliogomes@gmail.com','2024-03-11 15:26:38'),(2,'Maria Manuel','123213132','2003-03-12','Brasileira','Solteiro','Luanda','930841618','gomes.luciliogomes@gmail.com','2024-03-11 16:08:38'),(3,'Maria Manuel','123213132','2003-03-12','Angola','','Luanda','930841618','gomes.luciliogomes@gmail.com','2024-03-11 16:09:08'),(4,'Emilia','12321312','2003-12-12','Angola','Solteiro','Luanda','930841618','gomes.luciliogomes@gmail.com','2024-03-11 16:12:19'),(5,'Gerson Eduardo','12321312','2020-03-12','Brasileira','Viúvo','Cabinda','934785726','gomes.luciliogomes@gmail.com','2024-03-11 17:30:58'),(6,'Vania Calombe','12321312','2024-04-05','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-17 23:35:46'),(7,'Maria Silva','12321312','2024-03-21','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-17 23:38:32'),(8,'Maria Silva','12321312','2024-03-21','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-17 23:38:45'),(9,'Mariano Paquete','489303 1313','2024-03-29','Angola','Solteiro','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:40:15'),(10,'Sebastiao','59303 1313','2024-03-14','','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:42:31'),(11,'Lucas Silva','21489303 1313','2024-02-26','','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:44:37'),(12,'Victor Lukoki','21489303 1313','2024-02-28','Congoles','Divorciado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:45:32'),(13,'LUCÍLIO GOMES','21489303 1313','2024-03-08','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:48:34'),(14,'Kikulo Jorge','21489303 1313','1999-12-12','Angola','Casado','Luanda','930841618','luciliodetales@gmail.com','2024-03-18 08:49:49');
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
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `clientes_documentos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_documentos`
--

LOCK TABLES `clientes_documentos` WRITE;
/*!40000 ALTER TABLE `clientes_documentos` DISABLE KEYS */;
INSERT INTO `clientes_documentos` VALUES (6,1,'Bilhete Do Cliente','file65f306539259414032024151443.pdf'),(9,7,'Extrato','file65f7812ea714e18032024004758.pdf'),(10,7,'Bilhete','file65f7812eaa33018032024004758.pdf');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultasagendamento`
--

LOCK TABLES `consultasagendamento` WRITE;
/*!40000 ALTER TABLE `consultasagendamento` DISABLE KEYS */;
INSERT INTO `consultasagendamento` VALUES (1,NULL,NULL,NULL,NULL,'Portugal','2024-03-30 12:30:00',NULL,1,'2024-03-12 20:24:53',1,1),(2,NULL,NULL,NULL,NULL,'Brasil','2024-03-27 15:30:00',NULL,2,'2024-03-12 20:27:18',1,2),(3,NULL,NULL,NULL,NULL,'Angola','2024-03-29 06:35:00',NULL,1,'2024-03-12 23:30:04',3,3),(4,NULL,NULL,NULL,NULL,'Portugal','2024-03-30 12:40:00',NULL,2,'2024-03-12 23:35:35',2,3),(5,NULL,NULL,NULL,NULL,'Portugal','2024-03-31 20:00:00',NULL,2,'2024-03-13 15:59:58',2,3),(6,NULL,NULL,NULL,NULL,'Angola','2024-03-30 20:20:00',NULL,2,'2024-03-14 14:16:17',1,2),(7,NULL,NULL,NULL,NULL,'Portugal','2024-03-06 09:03:00',NULL,2,'2024-03-18 09:00:01',2,12);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultasestado`
--

LOCK TABLES `consultasestado` WRITE;
/*!40000 ALTER TABLE `consultasestado` DISABLE KEYS */;
INSERT INTO `consultasestado` VALUES (1,'em espera'),(2,'iniciado'),(3,'concluido'),(4,'cancelado'),(5,'Novo Estado'),(6,'Estado');
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
  PRIMARY KEY (`id`),
  KEY `agendamento_consulta_id` (`agendamento_consulta_id`),
  CONSTRAINT `consultoriadetalhes_ibfk_1` FOREIGN KEY (`agendamento_consulta_id`) REFERENCES `consultasagendamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultoriadetalhes`
--

LOCK TABLES `consultoriadetalhes` WRITE;
/*!40000 ALTER TABLE `consultoriadetalhes` DISABLE KEYS */;
INSERT INTO `consultoriadetalhes` VALUES (1,1,'$razoes','$motivo','sim','sim',2,2023,2023,'$razoes_nao_aprovado_input','$solicitacao_visto',2,'$responsabilidade_despesas','','$nome_outra_pessoa','$numero_outra_pessoa','','$endereco_outra_pessoa','$trabalho','$emprego_outra_pessoa','',1,2,'$recomendacao'),(2,1,'$razoes','$motivo','sim','sim',1,2022,2023,'$razoes_nao_aprovado_input','$solicitacao_visto',2,'$responsabilidade_despesas','','$nome_outra_pessoa','$numero_outra_pessoa','','$endereco_outra_pessoa','$trabalho','$emprego_outra_pessoa','',1,1,'$recomendacao'),(3,1,'Digite as razões','Estudo','Sim','Sim',0,0,2023,'','Singular',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'Digite as razões','Estudo','Sim','Sim',0,0,2023,'','Singular',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,2,'Digite as razões de estudo','Estudo','Sim','Sim',0,0,2023,'','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',1,1,'Joao Manuel'),(6,3,'Digite as razõesalff sdf','Turismo','Sim','Não',2,2022,0,'so many reazons','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,1,'Joao Manuel'),(7,3,'Digite as razõesalff sdf','Turismo','Sim','Não',2,2022,0,'so many reazons','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,2,'Joao Manuel'),(8,3,'Digite as razõesalff sdf','Turismo','Sim','Não',2,2022,0,'so many reazons','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',0,2,'Joao Manuel'),(9,4,'Razões educacionais, etc.','Estudo','Não','',2,2022,0,'Indisciplina','Singular',0,'Por Conta Própria','','','','','','Por Conta Própria','','',1,1,'Joao Manuel'),(10,7,'Digite as razões','','','',0,0,0,'','',0,'','','','','','','','','',1,1,'');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Administração'),(2,'RH'),(3,'Financeiro'),(4,'Comercial'),(5,'Novo'),(6,'RH');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faturas`
--

LOCK TABLES `faturas` WRITE;
/*!40000 ALTER TABLE `faturas` DISABLE KEYS */;
INSERT INTO `faturas` VALUES (1,1,1,1,'2024-03-16 12:27:16','JK Comercial','jk@gmail.com','930841618','Luanda',10,1,0),(2,2,3,1,'2024-03-16 12:28:22','Maria Services Ltd','maria@gmail.com','930841618','Luanda',0,0,0),(3,4,2,1,'2024-03-16 12:30:07','Doces da Emilia','emi@gmail.com','930841618','Luanda',9,0,0),(4,1,2,1,'2024-03-17 23:28:46','Maria Services Ltd','luciliodetales@gmail.com','930841618','Luanda',6,1,0),(5,6,4,1,'2024-03-18 07:53:31','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',25,1,545000),(6,3,3,1,'2024-03-18 08:06:34','JK Comercial','luciliodetales@gmail.com','930841618','Luanda',36,1,300000);
/*!40000 ALTER TABLE `faturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `papel_usuario` int NOT NULL,
  `agencia` int NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT '0.00',
  `departamento` int NOT NULL,
  `estado` enum('Ativo','Inativo') COLLATE utf8mb4_general_ci DEFAULT 'Ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `agencia` (`agencia`),
  KEY `departamento` (`departamento`),
  CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`agencia`) REFERENCES `agencias` (`id`),
  CONSTRAINT `funcionarios_ibfk_2` FOREIGN KEY (`departamento`) REFERENCES `departamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Lucilio Gomes','lucilio@gmail.com','$2y$10$psdaIpotF7y0o4KQCs15O.TvGgDzx1ntEoeLjz4yvICUQ3AZLjmaC',1,1,'endereco','943500272',3000.00,2,''),(2,'Manuel Jorge','manuel@gmail.com','$2y$10$v3Dh9AQVOkxPMs6gsUjsZua6LQt4X9qMQOOG/tkIrAKGxu/tOoe9C',1,1,'Luanda','943589423',30000.00,2,'Ativo'),(3,'jORGE Silva','jorge@gmail.com','$2y$10$qvNpIUFl1Jjy1Gf/feWNNuLO2sOXkHw2biQlsv/PGVLS4CP4uPWNu',1,1,'Luanda','934589303',4000.00,6,'Ativo'),(4,'Victor Armando','victor@gmail.com','$2y$10$PxfHcdugutUkj7FA2q.RgO1u0FX2T0oSRGvdyfHQh6Jf9KwVSBFO2',2,1,'Luanda, Angola','943587372',3907000.00,3,'Ativo');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios_papel`
--

LOCK TABLES `funcionarios_papel` WRITE;
/*!40000 ALTER TABLE `funcionarios_papel` DISABLE KEYS */;
INSERT INTO `funcionarios_papel` VALUES (1,'Admin'),(2,'Operador'),(3,'Papel');
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,1,'Cadastrando um processo','1-3-2-2024-03-25-2024-03-30','2024-03-15 21:42:57'),(2,1,'Actualizando  um processo','4-3-2-2024-03-15-2024-03-23','2024-03-15 21:49:28'),(3,1,'Cadastrando uma fatura','Client:1-Servico:1-Conta:1-Empresa:JK Comercial-Pago:','2024-03-16 12:27:16'),(4,1,'Cadastrando uma fatura','Client:2-Servico:3-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-03-16 12:28:22'),(5,1,'Cadastrando uma fatura','Client:4-Servico:2-Conta:1-Empresa:Doces da Emilia-Pago:','2024-03-16 12:30:07'),(6,1,'Terminando  um processo','ID:4','2024-03-16 13:42:28'),(7,1,'Terminando  um processo','ID:1','2024-03-16 13:42:56'),(8,1,'Terminando  um processo','ID:5','2024-03-16 14:50:55'),(9,1,'Terminando  um processo','ID:2','2024-03-16 15:22:35'),(10,1,'Terminando  um processo','ID:2','2024-03-16 15:24:50'),(11,1,'Terminando  um processo','ID:2','2024-03-16 15:25:37'),(12,1,'Terminando  um processo','ID:2','2024-03-16 15:26:27'),(13,1,'Terminando  um processo','ID:2','2024-03-16 15:27:37'),(14,1,'Terminando  um processo','ID:2','2024-03-16 15:28:48'),(15,1,'Terminando  um processo','ID:3','2024-03-16 17:40:19'),(16,1,'Terminando  um processo','ID:4','2024-03-16 17:41:23'),(17,1,'Terminando  um processo','ID:5','2024-03-16 17:42:28'),(18,1,'Terminando  um processo','ID:6','2024-03-16 17:43:38'),(19,1,'Terminando  um processo','ID:7','2024-03-16 17:44:24'),(20,1,'Cadastrando uma fatura','Client:1-Servico:2-Conta:1-Empresa:Maria Services Ltd-Pago:','2024-03-17 23:28:46'),(21,1,'Cadastrando uma fatura','Client:6-Servico:4-Conta:1-Empresa:JK Comercial-Pago:','2024-03-18 07:53:31'),(22,1,'Cadastrando uma fatura','Client:3-Servico:3-Conta:1-Empresa:JK Comercial-Pago:','2024-03-18 08:06:34'),(23,1,'Cadastrando uma fatura','Client:-Servico:-Conta:-Empresa:-Pago:','2024-03-18 08:40:15'),(24,1,'Cadastrando um Cliente','Client:Sebastiao-NIF:59303 1313-NASCIMENTO:2024-03-14','2024-03-18 08:42:31'),(25,1,'Cadastrando um Cliente','Client:Lucas Silva-NIF:21489303 1313-NASCIMENTO:2024-02-26','2024-03-18 08:44:37'),(26,1,'Cadastrando um Cliente','Client:Victor Lukoki-NIF:21489303 1313-NASCIMENTO:2024-02-28','2024-03-18 08:45:32'),(27,1,'Cadastrando um Cliente','Client:LUCÍLIO GOMES-NIF:21489303 1313-NASCIMENTO:2024-03-08-FUNCIONARIO:MQ==','2024-03-18 08:48:35'),(28,1,'Cadastrando um Cliente','Client:Kikulo Jorge-NIF:21489303 1313-NASCIMENTO:1999-12-12-FUNCIONARIO:1','2024-03-18 08:49:49'),(29,1,'Editando um Cliente','Client:Maria Manuel-NIF:123213132-NASCIMENTO:2003-03-12-FUNCIONARIO:1','2024-03-18 08:53:34'),(30,1,'Editando um Cliente','Client:Maria Manuel-NIF:123213132-NASCIMENTO:2003-03-12-FUNCIONARIO:1','2024-03-18 08:55:58'),(31,1,'Cadastrando um agendamento','Client:12-SERVICE:2-DATA:2024-03-06 09:03-FUNCIONARIO:1','2024-03-18 09:00:01'),(32,1,'Iniciando um agendamento','Agendamento:7-FUNCIONARIO:1','2024-03-18 09:02:02'),(33,1,'Adicionando uma atividade','Actividade:Fazer o levantamento das actividades-INicio:2024-02-27-FIM:2024-03-29-FUNCIONARIO:1','2024-03-18 09:05:06'),(34,1,'Cadastrando um processo','13-2-1-2024-03-14-2024-03-30-FUNCIONARIO:1','2024-03-18 09:07:09');
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
INSERT INTO `permissoesporcargo` VALUES (1,1,3),(2,1,4),(3,1,2),(4,1,1),(5,1,3),(6,1,10),(7,1,11),(8,1,12),(9,1,13),(10,2,14),(11,2,15),(12,1,14),(13,1,15),(14,1,16),(15,1,17),(16,1,18),(17,1,19),(18,1,20),(19,1,21),(20,1,22),(21,1,23),(22,1,27),(23,1,25),(24,1,26),(25,1,28),(26,1,29),(27,1,30),(28,1,31),(29,1,32),(30,1,33),(31,1,34),(32,1,36),(33,1,35),(34,1,37),(35,1,38),(36,1,39),(37,1,40),(38,1,41),(39,1,42),(40,1,43),(41,1,44),(42,1,46),(43,1,45),(44,1,50),(45,1,47),(46,1,52),(47,1,51),(48,1,56);
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
  CONSTRAINT `processos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `processos_ibfk_2` FOREIGN KEY (`tipo_servico_id`) REFERENCES `servicos` (`id`),
  CONSTRAINT `processos_ibfk_3` FOREIGN KEY (`estado_processo_id`) REFERENCES `processosestado` (`id`),
  CONSTRAINT `processos_ibfk_4` FOREIGN KEY (`funcionario_responsavel_id`) REFERENCES `funcionarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processos`
--

LOCK TABLES `processos` WRITE;
/*!40000 ALTER TABLE `processos` DISABLE KEYS */;
INSERT INTO `processos` VALUES (1,1,3,2,2,'Novo Processo','2024-03-17 00:00:00','2024-03-13 00:00:00','2024-03-13 00:00:00'),(6,1,3,2,1,'bm','2024-03-25 00:00:00','2024-03-30 00:00:00','2024-03-30 00:00:00'),(7,1,3,2,1,'bm','2024-03-25 00:00:00','2024-03-30 00:00:00','2024-03-30 00:00:00'),(8,1,3,1,1,'bm','2024-03-25 00:00:00','2024-03-30 00:00:00','2024-03-30 00:00:00'),(9,1,3,1,1,'bm','2024-03-25 00:00:00','2024-03-30 00:00:00','2024-03-30 00:00:00'),(10,13,2,1,1,'Descricao do processo','2024-03-14 00:00:00','2024-03-30 00:00:00','2024-03-30 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1,'Servico 1',10000.00,4),(2,'Servico 2',14000.00,2),(3,'Serviço 3',5.00,2000),(4,'Serviço 4',10.00,30000);
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-18 10:19:43

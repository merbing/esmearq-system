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
  PRIMARY KEY (`id`),
  KEY `funcionario_id` (`funcionario_id`),
  CONSTRAINT `atividadesregistro_ibfk_1` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividadesregistro`
--

LOCK TABLES `atividadesregistro` WRITE;
/*!40000 ALTER TABLE `atividadesregistro` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancariasinformacoes`
--

LOCK TABLES `bancariasinformacoes` WRITE;
/*!40000 ALTER TABLE `bancariasinformacoes` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancostipocontas`
--

LOCK TABLES `bancostipocontas` WRITE;
/*!40000 ALTER TABLE `bancostipocontas` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'João Matoso','12321312','1998-12-12','Angola','Solteiro','Luanda','933231232','joao@gmail.com','2024-03-11 15:26:38'),(2,'Maria Manuel','123213132','2003-03-12','Angola','','Luanda','930841618','maria@gmail.com','2024-03-11 16:08:38'),(3,'Maria Manuel','123213132','2003-03-12','Angola','','Luanda','930841618','maria@gmail.com','2024-03-11 16:09:08'),(4,'Emilia','12321312','2003-12-12','Angola','Solteiro','Luanda','930841618','emilia@gmail.com','2024-03-11 16:12:19'),(5,'Gerson Eduardo','12321312','2020-03-12','','Viúvo','Cabinda','934785726','jerson@gmail.com','2024-03-11 17:30:58');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_documentos`
--

LOCK TABLES `clientes_documentos` WRITE;
/*!40000 ALTER TABLE `clientes_documentos` DISABLE KEYS */;
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
  `nome_clinete` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `morada` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pais_destino` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_consulta` datetime NOT NULL,
  `data_prevista` date NOT NULL,
  `servico_desejado` int DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultasagendamento`
--

LOCK TABLES `consultasagendamento` WRITE;
/*!40000 ALTER TABLE `consultasagendamento` DISABLE KEYS */;
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
  `agendamento_consulta_id` int DEFAULT NULL,
  `consulta_iniciada` tinyint(1) DEFAULT '0',
  `consulta_concluida` tinyint(1) DEFAULT '0',
  `consulta_cancelada` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `agendamento_consulta_id` (`agendamento_consulta_id`),
  CONSTRAINT `consultasestado_ibfk_1` FOREIGN KEY (`agendamento_consulta_id`) REFERENCES `consultasagendamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultasestado`
--

LOCK TABLES `consultasestado` WRITE;
/*!40000 ALTER TABLE `consultasestado` DISABLE KEYS */;
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
  `pessoa_responsavel` varchar(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultoriadetalhes`
--

LOCK TABLES `consultoriadetalhes` WRITE;
/*!40000 ALTER TABLE `consultoriadetalhes` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Lucilio Gomes','lucilio@gmail.com','$2y$10$psdaIpotF7y0o4KQCs15O.TvGgDzx1ntEoeLjz4yvICUQ3AZLjmaC',1,1,'endereco','943500272',3000.00,2,''),(2,'Manuel Jorge','manuel@gmail.com','$2y$10$v3Dh9AQVOkxPMs6gsUjsZua6LQt4X9qMQOOG/tkIrAKGxu/tOoe9C',1,1,'Luanda','943589423',30000.00,2,'Ativo'),(3,'jORGE Silva','jorge@gmail.com','$2y$10$qvNpIUFl1Jjy1Gf/feWNNuLO2sOXkHw2biQlsv/PGVLS4CP4uPWNu',1,1,'Luanda','934589303',4000.00,6,'Ativo');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoesporcargo`
--

LOCK TABLES `permissoesporcargo` WRITE;
/*!40000 ALTER TABLE `permissoesporcargo` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoessistema`
--

LOCK TABLES `permissoessistema` WRITE;
/*!40000 ALTER TABLE `permissoessistema` DISABLE KEYS */;
INSERT INTO `permissoessistema` VALUES (1,'permissao'),(2,'editar agencia'),(3,'adicionar funcionario'),(4,'permissao'),(5,'permissao');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processos`
--

LOCK TABLES `processos` WRITE;
/*!40000 ALTER TABLE `processos` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processosestado`
--

LOCK TABLES `processosestado` WRITE;
/*!40000 ALTER TABLE `processosestado` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
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

-- Dump completed on 2024-03-12  8:07:58

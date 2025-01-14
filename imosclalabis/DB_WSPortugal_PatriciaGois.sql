# ************************************************************
# Sequel Pro SQL dump
# Vers�o 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Base de Dados: bdImoSclal_PatriciaGois
# Tempo de Gera��o: 2024-09-24 19:47:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela cliente
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `nif` int(11) unsigned NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `morada` varchar(100) DEFAULT NULL,
  `cod_postal` varchar(100) DEFAULT NULL,
  `localizacao_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`nif`),
  KEY `fk_localizacao_id` (`localizacao_id`),
  CONSTRAINT `fk_localizacao_id` FOREIGN KEY (`localizacao_id`) REFERENCES `localizacao` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;

INSERT INTO `cliente` (`nif`, `nome`, `email`, `telefone`, `morada`, `cod_postal`, `localizacao_id`)
VALUES
	(1,'João Silva','joao@mail.com',911111111,'Rua do Porto','4050-123',1),
	(2,'Maria Costa','maria@mail.com',922222222,'Avenida da Boavista','4100-001',2),
	(3,'Pedro Martins','pedro@mail.com',933333333,'Rua do Infante','4050-456',1),
	(4,'Ana Luís','ana@mail.com',944444444,'Travessa do Forno','4100-789',3),
	(5,'Rui Oliveira','rui@mail.com',955555555,'Praça da República','4050-901',2);

/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela consultor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `consultor`;

CREATE TABLE `consultor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `funcao_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_funcao_id` (`funcao_id`),
  CONSTRAINT `fk_funcao_id` FOREIGN KEY (`funcao_id`) REFERENCES `funcao` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `consultor` WRITE;
/*!40000 ALTER TABLE `consultor` DISABLE KEYS */;

INSERT INTO `consultor` (`id`, `nome`, `contacto`, `funcao_id`)
VALUES
	(1,'João Pereira','joao.pereira@example.com',1),
	(2,'Maria Rodrigues','maria.rodrigues@example.com',2),
	(3,'Pedro Sousa','pedro.sousa@example.com',3),
	(4,'Ana Fernandes','ana.fernandes@example.com',1),
	(5,'Rui Costa','rui.costa@example.com',2);

/*!40000 ALTER TABLE `consultor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela estado
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;

INSERT INTO `estado` (`id`, `descricao`)
VALUES
	(1,'Vendido'),
	(2,'Por vender'),
	(3,'Em espera'),
	(4,'Cancelado'),
	(5,'Entregue');

/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela funcao
# ------------------------------------------------------------

DROP TABLE IF EXISTS `funcao`;

CREATE TABLE `funcao` (
  `id` int(11) unsigned NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `funcao` WRITE;
/*!40000 ALTER TABLE `funcao` DISABLE KEYS */;

INSERT INTO `funcao` (`id`, `descricao`)
VALUES
	(1,'Vendedor'),
	(2,'Estagiário'),
	(3,'Gerente'),
	(4,'Administrador'),
	(5,'Consultor');

/*!40000 ALTER TABLE `funcao` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela imovel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `imovel`;

CREATE TABLE `imovel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `morada` varchar(100) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `quartos_id` int(11) unsigned DEFAULT NULL,
  `wcs` int(11) DEFAULT NULL,
  `estado_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quartos_id` (`quartos_id`),
  KEY `estado_id` (`estado_id`),
  CONSTRAINT `imovel_ibfk_1` FOREIGN KEY (`quartos_id`) REFERENCES `quartos` (`id`),
  CONSTRAINT `imovel_ibfk_2` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `imovel` WRITE;
/*!40000 ALTER TABLE `imovel` DISABLE KEYS */;

INSERT INTO `imovel` (`id`, `descricao`, `morada`, `preco`, `area`, `tipo`, `quartos_id`, `wcs`, `estado_id`)
VALUES
	(1,'Apartamento T2 em zona central','Rua do Centro',150000.00,80.00,'Apartamento',2,2,1),
	(2,'Vivenda T3 em zona rural','Rua do Campo',250000.00,150.00,'Vivenda',3,3,2),
	(3,'Apartamento T1 em zona urbana','Avenida da Boavista',100000.00,60.00,'Apartamento',1,1,1),
	(4,'Vivenda T4 em zona costeira','Praia da Rocha',350000.00,200.00,'Vivenda',4,4,3),
	(5,'Apartamento T3 em zona histórica','Rua do Castelo',200000.00,120.00,'Apartamento',3,3,2);

/*!40000 ALTER TABLE `imovel` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela localizacao
# ------------------------------------------------------------

DROP TABLE IF EXISTS `localizacao`;

CREATE TABLE `localizacao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `localidade` varchar(20) DEFAULT NULL,
  `concelho` varchar(50) DEFAULT NULL,
  `distrito` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `localizacao` WRITE;
/*!40000 ALTER TABLE `localizacao` DISABLE KEYS */;

INSERT INTO `localizacao` (`id`, `localidade`, `concelho`, `distrito`, `pais`)
VALUES
	(1,'São Mamede','Évora','Évora','Portugal'),
	(2,'Santo Estêvão','Benavente','Santarém','Portugal'),
	(3,'Galveias','Ponte de Sôr','Portalegre','Portugal'),
	(4,'Ferragudo','Lagoa','Algarve','Portugal'),
	(5,'Utrecht','Utrecht','Nederland','Nederland');

/*!40000 ALTER TABLE `localizacao` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela quartos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `quartos`;

CREATE TABLE `quartos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `quartos` WRITE;
/*!40000 ALTER TABLE `quartos` DISABLE KEYS */;

INSERT INTO `quartos` (`id`, `descricao`)
VALUES
	(1,'T1'),
	(2,'T2'),
	(3,'T3'),
	(4,'T4'),
	(5,'T5');

/*!40000 ALTER TABLE `quartos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela venda
# ------------------------------------------------------------

DROP TABLE IF EXISTS `venda`;

CREATE TABLE `venda` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `cliente_nif` int(11) unsigned DEFAULT NULL,
  `imovel_id` int(11) unsigned DEFAULT NULL,
  `consultor_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_nif` (`cliente_nif`),
  KEY `imovel_id` (`imovel_id`),
  KEY `consultor_id` (`consultor_id`),
  CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`cliente_nif`) REFERENCES `cliente` (`nif`),
  CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`imovel_id`) REFERENCES `imovel` (`id`),
  CONSTRAINT `venda_ibfk_3` FOREIGN KEY (`consultor_id`) REFERENCES `consultor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `venda` WRITE;
/*!40000 ALTER TABLE `venda` DISABLE KEYS */;

INSERT INTO `venda` (`id`, `data`, `cliente_nif`, `imovel_id`, `consultor_id`)
VALUES
	(6,'2022-01-01 00:00:00',1,1,1),
	(7,'2022-02-01 00:00:00',2,2,2),
	(8,'2022-03-01 00:00:00',4,3,3),
	(9,'2022-04-01 00:00:00',3,4,4),
	(10,'2022-05-01 00:00:00',5,5,5);

/*!40000 ALTER TABLE `venda` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

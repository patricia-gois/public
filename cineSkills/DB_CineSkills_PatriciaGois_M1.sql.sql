-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para bdcineskills_patriciagois_n24
DROP DATABASE IF EXISTS `bdcineskills_patriciagois_n24`;
CREATE DATABASE IF NOT EXISTS `bdcineskills_patriciagois_n24` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdcineskills_patriciagois_n24`;

-- A despejar estrutura para tabela bdcineskills_patriciagois_n24.cinema
DROP TABLE IF EXISTS `cinema`;
CREATE TABLE IF NOT EXISTS `cinema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text DEFAULT NULL,
  `local_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cinema_local` (`local_id`),
  CONSTRAINT `FK_cinema_local` FOREIGN KEY (`local_id`) REFERENCES `local` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela bdcineskills_patriciagois_n24.cinema: ~2 rows (aproximadamente)
DELETE FROM `cinema`;
INSERT INTO `cinema` (`id`, `nome`, `local_id`) VALUES
	(1, 'Cinema 1', 2),
	(2, 'Cinema 2', 1),
	(3, 'Cinema 3', 3);

-- A despejar estrutura para tabela bdcineskills_patriciagois_n24.estado
DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela bdcineskills_patriciagois_n24.estado: ~2 rows (aproximadamente)
DELETE FROM `estado`;
INSERT INTO `estado` (`id`, `descricao`) VALUES
	(1, 'Ativa'),
	(2, 'Inativa');

-- A despejar estrutura para tabela bdcineskills_patriciagois_n24.filme
DROP TABLE IF EXISTS `filme`;
CREATE TABLE IF NOT EXISTS `filme` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nome` text DEFAULT NULL,
  `ano` year(4) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `tipo_filme_id` int(100) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_filme_tipo_filme` (`tipo_filme_id`),
  CONSTRAINT `FK_filme_tipo_filme` FOREIGN KEY (`tipo_filme_id`) REFERENCES `tipo_filme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela bdcineskills_patriciagois_n24.filme: ~2 rows (aproximadamente)
DELETE FROM `filme`;
INSERT INTO `filme` (`id`, `nome`, `ano`, `descricao`, `tipo_filme_id`) VALUES
	(5, 'Filme 1', '2014', 'Um filme de ação.', 3),
	(6, 'Filme 2', '2020', 'Um filme romântico.', 2);

-- A despejar estrutura para tabela bdcineskills_patriciagois_n24.local
DROP TABLE IF EXISTS `local`;
CREATE TABLE IF NOT EXISTS `local` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela bdcineskills_patriciagois_n24.local: ~4 rows (aproximadamente)
DELETE FROM `local`;
INSERT INTO `local` (`id`, `descricao`) VALUES
	(1, 'Évora'),
	(2, 'Benavente'),
	(3, 'Montijo'),
	(4, 'Vila Real');

-- A despejar estrutura para tabela bdcineskills_patriciagois_n24.rel_sessoes_salas
DROP TABLE IF EXISTS `rel_sessoes_salas`;
CREATE TABLE IF NOT EXISTS `rel_sessoes_salas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessao_id` int(11) DEFAULT 0,
  `sala_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_rel_sessoes_salas_sessao` (`sessao_id`),
  KEY `FK_rel_sessoes_salas_sala` (`sala_id`),
  CONSTRAINT `FK_rel_sessoes_salas_sala` FOREIGN KEY (`sala_id`) REFERENCES `sala` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rel_sessoes_salas_sessao` FOREIGN KEY (`sessao_id`) REFERENCES `sessao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela bdcineskills_patriciagois_n24.rel_sessoes_salas: ~3 rows (aproximadamente)
DELETE FROM `rel_sessoes_salas`;
INSERT INTO `rel_sessoes_salas` (`id`, `sessao_id`, `sala_id`) VALUES
	(3, 2, 3),
	(5, 1, 2),
	(6, 2, 1),
	(7, 3, 1);

-- A despejar estrutura para tabela bdcineskills_patriciagois_n24.sala
DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  `cinema_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sala_cinema` (`cinema_id`),
  CONSTRAINT `FK_sala_cinema` FOREIGN KEY (`cinema_id`) REFERENCES `cinema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela bdcineskills_patriciagois_n24.sala: ~2 rows (aproximadamente)
DELETE FROM `sala`;
INSERT INTO `sala` (`id`, `descricao`, `cinema_id`) VALUES
	(1, 'Sala com capacidade para 50 pessoas.', 2),
	(2, 'Sala com capacidade para 100 pessoas.', 3),
	(3, 'Sala para 300 pessoas.', 1);

-- A despejar estrutura para tabela bdcineskills_patriciagois_n24.sessao
DROP TABLE IF EXISTS `sessao`;
CREATE TABLE IF NOT EXISTS `sessao` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `filme_id` int(100) DEFAULT 0,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sessao_filme` (`filme_id`),
  KEY `FK_sessao_estado` (`estado_id`),
  CONSTRAINT `FK_sessao_estado` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sessao_filme` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela bdcineskills_patriciagois_n24.sessao: ~3 rows (aproximadamente)
DELETE FROM `sessao`;
INSERT INTO `sessao` (`id`, `filme_id`, `data`, `hora`, `estado_id`) VALUES
	(1, 5, '2025-02-21', '22:00:00', 1),
	(2, 6, '2024-11-01', '16:00:00', 2),
	(3, 5, '2025-05-22', '21:00:00', 1);

-- A despejar estrutura para tabela bdcineskills_patriciagois_n24.tipo_filme
DROP TABLE IF EXISTS `tipo_filme`;
CREATE TABLE IF NOT EXISTS `tipo_filme` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela bdcineskills_patriciagois_n24.tipo_filme: ~4 rows (aproximadamente)
DELETE FROM `tipo_filme`;
INSERT INTO `tipo_filme` (`id`, `descricao`) VALUES
	(1, 'Comédia'),
	(2, 'Romance'),
	(3, 'Ação'),
	(4, 'Aventura'),
	(5, 'Manga');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

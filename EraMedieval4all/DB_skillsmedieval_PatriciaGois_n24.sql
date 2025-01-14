-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para skillsmedieval_patriciagois_n24
DROP DATABASE IF EXISTS `skillsmedieval_patriciagois_n24`;
CREATE DATABASE IF NOT EXISTS `skillsmedieval_patriciagois_n24` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `skillsmedieval_patriciagois_n24`;

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.aluguer
DROP TABLE IF EXISTS `aluguer`;
CREATE TABLE IF NOT EXISTS `aluguer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilizador` int(11) DEFAULT NULL,
  `id_cliente` varchar(20) DEFAULT NULL,
  `datahora` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilizador` (`id_utilizador`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`nif`),
  CONSTRAINT `fk_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.aluguer: ~5 rows (aproximadamente)
INSERT INTO `aluguer` (`id`, `id_utilizador`, `id_cliente`, `datahora`) VALUES
	(1, 1, '123456789', '2024-11-13 14:30:00'),
	(2, 2, '987654321', '2024-11-13 15:00:00'),
	(3, 3, '112233445', '2024-11-13 16:00:00'),
	(4, 4, '998877665', '2024-11-13 17:00:00'),
	(5, 5, '554433221', '2024-11-13 18:00:00');

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.aluguer_groupa
DROP TABLE IF EXISTS `aluguer_groupa`;
CREATE TABLE IF NOT EXISTS `aluguer_groupa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluguer` int(11) NOT NULL,
  `id_groupa` varchar(50) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `data_entrega` datetime NOT NULL,
  `estado` enum('pendente','entregue','devolvido') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aluguer` (`id_aluguer`),
  KEY `id_groupa` (`id_groupa`),
  KEY `id_evento` (`id_evento`),
  CONSTRAINT `fk_aluguer` FOREIGN KEY (`id_aluguer`) REFERENCES `aluguer` (`id`),
  CONSTRAINT `fk_evento` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`),
  CONSTRAINT `fk_groupa` FOREIGN KEY (`id_groupa`) REFERENCES `guarda_roupa` (`ref`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.aluguer_groupa: ~2 rows (aproximadamente)
INSERT INTO `aluguer_groupa` (`id`, `id_aluguer`, `id_groupa`, `id_evento`, `data_entrega`, `estado`) VALUES
	(1, 1, 'GRP001', 1, '2024-11-30 09:00:00', 'pendente'),
	(2, 2, 'GRP002', 2, '2024-12-04 09:00:00', 'pendente');

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.armazem
DROP TABLE IF EXISTS `armazem`;
CREATE TABLE IF NOT EXISTS `armazem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.armazem: ~5 rows (aproximadamente)
INSERT INTO `armazem` (`id`, `nome`) VALUES
	(1, 'Armazém Central'),
	(2, 'Armazém Norte'),
	(3, 'Armazém Sul'),
	(4, 'Armazém Leste'),
	(5, 'Armazém Oeste');

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.cliente
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `nif` varchar(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.cliente: ~7 rows (aproximadamente)
INSERT INTO `cliente` (`nif`, `nome`, `morada`, `email`, `telefone`, `estado`) VALUES
	('', '', '', '', '', ''),
	('112233445', 'Ricardo Gomes', 'Rua Verde, 30', 'ricardo.gomes@cliente.com', '914567890', 'Inativo'),
	('121345', 'bgdfgdf', 'bfsb', 'fgfgf', 'fbvdfb', 'ffdfbdf'),
	('123456789', 'Carlos Oliveira', 'Rua do Sol, 10', 'carlos.oliveira@cliente.com', '912345678', 'Ativo'),
	('554433221', 'Rui Santos', 'Bairro Azul, 50', 'rui.santos@cliente.com', '916789012', 'Ativo'),
	('987654321', 'Joana Almeida', 'Avenida dos Sonhos, 20', 'joana.almeida@cliente.com', '913456789', 'Ativo'),
	('998877665', 'Helena Martins', 'Praça Nova, 40', 'helena.martins@cliente.com', '915678901', 'Ativo');

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.cliente_utilizador
DROP TABLE IF EXISTS `cliente_utilizador`;
CREATE TABLE IF NOT EXISTS `cliente_utilizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` varchar(20) DEFAULT NULL,
  `id_utilizador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_utilizador` (`id_utilizador`),
  CONSTRAINT `cliente_utilizador_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`nif`),
  CONSTRAINT `cliente_utilizador_ibfk_2` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.cliente_utilizador: ~5 rows (aproximadamente)
INSERT INTO `cliente_utilizador` (`id`, `id_cliente`, `id_utilizador`) VALUES
	(1, '123456789', 1),
	(2, '987654321', 2),
	(3, '112233445', 3),
	(4, '998877665', 4),
	(5, '554433221', 5);

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.evento
DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_organizador` varchar(15) NOT NULL,
  `descricao` text NOT NULL,
  `localidade` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_organizador` (`id_organizador`),
  CONSTRAINT `fk_organizador` FOREIGN KEY (`id_organizador`) REFERENCES `organizador` (`nif`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.evento: ~2 rows (aproximadamente)
INSERT INTO `evento` (`id`, `id_organizador`, `descricao`, `localidade`, `titulo`, `data_inicio`, `data_fim`, `facebook`, `instagram`, `tiktok`) VALUES
	(1, '123456789', 'Evento medieval com shows e apresentações', 'Lisboa', 'Feira Medieval', '2024-12-01', '2024-12-01', 'facebook.com/feiramedieval', 'instagram.com/feiramedieval', 'tiktok.com/feiramedieval'),
	(2, '987654321', 'Festival de música medieval ao ar livre', 'Porto', 'Festival Medieval', '2024-12-05', '2024-12-05', 'facebook.com/festivalmedieval', 'instagram.com/festivalmedieval', 'tiktok.com/festivalmedieval');

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.guarda_roupa
DROP TABLE IF EXISTS `guarda_roupa`;
CREATE TABLE IF NOT EXISTS `guarda_roupa` (
  `ref` varchar(50) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `estado` enum('disponível','indisponível') NOT NULL,
  `valor` float NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_armazem` int(11) NOT NULL,
  PRIMARY KEY (`ref`),
  KEY `fk_tipo_groupa` (`id_tipo`),
  KEY `fk_armazem` (`id_armazem`),
  CONSTRAINT `fk_armazem` FOREIGN KEY (`id_armazem`) REFERENCES `armazem` (`id`),
  CONSTRAINT `fk_tipo_groupa` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_groupa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.guarda_roupa: ~6 rows (aproximadamente)
INSERT INTO `guarda_roupa` (`ref`, `nome`, `estado`, `valor`, `imagem`, `id_tipo`, `id_armazem`) VALUES
	('egher', 'retyre', 'disponível', 543, 'traje20241114114400.png', 1, 1),
	('GRP001', 'Armadura Completa de Cavaleiro', 'disponível', 1500, 'traje20241114114400.png', 1, 1),
	('GRP002', 'Veste de Nobre Medieval', 'disponível', 800, 'traje20241114114400.png', 2, 2),
	('GRP003', 'Traje de Camponês', 'indisponível', 150, 'traje20241114114400.png', 3, 3),
	('GRP004', 'Roupa de Mercador', 'disponível', 200, 'traje20241114114400.png', 4, 4),
	('GRP005', 'Vestuário de Clérigo', 'disponível', 500, 'traje20241114114400.png', 5, 5);

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.login
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horaLogin` datetime NOT NULL,
  `horaLogout` datetime DEFAULT NULL,
  `id_utilizador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilizador` (`id_utilizador`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.login: ~8 rows (aproximadamente)
INSERT INTO `login` (`id`, `horaLogin`, `horaLogout`, `id_utilizador`) VALUES
	(1, '2024-11-13 08:00:00', '2024-11-13 17:00:00', 1),
	(2, '2024-11-13 09:00:00', '2024-11-13 18:00:00', 2),
	(3, '2024-11-13 10:00:00', '2024-11-13 19:00:00', 3),
	(4, '2024-11-13 11:00:00', '2024-11-13 20:00:00', 4),
	(5, '2024-11-13 12:00:00', '2024-11-13 21:00:00', 5),
	(6, '2024-11-13 17:31:12', '2024-11-13 17:33:33', 6),
	(7, '2024-11-13 17:33:44', '2024-11-13 17:36:20', 6),
	(8, '2024-11-13 17:33:57', '2024-11-13 17:36:20', 6);

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.organizador
DROP TABLE IF EXISTS `organizador`;
CREATE TABLE IF NOT EXISTS `organizador` (
  `nif` varchar(15) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `localidade` varchar(255) NOT NULL,
  `id_tipo_organizador` int(11) NOT NULL,
  PRIMARY KEY (`nif`),
  KEY `id_tipo_organizador` (`id_tipo_organizador`),
  CONSTRAINT `fk_tipo_organizador` FOREIGN KEY (`id_tipo_organizador`) REFERENCES `tipo_organizador` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.organizador: ~5 rows (aproximadamente)
INSERT INTO `organizador` (`nif`, `nome`, `localidade`, `id_tipo_organizador`) VALUES
	('123456789', 'Feiras', 'Lisboa', 1),
	('321654987', 'Workshops', 'Aveiro', 5),
	('456123789', 'Concertos', 'Coimbra', 3),
	('789321456', 'Empresarial', 'Braga', 4),
	('987654321', 'Festivais', 'Porto', 2);

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.tipo_groupa
DROP TABLE IF EXISTS `tipo_groupa`;
CREATE TABLE IF NOT EXISTS `tipo_groupa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.tipo_groupa: ~5 rows (aproximadamente)
INSERT INTO `tipo_groupa` (`id`, `descricao`) VALUES
	(1, 'Armaduras de Cavaleiro'),
	(2, 'Vestes de Nobreza'),
	(3, 'Trajes de Camponeses'),
	(4, 'Roupas de Mercador'),
	(5, 'Vestuário de Clérigos');

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.tipo_organizador
DROP TABLE IF EXISTS `tipo_organizador`;
CREATE TABLE IF NOT EXISTS `tipo_organizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.tipo_organizador: ~5 rows (aproximadamente)
INSERT INTO `tipo_organizador` (`id`, `descricao`) VALUES
	(1, 'Feiras'),
	(2, 'Festivais'),
	(3, 'Concertos'),
	(4, 'Eventos Empresariais'),
	(5, 'Workshops');

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.tipo_user
DROP TABLE IF EXISTS `tipo_user`;
CREATE TABLE IF NOT EXISTS `tipo_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.tipo_user: ~5 rows (aproximadamente)
INSERT INTO `tipo_user` (`id`, `descricao`) VALUES
	(1, 'Administrador'),
	(2, 'Cliente'),
	(3, 'Funcionário'),
	(4, 'Gestor'),
	(5, 'Super Usuário');

-- A despejar estrutura para tabela skillsmedieval_patriciagois_n24.utilizador
DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `tentativas_login` int(11) DEFAULT NULL,
  `conta_bloqueada` enum('blocked','ok') DEFAULT NULL,
  `status_login` enum('ativo','inativo') DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  KEY `id_tipo` (`id_tipo`),
  CONSTRAINT `utilizador_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela skillsmedieval_patriciagois_n24.utilizador: ~7 rows (aproximadamente)
INSERT INTO `utilizador` (`id`, `nome`, `morada`, `telefone`, `email`, `password`, `id_tipo`, `foto`, `tentativas_login`, `conta_bloqueada`, `status_login`) VALUES
	(1, 'Patrícia Gois', 'Rua da Alegria, 123', '912345678', 'patricia@exemplo.com', 'senha123', 1, 'patricia.jpg', 0, 'ok', 'ativo'),
	(2, 'João Silva', 'Avenida Central, 456', '913456789', 'joao@exemplo.com', 'senha456', 2, 'joao.jpg', 1, 'ok', 'ativo'),
	(3, 'Maria Costa', 'Rua Nova, 789', '914567890', 'maria@exemplo.com', 'senha789', 3, 'maria.jpg', 3, 'blocked', 'inativo'),
	(4, 'Carlos Pereira', 'Praça das Flores, 321', '915678901', 'carlos@exemplo.com', 'senha321', 2, 'carlos.jpg', 2, 'ok', 'ativo'),
	(5, 'Ana Sousa', 'Bairro Alto, 654', '916789012', 'ana@exemplo.com', 'senha654', 4, 'ana.jpg', 0, 'ok', 'ativo'),
	(6, 'pat', 'pat', 'pat', 'pat', 'k/vWbz1gWm6Cn/uQYu2Vzw==', 1, 'assets/img/user/user.webp', 0, 'ok', 'ativo'),
	(7, 'user', 'user', 'user', 'user', 'ncGXn+SYGLIAcOcnC+ZH/w==', 1, 'assets/img/user/user.webp', 3, 'blocked', 'ativo');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

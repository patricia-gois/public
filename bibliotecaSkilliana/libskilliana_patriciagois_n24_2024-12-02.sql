# ************************************************************
# Sequel Pro SQL dump
# Versão 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Base de Dados: libskilliana_patriciagois_n24
# Tempo de Geração: 2024-12-02 23:58:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela autores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `autores`;

CREATE TABLE `autores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `datanasc` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `infoextra` text DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `instragam` varchar(200) DEFAULT NULL,
  `x` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;

INSERT INTO `autores` (`id`, `nome`, `datanasc`, `bio`, `infoextra`, `facebook`, `instragam`, `x`)
VALUES
	(1,'José Saramago','1922-11-16','Escritor português, Nobel da Literatura.','Autor de Ensaio sobre a Cegueira.','facebook.com/saramago','instagram.com/saramago','twitter.com/saramago'),
	(2,'Fernando Pessoa','1888-06-13','Um dos maiores poetas da língua portuguesa.','Criador dos heterónimos.',NULL,NULL,NULL),
	(3,'Eça de Queirós','1845-11-25','Romancista, considerado um dos maiores escritores realistas de Portugal.',NULL,NULL,NULL,NULL),
	(4,'Sophia de Mello Breyner Andresen','1919-11-06','Poetisa portuguesa de grande renome.','Autora de Contos Exemplares.',NULL,NULL,NULL),
	(5,'Camilo Castelo Branco','1825-03-16','Romancista prolífico, autor de Amor de Perdição.',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela collaborators
# ------------------------------------------------------------

DROP TABLE IF EXISTS `collaborators`;

CREATE TABLE `collaborators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `morada` varchar(200) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `numfunc` varchar(200) DEFAULT NULL,
  `numcc` int(11) NOT NULL,
  `datanasc` date DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tipo_utilizador` (`id_tipo`),
  CONSTRAINT `FK_tipo_utilizador` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `collaborators` WRITE;
/*!40000 ALTER TABLE `collaborators` DISABLE KEYS */;

INSERT INTO `collaborators` (`id`, `nome`, `morada`, `telefone`, `email`, `numfunc`, `numcc`, `datanasc`, `id_tipo`)
VALUES
	(1,'Ricardo Gonçalves','Rua do Norte, 32, Lisboa','919876543','ricardo.goncalves@mail.com','001',14896721,'1982-02-15',1),
	(2,'Teresa Magalhães','Rua da Alegria, 67, Porto','912345678','teresa.magalhaes@mail.com','002',14896722,'1978-04-30',2),
	(3,'Luís Neves','Avenida de Roma, 120, Lisboa','917654321','luis.neves@mail.com','003',12345678,'1985-09-10',3),
	(4,'Inês Figueiredo','Rua do Carmo, 10, Coimbra','913456789','ines.figueiredo@mail.com','004',22222222,'1990-07-22',4),
	(5,'Paulo Sousa','Largo do Calhariz, 22, Faro','916789012','paulo.sousa@mail.com','005',44444444,'1992-11-12',5),
	(7,'Miguel Moura','Santo Estêvão','962847562','miguel@email.pt','005',63857297,'1995-08-31',2),
	(8,'Luisa Almeida','Mata do Duque','928475826','luisa@email.pt','007',72649582,'1996-05-12',4),
	(10,'André Ramalho','Couço','915927103','andre@email.pt','008',1638475,'1993-01-18',3),
	(13,'Ana Isabel','Santo Estêvão','937462749','belinha@email.pt','012',18378475,'1965-06-04',1);

/*!40000 ALTER TABLE `collaborators` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela emprestimo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `emprestimo`;

CREATE TABLE `emprestimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_registo` date DEFAULT NULL,
  `data_entrega` date DEFAULT NULL,
  `id_utilizador` int(11) DEFAULT NULL,
  `id_socio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_utilizador` (`id_utilizador`),
  KEY `FK_socio` (`id_socio`),
  CONSTRAINT `FK_socio` FOREIGN KEY (`id_socio`) REFERENCES `socio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `collaborators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `emprestimo` WRITE;
/*!40000 ALTER TABLE `emprestimo` DISABLE KEYS */;

INSERT INTO `emprestimo` (`id`, `data_registo`, `data_entrega`, `id_utilizador`, `id_socio`)
VALUES
	(1,'2024-01-10','2024-01-20',1,1),
	(2,'2024-02-15','2024-02-25',2,2),
	(3,'2024-03-01','2024-03-10',3,3),
	(4,'2024-03-20','2024-03-30',4,4),
	(5,'2024-04-05','2024-04-15',5,5),
	(7,'2024-12-02','2024-12-04',10,21);

/*!40000 ALTER TABLE `emprestimo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela estante
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estante`;

CREATE TABLE `estante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  `id_seccao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_seccao` (`id_seccao`),
  CONSTRAINT `FK_seccao` FOREIGN KEY (`id_seccao`) REFERENCES `seccao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `estante` WRITE;
/*!40000 ALTER TABLE `estante` DISABLE KEYS */;

INSERT INTO `estante` (`id`, `descricao`, `id_seccao`)
VALUES
	(1,'Estante A1',1),
	(2,'Estante B2',2),
	(3,'Estante C3',3),
	(4,'Estante D4',4),
	(5,'Estante E5',5);

/*!40000 ALTER TABLE `estante` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela livro_emprestimo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `livro_emprestimo`;

CREATE TABLE `livro_emprestimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_emprestimo` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_emprestimo` (`id_emprestimo`),
  KEY `FK_livro_emprestimo_livros` (`id_livro`),
  CONSTRAINT `FK_emprestimo` FOREIGN KEY (`id_emprestimo`) REFERENCES `emprestimo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_livro_emprestimo_livros` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `livro_emprestimo` WRITE;
/*!40000 ALTER TABLE `livro_emprestimo` DISABLE KEYS */;

INSERT INTO `livro_emprestimo` (`id`, `id_emprestimo`, `id_livro`)
VALUES
	(1,1,1),
	(2,2,2),
	(3,3,3),
	(4,4,4),
	(5,5,5),
	(7,7,2);

/*!40000 ALTER TABLE `livro_emprestimo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela livro_estante
# ------------------------------------------------------------

DROP TABLE IF EXISTS `livro_estante`;

CREATE TABLE `livro_estante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livro` int(11) DEFAULT NULL,
  `id_estante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_livro_estante_livros` (`id_livro`),
  KEY `FK_livro_estante_estante` (`id_estante`),
  CONSTRAINT `FK_livro_estante_estante` FOREIGN KEY (`id_estante`) REFERENCES `estante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_livro_estante_livros` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `livro_estante` WRITE;
/*!40000 ALTER TABLE `livro_estante` DISABLE KEYS */;

INSERT INTO `livro_estante` (`id`, `id_livro`, `id_estante`)
VALUES
	(1,1,1),
	(2,2,2),
	(3,3,3),
	(4,4,4),
	(5,5,5);

/*!40000 ALTER TABLE `livro_estante` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela livros
# ------------------------------------------------------------

DROP TABLE IF EXISTS `livros`;

CREATE TABLE `livros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `isbn` varchar(200) DEFAULT NULL,
  `sinopse` text DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `datalanc` date DEFAULT NULL,
  `edicao` varchar(200) DEFAULT NULL,
  `editora` varchar(200) DEFAULT NULL,
  `idioma` varchar(200) DEFAULT NULL,
  `qtdpaginas` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;

INSERT INTO `livros` (`id`, `titulo`, `isbn`, `sinopse`, `qtd`, `datalanc`, `edicao`, `editora`, `idioma`, `qtdpaginas`, `estado`)
VALUES
	(1,'O Ano da Morte de Ricardo Reis','9789722040125','Romance sobre o heterónimo de Fernando Pessoa.',5,'1984-01-01','1ª Edição','Caminho','Português',400,1),
	(2,'Os Maias','9789725646447','Clássico da literatura portuguesa que retrata a decadência da aristocracia.',3,'1888-01-01','1ª Edição','Livraria Lello','Português',800,1),
	(3,'A Jangada de Pedra','9789722040156','Romance que aborda a separação da Península Ibérica.',4,'1986-01-01','1ª Edição','Caminho','Português',500,1),
	(4,'Memorial do Convento','9789722040170','Romance sobre a construção do Convento de Mafra.',6,'1982-01-01','1ª Edição','Caminho','Português',600,1),
	(5,'Ensaio sobre a Cegueira','9789722040187','Romance distópico sobre uma epidemia de cegueira.',5,'1995-01-01','1ª Edição','Caminho','Português',300,0);

/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela livros_autores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `livros_autores`;

CREATE TABLE `livros_autores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livro` int(11) DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_livros` (`id_livro`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `FK_livros` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_autor` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `livros_autores` WRITE;
/*!40000 ALTER TABLE `livros_autores` DISABLE KEYS */;

INSERT INTO `livros_autores` (`id`, `id_livro`, `id_autor`)
VALUES
	(1,1,1),
	(2,2,3),
	(3,3,1),
	(4,4,1),
	(5,5,1);

/*!40000 ALTER TABLE `livros_autores` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela livros_tipo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `livros_tipo`;

CREATE TABLE `livros_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_livros_tipo_tipo_livro` (`id_tipo`),
  KEY `FK_livros_tipo_livros` (`id_livro`),
  CONSTRAINT `FK_livros_tipo_livros` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_livros_tipo_tipo_livro` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_livro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `livros_tipo` WRITE;
/*!40000 ALTER TABLE `livros_tipo` DISABLE KEYS */;

INSERT INTO `livros_tipo` (`id`, `id_tipo`, `id_livro`)
VALUES
	(1,1,1),
	(2,1,2),
	(3,1,3),
	(4,1,4),
	(5,1,5);

/*!40000 ALTER TABLE `livros_tipo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_origem` varchar(45) NOT NULL,
  `estado` enum('sucesso','falha','conta_bloqueada') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_login_attempts_user` (`username`),
  CONSTRAINT `fk_login_attempts_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;

INSERT INTO `login_attempts` (`id`, `username`, `hora`, `ip_origem`, `estado`)
VALUES
	(16,'pat','2024-11-03 22:26:24','::1','falha'),
	(17,'pat','2024-11-03 22:26:45','::1','falha'),
	(18,'pat','2024-11-03 22:29:24','::1','sucesso'),
	(19,'pat','2024-11-03 22:30:21','::1','falha'),
	(20,'patricia','2024-11-03 22:38:46','::1','sucesso'),
	(21,'patricia','2024-11-06 14:14:38','::1','falha'),
	(22,'patricia','2024-11-06 14:15:00','::1','falha'),
	(23,'patricia','2024-11-06 14:15:05','::1','conta_bloqueada'),
	(24,'admin','2024-11-06 14:15:47','::1','sucesso'),
	(25,'admin','2024-11-06 20:16:52','::1','sucesso'),
	(26,'admin','2024-11-06 20:16:55','::1','sucesso'),
	(27,'patricia','2024-11-07 15:48:07','::1','conta_bloqueada'),
	(28,'patriciagois','2024-12-02 21:38:34','::1','sucesso'),
	(29,'patriciagois','2024-12-02 21:53:24','::1','sucesso'),
	(30,'patriciagois','2024-12-02 23:45:52','::1','sucesso'),
	(31,'patriciagois','2024-12-02 23:49:24','::1','sucesso');

/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela seccao
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seccao`;

CREATE TABLE `seccao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `seccao` WRITE;
/*!40000 ALTER TABLE `seccao` DISABLE KEYS */;

INSERT INTO `seccao` (`id`, `descricao`)
VALUES
	(1,'Literatura'),
	(2,'Ciências'),
	(3,'Tecnologia'),
	(4,'Artes'),
	(5,'História');

/*!40000 ALTER TABLE `seccao` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela socio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `socio`;

CREATE TABLE `socio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `cc` varchar(200) DEFAULT NULL,
  `numsocio` varchar(200) DEFAULT NULL,
  `morada` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `datanasc` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `socio` WRITE;
/*!40000 ALTER TABLE `socio` DISABLE KEYS */;

INSERT INTO `socio` (`id`, `nome`, `cc`, `numsocio`, `morada`, `email`, `telefone`, `datanasc`, `estado`)
VALUES
	(1,'Ana Maria Silva','12345678','001','Rua das Flores, 123, Lisboa','ana.silva@mail.com','912345678','1980-01-23',1),
	(2,'João Manuel Pereira','87654321','002','Avenida da Liberdade, 45, Porto','joao.pereira@mail.com','917654321','1975-07-10',0),
	(3,'Carla Ferreira','11223344','003','Rua do Sol, 88, Coimbra','carla.ferreira@mail.com','913214567','1985-03-15',1),
	(4,'Pedro Mendes','44332211','004','Rua das Laranjeiras, 99, Faro','pedro.mendes@mail.com','911122334','1990-11-05',1),
	(5,'Maria João Costa','55667788','005','Praça da República, 101, Braga','maria.costa@mail.com','914567890','1995-06-20',1),
	(21,'patixaaa','4353535','232','dfgerg','erg','3423','2024-12-03',0);

/*!40000 ALTER TABLE `socio` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela tipo_livro
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_livro`;

CREATE TABLE `tipo_livro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tipo_livro` WRITE;
/*!40000 ALTER TABLE `tipo_livro` DISABLE KEYS */;

INSERT INTO `tipo_livro` (`id`, `descricao`)
VALUES
	(1,'Romance'),
	(2,'Ficção Científica'),
	(3,'História'),
	(4,'Poesia'),
	(5,'Ensaios');

/*!40000 ALTER TABLE `tipo_livro` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela tipo_utilizador
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipo_utilizador`;

CREATE TABLE `tipo_utilizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tipo_utilizador` WRITE;
/*!40000 ALTER TABLE `tipo_utilizador` DISABLE KEYS */;

INSERT INTO `tipo_utilizador` (`id`, `descricao`)
VALUES
	(1,'Bibliotecário'),
	(2,'Assistente de biblioteca'),
	(3,'Administrador'),
	(4,'Gestor de coleções'),
	(5,'Utilizador comum');

/*!40000 ALTER TABLE `tipo_utilizador` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `pw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tentativas_login` int(11) NOT NULL DEFAULT 0,
  `conta_bloqueada` tinyint(4) DEFAULT NULL,
  `pergunta` varchar(255) DEFAULT NULL,
  `resposta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `id_tipo` (`id_tipo`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_utilizador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`username`, `pw`, `id_tipo`, `foto`, `tentativas_login`, `conta_bloqueada`, `pergunta`, `resposta`)
VALUES
	('admin','1v+mnRX7074764Ji0aBLHg==',3,'assets/img/user/user.webp',0,0,NULL,NULL),
	('pat','moj29EMc8R3RW3qweyzyiA==',3,'assets/img/user/user.webp',1,0,NULL,NULL),
	('patricia','WVGBxE1qj/3mPMsycTtrYQ==',3,'assets/img/user/user.webp',3,1,NULL,NULL),
	('patriciagois','1v+mnRX7074764Ji0aBLHg==',3,'assets/img/user/user.webp',0,0,'1','Florinda');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

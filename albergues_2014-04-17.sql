# ************************************************************
# Sequel Pro SQL dump
# Versión 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.17-debug)
# Base de datos: albergues
# Tiempo de Generación: 2014-04-17 20:01:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla albergue
# ------------------------------------------------------------

CREATE TABLE `albergue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `domicilio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `albergue` WRITE;
/*!40000 ALTER TABLE `albergue` DISABLE KEYS */;

INSERT INTO `albergue` (`id`, `nombre`, `domicilio`)
VALUES
	(1,'Escuela Roma',1),
	(2,'Juan Bosco',1);

/*!40000 ALTER TABLE `albergue` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla caso
# ------------------------------------------------------------

CREATE TABLE `caso` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `objetivos` text,
  `observaciones` text,
  `fecha_apertura` date DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `encargado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla categoria_item
# ------------------------------------------------------------

CREATE TABLE `categoria_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla domicilio
# ------------------------------------------------------------

CREATE TABLE `domicilio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `calle` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `depto` varchar(255) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL COMMENT 'o cerro',
  `observaciones` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `domicilio` WRITE;
/*!40000 ALTER TABLE `domicilio` DISABLE KEYS */;

INSERT INTO `domicilio` (`id`, `calle`, `numero`, `depto`, `sector`, `observaciones`)
VALUES
	(1,'Alfonso Lopez',1534,NULL,'El sol','Entre San martín y peyronet');

/*!40000 ALTER TABLE `domicilio` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla estados
# ------------------------------------------------------------

CREATE TABLE `estados` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;

INSERT INTO `estados` (`id`, `nombre`, `activo`)
VALUES
	(1,'Lactancia',1),
	(2,'Embarazo',1),
	(3,'Madre',1);

/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla evento
# ------------------------------------------------------------

CREATE TABLE `evento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_caso` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla familia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `familia`;

CREATE TABLE `familia` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `id_domicilio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `familia` WRITE;
/*!40000 ALTER TABLE `familia` DISABLE KEYS */;

INSERT INTO `familia` (`id`, `apellido_paterno`, `apellido_materno`, `id_domicilio`)
VALUES
	(1,'Solar','Fernandez',1);

/*!40000 ALTER TABLE `familia` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla item
# ------------------------------------------------------------

CREATE TABLE `item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla personas
# ------------------------------------------------------------

CREATE TABLE `personas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `estado_civil` varchar(255) DEFAULT NULL,
  `rut` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL COMMENT 'lactancia, embarazo, etc',
  `activo` int(2) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `familia` int(11) DEFAULT NULL,
  `tipo_familia` varchar(255) DEFAULT NULL COMMENT 'mama, hijo, etc',
  `observacion` text,
  `pariente` int(11) DEFAULT NULL,
  `domicilio` int(11) DEFAULT NULL,
  `sexo` int(2) DEFAULT NULL,
  `albergue` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;

INSERT INTO `personas` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `estado_civil`, `rut`, `estado`, `activo`, `fecha_ingreso`, `familia`, `tipo_familia`, `observacion`, `pariente`, `domicilio`, `sexo`, `albergue`)
VALUES
	(1,'Hugo','Solar','Rivas','1983-07-31','soltero','15.449.532-0',NULL,1,'2014-04-16',1,'1',NULL,0,1,2,1);

/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

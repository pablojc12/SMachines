-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2015 a las 05:17:45
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE IF NOT EXISTS `autos` (
  `id_auto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(30) NOT NULL,
  `modelo` int(11) NOT NULL,
  `submarca` varchar(30) NOT NULL,
  PRIMARY KEY (`id_auto`),
  UNIQUE KEY `id_auto` (`id_auto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `id_cita` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `correo` varchar(25) NOT NULL,
  `servicio` varchar(200) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `modelo` int(11) NOT NULL,
  `submarca` varchar(30) NOT NULL,
  PRIMARY KEY (`id_cita`),
  UNIQUE KEY `id_cita` (`id_cita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `correo`, `servicio`, `fecha`, `marca`, `modelo`, `submarca`) VALUES
(1, 'Cambio de Aceite de Motor', 'and@hotmail.com', '2015-03-18', 'Mercedes Benz', 0, '1123'),
(2, 'Sistemas de enfriamiento', 'and@hotmail.com', '2015-03-01', 'Honda', 0, '1999'),
(3, 'Verificaciones', 'and@hotmail.com', '2015-03-28', 'Audi', 1999, 'chevy'),
(4, 'Cambio de Aceite de Motor', 'asdasd', '2015-03-10', 'Jeep', 123, 'adsad'),
(5, 'usuario@hotmail.com', 'Cambio de Aceite de Motor', '2015-03-22', 'Audi', 1999, 'chevy'),
(6, 'ala', 'caca', '2015-03-22', 'Jeep', 1998, 'chevy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `correo` varchar(30) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `paterno` varchar(20) NOT NULL,
  `materno` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `id_cliente` (`id_cliente`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `correo`, `nombre`, `paterno`, `materno`, `telefono`, `direccion`, `password`) VALUES
(10, 'aldjalkdsj', 'panchito', 'alkdlak', 'lakdjaslkjd', 'djakldsjk', 'daklsjd', 'ldakjdaskd'),
(14, 'lupe@hotmail.com', 'lupe', 'zamuio', 'lopez', '8192783721', 'los heroes', '9876543'),
(15, '@modofoker', 'campechano', 'alkd', 'asdÃ±lk', 'aslkdja', 'los heroes', '1231231'),
(16, 'karen@aklsdj', 'andresito', 'zamudio', 'zlaÃ±sd', '556', 'canal', '67788'),
(17, 'jose@hotmail.com', 'josue', 'lopez', 'perez', '728364764', 'neza', '1234'),
(18, '', '', '', '', '', '', ''),
(24, 'jghgjhghg', '', '', '', '', '', ''),
(25, 'lala', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `paterno` varchar(20) NOT NULL,
  `materno` varchar(20) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `curp` varchar(30) NOT NULL,
  `rfc` varchar(15) NOT NULL,
  `civil` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `contrasena` varchar(10) NOT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `id_empleado` (`id_empleado`),
  UNIQUE KEY `curp` (`curp`,`rfc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `paterno`, `materno`, `direccion`, `curp`, `rfc`, `civil`, `telefono`, `contrasena`) VALUES
(4, 'fabian', 'lopez', 'guerrero', 'hidalgo', 'FABGJKAS', 'FAB35', 'casado', '123213', '9090'),
(9, 'juan', 'aÃ±lskd', 'Ã±asldk', 'Ã±asldk', 'Ã±asldkasd', 'aÃ±sdlk', 'Casad@', '123123', '2344'),
(10, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_mensaje` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `correo` varchar(30) NOT NULL,
  `asunto` varchar(20) NOT NULL,
  `mensaje` varchar(450) NOT NULL,
  PRIMARY KEY (`id_mensaje`),
  UNIQUE KEY `id_mensaje` (`id_mensaje`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `correo`, `asunto`, `mensaje`) VALUES
(1, 'juancho@hotmail.com', 'ninguno', 'no tengo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `id_servicio` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(200) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`id_servicio`),
  UNIQUE KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `tipo`, `descripcion`, `precio`) VALUES
(2, 'llantas', 'cambio de llantas', 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `id_cliente` varchar(30) NOT NULL,
  PRIMARY KEY (`id_venta`),
  UNIQUE KEY `id_vente` (`id_venta`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_empleado`, `id_cliente`) VALUES
(2, 29, 'andres@@@@');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

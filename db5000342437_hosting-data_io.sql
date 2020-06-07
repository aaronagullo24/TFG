-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: db5000342437.hosting-data.io
-- Tiempo de generación: 06-06-2020 a las 15:16:53
-- Versión del servidor: 5.7.30-log
-- Versión de PHP: 7.0.33-0+deb9u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbs332813`
--
DROP DATABASE IF EXISTS `dbs332813`;
CREATE DATABASE IF NOT EXISTS `dbs332813` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbs332813`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_administrador` int(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_administrador`, `correo`, `nombre`, `password`) VALUES
(1, 'aaron@admin.com', 'aaron', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendarios`
--

CREATE TABLE `calendarios` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '1',
  `id_voluntario` int(11) NOT NULL,
  `id_dependiente` int(11) NOT NULL,
  `color` varchar(200) NOT NULL,
  `Detalles` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calendarios`
--

INSERT INTO `calendarios` (`id`, `title`, `start`, `end`, `editable`, `id_voluntario`, `id_dependiente`, `color`, `Detalles`) VALUES
(12, 'hola', '2020-04-01 00:00:00', '2020-04-01 00:00:00', 11, 12, 29, '#000000', ''),
(13, 'ducha', '2020-05-02 12:00:00', '2020-05-02 13:00:00', 11, 27, 36, '#000000', ''),
(62, 'ffff', '2020-05-08 00:00:00', '0000-00-00 00:00:00', 11, 38, 42, '#000000', 'hhh'),
(63, 'correo', '2020-05-05 00:00:00', '2020-01-01 04:01:00', 11, 38, 42, '#ff0000', ''),
(64, 'cooreo doble', '2020-05-06 00:00:00', '2020-01-01 00:00:00', 11, 38, 42, '#000000', ''),
(65, 'correo dependiente', '2020-05-09 00:00:00', '2020-05-09 00:00:00', 11, 38, 42, '#000000', ''),
(93, 'prueba', '2020-05-25 08:47:00', '2020-05-25 11:47:00', 11, 52, 54, '#54b14e', 'hola buenos dias'),
(94, 'prueba admin', '2020-05-25 00:00:00', '2020-05-26 02:00:00', 11, 52, 54, '#ffff00', ''),
(95, 'a', '2020-05-18 00:00:00', '2020-05-22 00:00:00', 11, 52, 54, '#95974e', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id` int(11) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `mensaje` varchar(200) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_chat` int(11) NOT NULL,
  `Leido` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `Nombre`, `mensaje`, `fecha`, `id_chat`, `Leido`) VALUES
(54, 'aaron@admin.com', 'hola buenos dias', '2020-05-25 08:46:36', 240, 'leido'),
(65, 'aaron@admin.com', 'hola soy el administrador', '2020-06-04 15:08:51', 262, 'leido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependiente`
--

CREATE TABLE `dependiente` (
  `Password` varchar(20) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Numero_socio` int(11) NOT NULL,
  `Provincia` varchar(50) DEFAULT NULL,
  `Localidad` varchar(50) DEFAULT NULL,
  `Fecha_nacimiento` varchar(30) DEFAULT NULL,
  `Necesidad` varchar(200) DEFAULT NULL,
  `voluntario` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dependiente`
--

INSERT INTO `dependiente` (`Password`, `Nombre`, `Correo`, `Numero_socio`, `Provincia`, `Localidad`, `Fecha_nacimiento`, `Necesidad`, `voluntario`) VALUES
('1234', 'aaron prueba2', 'aaron@dependiente.com', 29, 'Badajoz', 'Acedera', '2020-12-29', 'hola buenos dias XML ', '12'),
('123', 'sheri@dependiente.com', 'sheri@dependiente.com', 30, 'Alava', 'Abetxuko', '2020-12-01', 'hola', '13'),
('123', 'prueba', 'prueba@prueba.com', 31, 'Alava', 'Abetxuko', '2020-12-31', 'necesito que me curen', '19'),
('123', 'Aaron 111', 'aaron2@hotmail.com', 33, 'Granada', 'Melegis', '2020-12-31', 'necesito ayuda para todo hhy\n', ''),
('123', 'Manolo Prueba', 'manolo@dependiente.com', 34, 'Alava', 'Abetxuko', '2020-04-29', 'Hola buenas necesito alguien que me cuide', '23'),
('123', 'jesus', 'jesus2@dependiente.com', 35, 'Albacete', 'Elx/elche', '2020-04-03', 'Necesito ayuda', '48'),
('123', 'Javi Dependiente', 'Javi@dependiente.com', 36, 'Albacete', 'Elx/elche', '2020-04-29', 'Hola', '27'),
('123', 'prueba', 'prueba2@prueba.com', 37, 'Albacete', 'Elx/elche', '2020-04-10', 'sssss', NULL),
('123', 'PruebaXML', 'prueba@XML.com', 38, '03', 'Elx/elche', '2016-12-31', 'XML', NULL),
('123', 'aaron121', '123@123.com', 46, 'Girona', 'Arcs, Els', '2020-01-01', 'qw', NULL),
('123', 'aaron', 'prueba@d.com', 47, 'Alava', 'Abetxuko', '2020-01-01', '123', NULL),
('123', 'prueba', 'pruebaa@prueba.com', 48, 'Alicante', 'Elx/elche', '2020-01-01', '11', NULL),
('123', 'dependiente', 'dependiente@dependiente.com', 50, 'Burgos', 'Aforados De Moneo', '0001-01-01', 'qwe', NULL),
('123', 'aaron123', 'aaronq@gmail.com', 51, 'Cuenca', 'Arandilla Del Arroyo', '2020-04-30', 'hola buenos dias', NULL),
('123', 'dependiente prueba', 'dependiente@d.com', 52, 'Alava', 'Abetxuko', '2020-01-01', 'hola', '51'),
('123', 'tiempo dependiente', 'tiempo_dependiente@gmail.com', 54, 'Alicante', 'Elx/elche', '2020-01-01', 'hola', '52'),
('123', 'aaron dependiente', 'aaron_agullo22@hotmail.com', 56, 'Alicante', 'Elx/elche', '2020-01-01', 'estoy malo', '58'),
('123', 'Aaron Dependiente', 'aaron_@hotmial.com', 57, 'Alicante', 'Elx/elche', '2020-04-02', 'Necesito ayuda', NULL),
('123', 'mmm', 'mm@mm.com', 58, 'Castellon', 'Ain', '', '22', NULL),
('123', 'aaron dependiente1', 'aaron_agullo@hotmail.com', 65, 'Alicante', 'Elx/elche', '1997-12-11', 'Necesito ayuda', '70');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parejas`
--

CREATE TABLE `parejas` (
  `id_dependientes` int(11) DEFAULT NULL,
  `id_voluntario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parejas`
--

INSERT INTO `parejas` (`id_dependientes`, `id_voluntario`) VALUES
(34, 23),
(36, 27),
(29, 12),
(31, 19),
(52, 51),
(35, 48),
(54, 52),
(33, 13),
(56, 58),
(30, 13),
(65, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `voluntario` int(11) NOT NULL,
  `dependiente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`voluntario`, `dependiente`) VALUES
(24, 31),
(28, 31),
(40, 39),
(45, 35),
(12, 29),
(25, 29),
(55, 30),
(55, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voluntario`
--

CREATE TABLE `voluntario` (
  `Nombre` varchar(100) NOT NULL,
  `Titulacion` varchar(100) NOT NULL,
  `Numero_socio` int(100) NOT NULL,
  `Password` varchar(11) DEFAULT NULL,
  `Correo` varchar(50) NOT NULL,
  `descripcion` varchar(5000) NOT NULL,
  `experiencia` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `voluntario`
--

INSERT INTO `voluntario` (`Nombre`, `Titulacion`, `Numero_socio`, `Password`, `Correo`, `descripcion`, `experiencia`) VALUES
('aaron voluntario1', 'Gerontología.', 12, '123', 'aaron@voluntario.com', 'aa', 'a'),
('aaron voluntario21', 'Cuidado y asistencia al adulto.', 13, '123', 'aaron@hotmail.com', 'hola soy un chico que quiere ayudar a personas que lo necesitan, quiero ayudar', 'He trabajado muchos años en geriátricos y residencias  '),
('aaron', 'Gerontología.', 19, '212', 'aaron@gmail.com', 'hola', 'hola'),
('aaron', 'Enfermería.', 21, '123', '123@123.cosm', '', ''),
('aaron', 'Otros...', 23, '123', 'aaronvoluntario@gmail.com', '', ''),
('Manolo Prueba', 'Gerontología.', 24, '123', 'manolo@gmail.com', '', ''),
('jesus', 'Gerontología.', 26, '123', 'jesus@dependiente.com', '', ''),
('Javi Voluntario', 'Gerontología.', 27, '123', 'Javi@voluntario.com', '', ''),
('manolin', 'Neurología.', 28, '123', 'manolo22@gmail.com', '', ''),
('aaron', 'Gerontología.', 38, '123', 'aaronagulddddlo24@gmail.com', '', ''),
('Juan Luis Calderon Pomares', 'Ninguno', 45, '1234', 'juan.luis.calde.95@gmail.com', 'Soy simpatico y agradable', 'experiencia cuidando niños'),
('prueba admin', 'Neurología.', 46, '123', 'aaron@correo.com', 'hoa', 'aa'),
('prueba2', 'Gerontología.', 47, '123', '1prueba@prueba.com', 'a', 'a'),
('Manolo Prueba3', 'Neurología.', 48, '123', 'manolo1@gmail.com', 'Necesito ayuda', 'Necesito mucha ayuda'),
('aa', 'Gerontología.', 50, '123', 'aar@c.com', 'hola', 'ahola'),
('prueab', 'Educación social.', 51, '123', 'prueba@TFG.com', 'aa', 'aa'),
('tiempo voluntario', 'Gerontología.', 52, '123', 'tiempo_voluntario@gmail.com', 'hola soy tiempo', 'hola soy tiempo'),
('prueba', 'Gerontología.', 54, '123', 'pr@pc.com', 'qq', 'qq'),
('Diego Fco. Tomás López', 'Gerontología.', 55, '666666666', 'diegotomaslopez16@gmail.com', 'AHHHHHHHHHHHHHHHH', 'AHHHHHHHHHHHHHHHH'),
('prueba3', 'Neurología.', 56, '123', 'prueba3@gmail.com', 'aa', 'aa'),
('aaron voluntario1', 'Gerontología.', 57, '123', 'aa@aa4.com', 'hola buenos dias', 'ninguna'),
('aaron voluntario1', 'Gerontología.', 58, '123', 'aaronaguo@gmail.com', 'Soy un chico muy atento', 'Ninguna'),
('aaron voluntario', 'Gerontología.', 59, '123', '123@1.com', 'jj', 'jj'),
('agag', 'Gerontología.', 65, '123', 'ha@h.com', 'ss', 'ss'),
('aaron voluntario1', 'Ninguno', 70, '123', 'aaronagullo24@gmail.com', 'Soy una persona muy amable', 'Ninguna');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_administrador`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `calendarios`
--
ALTER TABLE `calendarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD UNIQUE KEY `id_chat` (`id_chat`);

--
-- Indices de la tabla `dependiente`
--
ALTER TABLE `dependiente`
  ADD PRIMARY KEY (`Numero_socio`);

--
-- Indices de la tabla `parejas`
--
ALTER TABLE `parejas`
  ADD KEY `FK__dependiente` (`id_dependientes`),
  ADD KEY `FK__voluntario` (`id_voluntario`);

--
-- Indices de la tabla `voluntario`
--
ALTER TABLE `voluntario`
  ADD PRIMARY KEY (`Numero_socio`,`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_administrador` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `calendarios`
--
ALTER TABLE `calendarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT de la tabla `dependiente`
--
ALTER TABLE `dependiente`
  MODIFY `Numero_socio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `voluntario`
--
ALTER TABLE `voluntario`
  MODIFY `Numero_socio` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `parejas`
--
ALTER TABLE `parejas`
  ADD CONSTRAINT `FK__dependiente` FOREIGN KEY (`id_dependientes`) REFERENCES `dependiente` (`Numero_socio`),
  ADD CONSTRAINT `FK__voluntario` FOREIGN KEY (`id_voluntario`) REFERENCES `voluntario` (`Numero_socio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

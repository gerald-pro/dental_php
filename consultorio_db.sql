-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2024 a las 14:04:03
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consuloriodental3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_secretaria` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id`, `id_medico`, `id_paciente`, `id_secretaria`, `inicio`, `fin`, `estado`) VALUES
(25, 103, 11, 99, '2024-05-08 08:00:00', '2024-05-09 08:30:00', 1),
(26, 104, 16, 99, '2024-05-10 16:00:00', '2024-05-11 16:30:00', 1),
(27, 105, 17, 99, '2024-05-17 14:00:00', '2024-05-18 14:30:00', 1),
(28, 111, 12, 99, '2024-05-08 10:00:00', '2024-05-09 10:30:00', 1),
(33, 116, 10, 99, '2024-05-08 10:00:00', '2024-05-09 10:30:00', 1),
(34, 111, 10, 99, '2024-05-09 09:00:00', '2024-05-10 09:30:00', 1),
(35, 104, 14, 99, '2024-05-08 15:00:00', '2024-05-09 15:30:00', 1),
(36, 105, 12, 99, '2024-05-08 08:00:00', '2024-05-09 08:30:00', 1),
(37, 103, 13, 99, '2024-05-09 08:00:00', '2024-05-10 08:30:00', 1),
(43, 104, 4, 99, '2024-04-30 14:00:00', '2024-04-30 14:30:00', 1),
(49, 108, 1, 99, '2024-06-04 16:00:00', '2024-06-05 16:30:00', 1),
(50, 111, 20, 99, '2024-06-10 11:00:00', '2024-06-11 11:30:00', 1),
(52, 114, 21, 99, '2024-06-06 08:00:00', '2024-06-07 08:30:00', 1),
(54, 104, 12, 99, '2024-06-10 09:00:00', '2024-06-11 09:30:00', 1),
(55, 105, 12, 99, '2024-06-06 15:00:00', '2024-06-07 15:30:00', 1),
(57, 103, 14, 99, '2024-06-06 10:00:00', '2024-06-07 10:30:00', 1),
(58, 103, 19, 99, '2024-06-10 09:00:00', '2024-06-10 09:30:00', 1),
(60, 118, 23, 99, '2024-06-06 09:00:00', '2024-06-06 09:30:00', 1),
(61, 118, 14, 99, '2024-06-13 08:30:00', '2024-06-13 09:00:00', 1),
(62, 103, 12, 99, '2024-06-20 07:00:00', '2024-06-20 08:00:00', 1),
(63, 103, 1, 99, '2024-06-13 00:00:00', '2024-06-14 00:00:00', 1),
(64, 104, 14, 99, '2024-08-07 07:30:00', '2024-08-07 08:00:00', 1),
(65, 103, 11, 99, '2024-08-21 11:30:00', '2024-08-21 12:00:00', 1),
(66, 104, 4, 99, '2024-08-29 07:00:00', '2024-08-29 07:30:00', 1),
(67, 105, 15, 99, '2024-08-27 09:00:00', '2024-08-27 09:30:00', 1),
(68, 104, 13, 99, '2024-08-28 08:30:00', '2024-08-28 09:00:00', 1),
(69, 104, 19, 99, '2024-10-08 08:00:00', '2024-10-08 08:30:00', 1),
(70, 104, 19, 99, '2024-10-08 08:00:00', '2024-10-08 08:30:00', 1),
(71, 108, 20, 99, '2024-10-21 09:00:00', '2024-10-21 09:30:00', 1),
(73, 108, 21, 99, '2024-09-10 08:00:00', '2024-09-10 08:30:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_plan_tratamiento`
--

CREATE TABLE `detalle_plan_tratamiento` (
  `id_servicio` int(11) NOT NULL,
  `id_plan_tratamiento` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `entrada` time NOT NULL,
  `salida` time NOT NULL,
  `dia` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `entrada`, `salida`, `dia`, `id_medico`, `estado`) VALUES
(6, '08:00:00', '16:00:00', 6, 105, 1),
(13, '09:00:00', '12:00:00', 6, 113, 1),
(14, '13:00:00', '17:00:00', 3, 103, 1),
(15, '08:00:00', '12:30:00', 1, 116, 1),
(16, '08:30:00', '11:30:00', 2, 114, 1),
(17, '08:00:00', '12:00:00', 4, 111, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoP` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoM` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(9) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaNacimiento` date NOT NULL,
  `direccion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `nombre`, `apellidoP`, `apellidoM`, `documento`, `sexo`, `telefono`, `email`, `fechaNacimiento`, `direccion`) VALUES
(1, 'Patricia', 'Flores', 'Ortiz', '12890715', 'Femenino', 69456897, 'patricia@gmail.com', '2019-09-19', 'Calle las americas'),
(4, 'Marta', 'Marca', 'Viera', '12056583', 'Femenino', 69853268, 'marta12@gmail.com', '2024-03-09', 'Calle bolivar'),
(10, 'Katherine', 'Ortiz', 'Chavez', '12856931', 'Femenino', 69384256, 'katherine12@gmail.com', '2023-02-02', 'Calle la paz'),
(11, 'Lurdes', 'Gusman', 'Larico', '12890712', 'Femenino', 69271680, 'lurdes32@gmail.com', '2020-04-04', 'calle 6 de agosto'),
(12, 'Oscar', 'Peralta', 'Quispe', '3339756', 'Masculino', 76715520, 'Oscar2@gmail.com', '2010-06-18', 'B/palmira'),
(13, 'Pablo', 'Montenegro', 'Castro', '7671542', 'Masculino', 75544794, 'pablo@gmail.com', '2022-08-11', 'B/Magisterio'),
(14, 'Micaela', 'Condori', 'Roca', '7671552', 'Femenino', 69231680, 'micaela@gmail.com', '2016-10-05', 'B/El arenal'),
(15, 'Sandra', 'Duran', 'Cabrera', '13767182', 'Femenino', 70089598, 'sandra@gmail.com', '2018-05-20', 'La pampa'),
(16, 'Sebastian', 'Sanabria', 'Flores', '63182375', 'Masculino', 62613385, 'sebastian@gmail.com', '2020-03-05', 'B/Patuju'),
(17, 'Micol', 'Vega', 'salva', '7271337', 'Masculino', 60089598, 'maicol@gmail.com', '2012-11-07', 'La cuchilla'),
(18, 'Fabricio', 'Pinedo', 'Figueroa', '35890712', 'Masculino', 65395236, 'Fabricio@gmail.com', '2003-05-08', 'B/las lomas'),
(19, 'Jorge', 'Choque', 'Vaca', '5367300', 'Masculino', 79805386, 'jorge@gmail.com', '1995-06-05', ' Calle charcas'),
(20, 'Iver', 'Ortega', 'Leon', '3675360', 'Masculino', 62219628, 'iver@gmail.com', '1981-10-09', 'Calle Paraiso'),
(21, 'Veronica', 'Ramos', 'Montero', '4421719', 'Femenino', 75054602, 'veronica@gmail.com', '1995-01-24', 'B/Padre Hurtado'),
(22, 'Danixa', 'Ramirez', 'Santos', '8130858', 'Femenino', 77828032, 'danixa@gmail.com', '2000-12-25', 'B/San Carlos'),
(23, 'Leila', 'Melano', 'Vargas', '9645626', 'Femenino', 76619614, 'leila@gmail.com', '2015-03-07', 'Calle charcas'),
(25, 'Alicia', 'Arteaga', 'Solis', '34021416', 'Femenino', 77377135, 'alicia@gmail.com', '2014-03-25', 'calle mejillones'),
(26, 'Carmen Lusia', 'Marquez', 'Toledo', '3365987', 'Femenino', 66070887, 'Carmen85@gmail.com', '2018-08-09', 'av. las palmas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` int(11) NOT NULL,
  `id_plan_tratamiento` int(11) NOT NULL,
  `id_razonsocial` int(11) NOT NULL,
  `id_secretaria` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_tratamiento`
--

CREATE TABLE `plan_tratamiento` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `descuento` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `servicios` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `plan_tratamiento`
--

INSERT INTO `plan_tratamiento` (`id`, `fecha`, `descuento`, `subtotal`, `total`, `estado`, `id_paciente`, `id_medico`, `servicios`) VALUES
(1, '0000-00-00 00:00:00', 4, 420, 416, 0, 11, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(2, '0000-00-00 00:00:00', 4, 420, 416, 0, 11, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(3, '0000-00-00 00:00:00', 4, 420, 416, 0, 1, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(4, '0000-00-00 00:00:00', 4, 420, 416, 0, 4, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(5, '0000-00-00 00:00:00', 9, 928, 919, 0, 21, 116, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(6, '0000-00-00 00:00:00', 35, 3500, 3465, 0, 16, 116, '[{\"id\":\"19\",\"nombre\":\"Coronas y Puentes en Porcelana\",\"precio\":\"3500.00\",\"total\":\"3500.00\"}]'),
(22, '0000-00-00 00:00:00', 4, 420, 416, 0, 14, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(23, '0000-00-00 00:00:00', 4, 420, 416, 0, 13, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(24, '0000-00-00 00:00:00', 25, 2500, 2475, 0, 1, 116, '[{\"id\":\"1\",\"nombre\":\"Ortodoncia\",\"precio\":\"2500.00\",\"total\":\"2500.00\"}]'),
(25, '0000-00-00 00:00:00', 25, 2500, 2475, 0, 11, 116, '[{\"id\":\"1\",\"nombre\":\"Ortodoncia\",\"precio\":\"2500.00\",\"total\":\"2500.00\"}]'),
(26, '0000-00-00 00:00:00', 3, 250, 248, 0, 19, 116, '[{\"id\":\"23\",\"nombre\":\"Rayos X\",\"precio\":\"250.00\",\"total\":\"250.00\"}]'),
(27, '0000-00-00 00:00:00', 3, 250, 248, 0, 13, 116, '[{\"id\":\"25\",\"nombre\":\"limpieza dental\",\"precio\":\"250.00\",\"total\":\"250.00\"}]'),
(28, '0000-00-00 00:00:00', 25, 2500, 2475, 0, 14, 116, '[{\"id\":\"1\",\"nombre\":\"Ortodoncia\",\"precio\":\"2500.00\",\"total\":\"2500.00\"}]'),
(29, '0000-00-00 00:00:00', 9, 928, 919, 0, 23, 116, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(30, '0000-00-00 00:00:00', 9, 928, 919, 0, 23, 116, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(31, '0000-00-00 00:00:00', 9, 928, 919, 0, 23, 116, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(32, '0000-00-00 00:00:00', 9, 928, 919, 0, 23, 116, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(33, '0000-00-00 00:00:00', 9, 928, 919, 0, 23, 116, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(34, '0000-00-00 00:00:00', 9, 928, 919, 0, 23, 116, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(35, '0000-00-00 00:00:00', 35, 3500, 3465, 0, 26, 116, '[{\"id\":\"19\",\"nombre\":\"Coronas y Puentes en Porcelana\",\"precio\":\"3500.00\",\"total\":\"3500.00\"}]'),
(36, '0000-00-00 00:00:00', 35, 3500, 3465, 0, 26, 116, '[{\"id\":\"19\",\"nombre\":\"Coronas y Puentes en Porcelana\",\"precio\":\"3500.00\",\"total\":\"3500.00\"}]'),
(37, '0000-00-00 00:00:00', 35, 3500, 3465, 0, 26, 116, '[{\"id\":\"19\",\"nombre\":\"Coronas y Puentes en Porcelana\",\"precio\":\"3500.00\",\"total\":\"3500.00\"}]'),
(38, '0000-00-00 00:00:00', 35, 3500, 3465, 0, 26, 116, '[{\"id\":\"19\",\"nombre\":\"Coronas y Puentes en Porcelana\",\"precio\":\"3500.00\",\"total\":\"3500.00\"}]'),
(39, '0000-00-00 00:00:00', 35, 3500, 3465, 0, 26, 116, '[{\"id\":\"19\",\"nombre\":\"Coronas y Puentes en Porcelana\",\"precio\":\"3500.00\",\"total\":\"3500.00\"}]'),
(40, '0000-00-00 00:00:00', 4, 420, 416, 0, 18, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(41, '0000-00-00 00:00:00', 4, 420, 416, 0, 18, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(42, '0000-00-00 00:00:00', 9, 928, 919, 0, 26, 116, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(43, '0000-00-00 00:00:00', 0, 0, 0, 0, 17, 116, ''),
(44, '0000-00-00 00:00:00', 4, 420, 416, 0, 17, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(45, '0000-00-00 00:00:00', 4, 420, 416, 0, 17, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(46, '0000-00-00 00:00:00', 4, 420, 416, 0, 17, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(47, '0000-00-00 00:00:00', 25, 2500, 2475, 0, 14, 1, '[{\"id\":\"1\",\"nombre\":\"Ortodoncia\",\"precio\":\"2500.00\",\"total\":\"2500.00\"}]'),
(48, '0000-00-00 00:00:00', 25, 2500, 2475, 0, 14, 1, '[{\"id\":\"1\",\"nombre\":\"Ortodoncia\",\"precio\":\"2500.00\",\"total\":\"2500.00\"}]'),
(49, '0000-00-00 00:00:00', 4, 420, 416, 0, 1, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracio\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(50, '0000-00-00 00:00:00', 4, 420, 416, 0, 1, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracio\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(51, '0000-00-00 00:00:00', 400, 4000, 3600, 0, 16, 116, '[{\"id\":\"22\",\"nombre\":\"Protesis Parciales\",\"precio\":\"4000.00\",\"total\":\"4000.00\"}]'),
(52, '0000-00-00 00:00:00', 4, 400, 396, 0, 23, 104, '[{\"id\":\"20\",\"nombre\":\"Tratamiento de Conducto\",\"precio\":\"400.00\",\"total\":\"400.00\"}]'),
(53, '0000-00-00 00:00:00', 4, 400, 396, 0, 19, 104, '[{\"id\":\"20\",\"nombre\":\"Tratamiento de Conducto\",\"precio\":\"400.00\",\"total\":\"400.00\"}]'),
(54, '0000-00-00 00:00:00', 9, 928, 919, 0, 22, 104, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(55, '0000-00-00 00:00:00', 9, 928, 919, 0, 22, 104, '[{\"id\":\"18\",\"nombre\":\"Cromo Cobalto\",\"precio\":\"928.00\",\"total\":\"928.00\"}]'),
(56, '0000-00-00 00:00:00', 4, 400, 396, 0, 22, 104, '[{\"id\":\"20\",\"nombre\":\"Tratamiento de Conducto\",\"precio\":\"400.00\",\"total\":\"400.00\"}]'),
(57, '0000-00-00 00:00:00', 4, 400, 396, 0, 22, 104, '[{\"id\":\"20\",\"nombre\":\"Tratamiento de Conducto\",\"precio\":\"400.00\",\"total\":\"400.00\"}]'),
(58, '0000-00-00 00:00:00', 0, 0, 0, 0, 16, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"cantidad\":\"1\",\"stock\":\"NaN\",\"precio\":\"420.00\",\"total\":\"420.00\"}]'),
(59, '0000-00-00 00:00:00', 0, 0, 0, 0, 22, 116, '[{\"id\":\"15\",\"nombre\":\"Restauracion\",\"cantidad\":\"1\",\"stock\":\"NaN\",\"precio\":\"420.00\",\"total\":\"420.00\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razonsocial`
--

CREATE TABLE `razonsocial` (
  `id` int(10) NOT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `razonsocial`
--

INSERT INTO `razonsocial` (`id`, `nit`, `nombre`) VALUES
(4, '123456789012', 'Marta Marca Viera'),
(7, '123456789012', 'Oscar Peralta Quispe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `precio`) VALUES
(15, 'Restauracion', 420.00),
(16, 'Protesis Totales', 10000.00),
(17, 'Protesis Flexibles', 3000.00),
(18, 'Cromo Cobalto', 928.00),
(19, 'Coronas y Puentes en Porcelana', 3500.00),
(20, 'Tratamiento de Conducto', 400.00),
(21, 'Cirugia', 3000.00),
(22, 'Protesis Parciales', 4000.00),
(23, 'Rayos X', 250.00),
(25, 'limpieza denta', 250.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/409.png', 1, '2024-10-30 07:44:23', '2024-10-30 12:44:23'),
(99, 'Karina Martines Chavez', 'kar', '$2a$07$asxx54ahjppf45sd87a5auJHezPbP86kejZqHVBDRR/waKeKRuBVC', 'Secretaria', 'vistas/img/usuarios/kar/114.png', 1, '2024-10-29 10:31:37', '2024-10-29 15:31:37'),
(103, 'Carlos Salvatierra Rojas', 'car', '$2a$07$asxx54ahjppf45sd87a5auXaW5n/KLY/bEvEkjrWiw6hTlwjyTGja', 'Medico', 'vistas/img/usuarios/car/772.png', 0, '2024-04-12 17:17:45', '2024-10-17 22:07:42'),
(104, 'Franco Plata Zalasar', 'fran', '$2a$07$asxx54ahjppf45sd87a5auHC328efANf23/8RFe2mj0LEbEBfAlg6', 'Medico', 'vistas/img/usuarios/fran/214.png', 1, '2024-10-22 07:17:20', '2024-10-22 12:17:20'),
(105, 'Mauricio Pereira Cruz', 'mau', '$2a$07$asxx54ahjppf45sd87a5auZuceERVFI8GM5F4Rechy804LjQd8MUq', 'Medico', 'vistas/img/usuarios/mau/656.png', 1, '0000-00-00 00:00:00', '2024-09-10 13:29:50'),
(108, 'Juan Laime Marquez', 'juan', '$2a$07$asxx54ahjppf45sd87a5auwRi.z6UsW7kVIpm0CUEuCpmsvT2sG6O', 'Medico', 'vistas/img/usuarios/juan/384.png', 1, '0000-00-00 00:00:00', '2024-09-10 16:06:03'),
(111, 'Paulo Rios Peña', 'pau', '$2a$07$asxx54ahjppf45sd87a5aua76b8HP.Q6ajtUQIr.ffxBKDha17dje', 'Medico', 'vistas/img/usuarios/pau/743.png', 0, '0000-00-00 00:00:00', '2024-08-02 14:40:46'),
(112, 'Cesar Torrico Llanos', 'cesar', '$2a$07$asxx54ahjppf45sd87a5au7/Sn5rpxG4Ptbkl7WThuKQKewQBnrai', 'Medico', 'vistas/img/usuarios/cesar/965.png', 0, '0000-00-00 00:00:00', '2024-08-02 14:40:43'),
(113, 'Miguel Siles Montes', 'miguel', '$2a$07$asxx54ahjppf45sd87a5au5TACPA4ZohYQvUmfuQ1K7hyl/D7SF7O', 'Medico', 'vistas/img/usuarios/miguel/495.png', 0, '0000-00-00 00:00:00', '2024-08-02 14:40:42'),
(114, 'Jhoel Villaroel Ayala', 'jhoel', '$2a$07$asxx54ahjppf45sd87a5au8VF7qOnUzlNTOGmyqZZxJy923wWNx22', 'Medico', 'vistas/img/usuarios/jhoel/878.png', 0, '0000-00-00 00:00:00', '2024-09-10 15:05:10'),
(116, 'Jhosep Rocha Villca', 'jhosep', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 'Medico', 'vistas/img/usuarios/jhosep/827.png', 1, '2024-10-29 10:40:48', '2024-10-29 15:40:48'),
(118, 'Jorge Cuellar  Bravo', 'jorge', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 'Medico', 'vistas/img/usuarios/jorge/192.png', 0, '0000-00-00 00:00:00', '2024-09-10 15:05:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_secretaria` (`id_secretaria`);

--
-- Indices de la tabla `detalle_plan_tratamiento`
--
ALTER TABLE `detalle_plan_tratamiento`
  ADD PRIMARY KEY (`id_servicio`,`id_plan_tratamiento`),
  ADD KEY `id_plan_tratamiento` (`id_plan_tratamiento`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_plan_tratamiento` (`id_plan_tratamiento`),
  ADD KEY `id_razonsocial` (`id_razonsocial`),
  ADD KEY `id_secretaria` (`id_secretaria`);

--
-- Indices de la tabla `plan_tratamiento`
--
ALTER TABLE `plan_tratamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `razonsocial`
--
ALTER TABLE `razonsocial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_tratamiento`
--
ALTER TABLE `plan_tratamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `razonsocial`
--
ALTER TABLE `razonsocial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_secretaria`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `detalle_plan_tratamiento`
--
ALTER TABLE `detalle_plan_tratamiento`
  ADD CONSTRAINT `detalle_plan_tratamiento_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `detalle_plan_tratamiento_ibfk_2` FOREIGN KEY (`id_plan_tratamiento`) REFERENCES `plan_tratamiento` (`id`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_plan_tratamiento`) REFERENCES `plan_tratamiento` (`id`),
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`id_razonsocial`) REFERENCES `razonsocial` (`id`),
  ADD CONSTRAINT `pago_ibfk_3` FOREIGN KEY (`id_secretaria`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `plan_tratamiento`
--
ALTER TABLE `plan_tratamiento`
  ADD CONSTRAINT `plan_tratamiento_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `plan_tratamiento_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

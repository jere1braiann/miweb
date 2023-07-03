-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2023 a las 22:53:56
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dni_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escrutinio_final`
--

CREATE TABLE `escrutinio_final` (
  `id` int(11) NOT NULL,
  `lista` varchar(50) NOT NULL,
  `presidencia` int(11) NOT NULL,
  `secretarias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escrutinio_final`
--

INSERT INTO `escrutinio_final` (`id`, `lista`, `presidencia`, `secretarias`) VALUES
(1, 'MIVP', 0, 0),
(2, 'PEV', 0, 0),
(3, 'EN BLANCO', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `escrutinio_final`
--
ALTER TABLE `escrutinio_final`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `escrutinio_final`
--
ALTER TABLE `escrutinio_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

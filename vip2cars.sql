-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-05-2025 a las 01:49:26
-- Versión del servidor: 10.11.10-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vip2cars`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cliente_x_codigo` (IN `codCliente` INT)   SELECT
*
FROM clientes
WHERE codigo = codCliente$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marcas` ()   BEGIN
    SELECT *
    FROM marcas
    WHERE habilitado = 1
ORDER BY nombre ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_vehiculos` ()   BEGIN
    SELECT
vh.codigo,
vh.placa,
mr.nombre as marca,
vh.modelo,
vh.anioFabricacion,
vh.codCliente
    FROM vehiculos AS vh
INNER JOIN marcas AS mr ON mr.codigo=vh.codMarca
    WHERE vh.habilitado = 1
    ORDER BY vh.codigo DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_vehiculo_x_codigo` (IN `idVehiculo` INT)   SELECT
vh.codigo,
vh.placa,
vh.codMarca,
vh.modelo,
vh.anioFabricacion,
cli.nombres,
cli.apellidos,
cli.nroDoc,
cli.correo,
cli.telefono
FROM vehiculos AS vh
LEFT JOIN clientes AS cli ON cli.codigo=vh.codCliente
WHERE vh.codigo=idVehiculo$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `codigo` int(11) NOT NULL,
  `nombres` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nroDoc` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`codigo`, `nombres`, `apellidos`, `nroDoc`, `correo`, `telefono`) VALUES
(1, 'JUAN ANTONIO', 'VASQUEZ CAMPOS', '75481236', 'JUANJO@HOTMAIL.COM', '987456123'),
(2, 'PEDRO MARCOS', 'PEREDA RIOS', '75489612', 'PEDRORIOS@HOTMAIL.COM', '789456123'),
(3, 'MARIA', 'IBAÑEZ LOPEZ', '45612378', 'MARITA@GMAIL.COM', '975846123'),
(4, 'EDWIN', 'MORENO SALAZAR', '48759623', 'MORENOSAZ@GMAIL.COM', '956784123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `habilitado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`codigo`, `nombre`, `habilitado`) VALUES
(1, 'AUDI', 1),
(2, 'BMW', 1),
(3, 'CHEVROLET', 1),
(4, 'CITROEN', 1),
(5, 'DAIHATSU', 1),
(6, 'DODGE', 1),
(7, 'FIAT', 1),
(8, 'FORD', 1),
(9, 'KIA', 1),
(10, 'NISSAN', 1),
(11, 'MAZDA', 1),
(12, 'GEELY', 1),
(13, 'HONDA', 1),
(14, 'HYUNDAI', 1),
(15, 'LEXUS', 1),
(16, 'PEUGEOT', 1),
(17, 'PORSCHE', 1),
(18, 'SUBARU', 1),
(19, 'SUSUKI', 1),
(20, 'TOYOTA', 1),
(21, 'VOLKSWAGEN', 1),
(22, 'CHANGAN', 1),
(23, 'JAC', 1),
(24, 'GREAT WALL', 1),
(25, 'CHERY', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `codigo` int(11) NOT NULL,
  `placa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `codMarca` int(11) NOT NULL,
  `modelo` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `anioFabricacion` smallint(6) NOT NULL,
  `codCliente` int(11) NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`codigo`, `placa`, `codMarca`, `modelo`, `anioFabricacion`, `codCliente`, `habilitado`) VALUES
(1, 'AHG-423', 20, 'YARIS', 2018, 0, 1),
(2, 'BGH-741', 9, 'PICANTO', 2022, 0, 1),
(3, 'AGS-732', 14, 'ELANTRA', 2024, 0, 1),
(4, 'ASD-754', 10, 'SPORTAGE', 2018, 0, 1),
(5, 'RGF-741', 14, 'ELANTRA', 2018, 0, 1),
(6, 'SDF-421', 18, 'SOLTERRA', 2021, 0, 1),
(7, 'HGD-456', 10, 'KICKS', 2015, 0, 1),
(8, 'FGH-458', 10, 'PATHFINDER', 2022, 0, 1),
(9, 'GHT-741', 10, 'PATROL', 2023, 3, 1),
(10, 'HTY-452', 20, 'AVANZA', 2022, 0, 1),
(11, 'ATX-785', 20, 'COROLLA', 2022, 0, 1),
(12, 'HGT-452', 20, 'FORTUNER', 2012, 0, 1),
(13, 'HTY-457', 20, 'YARIS', 2020, 0, 1),
(14, 'THY-456', 14, 'ELANTRA', 2019, 4, 1),
(15, 'RTG-754', 20, 'YARIS', 2018, 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

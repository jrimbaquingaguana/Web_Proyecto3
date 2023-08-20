-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2023 a las 23:32:40
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
-- Base de datos: `proyecto_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_compra` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_inventario` int(11) NOT NULL,
  `cantidadc` int(11) NOT NULL,
  `precioc` double NOT NULL,
  `fechac` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`ID_compra`, `codigo_usuario`, `codigo_inventario`, `cantidadc`, `precioc`, `fechac`) VALUES
(7, 1, 3, 1, 2.5, '2023-08-13 19:10:50'),
(14, 1, 1, 1, 1, '2023-08-13 21:05:46'),
(15, 1, 1, 1, 1, '2023-08-13 21:06:40'),
(20, 1, 3, 2, 5, '2023-08-13 21:38:09'),
(21, 3, 3, 5, 5.5, '2023-08-15 07:16:55'),
(22, 3, 3, 4, 5.01, '2023-08-16 22:07:03'),
(23, 3, 3, 4, 5.01, '2023-08-16 22:08:03'),
(24, 3, 3, 4, 5.01, '2023-08-16 22:08:40'),
(25, 3, 3, 4, 5.01, '2023-08-16 22:09:00'),
(26, 3, 3, 4, 5.01, '2023-08-16 22:10:23'),
(27, 3, 3, 4, 5.01, '2023-08-16 22:16:57'),
(28, 3, 3, 4, 5.01, '2023-08-16 22:17:07'),
(29, 3, 3, 4, 5.01, '2023-08-16 22:17:31'),
(30, 4, 13, 4, 0.04, '2023-08-16 22:32:47'),
(31, 4, 13, 4, 0.04, '2023-08-16 22:33:13'),
(32, 3, 16, 4, 0.07, '2023-08-16 22:33:33'),
(33, 3, 16, 4, 0.07, '2023-08-16 22:34:31'),
(34, 3, 16, 4, 0.07, '2023-08-16 22:34:54'),
(35, 3, 14, 1, 1, '2023-08-16 22:57:38'),
(36, 3, 14, 1, 1, '2023-08-16 22:58:13'),
(37, 4, 16, 123, 123, '2023-08-16 23:32:57'),
(38, 4, 16, 123, 123, '2023-08-16 23:34:28'),
(39, 4, 16, 123, 123, '2023-08-16 23:34:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `precio_promedio` double NOT NULL,
  `foto` varchar(200) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Unidades` varchar(255) NOT NULL,
  `cantidad_necesaria` int(11) NOT NULL DEFAULT 0,
  `codigo_registro` varchar(255) DEFAULT NULL,
  `pendiente` int(11) NOT NULL DEFAULT 0,
  `precio_despacho` decimal(10,2) DEFAULT NULL,
  `tipo` enum('PRODUCTO','MATERIAL') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`ID`, `nombre`, `cantidad`, `precio`, `precio_promedio`, `foto`, `fecha`, `Unidades`, `cantidad_necesaria`, `codigo_registro`, `pendiente`, `precio_despacho`, `tipo`) VALUES
(1, 'Madera Triplex', 103, 57.32, 0, '../fotos/marvel.jpg', '2023-08-20 16:13:29', 'pepe', 0, NULL, 0, 0.00, 'MATERIAL'),
(3, 'Madera normal', 89, 11.5, 8.255, '../fotos/foto.jpg', '2023-08-20 16:13:29', '', 0, NULL, 0, 0.00, 'MATERIAL'),
(13, 'pepa.jpg', 9, 1, 0.52, '../fotos/pepa.jpg', '2023-08-20 16:13:29', '', 0, NULL, 0, 0.00, 'MATERIAL'),
(14, 'pepa', 3, 1, 1, '../fotos/pepa.jpg', '2023-08-20 16:13:29', '', 0, NULL, 0, 0.00, 'MATERIAL'),
(15, 'Llavero', 15, 5, 0, '../fotos/hulk.png', '2023-08-20 16:13:29', '', 0, NULL, 0, 0.00, 'MATERIAL'),
(16, 'Jose', 382, 0.01, 61.505, '../fotos/hulk.png', '2023-08-20 16:13:29', 'mililitros', 0, NULL, 0, 0.00, 'MATERIAL'),
(17, 'Pablito', 15, 15, 0, '', '2023-08-20 16:13:29', 'hola', 0, NULL, 0, 0.00, 'MATERIAL'),
(18, 'Taladro', 0, 0.05, 0, '../fotos/images.jpeg', '2023-08-20 16:07:48', 'Entero', 0, NULL, 0, 0.00, 'MATERIAL'),
(19, 'Marco', 45, 10, 0, '../fotos/images.jpeg', '2023-08-20 16:13:29', 'mililitros', 0, NULL, 0, NULL, 'MATERIAL'),
(20, 'Jose', 1, 0.02, 0, '../fotos/images.jpeg', '2023-08-20 15:48:56', 'litros', 0, NULL, 0, NULL, ''),
(21, 'PUTO', 2, 0.02, 0, '../fotos/images.jpeg', '2023-08-20 15:49:43', 'mililitros', 0, NULL, 0, NULL, ''),
(22, 'PUTO', 2, 0.02, 0, '../fotos/images.jpeg', '2023-08-20 16:14:47', 'mililitros', 0, NULL, 0, NULL, 'PRODUCTO'),
(23, 'Jose', 1, 0.01, 0, '../fotos/images.jpeg', '2023-08-20 15:53:16', 'mililitros', 0, NULL, 0, NULL, 'MATERIAL'),
(25, '1', 0, -2, 0, '', '2023-08-20 16:23:21', '', 0, '64e28449ebde1', 1, NULL, 'PRODUCTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombreu` varchar(200) NOT NULL,
  `constraseña` varchar(200) NOT NULL,
  `rol` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombreu`, `constraseña`, `rol`) VALUES
(1, 'Jose', '123', 'Bodegero'),
(2, 'Pepe', '040500', 'Fabricador'),
(3, 'Pedro', '040500', 'Administrador'),
(4, 'Pablo', '040500', 'Comprador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_compra`),
  ADD KEY `codigo_inventario` (`codigo_inventario`),
  ADD KEY `codigo_usuario` (`codigo_usuario`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`codigo_inventario`) REFERENCES `inventario` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`codigo_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

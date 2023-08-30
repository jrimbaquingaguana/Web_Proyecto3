-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2023 a las 02:54:59
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
-- Base de datos: `rol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Bodeguero'),
(3, 'Productor'),
(4, 'Invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_compra` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_inventario` int(11) DEFAULT NULL,
  `cantidadc` int(11) NOT NULL,
  `precioc` double NOT NULL,
  `fechac` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombrec` varchar(255) NOT NULL,
  `unidadesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`ID_compra`, `codigo_usuario`, `codigo_inventario`, `cantidadc`, `precioc`, `fechac`, `nombrec`, `unidadesc`) VALUES
(1, 2, NULL, 50, 15, '2023-08-27 18:39:34', 'Tornillos', 'Entero'),
(2, 2, NULL, 100, 10.5, '2023-08-27 18:39:34', 'Madera Triplex', 'Entero'),
(3, 4, NULL, 45, 10, '2023-08-27 18:39:34', 'Madera de Pino', 'Entero'),
(4, 4, NULL, 12, 15, '2023-08-27 18:39:34', 'Madera roble', 'Entero'),
(5, 4, NULL, 165, 12, '2023-08-27 18:39:34', 'Tableros Densidad Media', 'Entero'),
(6, 4, NULL, 100, 7.45, '2023-08-27 18:39:34', 'Telas de Muebles', 'Entero'),
(7, 4, NULL, 15, 15, '2023-08-27 18:37:57', 'Relleno de Goma', 'litros'),
(8, 4, NULL, 14, 7.5, '2023-08-27 18:39:34', 'Bisagras', 'Entero'),
(9, 4, NULL, 4, 17.5, '2023-08-27 18:39:34', 'Barniz', 'Entero'),
(10, 4, NULL, 67, 2.5, '2023-08-27 18:39:34', 'Sujetadores', 'Entero '),
(11, 4, NULL, 20, 4.5, '2023-08-27 18:39:34', 'Pegamento', 'Entero'),
(12, 4, NULL, 75, 6.5, '2023-08-27 18:39:34', 'Vidrio', 'Entero'),
(13, 4, NULL, 14, 8, '2023-08-27 18:39:34', 'Acero', 'Entero'),
(15, 2, NULL, 15, 15, '2023-08-29 18:48:58', 'A4', 'Unidades'),
(16, 2, 17, 15, 0.5, '2023-08-29 18:50:01', '', ''),
(17, 2, 17, 1545, 0.5, '2023-08-29 18:50:15', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creación`
--

CREATE TABLE `creación` (
  `id_creacion` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `veces_creado` int(11) NOT NULL,
  `precio_total` double NOT NULL,
  `precio_invdividual` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Tornillos', -20, 15, 0, '../fotos/tipos-de-cabeza-de-tornillos.jpg', '2023-08-29 18:47:17', 'litros', 0, NULL, 0, NULL, 'MATERIAL'),
(2, 'Madera Triplex', 80, 10.5, 0, '../fotos/madera_triplex.jpeg', '2023-08-27 21:36:31', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(3, 'Madera de Pino', 41, 10, 0, '../fotos/madera_pino.jpeg', '2023-08-29 18:29:48', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(4, 'Madera roble', 12, 15, 0, '../fotos/madera_roble.jpeg', '2023-08-27 21:36:31', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(5, 'Tableros Densidad Media', 165, 12, 0, '../fotos/tableros_fibra_media.jpg', '2023-08-27 21:36:31', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(6, 'Telas de Muebles', 100, 7.45, 0, '../fotos/telas_muebles.jpg', '2023-08-27 21:36:31', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(7, 'Mesa', 2, 100, 0, '', '2023-08-27 21:36:31', '', 0, '64eb01df6997e', 0, NULL, 'PRODUCTO'),
(8, 'Relleno de Goma', 15, 15, 0, '../fotos/relleno_tapiceria.jpg', '2023-08-27 21:36:31', 'litros', 0, NULL, 0, NULL, 'MATERIAL'),
(9, 'Bisagras', 14, 7.5, 0, '../fotos/imagen_2023-08-27_031009567.png', '2023-08-27 21:36:31', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(10, 'Barniz', 30, 17.5, 0, '../fotos/barniz.jpeg', '2023-08-29 18:37:03', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(11, 'Sujetadores', 67, 2.5, 0, '../fotos/sujetadores.jpg', '2023-08-27 21:36:31', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(12, 'Pegamento', 20, 4.5, 0, '../fotos/pegamento.jpg', '2023-08-27 21:36:31', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(13, 'Vidrio', 75, 6.5, 0, '../fotos/vidrio.jpeg', '2023-08-27 21:36:31', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(14, 'Acero', -212, 8, 0, '../fotos/acero.jpg', '2023-08-29 18:07:25', 'Entero', 0, NULL, 0, NULL, 'MATERIAL'),
(16, '', 0, 0, 0, '', '2023-08-29 18:47:17', '', 0, '64ee20654722d', 1020279, NULL, 'PRODUCTO'),
(17, 'A4', 1575, 4.125, 4.125, '../fotos/bisagra.jpg', '2023-08-29 18:50:15', 'Unidades', 0, NULL, 0, NULL, 'MATERIAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_original`
--

CREATE TABLE `inventario_original` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int(255) NOT NULL,
  `precio_inicial` double NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Unidades` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_original`
--

INSERT INTO `inventario_original` (`ID`, `nombre`, `cantidad`, `precio_inicial`, `fecha`, `Unidades`, `foto`) VALUES
(1, 'Tornillos', 50, 15, '2023-08-27 21:36:31', 'litros', '../fotos/tipos-de-cabeza-de-tornillos.jpg'),
(2, 'Madera Triplex', 100, 10.5, '2023-08-27 21:36:31', 'Entero', '../fotos/madera_triplex.jpeg'),
(3, 'Madera de Pino', 45, 10, '2023-08-27 21:36:31', 'Entero', '../fotos/madera_pino.jpeg'),
(4, 'Madera roble', 12, 15, '2023-08-27 21:36:31', 'Entero', '../fotos/madera_roble.jpeg'),
(5, 'Tableros Densidad Media', 165, 12, '2023-08-27 21:36:31', 'Entero', '../fotos/tableros_fibra_media.jpg'),
(6, 'Telas de Muebles', 100, 7.45, '2023-08-27 21:36:31', 'Entero', '../fotos/telas_muebles.jpg'),
(7, 'Relleno de Goma', 15, 15, '2023-08-27 21:36:31', 'litros', '../fotos/relleno_tapiceria.jpg'),
(8, 'Bisagras', 14, 7.5, '2023-08-27 21:36:31', 'Entero', '../fotos/imagen_2023-08-27_031009567.png'),
(9, 'Barniz', 4, 17.5, '2023-08-27 21:36:31', 'Entero', '../fotos/barniz.jpeg'),
(10, 'Sujetadores', 67, 2.5, '2023-08-27 21:36:31', 'Entero', '../fotos/sujetadores.jpg'),
(11, 'Pegamento', 20, 4.5, '2023-08-27 21:36:31', 'Entero', '../fotos/pegamento.jpg'),
(12, 'Vidrio', 75, 6.5, '2023-08-27 21:36:31', 'Entero', '../fotos/vidrio.jpeg'),
(13, 'Acero', 14, 8, '2023-08-27 21:36:31', 'Entero', '../fotos/acero.jpg'),
(15, 'A4', 15, 15, '2023-08-29 18:48:58', 'Unidades', '../fotos/bisagra.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_produccion`
--

CREATE TABLE `inventario_produccion` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `nombre_material` varchar(255) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cantidad_cad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `precio_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_produccion`
--

INSERT INTO `inventario_produccion` (`id_producto`, `nombre_producto`, `nombre_material`, `cantidad`, `fecha`, `cantidad_cad`, `precio`, `precio_total`) VALUES
(1, 'Silla', 'Tornillos, Madera Triplex, Bisagras', '10, 2, 2', '2023-08-29 11:44:02', 0, 0, 0),
(2, 'Cajon', 'Madera de Pino, Bisagras, Acero, Tornillos', '10, 2, 2, 10', '2023-08-29 11:53:00', 0, 281, 0),
(3, 'asd', 'Madera de Pino, Bisagras', '2, 3', '2023-08-29 15:36:32', 0, 42.5, 0),
(4, 'Pieza a5', 'Acero, Barniz, Madera Triplex, Relleno de Goma, Tornillos', '4, 4, 4, 4, 4', '2023-08-29 15:37:23', 0, 264, 0),
(5, 'Pez', 'Acero, Barniz', '2, 2', '2023-08-29 17:05:39', 0, 51, 0),
(6, 'pablo', 'Barniz, Tornillos', '2, 10', '2023-08-29 18:08:53', 0, 185, 0),
(7, 'Danny', 'Tornillos, Madera Triplex, Relleno de Goma, Telas de Muebles', '10, 5, 2, 1', '2023-08-29 18:45:46', 0, 239.95, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` int(10) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT 1,
  `id_cargo` int(11) NOT NULL,
  `roles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `direccion`, `telefono`, `usuario`, `contraseña`, `Active`, `id_cargo`, `roles`) VALUES
(1, 'Danny', 'Quingaluisa', 'Paute S7-295 y Sangay', 995064852, 'dsquingaluisa1@espe.edu.ec', '$2y$10$PbrWTUtD/ksrPiv9Kvv.l.waqLUnLhGWEWRTT7dk5xe3t5m1wB63q', 1, 1, ''),
(2, 'Alisson', 'Caiza', 'Palmar de Solanda OE2E y Quimiag', 999874054, 'alcaiza3@espe.edu.ec', '$2y$10$Ps.tS3d2B19Jk.t9JhSo7ucn.f.V2HnLWWKNXzvyfws350IukewFm', 0, 2, ''),
(3, 'Camila', 'Balseca', 'Apostol Miqueas y Calle 5', 963035620, 'clbalseca@uce.edu.ec', '$2y$10$gONtlwJII9IEt6hhV/G/H.2a8wM20GcoAd8kKMpjTHF7CDh3yo4yi', 1, 3, ''),
(4, 'Jose', 'imbaquinga', 'av.mariana de jesus y venezuela', 999819224, 'jose', 'Y6FjomCT', 1, 4, ''),
(5, 'Diego', 'Portilla', 'Luluncoto', 984542347, 'daportilla1@espe.edu.ec', '$2y$10$/CO9HdjKGcJHLrijKI51u.OEWUoAt65Hoa7BeD9Q6jAsM7gS5otS6', 1, 1, ''),
(6, 'adsd', 'gsfs', 'rd', 999819224, 'sd@fhg.com', '$2y$10$8wQYXZ84Mfx1rroEDPzjqObXSsaCzzXdA59G34QEPX5InLXCZtlY6', 1, 2, '2, 3'),
(7, 'asd', 'das', 'av.mariana de jesus y venexuela', 999819224, 'clb1alseca@uce.edu.ec', '$2y$10$gocGgnpxFGUrR0B1cr7MxOBGzhSTfwMOuuXCMbXT13dITUU2eJbjC', 1, 4, '2, 2, 3'),
(8, 'Jose', 'Imbaquinga', 'av.mariana de jesus y venezuela', 999199241, 'ricardoimbaquinga1@gmail.com', '$2y$10$2tJf/f9/ZlFCt4nQEQ0Jt.DA/P.5ZVLn1Y1.kKjl.HFJhKDTTEl5u', 1, 1, '2, 2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_compra`),
  ADD KEY `codigo_inventario` (`codigo_inventario`),
  ADD KEY `codigo_usuario` (`codigo_usuario`);

--
-- Indices de la tabla `creación`
--
ALTER TABLE `creación`
  ADD PRIMARY KEY (`id_creacion`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `inventario_original`
--
ALTER TABLE `inventario_original`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `inventario_produccion`
--
ALTER TABLE `inventario_produccion`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `creación`
--
ALTER TABLE `creación`
  MODIFY `id_creacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `inventario_original`
--
ALTER TABLE `inventario_original`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `inventario_produccion`
--
ALTER TABLE `inventario_produccion`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`codigo_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`codigo_inventario`) REFERENCES `inventario` (`ID`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

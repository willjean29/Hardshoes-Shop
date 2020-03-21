-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2020 a las 22:50:20
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hardshoes`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar` (IN `sku_n` VARCHAR(5), IN `nombre_n` VARCHAR(50), IN `imagen_n` VARCHAR(100), IN `precio_n` FLOAT)  begin
	insert into productos values (null, sku_n, nombre_n, imagen_n, precio_n);
	
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `editado` datetime NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id_admin`, `usuario`, `nombre`, `password`, `editado`, `nivel`) VALUES
(1, 'admin', 'Jean Osco', '$2y$12$Mx3CDXdSq.4lmOgYeIOcL.pSr4ykzQlZj3WRDEcJ9kojfR8M7quhS', '2020-02-18 21:48:26', 1),
(4, 'admin2', 'Usuario', '$2y$12$oAFuHybYstAHbQVt5vNife4sqwEGen9384iF9HkIpSyF3QQ2nA3yC', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `cliente_nombre` varchar(50) NOT NULL,
  `cliente_num` varchar(50) NOT NULL,
  `cliente_fecha` varchar(20) NOT NULL,
  `cliente_cvc` varchar(10) NOT NULL,
  `cliente_email` varchar(50) NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cliente_nombre`, `cliente_num`, `cliente_fecha`, `cliente_cvc`, `cliente_email`, `editado`) VALUES
(29, 'Jean Osco', '1234567812345678', '12/24', '568', 'willjean29@gmail.com', '0000-00-00 00:00:00'),
(31, 'Jean Osco', '457963178955', '12/24', '123', 'jean.osco@unmsm.edu.pe', '0000-00-00 00:00:00'),
(33, 'Willimas Osco', '147852369741', '12/24', '568', 'pepe@gmail.com', '0000-00-00 00:00:00'),
(34, 'John Doe', '2323345436', '12/22', '455', 'willjean29@gmail.com', '0000-00-00 00:00:00'),
(35, 'pepe', '4545656566', '12/22', '456', 'jsff@gmail.com', '0000-00-00 00:00:00'),
(36, 'pipo', '5453453', '12/22', '456', 'aaaaaaa@gmail.com', '0000-00-00 00:00:00'),
(37, 'pappo', '34343', '12/22', '435', 'pepe@gmail.com', '0000-00-00 00:00:00'),
(38, 'Juan Dias', '324235346', '12/22', '123', 'jd@gmail.com', '0000-00-00 00:00:00'),
(39, 'Urpi', '123456789963258', '12/22', '568', 'urpi@gmail.com', '0000-00-00 00:00:00'),
(40, 'Pedro Dias', '123456789123', '12/24', '123', 'pedro@gmail.com', '0000-00-00 00:00:00'),
(41, 'John Doe', '3432354565878', '12/24', '445', 'willjean29@gmail.com', '0000-00-00 00:00:00'),
(43, 'pipo pipo', '4534545', '12/24', '656', 'willjean29@gmail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `compra_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `compra_fecha` date NOT NULL,
  `compra_precio` float NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`compra_id`, `cliente_id`, `compra_fecha`, `compra_precio`, `editado`) VALUES
(21, 33, '2020-03-01', 511, '0000-00-00 00:00:00'),
(23, 34, '2020-03-01', 511, '0000-00-00 00:00:00'),
(24, 35, '2020-03-01', 511, '0000-00-00 00:00:00'),
(27, 38, '2020-03-01', 400, '0000-00-00 00:00:00'),
(28, 39, '2020-03-01', 400, '0000-00-00 00:00:00'),
(29, 40, '2020-03-02', 303, '0000-00-00 00:00:00'),
(30, 41, '2020-03-02', 324.4, '0000-00-00 00:00:00'),
(31, 43, '2020-03-04', 324.4, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_detalle`
--

CREATE TABLE `compra_detalle` (
  `cmd_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra_detalle`
--

INSERT INTO `compra_detalle` (`cmd_id`, `compra_id`, `producto_id`, `cantidad`, `precio`) VALUES
(29, 21, 3, 1, 85),
(30, 21, 2, 2, 110),
(31, 21, 1, 2, 98),
(32, 23, 3, 1, 85),
(33, 23, 2, 2, 110),
(34, 23, 1, 2, 98),
(35, 24, 3, 1, 85),
(36, 24, 2, 2, 110),
(37, 24, 1, 2, 98),
(44, 27, 3, 2, 85),
(45, 27, 2, 2, 110),
(46, 28, 3, 2, 85),
(47, 28, 2, 2, 110),
(48, 29, 3, 1, 85),
(49, 29, 2, 1, 110),
(50, 29, 1, 1, 98),
(51, 30, 1, 1, 98),
(52, 30, 4, 1, 95.5),
(53, 30, 5, 1, 120.9),
(54, 31, 1, 1, 98),
(55, 31, 4, 1, 95.5),
(56, 31, 5, 1, 120.9);

--
-- Disparadores `compra_detalle`
--
DELIMITER $$
CREATE TRIGGER `bd_DetalleCompra1` AFTER INSERT ON `compra_detalle` FOR EACH ROW BEGIN
        UPDATE productos
        SET    stock = stock - NEW.cantidad
        WHERE  id  = NEW.producto_id ;
     END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bd_DetalleCompra2` AFTER DELETE ON `compra_detalle` FOR EACH ROW BEGIN
        UPDATE productos
        SET    stock  = stock + OLD.cantidad
        WHERE  id= OLD.producto_id;
     END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bd_DetalleCompra3` AFTER UPDATE ON `compra_detalle` FOR EACH ROW BEGIN
        UPDATE productos
        SET    stock  = stock + OLD.cantidad
        WHERE  id= OLD.producto_id;
        UPDATE productos
        SET    stock = stock - NEW.cantidad
        WHERE  id  = NEW.producto_id ;
     END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `sku` varchar(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `editado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `sku`, `nombre`, `imagen`, `precio`, `stock`, `editado`) VALUES
(1, '1001', 'Zapatos de cuero para hombre | Negro', '1.png', 98, 17, '2020-02-18 20:34:01'),
(2, '1002', 'Botas de campo para hombre | Marrón', '2.png', 110, 5, '0000-00-00 00:00:00'),
(3, '1003', 'Zapatilla running unisex| Anaranjado', '3.png', 85, 5, '0000-00-00 00:00:00'),
(4, '1004', 'Zapato elegante para mujer | Negro', '4.png', 95.5, 8, '0000-00-00 00:00:00'),
(5, '1005', 'Zapatilla running para hombre| Negro', '5.png', 120.9, 8, '0000-00-00 00:00:00'),
(6, '1006', 'Zapatillas Urbanas para mujer | Azul', '6.png', 92.5, 10, '0000-00-00 00:00:00'),
(7, '1007', 'Zapatillas floreadas para mujer', '7.png', 115, 10, '0000-00-00 00:00:00'),
(8, '1008', 'Zapatillas urbanas para hombre| Marrones', '8.png', 116.5, 10, '0000-00-00 00:00:00'),
(9, '1009', 'Zapatillas urbanas para mujer | Negro y rosado', '9.png', 95.5, 10, '0000-00-00 00:00:00'),
(10, '1010', 'Zapatillas running para unisex | Verde', '10.png', 130.5, 10, '0000-00-00 00:00:00'),
(11, '1011', 'Zapatillas running para mujer | Rojo', '11.png', 125.5, 10, '0000-00-00 00:00:00'),
(12, '1012', 'Zapatillas urbanas para mujer | Morado', '12.png', 120, 15, '2020-02-18 20:33:04'),
(45, '2528', 'zapatillas devortivas', 'Zapatillas Emporio Armani EA7 _ Negro.jpg', 150, 25, '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`) USING BTREE;

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`compra_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD PRIMARY KEY (`cmd_id`),
  ADD KEY `compra_id` (`compra_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `compra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  MODIFY `cmd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD CONSTRAINT `compra_detalle_ibfk_1` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`compra_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compra_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-12-2023 a las 07:47:11
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rancho_cerro_oro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hembra`
--

CREATE TABLE `hembra` (
  `id_vaca` int(11) NOT NULL,
  `padre_num` int(11) DEFAULT NULL,
  `padre_raza` varchar(50) DEFAULT NULL,
  `madre_num` int(11) DEFAULT NULL,
  `madre_raza` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` varchar(20) DEFAULT NULL,
  `fecha_destete` varchar(20) DEFAULT NULL,
  `fecha_venta` varchar(20) DEFAULT NULL,
  `edad_actual` varchar(20) DEFAULT NULL,
  `edad_destete` varchar(30) DEFAULT NULL,
  `edad_venta` varchar(30) DEFAULT NULL,
  `peso_nacimiento` varchar(30) DEFAULT NULL,
  `peso_3meses` varchar(30) DEFAULT NULL,
  `peso_destete` varchar(30) DEFAULT NULL,
  `peso_venta` varchar(30) DEFAULT NULL,
  `ganancia_peso_dia` varchar(30) DEFAULT NULL,
  `ganancia_peso_mes` varchar(30) DEFAULT NULL,
  `finado` varchar(20) DEFAULT NULL,
  `cria_num` varchar(30) DEFAULT NULL,
  `cria_arete` varchar(30) DEFAULT NULL,
  `destino_cria` varchar(30) DEFAULT NULL,
  `vaca_num` int(11) DEFAULT NULL,
  `vaca_arete` varchar(30) DEFAULT NULL,
  `vaca_raza` varchar(50) DEFAULT NULL,
  `fecha_aretado` varchar(30) DEFAULT NULL,
  `estatus` varchar(30) DEFAULT NULL,
  `potrero` varchar(50) DEFAULT NULL,
  `lote` varchar(30) DEFAULT NULL,
  `estado_reproductivo` varchar(30) DEFAULT NULL,
  `celo` varchar(50) DEFAULT NULL,
  `parto_num` varchar(30) DEFAULT NULL,
  `estado_palpacion` varchar(50) DEFAULT NULL,
  `fecha_probable` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hembra`
--

INSERT INTO `hembra` (`id_vaca`, `padre_num`, `padre_raza`, `madre_num`, `madre_raza`, `fecha_nacimiento`, `fecha_destete`, `fecha_venta`, `edad_actual`, `edad_destete`, `edad_venta`, `peso_nacimiento`, `peso_3meses`, `peso_destete`, `peso_venta`, `ganancia_peso_dia`, `ganancia_peso_mes`, `finado`, `cria_num`, `cria_arete`, `destino_cria`, `vaca_num`, `vaca_arete`, `vaca_raza`, `fecha_aretado`, `estatus`, `potrero`, `lote`, `estado_reproductivo`, `celo`, `parto_num`, `estado_palpacion`, `fecha_probable`, `foto`, `observaciones`, `fecha_registro`) VALUES
(1, 23, 'suizo', 12, 'suizo', '2023-12-01', '2023-12-16', '2023-11-29', '10', '11', '12', '28.632', '84.362', '134.252', '249.762', '1.764', '23.039', 'no', '233', '432323', 'D-1', 30, '245345', 'suizo 1/2 ', '2023-12-28', 'vigente', 'D-1', 'vaca', 'vacia', 'fechas', '2', 'aun no', '2023-12-21', 'fotografias/vaca3.jpg', 'Primer registro', '2023-12-22 18:36:15'),
(7, 53, 'suizo americano', 88, 'suiza alemana', '2023-10-11', '2023-11-17', '', '11.22', '', '', '', '', '', '', '', '', 'no', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 'fotografias/vaca5.png', '', '2023-12-22 19:59:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `macho`
--

CREATE TABLE `macho` (
  `id_toro` int(11) NOT NULL,
  `padre_num` int(11) DEFAULT NULL,
  `padre_raza` varchar(50) DEFAULT NULL,
  `madre_num` int(11) DEFAULT NULL,
  `madre_raza` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` varchar(20) DEFAULT NULL,
  `fecha_destete` varchar(20) DEFAULT NULL,
  `fecha_venta` varchar(20) DEFAULT NULL,
  `edad_actual` varchar(20) DEFAULT NULL,
  `edad_destete` varchar(30) DEFAULT NULL,
  `edad_venta` varchar(30) DEFAULT NULL,
  `peso_nacimiento` varchar(30) DEFAULT NULL,
  `peso_3meses` varchar(30) DEFAULT NULL,
  `peso_destete` varchar(30) DEFAULT NULL,
  `peso_venta` varchar(30) DEFAULT NULL,
  `ganancia_peso_dia` varchar(30) DEFAULT NULL,
  `ganancia_peso_mes` varchar(30) DEFAULT NULL,
  `finado` varchar(20) DEFAULT NULL,
  `cria_num` varchar(30) DEFAULT NULL,
  `cria_arete` varchar(30) DEFAULT NULL,
  `destino_cria` varchar(30) DEFAULT NULL,
  `toro_num` int(11) DEFAULT NULL,
  `toro_arete` varchar(30) DEFAULT NULL,
  `toro_raza` varchar(50) DEFAULT NULL,
  `fecha_aretado` varchar(30) DEFAULT NULL,
  `estatus` varchar(30) DEFAULT NULL,
  `potrero` varchar(50) DEFAULT NULL,
  `lote` varchar(30) DEFAULT NULL,
  `estado_reproductivo` varchar(30) DEFAULT NULL,
  `celo` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `macho`
--

INSERT INTO `macho` (`id_toro`, `padre_num`, `padre_raza`, `madre_num`, `madre_raza`, `fecha_nacimiento`, `fecha_destete`, `fecha_venta`, `edad_actual`, `edad_destete`, `edad_venta`, `peso_nacimiento`, `peso_3meses`, `peso_destete`, `peso_venta`, `ganancia_peso_dia`, `ganancia_peso_mes`, `finado`, `cria_num`, `cria_arete`, `destino_cria`, `toro_num`, `toro_arete`, `toro_raza`, `fecha_aretado`, `estatus`, `potrero`, `lote`, `estado_reproductivo`, `celo`, `foto`, `observaciones`, `fecha_registro`) VALUES
(1, 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'no', '', '', '', 0, '', '', '', '', '', '', '', '', 'fotografias/', '', '2023-12-23 23:42:50'),
(3, 32, 'suizo americano', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'no', '', '', '', 0, '', '', '', '', '', '', '', '', 'fotografias/', '', '2023-12-23 23:45:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hembra`
--
ALTER TABLE `hembra`
  ADD PRIMARY KEY (`id_vaca`);

--
-- Indices de la tabla `macho`
--
ALTER TABLE `macho`
  ADD PRIMARY KEY (`id_toro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hembra`
--
ALTER TABLE `hembra`
  MODIFY `id_vaca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `macho`
--
ALTER TABLE `macho`
  MODIFY `id_toro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

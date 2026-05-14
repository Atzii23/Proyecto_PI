-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb1034.awardspace.net
-- Tiempo de generación: 13-05-2026 a las 05:35:08
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `4754372_baseproyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_accesos`
--

CREATE TABLE `historial_accesos` (
  `id_log` int NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_entrada` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `historial_accesos`
--

INSERT INTO `historial_accesos` (`id_log`, `id_usuario`, `fecha_entrada`) VALUES
(1, 1, '2026-05-10 04:47:04'),
(2, 4, '2026-05-10 04:47:04'),
(3, 6, '2026-05-10 05:03:59'),
(4, 10, '2026-05-11 15:16:02'),
(5, 5, '2026-05-12 04:24:38'),
(6, 5, '2026-05-12 04:33:57'),
(7, 5, '2026-05-13 01:50:32'),
(8, 5, '2026-05-13 01:53:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `contraseña` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`) VALUES
(1, 'Rudth', 'al21@gmail.com', '$2y$12$6X38ZoJkG0CQJPGgCnIGZuRbDS5H/0s6r0MqmUbnpcUTuhlMMhm3S'),
(2, 'test', '123@gmail.com', '$2y$12$hPh06ghthlN0ZsUrTZm87e6gRQ1tUDwG/SeVNeq/dCMowX29H5Cq6'),
(3, 'otrocorreo', '456@gmail.com', '$2y$12$LYAkaXenY8WUyOCRKx5dzegZ9Y.ftHvVm4RmllLdsJ7We05mDE2WO'),
(4, 'Marisol Dominguez', 'aimep3@gmail.com', '$2y$12$TXXEESB.fca2wdpHbhFvuOZ1z6TpT.RsLJkqOLQlvF.S/c9UwbXk2'),
(5, 'visitante', 'visitante@gmail.com', '$2y$12$8meYGuso5LRiKVT484ljROcUrucZUOf9P.ZuCcQE6cPJFaJt0X996'),
(6, 'Adriana', 'adrianaSalte@gmail.com', '$2y$12$r.zBZLm//qteqzpvvkZY5.TTDsIbI.LmvEUiLuEl7svxjbI4aqsQW'),
(7, 'Maya', 'May@gmail.com', '$2y$12$Nh0acjWr.w9eXVGsnjLl0u7gAsP3moJhFLMyiC3ei5GjtC5m1DTlS'),
(8, 'Alejandra', 'alepro@gmail.com', '$2y$12$8N1eXZvAbHdoxHTXNSWNceu1cQBGfoLU5dfziLbl019weU2Fu.iZe'),
(9, 'soniaVal', 'soni@gmail.com', '$2y$12$s8ePKhBp/5y3n1AQIHeWb.y3ndsMVNxy2NjDCeQG.W7ziWJBkyPDa'),
(10, 'Karle', 'karlepro@gmail.com', '$2y$12$ZihtovEco6ilNTixr4qD6Od7NyxYLXWM9wVML.wP3eOOtmIjjHJBW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `historial_accesos`
--
ALTER TABLE `historial_accesos`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `fk_usuario_historial` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial_accesos`
--
ALTER TABLE `historial_accesos`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_accesos`
--
ALTER TABLE `historial_accesos`
  ADD CONSTRAINT `fk_usuario_historial` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

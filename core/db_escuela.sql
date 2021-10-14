-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2021 a las 03:18:11
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_escuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `detalle` text DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especiales`
--

CREATE TABLE `especiales` (
  `id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especiales`
--

INSERT INTO `especiales` (`id`, `descripcion`, `estado`) VALUES
(1, 'Embarazo', 'A'),
(2, '3ra Edad', 'A'),
(3, 'Ninguno', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icono` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `id_padre`, `nombre`, `url`, `icono`, `pos`, `estado`) VALUES
(1, 0, 'Inicio', '#', 'nav-icon fas fa-tachometer-alt', 0, 'A'),
(2, 0, 'Gestión de usuarios', '#', 'fas fa-user', 1, 'A'),
(3, 0, 'Administración', '#', 'fas fa-school', 2, 'A'),
(4, 0, 'Tickets', '#', 'fas fa-ticket-alt', 3, 'A'),
(5, 0, 'Reportes', '#', 'fas fa-chart-area', 4, 'A'),
(6, 0, 'Nosotros', '#', 'fa fa-book', 5, 'A'),
(7, 1, 'Dashboard', 'inicio/administrador', '#', 1, 'A'),
(8, 1, 'Dashboard', 'inicio/docente', '#', 2, 'A'),
(9, 1, 'Representante', 'inicio/representante', '#', 3, 'A'),
(10, 2, 'Roles', 'gestion/roles', '#', 1, 'A'),
(11, 2, 'Usuarios', 'gestion/usuarios', '#', 2, 'A'),
(12, 3, 'Viáticos/Libros', 'administracion/viaticos', '#', 1, 'A'),
(13, 3, 'Nuevo Representante', 'administracion/representante', '#', 2, 'A'),
(14, 3, 'Nuevo estudiante', 'administracion/estudiante', '#', 3, 'A'),
(15, 3, 'Cargar estudiantes', 'administracion/cargar', '#', 4, 'A'),
(16, 4, 'Generar tickets', 'ticket/generar', '#', 1, 'A'),
(17, 4, 'Mis tickets', 'ticket/mios', '#', 2, 'A'),
(18, 4, 'Constancias', 'ticket/constancia', '#', 3, 'A'),
(19, 5, 'Productos por caducarse', 'reporte/productoCaducarse', '#', 1, 'A'),
(20, 5, 'Viáticos', 'reporte/viaticos', '#', 2, 'A'),
(21, 5, 'Estados tickets', 'reporte/tickets', '#', 3, 'A'),
(22, 6, 'Historia', 'nosotros/historia', '#', 1, 'A'),
(23, 6, 'Misión y Visión', 'nosotros/mision', '#', 2, 'A'),
(24, 6, 'Autoridades', 'nosotros/autoridades', '#', 3, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentescos`
--

CREATE TABLE `parentescos` (
  `id` int(11) NOT NULL,
  `detalle` text DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `parentescos`
--

INSERT INTO `parentescos` (`id`, `detalle`, `estado`) VALUES
(1, 'Padre / Madre', 'A'),
(3, 'Tio / Tia', 'A'),
(5, 'Hermano / Hermana', 'A'),
(7, 'abuelo / abuela', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `activo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `rol_id`, `menu_id`, `activo`, `estado`) VALUES
(1, 1, 1, 'S', 'A'),
(2, 1, 7, 'S', 'A'),
(3, 1, 2, 'S', 'A'),
(4, 1, 10, 'S', 'A'),
(5, 1, 11, 'S', 'A'),
(6, 1, 3, 'S', 'A'),
(7, 1, 12, 'S', 'A'),
(8, 1, 13, 'S', 'A'),
(9, 1, 14, 'S', 'A'),
(10, 1, 15, 'S', 'A'),
(11, 1, 5, 'S', 'A'),
(12, 1, 19, 'S', 'A'),
(13, 1, 20, 'S', 'A'),
(14, 1, 21, 'S', 'A'),
(15, 1, 6, 'S', 'A'),
(16, 1, 22, 'S', 'A'),
(17, 1, 23, 'S', 'A'),
(18, 1, 24, 'S', 'A'),
(19, 2, 1, 'S', 'A'),
(20, 2, 8, 'S', 'A'),
(21, 2, 3, 'S', 'A'),
(22, 2, 12, 'S', 'A'),
(23, 2, 13, 'S', 'A'),
(24, 2, 14, 'S', 'A'),
(25, 2, 15, 'S', 'A'),
(26, 2, 5, 'S', 'A'),
(27, 2, 19, 'S', 'A'),
(28, 2, 20, 'S', 'A'),
(29, 2, 21, 'S', 'A'),
(30, 2, 6, 'S', 'A'),
(31, 2, 22, 'S', 'A'),
(32, 2, 23, 'S', 'A'),
(33, 2, 24, 'S', 'A'),
(34, 3, 1, 'S', 'A'),
(35, 3, 9, 'S', 'A'),
(36, 3, 4, 'S', 'A'),
(37, 3, 16, 'S', 'A'),
(38, 3, 17, 'S', 'A'),
(39, 3, 18, 'S', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombres` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `cedula`, `nombres`, `apellidos`, `telefono`, `correo`, `sexo`, `estado`) VALUES
(1, '2450696568', 'Rosa', 'Rodríguez', '0987676554', 'rosa@gmail.com', 'F', 'A'),
(2, '0907446439', 'Sandra', 'Tomalá', '0976456462', 'sandra@gmail.com', 'F', 'A'),
(6, '0930287768', 'Jose', 'Lopez', '0986526522', 'jose@gmail.com', 'M', 'A'),
(8, '2400454720', 'Pablo', 'Caiche', '3456788546', 'pablo2021@gmail.com', 'M', 'A'),
(10, '0928412659', 'Paul', 'Gomez', '0985454489', 'paulhola@gmail.com', 'M', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nombre` int(11) DEFAULT NULL,
  `peso` varchar(10) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `parentesco_id` int(11) DEFAULT NULL,
  `especial_id` int(11) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `persona_id`, `parentesco_id`, `especial_id`, `fecha_nac`, `estado`) VALUES
(1, 8, 1, 3, '2021-10-12', 'A'),
(3, 10, 5, 3, '1997-10-15', 'A'),
(5, 8, 3, 2, '2021-10-12', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`, `descripcion`, `estado`) VALUES
(1, 'Administrador', NULL, 'A'),
(2, 'Docente guia', NULL, 'A'),
(3, 'Representante', NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conf_clave` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rol_id`, `persona_id`, `foto`, `clave`, `conf_clave`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Rosa.png', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', 'A', '2021-04-28 21:13:07', '2021-10-12 06:07:05'),
(2, 2, 2, 'default.png', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', 'A', '2021-04-28 21:13:44', '2021-04-28 21:13:44'),
(6, 1, 6, 'filtro.JPG', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'A', '2021-10-12 03:48:17', '2021-10-12 03:48:17'),
(8, 3, 8, 'hacker.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'A', '2021-10-12 03:58:40', '2021-10-12 07:19:54'),
(11, 3, 10, 'laptop-lenovo-core-i7-8va-2tb-disco-8gb-14-pul-tec-iluminado.jpg', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', 'A', '2021-10-12 16:41:46', '2021-10-12 16:41:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especiales`
--
ALTER TABLE `especiales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parentescos`
--
ALTER TABLE `parentescos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permisos_rol` (`rol_id`),
  ADD KEY `permisos_menu` (`menu_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_categoria` (`categoria_id`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_representante_persona` (`persona_id`),
  ADD KEY `fk_representante_parentesco` (`parentesco_id`),
  ADD KEY `fk_representante_especial` (`especial_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_persona` (`persona_id`),
  ADD KEY `usuario_rol` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especiales`
--
ALTER TABLE `especiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `parentescos`
--
ALTER TABLE `parentescos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `permisos_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `fk_representante_especial` FOREIGN KEY (`especial_id`) REFERENCES `especiales` (`id`),
  ADD CONSTRAINT `fk_representante_parentesco` FOREIGN KEY (`parentesco_id`) REFERENCES `parentescos` (`id`),
  ADD CONSTRAINT `fk_representante_persona` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_persona` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

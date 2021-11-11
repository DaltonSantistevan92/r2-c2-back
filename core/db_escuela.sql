-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2021 a las 10:46:57
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

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `detalle`, `estado`) VALUES
(1, 'Insumos Alimenticios', 'A'),
(2, 'Libros', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `curso` varchar(25) DEFAULT NULL,
  `capacidad` int(3) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `curso`, `capacidad`, `estado`) VALUES
(1, 'Primer Año ', 20, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `persona_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 'A', '2021-10-14 18:49:46', '2021-10-14 18:49:46'),
(6, 15, 'A', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_curso`
--

CREATE TABLE `docente_curso` (
  `id` int(11) NOT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  `docente_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `paralelo_id` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docente_curso`
--

INSERT INTO `docente_curso` (`id`, `periodo_id`, `docente_id`, `curso_id`, `paralelo_id`, `estado`) VALUES
(1, 1, 1, 1, 2, 'A'),
(3, 1, 6, 1, 1, 'A');

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
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `persona_id`, `estado`) VALUES
(1, 22, 'A');

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
(12, 3, 'Insumos Alimenticios / Libros', 'administracion/insumos', '#', 1, 'A'),
(13, 3, 'Listar Representantes', 'administracion/representante', '#', 5, 'A'),
(14, 3, 'Nuevo estudiante', 'administracion/estudiante', '#', 2, 'A'),
(15, 3, 'Cargar estudiantes', 'administracion/cargar', '#', 3, 'A'),
(16, 4, 'Generar tickets', 'ticket/generar', '#', 1, 'A'),
(17, 4, 'Mis tickets', 'ticket/mios', '#', 2, 'A'),
(18, 4, 'Constancias', 'ticket/constancia', '#', 3, 'A'),
(19, 5, 'Productos por caducarse', 'reporte/productoCaducarse', '#', 1, 'A'),
(20, 5, 'Viáticos', 'reporte/viaticos', '#', 2, 'A'),
(21, 5, 'Estados tickets', 'reporte/tickets', '#', 3, 'A'),
(22, 6, 'Historia', 'nosotros/historia', '#', 1, 'A'),
(23, 6, 'Misión y Visión', 'nosotros/mision', '#', 2, 'A'),
(24, 6, 'Autoridades', 'nosotros/autoridades', '#', 3, 'A'),
(25, 3, 'Listar Estudiantes', 'administracion/listarestudiante', '#', 4, 'A'),
(26, 3, 'Listar Docente', 'administracion/docentes', '#', 6, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paralelos`
--

CREATE TABLE `paralelos` (
  `id` int(11) NOT NULL,
  `detalle` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paralelos`
--

INSERT INTO `paralelos` (`id`, `detalle`, `estado`) VALUES
(1, 'A', 'A'),
(2, 'B', 'A');

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
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `id` int(11) NOT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `desde` year(4) DEFAULT NULL,
  `hasta` year(4) DEFAULT NULL,
  `definir` varchar(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`id`, `detalle`, `desde`, `hasta`, `definir`, `estado`, `created_at`, `updated_at`) VALUES
(1, '2021', 2021, 2022, 'S', 'A', '2021-10-14 04:57:02', '2021-11-10 21:31:14'),
(2, '2020', 2020, 2021, 'N', 'A', '2021-10-14 07:22:11', '2021-11-10 21:29:39');

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
(39, 3, 18, 'S', 'A'),
(40, 1, 25, 'S', 'A'),
(41, 2, 25, 'S', 'A'),
(42, 1, 26, 'S', 'A'),
(43, 2, 26, 'S', 'A');

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
(15, '2400454720', 'Manuel', 'Sanchez', '0987885841', 'manuel@hotmail.es', 'M', 'A'),
(18, '2400254039', 'Victoria', 'Perez', '0989655556', 'victoria@hotmail.es', 'F', 'A'),
(20, '0927514406', 'Victor', 'Suarez', '0987454544', 'victor@gmail.com', 'M', 'A'),
(22, '0928141076', 'Juan', 'Gonzalez', '0989646161', 'juangon@gmail.com', 'M', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `peso` varchar(10) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `peso`, `stock`, `descripcion`, `fecha_caducidad`, `estado`) VALUES
(1, 1, 'Leche', '50 g', 20, 'Todos', '2021-12-31', 'A'),
(2, 2, 'Literatura', '100 g', 25, 'Todos los cursos', '0000-00-00', 'A'),
(3, 1, 'Galletas', '50 g', 50, '', '2021-12-02', 'A'),
(4, 2, 'Matemáticas', '200 g', 10, 'Perfecto ', '0000-00-00', 'A'),
(5, 2, 'Sociales', '500 g', 16, 'Noveno', '0000-00-00', 'A'),
(6, 2, 'Ingles', '500 g', 30, 'Todos los cursos', '0000-00-00', 'A'),
(7, 1, 'Barra ', '50 g', 15, '', '2021-12-24', 'A'),
(8, 2, 'Fisica', '500 g', 15, 'Decimo', '0000-00-00', 'A');

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
(7, 20, 1, 3, '1980-11-13', 'A');

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
(1, 'Administrador', 'admin', 'A'),
(2, 'Docente guia', 'docen', 'A'),
(3, 'Representante', 'repre', 'A');

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
(16, 2, 15, 'user-default.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'A', '2021-11-10 22:22:47', '2021-11-10 22:45:13'),
(21, 3, 20, 'user-default.jpg', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', 'A', '2021-11-10 23:47:29', '2021-11-10 23:47:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_docente_persona` (`persona_id`);

--
-- Indices de la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dc_docente` (`docente_id`),
  ADD KEY `fk_dc_curso` (`curso_id`),
  ADD KEY `fk_dc_periodo` (`periodo_id`),
  ADD KEY `fk_dc_paralelo` (`paralelo_id`);

--
-- Indices de la tabla `especiales`
--
ALTER TABLE `especiales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estu_persona` (`persona_id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paralelos`
--
ALTER TABLE `paralelos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parentescos`
--
ALTER TABLE `parentescos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `especiales`
--
ALTER TABLE `especiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `paralelos`
--
ALTER TABLE `paralelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parentescos`
--
ALTER TABLE `parentescos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `fk_docente_persona` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  ADD CONSTRAINT `fk_dc_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `fk_dc_docente` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `fk_dc_paralelo` FOREIGN KEY (`paralelo_id`) REFERENCES `paralelos` (`id`),
  ADD CONSTRAINT `fk_dc_periodo` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `fk_estu_persona` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`);

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

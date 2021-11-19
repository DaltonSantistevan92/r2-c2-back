-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2021 a las 07:13:52
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.25

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
-- Estructura de tabla para la tabla `abastecer`
--

CREATE TABLE `abastecer` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `abastecer`
--

INSERT INTO `abastecer` (`id`, `proveedor_id`, `usuario_id`, `codigo`, `fecha`, `estado`, `created_at`, `updated_at`) VALUES
(10, 1, 2, '00001', '2021-11-18', 'A', '2021-11-19 04:28:10', '2021-11-19 04:28:10'),
(11, 1, 2, '00002', '2021-11-18', 'A', '2021-11-19 04:28:40', '2021-11-19 04:28:40'),
(12, 1, 2, '00003', '2021-11-18', 'A', '2021-11-19 04:48:41', '2021-11-19 04:48:41'),
(13, 1, 2, '00004', '2021-11-18', 'A', '2021-11-19 04:49:50', '2021-11-19 04:49:50'),
(14, 1, 2, '00005', '2021-11-19', 'A', '2021-11-19 05:57:23', '2021-11-19 05:57:23');

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
-- Estructura de tabla para la tabla `detalle_abastecer`
--

CREATE TABLE `detalle_abastecer` (
  `id` int(11) NOT NULL,
  `abastecer_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `num_caja` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_abastecer`
--

INSERT INTO `detalle_abastecer` (`id`, `abastecer_id`, `producto_id`, `num_caja`, `cantidad`) VALUES
(5, 10, 35, 5, 120),
(6, 11, 35, 1, 24),
(7, 12, 36, 2, 48),
(8, 13, 36, 1, 24),
(9, 14, 29, 2, 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrega`
--

CREATE TABLE `detalle_entrega` (
  `id` int(11) NOT NULL,
  `entrega_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` date DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL
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
(1, 22, 'A'),
(2, 23, 'A'),
(3, 26, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_atencion`
--

CREATE TABLE `horarios_atencion` (
  `id` int(11) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios_atencion`
--

INSERT INTO `horarios_atencion` (`id`, `hora_inicio`, `hora_fin`, `estado`) VALUES
(1, '07:30:00', '12:00:00', 'A'),
(2, '13:00:00', '17:00:00', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `movimiento_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `disponible` char(1) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(5, 0, 'Reportes', '#', 'fas fa-chart-area', 5, 'A'),
(6, 0, 'Nosotros', '#', 'fa fa-book', 6, 'A'),
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
(25, 3, 'Listar Estudiantes', 'administracion/listarestudiante', '#', 4, 'I'),
(26, 3, 'Listar Docente', 'administracion/docentes', '#', 6, 'A'),
(28, 4, 'Tickets Entregados', 'ticket/atendidos', '#', 4, 'A'),
(29, 0, 'Gestión de Produtos', '#', 'fas fa-archive', 4, 'A'),
(30, 29, 'Abastecimiento', 'gestion/abastecimiento', '#', 0, 'A'),
(31, 29, 'Entregas', 'gestion/entrega', '#', 1, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `entrega_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `num_orden` varchar(50) DEFAULT NULL,
  `tipo` varchar(25) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `num_orden`, `tipo`, `estado`) VALUES
(1, '00001', 'ticket', 'A'),
(2, '00002', 'ticket', 'A'),
(3, '00003', 'ticket', 'A'),
(4, '00004', 'ticket', 'A'),
(5, '00005', 'ticket', 'A'),
(9, '00001', 'abastecer', 'A'),
(10, '00002', 'abastecer', 'A'),
(11, '00003', 'abastecer', 'A'),
(12, '00004', 'abastecer', 'A'),
(13, '00005', 'abastecer', 'A');

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
(1, '2021', 2021, 2022, 'S', 'A', '2021-10-14 04:57:02', '2021-11-17 05:49:45'),
(2, '2020', 2020, 2021, 'N', 'A', '2021-10-14 07:22:11', '2021-11-16 04:29:42');

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
(43, 2, 26, 'S', 'A'),
(44, 1, 4, 'N', 'I'),
(45, 1, 16, 'S', 'I'),
(46, 1, 17, 'S', 'I'),
(47, 1, 18, 'S', 'I'),
(48, 2, 4, 'S', 'A'),
(49, 2, 16, 'S', 'A'),
(50, 2, 17, 'S', 'A'),
(51, 2, 28, 'S', 'A'),
(52, 2, 29, 'S', 'A'),
(53, 2, 30, 'S', 'A'),
(54, 2, 31, 'S', 'A');

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
(22, '0928141076', 'Juan', 'Gonzalez', '0989646161', 'juangon@gmail.com', 'M', 'A'),
(23, '0928020874', 'Richard', 'Suarez', '0987656526', 'richard@gmail.com', 'M', 'A'),
(24, '2450044405', 'Narcisa', 'Perez', '0987623063', 'narcisa@outlook.com', 'F', 'A'),
(25, '2400333023', 'Pablo', 'Sanchez', '0988126922', 'pablo@gmail.com', 'M', 'A'),
(26, '0926462367', 'Joselyn', 'De La Cruz', '0984226258', 'joselyn@gmail.com', 'F', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `caja` int(11) DEFAULT NULL,
  `peso` varchar(10) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `caja`, `peso`, `stock`, `descripcion`, `img`, `fecha_caducidad`, `estado`) VALUES
(1, 1, 'Leche', 1, '50 g', 24, 'Todos', 'default_product.jpg', '2021-12-31', 'A'),
(2, 2, 'Literatura', 2, '100 g', 48, 'Todos los cursos', 'default_product.jpg', '0000-00-00', 'A'),
(3, 1, 'Galletas', 3, '50 g', 72, '', 'default_product.jpg', '2021-12-02', 'A'),
(4, 2, 'Matemáticas ', 1, '200 g', 24, 'Perfecto ', 'default_product.jpg', '0000-00-00', 'A'),
(5, 2, 'Sociales', 2, '500 g', 48, 'Noveno', 'default_product.jpg', '0000-00-00', 'A'),
(6, 2, 'Ingles', 3, '500 g', 72, 'Todos los cursos', 'default_product.jpg', '0000-00-00', 'A'),
(7, 1, 'Barra ', 1, '50 g', 24, '', 'default_product.jpg', '2021-12-24', 'A'),
(8, 2, 'Fisica', 2, '500 g', 48, 'Decimo', 'default_product.jpg', '0000-00-00', 'A'),
(9, 1, 'Colada', 3, '500 g', 72, 'Colada varios sabores', 'default_product.jpg', '2022-02-18', 'A'),
(29, 1, 'Pruebaaaaa ', 2, '500mg', 48, 'Bvg', 'depositphotos_14966757-stock-photo-group-of-high-school-students.jpg', '2022-01-21', 'A'),
(30, 1, 'Vrdf', 3, 'rfr', 72, 'Vgf', 'user-default.jpg', '2022-02-26', 'A'),
(31, 1, 'prueba2', 0, 'rfr', 0, 'Vcv', 'radiador.jpg', '2021-11-19', 'A'),
(35, 1, 'prueba', 6, 'ggg', 144, 'Gggg', 'banner.jpg', '2022-05-26', 'A'),
(36, 1, 'Barra de cereales', 3, '100g', 72, 'Varios sabores', 'filtro.JPG', '2022-01-22', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(50) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razon_social`, `estado`) VALUES
(1, 'SICAE', 'A');

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
(7, 20, 1, 3, '1980-11-13', 'A'),
(8, 24, 3, 3, '1990-07-17', 'A'),
(9, 25, 1, 3, '1990-11-24', 'A');

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
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `detalle` varchar(25) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `detalle`, `estado`) VALUES
(1, 'Pendiente', 'A'),
(2, 'Entregados', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) DEFAULT NULL,
  `representante_id` int(11) DEFAULT NULL,
  `horario_atencion_id` int(11) DEFAULT NULL,
  `codigo` varchar(5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `privilegio` char(1) DEFAULT 'N',
  `orden` varchar(10) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `estudiante_id`, `representante_id`, `horario_atencion_id`, `codigo`, `fecha`, `fecha_entrega`, `privilegio`, `orden`, `status_id`, `estado`) VALUES
(1, 2, 7, 1, '13808', '2021-11-17', '2021-11-19', 'N', '00001', 2, 'A'),
(2, 1, 8, 2, '65c5f', '2021-11-17', '2021-11-18', 'N', '00002', 2, 'A'),
(3, 1, 7, 1, '72d99', '2021-11-17', '2021-11-22', 'N', '00003', 1, 'A'),
(4, 3, 9, 1, '5555d', '2021-11-17', '2021-11-24', 'N', '00004', 2, 'A'),
(5, 2, 9, 1, '0283f', '2021-11-18', '2021-11-27', 'N', '00005', 2, 'A');

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
(21, 3, 20, 'user-default.jpg', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', 'A', '2021-11-10 23:47:29', '2021-11-10 23:47:29'),
(22, 3, 24, 'user-default.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'A', '2021-11-17 07:41:12', '2021-11-17 07:41:12'),
(23, 3, 25, 'user-default.jpg', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', '93fa3e4624676f2e9aa143911118b4547087e9b6e0b6076f2e1027d7a2da2b0a', 'A', '2021-11-18 02:43:22', '2021-11-18 02:43:22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abastecer`
--
ALTER TABLE `abastecer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_abas_prove` (`proveedor_id`),
  ADD KEY `fk_abas_usu` (`usuario_id`);

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
-- Indices de la tabla `detalle_abastecer`
--
ALTER TABLE `detalle_abastecer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_deta_abaste` (`abastecer_id`),
  ADD KEY `fk_deta_prod` (`producto_id`);

--
-- Indices de la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_entre` (`entrega_id`),
  ADD KEY `fk_det_prod` (`producto_id`);

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
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entre_ticket` (`ticket_id`),
  ADD KEY `fk_entre_usua` (`usuario_id`);

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
-- Indices de la tabla `horarios_atencion`
--
ALTER TABLE `horarios_atencion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invent_movim` (`movimiento_id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movi_entrega` (`entrega_id`),
  ADD KEY `fk_movi_usua` (`usuario_id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
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
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tick_hor_aten` (`horario_atencion_id`),
  ADD KEY `fk_tick_estudi` (`estudiante_id`),
  ADD KEY `fk_tick_repres` (`representante_id`),
  ADD KEY `fk_tick_status` (`status_id`);

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
-- AUTO_INCREMENT de la tabla `abastecer`
--
ALTER TABLE `abastecer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT de la tabla `detalle_abastecer`
--
ALTER TABLE `detalle_abastecer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especiales`
--
ALTER TABLE `especiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horarios_atencion`
--
ALTER TABLE `horarios_atencion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abastecer`
--
ALTER TABLE `abastecer`
  ADD CONSTRAINT `fk_abas_prove` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `fk_abas_usu` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `detalle_abastecer`
--
ALTER TABLE `detalle_abastecer`
  ADD CONSTRAINT `fk_deta_abaste` FOREIGN KEY (`abastecer_id`) REFERENCES `abastecer` (`id`),
  ADD CONSTRAINT `fk_deta_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  ADD CONSTRAINT `fk_det_entre` FOREIGN KEY (`entrega_id`) REFERENCES `entregas` (`id`),
  ADD CONSTRAINT `fk_det_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

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
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `fk_entre_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `fk_entre_usua` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `fk_estu_persona` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_invent_movim` FOREIGN KEY (`movimiento_id`) REFERENCES `movimientos` (`id`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_movi_entrega` FOREIGN KEY (`entrega_id`) REFERENCES `entregas` (`id`),
  ADD CONSTRAINT `fk_movi_usua` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

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
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tick_estudi` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`),
  ADD CONSTRAINT `fk_tick_hor_aten` FOREIGN KEY (`horario_atencion_id`) REFERENCES `horarios_atencion` (`id`),
  ADD CONSTRAINT `fk_tick_repres` FOREIGN KEY (`representante_id`) REFERENCES `representantes` (`id`),
  ADD CONSTRAINT `fk_tick_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

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

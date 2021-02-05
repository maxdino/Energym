-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2019 a las 14:11:32
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ener`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `almacen_id` int(11) NOT NULL,
  `almacen_descripcion` varchar(60) DEFAULT NULL,
  `almacen_direccion` varchar(80) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `almacen_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`almacen_id`, `almacen_descripcion`, `almacen_direccion`, `id_sede`, `almacen_estado`) VALUES
(3, 'Principal1', 'jr. orellana 244', 1, 1),
(4, 'almacen 1', NULL, 1, 0),
(5, 'prueba23244', NULL, 1, 0),
(6, 'probando12', NULL, 1, 0),
(7, 'probando1', NULL, 1, 0),
(8, 'prueba45', NULL, 1, 0),
(9, 'numero2', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `asistencia_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `asistencia_fecha_hora` datetime DEFAULT NULL,
  `asistencia_fecha` date DEFAULT NULL,
  `asistencia_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`asistencia_id`, `cliente_id`, `asistencia_fecha_hora`, `asistencia_fecha`, `asistencia_estado`) VALUES
(5, 9, '2019-07-12 22:49:07', '2019-07-12', 1),
(6, 10, '2019-07-14 19:19:29', '2019-07-14', 1),
(7, 9, '2019-07-15 09:21:58', '2019-07-15', 1),
(8, 10, '2019-07-15 10:11:06', '2019-07-15', 1),
(10, 14, '2019-11-02 23:27:57', '2019-11-02', 1),
(11, 14, '2019-11-08 23:36:13', '2019-11-08', 1),
(16, 15, '2019-11-18 17:38:44', '2019-11-18', 1),
(17, 15, '2019-11-19 08:06:02', '2019-11-19', 1),
(18, 14, '2019-11-24 20:56:08', '2019-11-24', 1),
(19, 15, '2019-11-26 07:33:28', '2019-11-26', 1),
(21, 14, '2019-11-26 20:12:15', '2019-11-26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `categoria_producto_id` int(11) NOT NULL,
  `categoria_producto_descripcion` varchar(255) DEFAULT NULL,
  `categoria_producto_estado` int(11) DEFAULT '1',
  `id_sede` int(11) DEFAULT NULL,
  `categoria_imagen` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`categoria_producto_id`, `categoria_producto_descripcion`, `categoria_producto_estado`, `id_sede`, `categoria_imagen`) VALUES
(1, 'Agua Mineral ', 1, 1, NULL),
(4, '', 0, 1, NULL),
(5, '', 0, 1, NULL),
(6, 'Proteínas', 1, 1, NULL),
(7, 'Sporade', 0, 1, NULL),
(8, 'prueba23', 0, 1, NULL),
(9, 'prueba31', 0, 1, NULL),
(10, 'prueba31', 0, 1, NULL),
(11, 'prueba31', 0, 1, NULL),
(12, 'prueba31', 0, 1, NULL),
(13, 'preba21', 0, 1, NULL),
(14, 'pre', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `cliente_nombre_completo` varchar(255) DEFAULT NULL,
  `cliente_documento_numero` varchar(20) DEFAULT NULL,
  `tipo_documento_cliente_id` int(11) DEFAULT NULL,
  `cliente_sexo` varchar(255) DEFAULT NULL,
  `cliente_correo` varchar(255) DEFAULT NULL,
  `cliente_telefono` varchar(255) DEFAULT NULL,
  `cliente_direccion` varchar(255) DEFAULT NULL,
  `cliente_telefono_referencia` varchar(255) DEFAULT NULL,
  `cliente_estado` int(11) DEFAULT '1',
  `tipo_documento_cliente_tam` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_nombre_completo`, `cliente_documento_numero`, `tipo_documento_cliente_id`, `cliente_sexo`, `cliente_correo`, `cliente_telefono`, `cliente_direccion`, `cliente_telefono_referencia`, `cliente_estado`, `tipo_documento_cliente_tam`) VALUES
(1, 'Maria Rojas Garcia', '75270586', 1, 'Femenino', 'maria12@gmail.com', '984638576', 'psje. humberto pinedo 130', '933345643', 0, 8),
(2, 'julymarth panduro aching', '70275866', 1, 'Masculino', 'jimmycarbajalsanchez@gmail.com', '933122626', 'psje. humberto pinedo 130', '912226244', 0, 8),
(7, 'Ronald Adrian Hilario Tafur', '71044092', 1, 'Masculino', 'josmar08.31059@gmail.com', '984638576', 'Nicolas De Pierola 351', '5555', 0, 8),
(8, 'andy hilario tafur', '71087964', 1, 'Masculino', 'dsdksdk', '99999999', 'jr lima', '8855666', 0, 8),
(9, 'Merly Monsalve Vásque', '75953763', 1, 'Femenino', 'merly@gmail.co', '324323425', 'Jr Sáenz Peña cdra 2 ', '344536535', 0, 8),
(10, 'Genry Trigozo Cutipa', '73990362', 1, 'Masculino', 'genry@gmail.com', ' jr.progreso #550', ' jr.progreso #550', '', 0, 8),
(11, 'Yadira Chingay Mego', '70808493', 1, 'Femenino', 'Yadira@gmail.com', '914 952 3', 'Pasaje Humberto Pinedo SN', '', 0, 8),
(12, 'Whylds Rodríguez Reategui', '76419563', 1, 'Masculino', 'whylds@gmail.com', '936 864 4', 'Av circunvalación cumbaza c2', '', 0, 8),
(13, 'CCVFB<DGNBDGN', '73996455', 1, 'Masculino', 'FHFGG75555CCC', '888888888', 'YTYYTNTYHT', '888888888', 0, 8),
(14, 'Jhonny Eintens Shapiama Alvarado', '65785950', 1, 'Masculino', 'jhony@gmail.com', '234576835', '9 de abril', '', 1, NULL),
(15, 'Jose Max Hilario Arroyo', '70992778', 1, 'Masculino', 'jose@gmail.com', '956746356', 'Nicolás De Pierola 351', '', 1, NULL),
(16, 'juan perez', '32323232', 1, 'Masculino', 'juan@gmail.com', '987356483', 'aribba 334', '', 1, NULL),
(17, 'maria vargas', '34354565', 1, 'Femenino', 'maria@gmail.com', '345765378', 'alfonso ugarte', '', 1, NULL),
(18, 'Ronald adrian', '76767676', 1, 'Masculino', 'adrian@gmail.com', '987897876', 'Nicolás De Pierola 351', '', 1, NULL),
(19, 'Mario Vargas Llosa', '34576893', 1, 'Masculino', 'llosa@gmail.com', '935745211', 'españa 357', '', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_doc_sede`
--

CREATE TABLE `detalle_doc_sede` (
  `detalle_id_sede` int(11) DEFAULT NULL,
  `detalle_id_documento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `venta_id` int(11) NOT NULL,
  `precio` varchar(100) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `tipo_membresia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `producto_id`, `venta_id`, `precio`, `cantidad`, `importe`, `tipo_membresia`) VALUES
(36, NULL, 29, '180', '1', '180', 6),
(37, NULL, 30, '180', '1', '180', 6),
(38, NULL, 31, '71', '1', '71', 1),
(39, 8, 32, '390.60', '1', '390.60', NULL),
(40, 10, 33, '390.60', '1', '390.60', NULL),
(41, 10, 34, '390.60', '1', '390.60', NULL),
(42, NULL, 35, '180', '1', '180', 6),
(43, 8, 36, '390.60', '2', '781.20', NULL),
(44, 8, 37, '390.60', '1', '390.60', NULL),
(45, NULL, 38, '70', '1', '70', 6),
(46, 10, 39, '390.60', '1', '390.60', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id_documento` int(1) NOT NULL,
  `doc_serie` char(4) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `doc_correlativo` int(11) DEFAULT NULL,
  `id_empresa` varchar(11) DEFAULT NULL,
  `id_tipodocumento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `empleado_id` int(11) NOT NULL,
  `empleado_nombres` varchar(100) NOT NULL,
  `empleado_apellidos` varchar(100) DEFAULT NULL,
  `empleado_dni` varchar(8) DEFAULT NULL,
  `empleado_direccion` varchar(50) DEFAULT NULL,
  `empleado_email` varchar(50) DEFAULT NULL,
  `empleado_telefono` varchar(30) DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  `empleado_usuario` varchar(50) DEFAULT NULL,
  `empleado_clave` varchar(200) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  `empresa_ruc` varchar(255) DEFAULT NULL,
  `empresa_sede` int(11) DEFAULT NULL,
  `empleado_nombre_completo` varchar(255) DEFAULT NULL,
  `empleado_foto_perfil` text,
  `empleado_fecha_nacimiento` date DEFAULT NULL,
  `empleado_huella` longtext,
  `empleado_sexo` char(1) DEFAULT 'm',
  `empleado_horario_entrada_man` time DEFAULT NULL,
  `empleado_horario_salida_man` time DEFAULT NULL,
  `empleado_horario_entrada_tar` time DEFAULT NULL,
  `empleado_horario_salida_tar` time DEFAULT NULL,
  `empleado_foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`empleado_id`, `empleado_nombres`, `empleado_apellidos`, `empleado_dni`, `empleado_direccion`, `empleado_email`, `empleado_telefono`, `perfil_id`, `empleado_usuario`, `empleado_clave`, `estado`, `empresa_ruc`, `empresa_sede`, `empleado_nombre_completo`, `empleado_foto_perfil`, `empleado_fecha_nacimiento`, `empleado_huella`, `empleado_sexo`, `empleado_horario_entrada_man`, `empleado_horario_salida_man`, `empleado_horario_entrada_tar`, `empleado_horario_salida_tar`, `empleado_foto`) VALUES
(1, 'Andy Brayan Hilario Tafur', 'Tafur', '', 'Nicolás De Pierola 351', 'andyyadrian12@gmail.com', '', 8, 'admin', '123', 1, '20709965293', 1, 'Andy Brayan Hilario Tafur Tafur', '34178536_10212571822916029_4983929343618056192_n.jpg', '0000-00-00', NULL, 'M', NULL, NULL, NULL, NULL, 'be39746ebf53d200f58929071a585d08.jpg'),
(2, 'Victor', 'Campos', '78965412', '', '', '987654321', 14, 'victor', '123', 1, '20709965293', 1, 'Victor Campos', NULL, '0000-00-00', NULL, 'F', NULL, NULL, NULL, NULL, 'd21c40c6f2c2974cd91e0aa137043550.jpg'),
(3, 'Clientes', '', '', '', '', '', 15, 'cliente', '123', 0, '20709965293', 1, 'Clientes ', NULL, '0000-00-00', NULL, 'F', NULL, NULL, NULL, NULL, 'da6c99ffee293ea576fef8c001495d85.png'),
(7, 'carlos', 'saavedra', '32132131', '10 de agosto', 'chu@gmail.com', '987654378', 14, 'carlos', '123', 1, '20709965293', 1, NULL, NULL, NULL, NULL, 'M', NULL, NULL, NULL, NULL, NULL),
(8, 'liam', 'goana', '32312312', 'Nicolás De Pierola 351', 'liam12@gmail.com', '987245631', 14, 'liam', '123', 0, '20709965293', 1, NULL, NULL, NULL, NULL, 'M', NULL, NULL, NULL, NULL, NULL),
(9, 'adrian', 'hilario', '74385632', 'Nicolás De Pierola 351', 'adrian@gmail.com', '987345234', 14, 'adrian', '123', 1, '20709965293', 1, NULL, NULL, NULL, NULL, 'M', NULL, NULL, NULL, NULL, NULL),
(10, 'rafael ', 'hernandez', '70996529', 'ASDHH', 'andyfjslfjdlf@gmail.com', '987985856', 8, 'rafel', '123', 0, '20709965293', 1, NULL, NULL, NULL, NULL, 'M', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_ruc` varchar(11) NOT NULL,
  `empresa_razon_social` varchar(255) DEFAULT NULL,
  `empresa_direccion` varchar(255) DEFAULT NULL,
  `empresa_telefono` varchar(255) DEFAULT NULL,
  `empresa_correo` varchar(255) DEFAULT NULL,
  `empresa_estado` int(11) DEFAULT '1',
  `empresa_icono` text,
  `empresa_abreviatura` varchar(255) DEFAULT NULL,
  `empresa_nombre_comercial` varchar(255) DEFAULT NULL,
  `empresa_culqi_publico` text,
  `empresa_culqi_privado` text,
  `empresa_usuario_sol` varchar(255) DEFAULT NULL,
  `empresa_clave_sol` varchar(255) DEFAULT NULL,
  `empreasa_firma_digital` text,
  `empresa_estado_activo` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_ruc`, `empresa_razon_social`, `empresa_direccion`, `empresa_telefono`, `empresa_correo`, `empresa_estado`, `empresa_icono`, `empresa_abreviatura`, `empresa_nombre_comercial`, `empresa_culqi_publico`, `empresa_culqi_privado`, `empresa_usuario_sol`, `empresa_clave_sol`, `empreasa_firma_digital`, `empresa_estado_activo`) VALUES
('20709965293', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `marca_descripcion` varchar(100) DEFAULT NULL,
  `marca_estado` char(1) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca_descripcion`, `marca_estado`, `id_sede`) VALUES
(1, 'Inca Kola', '1', 1),
(2, 'Duromas', '1', 1),
(3, 'Cielo1', '0', 1),
(4, 'orueba12', '0', 1),
(5, 'prueba14', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia`
--

CREATE TABLE `membresia` (
  `membresia_id` int(11) NOT NULL,
  `tipo_membresia_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `membresia_fecha_inicio` date DEFAULT NULL,
  `membresia_fecha_fin` date DEFAULT NULL,
  `membresia_precio_mes` decimal(20,2) DEFAULT NULL,
  `membresia_meses` int(11) DEFAULT NULL,
  `membresia_estado` int(11) DEFAULT '1',
  `membresia_precio_total` decimal(20,2) DEFAULT NULL,
  `membresia_fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `membresia`
--

INSERT INTO `membresia` (`membresia_id`, `tipo_membresia_id`, `cliente_id`, `membresia_fecha_inicio`, `membresia_fecha_fin`, `membresia_precio_mes`, `membresia_meses`, `membresia_estado`, `membresia_precio_total`, `membresia_fecha_registro`) VALUES
(18, 6, 14, '2019-11-24', '2019-11-28', '180.00', 1, 1, '180.00', '2019-11-24'),
(19, 6, 15, '2019-11-24', '2019-12-24', '180.00', 1, 1, '180.00', '2019-11-24'),
(20, 1, 16, '2019-11-24', '2019-12-24', '35.50', 1, 1, '35.50', '2019-11-24'),
(21, 1, 17, '2019-11-24', '2019-12-24', '35.50', 1, 1, '35.50', '2019-11-24'),
(22, 6, 18, '2019-11-25', '2019-12-25', '180.00', 1, 1, '180.00', '2019-11-25'),
(23, 6, 19, '2019-11-26', '2019-12-26', '70.00', 1, 1, '70.00', '2019-11-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `modulo_id` int(11) NOT NULL,
  `modulo_nombre` varchar(50) DEFAULT NULL,
  `modulo_icono` varchar(50) DEFAULT NULL,
  `modulo_url` varchar(50) DEFAULT NULL,
  `modulo_padre` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  `modulo_orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`modulo_id`, `modulo_nombre`, `modulo_icono`, `modulo_url`, `modulo_padre`, `estado`, `modulo_orden`) VALUES
(1, 'MODULO PADRE', '#', '#', 1, 1, 1),
(2, 'Administracion', 'mdi mdi-key', '#', 1, 1, 6),
(3, 'Permisos', ' ', 'Permisos', 2, 1, NULL),
(4, 'Perfil', ' ', 'Perfiles', 2, 1, 4),
(5, 'Modulos', ' ', 'Modulo', 2, 1, 6),
(6, 'Empresa', '.', 'empresa', 2, 0, NULL),
(7, 'Almacen', 'mdi mdi-medical-bag', '#', 1, 1, NULL),
(8, 'R. de Almacen', ' ', 'Almacen', 7, 1, NULL),
(9, 'Mantenimiento', 'mdi mdi-svg', '#', 1, 1, NULL),
(10, 'Categoria Producto', ' ', 'C_producto', 9, 1, NULL),
(11, 'Marca Producto', ' ', 'Marca_producto', 9, 1, NULL),
(15, 'Compras', 'mdi mdi-cart-outline', '#', 1, 1, NULL),
(16, 'Registrar Producto', ' ', 'R_producto', 7, 1, NULL),
(17, 'Membresia', 'mdi mdi-account-multiple', '#', 1, 1, NULL),
(18, 'Cliente', '.', 'ClientesP', 1, 1, NULL),
(19, 'Tipo Membresia', '.', 'Tipo_membresia', 17, 1, NULL),
(20, 'Asistencia', '.', 'Asistencia', 17, 1, NULL),
(21, 'Modulo Prueba', 'sdsd', '#', 1, 1, NULL),
(22, 'Reporte', 'mdi mdi-file-pdf', '#', 1, 1, NULL),
(23, 'Reporte Clientes', ' ', 'Clientesr', 22, 1, NULL),
(24, 'Reporte Asistencia', ' ', 'RAsistencia', 22, 1, NULL),
(25, 'Ventas', ' mdi mdi-clipboard', '#', 1, 1, NULL),
(26, 'Visualizar Venta Producto', ' ', 'Ventaproducto', 25, 1, NULL),
(27, 'Visualizar Venta Servicio', ' ', 'Ventaservicio', 25, 1, NULL),
(28, 'Usuario', ' ', 'Usuario', 2, 1, NULL),
(29, 'Clientes', '  ', 'Cliente', 17, 1, NULL),
(30, 'Venta Producto', 'dsadsa', 'Rventa_producto', 22, 1, NULL),
(31, 'Venta Servicio', 'dsadsa', 'Rventa_servicio', 22, 1, NULL),
(32, 'Registrar Venta Producto', ' ', 'VentaProducto/nuevo', 25, 1, NULL),
(33, 'Registrar Venta Servicio', ' ', 'VentaServicio/nuevo', 25, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `moneda_id` int(11) NOT NULL,
  `moneda_descripcion` varchar(20) DEFAULT NULL,
  `moneda_simbolo` varchar(5) DEFAULT NULL,
  `moneda_estado` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`moneda_id`, `moneda_descripcion`, `moneda_simbolo`, `moneda_estado`) VALUES
(1, 'Soles ', 'S/', '1'),
(2, 'Dolares', '$', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `perfil_id` int(11) NOT NULL,
  `perfil_descripcion` varchar(50) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  `perfil_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perfil_id`, `perfil_descripcion`, `estado`, `perfil_url`) VALUES
(1, 'ADMINISTRADOR1', 0, ''),
(5, 'CAJERO', 0, 'Pedido'),
(8, 'ADMINISTRADOR DE EMPRESA', 1, 'control'),
(12, 'ADMINISTRADOR DE SEDE', 0, 'control'),
(13, 'sdsdsds', 0, NULL),
(14, 'CAJERO', 1, NULL),
(15, 'CLIENTE', 1, NULL),
(16, 'pureba1', 0, NULL),
(17, 'paraborrar', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_sede`
--

CREATE TABLE `permisos_sede` (
  `persed_id_perfil` int(11) DEFAULT NULL,
  `persed_id_modulo` int(11) DEFAULT NULL,
  `persed_id_sede` int(11) DEFAULT NULL,
  `persed_id_rubro` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `permisos_sede`
--

INSERT INTO `permisos_sede` (`persed_id_perfil`, `persed_id_modulo`, `persed_id_sede`, `persed_id_rubro`) VALUES
(1, 10, 1, NULL),
(15, 20, 1, NULL),
(14, 16, 1, NULL),
(14, 10, 1, NULL),
(14, 11, 1, NULL),
(14, 18, 1, NULL),
(14, 20, 1, NULL),
(14, 23, 1, NULL),
(14, 24, 1, NULL),
(14, 26, 1, NULL),
(14, 27, 1, NULL),
(8, 3, 1, NULL),
(8, 4, 1, NULL),
(8, 5, 1, NULL),
(8, 28, 1, NULL),
(8, 8, 1, NULL),
(8, 16, 1, NULL),
(8, 10, 1, NULL),
(8, 11, 1, NULL),
(8, 19, 1, NULL),
(8, 20, 1, NULL),
(8, 29, 1, NULL),
(8, 23, 1, NULL),
(8, 24, 1, NULL),
(8, 30, 1, NULL),
(8, 31, 1, NULL),
(8, 26, 1, NULL),
(8, 27, 1, NULL),
(8, 32, 1, NULL),
(8, 33, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(11) NOT NULL,
  `producto_descripcion_` varchar(255) DEFAULT NULL,
  `producto_precio` decimal(10,2) DEFAULT NULL,
  `producto_stock` int(11) DEFAULT '0',
  `producto_minimo` int(11) DEFAULT '0',
  `producto_feche_vencimiento` date DEFAULT NULL,
  `producto_observacion` varchar(255) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `producto_estado` int(11) DEFAULT '1',
  `producto_imagen` varchar(250) DEFAULT NULL,
  `categoria_producto_id` int(11) DEFAULT NULL,
  `producto_codigobarra` varchar(100) DEFAULT NULL,
  `unidad_medida_id` int(11) DEFAULT NULL,
  `tipo_unidad_medida_id` int(11) DEFAULT NULL,
  `producto_preciocompra` decimal(10,2) DEFAULT NULL,
  `producto_stock_temporal` int(11) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_descripcion_`, `producto_precio`, `producto_stock`, `producto_minimo`, `producto_feche_vencimiento`, `producto_observacion`, `id_sede`, `producto_estado`, `producto_imagen`, `categoria_producto_id`, `producto_codigobarra`, `unidad_medida_id`, `tipo_unidad_medida_id`, `producto_preciocompra`, `producto_stock_temporal`) VALUES
(8, 'ISO WHEY 5KG', '390.60', 9999999, 0, NULL, NULL, NULL, 1, 'isowhey.jpg', 6, 'WHEY10000', 25, 14, NULL, NULL),
(10, 'ISO WHEY 10KG', '390.60', 9999999, 0, NULL, NULL, NULL, 1, 'isowhey10.jpg', 6, 'WHEY999', 25, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` int(11) NOT NULL,
  `empresa_ruc` varchar(255) DEFAULT NULL,
  `sede_direccion` varchar(255) DEFAULT NULL,
  `sede_telefono` int(11) DEFAULT NULL,
  `sede_observacion` varchar(255) DEFAULT NULL,
  `sede_horario_m_i` time DEFAULT NULL,
  `sede_horario_m` time DEFAULT NULL,
  `sede_horario_t_i` time DEFAULT NULL,
  `sede_horario_t` time DEFAULT NULL,
  `id_distrito` int(11) DEFAULT NULL,
  `sede_descripcion` varchar(255) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `sede_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `empresa_ruc`, `sede_direccion`, `sede_telefono`, `sede_observacion`, `sede_horario_m_i`, `sede_horario_m`, `sede_horario_t_i`, `sede_horario_t`, `id_distrito`, `sede_descripcion`, `id_provincia`, `id_departamento`, `sede_estado`) VALUES
(1, '20709965293', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `tipodoc_id` int(11) NOT NULL,
  `tipodoc_descripcion` varchar(60) DEFAULT NULL,
  `tipodoc_abreviacion` varchar(7) DEFAULT NULL,
  `tipodoc_estado` char(1) DEFAULT '1',
  `serie` varchar(3) DEFAULT NULL,
  `correlativo` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`tipodoc_id`, `tipodoc_descripcion`, `tipodoc_abreviacion`, `tipodoc_estado`, `serie`, `correlativo`) VALUES
(1, 'BOLETA ', 'BOLETA', '1', '001', 31),
(2, 'FACTURA ', 'FACTURA', '1', '001', 10),
(3, 'TICKET BOLETA', 'TICKET', '1', '001', 1),
(4, 'TICKET FACTURA.', 'TICKET', '1', '001', 1),
(11, 'NOTA DE CREDITO ', 'N. CRED', '0', '001', 1),
(12, 'NOTA DE DEBITO ', 'N. DEB.', '0', '001', 1),
(13, 'SIN DOCUMENTO', 'SIN DOC', '1', '001', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento_cliente`
--

CREATE TABLE `tipo_documento_cliente` (
  `tipo_documento_cliente_id` int(11) NOT NULL,
  `tipo_documento_cliente_descripcion` varchar(255) DEFAULT NULL,
  `tipo_documento_cliente_tam` int(11) DEFAULT NULL,
  `tipo_documento_cliente_estado` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipo_documento_cliente`
--

INSERT INTO `tipo_documento_cliente` (`tipo_documento_cliente_id`, `tipo_documento_cliente_descripcion`, `tipo_documento_cliente_tam`, `tipo_documento_cliente_estado`) VALUES
(1, 'DNI', 8, 1),
(2, 'RUC', 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_membresia`
--

CREATE TABLE `tipo_membresia` (
  `tipo_membresia_id` int(11) NOT NULL,
  `tipo_membresia_descripcion` varchar(255) DEFAULT NULL,
  `tipo_membresia_mes` int(11) DEFAULT NULL,
  `tipo_membresia_precio_mes` decimal(50,0) DEFAULT NULL,
  `tiempo_duracion` date DEFAULT NULL,
  `tipo_duracion` int(11) DEFAULT NULL,
  `tipo_membresia_estado` int(11) DEFAULT '1',
  `tipo_membresia_fecha_registro` date DEFAULT NULL,
  `estado_asistencia` int(1) DEFAULT '0',
  `cantidad_personas` int(11) DEFAULT '1',
  `tipo_tiempo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipo_membresia`
--

INSERT INTO `tipo_membresia` (`tipo_membresia_id`, `tipo_membresia_descripcion`, `tipo_membresia_mes`, `tipo_membresia_precio_mes`, `tiempo_duracion`, `tipo_duracion`, `tipo_membresia_estado`, `tipo_membresia_fecha_registro`, `estado_asistencia`, `cantidad_personas`, `tipo_tiempo`) VALUES
(1, 'Paquete 2 x 1', 1, '150', '2019-11-26', 0, 1, '2019-11-26', 1, 2, NULL),
(2, 'estudiante', 1, '40', '2019-04-09', 1, 0, '2019-04-08', 0, 1, NULL),
(3, 'estudiante', 1, '45', '2019-07-12', 0, 0, '2019-07-12', 0, 1, NULL),
(4, 'paquete 2 x 1', 1, '100', '2019-07-12', 1, 0, '2019-07-12', 0, 1, NULL),
(5, 'duo', 1, '120', '2019-10-30', 1, 0, '2019-10-30', 0, 1, NULL),
(6, 'Estándar', 1, '70', '2019-12-30', 0, 1, '2019-11-26', 0, 1, NULL),
(7, 'solo amigos', 1, '50', '2019-10-30', 1, 0, '2019-10-30', 0, 1, NULL),
(8, 'cuarteto', 1, '150', '2019-11-02', 1, 0, '2019-11-02', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_unidad_medida`
--

CREATE TABLE `tipo_unidad_medida` (
  `id_tipo_unidad_medida` int(11) NOT NULL,
  `tipo_unidad_medida_descripcion` varchar(255) DEFAULT NULL,
  `tipo_unidad_medida_estado` char(1) NOT NULL DEFAULT '1',
  `cu_tabla` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipo_unidad_medida`
--

INSERT INTO `tipo_unidad_medida` (`id_tipo_unidad_medida`, `tipo_unidad_medida_descripcion`, `tipo_unidad_medida_estado`, `cu_tabla`) VALUES
(1, 'Masa', '1', '20542322412'),
(2, 'Capacidad', '0', '20542322412'),
(3, 'Densidad', '0', '20542322412'),
(4, 'Energía', '0', '20542322412'),
(5, 'Fuerza', '0', '20542322412'),
(6, 'Longitud', '0', '20542322412'),
(7, 'Potencia', '0', '20542322412'),
(8, 'Temperatura', '0', '20542322412'),
(9, 'Tiempo', '0', '20542322412'),
(10, 'Velocidad', '0', '20542322412'),
(11, 'Volumen', '1', '20542322412'),
(12, 'Eléctricas', '0', '20542322412'),
(13, 'Depresacion', '0', '20542322412'),
(14, 'Unidad', '1', '20542322412');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id_unidad_medida` int(11) NOT NULL,
  `unidad_medida_descripcion` varchar(255) DEFAULT NULL,
  `unidad_medida_estado` int(11) DEFAULT '1',
  `id_tipo_unidad_medida` int(11) DEFAULT NULL,
  `valor_unidad_medida` float(10,2) DEFAULT NULL,
  `unidad_medida_abreviatura` varchar(255) DEFAULT NULL,
  `codigo_sunat` varchar(255) DEFAULT NULL,
  `descripcion_sunat` varchar(255) DEFAULT NULL,
  `cu_tabla` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id_unidad_medida`, `unidad_medida_descripcion`, `unidad_medida_estado`, `id_tipo_unidad_medida`, `valor_unidad_medida`, `unidad_medida_abreviatura`, `codigo_sunat`, `descripcion_sunat`, `cu_tabla`) VALUES
(1, 'Kilogramos', 1, 1, NULL, 'kg', '01', 'KILOGRAMOS', '20542322412'),
(2, 'Gramos', 1, 1, NULL, 'g', '06', 'GRAMOS', '20542322412'),
(3, 'Toneladas', 1, 1, NULL, 'T', '04', 'TONELADAS MÉTRICAS', '20542322412'),
(4, 'miligramos', 1, 1, NULL, 'mg', NULL, NULL, '20542322412'),
(5, 'Mensual', 1, 9, 30.00, NULL, NULL, NULL, '20542322412'),
(6, 'Quincenal', 1, 9, 15.00, NULL, NULL, NULL, '20542322412'),
(7, 'Semanal', 1, 9, 7.00, NULL, NULL, NULL, '20542322412'),
(8, 'Diario', 1, 9, 1.00, NULL, NULL, NULL, '20542322412'),
(9, 'Anual', 1, 9, 360.00, NULL, NULL, NULL, '20542322412'),
(10, '(25%)Ganado de trabajo y reproducción; redes de pesca.', 1, 13, 0.25, NULL, NULL, NULL, '20542322412'),
(11, '(20%) Vehículos de transporte terrestre (excepto ferrocarriles); hornos en general.', 1, 13, 0.20, NULL, NULL, NULL, '20542322412'),
(12, '(20%)  Maquinaria y equipo utilizados por las actividades minera, petrolera y de construcción; excepto muebles, enseres y equipos de oficina', 1, 13, 0.20, NULL, NULL, NULL, '20542322412'),
(13, '(25%) Equipos de procesamiento de datos', 1, 13, 0.25, NULL, NULL, NULL, '20542322412'),
(14, '(10%) Maquinaria y equipo adquirido a partir del 1.1.91. 1', 1, 13, 0.10, NULL, NULL, NULL, '20542322412'),
(15, '(10%) Otros bienes del activo fijo 10', 1, 13, 0.10, NULL, NULL, NULL, '20542322412'),
(16, 'Litros', 1, 11, NULL, 'l', '08', 'LITROS', '20542322412'),
(17, 'Mililitros', 1, 11, NULL, 'ml', NULL, NULL, '20542322412'),
(18, 'Metro cubicos', 1, 11, NULL, 'm3', '14', 'METROS CÚBICOS', '20542322412'),
(19, 'Centimetros Cubicos', 1, 11, NULL, 'cm3', NULL, NULL, '20542322412'),
(20, 'b', NULL, 2, 0.00, NULL, NULL, NULL, '20542322412'),
(21, 'den1', NULL, 3, 0.00, NULL, NULL, NULL, '20542322412'),
(22, 'den2', NULL, 3, 0.00, NULL, NULL, NULL, '20542322412'),
(25, 'Unidad', 1, 14, 0.00, 'unid.', '07', 'UNIDADES', '20542322412'),
(26, 'Caja', 1, 14, 0.00, NULL, '12', 'CAJAS', '20542322412');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `igv` decimal(11,2) NOT NULL,
  `descuento` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `tipo_comprobante` int(11) NOT NULL,
  `nro_comprobante` varchar(100) NOT NULL,
  `serie` varchar(100) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `monto_entregado` decimal(11,2) DEFAULT NULL,
  `vuelto` decimal(11,2) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `venta_estado_consumo` int(11) DEFAULT '0',
  `id_vendedor` int(11) DEFAULT NULL,
  `tipo_venta` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `subtotal`, `igv`, `descuento`, `total`, `tipo_comprobante`, `nro_comprobante`, `serie`, `estado`, `monto_entregado`, `vuelto`, `id_cliente`, `venta_estado_consumo`, `id_vendedor`, `tipo_venta`) VALUES
(29, '2019-11-24', '180.00', '0.00', '0.00', '180.00', 1, '20', '001', '1', '180.00', '0.00', 14, 0, 1, 2),
(30, '2019-11-24', '180.00', '0.00', '0.00', '180.00', 1, '21', '001', '1', '180.00', '0.00', 15, 0, 1, 2),
(31, '2019-11-24', '71.00', '0.00', '0.00', '71.00', 1, '22', '001', '1', '80.00', '9.00', 16, 0, 1, 2),
(32, '2019-11-24', '390.60', '0.00', '0.00', '390.60', 1, '23', '001', '1', '390.60', '0.00', 16, 0, 1, 1),
(33, '2019-11-25', '390.60', '0.00', '0.00', '390.60', 1, '24', '001', '1', '400.00', '9.40', 17, 0, 1, 1),
(34, '2019-11-25', '390.60', '0.00', '0.00', '390.60', 1, '25', '001', '1', '400.00', '9.40', 15, 0, 1, 1),
(35, '2019-11-25', '180.00', '0.00', '0.00', '180.00', 1, '26', '001', '1', '180.00', '0.00', 18, 0, 1, 2),
(36, '2019-11-26', '781.20', '0.00', '0.00', '781.20', 1, '27', '001', '1', '800.00', '18.80', 18, 0, 1, 1),
(37, '2019-11-26', '390.60', '0.00', '0.00', '390.60', 1, '28', '001', '1', '400.00', '9.40', 15, 0, 1, 1),
(38, '2019-11-26', '70.00', '0.00', '0.00', '70.00', 1, '29', '001', '1', '100.00', '30.00', 19, 0, 1, 2),
(39, '2019-11-26', '390.60', '0.00', '0.00', '390.60', 1, '30', '001', '1', '400.00', '9.40', 15, 0, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`almacen_id`) USING BTREE,
  ADD KEY `id_sede` (`id_sede`) USING BTREE;

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`asistencia_id`) USING BTREE,
  ADD KEY `cliente_id` (`cliente_id`) USING BTREE;

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`categoria_producto_id`) USING BTREE,
  ADD KEY `id_sede` (`id_sede`) USING BTREE;

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`) USING BTREE,
  ADD KEY `tipo_documento_cliente_id` (`tipo_documento_cliente_id`) USING BTREE;

--
-- Indices de la tabla `detalle_doc_sede`
--
ALTER TABLE `detalle_doc_sede`
  ADD KEY `fk_doc_det` (`detalle_id_documento`) USING BTREE,
  ADD KEY `fk_sed_det` (`detalle_id_sede`) USING BTREE;

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `tipo_membresia` (`tipo_membresia`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`) USING BTREE,
  ADD KEY `fk_tipodoc` (`id_tipodocumento`) USING BTREE;

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`empleado_id`) USING BTREE,
  ADD KEY `fk_perfil_empleado` (`perfil_id`) USING BTREE,
  ADD KEY `empresa_ruc` (`empresa_ruc`) USING BTREE,
  ADD KEY `empresa_sede` (`empresa_sede`) USING BTREE;

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_ruc`) USING BTREE;

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`) USING BTREE,
  ADD KEY `marca_producto_ibfk_1` (`id_sede`) USING BTREE;

--
-- Indices de la tabla `membresia`
--
ALTER TABLE `membresia`
  ADD PRIMARY KEY (`membresia_id`) USING BTREE,
  ADD KEY `tipo_membresia_id` (`tipo_membresia_id`) USING BTREE,
  ADD KEY `cliente_id` (`cliente_id`) USING BTREE;

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`modulo_id`) USING BTREE;

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`moneda_id`) USING BTREE;

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`perfil_id`) USING BTREE;

--
-- Indices de la tabla `permisos_sede`
--
ALTER TABLE `permisos_sede`
  ADD KEY `fk_detalle_sed` (`persed_id_sede`) USING BTREE,
  ADD KEY `fk_detalle_per` (`persed_id_perfil`) USING BTREE,
  ADD KEY `fk_detalle_mod` (`persed_id_modulo`) USING BTREE;

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`) USING BTREE,
  ADD KEY `categoria_producto_id` (`categoria_producto_id`) USING BTREE,
  ADD KEY `producto_ibfk_3` (`unidad_medida_id`) USING BTREE,
  ADD KEY `producto_ibfk_4` (`tipo_unidad_medida_id`) USING BTREE;

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`) USING BTREE,
  ADD KEY `empresa_ruc` (`empresa_ruc`) USING BTREE,
  ADD KEY `id_distrito` (`id_distrito`) USING BTREE;

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`tipodoc_id`) USING BTREE;

--
-- Indices de la tabla `tipo_documento_cliente`
--
ALTER TABLE `tipo_documento_cliente`
  ADD PRIMARY KEY (`tipo_documento_cliente_id`) USING BTREE;

--
-- Indices de la tabla `tipo_membresia`
--
ALTER TABLE `tipo_membresia`
  ADD PRIMARY KEY (`tipo_membresia_id`) USING BTREE;

--
-- Indices de la tabla `tipo_unidad_medida`
--
ALTER TABLE `tipo_unidad_medida`
  ADD PRIMARY KEY (`id_tipo_unidad_medida`) USING BTREE;

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id_unidad_medida`) USING BTREE,
  ADD KEY `id_tipo_unidad_medida` (`id_tipo_unidad_medida`) USING BTREE;

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `almacen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `asistencia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `categoria_producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `empleado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `membresia`
--
ALTER TABLE `membresia`
  MODIFY `membresia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `modulo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `moneda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `perfil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `tipodoc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipo_documento_cliente`
--
ALTER TABLE `tipo_documento_cliente`
  MODIFY `tipo_documento_cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_membresia`
--
ALTER TABLE `tipo_membresia`
  MODIFY `tipo_membresia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_unidad_medida`
--
ALTER TABLE `tipo_unidad_medida`
  MODIFY `id_tipo_unidad_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id_unidad_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD CONSTRAINT `almacenes_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);

--
-- Filtros para la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD CONSTRAINT `categoria_producto_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`tipo_documento_cliente_id`) REFERENCES `tipo_documento_cliente` (`tipo_documento_cliente_id`);

--
-- Filtros para la tabla `detalle_doc_sede`
--
ALTER TABLE `detalle_doc_sede`
  ADD CONSTRAINT `detalle_doc_sede_ibfk_1` FOREIGN KEY (`detalle_id_documento`) REFERENCES `documento` (`id_documento`),
  ADD CONSTRAINT `detalle_doc_sede_ibfk_2` FOREIGN KEY (`detalle_id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`),
  ADD CONSTRAINT `detalle_venta_ibfk_3` FOREIGN KEY (`tipo_membresia`) REFERENCES `tipo_membresia` (`tipo_membresia_id`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_tipodocumento`) REFERENCES `tipo_documento` (`tipodoc_id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`perfil_id`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`empresa_ruc`) REFERENCES `empresa` (`empresa_ruc`),
  ADD CONSTRAINT `empleados_ibfk_3` FOREIGN KEY (`empresa_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `marca`
--
ALTER TABLE `marca`
  ADD CONSTRAINT `marca_producto_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `membresia`
--
ALTER TABLE `membresia`
  ADD CONSTRAINT `membresia_ibfk_1` FOREIGN KEY (`tipo_membresia_id`) REFERENCES `tipo_membresia` (`tipo_membresia_id`),
  ADD CONSTRAINT `membresia_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);

--
-- Filtros para la tabla `permisos_sede`
--
ALTER TABLE `permisos_sede`
  ADD CONSTRAINT `permisos_sede_ibfk_1` FOREIGN KEY (`persed_id_modulo`) REFERENCES `modulos` (`modulo_id`),
  ADD CONSTRAINT `permisos_sede_ibfk_2` FOREIGN KEY (`persed_id_perfil`) REFERENCES `perfiles` (`perfil_id`),
  ADD CONSTRAINT `permisos_sede_ibfk_3` FOREIGN KEY (`persed_id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_producto_id`) REFERENCES `categoria_producto` (`categoria_producto_id`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidad_medida` (`id_unidad_medida`),
  ADD CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`tipo_unidad_medida_id`) REFERENCES `tipo_unidad_medida` (`id_tipo_unidad_medida`);

--
-- Filtros para la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD CONSTRAINT `unidad_medida_ibfk_1` FOREIGN KEY (`id_tipo_unidad_medida`) REFERENCES `tipo_unidad_medida` (`id_tipo_unidad_medida`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cliente_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

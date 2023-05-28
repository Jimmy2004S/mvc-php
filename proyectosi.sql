-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2023 a las 21:37:14
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
-- Base de datos: `proyectosi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `codigo` int(11) NOT NULL,
  `carrera` varchar(40) NOT NULL,
  `semestre` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`codigo`, `carrera`, `semestre`) VALUES
(20222, 'Ingenieria de Sistemas', 4),
(20225, 'Calidad', 3),
(20250, 'Derecho', 8),
(20254, 'Arte', 7),
(20259, 'Ingeniería de Sistemas', 4),
(20263, 'Ingeniería de Sistemas', 1),
(20264, 'Derecho', 5),
(20268, 'Turismo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `codigo_grupo` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`codigo_grupo`, `nombre`) VALUES
(2000, 'Otakus'),
(2002, 'Investigadores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_persona`
--

CREATE TABLE `grupo_persona` (
  `codigo_grupo` int(11) NOT NULL,
  `codigo_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo_persona`
--

INSERT INTO `grupo_persona` (`codigo_grupo`, `codigo_persona`) VALUES
(2000, 20222),
(2000, 20223),
(2000, 20224),
(2000, 20225),
(2002, 20222);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `codigo_persona` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `tipo_persona` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Inhabilitado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`codigo_persona`, `nombre`, `apellido`, `identificacion`, `tipo_persona`, `email`, `clave`, `telefono`, `estado`) VALUES
(20221, 'Admin', 'UNICOLOMBO', '19052023', 'Administrador', 'jimmy.jimenez@unicolombo.edu.co', 'facil', '3016634773', 'Activo'),
(20222, 'Shina', 'Mashiro', '1070000', 'Estudiante', 'shina.m@gmail.com', '12345', '1111111', 'Activo'),
(20223, 'Eren', 'Yeager', '5555', 'Profesor', 'Atack.Titan@.com,', '5555', '303', 'Activo'),
(20224, 'lena', 'Yea', '12121212', 'Profesor', 'AtackTittan@.com,', '12121212', '303', 'Activo'),
(20225, 'Daniel', 'D', '4444', 'Estudiante', 'S', '4444', 'S', 'Activo'),
(20249, 'Asgard', 'jj', '1111', 'Profesor', 'jimmy.jimenez@unicolombo.edu.co', '1111', '1111', 'Activo'),
(20250, 'Belio', 'Vanega', '2222', 'Estudiante', 'beliovanega@gmail.com', '2222', '66', 'Activo'),
(20251, 'Camelia', 'dasddaa', '3333', 'Profesor', 'jimmy.jimenez@unicolombo.edu.co', '3333', '2323', 'Activo'),
(20252, 'Felix', 'Lameda', '11111111', 'Profesor', 'jimmy.jimenez@unicolombo.edu.co', '11111111', '6575', 'Activo'),
(20254, 'Hotaru', 'asd', '8888', 'Estudiante', 'Hasd@gmail.com', '8888', '8888', 'Activo'),
(20256, 'Izland', 'IS', '9999', 'Profesor', 'izlandIS@gmail.com', '9999', '9999', 'Activo'),
(20257, 'Amenadiel', 'Sur', '111', 'Profesor', 'amenadielS@gmail.com', '1111', '111', 'Activo'),
(20258, 'Goliat', 'Gn', '7777', 'Profesor', 'GoliatGN@gmail.com', '7777', '7777', 'Activo'),
(20259, 'Jimmy Isaac', 'Jimenez Bravo', '1043635986', 'Estudiante', 'jimmy.jimenez@unicolombo.edu.co', 'jimmy', '3016634773', 'Activo'),
(20263, 'Esteban', 'Marcos Verdugo', '5202152114', 'Estudiante', 'EstebanM@gmail.com', 'esteban15', '11111111', 'Activo'),
(20264, 'Ian ', 'Turner DVM', '9114', 'Estudiante', 'ianTurner@hotmail.com', 'ian21', '9114', 'Activo'),
(20265, 'Sharon', ' Caldwell', '2081191614', 'Profesor', 'sharonc@gmail.com', 'sharon3', '2081191614', 'Activo'),
(20266, 'Gabriela', 'Florez ', '6666', 'Profesor', 'gabrielaflorez@gmail.com', '6666', '6666', 'Activo'),
(20267, 'Janel', 'Soto ', '10101010', 'Profesor', 'JanelSoto@hotmail.com', '10101010', '10101010', 'Activo'),
(20268, 'Melissa', 'Durango', '13131313', 'Estudiante', 'melisaD@hotmail.com', '13131313', '13131313', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `codigo` int(11) NOT NULL,
  `departamento` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`codigo`, `departamento`) VALUES
(20223, 'Informatica'),
(20224, 'Turismo'),
(20249, 'Sociologia'),
(20251, 'Arte'),
(20252, 'Leyes'),
(20256, 'Literatura'),
(20257, 'Historia'),
(20258, 'Historia'),
(20265, 'Literatura'),
(20266, 'Informatica'),
(20267, 'Lenguas y cultura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_inicio` varchar(30) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `codigo_grupo` int(11) DEFAULT NULL,
  `codigo_lider_proyecto` int(11) NOT NULL,
  `archivo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`codigo`, `nombre`, `descripcion`, `fecha_inicio`, `likes`, `codigo_grupo`, `codigo_lider_proyecto`, `archivo`) VALUES
(2134, 'Creación de un juego educativo', 'Crea un juego educativo en línea o en una aplicación móvil que enseñe conceptos de ciencias, matemáticas o cualquier otro tema que sea de interés.', '15-05-2023 23:06', 4, 2000, 20222, '18-05-2023-18-19_Creación de un juego educativo.jpg'),
(2135, 'Software de Administración para proyectos en la Universidad UNICOLOMBO.', 'Creacion de una plataforma universitaria que permite de forma interactuar y administrar los proyectos realizados por el cuerpo de la comunidad.', '16-05-2023 22:39', 12, 2000, 20259, '16-05-2023-22-39_ProAula.rar'),
(2136, 'Análisis de datos de la industria alimentaria', 'Recopila y analiza datos de la industria alimentaria para entender mejor los patrones de consumo y los impactos ambientales y sociales de los procesos de producción.', '16-05-2023 22:46', 9, 2000, 20250, '16-05-2023-22-46_Análisis de datos de la industria alimentaria.jpg'),
(2137, 'Sistema de monitoreo de la calidad del aire en tiempo real', 'Proyecto que busca monitorear la calidad del aire en una ciudad y proporcionar información en tiempo real a los ciudadanos.', '16-05-2023 22:48', 8, 2000, 20251, '16-05-2023-22-48_Investigación de la calidad del aire en la ciudad.jpg'),
(2138, 'Desarrollo de una aplicación móvil de aprendizaje de idiomas', 'Crear una app interactiva que proporcione lecciones de idiomas, ejercicios de vocabulario y gramática, así como pruebas de evaluación para ayudar a los usuarios a aprender nuevos idiomas de manera efectiva.', '16-05-2023 22:58', 10, 2000, 20225, '16-05-2023-22-58_Desarrollo de una aplicación móvil de aprendizaje de idiomas.jpg'),
(2144, 'Reflexiones sobre el turismo cultural', 'El turismo cultural puede ser un positivo instrumento de desarrollo local y regional, entendido esto último desde una visión socio-económica que permita una equitativa distribución de los beneficios, ya sean de carácter económico, social y cultural en las', '18-05-2023 20:59', 2, NULL, 20268, '18-05-2023-20-59_Reflexiones sobre el turismo cultural.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos_likes`
--

CREATE TABLE `proyectos_likes` (
  `id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos_likes`
--

INSERT INTO `proyectos_likes` (`id`, `proyecto_id`, `usuario_id`) VALUES
(173, 2134, 20222),
(151, 2134, 20223),
(133, 2134, 20225),
(156, 2134, 20258),
(189, 2135, 20222),
(182, 2136, 20221),
(169, 2136, 20222),
(149, 2136, 20223),
(144, 2136, 20225),
(166, 2136, 20252),
(159, 2136, 20254),
(163, 2136, 20256),
(154, 2136, 20258),
(178, 2136, 20268),
(181, 2138, 20221),
(168, 2138, 20222),
(147, 2138, 20223),
(145, 2138, 20225),
(165, 2138, 20252),
(157, 2138, 20254),
(161, 2138, 20256),
(152, 2138, 20258),
(176, 2138, 20268),
(193, 2144, 20222);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`codigo_grupo`);

--
-- Indices de la tabla `grupo_persona`
--
ALTER TABLE `grupo_persona`
  ADD PRIMARY KEY (`codigo_grupo`,`codigo_persona`),
  ADD KEY `codigo_persona` (`codigo_persona`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`codigo_persona`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_grupo` (`codigo_grupo`),
  ADD KEY `codigo_lider_proyecto` (`codigo_lider_proyecto`);

--
-- Indices de la tabla `proyectos_likes`
--
ALTER TABLE `proyectos_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_proyecto_usuario_likes` (`proyecto_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `codigo_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2003;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `codigo_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20269;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2145;

--
-- AUTO_INCREMENT de la tabla `proyectos_likes`
--
ALTER TABLE `proyectos_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`codigo`) REFERENCES `persona` (`codigo_persona`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupo_persona`
--
ALTER TABLE `grupo_persona`
  ADD CONSTRAINT `grupo_persona_ibfk_1` FOREIGN KEY (`codigo_grupo`) REFERENCES `grupo` (`codigo_grupo`) ON DELETE CASCADE,
  ADD CONSTRAINT `grupo_persona_ibfk_2` FOREIGN KEY (`codigo_persona`) REFERENCES `persona` (`codigo_persona`) ON DELETE CASCADE;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`codigo`) REFERENCES `persona` (`codigo_persona`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`codigo_grupo`) REFERENCES `grupo` (`codigo_grupo`),
  ADD CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`codigo_lider_proyecto`) REFERENCES `persona` (`codigo_persona`);

--
-- Filtros para la tabla `proyectos_likes`
--
ALTER TABLE `proyectos_likes`
  ADD CONSTRAINT `proyectos_likes_ibfk_1` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`codigo`) ON DELETE CASCADE,
  ADD CONSTRAINT `proyectos_likes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `persona` (`codigo_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

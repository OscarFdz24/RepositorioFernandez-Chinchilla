-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2024 a las 19:19:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fitsyncronizer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dietas`
--

CREATE TABLE `dietas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_dieta` varchar(255) NOT NULL,
  `descripcion` varchar(2500) NOT NULL,
  `en_proceso` tinyint(1) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dietas`
--

INSERT INTO `dietas` (`id`, `id_usuario`, `nombre_dieta`, `descripcion`, `en_proceso`, `fecha`) VALUES
(29, 1, 'Dieta Estricta perso', '-&lt;b&gt;&lt;span style=&quot;color:rgb(0,0,255);&quot;&gt;cara&lt;/span&gt;&lt;/b&gt;&lt;p&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;-cola&lt;/span&gt;&lt;/p&gt;', 1, '2024-06-01 17:59:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamiento`
--

CREATE TABLE `entrenamiento` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `dia` varchar(200) NOT NULL,
  `rutina` varchar(2500) DEFAULT NULL,
  `grupo_muscular` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `like`
--

INSERT INTO `like` (`id`, `id_perfil`, `id_usuario`) VALUES
(155, 13, 15),
(156, 14, 16),
(157, 15, 17),
(158, 16, 15),
(159, 15, 19),
(160, 17, 19),
(161, 16, 19),
(162, 13, 19),
(163, 14, 19),
(164, 18, 20),
(165, 15, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_profesional`
--

CREATE TABLE `perfil_profesional` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `nombre_personal` varchar(255) DEFAULT NULL,
  `nombre_usuario_profesional` varchar(255) DEFAULT NULL,
  `descripcion_personal` varchar(2500) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `anos_experiencia` int(11) DEFAULT NULL,
  `datos_contacto` varchar(255) DEFAULT NULL,
  `trabajos_anteriores` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil_profesional`
--

INSERT INTO `perfil_profesional` (`id`, `id_usuario`, `imagen`, `nombre_personal`, `nombre_usuario_profesional`, `descripcion_personal`, `edad`, `anos_experiencia`, `datos_contacto`, `trabajos_anteriores`) VALUES
(13, 15, '1ce12c6e3596c6eff854d73de108827a.png', 'Maria', 'Maria22', 'Hola, soy Maria. He estado trabajando en el sector de la nutricion y el fitness, creando dietas reguladas para mis clientes y supervisando entrenamientos personalizados. Espero que nos llevemos bien :)', 22, 2, 'maria@gmail.com', 'Hosteleria y nutricion'),
(14, 16, 'ea51d81f7411b8bd76eb1471df918bef.png', 'Juan', 'JuanJefe', 'Hola, me llamo Juan y soy el mejor entrenador personal que vas a encontrar por aqui.', 30, 10, 'juan@gmail.com', 'He estado siempre de entrenador y preparador fisico'),
(15, 17, '4d8f0b19f4982b9de2f43fc92715da99.jpg', 'Joan', 'Joan Pradells', 'Hola, soy Joan Pradells, culturista profesional y entrenador fitness Senior. Ofrezco rutinas de entrenamientos, dietas personalizadas y eventos para culturistas', 28, 8, 'joan@gmail.com', 'Jugador de Rugby'),
(16, 18, 'ac5cab32fec0a0d241af744b1d2b3db1.png', 'Enrique', 'EnriqueBoy', 'Hola soy Enrique y acabo de terminar mi curso de nutricionismo y preparador fisico', 18, 0, 'enrique@gmail.com', 'Ninguno'),
(17, 19, 'c9a98643034e5032473292d0885d27d4.jpg', 'Pepe', 'PepeTop', 'Hola soy Pepe, quiero ver que tal est&aacute; la aplicacion', 40, 18, 'pepe@gmail.com', 'Camionero, repartidor, entrenador de boxeo'),
(18, 20, 'e6efc11f665ffedf5d4cbed124b8f796.jpg', 'Laura', 'LauraMis', 'Hola soy Laura, como estais. Soy entrenadora personal', 30, 8, 'laura@gmail.com', 'Siempre he trabajado de esto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `rol` varchar(500) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `perfil_publico` tinyint(1) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rol`, `nombre`, `nombre_usuario`, `correo`, `contrasena`, `telefono`, `perfil_publico`, `fecha`) VALUES
(1, 'Profesional', 'Oscar', 'Roo', 'oscar@gmail.com', '$2y$10$rSe2X.QfI.PY.GwefIcPVO0fWCN7y08J29ITyljFgr9cFD84JBGJi', '1234', 1, '2024-05-05 19:36:46'),
(10, 'Administrador', 'admin', 'admin', 'admin@gmail.com', '$2y$10$rXt.dfUm49ZoNGI/qQtg4.Fo9yKmYfhPj/J9bXk5WHudWmq/WjSMO', NULL, 0, '2024-06-12 16:07:56'),
(15, 'Profesional', 'Maria', 'Maria22', 'maria@gmail.com', '$2y$10$H.vjzSuvmPStw.lLctWfq.8JibbYw9JyCIz23WeflEXlMSAuVQCDW', '666666664', 1, '2024-06-16 17:42:04'),
(16, 'Profesional', 'Juan', 'JuanJefe', 'juan@gmail.com', '$2y$10$UPNGgm6.Fu2ulYLfcWf7U.bN0QFExJIBOoEBIcfPNiNoWoqXN90Se', '666666662', 1, '2024-06-17 10:47:58'),
(17, 'Profesional', 'Joan Pradells', 'Joan Pradells', 'joan@gmail.com', '$2y$10$I08hfjfC2P3a70XS017SRuz.7Y3YjSMdxaT/fVF1XrYV5ileW93Je', '666666669', 1, '2024-06-17 10:51:09'),
(18, 'Profesional', 'Enrique', 'EnriqueBoy', 'enrique@gmail.com', '$2y$10$rvGhS8cJllf4yO3.YVy2k.cPN.EKZ.RsUbKhQYNVokRjicUWpk90u', '666636666', 1, '2024-06-17 10:54:18'),
(19, 'Profesional', 'Pepe', 'PepeTop', 'pepe@gmail.com', '$2y$10$XSXeS2vngrOP.WXkcM9jlutOpl5SkHdQx7WgOGpfSnyabpuXKT0Ui', '662666666', 1, '2024-06-17 11:01:25'),
(20, 'Profesional', 'Laura', 'LauraMis', 'laura@gmail.com', '$2y$10$PLiec18ZWw9JsnOF/6EaN.AGeH7Ax82rDBN.qEiuRKn.rJ1.C2kCa', '666666634', 1, '2024-06-17 11:04:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dietas`
--
ALTER TABLE `dietas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `perfil_profesional`
--
ALTER TABLE `perfil_profesional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dietas`
--
ALTER TABLE `dietas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT de la tabla `perfil_profesional`
--
ALTER TABLE `perfil_profesional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dietas`
--
ALTER TABLE `dietas`
  ADD CONSTRAINT `dietas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD CONSTRAINT `entrenamiento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil_profesional` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfil_profesional`
--
ALTER TABLE `perfil_profesional`
  ADD CONSTRAINT `perfil_profesional_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-12-2016 a las 04:32:56
-- Versión del servidor: 5.7.16-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ProyectoBD`
--
CREATE DATABASE IF NOT EXISTS `ProyectoBD` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ProyectoBD`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarUsuario` (IN `name` VARCHAR(50), IN `age` INT(11), IN `address` VARCHAR(100), IN `run` VARCHAR(10), IN `genre` VARCHAR(1), IN `phone` VARCHAR(15), IN `region` VARCHAR(100), IN `mail` VARCHAR(255), IN `user_type` VARCHAR(25))  INSERT INTO `users` (`mission_id`, `adm_enc_id`, `name`, `age`, `address`, `run`, `genre`, `phone`, `region`, `mail`, `score`, `volunteer_state`, `user_type`) VALUES
(NULL, NULL, NOMBRE, EDAD, DIRECCION, RUT, GENERO, TELEFONO, REGION, CORREO, 0, 'DISPONIBLE', TIPO_USER)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `VoluntariosDisponibles` ()  SELECT * FROM users WHERE volunteer_state='DISPONIBLE'$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abilities`
--

CREATE TABLE `abilities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `abilities`
--

INSERT INTO `abilities` (`id`, `name`) VALUES
(1, 'Constructor'),
(2, 'Constructor'),
(3, 'Mirador'),
(4, 'Sacador de vuelta'),
(5, 'Planificador'),
(6, 'Motivador'),
(8, 'Bombero'),
(9, 'Carpintero'),
(10, 'Matemático'),
(11, 'Acoplador'),
(12, 'Prevencionista'),
(13, 'Resistencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abilities_missions`
--

CREATE TABLE `abilities_missions` (
  `mission_id` int(11) NOT NULL,
  `ability_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `abilities_missions`
--

INSERT INTO `abilities_missions` (`mission_id`, `ability_id`) VALUES
(1, 2),
(2, 2),
(3, 3),
(3, 8),
(4, 9),
(4, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abilities_users`
--

CREATE TABLE `abilities_users` (
  `ability_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `abilities_users`
--

INSERT INTO `abilities_users` (`ability_id`, `user_id`) VALUES
(2, 15),
(2, 16),
(2, 17),
(4, 8),
(4, 9),
(4, 26),
(5, 23),
(8, 24),
(9, 23),
(10, 18),
(10, 19),
(10, 27),
(11, 20),
(11, 22),
(12, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calls`
--

CREATE TABLE `calls` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `volunteer_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `state` varchar(15) NOT NULL DEFAULT 'NO CONFIRMADO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calls`
--

INSERT INTO `calls` (`id`, `manager_id`, `volunteer_id`, `task_id`, `date`, `state`) VALUES
(1, 1, 8, 1, '2016-11-02 00:00:00', 'NO CONFIRMADO'),
(3, 1, 9, 2, '2016-11-04 00:00:00', 'NO CONFIRMADO'),
(4, 20, 16, 3, NULL, 'NO CONFIRMADO'),
(5, 20, 17, 3, NULL, 'NO CONFIRMADO'),
(6, 20, 18, 4, NULL, 'NO CONFIRMADO'),
(7, 21, 19, 4, NULL, 'NO CONFIRMADO'),
(8, 21, 22, 5, NULL, 'NO CONFIRMADO'),
(9, 10, 24, 2, '2016-12-16 06:31:51', 'CONFIRMADO');

--
-- Disparadores `calls`
--
DELIMITER $$
CREATE TRIGGER `CallConfirmation` AFTER UPDATE ON `calls` FOR EACH ROW UPDATE users AS U
INNER JOIN calls AS C
ON U.id = NEW.volunteer_id
SET U.volunteer_state = 'NO DISPONIBLE'
WHERE C.state = 'CONFIRMADO'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `SendManuals` AFTER UPDATE ON `calls` FOR EACH ROW BEGIN

SET @user_id = (SELECT NEW.volunteer_id);
SET @task_id = (SELECT NEW.task_id);
SET @manual_id = (SELECT M.id
                 FROM manuals AS M
                 WHERE M.task_id = @task_id);
                 
INSERT INTO `manuals_requests` (`user_id`, `manual_id`, `request_date`)
VALUES (@user_id, @manual_id, CURRENT_TIMESTAMP);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emergencies`
--

CREATE TABLE `emergencies` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `place` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `gravity` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `state` varchar(15) DEFAULT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emergencies`
--

INSERT INTO `emergencies` (`id`, `admin_id`, `place`, `date`, `gravity`, `description`, `state`, `name`) VALUES
(5, 1, 'Petrolifera', '2016-11-01 00:00:00', 1, 'La vola del tolueno', 'NO FINALIZADO', 'Incendio forestal'),
(6, 1, 'China', '2016-11-09 00:00:00', 2, '5 millones de chinos en la china, se han suicidado de forma colectiva.', 'NO FINALIZADO', 'Suicidio colectivo'),
(7, 1, 'DIINF', '2016-12-16 08:00:00', 12, 'Hay que ir a cachorrear.', 'NO FINALIZADO', 'Cachorreo masivo'),
(10, 25, 'Chile', '2016-12-19 07:00:00', 5, 'Puros cachorros en esta alianza', 'NO FINALIZADO', 'Tangananica'),
(11, 25, 'Chile', '2016-12-16 13:00:00', 4, 'Con una sonrisa en la cara.', 'NO FINALIZADO', 'Saludar gente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manuals`
--

CREATE TABLE `manuals` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `manuals`
--

INSERT INTO `manuals` (`id`, `task_id`, `name`) VALUES
(1, 1, 'Uso de serrucho'),
(2, 1, 'Uso de martillo'),
(3, 2, 'Como motivar a la gente'),
(4, 3, 'Como barrer escombros'),
(5, 3, 'Como reciclar escombros'),
(6, 3, 'Cuidados al barrer escombros'),
(7, 4, 'Como usar una motosierra'),
(8, 5, 'Curaciones básicas'),
(9, 6, 'Alimentos para tipos de animales'),
(10, 7, 'Separación de alimentos según su tipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manuals_requests`
--

CREATE TABLE `manuals_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `manual_id` int(11) NOT NULL,
  `request_date` datetime DEFAULT NULL,
  `devolution_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `manuals_requests`
--

INSERT INTO `manuals_requests` (`request_id`, `user_id`, `manual_id`, `request_date`, `devolution_date`) VALUES
(2, 24, 3, '2016-12-16 03:32:56', '2016-12-16 04:05:42'),
(3, 24, 3, '2016-12-16 04:00:13', '2016-12-16 04:05:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `missions`
--

CREATE TABLE `missions` (
  `id` int(11) NOT NULL,
  `emergency_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `region_mission` varchar(100) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `volunteers_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `missions`
--

INSERT INTO `missions` (`id`, `emergency_id`, `start_date`, `finish_date`, `region_mission`, `name`, `description`, `volunteers_quantity`) VALUES
(1, 5, '2016-11-02 00:00:00', '2016-12-15 15:30:00', 'Región Metropolitana de Santiago', 'Salvar el semestre', 'Ayudar a los heridos del semestre.', 15),
(2, 5, '2016-11-08 00:00:00', '2016-12-16 10:00:00', 'Región Metropolitana de Santiago', 'Pasar el ramo de DBD', 'Ponerle wendy al proyecto.', 20),
(3, 5, '2016-12-16 10:00:00', NULL, 'Metropolitana', 'Suicidio colectivo', 'Agilizar el flujo de gente.', 30),
(4, 6, '2016-12-21 13:00:00', NULL, 'Región Metropolitana de Santiago', 'Relajar la pera 2.', 'Nada que decir.', 50),
(5, 7, '2016-12-28 09:00:00', NULL, 'Región Metropolitana de Santiago', 'Apagar incendio', 'Ocurrió un incendio en el Cerro Lonquén', 120),
(6, 11, '2016-12-28 00:00:00', NULL, 'Región Metropolitana de Santiago', 'Ayuda post-inundación', 'Inundación en sector rural de difícil acceso.', 80),
(7, 10, '2017-01-11 12:00:00', NULL, 'Región de Magallanes y la Antártica Chilena', 'Despejar zona afectada por alud', 'Alud en un pueblo, cercano a la base chilena.', 110),
(8, 10, '2016-12-21 09:00:00', NULL, 'Región del Libertador General Bernardo O Higgins', 'Ayuda post-terremoto', 'Se necesita de voluntarios experimentados para una situación de extrema urgencia.', 360);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_date` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `gravity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reports`
--

INSERT INTO `reports` (`id`, `task_id`, `user_id`, `entry_date`, `description`, `gravity`) VALUES
(1, 1, 9, '2016-11-02 07:18:35', 'El JP y loco veja no pasa ná o.o....', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `state` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `mission_id`, `state`, `name`, `description`) VALUES
(1, 3, 'NO FINALIZADO', 'Buscar leña', 'Incendio volcánico.'),
(2, 1, 'FINALIZADO', 'Recoger basura', 'Recoger basura de la calle.'),
(3, 8, 'NO FINALIZADO', 'Barrer escombros', 'Eliminar escombros del camino\r\n'),
(4, 5, 'NO FINALIZADO', 'Cortar árboles', 'Cortar árboles quemados'),
(5, 5, 'NO FINALIZADO', 'Curar heridos', 'Curar heridos quemados'),
(6, 8, 'NO FINALIZADO', 'Alimentar animales', 'Alimentar animales en refugio'),
(7, 6, 'NO FINALIZADO', 'Recaudar alimento', 'Recaudar alimento donado en cajas'),
(8, 4, 'FINALIZADO', 'Probar la BD', 'Con esto se prueba la BD'),
(9, 4, 'NO FINALIZADO', 'Fixear algunos asuntirijillos', 'Probando probando 123 123');

--
-- Disparadores `tasks`
--
DELIMITER $$
CREATE TRIGGER `FreeUsers` AFTER UPDATE ON `tasks` FOR EACH ROW BEGIN
UPDATE users AS U
JOIN (SELECT C.volunteer_id
      FROM tasks AS T
      INNER JOIN calls AS C
      ON T.id = C.task_id
      WHERE T.state = 'FINALIZADO') AS R
ON U.id = R.volunteer_id
SET U.volunteer_state = 'DISPONIBLE';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ReturnManuals` AFTER UPDATE ON `tasks` FOR EACH ROW BEGIN
UPDATE manuals_requests AS M
JOIN (SELECT C.volunteer_id
      FROM tasks AS T
      INNER JOIN calls AS C
      ON T.id = C.task_id
      WHERE T.state = 'FINALIZADO') AS R
ON M.user_id = R.volunteer_id
SET M.devolution_date = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizarPuntajes` AFTER UPDATE ON `tasks` FOR EACH ROW UPDATE users AS U
INNER JOIN calls AS C
ON U.id = C.volunteer_id
INNER JOIN tasks AS T
ON C.task_id = T.id
SET U.score = U.score + 1
WHERE T.state = 'FINALIZADO'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mission_id` int(11) DEFAULT NULL,
  `adm_enc_id` int(11) DEFAULT NULL,
  `run` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `volunteer_state` varchar(20) DEFAULT NULL,
  `user_type` varchar(25) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `genre` varchar(1) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `region` varchar(100) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `username` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `mission_id`, `adm_enc_id`, `run`, `password`, `name`, `mail`, `volunteer_state`, `user_type`, `age`, `address`, `genre`, `phone`, `region`, `score`, `username`) VALUES
(1, NULL, NULL, '18091503-6', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Arthur Kevin Peña Lozano', 'arthur.pena@usach.cl', 'DISPONIBLE', 'Voluntario', 24, 'Av. General Gambino 4367', 'M', '+56991334545', 'Región Metropolitana de Santiago', 0, '18091503-6'),
(8, NULL, NULL, '19237546-0', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Juan Pablo Rojas Rojas', 'indiopicaro@gmail.com', 'DISPONIBLE', 'Voluntario', 22, 'El Campo 0147', 'M', '+56997656008', 'Región Metropolitana de Santiago', 1, '19237546-0'),
(9, NULL, NULL, '19276279-0', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Benjamín Enrique Hernández Cortés', 'pericolospalotes@gmail.com', 'DISPONIBLE', 'Voluntario', 23, 'Talagante 123', 'M', '+56965036713', 'Región Metropolitana de Santiago', 1, '19276279-0'),
(10, 4, NULL, '19208940-9', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Pablo Antonio Cáceres Luzanto', 'asd@asd.cl\r\n', 'DISPONIBLE', 'Encargado', 23, 'La Punta del Cerro 241', 'M', '+56944509882', 'Valparaíso', 7, '19208940-9'),
(15, 3, NULL, '18840716-1', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'David Esteban Aguilar Guerrero', 'luluca@usach.cl', 'DISPONIBLE', 'Encargado', 24, 'Las Vizcachas 659', 'M', '+56981355545', 'Región Metropolitana de Santiago', 10, '18840716-1'),
(16, NULL, NULL, '18543123-1', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Roberto Alejandro Garcia Carmona', 'ralejandro.garcia@gmail.com', 'NO DISPONIBLE', 'Voluntario', 21, 'En mi casita.', 'M', '+56974638594', 'Región de Magallanes y la Antártica Chilena', 4, '18543123-1'),
(17, NULL, NULL, '20546786-9', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Paulina Javiera Bascuñan Recabarren', 'pb.recabarren@gmail.com', 'NO DISPONIBLE', 'Voluntario', 17, '', 'F', '+56965437646', 'Región de Magallanes y la Antártica Chilena', 0, '20546786-9'),
(18, NULL, NULL, '19542954-5', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Camila Andrea Muñoz Galáz', 'camila.muñoz12@gmail.com', 'DISPONIBLE', 'Voluntario', 23, '', 'F', '+56966623418', 'Región Metropolitana de Santiago', 34, '19542954-5'),
(19, NULL, NULL, '17546321-8', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Jesús Gonzalo Maduro Gonzalez', 'jesus.madura@gmail.com', 'DISPONIBLE', 'Voluntario', 23, '', 'M', '+56943513445', 'Región del Libertador General Bernardo O Higgins', 0, '17546321-8'),
(20, 5, NULL, '15342234-1', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Alejandro Elliu Oróstica Guerrero', 'indioale@gmail.com', 'NO DISPONIBLE', 'Encargado', 37, '', 'M', '+56934534125', 'Región del Libertador General Bernardo O Higgins', 0, '15342234-1'),
(21, 6, NULL, '17453221-0', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Daniel Esteban Gonzalez Rojas', 'dgoro@gmail.com', 'NO DISPONIBLE', 'Encargado', 21, '', 'M', '+56966849398', 'Región del Libertador General Bernardo O Higgins', 2, '17453221-0'),
(22, 8, NULL, '11235325-1', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Pedro Ignacio López Garcia', 'peiglopez@gmail.com', 'DISPONIBLE', 'Encargado', 44, '', 'M', '+56985746383', 'Región del Bío-Bío', 23, '11235325-1'),
(23, NULL, NULL, '14645234-2', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Juan Ignacio Soto Rifo', 'juan.sotor@gmail.com', 'DISPONIBLE', 'Voluntario', 38, '', 'M', '+56984372828', 'Región del Bío-Bío', 1, '14645234-2'),
(24, NULL, NULL, '21256753-3', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Maria Constanza Astudillo Garcia', 'mastudillo@gmail.com', 'DISPONIBLE', 'Voluntario', 20, '', 'F', '+56983475334', 'Región Metropolitana de Santiago', 24, '21256753-3'),
(25, NULL, NULL, '12145675-7', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Alejandra Macarena Asturias Morgado', 'alejandra.macas@gmail.com', 'NO DISPONIBLE', 'Administrador', 51, '', 'F', '+56945489291', 'Región Metropolitana de Santiago', 79, '12145675-7'),
(26, 4, NULL, '12345678-9', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Antonio Ríos - El Maestro', 'marcianitocumbiero@gmail.com', 'DISPONIBLE', 'Encargado', 62, 'Argentina Cheee 14', 'M', '+51428947310', 'Malvinas Argentinas', 50, '12345678-9'),
(27, NULL, NULL, '11223344-5', '$2y$10$ND2V0I57PGmAJvxapwgJy.80WFhsIj5.3HIOr8MhV57ajfBsPSi/W', 'Nicolás God Mariángel', 'nicomgod@elcielo.com', 'DISPONIBLE', 'Encargado', 21, 'Nadie lo sabe', 'M', '+56984751243', 'Región Metropolitana de Santiago', 100, '11223344-5');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `abilities_missions`
--
ALTER TABLE `abilities_missions`
  ADD PRIMARY KEY (`mission_id`,`ability_id`),
  ADD KEY `FK_HABILIDAD_NECESITA` (`ability_id`);

--
-- Indices de la tabla `abilities_users`
--
ALTER TABLE `abilities_users`
  ADD PRIMARY KEY (`user_id`,`ability_id`),
  ADD KEY `FK_HABILIDAD` (`ability_id`);

--
-- Indices de la tabla `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ENCARGADO_LLAMADO` (`manager_id`),
  ADD KEY `FK_VOLUNTARIO_LLAMADO` (`volunteer_id`),
  ADD KEY `FK_TAREA_LLAMADO` (`task_id`);

--
-- Indices de la tabla `emergencies`
--
ALTER TABLE `emergencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_EMERGENCIA_ADM` (`admin_id`);

--
-- Indices de la tabla `manuals`
--
ALTER TABLE `manuals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_MANUAL_TAREA` (`task_id`);

--
-- Indices de la tabla `manuals_requests`
--
ALTER TABLE `manuals_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `FK_PETICION_USUARIO` (`user_id`),
  ADD KEY `FK_PETICION_MANUAL` (`manual_id`);

--
-- Indices de la tabla `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_EMERGENCIA` (`emergency_id`);

--
-- Indices de la tabla `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_REPORTE_TAREA` (`task_id`),
  ADD KEY `FK_REPORTE_USUARIO` (`user_id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TAREA_MISION` (`mission_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `run` (`run`),
  ADD KEY `fk_adm_enc` (`adm_enc_id`),
  ADD KEY `fk_Mision` (`mission_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `abilities_missions`
--
ALTER TABLE `abilities_missions`
  MODIFY `mission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `abilities_users`
--
ALTER TABLE `abilities_users`
  MODIFY `ability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `emergencies`
--
ALTER TABLE `emergencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `manuals`
--
ALTER TABLE `manuals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `manuals_requests`
--
ALTER TABLE `manuals_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abilities_missions`
--
ALTER TABLE `abilities_missions`
  ADD CONSTRAINT `FK_HABILIDAD_NECESITA` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`),
  ADD CONSTRAINT `FK_MISION_NECESITA` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`);

--
-- Filtros para la tabla `abilities_users`
--
ALTER TABLE `abilities_users`
  ADD CONSTRAINT `FK_HABILIDAD` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`),
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `calls`
--
ALTER TABLE `calls`
  ADD CONSTRAINT `FK_ENCARGADO_LLAMADO` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_TAREA_LLAMADO` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `FK_VOLUNTARIO_LLAMADO` FOREIGN KEY (`volunteer_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `emergencies`
--
ALTER TABLE `emergencies`
  ADD CONSTRAINT `FK_EMERGENCIA_ADM` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `manuals`
--
ALTER TABLE `manuals`
  ADD CONSTRAINT `FK_MANUAL_TAREA` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Filtros para la tabla `manuals_requests`
--
ALTER TABLE `manuals_requests`
  ADD CONSTRAINT `FK_PETICION_MANUAL` FOREIGN KEY (`manual_id`) REFERENCES `manuals` (`id`),
  ADD CONSTRAINT `FK_PETICION_USUARIO` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `FK_EMERGENCIA` FOREIGN KEY (`emergency_id`) REFERENCES `emergencies` (`id`);

--
-- Filtros para la tabla `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `FK_REPORTE_TAREA` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `FK_REPORTE_USUARIO` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `FK_TAREA_MISION` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Mision` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`),
  ADD CONSTRAINT `fk_adm_enc` FOREIGN KEY (`adm_enc_id`) REFERENCES `users` (`id`);
--
-- Base de datos: `fundamenta`
--
CREATE DATABASE IF NOT EXISTS `fundamenta` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fundamenta`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateSurveyDB` (IN `complaint_id` INT(11))  INSERT INTO
surveys (`complaint_id`, `calificacion`, `detalles`)
VALUES
(complaint_id, 0, '')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteComplaintDB` (IN `user_id` INT(11))  DELETE FROM complaints
WHERE `propietario_id` = user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUserDB` (IN `user_id` INT(11))  DELETE FROM `users`
WHERE `id` = user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetBuildingsDB` (IN `user_id` INT(11))  SELECT DISTINCT B.id, B.nombre
FROM
(
	SELECT P.id
	FROM properties AS P
    WHERE user_id = P.propietario_id
)
AS R
INNER JOIN buildings AS B
ON B.id = R.id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEjecutoresDB` (IN `complaint_date` DATE)  SELECT U.id, U.nombre, U.especialidad
FROM users AS U
WHERE U.role = 'ejecutor'
AND U.disponibilidad >= complaint_date$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPropertiesDB` (IN `user_id` INT(11), IN `building_id` INT(11))  SELECT P.id, P.numero
FROM properties AS P
WHERE user_id = P.propietario_id
AND building_id = P.building_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUsersDB` ()  SELECT `id`, `username`, `password`, `role`, `nombre`, `run`, `email`, `telefono`, `direccion`, `especialidad`
FROM `users`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertComplaintDB` (IN `user_id` INT(11), IN `property_id` INT(11), IN `tipo_falla` VARCHAR(20), IN `descripcion` TEXT, IN `disponibilidad` DATE)  INSERT INTO `complaints`(`propietario_id`, `property_id`, `tipo_falla`, `prioridad`, `estado_actual`, `descripcion`, `disponibilidad`, `created`)
VALUES (user_id, property_id, tipo_falla, 'SIN ASIGNAR', 'EN ESPERA', descripcion, disponibilidad, CURRENT_DATE)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUserDB` (IN `username` VARCHAR(50), IN `pass` VARCHAR(255), IN `role` VARCHAR(20), IN `nombre` VARCHAR(50), IN `run` VARCHAR(20), IN `email` VARCHAR(50), IN `telefono` VARCHAR(15))  INSERT INTO `users`(`username`, `password`, `role`, `nombre`, `run`, `email`, `telefono`,`created`)
VALUES (username, pass, role, nombre, run, email, telefono, CURRENT_TIMESTAMP)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateComplaintEjecutorDB` (IN `id_complaint` INT(11), IN `estado_actual` VARCHAR(20))  UPDATE complaints
SET `estado_actual` = estado_actual
WHERE `id` = id_complaint$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateComplaintSupervisorBD` (IN `id_complaint` INT(11), IN `ejecutor_id` INT(11), IN `prioridad` VARCHAR(20), IN `estado_actual` VARCHAR(20))  UPDATE complaints
SET `ejecutor_id` = ejecutor_id,
	`prioridad` = prioridad,
    `estado_actual` = estado_actual,
    `modified` = CURRENT_TIMESTAMP
WHERE `id` = id_complaint$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSurveyDB` (IN `survey_id` INT(11), IN `calificacion` INT(11), IN `detalles` TEXT)  UPDATE surveys AS S
SET S.calificacion = calificacion, S.detalles = detalles
WHERE S.id = survey_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `comuna` varchar(20) NOT NULL,
  `ciudad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `buildings`
--

INSERT INTO `buildings` (`id`, `supervisor_id`, `nombre`, `direccion`, `comuna`, `ciudad`) VALUES
(1, 8, 'Eco Vista', 'Los Carrera 1131', 'Copiapó', 'Copiapó'),
(2, 9, 'Eco Futuro I', 'Radal 066', 'Estación Central', 'Santiago'),
(3, 10, 'Eco Fusión', 'Darío Urzúa 1591', 'Providencia', 'Santiago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) NOT NULL,
  `ejecutor_id` int(11) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  `tipo_falla` varchar(20) NOT NULL,
  `prioridad` varchar(20) NOT NULL,
  `estado_actual` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `comentarios` text,
  `disponibilidad` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `complaints`
--

INSERT INTO `complaints` (`id`, `propietario_id`, `ejecutor_id`, `property_id`, `tipo_falla`, `prioridad`, `estado_actual`, `descripcion`, `comentarios`, `disponibilidad`, `created`, `modified`) VALUES
(1, 2, 5, 1, 'Equipamiento', 'URGENTE', 'ASIGNADO', 'El gas no funciona', NULL, '2017-01-05', '2016-12-13 00:00:00', '2016-12-13 00:54:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `piso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `properties`
--

INSERT INTO `properties` (`id`, `building_id`, `propietario_id`, `name`, `direccion`, `numero`, `piso`) VALUES
(1, 1, 2, 'Eco Vista, Departamento 101', 'Los Carrera 1131, Copiapó, Copiapó', 101, 1),
(2, 2, 2, 'Eco Futuro I, Departamento 202', 'Radal 066, Estación Central, Santiago', 202, 2),
(3, 2, NULL, 'Eco Futuro I, Departamento 212', 'Radal 066, Estación Central, Santiago', 212, 2),
(4, 3, 4, 'Eco Fusión, Departamento 303', 'Darío Urzúa 1591, Providencia, Santiago', 303, 3),
(5, 3, 4, 'Eco Fusión, Departamento 602', 'Darío Urzúa 1591, Providencia, Santiago', 602, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `detalles` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `surveys`
--

INSERT INTO `surveys` (`id`, `complaint_id`, `calificacion`, `detalles`) VALUES
(1, 1, 9, 'Hola Mundo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `run` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `especialidad` varchar(20) DEFAULT NULL,
  `disponibilidad` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nombre`, `run`, `email`, `telefono`, `direccion`, `especialidad`, `disponibilidad`, `created`, `modified`) VALUES
(2, 'propietario1', '$2y$10$lMSOr5kekEkHSLD9vFlVf.V6mobyLuteeUdkIShEcXmUZ0XnoYwna', 'propietario', 'Juan Carlos Herrera Parra', '14856927-0', 'jcarlos1@gmail.com', '+56984752653', NULL, NULL, NULL, '2016-12-12 21:53:54', '2016-12-12 21:53:54'),
(4, 'propietario3', '$2y$10$OQWCJD24OImfoo8aONQiOuxsPtbkyPhbtDkD5rTAJaplsGeakm.3C', 'propietario', 'Humberto Ricardo Suazo Coloma', '14875632-5', 'chupetoide4@gmail.com', '+56941827654', NULL, NULL, NULL, '2016-12-12 21:53:54', '2016-12-12 21:53:54'),
(5, 'ejecutor1', '$2y$10$egzXYV2D80LJC4kmv./QJOii2AK6CiZJE3whKim6wYVWPPQDHl2Nq', 'ejecutor', 'Mario Tomás Castro Cortés', '14524146-2', 'mario.tomas2@gmail.com', '+56944570012', NULL, 'Gásfiter', '2017-01-12', '2016-12-12 21:53:54', '2016-12-12 21:53:54'),
(6, 'ejecutor2', '$2y$10$yfVaNzveWHaOvOu5teSxcuBCropjX/vJPw4Et3rtVnSklXNR1obuK', 'ejecutor', 'Luigi Santiago Rosales Acuña', '14504796-1', 'donluigi7@gmail.com', '+56999854701', NULL, 'Gásfiter', '2017-01-15', '2016-12-12 21:53:54', '2016-12-12 21:53:54'),
(7, 'ejecutor3', '$2y$10$G2cvw.cFrmQmeJ7e.P.5G.ucuPDN1nZz73CgUwkgcB3Hky5de..3G', 'ejecutor', 'Carlos Javier Nuñez Vergara', '15142447-7', 'carlosja11@gmail.com', '+56953252263', NULL, 'Eléctricista', '2017-01-22', '2016-12-12 21:53:54', '2016-12-12 21:53:54'),
(8, 'supervisor1', '$2y$10$7HuWyifMns/HBoxjN8V1LuUqQnuD1qeBkmb5fm/X6IB9w22IKK7cq', 'supervisor', 'Ricardo Enrique Pérez Rosales', '15557896-5', 'rosalesre14@gmail.com', '+56954872263', NULL, NULL, NULL, '2016-12-12 21:53:54', '2016-12-12 21:53:54'),
(9, 'supervisor2', '$2y$10$g8LhgZzzUAHQ2PoQf61Kruy72RVPcYkRtsIeya0CWKDdBTXAUYRSi', 'supervisor', 'Francisco Marcos Olarra Rosales', '12445784-K', 'pancho.or5@gmail.com', '+56954887650', NULL, NULL, NULL, '2016-12-12 21:53:54', '2016-12-12 21:53:54'),
(10, 'supervisor3', '$2y$10$gvS0d22GpktWrDbCESu3z.3wiNiz8ZzW0J6wSTpL5K.bNyndSxMH6', 'supervisor', 'Lorena Alejandra Rojas Eyzaguirre', '16221485-0', 'lore.alej22@gmail.com', '+56922548700', NULL, NULL, NULL, '2016-12-12 21:53:54', '2016-12-12 21:53:54'),
(11, 'admin1', '$2y$10$Q9H8a7ovp975X8F1s6ByqO4qrXlZLza.iaa.Gul33HEBJ.qA6GcMW', 'administrador', 'Benjamin Rafael Hernández Araneda', '16322674-9', 'callmegod@gmail.com', '+56224579685', NULL, NULL, NULL, '2016-12-12 21:53:54', '2016-12-12 21:53:54');

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `CleanBuildingsDB` BEFORE DELETE ON `users` FOR EACH ROW UPDATE properties
SET `propietario_id` = NULL
WHERE `propietario_id` = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CleanComplaintsDB` BEFORE DELETE ON `users` FOR EACH ROW DELETE FROM complaints
WHERE `propietario_id` = OLD.id
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indices de la tabla `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propietario_id` (`propietario_id`),
  ADD KEY `ejecutor_id` (`ejecutor_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indices de la tabla `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `propietario_id` (`propietario_id`);

--
-- Indices de la tabla `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_id` (`complaint_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`propietario_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`ejecutor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `complaints_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Filtros para la tabla `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`),
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`propietario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`);
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{"db":"ProyectoBD","table":"users"},{"db":"ProyectoBD","table":"calls"},{"db":"ProyectoBD","table":"tasks"},{"db":"ProyectoBD","table":"abilities_users"},{"db":"ProyectoBD","table":"manuals_requests"},{"db":"ProyectoBD","table":"missions"},{"db":"ProyectoBD","table":"emergencies"},{"db":"ProyectoBD","table":"manuals"},{"db":"ProyectoBD","table":"abilities_missions"},{"db":"ProyectoBD","table":"abilities"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2016-12-15 05:16:05', '{"lang":"es","collation_connection":"utf8mb4_unicode_ci"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2024 a las 05:03:18
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumcar`
--

CREATE TABLE `alumcar` (
  `id` int(10) UNSIGNED NOT NULL,
  `alumno` int(10) UNSIGNED NOT NULL,
  `carrera` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajaejemplar`
--

CREATE TABLE `bajaejemplar` (
  `id` int(10) UNSIGNED NOT NULL,
  `ejemplar` int(10) UNSIGNED NOT NULL,
  `fechaHora` datetime NOT NULL,
  `motivo` varchar(250) NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajaslibro`
--

CREATE TABLE `bajaslibro` (
  `id` int(10) UNSIGNED NOT NULL,
  `libro` int(13) UNSIGNED NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL,
  `fechaHora` datetime NOT NULL,
  `motivo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajassocios`
--

CREATE TABLE `bajassocios` (
  `id` int(10) UNSIGNED NOT NULL,
  `fechaHora` datetime NOT NULL,
  `motivo` varchar(250) NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL,
  `socioBaja` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carmat`
--

CREATE TABLE `carmat` (
  `id` int(10) UNSIGNED NOT NULL,
  `carrera` int(3) UNSIGNED NOT NULL,
  `materia` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `nombre` varchar(45) NOT NULL,
  `codigo` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `fechaDev` datetime NOT NULL,
  `observacion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discilibro`
--

CREATE TABLE `discilibro` (
  `id` int(10) UNSIGNED NOT NULL,
  `disciplina` int(10) UNSIGNED NOT NULL,
  `libro` int(13) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `dirección` varchar(250) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplares`
--

CREATE TABLE `ejemplares` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` int(4) UNSIGNED NOT NULL,
  `observación` varchar(250) NOT NULL,
  `libro` int(13) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplarprestamo`
--

CREATE TABLE `ejemplarprestamo` (
  `id` int(10) UNSIGNED NOT NULL,
  `prestamo` int(10) UNSIGNED NOT NULL,
  `ejemplar` int(10) UNSIGNED NOT NULL,
  `cantRenovaciones` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplarreserva`
--

CREATE TABLE `ejemplarreserva` (
  `id` int(10) UNSIGNED NOT NULL,
  `ejemplar` int(10) UNSIGNED NOT NULL,
  `reserva` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `ISBN` int(13) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `edicion` int(10) NOT NULL,
  `editorial` int(10) NOT NULL,
  `cantEjemplares` int(10) UNSIGNED NOT NULL,
  `estado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroautor`
--

CREATE TABLE `libroautor` (
  `id` int(10) UNSIGNED NOT NULL,
  `libro` int(13) UNSIGNED NOT NULL,
  `autor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `codigo` int(4) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio` int(8) UNSIGNED NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaVen` datetime NOT NULL,
  `tipo` binary(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio` int(8) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profmat`
--

CREATE TABLE `profmat` (
  `id` int(10) UNSIGNED NOT NULL,
  `profesor` int(10) UNSIGNED NOT NULL,
  `materia` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(10) UNSIGNED NOT NULL,
  `socio` int(8) UNSIGNED NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `motivoCan` varchar(250) DEFAULT NULL,
  `fechaCan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `dni` int(8) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `localidad` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `frenteDni` varchar(255) NOT NULL,
  `dorsoDni` varchar(255) NOT NULL,
  `fechaAlta` date NOT NULL,
  `estado` binary(1) NOT NULL,
  `tipoSocio` int(1) UNSIGNED NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipossocio`
--

CREATE TABLE `tipossocio` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposusuario`
--

CREATE TABLE `tiposusuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `tipoUsuario` int(10) UNSIGNED NOT NULL,
  `estado` binary(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumcar`
--
ALTER TABLE `alumcar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `alumno` (`alumno`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socio` (`socio`);

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bajaejemplar`
--
ALTER TABLE `bajaejemplar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `ejemplar` (`ejemplar`);

--
-- Indices de la tabla `bajaslibro`
--
ALTER TABLE `bajaslibro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro` (`libro`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `bajassocios`
--
ALTER TABLE `bajassocios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `socioBaja` (`socioBaja`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `carmat`
--
ALTER TABLE `carmat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia` (`materia`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `discilibro`
--
ALTER TABLE `discilibro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disciplina` (`disciplina`),
  ADD KEY `libro` (`libro`);

--
-- Indices de la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `dirección` (`dirección`);

--
-- Indices de la tabla `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `libro` (`libro`);

--
-- Indices de la tabla `ejemplarprestamo`
--
ALTER TABLE `ejemplarprestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestamo` (`prestamo`),
  ADD KEY `ejemplar` (`ejemplar`);

--
-- Indices de la tabla `ejemplarreserva`
--
ALTER TABLE `ejemplarreserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ejemplar` (`ejemplar`),
  ADD KEY `reserva` (`reserva`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `editorial` (`editorial`);

--
-- Indices de la tabla `libroautor`
--
ALTER TABLE `libroautor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro` (`libro`),
  ADD KEY `autor` (`autor`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socio` (`socio`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socio` (`socio`);

--
-- Indices de la tabla `profmat`
--
ALTER TABLE `profmat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor` (`profesor`),
  ADD KEY `materia` (`materia`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socio` (`socio`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `frenteDni` (`frenteDni`,`dorsoDni`),
  ADD UNIQUE KEY `usuario_3` (`usuario`),
  ADD KEY `tipoSocio` (`tipoSocio`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `tipossocio`
--
ALTER TABLE `tipossocio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiposusuario`
--
ALTER TABLE `tiposusuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `tipoUsuario` (`tipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumcar`
--
ALTER TABLE `alumcar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bajaejemplar`
--
ALTER TABLE `bajaejemplar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bajaslibro`
--
ALTER TABLE `bajaslibro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carmat`
--
ALTER TABLE `carmat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `discilibro`
--
ALTER TABLE `discilibro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejemplares`
--
ALTER TABLE `ejemplares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejemplarprestamo`
--
ALTER TABLE `ejemplarprestamo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejemplarreserva`
--
ALTER TABLE `ejemplarreserva`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libroautor`
--
ALTER TABLE `libroautor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profmat`
--
ALTER TABLE `profmat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `tipoSocio` int(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipossocio`
--
ALTER TABLE `tipossocio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposusuario`
--
ALTER TABLE `tiposusuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumcar`
--
ALTER TABLE `alumcar`
  ADD CONSTRAINT `alumcar_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumcar_ibfk_2` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`socio`) REFERENCES `socios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bajaejemplar`
--
ALTER TABLE `bajaejemplar`
  ADD CONSTRAINT `bajaejemplar_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bajaejemplar_ibfk_2` FOREIGN KEY (`ejemplar`) REFERENCES `ejemplares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bajaslibro`
--
ALTER TABLE `bajaslibro`
  ADD CONSTRAINT `bajaslibro_ibfk_1` FOREIGN KEY (`libro`) REFERENCES `libro` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bajaslibro_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bajassocios`
--
ALTER TABLE `bajassocios`
  ADD CONSTRAINT `bajassocios_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bajassocios_ibfk_2` FOREIGN KEY (`socioBaja`) REFERENCES `socios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carmat`
--
ALTER TABLE `carmat`
  ADD CONSTRAINT `carmat_ibfk_1` FOREIGN KEY (`materia`) REFERENCES `materias` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carmat_ibfk_2` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `discilibro`
--
ALTER TABLE `discilibro`
  ADD CONSTRAINT `discilibro_ibfk_1` FOREIGN KEY (`disciplina`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discilibro_ibfk_2` FOREIGN KEY (`libro`) REFERENCES `libro` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD CONSTRAINT `ejemplares_ibfk_1` FOREIGN KEY (`libro`) REFERENCES `libro` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ejemplarprestamo`
--
ALTER TABLE `ejemplarprestamo`
  ADD CONSTRAINT `ejemplarprestamo_ibfk_1` FOREIGN KEY (`prestamo`) REFERENCES `prestamos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ejemplarprestamo_ibfk_2` FOREIGN KEY (`ejemplar`) REFERENCES `ejemplares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ejemplarreserva`
--
ALTER TABLE `ejemplarreserva`
  ADD CONSTRAINT `ejemplarreserva_ibfk_1` FOREIGN KEY (`ejemplar`) REFERENCES `ejemplares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ejemplarreserva_ibfk_2` FOREIGN KEY (`reserva`) REFERENCES `reservas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libroautor`
--
ALTER TABLE `libroautor`
  ADD CONSTRAINT `libroautor_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libroautor_ibfk_2` FOREIGN KEY (`libro`) REFERENCES `libro` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`socio`) REFERENCES `socios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`socio`) REFERENCES `socios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profmat`
--
ALTER TABLE `profmat`
  ADD CONSTRAINT `profmat_ibfk_1` FOREIGN KEY (`profesor`) REFERENCES `profesores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profmat_ibfk_2` FOREIGN KEY (`materia`) REFERENCES `materias` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socios_ibfk_2` FOREIGN KEY (`tipoSocio`) REFERENCES `tipossocio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipoUsuario`) REFERENCES `tiposusuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

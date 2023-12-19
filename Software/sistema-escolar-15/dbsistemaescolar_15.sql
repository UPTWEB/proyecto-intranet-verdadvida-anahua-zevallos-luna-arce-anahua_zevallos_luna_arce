-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para dbsistemaescolar
CREATE DATABASE IF NOT EXISTS `dbsistemaescolar` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dbsistemaescolar`;

-- Volcando estructura para tabla dbsistemaescolar.ambientes
CREATE TABLE IF NOT EXISTS `ambientes` (
  `IdAmbiente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL COMMENT 'Ejemplos: 101, LabCiencia, PatioA, etc',
  `Ubicacion` varchar(255) DEFAULT NULL COMMENT 'Tabla Ubicacion o descripcion de la ubicación del ambiente/aula',
  `AforoMax` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdAmbiente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.ambientes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ambientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ambientes` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.anios_escolares
CREATE TABLE IF NOT EXISTS `anios_escolares` (
  `IdAnioEscolar` int(11) NOT NULL AUTO_INCREMENT,
  `AnioEscolar` varchar(9) NOT NULL COMMENT '"2023-2024" - "2024-2025"',
  `FechaInicio` date NOT NULL,
  `FechaFinalizacion` date NOT NULL,
  PRIMARY KEY (`IdAnioEscolar`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.anios_escolares: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `anios_escolares` DISABLE KEYS */;
INSERT INTO `anios_escolares` (`IdAnioEscolar`, `AnioEscolar`, `FechaInicio`, `FechaFinalizacion`) VALUES
	(1, '2022-2023', '2022-03-01', '2023-02-28'),
	(2, '2023-2024', '2023-03-01', '2024-02-29'),
	(3, '2024-2025', '2024-03-01', '2025-02-28'),
	(4, '2025-2026', '2025-03-01', '2026-02-28');
/*!40000 ALTER TABLE `anios_escolares` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.apoderados
CREATE TABLE IF NOT EXISTS `apoderados` (
  `IdApoderado` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL,
  `ApellidoPaterno` varchar(255) NOT NULL,
  `ApellidoMaterno` varchar(255) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `CorreoPersonal` varchar(255) NOT NULL,
  `Celular` varchar(20) NOT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Departamento` varchar(255) DEFAULT NULL,
  `Provincia` varchar(255) DEFAULT NULL,
  `Distrito` varchar(255) DEFAULT NULL,
  `RelacionEstudiante` varchar(255) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Nacionalidad` varchar(255) DEFAULT NULL,
  `Primaria` tinyint(1) DEFAULT NULL,
  `Secundaria` tinyint(1) DEFAULT NULL,
  `CarreraTecnica` tinyint(1) DEFAULT NULL,
  `CarreraUniversitaria` tinyint(1) DEFAULT NULL,
  `ProfesionOcupacion` varchar(255) DEFAULT NULL,
  `CentroTrabajo` varchar(255) DEFAULT NULL,
  `Cargo` varchar(255) DEFAULT NULL,
  `ViveConEstudiante` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`IdApoderado`),
  UNIQUE KEY `DNI` (`DNI`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.apoderados: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `apoderados` DISABLE KEYS */;
INSERT INTO `apoderados` (`IdApoderado`, `Nombres`, `ApellidoPaterno`, `ApellidoMaterno`, `DNI`, `CorreoPersonal`, `Celular`, `Direccion`, `Departamento`, `Provincia`, `Distrito`, `RelacionEstudiante`, `FechaNacimiento`, `Nacionalidad`, `Primaria`, `Secundaria`, `CarreraTecnica`, `CarreraUniversitaria`, `ProfesionOcupacion`, `CentroTrabajo`, `Cargo`, `ViveConEstudiante`) VALUES
	(1, 'Julio Jose', 'Alvarez', 'aaaa', '2412312', 'julio123@gmail.com', '9384128', 'o', 'Tacna', 'Tacna', 'Tacna', 'Padre', '1930-04-30', 'Peruana', 0, 0, 0, 0, 'Empresario', 'Tacna', 'Padre', 0);
/*!40000 ALTER TABLE `apoderados` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.asistencias
CREATE TABLE IF NOT EXISTS `asistencias` (
  `IdAsistencia` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `EstadoAsistencia` enum('Asistio','Falta','Tardanza','Falta_Justificada') DEFAULT NULL COMMENT 'Estado de la asistencia del estudiante: Asistio, Falta, Tardanza, Falta_Justificada',
  `FKIdEstudiante` int(11) NOT NULL,
  `FKIdCurso_Profesor_Seccion` int(11) DEFAULT NULL COMMENT 'FKIdCurso NULL para Inicial y Primaria de ser necesario',
  PRIMARY KEY (`IdAsistencia`),
  KEY `FK_asistencias_estudiantes` (`FKIdEstudiante`),
  KEY `FK_asistencias_curso_profesor_seccion` (`FKIdCurso_Profesor_Seccion`),
  CONSTRAINT `FK_asistencias_curso_profesor_seccion` FOREIGN KEY (`FKIdCurso_Profesor_Seccion`) REFERENCES `curso_profesor_seccion` (`IdCurso_Profesor_Seccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asistencias_estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.asistencias: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `asistencias` DISABLE KEYS */;
INSERT INTO `asistencias` (`IdAsistencia`, `Fecha`, `EstadoAsistencia`, `FKIdEstudiante`, `FKIdCurso_Profesor_Seccion`) VALUES
	(1, '2023-03-10', 'Tardanza', 3, NULL),
	(2, '2023-03-10', 'Asistio', 4, NULL),
	(3, '2023-03-10', 'Asistio', 5, NULL),
	(4, '2023-03-11', 'Falta', 3, NULL),
	(5, '2023-03-11', 'Tardanza', 4, NULL),
	(6, '2023-03-11', 'Asistio', 5, NULL),
	(7, '2023-03-10', 'Falta', 3, NULL),
	(8, '2023-03-10', 'Falta', 4, NULL),
	(9, '2023-03-10', 'Tardanza', 5, NULL),
	(10, '2023-03-11', 'Asistio', 3, NULL),
	(11, '2023-03-11', 'Asistio', 4, NULL),
	(12, '2023-03-11', 'Tardanza', 5, NULL);
/*!40000 ALTER TABLE `asistencias` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.calendario
CREATE TABLE IF NOT EXISTS `calendario` (
  `IdCalendario` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `FKIdEvento` int(11) DEFAULT NULL,
  `FKIdTarea` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdCalendario`),
  KEY `FK_calendario_eventos` (`FKIdEvento`),
  KEY `FK_calendario_tareas` (`FKIdTarea`),
  CONSTRAINT `FK_calendario_eventos` FOREIGN KEY (`FKIdEvento`) REFERENCES `eventos` (`IdEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_calendario_tareas` FOREIGN KEY (`FKIdTarea`) REFERENCES `tareas` (`IdTarea`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.calendario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `calendario` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendario` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.configuracion_general
CREATE TABLE IF NOT EXISTS `configuracion_general` (
  `IdConfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `FechaInicioPrematricula` date DEFAULT NULL,
  `FechaFinPrematricula` date DEFAULT NULL,
  `MontoMatricula` decimal(10,2) DEFAULT NULL COMMENT '(I-P-S) ?',
  `MontoPension` decimal(10,2) DEFAULT NULL COMMENT '(I-P-S) ?',
  PRIMARY KEY (`IdConfiguracion`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.configuracion_general: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `configuracion_general` DISABLE KEYS */;
INSERT INTO `configuracion_general` (`IdConfiguracion`, `FechaInicioPrematricula`, `FechaFinPrematricula`, `MontoMatricula`, `MontoPension`) VALUES
	(1, '2023-11-10', '2023-10-10', 250.00, 450.00);
/*!40000 ALTER TABLE `configuracion_general` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.contacto_emergencia
CREATE TABLE IF NOT EXISTS `contacto_emergencia` (
  `IdContactoEmergencia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL,
  `Apellidos` varchar(255) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `Celular` varchar(20) NOT NULL,
  `TelefonoFijo` varchar(20) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Parentesco` varchar(50) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `OrdenPrioridad` int(11) DEFAULT NULL,
  `Departamento` varchar(255) NOT NULL,
  `Provincia` varchar(255) NOT NULL,
  `Distrito` varchar(255) NOT NULL,
  `ProfesionOcupacion` varchar(255) DEFAULT NULL,
  `FKIdEstudiante` int(11) NOT NULL,
  PRIMARY KEY (`IdContactoEmergencia`),
  KEY `FK_contacto_emergencia_estudiantes` (`FKIdEstudiante`),
  CONSTRAINT `FK_contacto_emergencia_estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.contacto_emergencia: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contacto_emergencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacto_emergencia` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.cursos
CREATE TABLE IF NOT EXISTS `cursos` (
  `IdCurso` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCurso` varchar(255) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  PRIMARY KEY (`IdCurso`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.cursos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` (`IdCurso`, `NombreCurso`, `Descripcion`) VALUES
	(1, 'Comunicacion', 'asdasd'),
	(2, 'Comunicacion', 'asda'),
	(3, 'Matematica', 'asdasd'),
	(4, 'Arte', 'sadasd');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.curso_profesor_seccion
CREATE TABLE IF NOT EXISTS `curso_profesor_seccion` (
  `IdCurso_Profesor_Seccion` int(11) NOT NULL AUTO_INCREMENT,
  `FKIdCurso` int(11) DEFAULT NULL,
  `FKIdProfesor` int(11) DEFAULT NULL,
  `FKIdSeccion` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdCurso_Profesor_Seccion`),
  KEY `FK_curso_profesor_seccion_cursos` (`FKIdCurso`),
  KEY `FK_curso_profesor_seccion_profesores` (`FKIdProfesor`),
  KEY `FK_curso_profesor_seccion_secciones` (`FKIdSeccion`),
  CONSTRAINT `FK_curso_profesor_seccion_cursos` FOREIGN KEY (`FKIdCurso`) REFERENCES `cursos` (`IdCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_curso_profesor_seccion_profesores` FOREIGN KEY (`FKIdProfesor`) REFERENCES `profesores` (`IdProfesor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_curso_profesor_seccion_secciones` FOREIGN KEY (`FKIdSeccion`) REFERENCES `secciones` (`IdSeccion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.curso_profesor_seccion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `curso_profesor_seccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso_profesor_seccion` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.estudiantes
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `IdEstudiante` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL,
  `Apellidos` varchar(255) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  `Estado` varchar(10) NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`IdEstudiante`),
  UNIQUE KEY `DNI` (`DNI`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.estudiantes: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `estudiantes` DISABLE KEYS */;
INSERT INTO `estudiantes` (`IdEstudiante`, `Nombres`, `Apellidos`, `DNI`, `FechaNacimiento`, `Activo`, `Estado`) VALUES
	(3, 'Justin', 'Zevallos', '72949727', '2003-06-03', 0, 'inactivo'),
	(4, 'Ivan', 'Mamani', '234312', '2008-03-30', 1, 'inactivo'),
	(5, 'a', 'e', '123123', '5333-04-23', 0, 'inactivo'),
	(6, 'Juan', 'Pérez', '12345678', '2005-01-01', 1, 'activo'),
	(10, 'Jose', 'PAz', '32341', '0000-00-00', 1, 'activo'),
	(14, 'Jose', 'PAz2', '0000', '0000-00-00', 1, 'activo'),
	(16, 'Jack', 'Purca', '12397129', '2007-04-04', 1, 'activo');
/*!40000 ALTER TABLE `estudiantes` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.estudiantes_apoderados
CREATE TABLE IF NOT EXISTS `estudiantes_apoderados` (
  `FKIdEstudiante` int(11) NOT NULL,
  `FKIdApoderado` int(11) NOT NULL,
  KEY `FK__estudiantes` (`FKIdEstudiante`),
  KEY `FK__apoderados` (`FKIdApoderado`),
  CONSTRAINT `FK__apoderados` FOREIGN KEY (`FKIdApoderado`) REFERENCES `apoderados` (`IdApoderado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.estudiantes_apoderados: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estudiantes_apoderados` DISABLE KEYS */;
/*!40000 ALTER TABLE `estudiantes_apoderados` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.eventos
CREATE TABLE IF NOT EXISTS `eventos` (
  `IdEvento` int(11) NOT NULL AUTO_INCREMENT,
  `NombreEvento` varchar(255) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Ubicacion` varchar(255) DEFAULT NULL,
  `FechaHoraInicio` datetime DEFAULT NULL,
  `FechaHoraFin` datetime DEFAULT NULL,
  `TipoEvento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.eventos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.grados
CREATE TABLE IF NOT EXISTS `grados` (
  `IdGrado` int(11) NOT NULL AUTO_INCREMENT,
  `NombreGrado` varchar(255) NOT NULL,
  `Orden` int(11) NOT NULL,
  `FKIdNivel` int(11) NOT NULL,
  PRIMARY KEY (`IdGrado`),
  KEY `FK_grados_niveles` (`FKIdNivel`),
  CONSTRAINT `FK_grados_niveles` FOREIGN KEY (`FKIdNivel`) REFERENCES `niveles` (`IdNivel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.grados: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `grados` DISABLE KEYS */;
INSERT INTO `grados` (`IdGrado`, `NombreGrado`, `Orden`, `FKIdNivel`) VALUES
	(2, 'Primer Grado', 1, 1),
	(4, 'Segundo Grado', 1, 1);
/*!40000 ALTER TABLE `grados` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `IdHorario` int(11) NOT NULL AUTO_INCREMENT,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL,
  `DiaSemana` varchar(10) NOT NULL COMMENT 'Tabla o ENUM()',
  `FKIdAmbiente` int(11) DEFAULT NULL,
  `FKIdCurso_Docente_Seccion` int(11) NOT NULL,
  PRIMARY KEY (`IdHorario`),
  KEY `FK_horarios_ambientes` (`FKIdAmbiente`),
  KEY `FK_horarios_curso_profesor_seccion` (`FKIdCurso_Docente_Seccion`),
  CONSTRAINT `FK_horarios_ambientes` FOREIGN KEY (`FKIdAmbiente`) REFERENCES `ambientes` (`IdAmbiente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_horarios_curso_profesor_seccion` FOREIGN KEY (`FKIdCurso_Docente_Seccion`) REFERENCES `curso_profesor_seccion` (`IdCurso_Profesor_Seccion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.horarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.info_adicional
CREATE TABLE IF NOT EXISTS `info_adicional` (
  `IdInfoAdicional` int(11) NOT NULL AUTO_INCREMENT,
  `Genero` char(1) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Departamento` varchar(255) DEFAULT NULL,
  `Provincia` varchar(255) DEFAULT NULL,
  `Distrito` varchar(255) DEFAULT NULL,
  `TelefonoCasa` varchar(20) DEFAULT NULL,
  `FKIdEstudiante` int(11) NOT NULL COMMENT 'Sin UNIQUE permite registra un Historial de InfoAdicional',
  PRIMARY KEY (`IdInfoAdicional`),
  UNIQUE KEY `FKIdEstudiante` (`FKIdEstudiante`),
  CONSTRAINT `FK_info_adicional_estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.info_adicional: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `info_adicional` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_adicional` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.info_medica
CREATE TABLE IF NOT EXISTS `info_medica` (
  `IdInfoMedica` int(11) NOT NULL AUTO_INCREMENT,
  `Peso` decimal(5,2) DEFAULT NULL,
  `Estatura` decimal(5,2) DEFAULT NULL,
  `TipoSangre` varchar(3) DEFAULT NULL,
  `PresentaAlergias` tinyint(1) DEFAULT 0,
  `NombresAlergias` text DEFAULT NULL,
  `FKIdEstudiante` int(11) NOT NULL COMMENT 'Sin UNIQUE permite registra un Historial de InfoMedica',
  PRIMARY KEY (`IdInfoMedica`),
  UNIQUE KEY `FKIdEstudiante` (`FKIdEstudiante`),
  CONSTRAINT `FK_info_medica_estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.info_medica: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `info_medica` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_medica` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.matriculas
CREATE TABLE IF NOT EXISTS `matriculas` (
  `IdMatricula` int(11) NOT NULL AUTO_INCREMENT,
  `TipoMatricula` varchar(50) DEFAULT NULL COMMENT 'NuevaInscripcion - Renovacion - Descripcion?',
  `FechaMatricula` date NOT NULL COMMENT 'Anio en el q se raliza la matricula = now()',
  `FKIdEstudiante` int(11) NOT NULL,
  `FKIdGrado` int(11) NOT NULL,
  `FKIdSeccion` int(11) DEFAULT NULL,
  `FKIdAnioEscolar` int(11) NOT NULL,
  `EstadoDocumentos` varchar(100) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdMatricula`),
  KEY `FK_matriculas_estudiantes` (`FKIdEstudiante`),
  KEY `FK_matriculas_grados` (`FKIdGrado`),
  KEY `FK_matriculas_secciones` (`FKIdSeccion`),
  KEY `FK_matriculas_anios_escolares` (`FKIdAnioEscolar`),
  CONSTRAINT `FK_matriculas_anios_escolares` FOREIGN KEY (`FKIdAnioEscolar`) REFERENCES `anios_escolares` (`IdAnioEscolar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_matriculas_estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_matriculas_grados` FOREIGN KEY (`FKIdGrado`) REFERENCES `grados` (`IdGrado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_matriculas_secciones` FOREIGN KEY (`FKIdSeccion`) REFERENCES `secciones` (`IdSeccion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.matriculas: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `matriculas` DISABLE KEYS */;
INSERT INTO `matriculas` (`IdMatricula`, `TipoMatricula`, `FechaMatricula`, `FKIdEstudiante`, `FKIdGrado`, `FKIdSeccion`, `FKIdAnioEscolar`, `EstadoDocumentos`, `Estado`) VALUES
	(11, 'Nueva Inscripcion', '2023-12-04', 4, 2, 2, 1, 'Completos', 'Activa'),
	(12, 'Renovacion', '2023-12-04', 14, 4, 3, 2, 'Pendientes', 'Activa'),
	(16, 'Nueva Inscripcion', '2023-12-04', 3, 2, 2, 1, 'Completos', 'Activa'),
	(17, 'Nueva Inscripcion', '2023-12-05', 3, 2, 2, 1, 'Completos', 'Activa'),
	(18, 'Nueva Inscripcion', '2023-12-05', 4, 4, 3, 2, 'Completos', 'Activa');
/*!40000 ALTER TABLE `matriculas` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.mensajes
CREATE TABLE IF NOT EXISTS `mensajes` (
  `IdMensaje` int(11) NOT NULL AUTO_INCREMENT,
  `Asunto` varchar(50) DEFAULT NULL,
  `Cuerpo` varchar(50) DEFAULT NULL,
  `FechaEnvio` datetime DEFAULT NULL,
  `Leido` tinyint(1) DEFAULT 0,
  `FKIdEmisor` int(11) DEFAULT NULL,
  `FKIdReceptor` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdMensaje`),
  KEY `FK_mensajes_usuarios` (`FKIdEmisor`),
  KEY `FK_mensajes_usuarios_2` (`FKIdReceptor`),
  CONSTRAINT `FK_mensajes_usuarios` FOREIGN KEY (`FKIdEmisor`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_mensajes_usuarios_2` FOREIGN KEY (`FKIdReceptor`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.mensajes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.metodo_pago
CREATE TABLE IF NOT EXISTS `metodo_pago` (
  `IdMetodoPago` int(11) NOT NULL AUTO_INCREMENT,
  `NombreMetodoPago` varchar(50) NOT NULL,
  `Descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdMetodoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.metodo_pago: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `metodo_pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `metodo_pago` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.niveles
CREATE TABLE IF NOT EXISTS `niveles` (
  `IdNivel` int(11) NOT NULL AUTO_INCREMENT,
  `NombreNivel` varchar(255) NOT NULL,
  PRIMARY KEY (`IdNivel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.niveles: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `niveles` DISABLE KEYS */;
INSERT INTO `niveles` (`IdNivel`, `NombreNivel`) VALUES
	(1, 'primaria'),
	(3, 'Inical'),
	(4, 'Terciario');
/*!40000 ALTER TABLE `niveles` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.notas
CREATE TABLE IF NOT EXISTS `notas` (
  `IdNota` int(11) NOT NULL AUTO_INCREMENT,
  `ValorNota` decimal(5,2) NOT NULL,
  `NombreCompetencia` varchar(255) DEFAULT NULL,
  `FKIdEstudiante` int(11) NOT NULL,
  `FKIdCurso_Profesor_Seccion` int(11) NOT NULL,
  `FKIdPeriodoAcademico` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdNota`),
  KEY `FK_notas_estudiantes` (`FKIdEstudiante`),
  KEY `FK_notas_curso_profesor_seccion` (`FKIdCurso_Profesor_Seccion`),
  KEY `FK_notas_periodos_academicos` (`FKIdPeriodoAcademico`),
  CONSTRAINT `FK_notas_curso_profesor_seccion` FOREIGN KEY (`FKIdCurso_Profesor_Seccion`) REFERENCES `curso_profesor_seccion` (`IdCurso_Profesor_Seccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_notas_estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_notas_periodos_academicos` FOREIGN KEY (`FKIdPeriodoAcademico`) REFERENCES `periodos_academicos` (`IdPeriodoAcademico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.notas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `IdPago` int(11) NOT NULL AUTO_INCREMENT,
  `Monto` decimal(10,2) NOT NULL,
  `FechaPago` date NOT NULL,
  `TipoPago` varchar(50) DEFAULT '' COMMENT 'Descripcion del pago?',
  `Estado` varchar(50) DEFAULT NULL COMMENT 'pendiente?-completado-cancelado',
  `FKIdMatricula` int(11) DEFAULT NULL,
  `FKIdPension` int(11) DEFAULT NULL,
  `FKIdMetodoPago` int(11) NOT NULL,
  PRIMARY KEY (`IdPago`),
  KEY `FK_pagos_matriculas` (`FKIdMatricula`),
  KEY `FK_pagos_pensiones` (`FKIdPension`),
  KEY `FK_pagos_metodo_pago` (`FKIdMetodoPago`),
  CONSTRAINT `FK_pagos_matriculas` FOREIGN KEY (`FKIdMatricula`) REFERENCES `matriculas` (`IdMatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pagos_metodo_pago` FOREIGN KEY (`FKIdMetodoPago`) REFERENCES `metodo_pago` (`IdMetodoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pagos_pensiones` FOREIGN KEY (`FKIdPension`) REFERENCES `pensiones` (`IdPension`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.pagos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.pensiones
CREATE TABLE IF NOT EXISTS `pensiones` (
  `IdPension` int(11) NOT NULL AUTO_INCREMENT,
  `Mes` varchar(50) NOT NULL,
  `Monto` decimal(10,2) NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `EstadoPago` varchar(50) DEFAULT NULL COMMENT 'pendiente-pagado-atrasado?',
  `FKIdEstudiante` int(11) NOT NULL,
  `Boleta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdPension`),
  KEY `FK_pensiones_estudiantes` (`FKIdEstudiante`),
  CONSTRAINT `FK_pensiones_estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.pensiones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pensiones` DISABLE KEYS */;
INSERT INTO `pensiones` (`IdPension`, `Mes`, `Monto`, `FechaVencimiento`, `EstadoPago`, `FKIdEstudiante`, `Boleta`) VALUES
	(1, 'Marzo', 300.00, '2024-01-01', 'Pendiente', 4, NULL);
/*!40000 ALTER TABLE `pensiones` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.periodos_academicos
CREATE TABLE IF NOT EXISTS `periodos_academicos` (
  `IdPeriodoAcademico` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePeriodo` varchar(50) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `FKIdAnioEscolar` int(11) NOT NULL,
  PRIMARY KEY (`IdPeriodoAcademico`),
  KEY `FK_periodosacademicos_anios_escolares` (`FKIdAnioEscolar`),
  CONSTRAINT `FK_periodosacademicos_anios_escolares` FOREIGN KEY (`FKIdAnioEscolar`) REFERENCES `anios_escolares` (`IdAnioEscolar`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.periodos_academicos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `periodos_academicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodos_academicos` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.profesores
CREATE TABLE IF NOT EXISTS `profesores` (
  `IdProfesor` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL,
  `ApellidoPaterno` varchar(255) NOT NULL,
  `ApellidoMaterno` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Especialidad` varchar(255) NOT NULL,
  PRIMARY KEY (`IdProfesor`),
  UNIQUE KEY `Correo` (`Correo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.profesores: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `profesores` DISABLE KEYS */;
INSERT INTO `profesores` (`IdProfesor`, `Nombres`, `ApellidoPaterno`, `ApellidoMaterno`, `Correo`, `Especialidad`) VALUES
	(11, 'Tomas', 'Zevallos', 'Purca', 'correo1@example.com', 'Matematica'),
	(13, 'Johan', 'Palacios', 'Zapata', 'ajhssa@gmaik', 'Ciencia');
/*!40000 ALTER TABLE `profesores` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `IdRol` int(11) NOT NULL AUTO_INCREMENT,
  `NombreRol` varchar(255) NOT NULL,
  PRIMARY KEY (`IdRol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.roles: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`IdRol`, `NombreRol`) VALUES
	(1, 'Administrador'),
	(2, 'Apoderado'),
	(3, 'Profesor'),
	(4, 'Estudiante');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.secciones
CREATE TABLE IF NOT EXISTS `secciones` (
  `IdSeccion` int(11) NOT NULL AUTO_INCREMENT,
  `NombreSeccion` varchar(20) NOT NULL,
  `CuposTotales` int(11) NOT NULL,
  `CuposDisponibles` int(11) NOT NULL,
  `FKIdGrado` int(11) NOT NULL,
  PRIMARY KEY (`IdSeccion`),
  KEY `FK_secciones_grados` (`FKIdGrado`),
  CONSTRAINT `FK_secciones_grados` FOREIGN KEY (`FKIdGrado`) REFERENCES `grados` (`IdGrado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.secciones: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `secciones` DISABLE KEYS */;
INSERT INTO `secciones` (`IdSeccion`, `NombreSeccion`, `CuposTotales`, `CuposDisponibles`, `FKIdGrado`) VALUES
	(2, 'A', 30, 30, 2),
	(3, 'B', 29, 29, 2);
/*!40000 ALTER TABLE `secciones` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.tareas
CREATE TABLE IF NOT EXISTS `tareas` (
  `IdTarea` int(11) NOT NULL AUTO_INCREMENT,
  `NombreTarea` varchar(255) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `FechaEnvio` date DEFAULT NULL,
  `FechaEntrega` date DEFAULT NULL,
  `FKIdCurso_Profesor_Seccion` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdTarea`),
  KEY `FK_tareas_curso_profesor_seccion` (`FKIdCurso_Profesor_Seccion`),
  CONSTRAINT `FK_tareas_curso_profesor_seccion` FOREIGN KEY (`FKIdCurso_Profesor_Seccion`) REFERENCES `curso_profesor_seccion` (`IdCurso_Profesor_Seccion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.tareas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tareas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tareas` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_rol` int(11) NOT NULL,
  `imagen` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`IdRol`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.users: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `usuario`, `correo`, `password`, `fecha`, `id_rol`, `imagen`) VALUES
	(5, 'Administrador', 'admin@gmail.com', '$2y$05$rSGStdVtYXAeIMxNwVR1suYBn4LT7zwImjLKvEMTT7Rxx1kKlCA8W', '2023-08-19 12:40:13', 1, ''),
	(20, 'Emanuel', 'saul@gmail.com', '$2y$05$4rVBmwaaBu2Auh.XH87jFeNmrPdsgDL9JFL680q/QwKIeLpNpu7BW', '2023-08-28 14:37:24', 1, ''),
	(23, 'admin', 'admin@gmail.com', '$2y$05$rSGStdVtYXAeIMxNwVR1suYBn4LT7zwImjLKvEMTT7Rxx1kKlCA8W', '2023-11-15 07:29:28', 1, ''),
	(24, 'user', 'user@gmail.com', '$2y$05$DDd2ANjEjg6IJl00a6PGLerRY6b1CmBBJwnn12kivTlKhMfTyD56i', '2023-11-15 07:36:15', 3, ''),
	(25, 'profesor', 'profesor@gmail.com ', '$2y$05$mHnExScg.zDYmjZ7XFfo..omS0o3CYfoVJAX49JfUD9dCvhmj4jKC', '2023-11-15 09:26:48', 2, ''),
	(26, 'apoderado', 'apoderado@gmail.com ', '$2y$05$kGJmbx7U6SfKiEFuL7Yji.ifiRLoBtVvROAVot02GUhtP9czv5UVi', '2023-11-15 09:29:14', 4, '');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla dbsistemaescolar.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL COMMENT 'Nombre usuario en base a info personal o usar el correo',
  `correo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `FKIdRol` int(11) DEFAULT NULL,
  `FKIdApoderado` int(11) DEFAULT NULL,
  `FKIdProfesor` int(11) DEFAULT NULL,
  `FKIdEstudiante` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL COMMENT '1 = Activo  0 = Inactivo',
  PRIMARY KEY (`IdUsuario`),
  UNIQUE KEY `NombreUsuario` (`usuario`) USING BTREE,
  KEY `FK_usuarios_roles` (`FKIdRol`),
  KEY `FK_usuarios_apoderados` (`FKIdApoderado`),
  KEY `FK_usuarios_profesores` (`FKIdProfesor`),
  KEY `FK_usuarios_estudiantes` (`FKIdEstudiante`),
  CONSTRAINT `FK_usuarios_apoderados` FOREIGN KEY (`FKIdApoderado`) REFERENCES `apoderados` (`IdApoderado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuarios_estudiantes` FOREIGN KEY (`FKIdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuarios_profesores` FOREIGN KEY (`FKIdProfesor`) REFERENCES `profesores` (`IdProfesor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`FKIdRol`) REFERENCES `roles` (`IdRol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla dbsistemaescolar.usuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`IdUsuario`, `usuario`, `correo`, `password`, `FKIdRol`, `FKIdApoderado`, `FKIdProfesor`, `FKIdEstudiante`, `Estado`) VALUES
	(1, 'admin', 'admin@upt.pe', '$2y$05$kGJmbx7U6SfKiEFuL7Yji.ifiRLoBtVvROAVot02GUhtP9czv5UVi', 1, NULL, NULL, NULL, 1),
	(2, 'apoderado', 'apo@upt.pe', '123', 2, 1, NULL, NULL, 1),
	(3, 'profesor', 'profesor@upt.pe', 'Contraseña4', 3, NULL, 13, NULL, 1),
	(4, 'estudiante', 'estu@upt.pe', 'Contraseña3', 4, NULL, NULL, 3, 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

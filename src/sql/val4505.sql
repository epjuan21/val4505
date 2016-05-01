-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2016 a las 19:48:10
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `val4505`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades`
--

CREATE TABLE IF NOT EXISTS `entidades` (
  `ENTIDAD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTIDAD_COD` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ENTIDAD_NAME` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ENTIDAD_ID`),
  UNIQUE KEY `ENTIDAD_ID_UNIQUE` (`ENTIDAD_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `entidades`
--

INSERT INTO `entidades` (`ENTIDAD_ID`, `ENTIDAD_COD`, `ENTIDAD_NAME`) VALUES
(2, 'ESS091', 'ECOOPSOS'),
(3, 'EPS013', 'SALUCOOP'),
(4, 'EPS037', 'NUEVA EPS'),
(5, '05091', 'VINCULADOS BETANIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `MENU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MENU_NAME` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `MENU_HTML` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`MENU_ID`),
  UNIQUE KEY `MENU_ID_UNIQUE` (`MENU_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`MENU_ID`, `MENU_NAME`, `MENU_HTML`) VALUES
(1, 'Inicio', 'inicio'),
(2, 'Parametros', 'page.Parametros'),
(3, 'Entidades', 'page.Entidades'),
(4, 'EditarEntidad', 'page.EditarEntidad'),
(5, 'Municipios', 'page.Municipios'),
(6, 'Importar', 'page.Importar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE IF NOT EXISTS `municipios` (
  `MUN_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID TABLA MUNICIPIOS',
  `MUN_NAME` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE MUNICIPIO',
  `MUN_COD` varchar(5) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CODIGO MUNICIPIO',
  `MUN_ENT_COD_HAB` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CODIGO HABILITACION HOSPITAL',
  PRIMARY KEY (`MUN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='TABLA DE MUNICIPIOS' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`MUN_ID`, `MUN_NAME`, `MUN_COD`, `MUN_ENT_COD_HAB`) VALUES
(1, 'BETANIA', '05091', '050910457201');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rped`
--

CREATE TABLE IF NOT EXISTS `rped` (
  `R_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDENTIFICADOR UNICO DEL REGISTRO',
  `FechaRegistro` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'FECHA Y HORA DE GRABACION DEL REGISTRO',
  `IdUsuario` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Numero Id Usuario del Sistema',
  `CodigoMunicipio` varchar(5) COLLATE utf8_spanish_ci NOT NULL COMMENT 'CODIGO DANE MUNICIPIO',
  `CodigoEntidad` varchar(6) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de la EPS o de la Dirección Territorial de Salud',
  `FechaInicialReg` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha inicial del período de la información reportada',
  `FechaFinalReg` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha final del período de la Información Reportada',
  `CodigoHabilitacionIPS` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de Habilitación IPS Primaria',
  `TipoIdUsuario` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de identificación del usuario',
  `NumeroIdUsuario` varchar(18) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Número de identificación del usuario',
  `Apellido1` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Primer apellido del usuario',
  `Apellido2` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Segundo apellido del usuario',
  `Nombre1` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Primer nombre del usuario',
  `Nombre2` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Segundo nombre del usuario',
  `FechaNacimiento` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha de Nacimiento',
  `Sexo` varchar(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Sexo',
  `PertenenciaEtnica` varchar(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código pertenencia étnica',
  `CodigoOcupacion` varchar(4) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de ocupación',
  `CodigoNivelEducativo` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de nivel educativo',
  `Gestacion` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Gestación',
  `SifilisGestacional` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Sífilis Gestacional o congénita',
  `HipertensionInducidaGestacion` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Hipertensión Inducida por la Gestación',
  `HipotiroidismoCongenito` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Hipotiroidismo Congénito',
  `SintomaticoRespiratorio` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Sintomático Respiratorio (población general)',
  `Tuberculosis` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tuberculosis Multidrogoresistente',
  `Lepra` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Lepra',
  `ObesidadDesnutricion` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Obesidad o Desnutrición Proteico Calórica',
  `VictimaMaltrato` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Víctima de Maltrato',
  `VictimaViolenciaSexual` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Víctima de Violencia  Sexual',
  `InfeccionTrasmisionSexual` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Infecciones de Trasmisión Sexual',
  `EnfermedadMental` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Enfermedad Mental',
  `CancerCervix` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cáncer de Cérvix',
  `CancerSeno` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cáncer de Seno (población general)',
  `FluorosisDental` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fluorosis Dental',
  `FechaPeso` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha del Peso (población general)',
  `PesoKilogramos` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Peso en Kilogramos (población general)',
  `FechaTalla` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha de la Talla (población general)',
  `TallaCentimetros` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Talla en Centímetros (población general)',
  `FechaProbableParto` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Probable de Parto',
  `EdadGestacional` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Edad Gestacional al Nacer',
  `BCG` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'BCG',
  `HepatitisB` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Hepatitis B menores de 1 año',
  `Pentavalente` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Pentavalente',
  `Polio` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Polio',
  `DPT` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'DPT menores de 5 años',
  `Rotavirus` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Rotavirus',
  `Neumococo` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Neumococo',
  `InfluenzaN` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Influenza Niños',
  `FiebreAmarillaN1` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fiebre Amarilla niños de 1 año',
  `HepatitisA` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Hepatitis A',
  `TripleViralN` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Triple Viral Niños',
  `VPH` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Virus del Papiloma Humano (VPH)',
  `TdTtMEF` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'TD o TT Mujeres en Edad Fértil 15 a 49 años',
  `ControlPlacaBacteriana` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Control de Placa Bacteriana',
  `FechaAtencionParto` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha atención parto o cesárea',
  `FechaSalidaParto` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha salida de la atención del parto o cesárea',
  `FechaConsejeriaLactanciaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha de consejería en Lactancia Materna',
  `ControlRecienNacidoInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Control Recién Nacido',
  `PlanificacionFamiliarPrimeraVezInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Planificación Familiar Primera vez',
  `SuministroMetodoAnticonceptivo` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Suministro de Método Anticonceptivo',
  `FechaSuministroMetodoAnticonceptivo` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Suministro de Método Anticonceptivo',
  `ControlPrenatalPrimeraVezInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Control Prenatal de Primera vez',
  `ControlPrenatal` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Control Prenatal',
  `UltimoControlPrenatal` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Último Control Prenatal',
  `SuministroAcidoFolico` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Suministro de Ácido Fólico en el Último Control Prenatal',
  `SuministroSulfatoFerroso` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Suministro de Sulfato Ferroso en el Último Control Prenatal',
  `SuministroCarbonatoCalcio` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Suministro de Carbonato de Calcio en el Último Control Prenatal',
  `ValoracionAgudezaVisualInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Valoración de la Agudeza Visual',
  `ConsultaOftalmologiaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Consulta por Oftalmología',
  `FechaDiagnosticoDesnutricion` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Diagnóstico Desnutrición Proteico Calórica',
  `ConsultaMujerMenorVictimaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Consulta Mujer o Menor Víctima del Maltrato',
  `ConsultaVictimaViolenciaSexualInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Consulta Víctimas de Violencia Sexual',
  `ConsultaNutricionInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Consulta Nutrición',
  `ConsultaPsicologiaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Consulta de Psicología',
  `ConsultaCyDPrimeraVezInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Consulta de Crecimiento y Desarrollo Primera vez',
  `SuministroSulfatoFerrosoMenor` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Suministro de Sulfato Ferroso en la Última Consulta del Menor de 10 años',
  `SuministroVitaminaAMenor` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Suministro de Vitamina A en la Última Consulta del Menor de 10 años',
  `ConsultaJovenPrimeraVezInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Consulta de Joven Primera vez',
  `ConsultaAdultoPrimeraVezInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Consulta de Adulto Primera vez',
  `PreservativosITSInput` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Preservativos entregados a pacientes con ITS',
  `AsesoriaPreElisaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Asesoría Pre test Elisa para VIH',
  `AsesoriaPostElisaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Asesoría Pos test Elisa para VIH',
  `PacienteEnfermedadMental` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Paciente con Diagnóstico de: Ansiedad, Depresión, Esquizofrenia, déficit de atención, consumo SPA y Bipolaridad recibió Atención en los últimos 6 meses por Equipo Interdisciplinario Completo',
  `FechaAntigenoHepatitisBGestantesInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Antígeno de Superficie Hepatitis B en Gestantes',
  `ResultadoAntigenoHepatitisBGestantes` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Resultado Antígeno de Superficie Hepatitis B en Gestantes',
  `FechaSerologiaSifilisInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Serología para Sífilis',
  `ResultadoSerologiaSifilis` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Resultado Serología para Sífilis',
  `FechaTomaElisaVIHInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha de Toma de Elisa para VIH',
  `ResultadoElisaVIH` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Resultado Elisa para VIH',
  `FechaTSHNeonatalInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha TSH Neonatal',
  `ResultadoTSHNeonatal` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Resultado de TSH Neonatal',
  `TamizajeCancerCU` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tamizaje Cáncer de Cuello Uterino',
  `FechaCitologiaCUInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Citología Cervico uterina',
  `CitologiaCUResultados` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Citología Cervico uterina Resultados según Bethesda',
  `CalidadMuestraCitologia` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Calidad en la Muestra de Citología Cervicouterina',
  `CodigoHabilitacionIPSTomaMuestra` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de habilitación IPS donde se toma Citología Cervicouterina',
  `FechaColposcopiaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Colposcopia',
  `CodigoHabilitacionTomaColposcopia` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de habilitación IPS donde se toma Colposcopia',
  `FechaBiopsiaCervicalInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Biopsia Cervical',
  `ResultadoBiopsiaCervical` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Resultado de Biopsia Cervical',
  `CodigoHabilitacionTomaBiopsia` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de habilitación IPS donde se toma Biopsia Cervical',
  `FechaMamografiaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Mamografía',
  `ResultadoMamografia` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Resultado Mamografía',
  `CodigoHabilitacionTomaMamografia` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de habilitación IPS donde se toma Mamografía',
  `FechaBiopsiaSenoInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Toma Biopsia Seno por BACAF',
  `FechaResultadoBiopsiaSeno` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Resultado Biopsia Seno',
  `ResultadoBiopsiaSeno` varchar(3) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Resultado Biopsia Seno',
  `CodigoHabilitacionBiopsiaSeno` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de habilitación IPS donde se toma Biopsia Seno',
  `FechaTomaHemoglobinaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Toma de Hemoglobina',
  `ResultadoHemoglobina` varchar(4) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Hemoglobina',
  `FechaTomaGlisemiaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha  de la Toma de Glicemia Basal',
  `FechaTomaCreatininaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Creatinina',
  `ResultadoCreatinina` varchar(4) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Creatinina',
  `FechaHemoglobinaGlicosiladaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Hemoglobina Glicosilada',
  `ResultadoHemoglobinaGlicosilada` varchar(4) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Hemoglobina Glicosilada',
  `FechaTomaMicroalbuminuriaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Toma de Microalbuminuria',
  `FechaTomaHDLInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Toma de HDL',
  `FechaTomaBaciloscopiaInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha Toma de Baciloscopia de Diagnóstico',
  `ResultadoBaciloscopia` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Baciloscopia de Diagnóstico',
  `TratamientoHipotiroidismoCongenito` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tratamiento para Hipotiroidismo Congénito',
  `TratamientoSifilisGestacional` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tratamiento para Sífilis gestacional',
  `TratamientoSifilisCongenita` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tratamiento para Sífilis Congénita',
  `TratamientoLepra` varchar(2) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tratamiento para Lepra',
  `FechaTerLeishmaniasisInput` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Fecha de Terminación Tratamiento para Leishmaniasis',
  PRIMARY KEY (`R_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=492 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `USUARIO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO_NAME` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `USUARIO_PASS` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `USUARIO_MAIL` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`USUARIO_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`USUARIO_ID`, `USUARIO_NAME`, `USUARIO_PASS`, `USUARIO_MAIL`) VALUES
(1, 'admin', '123', 'ep.juan@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

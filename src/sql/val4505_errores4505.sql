-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: val4505
-- ------------------------------------------------------

DROP TABLE IF EXISTS `errores4505`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `errores4505` (
  `IdError` int(11) NOT NULL AUTO_INCREMENT,
  `NumeroIdUsuario` varchar(18) COLLATE utf8_spanish_ci NOT NULL,
  `CodigoEntidad` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `TipoError` int(2) NOT NULL,
  `Periodo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `CodigoMunicipio` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `IdUsuario` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `DetalleError` text COLLATE utf8_spanish_ci,
  `MensajeError` text CHARACTER SET utf8,
  PRIMARY KEY (`IdError`)
) ENGINE=InnoDB AUTO_INCREMENT=9203 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

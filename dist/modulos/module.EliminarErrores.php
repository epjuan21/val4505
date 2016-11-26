<?php
require_once ("../clases/class.rped.php");
require_once ("../clases/class.Errores.php");

$objRPED = new rped();
$objErrores = new Errores();

$CodEPS = $_GET["CodEPS"];
$TipoError = $_GET["TipoError"];
$Per = $_GET["Per"];
$CodMun = $_GET["CodMun"];
$IdUser = $_GET["IdUser"];

	// Borrar Errores Segun Periodo, Entidad y Tipo
	$objErrores->delErroresProc($CodEPS, $TipoError, $Per, $CodMun, $IdUser);

	header("Location: ../inicio.php?menu=12&CodEPS=$CodEPS&CodMun=$CodMun&CodUs=$IdUser&Per=$Per");

?>
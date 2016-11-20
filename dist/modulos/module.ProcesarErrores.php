<?php
require_once ("../clases/class.rped.php");
require_once ("../clases/class.Errores.php");

$objRPED = new rped();
$objErrores = new Errores();

$CodEPS = $_GET["CodEPS"];
$TipoError = 1;
$Per = $_GET["Per"];
$CodMun = $_GET["CodMun"];
$IdUser = $_GET["IdUser"];


$Errores = $objErrores->gerErroresProc($CodEPS, $TipoError, $Per, $CodMun, $IdUser);


for ($i=0;$i<sizeof($Errores); $i++) { 
	
	$NumeroIdUsuario = $Errores[$i]["NumeroIdUsuario"];

	$objRPED->deleteRegistroByCodUser($IdUser,$CodMun,$CodEPS,$Per,$NumeroIdUsuario);

}
	// Borrar Errores luego de Ser Procesados
	$objErrores->delErroresProc($CodEPS, $TipoError, $Per, $CodMun, $IdUser);


?>
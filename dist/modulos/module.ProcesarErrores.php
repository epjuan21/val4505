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


$Errores = $objErrores->gerErroresProc($CodEPS, $TipoError, $Per, $CodMun, $IdUser);


// Tipo Error 1: El afiliado no existe en la base de datos o sus datos no concuerdan con BDUA
// Tipo Error 2: Afiliado con valores en Nombres y/o Apellidos y/o Fecha de nacimiento diferentes a BDUA


if ($TipoError == 1) {
	for ($i=0;$i<sizeof($Errores); $i++) { 

		$NumeroIdUsuario = $Errores[$i]["NumeroIdUsuario"];

	$objRPED->deleteRegistroByCodUser($IdUser,$CodMun,$CodEPS,$Per,$NumeroIdUsuario);

	}
	
	// Borrar Errores luego de Ser Procesados
	$objErrores->delErroresProc($CodEPS, $TipoError, $Per, $CodMun, $IdUser);

	header("Location: ../inicio.php?menu=12&CodEPS=$CodEPS&CodMun=$CodMun&CodUs=$IdUser&Per=$Per");

} else if ($TipoError == 2) {
	for ($i=0;$i<sizeof($Errores); $i++) {

		$NumeroIdUsuario = $Errores[$i]["NumeroIdUsuario"];

		$Datos = $Errores[$i]["DetalleError"];
		$DatosExplode = explode(";", $Datos);

		$Apellido1 = $DatosExplode[0];
		$Apellido2 = $DatosExplode[1];
		$Nombre1 = $DatosExplode[2];
		$Nombre2 = $DatosExplode[3];
		$FechaNacimiento = $DatosExplode[4];
		
		$objRPED->updateUser($Apellido1, $Apellido2, $Nombre1, $Nombre2, $FechaNacimiento, $IdUser, $CodMun, $CodEPS, $Per, $NumeroIdUsuario);

		// Borrar Errores luego de Ser Procesados
		$objErrores->delErroresProc($CodEPS, $TipoError, $Per, $CodMun, $IdUser);

		header("Location: ../inicio.php?menu=12&CodEPS=$CodEPS&CodMun=$CodMun&CodUs=$IdUser&Per=$Per");

	}




}


?>
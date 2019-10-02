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
// Tipo Error 3: Fecha de Nacimiento reportado por la IPS Diferente al contenido en la Base de BDUA


if ($TipoError == 1 && $IdUser != '') {

	for ($i=0;$i<sizeof($Errores); $i++) { 

		$NumeroIdUsuario = $Errores[$i]["NumeroIdUsuario"];

		var_dump($NumeroIdUsuario);

		$objRPED->deleteRegistroByCodUser($IdUser,$CodMun,$CodEPS,$Per,$NumeroIdUsuario);

	}
	
	// Borrar Errores luego de Ser Procesados
	$objErrores->delErroresProc($CodEPS, $TipoError, $Per, $CodMun, $IdUser);

	header("Location: ../inicio.php?menu=12&CodEPS=$CodEPS&CodMun=$CodMun&CodUs=$IdUser&Per=$Per");

} 
else if ($TipoError == 2 && $IdUser != '') 
{
	
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
else if ($TipoError == 3 && $IdUser != '')
{

	for ($i=0;$i<sizeof($Errores);$i++)
	{
		$NumeroIdUsuario = $Errores[$i]["NumeroIdUsuario"];

		$FechaNacimiento = $Errores[$i]["DetalleError"];

		// Actualiza Fecha de Nacimiento
		$objRPED->updateFchNac($FechaNacimiento, $IdUser, $CodMun, $CodEPS, $Per, $NumeroIdUsuario);

		// Borrar Errores luego de Ser Procesados
		$objErrores->delErroresProc($CodEPS, $TipoError, $Per, $CodMun, $IdUser);

		// Redireccionamos a la Pagina de Detalle Periodo
		header("Location: ../inicio.php?menu=12&CodEPS=$CodEPS&CodMun=$CodMun&CodUs=$IdUser&Per=$Per");

	}


}

?>
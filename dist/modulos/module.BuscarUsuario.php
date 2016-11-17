<?php
require_once ("../clases/class.rped.php");
$objRPED = new rped();

$Ent = $_POST["Entidad"];
$IdUsuario = $_POST["NumeroIdUsuario"];
$Periodo = substr($_POST["Periodo"],5,2);
$Año = substr($_POST["Periodo"],0,4);

$Usuario = $objRPED->getUser($Ent,$IdUsuario,$Periodo,$Año);


if ($Usuario)
{
	header("Location: ../inicio.php?menu=9&Ent=$Ent&IdUser=$IdUsuario&Per=$Periodo&Año=$Año");
}
else
{
 	// Regresa al Formulario de Ingreso de Datos
 	header ("Location: ../inicio.php?menu=8&Ent=$Ent&Año=$Año&Period=$Periodo&Estado=Warning"); 
}

?>
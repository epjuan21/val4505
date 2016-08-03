<?php
require_once ("clases/class.rped.php");
$objRPED = new rped();
$Usuario = $objRPED->getUser($_POST["Entidad"],$_POST["NumeroIdUsuario"],$_POST["Periodo"],$_POST["Año"]);

$IdUsuario = $_POST["NumeroIdUsuario"];
$Ent = $_POST["Entidad"];
$Año = $_POST["Año"];
$Period = $_POST["Periodo"];

if ($Usuario)
{
	header("Location: inicio.php?menu=9&Ent=$Ent&IdUser=$IdUsuario&Per=$Period&Año=$Año");
}
else
{
 	// Regresa al Formulario de Ingreso de Datos
 	header ("Location: inicio.php?menu=8&Ent=$Ent&Año=$Año&Period=$Period&Estado=Warning"); 
}

?>
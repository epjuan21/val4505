<?php
require_once ("../clases/class.rped.php");
require_once ("../clases/class.Errores.php");

$objRPED = new rped();
$objErrores = new Errores();

echo $CodEPS = $_GET["CodEPS"];
$TipoError = 1;
echo $Per = $_GET["Per"];
echo $CodMun = $_GET["CodMun"];
echo $IdUser = $_GET["IdUser"];


$Errores = $objErrores->gerErroresProc ($CodEPS, $TipoError, $Per, $CodMun, $IdUser);








?>
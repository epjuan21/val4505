<?php
require_once ("../clases/class.rped.php");
$objRPED = new rped();

$IdUsuario = $_GET["IdUser"];
$CodigoMunicipio = $_GET["CodMun"];
$CodigoEntidad = $_GET["CodEnt"];
$FechaInicialReg = $_GET["FecIn"];
$FechaFinalReg = $_GET["FecFn"];

$objRPED->deletePeriod($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaInicialReg, $FechaFinalReg);
header ("Location: ../inicio.php?menu=6")

?>
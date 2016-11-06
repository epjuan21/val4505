<?php
require_once ("../clases/class.rped.php");
$objRPED = new rped();
// Se Obtiene el ID del Registro Para Asegurarnos de Modificar Solo El Registro Seleccionado
$R_ID = $_POST["R_ID"];
// Se Obtienen las Fecha Inicial y Final del Registro Original del Usuario
// En caso de No Querer Cambiar Esas Fechas Para Enviarlas Igual Al Formulario de Actualizacion
$FechaInicialReg = $_POST["FechaInicialReg"];
$FechaFinalReg = $_POST["FechaFinalReg"];
//Obtenemos el Codigo de la Entidad del Registro Original del Usuario en Caso de NO Querer Cambiarla
$CodigoEntidad = $_POST["CodigoEntidad"];
//Se Obtiene el Codigo de La Entidad Del Formulario de Actualizacion Por Si se desea cambiar la Entidad del Usuario
//Este se obtiene del Select Cambiar Entidad
$NuevoCodigoEntidad = $_POST["CambiarCodigoEntidad"];
//Se Obtiene El Mes y Año del Formulario de Actualización por si se desea cambiar el Periodo del Registro
//Estos se obtienen de los Select Cambiar Periodo - Mes: y Cambiar Periodo - Año:
$PeriodoMes = $_POST["CambioPeriodoMes"];
$PeriodoAño = $_POST["CambioPeriodoAño"];
// Si No Se Selecciona Año Se Iguala la Variable $PeriodoAño al Año Original del Registro
if ($PeriodoAño == '')
{
	$PeriodoAño = substr($FechaFinalReg, 0, 4);
}
else {
	$PeriodoAño = $_POST["CambioPeriodoAño"];
}
if ($NuevoCodigoEntidad == '')
{
	$_POST["CodigoEntidad"] = $CodigoEntidad;
}
else
{
	$_POST["CodigoEntidad"] = $NuevoCodigoEntidad;
}
switch ($PeriodoMes) {
 	case 'Enero':
 		$PeriodoIn = $PeriodoAño."-01-01";
 		$PeriodoFn = $PeriodoAño."-01-31";
 		break;
 	
 	case 'Febrero':
 		$PeriodoIn = $PeriodoAño."-02-01";
 		$PeriodoFn = $PeriodoAño."-02-28";
 		break;
 	case 'Marzo':
 		$PeriodoIn = $PeriodoAño."-03-01";
 		$PeriodoFn = $PeriodoAño."-03-31";
 		break;
 	case 'Abril':
 		$PeriodoIn = $PeriodoAño."-04-01";
 		$PeriodoFn = $PeriodoAño."-04-30";
 		break;
 	case 'Mayo':
 		$PeriodoIn = $PeriodoAño."-05-01";
 		$PeriodoFn = $PeriodoAño."-05-31";
 		break;
 	case 'Junio':
 		$PeriodoIn = $PeriodoAño."-06-01";
 		$PeriodoFn = $PeriodoAño."-06-30";
 		break;
 	case 'Julio':
 		$PeriodoIn = $PeriodoAño."-07-01";
 		$PeriodoFn = $PeriodoAño."-07-31";
 		break;
 	case 'Agosto':
 		$PeriodoIn = $PeriodoAño."-08-01";
 		$PeriodoFn = $PeriodoAño."-08-31";
 		break;
 	case 'Septiembre':
 		$PeriodoIn = $PeriodoAño."-09-01";
 		$PeriodoFn = $PeriodoAño."-09-30";
 		break;
 	case 'Octubre':
 		$PeriodoIn = $PeriodoAño."-10-01";
 		$PeriodoFn = $PeriodoAño."-10-31";
 		break;
 	case 'Noviembre':
 		$PeriodoIn = $PeriodoAño."-11-01";
 		$PeriodoFn = $PeriodoAño."-11-30";
 		break;
 	case 'Diciembre':
 		$PeriodoIn = $PeriodoAño."-12-01";
 		$PeriodoFn = $PeriodoAño."-12-31";
 		break;
 	case '':
 		$PeriodoIn = $PeriodoAño.substr($FechaInicialReg, 4, 9);
 		$PeriodoFn = $PeriodoAño.substr($FechaFinalReg, 4, 9);
 		break;
 }
$objRPED->update_RPED();
$Año = substr($FechaFinalReg, 0, 4);
$Periodo = substr($FechaFinalReg, 5, 2);
header ("Location: ../inicio.php?menu=8&Ent=$CodigoEntidad&Año=$Año&Period=$Periodo")
?>
<?php
function calcularEdad ($FechaFin, $FechaNacimiento)
{
	$dateExport = date($FechaFin);
	$FechaNacimiento = date($FechaNacimiento);
	$yearExport = date("Y", strtotime($dateExport));
	$monthExport = date("m", strtotime($dateExport));
	$dayExport = date("d", strtotime($dateExport));
	$yearBirthday = date("Y", strtotime($FechaNacimiento));
	$monthBirthday = date("m", strtotime($FechaNacimiento));
	$dayhBirthday = date("d", strtotime($FechaNacimiento));

	if ($monthExport>$monthBirthday)
	{	
		//Si Mes Exportacion es Mayor a Mes de Nacimiento;
		$edad = $yearExport - $yearBirthday;
		return $edad;
	} else if ($monthExport<$monthBirthday)
	{	
		//Si Mes Exportacion es Menor a Mes de Nacimiento;
		$edad = $yearExport - $yearBirthday - 1;
		return $edad;

		// Si Mes Exportacion es Igual a Mes de Nacimiento
	} else if ($monthExport==$monthBirthday)
	{
		if ($dayExport>=$dayhBirthday)
		{
			$edad = $yearExport - $yearBirthday;
			return $edad;
		} else if ($dayExport<$dayhBirthday)
		{
			$edad = $yearExport - $yearBirthday - 1;
			return $edad;
		}
	}
}

function calcularEdadenDias ($FechaFin, $FechaNacimiento)
{
	$segundos=strtotime($FechaNacimiento) - strtotime($FechaFin);
	$dias=intval($segundos/60/60/24);
	return $dias;
}
?>


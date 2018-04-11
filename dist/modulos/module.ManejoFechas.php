<?php
date_default_timezone_set('America/Bogota');

if (date_default_timezone_get()) {
    echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
}

if (ini_get('date.timezone')) {
    echo 'date.timezone: ' . ini_get('date.timezone');
}
//date_default_timezone_set('America/Bogota');
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

function diferenciaFecha($FechaVariable,$FechaCorte)
{
	$FechaVariableFunction = date_create($FechaVariable);
	$FechaCorteFunction = date_create($FechaCorte);
	$interval = date_diff($FechaVariableFunction, $FechaCorteFunction);
	$res = $interval->format('%a');
	return $res;
}


// Script PHP para calcular los días de diferencia que hay entre dos fechas


// A veces necesitamos saber los días que han transcurrido entre dos fechas. 
// Con PHP podemos hacer esa tarea fácilmente, 
// simplemente restando el valor timestamp de las dos fechas y convirtiendo a días. 

// Vamos a obtener los valores timestamp de las dos fechas. 
// (Recordar que los timestamp son los segundos que han pasado desde las cero horas del 1 de enero de 1970) 
// Como los dos timestamps son una cantidad de segundos, no tenemos más que restarlos para obtener los segundos de diferencia entre las dos fechas. 

// Luego se trataría de convertir esos segundos en días para obtener el dato que estamos buscando. 

// Veamos entonces la manera de obtener un timestamp de una fecha. 

// Entre las funciones de fechas de PHP hay varias que nos pueden servir para trabajar con timestamp, 
// pero nosotros tenemos que utilizar una en concreto llamada mktime(). 

// Esta función recibe varios parámetros: 

// mktime ( [int hora [, int minuto [, int segundo [, int mes [, int dia [, int anyo [, int es_dst]]]]]]] ) 

// El primer parámetro es la hora, luego los minutos y segundos. Luego los meses, días y años. 

// Con todos esos valores nos devuelve el timestamp de una fecha cualquiera. 

// Podemos omitir parámetros y en ese caso tomará los valores de la fecha actual del servidor. 

// El código para obtener los timestamp de un par de fechas inventadas podría ser algo como el siguiente: 

function diferenciaDias()
{


// defino fecha 1 
$ano1 = 2006; 
$mes1 = 10; 
$dia1 = 2; 

// Defino fecha 2 
$ano2 = 2006; 
$mes2 = 10; 
$dia2 = 27; 

// calculo timestam de las dos fechas 
$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
$timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 

// Luego, podríamos restar los timestamp y convertir los segundos en días: 

// resto a una fecha la otra 
$segundos_diferencia = $timestamp1 - $timestamp2; 
//echo $segundos_diferencia; 

// convierto segundos en días 
$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 

// Para convertir los segundos en días, como se ha podido observar en el código, hay que dividir entre el número de segundos de un día. (60 segundos de un minuto, por los 60 minutos de una hora, por las 24 horas de un día). 

// Ahora bien, con un código como el anterior, el valor de los días de diferencia puede tener decimales y ser negativo. Nosotros queremos un número de días entero y positivo. Entonces todavía tendremos que hacer un par de operaciones matemáticas. Primero quitar el signo negativo y luego quitar los decimales. 

// obtengo el valor absoulto de los días (quito el posible signo negativo) 
$dias_diferencia = abs($dias_diferencia); 

//quito los decimales a los días de diferencia 
$dias_diferencia = floor($dias_diferencia); 

// Los decimales los quitamos simplemente redondeando hacia abajo. Puesto que si tenemos un número decimal de días no ha llegado a un día completo y no nos interesa contabilizarlo. 

// El código completo se puede ver a continuación: 


//defino fecha 1 
$ano1 = 2006; 
$mes1 = 10; 
$dia1 = 2; 

//defino fecha 2 
$ano2 = 2006; 
$mes2 = 10; 
$dia2 = 27; 

//calculo timestam de las dos fechas 
$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2); 

//resto a una fecha la otra 
$segundos_diferencia = $timestamp1 - $timestamp2; 
//echo $segundos_diferencia; 

//convierto segundos en días 
$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 

//obtengo el valor absoulto de los días (quito el posible signo negativo) 
$dias_diferencia = abs($dias_diferencia); 

//quito los decimales a los días de diferencia 
$dias_diferencia = floor($dias_diferencia); 

//echo $dias_diferencia; 

}


?>

<?php
require_once ("../clases/class.rped.php");
include ("module.ManejoFechas.php");
$objRPED = new rped();

$IdUsuario = $_GET["IdU"];
$CodigoMunicipio = $_GET["CodM"];
$CodigoEntidad = $_GET["CodE"];
$FechaInicio = $_GET["FIn"];
$FechaFinal = $_GET["FFn"];

// Numero de Registros
$numReg = $objRPED->getNumRows($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaInicio, $FechaFinal);

// Registros para Exportar
$reg = $objRPED->getRPED($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaInicio, $FechaFinal);

$res='SGD280RPED';
$tipoId = 'MU';
$numId = '0000000'.$CodigoEntidad;
$cons = 'N01';

$nombreArchivo = $res."".str_replace("-", "", $FechaFinal)."".$tipoId."".$numId."".$cons.".txt";
$txt = fopen("$nombreArchivo","w");

fwrite($txt,"1");
fwrite($txt,"|");
fwrite($txt,$CodigoEntidad);
fwrite($txt,"|");
fwrite($txt,$FechaInicio);
fwrite($txt,"|");
fwrite($txt,$FechaFinal);
fwrite($txt,"|");
fwrite($txt,$numReg.PHP_EOL);

for ($i=0;$i<sizeof($reg);$i++)
{
	$edad = calcularEdad($FechaFinal, $reg[$i]["FechaNacimiento"]);
	$edadDias = calcularEdadenDias ($reg[$i]["FechaNacimiento"], $FechaFinal);
	$Edad365 = $edadDias / 365;
	fwrite($txt,"2");
	fwrite($txt,"|");
	fwrite($txt,$i+1);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CodigoHabilitacionIPS"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["TipoIdUsuario"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["NumeroIdUsuario"]);
	fwrite($txt,"|");

	//Reemplazar la Ñ en Apellido 1

	$ap1  = str_replace("Ñ", "N", $reg[$i]["Apellido1"]);

	fwrite($txt,trim($ap1));
	fwrite($txt,"|");
	
	//Reemplazar la Ñ en Apellido 2

	$ap2 = str_replace("Ñ", "N", $reg[$i]["Apellido2"]);

	fwrite($txt,trim($ap2));
	fwrite($txt,"|");
	fwrite($txt,trim($reg[$i]["Nombre1"]));
	fwrite($txt,"|");
	fwrite($txt,trim($reg[$i]["Nombre2"]));
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaNacimiento"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["Sexo"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["PertenenciaEtnica"]);
	fwrite($txt,"|");
	fwrite($txt,'9999'); // 12. Código de ocupación
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CodigoNivelEducativo"]);
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M')
		{
			fwrite($txt,'0');
		}
		else if ($edad < 10 || $edad >= 60)
		{
			fwrite($txt,'0');
		}
		else if (($edad >= 10 && $edad < 60) && $reg[$i]["Gestacion"] == 0)
		{
			fwrite($txt,'21');
		}
		else
		{
			fwrite($txt,$reg[$i]["Gestacion"]);
		}
	//fwrite($txt,$reg[$i]["Gestacion"]); // 14. Gestacion
	fwrite($txt,"|");
		if (($reg[$i]["Sexo"]=='M') || ($reg[$i]["Gestacion"]=='21' || $reg[$i]["Gestacion"]=='0'))
		{
			fwrite($txt,'0');
		}
		else if (($edad < 10 || $edad >= 60) || $reg[$i]["Gestacion"]!='1')
		{
			fwrite($txt,'0');
		}
		else if ($edad < 60 && $reg[$i]["SifilisGestacional"]=='0')
		{
			if (($reg[$i]["Gestacion"]=='0' || $reg[$i]["Gestacion"]=='21') && $edadDias > 91) 
			{
				fwrite($txt,'0');
			}
			else
			{
				fwrite($txt,'21');
			}
			
		}
		else if ($edad >= 60 && $reg[$i]["SifilisGestacional"]=='0' && $reg[$i]["Sexo"]=='F')
		{
			if ($reg[$i]["Gestacion"]=='0')
			{
				fwrite($txt,'0');
			}
			else
			{
				fwrite($txt,'21');
			}
		}
		else {
			fwrite($txt,$reg[$i]["SifilisGestacional"]);
		}
	//fwrite($txt,$reg[$i]["SifilisGestacional"]); // 15. Sifilis Gestacional y Congenita
	fwrite($txt,"|");
		if ((($edad < 10 || $edad >= 57) || $reg[$i]["HipertensionInducidaGestacion"] == '21') && $reg[$i]["Gestacion"] == '0')
		{
			fwrite($txt,'0');
		}
		else if($reg[$i]["Gestacion"] != '1' && $reg[$i]["HipertensionInducidaGestacion"] == '2')
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Gestacion"] == '21' && $reg[$i]["HipertensionInducidaGestacion"] == '21')
		{
			fwrite($txt,'0');	
		}
		else
		{
			fwrite($txt,$reg[$i]["HipertensionInducidaGestacion"]);
		}
	//fwrite($txt,$reg[$i]["HipertensionInducidaGestacion"]); // 16. Hipertension Inducida por la Gestacion
	fwrite($txt,"|");
		if ($edad >= 3)
		{
			fwrite($txt,'0');
		} else if ($edad <= 3 && $reg[$i]["HipotiroidismoCongenito"]=='0')
		{
			fwrite($txt,'21');
		} else {
			fwrite($txt,$reg[$i]["HipotiroidismoCongenito"]);
		}
	//fwrite($txt,$reg[$i]["HipotiroidismoCongenito"]); // 17. Hipotiroidismo Congenito
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["SintomaticoRespiratorio"]);
	fwrite($txt,"|");
		if ($reg[$i]["Tuberculosis"]=='')
		{
			fwrite($txt,'21');
		} else {
			fwrite($txt,$reg[$i]["Tuberculosis"]);
		}
	//fwrite($txt,$reg[$i]["Tuberculosis"]); // 19. Tuberculosis Multidrogoresistente
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["Lepra"]);
	fwrite($txt,"|");
		if ($reg[$i]["ObesidadDesnutricion"]=='')
		{
			fwrite($txt,'21');
		} else {
			fwrite($txt,$reg[$i]["ObesidadDesnutricion"]);
		}
	//fwrite($txt,$reg[$i]["ObesidadDesnutricion"]); // 21. Obsesidad o Desnutrición Proteico Calórica
	fwrite($txt,"|");
		if ($edad >= 19 && $reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 19 && $reg[$i]["VictimaMaltrato"]=='0')
		{
			fwrite($txt,'21');

		}
		else if ($reg[$i]["ConsultaMujerMenorVictimaInput"] == '1800-01-01' && ($reg[$i]["VictimaMaltrato"] == '21' || $reg[$i]["VictimaMaltrato"] == '2'))
		{
			fwrite($txt,'3');
		}
		else
		{
			fwrite($txt,$reg[$i]["VictimaMaltrato"]);
		}
	//fwrite($txt,$reg[$i]["VictimaMaltrato"]); // 22. Victima Maltrato
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["VictimaViolenciaSexual"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["InfeccionTrasmisionSexual"]);
	fwrite($txt,"|");
	//	fwrite($txt,"21");
	fwrite($txt,$reg[$i]["EnfermedadMental"]); // 25. Enfermedad Mental
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CancerCervix"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CancerSeno"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FluorosisDental"]);
	fwrite($txt,"|");
		if($reg[$i]["FechaPeso"] == '1800-01-01')
		{
			fwrite($txt,$reg[$i]["FechaPeso"]);
		}
		else if ($reg[$i]["PesoKilogramos"] == 0)
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaPeso"]);
		}
	//fwrite($txt,$reg[$i]["FechaPeso"]);	// 29. Fecha Peso
	fwrite($txt,"|");
		if ($reg[$i]["PesoKilogramos"] > 1000)
		{
			$peso = $reg[$i]["PesoKilogramos"] * 0.001;
			fwrite($txt,$peso);
		} 
		else if ($reg[$i]["PesoKilogramos"] == 0)
		{
			fwrite($txt,'999');
		}
		else
		{
			fwrite($txt,$reg[$i]["PesoKilogramos"]);
		}
	//fwrite($txt,$reg[$i]["PesoKilogramos"]); // 30. Peso en Kilogramos
	$esNumero = is_numeric($reg[$i]["TallaCentimetros"]);
	fwrite($txt,"|");
		if($reg[$i]["FechaTalla"] == '1800-01-01')
		{
			fwrite($txt,$reg[$i]["FechaTalla"]);
		}
		else if ($esNumero == false)
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTalla"]);
		}
	//fwrite($txt,$reg[$i]["FechaTalla"]); // 31. Fecha Talla
	fwrite($txt,"|");
		if ($reg[$i]["TallaCentimetros"] > 225 && $reg[$i]["TallaCentimetros"]!='999')
		{
			$talla = $reg[$i]["TallaCentimetros"] * 0.1;
			fwrite($txt,$talla);
		} 
		else if ($esNumero == false)
		{
			fwrite($txt,'999');
		}
		else 
		{
			fwrite($txt,$reg[$i]["TallaCentimetros"]);
		}
	//fwrite($txt,$reg[$i]["TallaCentimetros"]); // 32. Talla en Centimetros
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2')
		{
			fwrite($txt,'1845-01-01');
		} else if ($reg[$i]["Sexo"]=='F' && $reg[$i]["Gestacion"]=='0')
		{
			fwrite($txt,'1845-01-01');
		} else if ($reg[$i]["Sexo"]=='F' && $reg[$i]["Gestacion"]=='1' && $reg[$i]["FechaProbableParto"]=='1845-01-01') 
		{
			fwrite($txt,'1800-01-01');
		} else if ($reg[$i]["FechaProbableParto"]=='1800-01-01' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'1845-01-01');
		} else {
			fwrite($txt,$reg[$i]["FechaProbableParto"]);
		}
	//fwrite($txt,$reg[$i]["FechaProbableParto"]); // 33. Fecha Probable Parto
	fwrite($txt,"|");
		if ($edad < 6 and $reg[$i]["EdadGestacional"]=='0')
		{
			fwrite($txt,'999');
		} else {
			fwrite($txt,$reg[$i]["EdadGestacional"]);
		}
	//fwrite($txt,$reg[$i]["EdadGestacional"]); // 34. Edad Gestacion al Nacer
	fwrite($txt,"|");
		if ($edad > 6)
		{
			fwrite($txt,'0');
		} else if ($edad < 6 and $reg[$i]["BCG"]=='0') 
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["BCG"]);
		}
	//fwrite($txt,$reg[$i]["BCG"]); // 35. BCG
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 6 && $reg[$i]["HepatitisB"]== '0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["HepatitisB"]);
		}
	//fwrite($txt,$reg[$i]["HepatitisB"]); // 36. Hepatitis B Menores de 1 año
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 6 && $reg[$i]["Pentavalente"]== '0') 
		{
			fwrite($txt,'22');
		}
		else if ($edadDias < 120 && $reg[$i]["Pentavalente"]== '2')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["Pentavalente"]);
		}
	//fwrite($txt,$reg[$i]["Pentavalente"]); // 37. Pentavalente
	fwrite($txt,"|");
		if ($edad > 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["Polio"]=='0') 
		{
			fwrite($txt,'22');
		}
		else if ($edadDias < 120 && $reg[$i]["Polio"]== '2')
		{
			fwrite($txt,'22');
		}
		 else {
			fwrite($txt,$reg[$i]["Polio"]);
		}
	// fwrite($txt,$reg[$i]["Polio"]); // 38. Polio
	fwrite($txt,"|");
		// 540 Dias Equivalen a 18 Meses
		// 1800 Dias Equivalen a 60 Meses
		// Si es menor a 18 meses debe registrar no aplica en la variable 39
		if ($edadDias < 549 || $edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if (($edadDias >= 549 && $edad < 6) && $reg[$i]["DPT"] == 0)
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["DPT"]);
		}
	//fwrite($txt,$reg[$i]["DPT"]); // 39. DPT en Menores de 5 años
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 6 && $reg[$i]["Rotavirus"]== '0') 
		{
			fwrite($txt,'22');
		}
		else if ($edadDias < 120 && $reg[$i]["Rotavirus"]== '2')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["Rotavirus"]);
		}
	//fwrite($txt,$reg[$i]["Rotavirus"]); // 40. Rotavirus
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 6 && $reg[$i]["Neumococo"]== '0') 
		{
			fwrite($txt,'22');
		}
		else if ($edadDias < 180 && $reg[$i]["Neumococo"]== '2')
		{
			fwrite($txt,'22');
		}
		else if ($edadDias < 180 && $reg[$i]["Neumococo"]== '3')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["Neumococo"]);
		}
	//fwrite($txt,$reg[$i]["Neumococo"]); // 41. Neumococo
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 6 && $reg[$i]["InfluenzaN"]== '0') 
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["InfluenzaN"]);
		}
	//fwrite($txt,$reg[$i]["InfluenzaN"]); // 42. Influenza Niños
	fwrite($txt,"|");
		if ($edad < 1 || $edad > 5) 
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 1 && $edad < 6 && $reg[$i]["FiebreAmarillaN1"] == '0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["FiebreAmarillaN1"]); 
		}
	//fwrite($txt,$reg[$i]["FiebreAmarillaN1"]); // 43. Fiebre Amarilla en Menores de Un Año
	fwrite($txt,"|");
		if ($edad < 1 || $edad > 5) 
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 1 && $edad < 6 && $reg[$i]["HepatitisA"] == '0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["HepatitisA"]); 
		}	
	//fwrite($txt,$reg[$i]["HepatitisA"]); // 44. Hepatitis A
	fwrite($txt,"|");
		if ($edad < 1 || $edad > 5) 
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 1 && $edad < 6 && $reg[$i]["TripleViralN"] == '0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["TripleViralN"]); 
		}
	//fwrite($txt,$reg[$i]["TripleViralN"]); // 45. Triple Viral Niños
	fwrite($txt,"|");
		if ($edad < 9 && ($reg[$i]["Sexo"] == 'M' || $reg[$i]["Sexo"] == 'F' )) 
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 9 && $reg[$i]["Sexo"] == 'F' && $reg[$i]["VPH"]=='22')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["VPH"]);
		}
	//fwrite($txt,$reg[$i]["VPH"]); // 46. Virus del Papiloma Humano (VPH)
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} else if (($edad > 15 && $edad < 49) && $reg[$i]["TdTtMEF"]=='0')
		{
			fwrite($txt,'22');
		} else if (($edad < 15 || $edad > 49) && $reg[$i]["TdTtMEF"]=='22' || $reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} else{
			fwrite($txt,$reg[$i]["TdTtMEF"]);
		}
	//fwrite($txt,$reg[$i]["TdTtMEF"]); // 47. TD o TT Mujeres en Edad Fertil 15  a 49 años
	fwrite($txt,"|");
		if ($edad < 2)
		{
			fwrite($txt,'0');
		} else if ($edad > 2 && $reg[$i]["ControlPlacaBacteriana"]=='0')
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["ControlPlacaBacteriana"]);
		}
	//fwrite($txt,$reg[$i]["ControlPlacaBacteriana"]); // 48. Control de Placa Bacteriana
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"]=='0' || $reg[$i]["Gestacion"]=='2' || $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'1845-01-01');
		} else if ($reg[$i]["Gestacion"]=='1' && $reg[$i]["FechaAtencionParto"]=='1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		} else {
			fwrite($txt,$reg[$i]["FechaAtencionParto"]);
		}
	//fwrite($txt,$reg[$i]["FechaAtencionParto"]); // 49. Fecha Atencion Parto o Cesarea
	// SEGUN Secretaria Seccional de Salud cuando registre un dato diferente a 1845-01-01 no debe ser gestante. 2
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"]=='0' || $reg[$i]["Gestacion"]=='2' || $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($reg[$i]["Gestacion"]=='2' && $reg[$i]["FechaSalidaParto"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		} 
		else if ($reg[$i]["Gestacion"]=='1')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaSalidaParto"]);
		}
	//fwrite($txt,$reg[$i]["FechaSalidaParto"]); // 50. Fecha Salida de la Atención del Parto o Cesárea
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2')
		{
			fwrite($txt,'1845-01-01');
		} else if ($reg[$i]["Gestacion"]=='1' && $reg[$i]["FechaConsejeriaLactanciaInput"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		} else {
			fwrite($txt,$reg[$i]["FechaConsejeriaLactanciaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaConsejeriaLactanciaInput"]); // 51. Fecha de Consejería en Lactancia Materna
	fwrite($txt,"|");
		if ($edadDias > 30)
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($edadDias <= 30 && $reg[$i]["ControlRecienNacidoInput"] == '1845-01-01') 
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ControlRecienNacidoInput"]);
		}
	//fwrite($txt,$reg[$i]["ControlRecienNacidoInput"]); 52. Control del Recien Nacido
	fwrite($txt,"|");
		// Validar que cuando la variable 53 registre un dato diferente a 1845-01-01 
		// la variable 9 corresponda a >= 10 años y < 60 años

		// Validar que cuando la variable 53 registre 1845-01-01, la variable 9 corresponda a < 10 años
		if ($edad < 10 || $edad >= 60)
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($edad >= 10 && $edad < 60 && $reg[$i]["PlanificacionFamiliarPrimeraVezInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($edad == 60 && $reg[$i]["PlanificacionFamiliarPrimeraVezInput"] == '1845-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["PlanificacionFamiliarPrimeraVezInput"]);
		}
		//fwrite($txt,$reg[$i]["PlanificacionFamiliarPrimeraVezInput"]); //53. Planificacion Familiar Primera Vez
	fwrite($txt,"|");
		if ($edad < 10 || $edad >= 60) 
		{
			fwrite($txt,'0');
		} 
		else 
		{
			fwrite($txt,$reg[$i]["SuministroMetodoAnticonceptivo"]);
		}
	//fwrite($txt,$reg[$i]["SuministroMetodoAnticonceptivo"]); // 54. Suministro de Metodo Anticonveptivo
	fwrite($txt,"|");
		// Validar que cuando variable 55  registre  un dato diferente a 1845-01-01, variable 54 registre un valor diferente a 0
		// Validar que cuando variable 9 registre <10 años y >60 años, variable 53 registre 1845-01-01
		if ($reg[$i]["SuministroMetodoAnticonceptivo"]=='0' || ($edad < 10 || $edad >= 60)) 
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($reg[$i]["FechaSuministroMetodoAnticonceptivo"] == '1845-01-01' && $reg[$i]["SuministroMetodoAnticonceptivo"]!='0'  )
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaSuministroMetodoAnticonceptivo"]);
		}
	//fwrite($txt,$reg[$i]["FechaSuministroMetodoAnticonceptivo"]); //55. Fecha Suministro Metodo Anticonceptivo
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='0')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($reg[$i]["Gestacion"]=='1')
		{
			fwrite($txt,'1800-01-01');
		} 
		else if ($reg[$i]["ControlPrenatalPrimeraVezInput"]=='1800-01-01' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'1845-01-01');
		} 
		else 
		{
			fwrite($txt,$reg[$i]["ControlPrenatalPrimeraVezInput"]);
		}
	//fwrite($txt,$reg[$i]["ControlPrenatalPrimeraVezInput"]); // 56. Control Prenatal de Primera Vez
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2' || $reg[$i]["Gestacion"]=='0')
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["Sexo"]=='F' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		} 
		else ($reg[$i]["Sexo"]=='F' && $reg[$i]["Gestacion"]=='1' && $reg[$i]["ControlPrenatal"] == '0')
		{
			fwrite($txt,'999');
		}
		else
		{
			fwrite($txt,$reg[$i]["ControlPrenatal"]);
		}
	//fwrite($txt,$reg[$i]["ControlPrenatal"]); // 57. Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' && $reg[$i]["Gestacion"]!='1')
		{
			fwrite($txt,"1845-01-01");
		} 
		else if ($reg[$i]["Sexo"]=='F' && $reg[$i]["Gestacion"]=='1' && $reg[$i]["UltimoControlPrenatal"]=='1845-01-01')
		{ 
			fwrite($txt,'1800-01-01');
		} 
		else if (($reg[$i]["UltimoControlPrenatal"]=='1800-01-01' && $reg[$i]["Gestacion"]=='21') || ($reg[$i]["Gestacion"]=='0'))
		{
			fwrite($txt,'1845-01-01');
		} 
		else {
			fwrite($txt,$reg[$i]["UltimoControlPrenatal"]);
		}
	//fwrite($txt,$reg[$i]["UltimoControlPrenatal"]); // 58. Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' && $reg[$i]["Gestacion"]!='1')
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["Gestacion"]=='1')
		{
			fwrite($txt,'21');
		} 
		else if (($reg[$i]["SuministroAcidoFolico"]=='21' && $reg[$i]["Gestacion"]=='21') || ($reg[$i]["Gestacion"]=='0'))
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["SuministroAcidoFolico"]=='1' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["SuministroAcidoFolico"]=='20' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["SuministroAcidoFolico"]);
		}
	//fwrite($txt,$reg[$i]["SuministroAcidoFolico"]); // 59. Suministro de Acido Folico en el Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["Gestacion"]=='1')
		{
			fwrite($txt,'21');
		} else if (($reg[$i]["SuministroSulfatoFerroso"]=='21' && $reg[$i]["Gestacion"]=='21') ||  ($reg[$i]["Gestacion"]=='0'))
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["SuministroSulfatoFerroso"]=='1' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["SuministroSulfatoFerroso"]=='20' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["SuministroSulfatoFerroso"]);
		}
	//fwrite($txt,$reg[$i]["SuministroSulfatoFerroso"]); // 60. Suministro de Sulfato Ferroso en el Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' && $reg[$i]["Gestacion"]!='1')
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["Gestacion"]=='1')
		{
			fwrite($txt,'21');
		} else if (($reg[$i]["SuministroCarbonatoCalcio"]=='21' && $reg[$i]["Gestacion"]=='21') || ($reg[$i]["Gestacion"]=='0'))
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["SuministroCarbonatoCalcio"]=='1' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["SuministroCarbonatoCalcio"]=='20' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["SuministroCarbonatoCalcio"]);
		}
	//fwrite($txt,$reg[$i]["SuministroCarbonatoCalcio"]); // 61. Suministro de Carbonato de Calcio en el Ultimo Control Prenatal
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ValoracionAgudezaVisualInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaOftalmologiaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaDiagnosticoDesnutricion"]);
	fwrite($txt,"|");
		if ($reg[$i]["VictimaMaltrato"] == '0' && $reg[$i]["ConsultaMujerMenorVictimaInput"] == '1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["VictimaMaltrato"] == '21' && $reg[$i]["ConsultaMujerMenorVictimaInput"] == '1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ConsultaMujerMenorVictimaInput"]);
		}
	//fwrite($txt,$reg[$i]["ConsultaMujerMenorVictimaInput"]); // 65. Consulta Mujer o Menor Víctima del Maltrato
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaVictimaViolenciaSexualInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaNutricionInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaPsicologiaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaCyDPrimeraVezInput"]);
	fwrite($txt,"|");
		if ($edad >= 10 && $reg[$i]["SuministroSulfatoFerrosoMenor"]=='0' && $reg[$i]["SuministroSulfatoFerrosoMenor"]!='0')
		{
			fwrite($txt,$reg[$i]["SuministroSulfatoFerrosoMenor"]); 
		} else if ($edad < 10 && $reg[$i]["SuministroSulfatoFerrosoMenor"] > 0 && $reg[$i]["SuministroSulfatoFerrosoMenor"]!='0')
		{
			fwrite($txt,$reg[$i]["SuministroSulfatoFerrosoMenor"]);
		} else if ($edad >= 10 && $reg[$i]["SuministroSulfatoFerrosoMenor"]=='21')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["SuministroSulfatoFerrosoMenor"]);
		}
	//fwrite($txt,$reg[$i]["SuministroSulfatoFerrosoMenor"]); // 70. Suministro de Sulfato Ferroso en la Ultima Consulta de Menor de 10 Años
	fwrite($txt,"|");
		if ($Edad365 > 10)
		{
			fwrite($txt,'0');
		} else if ($Edad365 < 10 && $reg[$i]["SuministroVitaminaAMenor"]=='0')
		{
			fwrite($txt,'21');
		} else {
			fwrite($txt,$reg[$i]["SuministroVitaminaAMenor"]);
		}
	//fwrite($txt,$reg[$i]["SuministroVitaminaAMenor"]); // 71. Suministro de Vitamina A en la Ultima Consulta de Menor de 10 Años
	fwrite($txt,"|");
		if ($edad < 10) 
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($edad >= 10 && $edad < 30 && ($reg[$i]["ConsultaJovenPrimeraVezInput"] == '1835-01-01') )
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ConsultaJovenPrimeraVezInput"]);
		}
	//fwrite($txt,$reg[$i]["ConsultaJovenPrimeraVezInput"]); // 72. Consulta de Joven Primera Vez
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaAdultoPrimeraVezInput"]);
	fwrite($txt,"|");
		fwrite($txt,'0');
	//fwrite($txt,$reg[$i]["PreservativosITSInput"]); // 74. Preservativos Entregados a Pacientes con ITS
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["AsesoriaPreElisaInput"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01'); 
		}
		else
		{
			fwrite($txt,$reg[$i]["AsesoriaPreElisaInput"]);
		}
	//fwrite($txt,$reg[$i]["AsesoriaPreElisaInput"]); // 75. 
	fwrite($txt,"|");
		// $FechaAsesoriaPostElisa = $reg[$i]["AsesoriaPostElisaInput"];
		// $diferencia = diferenciaFecha($FechaFin,$FechaAsesoriaPostElisa);
		// if ($diferencia >= 0)
		// {
		// 	fwrite($txt,'1800-01-01');
		// }
		// else
		// {
		// 	fwrite($txt,$reg[$i]["AsesoriaPostElisaInput"]);
		// }
	fwrite($txt,$reg[$i]["AsesoriaPostElisaInput"]); // 76. Asesoría Pos test Elisa para VIH
	fwrite($txt,"|");
		if ($reg[$i]["EnfermedadMental"] == '21' &&  $reg[$i]["PacienteEnfermedadMental"] == '1')
		{
			fwrite($txt,"0");
		} else if ($reg[$i]["PacienteEnfermedadMental"]=='22' && $reg[$i]["EnfermedadMental"] == '7')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["PacienteEnfermedadMental"]);
		}
	//fwrite($txt,$reg[$i]["PacienteEnfermedadMental"]); // 77. Paciente con Diagnóstico de: Ansiedad, Depresión, Esquizofrenia, déficit de atención, consumo SPA y Bipolaridad recibió Atención en los últimos 6 meses por Equipo Interdisciplinario Completo
	fwrite($txt,"|");

		$FechaFormulario = new DateTime($reg[$i]["FechaAntigenoHepatitisBGestantesInput"]); // Fecha Digitada por El Usuario
		$FechaOpcion = new DateTime('1845-01-01');	//Fecha Mayor del Listado de Opciones

		// Se compara la Fecha Digitada por el Usuario con las Fechas de las Opciones
		// Se compara con la Fecha Mayor, lo que indica si la fecha Digitada no esta dentro de las Opciones
		// Si la Fecha Digitada es Mayor a la Fecha de las Opciones, significa que se digito una fecha Especifica
		// Si el resutlao de la variable $red es mayor a 0 indica que se digido una fecha Especifica

		$interval = $FechaFormulario->diff($FechaOpcion);
		$ret78 = (integer) $interval->format('%a%');

		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["Gestacion"]=='1' && $reg[$i]["FechaAntigenoHepatitisBGestantesInput"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		} 
		else if (($reg[$i]["FechaAntigenoHepatitisBGestantesInput"]=='1800-01-01' && $reg[$i]["Gestacion"]=='21') || ($reg[$i]["Gestacion"]=='0'))
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($ret78 > 0 && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'1845-01-01');
		}
		else 
		{
			fwrite($txt,$reg[$i]["FechaAntigenoHepatitisBGestantesInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaAntigenoHepatitisBGestantesInput"]); // 78. Fecha Antigeno de Superficie Hepatitis B en Gestantes
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["Gestacion"]=='1' && $reg[$i]["ResultadoAntigenoHepatitisBGestantes"]=='0')
		{
			fwrite($txt,'22');
		} else if (($reg[$i]["ResultadoAntigenoHepatitisBGestantes"]=='22' && $reg[$i]["Gestacion"]=='21') || ($reg[$i]["Gestacion"]=='0'))
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["ResultadoAntigenoHepatitisBGestantes"]=='1' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["ResultadoAntigenoHepatitisBGestantes"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoAntigenoHepatitisBGestantes"]); // 79. Resultado Antigeno de Superficie Hepatitis B en Gestantes
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaSerologiaSifilisInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaSerologiaSifilisInput"]);	
		}
	//fwrite($txt,$reg[$i]["FechaSerologiaSifilisInput"]); // 80. Fecha Serologia para Sifilis
	fwrite($txt,"|");
		if($reg[$i]["Gestacion"] == '1' && $reg[$i]["ResultadoSerologiaSifilis"] =='0')
		{
			fwrite($txt,'22');
		}
		else if ($reg[$i]["FechaSerologiaSifilisInput"] =='1845-01-01' && $reg[$i]["ResultadoSerologiaSifilis"] =='1')
		{
			fwrite($txt,'0'); 
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoSerologiaSifilis"]); 
		}
	//fwrite($txt,$reg[$i]["ResultadoSerologiaSifilis"]); // 81. Resultado Serología Para Sífilis
	fwrite($txt,"|");
		if ($reg[$i]["FechaTomaElisaVIHInput"] == '0000-00-00' || $reg[$i]["FechaTomaElisaVIHInput"] == '0000-00-80')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaTomaElisaVIHInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTomaElisaVIHInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTomaElisaVIHInput"]); // 82. Fecha de Toma de Elisa para VIH
	fwrite($txt,"|");
		if ($reg[$i]["ResultadoElisaVIH"] == '0' && ($reg[$i]["FechaTomaElisaVIHInput"] == '1800-01-01' || $reg[$i]["FechaTomaElisaVIHInput"] == '0000-00-80' || $reg[$i]["FechaTomaElisaVIHInput"] == '0000-00-00' || ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaTomaElisaVIHInput"] == '1845-01-01')))
		{
			fwrite($txt,'22');
		}
		else if ($reg[$i]["FechaTomaElisaVIHInput"] == '1845-01-01' && $reg[$i]["ResultadoElisaVIH"] == '1')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoElisaVIH"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoElisaVIH"]); // 83. Resultado ELISA para VIH
	fwrite($txt,"|");
		if ($edadDias < 2)
		{
			fwrite($txt,'1845-01-01');
		} else {
			fwrite($txt,$reg[$i]["FechaTSHNeonatalInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTSHNeonatalInput"]); // 84. Fecha TSH Neonatal
	fwrite($txt,"|");
	if ($edad > 1)
	{
		fwrite($txt,'0');
	} else {
		fwrite($txt,$reg[$i]["ResultadoTSHNeonatal"]);
	}
	//fwrite($txt,$reg[$i]["ResultadoTSHNeonatal"]); // 85. Resultado de TSH Neonatal
	fwrite($txt,"|");
		if($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		}
		else if ($edad <= 10 and $reg[$i]["TamizajeCancerCU"]!='0')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["TamizajeCancerCU"]);
		}
	//fwrite($txt,$reg[$i]["TamizajeCencerCU"]); // 86. Tamizaje Cancer de Cuello Uterino
	fwrite($txt,"|");
		if ($edad > 10 && $reg[$i]["FechaCitologiaCUInput"] == '1845-01-01' && $reg[$i]["Sexo"] == 'F')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["TamizajeCancerCU"] == '22' && $reg[$i]["FechaCitologiaCUInput"] == '1835-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaCitologiaCUInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaCitologiaCUInput"]); // 87. Citologia Cervicouterina
	fwrite($txt,"|");
		//Validar que cuando  variable 88 registre  un dato diferente de  0 la variable 87 sea igual a 1800-01-01 o >1900-01-01 
		if ($reg[$i]["Sexo"] == 'M' || $reg[$i]["FechaCitologiaCUInput"] == '1845-01-01')
		{
			if ($reg[$i]["Sexo"] == 'F' &&  $edad < 10 )
			{
				fwrite($txt,'0');
			}
			else if ($reg[$i]["Sexo"] == 'F' && $edad > 10 && $reg[$i]["CitologiaCUResultados"] == '0')
			{
				fwrite($txt,'999');
			}
			else
			{
				fwrite($txt,'0');
			}
		}
		else if ($reg[$i]["CitologiaCUResultados"] != '999' || $reg[$i]["CitologiaCUResultados"] != '0' || $reg[$i]["CitologiaCUResultados"] < 19)
		{
			// Si variable 87 = 1835-01-01 
			if ($reg[$i]["FechaCitologiaCUInput"] == '1835-01-01' ) 
			{
				fwrite($txt,'999');
			}
			else
			{
				fwrite($txt,'999');
			}
		}
		else if ($edad > 10 && $reg[$i]["Sexo"] == 'F' && $reg[$i]["CitologiaCUResultados"] == '0' )
		{
			fwrite($txt,'999');
		}
		else
		{
			fwrite($txt,$reg[$i]["CitologiaCUResultados"]);
		}
	//fwrite($txt,$reg[$i]["CitologiaCUResultados"]); // 88. Citologia Cervico Uterina Resultados Segun Bethesda
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} else if ($edad <= 10 and $reg[$i]["CalidadMuestraCitologia"]!='0')
		{
			fwrite($txt,'0');
		} else if ($edad >= 10 && $reg[$i]["Sexo"]=='F' && $reg[$i]["CalidadMuestraCitologia"]=='0')
		{
			fwrite($txt,'999');
		} else {
			fwrite($txt,$reg[$i]["CalidadMuestraCitologia"]);
		}
	//fwrite($txt,$reg[$i]["CalidadMuestraCitologia"]); // 89. Calidad en la Muestra de Citologia Cervicouterina
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} else if ($edad <= 10 && $reg[$i]["CodigoHabilitacionIPSTomaMuestra"]!='0')
		{
			fwrite($txt,'0');
		} else if ($edad >= 10 && $reg[$i]["Sexo"]=='F' && $reg[$i]["CodigoHabilitacionIPSTomaMuestra"]=='0')
		{
			fwrite($txt,'999');
		} else {
			fwrite($txt,$reg[$i]["CodigoHabilitacionIPSTomaMuestra"]);
		}
	//fwrite($txt,$reg[$i]["CodigoHabilitacionIPSTomaMuestra"]); // 90. Codigo de Habilitacion IPS donde se toma Citologia Cervicouterina
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M')
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["FechaColposcopiaInput"] == '1835-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaColposcopiaInput"]); 
		}
	//fwrite($txt,$reg[$i]["FechaColposcopiaInput"]); // 91. Fecha Colposcopia
	fwrite($txt,"|");
		// Comparar Fecha de Nacimiento con Fecha de Corte
		$dif92  = diferenciaDias($FechaFinal,$reg[$i]["FechaNacimiento"]);
		//echo "Diferencia en Dias ".$dif92;
		$difanios = $dif92 / 365;
		$difanios = floor($difanios);
	fwrite($txt,$reg[$i]["CodigoHabilitacionTomaColposcopia"]); // 92. Codigo de Habilitacion IPS donde se toma Colposcopia
	fwrite($txt,"|");
		if ($reg[$i]["FechaBiopsiaCervicalInput"] == '1835-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaBiopsiaCervicalInput"]);
		}

	//fwrite($txt,$reg[$i]["FechaBiopsiaCervicalInput"]); // 93. Fecha Biopsia Cervical
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ResultadoBiopsiaCervical"]); // 94. Resultado Biopsia Cervical
	fwrite($txt,"|");
		if ($edad >= 10 && $reg[$i]["Sexo"] == 'F' && $reg[$i]["CodigoHabilitacionTomaBiopsia"] == '0' && $reg[$i]["ResultadoBiopsiaCervical"] != 0) 
		{
			fwrite($txt,'999');
		} 
		else {
			fwrite($txt,$reg[$i]["CodigoHabilitacionTomaBiopsia"]);
		}
	//fwrite($txt,$reg[$i]["CodigoHabilitacionTomaBiopsia"]); // 95. Codigo de Habilitacion IPS donde se toma la Biopsia Cervical
	fwrite($txt,"|");
		if ($edad >= 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'1800-01-01');
		} else if ($edad < 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'1845-01-01');
		} else {
			fwrite($txt,$reg[$i]["FechaMamografiaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaMamografiaInput"]); // 96. Fecha Mamografia
	fwrite($txt,"|");
		if ($edad >= 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'999');
		} else if ($edad < 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["ResultadoMamografia"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoMamografia"]); // 97. Resultado Mamografia
	fwrite($txt,"|");
		if ($edad >= 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'999');
		} else if ($edad < 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["CodigoHabilitacionTomaMamografia"]);
		}
	//fwrite($txt,$reg[$i]["CodigoHabilitacionTomaMamografia"]); // 98. Codigo de Habilitacion donde se Toma la Mamografia
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaBiopsiaSenoInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaResultadoBiopsiaSeno"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ResultadoBiopsiaSeno"]);	// 101. Resultado Biopsia Seno por BACAF
	fwrite($txt,"|");
		if ($reg[$i]["ResultadoBiopsiaSeno"] == '0' && $reg[$i]["CodigoHabilitacionBiopsiaSeno"] == '999')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["CodigoHabilitacionBiopsiaSeno"]);
		}
	//fwrite($txt,$reg[$i]["CodigoHabilitacionBiopsiaSeno"]); // 102. Código de habilitación IPS donde se toma Biopsia Seno por BACAF
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaTomaHemoglobinaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ResultadoHemoglobina"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaTomaGlisemiaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaTomaCreatininaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ResultadoCreatinina"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaHemoglobinaGlicosiladaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ResultadoHemoglobinaGlicosilada"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaTomaMicroalbuminuriaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaTomaHDLInput"]);
	fwrite($txt,"|");
		if ($reg[$i]["SintomaticoRespiratorio"] == '1' && $reg[$i]["FechaTomaBaciloscopiaInput"] == '1845-01-01' )
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTomaBaciloscopiaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTomaBaciloscopiaInput"]);
	fwrite($txt,"|");
		if ($reg[$i]["SintomaticoRespiratorio"] == '1' && $reg[$i]["ResultadoBaciloscopia"] == '4')
		{
			fwrite($txt,'22');
		}
		else {
			fwrite($txt,$reg[$i]["ResultadoBaciloscopia"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoBaciloscopia"]);
	fwrite($txt,"|");
		// Si es diferente de no aplica, la variable 17 es igual a 1
		// Si Tiene Tratamiento Contra Hipotiroidismo Congenito (Variable 114 Diferente de 0) Debe Tener Hipotiroidismo (Variable 17 = 1)
		if (($reg[$i]["HipotiroidismoCongenito"] == '0' || $reg[$i]["HipotiroidismoCongenito"] == '2' || $reg[$i]["HipotiroidismoCongenito"] == '21' || ($edad <= 3 && $reg[$i]["HipotiroidismoCongenito"]=='0') ) && $reg[$i]["TratamientoHipotiroidismoCongenito"] != '0')
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["HipotiroidismoCongenito"] == '1' && $reg[$i]["TratamientoHipotiroidismoCongenito"] == '0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["TratamientoHipotiroidismoCongenito"]);
		}
	//fwrite($txt,$reg[$i]["TratamientoHipotiroidismoCongenito"]); // 114. Tratamiento para Hipotiroidismo Congénito
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["TratamientoSifilisGestacional"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["TratamientoSifilisCongenita"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["TratamientoLepra"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaTerLeishmaniasisInput"].PHP_EOL);
}

fclose($txt);
$nombreArchivo;
header("Content-disposition: attachment; filename=$nombreArchivo");
header("Content-type: application/octet-stream");

readfile($nombreArchivo);
include("module.VaciarDirectorio.php");
?>

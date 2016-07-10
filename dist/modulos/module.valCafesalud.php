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

$res = "4505";

$nombreArchivo = $res."".str_replace("-", "", $FechaFinal)."".$CodigoEntidad."".$reg["0"]["CodigoHabilitacionIPS"].".txt";
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
	$Edad = $edadDias / 365;
	$Edad360 = ($edadDias / 365);
	$ValGestacion = $reg[$i]["Gestacion"];
	$EdadRound = floor($Edad);
	$EdadResiduo = $EdadRound % 5;
	fwrite($txt,"2");
	fwrite($txt,"|");
	fwrite($txt,$i+1);
	//fwrite($txt,$reg[$i]["ConsecutivoRegistro"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CodigoHabilitacionIPS"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["TipoIdUsuario"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["NumeroIdUsuario"]);
	fwrite($txt,"|");
	fwrite($txt,trim($reg[$i]["Apellido1"]));
	fwrite($txt,"|");
	fwrite($txt,trim($reg[$i]["Apellido2"]));
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
		if ($Edad <= 10 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["Sexo"]=='F' && $reg[$i]["Gestacion"]=='0' && ($Edad >= 10 && $Edad < 60))
		{
			fwrite($txt,'21');
		}
		else if ($reg[$i]["SifilisGestacional"]=='21' && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["SifilisGestacional"]=='21' && $reg[$i]["Gestacion"]=='0')
		{
			fwrite($txt,'21');
		}
		else if ($Edad >= 60 && $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["Gestacion"]);
		}
	//fwrite($txt,$reg[$i]["Gestacion"]); // 14. Gestacion
	fwrite($txt,"|");
		if ($edadDias > 91 && $reg[$i]["Sexo"]=='M' && ($reg[$i]["Gestacion"]=='21' || $reg[$i]["Gestacion"]=='0'))
		{
			fwrite($txt,'0');
		}
		else if ($Edad < 60 && $reg[$i]["SifilisGestacional"]=='0')
		{
			if ($reg[$i]["Gestacion"]=='0' && $edadDias > 91) 
			{
				fwrite($txt,'0');
			}
			else
			{
				fwrite($txt,'21');
			}
			
		}
		else if ($Edad >= 60 && $reg[$i]["SifilisGestacional"]=='0' && $reg[$i]["Sexo"]=='F')
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
		if ($edad <= 10  && $reg[$i]["HipertensionInducidaGestacion"]!='0')
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Gestacion"]=='0')
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
		if ($edad >= 19 and $reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} else if ($edad < 19 and $reg[$i]["VictimaMaltrato"]=='0')
		{
			fwrite($txt,'21');
		} else {
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
	fwrite($txt,$reg[$i]["FechaPeso"]); // 29. 
	fwrite($txt,"|");
		if ($reg[$i]["PesoKilogramos"] > 1000)
		{
			$peso = $reg[$i]["PesoKilogramos"] * 0.001;
			fwrite($txt,$peso);
		} else {
			fwrite($txt,$reg[$i]["PesoKilogramos"]);
		}
	//fwrite($txt,$reg[$i]["PesoKilogramos"]); // 30. Peso en Kilogramos
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaTalla"]);
	fwrite($txt,"|");
		if ($reg[$i]["TallaCentimetros"] > 225 and $reg[$i]["TallaCentimetros"]!='999')
		{
			$talla = $reg[$i]["TallaCentimetros"] * 0.1;
			fwrite($txt,$talla);
		} else {
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
		if ($reg[$i]["BCG"]!='0' && $Edad > 6 && $reg[$i]["Lepra"]!='3')
		{
			if ($reg[$i]["BCG"]=='22' && $entidad=='EPS013') 
			{
				fwrite($txt,'0');
			} 
			else 
			{
			fwrite($txt,$reg[$i]["BCG"]);
			}
		} 
		else if ($reg[$i]["BCG"]=='0' && $Edad > 6) 
		{
			fwrite($txt,$reg[$i]["BCG"]);
		} 
		else if ($reg[$i]["BCG"] >= 1 && $Edad > 0 && $Edad <= 6)
		{
			fwrite($txt,$reg[$i]["BCG"]);
		} 
		else if ($reg[$i]["BCG"] == '22' && $Edad > 6)
		{
			fwrite($txt,'0');
		} 
		else  if ($reg[$i]["BCG"] == '0' && $Edad <= 6)
		{
			fwrite($txt,'22');
		}
		else
		{
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
		if ($Edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($Edad < 6 && $reg[$i]["Pentavalente"]=='0') 
		{
			fwrite($txt,'22');
		} 
		else 
		{
			fwrite($txt,$reg[$i]["Pentavalente"]);
		}
	// fwrite($txt,$reg[$i]["Pentavalente"]); // 37. Pentavalente
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["Polio"]=='0') 
		{
			fwrite($txt,'22');
		} 
		else {
			fwrite($txt,$reg[$i]["Polio"]);
		}
	// fwrite($txt,$reg[$i]["Polio"]); // 38. Polio
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["DPT"]=='0')
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["DPT"]);
		}
	//fwrite($txt,$reg[$i]["DPT"]); // 39. DPT en Menores de 5 años
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ( $edad < 6 && $reg[$i]["Rotavirus"]=='0' )
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["Rotavirus"]);
		}
	//fwrite($txt,$reg[$i]["Rotavirus"]); // 40. Rotavirus
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["Neumococo"]=='0')
		{
			fwrite($txt,'22');
		}
		else {
			fwrite($txt,$reg[$i]["Neumococo"]);
		}
	//fwrite($txt,$reg[$i]["Neumococo"]); // 41. Neumococo
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["InfluenzaN"]=='0')
		{
			fwrite($txt,'22');
		} 
		else
		{
			fwrite($txt,$reg[$i]["InfluenzaN"]);
		}
	//fwrite($txt,$reg[$i]["InfluenzaN"]); // 42. Influenza Niños
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["FiebreAmarillaN1"]=='0')
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["FiebreAmarillaN1"]); 
		}
	//fwrite($txt,$reg[$i]["FiebreAmarillaN1"]); // 43. Fiebre Amarilla en Menores de Un Año
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0'); 
		} 
		else if ($edad < 6 && $reg[$i]["HepatitisA"]=='0')
		{
			fwrite($txt,'22'); 
		} else {
			fwrite($txt,$reg[$i]["HepatitisA"]); 
		}
	//fwrite($txt,$reg[$i]["HepatitisA"]); // 44. Hepatitis A
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["TripleViralN"]=='0')
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["TripleViralN"]);
		}
	//fwrite($txt,$reg[$i]["TripleViralN"]); // 45. Triple Viral Niños
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["Sexo"]=='F' && $edad < 9)
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Sexo"]=='F' && $edad >= 9 && $reg[$i]["VPH"] == '0')
		{
			fwrite($txt,'22');
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
		} 
		else if (($edad >= 10 && $edad < 50) && $reg[$i]["TdTtMEF"]=='0')
		{
			fwrite($txt,'22');
		} 
		else if (($edad < 10 || $edad > 50) && $reg[$i]["TdTtMEF"]=='22' || $reg[$i]["Sexo"]=='M')
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
		} 
		else if ($edad > 2 && $reg[$i]["ControlPlacaBacteriana"]=='0')
		{
			fwrite($txt,'22');
		} 
		else {
			fwrite($txt,$reg[$i]["ControlPlacaBacteriana"]);
		}
	//fwrite($txt,$reg[$i]["ControlPlacaBacteriana"]); // 48. Control de Placa Bacteriana
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"]=='0' || $reg[$i]["Gestacion"]=='2' || $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($reg[$i]["Gestacion"]=='1' && $reg[$i]["FechaAtencionParto"]=='1800-01-01')
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
		} else if ($reg[$i]["Gestacion"]=='1' && $reg[$i]["FechaSalidaParto"]=='1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		} else {
			fwrite($txt,$reg[$i]["FechaSalidaParto"]);
		}
	//fwrite($txt,$reg[$i]["FechaSalidaParto"]); // 50. Fecha Salida de la Atención del Parto o Cesárea
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2' || $edad > 60 )
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($reg[$i]["Gestacion"]=='1' && $reg[$i]["FechaConsejeriaLactanciaInput"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		} 
		else {
			fwrite($txt,$reg[$i]["FechaConsejeriaLactanciaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaConsejeriaLactanciaInput"]); // 51. Fecha de Consejería en Lactancia Materna
	fwrite($txt,"|");
		if ($edadDias < 30 && $reg[$i]["ControlRecienNacidoInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else 
		{
			fwrite($txt,$reg[$i]["ControlRecienNacidoInput"]);
		}
	//fwrite($txt,$reg[$i]["ControlRecienNacidoInput"]); // 52. Control Recién Nacido
	fwrite($txt,"|");
		if (($edad < 10 || $edad >= 60) && $reg[$i]["PlanificacionFamiliarPrimeraVezInput"]!='1845-01-01')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($edad >= 10 && $edad < 60 && $reg[$i]["PlanificacionFamiliarPrimeraVezInput"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else {
			fwrite($txt,$reg[$i]["PlanificacionFamiliarPrimeraVezInput"]);
		}
		//fwrite($txt,$reg[$i]["PlanificacionFamiliarPrimeraVezInput"]); //53. Planificacion Familiar Primera Vez Input
	fwrite($txt,"|");
		if (($edad < 10 || $edad >= 60) && $reg[$i]["SuministroMetodoAnticonceptivo"]!='0')
		{
			fwrite($txt,'0');
		}
		else if ($edad >= 10 && $edad < 60 && $reg[$i]["SuministroMetodoAnticonceptivo"]=='0')
		{
			fwrite($txt,'21');
		}
		else
		{
			fwrite($txt,$reg[$i]["SuministroMetodoAnticonceptivo"]);
		}
	//fwrite($txt,$reg[$i]["SuministroMetodoAnticonceptivo"]); //54. Suministro de Método Anticonceptivo
		fwrite($txt,"|");
		if (($edad < 10 || $edad >= 60) && $reg[$i]["FechaSuministroMetodoAnticonceptivo"]!='1845-01-01')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($edad >= 10 && $edad < 60 && $reg[$i]["FechaSuministroMetodoAnticonceptivo"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaSuministroMetodoAnticonceptivo"]);
		}
	//fwrite($txt,$reg[$i]["FechaSuministroMetodoAnticonceptivo"]); //55. Fecha Suministro Metodo Anticonceptivo
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'1845-01-01');
		} else if ($reg[$i]["Gestacion"]=='1')
		{
			fwrite($txt,'1800-01-01');
		} else 
		{
			fwrite($txt,$reg[$i]["ControlPrenatalPrimeraVezInput"]);
		}
	//fwrite($txt,$reg[$i]["ControlPrenatalPrimeraVezInput"]); // 56. Control Prenatal de Primera Vez
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2' || $reg[$i]["Gestacion"]=='0')
		{
			fwrite($txt,'0');
		} else if ($reg[$i]["Gestacion"]='1' && $reg[$i]["ControlPrenatal"]=='0')
		{
			fwrite($txt,'999');
		} else {
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
		else {
			fwrite($txt,$reg[$i]["UltimoControlPrenatal"]);
		}
	//fwrite($txt,$reg[$i]["UltimoControlPrenatal"]); // 58. Ultimo Control Prenatal
	fwrite($txt,"|");
		if($reg[$i]["Gestacion"]=='1' || $reg[$i]["Gestacion"]=='')
		{
			fwrite($txt,'21');
		}
		else 
		{
			fwrite($txt,$reg[$i]["SuministroAcidoFolico"]);
		}
	//fwrite($txt,$reg[$i]["SuministroAcidoFolico"]); // 59. Suministro de Acido Folico en el Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["Gestacion"]=='1' || $reg[$i]["Gestacion"]=='')
		{
			fwrite($txt,'21');
		} 
		else 
		{
			fwrite($txt,$reg[$i]["SuministroSulfatoFerroso"]);
		}
	//fwrite($txt,$reg[$i]["SuministroSulfatoFerroso"]); // 60. Suministro de Sulfato Ferroso en el Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' && $reg[$i]["Gestacion"]!='1')
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["Gestacion"]=='1' || $reg[$i]["Gestacion"]=='')
		{
			fwrite($txt,'21');
		} 
		else
		{
			fwrite($txt,$reg[$i]["SuministroCarbonatoCalcio"]);
		}
	//fwrite($txt,$reg[$i]["SuministroCarbonatoCalcio"]); // 61. Suministro de Carbonato de Calcio en el Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($edad > 45 && $reg[$i]["ValoracionAgudezaVisualInput"] == '1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else if (($edad == 4 || $edad == 11 || $edad == 16 || $edad == 45) && $reg[$i]["ValoracionAgudezaVisualInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ValoracionAgudezaVisualInput"]);
		}
	//fwrite($txt,$reg[$i]["ValoracionAgudezaVisualInput"]); //62. Valoración de la Agudeza Visual
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaOftalmologiaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaDiagnosticoDesnutricion"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaMujerMenorVictimaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaVictimaViolenciaSexualInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaNutricionInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaPsicologiaInput"]);
	fwrite($txt,"|");
		if ($reg[$i]["ConsultaCyDPrimeraVezInput"] == '1845-01-01' && $edad < 10)
		{
			fwrite($txt,'1800-01-01');
		}
		else 
		{
			fwrite($txt,$reg[$i]["ConsultaCyDPrimeraVezInput"]); 
		}
	//fwrite($txt,$reg[$i]["ConsultaCyDPrimeraVezInput"]); // 69. Suministro de Sulfato Ferroso en la Ultima Consulta de Menor de 10 Años
	fwrite($txt,"|");
		if ($edad > 10)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 10 && $reg[$i]["SuministroSulfatoFerrosoMenor"]=='0')
		{
			fwrite($txt,'21');
		} 
		else {
			fwrite($txt,$reg[$i]["SuministroSulfatoFerrosoMenor"]);
		}
	//fwrite($txt,$reg[$i]["SuministroSulfatoFerrosoMenor"]); // 70. Suministro de Sulfato Ferroso en la Ultima Consulta de Menor de 10 Años
	fwrite($txt,"|");
		if ($edad > 10)
		{
			fwrite($txt,'0');
		} else if ($edad < 10 && $reg[$i]["SuministroVitaminaAMenor"]=='0')
		{
			fwrite($txt,'21');
		} else {
			fwrite($txt,$reg[$i]["SuministroVitaminaAMenor"]);
		}
	//fwrite($txt,$reg[$i]["SuministroVitaminaAMenor"]); // 71. Suministro de Vitamina A en la Ultima Consulta de Menor de 10 Años
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ConsultaJovenPrimeraVezInput"]);
	fwrite($txt,"|");
	// Pagina 49: La opción 1845-01-01 se usa: Para población mayor de 45 años
	// 
		if ($edad >= 45 && $reg[$i]["ConsultaAdultoPrimeraVezInput"] == '1845-01-01')
		{
			if ($edad == 45 || $edad == 50 || $edad == 55 || $edad == 60 || $edad == 65 || $edad == 65 || $edad == 70 || $edad == 75 || $edad == 80 || $edad == 85)
			{
				fwrite($txt,'1800-01-01');
			}
			else
			{
				fwrite($txt,'1845-01-01');
			}	
		}
		else
		{
			fwrite($txt,$reg[$i]["ConsultaAdultoPrimeraVezInput"]);
		}
	//fwrite($txt,$reg[$i]["ConsultaAdultoPrimeraVezInput"]); // 73. Consulta de Adulto Primera vez
	fwrite($txt,"|");
		fwrite($txt,'0');
	//fwrite($txt,$reg[$i]["PreservativosITSInput"]); // 74. Preservativos Entregados a Pacientes con ITS
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["AsesoriaPreElisaInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["AsesoriaPostElisaInput"]);
	fwrite($txt,"|");
		if ($reg[$i]["EnfermedadMental"] == '21'&&  $reg[$i]["PacienteEnfermedadMental"] == '1')
		{
			fwrite($txt,"0");
		} else {
			fwrite($txt,$reg[$i]["PacienteEnfermedadMental"]);
		}
	//fwrite($txt,$reg[$i]["PacienteEnfermedadMental"]); // 77. Paciente con Diagnóstico de: Ansiedad, Depresión, Esquizofrenia, déficit de atención, consumo SPA y Bipolaridad recibió Atención en los últimos 6 meses por Equipo Interdisciplinario Completo
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if (($reg[$i]["Gestacion"]=='1' || $reg[$i]["Gestacion"]=='') && $reg[$i]["FechaAntigenoHepatitisBGestantesInput"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		} 
		else {
			fwrite($txt,$reg[$i]["FechaAntigenoHepatitisBGestantesInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaAntigenoHepatitisBGestantesInput"]); // 78. Fecha Antigeno de Superficie Hepatitis B en Gestantes
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M')
		{
			fwrite($txt,'0');
		} else if (($reg[$i]["Gestacion"]=='1' || $reg[$i]["Gestacion"]=='') && $reg[$i]["ResultadoAntigenoHepatitisBGestantes"]=='0')
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["ResultadoAntigenoHepatitisBGestantes"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoAntigenoHepatitisBGestantes"]); // 79. Resultado Antigeno de Superficie Hepatitis B en Gestantes
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaSerologiaSifilisInput"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ResultadoSerologiaSifilis"]);
	fwrite($txt,"|");
		if ($reg[$i]["FechaTomaElisaVIHInput"]=='0000-00-00')
		{
			// Si Variable 75 y 76 = 1845-01-01 y Variable 82 = 1800-01-01
			if ($reg[$i]["AsesoriaPreElisaInput"] == '1845-01-01' && $reg[$i]["AsesoriaPostElisaInput"] == '1845-01-01')
			{
				fwrite($txt,'1845-01-01');
			}
			else
			{
				fwrite($txt,'1800-01-01');
			}
		} 
		// Si Variable 75 y 76 = 1845-01-01 y Variable 82 = 1800-01-01
		else if ($reg[$i]["AsesoriaPreElisaInput"] == '1845-01-01' && $reg[$i]["AsesoriaPostElisaInput"] == '1845-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTomaElisaVIHInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTomaElisaVIHInput"]); // 82. Fecha de Toma de Elisa para VIH
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ResultadoElisaVIH"]);
	fwrite($txt,"|");
		if ($edadDias < 2)
		{
			fwrite($txt,'1845-01-01');
		} else {
			fwrite($txt,$reg[$i]["FechaTSHNeonatalInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTSHNeonatalInput"]); // 84. Fecha TSH Neonatal
	fwrite($txt,"|");
		if ($edadDias > 30)
		{
			fwrite($txt,'0');
		}
		else if ($edadDias < 30)
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoTSHNeonatal"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoTSHNeonatal"]); // 85. Resultado de TSH Neonatal
	fwrite($txt,"|");
		if ($edad < 10 && $reg[$i]["TamizajeCancerCU"]!='0')
		{
			fwrite($txt,'0');
		}
		else if ($edad >= 10 && $reg[$i]["TamizajeCancerCU"]=='0' && $reg[$i]["Sexo"] == 'F')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["TamizajeCancerCU"]);
		}
	//fwrite($txt,$reg[$i]["TamizajeCencerCU"]); // 86. Tamizaje Cancer de Cuello Uterino
	fwrite($txt,"|");
		//Validar que cuando la variable 87 registre un dato diferente a 
		//1845-01-01, 1805-01-01,1810-01-01, 1825-01-01,1830-0101,1835-01-01 
		//la variable 88 corresponda a un dato diferente de 0
		if ($edad > 10 && $reg[$i]["FechaCitologiaCUInput"] == '1845-01-01' && $reg[$i]["Sexo"] == 'F')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["FechaCitologiaCUInput"] == '1835-01-01' )
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
		} else if ($edad < 10 && $reg[$i]["CalidadMuestraCitologia"]!='0')
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
		} else if ($edad < 10 && $reg[$i]["CodigoHabilitacionIPSTomaMuestra"]!='0')
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
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["CitologiaCUResultados"]=='17' || $edad < 10)
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 10 && $reg[$i]["Sexo"]=='F' && $reg[$i]["CodigoHabilitacionTomaColposcopia"]=='0')
		{
			if ($reg[$i]["FechaColposcopiaInput"] == '1845-01-01')
			{
				fwrite($txt,'0');
			}
			else
			{
				fwrite($txt,'999');
			}
		}
		else 
		{
			fwrite($txt,$reg[$i]["CodigoHabilitacionTomaColposcopia"]);
		}
	//fwrite($txt,$reg[$i]["CodigoHabilitacionTomaColposcopia"]); // 92. Codigo de Habilitacion IPS donde se toma Colposcopia
	fwrite($txt,"|");
		// Validar que cuando la variable 93 registre un dato diferente a 1845-01-01 la variable 10 corresponda a F
		// Validar que cuando la variable 93 registre un valor diferente a 1845-01-01 el cálculo de la edad* debe ser mayor a 10 años

		// La opción 1845-01-01 se usa:  
		// -  se usa personas de sexo masculino. 
		// -  Menores de 10 años  
		// -  Mujeres que reportan citología normal 
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["CitologiaCUResultados"]=='17' || $edad < 10)
		{
			fwrite($txt,'1845-01-01');
		} 
		else if (($reg[$i]["FechaBiopsiaCervicalInput"]=='1845-01-01' || $reg[$i]["FechaBiopsiaCervicalInput"]=='1835-01-01') && $reg[$i]["Sexo"]=='F' && $edad >=10)
		{
			fwrite($txt,'1800-01-01');
		} 
		else {
			fwrite($txt,$reg[$i]["FechaBiopsiaCervicalInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaBiopsiaCervicalInput"]); // 93. Fecha Biopsia Cervical
	fwrite($txt,"|");
		// Validar que cuando la variable 94 registre un dato diferente a  0  la variable 10 corresponda a F
		// Validar que cuando la variable 94 registre un valor diferente a  0  el cálculo de la edad* debe ser mayor a 10 años

		// La opción 0 se usa:  
		// -  se usa personas de sexo masculino. 
		// -  Menores de 10 años  
		// -  Mujeres que reportan citología normal 
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["CitologiaCUResultados"]=='17' || $edad < 10)
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 10 && $reg[$i]["Sexo"]=='F' && $reg[$i]["ResultadoBiopsiaCervical"]=='0')
		{
			fwrite($txt,'999');
		} else {
			fwrite($txt,$reg[$i]["ResultadoBiopsiaCervical"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoBiopsiaCervical"]); // 94. Resultado Biopsia Cervical
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CodigoHabilitacionTomaBiopsia"]); // 95. Codigo de Habilitacion IPS donde se toma la Biopsia Cervical
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
	fwrite($txt,$reg[$i]["ResultadoBiopsiaSeno"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CodigoHabilitacionBiopsiaSeno"]);
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaTomaHemoglobinaInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Sexo"] == 'F' && ($edad >= 10 && $edad <= 13) && $reg[$i]["FechaTomaHemoglobinaInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}	
		else if ($reg[$i]["Sexo"] == 'F' && $reg[$i]["ResultadoHemoglobina"] == '0')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTomaHemoglobinaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTomaHemoglobinaInput"]); // 103. Fecha Toma de Hemoglobina
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ResultadoHemoglobina"]); // 104. 
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
	fwrite($txt,$reg[$i]["FechaTomaBaciloscopiaInput"]); // 112. Fecha Toma de Baciloscopia de Diagnóstico
	fwrite($txt,"|");
		$DateResultadoBasiloscopia = date($reg[$i]["FechaTomaBaciloscopiaInput"]);
		$YearResultadoBasiloscopia = substr($DateResultadoBasiloscopia, 0, 4);
		if ($YearResultadoBasiloscopia > 1900 && $reg[$i]["ResultadoBaciloscopia"] == '4')
		{
			fwrite($txt,'1');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoBaciloscopia"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoBaciloscopia"]); // 113. Baciloscopia de Diagnostico
	fwrite($txt,"|");
		// Si es diferente de no aplica, la variable 17 es igual a 1
		// Si Tiene Tratamiento Contra Hipotiroidismo Congenito (Variable 114 Diferente de 0) Debe Tener Hipotiroidismo (Variable 17 = 1)
		if (($reg[$i]["HipotiroidismoCongenito"] == '0' || $reg[$i]["HipotiroidismoCongenito"] == '2' ) && $reg[$i]["TratamientoHipotiroidismoCongenito"] != '0')
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
		if ($reg[$i]["FechaTerLeishmaniasisInput"] == '1845-01-00')
		{
			fwrite($txt,'1845-01-01'.PHP_EOL);
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTerLeishmaniasisInput"].PHP_EOL);
		}
	//fwrite($txt,$reg[$i]["FechaTerLeishmaniasisInput"].PHP_EOL);
}

fclose($txt);
$nombreArchivo;
header("Content-disposition: attachment; filename=$nombreArchivo");
header("Content-type: application/octet-stream");

readfile($nombreArchivo);

?>
<?php
require_once ("../clases/class.rped.php");
include ("module.ManejoFechas.php");
$objRPED = new rped();

// Datos Provenientes de module.SeleccionarValidador.php
$IdUsuario = $_GET["IdU"];
$CodigoMunicipio = $_GET["CodM"];
$Nit = $_GET["Nit"];
$CodigoEntidad = $_GET["CodE"];
$FechaInicio = $_GET["FIn"];
$FechaFinal = $_GET["FFn"];

// Numero de Registros
$numReg = $objRPED->getNumRows($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaInicio, $FechaFinal);

// Registros para Exportar
$reg = $objRPED->getRPED($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaInicio, $FechaFinal);

$res='SGD280RPED';
$tipoId = 'NI';
$numId = '000'.$Nit;
$cons = 'S01';

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
fwrite($txt,$numReg."\r\n");

for ($i=0;$i<sizeof($reg);$i++)
{
	$edad = calcularEdad($FechaFinal, $reg[$i]["FechaNacimiento"]);
	$edadDias = calcularEdadenDias ($reg[$i]["FechaNacimiento"], $FechaFinal);
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
		if (trim($reg[$i]["Apellido1"]=='CASTANEDA'))
		{
			fwrite($txt,'CASTAÑEDA');
		}
		else if (trim($reg[$i]["Apellido2"]=='CASTANEDA'))
		{
			fwrite($txt,'CASTAÑEDA');
		}
		else if (trim($reg[$i]["Apellido2"]=='LONDONO'))
		{
			fwrite($txt,'LONDOÑO');
		}
		else if (trim($reg[$i]["Apellido1"]=='CANAS'))
		{
			fwrite($txt,'CAÑAS');
		} 
		else if (trim($reg[$i]["Apellido1"]=='MUNOZ'))
		{
			fwrite($txt,'MUÑOZ');
		} 
		else if(trim($reg[$i]["Apellido1"]=='CATANO'))
		{
			fwrite($txt,'CATAÑO');
		}
		else if (trim($reg[$i]["Apellido1"]=='LONDONO'))
		{
			fwrite($txt,'LONDOÑO');
		} 
		else if (trim($reg[$i]["Apellido1"]=='CANAVERAL'))
		{
		fwrite($txt,'CAÑAVERAL');
		} 
		else
		{
			fwrite($txt,trim($reg[$i]["Apellido1"]));
		}
	//fwrite($txt,$reg[$i]["Apellido1"]));		// 5. Apellido1
	fwrite($txt,"|");
		if (trim($reg[$i]["Apellido2"]=='MUNOZ'))
		{
			fwrite($txt,'MUÑOZ');
		}
		else if (trim($reg[$i]["Apellido2"]=='MONTANO'))
		{
			fwrite($txt,'MONTAÑO');
		}
		else if (trim($reg[$i]["Apellido2"]=='CANAS'))
		{
			fwrite($txt,'CAÑAS');
		}
		else if (trim($reg[$i]["Apellido2"]=='PATINO'))
		{
			fwrite($txt,'PATIÑO');
		}
		else {
			fwrite($txt,trim($reg[$i]["Apellido2"]));
		}
	//fwrite($txt,trim($reg[$i]["Apellido2"]));			// 6. Apellido2
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
		//registrar no aplica en sexo F menor de 10 años o mayor de 60 años y todos los de sexo M
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
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["SifilisGestacional"] == '0')
		{
			fwrite($txt,'21');
		}
		else if ($reg[$i]["Gestacion"] == '0' || ($edad < 10 || $edad >= 60) || $reg[$i]["Gestacion"] == '21' || (($edad >= 10 && $edad < 60) && $reg[$i]["Gestacion"] == 0))
		{
			fwrite($txt,'0'); 
		}
		else if ($reg[$i]["Gestacion"] == '2' && $reg[$i]["SifilisGestacional"] == '21')
		{
			fwrite($txt,'0'); 
		}
		else
		{
			fwrite($txt,$reg[$i]["SifilisGestacional"]); 
		}
	//fwrite($txt,$reg[$i]["SifilisGestacional"]); // 15. Sifilis Gestacional y Congenita
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '0' || ($edad < 10 || $edad >= 60) || $reg[$i]["Gestacion"] == '21' || (($edad >= 10 && $edad < 60) && $reg[$i]["Gestacion"] == 0))
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Gestacion"] == '2' && $reg[$i]["HipertensionInducidaGestacion"] == '21')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["HipertensionInducidaGestacion"]);
		}
	//fwrite($txt,$reg[$i]["HipertensionInducidaGestacion"]); // 16. Hipertension Inducida por la Gestacion
	fwrite($txt,"|");
		// La opcion 0 se Utiliza en Mayores de 3 Años
		if ($edad >= 3)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 3 || $reg[$i]["HipotiroidismoCongenito"] != '0') // Se puede tener en cuenta para la Pregunta 85. Resultado TSH Neonatal
		{
			fwrite($txt,'21');
		}
		else
		{
			fwrite($txt,$reg[$i]["HipotiroidismoCongenito"]);
		}
	//fwrite($txt,$reg[$i]["HipotiroidismoCongenito"]); // 17. Hipotiroidismo Congenito
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["SintomaticoRespiratorio"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["Tuberculosis"]); // 19. Tuberculosis Multidrogoresistente
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["Lepra"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ObesidadDesnutricion"]); // 21. Obsesidad o Desnutrición Proteico Calórica
	fwrite($txt,"|");
		if ($edad < 19 && $reg[$i]["VictimaMaltrato"] == '0')
		{
			fwrite($txt,'21');
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
	fwrite($txt,$reg[$i]["EnfermedadMental"]); // 25. Enfermedad Mental
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CancerCervix"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CancerSeno"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FluorosisDental"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaPeso"]);
	fwrite($txt,"|");
		if ($reg[$i]["PesoKilogramos"] > 250)
		{
			$Peso = substr($reg[$i]["PesoKilogramos"], 0, 2);
			fwrite($txt,$Peso);
		}
		else if ($edad < 1 && ($reg[$i]["PesoKilogramos"] > 250 && $reg[$i]["PesoKilogramos"] < 999))
		{
			$pesoRedondeado = round($reg[$i]["PesoKilogramos"] / 100);
			fwrite($txt,$pesoRedondeado);
		}
		else
		{
			fwrite($txt,$reg[$i]["PesoKilogramos"]);
		}
	//fwrite($txt,$reg[$i]["PesoKilogramos"]); // 30. Peso en Kilogramos
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaTalla"]);
	fwrite($txt,"|");
		if ($reg[$i]["TallaCentimetros"] > 200)
		{
			$Talla = substr($reg[$i]["TallaCentimetros"], 0,2);
			fwrite($txt,$Talla);
		}
		else
		{
			fwrite($txt,$reg[$i]["TallaCentimetros"]);
		}
	//fwrite($txt,$reg[$i]["TallaCentimetros"]); // 32. Talla en Centimetros
	fwrite($txt,"|");
		//Calcularemos la Diferencia en Dias Entre la Fecha Del Reporte y La Fecha Probable del Parto
		// Debe Ser Menor a 280 o 9 Meses
		$FechaParto = $reg[$i]["FechaProbableParto"];
		$FechaReporte = $FechaFinal;

		$diferencia = diferenciaFecha($FechaReporte, $FechaParto);

		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaProbableParto"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '1' && $diferencia > 280)
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '2' && $reg[$i]["FechaProbableParto"] == '1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaProbableParto"]); 
		}
	//fwrite($txt,$reg[$i]["FechaProbableParto"]); // 33. Fecha Probable Parto
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 6 && $reg[$i]["EdadGestacional"] == '0')
		{
			fwrite($txt,'999');
		}
		else
		{
			fwrite($txt,$reg[$i]["EdadGestacional"]);
		}

	//fwrite($txt,$reg[$i]["EdadGestacional"]); // 34. Edad Gestacion al Nacer
	fwrite($txt,"|");
		if ($edad >= 6) 
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["BCG"]== '0')
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
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 6 && $reg[$i]["Pentavalente"]== '0') 
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["Pentavalente"]);
		}
	//fwrite($txt,$reg[$i]["Pentavalente"]); // 37. Pentavalente
	fwrite($txt,"|");
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if ($edad < 6 && $reg[$i]["Polio"]== '0') 
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["Polio"]);
		}
	//fwrite($txt,$reg[$i]["Polio"]); // 38. Polio
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
		//Si registra dato diferente a no aplica debe ser F, mayor e igual a 9 años
		if ($edad < 9 && ($reg[$i]["Sexo"] == 'M' || $reg[$i]["Sexo"] == 'F' )) 
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 9 && $reg[$i]["Sexo"] == 'F' && $reg[$i]["VPH"]=='0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["VPH"]);
		}
	//fwrite($txt,$reg[$i]["VPH"]); // 46. Virus del Papiloma Humano (VPH)
	fwrite($txt,"|");
		// Si registra dato diferente a no aplica debe ser F menor a 50 años
		if ($reg[$i]["Sexo"] == 'M')
		{
			fwrite($txt,'0');
		}	
		else if( ($edad >= 50 || $edad < 10) && $reg[$i]["Sexo"] == 'F')
		{
			fwrite($txt,'0');
		}
		else if ($edad < 50 && $reg[$i]["TdTtMEF"] == '0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["TdTtMEF"]);
		}
	//fwrite($txt,$reg[$i]["TdTtMEF"]); // 47. TD o TT Mujeres en Edad Fertil 15  a 49 años
	fwrite($txt,"|");
		if ($edad < 2) 
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 2 && $reg[$i]["ControlPlacaBacteriana"]=='0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["ControlPlacaBacteriana"]); 
		}
		
	//fwrite($txt,$reg[$i]["ControlPlacaBacteriana"]); // 48. Control de Placa Bacteriana
	fwrite($txt,"|");
		if ($edad < 10 || $edad >= 60)
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaAtencionParto"] =='1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else if (($reg[$i]["Gestacion"] == '21' && $reg[$i]["FechaAtencionParto"] =='1800-01-01') || (($edad >= 10 && $edad < 60) && $reg[$i]["Gestacion"] == 0))
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaAtencionParto"]);
		}
	//fwrite($txt,$reg[$i]["FechaAtencionParto"]); // 49. Fecha Atencion Parto o Cesarea
	fwrite($txt,"|");
		if ($edad < 10 || $edad >= 60)
		{
			fwrite($txt,'1845-01-01'); 
		}
		else if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaSalidaParto"] =='1800-01-01')
		{
			fwrite($txt,'1845-01-01'); 
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaSalidaParto"]); 
		}
	//fwrite($txt,$reg[$i]["FechaSalidaParto"]); // 50. Fecha Salida de la Atención del Parto o Cesárea
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M')
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '0')
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["Sexo"] == 'F' && $reg[$i]["FechaConsejeriaLactanciaInput"] == '1845-01-01')
		{
			if ($edad < 10 || $edad >= 60)
			{
				fwrite($txt,'1845-01-01');
			}
			else
			{
				fwrite($txt,'1800-01-01');
			}
		}
		else
		{
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
	fwrite($txt,$reg[$i]["PlanificacionFamiliarPrimeraVezInput"]); //53. Planificacion Familiar Primera Vez Input
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
		if ($reg[$i]["Sexo"] == 'F' && $reg[$i]["Gestacion"] == '1' && $reg[$i]["ControlPrenatalPrimeraVezInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '0' && $reg[$i]["ControlPrenatalPrimeraVezInput"] == '1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '2' && $reg[$i]["ControlPrenatalPrimeraVezInput"] == '1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ControlPrenatalPrimeraVezInput"]);
		}
	//fwrite($txt,$reg[$i]["ControlPrenatalPrimeraVezInput"]); // 56. Control Prenatal de Primera Vez
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M')
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Gestacion"] == '2')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["ControlPrenatal"]);
		}
	//fwrite($txt,$reg[$i]["ControlPrenatal"]); // 57. Control Prenatal
	fwrite($txt,"|");
		$DateUltimoControlPrenatal = date($reg[$i]["UltimoControlPrenatal"]);
		$YearUltimoControlPrenatal = substr($DateUltimoControlPrenatal, 0, 4);
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["UltimoControlPrenatal"]=='1845-01-01')
		{	
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '2' && ($reg[$i]["UltimoControlPrenatal"] == '1800-01-01' || $reg[$i]["UltimoControlPrenatal"] > 1845))
		{
			fwrite($txt,'1845-01-01');	
		}
		else
		{
			fwrite($txt,$reg[$i]["UltimoControlPrenatal"]);
		}
	//fwrite($txt,$reg[$i]["UltimoControlPrenatal"]); // 58. Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["SuministroAcidoFolico"] == '0')
		{
			fwrite($txt,'21');
		}
		else if ($reg[$i]["Gestacion"] == '2' && $reg[$i]["SuministroAcidoFolico"] == '21')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["SuministroAcidoFolico"]);
		}
	//fwrite($txt,$reg[$i]["SuministroAcidoFolico"]); // 59. Suministro de Acido Folico en el Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["SuministroSulfatoFerroso"] == '0')
		{
			fwrite($txt,'21');
		}
		else if ($reg[$i]["Gestacion"] == '2' && $reg[$i]["SuministroSulfatoFerroso"] == '21')
		{
			fwrite($txt,'0');
		}
		else
		{
		fwrite($txt,$reg[$i]["SuministroSulfatoFerroso"]); 
		}
	//fwrite($txt,$reg[$i]["SuministroSulfatoFerroso"]); // 60. Suministro de Sulfato Ferroso en el Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M' || $reg[$i]["Gestacion"] == '0' || $reg[$i]["Gestacion"] == '2')
		{
			fwrite($txt,'0');
		}
		else if (($reg[$i]["Sexo"] == 'F' || $reg[$i]["Gestacion"] == '1') && $reg[$i]["SuministroCarbonatoCalcio"] == '0')
		{
			if ($reg[$i]["Gestacion"] == '21')
			{
				fwrite($txt,'0');
			}
			else
			{
				fwrite($txt,'21');
			}
		}
		else
		{
			fwrite($txt,$reg[$i]["SuministroCarbonatoCalcio"]);
		}
	//fwrite($txt,$reg[$i]["SuministroCarbonatoCalcio"]); // 61. Suministro de Carbonato de Calcio en el Ultimo Control Prenatal
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["ValoracionAgudezaVisualInput"]);
	fwrite($txt,"|");
		if ($edad == 60 && $reg[$i]["ConsultaOftalmologiaInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ConsultaOftalmologiaInput"]);
		}
	//fwrite($txt,$reg[$i]["ConsultaOftalmologiaInput"]); // 63. Consulta por Oftalmología
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

		$añoCyD = substr($reg[$i]["ConsultaCyDPrimeraVezInput"], 0, 4);

		if ($edad >= 10 && $reg[$i]["ConsultaCyDPrimeraVezInput"] == '1800-01-01' || ($edad >= 10 && $añoCyD > 1845))
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($edad < 10 && $reg[$i]["ConsultaCyDPrimeraVezInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ConsultaCyDPrimeraVezInput"]);
		}
	//fwrite($txt,$reg[$i]["ConsultaCyDPrimeraVezInput"]); // 69. Consulta de Crecimiento y Desarrollo Primeva Vez
	fwrite($txt,"|");
		if ($edad >= 10)
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
		if ($edad >= 10)
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
		// Debe registrar diferente de 1845-01-01, si tiene entre 10 y 29 años
		if ($edad < 10 || $edad >= 30)
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["ConsultaJovenPrimeraVezInput"] == '1845-01-01' && ($edad >=10 && $edad < 30))
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ConsultaJovenPrimeraVezInput"]);
		}

	//fwrite($txt,$reg[$i]["ConsultaJovenPrimeraVezInput"]); // 72. Consulta de Joven Primera Vez
	fwrite($txt,"|");
		if ($edad < 45) 
		{
			fwrite($txt,'1845-01-01'); 
		} 
		else if ($edad >= 45 && $reg[$i]["ConsultaAdultoPrimeraVezInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		} 
		else
		{
			fwrite($txt,$reg[$i]["ConsultaAdultoPrimeraVezInput"]);
		}
		
	//fwrite($txt,$reg[$i]["ConsultaAdultoPrimeraVezInput"]); // 73. Consulta de Adulto Primera Vez
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["PreservativosITSInput"]); // 74. Preservativos Entregados a Pacientes con ITS
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
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["AsesoriaPostElisaInput"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["AsesoriaPostElisaInput"]); 
		}
	//fwrite($txt,$reg[$i]["AsesoriaPostElisaInput"]); // 76. 
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["PacienteEnfermedadMental"]); // 77. Paciente con Diagnóstico de: Ansiedad, Depresión, Esquizofrenia, déficit de atención, consumo SPA y Bipolaridad recibió Atención en los últimos 6 meses por Equipo Interdisciplinario Completo
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M' || $edad < 10 )
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["Sexo"] == 'F' && $edad > 10 && $reg[$i]["FechaAntigenoHepatitisBGestantesInput"] == '1845-01-01' && $reg[$i]["Gestacion"] == '1')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '0' && $reg[$i]["FechaAntigenoHepatitisBGestantesInput"] == '1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '2')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaAntigenoHepatitisBGestantesInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaAntigenoHepatitisBGestantesInput"]); // 78. Fecha Antigeno de Superficie Hepatitis B en Gestantes
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M')
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Sexo"] == 'F' && $reg[$i]["ResultadoAntigenoHepatitisBGestantes"] == '0' && $reg[$i]["Gestacion"] == '1') 
		{
			fwrite($txt,'22');
		}
		else if ($reg[$i]["Gestacion"] == '2')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoAntigenoHepatitisBGestantes"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoAntigenoHepatitisBGestantes"]); // 79. Resultado Antigeno de Superficie Hepatitis B en Gestantes
	fwrite($txt,"|");
		if($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaSerologiaSifilisInput"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaSerologiaSifilisInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaSerologiaSifilisInput"]); // 80. 
	fwrite($txt,"|");
		if($reg[$i]["Gestacion"] == '1' && $reg[$i]["ResultadoSerologiaSifilis"] =='0')
		{
			fwrite($txt,'22');
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
		if($reg[$i]["Gestacion"] == '1' && $reg[$i]["ResultadoElisaVIH"] == '0')
		{
			fwrite($txt,'22');
		}
		else if ($reg[$i]["FechaTomaElisaVIHInput"] == '1800-01-01' || $reg[$i]["FechaTomaElisaVIHInput"] == '0000-00-00' || $reg[$i]["FechaTomaElisaVIHInput"] == '0000-00-80')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoElisaVIH"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoElisaVIH"]); // 83. Resultado ELISA para VIH
	fwrite($txt,"|");
		$DateTHS = date($reg[$i]["FechaTSHNeonatalInput"]);
		$YearTSH = substr($DateTHS, 0, 4);
		// Si Variable 17 es 21 Variable 84 Puede Ser 1800-01-01
		if ($YearTSH > 1900 && $edadDias > 2)
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTSHNeonatalInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTSHNeonatalInput"]); // 84. Fecha TSH Neonatal
	fwrite($txt,"|");
		if (($YearTSH > 1900 && $edadDias > 2) || $reg[$i]["FechaTSHNeonatalInput"] == '1845-01-01')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoTSHNeonatal"]); 
		}
	//fwrite($txt,$reg[$i]["ResultadoTSHNeonatal"]); // 85. Resultado de TSH Neonatal
	fwrite($txt,"|");
		$DateCitologia = date($reg[$i]["FechaCitologiaCUInput"]); // Fecha Variable 87. Fecha Citologia Cervicouterina
		$YearCitologia = substr($DateCitologia, 0, 4);
		if ($reg[$i]["Sexo"] == 'F' && $edad < 10) 
		{
			fwrite($txt,'0');
		}
		else if ($YearCitologia > 1900 && $reg[$i]["TamizajeCancerCU"] == '22')
		{
			fwrite($txt,'1');
		}
		else if ($reg[$i]["Sexo"] == 'F' && $edad > 10 && $reg[$i]["TamizajeCancerCU"] == '0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["TamizajeCancerCU"]);
		}
		
	//fwrite($txt,$reg[$i]["TamizajeCancerCU"]); // 86. Tamizaje Cancer de Cuello Uterino
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
			fwrite($txt,'999');
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
		if ($reg[$i]["Sexo"] == 'M')
		{
			fwrite($txt,'0');
		}
		else if ($edad > 10 && $reg[$i]["Sexo"] == 'F' && $reg[$i]["CalidadMuestraCitologia"] == '0')
		{
			fwrite($txt,'999');
		}
		else
		{
			fwrite($txt,$reg[$i]["CalidadMuestraCitologia"]);
		}
	//fwrite($txt,$reg[$i]["CalidadMuestraCitologia"]); // 89. Calidad en la Muestra de Citologia Cervicouterina
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M')
		{
			fwrite($txt,'0');
		}
		else if (($reg[$i]["Sexo"] == 'F' && $edad > 10 && $reg[$i]["CitologiaCUResultados"] == '0' ) || ($reg[$i]["CitologiaCUResultados"] != '999' || $reg[$i]["CitologiaCUResultados"] != '0' || $reg[$i]["CitologiaCUResultados"] < 19)) // Condicion Pregunta 88- Convierte el 0 en 999
		{
			if ($reg[$i]["CalidadMuestraCitologia"] == '0' && $reg[$i]["Sexo"] == 'F' &&  $edad < 10 )
			{
				fwrite($txt,'0');
			}
			else
			{
				fwrite($txt,'999');
			}
		}
		else if ($reg[$i]["CalidadMuestraCitologia"] == '0')
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["CitologiaCUResultados"] == '0' && $reg[$i]["CodigoHabilitacionIPSTomaMuestra"] == '0')
		{
			fwrite($txt,'999');
		}
		else
		{
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
		if ($reg[$i]["Sexo"]=='M' || $edad < 10)
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 10 && $reg[$i]["Sexo"]=='F' && $reg[$i]["CodigoHabilitacionTomaColposcopia"]=='0')
		{
			if ($reg[$i]["FechaColposcopiaInput"] == '1845-01-01')
			{
				fwrite($txt,'0');
			}
			else if ($reg[$i]["FechaColposcopiaInput"] == '1835-01-01')
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
	fwrite($txt,$reg[$i]["CodigoHabilitacionTomaBiopsia"]); // 95. Codigo de Habilitacion IPS donde se toma la Biopsia Cervical
	fwrite($txt,"|");
		if ($edadDias >= 12783 && $reg[$i]["Sexo"] == 'F' && $reg[$i]["FechaMamografiaInput"] == '1845-01-01') // 12783 Equivale a 35 Años
		{
			fwrite($txt,'1800-01-01');
		}
		else if($edadDias < 12783 && $reg[$i]["Sexo"] == 'F')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaMamografiaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaMamografiaInput"]); // 96. Fecha Mamografia
	fwrite($txt,"|");
		if ($edadDias < 12783 && $reg[$i]["Sexo"] == 'F')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoMamografia"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoMamografia"]); // 97. Resultado Mamografia
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M' || $edadDias < 12783) //12783 Equivale a 35 Años
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Sexo"] == 'F'  && $edadDias >= 12783 && $reg[$i]["CodigoHabilitacionTomaMamografia"] == '0')
		{
			fwrite($txt,'999');
		}
		else
		{
			fwrite($txt,$reg[$i]["CodigoHabilitacionTomaMamografia"]);
		}
	//fwrite($txt,$reg[$i]["CodigoHabilitacionTomaMamografia"]); // 98. Codigo de Habilitacion donde se Toma la Mamografia
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaBiopsiaSenoInput"]); // 99. Fecha Toma Biopsia Seno por BACAF
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["FechaResultadoBiopsiaSeno"]);
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M' || $edad < 10)
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Sexo"] == 'F' && $edad >= 10 && $reg[$i]["ResultadoBiopsiaSeno"] == '0')
		{
			if ($reg[$i]["FechaBiopsiaSenoInput"] == '1845-01-01')
			{
				fwrite($txt,'0');
			}
			else
			{
				fwrite($txt,'999');
			}
		}
		else if ($reg[$i]["FechaBiopsiaSenoInput"] == '1845-01-01')
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoBiopsiaSeno"]);	
		}
	//fwrite($txt,$reg[$i]["ResultadoBiopsiaSeno"]); // 101. Resultado Biopsia Seno por BACAF
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CodigoHabilitacionBiopsiaSeno"]);
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaTomaHemoglobinaInput"])
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Sexo"] == 'F' && ($edad >= 10 && $edad <= 13))
		{
			fwrite($txt,'1800-01-01');
		}	
		else
		{
			fwrite($txt,$reg[$i]["FechaTomaHemoglobinaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTomaHemoglobinaInput"]); // 103. Fecha Toma de Hemoglobina
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
		$DateBaciloscopia = date($reg[$i]["FechaTomaBaciloscopiaInput"]); // Fecha Variable 112. Fecha Toma de Baciloscopia de Diagnóstico
		$YearBaciloscopia = substr($DateBaciloscopia, 0, 4);
	fwrite($txt,$reg[$i]["FechaTomaBaciloscopiaInput"]); // 112. Fecha Toma de Baciloscopia de Diagnóstico
	fwrite($txt,"|");
		if ($reg[$i]["FechaTomaBaciloscopiaInput"] == '1845-01-01') 
		{
			fwrite($txt,'4');
		} 
		else if ($YearBaciloscopia > 1900 && $reg[$i]["ResultadoBaciloscopia"])
		{
			fwrite($txt,'1');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoBaciloscopia"]);
		}
			
	//fwrite($txt,$reg[$i]["ResultadoBaciloscopia"]); // 113. Resultado de Baciloscopia de Diagnóstico
	fwrite($txt,"|");
		// Si es diferente de no aplica, la variable 17 es igual a 1
		// Si Tiene Tratamiento Contra Hipotiroidismo Congenito (Variable 114 Diferente de 0) Debe Tener Hipotiroidismo (Variable 17 = 1)
		if ($edad >= 3 || $reg[$i]["HipotiroidismoCongenito"] == '0' || $reg[$i]["HipotiroidismoCongenito"] == '21')
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
		if ($reg[$i]["FechaTerLeishmaniasisInput"] == '1845-01-00' || $reg[$i]["FechaTerLeishmaniasisInput"] == '1845-01-0')
		{
			fwrite($txt,'1845-01-01'.PHP_EOL);
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTerLeishmaniasisInput"]."\r\n");
		}
}

fclose($txt);
header("Content-disposition: attachment; filename=$nombreArchivo");
header("Content-type: application/octet-stream");

readfile($nombreArchivo);
include("module.VaciarDirectorio.php");
?>

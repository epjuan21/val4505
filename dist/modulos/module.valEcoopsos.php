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
	//fwrite($txt,$reg[$i]["ConsecutivoRegistro"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["CodigoHabilitacionIPS"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["TipoIdUsuario"]);
	fwrite($txt,"|");
	fwrite($txt,$reg[$i]["NumeroIdUsuario"]);
	fwrite($txt,"|");
	fwrite($txt,trim($reg[$i]["Apellido1"]));		// 5. Apellido1
	fwrite($txt,"|");
	fwrite($txt,trim($reg[$i]["Apellido2"]));	// 6. Apellido2
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
		if ($reg[$i]["CodigoOcupacion"] = '429' || $reg[$i]["CodigoOcupacion"] = '490' || $reg[$i]["CodigoOcupacion"] = '611' || $reg[$i]["CodigoOcupacion"] = '996' || $reg[$i]["CodigoOcupacion"] = '997')
		{
			fwrite($txt,'9999');
		}
		else
		{
			fwrite($txt,$reg[$i]["CodigoOcupacion"]);
		}
	//fwrite($txt,'9999'); // 12. Código de ocupación
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
	//fwrite($txt,$reg[$i]["Gestacion"]); // 14. <Gestacion></Gestacion>
	fwrite($txt,"|");
		// La opción 0 se usa: 
		// Cuando corresponde a un hombre que no es RN (<28 días de nacido)  
		// Cuando la variable 14 registra 0, 2 o  21 
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2' || $reg[$i]["Gestacion"] == '0' || $reg[$i]["Gestacion"]=='21')
		{
			if ($edadDias < 90)
			{
				fwrite($txt,'21');
			}
			else
			{
				fwrite($txt,'0');
			}			
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
		if ($edad <= 10  && $reg[$i]["HipertensionInducidaGestacion"]!='0')
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
		if ($edad >= 10 && $edad <= 60 && $reg[$i]["SifilisGestacional"] == '0') // Condicion Pregunta 15 que Pone 21
		{
			fwrite($txt,'21'); 
		} 
		else if ($reg[$i]["Gestacion"]=='0' && $reg[$i]["InfeccionTrasmisionSexual"] == '2')
		{
			fwrite($txt,'21'); 
		}
		else
		{
			fwrite($txt,$reg[$i]["InfeccionTrasmisionSexual"]);
		}
	//fwrite($txt,$reg[$i]["InfeccionTrasmisionSexual"]); // 24. Infecciones de Trasmisión Sexual
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
	fwrite($txt,$reg[$i]["FechaPeso"]);
	fwrite($txt,"|");
		$VarPeso = $reg[$i]["PesoKilogramos"] ;
		if ($reg[$i]["PesoKilogramos"] > 1000)
		{
			$peso = $VarPeso * 0.001;
			fwrite($txt,$peso);
		} 
		else if ($reg[$i]["FechaPeso"] == '1800-01-01')
		{
			fwrite($txt,'999');
		}
		else if ($VarPeso > 250)
		{
			$peso = substr($VarPeso, 0, 2);
			fwrite($txt,$peso);
		}
		else
		{
			fwrite($txt,$reg[$i]["PesoKilogramos"]);
		}
	//fwrite($txt,$reg[$i]["PesoKilogramos"]); // 30. Peso en Kilogramos
	fwrite($txt,"|");
		$DateTalla = date($reg[$i]["FechaTalla"]);
		$YearTalla = substr($DateTalla, 0, 4);
	fwrite($txt,$reg[$i]["FechaTalla"]); // 31. Fecha Talla
	fwrite($txt,"|");

		if ($reg[$i]["TallaCentimetros"] > 225 && $reg[$i]["TallaCentimetros"]!='999')
		{
			$talla = $reg[$i]["TallaCentimetros"] / 10;
			fwrite($txt,$talla);
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
		} else {
			fwrite($txt,$reg[$i]["FechaProbableParto"]);
		}
	//fwrite($txt,$reg[$i]["FechaProbableParto"]); // 33. Fecha Probable Parto
	fwrite($txt,"|");
		if (($edad < 6 && $reg[$i]["EdadGestacional"]!='0') || ($edad >= 6 && $reg[$i]["EdadGestacional"] == '999'))
		{
			fwrite($txt,'0');
		}
		else
		{
			fwrite($txt,$reg[$i]["EdadGestacional"]);
		}
	//fwrite($txt,$reg[$i]["EdadGestacional"]); // 34. Edad Gestacion al Nacer
	fwrite($txt,"|");
		// Validar que cuando la variable 35 registre un valor diferente a  0 el cálculo de la edad* sea < 6 años
		// Validar que en < 6 años de edad variable 35 sea diferente a 0 No aplica 
		// Validar que en >= 6 años de edad variable 35 sea 0 No aplica
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["BCG"]=='0') 
		{
			fwrite($txt,'22');
		} 
		else {
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
		// Validar que cuando la variable 37 registre un valor diferente a 0 el cálculo de la edad* sea < 6 años
		// Validar que en >= 6 años de edad variable 37 sea 0 No aplica 
		// Validar que en < 6 años de edad variable 37 sea diferente a 0 No aplica 
		// Validar que si: 
		// Edad en meses < 4 variable 37 diferente a 0, 2, 3 
		// Edad en meses < 6 variable 37 diferente a 0, 3 

		// La opción 0 se usa En mayor o igual de 6 años de edad.
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["Pentavalente"]=='0') 
		{
			fwrite($txt,'22');
		} 
		else {
			fwrite($txt,$reg[$i]["Pentavalente"]);
		}
	// fwrite($txt,$reg[$i]["Pentavalente"]); // 37. Pentavalente
	fwrite($txt,"|");
		// Validar que cuando la variable 38 registre un valor diferente a  0 el cálculo de la edad* sea < 6 años
		// Validar que en >= 6 años de edad variable 38 sea 0 No aplica 
		// Validar que en < 6 años de edad variable 38 sea diferente a 0 No aplica
		if ($edad >= 6)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 6 && $reg[$i]["Polio"]=='0') 
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["Polio"]);
		}
	// fwrite($txt,$reg[$i]["Polio"]); // 38. Polio
	fwrite($txt,"|");
		// 540 Dias Equivalen a 18 Meses
		// 1800 Dias Equivalen a 60 Meses
		// Si es menor a 18 meses debe registrar no aplica en la variable 39
		if ($edadDias < 548 || $edad >= 6)
		{
			fwrite($txt,'0');
		}
		else if (($edadDias >= 548 && $edad < 6) && $reg[$i]["DPT"] == 0)
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
		// Validar que cuando la variable 41 registre un valor diferente a 0 el cálculo de la edad* sea < 6 años
		// Validar que en >= 6 años de edad variable 41 sea 0 No aplica
		// Validar que en < 6 años de edad variable 41 sea diferente a 0 No aplica 
		// Validar que si: 
		// Edad en meses < 4 variable 41 diferente a 0, 2, 3 
		// Edad en meses < 6 variable 41 diferente a 0, 3 

		// La opción 0 se usa En mayor o igual de 6 años de edad
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
		} else {
			fwrite($txt,$reg[$i]["InfluenzaN"]);
		}
	//fwrite($txt,$reg[$i]["InfluenzaN"]); // 42. Influenza Niños
	fwrite($txt,"|");
		// Validar que cuando la variable 43 registre un valor diferente a  0 el cálculo de la edad* sea < 6 años
		// Validar que en >= 6 años de edad variable 43 sea 0 No aplica 
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
		// Validar que cuando la variable 44 registre un valor diferente a  0 el cálculo de la edad* sea < 6 años
		// Validar que en >= 6 años de edad variable 44 sea 0 No aplica
		if ($edad >= 6 || $edad < 1)
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
		// Validar que cuando la variable 45 registre un valor diferente a  0 el cálculo de la edad* sea < 6 años
		// Validar que en >= 6 años de edad variable 45 sea 0 No aplica 
		// Validar que en < 6 años de edad variable 44 sea diferente a 0 No 
		if ($edad >= 6 || $edad < 1)
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
		if ($edad < 9 && ($reg[$i]["Sexo"] == 'M' || $reg[$i]["Sexo"] == 'F' )) 
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 9 && $reg[$i]["Sexo"] == 'F')
		{
			fwrite($txt,'0');
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
		} else if ($edad > 2 && $reg[$i]["ControlPlacaBacteriana"]=='0')
		{
			fwrite($txt,'22');
		} else {
			fwrite($txt,$reg[$i]["ControlPlacaBacteriana"]);
		}
	//fwrite($txt,$reg[$i]["ControlPlacaBacteriana"]); // 48. Control de Placa Bacteriana
	fwrite($txt,"|");
		// Validar que cuando la variable 49 registre un dato diferente a 1845-01-01 la variable 10 corresponda a F
		// Validar que cuando la variable 49 registre un dato diferente a 1845-01-01 la variable 14 corresponda a 1

		// Validar que cuando la variable 49 registre un dato diferente a 1845-01-01 la variable 14 corresponda a 2
		if ($reg[$i]["Gestacion"]=='0' || $reg[$i]["Gestacion"]=='21')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($reg[$i]["Gestacion"]=='2' && $reg[$i]["FechaAtencionParto"]=='1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		} 
		else if ($reg[$i]["Gestacion"]=='1')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaAtencionParto"]);
		}
	//fwrite($txt,$reg[$i]["FechaAtencionParto"]); // 49. Fecha Atencion Parto o Cesarea
	// SEGUN Secretaria Seccional de Salud cuando registre un dato diferente a 1845-01-01 no debe ser gestante. 2
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"]=='0' || $reg[$i]["Gestacion"]=='21')
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
		// Validar que cuando la variable 54 registre un valor diferente a 0, 
		// la variable 55  corresponda a un dato diferente a 1845-01-01

		// Validar que cuando la variable 54 registre un dato diferente a 0 
		// la variable 9 corresponda a >= 10 años y < 60 años

		// Validar que cuando variable 9 registre menor de < 10 años y >= 60 años, variable 54 registre 0 
		if ($edad < 10 || $edad >= 60) 
		{	
			fwrite($txt,'0');
		} 
		else if ($edad >= 10 && $edad < 60 && $reg[$i]["SuministroMetodoAnticonceptivo"] == '0')
		{
			fwrite($txt,'21');
		}
		else
		{
			fwrite($txt,$reg[$i]["SuministroMetodoAnticonceptivo"]);
		}
	//fwrite($txt,$reg[$i]["SuministroMetodoAnticonceptivo"]); // 54. Suministro de Método Anticonceptivo
	fwrite($txt,"|");
		// Validar que cuando variable 55 registre un dato diferente a 1845-01-01, variable 54 registre un valor diferente a 0
		// Validar que cuando variable 9 registre <10 años y >60 años, variable 53 registre 1845-01-01
		if ($edad < 10 || $edad >= 60) 
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($edad >= 10 && $edad < 60 && $reg[$i]["FechaSuministroMetodoAnticonceptivo"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaSuministroMetodoAnticonceptivo"]);
		}
	//fwrite($txt,$reg[$i]["FechaSuministroMetodoAnticonceptivo"]); //55. Fecha Suministro Metodo Anticonceptivo
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($reg[$i]["Gestacion"]=='1')
		{
			fwrite($txt,'1800-01-01');
		}
		else 
		{
			fwrite($txt,$reg[$i]["ControlPrenatalPrimeraVezInput"]);
		}
	//fwrite($txt,$reg[$i]["ControlPrenatalPrimeraVezInput"]); // 56. Control Prenatal de Primera Vez
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2' || $reg[$i]["Gestacion"]=='0' || $reg[$i]["Gestacion"]=='21' )
		{
			fwrite($txt,'0');
		} 
		else if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["ControlPrenatal"]=='0')
		{
			fwrite($txt,'999');
		} else {
			fwrite($txt,$reg[$i]["ControlPrenatal"]);
		}
	//fwrite($txt,$reg[$i]["ControlPrenatal"]); // 57. Control Prenatal
	fwrite($txt,"|");
	$DateUltimoControlPrenatal = date($reg[$i]["UltimoControlPrenatal"]); // Fecha Variable 87. Fecha Citologia Cervicouterina
	$YearUltimoControlPrenatal = substr($DateUltimoControlPrenatal, 0, 4);
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"] == '2' || ( $reg[$i]["Gestacion"] == '2' && $YearUltimoControlPrenatal > 1900))
		{
			fwrite($txt,"1845-01-01");
		} 
		else if ($reg[$i]["Gestacion"] == '0' && $reg[$i]["UltimoControlPrenatal"] == '1800-01-01')
		{
			fwrite($txt,"1800-01-01");
		}
		else
		{
			fwrite($txt,$reg[$i]["UltimoControlPrenatal"]);
		}
	//fwrite($txt,$reg[$i]["UltimoControlPrenatal"]); // 58. Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='F' && $reg[$i]["Gestacion"] == '1' && ($edad >= 10 && $edad < 60) && $reg[$i]["SuministroAcidoFolico"] == '0')
		{
			fwrite($txt,'21');
		}
		else if ($reg[$i]["Gestacion"] == '2')
		{
			fwrite($txt,'0');
		}
		else 
		{
			fwrite($txt,$reg[$i]["SuministroAcidoFolico"]);
		}
	//fwrite($txt,$reg[$i]["SuministroAcidoFolico"]); // 59. Suministro de Acido Folico en el Ultimo Control Prenatal
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"]=='2')
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
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["Gestacion"] == '2')
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
		else if ($edad == 5 && $reg[$i]["ValoracionAgudezaVisualInput"] == '1800-01-01')
		{
			fwrite($txt,'1845-01-01');
		}
		else	
		{
			fwrite($txt,$reg[$i]["ValoracionAgudezaVisualInput"]);
		}
	//fwrite($txt,$reg[$i]["ValoracionAgudezaVisualInput"]); //62. Valoración de la Agudeza Visual
	fwrite($txt,"|");
		if ($edad >= 55 && ($reg[$i]["ConsultaOftalmologiaInput"] == '1800-01-01' || $reg[$i]["ConsultaOftalmologiaInput"] == '1845-01-01'))
		{
			if ($edad == 55 || $edad == 60 || $edad == 65 || $edad == 70 || $edad == 75 || $edad == 80 || $edad == 85 || $edad == 90)
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
		if ($edad >= 10 && $reg[$i]["ConsultaCyDPrimeraVezInput"] == '1800-01-01')
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
		// Validar que cuando la variable 70 registre un valor diferente a 0 el cálculo de la edad* debe ser menor a 10 años.

		// Validar que cuando variable 9 registre >= 10 años variable 70 registre 0
		if ($edad >= 10)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 10 && $reg[$i]["SuministroSulfatoFerrosoMenor"]=='0')
		{
			fwrite($txt,'21');
		} 
		else 
		{
			fwrite($txt,$reg[$i]["SuministroSulfatoFerrosoMenor"]);
		}
	//fwrite($txt,$reg[$i]["SuministroSulfatoFerrosoMenor"]); // 70. Suministro de Sulfato Ferroso en la Ultima Consulta de Menor de 10 Años
	fwrite($txt,"|");
		if ($edad >= 10)
		{
			fwrite($txt,'0');
		} 
		else if ($edad < 10 && $reg[$i]["SuministroVitaminaAMenor"] == '0' || $reg[$i]["SuministroVitaminaAMenor"]=='20')
		{
			fwrite($txt,'21');
		} 
		else if ($edad == 9 && $reg[$i]["SuministroVitaminaAMenor"]=='20')
		{
			fwrite($txt,'0');
		}
		else {
			fwrite($txt,$reg[$i]["SuministroVitaminaAMenor"]);
		}
	//fwrite($txt,$reg[$i]["SuministroVitaminaAMenor"]); // 71. Suministro de Vitamina A en la Ultima Consulta de Menor de 10 Años
	fwrite($txt,"|");
		if ($edad < 10 || $edad >= 30) 
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($edad >= 10 && $edad < 30 && ($reg[$i]["ConsultaJovenPrimeraVezInput"] == '1835-01-01' || $reg[$i]["ConsultaJovenPrimeraVezInput"] == '1845-01-01') )
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["ConsultaJovenPrimeraVezInput"]);
		}
	//fwrite($txt,$reg[$i]["ConsultaJovenPrimeraVezInput"]); // 72. Consulta de Joven Primera Vez
	fwrite($txt,"|");
	// Pagina 49: La opción 1845-01-01 se usa: Para población menor de 45 años
		$DateConsultaAdultoPrimeraVezInput = date($reg[$i]["ConsultaAdultoPrimeraVezInput"]); // Fecha Variable 87. Fecha Citologia Cervicouterina
		$YearConsultaAdultoPrimeraVezInput = substr($DateConsultaAdultoPrimeraVezInput, 0, 4);
		if ($edad < 45 || ($edad >= 45 && $edad%5 != 0)) 
		{
			fwrite($txt,'1845-01-01'); 
		} 
		else if ($edad >= 45 && $reg[$i]["ConsultaAdultoPrimeraVezInput"] == '1845-01-01' && fmod($edad,5) == 0)
		{
			fwrite($txt,'1800-01-01');
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
		if($reg[$i]["Gestacion"] == '1' && $reg[$i]["AsesoriaPreElisaInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["AsesoriaPreElisaInput"]);
		}
	//fwrite($txt,$reg[$i]["AsesoriaPreElisaInput"]); // 75. Asesoria Pre Test Elisa para VIH
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["AsesoriaPreElisaInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["AsesoriaPostElisaInput"]);
		}
	//fwrite($txt,$reg[$i]["AsesoriaPostElisaInput"]); // 76. Asesoria Post Test Elisa para VIH
	fwrite($txt,"|");
		if ($reg[$i]["EnfermedadMental"] == '21'&&  $reg[$i]["PacienteEnfermedadMental"] == '1')
		{
			fwrite($txt,"0");
		} else {
			fwrite($txt,$reg[$i]["PacienteEnfermedadMental"]);
		}
	//fwrite($txt,$reg[$i]["PacienteEnfermedadMental"]); // 77. Paciente con Diagnóstico de: Ansiedad, Depresión, Esquizofrenia, déficit de atención, consumo SPA y Bipolaridad recibió Atención en los últimos 6 meses por Equipo Interdisciplinario Completo
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M' || $reg[$i]["Gestacion"] == '2')
		{
			fwrite($txt,'1845-01-01');
		} 
		else if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaAntigenoHepatitisBGestantesInput"] == '1845-01-01')
		{
			fwrite($txt,'1800-01-01');
		} 
		else 
		{
			fwrite($txt,$reg[$i]["FechaAntigenoHepatitisBGestantesInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaAntigenoHepatitisBGestantesInput"]); // 78. Fecha Antigeno de Superficie Hepatitis B en Gestantes
	fwrite($txt,"|");
		if ($reg[$i]["Sexo"] == 'M' || $reg[$i]["Gestacion"] == '2')
		{
			fwrite($txt,'0');
		}
		else if ($reg[$i]["Sexo"] == 'F' && $reg[$i]["ResultadoAntigenoHepatitisBGestantes"] == '0' && $reg[$i]["Gestacion"] == '1') 
		{
			fwrite($txt,'22');
		}
		else
		{
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
		else
		{
			fwrite($txt,$reg[$i]["ResultadoSerologiaSifilis"]); 
		}
	//fwrite($txt,$reg[$i]["ResultadoSerologiaSifilis"]); // 81. Resultado Serología Para Sífilis
	fwrite($txt,"|");
		if (($reg[$i]["FechaTomaElisaVIHInput"] == '0000-00-00' || $reg[$i]["FechaTomaElisaVIHInput"] == '0000-00-80') && $reg[$i]["Gestacion"] == '1')
		{
			fwrite($txt,'1800-01-01');
		}
		else if ($reg[$i]["Gestacion"] == '21' || $reg[$i]["Gestacion"] == '2' || $reg[$i]["Gestacion"] == '0')
		{
			fwrite($txt,'1845-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTomaElisaVIHInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTomaElisaVIHInput"]); // 82. Fecha de Toma de Elisa para VIH
	fwrite($txt,"|");
		if ($reg[$i]["Gestacion"] == '1' && $reg[$i]["ResultadoElisaVIH"] == '0')
		{
			fwrite($txt,'22');
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoElisaVIH"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoElisaVIH"]); // 83. Resultado ELISA par VIH
	fwrite($txt,"|");
	$DateTSHNeonatal = date($reg[$i]["FechaTSHNeonatalInput"]);
	$YearTSHNeonatal = substr($DateTSHNeonatal, 0, 4);
	
	//Calcular Edad Desde Nacimiento Hasta TSH
	$DiasTSH = calcularEdadenDias ($reg[$i]["FechaNacimiento"], $reg[$i]["FechaTSHNeonatalInput"]);
	
		if ($DiasTSH < 2)
		{
			fwrite($txt,'1845-01-01');		
		} 
		else if ($DiasTSH >= 2 && $YearTSHNeonatal > 1900)
		{
			fwrite($txt,'1845-01-01');
		}
		else	
		{
			fwrite($txt,$reg[$i]["FechaTSHNeonatalInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTSHNeonatalInput"]); // 84. Fecha TSH Neonatal
	fwrite($txt,"|");
	if ($DiasTSH < 2)
	{
		fwrite($txt,'0');
	} 
	else if ($DiasTSH >= 2 && $YearTSHNeonatal > 1900)
	{
		fwrite($txt,'0');
	}
	else if ($YearTSHNeonatal > 1900 && $DiasTSH < 2)
	{
		fwrite($txt,'1');
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
		else if ($edad >= 10 && $reg[$i]["TamizajeCancerCU"] == '0' && $reg[$i]["Sexo"] == 'F')
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
		if ($edad >= 10 && $reg[$i]["FechaCitologiaCUInput"] == '1845-01-01' && $reg[$i]["Sexo"] == 'F')
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
			else if ($reg[$i]["Sexo"] == 'F' && $edad >= 10 && $reg[$i]["CitologiaCUResultados"] == '0')
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
			else if ($reg[$i]["CitologiaCUResultados"] == '17' || $reg[$i]["CitologiaCUResultados"] == '3')
			{
				fwrite($txt,$reg[$i]["CitologiaCUResultados"]);
			}
			else 
			{
				fwrite($txt,$reg[$i]["CitologiaCUResultados"]);
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
		} 
		else if ($edad < 10 && $reg[$i]["CalidadMuestraCitologia"]!='0')
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 10 && $reg[$i]["Sexo"]=='F' && $reg[$i]["CalidadMuestraCitologia"]=='0')
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
		} 
		else if ($edad < 10 && $reg[$i]["CodigoHabilitacionIPSTomaMuestra"]!='0')
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
		if ($reg[$i]["Sexo"] == 'M' || $reg[$i]["CitologiaCUResultados"]=='17')
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
		if ($reg[$i]["Sexo"]=='M' || $reg[$i]["CitologiaCUResultados"]=='17' || $edad < 10)
		{
			fwrite($txt,'0');
		} 
		else if ($edad >= 10 && $reg[$i]["Sexo"]=='F' && $reg[$i]["CodigoHabilitacionTomaBiopsia"]=='0') 
		{
			fwrite($txt,'999');
		} 
		else {
			fwrite($txt,$reg[$i]["CodigoHabilitacionTomaBiopsia"]);
		}
	//fwrite($txt,$reg[$i]["CodigoHabilitacionTomaBiopsia"]); // 95. Codigo de Habilitacion IPS donde se toma la Biopsia Cervical
	fwrite($txt,"|");
		if ($edad > 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'1800-01-01');
		} else if ($edad <= 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'1845-01-01');
		} else {
			fwrite($txt,$reg[$i]["FechaMamografiaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaMamografiaInput"]); // 96. Fecha Mamografia
	fwrite($txt,"|");
		if ($edad > 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'999');
		} else if ($edad <= 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'0');
		} else {
			fwrite($txt,$reg[$i]["ResultadoMamografia"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoMamografia"]); // 97. Resultado Mamografia
	fwrite($txt,"|");
		if ($edad > 35 && $reg[$i]["Sexo"]=='F')
		{
			fwrite($txt,'999');
		} else if ($edad <= 35 && $reg[$i]["Sexo"]=='F')
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
	fwrite($txt,$reg[$i]["ResultadoHemoglobina"]); // 104. Hemoglobina
	fwrite($txt,"|");
		if ((($edad == '45' || $edad == '50' || $edad == '55' || $edad == '60' || $edad == '65' || $edad == '70' || $edad == '75' || $edad == '80' || $edad == '85' || $edad == '90' || $edad == '95' || $edad == '100') || $reg[$i]["FechaTomaGlisemiaInput"] == '1845-01-01') || ($reg[$i]["Gestacion"] == '1' && $reg[$i]["FechaTomaGlisemiaInput"] == '1845-01-01'))
		{
			fwrite($txt,'1800-01-01');
		}
		else
		{
			fwrite($txt,$reg[$i]["FechaTomaGlisemiaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaTomaGlisemiaInput"]); // 105. Fecha de la Toma de Glisemia Basal
	fwrite($txt,"|");
		if ($edad >= 45 && ($reg[$i]["FechaTomaCreatininaInput"] == '1800-01-01' || $reg[$i]["FechaTomaCreatininaInput"] == '1845-01-01'))
		{
			if ($edad == '45' || $edad == '50' || $edad == '55' || $edad == '60' || $edad == '65' || $edad == '70' || $edad == '75' || $edad == '80' || $edad == '85' || $edad == '90' || $edad == '95' || $edad == '100')
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
			fwrite($txt,$reg[$i]["FechaTomaCreatininaInput"]);
		}
	//fwrite($txt,	$reg[$i]["FechaTomaCreatininaInput"]); // 106. Fecha de Creatinina
	fwrite($txt,"|");
		if ($edad >= '45' && ($reg[$i]["ResultadoCreatinina"] == '999' || $reg[$i]["ResultadoCreatinina"] == '0'))
		{	
			if ($edad == '45' || $edad == '50' || $edad == '55' || $edad == '60' || $edad == '65' || $edad == '70' || $edad == '75' || $edad == '80' || $edad == '85' || $edad == '90' || $edad == '95' || $edad == '100')
			{
				fwrite($txt,'999');
			}
			else
			{
				fwrite($txt,'0');
			}
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoCreatinina"]);
		}
	//fwrite($txt,$reg[$i]["ResultadoCreatinina"]); // 107. Creatinina
	fwrite($txt,"|");
		if ($edad >= '45' && ($reg[$i]["FechaHemoglobinaGlicosiladaInput"] == '1800-01-01' || $reg[$i]["FechaHemoglobinaGlicosiladaInput"] == '1845-01-01'))
		{
			if ($edad == '45' || $edad == '50' || $edad == '55' || $edad == '60' || $edad == '65' || $edad == '70' || $edad == '75' || $edad == '80' || $edad == '85' || $edad == '90' || $edad == '95' || $edad == '100')
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
		fwrite($txt,$reg[$i]["FechaHemoglobinaGlicosiladaInput"]);
		}
	//fwrite($txt,$reg[$i]["FechaHemoglobinaGlicosiladaInput"]); // 108. Fecha Hemoglobina Glicosilada
	fwrite($txt,"|");
		if ($edad >= '45' && ($reg[$i]["ResultadoHemoglobinaGlicosilada"] == '999' || $reg[$i]["ResultadoHemoglobinaGlicosilada"] == '0'))
		{
			if ($edad == '45' || $edad == '50' || $edad == '55' || $edad == '60' || $edad == '65' || $edad == '70' || $edad == '75' || $edad == '80' || $edad == '85' || $edad == '90' || $edad == '95' || $edad == '100')
			{	
				fwrite($txt,'999');
			}
			else
			{
				fwrite($txt,'0');
			}	
		}
		else
		{
			fwrite($txt,$reg[$i]["ResultadoHemoglobinaGlicosilada"]); 
		}
	//fwrite($txt,$reg[$i]["ResultadoHemoglobinaGlicosilada"]); // 109. Hemoglobina Glicosilada
	fwrite($txt,"|");
		if ($edad >= 45 && ($reg[$i]["FechaTomaMicroalbuminuriaInput"] == '1800-01-01' || $reg[$i]["FechaTomaMicroalbuminuriaInput"] == '1845-01-01'))
		{			
			if ($edad == '45' || $edad == '50' || $edad == '55' || $edad == '60' || $edad == '65' || $edad == '70' || $edad == '75' || $edad == '80' || $edad == '85' || $edad == '90' || $edad == '95' || $edad == '100')
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
			fwrite($txt,$reg[$i]["FechaTomaMicroalbuminuriaInput"]);	
		}
	//fwrite($txt,$reg[$i]["FechaTomaMicroalbuminuriaInput"]); // 110. Fecha toma de Microalbuminuria
	fwrite($txt,"|");
		if ($edad >= 45 && ($reg[$i]["FechaTomaHDLInput"] == '1800-01-01' || $reg[$i]["FechaTomaHDLInput"] == '1845-01-01'))
		{
			if ($edad == '45' || $edad == '50' || $edad == '55' || $edad == '60' || $edad == '65' || $edad == '70' || $edad == '75' || $edad == '80' || $edad == '85' || $edad == '90' || $edad == '95' || $edad == '100')
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
			fwrite($txt,$reg[$i]["FechaTomaHDLInput"]);	
		}
	//fwrite($txt,$reg[$i]["FechaTomaHDLInput"]); // 111. Fecha Toma de HDL
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
	fwrite($txt,$reg[$i]["FechaTerLeishmaniasisInput"]."\r\n");
}

fclose($txt);
header("Content-disposition: attachment; filename=$nombreArchivo");
header("Content-type: application/octet-stream");

readfile($nombreArchivo);
include("module.VaciarDirectorio.php");
?>

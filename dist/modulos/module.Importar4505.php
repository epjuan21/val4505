<?php
    require_once("../clases/class.Session.php");
    $sesion = new sesion();
    $idUsuario = $sesion->get("idUsuario");

    require_once ("../clases/class.rped.php");
    $ObjRPED = new rped();

	date_default_timezone_set('America/Bogota');

	// Definimos la Carpeta de Destino
	$carpetaDestino = "../Uploads/";

	// Si la Carpeta No Existe La Creamos
	if (!file_exists($carpetaDestino))
	{
		mkdir($carpetaDestino);
	}

	// Verificamos Que No Haya Errores
	if ($_FILES['upload']["error"] > 0)
	{
		// Si el Codigo del Error es 4 Significa
		// Error: 4 = UPLOAD_ERR_NO_FILE  = Valor: 4; No se subió ningún fichero.
		if ($_FILES['upload']['error'] == 4)
		{
	    	header ("Location: ../inicio.php?menu=6&Estado=4");
	    	die();
		}

	}

	// Obtenemos el Tipo de Archivo Cargado

	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$fileContents = file_get_contents($_FILES['upload']['tmp_name']);
	$mimeType = $finfo->buffer($fileContents);

	// Si el Arcihvo Cargado es Diferente de text/plain o archivo de texto plano genera error y no continua con el codigo

	if ($mimeType != 'text/plain') 
	{
		header ("Location: ../inicio.php?menu=6&Estado=5");
    	die();
	}

	// Si El Archivo Existe Redirigir y Mostrar Error
	else if (file_exists($carpetaDestino . $_FILES['upload']['name']))
	{
    	header ("Location: ../inicio.php?menu=6&Estado=Warning");
    	die();
	}
	else 
	{

		// Movemos el Archivo Subido a la Carpeta Uploads del Servidor	
		move_uploaded_file($_FILES['upload']['tmp_name'],$carpetaDestino.$_FILES['upload']['name']);

		// Asignamos la ruta completa del archivo a una Variable
		$archivo = $carpetaDestino.$_FILES['upload']['name'];

		// Abrimos el Archivo Subido en Modo Lectura y lo Asignamos a una Variable
		$fp = fopen($archivo, "r");

		$line = stream_get_line($fp, 1000000, "\n");

		$reg = explode("|", $line);

		if ($reg[0]==1){
			$CodigoEntidad = $reg[1];
			$FechaInicialReg = $reg[2];
			$FechaFinalReg = $reg[3];
		} 

		$now = new DateTime;
		$FechaRegistro = $now->format('Y-m-d H:i:s-U');		// Fecha Registro
		$CodigoMunicipio = $_POST["MunicipioReporte"];		// Codigo Municipio

		// Mientras no Sea el Final del Archivo
		while (!feof($fp))
		{
			$line = stream_get_line($fp, 1000000, "\n");
			$reg = explode("|", $line);

			if ($line)
			{
	
			$CodigoHabilitacionIPS = $reg[2];
			$TipoIdUsuario = $reg[3];
			$NumeroIdUsuario = $reg[4];
			$Apellido1 = $reg[5];
			$Apellido2 = $reg[6];
			$Nombre1 = $reg[7];
			$Nombre2 = $reg[8];
			$FechaNacimiento = $reg[9];
			$Sexo = $reg[10];
			$PertenenciaEtnica = $reg[11];
			$CodigoOcupacion = $reg[12];
			$CodigoNivelEducativo = $reg[13];
			$Gestacion = $reg[14];
			$SifilisGestacional = $reg[15];
			$HipertensionInducidaGestacion = $reg[16];
			$HipotiroidismoCongenito = $reg[17];
			$SintomaticoRespiratorio = $reg[18];
			$Tuberculosis = $reg[19];
			$Lepra = $reg[20];
			$ObesidadDesnutricion = $reg[21];
			$VictimaMaltrato = $reg[22];
			$VictimaViolenciaSexual = $reg[23];
			$InfeccionTrasmisionSexual = $reg[24];
			$EnfermedadMental = $reg[25];
			$CancerCervix = $reg[26];
			$CancerSeno = $reg[27];
			$FluorosisDental = $reg[28];
			$FechaPeso = $reg[29];
			$PesoKilogramos = $reg[30];
			$FechaTalla = $reg[31];
			$TallaCentimetros = $reg[32];
			$FechaProbableParto = $reg[33];
			$EdadGestacional = $reg[34];
			$BCG = $reg[35];
			$HepatitisB = $reg[36];
			$Pentavalente = $reg[37];
			$Polio = $reg[38];
			$DPT = $reg[39];
			$Rotavirus = $reg[40];
			$Neumococo = $reg[41];
			$InfluenzaN = $reg[42];
			$FiebreAmarillaN1 = $reg[43];
			$HepatitisA = $reg[44];
			$TripleViralN = $reg[45];
			$VPH = $reg[46];
			$TdTtMEF = $reg[47];
			$ControlPlacaBacteriana = $reg[48];
			$FechaAtencionParto = $reg[49];
			$FechaSalidaParto = $reg[50];
			$FechaConsejeriaLactanciaInput = $reg[51];
			$ControlRecienNacidoInput = $reg[52];
			$PlanificacionFamiliarPrimeraVezInput = $reg[53];
			$SuministroMetodoAnticonceptivo = $reg[54];
			$FechaSuministroMetodoAnticonceptivo = $reg[55];
			$ControlPrenatalPrimeraVezInput = $reg[56];
			$ControlPrenatal = $reg[57];
			$UltimoControlPrenatal = $reg[58];
			$SuministroAcidoFolico = $reg[59];
			$SuministroSulfatoFerroso = $reg[60];
			$SuministroCarbonatoCalcio = $reg[61];
			$ValoracionAgudezaVisualInput = $reg[62];
			$ConsultaOftalmologiaInput = $reg[63];
			$FechaDiagnosticoDesnutricion = $reg[64];
			$ConsultaMujerMenorVictimaInput = $reg[65];
			$ConsultaVictimaViolenciaSexualInput = $reg[66];
			$ConsultaNutricionInput = $reg[67];
			$ConsultaPsicologiaInput = $reg[68];
			$ConsultaCyDPrimeraVezInput = $reg[69];
			$SuministroSulfatoFerrosoMenor = $reg[70];
			$SuministroVitaminaAMenor = $reg[71];
			$ConsultaJovenPrimeraVezInput = $reg[72];
			$ConsultaAdultoPrimeraVezInput = $reg[73];
			$PreservativosITSInput = $reg[74];
			$AsesoriaPreElisaInput = $reg[75];
			$AsesoriaPostElisaInput = $reg[76];
			$PacienteEnfermedadMental = $reg[77];
			$FechaAntigenoHepatitisBGestantesInput = $reg[78];
			$ResultadoAntigenoHepatitisBGestantes = $reg[79];
			$FechaSerologiaSifilisInput = $reg[80];
			$ResultadoSerologiaSifilis = $reg[81];
			$FechaTomaElisaVIHInput = $reg[82];
			$ResultadoElisaVIH = $reg[83];
			$FechaTSHNeonatalInput = $reg[84];
			$ResultadoTSHNeonatal = $reg[85];
			$TamizajeCancerCU = $reg[86];
			$FechaCitologiaCUInput = $reg[87];
			$CitologiaCUResultados = $reg[88];
			$CalidadMuestraCitologia = $reg[89];
			$CodigoHabilitacionIPSTomaMuestra = $reg[90];
			$FechaColposcopiaInput = $reg[91];
			$CodigoHabilitacionTomaColposcopia = $reg[92];
			$FechaBiopsiaCervicalInput = $reg[93];
			$ResultadoBiopsiaCervical = $reg[94];
			$CodigoHabilitacionTomaBiopsia = $reg[95];
			$FechaMamografiaInput = $reg[96];
			$ResultadoMamografia = $reg[97];
			$CodigoHabilitacionTomaMamografia = $reg[98];
			$FechaBiopsiaSenoInput = $reg[99];
			$FechaResultadoBiopsiaSeno = $reg[100];
			$ResultadoBiopsiaSeno = $reg[101];
			$CodigoHabilitacionBiopsiaSeno = $reg[102];
			$FechaTomaHemoglobinaInput = $reg[103];
			$ResultadoHemoglobina = $reg[104];
			$FechaTomaGlisemiaInput = $reg[105];
			$FechaTomaCreatininaInput = $reg[106];
			$ResultadoCreatinina = $reg[107];
			$FechaHemoglobinaGlicosiladaInput = $reg[108];
			$ResultadoHemoglobinaGlicosilada = $reg[109];
			$FechaTomaMicroalbuminuriaInput = $reg[110];
			$FechaTomaHDLInput = $reg[111];
			$FechaTomaBaciloscopiaInput = $reg[112];
			$ResultadoBaciloscopia = $reg[113];
			$TratamientoHipotiroidismoCongenito = $reg[114];
			$TratamientoSifilisGestacional = $reg[115];
			$TratamientoSifilisCongenita = $reg[116];
			$TratamientoLepra = $reg[117];
			$FechaTerLeishmaniasisInput = $reg[118];

			$ObjRPED->insertRped(
				null
				,$FechaRegistro
				,$idUsuario
				,$CodigoMunicipio
				,$CodigoEntidad
				,$FechaInicialReg
				,$FechaFinalReg
				,$CodigoHabilitacionIPS
				,$TipoIdUsuario
				,$NumeroIdUsuario
				,$Apellido1
				,$Apellido2
				,$Nombre1
				,$Nombre2
				,$FechaNacimiento
				,$Sexo
				,$PertenenciaEtnica
				,$CodigoOcupacion
				,$CodigoNivelEducativo
				,$Gestacion
				,$SifilisGestacional
				,$HipertensionInducidaGestacion
				,$HipotiroidismoCongenito
				,$SintomaticoRespiratorio
				,$Tuberculosis
				,$Lepra
				,$ObesidadDesnutricion
				,$VictimaMaltrato
				,$VictimaViolenciaSexual
				,$InfeccionTrasmisionSexual
				,$EnfermedadMental
				,$CancerCervix
				,$CancerSeno
				,$FluorosisDental
				,$FechaPeso
				,$PesoKilogramos
				,$FechaTalla
				,$TallaCentimetros
				,$FechaProbableParto
				,$EdadGestacional
				,$BCG
				,$HepatitisB
				,$Pentavalente
				,$Polio
				,$DPT
				,$Rotavirus
				,$Neumococo
				,$InfluenzaN
				,$FiebreAmarillaN1
				,$HepatitisA
				,$TripleViralN
				,$VPH
				,$TdTtMEF
				,$ControlPlacaBacteriana
				,$FechaAtencionParto
				,$FechaSalidaParto
				,$FechaConsejeriaLactanciaInput
				,$ControlRecienNacidoInput
				,$PlanificacionFamiliarPrimeraVezInput
				,$SuministroMetodoAnticonceptivo
				,$FechaSuministroMetodoAnticonceptivo
				,$ControlPrenatalPrimeraVezInput
				,$ControlPrenatal
				,$UltimoControlPrenatal
				,$SuministroAcidoFolico
				,$SuministroSulfatoFerroso
				,$SuministroCarbonatoCalcio
				,$ValoracionAgudezaVisualInput
				,$ConsultaOftalmologiaInput
				,$FechaDiagnosticoDesnutricion
				,$ConsultaMujerMenorVictimaInput
				,$ConsultaVictimaViolenciaSexualInput
				,$ConsultaNutricionInput
				,$ConsultaPsicologiaInput
				,$ConsultaCyDPrimeraVezInput
				,$SuministroSulfatoFerrosoMenor
				,$SuministroVitaminaAMenor
				,$ConsultaJovenPrimeraVezInput
				,$ConsultaAdultoPrimeraVezInput
				,$PreservativosITSInput
				,$AsesoriaPreElisaInput
				,$AsesoriaPostElisaInput
				,$PacienteEnfermedadMental
				,$FechaAntigenoHepatitisBGestantesInput
				,$ResultadoAntigenoHepatitisBGestantes
				,$FechaSerologiaSifilisInput
				,$ResultadoSerologiaSifilis
				,$FechaTomaElisaVIHInput
				,$ResultadoElisaVIH
				,$FechaTSHNeonatalInput
				,$ResultadoTSHNeonatal
				,$TamizajeCancerCU
				,$FechaCitologiaCUInput
				,$CitologiaCUResultados
				,$CalidadMuestraCitologia
				,$CodigoHabilitacionIPSTomaMuestra
				,$FechaColposcopiaInput
				,$CodigoHabilitacionTomaColposcopia
				,$FechaBiopsiaCervicalInput
				,$ResultadoBiopsiaCervical
				,$CodigoHabilitacionTomaBiopsia
				,$FechaMamografiaInput
				,$ResultadoMamografia
				,$CodigoHabilitacionTomaMamografia
				,$FechaBiopsiaSenoInput
				,$FechaResultadoBiopsiaSeno
				,$ResultadoBiopsiaSeno
				,$CodigoHabilitacionBiopsiaSeno
				,$FechaTomaHemoglobinaInput
				,$ResultadoHemoglobina
				,$FechaTomaGlisemiaInput
				,$FechaTomaCreatininaInput
				,$ResultadoCreatinina
				,$FechaHemoglobinaGlicosiladaInput
				,$ResultadoHemoglobinaGlicosilada
				,$FechaTomaMicroalbuminuriaInput
				,$FechaTomaHDLInput
				,$FechaTomaBaciloscopiaInput
				,$ResultadoBaciloscopia
				,$TratamientoHipotiroidismoCongenito
				,$TratamientoSifilisGestacional
				,$TratamientoSifilisCongenita
				,$TratamientoLepra
				,$FechaTerLeishmaniasisInput
				);

			}
			
		}
		fclose($fp);
	}

$carpetaDestino = "../Uploads/";
$handle = opendir($carpetaDestino); 

while ($file = readdir($handle))  
	{   
		if (is_file($carpetaDestino.$file)) 
			{ 
				unlink($carpetaDestino.$file); 
			}
	} 

header("Location: ../inicio.php?menu=6");






?>

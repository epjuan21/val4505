<?php
require_once ("class.ConnectionMySQL.php");

class rped extends ConnectionMySQL {


	// Obtiene la Cantidad de Registros por Entidad
	public function getRegByEnt (){

		$this->query = $this->conn->prepare(
			"SELECT COUNT(CodigoEntidad) AS Registros
			,ENTIDAD_NAME AS Entidad
			,CodigoEntidad
			,substr(FechaFinalReg,6,2) AS CodPer
			,substr(FechaFinalReg,1,4) AS Año
			,case substr(FechaFinalReg,6,2)
				WHEN '01' THEN 'Enero'
				WHEN '02' THEN 'Febrero'
				WHEN '03' THEN 'Marzo'
				WHEN '04' THEN 'Abril'
				WHEN '05' THEN 'Mayo'
				WHEN '06' THEN 'Junio'
				WHEN '07' THEN 'Julio'
				WHEN '08' THEN 'Agosto'
				WHEN '09' THEN 'Septiembre'
				WHEN '10' THEN 'Octubre'
				WHEN '11' THEN 'Noviembre'
				WHEN '12' THEN 'Diciembre'
				END AS Periodo
			FROM rped 
			LEFT JOIN entidades ON rped.CodigoEntidad = entidades.ENTIDAD_COD
			GROUP BY CodigoEntidad, FechaFinalReg
			ORDER BY Año DESC, CodPer DESC;");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	// Obtener Detalle Por Periodo - Cabecera del Archivo 4505
	// Según Codigo Entidad, Mes y Año
	public function getDetByPer($Entidad, $Periodo, $Año)
	{
		$this->query = $this->conn->prepare(
			"SELECT COUNT(CodigoEntidad) AS Registros
			,ENTIDAD_NAME AS Entidad
			,CodigoEntidad AS CodEnti
			,substr(FechaFinalReg,1,4) AS Año
			,substr(FechaFinalReg,6,2) AS CodPer
			,case substr(FechaFinalReg,6,2)
				WHEN '01' THEN 'Enero'
				WHEN '02' THEN 'Febrero'
				WHEN '03' THEN 'Marzo'
				WHEN '04' THEN 'Abril'
				WHEN '05' THEN 'Mayo'
				WHEN '06' THEN 'Junio'
				WHEN '07' THEN 'Julio'
				WHEN '08' THEN 'Agosto'
				WHEN '09' THEN 'Septiembre'
				WHEN '10' THEN 'Octubre'
				WHEN '11' THEN 'Noviembre'
				WHEN '12' THEN 'Diciembre'
				END AS Periodo
			FROM rped
			LEFT JOIN entidades
			ON rped.CodigoEntidad = entidades.ENTIDAD_COD
			WHERE CodigoEntidad = '$Entidad'
			AND substr(FechaFinalReg,6,2) = '$Periodo' AND substr(FechaFinalReg,1,4) = '$Año'
			GROUP BY CodigoEntidad;");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	public function getUser($Entidad, $IdUsuario, $Periodo, $Año){
		$this->query = $this->conn->prepare(
			"SELECT
			FechaRegistro
			,IdUsuario
			,CodigoMunicipio
			,CodigoEntidad
			,FechaInicialReg
			,FechaFinalReg
			,CodigoHabilitacionIPS
			,TipoIdUsuario
			,NumeroIdUsuario
			,Apellido1
			,Apellido2
			,Nombre1
			,Nombre2
			,FechaNacimiento
			,Sexo
			,PertenenciaEtnica
			,CodigoOcupacion
			,CodigoNivelEducativo
			,Gestacion
			,SifilisGestacional
			,HipertensionInducidaGestacion
			,HipotiroidismoCongenito
			,SintomaticoRespiratorio
			,Tuberculosis
			,Lepra
			,ObesidadDesnutricion
			,VictimaMaltrato
			,VictimaViolenciaSexual
			,InfeccionTrasmisionSexual
			,EnfermedadMental
			,CancerCervix
			,CancerSeno
			,FluorosisDental
			,FechaPeso
			,PesoKilogramos
			,FechaTalla
			,TallaCentimetros
			,FechaProbableParto
			,EdadGestacional
			,BCG
			,HepatitisB
			,Pentavalente
			,Polio
			,DPT
			,Rotavirus
			,Neumococo
			,InfluenzaN
			,FiebreAmarillaN1
			,HepatitisA
			,TripleViralN
			,VPH
			,TdTtMEF
			,ControlPlacaBacteriana
			,FechaAtencionParto
			,FechaSalidaParto
			,FechaConsejeriaLactanciaInput
			,ControlRecienNacidoInput
			,PlanificacionFamiliarPrimeraVezInput
			,SuministroMetodoAnticonceptivo
			,FechaSuministroMetodoAnticonceptivo
			,ControlPrenatalPrimeraVezInput
			,ControlPrenatal
			,UltimoControlPrenatal
			,SuministroAcidoFolico
			,SuministroSulfatoFerroso
			,SuministroCarbonatoCalcio
			,ValoracionAgudezaVisualInput
			,ConsultaOftalmologiaInput
			,FechaDiagnosticoDesnutricion
			,ConsultaMujerMenorVictimaInput
			,ConsultaVictimaViolenciaSexualInput
			,ConsultaNutricionInput
			,ConsultaPsicologiaInput
			,ConsultaCyDPrimeraVezInput
			,SuministroSulfatoFerrosoMenor
			,SuministroVitaminaAMenor
			,ConsultaJovenPrimeraVezInput
			,ConsultaAdultoPrimeraVezInput
			,PreservativosITSInput
			,AsesoriaPreElisaInput
			,AsesoriaPostElisaInput
			,PacienteEnfermedadMental
			,FechaAntigenoHepatitisBGestantesInput
			,ResultadoAntigenoHepatitisBGestantes
			,FechaSerologiaSifilisInput
			,ResultadoSerologiaSifilis
			,FechaTomaElisaVIHInput
			,ResultadoElisaVIH
			,FechaTSHNeonatalInput
			,ResultadoTSHNeonatal
			,TamizajeCancerCU
			,FechaCitologiaCUInput
			,CitologiaCUResultados
			,CalidadMuestraCitologia
			,CodigoHabilitacionIPSTomaMuestra
			,FechaColposcopiaInput
			,CodigoHabilitacionTomaColposcopia
			,FechaBiopsiaCervicalInput
			,ResultadoBiopsiaCervical
			,CodigoHabilitacionTomaBiopsia
			,FechaMamografiaInput
			,ResultadoMamografia
			,CodigoHabilitacionTomaMamografia
			,FechaBiopsiaSenoInput
			,FechaResultadoBiopsiaSeno
			,ResultadoBiopsiaSeno
			,CodigoHabilitacionBiopsiaSeno
			,FechaTomaHemoglobinaInput
			,ResultadoHemoglobina
			,FechaTomaGlisemiaInput
			,FechaTomaCreatininaInput
			,ResultadoCreatinina
			,FechaHemoglobinaGlicosiladaInput
			,ResultadoHemoglobinaGlicosilada
			,FechaTomaMicroalbuminuriaInput
			,FechaTomaHDLInput
			,FechaTomaBaciloscopiaInput
			,ResultadoBaciloscopia
			,TratamientoHipotiroidismoCongenito
			,TratamientoSifilisGestacional
			,TratamientoSifilisCongenita
			,TratamientoLepra
			,FechaTerLeishmaniasisInput
			,val4505.usuarios.USUARIO_NAME
			,val4505.municipios.MUN_NAME
			,val4505.entidades.ENTIDAD_NAME
			FROM val4505.rped
			LEFT JOIN val4505.usuarios
			ON val4505.usuarios.USUARIO_ID = val4505.rped.IdUsuario
			LEFT JOIN val4505.municipios
			ON val4505.municipios.MUN_ID = val4505.rped.CodigoMunicipio
			LEFT JOIN val4505.entidades
			ON val4505.entidades.ENTIDAD_COD = val4505.rped.CodigoEntidad
			WHERE CodigoEntidad = '$Entidad'
			AND NumeroIdUsuario = '$IdUsuario'
			AND substr(FechaFinalReg,6,2) = '$Periodo'
			AND substr(FechaFinalReg,1,4) = '$Año'
			");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	public function insertRped (
		$ID
		,$FechaRegistro
		,$IdUsuario
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
		){

		$sql="INSERT INTO rped VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$stmt=$this->conn->prepare($sql);		

		$stmt->bindValue(1,$ID,PDO::PARAM_INT);
		$stmt->bindValue(2,$FechaRegistro,PDO::PARAM_STR);
		$stmt->bindValue(3,$IdUsuario,PDO::PARAM_STR);
		$stmt->bindValue(4,$CodigoMunicipio,PDO::PARAM_STR);
		$stmt->bindValue(5,$CodigoEntidad,PDO::PARAM_STR);
		$stmt->bindValue(6,$FechaInicialReg,PDO::PARAM_STR);
		$stmt->bindValue(7,$FechaFinalReg,PDO::PARAM_STR);
		$stmt->bindValue(8,$CodigoHabilitacionIPS,PDO::PARAM_STR);
		$stmt->bindValue(9,$TipoIdUsuario,PDO::PARAM_STR);
		$stmt->bindValue(10,$NumeroIdUsuario,PDO::PARAM_STR);
		$stmt->bindValue(11,$Apellido1,PDO::PARAM_STR);
		$stmt->bindValue(12,$Apellido2,PDO::PARAM_STR);
		$stmt->bindValue(13,$Nombre1,PDO::PARAM_STR);
		$stmt->bindValue(14,$Nombre2,PDO::PARAM_STR);
		$stmt->bindValue(15,$FechaNacimiento,PDO::PARAM_STR);
		$stmt->bindValue(16,$Sexo,PDO::PARAM_STR);
		$stmt->bindValue(17,$PertenenciaEtnica,PDO::PARAM_STR);
		$stmt->bindValue(18,$CodigoOcupacion,PDO::PARAM_STR);
		$stmt->bindValue(19,$CodigoNivelEducativo,PDO::PARAM_STR);
		$stmt->bindValue(20,$Gestacion,PDO::PARAM_STR);
		$stmt->bindValue(21,$SifilisGestacional,PDO::PARAM_STR);
		$stmt->bindValue(22,$HipertensionInducidaGestacion,PDO::PARAM_STR);
		$stmt->bindValue(23,$HipotiroidismoCongenito,PDO::PARAM_STR);
		$stmt->bindValue(24,$SintomaticoRespiratorio,PDO::PARAM_STR);
		$stmt->bindValue(25,$Tuberculosis,PDO::PARAM_STR);
		$stmt->bindValue(26,$Lepra,PDO::PARAM_STR);
		$stmt->bindValue(27,$ObesidadDesnutricion,PDO::PARAM_STR);
		$stmt->bindValue(28,$VictimaMaltrato,PDO::PARAM_STR);
		$stmt->bindValue(29,$VictimaViolenciaSexual,PDO::PARAM_STR);
		$stmt->bindValue(30,$InfeccionTrasmisionSexual,PDO::PARAM_STR);
		$stmt->bindValue(31,$EnfermedadMental,PDO::PARAM_STR);
		$stmt->bindValue(32,$CancerCervix,PDO::PARAM_STR);
		$stmt->bindValue(33,$CancerSeno,PDO::PARAM_STR);
		$stmt->bindValue(34,$FluorosisDental,PDO::PARAM_STR);
		$stmt->bindValue(35,$FechaPeso,PDO::PARAM_STR);
		$stmt->bindValue(36,$PesoKilogramos,PDO::PARAM_STR);
		$stmt->bindValue(37,$FechaTalla,PDO::PARAM_STR);
		$stmt->bindValue(38,$TallaCentimetros,PDO::PARAM_STR);
		$stmt->bindValue(39,$FechaProbableParto,PDO::PARAM_STR);
		$stmt->bindValue(40,$EdadGestacional,PDO::PARAM_STR);
		$stmt->bindValue(41,$BCG,PDO::PARAM_STR);
		$stmt->bindValue(42,$HepatitisB,PDO::PARAM_STR);
		$stmt->bindValue(43,$Pentavalente,PDO::PARAM_STR);
		$stmt->bindValue(44,$Polio,PDO::PARAM_STR);
		$stmt->bindValue(45,$DPT,PDO::PARAM_STR);
		$stmt->bindValue(46,$Rotavirus,PDO::PARAM_STR);
		$stmt->bindValue(47,$Neumococo,PDO::PARAM_STR);
		$stmt->bindValue(48,$InfluenzaN,PDO::PARAM_STR);
		$stmt->bindValue(49,$FiebreAmarillaN1,PDO::PARAM_STR);
		$stmt->bindValue(50,$HepatitisA,PDO::PARAM_STR);
		$stmt->bindValue(51,$TripleViralN,PDO::PARAM_STR);
		$stmt->bindValue(52,$VPH,PDO::PARAM_STR);
		$stmt->bindValue(53,$TdTtMEF,PDO::PARAM_STR);
		$stmt->bindValue(54,$ControlPlacaBacteriana,PDO::PARAM_STR);
		$stmt->bindValue(55,$FechaAtencionParto,PDO::PARAM_STR);
		$stmt->bindValue(56,$FechaSalidaParto,PDO::PARAM_STR);
		$stmt->bindValue(57,$FechaConsejeriaLactanciaInput,PDO::PARAM_STR);
		$stmt->bindValue(58,$ControlRecienNacidoInput,PDO::PARAM_STR);
		$stmt->bindValue(59,$PlanificacionFamiliarPrimeraVezInput,PDO::PARAM_STR);
		$stmt->bindValue(60,$SuministroMetodoAnticonceptivo,PDO::PARAM_STR);
		$stmt->bindValue(61,$FechaSuministroMetodoAnticonceptivo,PDO::PARAM_STR);
		$stmt->bindValue(62,$ControlPrenatalPrimeraVezInput,PDO::PARAM_STR);
		$stmt->bindValue(63,$ControlPrenatal,PDO::PARAM_STR);
		$stmt->bindValue(64,$UltimoControlPrenatal,PDO::PARAM_STR);
		$stmt->bindValue(65,$SuministroAcidoFolico,PDO::PARAM_STR);
		$stmt->bindValue(66,$SuministroSulfatoFerroso,PDO::PARAM_STR);
		$stmt->bindValue(67,$SuministroCarbonatoCalcio,PDO::PARAM_STR);
		$stmt->bindValue(68,$ValoracionAgudezaVisualInput,PDO::PARAM_STR);
		$stmt->bindValue(69,$ConsultaOftalmologiaInput,PDO::PARAM_STR);
		$stmt->bindValue(70,$FechaDiagnosticoDesnutricion,PDO::PARAM_STR);
		$stmt->bindValue(71,$ConsultaMujerMenorVictimaInput,PDO::PARAM_STR);
		$stmt->bindValue(72,$ConsultaVictimaViolenciaSexualInput,PDO::PARAM_STR);
		$stmt->bindValue(73,$ConsultaNutricionInput,PDO::PARAM_STR);
		$stmt->bindValue(74,$ConsultaPsicologiaInput,PDO::PARAM_STR);
		$stmt->bindValue(75,$ConsultaCyDPrimeraVezInput,PDO::PARAM_STR);
		$stmt->bindValue(76,$SuministroSulfatoFerrosoMenor,PDO::PARAM_STR);
		$stmt->bindValue(77,$SuministroVitaminaAMenor,PDO::PARAM_STR);
		$stmt->bindValue(78,$ConsultaJovenPrimeraVezInput,PDO::PARAM_STR);
		$stmt->bindValue(79,$ConsultaAdultoPrimeraVezInput,PDO::PARAM_STR);
		$stmt->bindValue(80,$PreservativosITSInput,PDO::PARAM_STR);
		$stmt->bindValue(81,$AsesoriaPreElisaInput,PDO::PARAM_STR);
		$stmt->bindValue(82,$AsesoriaPostElisaInput,PDO::PARAM_STR);
		$stmt->bindValue(83,$PacienteEnfermedadMental,PDO::PARAM_STR);
		$stmt->bindValue(84,$FechaAntigenoHepatitisBGestantesInput,PDO::PARAM_STR);
		$stmt->bindValue(85,$ResultadoAntigenoHepatitisBGestantes,PDO::PARAM_STR);
		$stmt->bindValue(86,$FechaSerologiaSifilisInput,PDO::PARAM_STR);
		$stmt->bindValue(87,$ResultadoSerologiaSifilis,PDO::PARAM_STR);
		$stmt->bindValue(88,$FechaTomaElisaVIHInput,PDO::PARAM_STR);
		$stmt->bindValue(89,$ResultadoElisaVIH,PDO::PARAM_STR);
		$stmt->bindValue(90,$FechaTSHNeonatalInput,PDO::PARAM_STR);
		$stmt->bindValue(91,$ResultadoTSHNeonatal,PDO::PARAM_STR);
		$stmt->bindValue(92,$TamizajeCancerCU,PDO::PARAM_STR);
		$stmt->bindValue(93,$FechaCitologiaCUInput,PDO::PARAM_STR);
		$stmt->bindValue(94,$CitologiaCUResultados,PDO::PARAM_STR);
		$stmt->bindValue(95,$CalidadMuestraCitologia,PDO::PARAM_STR);
		$stmt->bindValue(96,$CodigoHabilitacionIPSTomaMuestra,PDO::PARAM_STR);
		$stmt->bindValue(97,$FechaColposcopiaInput,PDO::PARAM_STR);
		$stmt->bindValue(98,$CodigoHabilitacionTomaColposcopia,PDO::PARAM_STR);
		$stmt->bindValue(99,$FechaBiopsiaCervicalInput,PDO::PARAM_STR);
		$stmt->bindValue(100,$ResultadoBiopsiaCervical,PDO::PARAM_STR);
		$stmt->bindValue(101,$CodigoHabilitacionTomaBiopsia,PDO::PARAM_STR);
		$stmt->bindValue(102,$FechaMamografiaInput,PDO::PARAM_STR);
		$stmt->bindValue(103,$ResultadoMamografia,PDO::PARAM_STR);
		$stmt->bindValue(104,$CodigoHabilitacionTomaMamografia,PDO::PARAM_STR);
		$stmt->bindValue(105,$FechaBiopsiaSenoInput,PDO::PARAM_STR);
		$stmt->bindValue(106,$FechaResultadoBiopsiaSeno,PDO::PARAM_STR);
		$stmt->bindValue(107,$ResultadoBiopsiaSeno,PDO::PARAM_STR);
		$stmt->bindValue(108,$CodigoHabilitacionBiopsiaSeno,PDO::PARAM_STR);
		$stmt->bindValue(109,$FechaTomaHemoglobinaInput,PDO::PARAM_STR);
		$stmt->bindValue(110,$ResultadoHemoglobina,PDO::PARAM_STR);
		$stmt->bindValue(111,$FechaTomaGlisemiaInput,PDO::PARAM_STR);
		$stmt->bindValue(112,$FechaTomaCreatininaInput,PDO::PARAM_STR);
		$stmt->bindValue(113,$ResultadoCreatinina,PDO::PARAM_STR);
		$stmt->bindValue(114,$FechaHemoglobinaGlicosiladaInput,PDO::PARAM_STR);
		$stmt->bindValue(115,$ResultadoHemoglobinaGlicosilada,PDO::PARAM_STR);
		$stmt->bindValue(116,$FechaTomaMicroalbuminuriaInput,PDO::PARAM_STR);
		$stmt->bindValue(117,$FechaTomaHDLInput,PDO::PARAM_STR);
		$stmt->bindValue(118,$FechaTomaBaciloscopiaInput,PDO::PARAM_STR);
		$stmt->bindValue(119,$ResultadoBaciloscopia,PDO::PARAM_STR);
		$stmt->bindValue(120,$TratamientoHipotiroidismoCongenito,PDO::PARAM_STR);
		$stmt->bindValue(121,$TratamientoSifilisGestacional,PDO::PARAM_STR);
		$stmt->bindValue(122,$TratamientoSifilisCongenita,PDO::PARAM_STR);
		$stmt->bindValue(123,$TratamientoLepra,PDO::PARAM_STR);
		$stmt->bindValue(124,$FechaTerLeishmaniasisInput,PDO::PARAM_STR);

		$stmt->execute();
		
	}
}

?>



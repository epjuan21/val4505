<?php
require_once ("class.ConnectionMySQL.php");
class rped extends ConnectionMySQL {

	// Obtiene la Cantidad de Registros por Entidad

	public function getRegByEnt (){
		$this->query = $this->conn->prepare(
			"SELECT COUNT(CodigoEntidad) AS Registros
			,entidades.ENTIDAD_NAME AS Entidad
			,IdUsuario
			,CodigoEntidad
			,CodigoMunicipio
			,FechaInicialReg
			,FechaFinalReg
			,FechaRegistro
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
			GROUP BY entidades.ENTIDAD_NAME, IdUsuario, CodigoEntidad, CodigoMunicipio, FechaInicialReg, FechaFinalReg, rped.CodigoEntidad, rped.FechaFinalReg, rped.FechaRegistro
			ORDER BY FechaRegistro DESC;"
			);
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	// Funcion Para Obtener Registros Numerados
	public function gerRegNum($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaFinalReg) {
		$this->query = $this->conn->prepare("
			SELECT
			@rownum:=@rownum+1 AS Linea
			,IdUsuario
			,CodigoMunicipio
			,CodigoEntidad
			,FechaFinalReg
			,NumeroIdUsuario
			FROM rped
			,(SELECT @rownum:=0) r
			WHERE IdUsuario = '$IdUsuario'
			AND CodigoMunicipio = '$CodigoMunicipio'
			AND CodigoEntidad = '$CodigoEntidad'
			AND FechaFinalReg = '$FechaFinalReg'
			");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	// Borra Periodos Seleccionados Por Entidad desde la Pagina de Importar
	
	public function deletePeriod ($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaInicialReg, $FechaFinalReg)
	{
		$this->query = $this->conn->prepare("DELETE FROM rped WHERE IdUsuario = '$IdUsuario' AND CodigoMunicipio = '$CodigoMunicipio' AND CodigoEntidad = '$CodigoEntidad' AND FechaInicialReg = '$FechaInicialReg' AND FechaFinalReg = '$FechaFinalReg' ");
		$this->query->execute();
	}

	// Borrar Registro Por ID | Funcion Usada para Borrar Usuarios en la Pagina page.Editar4505.php
	public function deleteRegistro ($ID)
	{
		$this->query = $this->conn->prepare("DELETE FROM rped WHERE R_ID = '$ID' ");
		$this->query->execute();
	}

	// Borrar Registro Segun Codigo Usuario | Funcion Usada para Borrar Usuarios Segun Errores Importados
	public function deleteRegistroByCodUser ($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaFinalReg, $NumeroIdUsuario)
	{
		$this->query = $this->conn->prepare("DELETE FROM rped WHERE IdUsuario = '$IdUsuario' AND CodigoMunicipio = '$CodigoMunicipio' AND CodigoEntidad = '$CodigoEntidad' AND FechaFinalReg = '$FechaFinalReg' AND NumeroIdUsuario = '$NumeroIdUsuario' ");
		$this->query->execute();
	}

	// Funcion para Actualizar Nombres, Apellidos y Fecha de Nacimeinto Segun Archivo de Errores Importado de ECOOPSOS
	public function updateUser ($Apellido1, $Apellido2, $Nombre1, $Nombre2, $FechaNacimiento, $IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaFinalReg, $NumeroIdUsuario){
		$sql = "UPDATE rped SET 
			Apellido1=?,
			Apellido2=?,
			Nombre1=?,
			Nombre2=?,
			FechaNacimiento=?
			WHERE
			IdUsuario=?
			AND
			CodigoMunicipio=?
			AND
			CodigoEntidad=?
			AND
			FechaFinalReg=?
			AND
			NumeroIdUsuario=?";

		$stmt=$this->conn->prepare($sql);

		$stmt->execute(array($Apellido1, $Apellido2, $Nombre1, $Nombre2, $FechaNacimiento, $IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaFinalReg, $NumeroIdUsuario));
			
	}

	// Funcion para Atualizar Fecha de Nacimiento Segun Archivo de Errores de SAVIASALUD
	public function updateFchNac($FechaNacimiento, $IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaFinalReg, $NumeroIdUsuario){
		$sql = "UPDATE rped SET
			FechaNacimiento=?
			WHERE
			IdUsuario=?
			AND
			CodigoMunicipio=?
			AND
			CodigoEntidad=?
			AND
			FechaFinalReg=?
			AND
			NumeroIdUsuario=?";
		
		$stmt=$this->conn->prepare($sql);
		$stmt->execute(array($FechaNacimiento, $IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaFinalReg, $NumeroIdUsuario));

	}

	// Funcion para Obtener el Numero de Registros
	public function getNumRows ($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaInicialReg, $FechaFinalReg) {
		$this->query = $this->conn->prepare("SELECT COUNT(*) FROM rped WHERE IdUsuario = '$IdUsuario' AND CodigoMunicipio = '$CodigoMunicipio' AND CodigoEntidad = '$CodigoEntidad' AND FechaInicialReg = '$FechaInicialReg' AND FechaFinalReg = '$FechaFinalReg' ");
		$this->query->execute();
		$count = $this->query->fetch(PDO::FETCH_NUM);
		return reset($count);
		//return $numRows = $this->query->rowCount();
	}

	//Obtenemos Registros para el Proceso de Exportacion
	
	public function getRPED($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $FechaInicialReg, $FechaFinalReg) {
		$this->query = $this->conn->prepare("SELECT * FROM rped WHERE IdUsuario = '$IdUsuario' AND CodigoMunicipio = '$CodigoMunicipio' AND CodigoEntidad = '$CodigoEntidad' AND FechaInicialReg = '$FechaInicialReg' AND FechaFinalReg = '$FechaFinalReg'");
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
			GROUP BY CodigoEntidad, ENTIDAD_NAME, FechaFinalReg;");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}
	
	public function getUser($Entidad, $IdUsuario, $Periodo, $Año){
		$this->query = $this->conn->prepare(
			"SELECT
			R_ID
			,FechaRegistro
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
	public function update_RPED () {
		$this->query = $this->conn->prepare
		('UPDATE rped SET
			 CodigoEntidad=?
			,FechaInicialReg=?
			,FechaFinalReg=?
			,TipoIdUsuario=?
			,NumeroIdUsuario=?
			,Apellido1=?
			,Apellido2=?
			,Nombre1=?
			,Nombre2=?
			,FechaNacimiento=?
			,Sexo=?
			,PertenenciaEtnica=?
			,CodigoOcupacion=?
			,CodigoNivelEducativo=?
			,Gestacion=?
			,SifilisGestacional=?
			,HipertensionInducidaGestacion=?
			,HipotiroidismoCongenito=?
			,SintomaticoRespiratorio=?
			,Tuberculosis=?
			,Lepra=?
			,ObesidadDesnutricion=?
			,VictimaMaltrato=?
			,VictimaViolenciaSexual=?
			,InfeccionTrasmisionSexual=?
			,EnfermedadMental=?
			,CancerCervix=?
			,CancerSeno=?
			,FluorosisDental=?
			,FechaPeso=?					-- Estar Pendiente
			,PesoKilogramos=?
			,FechaTalla=?					-- Estar Pendiente
			,TallaCentimetros=?
			,FechaProbableParto=?
			,EdadGestacional=?
			,BCG=?
			,HepatitisB=?
			,Pentavalente=?
			,Polio=?
			,DPT=?
			,Rotavirus=?
			,Neumococo=?
			,InfluenzaN=?
			,FiebreAmarillaN1=?
			,HepatitisA=?
			,TripleViralN=?
			,VPH=?
			,TdTtMEF=?
			,ControlPlacaBacteriana=?
			,FechaAtencionParto=?
			,FechaSalidaParto=?
			,FechaConsejeriaLactanciaInput=?
			,ControlRecienNacidoInput=?
			,PlanificacionFamiliarPrimeraVezInput=?
			,SuministroMetodoAnticonceptivo=?
			,FechaSuministroMetodoAnticonceptivo=?
			,ControlPrenatalPrimeraVezInput=?
			,ControlPrenatal=?
			,UltimoControlPrenatal=?
			,SuministroAcidoFolico=?
			,SuministroSulfatoFerroso=?
			,SuministroCarbonatoCalcio=?
			,ValoracionAgudezaVisualInput=?
			,ConsultaOftalmologiaInput=?
			,FechaDiagnosticoDesnutricion=?
			,ConsultaMujerMenorVictimaInput=?
			,ConsultaVictimaViolenciaSexualInput=?
			,ConsultaNutricionInput=?
			,ConsultaPsicologiaInput=?
			,ConsultaCyDPrimeraVezInput=?
			,SuministroSulfatoFerrosoMenor=?
			,SuministroVitaminaAMenor=?
			,ConsultaJovenPrimeraVezInput=?
			,ConsultaAdultoPrimeraVezInput=?
			,PreservativosITSInput=?
			,AsesoriaPreElisaInput=?
			,AsesoriaPostElisaInput=?
			,PacienteEnfermedadMental=?
			,FechaAntigenoHepatitisBGestantesInput=?
			,ResultadoAntigenoHepatitisBGestantes=?
			,FechaSerologiaSifilisInput=?
			,ResultadoSerologiaSifilis=?
			,FechaTomaElisaVIHInput=?
			,ResultadoElisaVIH=?
			,FechaTSHNeonatalInput=?
			,ResultadoTSHNeonatal=?
			,TamizajeCancerCU=?
			,FechaCitologiaCUInput=?
			,CitologiaCUResultados=?
			,CalidadMuestraCitologia=?
			,CodigoHabilitacionIPSTomaMuestra=?
			,FechaColposcopiaInput=?
			,CodigoHabilitacionTomaColposcopia=?
			,FechaBiopsiaCervicalInput=?
			,ResultadoBiopsiaCervical=?
			,CodigoHabilitacionTomaBiopsia=?
			,FechaMamografiaInput=?
			,ResultadoMamografia=?
			,CodigoHabilitacionTomaMamografia=?
			,FechaBiopsiaSenoInput=?
			,FechaResultadoBiopsiaSeno=?
			,ResultadoBiopsiaSeno=?
			,CodigoHabilitacionBiopsiaSeno=?
			,FechaTomaHemoglobinaInput=?
			,ResultadoHemoglobina=?
			,FechaTomaGlisemiaInput=?
			,FechaTomaCreatininaInput=?
			,ResultadoCreatinina=?
			,FechaHemoglobinaGlicosiladaInput=?
			,ResultadoHemoglobinaGlicosilada=?
			,FechaTomaMicroalbuminuriaInput=?
			,FechaTomaHDLInput=?
			,FechaTomaBaciloscopiaInput=?
			,ResultadoBaciloscopia=?
			,TratamientoHipotiroidismoCongenito=?
			,TratamientoSifilisGestacional=?
			,TratamientoSifilisCongenita=?
			,TratamientoLepra=?
			,FechaTerLeishmaniasisInput=?
			WHERE
			R_ID=?');
		$this->query->bindValue(1,$_POST["CodigoEntidad"], PDO::PARAM_STR);
		$this->query->bindValue(2,$_POST["FechaInicialReg"], PDO::PARAM_STR);
		$this->query->bindValue(3,$_POST["FechaFinalReg"], PDO::PARAM_STR);
		$this->query->bindValue(4,strtoupper($_POST["TipoIdUsuario"]), PDO::PARAM_STR);
		$this->query->bindValue(5,$_POST["NumeroIdUsuario"], PDO::PARAM_STR);
		$this->query->bindValue(6,strtoupper($_POST["Apellido1"]), PDO::PARAM_STR);
		$this->query->bindValue(7,strtoupper($_POST["Apellido2"]),PDO::PARAM_STR);
		$this->query->bindValue(8,strtoupper($_POST["Nombre1"]),PDO::PARAM_STR);
		$this->query->bindValue(9,strtoupper($_POST["Nombre2"]),PDO::PARAM_STR);
		$this->query->bindValue(10,$_POST["FechaNacimiento"],PDO::PARAM_STR);
		$this->query->bindValue(11,$_POST["Sexo"],PDO::PARAM_STR);
		$this->query->bindValue(12,$_POST["PertenenciaEtnica"],PDO::PARAM_STR);
		$this->query->bindValue(13,$_POST["CodigoOcupacion"],PDO::PARAM_STR);
		$this->query->bindValue(14,$_POST["CodigoNivelEducativo"],PDO::PARAM_STR);
		$this->query->bindValue(15,$_POST["Gestacion"],PDO::PARAM_STR);
		$this->query->bindValue(16,$_POST["SifilisGestacional"],PDO::PARAM_STR);
		$this->query->bindValue(17,$_POST["HipertensionInducidaGestacion"],PDO::PARAM_STR);
		$this->query->bindValue(18,$_POST["HipotiroidismoCongenito"],PDO::PARAM_STR);
		$this->query->bindValue(19,$_POST["SintomaticoRespiratorio"],PDO::PARAM_STR);
		$this->query->bindValue(20,$_POST["Tuberculosis"],PDO::PARAM_STR);
		$this->query->bindValue(21,$_POST["Lepra"],PDO::PARAM_STR);
		$this->query->bindValue(22,$_POST["ObesidadDesnutricion"],PDO::PARAM_STR);
		$this->query->bindValue(23,$_POST["VictimaMaltrato"],PDO::PARAM_STR);
		$this->query->bindValue(24,$_POST["VictimaViolenciaSexual"],PDO::PARAM_STR);
		$this->query->bindValue(25,$_POST["InfeccionTrasmisionSexual"],PDO::PARAM_STR);
		$this->query->bindValue(26,$_POST["EnfermedadMental"],PDO::PARAM_STR);
		$this->query->bindValue(27,$_POST["CancerCervix"],PDO::PARAM_STR);
		$this->query->bindValue(28,$_POST["CancerSeno"],PDO::PARAM_STR);
		$this->query->bindValue(29,$_POST["FluorosisDental"],PDO::PARAM_STR);
		$this->query->bindValue(30,$_POST["FechaPeso"],PDO::PARAM_STR); 							// Estar Pendiente
		$this->query->bindValue(31,$_POST["PesoKilogramos"],PDO::PARAM_STR);
		$this->query->bindValue(32,$_POST["FechaTalla"],PDO::PARAM_STR);							// Estar Pendiente
		$this->query->bindValue(33,$_POST["TallaCentimetros"],PDO::PARAM_STR);
		$this->query->bindValue(34,$_POST["FechaProbableParto"],PDO::PARAM_STR);
		$this->query->bindValue(35,$_POST["EdadGestacional"],PDO::PARAM_STR);
		$this->query->bindValue(36,$_POST["BCG"],PDO::PARAM_STR);
		$this->query->bindValue(37,$_POST["HepatitisB"],PDO::PARAM_STR);
		$this->query->bindValue(38,$_POST["Pentavalente"],PDO::PARAM_STR);
		$this->query->bindValue(39,$_POST["Polio"],PDO::PARAM_STR);
		$this->query->bindValue(40,$_POST["DPT"],PDO::PARAM_STR);
		$this->query->bindValue(41,$_POST["Rotavirus"],PDO::PARAM_STR);
		$this->query->bindValue(42,$_POST["Neumococo"],PDO::PARAM_STR);
		$this->query->bindValue(43,$_POST["InfluenzaN"],PDO::PARAM_STR);
		$this->query->bindValue(44,$_POST["FiebreAmarillaN1"],PDO::PARAM_STR);
		$this->query->bindValue(45,$_POST["HepatitisA"],PDO::PARAM_STR);
		$this->query->bindValue(46,$_POST["TripleViralN"],PDO::PARAM_STR);
		$this->query->bindValue(47,$_POST["VPH"],PDO::PARAM_STR);
		$this->query->bindValue(48,$_POST["TdTtMEF"],PDO::PARAM_STR);
		$this->query->bindValue(49,$_POST["ControlPlacaBacteriana"],PDO::PARAM_STR);
		$this->query->bindValue(50,$_POST["FechaAtencionParto"],PDO::PARAM_STR);
		$this->query->bindValue(51,$_POST["FechaSalidaParto"],PDO::PARAM_STR);
		$this->query->bindValue(52,$_POST["FechaConsejeriaLactanciaInput"],PDO::PARAM_STR);
		$this->query->bindValue(53,$_POST["ControlRecienNacidoInput"],PDO::PARAM_STR);
		$this->query->bindValue(54,$_POST["PlanificacionFamiliarPrimeraVezInput"],PDO::PARAM_STR);
		$this->query->bindValue(55,$_POST["SuministroMetodoAnticonceptivo"],PDO::PARAM_STR);
		$this->query->bindValue(56,$_POST["FechaSuministroMetodoAnticonceptivo"],PDO::PARAM_STR);
		$this->query->bindValue(57,$_POST["ControlPrenatalPrimeraVezInput"],PDO::PARAM_STR);
		$this->query->bindValue(58,$_POST["ControlPrenatal"],PDO::PARAM_STR);
		$this->query->bindValue(59,$_POST["UltimoControlPrenatal"],PDO::PARAM_STR);
		$this->query->bindValue(60,$_POST["SuministroAcidoFolico"],PDO::PARAM_STR);
		$this->query->bindValue(61,$_POST["SuministroSulfatoFerroso"],PDO::PARAM_STR);
		$this->query->bindValue(62,$_POST["SuministroCarbonatoCalcio"],PDO::PARAM_STR);
		$this->query->bindValue(63,$_POST["ValoracionAgudezaVisualInput"],PDO::PARAM_STR);
		$this->query->bindValue(64,$_POST["ConsultaOftalmologiaInput"],PDO::PARAM_STR);
		$this->query->bindValue(65,$_POST["FechaDiagnosticoDesnutricion"],PDO::PARAM_STR);
		$this->query->bindValue(66,$_POST["ConsultaMujerMenorVictimaInput"],PDO::PARAM_STR);
		$this->query->bindValue(67,$_POST["ConsultaVictimaViolenciaSexualInput"],PDO::PARAM_STR);
		$this->query->bindValue(68,$_POST["ConsultaNutricionInput"],PDO::PARAM_STR);
		$this->query->bindValue(69,$_POST["ConsultaPsicologiaInput"],PDO::PARAM_STR);
		$this->query->bindValue(70,$_POST["ConsultaCyDPrimeraVezInput"],PDO::PARAM_STR);
		$this->query->bindValue(71,$_POST["SuministroSulfatoFerrosoMenor"],PDO::PARAM_STR);
		$this->query->bindValue(72,$_POST["SuministroVitaminaAMenor"],PDO::PARAM_STR);
		$this->query->bindValue(73,$_POST["ConsultaJovenPrimeraVezInput"],PDO::PARAM_STR);
		$this->query->bindValue(74,$_POST["ConsultaAdultoPrimeraVezInput"],PDO::PARAM_STR);
		$this->query->bindValue(75,$_POST["PreservativosITSInput"],PDO::PARAM_STR);
		$this->query->bindValue(76,$_POST["AsesoriaPreElisaInput"],PDO::PARAM_STR);
		$this->query->bindValue(77,$_POST["AsesoriaPostElisaInput"],PDO::PARAM_STR);
		$this->query->bindValue(78,$_POST["PacienteEnfermedadMental"],PDO::PARAM_STR);
		$this->query->bindValue(79,$_POST["FechaAntigenoHepatitisBGestantesInput"],PDO::PARAM_STR);
		$this->query->bindValue(80,$_POST["ResultadoAntigenoHepatitisBGestantes"],PDO::PARAM_STR);
		$this->query->bindValue(81,$_POST["FechaSerologiaSifilisInput"],PDO::PARAM_STR);
		$this->query->bindValue(82,$_POST["ResultadoSerologiaSifilis"],PDO::PARAM_STR);
		$this->query->bindValue(83,$_POST["FechaTomaElisaVIHInput"],PDO::PARAM_STR);
		$this->query->bindValue(84,$_POST["ResultadoElisaVIH"],PDO::PARAM_STR);
		$this->query->bindValue(85,$_POST["FechaTSHNeonatalInput"],PDO::PARAM_STR);
		$this->query->bindValue(86,$_POST["ResultadoTSHNeonatal"],PDO::PARAM_STR);
		$this->query->bindValue(87,$_POST["TamizajeCancerCU"],PDO::PARAM_STR);
		$this->query->bindValue(88,$_POST["FechaCitologiaCUInput"],PDO::PARAM_STR);
		$this->query->bindValue(89,$_POST["CitologiaCUResultados"],PDO::PARAM_STR);
		$this->query->bindValue(90,$_POST["CalidadMuestraCitologia"],PDO::PARAM_STR);
		$this->query->bindValue(91,$_POST["CodigoHabilitacionIPSTomaMuestra"],PDO::PARAM_STR);
		$this->query->bindValue(92,$_POST["FechaColposcopiaInput"],PDO::PARAM_STR);
		$this->query->bindValue(93,$_POST["CodigoHabilitacionTomaColposcopia"],PDO::PARAM_STR);
		$this->query->bindValue(94,$_POST["FechaBiopsiaCervicalInput"],PDO::PARAM_STR);
		$this->query->bindValue(95,$_POST["ResultadoBiopsiaCervical"],PDO::PARAM_STR);
		$this->query->bindValue(96,$_POST["CodigoHabilitacionTomaBiopsia"],PDO::PARAM_STR);
		$this->query->bindValue(97,$_POST["FechaMamografiaInput"],PDO::PARAM_STR);
		$this->query->bindValue(98,$_POST["ResultadoMamografia"],PDO::PARAM_STR);
		$this->query->bindValue(99,$_POST["CodigoHabilitacionTomaMamografia"],PDO::PARAM_STR);
		$this->query->bindValue(100,$_POST["FechaBiopsiaSenoInput"],PDO::PARAM_STR);
		$this->query->bindValue(101,$_POST["FechaResultadoBiopsiaSeno"],PDO::PARAM_STR);
		$this->query->bindValue(102,$_POST["ResultadoBiopsiaSeno"],PDO::PARAM_STR);
		$this->query->bindValue(103,$_POST["CodigoHabilitacionBiopsiaSeno"],PDO::PARAM_STR);
		$this->query->bindValue(104,$_POST["FechaTomaHemoglobinaInput"],PDO::PARAM_STR);
		$this->query->bindValue(105,$_POST["ResultadoHemoglobina"],PDO::PARAM_STR);
		$this->query->bindValue(106,$_POST["FechaTomaGlisemiaInput"],PDO::PARAM_STR);
		$this->query->bindValue(107,$_POST["FechaTomaCreatininaInput"],PDO::PARAM_STR);
		$this->query->bindValue(108,$_POST["ResultadoCreatinina"],PDO::PARAM_STR);
		$this->query->bindValue(109,$_POST["FechaHemoglobinaGlicosiladaInput"],PDO::PARAM_STR);
		$this->query->bindValue(110,$_POST["ResultadoHemoglobinaGlicosilada"],PDO::PARAM_STR);
		$this->query->bindValue(111,$_POST["FechaTomaMicroalbuminuriaInput"],PDO::PARAM_STR);
		$this->query->bindValue(112,$_POST["FechaTomaHDLInput"],PDO::PARAM_STR);
		$this->query->bindValue(113,$_POST["FechaTomaBaciloscopiaInput"],PDO::PARAM_STR);
		$this->query->bindValue(114,$_POST["ResultadoBaciloscopia"],PDO::PARAM_STR);
		$this->query->bindValue(115,$_POST["TratamientoHipotiroidismoCongenito"],PDO::PARAM_STR);
		$this->query->bindValue(116,$_POST["TratamientoSifilisGestacional"],PDO::PARAM_STR);
		$this->query->bindValue(117,$_POST["TratamientoSifilisCongenita"],PDO::PARAM_STR);
		$this->query->bindValue(118,$_POST["TratamientoLepra"],PDO::PARAM_STR);
		$this->query->bindValue(119,$_POST["FechaTerLeishmaniasisInput"],PDO::PARAM_STR);
		$this->query->bindValue(120,$_POST["R_ID"], PDO::PARAM_STR);
		$this->query->execute();
	}
}
?>

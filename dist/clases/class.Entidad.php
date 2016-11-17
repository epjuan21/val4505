<?php
require_once ("class.ConnectionMySQL.php");
class Entidad extends ConnectionMySQL {
	public $query;
	public function getEntidades () {
		$this->query = $this->conn->prepare('SELECT ENTIDAD_ID, ENTIDAD_COD, ENTIDAD_NAME FROM entidades');
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}
	public function getEntidadId ($idEntidad) {
		$this->query = $this->conn->prepare("SELECT ENTIDAD_ID, ENTIDAD_COD, ENTIDAD_NAME FROM entidades WHERE ENTIDAD_COD = '$idEntidad' ");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}
	// Funcion para Listar Entidades Importadas Por Usuario
	public function getListEnt($IdUsuario){
		$this->query = $this->conn->prepare(
			"SELECT val4505.entidades.ENTIDAD_NAME, val4505.entidades.ENTIDAD_COD, val4505.rped.CodigoMunicipio FROM val4505.rped LEFT JOIN entidades ON (val4505.rped.CodigoEntidad = val4505.entidades.ENTIDAD_COD) WHERE val4505.rped.IdUsuario = '$IdUsuario' GROUP BY val4505.entidades.ENTIDAD_NAME");		
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}
	// Funcion para listar Periodos por Entidades
	public function getListPeriodos($IdEntidad){
		$this->query = $this->conn->prepare(
			"SELECT 
			CodigoEntidad
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
			,FechaFinalReg AS FechaFinalReg
			,substr(FechaFinalReg,1,4) AS Año
			FROM val4505.rped
			WHERE CodigoEntidad = '$IdEntidad'
			GROUP BY FechaFinalReg");		
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	// Funcion Para Obtener Todos Los Periodos Importados Por Entidad
	public function getListPeriodosId ($CodigoEntidad, $IdUsuario, $CodigoMunicipio) {
		$this->query = $this->conn->prepare(
			"SELECT COUNT(CodigoEntidad) AS Registros
			,ENTIDAD_NAME AS Entidad
			,IdUsuario
			,CodigoEntidad
			,CodigoMunicipio
			,municipios.MUN_NAME AS Municipio
			,FechaInicialReg
			,FechaFinalReg
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
			LEFT JOIN municipios ON rped.CodigoMunicipio = municipios.MUN_ID
			WHERE CodigoEntidad = '$CodigoEntidad'
			AND IdUsuario = '$IdUsuario'
			AND CodigoMunicipio = '$CodigoMunicipio'
			GROUP BY CodigoEntidad, FechaFinalReg
			ORDER BY Año DESC, CodPer DESC");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	// Funcion Para Obtener Un Periodo Por Entidad
	public function getPeriodoEntidad ($CodigoEntidad, $IdUsuario, $CodigoMunicipio, $Periodo) {
		$this->query = $this->conn->prepare(
			"SELECT COUNT(CodigoEntidad) AS Registros
			,ENTIDAD_NAME AS Entidad
			,IdUsuario
			,CodigoEntidad
			,CodigoMunicipio
			,municipios.MUN_NAME AS Municipio
			,FechaInicialReg
			,FechaFinalReg
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
			LEFT JOIN municipios ON rped.CodigoMunicipio = municipios.MUN_ID
			WHERE CodigoEntidad = '$CodigoEntidad'
			AND IdUsuario = '$IdUsuario'
			AND CodigoMunicipio = '$CodigoMunicipio'
			AND FechaFinalReg = '$Periodo'
			GROUP BY CodigoEntidad, FechaFinalReg
			ORDER BY Año DESC, CodPer DESC");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}	


	// Funcion Para Insertar Entidad
	public function insertEntidad () {
		$sql="INSERT INTO entidades VALUES(?,?,?)";
		$stmt=$this->conn->prepare($sql);		
		$stmt->bindValue(1,null,PDO::PARAM_INT);
		$stmt->bindValue(2,$_POST["ent-cod"],PDO::PARAM_STR);
		$stmt->bindValue(3,$_POST["ent-nombre"],PDO::PARAM_STR);
		$stmt->execute();
		$this->conn=null;
	}
	public function updateEntidad () {
		echo $_POST["ent-cod"];
		$sql = "UPDATE entidades SET 			
			ENTIDAD_COD=?,
			ENTIDAD_NAME=?
			WHERE
			ENTIDAD_ID=?";
	
			$stmt=$this->conn->prepare($sql);
			
			$stmt->bindValue(1,$_POST["ent-cod"], PDO::PARAM_STR);
			$stmt->bindValue(2,$_POST["ent-nombre"],PDO::PARAM_STR);
			$stmt->bindValue(3,$_POST["id-entidad"],PDO::PARAM_STR);
			$stmt->execute();
	}
}
?>
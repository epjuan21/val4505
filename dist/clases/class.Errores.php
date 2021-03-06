<?php
require_once ("class.ConnectionMySQL.php");

class Errores extends ConnectionMySQL {

	public $query;

	// Funcion Para Insertar Errores de Ecoopsos
	public function insertErrores ($IdError, $CodigoUsuario, $IdEntidad, $TipoError, $Periodo, $CodigoMunicipio, $IdUsuario, $DetalleError, $MensajeError) {

		$sql="INSERT INTO errores4505 VALUES(?,?,?,?,?,?,?,?,?)";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1,$IdError,PDO::PARAM_INT);
		$stmt->bindValue(2,$CodigoUsuario,PDO::PARAM_STR);
		$stmt->bindValue(3,$IdEntidad,PDO::PARAM_STR);
		$stmt->bindValue(4,$TipoError,PDO::PARAM_INT);
		$stmt->bindValue(5,$Periodo,PDO::PARAM_STR);
		$stmt->bindValue(6,$CodigoMunicipio,PDO::PARAM_STR);
		$stmt->bindValue(7,$IdUsuario,PDO::PARAM_STR);
		$stmt->bindValue(8,$DetalleError,PDO::PARAM_STR);
		$stmt->bindValue(9,$MensajeError,PDO::PARAM_STR);
		$stmt->execute();
	}

	public function getErrores ()
	{
		$this->query = $this->conn->prepare('SELECT NumeroIdUsuario, CodigoEntidad FROM errores4505');
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	// Funcion Para Obtener Errores Para ser Procesados
	public function gerErroresProc ($CodigoEntidad, $TipoError, $Periodo, $CodigoMunicipio, $IdUsuario){
		$this->query = $this->conn->prepare("SELECT NumeroIdUsuario, CodigoEntidad, Periodo, CodigoMunicipio, IdUsuario, DetalleError, MensajeError FROM errores4505 WHERE CodigoEntidad = '$CodigoEntidad' AND TipoError = '$TipoError' AND Periodo = '$Periodo' AND CodigoMunicipio = '$CodigoMunicipio' AND IdUsuario = '$IdUsuario' ");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}


	// Funcion Para Borrar Errores Luego de Ser Procesados
	public function delErroresProc ($CodigoEntidad, $TipoError, $Periodo, $CodigoMunicipio, $IdUsuario){
		$this->query = $this->conn->prepare("DELETE FROM errores4505 WHERE CodigoEntidad = '$CodigoEntidad' AND TipoError = '$TipoError' AND Periodo = '$Periodo' AND CodigoMunicipio = '$CodigoMunicipio' AND IdUsuario = '$IdUsuario' ");
		$this->query->execute();
	}

	// Funcion para Obtener el Número de Errores Por Tipo
	public function getNumErrorsByType ($CodigoEntidad, $TipoError, $Periodo, $CodigoMunicipio, $IdUsuario) {
		$this->query = $this->conn->prepare("
			SELECT COUNT(*) FROM errores4505 WHERE 
			TipoError = '$TipoError' AND
			CodigoEntidad = '$CodigoEntidad' AND
			Periodo = '$Periodo' AND
			CodigoMunicipio = '$CodigoMunicipio' AND
			IdUsuario = '$IdUsuario'
			");
		$this->query->execute();
		$count = $this->query->fetch(PDO::FETCH_NUM);
		return reset($count);
		//return $numRows = $this->query->rowCount();
	}

	// Funcion para obtener Cantidad de Errores por Entidad
	public function getErrorByEPS($CodigoEntidad, $Periodo, $CodigoMunicipio, $IdUsuario) {
		$this->query = $this->conn->prepare("
			SELECT COUNT(TipoError) AS Cantidad
			,errores4505.MensajeError
			,CodigoEntidad
			,TipoError
			FROM
			errores4505
			WHERE CodigoEntidad = '$CodigoEntidad'
			AND Periodo = '$Periodo'
			AND CodigoMunicipio = '$CodigoMunicipio'
			AND IdUsuario = '$IdUsuario'
			GROUP BY errores4505.MensajeError, TipoError, CodigoEntidad
			");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}
}
?>

<?php
require_once ("class.ConnectionMySQL.php");

class Errores extends ConnectionMySQL {

	public $query;

	// Funcion Para Insertar Errores de Ecoopsos
	public function insertErroresEcoopsos ($IdError, $CodigoUsuario, $IdEntidad, $TipoError, $Periodo, $CodigoMunicipio, $IdUsuario, $DetalleError) {

		$sql="INSERT INTO errores4505 VALUES(?,?,?,?,?,?,?,?)";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1,$IdError,PDO::PARAM_INT);
		$stmt->bindValue(2,$CodigoUsuario,PDO::PARAM_STR);
		$stmt->bindValue(3,$IdEntidad,PDO::PARAM_STR);
		$stmt->bindValue(4,$TipoError,PDO::PARAM_INT);
		$stmt->bindValue(5,$Periodo,PDO::PARAM_STR);
		$stmt->bindValue(6,$CodigoMunicipio,PDO::PARAM_STR);
		$stmt->bindValue(7,$IdUsuario,PDO::PARAM_STR);
		$stmt->bindValue(8,$DetalleError,PDO::PARAM_STR);
		$stmt->execute();
	}

	public function getErrores ()
	{
		$this->query = $this->conn->prepare('SELECT NumeroIdUsuario, CodigoEntidad FROM errores4505');
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	// Funcion para Obtener el Número de Errores Por Tipo
	public function getNumErrorsByType ($TipoError) {
		$this->query = $this->conn->prepare("SELECT COUNT(*) FROM errores4505 WHERE TipoError = '$TipoError'");
		$this->query->execute();
		$count = $this->query->fetch(PDO::FETCH_NUM);
		return reset($count);
		//return $numRows = $this->query->rowCount();
	}

}

?>

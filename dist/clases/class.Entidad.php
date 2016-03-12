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
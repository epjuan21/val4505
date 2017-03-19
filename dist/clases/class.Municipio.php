<?php
require_once ("class.ConnectionMySQL.php");

class Municipio extends ConnectionMySQL {

	public $query;

	public function getMunicipios () {
		$this->query = $this->conn->prepare('SELECT MUN_ID, MUN_NAME, MUN_COD, MUN_ENT_COD_HAB FROM municipios');
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	public function getMunicipioId ($idMunicipio) {
		$this->query = $this->conn->prepare("SELECT MUN_ID, MUN_NAME, MUN_COD, MUN_ENT_COD_HAB FROM municipios WHERE MUN_ID = '$idMunicipio' ");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

	public function insertMunicipio () {

		$sql="INSERT INTO municipios VALUES(?,?,?,?)";
		$stmt=$this->conn->prepare($sql);		
		$stmt->bindValue(1,null,PDO::PARAM_INT);
		$stmt->bindValue(2,$_POST["mun-name"],PDO::PARAM_STR);
		$stmt->bindValue(3,$_POST["mun-cod"],PDO::PARAM_STR);
		$stmt->bindValue(4,$_POST["mun-cod-hab"],PDO::PARAM_STR);
		$stmt->execute();
		$this->conn=null;
	}

	public function updateMunicipio () {

		$sql = "UPDATE municipios SET 			
			MUN_NAME=?,
			MUN_COD=?,
			MUN_ENT_COD_HAB=?

			WHERE
			MUN_ID=?";
	
			$stmt=$this->conn->prepare($sql);
			
			$stmt->bindValue(1,$_POST["NombreMunicipio"],PDO::PARAM_STR);
			$stmt->bindValue(2,$_POST["CodigoMunicipio"],PDO::PARAM_STR);
			$stmt->bindValue(3,$_POST["CodigoHabilitacion"],PDO::PARAM_STR);

			$stmt->bindValue(4,$_POST["IdMunicipio"],PDO::PARAM_STR);

			$stmt->execute();
	}

}

?>
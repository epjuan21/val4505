<?php
require_once ("class.ConnectionSQLite.php");

class Usuarios extends ConnectionSQLite {

	public $query;

	public function validar_usuario ($usuario, $clave) {
		echo $clave;
		$this->query = $this->conn->prepare("SELECT idusuario, usuario, clave, email FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

}

?>
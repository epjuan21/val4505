<?php
require_once ("class.ConnectionMySQL.php");

class Usuarios extends ConnectionMySQL {

	public $query;

	public function validar_usuario ($usuario, $clave) {
		$this->query = $this->conn->prepare("SELECT USUARIO_NAME, USUARIO_PASS FROM usuarios WHERE USUARIO_NAME = '$usuario' AND USUARIO_PASS = '$clave'");
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

}

?>
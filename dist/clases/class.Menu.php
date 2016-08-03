<?php
require_once ("class.ConnectionMySQL.php");

class Menu extends ConnectionMySQL {

	public $query;

	public function getMenu ($id_menu) {

		$this->query = $this->conn->prepare('SELECT MENU_ID, MENU_NAME, MENU_HTML FROM menu WHERE MENU_ID ='.$id_menu);
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

}

?>
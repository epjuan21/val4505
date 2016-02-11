<?php
require_once ("class.ConnectionSQLite.php");

class Menu extends ConnectionSQLite {

	public $query;

	public function get_menu ($id_menu) {

		$this->query = $this->conn->prepare('SELECT id_menu, menu, html FROM menu WHERE id_menu ='.$id_menu);
		$this->query->execute();
		return $this->query->fetchAll(PDO::FETCH_BOTH);
	}

}

?>
<?php

abstract class ConnectionSQLite {

	protected $db_name = '../sqlite/val4505.sqlite';
	public $conn;
	public $query;

	public function __construct(){

	try {

		$this->conn = new PDO('sqlite:../sqlite/val4505.sqlite');

	} catch(PDOException $e){
            $this->error = $e->getMessage();
        }
      }

	}

?>
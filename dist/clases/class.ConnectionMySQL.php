<?php
abstract class ConnectionMySQL {

	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '1234321234Juan';
	protected $db_name = 'val4505';

	public function __construct(){

		// Set DNS
		$dns = "mysql:host=" . self::$db_host . ";dbname=" . $this->db_name;

		// Set Options
		$options = array( PDO::MYSQL_ATTR_LOCAL_INFILE => 1,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

	try {

		$this->conn = new PDO($dns, self::$db_user, self::$db_pass, $options);

	} catch(PDOException $e){
            $this->error = $e->getMessage();
        }

	}
}

?>
<?php
echo dirname(__FILE__);
	$host = "PMALAP-004\\SQLEXPRESS";
	$db_name = "biz";
	$username = "sa";
	$password = "Answer934@";
	$puerto = ""; //":8086";
	$dominio="biznet";
	$subdominio= "";
	$company="biznet";
	$protocol ="http";

	$conn;		
	$urlServicios;		
	
	$conn = null;
	try{				
		$this->conn = new PDO("mssql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
		//$this->conn->exec("set names utf8");
		
		//$conn = new PDO("sqlsrv:server=" . $host . ";database=" . $db_name, $username, $password);
		//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//$conn = new PDO("mssql:host=$host;dbname=$db_name, $username, $password");
		//echo $conn;
		
	}catch(Exception $e){
		echo "Database could not be connected: " . $e->getMessage();
	}
	//return $this->conn;	
?>
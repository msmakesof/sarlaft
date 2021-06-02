<?php
/*
CRUD con SQL Server y PHP
@author parzibyte [parzibyte.me/blog]
@date 2019-06-03
================================
Este archivo se encarga de conectar a la base de datos
y traer un objeto PDO
Recuerda cambiar tus credenciales, y tal vez ponerlas en
un archivo env: https://parzibyte.me/blog/2018/06/30/leer-archivo-configuracion-ini-php/
================================

$contraseña = "Answer934@";
$usuario = "sa";
$nombreBaseDeDatos = "biz";
# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
$rutaServidor = "PMALAP-004\SQLEXPRESS";
try {
    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
 */

/*
//$dsn = 'dblib:host=PMALAP-004\SQLEXPRESS;dbname=biz';
$dsn = 'dblib:host=localhost;dbname=biz';
$user = 'sa';
$password = 'Answer934@';

try
{
    $pdo_object = new PDO($dsn, $user, $password);
}
catch (PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}

$sql = "SELECT * from neg_categoria";
$pdo_statement_object = $pdo_object->prepare($sql);
$pdo_statement_object->execute();
// $result = $pdo_statement_object->fetch(PDO::FETCH_ASSOC);
$result = $pdo_statement_object->fetchAll();
print_r($result);
*/


$_MYSQL_HOST = "PMALAP-004\\SQLEXPRESS"; //servidor
$_MYSQL_DB = "SecureLogin"; //base de datos
$_MYSQL_USER = "sa "; //Usuario
$_MYSQL_PASS = "Answer934@"; //Password

try {
	$pdo = new PDO ("sqlsrv:Server=$_MYSQL_HOST;Database=$_MYSQL_DB",$_MYSQL_USER, $_MYSQL_PASS); 
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //atributos para la base de datos
    echo 'LA CONEXION A LA BASE DE DATOS SE REALIZÓ SATISFACTORIAMENTE<br>';	

} 
catch (PDOException $e) { // captura de errores
    echo 'ERROR AL CONECTAR A LA BASE DE DATOS' . $e -> getMessage(); // mensaje de errores
    die(); //finalizar script 
}

	/**/
	$resp=[];
	$sqlQuery = "SELECT id, CustomerKey ,CustomerDB ,CustomerLogo ,CustomerName ,CustomerNit ,CustomerCity ,CustomerColor ,CustomerStatus ,UserKey ,DateStamp FROM  SecureLogin	 ORDER BY CustomerName <br>";	
	echo  $sqlQuery;
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute();
    //return $stmt;
	echo "<br>stmt...";
	//echo $stmt;
	$resp = $stmt->fetch();
	if($resp){
            echo "conectado";
            die();
    }
	

/*	
	$dsn = 'dblib:host=PMALAP-004\\SQLEXPRESS;dbname=<database name>';
	$user = 'user id';
	$password = 'password';

	try
	{
		$pdo_object = new PDO($dsn, $user, $password);
	}
	catch (PDOException $e)
	{
		echo 'Connection failed: ' . $e->getMessage();
	}
*/
	
	////$sql = "id, CustomerKey ,CustomerDB ,CustomerLogo ,CustomerName ,CustomerNit ,CustomerCity ,CustomerColor ,CustomerStatus ,UserKey ,DateStamp FROM  SecureLogin	";
	////$pdo_statement_object = $pdo->prepare($sql);
	////$pdo_statement_object->execute();
	// $result = $pdo_statement_object->fetch(PDO::FETCH_ASSOC);
	////$result = $pdo_statement_object->fetchAll();
	////print_r($result);

	
	/*
	$stmt = $pdo->prepare("SELECT id, CustomerKey ,CustomerDB ,CustomerLogo ,CustomerName ,CustomerNit ,CustomerCity ,CustomerColor ,CustomerStatus ,UserKey ,DateStamp FROM  SecureLogin ORDER BY CustomerName");
	$stmt = $stmt->fetch_object();
	//var_dump($stmt);
	//echo $stmt;
	$stmt->execute();
	while ($row = $stmt->fetch()) {
		print_r($row);
	}
	unset($pdo); unset($stmt);
	*/
	
?>
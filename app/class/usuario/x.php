<?php
$server = "PMALAP-004\\SQLEXPRESS";
$user = "sa";
$pwd = "Answer934@";
$database = "SecureLogin";

/*
try {
 //$conn = new PDO( "sqlsrv:Server=$server;Database=$database", $user, $pwd );
 //$conn = new PDO ("mssql:host=$server;dbname=$database","$user","$pwd");
  $pdo = new PDO("odbc:Driver={SQL Server};Server=$server;Database=$database;", $user, $pwd);  // works with proper driver for ODBC and PHP ODBC.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ini_set('mssql.charset', 'UTF-8');  
 
} catch ( Exception $e ) {
 die( print_r( $e->getMessage() ) );
} */

try{
    //$pdo = new PDO("sqlsrv:Server=$hostname;Database=$dbname;", $username, $password);  // works with proper driver for PHP.
    $pdo = new PDO("odbc:Driver={SQL Server};Server=$server;Database=$database;", $user, $pwd);  // works with proper driver for ODBC and PHP ODBC.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ini_set('mssql.charset', 'UTF-8');  // allow Chinese names.
	
	echo "Conectado";
	
}catch(PDOException $e){
    die("Error connecting to $server SQL: ".$e->getMessage());
}


/*
$conn->setAttribute( PDO::SQLSRV_ATTR_DIRECT_QUERY, true );
$data = $conn->query( $conn, "SELECT id, CustomerKey ,CustomerDB ,CustomerLogo ,CustomerName ,CustomerNit ,CustomerCity ,CustomerColor ,CustomerStatus FROM  SecureLogin" );

$rows = $data->fetchAll( PDO::FETCH_BOTH );
*/
?>
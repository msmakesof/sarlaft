<?php
$serverName = "PMALAP-004\SQLEXPRESS";  //"LAPTOP-C19VUK67"; //serverName\instanceName 
$connectionInfo = array( "Database"=>"SecureLogin", "UID"=>"sa", "PWD"=>"Answer934@");
$con = sqlsrv_connect( $serverName, $connectionInfo);

if( $con ) {
     //echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>


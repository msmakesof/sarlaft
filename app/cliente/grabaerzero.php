<?php
include('../ajax/is_logged.php');
$CustomerKey=$_SESSION['Keyp'];

require_once ("../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

$consecutivo = $_POST['csc'];
$ideventoriesgo = $_POST['er'];
// Insertar EVRI_EventoRiesgo
date_default_timezone_set("America/Bogota");
$CustomerKey=$_SESSION['Keyp'];
$EventoKey=time();
$UserKey=$_SESSION['UserKey'];
$DateStamp=date("Y-m-d H:i:s");

$sql="INSERT INTO EVRI_EventoRiesgo (EVRI_Consecutivo, EVRI_IdEvento, EVRI_CustomerKey, EVRI_UserKey, EVRI_EventoKey, EVRI_DateStamp) VALUES ('".$consecutivo."',".$ideventoriesgo.",'".$CustomerKey."','".$UserKey."','".$EventoKey."','".$DateStamp."'); ;  SELECT SCOPE_IDENTITY() as LastId;";
$query = sqlsrv_query($conn,$sql);
$next_result = sqlsrv_next_result($query);
$row = sqlsrv_fetch_array($query); 
$LastId = $row['LastId'];
echo $LastId;
?>
<?php
/***********************************************************
Author: Mauricio Sanchez Sierra
Date: 2021-08-04
Description:  Graba la primera parte del Evento de Riesgo
***********************************************************/
include('../ajax/is_logged.php');
$CustomerKey=$_SESSION['Keyp'];

require_once ("../config/dbx.php");
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

//Para saber el Id de la Interseccion usada
$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 INT_IdInterseccion FROM INT_Interseccion WHERE INT_CustomerKey='".$CustomerKey."' ORDER BY INT_IdInterseccion DESC ");
$reg = sqlsrv_fetch_array($sqlmov);
$IdInterseccion = $reg['INT_IdInterseccion'];

$consecutivo = $_POST['csc'];
$ideventoriesgo = $_POST['er'];
// Insertar EVRI_EventoRiesgo
date_default_timezone_set("America/Bogota");
$CustomerKey=$_SESSION['Keyp'];
$EventoKey=time();
$UserKey=$_SESSION['UserKey'];
$DateStamp=date("Y-m-d H:i:s");

$sql="INSERT INTO EVRI_EventoRiesgo (EVRI_Consecutivo, EVRI_IdEvento, EVRI_IdInterseccion, EVRI_CustomerKey, EVRI_UserKey, EVRI_EventoKey, EVRI_DateStamp) VALUES ('".$consecutivo."',".$ideventoriesgo.",".$IdInterseccion.",'".$CustomerKey."','".$UserKey."','".$EventoKey."','".$DateStamp."'); SELECT SCOPE_IDENTITY() as LastId;";
$query = sqlsrv_query($conn,$sql);
$next_result = sqlsrv_next_result($query);
$row = sqlsrv_fetch_array($query); 
$LastId = $row['LastId'];
echo $LastId;
?>
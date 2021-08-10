<?php
if( isset($_POST["ck"]) && $_POST["ck"] != "" ){
	$CustomerKey=$_POST["ck"];
}

if( isset($_POST["er"]) && $_POST["er"] != "" ){
	$EventoRiesgo=$_POST["er"];
}

if( isset($_POST["ruta"]) && $_POST["ruta"] != "" ){
	$ruta=$_POST["ruta"];
}
else {
	$ruta='';
}
require_once $ruta.'../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);

$sqlmov=sqlsrv_query($conn,"SELECT TOP 1 MOV_TieneControlMRC FROM MOV_MatrizControl WHERE MOV_CustomerKeyMRC='".$CustomerKey."' AND MOV_IdEventoMRC =".$EventoRiesgo." ORDER BY MOV_IdMovimientoMRC DESC ");						
$reg = sqlsrv_fetch_array($sqlmov);
$afecta = $reg['MOV_TieneControlMRC'];
echo $afecta;
?>
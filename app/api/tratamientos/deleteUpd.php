<?php
include '../../ajax/is_logged.php';
$CustomerKey = $_SESSION['Keyp'];
$ck = trim($_POST['ck']);
$id = trim($_POST['id']);
$er = trim($_POST['er']);
include_once '../../config/dbx.php';

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($ck);

$sqlmov="DELETE FROM ETRA_Tratamientos WHERE ETRA_Id = ".$id." AND ETRA_IdEventoRiesgo=".$er;
$query = sqlsrv_query($conn,$sqlmov);
if ($query){
	// ingresa registro en el log de Auditoria
	date_default_timezone_set("America/Bogota");
	$DateStamp=date("Y-m-d H:i:s");
	$cadena = str_replace("'",'"',$sqlmov);
	$MAC = '';
	ob_start();
	system('ipconfig/all');
	$mycom=ob_get_contents(); 
	ob_clean(); 
	$findme = "Physical";
	$pmac = strpos($mycom, $findme); 
	$MAC=substr($mycom,($pmac+36),17);
	$sqllog="INSERT INTO LOG_LogAuditoria (LOG_CustomerKey, LOG_UserKey, LOG_Accion, LOG_Descripcion, LOG_IpAddress, LOG_Module, LOG_DateStamp) VALUES ('$CustomerKey','$UserKey','Borrar Tratamiento', '$cadena','$MAC','Evento de Riesgo','$DateStamp') ";
	$query = sqlsrv_query($conn,$sqllog);
	echo "S";
}
else{
	echo "N";
}
?>
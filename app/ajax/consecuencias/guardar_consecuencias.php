<?php
include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
if (empty($_POST['ConsecuenciasName2'])){
	$errors[] = "Ingresa el nombre del Consecuencia.";
} elseif (!empty($_POST['ConsecuenciasName2'])){
	//require_once ("../components/sql_server.php");
	require_once ("../../config/dbx.php");
	$getConnectionCli2 = new Database();
	$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);
	
	$query=sqlsrv_query($conn,"SELECT count(id) as Total FROM ConsecuenciasSarlaft WHERE CustomerKey=".$_SESSION['Keyp']." AND ConsecuenciasName ='".trim($_POST['ConsecuenciasName2'])."'");
	$reg=sqlsrv_fetch_array($query);
	if( $reg['Total'] > 0 ){
		echo "E";
	}
	else {
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$ConsecuenciasName=trim(strtoupper($_POST["ConsecuenciasName2"]));
		date_default_timezone_set("America/Bogota");
		$CustomerKey=$_SESSION['Keyp'];
		$ConsecuenciasKey=time();
		$UserKey=$_SESSION['UserKey'];
		$DateStamp=date("Y-m-d H:i:s");
		$sql="INSERT INTO ConsecuenciasSarlaft (CustomerKey, UserKey, DateStamp, ConsecuenciasName, ConsecuenciasKey) VALUES ('".$CustomerKey."','".$UserKey."','".$DateStamp."','".$ConsecuenciasName."','".$ConsecuenciasKey."')";
		$query = sqlsrv_query($conn,$sql);
		// if product has been added successfully
		if ($query) {
			//$messages[] = "El Consecuencia ha sido guardado con éxito.";
			echo "O";
		} else {
			//$errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
			echo "F";
		}
	}		
} else 
{
	//$errors[] = "desconocido.";
	echo "D";
}
?>			
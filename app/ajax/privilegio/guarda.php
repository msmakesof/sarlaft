<?php
$array = json_decode($_POST["ids"],TRUE);
$IdRol = $_POST["id"];
$IdUser = $_POST["iduser"];

require_once '../../config/dbx.php';
$getConnectionSL = new Database();
$con = $getConnectionSL->getConnectionSL();

// Borra los registros del IdRol
$sql="DELETE FROM PermisosxRol WHERE PER_IdRol = ".$IdRol;
//echo "$sql<br>";
$query = sqlsrv_query($con,$sql);
if (!$query) {
	echo "Se presento un problema al ejecutar la instrucción";
}
else{
	foreach ($array as $value) 
	{	
		$porciones = explode("A", $value['value']);
		$menu = $porciones[0];
		$accion =  $porciones[1];
		$sql="INSERT INTO PermisosxRol (PER_IdRol, PER_IdMenu, PER_IdAccion, PER_UserKey, PER_Creado) VALUES (".$IdRol.",".$menu.",".$accion.",'".$IdUser."',SYSDATETIME())";
		//echo "$sql<br>";
		$query = sqlsrv_query($con,$sql);
	}

	// if product has been added successfully
	if ($query) {
		$rta = "S"; 
	} else {
		$rta = "N";
	}
}
echo $rta;
?>
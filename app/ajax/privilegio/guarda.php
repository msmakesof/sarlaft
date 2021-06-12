<?php
////echo $_POST["id"]."<br>";
//echo $_POST['selected'];
////print_r(json_decode($_POST["ids"],TRUE));
$array = json_decode($_POST["ids"],TRUE);
//$array = $_POST["ids"];

/*
echo "<br>";
foreach ($array as $value) {
    //$cadena = "El nombre de la provincia es: '". $value['name'] ."', y su puntuación es: ". $value['y'] ."},";
    ////echo $value['name']. ' '. $value['value']."<br>";
	$porciones = explode("A", $value['value']);
	echo $porciones[0]."<br>";
	echo $porciones[1]."<br>";
}
*/

/*
require_once '../../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
//echo $urlServicios;

$idrol = $_POST["id"];
$iduser = $_POST["iduser"];
// Se envia array.
$url = $urlServicios."api/privilegio/crear.php?idrol=$idrol&iduser=$iduser&opciones=".serialize($array);
echo $url;
*/


/*   Esto funciona */
$IdRol = $_POST["id"];
$IdUser = $_POST["iduser"];
require_once '../../components/sql_server_login.php';

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
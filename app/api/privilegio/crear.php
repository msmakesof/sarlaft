<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//include_once '../../config/dbx.php';
//include_once '../../class/privilegio/privilegio.php';
require_once '../../components/sql_server_login.php';

/*
$database = new Database();
$db = $database->getConnection();
$item = new PermisosxRol($db);
*/


$IdRol = trim($_GET['idrol']);
$IdUser = trim($_GET['iduser']);
$IdPermisoxRol = json_decode($_GET['opciones'],TRUE); // $_GET['opciones'];  //
print_r($IdPermisoxRol);

if(is_array($IdPermisoxRol)){ echo "es arreglo";} else { echo  gettype($IdPermisoxRol);}
echo "<br>";

//date_default_timezone_set("America/Bogota");
//$DateStamp=date("Y-m-d H:i:s");
foreach ( $IdPermisoxRol as $value) 
{	
	//$value['value'];
	$porciones = explode("A", $value['value']);
	$menu = $porciones[0];     //."<br>";
	$accion =  $porciones[1];  //."<br>";
	$sql="INSERT INTO PermisosxRol (PER_IdRol, PER_IdMenu, PER_IdAccion, PER_UserKey, PER_Creado) VALUES (".$IdRol.",".$menu.",".$accion.",'".$IdUser."',SYSDATETIME())";
	$query = sqlsrv_query($con,$sql);
}

// if product has been added successfully
if ($query) {
	echo 'S'; 
} else {
	echo 'N';
}

/*
$item->PER_IdPermisoxRol = $IdPermisoxRol;
$item->PER_IdUsuario = $IdUser ;
$item->PER_IdRol = $IdRol;

if($item->createPrivilegioxRol())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
*/
?>
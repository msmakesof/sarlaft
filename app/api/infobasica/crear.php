<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/infobasica/infobasica.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Infobasica($db);

$Nombre = trim($_GET['Nombre']);
$ObjetoSocial = trim($_GET['ObjetoSocial']);
$DescripcionGeneral = trim($_GET['DescripcionGeneral']);
$ObjetivosEstrategicos = trim($_GET['ObjetivosEstrategicos']);
$Mision = trim($_GET['Mision']);
$Vision = trim($_GET['Vision']);
$CustomerKey = trim($_GET['CK']);  //$_SESSION['Keyp'];
$UserKey = trim($_GET['WK']);  //$_SESSION['UserKey'];
$InfoBasicaKey = trim($_GET['IK']);  //$_SESSION['UserKey'];
$DateStamp = trim($_GET['DS']);  //$_SESSION['UserKey'];

$item->CLI_ActividadEconomica = $Nombre;
$item->CLI_ObjetoSocial = $ObjetoSocial;
$item->CLI_DescripcionGeneral = $DescripcionGeneral;
$item->CLI_Mision = $Mision;
$item->CLI_Vision = $Vision;
$item->CLI_ObjetivosEstrategicos = $ObjetivosEstrategicos;
$item->CLI_CustomerKey = $CustomerKey;
$item->CLI_InfoBasicaKey = $InfoBasicaKey;
$item->CLI_UserKey = $UserKey;
$item->CLI_DateStamp = $DateStamp;

if($item->create())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>
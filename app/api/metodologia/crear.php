<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/metodologia/metodologia.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new Metodologia($db);

$Nombre = trim($_GET['Nombre']);
$FactorRiesgo = trim($_GET['FactorRiesgo']);
$Descripcion = trim($_GET['Descripcion']);
$Observaciones = trim($_GET['Observaciones']);
$CK = trim($_GET['CK']);
$MK = trim($_GET['MK']);
$UK = trim($_GET['UK']);
//$DS = trim($_GET['DS']);

$item->MET_Nombre = $Nombre;
$item->MET_FactorRiesgo = $FactorRiesgo;
$item->MET_Descripcion = $Descripcion;
$item->MET_Observaciones = $Observaciones;
$item->MET_CustomerKey = $CK;
$item->MET_MetodologiaKey = $MK;
$item->MET_USerKey = $UK;
//$item->MET_DateStamp = $DS;

if($item->create())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}
?>
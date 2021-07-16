<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbx.php';
include_once '../../class/plan/tarea.php';

$database = new Database();
$db = $database->getConnectionCli();
$item = new TareasPlan($db);

$IdPlan = trim($_GET['IdPlan']);
$NombreTarea = trim($_GET['NombreTarea']);

$item->TPP_IdPlan = $IdPlan;
$item->TPP_NombreTarea = $NombreTarea;

if($item->createTarea())
{
	echo 'S'; 
} 
else
{
	echo 'N';
}


/*  // con SP
require_once '../../config/sql_serversp.php';

$IdPlan = trim($_GET['IdPlan']);
$NombreTarea = trim($_GET['NombreTarea']);

$params = array (
	array($IdPlan, SQLSRV_PARAM_IN),
	array($NombreTarea, SQLSRV_PARAM_IN),
);
$spSQL = "{call dbo.sp_InsertaTarea(?,?)}";
$REC = sqlsrv_prepare($conn, $spSQL, $params);

if(sqlsrv_execute($REC)){
	echo 'S'; 
}
else {
    die( print_r( sqlsrv_errors(), true));
	echo 'N';
}
*/
?>
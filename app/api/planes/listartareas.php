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
$items = new TareasPlan($db);

$items->TPP_IdPlan = isset($_GET['id']) ? $_GET['id'] : die();
//$CustomerKey = trim($_GET['ck']);

$stmt = $items->getTareasPlan();
$itemCount = $stmt->rowCount();

if($itemCount > 0){
    
    $estadoArr = array();
    $estadoArr["body"] = array();
    $estadoArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "TPP_IdTareaxPlan" => $TPP_IdTareaxPlan,
            "TPP_IdPlan" => $TPP_IdPlan,
            "TPP_NombreTarea" => $TPP_NombreTarea,
        );

        array_push($estadoArr["body"], $e);
    }
    echo json_encode($estadoArr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "Registro No Encontrado.")
    );
}

//$NombreTarea = trim($_GET['NombreTarea']);

/*

$params = array (
	array($IdPlan, SQLSRV_PARAM_IN),
	array($CustomerKey, SQLSRV_PARAM_IN),
);

$spSQL = "{call dbo.sp_ListaPlanTareas(?,?)}";
$REC = sqlsrv_prepare($conn, $spSQL);

if(sqlsrv_execute($REC)){    

    $estadoArr = array();
    $estadoArr["body"] = array();

    $z = 0;
    while ($row= sqlsrv_fetch_array($REC))
    {
        extract($row);
        $e = array(
            "id" => $id,
            "PlanesKey" => $PlanesKey,
        );
        array_push($estadoArr["body"], $e);
        $z ++;
    }
    if($z > 0){
        $estadoArr["itemCount"] = $z;
        echo json_encode($estadoArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Registro No Encontrado.")
        );
    }
    
}
else {
    die( print_r( sqlsrv_errors(), true));
}
*/
?>
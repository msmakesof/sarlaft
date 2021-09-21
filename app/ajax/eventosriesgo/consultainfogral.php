<?php
include '../is_logged.php';
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
require_once '../../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();

// escaping, additionally removing everything that could be (html/javascript-) code
$caso = trim($_POST["caso"]);
$evento = trim($_POST["evento"]);
$proceso = trim($_POST["proceso"]);
$responsable = trim($_POST["responsable"]);
$causas = trim($_POST["causas"]);
$consecuencias = trim($_POST["consecuencias"]);
$control = trim($_POST["control"]);
$tratamiento = trim($_POST["tratamiento"]);
$segclientes = trim($_POST["segclientes"]);
$segproductos = trim($_POST["segproductos"]);
$segcanales = trim($_POST["segcanales"]);
$segjurisdiccion = trim($_POST["segjurisdiccion"]);
$debilidades = trim($_POST["debilidades"]);
$oportunidades = trim($_POST["oportunidades"]);
$fortalezas = trim($_POST["fortalezas"]);
$amenazas = trim($_POST["amenazas"]);
$CustomerKey = trim($_SESSION['Keyp']);


$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

// Evento de Riesgo
$everie="";
$condi_where_caso = "";
/* Si caso esta vacio, seleccionamos todos */
if ( $caso != "" ){
	$condi_where_caso = " AND EVRI_Id = ".$caso ;
}

$query_ev=sqlsrv_query($conn,"SELECT EVRI_Id FROM EVRI_EventoRiesgo WHERE EVRI_CustomerKey='$CustomerKey' $condi_where_caso ");

if( $query_ev === false) {
    die( print_r( sqlsrv_errors(), true) );
}
while($row = sqlsrv_fetch_array( $query_ev, SQLSRV_FETCH_ASSOC ) ){
	$EVRI_Id = $row["EVRI_Id"];
	echo $EVRI_Id;
}



/*
$query = "";
$resultado = "";
// Si todo va bien se hace el Insert
$params = "caso=$caso&evento=$evento&proceso=$proceso&responsable=$responsable&causas=$causas&consecuencias=$consecuencias&control=$control&tratamiento=$tratamiento&segclientes=$segclientes&segproductos=$segproductos&segcanales=$segcanales&segjurisdiccion=$segjurisdiccion&debilidades=$debilidades&oportunidades=$oportunidades&oportunidades=$oportunidades&fortalezas=$fortalezas&amenazas=$amenazas&ck=$CustomerKey";
$url = $urlServicios."api/eventoriesgo/consulta_infogral.php?$params";
//echo $url;
$query = "";
$resultado = "";
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 0);
$resultado = curl_exec ($ch);
curl_close($ch);

$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
$query = $mestado;

$json_errors = array(
	JSON_ERROR_NONE => 'No se ha producido ningún error',
	JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
	JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
	JSON_ERROR_SYNTAX => 'Error de Sintaxis',
);

// if product has been added successfully
if ($query) {
	$messages[] = "O";
} else {
	$errors[] = 'R';
}
echo $msjx;
*/
?>
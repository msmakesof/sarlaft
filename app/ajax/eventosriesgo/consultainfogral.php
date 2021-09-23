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
/* Si caso está vacio, seleccionamos todos */
$condi_where_caso = " AND EVRI_Id > 0 ";
if ( $caso != "" ){
	$condi_where_caso = " AND EVRI_Id = ".$caso ;
}

/* Si evento está vacio, seleccionamos todos */
$condi_where_evento = " AND EVRI_IdEvento > 0 ";
if ( $evento != "" ){
	$condi_where_evento = " AND EVRI_IdEvento = ".$evento ;
}

/* Si proceso está vacio, seleccionamos todos */
$condi_where_proceso = " AND EVRI_IdProceso > 0 ";
if ( $proceso != "" ){
	$condi_where_proceso = " AND EVRI_IdProceso = ".$proceso ;
}

/* Si responsable está vacio, seleccionamos todos */
$condi_where_responsable = " AND EVRI_IdResponsable > 0 ";
if ( $responsable != "" ){
	$condi_where_responsable = " AND EVRI_IdResponsable = ".$responsable ;
}

/* Si causas está vacio, seleccionamos todos */
$condi_join_causas =" JOIN ECAU_Causas ON ECAU_IdEventoRiesgo > 0 ";
////$condi_where_causas = " AND EVRI_IdResponsable > 0 ";
if ( $causas != "" ){
	$condi_join_causas =" JOIN ECAU_Causas ON ECAU_IdEventoRiesgo = EVRI_Id ";
	////$condi_where_causas = " AND EVRI_IdResponsable = ".$causas ;
}

$query_ev=sqlsrv_query($conn,"SELECT EVRI_Id, EVRI_IdEvento, MOV_FilaMRI, MOV_ColumnaMRI, EventosdeRiesgoName, ProcesosName, CargosName, ResponsablesName FROM EVRI_EventoRiesgo JOIN MOV_MatrizInherente ON MOV_IdEventoMRI = EVRI_Id AND MOV_CustomerKeyMRI = EVRI_CustomerKey JOIN EventosdeRiesgoSarlaft AS E ON E.id = EVRI_IdEvento JOIN ProcesosSarlaft AS P ON P.id = EVRI_IdProceso JOIN CargosSarlaft AS C ON C.CargosId = EVRI_IdCargo JOIN ResponsablesSarlaft AS R ON R.ResponsablesId = EVRI_IdResponsable WHERE EVRI_CustomerKey='$CustomerKey' $condi_where_caso ");

//echo "SELECT EVRI_Id, EVRI_IdEvento, MOV_FilaMRI, MOV_ColumnaMRI, EventosdeRiesgoName, ProcesosName, CargosName, ResponsablesName FROM EVRI_EventoRiesgo JOIN MOV_MatrizInherente ON MOV_IdEventoMRI = EVRI_Id AND MOV_CustomerKeyMRI = EVRI_CustomerKey JOIN EventosdeRiesgoSarlaft AS E ON E.id = EVRI_IdEvento JOIN ProcesosSarlaft AS P ON P.id = EVRI_IdProceso JOIN CargosSarlaft AS C ON C.CargosId = EVRI_IdCargo JOIN ResponsablesSarlaft AS R ON R.ResponsablesId = EVRI_IdResponsable WHERE EVRI_CustomerKey='$CustomerKey' $condi_where_caso ";


if( $query_ev === false) {
    die( print_r( sqlsrv_errors(), true) );
}
$respuesta="";
while($row = sqlsrv_fetch_array( $query_ev, SQLSRV_FETCH_ASSOC ) ){
	$EVRI_Id = $row["EVRI_Id"];
	$FilaMRI = $row["MOV_FilaMRI"];
	$ColumnaMRI = $row["MOV_ColumnaMRI"];
	$EventosdeRiesgoName = trim($row["EventosdeRiesgoName"]);
	$ProcesosName = trim($row["ProcesosName"]);
	$CargosName = trim($row["CargosName"]);
	$ResponsablesName = trim($row["ResponsablesName"]);

	$respuesta="<table style='width:100%'>
	<tr style='background-color:gray; color:black;'>
		<td> Caso $EVRI_Id</td>
	</tr>
	<tr>
		<td>Evento de Riesgo: $EventosdeRiesgoName</td>
	</tr>
	<tr>
		<td>Proceso: $ProcesosName</td>
	</tr>
	</tr>
	<tr>
		<td>Cargo: $CargosName</td>
	</tr>
	<tr>
		<td>Responsable: $ResponsablesName</td>
	</tr>
	<tr>
		<td>Riesgo Inherente: </td>
	</tr>
	<tr>
		<td>Riesgo Residual: </td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Causas:</td>
	</tr>";
	$CausasName="";
	$query_causas=sqlsrv_query($conn,"SELECT CausasName FROM ECAU_Causas JOIN CausasSarlaft C ON C.id = ECAU_IdCausa AND C.CustomerKey = '$CustomerKey' WHERE ECAU_IdEventoRiesgo = $EVRI_Id ");
	if( $query_causas === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowCausas = sqlsrv_fetch_array( $query_causas, SQLSRV_FETCH_ASSOC ) ){
		$CausasName = trim($rowCausas["CausasName"]);
		$respuesta.="<tr><td>$CausasName</td></tr>";
	}
	$respuesta.="	
	<tr>
		<td style='font-weight:bold'>Consecuencias:</td>
	</tr>";
	$ConsecuenciasName="";
	$query_consecuencias=sqlsrv_query($conn,"SELECT ConsecuenciasName FROM ECON_Consecuencias JOIN ConsecuenciasSarlaft C ON C.id = ECON_IdConsecuencia AND C.CustomerKey = '$CustomerKey' WHERE ECON_IdEventoRiesgo = $EVRI_Id ");
	if( $query_consecuencias === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowConsecuencias = sqlsrv_fetch_array( $query_consecuencias, SQLSRV_FETCH_ASSOC ) ){
		$ConsecuenciasName = trim($rowConsecuencias["ConsecuenciasName"]);
		$respuesta.="<tr><td>$ConsecuenciasName</td></tr>";
	}
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Controles:</td>
	</tr>";
	
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Tratamientos:</td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Tipo Riesgo:</td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Factor Riesgo:</td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Riesgo Asociado:</td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Debilidades:</td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Oportunidades:</td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Fortalezas:</td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Amenazas:</td>
	</tr>

	</table>";
	echo $respuesta;
}
?>
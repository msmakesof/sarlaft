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
$condi_where_caso = "";  //" AND EVRI_Id > 0 ";
// caso Todos
if ( $caso == "0" ){  
	$condi_where_caso = " AND EVRI_Id > 0" ;
}
if ( $caso > 0 ){
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
//$condi_join_causas =" JOIN ECAU_Causas ON ECAU_IdEventoRiesgo > 0 ";

$condi_join_causas =" JOIN ECAU_Causas ON ECAU_IdCausa > 0 ";
////$condi_where_causas = " AND EVRI_IdResponsable > 0 ";
if ( $causas != "" ){
	//$condi_join_causas =" JOIN ECAU_Causas ON ECAU_IdEventoRiesgo = EVRI_Id ";
	$condi_join_causas =" JOIN ECAU_Causas ON ECAU_IdCausa = $causas ";
	////$condi_where_causas = " AND EVRI_IdResponsable = ".$causas ;
}
if ( $caso != "" ){
	$condi_join_causas .= " AND ECAU_IdEventoRiesgo = ".$caso ;
}

//$query_ev=sqlsrv_query($conn,"SELECT EVRI_Id, EVRI_IdEvento, MOV_FilaMRI, MOV_ColumnaMRI, EventosdeRiesgoName, ProcesosName, CargosName, ResponsablesName FROM EVRI_EventoRiesgo JOIN MOV_MatrizInherente ON MOV_IdEventoMRI = EVRI_Id AND MOV_CustomerKeyMRI = EVRI_CustomerKey JOIN EventosdeRiesgoSarlaft AS E ON E.id = EVRI_IdEvento JOIN ProcesosSarlaft AS P ON P.id = EVRI_IdProceso JOIN CargosSarlaft AS C ON C.CargosId = EVRI_IdCargo JOIN ResponsablesSarlaft AS R ON R.ResponsablesId = EVRI_IdResponsable WHERE EVRI_CustomerKey='$CustomerKey' $condi_where_caso ORDER BY EVRI_Id ");

//echo "SELECT EVRI_Id, EVRI_IdEvento, MOV_FilaMRI, MOV_ColumnaMRI, EventosdeRiesgoName, ProcesosName, CargosName, ResponsablesName FROM EVRI_EventoRiesgo JOIN MOV_MatrizInherente ON MOV_IdEventoMRI = EVRI_Id AND MOV_CustomerKeyMRI = EVRI_CustomerKey JOIN EventosdeRiesgoSarlaft AS E ON E.id = EVRI_IdEvento JOIN ProcesosSarlaft AS P ON P.id = EVRI_IdProceso JOIN CargosSarlaft AS C ON C.CargosId = EVRI_IdCargo JOIN ResponsablesSarlaft AS R ON R.ResponsablesId = EVRI_IdResponsable WHERE EVRI_CustomerKey='$CustomerKey' $condi_where_caso  ORDER BY EVRI_Id ";

$query_ev=sqlsrv_query($conn,"SELECT EVRI_Id,EVRI_CustomerKey WHERE EVRI_CustomerKey='$CustomerKey' $condi_where_caso ORDER BY EVRI_Id ");

if( $query_ev === false) {
    die( print_r( sqlsrv_errors(), true) );
}
$respuesta="";
while($row = sqlsrv_fetch_array( $query_ev, SQLSRV_FETCH_ASSOC ) ){
	$EVRI_Id = $row["EVRI_Id"];
	$EVRI_CustomerKey = $row["EVRI_CustomerKey"];
	/*$FilaMRI = $row["MOV_FilaMRI"];
	$ColumnaMRI = $row["MOV_ColumnaMRI"];
	$EventosdeRiesgoName = trim($row["EventosdeRiesgoName"]);
	$ProcesosName = trim($row["ProcesosName"]);
	$CargosName = trim($row["CargosName"]);
	$ResponsablesName = trim($row["ResponsablesName"]);*/

	$respuesta="<table style='width:100%'>
	<tr style='background-color:gray; color:black;'>
		<td style='font-weight:bold'> Caso $EVRI_Id</td>
	</tr>";

	$EventosdeRiesgoName="";
	$_condiEventoRiesgo = "";
	if ( $evento != ""){
		$_condiEventoRiesgo = " AND E.id = $evento ";
	}
	$query_eventoriesgo=sqlsrv_query($conn,"SELECT E.EventosdeRiesgoName FROM EventosdeRiesgoSarlaft E WHERE E.CustomerKey = '$EVRI_CustomerKey'  $_condiEventoRiesgo ");
	if( $query_eventoriesgo === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowEventoriesgo = sqlsrv_fetch_array( $query_eventoriesgo, SQLSRV_FETCH_ASSOC ) ){
		$EventosdeRiesgoName = trim($rowEventoriesgo["EventosdeRiesgoName"]);
		$respuesta.="<tr><td>$EventosdeRiesgoName</td></tr>";
	}	
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Evento de Riesgo: $EventosdeRiesgoName</td>
	</tr>";	
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Proceso: $ProcesosName</td>
	</tr>";	
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Cargo: $CargosName</td>
	</tr>";	
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Responsable: $ResponsablesName</td>
	</tr>";	
	$respuesta.="	
	<tr>
		<td style='font-weight:bold'>Riesgo Inherente: </td>
	</tr>";	
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Riesgo Residual: </td>
	</tr>";	
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Causas:</td>
	</tr>";

	$CausasName="";
	$_condiCausa = "";
	if ( $causas != ""){
		$_condiCausa = " AND ECAU_IdCausa = $causas ";
	}
	$query_causas=sqlsrv_query($conn,"SELECT CausasName FROM ECAU_Causas JOIN CausasSarlaft C ON C.id = ECAU_IdCausa AND C.CustomerKey = '$CustomerKey' WHERE ECAU_IdEventoRiesgo = $EVRI_Id $_condiCausa ");
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
	$_condiConsecuencia = "";
	if ( $consecuencias != "" ){
		$_condiConsecuencia = " AND ECON_IdConsecuencia = $consecuencias ";
	}
	$query_consecuencias=sqlsrv_query($conn,"SELECT ConsecuenciasName FROM ECON_Consecuencias JOIN ConsecuenciasSarlaft C ON C.id = ECON_IdConsecuencia AND C.CustomerKey = '$CustomerKey' WHERE ECON_IdEventoRiesgo = $EVRI_Id $_condiConsecuencia ");
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

	$ControlesName="";
	$_condiControl = "";
	if ( $control != "" ){
		$_condiControl = " AND ECTR_IdControl = $control ";
	}
	$query_cntrol=sqlsrv_query($conn,"SELECT ControlesName FROM ECTR_Controles JOIN ControlesSarlaft CT ON CT.id = ECTR_IdControl AND CT.CustomerKey = '$CustomerKey' WHERE ECTR_IdEventoMRC = $EVRI_Id $_condiControl ");
	if( $query_cntrol === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowControl = sqlsrv_fetch_array( $query_cntrol, SQLSRV_FETCH_ASSOC ) ){
		$ControlesName = trim($rowControl["ControlesName"]);
		$respuesta.="<tr><td>$ControlesName</td></tr>";
	}
	
	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Tratamientos:</td>
	</tr>";
	$TratamientosName="";
	$_condiTratamiento = "";
	if ( $tratamiento != "" ){
		$_condiTratamiento = " AND ETRA_IdTratamiento = $tratamiento ";
	}
	$query_tratamiento=sqlsrv_query($conn,"SELECT TratamientosName FROM ETRA_Tratamientos JOIN TratamientosSarlaft TR ON TR.id = ETRA_IdTratamiento AND TR.CustomerKey = '$CustomerKey' WHERE ETRA_IdEventoRiesgo = $EVRI_Id $_condiTratamiento ");
	if( $query_tratamiento === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowTratamiento = sqlsrv_fetch_array( $query_tratamiento, SQLSRV_FETCH_ASSOC ) ){
		$TratamientosName = trim($rowTratamiento["TratamientosName"]);
		$respuesta.="<tr><td>$TratamientosName</td></tr>";
	}

	/* $respuesta.="
	<tr>
		<td style='font-weight:bold'>Tipo Riesgo:</td>
	</tr>";
	$TIR_Nombre="";
	$_condiTipoRiesgo = "";
	if ( $tratamiento != "" ){
		$_condiTipoRiesgo = " AND ETRA_IdTratamiento = $TIR_Nombre ";
	}
	$query_tratamiento=sqlsrv_query($conn,"SELECT TIR_Nombre FROM ETRA_Tratamientos JOIN TratamientosSarlaft TR ON TR.id = ETRA_IdTratamiento AND TR.CustomerKey = '$CustomerKey' WHERE ETRA_IdEventoRiesgo = $EVRI_Id $_condiTipoRiesgo ");
	if( $query_tratamiento === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowTratamiento = sqlsrv_fetch_array( $query_tratamiento, SQLSRV_FETCH_ASSOC ) ){
		$TIR_Nombre = trim($rowTratamiento["TIR_Nombre"]);
		$respuesta.="<tr><td>$TIR_Nombre</td></tr>";
	}  */

	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Segmentación Clientes:</td>
	</tr>";
	/*
	$segclientes="";
	$_condisegcliente = "";
	if ( $segclientes != "" ){
		$_condisegcliente = " AND ETRA_IdTratamiento = $segclientes ";
	}
	$query_segclientes=sqlsrv_query($conn,"SELECT SegClientesName FROM ETRA_Tratamientos JOIN TratamientosSarlaft TR ON TR.id = ETRA_IdTratamiento AND TR.CustomerKey = '$CustomerKey' WHERE ETRA_IdEventoRiesgo = $EVRI_Id $_condiTipoRiesgo ");
	if( $query_segclientes === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowsegclientes = sqlsrv_fetch_array( $query_segclientes, SQLSRV_FETCH_ASSOC ) ){
		$SegClientesName = trim($rowsegclientes["SegClientesName"]);
		$respuesta.="<tr><td>$SegClientesName</td></tr>";
	}*/

	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Factor Riesgo:</td>
	</tr>
	<tr>
		<td style='font-weight:bold'>Riesgo Asociado:</td>
	</tr>";

	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Debilidades:</td>
	</tr>";
	$DebilidadesName="";
	$_condiDebilidades = "";
	if ( $debilidades != "" ){
		$_condiDebilidades = " AND EDEB_IdDebilidad = $debilidades ";
	}
	$query_debilidad=sqlsrv_query($conn,"SELECT DebilidadesName FROM EDEB_Debilidades JOIN DebilidadesSarlaft DE ON DE.id = EDEB_IdDebilidad AND DE.CustomerKey = '$CustomerKey' WHERE EDEB_IdEventoRiesgo = $EVRI_Id $_condiDebilidades ");
	if( $query_debilidad === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowDebilidades = sqlsrv_fetch_array( $query_debilidad, SQLSRV_FETCH_ASSOC ) ){
		$DebilidadesName = trim($rowDebilidades["DebilidadesName"]);
		$respuesta.="<tr><td>$DebilidadesName</td></tr>";
	}

	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Oportunidades:</td>
	</tr>";
	$OportunidadesName="";
	$_condiOportunidades = "";
	if ( $oportunidades != "" ){
		$_condiOportunidades = " AND EOPO_IdOportunidad = $oportunidades ";
	}
	$query_oportunidad=sqlsrv_query($conn,"SELECT OportunidadesName FROM EOPO_Oportunidades JOIN OportunidadesSarlaft O ON O.id = EOPO_IdOportunidad AND O.CustomerKey = '$CustomerKey' WHERE EOPO_IdEventoRiesgo = $EVRI_Id $_condiOportunidades ");
	if( $query_oportunidad === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowOportunidades = sqlsrv_fetch_array( $query_oportunidad, SQLSRV_FETCH_ASSOC ) ){
		$OportunidadesName = trim($rowOportunidades["OportunidadesName"]);
		$respuesta.="<tr><td>$OportunidadesName</td></tr>";
	}

	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Fortalezas:</td>
	</tr>";
	$FortalezasName="";
	$_condiFortalezas = "";
	if ( $fortalezas != "" ){
		$_condiFortalezas = " AND EFOR_IdFortaleza = $fortalezas ";
	}
	$query_fortaleza=sqlsrv_query($conn,"SELECT FortalezasName FROM EFOR_Fortalezas JOIN FortalezasSarlaft F ON F.id = EFOR_IdFortaleza AND F.CustomerKey = '$CustomerKey' WHERE EFOR_IdEventoRiesgo = $EVRI_Id $_condiFortalezas ");
	if( $query_fortaleza === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowFortalezas = sqlsrv_fetch_array( $query_fortaleza, SQLSRV_FETCH_ASSOC ) ){
		$FortalezasName = trim($rowFortalezas["FortalezasName"]);
		$respuesta.="<tr><td>$FortalezasName</td></tr>";
	}

	$respuesta.="
	<tr>
		<td style='font-weight:bold'>Amenazas:</td>
	</tr>";
	$AmenazasName="";
	$_condiAmenazas = "";
	if ( $amenazas != "" ){
		$_condiAmenazas = " AND EFOR_IdFortaleza = $amenazas ";
	}
	$query_amenaza=sqlsrv_query($conn,"SELECT AmenazasName FROM EAME_Amenazas JOIN AmenazasSarlaft A ON A.id = EAME_IdAmenaza AND A.CustomerKey = '$CustomerKey' WHERE EAME_IdEventoRiesgo = $EVRI_Id $_condiAmenazas ");
	if( $query_amenaza === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	while($rowAmenazas = sqlsrv_fetch_array( $query_amenaza, SQLSRV_FETCH_ASSOC ) ){
		$AmenazasName = trim($rowAmenazas["AmenazasName"]);
		$respuesta.="<tr><td>$AmenazasName</td></tr>";
	}

	$respuesta.="</table>";
	echo $respuesta;
}
?>
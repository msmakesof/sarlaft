<?php
include '../../ajax/is_logged.php';
$CustomerKey = $_SESSION['Keyp'];
$ck = $_POST['ck'];
$id = $_POST['id'];  // NumControl
$er = $_POST['er'];  // Evento de Riesgo
include_once '../../config/dbx.php';   

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($ck);
//$sqlmov="DELETE FROM ECTR_Controles WHERE ECTR_NumControl=$id AND ECTR_IdEventoMRC = $er ;";
$sqlmov="UPDATE ECTR_Controles SET ECTR_IdRealizado = 'N' WHERE ECTR_NumControl=$id AND ECTR_IdEventoMRC = $er ;";

//$sqlmov.="DELETE FROM MOV_MatrizControl WHERE MOV_IdMovimientoMRC = $id AND MOV_CustomerKeyMRC ='$ck' ;";
$sqlmov.="UPDATE MOV_MatrizControl SET MOV_Estado = 'D' WHERE MOV_IdMovimientoMRC = $id AND MOV_CustomerKeyMRC ='$ck' ;";
//echo $sqlmov;
$query = sqlsrv_query($conn,$sqlmov);
if ($query){
	// ingresa registro en el log de Auditoria
	date_default_timezone_set("America/Bogota");
	$DateStamp=date("Y-m-d H:i:s");
	$cadena = str_replace("'",'"',$sqlmov);
	$MAC = '';
	ob_start();
	system('ipconfig/all');
	$mycom=ob_get_contents(); 
	ob_clean(); 
	$findme = "Physical";
	$pmac = strpos($mycom, $findme); 
	$MAC=substr($mycom,($pmac+36),17);
	$sqllog="INSERT INTO LOG_LogAuditoria (LOG_CustomerKey, LOG_UserKey, LOG_Accion, LOG_Descripcion, LOG_IpAddress, LOG_Module, LOG_DateStamp) VALUES ('$CustomerKey','$UserKey','Borrar Control', '$cadena','$MAC','Evento de Riesgo','$DateStamp') ";
	$query = sqlsrv_query($conn,$sqllog);
	
	// Recalcular ubicación de la bolita para cada registro de la matriz de Control
	$query = sqlsrv_query($conn,"SELECT MOV_IdMovimientoMRC, MOV_FilaMRC, MOV_ColumnaMRC FROM MOV_MatrizControl WHERE MOV_IdEventoMRC = $er AND MOV_Estado <> 'D' ");
	{
		if ( $query === false)
		{
			die(print_r(sqlsrv_errors(), true));
		}						
		while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
			$id=$row['MOV_IdMovimientoMRC'];
			$FilaMRC=trim($row['MOV_FilaMRC']);
			$ColumnaMRC=trim($row['MOV_ColumnaMRC']);
			////echo "<br>0]   $id.... Fila: $FilaMRC     Columna:   $ColumnaMRC<br>";
			////  AND MOV_IdMovimientoMRC = $id 
			$queryint = sqlsrv_query($conn,"SELECT MOV_IdMovimientoMRC, MOV_FilsMovidas, MOV_ColsMovidas, MOV_PosicionesAMover, MOV_FilaMRC, MOV_ColumnaMRC FROM MOV_MatrizControl WHERE MOV_IdMovimientoMRC = $id AND MOV_Estado ='G' ORDER BY MOV_IdMovimientoMRC ");
			{
				if ( $queryint === false)
				{
					die(print_r(sqlsrv_errors(), true));
				}						
				while( $rowint = sqlsrv_fetch_array( $queryint, SQLSRV_FETCH_ASSOC) ) {
					$idint=$rowint['MOV_IdMovimientoMRC'];
					$FilsMovidas=$rowint['MOV_FilsMovidas'];
					$ColsMovidas=$rowint['MOV_ColsMovidas'];
					$PosicionesAMover=$rowint['MOV_PosicionesAMover'];
					$NewFilaMRC=trim($rowint['MOV_FilaMRC']);
					$NewColumnaMRC=trim($rowint['MOV_ColumnaMRC']);
					////$NEWFILA = $rowint['MOV_FilaMRC']; //echo "<br>NEWFILA....$NEWFILA<br>";
					
					//$nuevaFils = $FilaMRC;  //$nuevaCols = $ColumnaMRC; //echo "<br>1]   nuevaFils....$nuevaFils      nuevaCols....$nuevaCols <br>";

					$nuevaFils = $NewFilaMRC;
					$nuevaCols = $NewColumnaMRC;

					if( $FilsMovidas > 0 ){
						$nuevaFils = $NewFilaMRC + $PosicionesAMover;
					}

					if( $ColsMovidas > 0 ){
						$nuevaCols = $NewColumnaMRC + $PosicionesAMover;
					}

					//echo "<br>2]   $id...NuevaFila:  $nuevaFils      NuevaColumna:   $nuevaCols<br>";
					$sqlmov ="UPDATE MOV_MatrizControl SET MOV_FilaMRC = $nuevaFils, MOV_ColumnaMRC = $nuevaCols WHERE MOV_IdMovimientoMRC = $idint AND MOV_CustomerKeyMRC ='$ck' ;";
					//echo $sqlmov;
					$query = sqlsrv_query($conn,$sqlmov);
					break ;
				}
			}
		}
	}
	echo "S";
}
else{
	echo "N";
}
?>
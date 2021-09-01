<?php
    if(isset($_POST['ck']) && $_POST['ck'] != ""){
        $ck= trim($_POST['ck']);
    }
    if(isset($_POST['er']) && $_POST['er'] != ""){
        $er= trim($_POST['er']);
    }
    if(isset($_POST['nc']) && $_POST['nc'] != ""){
        $nc= trim($_POST['nc']);   
    }
    include_once '../../config/dbx.php';   

    $getConnectionCli2 = new Database();
	$conn = $getConnectionCli2->getConnectionCli2($ck);

    $sqlmov="INSERT INTO ETRA_Tratamientos (ETRA_IdEventoRiesgo, ETRA_NumTratamiento) VALUES (".$er.",".$nc."); SELECT SCOPE_IDENTITY() as LastId; ";
	//echo "upd.........$sqlmov<br>";
	$query = sqlsrv_query($conn,$sqlmov);
    $next_result = sqlsrv_next_result($query);
    $row = sqlsrv_fetch_array($query); 
    $LastId = $row['LastId'];
	
	 $sqlmov="UPDATE ETRA_Tratamientos SET ETRA_NumTratamiento = ".$LastId." WHERE ETRA_IdEventoRiesgo =". $er. " AND ETRA_NumTratamiento=".$nc;
    $query = sqlsrv_query($conn,$sqlmov);
	echo $LastId;
?>
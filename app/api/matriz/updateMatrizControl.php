<?php
    if(isset($_POST['ck']) && $_POST['ck'] != ""){
        $ck= $_POST['ck'];
    }
    if(isset($_POST['er']) && $_POST['er'] != ""){
        $er= $_POST['er'];
    }
    if(isset($_POST['nc']) && $_POST['nc'] != ""){
        $nc= $_POST['nc'];   
    }
    include_once '../../config/dbx.php';   

    $getConnectionCli2 = new Database();
	$conn = $getConnectionCli2->getConnectionCli2($ck);

    date_default_timezone_set("America/Bogota");
	$DateStamp=date("Y-m-d H:i:s");	

    ////$sqlmov="UPDATE MOV_MatrizControl SET MOV_NumControl = ".$nc." WHERE MOV_CustomerKeyMRC='".$ck."' AND MOV_IdEventoMRC = ".$er ;
    $sqlmov="INSERT INTO MOV_MatrizControl (MOV_IdEventoMRC, MOV_CustomerKeyMRC, MOV_DateStampMRC, MOV_TieneControlMRC, MOV_NumControl) VALUES (".$er.",'".$ck."','".$DateStam."','S',".$nc.") ";
	//echo "upd.........$sqlmov<br>";
	$query = sqlsrv_query($conn,$sqlmov);
   
?>
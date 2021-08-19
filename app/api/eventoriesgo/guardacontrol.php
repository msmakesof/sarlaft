<?php
if(isset($_POST['ck']) && $_POST['ck'] != ""){
    $ck= $_POST['ck'];
}
if(isset($_POST['uk']) && $_POST['uk'] != ""){
    $uk= $_POST['uk'];
}
if(isset($_POST['prop']) && $_POST['prop'] != ""){
    $prop= $_POST['prop'];
}
if(isset($_POST['ejec']) && $_POST['ejec'] != ""){
    $ejec= $_POST['ejec'];
}
if(isset($_POST['efec']) && $_POST['efec'] != ""){
    $efec= $_POST['efec'];
}
if(isset($_POST['frec']) && $_POST['frec'] != ""){
    $frec= $_POST['frec'];
}
if(isset($_POST['er']) && $_POST['er'] != ""){
    $er= $_POST['er'];
}
if(isset($_POST['nrocontrol']) && $_POST['nrocontrol'] != ""){
    $nrocontrol= $_POST['nrocontrol'];
}

include_once '../../config/dbx.php';   

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($ck);

$sqlmov="UPDATE ECTR_Controles SET ECTR_IdPropietario=".$prop.", ECTR_IdEjecutor=".$ejec.", ECTR_IdEfectividad=".$efec.", ECTR_IdFrecuencia=".$frec.", ECTR_UserKey ='".$uk."' WHERE ECTR_CustomerKey ='".$ck."' AND ECTR_IdEventoMRC =".$er." AND ECTR_NumControl=".$nrocontrol;
$query = sqlsrv_query($conn,$sqlmov);
?>
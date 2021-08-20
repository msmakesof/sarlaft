<?php
if(isset($_POST['ck']) && $_POST['ck'] != ""){
    $ck= trim($_POST['ck']);
}
if(isset($_POST['trata']) && $_POST['trata'] != ""){
    $trata= trim($_POST['trata']);
}
else { $trata= NULL; }
if(isset($_POST['status']) && $_POST['status'] != ""){
    $status= trim($_POST['status']);
}
else { $status= NULL; }
if(isset($_POST['priori']) && $_POST['priori'] != ""){
    $priori= trim($_POST['priori']);
}
else { $priori= NULL; }
if(isset($_POST['fecini']) && $_POST['fecini'] != ""){
    $fecini= trim($_POST['fecini']);
}
else { $fecini= NULL; }
if(isset($_POST['fecfin']) && $_POST['fecfin'] != ""){
    $fecfin = trim($_POST['fecfin']);
}
else { $fecfin= NULL; }
if(isset($_POST['fecseg']) && $_POST['fecseg'] != ""){
    $fecseg= trim($_POST['fecseg']);
}
else { $fecseg = NULL; }
if(isset($_POST['planes']) && $_POST['planes'] != ""){
    $planes= trim($_POST['planes']);
}
else { $planes= NULL; }
if(isset($_POST['er']) && $_POST['er'] != ""){
    $er= trim($_POST['er']);
}
if(isset($_POST['nrocontrol']) && $_POST['nrocontrol'] != ""){
    $nrocontrol= $_POST['nrocontrol'];
}

include_once '../../config/dbx.php';   

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($ck);

$sqlmov="UPDATE ETRA_Tratamientos SET ETRA_IdTratamiento =".$trata.", ETRA_Status=".$status.", ETRA_Prioridad=".$priori.", ETRA_FechaInicio='".$fecini."', ETRA_FechaFinal='".$fecfin."', ETRA_FechaSeguimiento ='".$fecseg."', ETRA_IdPlan=".$planes." WHERE ETRA_Id ='".$nrocontrol."' AND ETRA_IdEventoRiesgo =".$er." AND ETRA_NumTratamiento=".$nrocontrol;
echo "upd...$sqlmov<br>";
$query = sqlsrv_query($conn,$sqlmov);
?>
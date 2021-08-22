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
else{$prop="";}
if(isset($_POST['ejec']) && $_POST['ejec'] != ""){
    $ejec= $_POST['ejec'];
}
else{$ejec="";}
if(isset($_POST['efec']) && $_POST['efec'] != ""){
    $efec= $_POST['efec'];
}
else{$efec="";}
if(isset($_POST['frec']) && $_POST['frec'] != ""){
    $frec= $_POST['frec'];
}
else{$frec="";}
if(isset($_POST['rea']) && $_POST['rea'] != ""){
    $rea= $_POST['rea'];
}
else{$rea="";}
if(isset($_POST['cat']) && $_POST['cat'] != ""){
    $cat= $_POST['cat'];
}
else{$cat="";}
if(isset($_POST['doc']) && $_POST['doc'] != ""){
    $doc= $_POST['doc'];
}
else{$doc="";}
if(isset($_POST['apl']) && $_POST['apl'] != ""){
    $apl= $_POST['apl'];
}
else{$apl="";}
if(isset($_POST['efe']) && $_POST['efe'] != ""){
    $efe= $_POST['efe'];
}
else{$efe="";}
if(isset($_POST['eva']) && $_POST['eva'] != ""){
    $eva= $_POST['eva'];
}
else{$eva="";}
if(isset($_POST['control']) && $_POST['control'] != ""){
    $control= $_POST['control'];
}
else{$control="";}

if(isset($_POST['er']) && $_POST['er'] != ""){
    $er= $_POST['er'];
}
if(isset($_POST['nrocontrol']) && $_POST['nrocontrol'] != ""){
    $nrocontrol= $_POST['nrocontrol'];
}

include_once '../../config/dbx.php';   

$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($ck);

$sqlmov="UPDATE ECTR_Controles SET ECTR_IdPropietario=".$prop.", ECTR_IdEjecutor=".$ejec.", ECTR_IdEfectividad=".$efec.", ECTR_IdFrecuencia=".$frec.", ECTR_UserKey ='".$uk."', ECTR_IdCategoria='".$cat."', ECTR_IdRealizado='".$rea."', ECTR_IdDocumentado=".$doc.", ECTR_IdAplicado=".$apl.", ECTR_IdEfectivo=".$efe.", ECTR_IdEvaluado=".$eva.", ECTR_IdControl=".$control." WHERE ECTR_CustomerKey ='".$ck."' AND ECTR_IdEventoMRC =".$er." AND ECTR_NumControl=".$nrocontrol;
$query = sqlsrv_query($conn,$sqlmov);
if($query){
    echo "S";
}
else{
    echo "N";
} ////$sqlmov;
?>
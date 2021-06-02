<?php
include ('is_logged.php');
if (empty($_GET['id'])) { $id="";} else { $id = strtolower($_GET["id"]);}
if (empty($_GET['EControl'])) { $EControl="";} else { $EControl = strtolower($_GET["EControl"]);}
if($EControl != NULL){
    $sql = "DELETE FROM  EControlSarlaft WHERE id='$id'";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Escalasetup";
</SCRIPT>';
    } 
}
?>
<?php
if (empty($_GET['id'])) { $id="";} else { $id = strtolower($_GET["id"]);}
if (empty($_GET['EProbabilidad'])) { $EProbabilidad="";} else { $EProbabilidad = strtolower($_GET["EProbabilidad"]);}
if($EProbabilidad != NULL){
    $sql = "DELETE FROM  EProbabilidadSarlaft WHERE id='$id'";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Escalasetup";
</SCRIPT>';
    } 
}
?>
<?php
if (empty($_GET['id'])) { $id="";} else { $id = strtolower($_GET["id"]);}
if (empty($_GET['ERiesgos'])) { $ERiesgos="";} else { $ERiesgos = strtolower($_GET["ERiesgos"]);}
if($ERiesgos != NULL){
    $sql = "DELETE FROM  ERiesgosSarlaft WHERE id='$id'";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Escalasetup";
</SCRIPT>';
    } 
}
?>
<?php
if (empty($_GET['id'])) { $id="";} else { $id = strtolower($_GET["id"]);}
if (empty($_GET['ENiveldeRiesgo'])) { $ENiveldeRiesgo="";} else { $ENiveldeRiesgo = strtolower($_GET["ENiveldeRiesgo"]);}
if($ENiveldeRiesgo != NULL){
    $sql = "DELETE FROM  ENiveldeRiesgoSarlaft WHERE id='$id'";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Escalasetup";
</SCRIPT>';
    } 
}
?>
<?php
if (empty($_GET['id'])) { $id="";} else { $id = strtolower($_GET["id"]);}
if (empty($_GET['EEfectividad'])) { $EEfectividad="";} else { $EEfectividad = strtolower($_GET["EEfectividad"]);}
if($EEfectividad != NULL){
    $sql = "DELETE FROM  EEfectividadSarlaft WHERE id='$id'";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Escalasetup";
</SCRIPT>';
    } 
}
?>
<?php
if (empty($_GET['id'])) { $id="";} else { $id = strtolower($_GET["id"]);}
if (empty($_GET['ECategoria'])) { $ECategoria="";} else { $ECategoria = strtolower($_GET["ECategoria"]);}
if($ECategoria != NULL){
    $sql = "DELETE FROM  ECategoriaSarlaft WHERE id='$id'";
    $query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Escalasetup";
</SCRIPT>';
    } 
}
?>
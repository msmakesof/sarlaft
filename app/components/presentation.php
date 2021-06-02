 <?php include 'components/sql_server.php';?>
<?php include 'ajax/is_logged.php';?>
<?php
$query_empresa=sqlsrv_query($conn,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
$query=sqlsrv_query($conn,"SELECT * FROM GestiondeRiesgoSarlaft WHERE EventosdeRiesgoKey=".$_GET['ERK']."");
$rows=sqlsrv_fetch_array($query);
$queryF=sqlsrv_query($conn,"SELECT VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE EventosdeRiesgoKey=".$_GET['ERK']."");
$regF=sqlsrv_fetch_array($queryF);
?>
<!DOCTYPE html>
<html lang="es">

<style type="text/css">
headers {
  background: #FBFBFC;
  width: 100%;
  position: fixed;
  z-index: 100;
}
</style>
<?php include 'components/header.php';?>
<?php include 'components/ajaxform.php';?>
<body id="page-top">
                            <?php $query = sqlsrv_query($conn,"SELECT VariableTipo ,VariableName ,VariableObservacion FROM GestiondeRiesgoPSarlaft WHERE EventosdeRiesgoKey=".$_GET['ERK'].""); while($roww = sqlsrv_fetch_array($query)){  ?>
                                <tr><td colspan="8" align="left"><?php echo $regF['VariableName'] ;?></td><td colspan="2"><a href="#deleteVariable" class="delete" data-toggle="modal" data-id="<?php echo $id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a></td></tr>
                            <?php } ?>
</body>
</html>
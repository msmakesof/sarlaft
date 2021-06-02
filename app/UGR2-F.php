<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
$query_empresa=sqlsrv_query($con,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
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

<headers>
   <?php include 'components/topbarugr.php';?>
   <?php include 'components/DB-Evento_RiesgoF.php';?> 
</headers>

    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" style="padding-top: 250px;">
          
    <?php include 'components/DB-Factores_RiesgoF.php';?>
    <?php include 'components/DB-Cuadros_Calor1F.php';?> 
    
    <?php include 'components/DB-Detalle_RiesgoF.php';?>

            </div>
        </div>
    </div>                       

    <?php include 'components/footer.php';?>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <?php include 'components/settings.php';?>
    
</body>
</html>

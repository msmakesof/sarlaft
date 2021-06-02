<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
$query_empresa=sqlsrv_query($con,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
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
<form method="post" id="formulario">              
<headers>
   <?php include 'components/topbarugr.php';?>
   <?php include 'components/DB-Evento_Riesgo.php';?> 
</headers>

    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" style="padding-top: 210px;">
    <?php include 'components/DB-Factores_Riesgo.php';?>
    <?php include 'components/DB-Cuadros_Calor1.php';?>

            </div>
        </div>
    </div>                       

    <?php include 'components/footer.php';?>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <?php include 'components/settings.php';?>
</form>
</body>
</html>

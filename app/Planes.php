<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
$query_empresa=sqlsrv_query($con,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
?>

<!DOCTYPE html>
<html lang="es">

<?php include 'components/header.php';?>
<body id="page-top">
  <div role="dialog" tabindex="-1" class="modal fade" id="modal-avisolegal" style="max-width:650px;margin-right:auto;margin-left:auto;">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
     </div>
   </div>
</div>
    <div id="wrapper">

        <?php include 'components/menu_setting.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'components/topbar.php';?>

                <?php include 'components/content_planes.php';?>
            </div>
                <?php include 'components/footer.php';?>
        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

                <?php include 'components/settings.php';?>
</body>
</html>

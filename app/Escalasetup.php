<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
$query_empresa=sqlsrv_query($con,"SELECT UserColor, id FROM UsersAuth WHERE UserKey=".$_SESSION['UserKey']."");
$reg=sqlsrv_fetch_array($query_empresa);
?>
<!DOCTYPE html>
<html lang="es">

<?php include 'components/header.php';?>
<body id="page-top">
    <div id="wrapper">

        <?php include 'components/menu.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'components/topbarppal.php';?>

                <?php include 'components/content_escalas_setup.php';?>
            </div>
                <?php include 'components/footer.php';?>
        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

                <?php include 'components/settings.php';?>
</body>
</html>
<?php include 'ajax/delete_escalas_setup.php';?>
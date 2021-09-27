<?php include 'ajax/is_logged.php';
$UserKey=$_SESSION['UserKey'];
$CustomerKey = trim($_SESSION['Keyp']);

require_once 'config/dbx.php';
$getConnectionSL = new Database();
$con = $getConnectionSL->getConnectionSL($_SESSION['Keyp']);

$query_empresa=sqlsrv_query($con,"SELECT CustomerName, CustomerLogo, CustomerColor FROM CustomerSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."");
$reg=sqlsrv_fetch_array($query_empresa);
include 'acceso.php';
$consultar=0;
$crear =0;
$modificar=0;
$eliminar=0;
$exportar=0;

if( $qry === false) {
    die( print_r( sqlsrv_errors(), true) );
}
while($row = sqlsrv_fetch_array( $qry, SQLSRV_FETCH_ASSOC ) ){
	$OPC_Nombre = trim($row['OPC_Nombre']);
	
	if( $OPC_Nombre == "PROBABILIDAD" ){
		$ACC_Nombre = trim($row['ACC_Nombre']);
		if($ACC_Nombre == "CONSULTAR"){ $consultar=1 ;}
		if($ACC_Nombre == "CREAR"){ $crear=1 ;}
		if($ACC_Nombre == "MODIFICAR"){ $modificar=1 ;}
		if($ACC_Nombre == "ELIMINAR"){ $eliminar=1 ;}
		if($ACC_Nombre == "EXPORTAR"){ $exportar=1 ;}
	}
}
?>
<!DOCTYPE html>
<html lang="es">

<?php include 'components/header.php';?>
<body id="page-top">
    <div id="wrapper">

        <?php include 'components/menu_setting.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'components/topbar.php';?>

                <?php include 'components/content_setting.php';?>

                <?php include 'components/probabilidad/content.php';?>
            </div>
                <?php include 'components/footer.php';?>
        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <?php include 'components/settings.php';?>
</body>
</html>

<?php include 'ajax/is_logged.php';?>
<?php //require_once 'components/sql_server_login.php';?>
<?php
//echo $_POST['id'];
// mks 20210516  verificar cUrl
include 'curl/usuario/queryUserKey.php';
//echo "info...$info<br>";

$id= trim($data['id']);
$UserKey = trim($data['UserKey']);
$UserColor =  trim($data['UserColor']);
//echo "uk....$UserKey";
////$query_empresa=sqlsrv_query($con,"SELECT UserColor, id FROM UsersAuth WHERE UserKey=".$_SESSION['UserKey']."");
////$reg=sqlsrv_fetch_array($query_empresa);
$reg['id'] = $id;
$reg['UserColor'] = $UserColor;
?>
<?php
    if (empty($_GET['Keyp'])) { $Keyp="";} else { $Keyp = strtolower($_GET["Keyp"]);}
    if($Keyp!=NULL){
        $_SESSION["Keyp"] = $Keyp;
        header("location: ./setting.php");
    }
?>
<!DOCTYPE html>
<html lang="es">

<?php include 'components/header.php';?>
<body id="page-top">
    <div role="dialog" tabindex="-1" class="modal fade" id="modal-avisolegal" >
        <div class="modal-dialog" role="document">
            <div class="modal-content"></div>
        </div>
    </div>
    <div id="wrapper">

        <?php include 'components/menu.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'components/topbarppal.php';?>

                <?php include 'components/privilegio/PrivilegioC.php';?>
            </div>
            <?php include 'components/footer.php';?>
        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <?php include 'components/settings.php';?>
</body>
</html>
<?php
if (empty($_GET['st'])) { $st="0";} else { $st = strtolower($_GET["st"]);}
if (empty($_GET['id'])) { $id="";} else { $id = strtolower($_GET["id"]);}
if($st != NULL){
    //echo "get id...".$_POST['id']."<br>";
    //echo "st...$st<br>";
    if( isset($_GET['id']) && $_GET['id'] != "" ){   // 20210524 mks
        $st = $st;
        $id = $_GET['id'];
        include 'curl/usuario/queryUpdStatus.php';
        //$sql = "UPDATE UsersAuth SET UserStatus =".$st." WHERE id=".$_GET['id']."";
        //$query = sqlsrv_query($con,$sql);

        // if product has been added successfully
        if ($query) {
            echo'<SCRIPT LANGUAGE="javascript">
                location.href = "./Users.php";
            </SCRIPT>';
        }
    }
}
?>
<?php
if (empty($_GET['db'])) { $db=""; } else { $db = strtolower($_GET["db"]); }
if (empty($_GET['clr'])) { $clr=""; } else { $clr = strtolower($_GET["clr"]); }
if($db != NULL){
    include 'curl/usuario/queryUpdColor.php';
    //$sql = "UPDATE UsersAuth SET UserColor ='#".$clr."' WHERE UserKey=".$_SESSION['UserKey']."";
    //$query = sqlsrv_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        echo'<SCRIPT LANGUAGE="javascript">
            location.href = "./Users.php";
        </SCRIPT>';
    } 
}
?>
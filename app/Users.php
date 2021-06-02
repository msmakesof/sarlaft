<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server_login.php';?>
<?php
$query_empresa=sqlsrv_query($con,"SELECT UserColor, id FROM UsersAuth WHERE UserKey=".$_SESSION['UserKey']."");
$reg=sqlsrv_fetch_array($query_empresa);
?>
    <?php
        if (empty($_GET['Keyp'])) { $Keyp="";} else { $Keyp = strtolower($_GET["Keyp"]);}
        if($Keyp!=NULL){
          $_SESSION["Keyp"] = $Keyp;
          header("location: ./setting");
          }
    ?>
<!DOCTYPE html>
<html lang="es">

<?php include 'components/header.php';?>
<body id="page-top">
  <div role="dialog" tabindex="-1" class="modal fade" id="modal-avisolegal" >
   <div class="modal-dialog" role="document">
     <div class="modal-content">
     </div>
   </div>
</div>
    <div id="wrapper">

        <?php include 'components/menu.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'components/topbarppal.php';?>

                <?php include 'components/content_users.php';?>
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
    $sql = "UPDATE UsersAuth SET UserStatus =".$st." WHERE id=".$_GET['id']."";
    $query = sqlsrv_query($con,$sql);
    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Users.php";
</SCRIPT>';
    } 
}
?>
<?php
if (empty($_GET['db'])) { $db="";} else { $db = strtolower($_GET["db"]);}
if (empty($_GET['clr'])) { $clr="";} else { $clr = strtolower($_GET["clr"]);}
if($db != NULL){
    $sql = "UPDATE UsersAuth SET UserColor ='#".$clr."' WHERE UserKey=".$_SESSION['UserKey']."";
    $query = sqlsrv_query($con,$sql);
    // if product has been added successfully
    if ($query) {
                echo'<SCRIPT LANGUAGE="javascript">
location.href = "./Users.php";
</SCRIPT>';
    } 
}
?>
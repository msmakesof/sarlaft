<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server_login.php';?>
<?php

// mks 20210516  verificar cUrl
include 'curl/cliente/consulta.php';
//echo "info...$info<br>";
//echo $_SESSION['UserKey'];

$query_empresa=sqlsrv_query($con,"SELECT UserColor, id FROM UsersAuth WHERE UserKey=".$_SESSION['UserKey']."");
$reg=sqlsrv_fetch_array($query_empresa);

//echo "keyp.....".$_GET['Keyp']."<br>";
//echo "Keypugr.....".$_GET['Keypugr']."<br>";
//echo "Keyps.....".$_GET['Keyps']."<br>";
?>
    <?php
        if (empty($_GET['Keyp'])) { $Keyp="";} else { $Keyp = strtolower($_GET["Keyp"]);}
        if($Keyp!=NULL){
          $_SESSION["Keyp"] = $Keyp;
          header("location: ./Setting.php");
          }
    ?>
    <?php
        if (empty($_GET['Keypugr'])) { $Keyp="";} else { $Keyp = strtolower($_GET["Keypugr"]);}
        if($Keyp!=NULL){
          $_SESSION["Keyp"] = $Keyp;
          header("location: ./UGR.php");
          }
    ?> 
    <?php
        if (empty($_GET['Keyps'])) { $Keyps="";} else { $Keyps = strtolower($_GET["Keyps"]);}
        if($Keyps!=NULL){
          $query=sqlsrv_query($con,"SELECT CustomerDB FROM CustomerSarlaft ORDER BY id DESC");
          $regs=sqlsrv_fetch_array($query);
          $Keyps2 = $regs['CustomerDB'];         
          $_SESSION["Keyp"] = $Keyps2;
          header("location: ./valida.php");
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

                <?php include 'components/content_clientes.php';?>
            </div>
                <?php include 'components/footer.php';?>
        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

                <?php include 'components/settings.php';?>
</body>
</html>
<?php
if (empty($_GET['db'])) { $db="";} else { $db = strtolower($_GET["db"]);}
if (empty($_GET['clr'])) { $clr="";} else { $clr = strtolower($_GET["clr"]);}
//echo "db......$db<br>";
//echo "clr......$clr<br>";
if($db != NULL){
    $sql = "UPDATE UsersAuth SET UserColor ='#".$clr."' WHERE UserKey=".$_SESSION['UserKey']." ";
    $query = sqlsrv_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        echo'<SCRIPT LANGUAGE="javascript">
            location.href = "./Clientes.php";
        </SCRIPT>';
    } 
}
?>

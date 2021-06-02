 <?php
include('is_logged.php');
require_once ("../components/sql_server.php");


if (empty($_POST['ECategoriaName'])) { $ECategoriaName="";} else { $ECategoriaName = strtolower($_POST["ECategoriaName"]);}
if (empty($_POST['ECategoriaValue'])) { $ECategoriaValue="";} else { $ECategoriaValue = $_POST["ECategoriaValue"];}

    if($ECategoriaName==NULL){echo 'Campo vacio';} else if($ECategoriaValue==NULL){echo 'Campo valor vacio';}else{
        date_default_timezone_set("America/Bogota");
        $EscalaKey=$_SESSION['Keyp'];
        $ECategoriaKey=time();
        $UserKey=$_SESSION['UserKey'];
        $DateStamp=date("Y-m-d H:i:s");
        $sql="INSERT INTO ECategoriaSarlaft (EscalaKey, UserKey, DateStamp, ECategoriaName, ECategoriaValue, ECategoriaKey) 
        VALUES ('".$EscalaKey."','".$UserKey."','".$DateStamp."','".$ECategoriaName."','".$ECategoriaValue."','".$ECategoriaKey."')";
    $query = sqlsrv_query($conn,$sql);
    if ($query) {
        echo "Ha sido guardado con éxito.";
    } else {
        echo "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
              }                             

?>


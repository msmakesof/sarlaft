 <?php
include('is_logged.php');
require_once ("../components/sql_server.php");


if (empty($_POST['ERiesgosName'])) { $ERiesgosName="";} else { $ERiesgosName = strtolower($_POST["ERiesgosName"]);}
if (empty($_POST['ERiesgosValue'])) { $ERiesgosValue="";} else { $ERiesgosValue = $_POST["ERiesgosValue"];}

    if($ERiesgosName==NULL){echo 'Campo vacio';} else if($ERiesgosValue==NULL){echo 'Campo valor vacio';}else{
        date_default_timezone_set("America/Bogota");
        $EscalaKey=$_SESSION['Keyp'];
        $ERiesgosKey=time();
        $UserKey=$_SESSION['UserKey'];
        $DateStamp=date("Y-m-d H:i:s");
        $sql="INSERT INTO ERiesgosSarlaft (EscalaKey, UserKey, DateStamp, ERiesgosName, ERiesgosValue, ERiesgosKey) 
        VALUES ('".$EscalaKey."','".$UserKey."','".$DateStamp."','".$ERiesgosName."','".$ERiesgosValue."','".$ERiesgosKey."')";
    $query = sqlsrv_query($conn,$sql);
    if ($query) {
        echo "Ha sido guardado con éxito.";
    } else {
        echo "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
              }                             

?>


 <?php
include('is_logged.php');
require_once ("../components/sql_server.php");


if (empty($_POST['ENiveldeRiesgoName'])) { $ENiveldeRiesgoName="";} else { $ENiveldeRiesgoName = strtolower($_POST["ENiveldeRiesgoName"]);}
if (empty($_POST['ENiveldeRiesgoValue'])) { $ENiveldeRiesgoValue="";} else { $ENiveldeRiesgoValue = $_POST["ENiveldeRiesgoValue"];}

    if($ENiveldeRiesgoName==NULL){echo 'Campo vacio';} else if($ENiveldeRiesgoValue==NULL){echo 'Campo valor vacio';}else{
        date_default_timezone_set("America/Bogota");
        $EscalaKey=$_SESSION['Keyp'];
        $ENiveldeRiesgoKey=time();
        $UserKey=$_SESSION['UserKey'];
        $DateStamp=date("Y-m-d H:i:s");
        $sql="INSERT INTO ENiveldeRiesgoSarlaft (EscalaKey, UserKey, DateStamp, ENiveldeRiesgoName, ENiveldeRiesgoValue, ENiveldeRiesgoKey) 
        VALUES ('".$EscalaKey."','".$UserKey."','".$DateStamp."','".$ENiveldeRiesgoName."','".$ENiveldeRiesgoValue."','".$ENiveldeRiesgoKey."')";
    $query = sqlsrv_query($conn,$sql);
    if ($query) {
        echo "Ha sido guardado con éxito.";
    } else {
        echo "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
              }                             

?>


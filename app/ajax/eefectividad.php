 <?php
include('is_logged.php');
require_once ("../components/sql_server.php");


if (empty($_POST['EEfectividadName'])) { $EEfectividadName="";} else { $EEfectividadName = strtolower($_POST["EEfectividadName"]);}
if (empty($_POST['EEfectividadValue'])) { $EEfectividadValue="";} else { $EEfectividadValue = $_POST["EEfectividadValue"];}

    if($EEfectividadName==NULL){echo 'Campo vacio';} else if($EEfectividadValue==NULL){echo 'Campo valor vacio';}else{
        date_default_timezone_set("America/Bogota");
        $EscalaKey=$_SESSION['Keyp'];
        $EEfectividadKey=time();
        $UserKey=$_SESSION['UserKey'];
        $DateStamp=date("Y-m-d H:i:s");
        $sql="INSERT INTO EEfectividadSarlaft (EscalaKey, UserKey, DateStamp, EEfectividadName, EEfectividadValue, EEfectividadKey) 
        VALUES ('".$EscalaKey."','".$UserKey."','".$DateStamp."','".$EEfectividadName."','".$EEfectividadValue."','".$EEfectividadKey."')";
    $query = sqlsrv_query($conn,$sql);
    if ($query) {
        echo "Ha sido guardado con éxito.";
    } else {
        echo "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
              }                             

?>


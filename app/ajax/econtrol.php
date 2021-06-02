<?php
include ('is_logged.php');
require_once ("../components/sql_server.php");


if (empty($_POST['EControlName'])) { $EControlName="";} else { $EControlName = strtolower($_POST["EControlName"]);}
if (empty($_POST['EControlValue'])) { $EControlValue="";} else { $EControlValue = $_POST["EControlValue"];}


        date_default_timezone_set("America/Bogota");
        $EscalaKey=$_SESSION['Keyp'];
        $EControlKey=time();
        $UserKey=$_SESSION['UserKey'];
        $DateStamp=date("Y-m-d H:i:s");
        $sql="INSERT INTO EControlSarlaft (EscalaKey, UserKey, DateStamp, EControlName, EControlValue, EControlKey) 
        VALUES ('".$EscalaKey."','".$UserKey."','".$DateStamp."','".$EControlName."','".$EControlValue."','".$EControlKey."')";
    $query = sqlsrv_query($conn,$sql);
    if ($query) {
        echo "Ha sido guardado con éxito.";
    } else {
        echo "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
                          

?>


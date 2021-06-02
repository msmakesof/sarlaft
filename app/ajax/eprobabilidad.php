 <?php
include('is_logged.php');
require_once ("../components/sql_server.php");


if (empty($_POST['EProbabilidadName'])) { $EProbabilidadName="";} else { $EProbabilidadName = strtolower($_POST["EProbabilidadName"]);}
if (empty($_POST['EProbabilidadValue'])) { $EProbabilidadValue="";} else { $EProbabilidadValue = $_POST["EProbabilidadValue"];}

    if($EProbabilidadName==NULL){echo 'Campo vacio';} else if($EProbabilidadValue==NULL){echo 'Campo valor vacio';}else{
        date_default_timezone_set("America/Bogota");
        $EscalaKey=$_SESSION['Keyp'];
        $EProbabilidadKey=time();
        $UserKey=$_SESSION['UserKey'];
        $DateStamp=date("Y-m-d H:i:s");
        $sql="INSERT INTO EProbabilidadSarlaft (EscalaKey, UserKey, DateStamp, EProbabilidadName, EProbabilidadValue, EProbabilidadKey) 
        VALUES ('".$EscalaKey."','".$UserKey."','".$DateStamp."','".$EProbabilidadName."','".$EProbabilidadValue."','".$EProbabilidadKey."')";
    $query = sqlsrv_query($conn,$sql);
    if ($query) {
        echo "Ha sido guardado con éxito.";
    } else {
        echo "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
              }                             

?>


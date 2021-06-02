<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
          $Acc=$_GET['Acc'];
          if($Acc==NULL){
          $sql = "SELECT EventosdeRiesgoKey FROM GestiondeRiesgoSarlaft WHERE CustomerKey=".$_SESSION['Keyp']."";
          $params = array();
          $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
          $stmt = sqlsrv_query( $conn, $sql , $params, $options );
          $na = sqlsrv_num_rows( $stmt );
          if($na=='0'){
            header("location: ./UGR2");
          }else{
          $query=sqlsrv_query($conn,"SELECT EventosdeRiesgoKey FROM GestiondeRiesgoSarlaft WHERE CustomerKey=".$_SESSION['Keyp']." ORDER BY id DESC");
          $reg=sqlsrv_fetch_array($query);
          $EventosdeRiesgoKey=$reg['EventosdeRiesgoKey'];            
          header("location: ./UGR2-F?ERK=".$EventosdeRiesgoKey."");
          }
     }else{

          header("location: ./UGR2");
     }
?>


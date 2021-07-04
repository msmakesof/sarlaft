<?php
//class Database {

 //    public $conn;
 //    public $con;
//}
     
     // Conexión a DB Creadas automaticamente
     //$a=$_SESSION["Keyp"];
     $serverName = "PMALAP-004\SQLEXPRESS";  //"LAPTOP-C19VUK67"; //serverName\instanceName
     //$connectionInfo = array( "Database"=>'E'.$a.'', "UID"=>"sa", "PWD"=>"Answer934@");    // Esta es la conexion para los clientes
     $connectionInfo = array( "Database"=>'sarlaft', "UID"=>"sa", "PWD"=>"Answer934@");      // Esta es laconexion standar
     $conn = sqlsrv_connect( $serverName, $connectionInfo);

     if( $conn ) {
          //echo "Conexión establecida.<br />";
     }else{
          echo "Conexión no se pudo establecer.<br />";
          die( print_r( sqlsrv_errors(), true));
     }
     
     
/*

     //public function getConnection(){
     //     $this->con = null;
     //}
          // Conexión SecureLogin
          $serverName = "PMALAP-004\SQLEXPRESS";  //"LAPTOP-C19VUK67"; //serverName\instanceName
          $connectionInfo = array( "Database"=>"SecureLogin", "UID"=>"sa", "PWD"=>"Answer934@");
          $con = sqlsrv_connect( $serverName, $connectionInfo);

          if( $con ) {
          //if( $this->con ) {     
               echo "Conexión establecida OK.<br />";
               return $con;
          }else{
               echo "Conexión no se pudo establecer.<br />";
               die( print_r( sqlsrv_errors(), true));
          }
  */        
     
//}
?>
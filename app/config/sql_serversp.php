<?php    
	require_once  'dbx.php';
	$conexSP = new Database();
	$sp = $conexSP->getSParr();
	$sphostpc =$sp[0];
	$spdb_name =$sp[1];
	$spusername=$sp[2];
	$sppassword=$sp[3];
	
    // Conexión a DB Creadas automaticamente
    //$a=$_SESSION["Keyp"];
    $serverName = $sphostpc;   //"PMALAP-004\SQLEXPRESS";  //"LAPTOP-C19VUK67"; //serverName\instanceName
    //$connectionInfo = array( "Database"=>'E'.$a.'', "UID"=>"sa", "PWD"=>"Answer934@");    // Esta es la conexion para los clientes	
    //$connectionInfo = array( "Database"=>'sarlaft', "UID"=>"sa", "PWD"=>"Answer934@");    // Esta es la conexion standar con la q estoy programando
	
	$connectionInfo = array( "Database"=>"$spdb_name", "UID"=>"$spusername", "PWD"=>"$sppassword");      // Esta es laconexion standar
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
        //echo "Conexión establecida.<br />";
    }else{
        echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }
     
     
/*  //public function getConnection(){
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
?>
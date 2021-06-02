<?php 
    class Database {
        private $host = "localhost";
		private $hostpc = "PMALAP-004\\SQLEXPRESS"; 
        private $db_name = "SecureLogin";
        private $username = "sa";
        private $password = "Answer934@";
        private $puerto = ":8090";
        private $dominio= "app";
        private $subdominio= "";
        private $company="ASRiesgos";
        private $protocol ="http";

        public $conn;		
		public $urlServicios;
		
		public function getUrl(){
        // Cuando es Solo Dominio
        $this->urlServicios = $this->protocol."://".$this->host.$this->puerto."/".$this->dominio."/";
        
        // Cuando es con SubDominio
			  // $this->urlServicios = $this->protocol."://".$this->subdominio.$this->puerto."/";

			  return $this->urlServicios;
		}

        public function getConnection(){
            $this->conn = null;
            try{				
				//$this->conn = new PDO("sqlsrv:server=" . $this->host . ";Database=" . $this->db_name, $this->username, $this->password);
                //$this->conn->exec("set names utf8");
				
				$this->conn = new PDO("sqlsrv:Server=". $this->hostpc .";Database=". $this->db_name, $this->username, $this->password,
					 array(
						//PDO::ATTR_PERSISTENT => true,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					) 				
				); 
				
				///$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				///$this->conn->setAttribute( PDO::SQLSRV_ATTR_QUERY_TIMEOUT, 1 );  
				
				////$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //atributos para la base de datos
				//echo 'LA CONEXION A LA BASE DE DATOS SE REALIZÓ SATISFACTORIAMENTE';
				
				//$pdo = new PDO ("sqlsrv:Server=$_MYSQL_HOST;Database=$_MYSQL_DB",$_MYSQL_USER, $_MYSQL_PASS); 
				//$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
				
				
				
				//$this->conn = new PDO("sqlsrv:server=" . $this->host . ";database=" . $this->db_name, $this->username, $this->password);
				//$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//$serverName = "PMALAP-004\SQLEXPRESS";  //"LAPTOP-C19VUK67"; //serverName\instanceName 
				//$connectionInfo = array( "Database"=>"SecureLogin", "UID"=>"sa", "PWD"=>"Answer934@");
				//$this->conn = sqlsrv_connect( $serverName, $connectionInfo);
				
            }catch(Exception $e){
                echo "Database could not be connected: " . $e->getMessage();
            }
            return $this->conn;
        }
    }  
?>

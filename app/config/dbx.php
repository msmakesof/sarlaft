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
        // Para los Cientes
        private $db_nameCli = "sarlaft";
        // Para los SP
        private $sphostpc = "PMALAP-004\\SQLEXPRESS";
        private $spdbname = "sarlaft";
        private $spusername = "sa";
        private $sppassword = "Answer934@";
        
        public $conn;
		public $urlServicios;
        public $sparr;
		public $a;
		public $connectionInfo;
		
		public function getUrl(){
			// Cuando es Solo Dominio
			$this->urlServicios = $this->protocol."://".$this->host.$this->puerto."/".$this->dominio."/";        
			// Cuando es con SubDominio // $this->urlServicios = $this->protocol."://".$this->subdominio.$this->puerto."/";
			return $this->urlServicios;
		}

        public function getConnection(){
            $this->conn = null;
            try {				
				$this->conn = new PDO("sqlsrv:Server=".$this->hostpc.";Database=".$this->db_name, $this->username, $this->password);			  
				$this->conn->exec("set names utf8");
			}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
            return $this->conn;
        }

        public function getConnectionCli(){
            $this->conn = null;
            try {				
				$this->conn = new PDO("sqlsrv:Server=". $this->hostpc.";Database=". $this->db_nameCli, $this->username, $this->password);			  
				$this->conn->exec("set names utf8");
			}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
            return $this->conn;
        }

        public function getSParr(){
            $this->sparr= array($this->sphostpc, $this->spdbname, $this->spusername, $this->sppassword);
            return $this->sparr;
        }
		
		//Conexion basica
		public function getConnectionCli2($par1){			
			//$serverName = $this->hostpc;  //"PMALAP-004\SQLEXPRESS";  //"LAPTOP-C19VUK67"; //serverName\instanceName
			$this->conn = null;
			$this->a = $par1;
			//$connectionInfo = array( "Database"=>'E'.$a.'', "UID"=>"sa", "PWD"=>"Answer934@");    // Esta es la conexion para los clientes
			$this->connectionInfo = array( "Database"=>$this->db_nameCli, "UID"=>$this->username, "PWD"=>$this->password, 
                           "CharacterSet" => "UTF-8");      // Esta es la conexion standar
			$this->conn = sqlsrv_connect( $this->hostpc, $this->connectionInfo);

			if( $this->conn ) {
				 //echo "Conexión establecida.<br />";				 
			}else{
				 echo "Conexión no se pudo establecer.<br />";
				 die( print_r( sqlsrv_errors(), true));
			}
			return $this->conn;
		}
		
		//Conexion basica a SecureLogin
		public function getConnectionSL(){
			$this->conn = null;
			//$this->a = $par1;
			$this->connectionInfo = array( "Database"=>$this->db_name, "UID"=>$this->username, "PWD"=>$this->password, 
                           "CharacterSet" => "UTF-8");      // Esta es la conexion standar
			$this->conn = sqlsrv_connect( $this->hostpc, $this->connectionInfo);

			if( $this->conn ) {
				 //echo "Conexión establecida.<br />";				 
			}else{
				 echo "Conexión no se pudo establecer.<br />";
				 die( print_r( sqlsrv_errors(), true));
			}
			return $this->conn;
		}
    }
?>
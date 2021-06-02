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
			// Cuando es con SubDominio // $this->urlServicios = $this->protocol."://".$this->subdominio.$this->puerto."/";
			return $this->urlServicios;
		}

        public function getConnection(){
            $this->conn = null;
            try {				
				$this->conn = new PDO("sqlsrv:Server=". $this->hostpc.";Database=". $this->db_name, $this->username, $this->password);			  
				$this->conn->exec("set names utf8");
			}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
            return $this->conn;
        }
    }  
?>
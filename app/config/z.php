<?php
		$hostpc = "PMALAP-004\\SQLEXPRESS"; 
        $db_name = "SecureLogin";
		 $host = "localhost";
         $username = "sa";
         $password = "Answer934@";
         $puerto = ":8090";
         $dominio= "app";
         $subdominio= "";
         $company="ASRiesgos";
         $protocol ="http";

         $conn;		
		 $urlServicios;
		
		/*
		public function getUrl(){
			// Cuando es Solo Dominio
			$this->urlServicios = $this->protocol."://".$this->host.$this->puerto."/".$this->dominio."/";        
			// Cuando es con SubDominio // $this->urlServicios = $this->protocol."://".$this->subdominio.$this->puerto."/";
			return $this->urlServicios;
		}*/

        //public function getConnection(){
            $conn = null;
            try {
				$conn = new PDO("sqlsrv:Server={$hostpc};Database={$db_name}", $username, $password);
				//$this->conn = true;
				$query = "SELECT * FROM CustomerSarlaft";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				$rows = $stmt->fetchAll();
				$num = count($rows);
				print $num;
			}
			catch(PDOException $exception){
				echo "Connection error: " . $exception->getMessage();
			}
?>
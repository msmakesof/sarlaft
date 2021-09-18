<?php
    class Fortalezas{

        // Connection
        private $conn;

        // Table
        private $db_table = "FortalezasSarlaft";

        // Columns
		public $id;
		public $CustomerKey;
		public $FortalezasKey;
		public $FortalezasName;
		public $UserKey;
		public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAccion(){
            $sql = "SELECT  id, FortalezasName, CustomerKey, FortalezasKey, UserKey FROM ". $this->db_table ." ORDER BY FortalezasName ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT id, FortalezasName, CustomerKey, FortalezasKey, UserKey FROM ". $this->db_table ." 
            WHERE CustomerKey = ? ORDER BY FortalezasName ";            
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			 $stmt->bindParam(1, $this->CustomerKey);
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdAccion(){
            $sql = "SELECT TOP 1 ACC_IdAccion, ACC_Nombre, ACC_IdEstado FROM ". $this->db_table ." WHERE ACC_IdAccion = ? ";			

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->IdPerfil);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->IdPerfil = $dataRow['IdPerfil'];
			$this->NombrePerfil = $dataRow['NombrePerfil'];
			$this->IdEstado = $dataRow['IdEstado']; 
            $this->STA_Nombre = $dataRow['STA_Nombre'];         
        }

        // Busca Nombre para controlar Duplicados
        public function getBuscaNombre(){
            $sql = "SELECT count(id) AS FortalezasName
                    FROM ". $this->db_table ."
                    WHERE FortalezasName = ? AND CustomerKey = ? AND id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->FortalezasName, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->FortalezasName = $dataRow['FortalezasName'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." ( CustomerKey, FortalezasKey, FortalezasName, UserKey, DateStamp ) VALUES ( :ck, :ok, :nombre, :uk, :ds )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->CustomerKey = htmlspecialchars(strip_tags($this->CustomerKey));
			$this->FortalezasKey = htmlspecialchars(strip_tags($this->FortalezasKey));
			$this->FortalezasName = htmlspecialchars(strip_tags($this->FortalezasName));
			$this->UserKey = htmlspecialchars(strip_tags($this->UserKey));
			$this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":ok", $this->FortalezasKey, PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $this->FortalezasName, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->UserKey, PDO::PARAM_STR);
			$stmt->bindParam(":ds", $this->DateStamp, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function update(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    FortalezasName = :nombre
                    WHERE id = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->FortalezasName=htmlspecialchars(strip_tags($this->FortalezasName));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nombre", $this->FortalezasName, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

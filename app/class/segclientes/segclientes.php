<?php
    class SegClientes{

        // Connection
        private $conn;

        // Table
        private $db_table = "SegClientesSarlaft";

        // Columns
		public $id;
		public $CustomerKey;
		public $SegClientesName;
        public $UserKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAccion(){
            $sql = "SELECT id, CustomerKey, SegClientesName, UserKey FROM ". $this->db_table ." 
            ORDER BY SegClientesName ";            
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }

        // GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT id, CustomerKey, SegClientesName, UserKey
            FROM ". $this->db_table ." WHERE CustomerKey = ? ORDER BY SegClientesName ";
            //echo $sql;
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
            $sql = "SELECT count(SegClientesName) AS SegClientesName
                      FROM ". $this->db_table ."
                    WHERE SegClientesName = ? AND id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->SegClientesName, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->ACC_Nombre = $dataRow['ACC_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (SegClientesName ) VALUES ( :nombre )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->SegClientesName = htmlspecialchars(strip_tags($this->SegClientesName));
			////$this->ACC_IdEstado = htmlspecialchars(strip_tags($this->ACC_IdEstado));
		
			// bind data
			$stmt->bindParam(":nombre", $this->SegClientesName, PDO::PARAM_STR);
			////$stmt->bindParam(":idestado", $this->ACC_IdEstado, PDO::PARAM_INT);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateAccion(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    ACC_Nombre = :accionnombre,
                    ACC_IdEstado = :idestado
                    WHERE ACC_IdAccion = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->ACC_Nombre=htmlspecialchars(strip_tags($this->ACC_Nombre));
			$this->ACC_IdEstado=htmlspecialchars(strip_tags($this->ACC_IdEstado));
            $this->ACC_IdAccion=htmlspecialchars(strip_tags($this->ACC_IdAccion));
        
            // bind data
            $stmt->bindParam(":accionnombre", $this->ACC_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->ACC_IdEstado, PDO::PARAM_INT);
            $stmt->bindParam(":id", $this->ACC_IdAccion, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteAccion(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE ACC_IdAccion = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->ACC_IdAccion = htmlspecialchars(strip_tags($this->ACC_IdAccion));

            // bind data
            $stmt->bindParam(1, $this->ACC_IdAccion, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

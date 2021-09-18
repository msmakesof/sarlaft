<?php
    class Debilidades{

        // Connection
        private $conn;

        // Table
        private $db_table = "DebilidadesSarlaft";

        // Columns
		public $id;
		public $CustomerKey;
		public $DebilidadesKey;
		public $DebilidadesName;
		public $UserKey;
		public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT id, DebilidadesName, CustomerKey, DebilidadesKey, UserKey  ". $this->db_table ." 
            ORDER BY DebilidadesName ";            
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT id, DebilidadesName, CustomerKey, DebilidadesKey, UserKey FROM ". $this->db_table ." 
            WHERE CustomerKey = ? ORDER BY DebilidadesName ";            
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
            $sql = "SELECT count(id) AS DebilidadesName
                    FROM ". $this->db_table ."
                    WHERE DebilidadesName = ? AND CustomerKey = ? AND id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->DebilidadesName, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->DebilidadesName = $dataRow['DebilidadesName'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." ( CustomerKey, UserKey, DateStamp, DebilidadesName, DebilidadesKey ) VALUES ( :ck, :uk, :ds, :nombre, :dk )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->CustomerKey = htmlspecialchars(strip_tags($this->CustomerKey));
			$this->UserKey = htmlspecialchars(strip_tags($this->UserKey));
			$this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
			$this->DebilidadesName = htmlspecialchars(strip_tags($this->DebilidadesName));
			$this->DebilidadesKey = htmlspecialchars(strip_tags($this->DebilidadesKey));
		
			// bind data
			$stmt->bindParam(":ck", $this->CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->UserKey, PDO::PARAM_STR);
			$stmt->bindParam(":ds", $this->DateStamp, PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $this->DebilidadesName, PDO::PARAM_STR);
			$stmt->bindParam(":dk", $this->DebilidadesKey, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function update(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    DebilidadesName = :nombre,
                    CustomerKey = :ck
                    WHERE id = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->DebilidadesName=htmlspecialchars(strip_tags($this->DebilidadesName));
			$this->CustomerKey=htmlspecialchars(strip_tags($this->CustomerKey));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nombre", $this->DebilidadesName, PDO::PARAM_STR);
			$stmt->bindParam(":ck", $this->CustomerKey, PDO::PARAM_INT);
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

<?php
    class Oportunidades{

        // Connection
        private $conn;

        // Table
        private $db_table = "OportunidadesSarlaft";

        // Columns
		public $id;
		public $CustomerKey;
		public $OportunidadesKey;
        public $OportunidadesName;
        public $UserKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAccion(){
            $sql = "SELECT id, CustomerKey, OportunidadesName, UserKey, OportunidadesKey, DateStamp FROM ". $this->db_table ."
            ORDER BY OportunidadesName ";            
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }

        // GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT id, CustomerKey, OportunidadesName, UserKey, OportunidadesKey, DateStamp 
            FROM ". $this->db_table ." WHERE CustomerKey = ?  ORDER BY OportunidadesName ";
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
            $sql = "SELECT count(id) AS OportunidadesName
                    FROM ". $this->db_table ."
                    WHERE OportunidadesName = ? AND CustomerKey = ? AND id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->OportunidadesName, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->OportunidadesName = $dataRow['OportunidadesName'];
        }
		
		// CREATE
		public function create
		(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." ( CustomerKey, OportunidadesKey, OportunidadesName, UserKey, DateStamp ) VALUES ( :ck, :ok, :nombre, :uk, :ds )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->CustomerKey = htmlspecialchars(strip_tags($this->CustomerKey));
			$this->OportunidadesKey = htmlspecialchars(strip_tags($this->OportunidadesKey));
			$this->OportunidadesName = htmlspecialchars(strip_tags($this->OportunidadesName));
			$this->UserKey = htmlspecialchars(strip_tags($this->UserKey));
			$this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":ok", $this->OportunidadesKey, PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $this->OportunidadesName, PDO::PARAM_STR);
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
                    OportunidadesName = :nombre
                    WHERE id = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->OportunidadesName=htmlspecialchars(strip_tags($this->OportunidadesName));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nombre", $this->OportunidadesName, PDO::PARAM_STR);
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

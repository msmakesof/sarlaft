<?php
    class TareasPlan{

        // Connection
        private $conn;

        // Table
        private $db_table = "TareasPlan";

        // Columns
		public $TPP_IdTareaxPlan;
		public $TPP_IdPlan;
		public $TPP_NombreTarea;
		public $TPP_CustomerKey;
		public $TPP_UserKey;
		public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
		public function getPlan(){	
            $sql = "SELECT id
			,TPP_IdTareaxPlan
			,TPP_IdPlan
			,TPP_NombreTarea
			FROM ". $this->db_table ."
			WHERE TPP_IdPlan = ?
			ORDER BY TPP_NombreTarea ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			
			$stmt->execute();
			return $stmt;
        }

         // GET ALL Tareas x Plan
		public function getTareasPlan(){
            $sql = "SELECT TPP_IdTareaxPlan, TPP_IdPlan, TPP_NombreTarea,TPP_CustomerKey
			FROM ". $this->db_table ."
			WHERE TPP_IdPlan = ? AND TPP_CustomerKey = ?
			ORDER BY TPP_NombreTarea ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->TPP_IdPlan);
			$stmt->bindParam(2, $this->TPP_CustomerKey);
			
			$stmt->execute();
			return $stmt;
        }
		
		// Cuenta las tareas de cada plan
		public function getContarTareasPlan(){
            $sql = "SELECT count(TPP_IdTareaxPlan) AS TotalTareas
			FROM ". $this->db_table ."
			WHERE TPP_IdPlan = ? AND TPP_CustomerKey = ? ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->TPP_IdPlan);
			$stmt->bindParam(2, $this->TPP_CustomerKey);
			
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
            $sql = "SELECT count(TPP_IdTareaxPlan) AS TPP_NombreTarea
                    FROM ". $this->db_table ."
                    WHERE TPP_NombreTarea = ? AND TPP_CustomerKey = ? AND TPP_IdPlan = ? AND TPP_IdTareaxPlan <> ? ";
//echo $sql;
            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->TPP_NombreTarea, PDO::PARAM_STR);			
			$stmt->bindParam(2, $this->TPP_CustomerKey, PDO::PARAM_STR);			
			$stmt->bindParam(3, $this->TPP_IdPlan, PDO::PARAM_INT);
			$stmt->bindParam(4, $this->TPP_IdTareaxPlan, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->TPP_NombreTarea = $dataRow['TPP_NombreTarea'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (TPP_IdPlan, TPP_NombreTarea, TPP_CustomerKey, TPP_UserKey, TPP_TareasKey, DateStamp ) VALUES ( :idplan, :nombre, :ck, :uk, :tk, :ds )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->TPP_IdPlan = htmlspecialchars(strip_tags($this->TPP_IdPlan));
			$this->TPP_NombreTarea = htmlspecialchars(strip_tags($this->TPP_NombreTarea));
			$this->TPP_CustomerKey = htmlspecialchars(strip_tags($this->TPP_CustomerKey));
			$this->TPP_UserKey = htmlspecialchars(strip_tags($this->TPP_UserKey));
			$this->TPP_TareasKey = htmlspecialchars(strip_tags($this->TPP_TareasKey));
			$this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data			
			$stmt->bindParam(":idplan", $this->TPP_IdPlan, PDO::PARAM_INT);
			$stmt->bindParam(":nombre", $this->TPP_NombreTarea, PDO::PARAM_STR);
			$stmt->bindParam(":ck", $this->TPP_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->TPP_UserKey, PDO::PARAM_STR);
			$stmt->bindParam(":tk", $this->TPP_TareasKey, PDO::PARAM_STR);
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
                    TPP_NombreTarea = :nombre
                    WHERE TPP_IdTareaxPlan = :id AND TPP_IdPlan = :idplan AND TPP_CustomerKey = :ck ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->TPP_NombreTarea=htmlspecialchars(strip_tags($this->TPP_NombreTarea));			
            $this->TPP_IdTareaxPlan=htmlspecialchars(strip_tags($this->TPP_IdTareaxPlan));
			$this->TPP_IdPlan=htmlspecialchars(strip_tags($this->TPP_IdPlan));
			$this->TPP_CustomerKey=htmlspecialchars(strip_tags($this->TPP_CustomerKey));
        
            // bind data
            $stmt->bindParam(":nombre", $this->TPP_NombreTarea, PDO::PARAM_STR);			
            $stmt->bindParam(":id", $this->TPP_IdTareaxPlan, PDO::PARAM_INT);
			$stmt->bindParam(":idplan", $this->TPP_IdPlan, PDO::PARAM_INT);
			$stmt->bindParam(":ck", $this->TPP_CustomerKey, PDO::PARAM_STR);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE TPP_IdTareaxPlan = ? AND TPP_CustomerKey = ? AND TPP_IdPlan = ?";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->TPP_IdTareaxPlan = htmlspecialchars(strip_tags($this->TPP_IdTareaxPlan));
			$this->TPP_CustomerKey = htmlspecialchars(strip_tags($this->TPP_CustomerKey));
			$this->TPP_IdPlan = htmlspecialchars(strip_tags($this->TPP_IdPlan));

            // bind data
            $stmt->bindParam(1, $this->TPP_IdTareaxPlan, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->TPP_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->TPP_IdPlan, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

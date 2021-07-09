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
            $sql = "SELECT TPP_IdTareaxPlan, TPP_IdPlan, TPP_NombreTarea
			FROM ". $this->db_table ."
			WHERE TPP_IdPlan = ?
			ORDER BY TPP_NombreTarea ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->TPP_IdPlan);
			
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
                    WHERE TPP_NombreTarea = ? AND TPP_IdPlan = ? AND TPP_IdTareaxPlan <> ? ";
//echo $sql;
            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->TPP_NombreTarea, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->TPP_IdPlan, PDO::PARAM_INT);
			$stmt->bindParam(3, $this->TPP_IdTareaxPlan, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->TPP_NombreTarea = $dataRow['TPP_NombreTarea'];
        }
		
		// CREATE
		public function createTarea(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (TPP_IdPlan, TPP_NombreTarea ) VALUES ( :idplan, :nombretarea )";
			echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->TPP_IdPlan = htmlspecialchars(strip_tags($this->TPP_IdPlan));
			$this->TPP_NombreTarea = htmlspecialchars(strip_tags($this->TPP_NombreTarea));
		
			// bind data			
			$stmt->bindParam(":idplan", $this->TPP_IdPlan, PDO::PARAM_INT);
			$stmt->bindParam(":nombretarea", $this->TPP_NombreTarea, PDO::PARAM_STR);
		
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

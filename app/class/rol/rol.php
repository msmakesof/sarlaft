<?php
    class RolUsers{

        // Connection
        private $conn;

        // Table
        private $db_table = "RolUsers";

        // Columns
		public $IdRol;
		public $RolNombre;
		public $IdEstado;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getRol(){
            $sql = "SELECT IdRol, RolNombre, IdEstado, STA_Nombre FROM ". $this->db_table ." JOIN State ON STA_IdEstado = IdEstado ORDER BY RolNombre ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdRol(){
            $sql = "SELECT TOP 1 IdRol, RolNombre, IdEstado FROM ". $this->db_table ." WHERE IdRol = ? ";			

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->IdRol);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->IdRol = $dataRow['IdRol'];
			$this->RolNombre = $dataRow['RolNombre'];
			$this->IdEstado = $dataRow['IdEstado'];          
        }

        // Busca Nombre para controlar Duplicados
        public function getBuscaNombre(){
            $sql = "SELECT count(IdRol) AS RolNombre
                      FROM ". $this->db_table ."
                    WHERE RolNombre = ? AND IdRol <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->RolNombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->IdRol, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->RolNombre = $dataRow['RolNombre'];
        }
		
		// CREATE
		public function createRol(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (RolNombre, IdEstado ) VALUES ( :rolnombre , :idestado )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->RolNombre = htmlspecialchars(strip_tags($this->RolNombre));
			$this->IdEstado = htmlspecialchars(strip_tags($this->IdEstado));
		
			// bind data
			$stmt->bindParam(":rolnombre", $this->RolNombre, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->IdEstado, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateRol(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
						RolNombre = :rolnombre,
						IdEstado = :idestado
                    WHERE IdRol = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->RolNombre=htmlspecialchars(strip_tags($this->RolNombre));
			$this->IdEstado=htmlspecialchars(strip_tags($this->IdEstado));
            $this->IdRol=htmlspecialchars(strip_tags($this->IdRol));
        
            // bind data
            $stmt->bindParam(":rolnombre", $this->RolNombre, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->IdEstado, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->IdRol, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteRol(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE IdRol = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->IdRol = htmlspecialchars(strip_tags($this->IdRol));

            // bind data
            $stmt->bindParam(1, $this->IdRol, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

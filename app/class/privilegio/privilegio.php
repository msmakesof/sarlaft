<?php
    class PermisosxRol{

        // Connection
        private $conn;

        // Table
        private $db_table = "PermisosxRol";

        // Columns
		public $PER_IdPermisoxRol;
		public $PER_IdRol;
		public $PER_IdMenu;
        public $PER_IdAccion;
		public $PER_IdUsuario;
        public $PER_Creado;

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

        // Trae los Privilegios por IdRol
        public function getPrivilegioxIdRol(){
            $sql = "SELECT PER_IdPermisoxRol, PER_IdRol, PER_IdMenu, PER_IdAccion, PER_UserKey FROM ". $this->db_table ." WHERE PER_IdRol = ? ";			
            //echo $sql;

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->PER_IdRol);

            $stmt->execute();
            
            return $stmt; 
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
		public function createPrivilegioxRol(){
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

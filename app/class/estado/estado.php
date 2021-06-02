<?php
    class State{

        // Connection
        private $conn;

        // Table
        private $db_table = "State";

        // Columns
		public $STA_IdEstado;
		public $STA_Nombre;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEstado(){
            $sql = "SELECT STA_IdEstado, STA_Nombre FROM ". $this->db_table ." ORDER BY STA_Nombre ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdEstado(){
            $sql = "SELECT TOP 1 STA_IdEstado, STA_Nombreo FROM ". $this->db_table ." WHERE STA_IdEstado = ? ";			

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->STA_IdEstado);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->STA_IdEstado = $dataRow['STA_IdEstado'];
			$this->STA_Nombre = $dataRow['STA_Nombre'];      
        }

        // Busca Nombre para controlar Duplicados
        public function getBuscaNombre(){
            $sql = "SELECT count(STA_IdEstado) AS STA_Nombre
                      FROM ". $this->db_table ."
                    WHERE STA_Nombre = ? AND STA_IdEstado <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->STA_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->STA_IdEstado, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->STA_Nombre = $dataRow['STA_Nombre'];
        }
		
		// CREATE
		public function createEstado(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (STA_Nombre ) VALUES ( :nombreestado )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->STA_Nombre = htmlspecialchars(strip_tags($this->STA_Nombre));
		
			// bind data
			$stmt->bindParam(":nombreestado", $this->STA_Nombre, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateEstado(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    STA_Nombre = :estadonombre
                    WHERE STA_IdEstado = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->STA_Nombre=htmlspecialchars(strip_tags($this->STA_Nombre));
        
            // bind data
            $stmt->bindParam(":estadonombre", $this->STA_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->STA_IdEstado, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteEstado(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE STA_IdEstado = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->STA_IdEstado = htmlspecialchars(strip_tags($this->STA_IdEstado));

            // bind data
            $stmt->bindParam(1, $this->STA_IdEstado, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

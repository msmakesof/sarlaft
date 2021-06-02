<?php
    class OptionMenu{

        // Connection
        private $conn;

        // Table
        private $db_table = "OptionMenu";

        // Columns
		public $OPC_Id;
		public $OPC_Nombre;
		public $OPC_IdEstado;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getMenu(){
            $sql = "SELECT OPC_Id, OPC_Nombre, OPC_IdEstado, STA_Nombre FROM ". $this->db_table ." 
            JOIN State ON STA_IdEstado = OPC_IdEstado ORDER BY OPC_Nombre ";            
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdMenu(){
            $sql = "SELECT TOP 1 OPC_Id, OPC_Nombre, OPC_IdEstado FROM ". $this->db_table ." WHERE OPC_Id = ? ";			

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->OPC_Id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->OPC_Id = $dataRow['OPC_Id'];
			$this->OPC_Nombre = $dataRow['OPC_Nombre'];
			$this->OPC_IdEstado = $dataRow['OPC_IdEstado']; 
            //$this->STA_Nombre = $dataRow['STA_Nombre'];         
        }

        // Busca Nombre para controlar Duplicados
        public function getBuscaNombre(){
            $sql = "SELECT count(OPC_Id) AS OPC_Nombre
                      FROM ". $this->db_table ."
                    WHERE OPC_Nombre = ? AND OPC_Id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->OPC_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->OPC_Id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->OPC_Nombre = $dataRow['OPC_Nombre'];
        }
		
		// CREATE
		public function createMenu(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (OPC_Nombre, OPC_IdEstado ) VALUES ( :nombremenu , :idestado )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->OPC_Nombre = htmlspecialchars(strip_tags($this->OPC_Nombre));
			$this->OPC_IdEstado = htmlspecialchars(strip_tags($this->OPC_IdEstado));
		
			// bind data
			$stmt->bindParam(":nombremenu", $this->OPC_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->OPC_IdEstado, PDO::PARAM_INT);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updateMenu(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                        OPC_Nombre = :menunombre,
						OPC_IdEstado = :idestado
                    WHERE OPC_Id = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->OPC_Nombre=htmlspecialchars(strip_tags($this->OPC_Nombre));
			$this->OPC_IdEstado=htmlspecialchars(strip_tags($this->OPC_IdEstado));
            $this->OPC_Id=htmlspecialchars(strip_tags($this->OPC_Id));
        
            // bind data
            $stmt->bindParam(":menunombre", $this->OPC_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->OPC_IdEstado, PDO::PARAM_INT);
            $stmt->bindParam(":id", $this->OPC_Id, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deleteMenu(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE OPC_Id = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->OPC_Id = htmlspecialchars(strip_tags($this->OPC_Id));

            // bind data
            $stmt->bindParam(1, $this->OPC_Id, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

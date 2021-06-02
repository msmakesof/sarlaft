<?php
    class ProfileUsers{

        // Connection
        private $conn;

        // Table
        private $db_table = "ProfileUsers";

        // Columns
		public $IdPerfil;
		public $NombrePerfil;
		public $IdEstado;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getPerfil(){
            $sql = "SELECT IdPerfil, NombrePerfil, ProfileUsers.IdEstado, STA_Nombre FROM ". $this->db_table ." 
            JOIN State ON State.STA_IdEstado = IdEstado ORDER BY NombrePerfil ";            
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdPerfil(){
            $sql = "SELECT TOP 1 IdPerfil, NombrePerfil, IdEstado FROM ". $this->db_table ." WHERE IdPerfil = ? ";			

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
            $sql = "SELECT count(IdPerfil) AS NombrePerfil
                      FROM ". $this->db_table ."
                    WHERE NombrePerfil = ? AND IdPerfil <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->NombrePerfil, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->IdPerfil, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->NombrePerfil = $dataRow['NombrePerfil'];
        }
		
		// CREATE
		public function createPerfil(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (NombrePerfil, IdEstado ) VALUES ( :nombreperfil , :idestado )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->NombrePerfil = htmlspecialchars(strip_tags($this->NombrePerfil));
			$this->IdEstado = htmlspecialchars(strip_tags($this->IdEstado));
		
			// bind data
			$stmt->bindParam(":nombreperfil", $this->NombrePerfil, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->IdEstado, PDO::PARAM_INT);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function updatePerfil(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
						NombrePerfil = :perfilnombre,
						IdEstado = :idestado
                    WHERE IdPerfil = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->NombrePerfil=htmlspecialchars(strip_tags($this->NombrePerfil));
			$this->IdEstado=htmlspecialchars(strip_tags($this->IdEstado));
            $this->IdPerfil=htmlspecialchars(strip_tags($this->IdPerfil));
        
            // bind data
            $stmt->bindParam(":perfilnombre", $this->NombrePerfil, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->IdEstado, PDO::PARAM_INT);
            $stmt->bindParam(":id", $this->IdPerfil, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function deletePerfil(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE IdPerfil = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->IdPerfil = htmlspecialchars(strip_tags($this->IdPerfil));

            // bind data
            $stmt->bindParam(1, $this->IdPerfil, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

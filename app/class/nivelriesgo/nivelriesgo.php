<?php
    class Nivelriesgo{

        // Connection
        private $conn;

        // Table
        private $db_table = "NIR_NivelRiesgo";

        // Columns
		public $NIR_IdNivelRiesgo;
		public $NIR_CustomerKey;
		public $NIR_Nombre;
        public $NIR_Color;
        public $NIR_UserKey;
        public $NIR_TipoRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT NIR_IdNivelRiesgo, NIR_CustomerKey, NIR_Nombre, NIR_Color, NIR_UserKey, NIR_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY NIR_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getIdFR(){
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
            $sql = "SELECT count(NIR_IdNivelRiesgo) AS NIR_Nombre
                      FROM ". $this->db_table ."
                    WHERE NIR_Nombre = ? AND NIR_IdNivelRiesgo <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->NIR_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->NIR_IdNivelRiesgo, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->NIR_Nombre = $dataRow['NIR_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (NIR_CustomerKey, NIR_UserKey, NIR_Nombre, NIR_Color, NIR_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :color, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->NIR_CustomerKey = htmlspecialchars(strip_tags($this->NIR_CustomerKey));
			$this->NIR_UserKey = htmlspecialchars(strip_tags($this->NIR_UserKey));
			$this->NIR_Nombre = htmlspecialchars(strip_tags($this->NIR_Nombre));
          //$this->NIR_Color = htmlspecialchars(strip_tags($this->NIR_Color));
            $this->NIR_Color = '#'.$this->NIR_Color;
            $this->NIR_TipoRiesgoKey = htmlspecialchars(strip_tags($this->NIR_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->NIR_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->NIR_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->NIR_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":color", $this->NIR_Color, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->NIR_TipoRiesgoKey, PDO::PARAM_STR);
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
                    NIR_Nombre = :nombre,
                    NIR_Color = :color
                    WHERE NIR_IdNivelRiesgo = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->NIR_Nombre=htmlspecialchars(strip_tags($this->NIR_Nombre));
            //$this->NIR_Color=htmlspecialchars(strip_tags($this->NIR_Color));
            $this->NIR_Color='#'.$this->NIR_Color;
            $this->NIR_IdNivelRiesgo=htmlspecialchars(strip_tags($this->NIR_IdNivelRiesgo));
        
            // bind data
            $stmt->bindParam(":nombre", $this->NIR_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":color", $this->NIR_Color, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->NIR_IdNivelRiesgo, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE NIR_IdNivelRiesgo = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->NIR_IdNivelRiesgo = htmlspecialchars(strip_tags($this->NIR_IdNivelRiesgo));

            // bind data
            $stmt->bindParam(1, $this->NIR_IdNivelRiesgo, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

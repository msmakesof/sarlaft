<?php
    class Probabilidad{

        // Connection
        private $conn;

        // Table
        private $db_table = "PRO_Probabilidad";

        // Columns
		public $PRO_IdProbabilidad;
		public $PRO_CustomerKey;
		public $PRO_Nombre;
        public $PRO_Escala;
        public $PRO_Color;
        public $PRO_UserKey;
        public $PRO_TipoRiesgoKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT PRO_IdProbabilidad, PRO_CustomerKey, PRO_Nombre, PRO_Escala, PRO_Color, PRO_UserKey, PRO_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY PRO_Escala, PRO_Nombre DESC";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT PRO_IdProbabilidad, PRO_CustomerKey, PRO_Nombre, PRO_Escala, PRO_Color, PRO_UserKey, PRO_TipoRiesgoKey, DateStamp 
            FROM ". $this->db_table ." WHERE PRO_CustomerKey = ? ORDER BY PRO_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->PRO_CustomerKey);
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
            $sql = "SELECT count(PRO_IdProbabilidad) AS PRO_Nombre
                      FROM ". $this->db_table ."
                    WHERE PRO_Nombre = ? AND PRO_IdProbabilidad <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->PRO_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->PRO_IdProbabilidad, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->PRO_Nombre = $dataRow['PRO_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (PRO_CustomerKey, PRO_UserKey, PRO_Nombre, PRO_Escala, PRO_Color, PRO_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :escala, :color, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->PRO_CustomerKey = htmlspecialchars(strip_tags($this->PRO_CustomerKey));
			$this->PRO_UserKey = htmlspecialchars(strip_tags($this->PRO_UserKey));            
			$this->PRO_Nombre = htmlspecialchars(strip_tags($this->PRO_Nombre));
            $this->PRO_Escala = htmlspecialchars(strip_tags($this->PRO_Escala));
            //$this->PRO_Color = htmlspecialchars(strip_tags($this->PRO_Color));
            $this->PRO_Color = '#'.$this->PRO_Color;
            $this->PRO_TipoRiesgoKey = htmlspecialchars(strip_tags($this->PRO_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->PRO_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->PRO_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->PRO_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":escala", $this->PRO_Escala, PDO::PARAM_STR);
            $stmt->bindParam(":color", $this->PRO_Color, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->PRO_TipoRiesgoKey, PDO::PARAM_STR);
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
                    PRO_Nombre = :nombre,
                    PRO_Escala = :escala,
                    PRO_Color = :color
                    WHERE PRO_IdProbabilidad = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->PRO_Nombre=htmlspecialchars(strip_tags($this->PRO_Nombre));
            $this->PRO_Escala=htmlspecialchars(strip_tags($this->PRO_Escala));
            //$this->PRO_Color=htmlspecialchars(strip_tags($this->PRO_Color));
            $this->PRO_Color='#'.$this->PRO_Color;
            $this->PRO_IdProbabilidad=htmlspecialchars(strip_tags($this->PRO_IdProbabilidad));
        
            // bind data
            $stmt->bindParam(":nombre", $this->PRO_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":escala", $this->PRO_Escala, PDO::PARAM_STR);
            $stmt->bindParam(":color", $this->PRO_Color, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->PRO_IdProbabilidad, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE PRO_IdProbabilidad = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->PRO_IdProbabilidad = htmlspecialchars(strip_tags($this->PRO_IdProbabilidad));

            // bind data
            $stmt->bindParam(1, $this->PRO_IdProbabilidad, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

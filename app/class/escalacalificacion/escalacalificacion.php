<?php
    class EscalaCalificacion{

        // Connection
        private $conn;

        // Table
        private $db_table = "ESC_EscalaCalificacion";

        // Columns
		public $ESC_IdEscalaCalificacion;
		public $ESC_Valor;
		public $ESC_CustomerKey;
        public $ESC_EscalaKey;
        public $ESC_UserKey;
        public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT ESC_IdEscalaCalificacion, ESC_Valor, ESC_CustomerKey, ESC_EscalaKey, ESC_UserKey, DateStamp 
            FROM ". $this->db_table ." ORDER BY ESC_Valor ";
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
            $sql = "SELECT count(ESC_IdEscalaCalificacion) AS ESC_Valor
                      FROM ". $this->db_table ."
                    WHERE ESC_Valor = ? AND ESC_IdEscalaCalificacion <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->ESC_Valor, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->ESC_IdEscalaCalificacion, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->ESC_Valor = $dataRow['ESC_Valor'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (ESC_Valor, ESC_CustomerKey, ESC_EscalaKey, ESC_UserKey, DateStamp ) VALUES ( :valor, :ck, :sk, :uk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
            $this->ESC_Valor = htmlspecialchars(strip_tags($this->ESC_Valor));
			$this->ESC_CustomerKey = htmlspecialchars(strip_tags($this->ESC_CustomerKey));
            $this->ESC_EscalaKey = htmlspecialchars(strip_tags($this->ESC_EscalaKey));
            $this->ESC_UserKey = htmlspecialchars(strip_tags($this->ESC_UserKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
            $stmt->bindParam(":valor", $this->ESC_Valor, PDO::PARAM_INT);
			$stmt->bindParam(":ck", $this->ESC_CustomerKey, PDO::PARAM_STR);
            $stmt->bindParam(":sk", $this->ESC_EscalaKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->ESC_UserKey, PDO::PARAM_STR);
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
                    ESC_Valor = :valor
                    WHERE ESC_IdEscalaCalificacion = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->ESC_Valor=htmlspecialchars(strip_tags($this->ESC_Valor));
            $this->ESC_IdEscalaCalificacion=htmlspecialchars(strip_tags($this->ESC_IdEscalaCalificacion));
        
            // bind data
            $stmt->bindParam(":valor", $this->ESC_Valor, PDO::PARAM_INT);
            $stmt->bindParam(":id", $this->ESC_IdEscalaCalificacion, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE ESC_IdEscalaCalificacion = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->ESC_IdEscalaCalificacion = htmlspecialchars(strip_tags($this->ESC_IdEscalaCalificacion));

            // bind data
            $stmt->bindParam(1, $this->ESC_IdEscalaCalificacion, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

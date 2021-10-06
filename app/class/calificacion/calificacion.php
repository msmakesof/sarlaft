<?php
    class Calificacion{

        // Connection
        private $conn;

        // Table
        private $db_table = "CAL_Calificacion";

        // Columns
		public $CAL_IdCalificacion;
		public $CAL_Nombre;
        public $CAL_Color;
		public $CAL_CustomerKey;
        public $CAL_CalificacionKey;
        public $CAL_UserKey;
        public $CAL_DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT CAL_IdCalificacion, CAL_RangoInicial, CAL_RangoFinal, CAL_Nombre, CAL_Color, CAL_CustomerKey, CAL_CalificacionKey, CAL_UserKey, CAL_DateStamp 
            FROM ". $this->db_table ." ORDER BY CAL_RangoInicial, CAL_RangoFinal, CAL_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT CAL_IdCalificacion, CAL_RangoInicial, CAL_RangoFinal, CAL_Nombre, CAL_Color, CAL_CustomerKey, CAL_CalificacionKey, CAL_UserKey, CAL_DateStamp
            FROM ". $this->db_table ." WHERE CAL_CustomerKey = ? ORDER BY CAL_RangoInicial, CAL_RangoFinal, CAL_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->CSC_CustomerKey);
			$stmt->execute();
			return $stmt;
        }

        // GET ALL por CK
        public function getDatoCalifica(){
            $sql = "SELECT CAL_IdCalificacion, CAL_Nombre, CAL_Color
            FROM ". $this->db_table ." WHERE CAL_CustomerKey = ? AND ? BETWEEN CAL_RangoInicial AND CAL_RangoFinal ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->CAL_CustomerKey);
            $stmt->bindParam(2, $this->CAL_RangoInicial);
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
            $sql = "SELECT count(CAL_IdCalificacion) AS CAL_Nombre
                      FROM ". $this->db_table ."
                    WHERE CAL_Nombre = ? AND CAL_CustomerKey = ? AND CAL_IdCalificacion <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->CAL_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->CAL_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->CAL_IdCalificacion, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CAL_Nombre = $dataRow['CAL_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (CAL_RangoInicial, CAL_RangoFinal, CAL_Nombre, CAL_Color, CAL_CustomerKey, CAL_CalificacionKey, CAL_UserKey, CAL_DateStamp) VALUES ( :ri, :rf, :nombre, :color, :ck, :cak, :uk,  :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
            $this->CAL_RangoInicial = htmlspecialchars(strip_tags($this->CAL_RangoInicial));
            $this->CAL_RangoFinal = htmlspecialchars(strip_tags($this->CAL_RangoFinal));
            $this->CAL_Nombre = htmlspecialchars(strip_tags($this->CAL_Nombre));
            $this->CAL_Color = '#'.$this->CAL_Color;
			$this->CAL_CustomerKey = htmlspecialchars(strip_tags($this->CAL_CustomerKey));
            $this->CAL_CalificacionKey = htmlspecialchars(strip_tags($this->CAL_CalificacionKey));
			$this->CAL_UserKey = htmlspecialchars(strip_tags($this->CAL_UserKey));
            $this->CAL_DateStamp = htmlspecialchars(strip_tags($this->CAL_DateStamp));
		
			// bind data
            $stmt->bindParam(":ri", $this->CAL_RangoInicial, PDO::PARAM_INT);
            $stmt->bindParam(":rf", $this->CAL_RangoFinal, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $this->CAL_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":color", $this->CAL_Color, PDO::PARAM_STR);
			$stmt->bindParam(":ck", $this->CAL_CustomerKey, PDO::PARAM_STR);
            $stmt->bindParam(":cak", $this->CAL_CalificacionKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->CAL_UserKey, PDO::PARAM_STR);
            $stmt->bindParam(":ds", $this->CAL_DateStamp, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function update(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    CAL_Nombre = :nombre,
                    CAL_RangoInicial = :ri,
                    CAL_RangoFinal = :rf,
                    CAL_Color = :color
                    WHERE CAL_IdCalificacion = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->CAL_Nombre=htmlspecialchars(strip_tags($this->CAL_Nombre));
            $this->CAL_RangoInicial=htmlspecialchars(strip_tags($this->CAL_RangoInicial));
            $this->CAL_RangoFinal=htmlspecialchars(strip_tags($this->CAL_RangoFinal));
          //$this->CAL_Color=htmlspecialchars(strip_tags($this->CAL_Color));
            $this->CAL_Color='#'.$this->CAL_Color;
            $this->CAL_IdCalificacion=htmlspecialchars(strip_tags($this->CAL_IdCalificacion));
        
            // bind data
            $stmt->bindParam(":nombre", $this->CAL_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":ri", $this->CAL_RangoInicial, PDO::PARAM_STR);
            $stmt->bindParam(":rf", $this->CAL_RangoFinal, PDO::PARAM_STR);
            $stmt->bindParam(":color", $this->CAL_Color, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->CAL_IdCalificacion, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE CAL_IdCalificacion = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->CAL_IdCalificacion = htmlspecialchars(strip_tags($this->CAL_IdCalificacion));

            // bind data
            $stmt->bindParam(1, $this->CAL_IdCalificacion, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

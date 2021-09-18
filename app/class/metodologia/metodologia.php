<?php
    class Metodologia{

        // Connection
        private $conn;

        // Table
        private $db_table = "MET_Metodologia";

        // Columns
		public $MET_IdMetodologia;
		public $MET_FactorRiesgo;
		public $MET_Nombre;
		public $MET_Descripcion;
		public $MET_Observaciones;
		public $MET_CustomerKey;
		public $MET_MetodologiaKey;
		public $MET_USerKey;
		public $MET_DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT MET_IdMetodologia, MET_FactorRiesgo, MET_Nombre, MET_Descripcion, MET_Observaciones, MET_CustomerKey, MET_MetodologiaKey, MET_USerKey FROM ". $this->db_table ." 
            ORDER BY MET_Nombre ";            
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT MET_IdMetodologia, MET_FactorRiesgo, MET_Nombre, MET_Descripcion, MET_Observaciones, MET_CustomerKey, MET_MetodologiaKey, MET_USerKey FROM ". $this->db_table ." 
            WHERE MET_CustomerKey = ? ORDER BY MET_Nombre ";            
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->MET_CustomerKey);
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
            $sql = "SELECT count(MET_IdMetodologia) AS MET_Nombre
                    FROM ". $this->db_table ."
                    WHERE MET_Nombre = ? AND MET_CustomerKey = ? AND MET_IdMetodologia <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->MET_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->MET_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->MET_IdMetodologia, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->MET_Nombre = $dataRow['MET_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (MET_Nombre, MET_FactorRiesgo, MET_Descripcion, MET_Observaciones, MET_CustomerKey, MET_MetodologiaKey, MET_USerKey ) VALUES ( :nombre, :fr, :descripcion, :observacion, :ck, :mk, :uk)";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->MET_FactorRiesgo = htmlspecialchars(strip_tags($this->MET_FactorRiesgo));
			$this->MET_Nombre = htmlspecialchars(strip_tags($this->MET_Nombre));
			$this->MET_Descripcion = htmlspecialchars(strip_tags($this->MET_Descripcion));
			$this->MET_Observaciones = htmlspecialchars(strip_tags($this->MET_Observaciones));
			$this->MET_CustomerKey = htmlspecialchars(strip_tags($this->MET_CustomerKey));
			$this->MET_MetodologiaKey = htmlspecialchars(strip_tags($this->MET_MetodologiaKey));
			$this->MET_USerKey = htmlspecialchars(strip_tags($this->MET_USerKey));
			//$this->MET_DateStamp = htmlspecialchars(strip_tags($this->MET_DateStamp));
		
			// bind data
			$stmt->bindParam(":fr", $this->MET_FactorRiesgo, PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $this->MET_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(":descripcion", $this->MET_Descripcion, PDO::PARAM_STR);
			$stmt->bindParam(":observacion", $this->MET_Observaciones, PDO::PARAM_STR);
			$stmt->bindParam(":ck", $this->MET_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":mk", $this->MET_MetodologiaKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->MET_USerKey, PDO::PARAM_STR);
			//$stmt->bindParam(":ds", $this->MET_DateStamp, PDO::PARAM_STR);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

		// UPDATE
        public function update(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                    MET_Nombre = :nombre,
                    MET_FactorRiesgo = :fr,
					MET_Descripcion = :descripcion,
					MET_Observaciones = :obs
                    WHERE MET_IdMetodologia = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->MET_Nombre=htmlspecialchars(strip_tags($this->MET_Nombre));
			$this->MET_FactorRiesgo=htmlspecialchars(strip_tags($this->MET_FactorRiesgo));
			$this->MET_Descripcion=htmlspecialchars(strip_tags($this->MET_Descripcion));
			$this->MET_Observaciones=htmlspecialchars(strip_tags($this->MET_Observaciones));
            $this->MET_IdMetodologia=htmlspecialchars(strip_tags($this->MET_IdMetodologia));
        
            // bind data
            $stmt->bindParam(":nombre", $this->MET_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(":fr", $this->MET_FactorRiesgo, PDO::PARAM_STR);
			$stmt->bindParam(":descripcion", $this->MET_Descripcion, PDO::PARAM_STR);
			$stmt->bindParam(":obs", $this->MET_Observaciones, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->MET_IdMetodologia, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE MET_IdMetodologia = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->MET_IdMetodologia = htmlspecialchars(strip_tags($this->MET_IdMetodologia));

            // bind data
            $stmt->bindParam(1, $this->MET_IdMetodologia, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

<?php
    class Contexto{

        // Connection
        private $conn;

        // Table
        private $db_table = "CTX_Contexto";

        // Columns
		public $CTX_IdContexto;
		public $CTX_Interno;
		public $CTX_Externo;
		public $CTX_CustomerKey;
		public $CTX_ContextoKey;
		public $CTX_USerKey;
		public $CTX_DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT CTX_IdContexto, CTX_Interno, CTX_Externo, CTX_CustomerKey, CTX_ContextoKey, CTX_USerKey FROM ". $this->db_table ." 
            WHERE CTX_CustomerKey = ? ORDER BY CTX_IdContexto ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->bindParam(1, $this->CLI_CustomerKey);
			$stmt->execute();
			return $stmt;
        }
		
		// GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT CTX_IdContexto, CTX_Interno, CTX_Externo, CTX_CustomerKey, CTX_ContextoKey, CTX_USerKey FROM ". $this->db_table ." 
            WHERE CTX_CustomerKey = ? ORDER BY CTX_IdContexto ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->CLI_CustomerKey);
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
            $sql = "SELECT count(CTX_IdContexto) AS CTX_Interno
                    FROM ". $this->db_table ."
                    WHERE CTX_Interno = ? AND CTX_Externo = ? AND CTX_IdContexto <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->CTX_Interno, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->CTX_Externo, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->CTX_IdContexto, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CTX_Interno = $dataRow['CTX_Interno'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (CLI_ActividadEconomica, CLI_ObjetoSocial, CLI_DescripcionGeneral, CLI_Mision, CLI_Vision, CLI_ObjetivosEstrategicos, CLI_CustomerKey, CLI_InfoBasicaKey, CLI_USerKey, CLI_DateStamp ) VALUES ( :ae, :os, :dg, :mi, :vi, :oe, :ck, :ik, :wk, :ds)";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize	

             //OK
             $this->CLI_ActividadEconomica = htmlspecialchars(strip_tags($this->CLI_ActividadEconomica));
             $this->CLI_ObjetoSocial = htmlspecialchars(strip_tags($this->CLI_ObjetoSocial));
             $this->CLI_DescripcionGeneral = htmlspecialchars(strip_tags($this->CLI_DescripcionGeneral));
             $this->CLI_Mision = htmlspecialchars(strip_tags($this->CLI_Mision));
             $this->CLI_Vision = htmlspecialchars(strip_tags($this->CLI_Vision));
             $this->CLI_ObjetivosEstrategicos = htmlspecialchars(strip_tags($this->CLI_ObjetivosEstrategicos));
             $this->CLI_CustomerKey = htmlspecialchars(strip_tags($this->CLI_CustomerKey));
             $this->CLI_InfoBasicaKey = htmlspecialchars(strip_tags($this->CLI_InfoBasicaKey));
             $this->CLI_USerKey = htmlspecialchars(strip_tags($this->CLI_USerKey));
             $this->CLI_DateStamp = htmlspecialchars(strip_tags($this->CLI_DateStamp));
/*
            //OK
            $this->CLI_ActividadEconomica = htmlspecialchars(mysql_real_escape_string($this->CLI_ActividadEconomica));
            $this->CLI_ObjetoSocial = htmlspecialchars(mysql_real_escape_string($this->CLI_ObjetoSocial));
            $this->CLI_DescripcionGeneral = htmlspecialchars(mysql_real_escape_string($this->CLI_DescripcionGeneral));
            $this->CLI_Mision = htmlspecialchars(mysql_real_escape_string($this->CLI_Mision));
            $this->CLI_Vision = htmlspecialchars(mysql_real_escape_string($this->CLI_Vision));
            $this->CLI_ObjetivosEstrategicos = mysql_real_escape_string(strip_tags($this->CLI_ObjetivosEstrategicos));
			$this->CLI_CustomerKey = htmlspecialchars(strip_tags($this->CLI_CustomerKey));
			$this->CLI_InfoBasicaKey = htmlspecialchars(strip_tags($this->CLI_InfoBasicaKey));
			$this->CLI_USerKey = htmlspecialchars(strip_tags($this->CLI_USerKey));
			$this->CLI_DateStamp = htmlspecialchars(strip_tags($this->CLI_DateStamp));

             // OK
             $this->CLI_ActividadEconomica =trim($this->CLI_ActividadEconomica);
             $this->CLI_ObjetoSocial = trim($this->CLI_ObjetoSocial);
             $this->CLI_DescripcionGeneral = trim($this->CLI_DescripcionGeneral);
             $this->CLI_Mision = trim($this->CLI_Mision);
             $this->CLI_Vision = trim($this->CLI_Vision);
             $this->CLI_ObjetivosEstrategicos = trim($this->CLI_ObjetivosEstrategicos);
             $this->CLI_CustomerKey = htmlspecialchars(strip_tags($this->CLI_CustomerKey));
             $this->CLI_InfoBasicaKey = htmlspecialchars(strip_tags($this->CLI_InfoBasicaKey));
             $this->CLI_USerKey = htmlspecialchars(strip_tags($this->CLI_USerKey));
             $this->CLI_DateStamp = htmlspecialchars(strip_tags($this->CLI_DateStamp));  

            //OK
            $this->CLI_ActividadEconomica = htmlspecialchars($this->CLI_ActividadEconomica);
            $this->CLI_ObjetoSocial = htmlspecialchars($this->CLI_ObjetoSocial);
            $this->CLI_DescripcionGeneral = htmlspecialchars($this->CLI_DescripcionGeneral);
            $this->CLI_Mision = htmlspecialchars($this->CLI_Mision);
            $this->CLI_Vision = htmlspecialchars($this->CLI_Vision);
            $this->CLI_ObjetivosEstrategicos = htmlspecialchars($this->CLI_ObjetivosEstrategicos);
			$this->CLI_CustomerKey = htmlspecialchars(strip_tags($this->CLI_CustomerKey));
			$this->CLI_InfoBasicaKey = htmlspecialchars(strip_tags($this->CLI_InfoBasicaKey));
			$this->CLI_USerKey = htmlspecialchars(strip_tags($this->CLI_USerKey));
			$this->CLI_DateStamp = htmlspecialchars(strip_tags($this->CLI_DateStamp));

           

           */
		
			// bind data
			$stmt->bindParam(":ae", $this->CLI_ActividadEconomica, PDO::PARAM_STR);
			$stmt->bindParam(":os", $this->CLI_ObjetoSocial, PDO::PARAM_STR);
			$stmt->bindParam(":dg", $this->CLI_DescripcionGeneral, PDO::PARAM_STR);
			$stmt->bindParam(":mi", $this->CLI_Mision, PDO::PARAM_STR);
            $stmt->bindParam(":vi", $this->CLI_Vision, PDO::PARAM_STR);
            $stmt->bindParam(":oe", $this->CLI_ObjetivosEstrategicos, PDO::PARAM_STR);
			$stmt->bindParam(":ck", $this->CLI_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":ik", $this->CLI_InfoBasicaKey, PDO::PARAM_STR);
			$stmt->bindParam(":wk", $this->CLI_USerKey, PDO::PARAM_STR);
			$stmt->bindParam(":ds", $this->CLI_DateStamp, PDO::PARAM_STR);
		
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
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE CTX_IdContexto = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->CTX_IdContexto = htmlspecialchars(strip_tags($this->CTX_IdContexto));

            // bind data
            $stmt->bindParam(1, $this->CTX_IdContexto, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

<?php
    class Control{

        // Connection
        private $conn;

        // Table
        private $db_table = "Control";

        // Columns
        public $CON_LlaveAcceso;
		public $CON_LlaveInicial;
		public $CON_LlaveIv;
		public $CON_MetodoEncriptacion;
		public $CON_TipoHash;
		public $CON_Cookie;
        public $CON_IdControl;       
        //public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getControl(){
            $sqlQuery = "SELECT CON_IdControl, CON_LlaveAcceso, CON_LlaveInicial, CON_LlaveIv, CON_MetodoEncriptacion, CON_TipoHash, CON_Cookie, STA_Nombre FROM " . $this->db_table . "
			 JOIN State ON STA_IdEstado = CON_IdEstado ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createPais(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        PAI_Nombre = :nombre,
						PAI_IdEstado = :estado";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->PAI_Nombre = htmlspecialchars(strip_tags($this->PAI_Nombre));
			$this->PAI_IdEstado = htmlspecialchars(strip_tags($this->PAI_IdEstado));
        
            // bind data
            $stmt->bindParam(":nombre", $this->PAI_Nombre);
			$stmt->bindParam(":estado", $this->PAI_IdEstado);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getIdPais(){
            $sqlQuery = "SELECT
                        PAI_IdPais, 
                        PAI_Nombre,
						PAI_IdEstado
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       PAI_IdPais = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->PAI_IdPais);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->PAI_Nombre = $dataRow['PAI_Nombre'];
			$this->PAI_IdEstado = $dataRow['PAI_IdEstado'];            
        }        
		
		// Busca Nombre
        public function getBuscaNombre(){
            $sqlQuery = "SELECT                         
                        count(PAI_IdPais) AS PAI_Nombre
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       PAI_Nombre = ? AND PAI_IdPais <> ? ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->PAI_Nombre);
			$stmt->bindParam(2, $this->PAI_IdPais);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->PAI_Nombre = $dataRow['PAI_Nombre'];            
        }

        // UPDATE
        public function updatePais(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        PAI_Nombre = :nombre, 
						PAI_IdEstado = :estado
                    WHERE 
                        PAI_IdPais = :id;";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->PAI_Nombre=htmlspecialchars(strip_tags($this->PAI_Nombre));
			$this->PAI_IdEstado=htmlspecialchars(strip_tags($this->PAI_IdEstado));
            $this->PAI_IdPais=htmlspecialchars(strip_tags($this->PAI_IdPais));
        
            // bind data
            $stmt->bindParam(":nombre", $this->PAI_Nombre);
			$stmt->bindParam(":estado", $this->PAI_IdEstado);
            $stmt->bindParam(":id", $this->PAI_IdPais);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletePais(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE PAI_IdPais = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->PAI_IdPais = htmlspecialchars(strip_tags($this->PAI_IdPais));
        
            $stmt->bindParam(1, $this->PAI_IdPais);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
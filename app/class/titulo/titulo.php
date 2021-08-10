<?php
    class Titulo{

        // Connection
        private $conn;

        // Table
        private $db_table = "TIT_Titulo";

        // Columns
		public $TIT_IdTitulo;
		public $TIT_Nombre;
		public $TIT_CustomerKey;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAll(){
            $sql = "SELECT TIT_IdTitulo, TIT_Nombre, TIT_CustomerKey
            FROM ". $this->db_table ." ORDER BY TIT_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// GET ALL por CK
        public function getCkAll(){
            $sql = "SELECT  TIT_IdTitulo, TIT_Nombre, TIT_CustomerKey
            FROM ". $this->db_table ." WHERE TIT_CustomerKey = ? ORDER BY TIT_Nombre ";
            //echo $sql;
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(1, $this->CSC_CustomerKey);
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
            $sql = "SELECT count(CSC_IdConsecuencia) AS CSC_Nombre
                      FROM ". $this->db_table ."
                    WHERE CSC_Nombre = ? AND CSC_IdConsecuencia <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->CSC_Nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->CSC_IdConsecuencia, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CSC_Nombre = $dataRow['CSC_Nombre'];
        }
		
		// CREATE
		public function create(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (CSC_CustomerKey, CSC_UserKey, CSC_Nombre, CSC_Escala, CSC_Color, CSC_TipoRiesgoKey, DateStamp) VALUES ( :ck, :uk, :nombre, :escala, :color, :trk, :ds )";
			//echo $sqlQuery ;
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->CSC_CustomerKey = htmlspecialchars(strip_tags($this->CSC_CustomerKey));
			$this->CSC_UserKey = htmlspecialchars(strip_tags($this->CSC_UserKey));            
			$this->CSC_Nombre = htmlspecialchars(strip_tags($this->CSC_Nombre));
            $this->CSC_Escala = htmlspecialchars(strip_tags($this->CSC_Escala));
          //$this->CSC_Color = htmlspecialchars(strip_tags($this->CSC_Color));
            $this->CSC_Color = '#'.$this->CSC_Color;
            $this->CSC_TipoRiesgoKey = htmlspecialchars(strip_tags($this->CSC_TipoRiesgoKey));
            $this->DateStamp = htmlspecialchars(strip_tags($this->DateStamp));
		
			// bind data
			$stmt->bindParam(":ck", $this->CSC_CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":uk", $this->CSC_UserKey, PDO::PARAM_STR);            
			$stmt->bindParam(":nombre", $this->CSC_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":escala", $this->CSC_Escala, PDO::PARAM_STR);
            $stmt->bindParam(":color", $this->CSC_Color, PDO::PARAM_STR);
            $stmt->bindParam(":trk", $this->CSC_TipoRiesgoKey, PDO::PARAM_STR);
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
                    TIT_Nombre = :nombre,
                    TIT_CustomerKey = :ck
                    WHERE TIT_IdTitulo = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->TIT_Nombre=htmlspecialchars(strip_tags($this->TIT_Nombre));
            $this->TIT_CustomerKey=htmlspecialchars(strip_tags($this->TIT_CustomerKey));
            $this->TIT_IdTitulo=htmlspecialchars(strip_tags($this->TIT_IdTitulo));
        
            // bind data
            $stmt->bindParam(":nombre", $this->TIT_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(":ck", $this->TIT_CustomerKey, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->TIT_IdTitulo, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }        

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE TIT_IdTitulo = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->TIT_IdTitulo = htmlspecialchars(strip_tags($this->TIT_IdTitulo));

            // bind data
            $stmt->bindParam(1, $this->TIT_IdTitulo, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

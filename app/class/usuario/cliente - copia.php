<?php
    class customer{

        // Connection
        private $conn;

        // Table
        private $db_table = "CustomerSarlaft";

        // Columns
		public $CLI_IdCliente;
		public $CLI_IdTipoDocumento;
		public $CLI_Identificacion;
        public $CLI_Nombre;
		public $CLI_PrimerApellido;
		public $CLI_SegundoApellido;
		public $CLI_Direccion;
		public $CLI_Celular;
		public $CLI_Fijo;
		public $CLI_Email;
		public $CLI_IdTipoPersona;
		public $CLI_TipoCliente;
		public $CLI_IdCiudad;
		public $CLI_IdEstado;
        //public $created; 710908

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCliente(){
            $sqlQuery = "SELECT CLI_IdCliente, concat_ws(' ',CLI_Nombre, CLI_PrimerApellido, CLI_SegundoApellido) AS CLI_Nombre, CLI_Direccion, CLI_Celular, CLI_Email, TIP_Nombre, CLI_Identificacion, TID_Nombre, CIU_Nombre, EST_Nombre FROM " . $this->db_table . "
			JOIN gen_tipodocumento ON TID_IdTipoDocumento = CLI_IdTipoDocumento AND TID_IdEstado = 1
			JOIN gen_tipopersoneria ON TIP_IdTipoPersona = CLI_IdTipoPersona AND TIP_IdEstado = 1
			JOIN gen_ciudad ON CIU_IdCiudad = CLI_IdCiudad AND CIU_IdEstado = 1
      JOIN gen_estado ON EST_IdEstado = CLI_IdEstado
      ORDER BY CLI_Nombre; ";			
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCliente(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        CLI_IdTipoDocumento = :tipodocumento,
						CLI_Identificacion = :documento,
						CLI_Nombre = :nombre,
						CLI_PrimerApellido = :ape1,
						CLI_SegundoApellido = :ape2,
						CLI_Direccion = :direccion,
						CLI_IdCiudad = :ciudad,
						CLI_Email = :email,
						CLI_Celular = :celular,					
						CLI_Fijo = :fijo,
						CLI_IdTipoPersona = :tipopersona,
						CLI_TipoCliente = :tipocliente, 
						CLI_IdEstado = :estado ";
			
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->CLI_IdTipoDocumento = htmlspecialchars(strip_tags($this->CLI_IdTipoDocumento));
			$this->CLI_Identificacion = htmlspecialchars(strip_tags($this->CLI_Identificacion));
			$this->CLI_Nombre = htmlspecialchars(strip_tags($this->CLI_Nombre));
			$this->CLI_PrimerApellido = htmlspecialchars(strip_tags($this->CLI_PrimerApellido));
			$this->CLI_SegundoApellido = htmlspecialchars(strip_tags($this->CLI_SegundoApellido));
			$this->CLI_Direccion = htmlspecialchars(strip_tags($this->CLI_Direccion));
			$this->CLI_IdCiudad = htmlspecialchars(strip_tags($this->CLI_IdCiudad));
			$this->CLI_Email = htmlspecialchars(strip_tags($this->CLI_Email));
			$this->CLI_Celular = htmlspecialchars(strip_tags($this->CLI_Celular));
			$this->CLI_Fijo = htmlspecialchars(strip_tags($this->CLI_Fijo));
			$this->CLI_IdTipoPersona = htmlspecialchars(strip_tags($this->CLI_IdTipoPersona));
			$this->CLI_TipoCliente = htmlspecialchars(strip_tags($this->CLI_TipoCliente));			
			$this->CLI_IdEstado = htmlspecialchars(strip_tags($this->CLI_IdEstado));			
        
            // bind data
			$stmt->bindParam(":tipodocumento", $this->CLI_IdTipoDocumento);
			$stmt->bindParam(":documento", $this->CLI_Identificacion);
            $stmt->bindParam(":nombre", $this->CLI_Nombre);
			$stmt->bindParam(":ape1", $this->CLI_PrimerApellido);
			$stmt->bindParam(":ape2", $this->CLI_SegundoApellido);
			$stmt->bindParam(":direccion", $this->CLI_Direccion);
			$stmt->bindParam(":ciudad", $this->CLI_IdCiudad);			
			$stmt->bindParam(":email", $this->CLI_Email);
			$stmt->bindParam(":celular", $this->CLI_Celular);
			$stmt->bindParam(":fijo", $this->CLI_Fijo);
			$stmt->bindParam(":tipopersona", $this->CLI_IdTipoPersona);
			$stmt->bindParam(":tipocliente", $this->CLI_TipoCliente);
			$stmt->bindParam(":estado", $this->CLI_IdEstado);			
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getIdCliente(){
            $sqlQuery = "SELECT
						CLI_IdCliente,
                        CLI_IdTipoDocumento,
						CLI_Identificacion,
						CLI_Nombre,
						CLI_PrimerApellido,
						CLI_SegundoApellido,
						CLI_Direccion,
						CLI_IdCiudad,
						CLI_Email,
						CLI_Celular,					
						CLI_Fijo,
						CLI_IdTipoPersona,
						CLI_TipoCliente, 
						CLI_IdEstado
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       CLI_IdCliente = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->CLI_IdCliente);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->CLI_IdCliente = $dataRow['CLI_IdCliente'];
			$this->CLI_IdTipoDocumento = $dataRow['CLI_IdTipoDocumento'];
			$this->CLI_Identificacion = $dataRow['CLI_Identificacion'];
            $this->CLI_Nombre = $dataRow['CLI_Nombre'];
			$this->CLI_PrimerApellido = $dataRow['CLI_PrimerApellido'];
			$this->CLI_SegundoApellido = $dataRow['CLI_SegundoApellido'];
			$this->CLI_Direccion = $dataRow['CLI_Direccion'];
			$this->CLI_IdCiudad = $dataRow['CLI_IdCiudad'];
			$this->CLI_Email = $dataRow['CLI_Email'];
			$this->CLI_Celular = $dataRow['CLI_Celular'];
			$this->CLI_Fijo = $dataRow['CLI_Fijo'];
			$this->CLI_IdTipoPersona = $dataRow['CLI_IdTipoPersona'];			
			$this->CLI_TipoCliente = $dataRow['CLI_TipoCliente'];
			$this->CLI_IdEstado = $dataRow['CLI_IdEstado'];            
        }        
		
		// Busca Nombre Duplicados
        public function getBuscaNombre(){
            $sqlQuery = "SELECT                         
                        count(CLI_IdCliente) AS CLI_Nombre
                    FROM
                        ". $this->db_table ."
                    WHERE 
                       (CLI_Nombre = ? AND CLI_PrimerApellido = ? AND CLI_SegundoApellido = ?) OR (CLI_Nombre = ?) OR CLI_Email = ? AND CLI_IdCliente <> ? AND CLI_IdEstado = 1 ; ";

            $stmt = $this->conn->prepare($sqlQuery);			

            $stmt->bindParam(1, $this->CLI_Nombre);
			$stmt->bindParam(2, $this->CLI_PrimerApellido);
			$stmt->bindParam(3, $this->CLI_SegundoApellido);
			$stmt->bindParam(4, $this->CLI_NombrePJ);
			$stmt->bindParam(5, $this->CLI_Email);			
			$stmt->bindParam(6, $this->CLI_IdCliente);			

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CLI_Nombre = $dataRow['CLI_Nombre'];            
        }
		
		// Busca Nro. Documento Duplicado
        public function getBuscaDocumentoDuplicado(){
            $sqlQuery = "SELECT                         
                        count(CLI_IdCliente) AS CLI_Nombre
                    FROM
                        ". $this->db_table ."
                    WHERE 
                       CLI_Identificacion = ? AND CLI_IdEstado = 1 ; ";

            $stmt = $this->conn->prepare($sqlQuery);
            
			$stmt->bindParam(1, $this->CLI_Identificacion);			
			//$stmt->bindParam(6, $this->CLI_IdCliente);			

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CLI_Nombre = $dataRow['CLI_Nombre'];            
        }
		
		// Busca Nombre Duplicados
        public function getBuscaNombrePJDuplicado(){
            $sqlQuery = "SELECT                         
                        count(CLI_IdCliente) AS CLI_Nombre
                    FROM
                        ". $this->db_table ."
                    WHERE 
                       CLI_Nombre = ? AND CLI_IdCliente <> ? AND CLI_IdTipoPersona = 2 AND CLI_IdEstado = 1 ; ";

            $stmt = $this->conn->prepare($sqlQuery);
            
			$stmt->bindParam(1, $this->CLI_NombrePJ);			
			$stmt->bindParam(2, $this->CLI_IdCliente);			

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CLI_Nombre = $dataRow['CLI_Nombre'];            
        }
		
		// Busca Nombre Duplicados
        public function getBuscaNombreDuplicado(){
            $sqlQuery = "SELECT                         
                        count(CLI_IdCliente) AS CLI_Nombre
                    FROM
                        ". $this->db_table ."
                    WHERE 
                       CLI_Nombre = ? AND CLI_PrimerApellido = ? AND CLI_SegundoApellido = ? AND CLI_IdCliente <> ? AND CLI_IdEstado = 1 ; ";

            $stmt = $this->conn->prepare($sqlQuery);			

            $stmt->bindParam(1, $this->CLI_Nombre);
			$stmt->bindParam(2, $this->CLI_PrimerApellido);
			$stmt->bindParam(3, $this->CLI_SegundoApellido);
			$stmt->bindParam(4, $this->CLI_IdCliente);	

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CLI_Nombre = $dataRow['CLI_Nombre'];            
        }
		
		// Busca Email Duplicados
        public function getBuscaEmailDuplicado(){
            $sqlQuery = "SELECT                         
                        count(CLI_IdCliente) AS CLI_Nombre
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       CLI_Email = ? AND CLI_IdEstado = 1 ; ";

            $stmt = $this->conn->prepare($sqlQuery);
           			
			$stmt->bindParam(1, $this->CLI_Email);
			//$stmt->bindParam(2, $this->USU_IdUsuario);			

            $stmt->execute();			

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CLI_Nombre = $dataRow['CLI_Nombre'];            
        }
		
		// Busca Email Duplicados
        public function getBuscaCelularDuplicado(){
            $sqlQuery = "SELECT                         
                        count(CLI_IdCliente) AS CLI_Nombre
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       CLI_Celular = ? AND CLI_IdEstado = 1 ; ";

            $stmt = $this->conn->prepare($sqlQuery);
           			
			$stmt->bindParam(1, $this->CLI_Celular);			

            $stmt->execute();			

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CLI_Nombre = $dataRow['CLI_Nombre'];            
        }
		
		// Busca Email Duplicados
        public function getBuscaEmail(){
            $sqlQuery = "SELECT                         
                        count(CLI_IdCliente) AS CLI_Nombre
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       CLI_Email = ? AND CLI_IdCliente <> ? AND CLI_IdEstado = 1 ; ";

            $stmt = $this->conn->prepare($sqlQuery);
           			
			$stmt->bindParam(1, $this->CLI_Email);
			$stmt->bindParam(2, $this->CLI_IdCliente);			

            $stmt->execute();			

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CLI_Nombre = $dataRow['CLI_Nombre'];            
        }
		
		//Busca Usuario y Clave
		public function getBuscaUsuarioEmail(){
			$sqlQuery = "SELECT                         
                        count(USU_IdUsuario) AS USU_Nombre, USU_Clave, USU_IdUsuario, concat_ws(' ',USU_Nombre, USU_PrimerApellido, USU_SegundoApellido) AS NombreUsuario, USU_Email
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       USU_Usuario = ? ";

            $stmt = $this->conn->prepare($sqlQuery);
            
			$stmt->bindParam(1, $this->USU_Usuario);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->USU_Nombre = $dataRow['USU_Nombre'];
			$this->USU_Clave = $dataRow['USU_Clave'];
			$this->USU_IdUsuario = $dataRow['USU_IdUsuario'];
			$this->NombreUsuario = $dataRow['NombreUsuario'];
			$this->USU_Email = $dataRow['USU_Email'];
		}
		

        // UPDATE
        public function updateCliente(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        CLI_IdTipoPersona = :tipopersona,
						CLI_IdTipoDocumento = :tipodocumento,
						CLI_Identificacion = :documento ,
						CLI_Nombre = :nombre,
						CLI_PrimerApellido = :ape1,
						CLI_SegundoApellido = :ape2,
						CLI_Direccion = :direccion,
						CLI_IdCiudad = :ciudad,
						CLI_Email = :email,
						CLI_Celular = :celular,
						CLI_Fijo = :fijo,
						CLI_TipoCliente = :tipousuario,
						CLI_IdEstado = :estado
                    WHERE 
                        CLI_IdCliente = :id;";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->CLI_IdTipoPersona=htmlspecialchars(strip_tags($this->CLI_IdTipoPersona));
			$this->CLI_IdTipoDocumento=htmlspecialchars(strip_tags($this->CLI_IdTipoDocumento));
			$this->CLI_Identificacion=htmlspecialchars(strip_tags($this->CLI_Identificacion));			
			$this->CLI_Nombre=htmlspecialchars(strip_tags($this->CLI_Nombre));
			$this->CLI_PrimerApellido=htmlspecialchars(strip_tags($this->CLI_PrimerApellido));
			$this->CLI_SegundoApellido=htmlspecialchars(strip_tags($this->CLI_SegundoApellido));			
			$this->CLI_Direccion=htmlspecialchars(strip_tags($this->CLI_Direccion));
			$this->CLI_IdCiudad=htmlspecialchars(strip_tags($this->CLI_IdCiudad));			
			$this->CLI_Email=htmlspecialchars(strip_tags($this->CLI_Email));
			$this->CLI_Celular=htmlspecialchars(strip_tags($this->CLI_Celular));
			$this->CLI_Fijo=htmlspecialchars(strip_tags($this->CLI_Fijo));
			$this->CLI_TipoCliente=htmlspecialchars(strip_tags($this->CLI_TipoCliente));
			$this->CLI_IdEstado=htmlspecialchars(strip_tags($this->CLI_IdEstado));
            $this->CLI_IdCliente=htmlspecialchars(strip_tags($this->CLI_IdCliente));
        
            // bind data
            $stmt->bindParam(":tipopersona", $this->CLI_IdTipoPersona);
			$stmt->bindParam(":tipodocumento", $this->CLI_IdTipoDocumento);
			$stmt->bindParam(":documento", $this->CLI_Identificacion);			
			$stmt->bindParam(":nombre", $this->CLI_Nombre);
			$stmt->bindParam(":ape1", $this->CLI_PrimerApellido);
			$stmt->bindParam(":ape2", $this->CLI_SegundoApellido);
			$stmt->bindParam(":direccion", $this->CLI_Direccion);
			$stmt->bindParam(":ciudad", $this->CLI_IdCiudad);
			$stmt->bindParam(":email", $this->CLI_Email);
			$stmt->bindParam(":celular", $this->CLI_Celular);
			$stmt->bindParam(":fijo", $this->CLI_Fijo);
			$stmt->bindParam(":tipousuario", $this->CLI_TipoCliente);			
			$stmt->bindParam(":estado", $this->CLI_IdEstado);
            $stmt->bindParam(":id", $this->CLI_IdCliente);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteCliente(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE CLI_IdCliente = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->CLI_IdCliente = htmlspecialchars(strip_tags($this->CLI_IdCliente));
        
            $stmt->bindParam(1, $this->CLI_IdCliente);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

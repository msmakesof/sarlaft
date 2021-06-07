<?php
    class UsersAuth{

        // Connection
        private $conn;

        // Table
        private $db_table = "UsersAuth";

        // Columns
		public $id;
		public $IdUser;
		public $CustomerKey;
        public $UserKey;
		public $UserEmail;
		public $UserName;
		public $UserTipo;
		public $UserStatus;
		public $Password;
		public $Salt;
		public $UserColor;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUsuario(){
            //$sql = "SELECT id, UserName, UserEmail, UserStatus, STA_Nombre FROM ". $this->db_table ." 
            $sql = "SELECT UsersAuth.id, IdUser, UsersAuth.CustomerKey ,UsersAuth.UserKey, UserEmail, UserName ,UserTipo ,UserStatus ,Password ,Salt ,UserColor, STA_Nombre, CustomerName FROM ". $this->db_table .            
            " JOIN State ON UserStatus = STA_IdEstado 
              LEFT JOIN  CustomerSarlaft ON CustomerSarlaft.CustomerKey = UsersAuth.CustomerKey 
            ORDER BY UserName ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		// READ single ID
        public function getUserKey(){
            $sql = "SELECT TOP 1 id, IdUser, CustomerKey ,UserKey ,UserEmail ,UserName ,UserTipo ,UserStatus ,Password ,Salt ,UserColor FROM ". $this->db_table ." WHERE UserKey = ? ";			

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->UserKey);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->UserKey = $dataRow['UserKey'];
			$this->id = $dataRow['id'];
			$this->IdUser = $dataRow['IdUser'];
			$this->CustomerKey = $dataRow['CustomerKey'];            
			$this->UserEmail = $dataRow['UserEmail'];
			$this->UserName = $dataRow['UserName'];
			$this->UserTipo = $dataRow['UserTipo'];
			$this->UserStatus = $dataRow['UserStatus'];
			$this->Password = $dataRow['Password'];
			$this->Salt = $dataRow['Salt'];
			$this->UserColor = $dataRow['UserColor'];           
        }

        // Buscar Usuario por Email y Clave
        public function getBuscar(){
            $sql = "SELECT id, UserKey, CustomerKey, UserEmail ,UserName ,UserTipo ,UserStatus, count(id) totregs FROM ". $this->db_table ." WHERE UserEmail = ? AND  Password = ? GROUP BY id, UserKey, CustomerKey, UserEmail ,UserName ,UserTipo ,UserStatus ";
            //echo $sql;

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->UserEmail);
            $stmt->bindParam(2, $this->Password);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
			$this->totregs = $dataRow['totregs'];
            $this->UserKey = $dataRow['UserKey'];
			$this->CustomerKey = $dataRow['CustomerKey'];            
			$this->UserEmail = $dataRow['UserEmail'];
			$this->UserName = $dataRow['UserName'];
			$this->UserTipo = $dataRow['UserTipo'];
			$this->UserStatus = $dataRow['UserStatus'];         
        }
		
		// UPD User Status
        public function updateUserStatus(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET UserStatus = :userstatus
                    WHERE id = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->UserStatus=htmlspecialchars(strip_tags($this->UserStatus));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":userstatus", $this->UserStatus, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

		// UPD User Color
        public function updateUserColor(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET UserColor = :usercolor
                    WHERE UserKey = :userkey ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->UserColor=htmlspecialchars(strip_tags($this->UserColor));
            $this->UserKey=htmlspecialchars(strip_tags($this->UserKey));
        
            // bind data
            $stmt->bindParam(":usercolor", $this->UserColor, PDO::PARAM_STR);
            $stmt->bindParam(":userkey", $this->UserKey, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Busca Nombre para controlar Duplicados
        public function getBuscaNombre(){
            $sql = "SELECT count(id) AS UserName
                      FROM ". $this->db_table ."
                    WHERE UserName = ? AND id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->UserName, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->UserName = $dataRow['UserName'];
        }

        // CREATE
		public function createUsuario(){
			$sqlQuery = "INSERT INTO ". $this->db_table ." (CustomerKey, UserName, UserEmail, Password, UserStatus, UserColor, UserTipo, UserKey, Salt ) 
            VALUES ( :customerkey, :nombreusuario, :email, :password, :idestado, :usercolor, :usertipo, :userkey, :salt )";
			//echo $sqlQuery ;
			
			$stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
			// sanitize
			$this->CustomerKey = htmlspecialchars(strip_tags($this->CustomerKey));
            $this->UserName = htmlspecialchars(strip_tags($this->UserName));
            $this->UserEmail = htmlspecialchars(strip_tags($this->UserEmail));
            $this->Password = htmlspecialchars(strip_tags($this->Password));
			$this->UserStatus = htmlspecialchars(strip_tags($this->UserStatus));
            $this->UserColor = htmlspecialchars(strip_tags($this->UserColor));
            $this->UserTipo = htmlspecialchars(strip_tags($this->UserTipo));
            $this->UserKey = htmlspecialchars(strip_tags($this->UserKey));
            $this->Salt = htmlspecialchars(strip_tags($this->Salt));
		
			// bind data
			$stmt->bindParam(":customerkey", $this->CustomerKey, PDO::PARAM_STR);
            $stmt->bindParam(":nombreusuario", $this->UserName, PDO::PARAM_STR);
            $stmt->bindParam(":email", $this->UserEmail, PDO::PARAM_STR);
            $stmt->bindParam(":password", $this->Password, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->UserStatus, PDO::PARAM_INT);
            $stmt->bindParam(":usercolor", $this->UserColor, PDO::PARAM_STR);
            $stmt->bindParam(":usertipo", $this->UserTipo, PDO::PARAM_STR);
            $stmt->bindParam(":userkey", $this->UserKey, PDO::PARAM_STR);
            $stmt->bindParam(":salt", $this->Salt, PDO::PARAM_STR);

		
			if($stmt->execute()){
				return true;
			}
			return false;
		}

        // UPDATE
        public function updateUsuario(){
            $sqlQuery = "UPDATE ". $this->db_table ."
                    SET
                        CustomerKey = :customerkey,
                        UserName = :usuarionombre,
                        UserEmail = :email,
                        Password = :password,
						UserStatus = :idestado
                    WHERE id = :id ";
			//echo   $sqlQuery;
        
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->CustomerKey=htmlspecialchars(strip_tags($this->CustomerKey));
			$this->UserName=htmlspecialchars(strip_tags($this->UserName));
            $this->UserEmail=htmlspecialchars(strip_tags($this->UserEmail));
			$this->Password=htmlspecialchars(strip_tags($this->Password));
            $this->UserStatus=htmlspecialchars(strip_tags($this->UserStatus));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":customerkey", $this->CustomerKey, PDO::PARAM_STR);
			$stmt->bindParam(":usuarionombre", $this->UserName, PDO::PARAM_STR);
            $stmt->bindParam(":email", $this->UserEmail, PDO::PARAM_STR);
            $stmt->bindParam(":password", $this->Password, PDO::PARAM_STR);
			$stmt->bindParam(":idestado", $this->UserStatus, PDO::PARAM_INT);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUsuario(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ? ";
            $stmt = $this->conn->prepare($sqlQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        
            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

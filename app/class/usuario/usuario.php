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
            $sql = "SELECT id, IdUser, CustomerKey ,UserKey ,UserEmail ,UserName ,UserTipo ,UserStatus ,Password ,Salt ,UserColor FROM ". $this->db_table ." ORDER BY UserName ";
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
    }
?>

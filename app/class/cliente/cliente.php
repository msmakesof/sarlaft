<?php
    class CustomerSarlaft{

        // Connection
        private $conn;

        // Table
        private $db_table = "CustomerSarlaft";

        // Columns
		public $id;
		public $CustomerDB;
		public $CustomerLogo;
        public $CustomerName;
		public $CustomerNit;
		public $CustomerCity;
		public $CustomerColor;
		public $CustomerStatus;
		public $UserKey;
		public $DateStamp;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCliente(){
            $sql = "SELECT id, CustomerKey ,CustomerDB ,CustomerLogo ,CustomerName ,CustomerNit ,CustomerCity ,CustomerColor ,CustomerStatus ,UserKey ,DateStamp FROM ". $this->db_table ." ORDER BY CustomerName; ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
		
		public function getIdCliente(){
            $sql = "SELECT id, CustomerKey ,CustomerDB ,CustomerLogo ,CustomerName ,CustomerNit ,CustomerCity ,CustomerColor ,CustomerStatus ,UserKey ,DateStamp FROM ". $this->db_table ." ORDER BY CustomerName; ";
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			return $stmt;
        }
    }
?>

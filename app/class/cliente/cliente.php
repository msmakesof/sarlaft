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
		public function getListaCliente(){
            $sql = "SELECT id, CustomerKey, CustomerName FROM ". $this->db_table ." ORDER BY CustomerName; ";
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

        // Busca Nombre para controlar Duplicados
        public function getBuscaNombre(){
            $sql = "SELECT count(id) AS CustomerName
                      FROM ". $this->db_table ."
                    WHERE CustomerName = ? AND id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->CustomerName, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CustomerName = $dataRow['CustomerName'];
        }

        // Busca Nit para controlar Duplicados
        public function getBuscaNit(){
            $sql = "SELECT count(id) AS CustomerNit
                      FROM ". $this->db_table ."
                    WHERE CustomerNit = ? AND id <> ? ";

            $stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $stmt->bindParam(1, $this->CustomerNit, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->CustomerNit = $dataRow['CustomerNit'];
        }
    }
?>

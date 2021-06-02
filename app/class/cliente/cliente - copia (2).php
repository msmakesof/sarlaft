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
            $sql = "SELECT id, CustomerKey ,CustomerDB ,CustomerLogo ,CustomerName ,CustomerNit ,CustomerCity ,CustomerColor ,CustomerStatus ,UserKey ,DateStamp FROM " . $this->db_table . " ORDER BY CustomerName; ";	
			
			
			//$sql = 'select * from ViewProduct';
			$params = array();
			$options = array('Scrollable' => SQLSRV_CURSOR_KEYSET);
			$stmt = sqlsrv_query($this->conn, $sql, $params, $options);
			$count = sqlsrv_num_rows($stmt);

			if ($count === false)
				echo "Error in retrieveing row count.";
			else
			echo $count;
			
			//$conn = sqlsrv_connect($serverName, $this->conn);
			//$tsql = $sqlQuery ;  //"SELECT * FROM tadatable";    

			/* Execute the query. */    
/*
			$stmt = sqlsrv_query( $this->conn, $tsql);
			if($stmt === false) {
				die( print_r( sqlsrv_errors(), true) );
			}
			sqlsrv_execute($stmt);
			$stmt->execute();
            return $stmt; */

			
			
			////echo  $sqlQuery;
			//echo "cnn...".$this->conn;
            ////$stmt = $this->conn->prepare($sqlQuery);
			
			//$query_empresa=sqlsrv_query($this->conn,"SELECT id, CustomerKey ,CustomerDB FROM CustomerSarlaft ");
			//$stmt=sqlsrv_fetch_array($query_empresa);            
			
			//$stmt = sqlsrv_prepare( $this->conn, $sqlQuery, array());
			/*$stmt = sqlsrv_prepare( $this->conn, $sqlQuery);
			sqlsrv_execute($stmt);
			while ($row = sqlsrv_fetch_array($rst)) {
				echo $row['CustomerKey'];
			}*/
			
			/*
			$result = sqlsrv_execute($stmt);
			if ($result === true) {
			 while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					$results = $row;
				}
				return $results;
			} else {
				return false;
			} */
			
			
			/*if( !$stmt ) {
				die( print_r( sqlsrv_errors(), true));
			}
			$stmt->execute();
            return $stmt; */
        }       

    }
?>

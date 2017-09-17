<?php
	class Database{
		public $conn;
		public function __construct(){
			try{
				$this->conn = new PDO("mysql:host=localhost;dbname=medicine_store;charset=utf8", "root", "");
				// set the PDO error mode to exception
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				
				//echo 'Connected';
				
			}catch(PDOException $e){
				echo "Connection failed: " . $e->getMessage(); 
			}
		}
	}
?>
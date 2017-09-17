<?php
	require('dbclass.php');
	
	
	class DataOperation extends Database{
		
		public function insert_record($table,$fields){
			if($fields["m_name"]!="" && $fields["qty"]!=""){
				$sql = "INSERT INTO ".$table." (".implode(",",array_keys($fields)).") VALUES ('".implode("','",array_values($fields))."')";
				
				$statement = $this->conn->prepare($sql);
				
				if($statement->execute()){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		public function fetch_record($table){
			$sql = "SELECT * FROM ".$table;
			$med_array = array();
			
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			
			while($row = $stmt->fetch()){
				$med_array[] = $row;
			}
			
			return $med_array;
			
		}
		
		public function select_record($table,$where){
			$condition = "";
			
			/*Right now we only have one element that is id in the $where associative array. We could have other associative arrays in future that will use this same method. So we are using for each loop.*/
			
			foreach($where as $key=>$value){
				$condition .= $key."='".$value."' AND ";
			}
			
			//now remove the last and from the $condition variable
			
			$condition = substr($condition,0,-5);
			
			$sql = "SELECT * FROM ".$table." WHERE ".$condition;
			
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			
			$row = $stmt->fetch();
			
			return $row;
			
		}
		
		public function delete_record($table,$where){
			$condition = "";
			
			/*Right now we only have one element that is id in the $where associative array. We could have other associative arrays in future that will use this same method. So we are using for each loop.*/
			
			foreach($where as $key=>$value){
				$condition .= $key."='".$value."' AND ";
			}
			
			//now remove the last and from the $condition variable
			
			$condition = substr($condition,0,-5);
			
			$sql = "DELETE FROM ".$table." WHERE ".$condition;
			
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			
			
		}
		
		public function update_record($table,$where,$array){
			
			if($array["m_name"]!="" && $array["qty"]!=""){
				$condition = "";
				$set = "";
				
				/*Right now we only have one element that is id in the $where associative array. We could have other associative arrays in future that will use this same method. So we are using for each loop.*/
				
				foreach($where as $key=>$value){
					$condition .= $key."='".$value."' AND ";
				}
				
				//now remove the last and from the $condition variable
				
				$condition = substr($condition,0,-5);
				
				foreach($array as $k=>$v){
					$set .= $k."='".$v."',";
				}
				
				//now remove the last and form the $set variable
				$set = substr($set,0,-1);
				
				$sql = "UPDATE ".$table." SET ".$set." WHERE ".$condition;
				
				$stmt = $this->conn->prepare($sql);
				if($stmt->execute()){
					return true;
				}else{
					return false;
				}
				
			}else{
				return false;
			}
			
		}
	}
?>
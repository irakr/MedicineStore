<?php
	require("actionclass.php");
	
	$obj = new DataOperation();
	
	if(isset($_POST["submit"])){
		$arr = array(
			"m_name"=>$_POST["name"],
			"qty"=>$_POST["qty"]
		);
		
		if($obj->insert_record("medicines",$arr)){
			header("location:../index.php?msg=Record Inserted");
		}else{
			echo 'Not inserted';
			header("location:../index.php?msg=Record Not Inserted");
		}
	}
	
	if(isset($_POST["edit"])){
		$id = $_POST["id"];
		
		$where = array("id"=>$id);
	
		$arr = array(
			"m_name"=>$_POST["name"],
			"qty"=>$_POST["qty"]
		);
		
		$val = $obj->update_record("medicines",$where,$arr);
	
		if($val){
			header("location:../index.php?msg=Record Updated");
		}else{
			echo 'Not inserted';
			header("location:../index.php?msg=Record Not Updated");
		}
	}
?>
<?php
	
	require 'db.php';
	if (isset($_GET["id"])) {
 		$db = new DB;
 		$id = $_GET["id"];
 		$db->deleteProduct($id);
 		header('location:index.php');
 	}
 	if(isset($_GET['manu_id'])){
 		$db = new DB;
 		$manu_id = $_GET["manu_id"];
 		$db->deleteManufacture($manu_id);
 		header('location:manufactures.php');
 	}
 	if(isset($_GET['type_id'])){
 		$db = new DB;
 		$type_id = $_GET["type_id"];
 		$db->deleteProtypes($type_id);
 		header('location:protypes.php');
 	}
?>
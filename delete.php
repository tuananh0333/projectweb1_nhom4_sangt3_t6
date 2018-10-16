<?php
session_start();
	
	require 'db.php';

 	date_default_timezone_set('Asia/Ho_Chi_Minh');
 	$date = date('d-m-Y H:i:s T', time()); 
 	$name = $_SESSION["user"];

	if (isset($_GET["id"])) {
 		$db = new DB;
 		$id = $_GET["id"];

 		//$strDate = $date['mday']."/".$date['mon']."/".$date['year']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];

 		$prod = $db->getProduct($id);
 		$desc;
 		foreach ($prod as  $value) {
 			$desc = $value["name"];
 		}
    	
 		$newTask = new Task("xóa sản phẩm", $name, $date, $desc);

 		$_SESSION["tasks"][] = $newTask;

 		$db->deleteProduct($id);
 		header('location:index.php');
 	}
 	if(isset($_GET['manu_id'])){
 		$db = new DB;
 		$manu_id = $_GET["manu_id"];

 		$manuName = $db->getManufactureName($manu_id);
 		
 		$newTask = new Task("xóa nhà sản xuất", $name, $date, $manuName);

 		$_SESSION["tasks"][] = $newTask;

 		$db->deleteManufacture($manu_id);
 		header('location:manufactures.php');
 	}
 	if(isset($_GET['type_id'])){
 		$db = new DB;
 		$type_id = $_GET["type_id"];

 		$typeName = $db->getProtypeName($type_id);

 		$newTask = new Task("xóa loại sản phẩm", $name, $date, $typeName);

 		$_SESSION["tasks"][] = $newTask;

 		$db->deleteProtypes($type_id);
 		header('location:protypes.php');
 	}
?>
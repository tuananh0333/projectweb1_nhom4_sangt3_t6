<?php 
session_start();
	// Nếu không có yêu cầu thì trả về trang chủ
	if (sizeof($_POST) == 0) {
		header ('location:index.php');
	}

	else {
		require 'db.php';
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	 	$date = date('d-m-Y H:i:s T', time()); 
	 	var_dump($_SESSION["user"]);
	 	$name = $_SESSION["user"];

		$db = new DB;

		if (isset($_GET["product"])){
			$_POST["id"] = $_GET["product"];

			$prod = $db->getProduct($_GET["product"]);
			$disc;
			foreach ($prod as  $value) {
				$disc = $value["name"];
			}

			$newTask = new Task("sửa sản phẩm", $name, $date, $disc);
 			$_SESSION["tasks"][] = $newTask;

			$db->updateProduct($_POST);
		}
		else if (isset($_GET["manufacture"])){
			$_POST["id"] = $_GET["manufacture"];

			$disc = $db->getManufactureName($_GET["manufacture"]);

			$newTask = new Task("sửa nhà sản xuất", $name, $date, $disc);
 			$_SESSION["tasks"][] = $newTask;

			$db->updateManufacture($_POST);
		}
		else if (isset($_GET["protype"])){
			$_POST["id"] = $_GET["protype"];

			$disc = $db->getProtypeName($_GET["protype"]);
			
			$newTask = new Task("sửa loại sản phẩm", $name, $date, $disc);
 			$_SESSION["tasks"][] = $newTask;

			$db->updateProtype($_POST);
		}
		header('location: index.php');	
	}
?>
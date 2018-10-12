<?php 
	require 'db.php';
	// UPLOAD IMAGE FILE TO DIRECTORY
	// Temp folder saving uploaded image file
	$targetDir = "public/images/";
	// Url of uploaded image file
	$targetFile = $targetDir.basename($_FILES["fileToUpload"]["name"]);
	// Successful upload or not
	$uploadOK = 1;
	// Uploaded image file extension
	$imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);
	// Check if uploaded file is square
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if ($check !== false) {
			echo "File is an image - ".$check["mine"].".";
			$uploadOK = 1;
		}
		else {
			echo "File is not an image";
			$uploadOK = 0;
		}
	}
	// Check if file already exists
	if (file_exists($targetFile)) {
		echo "File already exists";
		$uploadOK = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		echo "File is too large";
		$uploadOK = 0;
	}
	// Allow certain file formats
	if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		echo "Only PNG files are allowed";
		$uploadOK = 0;
	}
	// Check if $uploadOK is set to 0 by an error
	if ($uploadOK == 0) {
		echo "Your file was not uploaded";
	}
	else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
			echo "The file ".basename($_FILES["fileToUpload"]["name"])." has been uploaded";
			$name = $_POST["name"];
			$type_id = $_POST["type_id"];
			$manu_id = $_POST["manu_id"];
			$image = $_FILES["fileToUpload"]["name"];
			$description = $_POST["description"];
			$price = $_POST["price"];
			$db = new DB;
			$db->addNewProduct($name, $type_id, $manu_id, $image, $description, $price);
			header('location: form.php');
		}
		else {
			echo "Error while uploading file";
		}
	}
		
?>
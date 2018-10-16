<?php
require "config.php";
require 'Task.php';

class DB{
	public static $conn;

	// Constructor
	public function __construct(){
		self::$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		self::$conn->set_charset('utf8');
	}

	// Destructor
	public function __destruct() {
		self::$conn->close();
	}

	// Trả về mảng giá trị
	public function getData($obj) {
		$arr = array();
		while($row = $obj->fetch_assoc()) {
			$arr[]=$row;
		}
		return $arr;
	}

	// Trả về mảng tất cả dữ liệu từ bảng 
	// $table:		tên bảng
	public function getTable($table) {
		$sql = "SELECT * FROM $table";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}

	// Trả về mảng chứa dữ liệu của 1 sản phẩm
	// $id:		mã sản phẩm
	public function getProduct($id){
		$sql = "SELECT * FROM `products` WHERE `ID` = ".$id;
		$product = self::$conn->query($sql);
		return $product;
	}

	// Trả về mảng chứa dữ liệu của 1 nhà sản xuất
	// $manu_id:	mã nhà sản xuất
	public function getManufacture($manu_ID) {
		$sql = "SELECT * FROM `manufactures` WHERE `manu_ID` =".$manu_ID;
		$manufactures = self::$conn->query($sql);
		return $this->getData($manufactures);
	}
	
	// Trả về mảng chứa dữ liệu của 1 loại sản phẩm
	// $type_id:	mã nhà sản xuất
	public function getProtype($type_ID) {
		$sql = "SELECT * FROM `protypes` WHERE `type_ID` =".$type_ID;
		$protypes = self::$conn->query($sql);
		return $this->getData($protypes);
	}

	// Trả về số lượng dòng trong bảng
	// $table:		tên bảng
	public function getAmount($table) {
		$sql = "SELECT * FROM $table";
		$result = self::$conn->query($sql);
		$count = 0;
		foreach ($result as $value) {
			++$count;
		}
		return $count;
	}

	// Trả về tên loại sản phẩm
	// $type_id:	mã sản phẩm
	public function getProductImage($id)
	{
		$product = $this->getProduct($id);
		foreach ($product as $value) {
			$image = $value["image"];
		}
		return $image;
	}

	// Trả về tên loại sản phẩm
	// $type_id:	mã loại sản phẩm
	public function getProtypeName($type_ID)
	{
		$protype = $this->getProtype($type_ID);
		foreach ($protype as $value) {
			$name = $value["type_name"];
		}
		return $name;
	}

	// Trả về tên hình ảnh của loại sản phẩm
	// $type_id:	mã loại sản phẩm
	public function getProtypeImage($type_ID)
	{
		$protype = $this->getProtype($type_ID);
		foreach ($protype as $value) {
			$image = $value["type_img"];
		}
		return $image;
	}

	// Trả về tên hình ảnh của loại nhà sản xuất
	// $type_id:	mã nhà sản xuất
	public function getManufactureName($manu_ID)
	{
		$manufacture = $this->getManufacture($manu_ID);
		foreach ($manufacture as $value) {
			$name = $value["manu_name"];
		}
		return $name;
	}

	// Trả về tên loại nhà sản xuất
	// $type_id:	mã nhà sản xuất
	public function getManufactureImage($manu_ID)
	{
		$manufacture = $this->getManufacture($manu_ID);
		foreach ($manufacture as $value) {
			$image = $value["manu_img"];
		}
		return $image;
	}


	// Trả về mảng dữ liệu đã phân trang
	public function paging($current_page, $limit, $table){
		// Số trang tối đa
		$total_page = ceil(self::getAmount($table) / $limit);
		
		// Kiểm tra $current_page luôn nằm trong khoảng 1 -> $total_page
		if ($current_page > $total_page) {
			$current_page = $total_page;
		}
		else if ($current_page < 1) {
			$current_page = 1;
		}

		// Trả về mảng dữ liệu
		$start = ($current_page - 1) * $limit;
		$sql = "SELECT * FROM $table LIMIT $start, $limit";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}

	// Trả về thanh phân trang 1 2 3 ...
	// $current_page: 	trang hiện tại
	// $limit: 			số lượng phần tử hiển thị trong bảng
	public function pagingBar($current_page, $limit, $table) {
		$total_page = ceil(self::getAmount($table) / $limit);
		for ($index = 1; $index <= $total_page; $index++){
            // Nếu là trang hiện tại thì in đậm số trang
            if ($index == $current_page) {
                echo '<li class="active"><a href="index.php?page='.$index.'">'.$index.'</a></li>';
            }
            else{
                echo '<li><a href="index.php?page='.$index.'">'.$index.'</a></li>';
            }
        }
	}
	
	// Trả về sản phẩm chứa $key trong tên sản phẩm hay trong phần giới thiệu sản phẩm
	public function searchProduct($key)
	{
		$sql = "SELECT * FROM `products` WHERE `name` LIKE '%$key%' OR `description` LIKE '%$key%'";
		$result = self::$conn->query($sql);
		return $result;
	}

	// Hàm thêm hình ảnh vào thư mục
	public function updateImage($file) {
		// THÊM HÌNH ẢNH VÀO THƯ MỤC LƯU TRỮ
		// Tên thư mục lưu hình ảnh
		$targetDir = "public/images/";
		// Đường dẫn hình ảnh
		$targetFile = $targetDir.basename($_FILES["fileToUpload"]["name"]);
		// Kiểm tra xem có đủ điều kiện thêm ảnh hay không
		$uploadOK = 1;
		// Phần mở rộng của ảnh
		$imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

		// Kiểm tra hình ảnh có vuông hay không
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
		// Kiểm tra xem ảnh có tồn tại chưa
		if (file_exists($targetFile)) {
			echo "File already exists";
			$uploadOK = 0;
		}

		// Kiểm tra phần mở rộng của ảnh
		if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			echo "Only PNG files are allowed";
			$uploadOK = 0;
		}

		// Nếu ảnh đủ điều kiện thì thêm
		if ($uploadOK == 0) {
			echo "Your file was not uploaded";
		}
		else {
			// Thêm hình ảnh vào thư mục
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
				echo "The file ".basename($_FILES["fileToUpload"]["name"])." has been uploaded";
			}
			else {
				echo "Error while uploading file";
			}
		}
	}

	// Hàm cập nhật sản phẩm
	public function updateProduct($product)
	{
		$id = $product["id"];
		$name = $product["name"];
		$type_ID = $product["type_id"];
		$manu_ID = $product["manu_id"];
		if (isset($_FILES["fileToUpload"]["name"])) {
			$this->updateImage($_FILES["fileToUpload"]);
			$image = $_FILES["fileToUpload"]["name"];
		}
		else {
			$image = '';
		}
		$description = $product["description"];
		$price = $product["price"];

		if ($id == '') {
			$sql = "INSERT INTO `products` (`name`,`price`,`image`,`description`,`manu_ID`,`type_ID`) VALUES ('$name', $price, '$image', '$description', $manu_ID, $type_ID)";
		}
		else {
			if ($image == '') {
				$image = $this->getProductImage($id);
			}
			$sql = "UPDATE `products` SET `ID`= $id,`name`= '$name',`price`= $price,`image`= '$image',`description`= '$description',`manu_ID`= $manu_ID,`type_ID`= $type_ID WHERE `ID` = $id";
		}
		self::$conn->query($sql);
	}

	public function updateManufacture($manufacture)
	{
		// Tên nhà sản xuất
		$name = $manufacture["manu_name"];
		// Nếu cập nhật ảnh thì tải lên và lấy tên hình ảnh
		if (isset($_FILES["fileToUpload"]["name"])) {
			$this->updateImage($manufacture);
			$image = $_FILES["fileToUpload"]["name"];
		}
		else {
			$image = '';
		}

		// Nếu không có $id thì thêm mới
		if ($manufacture["manu_id"] == '') {
			$sql = "INSERT INTO `manufactures` (`manu_name`,`manu_img`) VALUES ('$name', '$image')";
		}
		else {
			// Lấy id của loại sản phẩm
			$id = $manufacture["manu_id"];
			// Nếu không cập nhật ảnh mới thì lấy tên ảnh cũ
			if ($image == '') {
				$image = $this->getManufactureImage($id);
			}
			$sql = "UPDATE `manufactures` SET `manu_ID`= $id,`manu_name`= '$name',`manu_img`= '$image' WHERE `manu_ID` = $id";
		}
		self::$conn->query($sql);
	}

	// Cập nhật và thêm loại sản phẩm mới
	// $protype:	mảng chứa thông tin của loại sản phẩm
	public function updateProtype($protype)
	{
		// Tên loại sản phẩm 
		$name = $protype["type_name"];
		// Nếu cập nhật ảnh thì tải lên và lấy tên hình ảnh
		if (isset($_FILES["fileToUpload"]["name"])) {
			$this->updateImage($protype);
			$image = $_FILES["fileToUpload"]["name"];
		}
		else {
			$image = '';
		}

		// var_dump($protype["type_id"]);
		// die();
		// Nếu không có $id thì thêm mới
		if ($protype["type_id"] == '') {
			// Thêm loại sản phẩm vào cơ sở dữ liệu
			$sql = "INSERT INTO `protypes` (`type_name`,`type_img`) VALUES ('$name', '$image')";
		}
		// Có $id thì cập nhật
		else {
			// Lấy id của loại sản phẩm
			$id = $protype["type_id"];
			// Nếu không cập nhật ảnh mới thì lấy tên ảnh cũ
			if ($image == '') {
				$image = $this->getProtypeImage($id);
			}
			// Cập nhật loại sản phẩm trên cơ sở dữ liệu
			$sql = "UPDATE `protypes` SET `type_ID`= $id,`type_name`= '$name',`type_img`= '$image' WHERE `type_ID` = $id";
		}
		self::$conn->query($sql);
	}

	public function deleteProduct($key)
	{
		$sql = "DELETE FROM `products` WHERE `ID` = ".$key;
		self::$conn->query($sql);
	}
	public function deleteManufacture($key)
	{
		$sql = "DELETE FROM `manufactures` WHERE `manu_ID` = ".$key;
		self::$conn->query($sql);
	}
	public function deleteProtypes($key)
	{
		$sql = "DELETE FROM `protypes` WHERE `type_ID` = ".$key;
		self::$conn->query($sql);
	}
}
 ?>
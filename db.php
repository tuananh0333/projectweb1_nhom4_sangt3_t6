<?php
require "config.php";

class DB{
	public static $conn;

	public function __construct(){
		self::$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		self::$conn->set_charset('utf8');
	}
	public function __destruct(){
		self::$conn->close();
	}
	// Tra ve mang gia tri tu co so du lieu
	public function getData($obj){
		$arr = array();
		while($row = $obj->fetch_assoc()){
			$arr[]=$row;
		}
		return $arr;
	}
	// Tra ve tat ca du lieu trong bang $table
	public function getAllRowInfo($table){
		$sql = "SELECT * FROM $table";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	// Tra ve so luong dong trong bang $table
	public function getTotalRow($table){
		$sql = "SELECT * FROM $table";
		$result = self::$conn->query($sql);
		$count = 0;
		foreach ($result as $value) {
			++$count;
		}
		return $count;
	}
	public function paging($current_page, $limit){
		$total_page = ceil(self::getTotalRow('products') / $limit);
		
		if ($current_page > $total_page) {
			$current_page = $total_page;
		}
		else if ($current_page < 1) {
			$current_page = 1;
		}
		$start = ($current_page - 1) * $limit;
		$sql = "SELECT * FROM products LIMIT $start, $limit";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	public function pagingBar($current_page, $limit) {
		$total_page = ceil(self::getTotalRow('products') / $limit);
		for ($index = 1; $index <= $total_page; $index++){
            // Nếu là trang hiện tại thì hiển thị thẻ span
            // ngược lại hiển thị thẻ a
            if ($index == $current_page){
                echo '<li class="active"><a href="index.php?page='.$index.'">'.$index.'</a></li>';
            }
            else{
                echo '<li><a href="index.php?page='.$index.'">'.$index.'</a></li>';
            }
        }
	}
	public function getManufactures(){
		$sql = "SELECT * FROM `manufactures`";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	public function getProtypes(){
		$sql = "SELECT * FROM `protypes`";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}

	public function getFullDB(){
		$sql = "SELECT * FROM `products`";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}

	public function getProtype($type_id)
	{
		$sql = "SELECT `type_name`, `type_ID` FROM `protypes`" ;
		$result = self::$conn->query($sql);

		$name ="";
		foreach ($result as $key => $value) {
			if($value["type_ID"] == $type_id)
			{
				$name = $value["type_name"];
			}
		}

		return $name;
	}

	public function getManufacture($manu_id)
	{
		$sql = "SELECT `manu_name`, `manu_ID` FROM `manufactures`" ;
		$result = self::$conn->query($sql);

		$name ="";
		foreach ($result as $value) {
			if($value["manu_ID"] == $manu_id)
			{
				$name = $value["manu_name"];
			}
		}

		return $name;
	}
	public function getProduct($id){
		$sql = "SELECT * FROM `products` WHERE `ID` = ".$id;
		$product = self::$conn->query($sql);
		return $product;
	}

	public function search($key)
	{
		$sql = "SELECT * FROM `products` WHERE `name` LIKE '%".$key."%' OR `description` LIKE '%".$key."%'";
		$result = self::$conn->query($sql);
		return $result;
	}

	public function edit($key)
	{
		$sql = "SELECT * FROM `products` WHERE `name` LIKE '%".$key."%' OR `description` LIKE '%".$key."%'";
		$result = self::$conn->query($sql);
		return $result;
	}

	public function delete($key)
	{
		$sql = "SELECT * FROM `products` WHERE `name` LIKE '%".$key."%' OR `description` LIKE '%".$key."%'";
		$result = self::$conn->query($sql);
		return $result;
	}

	public function addNewProduct($name, $type_id, $manu_id, $image, $description, $price)
	{
		$sql = "INSERT INTO products (`name`, `price`, `image`, `description`, `manu_ID`, `type_ID`) VALUES ('$name',$price,'$image','$description',$manu_id,$type_id)";
		
		return self::$conn->query($sql);
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
	//self::$conn->close();
}
 ?>
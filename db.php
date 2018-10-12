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
	public function getData($obj){
		$arr = array();
		while($row = $obj->fetch_assoc()){
			$arr[]=$row;
		}
		return $arr;
	}
	public function product(){
		$sql = "SELECT * FROM `products` WHERE ID BETWEEN (SELECT MIN(ID) FROM products) AND (SELECT MIN(ID) FROM products) + 9";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	
	public function product1($page){
		$min = ($page - 1) * 10 + 1;
		$sql = "SELECT * FROM `products` WHERE ID BETWEEN ".$min." AND ".($min + 9);
		$result = self::$conn->query($sql);
		return $this->getData($result);
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

	public function getProductAmount(){
		$sql = "SELECT * FROM `products`";
		$result = self::$conn->query($sql);
		$count = 0;
		foreach ($result as $value) {
			++$count;
		}
		return $count;
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
	//self::$conn->close();
}
 ?>
 <?php 
	session_start();
	require "db.php";
	require 'config.php';

 	if (isset($_GET["prod"])) {
 		$db = new DB;

 		$product = $db->getFullDB();

		foreach ($product as $key => $value) {
			if($value["ID"] == $_GET["prod"])
			{

 ?>
		 		<table>
					<td>
						<img style="width:225px;height: 250px; display: inline-block" src= "public/images/<?php echo $value["image"]; ?>">
					</td>
					<td>
						<h2 style="color: #00aed6; display: inline-block;"> <?php echo $value["name"] ?> </h2>
						<br>
						Giá: <p style="color: #619463; display: inline"> <?php echo $value["price"] ?> </p> 
						<br>
						<?php echo $value["description"] ?>
						<br>
						<br>

						<a href="cart.php?prod=<?php echo $value["name"] ?>" style="background: #47add3; color: white; text-decoration: none; padding: 5px; border-radius: 5px">Add to cart</a>
					</td>
				</table>

				<a href="bai3.php"> Trở về </a>
<?php
	 		}
	 	}
	}
	else
	{
		header('location:bai3.php');
	}
?>	

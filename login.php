<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
	<h1 class="name">Login</h1>
	<div class="login">
		<form action="" method="post">
			Username <input type="text" name="id" value="<?php if (isset($_COOKIE["id"])) echo $_COOKIE["id"]; ?>" > 
			<br><br>
			Password <input type="password" name="pass">
			<br><br>
			<input type="checkbox" name="cookie" value="cookie"> Lưu thông tin đăng nhập
			<br><br>
			<input type="submit" name="submit" value="Đăng Nhập">
		</form>
	</div>
</body> 
</html>
<?php
	include "User.php";

	if(isset($_POST["submit"])) {
		// Tao bien luu tru du lieu
		$id = $_POST["id"];
		$pass = $_POST["pass"];
		$user = new User($id, $pass);

		// Kiem tra xem nguoi dung co muon luu thong tin dang nhap hay khong
		if (isset($_POST["cookie"])) {
			setcookie("id", $id, time()+3600);
			setcookie("pass", $pass, time()+3600);

		}
		// Kiem tra id va pass
		$user->login($id, $pass);
	}
?>
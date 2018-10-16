<?php 
	require 'db.php';
	$db = new DB;
	session_start();
	if (isset($_GET["id"])) {
		$manufacture = $db->getManufacture($_GET["id"]);
			foreach ($manufacture as $value) {
				$id = $_GET["id"];
				$name = $value["manu_name"];
				$img = $value["manu_img"];
			}
	}
	else {
		$id = "";
		$name = "";
		$img = "";
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Mobile Admin</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="public/css/bootstrap.min.css" />
	<link rel="stylesheet" href="public/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="public/css/uniform.css" />
	<link rel="stylesheet" href="public/css/select2.css" />
	<link rel="stylesheet" href="public/css/matrix-style.css" />
	<link rel="stylesheet" href="public/css/matrix-media.css" />
	<link href="public/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
	<style type="text/css">
		ul.pagination{
			list-style: none;
			float: right;
		}
		ul.pagination li.active{
			font-weight: bold
		}
		ul.pagination li{
		  float: left;
		  display: inline-block;
		  padding: 10px
		}
	</style>
</head>
<body>
	<!--Header-part-->
	<div id="header">
		<h1><a href="index.php">Trang chủ</a></h1>
	</div>
	<!--close-Header-part-->

	<!--top-Header-menu-->
	<div id="user-nav" class="navbar navbar-inverse">
		<ul class="nav">
			<li  class="dropdown" id="profile-messages" >
				<a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
					<i class="icon icon-user"></i>
					<span class="text">
						<?php 
							// Kiểm tra xem người dùng đăng nhập hay chưa
							if (isset($_SESSION["user"])) {
								echo 'Xin chào '.$_SESSION["user"].'!';
							}
							else {
								header('location:login.php');
							}
						 ?>
					</span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="tasks.php"><i class="icon-check"></i>Tác vụ</a></li>
					<li class="divider"></li>
					<li><a href="login.php"><i class="icon-key"></i>Đăng xuất</a></li>
				</ul>
			</li>
			<li class="">
				<a title="" href="login.php"><i class="icon icon-share-alt"></i><span class="text"> Đăng xuất</span></a>
			</li>
		</ul>
	</div>

	<!--start-top-search-->
	<div id="search">
		<form action="result.php" method="get">
			<input type="text" placeholder="Tìm kiếm..." name="key"/>
			<button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
		</form>
	</div>
	<!--close-top-search-->

	<!--sidebar-menu-->
	<div id="sidebar"> 
		<a href="#" class="visible-phone"><i class="icon icon-th"></i>Bảng</a>
		<ul>
			<li><a href="index.php"><i class="icon icon-home"></i> <span>Trang chủ</span></a> </li>
			<li> <a href="manufactures.php"><i class="icon icon-th-list"></i> <span>Nhà sản xuất</span></a></li>
			<li> <a href="form_manufacture.php"><i class="icon icon-th-list"></i> <span>Thêm nhà sản xuất mới</span></a></li>
			<li> <a href="protypes.php"><i class="icon icon-th-list"></i> <span>Loại sản phẩm</span></a></li>
		</ul>
	</div>
<!-- BEGIN CONTENT -->
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
		<?php 
			if (!isset($_GET["id"])) {
				echo '<h1>Thêm Nhà Sản Xuất Mới</h1>';
			}
			else {
				echo '<h1>Chỉnh Sửa Nhà Sản Xuất</h1>';
			}
		 ?>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
						<h5>Thông tin nhà sản xuất</h5>
					</div>
					<div class="widget-content nopadding">

						<!-- BEGIN USER FORM -->
						<form action="update.php?manufacture=<?php echo $id ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
							<div class="control-group">
								<label class="control-label">Tên nhà sản xuất :</label>
								<div class="controls">
									<?php 
										echo '<input type="text" class="span11" placeholder="Tên nhà sản xuất" name="manu_name" value="'.$name.'"> '
									 ?>
									*
								</div>
							</div>

	
							<div class="control-group">
								<label class="control-label">Chọn hình ảnh :</label>
								<div class="controls">
									<input type="file" name="fileToUpload" id="fileToUpload">
								</div>
							</div>

							<div class="form-actions">
								<button style="float:right;" type="submit" class="btn btn-success">
									<?php 
										if (!isset($_GET["id"])) {
											echo 'Thêm mới';
										}
										else {
											echo 'Cập nhật';
										}
									 ?>
										
									</button>
							</div>
						</form>
						<!-- END USER FORM -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- END CONTENT -->
<!--Footer-part-->
<div class="row-fluid">
	<div id="footer" class="span12"> 2017 &copy; TDC - Lập trình web 1</div>
</div>
<!--end-Footer-part-->
<script src="public/js/jquery.min.js"></script>
<script src="public/js/jquery.ui.custom.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/jquery.uniform.js"></script>
<script src="public/js/select2.min.js"></script>
<script src="public/js/jquery.dataTables.min.js"></script>
<script src="public/js/matrix.js"></script>
<script src="public/js/matrix.tables.js"></script>
</body>
</html>

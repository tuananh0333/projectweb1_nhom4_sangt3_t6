<?php 
	if (isset($_GET["key"])) {
		require 'db.php';
		$db = new DB;
		session_start();
	}
	else {
		header('location: index.php');
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
			<li> <a href="form_product.php"><i class="icon icon-th-list"></i> <span>Thêm sản phẩm mới</span></a></li>
			<li> <a href="manufactures.php"><i class="icon icon-th-list"></i> <span>Nhà sản xuất</span></a></li>
			<li> <a href="protypes.php"><i class="icon icon-th-list"></i> <span>Loại sản phẩm</span></a></li>
		</ul>
	</div>
<!-- BEGIN CONTENT -->
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
		<h1>Kết quả tìm kiếm:</h1>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><a href="form.html"> <i class="icon-plus"></i> </a></span>
						<h5>Sản phẩm</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th></th>
								<th>Tên</th>
								<th>Loại sản phẩm</th>
								<th>Nhà sản xuất</th>
								<th>Description</th>
								<th>Giá (VND)</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
									$product = $db->searchProduct($_GET["key"]);

									foreach ($product as $key => $value) {	
							?>
									<tr class="">
										<td width="200">
											<img src= "public/images/<?php echo $value['image']?>">
										</td>

										<td>
											<?php echo $value["name"] ?>
										</td>
											<?php 
												if($db->getProtype($value["type_ID"]) == null)
												{
													echo '<td>'.'không xác định'.'</td>';
												}else
												{
													echo '<td>'.$db->getProtypeName($value["type_ID"]).'</td>';
												}
											 ?>

											<?php 
												if($db->getManufacture($value["manu_ID"]) == null)
												{
													echo '<td>'.'không xác định'.'</td>';
												}else
												{
													echo '<td>'.$db->getManufactureName($value["manu_ID"]).'</td>';
												}
											 ?>
										<td>
											<?php echo $value["description"] ?>
										</td>
										<td>
											<?php echo number_format($value["price"])  ?>
										</td>

										<td width="75">												
											<a href="form_product.php?id=<?php $value['ID'] ?>" class="btn btn-success btn-mini">Chỉnh sửa</a> <br>
											<a href="#" class="btn btn-danger btn-mini">Xóa</a>
										</td>
									</tr>
								<?php
								} ?>
							</tbody>
						</table>
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
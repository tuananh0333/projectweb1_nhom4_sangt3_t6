<?php 
	require 'db.php';
	$db = new DB;
	session_start();

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
			<div id="breadcrumb"> 
				<a href="index.php" title="Về trang chủ" class="tip-bottom current"><i class="icon-home"> </i>Trang chủ</a>
			</div>
			<h1>Tác vụ</h1>
		</div>
		<div class="container-fluid">
			<hr>
			<div class="row-fluid">
				<div class="span12">	
					<div class="widget-box">
						
						<div class="widget-content nopadding">
							<table class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>Tên tác vụ</th>
									<th>Người thực hiện</th>
									<th>Thời gian</th>
									<th>Mô tả</th>
								</tr>
								</thead>
								<tbody>
									<?php 
									if(isset($_SESSION["tasks"]))
									{
										$tasks = $_SESSION["tasks"];
										//if(sizeof($tasks) != 0)
										//{
											foreach ($tasks as $key => $value) {
												echo '<tr>';
												echo '<td>'.$value->getName().'</td>';
												echo '<td>'.$value->getUser().'</td>';
												echo '<td>'.$value->getTime().'</td>';
												echo '<td>'.$value->getDescription().'</td>';
												echo '</tr>';
											}
										//}
									}
									else
									{
										echo '<tr>';
										echo "<td colspan='3' style='text-align: center;'>chưa có tác vụ nào hiện tại</td>";
										echo '</tr>';
									}
									
									 ?>
								</tbody>
							</table>
							<ul class="pagination">
														
							</ul>
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

<!doctype html>
<html lang="th">

<head>
	<meta charset="utf-8">
	<script src="js/holder.min.js"></script>
	<script src="js/popper.min.js"></script>
</head>

<body class="py-5">
	<nav class="navbar navbar-expand-md navbar-dark  fixed-top" style="background-color:indigo">
		<a class="navbar-brand" href="#">
			<h1><b>e-inventory</b></h1>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a class="nav-link" href="menu_admin.php">หน้าแรก</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown">จัดการข้อมูล</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="product_show.php">สินค้า</a>
						<a class="dropdown-item" href="group_show.php">หมวดหมู่</a>
						<a class="dropdown-item" href="unit_show.php">หน่วย</a>
						<a class="dropdown-item" href="purpose_show.php">วัตถุประสงค์</a>
						<a class="dropdown-item" href="user_show.php">ผู้ใช้งาน</a>
						<a class="dropdown-item" href="supplier_show.php">ซัพพลายเออร์</a>
					</div>
				</li>
				<!--<li class="nav-item"><a class="nav-link" href="product_show.php">สินค้า</a></li>
					<li class="nav-item"><a class="nav-link" href="group_show.php">หมวดหมู่สินค้า</a></li>
					<li class="nav-item"><a class="nav-link" href="unit_show.php">หน่วยสินค้า</a></li>
					<li class="nav-item"><a class="nav-link" href="purpose_show.php">วัตถุประสงค์</a></li>
					<li class="nav-item"><a class="nav-link" href="user_show.php">ผู้ใช้งาน</a></li>-->
				<li class="nav-item"><a class="nav-link" href="stock_show.php">สต๊อกสินค้า</a></li>
				<li class="nav-item"><a class="nav-link" href="stock_in_show.php">รับสินค้าเข้า</a></li>
				<li class="nav-item"><a class="nav-link" href="stock_out_show.php">เบิกสินค้าออก</a></li>
			</ul>
			<div class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><img src="picture/admin.png" width="50" height="50"></a>
				<div class="dropdown-menu bg-warning">
					<a class="dropdown-item" href="#"><?php echo $_SESSION["User_status"]; ?></u> : <?php echo $_SESSION["User_name"]; ?></a>
					<a class="dropdown-item" href="profile_edit.php" style="color: blue"><u>
							<center>แก้ไข</center>
						</u></a>
					<center><a class="btn btn-dark" href="logout.php"> ออกจากระบบ </a></center>
				</div>
			</div>
		</div>
		<!--<div class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><img src="picture/admin.png" width="50" height="50"></a>
			<div class="dropdown-menu bg-warning">
				<a class="dropdown-item" href="#"><?php //echo $_SESSION["User_status"]; ?></u> : <?php //echo $_SESSION["User_name"]; ?></a>
				<a class="dropdown-item" href="profile_edit.php" style="color: blue"><u>
						<center>แก้ไข</center>
					</u></a>
				<center><a class="btn btn-dark" href="logout.php"> ออกจากระบบ </a></center>
			</div>
		</div>-->
		<div class="col-1">
		</div>
	</nav>
</body>

</html>
<?php
//สร้างแถบเมนู
session_start();
?>
<html lang="th">

<head>
	<title>เข้าสู่ระบบ คลังสินค้า</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<link href="plugins/input-clear/input-clear.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script scr="plugins/input-clear/input-clear.js"></script>
	<style>
		html,
		body {
			height: 100%;
		}

		body {
			background-color: azure;
		}

		.form-signin {
			width: 100%;
			max-width: 430px;
			padding: 10px;
			margin: auto;
		}

		.form-signin .form-control {
			position: relative;
			height: auto;
			padding: 10px;
			font-size: 16px;
		}

		.form-control:focus {
			z-index: 2;
		}

		#officer {
			border-bottom-left-radius: 0;
			border-bottom-right-radius: 0;
			margin-bottom: -1px
		}

		#password {
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>

	<script>
		$(function() {
			new inputClear('input-clear');
		});
	</script>
</head>

<body class="d-flex align-items-center text-center">
	<form class="form-signin" METHOD=POST ACTION="login_check.php">
		<img class="mb-3" src="picture/softhouse.png" alt="softhouse" width="280" height="200">
		<h1 class="h3 mb-3 font-weight-normal text-center">เข้าสู่ระบบ</h1>

		<input autocomplete="off" type="text" id="id" name="id" class="form-control input-clear" placeholder="ID" required autofocus>
		<input type="password" id="password" name="password" class="form-control input-clear" placeholder="Password" required>

		<!--<div class="custom-control custom-checkbox m-3">
		<input type="checkbox" class="custom-control-input" id="check1" value="remember-me" checked>
		<label class="custom-control-label" for="check1">Remember me</label>
 	</div>-->
		<br>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

		<p>
			<hr>
		</p>
		<footer class="page-footer font-small blue">

			<div class="footer-copyright text-center py-3">© 2020 - บริษัท ซอฟท์เฮาส์ รีเซิร์ช แอนด์ โปรแกรมมิ่ง จำกัด
				<a href="https://mdbootstrap.com/"> softhouse research & programming.</a>
			</div>

		</footer>
	</form>
</body>

</html>
<?php //include("footer.html"); 
?>
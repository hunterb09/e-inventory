
<?php
	session_start();
	//เช็คว่าเป็นสถานะอะไร
	/*if($_SESSION['OID'] == "")
	{
		header("location:login.php");
	}*/
	
	if($_SESSION['User_status'] != "user")
	{
		header("location:login.php");
	}
	//สร้างแถบเมนู
	require("connection.php");


?>
<html>
<head>
	<title>ผู้ดูแลระบบ</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body class="py-5" align="center">
    <br><br><br><!--<center><h2>ผู้ดูแลระบบ</h2>-->
    <div class="container-fluid text-center text-white">
        <div class="row border-bottom">
            <div class="col-2"></div>
            <div class="col-4 border"><a id="stock_in" href="stock_in_show.php" ><img src="picture/menu_a/stock_in.png" width="150"height="150"><br><button class= "btn btn-success">รับสินค้าเข้า</button></a></div>
            <div class="col-4 border"><a id="stock_out" href="stock_out_show.php" ><img src="picture/menu_a/stock_out.png" width="150"height="150"><br><button class= "btn btn-success">เบิกสินค้าออก</button></a></div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>
<?php 
//สร้างแถบเมนู
require("navbar_u.php");
include("footer.html");

?>
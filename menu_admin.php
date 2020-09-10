
<?php
	session_start();
	//เช็คว่าเป็นสถานะอะไร
	/*if($_SESSION['OID'] == "")
	{
		header("location:login.php");
	}*/
	
	if($_SESSION['User_status'] != "admin")
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
    <br><br><!--<center><h2>ผู้ดูแลระบบ</h2>-->
    <div class="container-fluid text-center text-white">
        <div class="row border-bottom">
            <div class="col-sm-6 col-lg-3 border"><a id="product" href="product_show.php" ><img src="picture/menu_a/buy.png" width="100"height="100"><br><button class= "btn btn-success">สินค้า</button></a></div>
            <div class="col-sm-6 col-lg-3 border"><a id="group" href="group_show.php" ><img src="picture/menu_a/group.png" width="100"height="100"><br><button class= "btn btn-success">หมวดหมู่</button></a></div>
            <div class="col-sm-6 col-lg-3 border"><a id="unit" href="unit_show.php" ><img src="picture/menu_a/unit.png" width="100"height="100"><br><button class= "btn btn-success">หน่วย</button></a></div>
            <div class="col-sm-6 col-lg-3 border"><a id="purpose" href="purpose_show.php" ><img src="picture/menu_a/purpose.png" width="100"height="100"><br><button class= "btn btn-success">วัตถุประสงค์</button></a></div>
        </div>
        <br>
        <div class="row border-bottom">
            <div class="col-sm-6 col-lg-3 border"><a id="user" href="user_show.php" ><img src="picture/menu_a/admin.png" width="100"height="100"><br><button class= "btn btn-success">ผู้ใช้งาน</button></a></div>
            <div class="col-sm-6 col-lg-3 border"><a id="supplier" href="supplier_show.php" ><img src="picture/menu_a/supplier.png" width="100"height="100"><br><button class= "btn btn-success">ซัพพลายเออร์</button></a></div>
            <div class="col-sm-6 col-lg-3 border"><a id="stock" href="stock_show.php" ><img src="picture/menu_a/stock.png" width="100"height="100"><br><button class= "btn btn-success">สต๊อกสินค้า</button></a></div>
            <div class="col-sm-6 col-lg-3 border"><a id="report" href="#" ><img src="picture/menu_a/report.png" width="100"height="100"><br><button class= "btn btn-success">รายงาน</button></a></div>
        </div>  
        <br>
        <div class="row border-bottom">
            <div class="col-sm-6 col-lg-3 border"><!--<a id="" href="user_show.php" ><img src="picture/menu_a/garbage.png" width="100"height="100"><br><button class= "btn btn-success">ผู้ใช้งาน</button></a>--></div>
            <div class="col-sm-6 col-lg-3 border"><a id="stock_in" href="stock_in_show.php" ><img src="picture/menu_a/stock_in.png" width="100"height="100"><br><button class= "btn btn-success">รับเข้า</button></a></div>
            <div class="col-sm-6 col-lg-3 border"><a id="stock_out" href="stock_out_show.php" ><img src="picture/menu_a/stock_out.png" width="100"height="100"><br><button class= "btn btn-success">เบิกออก</button></a></div>
            <div class="col-sm-6 col-lg-3 border"><!--<a id="report" href="#" ><img src="picture/menu_a/report.png" width="100"height="100"><br><button class= "btn btn-success">รายงาน</button></a>--></div>
        </div>
    </div>
</body>
</html>
<?php 
//สร้างแถบเมนู
require("navbar_a.php");
include("footer.html");

?>
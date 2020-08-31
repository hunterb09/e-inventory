<?php
	session_start();
	include("table.css");
	//1. เชื่อมต่อ database:
	require("connection.php");
	
	//เลือกหมายเลขซีเรียล วันที่รับ รหัสผู้รับ ท้ายสุด
    $sql0 = "SELECT * FROM stock_inmst ORDER BY Rec_date desc" or die("Error:" . mysqli_error());
    $result0 = mysqli_query($link,$sql0);
	$row0 = mysqli_fetch_array($result0);
	$St_serial = $row0["St_serial"];
	$User_id = $row0["User_id"];

	//ชื่อผู้รับ
	$sql1 = "SELECT * FROM user WHERE User_id = '$User_id' ";
    $result1 = mysqli_query($link,$sql1);
	$row1 = mysqli_fetch_array($result1);

	//ลำดับ รหัสสินค้า หน่วยสินค้า ปริมาณ ราคา
	$sql2 = "SELECT * FROM stock_indti WHERE St_serial = '$St_serial' ";
	$result2 = mysqli_query($link,$sql2);	


?>

<html>
<head>
	<title>บิลรับสินค้าเข้า</title>
	<link href="js/jquery-ui.min.css" rel="stylesheet">
	<script src="js/jquery-2.1.1.min.js"> </script>
	<script src="js/jquery-ui.min.js"> </script>
</head>
<body align="center">
</body>
</html>

<?php	
	echo '<br><br><center><h2><img src="picture/product/product.png" width="50"height="50"> <u> บิลรับ  </u></h2><br>';
	
	//หัวข้อตาราง
	echo "<form id='form' method=post action='stock_in_printbill.php' enctype='multipart/form-data'>";
	echo "<table id='table' border='1' align='center' width='80%'>";
	echo "<tr>";
	echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='10%'>ลำดับ </th>
			<th width='10%'>รหัสสินค้า </th>
			<th width='10%'>ชื่อสินค้า </th>
			<th width='10%'>หมวดหมู่ </th>
			<th width='10%'>หน่วยสินค้า </th>
			<th width='10%'>จำนวน </th>
			<th width='10%'>ราคา </th>
			<th width='10%'>ราคารวม </th>
		  </tr>";
		  
	
	
	
	echo "</table>";
	echo "</form>";
?>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	
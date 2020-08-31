<?php
//ยังไม่รองรับทุกขนาดหน้าจอ ต้องปรับเป็น '%'
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>บิลรับสินค้าเข้า</title>
<style>
	@import "global-order.css";
	
	form {
		margin: 20px auto;
		width: 70%;
		border: solid 0px;
		font-size: 12px;
		color: green;
	}
	form  > * {
		font: 14px tahoma;
		padding: 3px;	
	}
	input {
		width: 200px;
		margin: 3px;
		background: #ffc;
		border: solid 1px gray;
	}
	h2.warning {
		text-align: left !important;
	}
	span#forget-pswd {
		width: 425px;
		display: block;
		text-align: right;
		margin: -5px 0px 10px 0px;
	}
	span#forget-pswd a {
		font-size: 12px;
	}
	#head {
		padding: 5px !important;
	}
	table {
		margin: 20px auto;
		border-collapse: collapse;
	}
	caption {
		text-align: left;
		padding-bottom: 3px !important;
	}
	td:nth-child(1) {
		width: 250px;
		text-align: left !important;
	}
	td:nth-child(2) {
		width: 200px;
		text-align: left !important;
	}
	td:nth-child(3), td:nth-child(4) {
		width: 80px;
	}
	td:nth-child(5), td[colspan]+td {
		width: 100px;
	}
	table th {
		background: blue;
		color: white;
		padding: 5px;
		border-right: solid 1px white;
		font-size:12px;
	}
	tr:nth-of-type(odd) {
		background: lavender;
	}
	tr:nth-of-type(even) {
		background: whitesmoke;
	}
	td {
		text-align: center;
		vertical-align: top;
		padding: 3px 0px 3px 3px;
		border-right: solid 1px white;
	}
	tr:last-child td {
		border-top: solid 1px white;
		background: powderblue !important;
		padding: 5px;
		font-weight: bold;
		text-align: center !important;	
	}
	caption > div {
		float: right;
		color: navy;
	}
	caption img {
		height: 16px;
		float:none;
		vertical-align: bottom;
	}
	h3 {
		text-align: center;
		color: navy;
	}
	div#head > img {
		vertical-align: bottom;
		margin-right: 5px;
		height: 24px;
	}
	h5 {
		text-align: center;
		margin: 0px;
	}
</style>
<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<script>
$(function() {
	$('button#index').click(function() {
		location.href = "stock_in_show.php";
	});
});
</script>
</head>
<body><br><br>
<div id="container">
<div id="head"><h4><center>บิลรับสินค้า </center></h4></div>
<div id="content">
<?php
		require("connection.php");

        //รับค่าไอดีที่จะแก้ไข
        $St_serial = mysqli_real_escape_string($link,$_GET['St_serial']);

		//เลือกหมายเลขซีเรียล วันที่รับ รหัสผู้รับ ท้ายสุด
		$sql0 = "SELECT * FROM stock_inmst WHERE St_serial = '$St_serial' ";
		$result0 = mysqli_query($link,$sql0);
		$row0 = mysqli_fetch_array($result0);
		$St_serial = $row0["St_serial"];
		$Rec_date = $row0["Rec_date"];
		$User_id = $row0["User_id"];

		//ชื่อผู้รับ
		$sql1 = "SELECT * FROM user WHERE User_id = '$User_id' ";
		$result1 = mysqli_query($link,$sql1);
		$row1 = mysqli_fetch_array($result1);
		$User_name = $row1["User_name"];

		//ลำดับ รหัสสินค้า หน่วยสินค้า ปริมาณ ราคา
		$sql2 = "SELECT * FROM stock_indtl WHERE St_serial = '$St_serial' ";
		$result2 = mysqli_query($link,$sql2);	

		echo "<h5>เลขที่ใบรับ: $St_serial</h5>";
			//เชื่อม 3ตาราง
			$sql = "SELECT stock_indtl.*, product.P_id, product.P_name, product.P_group
			 			FROM stock_indtl LEFT JOIN product
						ON stock_indtl.P_id = product.P_id
						WHERE stock_indtl.St_serial = '$St_serial'";
			$result = mysqli_query($link, $sql);	

			//ยังไม่ได้ดึงชื่อหมวดหมู่ และชื่อหน่วย
?>
  			<table>
				 	
   	 					วันที่: <?php echo $Rec_date; ?> &nbsp;&nbsp;
                        ผู้รับ: <?php echo $User_name; ?>
				<tr align='center' bgcolor='#CCCCCC'>
					<th width='5%'>ลำดับ </th>
					<th width='5%'>รหัสสินค้า </th>
					<th width='15%'>ชื่อสินค้า </th>
					<th width='10%'>หมวดหมู่ </th>
					<th width='5%'>หน่วยสินค้า </th>
					<th width='5%'>จำนวน </th>
					<th width='5%'>ราคา </th>
					<th width='5%'>ราคารวม </th>
				</tr>
				<?php
					$grand_total = 0;
					while($order = mysqli_fetch_array($result)) {
						//ราคารวม
						$sub_total = $order['Qty'] * $order['Price'];

						$P_group = $order['P_group'];
						//แปลงจากรหัสเป็นชื่อหมวดหมู่
						$sql1 = "SELECT * FROM p_group WHERE P_group = '$P_group' ";
						$result1 = mysqli_query($link,$sql1);
						$row1 = mysqli_fetch_array($result1);	
						$G_name = $row1["G_name"];
		
						$Unit_id = $order['Unit_id'];
						//แปลงจากรหัสเป็นชื่อหน่วย
						$sql2 = "SELECT * FROM unit WHERE Unit_id = '$Unit_id' ";
						$result2 = mysqli_query($link,$sql2);
						$row2 = mysqli_fetch_array($result2);	
						$Unit_name = $row2["Unit_name"];
				?>
				<tr>
					<td><?php echo $order['St_no']; ?></td><!-- ลำดับ -->
    				<td><?php echo $order['P_id']; ?></td><!-- รหัสสินค้า -->		
					<td><?php echo $order['P_name']; ?></td><!-- ชื่อสินค้า -->		
					<td><?php echo $G_name; ?></td><!-- หมวดหมู่ -->		
    				<td><?php echo $Unit_name; ?></td><!-- หน่วยสินค้า -->
    				<td><?php echo $order['Qty']; ?></td><!-- จำนวน -->
    				<td><?php echo $order['Price']; ?></td><!-- ราคา -->
   					<td><?php echo number_format($sub_total); ?></td><!-- รวม -->
				</tr>
				<?php
					$grand_total += $sub_total;
				}
				?>
				<tr><td colspan="7">รวมทั้งหมด</td><td><?php echo number_format($grand_total); ?></td></tr>
			</table>
</div>
<div id="bottom"><button id="index">&laquo; ย้อนกลับ</button></div>
</div>
</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	
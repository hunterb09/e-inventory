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

	div#head {
		background: powderblue;
		font-size: 20px;
		color: navy;
	}
	div#bottom button {
		margin: 1px 2px;
		background: steelblue;
		border: solid 1px silver;
		color: white;
		padding: 3px 10px;
		border-radius: 5px;
		cursor: pointer;
		font: 14px tahoma;
	}
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
		location.href = "stock_show.php";
	});
});
</script>
</head>
<body><br><br>
<div id="container">
<div id="head"><h4><center>สต๊อกสินค้า </center></h4></div>
<div id="content">
<?php
		require("connection.php");

        //รับค่าไอดีที่จะแก้ไข
        $P_id = mysqli_real_escape_string($link,$_GET['P_id']);

		//เลือกหมายเลขซีเรียล วันที่รับ รหัสผู้รับ ท้ายสุด
		//$sql0 = "SELECT * FROM stock_indtl WHERE P_id = '$P_id' ";
		//$result0 = mysqli_query($link,$sql0);
        //เชื่อม 3ตาราง
		$sql0 = "SELECT stock_indtl.*, stock_inmst.St_serial, stock_inmst.Rec_date, stock_inmst.User_id
			FROM stock_indtl LEFT JOIN stock_inmst
		    ON stock_indtl.St_serial = stock_inmst.St_serial
		    WHERE stock_indtl.P_id = '$P_id'";
		$result0 = mysqli_query($link, $sql0);

        //รหัสสินค้าเป็นชื่อ
        $sql = "SELECT * FROM product WHERE P_id = '$P_id' ";
		$result = mysqli_query($link,$sql);
        $row = mysqli_fetch_array($result);	
        $P_name = $row["P_name"];
		echo "<h5>สินค้า: " .$P_id. "</h5>";	
        echo "<h5>ชื่อ: " .$P_name. "</h5>";	
?>
  			<table width='90%'>
				 	
				<tr align='center' bgcolor='#CCCCCC'>
					<th width='10%'>วันที่ </th>
                    <th width='5%'>เลขที่ใบรับ </th>
					<th width='5%'>จำนวน </th>
					<th width='5%'>ราคา </th>
					<th width='5%'>ราคารวม </th>
					<th width='5%'>ผู้รับ </th>
					<th width='5%'>เลขที่ใบเบิก </th>
					<th width='5%'>จำนวนเบิก </th>
					<!--<th width='5%'>จัดการ </th>-->
				</tr>
                <?php
                    $qty_total = 0;
					$grand_total = 0;
					while($order = mysqli_fetch_array($result0)) {
						$St_indtl = $order['St_indtl'];
						//ราคารวม
						$sub_total = $order['Qty_change'] * $order['Price'];
                        $q_total = $order['Qty_change'];

						$Unit_id = $order['Unit_id'];
						//แปลงจากรหัสเป็นชื่อหน่วย
						//$sql2 = "SELECT * FROM unit WHERE Unit_id = '$Unit_id' ";
						//$result2 = mysqli_query($link,$sql2);
						//$row2 = mysqli_fetch_array($result2);	
						//$Unit_name = $row2["Unit_name"];

						//แปลงจากรหัสเป็นชื่อผู้รับ
						$User_id = $order['User_id'];
						$sql2 = "SELECT * FROM user WHERE User_id = '$User_id' ";
						$result2 = mysqli_query($link,$sql2);
						$row2 = mysqli_fetch_array($result2);	
						$User_name = $row2["User_name"];

						//ค้นหา St_indtl ในเทเบิ้ล stock_outdtl
						$sql = "SELECT * FROM stock_outdtl WHERE St_indtl = '$St_indtl' ";
						$result = mysqli_query($link,$sql);
	
						$num = mysqli_num_rows($result); 
						if($num > 0){
							for($i = 1; $i <= $num; $i++){
								$row = mysqli_fetch_array($result);
									$Stout_serial = $row["Stout_serial"];
									$Qty = $row["Qty"];
									if($i == 1){
										echo "<tr>";
										echo "<td>". $order['Rec_date'] ."</td>";// วันที่รับ -->
										echo "<td>". $order['St_serial']."</td>";// เลขใบรับ -->			
										echo "<td>". $order['Qty_change']."</td>";// จำนวน -->
										echo "<td>". $order['Price']."</td>";// ราคา -->
										echo "<td>". number_format($sub_total)."</td>";// รวม -->
										echo "<td>". $User_name."</td>";// ผู้รับ -->
										echo "<td>". $Stout_serial."</td>";// เลขที่ใบเบิก -->
										echo "<td>". $Qty."</td>";// จำนวนเบิก -->
										echo "</tr>";
									}else{
										echo "<tr>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "<td>". $Stout_serial."</td>";// เลขที่ใบเบิก -->
										echo "<td>". $Qty."</td>";// จำนวนเบิก -->
										echo "</tr>";
									}
								
							}
						}else{
							echo "<tr>";
							echo "<td>". $order['Rec_date'] ."</td>";// วันที่รับ -->
							echo "<td>". $order['St_serial']."</td>";// เลขใบรับ -->			
							echo "<td>". $order['Qty_change']."</td>";// จำนวน -->
							echo "<td>". $order['Price']."</td>";// ราคา -->
							echo "<td>". number_format($sub_total)."</td>";// รวม -->
							echo "<td>". $User_name."</td>";// ผู้รับ -->
							echo "<td></td>";
							echo "<td></td>";
							echo "</tr>";
						}
                    $qty_total += $q_total;
					$grand_total += $sub_total;
					}
				?>
				<tr><td colspan="2">รวมทั้งหมด</td><td><?php echo number_format($qty_total); ?></td><td></td><td><?php echo number_format($grand_total); ?></td><td colspan="3"></td></tr>
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
<?php
session_start();
//1. เชื่อมต่อ database:
require("connection.php");

$sql = "SELECT * FROM product ORDER BY P_name asc";
$result1 = mysqli_query($link, $sql);

$sql = "SELECT * FROM unit ORDER BY Unit_name asc";
$result2 = mysqli_query($link, $sql);

//เลือกหมายเลขซีเรียล วันที่รับ รหัสผู้รับ ท้ายสุด
$sql0 = "SELECT *, DATE_FORMAT(Rec_date, '%d-%m-%Y') AS Rec_date
FROM stock_inmst ORDER BY St_serial desc";
$result0 = mysqli_query($link,$sql0);
$row0 = mysqli_fetch_array($result0);
$St_serial = $row0["St_serial"];
$sb = substr($St_serial, 0, 10); //เลือกตัวเลข
	$subint = (int)($sb); //เปลี่ยนตัวแปรเป็น int
	$P_id = ($subint+1); //+1
	if($P_id <= 9){
		$strnum = "000000000"; 
		$P_id = $strnum.$P_id; 
	}else if($P_id <= 99){
		$strnum = "00000000"; 
		$P_id = $strnum.$P_id; 
	}else if($P_id <= 999){
		$strnum = "0000000"; 
		$P_id = $strnum.$P_id; 
	}else if($P_id <= 9999){
		$strnum = "000000"; 
		$P_id = $strnum.$P_id; 
	}else if($P_id <= 99999){
		$strnum = "00000"; 
		$P_id = $strnum.$P_id; 
	}else if($P_id <= 999999){
		$strnum = "0000"; 
		$P_id = $strnum.$P_id;
	}else if($P_id <= 9999999){
		$strnum = "000"; 
		$P_id = $strnum.$P_id;
	}else if($P_id <= 99999999){
		$strnum = "00"; 
		$P_id = $strnum.$P_id;
	}else if($P_id <= 999999999){
		$strnum = "0"; 
		$P_id = $strnum.$P_id;
	}else{
		$P_id = $startid.$P_id; 
	}
?>
<!doctype html>
<html>

<head>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<link href="plugins/select-me/selectMe.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="plugins/select-me/selectMe.js"></script>
	<title>softhouse</title>
	<script>
		function fncSum() {
			var Qty = document.myTable['Qty'].value;
			var Price = document.myTable['Price'].value;
			var sum = Qty * Price;
			document.myTable.Total.value = sum;
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			
			var rows = 1;
			$("#createRows").click(function() {
				var tr = "<tr>";
				tr = tr + "<td><input type='hidden' name='St_no" + rows + "' id='St_no" + rows + "' value='" + rows + "' >" + rows + "</td>";
				tr = tr + "<td><select name='P_name" + rows + "' id='P_name" + rows + "' ><option value=''>เลือกชื่อ</option><?php while ($row1 = mysqli_fetch_array($result1)) { ?> <option value='<?php echo $row1["P_name"] ?>'> <?php echo $row1["P_name"] ?></option><?php } ?></select></td>";
				tr = tr + "<td><select name='Unit_name" + rows + "' id='Unit_name" + rows + "' ><?php while ($row2 = mysqli_fetch_array($result2)) { ?><?php echo "<option value=" . $row2['Unit_name'] . " >" . $row2["Unit_name"] ?> </option><?php } ?></select></td>";
				tr = tr + "<td><input type='number' name='Qty" + rows + "' id='Qty" + rows + "' min='1' size='5' required style='text-align :center' onkeyup='fncSum()'></td>";
				tr = tr + "<td><input type='number' name='Price" + rows + "' id='Price" + rows + "' min='0' size='8' required onkeyup='fncSum()'></td>";
				//tr = tr + "<td><input type='text' name='Total"+rows+"' id='Total"+rows+"' width='10%' readonly></td>";
				tr = tr + "</tr>";
				$('#myTable > tbody:last').append(tr);

				//แสดงแถบค้นหาชื่อ
				$('#P_name' + rows).selectMe({
					width: '350px',
					columnCount: 1, //จำนวนคอลัมน์
					search: true //แสดงช่องค้นหาหรือไม่
				});
				//แสดงแถบค้นหาหน่วย
				$('#Unit_name' + rows).selectMe({
					width: '350px',
					columnCount: 3, //จำนวนคอลัมน์
					search: true //แสดงช่องค้นหาหรือไม่
				});

				//เก็บจำนวนแถว
				$('#hdnCount').val(rows);
				rows = rows + 1;
			});

			$("#deleteRows").click(function() {
				if ($("#myTable tr").length != 1) { // ถ้า=1เด้งออกลูป
					$("#myTable tr:last").remove();
					rows = rows - 1;
				}
			});

			$("#clearRows").click(function() {
				rows = 1;
				$('#hdnCount').val(rows);
				$('#myTable > tbody:last').empty(); // remove all
			});

		});
	</script>
</head>

<body><br><br>
	<center>
		<h2><img src="picture/product/product.png" width="50" height="50"> <u> รับสินค้าเข้า </u></h2><br>
		<form id="form" method=post action="stock_in_insert.php" enctype="multipart/form-data">
		<h2>เลขที่ใบรับ: <?php echo $P_id; ?></h2>
			<table border="1" width="80%" align="center" id="myTable">
				<thead>
					<tr>
						<input type="hidden" id="St_serial" name="St_serial" value="<?php echo $St_serial ?>">
						<input type="hidden" id="User_id" name="User_id" value="<?php echo $_SESSION["User_id"] ?>">
					</tr>
					<tr>
						<td class="text-center">ลำดับ </td>
						<td class="text-center">ชื่อสินค้า </td>
						<!--แต่เปลี่ยนเป็น รหัสสินค้า ทีหลัง -->
						<td class="text-center">หน่วยสินค้า </td>
						<!--แต่เปลี่ยนเป็น หน่วยสินค้า ทีหลัง -->
						<td class="text-center">จำนวน </td>
						<td class="text-center">ราคา </td>
						<!--<td class="text-center" width="10%">ราคารวม </td> -->
					</tr>
					<p></p>
				</thead>
				<!-- body dynamic rows -->
				<tbody></tbody>
			</table><br>
			<input type="button" id="createRows" value="Add">
			<input type="button" id="deleteRows" value="Del">
			<input type="button" id="clearRows" value="Clear"><br><br>
			<input type="hidden" id="hdnCount" name="hdnCount">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">หมายเหตุ: </td>
						<td class="text-left" width="10%"><textarea name="Comment" id="Comment" cols="30" rows="1"></textarea></td>
					</tr>
				</tbody>
			</table><br>
			<input name="btnSubmit" type="submit" value="บันทึก" /></td>
		</form>
		<br><a href='stock_in_show.php'>ย้อนกลับ </a>
</body>

</html>
<?php
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>
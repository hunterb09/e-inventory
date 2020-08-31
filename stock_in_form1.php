<?php
	session_start();

	//1. เชื่อมต่อ database:
	require("connection.php");

	$sql = "SELECT * FROM product ORDER BY P_name asc" or die("Error:" . mysqli_error());
	$result1 = mysqli_query($link,$sql);
	
	$sql = "SELECT * FROM unit ORDER BY Unit_name asc" or die("Error:" . mysqli_error());
	$result2 = mysqli_query($link,$sql);
?>
<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/holder.min.js"></script>
		<title>softhouse</title>
		<script>
				function Validation(){
					var noERROR = true;

					var Mname = document.getElementById("G_name");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกรหัสหมวดหมู่สินค้า");
						noERROR = false;
					}

					var Mname = document.getElementById("P_name");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกชื่อสินค้า");
						noERROR = false;
					}

					var Mname = document.getElementById("P_tradename");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกชื่อเรียกสินค้า");
						noERROR = false;
					}

					if(noERROR == true){
						var form = document.getElementById("form");	
						form.submit();
					}
				}
		</script>
	</head>
	<body><br><br><center>
		<h2><img src="picture/product/product.png" width="50"height="50"> <u> รับสินค้าเข้า  </u></h2><br>
		<form id="form" method=post action="stock_in_insert.php" enctype="multipart/form-data">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">ชื่อสินค้า: </td><!--แต่เปลี่ยนเป็น รหัสสินค้า ทีหลัง -->
							<td class="text-left">
								<select name="P_name" id="P_name">
								    <?php while($row1 = mysqli_fetch_array($result1)) { ?>
									<option> <?php echo $row1["P_name"] ?> </option>
									<?php } ?>
								</select>
							</td>
					</tr>
					<tr>
						<td class="text-right" width="10%" height="30"> หน่วยสินค้า: </td><!--แต่เปลี่ยนเป็น หน่วยสินค้า ทีหลัง -->
							<td class="text-left">
								<select name="Unit_name" id="Unit_name">
								    <?php while($row2 = mysqli_fetch_array($result2)) { ?>
									<option> <?php echo $row2["Unit_name"] ?> </option>
									<?php } ?>
								</select>
							</td>
					</tr>
					<tr>
						<td class="text-right" width="10%">ชื่อสินค้า: </td>
						<td class="text-left" width="10%"><input type="text" name="P_name" id="P_name"></td>
					</tr>
					<tr>
						<td class="text-right" width="10%">ชื่อเรียกสินค้า: </td>
						<td class="text-left" width="10%"><input type="text" name="P_tradename" id="P_tradename"></td>
					</tr>
					<tr>
						<td class="text-right" width="10%">หมายเหตุ: </td>
						<td class="text-left" width="10%"><input type="text" name="Comment" id="Comment"></td>
					</tr>
				</tbody>
			</table><br>
			<input type="reset" value="Reset">
			<input name="btnSubmit" type="button" value="บันทึก" onclick="Validation();" /></td>
		</form>
		<br><a href='stock_in_show.php'>ย้อนกลับ </a>
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	
<?php
	session_start();

?>
<!doctype html>
<html>
	<head>
		<title>softhouse</title>
		<script>
				function Validation(){
					var noERROR = true;

					var Pname = document.getElementById("Unit_name");	
					if (Pname.value.trim() == ""){
						alert("กรุณากรอกชื่อหน่วยสินค้า");
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
		<h2><img src="picture/product/p_group.png" width="50"height="50"> <u> เพิ่มหน่วยสินค้า  </u></h2><br>
		<form id="form" method=post action="unit_insert.php" enctype="multipart/form-data">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">ชื่อหน่วยสินค้า: </td>
						<td class="text-left" width="10%"><input type="text" name="Unit_name" id="Unit_name"></td>
					</tr>
				</tbody>
			</table><br>
			<input type="reset" value="Reset">
			<input name="btnSubmit" type="button" value="บันทึก" onclick="Validation();" /></td>
		</form>
		<br><a href='unit_show.php'>ย้อนกลับ </a>
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	
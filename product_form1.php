<?php
    session_start();
    //สร้างแถบเมนู
    include("navbar_check.php");
?>
<html>
	<head>
		<title>softhouse</title>
<link href="js/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery-ui.min.js"> </script>
<script>
$(function(){
	/*
 	var data = ["javascript", 	"jquery", "java", "joomla",
				"iphone", "ipad", "ipod", "ios",
				"กุหลาบ", "กล้วยไม้", "ทานตะวัน"	];

	$('#product').autocomplete({ source: data });
	*/
	//ดึงข้อมูลที่ค้นหาแบบเรียลไทม์
	$('#G_name').autocomplete({source: 'listgroup.php' });
});
</script>
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
		<h2><img src="picture/product/product.png" width="50"height="50"> <u> เพิ่มสินค้า  </u></h2><br>
		<form id="form" method=post action="product_insert.php" enctype="multipart/form-data">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%" height="30"> หมวดหมู่สินค้า: <input type="hidden" name="GID" /></td>
							<td class="text-left"><input type="text" id="G_name" name="G_name">
								<!--<select name="G_name" id="G_name">
								    <?php //while($row1 = mysqli_fetch_array($result1)) { ?>
									<option> <?php //echo $row1["G_name"] ?> </option>
									<?php //} ?>
								</select>-->
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
		<br><a href='product_show.php'>ย้อนกลับ </a>
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("footer.html"); ?>
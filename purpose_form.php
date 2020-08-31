<?php
	session_start();

?>
<!doctype html>
<html>
	<head>
		<title>softhouse</title>
		<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
		<script>
				function Validation(){
					var noERROR = true;

					var Pname = document.getElementById("Pp_name");	
					if (Pname.value.trim() == ""){
						alert("กรุณากรอกวัตถุประสงค์");
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
		<h2><img src="picture/product/p_group.png" width="50"height="50"> <u> เพิ่มวัตถุประสงค์  </u></h2><br>
		<form id="form" method=post action="purpose_insert.php" enctype="multipart/form-data">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">วัตถุประสงค์: </td>
						<td class="text-left" width="10%"><textarea name="Pp_name" id="Pp_name"></textarea></td>
					</tr>
				</tbody>
			</table><br>
			<input type="reset" value="Reset">
			<input name="btnSubmit" type="button" value="บันทึก" onclick="Validation();" /></td>
		</form>
		<br><a href='purpose_show.php'>ย้อนกลับ </a>
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	
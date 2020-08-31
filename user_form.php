<?php
	session_start();

?>
<html>
	<head>
		<title>softhouse</title>
		<script>
				function Validation(){
					var noERROR = true;

					var Mname = document.getElementById("ID");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกไอดี");
						noERROR = false;
					}
					
					if (Mname.value.trim().length < 4){
						alert("กรุณากรอกไอดี > 3ตัว");
						noERROR = false;
					}

					var Mname = document.getElementById("User_password");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกพาสเวิร์ด");
						noERROR = false;
					}

					if (Mname.value.trim().length < 4){
						alert("กรุณากรอกพาสเวิร์ด > 3ตัว");
						noERROR = false;
					}

					var Mname = document.getElementById("User_name");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกชื่อ");
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
		<h2><img src="picture/product/p_group.png" width="50"height="50"> <u> เพิ่มผู้ใช้งาน  </u></h2><br>
		<form id="form" method=post action="user_insert.php" enctype="multipart/form-data">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">ไอดี: </td>
						<td class="text-left" width="10%"><input type="text" name="ID" id="ID" required autofocus></td>
					</tr>
					<tr>
						<td class="text-right" width="10%">พาสเวิร์ด: </td>
						<td class="text-left" width="10%"><input type="password" name="User_password" id="User_password" required></td>
					</tr>
					<tr>
						<td class="text-right" width="10%">ชื่อผู้ใช้งาน: </td>
						<td class="text-left" width="10%"><input type="text" name="User_name" id="User_name"></td>
					</tr>
					<tr>
						<td class="text-right" width="10%">สเตตัส: </td>
						<td class="text-left" width="10%">
							<input type="radio" name="User_status" onclick="check(this.value)" value="admin">admin
							<input type="radio" name="User_status" onclick="check(this.value)" value="officer">officer
							<input type="radio" name="User_status" onclick="check(this.value)" value="user" checked="checked">user</td>
					</tr>
				</tbody>
			</table><br>
			<input type="reset" value="Reset">
			<input name="btnSubmit" type="button" value="บันทึก" onclick="Validation();" /></td>
		</form>
		<br><a href='user_show.php'>ย้อนกลับ </a>
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	
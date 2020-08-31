<?php
//แก้ไขข้อมูลส่วนตัวเจ้าหน้าที่
session_start();
if ($_SESSION['User_id'] == "") {
	echo "Please Login!";
	exit();
}

//สร้างแถบเมนู

require("connection.php");
$sql = "SELECT * FROM user WHERE User_id = '" . $_SESSION['User_id'] . "' ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);

?>
<html>

<head>
	<title>แก้ไขข้อมูลตนเอง</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body align="center">
	<form name="form1" method="post" action="profile_save.php" align="center">
		<br><br>
		<h2><u> แก้ไขข้อมูลตนเอง </u></h2><br>
		<table width="400" border="0" align="center" style="width: 400px">
			<tbody>
				<tr>
					<td width="125" class="text-right"> &nbsp;รหัสผู้ใช้งาน :</td>
					<td width="180" class="text-left">
						<?php echo $row["User_id"]; ?>
					</td>
				</tr>
				<tr>
					<td class="text-right"> &nbsp;ไอดี :</td>
					<td class="text-left">
						<?php echo $row["ID"]; ?>
					</td>
				</tr>
				<tr>
					<td class="text-right"> &nbsp;พาสเวิร์ด :</td>
					<td class="text-left"><input name="txtPassword" type="password" id="txtPassword" value="<?php echo $row["User_password"]; ?>">
					</td>
				</tr>
				<tr>
					<td class="text-right"> &nbsp;ยืนยันพาสเวิร์ด :</td>
					<td class="text-left"><input name="txtConPassword" type="password" id="txtConPassword" value="<?php echo $row["User_password"]; ?>">
					</td>
				</tr>
				<tr>
					<td class="text-right">&nbsp;ชื่อ :</td>
					<td class="text-left"><input name="txtName" type="text" id="txtName" value="<?php echo $row["User_name"]; ?>"></td>
				</tr>
				<tr>
					<td class="text-right"> &nbsp;สเตตัส :</td>
					<td class="text-left">
						<?php echo $row["User_status"]; ?>
					</td>
				</tr>
			</tbody>
		</table>
		<br>
		<input type="submit" name="Submit" value="บันทึก">
	</form>
	<br><a href="stock_in_show.php">
		<center>ย้อนกลับ
	</a>
</body>

</html>
<?php
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html");

?>
<?php
    session_start();
?>
<html>
	<head>
		<title>ค้นหาผู้ใช้งาน</title>
		<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</head>
	<body><br><br><center>
		<h2><img src="picture/menu/search.png" width="50"height="50"> <u> ค้นหาผู้ใช้งาน  </u></h2><br>
		<form method=post action="user_search_uid.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัส: </td>
						<td class="text-left" width="10%"><input type="text" name="User_id"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>

		<form method=post action="user_search_id.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากไอดี: </td>
						<td class="text-left" width="10%"><input type="text" name="ID"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
        <form method=post action="user_search_name.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="User_name"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>

		<form method=post action="user_search_status.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากสถานะ: </td>
						<td class="text-left" width="10%"><input type="text" name="User_status"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
		<br><a href='user_show.php'>ย้อนกลับ </a>
		
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	

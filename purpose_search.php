<?php
    session_start();
?>
<html>
	<head>
		<title>ค้นหาวัตถุประสงค์</title>
		<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</head>
	<body><br><br><center>
		<h2><img src="picture/menu/search.png" width="50"height="50"> <u> ค้นหาวัตถุประสงค์  </u></h2><br>
		<form method=post action="purpose_search_id.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัส: </td>
						<td class="text-left" width="10%"><input type="text" name="Pp_id"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
        <form method=post action="purpose_search_name.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="Pp_name"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
		<br><a href='purpose_show.php'>ย้อนกลับ </a>
		
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	

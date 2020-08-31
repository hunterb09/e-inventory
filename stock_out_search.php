<?php
    session_start();
?>
<html>
	<head>
		<title>ค้นหาเบิกออก</title>
		<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</head>
	<body><br><br><center>
		<h2><img src="picture/menu/search.png" width="50"height="50"> <u> ค้นหาเบิกออก  </u></h2><br>

		<form method=post action="stock_out_search_id.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากเลขที่ใบรับสินค้า: </td>
						<td class="text-left" width="10%"><input type="text" name="id"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>

        <form method=post action="stock_out_search_date.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
                        <td class="text-right" width="10%" height="30">จากวันที่: <input type="date" name="Rec_date"></td>
						<td class="text-left" width="10%">ถึง <input type="date" name="Rec_date1"><input type="submit" value="ค้นหา"> </td>
					</tr>
				</tbody>
			</table>
        </form>

		<form method=post action="stock_out_search_uid.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัสผู้ใช้งาน: </td>
						<td class="text-left" width="10%"><input type="text" name="User_id"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
		<br><a href='stock_out_show.php'>ย้อนกลับ </a>
		
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	

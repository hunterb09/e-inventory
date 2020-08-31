<?php
    session_start();
?>
<html>
	<head>
		<title>ค้นหาหน่วยสินค้า</title>
		<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</head>
	<body><br><br><center>
		<h2><img src="picture/menu/search.png" width="50"height="50"> <u> ค้นหาหน่วยสินค้า  </u></h2><br>
		<form method=post action="unit_search_id.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัสหน่วย: </td>
						<td class="text-left" width="10%"><input type="text" name="Unit_id"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
        <form method=post action="unit_search_name.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="Unit_name"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
		<!--<form method=post action="p_group_search_groupname.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%">
                            <select name="P_group_name" id="P_group_name">
								<?php /* while($row1 = mysqli_fetch_array($result1)) { ?>
								<option> <?php echo $row1["P_group_name"] ?> </option>
								<?php } */?>
                            </select>
                            <input type="submit" value="ค้นหา"> 
                        </td>
					</tr>
				</tbody>
			</table>
		</form>-->
        
		<br><a href='unit_show.php'>ย้อนกลับ </a>
		
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	

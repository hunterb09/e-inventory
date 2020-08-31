<?php
    session_start();
    
?>
<html>
	<head>
		<title>ค้นหาหมวดหมู่สินค้า</title>
		<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script language="javascript">
		function Product(Div) {
			var P_name = document.frmprice['P_name'].value;
			var params = "P_name=" + P_name; // +
			alert(params);
			var url = "st_o_s.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
	</script>
	</head>
	<body><br><br><center>
		<h2><img src="picture/menu/search.png" width="50"height="50"> <u> ค้นหาสินค้า  </u></h2><br>
		<form method=post action="product_search_id.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัสสินค้า: </td>
						<td class="text-left" width="10%"><input type="text" name="P_id"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>
		
		<form method=post action="product_search_group.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
                        <td class="text-right" width="10%">จากรหัสหมวดหมู่: </td>
                        <td class="text-left" width="10%"><input type="text" name="P_group"><input type="submit" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<form method=post action="product_search_name.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="P_name"><input type="submit" value="ค้นหา"> </td>
					</tr>
				</tbody>
			</table>
		</form>
        
        <form method=post action="product_search_tradename.php">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อเรียก: </td>
						<td class="text-left" width="10%"><input type="text" name="P_tradename"><input type="submit" value="ค้นหา"> </td>
					</tr>
				</tbody>
			</table>
        </form>
        <div align="center" id="stock"></div>
		<br><a href='product_show.php'>ย้อนกลับ </a>
		
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	

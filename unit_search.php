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
	<script src="js/prototype.js" language="javascript" type="text/javascript"></script>
	<script language="javascript">
		function Product(Div) {
			var Unit_id = document.frmprice['Unit_id'].value;
			var params = "Unit_id=" + Unit_id; // +
			//alert(params);
			var url = "unit_search_id.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product2(Div) {
			var Unit_name = document.frmprice2['Unit_name'].value;
			var params = "Unit_name=" + Unit_name; // +
			//alert(params);
			var url = "unit_search_name.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
	</script>
</head>

<body><br><br>
	<center>
		<h2 id="h2"><img src="picture/menu/search.png" width="50" height="50"> <u> ค้นหาหน่วยสินค้า </u></h2><br>
		<form method=post action="unit_search_id.php" name="frmprice">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัสหน่วย: </td>
						<td class="text-left" width="10%"><input type="text" name="Unit_id"><input id="button" type="button" onclick="Product(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<form method=post action="unit_search_name.php" name="frmprice2">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="Unit_name"><input id="button2" type="button" onclick="Product2(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<br><a href='unit_show.php'>ย้อนกลับ </a><hr>
		<div align="center" id="stock"></div>
</body>

</html>
<?php
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>
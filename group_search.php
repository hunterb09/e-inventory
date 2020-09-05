<?php
session_start();
/*
    //1. เชื่อมต่อ database:
	require("connection.php");

	$sql = "SELECT * FROM group ORDER BY G_name asc" or die("Error:" . mysqli_error());
	$result1 = mysqli_query($link,$sql);*/
?>
<html>

<head>
	<title>ค้นหาหมวดหมู่สินค้า</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
   <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/prototype.js" language="javascript" type="text/javascript"></script>
	<script language="javascript">
		function Product(Div) {
			var P_group = document.frmprice['P_group'].value;
			var params = "P_group=" + P_group; // +
			//alert(params);
			var url = "group_search_g.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product2(Div) {
			var G_name = document.frmprice2['G_name'].value;
			var params = "G_name=" + G_name; // +
			//alert(params);
			var url = "group_search_gname.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
	</script>
</head>

<body><br><br>
	<center>
		<h2 id="h2"><img src="picture/menu/search.png" width="50" height="50"> <u> ค้นหาหมวดหมู่สินค้า </u></h2><br>
		<form method=post action="group_search_g.php" name="frmprice">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัสหมวดหมู่: </td>
						<td class="text-left" width="10%"><input type="text" name="P_group"><input id="button" type="button" onclick="Product(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<form method=post action="group_search_gname.php" name="frmprice2">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="G_name"><input id="button2" type="button" onclick="Product2(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<br><a href='group_show.php'>ย้อนกลับ </a><hr>
		<div align="center" id="stock"></div>
</body>

</html>
<?php
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>
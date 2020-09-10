<?php
session_start();
?>
<html>

<head>
	<title>ค้นหาซัพพลายเออร์</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
   <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/prototype.js" language="javascript" type="text/javascript"></script>
	<script language="javascript">
		function Product(Div) {
			var Sup_id = document.frmprice['Sup_id'].value;
			var params = "Sup_id=" + Sup_id; // +
			//alert(params);
			var url = "supplier_search_id.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product2(Div) {
			var Sup_name = document.frmprice2['Sup_name'].value;
			var params = "Sup_name=" + Sup_name; // +
			//alert(params);
			var url = "supplier_search_name.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product3(Div) {
			var Contact_name = document.frmprice3['Contact_name'].value;
			var params = "Contact_name=" + Contact_name; // +
			//alert(params);
			var url = "supplier_search_contact.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
	</script>
</head>

<body><br><br>
	<center>
		<h2 id="h2"><img src="picture/menu/search.png" width="50" height="50"> <u> ค้นหาซัพพลายเออร์ </u></h2><br>
		<form method=post action="supplier_search_id.php" name="frmprice">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัส: </td>
						<td class="text-left" width="10%"><input type="text" name="Sup_id"><input id="button" type="button" onclick="Product(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<form method=post action="supplier_search_name.php" name="frmprice2">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="Sup_name"><input id="button2" type="button" onclick="Product2(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<form method=post action="supplier_search_contact.php" name="frmprice3">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อผู้ที่จะติดต่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="Contact_name"><input id="button3" type="button" onclick="Product3(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<br><a href='supplier_show.php'>ย้อนกลับ </a><hr>
		<div align="center" id="stock"></div>
</body>

</html>
<?php
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>
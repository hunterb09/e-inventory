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
	<script src="js/prototype.js" language="javascript" type="text/javascript"></script>
	<script language="javascript">
		function Product(Div) {
			var P_id = document.frmprice['P_id'].value;
			var params = "P_id=" + P_id; // +
			//alert(params);
			var url = "product_search_id.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product2(Div) {
			var G_name = document.frmprice2['G_name'].value;
			var params = "G_name=" + G_name; // +
			//alert(params);
			var url = "product_search_group.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product3(Div) {
			var P_name = document.frmprice3['P_name'].value;
			var params = "P_name=" + P_name; // +
			//alert(params);
			var url = "product_search_name.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product4(Div) {
			var P_tradename = document.frmprice4['P_tradename'].value;
			var params = "P_tradename=" + P_tradename; // +
			//alert(params);
			var url = "product_search_tradename.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
	</script>
	</head>
	<body><br><br><center>
		<h2 id="h2"><img src="picture/menu/search.png" width="50"height="50"> <u> ค้นหาสินค้า  </u></h2><br>
		<form method=post action="product_search_id.php" name="frmprice">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัสสินค้า: </td>
						<td class="text-left" width="10%"><input type="text" name="P_id"><input id="button" type="button" onclick="Product(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>
		
		<form method=post action="product_search_group.php" name="frmprice2">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
                        <td class="text-right" width="10%">จากหมวดหมู่: </td>
                        <td class="text-left" width="10%"><input type="text" name="G_name"><input id="button" type="button" onclick="Product2(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>

		<form method=post action="product_search_name.php" name="frmprice3">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="P_name"><input id="button" type="button" onclick="Product3(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>
        
        <form method=post action="product_search_tradename.php" name="frmprice4">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อเรียก: </td>
						<td class="text-left" width="10%"><input type="text" name="P_tradename"><input id="button" type="button" onclick="Product4(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
		</form>
		<br><a href='product_show.php'>ย้อนกลับ </a><hr>
        <div align="center" id="stock"></div>
		
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	

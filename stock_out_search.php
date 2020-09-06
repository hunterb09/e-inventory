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
	<script src="js/prototype.js" language="javascript" type="text/javascript"></script>
	<script language="javascript">
		function Product(Div) {
			var id = document.frmprice['id'].value;
			var params = "id=" + id; // +
			//alert(params);
			var url = "stock_out_search_id.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product2(Div) {
			var Rec_date = document.frmprice2['Rec_date'].value;
			var params = "Rec_date=" + Rec_date; // +
			var Rec_date1 = document.frmprice2['Rec_date1'].value;
			var params2 = "Rec_date1=" + Rec_date1; // +
			//alert(params);
			var url = "stock_out_search_date.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product3(Div) {
			var User_id = document.frmprice3['User_id'].value;
			var params = "User_id=" + User_id; // +
			//alert(params);
			var url = "stock_out_search_uid.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
	</script>
	</head>
	<body><br><br><center>
		<h2><img src="picture/menu/search.png" width="50"height="50"> <u> ค้นหาเบิกออก  </u></h2><br>

		<form method=post action="stock_out_search_id.php" name="frmprice">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากเลขที่ใบรับสินค้า: </td>
						<td class="text-left" width="10%"><input type="text" name="id"><input id="button" type="button" onclick="Product(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>

        <form method=post action="stock_out_search_date.php" name="frmprice2">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
                        <td class="text-right" width="10%" height="30">จากวันที่: <input type="date" name="Rec_date"></td>
						<td class="text-left" width="10%">ถึง <input type="date" name="Rec_date1"><input id="button" type="button" onclick="Product2(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>

		<form method=post action="stock_out_search_uid.php" name="frmprice3">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัสผู้ใช้งาน: </td>
						<td class="text-left" width="10%"><input type="text" name="User_id"><input id="button" type="button" onclick="Product3(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
		<br><a href='stock_out_show.php'>ย้อนกลับ </a>
		<div align="center" id="stock"></div>
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	

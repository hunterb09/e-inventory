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
	<script src="js/prototype.js" language="javascript" type="text/javascript"></script>
	<script language="javascript">
		function Product(Div) {
			var User_id = document.frmprice['User_id'].value;
			var params = "User_id=" + User_id; // +
			//alert(params);
			var url = "user_search_uid.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product2(Div) {
			var IDa = document.frmprice2['ID'].value;
			var params = "ID=" + IDa; // +
			//alert(params);
			var url = "user_search_id.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product3(Div) {
			var User_name = document.frmprice3['User_name'].value;
			var params = "User_name=" + User_name; // +
			//alert(params);
			var url = "user_search_name.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
		function Product4(Div) {
			var User_status = document.frmprice4['User_status'].value;
			var params = "User_status=" + User_status; // +
			//alert(params);
			var url = "user_search_status.php"; // 
			var Addnew = new Ajax.Updater(Div, url, {
				method: "post",
				parameters: params
			});
		}
	</script>
	</head>
	<body><br><br><center>
		<h2 id="h2"><img src="picture/menu/search.png" width="50"height="50"> <u> ค้นหาผู้ใช้งาน  </u></h2><br>
		<form method=post action="user_search_uid.php" name="frmprice">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากรหัส: </td>
						<td class="text-left" width="10%"><input type="text" name="User_id"><input id="button" type="button" onclick="Product(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>

		<form method=post action="user_search_id.php" name="frmprice2">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากไอดี: </td>
						<td class="text-left" width="10%"><input type="text" name="ID"><input id="button" type="button" onclick="Product2(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
        <form method=post action="user_search_name.php" name="frmprice3">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากชื่อ: </td>
						<td class="text-left" width="10%"><input type="text" name="User_name"><input id="button" type="button" onclick="Product3(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>

		<form method=post action="user_search_status.php" name="frmprice4">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="10%">จากสถานะ: </td>
						<td class="text-left" width="10%"><input type="text" name="User_status"><input id="button" type="button" onclick="Product4(stock)" value="ค้นหา"></td>
					</tr>
				</tbody>
			</table>
        </form>
        
		<br><a href='user_show.php'>ย้อนกลับ </a>
		<div align="center" id="stock"></div>
	</body>
</html>
<?php 
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	

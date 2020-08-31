<!--<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<title>Product Form</title>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-5.1.1.min.js"></script>
	<script>
		$(function () {
			$("#button").click(function () {
				$.ajax({
					url: "st_o_s.php",
					data: {'P_name':P_name},
					type: "post",
					success:function(data){
						$('#unit').html(data);
					}
				});
				//var P_name = $('#P_name').val();
				//$("#msg").load("st_o_s.php", { myID: P_name });
			});
		});
	</script>
</head>

<body>
	<form id="form1" method="post">
		<table border="0" align="center">
			<tr>
				<td><span class="style8">Product Name</span></td>
				<td><input type="text" name="P_name" id="P_name"></td>
				<td colspan="2">
					<div align="center"><input id="button" type="button" value="Search"></div>
				</td>
			</tr>
		</table>
	</form>
	<div align="center" id="unit"></div>
</body>

</html>
-->
<?php
session_start();
//1. เชื่อมต่อ database:
require("connection.php");
//หมวดหมู่สินค้า
$sql = "SELECT * FROM product ORDER BY P_name asc";
$result1 = mysqli_query($link, $sql);
?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<title>Show Products</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/prototype.js" language="javascript" type="text/javascript"></script>
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
	<script>
		$(function() {
			$('#P_name').selectMe({
				width: '350px', 
				columnCount: 2, 	//จำนวนคอลัมน์
				search: true			//แสดงช่องค้นหาหรือไม่
			});			
			
		});
	</script>
</head>

<body>
	<form id="form1" method="post" name="frmprice">
		<table border="0" align="center">
			<tr>
				<td><span class="style8">Product Name</span></td>
				<td><select name="P_name" id="P_name">
						<?php while ($row1 = mysqli_fetch_array($result1)) { ?>
							<option> <?php echo $row1["P_name"] ?> </option>
						<?php } ?>
					</select></td>
				<td colspan="2">
					<div align="center"><input id="button" type="button" onclick="Product(stock)" value="Search"></div>
				</td>
			</tr>
		</table>
	</form>
	<div align="center" id="stock"></div>

</body>

</html>
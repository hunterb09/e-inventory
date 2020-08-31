<?php
session_start();
//1. เชื่อมต่อ database:
require("connection.php");

$sql = "SELECT * FROM product ORDER BY P_name asc";
$result3 = mysqli_query($link, $sql);

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>softhouse</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- ตัวเชื่อมajax -->
	<link href="js/jquery-ui.min.css" rel="stylesheet">
	<script src="js/jquery-ui.min.js"> </script>
	<script src="js/jquery-form.min.js"> </script>
	<script>
		$(function() {
			$('select').change(function() {
				var P_name = document.frmprice['P_name'].value;
				//alert(P_name);
				$.ajax({
					url: "st_o_s.php",
					data: {'P_name': P_name},
					type: "post",
					success: showTpirce
				});
			});
		});

		function showTpirce(result) {
			$("#msg").html(result);
		}
	</script>
</head>

<body><br><br>
	<center>
		<h2><img src="picture/product/product.png" width="50" height="50"> <u> เบิกสินค้าออก </u></h2><br>
		<form id="form" method=post action="stock_in_insert.php" name="frmprice">
			สินค้า<select class="select" name="P_name" id="P_name" style="width: 20%;">
				<?php while ($row3 = mysqli_fetch_array($result3)) { ?>
					<option> <?php echo $row3["P_name"] ?> </option>
				<?php } ?>
			</select>
			<input type="button" onClick="Result(msg)" value="ค้นหา">
			<table border="0" width="80%" align="center" id="myTable">
				<thead id="result">
					<tr>
						<input type="hidden" id="User_id" name="User_id" value="<?php echo $_SESSION["User_id"] ?>">
					</tr>
					<p></p>
				</thead>
				<!-- body dynamic rows -->
				<tbody>
					
				</tbody>
			</table><br>
			<div align="center" id="msg"></div>
			<br><br>
			<input type="hidden" id="hdnCount" name="hdnCount">
			<input name="btnSubmit" type="submit" value="บันทึก" /></td>
		</form>
		<br><a href='stock_out_show.php'>ย้อนกลับ </a>
</body>

</html>
<?php
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>

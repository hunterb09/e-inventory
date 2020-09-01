<?php
session_start();
//1. เชื่อมต่อ database:
require("connection.php");
//ดึงรายการสินค้า
$sql = "SELECT * FROM product ORDER BY P_name asc";
$result3 = mysqli_query($link, $sql);

//ดึงวัตถุประสงค์
$sql = "SELECT * FROM purpose ORDER BY Pp_id asc";
$result2 = mysqli_query($link, $sql);
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>softhouse</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<link href="plugins/select-me/selectMe.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="plugins/select-me/selectMe.js"></script>
	<!-- ตัวเชื่อมajax -->
	<link href="js/jquery-ui.min.css" rel="stylesheet">
	<script src="js/jquery-ui.min.js"> </script>
	<script src="js/jquery-form.min.js"> </script>
	<script>
		$(function() {
			$('#P_name').change(function() {
				var P_name = document.getElementById("P_name").value;
				cP_name = P_name.length; //นับตัวอักษร
				//alert(cP_name);
				//alert(P_name);
				/*$.ajax({
					url: "st_o_s.php",
					data: {
						'P_name': P_name
					},
					type: "post",
					success: showTpirce
				}); */
				$.ajax({
					url: "stock_out_show_qty.php",
					data: {
						'P_name': P_name
					},
					type: "post",
					success: showQty
				});
			});
		});

		function showTpirce(result) {
			$("#msg").html(result);
		}

		function showQty(result) {
			$("#AllStock").val(result);
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function() {

			var rows = 1;
			$("#createRows").click(function() {
				var P_name = document.frmprice['P_name'].value;
				var AllStock = document.frmprice['AllStock'].value;
				var Qty = document.frmprice['Qty'].value;
				//var Qty = parseInt(strQty);
				if (P_name.trim() == "") {
					alert("กรุณากรอกชื่อ");
					AllStock = -1;
				}
				if (Qty.trim() == "") {
					alert("กรุณากรอกจำนวน");
					AllStock = -1;
				}
				//สตริง > ตัวเลขทศนิยม
				var floatQty = parseFloat(Qty);

				if (Number.isInteger(floatQty)) {
					//alert("จำนวนเต็ม" + floatQty);

					//วนลูปหาจำนวนสินค้าในหน้าเบิก (สินค้าที่จะเพิ่ม)
					var sumQty = parseInt(Qty);
					for (i = 1; i < rows; i++) {
						var Pn = document.frmprice['P_name' + i].value;
						var strQt = document.frmprice['Qty' + i].value;
						var Qty = parseInt(Qty);
						var Qt = parseInt(strQt);
						if (Pn == P_name) {
							//alert(sumQty + Qt);
							sumQty += Qt;
							//alert(Pn + " " + sumQty + " " + Qt);
						}
					}
					//เช็คจำนวนสินค้า
					var sum = AllStock - sumQty;
					//alert(AllStock +"-"+ sumQty +" = "+sum);

					//เพิ่มรายการสินค้า
					if (sum >= 0) {
						$.ajax({
							url: "stock_out_form_indtl.php",
							data: {
								'P_name': P_name
							},
							type: "post",
							success: function(data) {
								$('#indtl').html(data);
							}
						});

						//เก็บจำนวนแถว
						$('#hdnCount').val(rows);

						rows = rows + 1;
					} else {
						alert("สินค้าในสต๊อกมีไม่พอ");
					}
				} else {
					alert("กรุณากรอกเลขจำนวนเต็ม");
				}

			});

		});
	</script>
	<script>
		$(function() {
			$('#Pp_name').selectMe({
				width: '200px',
				columnCount: 1, //จำนวนคอลัมน์
				search: true //แสดงช่องค้นหาหรือไม่
			});

		});
	</script>
</head>

<body><br><br>
	<center>
		<h2><img src="picture/product/product.png" width="50" height="50"> <u> เบิกสินค้าออก </u></h2><br>
		<form id="form" method=post action="stock_out_insert.php" name="frmprice" enctype="multipart/form-data">
			<table border="0" width="80%" align="center">
				<tbody>
					<tr>
						<td class="text-right" width="20%">สินค้า: </td>
						<td class="text-left" width="10%"><select name='P_name' id='P_name'>
								<option></option>
								<?php while ($row3 = mysqli_fetch_array($result3)) { ?> <?php echo "<option value=" . $row3['P_name'] . " >" . $row3["P_name"] ?> </option><?php } ?>
							</select></td>
						<td class="text-right" width="10%">สินค้าในสต๊อก: </td>
						<td class="text-left" width="30%"><input type="text" name="AllStock" id="AllStock" readonly style="background-color: lightblue"></td>
					</tr>
				</tbody>
			</table>

			<br>
			จำนวน: <input type='number' name='Qty' id='Qty' min='1' size='5' required style='text-align :center'>
			<input type="button" id="createRows" style="background-color: lightgreen" value="ค้นหา">
			<div align="center" id="indtl"></div>
			<table border="1" width="80%" align="center" id="myTable">
				<thead id="result">
					<tr>
						<input type="hidden" id="User_id" name="User_id" value="<?php echo $_SESSION["User_id"] ?>">
					</tr>
					<p></p>
					<tr>
						<td class="text-center" width="10%">ลำดับ </td>
						<td class="text-center" width="20%">ใบรับสินค้า </td>
						<td class="text-center" width="20%">ชื่อสินค้า </td>
						<td class="text-center" width="10%">จำนวน </td>
						<!--<td class="text-center" width="10%">ราคารวม </td> -->
					</tr>
				</thead>
				<!-- body dynamic rows -->
				<tbody>

				</tbody>
			</table><br>
			<div align="center" id="msg"></div>
			<br><br>
			<input type="hidden" id="hdnCount" name="hdnCount">
			<table border="0" width="80%" align="center" name="c">
				<tbody>
					<tr>
						<!--<td class="text-right" width="20%">วัตถุประสงค์: </td>
						<td class="text-left" width="10%"><select name='Pp_name' id='Pp_name'>
								<?php //while ($row2 = mysqli_fetch_array($result2)) { 
								?> <?php //echo "<option value=" . $row2['Pp_name'] . " >" . $row2["Pp_name"] 
									?> </option><?php //} 
																										?>
							</select></td>-->
						<td class="text-right" width="10%">หมายเหตุ: </td>
						<td class="text-left" width="30%"><textarea name="Comment" id="Comment" cols="30" rows="1"></textarea></td>
					</tr>
				</tbody>
			</table><br>
			<input class="btn btn-primary" name="btnSubmit" type="submit" value="บันทึก" />
		</form><br>
		<a href='stock_out_show.php'>ย้อนกลับ </a>
</body>

</html>
<?php
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>
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
				var textP = $('#P_name').val();
				//alert(textP);
				var P_name = document.getElementById("P_name").value;
				cP_name = P_name.length; //นับตัวอักษร
				$.ajax({
					url: "stock_out_show_qty.php",
					data: {
						'P_name': P_name
					},
					type: "post",
					success: showQty
				});
				//เพิ่มรายการสินค้า
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
			//ดึงรายการข้างบน ไปล่าง
			var rows = 1;
			$("#newRows").click(function() {

				var t = "";
				$(':checkbox:checked').each(function() {
					t += $(this).val() + ", ";
				});
				//alert(t);
				//ทำเป็นอาร์เรย์
				var new_t = t.split(", ");
				new_t.pop();
				var x = 0; //เทส-
				while (x < new_t.length) {
					//alert(new_t[x]);
					var P_name = document.frmprice['P_name'].value;
					var AllStock = document.frmprice['AllStock'].value;
					var St_serial = document.frmprice['St_serial' + new_t[x]].value;
					var oldQty = document.frmprice['oldQty' + new_t[x]].value;
					var Qty = document.frmprice['sQty' + new_t[x]].value;
					var Price = document.frmprice['Price' + new_t[x]].value;
					var checkoldQty = parseInt(oldQty);
					var checkQty = parseInt(Qty);
					//alert(checkoldQty +" และ "+ checkQty);
					if (P_name.trim() == "") {
						alert("กรุณากรอกชื่อ");
						AllStock = -1;
					}
					if (checkQty > checkoldQty) {
						alert("จำนวนเบิก > จำนวนในสต๊อก");
						AllStock = -1;
					}
					if ((Qty.trim() == "") || (Qty.trim() < 1)) { //เช็คค่าว่าง และค่าตัวเลข > 0
						alert("กรุณากรอกจำนวน เป็นตัวเลข > 0");
						AllStock = -1;
					}
					//สตริง > ตัวเลขทศนิยม
					var floatQty = parseFloat(Qty);

					if ((Number.isInteger(floatQty)) && (floatQty > 1) ){
						//alert("จำนวนเต็ม" + floatQty);

						//วนลูปหาจำนวนสินค้าในหน้าเบิก (สินค้าที่เพิ่มไปแล้ว)
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
							var tr = "<tr>";
							tr = tr + "<td><input type='hidden' name='St_no" + rows + "' id='St_no" + rows + "' value='" + rows + "' >" + rows + "</td>";
							tr = tr + "<td><input type='hidden' name='St_indtl" + rows + "' id='St_indtl" + rows + "' value='" + St_serial + "' >" + St_serial + "</td>";
							tr = tr + "<td><input type='hidden' name='P_name" + rows + "' id='P_name" + rows + "' value='" + P_name + "' >" + P_name + "</td>";
							tr = tr + "<td><input type='hidden' name='Qty" + rows + "' id='Qty" + rows + "' value='" + Qty + "' >" + Qty + "</td>";
							tr = tr + "<td><input type='hidden' name='Price" + rows + "' id='Price" + rows + "' value='" + Price + "' >" + Price + "</td>";
							$('#myTable > tbody:last').append(tr);

							//เก็บจำนวนแถว
							$('#hdnCount').val(rows);

							rows = rows + 1;
						} else {
							alert("สินค้าในสต๊อกมีไม่พอ");
						}
					} else {
						alert("กรุณากรอกเลขจำนวนเต็ม");
					}
					x++;
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
						<td class="text-left" width="10%">
							<select name='P_name' id='P_name'>
								<option></option>
								<?php while ($row3 = mysqli_fetch_array($result3)) { ?>
									<option> <?php echo $row3["P_name"] ?> </option>
								<?php } ?>
							</select></td>
						<td class="text-right" width="10%">สินค้าในสต๊อก: </td>
						<td class="text-left" width="30%"><input type="text" name="AllStock" id="AllStock" readonly style="background-color: lightblue"></td>
					</tr>
				</tbody>
			</table>

			<br>
			<div align="center" id="indtl"></div>
			<br><input type="button" id="newRows" style="background-color: lightgreen" value="เพิ่ม">
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
						<td class="text-center" width="10%">ราคา </td>
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
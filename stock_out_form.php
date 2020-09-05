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
					var St_indtl = document.frmprice['St_indtl' + new_t[x]].value;
					var St_serial = document.frmprice['St_serial' + new_t[x]].value;
					var Unit_name = document.frmprice['Unit_name' + new_t[x]].value;
					//alert(Unit_name);
					var oldQty = document.frmprice['oldQty' + new_t[x]].value;
					var Qty = document.frmprice['sQty' + new_t[x]].value;
					var Price = document.frmprice['Price' + new_t[x]].value;
					var checkoldQty = parseInt(oldQty);
					var checkQty = parseInt(Qty);
					//alert(checkoldQty +" และ "+ checkQty);
					for (let j = 1; j < rows; j++) { //ลูป2เช็คค่าซ้ำ
					let St_indtlJ = $('#2St_indtl' + j).val();
					//alert("เข้าลูปfor2" + P_nameJ);
						if (St_indtl == St_indtlJ) {
							alert("เคยเลือกสินค้า "+ P_name + " ในเลขใบรับ "+St_serial+" แล้ว");
							AllStock = -1;
						}
					}
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

					if ((Number.isInteger(floatQty)) && (floatQty > 0) ){
						//alert("จำนวนเต็ม" + floatQty);

						//เพิ่มรายการสินค้า
						if (AllStock > 0) {
							var tr = "<tr>";
							tr = tr + "<td><input type='hidden' name='2St_no" + rows + "' id='2St_no" + rows + "' value='" + rows + "' >" + rows + "</td>";
							tr = tr + "<td><input type='hidden' name='2St_indtl" + rows + "' id='2St_indtl" + rows + "' value='" + St_indtl + "' ><input type='hidden' name='2St_serial" + rows + "' id='2St_serial" + rows + "' value='" + St_serial + "' >" + St_serial + "</td>";
							tr = tr + "<td><input type='hidden' name='2P_name" + rows + "' id='2P_name" + rows + "' value='" + P_name + "' >" + P_name + "</td>";
							tr = tr + "<td><input type='hidden' name='2Unit_name" + rows + "' id='2Unit_name" + rows + "' value='" + Unit_name + "' >" + Unit_name + "</td>";
							tr = tr + "<td><input type='hidden' name='2Qty" + rows + "' id='2Qty" + rows + "' value='" + Qty + "' >" + Qty + "</td>";
							tr = tr + "<td><input type='hidden' name='2Price" + rows + "' id='2Price" + rows + "' value='" + Price + "' >" + Price + "</td>";
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
						<td class="text-center" width="10%">หน่วย </td>
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
			<table border="0" width="80%" align="center" >
				<tbody>
					<tr>
						<td class="text-right" width="20%">วัตถุประสงค์: </td>
						<td class="text-left" width="10%"><select name='Pp_name' id='Pp_name'>
								<?php while ($row2 = mysqli_fetch_array($result2)) { ?> 
									<option value='<?php echo $row2["Pp_name"] ?>'> <?php echo $row2["Pp_name"] ?></option>
								<?php } ?>
							</select></td>
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
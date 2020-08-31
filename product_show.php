<?php
session_start();
include("pagination.php");
include("table.css");
//1. เชื่อมต่อ database:
require("connection.php");

$sql = "SELECT * FROM product ORDER BY P_id asc";
$result = page_query($link, $sql, 10);

//หมวดหมู่สินค้า
$sql = "SELECT * FROM p_group ORDER BY G_name asc";
$result1 = mysqli_query($link, $sql);
?>

<html>

<head>
	<title>จัดการสินค้า</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<link href="plugins/select-me/selectMe.css" rel="stylesheet"> 
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="plugins/select-me/selectMe.js"></script>
	<script>
		$(function() {
			$('#btnAdd').click(function() {
				$('#modalAdd').modal();
			});

			$('#G_name').selectMe({
				width: '350px', 
				columnCount: 2, 	//จำนวนคอลัมน์
				search: true			//แสดงช่องค้นหาหรือไม่
			});			
			
		});
	</script>
	<script>
		function Validation() {
			var noERROR = true;

			var Mname = document.getElementById("G_name");
			if (Mname.value.trim() == "") {
				alert("กรุณากรอกรหัสหมวดหมู่สินค้า");
				noERROR = false;
			}

			var Mname = document.getElementById("P_name");
			if (Mname.value.trim() == "") {
				alert("กรุณากรอกชื่อสินค้า");
				noERROR = false;
			}

			var Mname = document.getElementById("P_tradename");
			if (Mname.value.trim() == "") {
				alert("กรุณากรอกชื่อเรียกสินค้า");
				noERROR = false;
			}

			if (noERROR == true) {
				var form = document.getElementById("form");
				form.submit();
			}
		}
	</script>
</head>

<body align="center">
	<!-- องค์ประกอบของ Modal -->
	<div id="modalAdd" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">เพิ่มสินค้า</h5>
					<button class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form" method=post action="product_insert.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="login">หมวดหมู่สินค้า:</label>
							<select name="G_name" id="G_name" class="form-control">
								<?php while ($row1 = mysqli_fetch_array($result1)) { ?>
									<?php echo "<option value=".$row1['G_name']." >"  .$row1["G_name"] ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="login">ชื่อสินค้า:</label>
							<input type="text" id="P_name" name="P_name" class="form-control">
						</div>
						<div class="form-group">
							<label for="login">ชื่อเรียกสินค้า:</label>
							<input type="text" id="P_tradename" name="P_tradename" class="form-control">
						</div>
						<div class="form-group">
							<label for="login">หมายเหตุ:</label>
							<input type="text" id="Comment" name="Comment" class="form-control">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input class="btn btn-primary" name="btnSubmit" type="button" value="บันทึก" onclick="Validation();" />
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<?php
echo '<br><br><center><h2><img src="picture/product/product.png" width="50"height="50"> <u> สินค้า  </u></h2><br>';
echo '<a href="product_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหาสินค้า </a>
		<button id="btnAdd" class="btn btn-primary btn-lg active">เพิ่มสินค้า</button>';
echo '<p></p>';

//หัวข้อตาราง
echo "<table class='table-hover' id='table' border='1' align='center' width='80%'>";
echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() .
	" จากทั้งหมด: " . page_total_rows() . "</caption>";
echo "<tr>";
echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='5%'>รหัสสินค้า </th>
			<th width='5%'>รหัสหมวดหมู่สินค้า </th>
			<th width='15%'>ชื่อสินค้า </th>
			<th width='15%'>ชื่อเรียกสินค้า </th>
			<th width='10%'>หมายเหตุ </th>
			<th width='15%'>จัดการ </th>
		  </tr>";

while ($row = mysqli_fetch_array($result)) {
	echo "<tr align='center'>";
	echo "<td>" . $row["P_id"] .  "</td> ";
	echo "<td>" . $row["P_group"] .  "</td> ";
	echo "<td>" . $row["P_name"] .  "</td> ";
	echo "<td>" . $row["P_tradename"] .  "</td> ";
	echo "<td>" . $row["Comment"] .  "</td> ";

	$_SESSION['P_id'] = $row["P_id"];
	//รูปภาพ แก้ไขข้อมูล ลบ
	echo "<td><center><a href='product_update_form.php?P_id=$row[0]'><button class='btn btn-warning'>แก้ไข</button></a>
		<a href='product_delete.php?P_id=$row[0] ' onclick=\"return confirm('ต้องการที่จะลบสินค้าหรือไม่ ')\"><button class='btn btn-danger'>ลบ</button></a></td> ";
	echo "</tr>";
}
echo "</table>";
//mysqli_close($link);	
//echo "</form>";
page_link_border("solid", "1px", "gray");
page_link_bg_color("lightblue", "pink");
page_link_font("14px");
page_link_color("blue", "red");
page_echo_pagenums(6, true);
?>
<?php
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>
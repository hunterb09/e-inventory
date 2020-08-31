<?php
session_start();
include("pagination.php");
include("table.css");
//1. เชื่อมต่อ database:
require("connection.php");

$sql = "SELECT * FROM unit ORDER BY Unit_id asc" or die("Error:" . mysqli_error());
$result = page_query($link, $sql, 10);

?>

<html>

<head>
	<title>จัดการหน่วยสินค้า</title>
	<link href="js/jquery-ui.min.css" rel="stylesheet">
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"> </script>
	<script>
		$(function() {
			$('#btnAdd').click(function() {
				$('#modalAdd').modal();
			});
		});
	</script>
	<script>
		function Validation() {
			var noERROR = true;

			var Pname = document.getElementById("Unit_name");
			if (Pname.value.trim() == "") {
				alert("กรุณากรอกชื่อหน่วยสินค้า");
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
					<h5 class="modal-title">เพิ่มหน่วยสินค้า</h5>
					<button class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form" method=post action="unit_insert.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="login">ชื่อ:</label>
							<input type="text" id="Unit_name" name="Unit_name" class="form-control">
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
echo '<br><br><center><h2><img src="picture/product/p_group.png" width="50"height="50"> <u> หน่วยสินค้า  </u></h2><br>';
echo '<a href="unit_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหาหน่วย </a>
		<button id="btnAdd" class="btn btn-primary btn-lg active">เพิ่มหน่วย</button>';
echo '<p></p>';

//หัวข้อตาราง
echo "<table class='table-hover' id='table' border='1' align='center' width='80%'>";
echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() .
	" จากทั้งหมด: " . page_total_rows() . "</caption>";
echo "<tr>";
echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='8%'>รหัสหน่วยสินค้า </th>
			<th width='15%'>ชื่อหน่วยสินค้า </th>
			<th width='15%'>จัดการ </th>
		  </tr>";

while ($row = mysqli_fetch_array($result)) {
	echo "<tr align='center'>";
	echo "<td>" . $row["Unit_id"] .  "</td> ";
	echo "<td>" . $row["Unit_name"] .  "</td> ";

	$_SESSION['Unit_id'] = $row["Unit_id"];
	//รูปภาพ แก้ไขข้อมูล ลบ
	echo "<td><center><a href='unit_update_form.php?Unit_id=$row[0]'><button class='btn btn-warning'>แก้ไข</button></a>
		<a href='unit_delete.php?Unit_id=$row[0] ' onclick=\"return confirm('ต้องการที่จะลบหน่วยหรือไม่ ')\"><button class='btn btn-danger'>ลบ</button></a></td> ";
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
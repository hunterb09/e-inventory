<?php
session_start();
include("pagination.php");
//1. เชื่อมต่อ database:
require("connection.php");

$sql = "SELECT * FROM p_group ORDER BY P_group asc";
$result = page_query($link, $sql, 10);

?>

<html>

<head>
	<title>จัดการหมวดหมู่สินค้า</title>
	<style>
		@import "table.css";
	</style>
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

			var Pname = document.getElementById("G_name");
			if (Pname.value.trim() == "") {
				alert("กรุณากรอกชื่อหมวดหมู่สินค้า");
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
					<h5 class="modal-title">เพิ่มหมวดหมู่สินค้า</h5>
					<button class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form" method=post action="group_insert.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="login">ชื่อ:</label>
							<input type="text" id="G_name" name="G_name" class="form-control">
						</div>
					</form><!-- ต้องเช็คในdatabaseก่อนว่า ชื่อมีอยู่ในระบบรึยัง -->
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
echo '<br><br><center><h2><img src="picture/product/p_group.png" width="50"height="50"> <u> หมวดหมู่สินค้า  </u></h2><br>';
echo '<a href="group_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหาหมวดหมู่ </a>
			<button id="btnAdd" class="btn btn-primary btn-lg active">เพิ่มหมวดหมู่</button>';
echo '<p></p>';

//หัวข้อตาราง
echo "<table class='table-hover' id='table' border='1' align='center' width='80%'>";
echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() .
	" จากทั้งหมด: " . page_total_rows() . "</caption>";
echo "<tr>";
echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='8%'>รหัสหมวดหมู่สินค้า </th>
			<th width='15%'>ชื่อหมวดหมู่สินค้า </th>
			<th width='15%'>จัดการ </th>
		  </tr>";

while ($row = mysqli_fetch_array($result)) {
	echo "<tr align='center'>";
	echo "<td>" . $row["P_group"] .  "</td> ";
	echo "<td>" . $row["G_name"] .  "</td> ";

	$_SESSION['P_group'] = $row["P_group"];
	//แก้ไขข้อมูล ลบ
	echo "<td><center><a href='group_update_form.php?P_group=$row[0]'><button class='btn btn-warning'>แก้ไข</button></a>
		<a href='group_delete.php?P_group=$row[0] ' onclick=\"return confirm('ต้องการที่จะลบสินค้าหรือไม่ ')\"><button class='btn btn-danger'>ลบ</button></a></td> ";
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
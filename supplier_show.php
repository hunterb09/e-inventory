<?php
session_start();
include("pagination.php");
//1. เชื่อมต่อ database:
require("connection.php");

$sql = "SELECT * FROM supplier ORDER BY Sup_id asc";
$result = page_query($link, $sql, 10);

?>

<html>

<head>
	<title>จัดการซัพพลายเออร์</title>
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

			var Pname = document.getElementById("Sup_name");
			if (Pname.value.trim() == "") {
				alert("กรุณากรอกชื่อผู้จัดส่ง");
				noERROR = false;
			}

			var Mname = document.getElementById("Address");
			if (Mname.value.trim() == "") {
				alert("กรุณากรอกที่อยู่");
				noERROR = false;
			}

			var Mname = document.getElementById("Phone");
			if (Mname.value.trim() == "") {
				alert("กรุณากรอกโทรศัพท์");
				noERROR = false;
			}

			var Mname = document.getElementById("Contact_name");
			if (Mname.value.trim() == "") {
				alert("กรุณากรอกชื่อผู้ที่จะติดต่อ");
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
					<h5 class="modal-title">เพิ่มซัพพลายเออร์</h5>
					<button class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form" method=post action="supplier_insert.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="login">ชื่อผู้จัดส่ง:</label>
							<input type="text" id="Sup_name" name="Sup_name" class="form-control">
						</div>
						<div class="form-group">
							<label for="login">ที่อยู่:</label>
							<input type="text" id="Address" name="Address" class="form-control">
						</div>
						<div class="form-group">
							<label for="login">โทรศัพท์:</label>
							<input type="text" id="Phone" name="Phone" class="form-control">
						</div>
						<div class="form-group">
							<label for="login">ชื่อผู้ที่จะติดต่อ:</label>
							<input type="text" id="Contact_name" name="Contact_name" class="form-control">
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
echo '<br><br><center><h2><img src="picture/product/p_group.png" width="50"height="50"> <u> ซัพพลายเออร์  </u></h2><br>';
echo '<a href="supplier_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหาซัพพลายเออร์ </a>
			<button id="btnAdd" class="btn btn-primary btn-lg active">เพิ่มซัพพลายเออร์</button>';
echo '<p></p>';

//หัวข้อตาราง
echo "<table class='table-hover' id='table' border='1' align='center' width='80%'>";
echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() .
	" จากทั้งหมด: " . page_total_rows() . "</caption>";
echo "<tr>";
echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='5%'>รหัส </th>
			<th width='10%'>ชื่อผู้จัดส่ง </th>
			<th width='15%'>ที่อยู่ </th>
			<th width='5%'>โทรศัพท์ </th>
			<th width='10%'>ชื่อผู้ที่จะติดต่อ </th>
			<th width='15%'>จัดการ </th>
		  </tr>";

while ($row = mysqli_fetch_array($result)) {
	echo "<tr align='center'>";
	echo "<td>" . $row["Sup_id"] .  "</td> ";
	echo "<td>" . $row["Sup_name"] .  "</td> ";
	echo "<td>" . $row["Address"] .  "</td> ";
	echo "<td>" . $row["Phone"] .  "</td> ";
	echo "<td>" . $row["Contact_name"] .  "</td> ";

	$_SESSION['Sup_id'] = $row["Sup_id"];
	//แก้ไขข้อมูล ลบ
	echo "<td><center><a href='supplier_update_form.php?Sup_id=$row[0]'><button class='btn btn-warning'>แก้ไข</button></a>
		<a href='supplier_delete.php?Sup_id=$row[0] ' onclick=\"return confirm('ต้องการที่จะลบซัพพลายเออร์หรือไม่ ')\"><button class='btn btn-danger'>ลบ</button></a></td> ";
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
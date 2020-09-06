<?php
	session_start();
	include("pagination.php");
	//1. เชื่อมต่อ database:
	require("connection.php");
	
	$sql = "SELECT * FROM purpose ORDER BY Pp_id asc" or die("Error:" . mysqli_error());
	$result = page_query($link, $sql, 10);

?>

<html>
<head>
	<title>จัดการวัตถุประสงค์</title>
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
		function Validation(){
					var noERROR = true;

					var Pname = document.getElementById("Pp_name");	
					if (Pname.value.trim() == ""){
						alert("กรุณากรอกวัตถุประสงค์");
						noERROR = false;
					}

					if(noERROR == true){
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
					<h5 class="modal-title">เพิ่มวัตถุประสงค์</h5>
					<button class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form" method=post action="purpose_insert.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="login">ชื่อ:</label>
							<textarea name="Pp_name" id="Pp_name" class="form-control"></textarea>
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
	echo '<br><br><center><h2><img src="picture/product/p_group.png" width="50"height="50"> <u> วัตถุประสงค์  </u></h2><br>';
	echo '<a href="purpose_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหาวัตถุประสงค์ </a>
			<button id="btnAdd" class="btn btn-primary btn-lg active">เพิ่มวัตถุประสงค์</button>';
	echo '<p></p>';
	
	//หัวข้อตาราง
	echo "<table class='table-hover' id='table' border='1' align='center' width='80%'>";
	echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() . 
 		 " จากทั้งหมด: " . page_total_rows() . "</caption>";
	echo "<tr>";
	echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='8%'>รหัสวัตถุประสงค์ </th>
			<th width='15%'>วัตถุประสงค์ </th>
			<th width='15%'>จัดการ </th>
		  </tr>";
		  
	while($row = mysqli_fetch_array($result)) {
	  echo "<tr align='center'>";
		  echo "<td>" .$row["Pp_id"] .  "</td> ";
		  echo "<td>" .$row["Pp_name"] .  "</td> ";
			
		$_SESSION['Pp_id'] = $row["Pp_id"];
		//รูปภาพ แก้ไขข้อมูล ลบ
		echo "<td><center><a href='purpose_update_form.php?Pp_id=$row[0]'><button class='btn btn-warning'>แก้ไข</button></a>
		<a href='purpose_delete.php?Pp_id=$row[0] ' onclick=\"return confirm('ต้องการที่จะลบหน่วยหรือไม่ ')\"><button class='btn btn-danger'>ลบ</button></a></td> ";	
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
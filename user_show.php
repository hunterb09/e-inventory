<?php
	include("pagination.php");
	include("table.css");
	//1. เชื่อมต่อ database:
	require("connection.php");
	
	$sql = "SELECT * FROM user ORDER BY User_id asc" or die("Error:" . mysqli_error());
	$result = page_query($link, $sql, 10);
	session_start();

?>

<html>
<head>
	<title>จัดการผู้ใช้งาน</title>
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
				function Validation(){
					var noERROR = true;

					var Mname = document.getElementById("ID");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกไอดี");
						noERROR = false;
					}
					
					if (Mname.value.trim().length < 4){
						alert("กรุณากรอกไอดี > 3ตัว");
						noERROR = false;
					}

					var Mname = document.getElementById("User_password");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกพาสเวิร์ด");
						noERROR = false;
					}

					if (Mname.value.trim().length < 4){
						alert("กรุณากรอกพาสเวิร์ด > 3ตัว");
						noERROR = false;
					}

					var Mname = document.getElementById("User_name");	
					if (Mname.value.trim() == ""){
						alert("กรุณากรอกชื่อ");
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
					<h5 class="modal-title">เพิ่มสินค้า</h5>
					<button class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form" method=post action="user_insert.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="login">ไอดี:</label>
							<input type="text" id="ID" name="ID" class="form-control">
						</div>
						<div class="form-group">
							<label for="login">พาสเวิร์ด:</label>
							<input type="text" id="User_password" name="User_password" class="form-control">
						</div>
						<div class="form-group">
							<label for="login">ชื่อผู้ใช้งาน:</label>
							<input type="text" id="User_name" name="User_name" class="form-control">
						</div>
						<div class="form-group">
							<label for="login">สเตตัส:</label>
							<input type="radio" name="User_status" onclick="check(this.value)" value="admin">admin
							<input type="radio" name="User_status" onclick="check(this.value)" value="officer">officer
							<input type="radio" name="User_status" onclick="check(this.value)" value="user" checked="checked">user
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
	echo '<br><br><center><h2><img src="picture/product/p_group.png" width="50"height="50"> <u> ผู้ใช้งาน  </u></h2><br>';
	echo '<a href="user_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหาผู้ใช้งาน </a>
		<button id="btnAdd" class="btn btn-primary btn-lg active">เพิ่มผู้ใช้งาน</button>';
	echo '<p></p>';
	
	//หัวข้อตาราง
	echo "<table id='table' border='1' align='center' width='80%'>";
	echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() . 
 		 " จากทั้งหมด: " . page_total_rows() . "</caption>";
	echo "<tr>";
	echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='8%'>รหัสผู้ใช้งาน </th>
			<th width='15%'>ชื่อผู้ใช้งาน </th>
			<th width='8%'>สถานะ </th>
			<th width='15%'>จัดการ </th>
		  </tr>";
		  
	while($row = mysqli_fetch_array($result)) {
	  echo "<tr align='center'>";
		  echo "<td>" .$row["User_id"] .  "</td> ";
		  echo "<td>" .$row["User_name"] .  "</td> ";
		  echo "<td>" .$row["User_status"] .  "</td> ";
			
		//$_SESSION['User_id'] = $row["User_id"];

		echo "<td><center><a href='user_update_form.php?User_id=$row[0]'><button class='btn btn-warning'>แก้ไข</button></a>
		<a href='user_delete.php?User_id=$row[0] ' onclick=\"return confirm('ต้องการที่จะลบหน่วยหรือไม่ ')\"><button class='btn btn-danger'>ลบ</button></a></td> ";	
	  echo "</tr>";
	}
	echo "</table>";

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
<?php
	$data = $_POST['Unit_name'];
	session_start();
	include("pagination.php");

	//1. เชื่อมต่อ database:
	require("connection.php");
	
	$sql = "SELECT * FROM unit WHERE Unit_name LIKE '%$data%' ";
	$result = page_query($link, $sql, 10);


?>

<html>
<head>
	<title>จัดการหมวดหมู่สินค้า</title>
	<link href="js/jquery-ui.min.css" rel="stylesheet">
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"> </script>
	<style>
		body {
			background: url(bg.jpg);
		}
		table {
			border-collapse: collapse;
			margin: auto;
			min-width: 300px;
		}
		td {
			text-align: left;
			vertical-align: top;
			max-width: 200px;
			word-wrap:break-word;
		}
		td, th {
			padding: 5px;
			border-right: solid 1px white;
			font: 14px tahoma;
		}
		td:last-child, th:last-child {
			border-right: solid 0px !important;
		}
		tr:nth-of-type(odd) {
			background: #dfd;
		}
		tr:nth-of-type(even) {
			background: #ddf;
		}
		th {
			background: green !important;
			color: yellow;
		}
		caption {
			text-align: left;
			margin-bottom: 5px;
		}
	</style>
</head>
<body align="center">
</body>
</html>

<<?php
	echo '<br><br><center><h2><img src="picture/product/p_group.png" width="50"height="50"> <u> หน่วยสินค้า  </u></h2><br>';
	echo '<a href="unit_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหาหน่วย </a>
		 <a href="unit_form.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">เพิ่มหน่วย </a>';
	echo '<p></p>';
	echo "<a href='unit_search.php?ID='> ย้อนกลับ </a>";
	
	//หัวข้อตาราง
	echo "<table id='table' border='1' align='center' width='80%'>";
	echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() . 
 		 " จากทั้งหมด: " . page_total_rows() . "</caption>";
	echo "<tr>";
	echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='8%'>รหัสหน่วยสินค้า </th>
			<th width='15%'>ชื่อหน่วยสินค้า </th>
			<th width='15%'>จัดการ </th>
		  </tr>";
		  
	while($row = mysqli_fetch_array($result)) {
	  echo "<tr align='center'>";
		  echo "<td>" .$row["Unit_id"] .  "</td> ";
		  echo "<td>" .$row["Unit_name"] .  "</td> ";
			
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
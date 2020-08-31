<?php
	$data = $_POST['P_id'];
	session_start();
	include("pagination.php");

	//1. เชื่อมต่อ database:
	require("connection.php");
	
	$sql = "SELECT * FROM product WHERE P_id LIKE '%$data%' ";
	$result = page_query($link, $sql, 10);


?>

<html>
<head>
	<title>จัดการสินค้า</title>
	<link href="js/jquery-ui.min.css" rel="stylesheet">
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>>
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

<?php
	echo '<br><br><center><h2><img src="picture/product/product.png" width="50"height="50"> <u> สินค้า  </u></h2><br>';
	echo '<a href="product_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหาสินค้า </a>
		 <a href="product_form.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">เพิ่มสินค้า </a>';
	echo '<p></p>';
	echo "<a href='product_search.php?ID='> ย้อนกลับ </a>";
	
	//หัวข้อตาราง
	echo "<table id='table' border='1' align='center' width='80%'>";
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
		  
	while($row = mysqli_fetch_array($result)) {
	  echo "<tr align='center'>";
	 	  echo "<td>" .$row["P_id"] .  "</td> ";
		  echo "<td>" .$row["P_group"] .  "</td> ";
		  echo "<td>" .$row["P_name"] .  "</td> ";
		  echo "<td>" .$row["P_tradename"] .  "</td> ";
		  echo "<td>" .$row["Comment"] .  "</td> ";
			
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
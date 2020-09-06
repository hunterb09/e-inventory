<?php
	session_start();
	include("pagination.php");

	$Rec_date = $_POST['Rec_date'];
    $Rec_date1 = $_POST['Rec_date1'];
	//1. เชื่อมต่อ database:
	require("connection.php");
    $sql = "SELECT * FROM stock_outmst WHERE Rec_date BETWEEN date('$Rec_date') AND date('$Rec_date1') ";
    $result = page_query($link, $sql, 100);
    
?>

<html>
<head>
	<title>ค้นหาผู้ใช้งาน</title>
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

<?php
	/*echo '<br><br><center><h2><img src="picture/product/p_group.png" width="50"height="50"> <u> ผู้ใช้งาน  </u></h2><br>';
	echo "<a href='stock_in_search.php?ID='> ย้อนกลับ </a>";*/
	
	//หัวข้อตาราง
	echo "<table id='table' border='1' align='center' width='80%'>";
	echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() . 
 		 " จากทั้งหมด: " . page_total_rows() . "</caption>";
	echo "<tr>";
	echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='10%'>เลขที่ใบรับสินค้า </th>
			<th width='10%'>วันที่รับ </th>
			<th width='5%'>ผู้เบิก </th>
			<th width='5%'>วัตถุประสงค์ </th>
			<th width='10%'>หมายเหตุ </th>
			<th width='5%'>จัดการ </th>
		  </tr>";
		  
	while($row = mysqli_fetch_array($result)) {
		//แปลงจากรหัสเป็นชื่อผู้รับ
		$User_id = $row['User_id'];
		$sql2 = "SELECT * FROM user WHERE User_id = '$User_id' ";
		$result2 = mysqli_query($link,$sql2);
		$row2 = mysqli_fetch_array($result2);	
		$User_name = $row2["User_name"];

		//แปลงจากรหัสเป็นวัตถุประสงค์
		$Pp_id = $row['Pp_id'];
		$sql2 = "SELECT * FROM purpose WHERE Pp_id = '$Pp_id' ";
		$result2 = mysqli_query($link,$sql2);
		$row2 = mysqli_fetch_array($result2);	
		$Pp_name = $row2["Pp_name"];

		echo "<tr align='center'>";
		echo "<td>" . $row["Stout_serial"] .  "</td> ";
		echo "<td>" . $row["Rec_date"] .  "</td> ";
		echo "<td>" . $User_name .  "</td> ";
		echo "<td>" . $Pp_name .  "</td> ";
		echo "<td>" . $row["Comment"] .  "</td> ";
		$_SESSION['Stout_serial'] = $row["Stout_serial"];
		//ดู แก้ไข ลบข้อมูล 
		echo "<td><center><a href='stock_in_showbill.php?St_serial=$row[0]'><button class='btn btn-info'>ดูข้อมูล</button></a></td> ";	
		//<a href='stock_in_update_form.php?St_serial=$row[0]'><button class='btn btn-warning'>แก้ไข</button></a>
		//<a href='stock_in_delete.php?St_serial=$row[0] ' onclick=\"return confirm('ต้องการที่จะลบรายการหรือไม่ ')\"><button class='btn btn-danger'>ลบ</button></a></td> ";	
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
//include("footer.html"); ?>	
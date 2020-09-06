<?php
session_start();
include("pagination.php");
//1. เชื่อมต่อ database:
require("connection.php");

$sql = "SELECT * FROM product ORDER BY P_id asc";
$result = page_query($link, $sql, 100);

?>

<html>

<head>
	<title>สต๊อกสินค้า</title>
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<style>
		@import "table.css";
	</style>
</head>

<body align="center">
</body>

</html>

<?php
echo '<br><br><center><h2><img src="picture/product/product.png" width="50"height="50"> <u> สต๊อกสินค้า  </u></h2><br>';
echo '<a href="stock_search.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ค้นหา </a>';
echo '<p></p>';

//หัวข้อตาราง
echo "<table class='table-hover' id='table' border='1' align='center' width='80%'>";
echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() .
	" จากทั้งหมด: " . page_total_rows() . "</caption>";
echo "<tr>";
echo "<tr align='center' bgcolor='#CCCCCC'>
			<th width='5%'>รหัสสินค้า </th>
			<th width='10%'>ชื่อสินค้า </th>
			<th width='10%'>หมวดหมู่ </th>
			<th width='5%'>จำนวน </th>
			<th width='5%'>จัดการ </th>
		  </tr>";

while ($row = mysqli_fetch_array($result)) {
	$P_id = $row['P_id'];
	$P_group = $row['P_group'];
	//แปลงจากรหัสเป็นชื่อหมวดหมู่
	$sql1 = "SELECT * FROM p_group WHERE P_group = '$P_group' ";
	$result1 = mysqli_query($link, $sql1);
	$row1 = mysqli_fetch_array($result1);
	$G_name = $row1["G_name"];

	//หายอดคงเหลือในอดีต ของสมาชิก
	//ผลรวมใบรับ
	$sql2 = "
		SELECT SUM(Qty) AS Qty
		FROM stock_indtl 
		WHERE P_id = '$P_id'
		";
	$result2 = mysqli_query($link, $sql2);
	$row2 = mysqli_fetch_array($result2);

	//ผลรวมใบเบิก
	$sql1 = "
		SELECT SUM(Qty) AS Qty
		FROM stock_outdtl 
		WHERE P_id = '$P_id'
		";
	$result1 = mysqli_query($link, $sql1);
	$row1 = mysqli_fetch_array($result1);

	//หาปริมาณในสต๊อก  (จำนวนสินค้าใบรับ - ใบเบิก)
	$in = $row2["Qty"];
	$out = $row1["Qty"];
	$in_out = $in - $out;

	echo "<tr align='center'>";
	echo "<td>" . $P_id .  "</td> ";
	echo "<td>" . $row["P_name"] .  "</td> ";
	echo "<td>" . $G_name .  "</td> "; 
	echo "<td>" . $in_out .  "</td> ";
	//ดู แก้ไข ลบข้อมูล 
	echo "<td><center><a href='stock_showbill.php?P_id=$row[0]'><button class='btn btn-info'>ดูข้อมูล</button></a></td> ";
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
include("footer.html"); ?>
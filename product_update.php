<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");

//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_POST["P_id"] == '') {
	echo "<script type='text/javascript'>";
	echo "alert('Error Contact Admin !!');";
	echo "window.location = 'product_show.php'; ";
	echo "</script>";
}

//แปลงจากชื่อเป็นรหัส
$sql1 = "SELECT * FROM p_group WHERE G_name = '" . $_POST['G_name'] . "' ";
$result1 = mysqli_query($link, $sql1);
$row1 = mysqli_fetch_array($result1);
//$P_id = "LT005";
$P_group = $row1["P_group"];

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$P_id = $_POST["P_id"];
$P_name = $_POST["P_name"];
$P_tradename = $_POST["P_tradename"];
$Comment = $_POST["Comment"];

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
$sql = "SELECT * FROM product WHERE P_name='$P_name' ";
$result1 = mysqli_query($link, $sql);
$num = mysqli_num_rows($result1);

//เช็คจากรหัสในฟอร์ม ว่าชื่อได้แก้ไขไหม
$sql = "SELECT * FROM product WHERE (P_id='$P_id') AND (P_name='$P_name') ";
$result2 = mysqli_query($link, $sql);
$name2 = mysqli_num_rows($result2);
if ($name2 > 0) {
	//รหัสและชื่อเหมือนเดิม
	//ถ้าเจอ $num = 0;
	$num = 0;
}
//ถ้าไม่เจอ เหมือนเดิม

if ($num > 0) {
	//ถ้าชื่อซ้ำ
	echo "<script type='text/javascript'>alert('$P_name << ชื่อสินค้านี้มีอยู่แล้ว');
		window.location = 'product_show.php'; </script>";
} else {
	//ยังไม่มีชื่อนี้อยู่ในระบบ
	//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
	$sql = "UPDATE product SET 
			P_group='$P_group' , 
			P_name='$P_name' , 
			P_tradename='$P_tradename' , 
			Comment='$Comment'
			WHERE P_id='$P_id' ";
	$result = mysqli_query($link, $sql);
	echo "<script type='text/javascript'>alert('เพิ่มสินค้า $P_name สำเร็จ');
		window.location = 'product_show.php'; </script>";
}
?>
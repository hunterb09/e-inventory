<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");

//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_POST["User_id"] == '') {
	echo "<script type='text/javascript'>";
	echo "alert('Error Contact Admin !!');";
	echo "window.location = 'user_show.php'; ";
	echo "</script>";
}

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$User_id = $_POST["User_id"];
$ID = $_POST["ID"];
$User_password = $_POST["User_password"];
$User_name = $_POST["User_name"];
$User_status = $_POST["User_status"];

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
$sql = "SELECT * FROM user WHERE ID='$ID' ";
$result1 = mysqli_query($link, $sql);
$num = mysqli_num_rows($result1);

//เช็คจากรหัสในฟอร์ม ว่าไอดีได้แก้ไขไหม
$sql = "SELECT * FROM user WHERE (User_id='$User_id') AND (ID='$ID') ";
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
	echo "<script type='text/javascript'>alert('$ID << ไอดีนี้มีอยู่แล้ว');
		window.location = 'user_show.php'; </script>";
} else {
	//ยังไม่มีชื่อนี้อยู่ในระบบ
	//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
	$sql = "UPDATE user SET 
				ID='$ID' , 
				User_password='$User_password' , 
				User_name='$User_name' ,
				User_status='$User_status' 
				WHERE User_id='$User_id' ";
	$result = mysqli_query($link, $sql);
	echo "<script type='text/javascript'>alert('แก้ไขผู้ใช้งาน $User_name สำเร็จ');
		window.location = 'user_show.php'; </script>";
}
?>
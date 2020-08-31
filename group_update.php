<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");

//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if($_POST["P_group"]==''){
    echo "<script type='text/javascript'>"; 
    echo "alert('กรุณากรอกชื่อ');"; 
    echo "window.location = 'group_show.php'; "; 
    echo "</script>"; 
}

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
	$P_group = $_POST["P_group"]; 
	$G_name = $_POST["G_name"];

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM p_group WHERE G_name='$G_name' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
		//ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$G_name << ชื่อนี้มีอยู่แล้ว');
		window.location = 'group_show.php'; </script>";
	}
	else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
		$sql = "UPDATE p_group SET 
		G_name='$G_name'
		WHERE P_group='$P_group' ";
		$result = mysqli_query($link, $sql);
		echo "<script type='text/javascript'>alert('เพิ่มหมวดหมู่ $G_name สำเร็จ');
		window.location = 'group_show.php'; </script>";
    }    
?>
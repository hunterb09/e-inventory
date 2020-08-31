<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");

//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if($_POST["Pp_id"]==''){
    echo "<script type='text/javascript'>"; 
    echo "alert('Error Contact Admin !!');"; 
    echo "window.location = 'purpose_show.php'; "; 
    echo "</script>"; 
}

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
	$Pp_id = $_POST["Pp_id"]; 
	$Pp_name = $_POST["Pp_name"];

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM purpose WHERE Pp_name='$Pp_name' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
		//ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$Pp_name << ชื่อนี้มีอยู่แล้ว');
		window.location = 'purpose_show.php'; </script>";
	}
	else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
		$sql = "UPDATE purpose SET 
				Pp_name='$Pp_name'
				WHERE Pp_id='$Pp_id' ";
		$result = mysqli_query($link, $sql);
		echo "<script type='text/javascript'>alert('เพิ่มวัตถุประสงค์ $Pp_name สำเร็จ');
		window.location = 'purpose_show.php'; </script>";
    }
?>
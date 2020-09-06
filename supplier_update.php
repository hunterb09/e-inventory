<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");

//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if($_POST["Sup_id"]==''){
    echo "<script type='text/javascript'>"; 
    echo "alert('Error Contact Admin !!');"; 
    echo "window.location = 'supplier_show.php'; "; 
    echo "</script>"; 
}

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
	$Sup_id = $_POST["Sup_id"]; 
	$Sup_name = $_POST["Sup_name"];


//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM supplier WHERE Sup_name='$Sup_name' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
		//ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$Sup_name << ชื่อนี้มีอยู่แล้ว');
		window.location = 'supplier_show.php'; </script>";
	}
	else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
		$sql = "UPDATE supplier SET 
				Sup_name='$Sup_name'
				WHERE Sup_id='$Sup_id' ";
		$result = mysqli_query($link, $sql);
		echo "<script type='text/javascript'>alert('เพิ่มหมวดหมู่ $Sup_name สำเร็จ');
		window.location = 'supplier_show.php'; </script>";
    }
?>
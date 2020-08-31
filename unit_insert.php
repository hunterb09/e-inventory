<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	
	$Unit_name = $_POST['Unit_name'];
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM unit WHERE Unit_name='$Unit_name' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
		//ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$Unit_name << ชื่อนี้มีอยู่แล้ว');
		window.location = 'unit_show.php'; </script>";
    }else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		$sql = "insert into unit (Unit_name)".
		"values('$Unit_name')";
		$result = mysqli_query($link,$sql);	
		echo "<script type='text/javascript'>alert('เพิ่มหมวดหมู่ $Unit_name สำเร็จ');
		window.location = 'unit_show.php'; </script>";
    }
	
?>
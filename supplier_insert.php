<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	
	$Sup_name = $_POST['Sup_name'];
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM supplier WHERE Sup_name='$Sup_name' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
        //ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$Sup_name << ชื่อนี้มีอยู่แล้ว');
		window.location = 'supplier_show.php'; </script>";
    }else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		$sql = "insert into supplier (Sup_name)".
		"values('$Sup_name')";
		$result = mysqli_query($link,$sql);	
		echo "<script type='text/javascript'>alert('เพิ่มซัพพลายเออร์ $Sup_name สำเร็จ');
		window.location = 'supplier_show.php'; </script>";
    }
?>
<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	
	$Pp_name = $_POST['Pp_name'];
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM purpose WHERE Pp_name='$Pp_name' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
		//ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$Pp_name << ชื่อนี้มีอยู่แล้ว');
		window.location = 'purpose_show.php'; </script>";
    }else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		$sql = "INSERT into purpose (Pp_name)".
		"values('$Pp_name')";
		$result = mysqli_query($link,$sql);	
		echo "<script type='text/javascript'>alert('เพิ่มวัตถุประสงค์ $Pp_name สำเร็จ');
		window.location = 'purpose_show.php'; </script>";
    }

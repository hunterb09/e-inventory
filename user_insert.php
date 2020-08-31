<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	
	$ID = $_POST['ID'];
	$User_password = $_POST['User_password'];
	$User_name = $_POST['User_name'];
	$User_status = $_POST['User_status'];
			
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM user WHERE ID='$ID' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
        //ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$ID << ไอดีนี้มีอยู่แล้ว');
		window.location = 'user_show.php'; </script>";
    }else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		$sql = "insert into user (ID, User_password, User_name, User_status)".
		"values('$ID', '$User_password', '$User_name', '$User_status')";
		$result = mysqli_query($link,$sql);	
		echo "<script type='text/javascript'>alert('เพิ่มผู้ใช้งาน $User_name สำเร็จ');
		window.location = 'user_show.php'; </script>";
    }
?>
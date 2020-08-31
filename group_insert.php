<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	
	$G_name = $_POST['G_name'];
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM p_group WHERE G_name='$G_name' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
        //ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$G_name << ชื่อนี้มีอยู่แล้ว');
		window.location = 'group_show.php'; </script>";
    }else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		$sql = "insert into p_group (G_name)".
		"values('$G_name')";
		$result = mysqli_query($link,$sql);	
		echo "<script type='text/javascript'>alert('เพิ่มหมวดหมู่ $G_name สำเร็จ');
		window.location = 'group_show.php'; </script>";
    }
?>
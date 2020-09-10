<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	//รันเลขไอดีออโต้
	$sql = "SELECT * FROM product ORDER BY P_id desc";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($result);
	$startid = "LT";
	$id = $row["P_id"];
	//strlen($id); //นับตัวอักษร
	$sb = substr($id, 2, 3); //เลือกตัวเลข
	$subint = (int)($sb); //เปลี่ยนตัวแปรเป็น int
	$P_id = ($subint+1); //+1
	if($P_id <= 9){
		$strnum = "00"; 
		$P_id = $startid.$strnum.$P_id; 
	}else if($P_id <= 99){
		$strnum = "0"; 
		$P_id = $startid.$strnum.$P_id; 
	}else{
		$P_id = $startid.$P_id; 
	}

	//แปลงจากชื่อเป็นรหัส
	$sql1 = "SELECT * FROM p_group WHERE G_name = '".$_POST['G_name']."' ";
	$result1 = mysqli_query($link,$sql1);
	$row1 = mysqli_fetch_array($result1);	
	$P_group = $row1["P_group"];
	
	$P_name = $_POST['P_name'];
	$P_tradename = $_POST['P_tradename'];
	$Comment = $_POST['Comment'];
			
	// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
	$sql="SELECT * FROM product WHERE P_name='$P_name' ";
	$result1 = mysqli_query($link,$sql);	
	$num = mysqli_num_rows($result1); 
	if($num > 0){
		//ถ้าชื่อซ้ำ
		echo "<script type='text/javascript'>alert('$P_name << ชื่อสินค้านี้มีอยู่แล้ว');
		window.location = 'product_show.php'; </script>";
    }else{
		//ยังไม่มีชื่อนี้อยู่ในระบบ
		$sql = "insert into product (P_id, P_group, P_name, P_tradename, Comment)".
		"values('$P_id', '$P_group', '$P_name', '$P_tradename', '$Comment')";
		$result = mysqli_query($link,$sql);	
        echo "<script type='text/javascript'>alert('เพิ่มสินค้า $P_name สำเร็จ');
		window.location = 'product_show.php'; </script>";
    }
?>
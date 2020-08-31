<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	$Unit_id = mysqli_real_escape_string($link,$_GET['Unit_id']);
	$sql = "DELETE FROM unit WHERE Unit_id = $Unit_id ";
	$result = mysqli_query($link,$sql);	
	if ($result)
		{
			echo "<script type='text/javascript'>";
			echo "alert('การลบข้อมูลสำเร็จ');";
			echo "window.location = 'unit_show.php'; ";
			echo "</script>";
			mysqli_close($link);
		}
	else
		{
			echo "<script type='text/javascript'>";
			echo "alert('ไม่สามารถลบข้อมูลได้');";
			echo "window.location = 'unit_show.php'; ";
			echo "</script>";
		}
	//สร้างแถบเมนู
	require("unit_show.php");
?>
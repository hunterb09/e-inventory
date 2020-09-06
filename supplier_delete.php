<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	$Sup_id = mysqli_real_escape_string($link,$_GET['Sup_id']);
	$sql = "DELETE FROM supplier WHERE Sup_id = $Sup_id ";
	$result = mysqli_query($link,$sql);	
	if ($result)
		{
			echo "<script type='text/javascript'>";
			echo "alert('การลบข้อมูลสำเร็จ');";
			echo "window.location = 'supplier_show.php'; ";
			echo "</script>";
			mysqli_close($link);
		}
	else
		{
			echo "<script type='text/javascript'>";
			echo "alert('ไม่สามารถลบข้อมูลได้');";
			echo "window.location = 'supplier_show.php'; ";
			echo "</script>";
		}
	//สร้างแถบเมนู
	require("supplier_show.php");
?>
<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	$P_group = mysqli_real_escape_string($link,$_GET['P_group']);
	$sql = "DELETE FROM p_group WHERE P_group = $P_group ";
	$result = mysqli_query($link,$sql);	
	if ($result)
		{
			echo "<script type='text/javascript'>";
			echo "alert('การลบข้อมูลสำเร็จ');";
			echo "window.location = 'group_show.php'; ";
			echo "</script>";
			mysqli_close($link);
		}
	else
		{
			echo "<script type='text/javascript'>";
			echo "alert('ไม่สามารถลบข้อมูลได้');";
			echo "window.location = 'group_show.php'; ";
			echo "</script>";
		}
	//สร้างแถบเมนู
	require("group_show.php");
?>
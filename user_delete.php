<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	$User_id = mysqli_real_escape_string($link,$_GET['User_id']);
	$sql = "DELETE FROM user WHERE User_id = $User_id ";
	$result = mysqli_query($link,$sql);	
	if ($result)
		{
			echo "<script type='text/javascript'>";
			echo "alert('การลบข้อมูลสำเร็จ');";
			echo "window.location = 'user_show.php'; ";
			echo "</script>";
			mysqli_close($link);
		}
	else
		{
			echo "<script type='text/javascript'>";
			echo "alert('ไม่สามารถลบข้อมูลได้');";
			echo "window.location = 'user_show.php'; ";
			echo "</script>";
		}
	//สร้างแถบเมนู
	require("user_show.php");
?>
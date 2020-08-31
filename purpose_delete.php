<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	$Pp_id = mysqli_real_escape_string($link,$_GET['Pp_id']);
	$sql = "DELETE FROM purpose WHERE Pp_id = $Pp_id ";
	$result = mysqli_query($link,$sql);	
	if ($result)
		{
			echo "<script type='text/javascript'>";
			echo "alert('การลบข้อมูลสำเร็จ');";
			echo "window.location = 'purpose_show.php'; ";
			echo "</script>";
			mysqli_close($link);
		}
	else
		{
			echo "<script type='text/javascript'>";
			echo "alert('ไม่สามารถลบข้อมูลได้');";
			echo "window.location = 'purpose_show.php'; ";
			echo "</script>";
		}
	//สร้างแถบเมนู
	require("purpose_show.php");
?>
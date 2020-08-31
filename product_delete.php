<?php
	//เชื่อมต่อฐานข้อมูล 
	require("connection.php");
	//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
	if($_GET["P_id"]==''){ 
		echo "<script type='text/javascript'>"; 
		echo "alert('Error Contact Admin !!');"; 
		echo "window.location = 'product_show.php'; "; 
		echo "</script>"; 
	}
	$P_id = mysqli_real_escape_string($link,$_GET['P_id']);
	$sql = "DELETE FROM p_id WHERE P_id = $P_id ";
	$result = mysqli_query($link,$sql) or die ("Error in query: $sql " . mysqli_error());
	if ($result)
		{
			echo "<script type='text/javascript'>";
			echo "alert('การลบข้อมูลสำเร็จ');";
			echo "window.location = 'product_show.php'; ";
			echo "</script>";
			mysqli_close($link);
		}
	else
		{
			echo "<script type='text/javascript'>";
			echo "alert('ไม่สามารถลบข้อมูลได้');";
			echo "window.location = 'product_show.php'; ";
			echo "</script>";
		}
	//สร้างแถบเมนู
	require("product_show.php");
?>
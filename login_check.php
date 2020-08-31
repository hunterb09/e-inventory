<?php
	//หลังจากล็อกอิน ได้ทำการเช็คสถานะ
	session_start();
	$id = $_POST['id'];
	$password = $_POST['password'];
	
	//$salt = 'fjdkslarueiwoqp';
	//$hash_login_password = hash_hmac('sha256', $password, $salt);

	//เชื่อมต่อฐานข้อมูล
	require("connection.php");
	//$encrypted_mypassword=sha1($pass);
	
	
	$sql="SELECT * FROM user WHERE ID='$id' AND "." 
         User_password='$password'";
	$result = mysqli_query($link,$sql);	
	$row = mysqli_fetch_array($result);
	$num = mysqli_num_rows($result); 
	//if (($row['User_status'] == "admin") || ($row['User_status'] == "officer") || ($row['User_status'] == "user")) มีข้อมูล ตามที่ผู้ใช้ล็อกอินเข้ามา
	if ($num > 0) //มีข้อมูล ตามที่ผู้ใช้ล็อกอินเข้ามา
	{
		//echo "ล็อกอินสำเร็จ <p>";
		$_SESSION["User_id"] = $row["User_id"];
		$_SESSION["ID"] = $row["ID"];
		$_SESSION["User_name"] = $row["User_name"];
		$_SESSION["User_status"] = $row["User_status"];
		session_write_close();
		if($row['User_status'] == "admin")
		{
			//header("location:menu_admin.php");
			echo "<script>";
			echo "alert(' เข้าสู่ระบบสำเร็จ');";
			echo "window.location='menu_admin.php';";
			echo "</script>";
        }
        else if($row['User_status'] == "officer")
		{
			//header("location:menu_officer.php");
			echo "<script>";
			echo "alert(' เข้าสู่ระบบสำเร็จ');";
			echo "window.location='menu_officer.php';";
			echo "</script>";
		}
		else
		{
			//header("location:menu_user.php");
			echo "<script>";
			echo "alert(' เข้าสู่ระบบสำเร็จ');";
			echo "window.location='menu_user.php';";
			echo "</script>";
		}

	}
	else //ไม่มีข้อมูล ตามที่ผู้ใช้ล็อกอินเข้ามา
	{
		echo "<script>";
		echo "alert(' กรุณากรอกใหม่อีกครั้ง !');";
		echo "window.location='login.php';";
		echo "</script>";
		//header("location:login.php");
	}
?>
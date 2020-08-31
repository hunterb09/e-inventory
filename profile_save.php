<?php
	session_start();
	
	if($_SESSION['User_id'] == "")
	{
		echo "Please Login!";
		exit();
	}
	require("connection.php");

	 
	if($_POST["txtPassword"] != $_POST["txtConPassword"])
	{
		echo "Password not Match!";
		exit();
	}
	$sql = "UPDATE user SET 
	User_Password = '".trim($_POST['txtPassword'])."'
	,User_name = '".trim($_POST['txtName'])."' 
	WHERE User_id = '".$_SESSION["User_id"]."' ";
	$result = mysqli_query($link,$sql);	
	echo "<br><br><br><center>";
	echo "แก้ไขข้อมูลสำเร็จ<br>";      
	 



	if($_SESSION["User_status"] == "admin")
	{
		echo "<br> Go to <a href='stock_in_show.php'>Admin page</a>";
    }
    elseif($_SESSION["User_status"] == "officer")
	{
		echo "<br> Go to <a href='stock_in_show.php'>Officer page</a>";
	}
	else
	{
		echo "<br> Go to <a href='stock_in_show.php'>User page</a>";
	}
	//เช็คว่ามีสถานะหรือไม่
	//require("navbar_check.php");
	include("footer.html"); 
?>
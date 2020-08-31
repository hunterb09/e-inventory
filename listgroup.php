<?php
    $p = trim($_GET['term']);  //ให้ใช้คีย์เป็นคำว่า 'term' เท่านั้น
	if(empty($p)) {
		exit;
	}
    //1. เชื่อมต่อ database:
    require("connection.php");
    $sql = "SELECT *  FROM p_group 
				WHERE G_name LIKE '%$p%'";
	
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0) {
		//อ่านข้อมูลผลลัพธ์มาสร้างเป็นอาร์เรย์ของ PHP
		$a = array();
		while($row = mysqli_fetch_array($result)) {
			array_push($a, $row["G_name"]);
		}
		//แปลงอาร์เรย์ของ PHP เป็น JSON แล้วส่งกลับ
		echo json_encode($a); 
	}	
	mysqli_close($link);
?>
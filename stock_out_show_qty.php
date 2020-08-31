<?php
    //ตรวจสอบว่ามีการส่งค่าตัวแปร $_POST[''] หรือไม่
	if(!isset($_POST['P_name'])){
		exit();
    }
    $data = $_POST['P_name'];
    session_start();
    
    //1. เชื่อมต่อ database:
    require("connection.php");
       
    //ดึงค่ารหัสสินค้า
    $sql0 = "SELECT * FROM product WHERE P_name = '$data' ";
    $result0 = mysqli_query($link, $sql0);
    $row0 = mysqli_fetch_array($result0);
    $P_id = $row0["P_id"];
    
    //หายอดคงเหลือในอดีต ของสมาชิก
    //ผลรวมใบรับ
    $sql = "
    SELECT SUM(Qty) AS Qty
    FROM stock_indtl 
    WHERE P_id = '$P_id'
    ";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result);

    //ผลรวมใบเบิก
    $sql1 = "
    SELECT SUM(Qty) AS Qty
    FROM stock_outdtl 
    WHERE P_id = '$P_id'
    ";
    $result1 = mysqli_query($link,$sql1);
    $row1 = mysqli_fetch_array($result1);

    //หาปริมาณในสต๊อก  (จำนวนสินค้าใบรับ - ใบเบิก)
    $in = $row["Qty"];
    $out = $row1["Qty"];
    $in_out = $in - $out;

    echo $in;
?>

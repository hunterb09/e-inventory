<?php
$data = $_POST['P_name'];
session_start();
include("pagination.php");

//1. เชื่อมต่อ database:
require("connection.php");

$sql = "SELECT * FROM product WHERE P_name LIKE '%$data%' ";
$result = page_query($link, $sql, 100);


?>

<html>

<head>
    <title>ค้นหาสต๊อกสินค้า</title>
    <link href="js/jquery-ui.min.css" rel="stylesheet">
    <link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"> </script>
    <style>
        body {
            background: url(bg.jpg);
        }

        table {
            border-collapse: collapse;
            margin: auto;
            min-width: 300px;
        }

        td {
            text-align: left;
            vertical-align: top;
            max-width: 200px;
            word-wrap: break-word;
        }

        td,
        th {
            padding: 5px;
            border-right: solid 1px white;
            font: 14px tahoma;
        }

        td:last-child,
        th:last-child {
            border-right: solid 0px !important;
        }

        tr:nth-of-type(odd) {
            background: #dfd;
        }

        tr:nth-of-type(even) {
            background: #ddf;
        }

        th {
            background: green !important;
            color: yellow;
        }

        caption {
            text-align: left;
            margin-bottom: 5px;
        }
    </style>
</head>

<body align="center">
</body>

</html>

<?php
//หัวข้อตาราง
echo "<table id='table' border='1' align='center' width='80%'>";
echo "<caption>ข้อมูลรายการ: " . page_start_row() . " - " . page_stop_row() .
    " จากทั้งหมด: " . page_total_rows() . "</caption>";
echo "<tr>";
echo "<tr align='center' bgcolor='#CCCCCC'>
            <th width='5%'>รหัสสินค้า </th>
            <th width='10%'>ชื่อสินค้า </th>
            <th width='10%'>หมวดหมู่ </th>
            <th width='5%'>จำนวน </th>
            <th width='5%'>จัดการ </th>
		  </tr>";

while ($row = mysqli_fetch_array($result)) {
    $P_id = $row['P_id'];
    $P_group = $row['P_group'];
    //แปลงจากรหัสเป็นชื่อหมวดหมู่
    $sql1 = "SELECT * FROM p_group WHERE P_group = '$P_group' ";
    $result1 = mysqli_query($link, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $G_name = $row1["G_name"];

    //หายอดคงเหลือในอดีต ของสมาชิก
    //ผลรวมใบรับ
    $sql2 = "
		SELECT SUM(Qty) AS Qty
		FROM stock_indtl 
		WHERE P_id = '$P_id'
		";
    $result2 = mysqli_query($link, $sql2);
    $row2 = mysqli_fetch_array($result2);

    //ผลรวมใบเบิก
    $sql1 = "
		SELECT SUM(Qty) AS Qty
		FROM stock_outdtl 
		WHERE P_id = '$P_id'
		";
    $result1 = mysqli_query($link, $sql1);
    $row1 = mysqli_fetch_array($result1);

    //หาปริมาณในสต๊อก  (จำนวนสินค้าใบรับ - ใบเบิก)
    $in = $row2["Qty"];
    $out = $row1["Qty"];
    $in_out = $in - $out;

    echo "<tr align='center'>";
	echo "<td>" . $P_id .  "</td> ";
	echo "<td>" . $row["P_name"] .  "</td> ";
	echo "<td>" . $G_name .  "</td> "; 
	echo "<td>" . $in_out .  "</td> ";
    echo "<td><center><a href='stock_showbill.php?P_id=$row[0]'><button class='btn btn-info'>ดูข้อมูล</button></a></td> ";
    echo "</tr>";
}
echo "</table>";
?>
<?php
//สร้างแถบเมนู
echo "<br><a href='#h2'>ไปบนสุด </a><hr>";
include("navbar_check.php");
?>
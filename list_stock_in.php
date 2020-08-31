 <?php
    //1. เชื่อมต่อ database:
    require("connection.php");

    $P_name = $_GET['P_name'];

    //เลือกรหัสสินค้า
    $sql = "SELECT * FROM product WHERE P_name = '$P_name ' ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $P_id = $row["P_id"];

    //เลือกทุกรายการรับ ของรหัสสินค้า
    $sql0 = "SELECT * FROM stock_inmst ORDER BY $P_id asc";
    $result0 = mysqli_query($link, $sql0);
   
   echo"<table border='1'><tr align='center'>
   <td><b>ลำดับ</b></td>
   <td><b>ลำดับ</b></td>
   <td><b>ลำดับ</b></td>
   </tr>";

    //วนลูปดึงข้อมูลจากตาราง
    while ($row0 = mysqli_fetch_array($result0)){
       $St_indtl = $row0["St_indtl"];
       $St_indtl = $row0["St_indtl"];
       $P_id	 = $row0["P_id	"];
       $Unit_id = $row0["Unit_id"];
       $Qty = $row0["Qty"];
       $Price = $row0["Price"];

       echo "<tr>".
            "<td><center>$St_indtl</center></td>"
            "</tr>"


    }

    ?>
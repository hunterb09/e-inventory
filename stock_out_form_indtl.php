<?php
    $data = $_POST['P_name'];
    session_start();
    
    //1. เชื่อมต่อ database:
    require("connection.php");
    //echo "saa".$data;
    //echo "ชื่อสินค้า ".$data."";
    
    //ดึงค่ารหัสสินค้า
    $sql0 = "SELECT * FROM product WHERE P_name = '$data' ";
    $result0 = mysqli_query($link, $sql0);
    $row0 = mysqli_fetch_array($result0);
    $P_id = $row0["P_id"];
    //echo "<br> ไอดี ".$P_id;
    echo "<form name='indtl'><table border='1' width='80%'><tr align='center' bgcolor='#CCCCCC'>
    <th width='5%'>เลือก </th>
    <th width='10%'>ลำดับ </th>
    <th width='10%'>เลขใบรับ </th>
    <th width='5%'>ชื่อสินค้า </th>
    <th width='5%'>ชื่อหน่วย </th>
    <th width='5%'>จำนวน </th>
    <th width='5%'>จำนวนเบิก </th>
    <th width='5%'>ราคา </th>
  </tr>";
  
    
    //รายการรับ
    $sql = "SELECT * FROM stock_indtl WHERE P_id = '$P_id' ";
    $result = mysqli_query($link, $sql);
    //$row = mysqli_fetch_array($result);
    //$St_serial = $row["St_serial"];
    //echo "<tr align='center'><td> $St_serial </td></tr>";
  $i = 0;
	while($row = mysqli_fetch_array($result)) {
        // ดึงชื่อหน่วย
        $unit = $row["Unit_id"];
        $sql1 = "SELECT * FROM unit WHERE Unit_id = '$unit' ";
        $result1 = mysqli_query($link, $sql1);
        $row1 = mysqli_fetch_array($result1);
      echo "<tr align='center'>";
          echo '<td> <input type="checkbox" name="indtl'.$i.'" value="'.$i.'"> </td> ';
          echo "<td>" .$row["St_indtl"] .  "</td> ";
          echo '<td> <input type="text" name="St_serial'.$i.'" id="St_serial'.$i.'" value="'.$row["St_serial"] .'" readonly style="background-color: #DCDCDC" size="8"></td> ';
          echo "<td>" .$data.  "</td> ";
          echo "<td>" .$row1["Unit_name"] .  "</td> ";
          echo '<td> <input type="text" name="oldQty'.$i.'" id="oldQty'.$i.'" value="'.$row["Qty"] .'"readonly style="background-color: #DCDCDC" size="3"></td> ';
          echo '<td> <input type="number" name="sQty'.$i.'" id="sQty'.$i.'" value="'.$row["Qty"] .'" min="1" max="'.$row["Qty"] .'" size="2"></td> ';
          echo '<td> <input type="text" name="Price'.$i.'" id="Price'.$i.'" value="'.$row["Price"] .'" readonly style="background-color: #DCDCDC" size="3"></td> ';
      echo "</tr>";
      $i++;
    }
    echo '</tr></table></form>';

?>
    
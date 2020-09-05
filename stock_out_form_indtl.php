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
    <th width='10%'>เลขใบรับ </th>
    <th width='10%'>ชื่อสินค้า </th>
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
      $Qty_change = $row["Qty_change"]; //ถ้าจำนวนคงเหลือ = 0 เด้งออกลูป
      if($Qty_change == 0){
        //ไม่ดึงแถว
      }else{
        // ดึงชื่อหน่วย
        $unit = $row["Unit_id"];
        $sql1 = "SELECT * FROM unit WHERE Unit_id = '$unit' ";
        $result1 = mysqli_query($link, $sql1);
        $row1 = mysqli_fetch_array($result1);
        echo "<tr align='center'>";
            echo '<td> <input type="checkbox" name="indtl'.$i.'" value="'.$i.'"> </td> ';
            echo '<td> <input type="hidden" name="St_indtl'.$i.'" id="St_indtl'.$i.'" value="'.$row["St_indtl"] .'" ';
            echo '<td> <input type="hidden" name="St_serial'.$i.'" id="St_serial'.$i.'" value="'.$row["St_serial"] .'">'.$row["St_serial"] .'</td> ';
            echo '<td> <input type="hidden" name="P_name'.$i.'" id="P_name'.$i.'" value="'.$data.'">'.$data.'</td> ';
            echo '<td> <input type="hidden" name="Unit_name'.$i.'" id="Unit_name'.$i.'" value="'.$row1["Unit_name"] .'">'.$row1["Unit_name"] .'</td> ';
            echo '<td> <input type="hidden" name="oldQty'.$i.'" id="oldQty'.$i.'" value="'.$row["Qty_change"] .'">'.$row["Qty_change"] .'</td> ';
            echo '<td> <input type="number" name="sQty'.$i.'" id="sQty'.$i.'" value="'.$row["Qty_change"] .'" min="1" max="'.$row["Qty_change"] .'" size="2"></td> ';
            echo '<td> <input type="hidden" name="Price'.$i.'" id="Price'.$i.'" value="'.$row["Price"] .'">'.$row["Price"] .'</td> ';
        echo "</tr>";
      $i++;
      }
    }
    echo '</tr></table></form>';

?>
    
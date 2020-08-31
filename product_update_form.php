<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if ($_GET["P_id"] == '') {
  echo "<script type='text/javascript'>";
  echo "alert('Error Contact Admin !!');";
  echo "window.location = 'product_show.php'; ";
  echo "</script>";
}

//รับค่าไอดีที่จะแก้ไข
$P_id = mysqli_real_escape_string($link, $_GET['P_id']);

//2. query ข้อมูลจากตาราง: 
$sql = "SELECT * FROM product WHERE P_id = '$P_id' ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
extract($row);
session_start();

//ดึงหมวดหมู่ทั้งหมด
$sql = "SELECT * FROM p_group ORDER BY G_name asc";
  $result1 = mysqli_query($link,$sql);
  
//ดึงหมวดหมู่จากสินค้า แปลงจากรหัสเป็นชื่อหมวดหมู่
$sql = "SELECT * FROM p_group WHERE P_group = '$P_group' ";
$result2 = mysqli_query($link, $sql);
$row2 = mysqli_fetch_array($result2);
$G_name2 = $row2["G_name"];

?>
<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<br><br>
<center>
  <form action="product_update.php" method="post" name="updates" id="updates">
    <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="40" colspan="2" align="center" bgcolor="#D6D5D6"><img src="picture/product/product.png" width="50" height="50"> <b>แก้ไขข้อมูลสินค้า</b></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">ID :</td>
        <td bgcolor="#EBEBEB">

          <p><input type="text" name="P_id" value="<?php echo $P_id; ?>" disabled='disabled' />
            <input type="hidden" name="P_id" value="<?php echo $P_id; ?>" />
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">หมวดหมู่สินค้า :</td>
        <td bgcolor="#EBEBEB"><select name="G_name" id="G_name">
                  <option value="<?=$G_name2;?>"><?=$G_name2;?></option>
								    <?php while($row1 = mysqli_fetch_array($result1)) { ?>
									<option> <?php echo $row1["G_name"] ?> </option>
									<?php } ?>
								</select></td>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td width="117" align="right" bgcolor="#EBEBEB">ชื่อสินค้า :</td>
        <td width="583" bgcolor="#EBEBEB"><input name="P_name" type="text" id="P_name" value="<?= $P_name; ?>" size="30" required="required" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td width="117" align="right" bgcolor="#EBEBEB">ชื่อเรียกสินค้า :</td>
        <td width="583" bgcolor="#EBEBEB"><input name="P_tradename" type="text" id="P_tradename" value="<?= $P_tradename; ?>" size="30" required="required" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td width="117" align="right" bgcolor="#EBEBEB">หมายเหตุ:</td>
        <td width="583" bgcolor="#EBEBEB"><input name="Comment" type="text" id="Comment" value="<?= $Comment; ?>" size="30" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;
          <input type="button" value=" ยกเลิก " onclick="window.location='product_show.php' " /> <!-- ถ้าไม่แก้ไขให้กลับไปหน้าแสดงรายการ -->
          &nbsp;
          <input type="submit" name="Update" id="Update" value="Update" /></td>
      </tr>
      <tr>
        <td bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
    </table>
  </form>
  <?php
  //สร้างแถบเมนู
  include("navbar_check.php");
  include("footer.html"); ?>
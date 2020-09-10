<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if($_GET["Sup_id"]==''){ 
    echo "<script type='text/javascript'>"; 
    echo "alert('Error Contact Admin !!');"; 
    echo "window.location = 'supplier_show.php'; "; 
    echo "</script>"; 
}

//รับค่าไอดีที่จะแก้ไข
$Sup_id = mysqli_real_escape_string($link,$_GET['Sup_id']);

//2. query ข้อมูลจากตาราง: 
$sql = "SELECT * FROM supplier WHERE Sup_id='$Sup_id' ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
extract($row);
session_start();

?>
<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<br><br><center>
<form action="supplier_update.php" method="post" name="updates" id="updates">
  <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="40" colspan="2" align="center" bgcolor="#D6D5D6"><img src="picture/product/p_group.png" width="50"height="50"> <b>แก้ไขชื่อซัพพลายเออร์</b></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">รหัสซัพพลายเออร์ :</td>
      <td bgcolor="#EBEBEB">
      
      <p><input type="text" name="Sup_id" value="<?php echo $Sup_id; ?>" disabled='disabled' />
<input type="hidden" name="Sup_id" value="<?php echo $Sup_id; ?>" /> 
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td width="117" align="right" bgcolor="#EBEBEB">ชื่อผู้จัดส่ง :</td>
      <td width="583" bgcolor="#EBEBEB"><input name="Sup_name" type="text" id="Sup_name" value="<?=$Sup_name;?>" size="30" required="required"  /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td width="117" align="right" bgcolor="#EBEBEB">ที่อยู่ :</td>
      <td width="583" bgcolor="#EBEBEB"><textarea name="Address" id="Address" cols="33" rows="4"><?=$Address;?></textarea></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td width="117" align="right" bgcolor="#EBEBEB">โทรศัพท์ :</td>
      <td width="583" bgcolor="#EBEBEB"><input name="Phone" type="text" id="Phone" value="<?=$Phone;?>" size="30" required="required"  /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td width="117" align="right" bgcolor="#EBEBEB">ชื่อผู้ที่จะติดต่อ :</td>
      <td width="583" bgcolor="#EBEBEB"><input name="Contact_name" type="text" id="Contact_name" value="<?=$Contact_name;?>" size="30" required="required"  /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;
        <input type="button" value=" ยกเลิก " onclick="window.location='supplier_show.php' " /> <!-- ถ้าไม่แก้ไขให้กลับไปหน้าแสดงรายการ -->
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
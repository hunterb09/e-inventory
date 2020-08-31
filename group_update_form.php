<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if($_GET["P_group"]==''){ 
    echo "<script type='text/javascript'>"; 
    echo "alert('Error Contact Admin !!');"; 
    echo "window.location = 'group_show.php'; "; 
    echo "</script>"; 
}

//รับค่าไอดีที่จะแก้ไข
$P_group = mysqli_real_escape_string($link,$_GET['P_group']);

//2. query ข้อมูลจากตาราง: 
$sql = "SELECT * FROM p_group WHERE P_group='$P_group' ";
$result = mysqli_query($link, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
extract($row);
session_start();

?>
<br><br><center>
<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<form action="group_update.php" method="post" name="updates" id="updates">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="40" colspan="2" align="center" bgcolor="#D6D5D6"><img src="picture/product/p_group.png" width="50"height="50"> <b>แก้ไขชื่อประเภทสินค้า</b></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">รหัสหมวดหมู่ :</td>
      <td bgcolor="#EBEBEB">
      
      <p><input type="text" name="P_group" value="<?php echo $P_group; ?>" disabled='disabled' />
<input type="hidden" name="P_group" value="<?php echo $P_group; ?>" /> 
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td width="117" align="right" bgcolor="#EBEBEB">ชื่อหมวดหมู่ :</td>
      <td width="583" bgcolor="#EBEBEB"><input name="G_name" type="text" id="G_name" value="<?=$G_name;?>" size="30" required="required"  /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;
        <input type="button" value=" ยกเลิก " onclick="window.location='group_show.php' " /> <!-- ถ้าไม่แก้ไขให้กลับไปหน้าแสดงรายการ -->
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
<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if($_GET["Pp_id"]==''){ 
    echo "<script type='text/javascript'>"; 
    echo "alert('Error Contact Admin !!');"; 
    echo "window.location = 'purpose_show.php'; "; 
    echo "</script>"; 
}

//รับค่าไอดีที่จะแก้ไข
$Pp_id = mysqli_real_escape_string($link,$_GET['Pp_id']);

//2. query ข้อมูลจากตาราง: 
$sql = "SELECT * FROM purpose WHERE Pp_id='$Pp_id' ";
$result = mysqli_query($link, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
extract($row);
session_start();

?>
<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<br><br><center>
<form action="purpose_update.php" method="post" name="updates" id="updates">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="40" colspan="2" align="center" bgcolor="#D6D5D6"><img src="picture/product/p_group.png" width="50"height="50"> <b>แก้ไขชื่อวัตถุประสงค์</b></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">รหัสวัตถุประสงค์ :</td>
      <td bgcolor="#EBEBEB">
      
      <p><input type="text" name="Pp_id" value="<?php echo $Pp_id; ?>" disabled='disabled' />
<input type="hidden" name="Pp_id" value="<?php echo $Pp_id; ?>" /> 
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td width="117" align="right" bgcolor="#EBEBEB">ชื่อวัตถุประสงค์ :</td>
      <td width="583" bgcolor="#EBEBEB"><input name="Pp_name" type="text" id="Pp_name" value="<?=$Pp_name;?>" size="30" required="required"  /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#EBEBEB">&nbsp;</td>
      <td bgcolor="#EBEBEB">&nbsp;
        <input type="button" value=" ยกเลิก " onclick="window.location='purpose_show.php' " /> <!-- ถ้าไม่แก้ไขให้กลับไปหน้าแสดงรายการ -->
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
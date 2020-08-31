<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
require("connection.php");
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
if ($_GET["User_id"] == '') {
  echo "<script type='text/javascript'>";
  echo "alert('Error Contact Admin !!');";
  echo "window.location = 'user_show.php'; ";
  echo "</script>";
}

//รับค่าไอดีที่จะแก้ไข
$User_id = mysqli_real_escape_string($link, $_GET['User_id']);

//2. query ข้อมูลจากตาราง: 
$sql = "SELECT * FROM user WHERE User_id='$User_id' ";
$result = mysqli_query($link, $sql) or die("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
extract($row);
session_start();
?>
<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<br><br>
<center>
  <form action="user_update.php" method="post" name="updates" id="updates">
    <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="40" colspan="2" align="center" bgcolor="#D6D5D6"><img src="picture/product/p_group.png" width="50" height="50"> <b>แก้ไขชื่อผู้ใช้งาน</b></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">รหัสผู้ใช้งาน :</td>
        <td bgcolor="#EBEBEB">

          <p><input type="text" name="User_id" value="<?php echo $User_id; ?>" disabled='disabled' />
            <input type="hidden" name="User_id" value="<?php echo $User_id; ?>" />
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td width="117" align="right" bgcolor="#EBEBEB">ไอดี :</td>
        <td width="583" bgcolor="#EBEBEB"><input name="ID" type="text" id="ID" value="<?= $ID; ?>" size="30" required="required" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td width="117" align="right" bgcolor="#EBEBEB">พาสเวิร์ด :</td>
        <td width="583" bgcolor="#EBEBEB"><input name="User_password" type="text" id="User_password" value="<?= $User_password; ?>" size="30" required="required" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td width="117" align="right" bgcolor="#EBEBEB">ชื่อผู้ใช้งาน :</td>
        <td width="583" bgcolor="#EBEBEB"><input name="User_name" type="text" id="User_name" value="<?= $User_name; ?>" size="30" required="required" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td width="117" align="right" bgcolor="#EBEBEB">สถานะ :</td>
        <td width="583" bgcolor="#EBEBEB">
          <select name="User_status" id="User_status">
            <option value="<?= $User_status; ?>"><?= $User_status; ?></option>
            <option value="admin">admin</option>
            <option value="officer">officer</option>
            <option value="user">user</option>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#EBEBEB">&nbsp;</td>
        <td bgcolor="#EBEBEB">&nbsp;
          <input type="button" value=" ยกเลิก " onclick="window.location='user_show.php' " /> <!-- ถ้าไม่แก้ไขให้กลับไปหน้าแสดงรายการ -->
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
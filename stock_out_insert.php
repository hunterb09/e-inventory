<?php   
		//1. เชื่อมต่อ database:
        require("connection.php");       
    
        //เพิ่ม table = stock_outmst
        $uid = $_POST['User_id'];
        //$Pp_name = $_POST['Pp_name'];
        $comment = $_POST['Comment'];

        echo "<script type='text/javascript'>alert('บันทึก'+$comment);
		</script>";
        //เปลี่ยนจากชื่อ เป็นรหัสวัตถุประสงค์
        /*$sql00 = "SELECT * FROM purpose WHERE Pp_name = '$Pp_name' ";
        $result00 = mysqli_query($link,$sql00);
        $row00 = mysqli_fetch_array($result00);	
        $Pp_id = $row00["Pp_id"];*/

        $sql = "INSERT into stock_outmst (Rec_date, User_id, Comment)".
	        "values(NOW(), '$uid', '$comment')";
        $result = mysqli_query($link,$sql);

        //เลือกหมายเลขซีเรียล ท้ายสุด
        $sql0 = "SELECT * FROM stock_outmst ORDER BY Rec_date desc";
        $result0 = mysqli_query($link,$sql0);
        $row0 = mysqli_fetch_array($result0);	
        $Stout_serial = $row0["Stout_serial"];
        
        //วนลูปเพิ่มบิลสินค้า
        for ($i = 1; $i<= (int)$_POST["hdnCount"]; $i++){
                $P_name = $_POST["P_name$i"];
                //แปลงจากชื่อสินค้าเป็นรหัส
                $sql1 = "SELECT * FROM product WHERE P_name = '$P_name' ";
                $result1 = mysqli_query($link,$sql1);
                $row1 = mysqli_fetch_array($result1);	
                $P_id = $row1["P_id"];


                //เพิ่มรายการ stock_outdtl
                $sql3 = "INSERT INTO stock_outdtl (Stout_serial, St_no, P_id, Qty) 
                    VALUES ('$Stout_serial', '".$_POST["St_no$i"]."', '$P_id',
                    '".$_POST["Qty$i"]."')";
                $result3 = mysqli_query($link,$sql3);
                
        }
        echo "<script type='text/javascript'>alert('บันทึกสำเร็จ'+$comment);
		window.location = 'stock_out_fb.php'; </script>";
?>
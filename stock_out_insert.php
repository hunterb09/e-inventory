<?php   
		//1. เชื่อมต่อ database:
        require("connection.php");       
    
        //เพิ่ม table = stock_outmst
        $uid = $_POST['User_id'];
        $Pp_name = $_POST['Pp_name'];
        $comment = $_POST['Comment'];

        //เปลี่ยนจากชื่อ เป็นรหัสวัตถุประสงค์
        $sql00 = "SELECT * FROM purpose WHERE Pp_name = '$Pp_name' ";
        $result00 = mysqli_query($link,$sql00);
        $row00 = mysqli_fetch_array($result00);	
        $Pp_id = $row00["Pp_id"];

        $sql = "INSERT into stock_outmst (Rec_date, User_id, Pp_id, Comment)".
	        "values(NOW(), '$uid', '$Pp_id', '$comment')";
        $result = mysqli_query($link,$sql);

        //เลือกหมายเลขซีเรียล ท้ายสุด
        $sql0 = "SELECT * FROM stock_outmst ORDER BY Rec_date desc";
        $result0 = mysqli_query($link,$sql0);
        $row0 = mysqli_fetch_array($result0);	
        $Stout_serial = $row0["Stout_serial"];
        
        //วนลูปเพิ่มบิลสินค้า
        for ($i = 1; $i<= (int)$_POST["hdnCount"]; $i++){
                $P_name = $_POST["2P_name$i"];
                $St_indtl = $_POST["2St_indtl$i"];
                $Qty = $_POST["2Qty$i"];
                //แปลงจากชื่อสินค้าเป็นรหัส
                $sql1 = "SELECT * FROM product WHERE P_name = '$P_name' ";
                $result1 = mysqli_query($link,$sql1);
                $row1 = mysqli_fetch_array($result1);	
                $P_id = $row1["P_id"];

                $Unit_name = $_POST["2Unit_name$i"];
                //แปลงจากชื่อหน่วยเป็นรหัส
                $sql2 = "SELECT * FROM unit WHERE Unit_name = '$Unit_name' ";
                $result2 = mysqli_query($link,$sql2);
                $row2 = mysqli_fetch_array($result2);	
                $Unit_id = $row2["Unit_id"];

                //ดึงค่า Qty_change ในTable stock_indtl
                $sql2 = "SELECT * FROM stock_indtl WHERE St_indtl = '$St_indtl' ";
                $result2 = mysqli_query($link,$sql2);
                $row2 = mysqli_fetch_array($result2);	
                $Qty_change = $row2["Qty_change"];
                //อัพเดท Qty_change ในTable stock_indtl
                $Qty_change = $Qty_change - $Qty;
                $sql = "UPDATE stock_indtl SET Qty_change='$Qty_change' WHERE St_indtl='$St_indtl' ";
                $result = mysqli_query($link,$sql);		

                //เพิ่มรายการ stock_outdtl
                $sql3 = "INSERT INTO stock_outdtl (Stout_serial, St_no, P_id, Unit_id, Qty, Price, St_indtl) 
                    VALUES ('$Stout_serial', '".$_POST["2St_no$i"]."', '$P_id', '$Unit_id',
                    '$Qty', '".$_POST["2Price$i"]."', '$St_indtl')";
                $result3 = mysqli_query($link,$sql3);
                
        }
        echo "<script type='text/javascript'>alert('บันทึกสำเร็จ');
		window.location = 'stock_out_fb.php'; </script>";
?>
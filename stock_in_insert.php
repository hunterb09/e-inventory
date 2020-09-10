<?php   
		//1. เชื่อมต่อ database:
        require("connection.php");       

        //เพิ่ม table = stock_inmst
        $uid = $_POST['User_id'];
        $Sup_name = $_POST['Sup_name'];
        $comment = $_POST['Comment'];

        //เปลี่ยนจากชื่อ เป็นรหัสซัพพลายเออร์
        $sql00 = "SELECT * FROM supplier WHERE Sup_name = '$Sup_name' ";
        $result00 = mysqli_query($link,$sql00);
        $row00 = mysqli_fetch_array($result00);	
        $Sup_id = $row00["Sup_id"];

        $sql = "INSERT into stock_inmst (Rec_date, User_id, Sup_id, Comment)".
	        "values(NOW(), '$uid', '$Sup_id', '$comment')";
        $result = mysqli_query($link,$sql);

        //เลือกหมายเลขซีเรียล ท้ายสุด
        $sql0 = "SELECT * FROM stock_inmst ORDER BY Rec_date desc";
        $result0 = mysqli_query($link,$sql0);
        $row0 = mysqli_fetch_array($result0);	
        $St_serial = $row0["St_serial"];
        
        //ถ้ามีเลขนี้ในฐานข้อมูล +1

        //วนลูปเพิ่มบิลสินค้า
        for ($i = 1; $i<= (int)$_POST["hdnCount"]; $i++){
                $P_name = $_POST["P_name$i"];
                //แปลงจากชื่อสินค้าเป็นรหัส
                $sql1 = "SELECT * FROM product WHERE P_name = '$P_name' ";
                $result1 = mysqli_query($link,$sql1);
                $row1 = mysqli_fetch_array($result1);	
                $P_id = $row1["P_id"];

                $Unit_name = $_POST["Unit_name$i"];
                //แปลงจากชื่อหน่วยเป็นรหัส
                $sql2 = "SELECT * FROM unit WHERE Unit_name = '$Unit_name' ";
                $result2 = mysqli_query($link,$sql2);
                $row2 = mysqli_fetch_array($result2);	
                $Unit_id = $row2["Unit_id"];

                //เพิ่มรายการ stock_indti
                $sql3 = "INSERT INTO stock_indtl (St_serial, St_no, P_id, Unit_id, Qty, Qty_change, Price) 
                    VALUES ('$St_serial', '".$_POST["St_no$i"]."', '$P_id',
                    '$Unit_id', '".$_POST["Qty$i"]."', '".$_POST["Qty$i"]."', '".$_POST["Price$i"]."')";
                $result3 = mysqli_query($link,$sql3);
                
        }
        echo "<script type='text/javascript'>alert('บันทึกสำเร็จ');
		window.location = 'stock_in_fb.php'; </script>";
?>
<?php   
		//1. เชื่อมต่อ database:
        require("connection.php");       

        //เพิ่ม table = stock_inmst
        $dt = $_POST['dt'];
        $uid = $_POST['User_id'];
        //$datetime = date("d-m-Y h:i:sa", $dt);
        $sql = "insert into stock_inmst (Rec_date, Unit_id)".
	        "values('$dt', '$uid')";
        $result = mysqli_query($link,$sql);

        $sql0 = "SELECT * FROM stock_inmst ORDER BY St_serial desc" or die("Error:" . mysqli_error());
        $result0 = mysqli_query($link,$sql0);
        $row0 = mysqli_fetch_array($result0);	
        $St_serial = $row0["St_serial"];

        //วนลูปเพิ่มบิลสินค้า
        for ($i = 1; $i<= (int)$_POST["hdnCount"]; $i++){
            if(isset($_POST["St_no$i"]))
            {   
                
                //แปลงจากชื่อสินค้าเป็นรหัส
                $sql1 = "SELECT * FROM product WHERE P_name = '".$_POST['P_name$i']."' ";
                $result1 = mysqli_query($link,$sql1);
                $row1 = mysqli_fetch_array($result1);	
                $P_id = $row1["P_id"];

                //แปลงจากชื่อหน่วยเป็นรหัส
                $sql2 = "SELECT * FROM unit WHERE Unit_name = '".$_POST['Unit_name$i']."' ";
                $result2 = mysqli_query($link,$sql2);
                $row2 = mysqli_fetch_array($result2);	
                $Unit_id = $row2["Unit_id"];

                $sql = "INSERT INTO stock_indtl (St_serial, St_no, P_id, Unit_id, Qty, Price) 
                    VALUES ('$St_serial', '".$_POST["St_no$i"]."', '".$_POST["P_id"]."',
                    '".$_POST["Unit_id"]."', '".$_POST["Qty$i"]."', '".$_POST["Price$i"]."')";
                $result = mysqli_query($link,$sql);
            }
        }
		require("stock_in_show.php");
?>
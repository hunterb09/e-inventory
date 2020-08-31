<?php
	//session_start();
    if(($_SESSION['User_status'] == "admin") || ($_SESSION['User_status'] == "officer") || ($_SESSION['User_status'] == "user"))
    {
        if($_SESSION['User_status'] == "admin"){
            require("navbar_a.php");
        }
        elseif($_SESSION['User_status'] == "officer"){
            require("navbar_o.php");
        }
        else{
            require("navbar_u.php");
        }
    }
    else{
        header("location:login.php");
    }
?>
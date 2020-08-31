<html>
<head>
	<title>รับสินค้าเข้า</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body align="center">
</body>
</html>

<?php
session_start();
echo '<br><br><center><a href="stock_in_formbill.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">พิมพ์ </a>
            <a href="stock_in_show.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">หน้าแรก </a>';

    
//สร้างแถบเมนู
include("navbar_check.php");
include("footer.html"); ?>	
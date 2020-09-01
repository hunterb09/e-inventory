<?php

//1. เชื่อมต่อ database:
require("connection.php");
//ดึงรายการสินค้า
$sql = "SELECT * FROM product ORDER BY P_name asc";
$result3 = mysqli_query($link, $sql);

?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<link rel="icon" href="picture/favicon.ico" type="image/x-icon">
	<title>Product Form</title>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-5.1.1.min.js"></script>
	<script>
		$(function () {
			$("#button").click(function () {
				var P_name = document.getElementById("P_name").value;
					alert(P_name);
				$.ajax({
					url: "st_o_s.php",
					data: {'P_name':P_name},
					type: "post",
					success:function(data){
						$('#unit').html(data);
					}
				});
				//var P_name = $('#P_name').val();
				//$("#msg").load("st_o_s.php", { myID: P_name });
			});
		});
	</script>
</head>

<body>
	<form id="form1" method="post">
		<table border="0" align="center">
			<tr>
			<td class="text-right">สินค้า: </td>
						<td class="text-left" ><select name='P_name' id='P_name'>
								<option></option>
								<?php while ($row3 = mysqli_fetch_array($result3)) { ?> <?php echo "<option value=" . $row3['P_name'] . " >" . $row3["P_name"] ?> </option><?php } ?>
							</select></td>
				<td colspan="2">
					<div align="center"><input id="button" type="button" value="Search"></div>
				</td>
			</tr>
		</table>
	</form>
	<div align="center" id="unit"></div>
</body>

</html>
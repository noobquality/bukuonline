<?php
	include("includes/db.php");
	include("includes/session.php");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>BukuOnline.Com</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<table width="800" border="1" align="center">
		  <tr>
			<td class="style3">
				<div align="right">
					<?php
						include("includes/menuuser.php");
					?>
				</div> 		 	
			</td>
		  </tr>
		  <tr>
			<td height="340" background="assets/img/header.jpg"  align="center" valign="bottom" class="style4" >
				<p>
					<a id="home" href="index.php">Home</a> | 
					<a id="products" href="products.php">Products</a>  | 
					<a id="aboutus" href="contactus.php">Contact Us</a> | 
					<a id="contactus" href="aboutus.php">About Us</a>
				</p>
			</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle">
				<span class="style7">
				<br />
				<div class="style2">Informasi Akun</div>
				<br />
					<table class="style9">
					<tr>
						<td rowspan="4">
							<img src="avatar/<?php echo $row_user['user_avatar'];?>" height="128"/>
						</td>
						<td>
							<strong>UserId :</strong> <?php echo $row_user['user_id'];?>
						</td>
					</tr>
					<tr>
						<td>
							<strong>UserName :</strong> <?php echo $row_user['user_name'];?>
						</td>
					</tr>
					<tr>
						<td>
							<strong>UserEmail :</strong> <?php echo $row_user['user_email'];?>
						</td>
					</tr>
					<tr>
						<td>
							<strong>BDate :</strong> <?php echo date("d-m-Y",strtotime($row_user['user_birthday']));?>
						</td>
					</tr>
					</table>
				</span>
			</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" class="style3">&copy; bukuonline.com | All Rights Reserved</td>
		  </tr>
		</table>
	</body>
</html>
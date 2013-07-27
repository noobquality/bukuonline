<?php
	include("includes/db.php");
	include("includes/session.php");
	include("includes/functions.php");
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
					<a id="home" href="index.php" >Home</a> | 
					<a id="products" href="products.php" >Products</a>  | 
					<a id="aboutus" href="contactus.php" >Contact Us</a> | 
					<a id="contactus" href="aboutus.php" >About Us</a>
				</p>
			</td>
		  </tr>
		  <tr>
			<td>
				<div align="center" class="detail_product">
					<div style="margin:0px auto; width:600px;" >
						<div style="padding-bottom:10px">
							<h1 align="center" class="style2">Order History</h1>
						</div>
						<table cellpadding="5px" cellspacing="1px" class="shopping2">
							<tr bgcolor="#FFFFFF" class="style4" align="center">
								<td>
									Kode Order
								</td>
								<td>
									Tanggal Order
								</td>
								<td>
									Total Sewa
								</td>
							</tr>
							<?php
							$order=mysql_query("select * from rent where customerid='".$_GET['id']."'");
							if(mysql_num_rows($order)==0){
								?>
								<tr bgcolor="#FFFFFF" class="shopping2">
									<td>
										Anda belum pernah melakukan peminjaman buku
									</td>
								</tr>
								<?php
							}
							else{
							while($row_order=mysql_fetch_array($order)){
									?>
									<tr bgcolor="#FFFFFF" align="center">
										<td>
											<a href="detail_order.php?id=<?php echo $row_order['serial'];?>"><?php echo $row_order['serial'];?></a>
										</td>
										<td>
										<?php
											echo date("d-m-Y",strtotime($row_order['date']));
										?>
										</td>
										<td>
											Rp. <?php echo number_format($row_order['total_price'],2,',','.');?>
										</td>
									</tr>
									<?php
								}
							}
							?>
						</table>
					</div>
				</div>
			</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" class="style3">&copy; bukuonline.com | All Rights Reserved</td>
		  </tr>
		</table>
	</body>
</html>

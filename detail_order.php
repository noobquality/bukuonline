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
					<a id="home" href="index.php">Home</a> | 
					<a id="products" href="products.php">Products</a>  | 
					<a id="aboutus" href="contactus.php">Contact Us</a> | 
					<a id="contactus" href="aboutus.php">About Us</a>
				</p>
			</td>
		  </tr>
		  <tr>
			<td>
				<div align="center" class="detail_product">
					<div style="margin:0px auto;">
						<div style="padding-bottom:10px">
							<h1 align="center" class="style6">Detail Order</h1>
						</div>
						<table border="0" cellpadding="0" cellspacing="10" align="center" class="style9" width="700">
						<?php
							$detail_order=mysql_query("select * from rent where serial='".$_GET['id']."'");
							$row_detail_order=mysql_fetch_array($detail_order);
						?>
							<tr>
								<td class="left">
									<strong>Kode Order : <?php echo $row_detail_order['serial'];?></strong>
									<br />
									<strong>Tanggal Order : <?php echo date("d-m-Y",strtotime($row_detail_order['date']));?></strong>
									<br />
								</td>
							</tr>
						</table>
						<table cellpadding="5px" cellspacing="1px" class="shopping2">
						<form name="form1" method="post">
							<tr class="style5" align="center">
								<td>
									Kode Buku
								</td>
								<td>
									Cover Buku
								</td>
								<td>
									Judul Buku
								</td>
								<td>
									Link Download
								</td>
								<td>
									Expire Date
								</td>
								<td>
									Harga Buku
								</td>
							</tr>
							<?php
								$detail_order2=mysql_query("select * from rent_detail where orderid='".$_GET['id']."'");
								while ($row_detail_order2=mysql_fetch_array($detail_order2)){
							?>
								<tr bgcolor="#FFFFFF" align="center">
									<td>
										<?php echo $row_detail_order2['productid'];?>
									</td>
									<td>
										<?php 
											$detail_picture=mysql_query("select * from product where serial='".$row_detail_order2['productid']."'");
											while ($row_detail_picture=mysql_fetch_array($detail_picture)){
											?>
												<img src="products/<?php echo $row_detail_picture['picture'];?>">
											<?php
											}
										?>
									</td>
									<td>
										<?php 
											$detail_picture=mysql_query("select * from product where serial='".$row_detail_order2['productid']."'");
											while ($row_detail_picture=mysql_fetch_array($detail_picture)){
												echo $row_detail_picture['name'];
											}
										?>
									</td>
									<td>
										<?php
											list($tahun2,$bulan2,$tanggal2)=explode('-',$row_detail_order['expired']);
											if("$tahun2"<=date("Y")){
												echo 'expired';
											}
											else{
												$detail_picture=mysql_query("select * from product where serial='".$row_detail_order2['productid']."'");
												while ($row_detail_picture=mysql_fetch_array($detail_picture)){
												?>
													<a href="download.php?file=<?php echo $row_detail_picture['picture'];?>">Klik disini</a>
												<?php
												}
											}
										?>
									</td>
									<td>
										<?php echo date("d-m-Y",strtotime($row_detail_order["expired"]));?>
									</td>
									<td>
										<?php 
											$detail_picture=mysql_query("select * from product where serial='".$row_detail_order2['productid']."'");
											while ($row_detail_picture=mysql_fetch_array($detail_picture)){
											?>
												Rp. <?php echo number_format($row_detail_picture['price'],2,',','.');?>
											<?php
											}
										?>
									</td>
								</tr>
							<?php
								}
							?>
							<tr class="style5" align="center">
								<td colspan="5">
									<strong>Total : <?php echo number_format($row_detail_order['total_price'],2,',','.');?></strong>
								</td>
							</tr>
						</form>
						</table>
						<table border="0" cellpadding="0" cellspacing="10" align="center" class="style9" width="700">
							<tr>
								<td class="left">
									<a id="history" href="renthistory.php?id=<?php echo $row_user["user_id"];?>"><< Rent History</a>
								</td>
							</tr>
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

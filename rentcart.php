<?php
	include("includes/db.php");
	include("includes/session.php");
	include("includes/functions.php");
	if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>BukuOnline.Com</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
		<script language="javascript">
		function del(pid){
			if(confirm('anda yakin menghapus item ini dari cart?')){
				document.form1.pid.value=pid;
				document.form1.command.value='delete';
				document.form1.submit();
			}
		}
		function clear_cart(){
			if(confirm('ini akan menghapus semua yang ada dalam cart, lanjutkan?')){
				document.form1.command.value='clear';
				document.form1.submit();
			}
		}
	</script>
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
					<form name="form1" method="post">
					<input type="hidden" name="pid" />
					<input type="hidden" name="command" />
						<div style="margin:0px auto; width:600px;" >
						<div style="padding-bottom:10px">
							<h1 align="center" class="style2">Rent Cart</h1>
						<input type="button" value="Searching For Books" onclick="window.location='products.php'" />
						</div>
							<div style="color:#F00">
							</div>
							<table cellpadding="5px" cellspacing="1px" class="shopping">
							<?php
								if(is_array($_SESSION['cart'])){
									echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>Serial</td><td>Name</td><td>Price</td><td>Options</td></tr>';
									$max=count($_SESSION['cart']);
									for($i=0;$i<$max;$i++){
										$pid=$_SESSION['cart'][$i]['productid'];
										$q=$_SESSION['cart'][$i]['qty'];
										$pname=get_product_name($pid);
										if($q==0) continue;
										?>
										<tr bgcolor="#FFFFFF">
											<td>
												<?php 
													echo $i+1
												?>
											</td>
											<td>
												<?php 
													echo $pname
												?>
											</td>
											<td>
												Rp. <?php echo number_format(get_price($pid),2,',','.')?>
											</td>
											<td>
												<a href="javascript:del(<?php echo $pid?>)">Remove</a>
											</td>
										</tr>
								<?php					
									}
								?>
									<tr>
										<td colspan="2">
											<b>Order Total: Rp. <?php echo number_format(get_order_total(),2,',','.')?></b>
										</td>
										<td colspan="2" align="right">
											<input type="button" value="Clear Cart" onclick="clear_cart()">
											<input type="button" value="Place Order" onclick="window.location='billing.php'">
										</td>
									</tr>
								<?php
								}
								else{
									echo "<tr bgColor='#FFFFFF'><td>Tidak ada item dalam cart!</td>";
								}
							?>
							</table>
						</div>
					</form>
				</div>
			</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" class="style3">&copy; bukuonline.com | All Rights Reserved</td>
		  </tr>
		</table>
	</body>
</html>

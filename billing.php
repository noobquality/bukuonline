<?php
	include("includes/db.php");
	include("includes/session.php");
	include("includes/functions.php");
	if($_REQUEST['command']=='update'){
		$customerid=$row_user['user_id'];
		$date=date('Y-m-d');
		$nextyear=date('Y-m-d', strtotime("+12 months $date"));
		$result=mysql_query("insert into rent(serial,date,expired,customerid,total_price) values('','$date','$nextyear','$customerid','".get_order_total()."')");
		$orderid=mysql_insert_id();
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$insert=mysql_query("insert into rent_detail(customerid,orderid,productid,quantity,price) values('$customerid','$orderid','$pid','$q','$price')");
			if($insert==true){
				$to = $row_user["user_email"];
				$subject = "Konfirmasi Peminjaman Buku";
				$message = "Data pemesanan anda telah kami terima dan akan segera di proses, terima kasih dan tetaplah bersama bukuonline.com karena kami memiliki banyak tawaran menarik!.";
				$from = "bukuonline@BO.com";
				$headers = "From: $from";
				mail($to,$subject,$message,$headers);
				$msg="scs";
				header("Location:index.php");
				unset($_SESSION['cart']);
			}
			else
			{
				$msg="err";
			}
		}
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>BukuOnline.Com</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
		<script language="javascript">
		function validate(){
			var f=document.form1;
			f.command.value='update';
			f.submit();
		}
		</script>
		<script type="text/javascript">
		<?php
		if($msg=="scs"){
			?>
				alert("rent books berhasil!");
			<?php
		}
		else if($msg=="err"){
			?>
				alert("rent books gagal!");
			<?php
		}
		?>
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
					<form name="form1" onsubmit="return validate()">
					<input type="hidden" name="command" />
						<div style="margin:0px auto; width:600px;" >
						<div style="padding-bottom:10px">
							<h1 align="center" class="style2">Billing Info</h1>
						</div>
							<div style="color:#F00">
							</div>
							<table cellpadding="5px" cellspacing="1px" class="style9">
								<tr>
									<td>
										Total pemesanan
									</td>
									<td>
										:
									</td>
									<td>
										Rp. <?php echo number_format(get_order_total(),2,',','.')?>
									</td>
								</tr>
								<tr>
									<td>
										Konfirmasi sekarang
									</td>
									<td>
										?
									</td>
									<td>
										<input type="submit" value="Ya" />
										<input type="reset" value="Tidak" onclick="window.location='rentcart.php'"/>
									</td>
								</tr>
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

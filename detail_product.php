<?php
	include("includes/db.php");
	include("includes/session.php");
	include("includes/functions.php");
	if($_REQUEST['command']=='add' && $_REQUEST['productid']>0){
		$pid=$_REQUEST['productid'];
		addtocart($pid,1);
		header("location:rentcart.php");
		exit();
	}
	if(isset($_POST['submit'])){
		$insert=mysql_query("insert into comment(comment_id,product_id,user_name,comment) values('','".$_GET['id']."','".$_SESSION['bukuonline']."','".$_POST['comment']."')");
	}
	$product=mysql_query("select * from product where serial='".$_GET['id']."'");
	$row_product=mysql_fetch_array($product);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>BukuOnline.Com</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
		<script language="javascript">
			function addtocart(pid){
				document.form1.productid.value=pid;
				document.form1.command.value='add';
				document.form1.submit();
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
					<table cellpadding="0" cellspacing="10" align="center" class="style9">
					<form name="form1">
						<input type="hidden" name="productid" />
						<input type="hidden" name="command" />
						<tr>
							<td>
								<strong>Judul : <?php echo $row_product['name'];?></strong>
								<br />
								<strong>Harga sewa : Rp.<?php echo number_format($row_product['price'],2,',','.');?></strong>
								<br />
								<strong>Review :</strong>
								<br />
								<?php echo $row_product['description'];?>
								<br />
								<br />
								<?php
								if($_SESSION['bukuonline']!=''){
								?>
									<input type="button" value="Masukkan ke Cart" onclick="addtocart(<?php echo $row_product['serial']?>);"/>
								<?php
								}
								?>
							</td>
							<td valign="top">
								<img src="products/<?php echo $row_product['picture'];?>"/>
							</td>
						</tr>
					</form>
					</table>
				</div>
				<div align="center" class="detail_product">
					<table cellpadding="0" cellspacing="10" align="left" class="style9">
						<form name="comment" action="#" method="post" enctype="multipart/form-data">
							<?php
							if($_SESSION['bukuonline']!=''){
							?>
								<tr>
									<td>
										<strong>Beri komentar :</strong>
									</td>
								</tr>
								<tr>
									<td>
										<textarea cols="75" rows="5" id="comment" name="comment"></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<input type="submit" name="submit" value="kirim" />
									</td>
								</tr>
							<?php
							}
							?>
							<tr>
								<td>
									<strong>Komentar :</strong>
								</td>
							</tr>
							<?php
							if($_GET['page']!=''){
								$page=($_GET['page']-1)*5;
							}
							else{
								$_GET['page']=1;
								$page='0';
							}
							$comment=mysql_query("select * from comment where product_id='".$_GET['id']."' limit $page,5");
							if(mysql_num_rows($comment)==0){
							?>
								<tr>
									<td>
										Tidak ada data komentar
									</td>
								</tr>
							<?php
							}
							else{
							while($row_comment=mysql_fetch_array($comment)){
								?>
								<tr>
									<td>
										<strong>by : <?php echo $row_comment['user_name']?></strong>
										<br />
										<?php echo $row_comment['comment'];?>
									</td>
								</tr>
								<br />
								<?php
								}
							}
							?>
						</form>
					</table>
				</div>
			</td>
		  </tr>
		  <tr bgcolor="#d0eaf8">
			<td>
			  <div class="header">
			  <div class="pagn" id="pagn">
			  <?php
				$query_page=mysql_query("select * from comment");
				$sum=mysql_num_rows($query_page);
				$count=ceil($sum/5);
				$start=1;
				if(($_GET['page']!=1) && ($_GET['page']!='')){
				?>
					<a href="detail_product.php?id=<?php echo $_GET['id']?>&&page=<?php echo $start;?>">
				<?php
					echo'First';
				?>
					</a>
				<?php
				}
				echo '&nbsp;';
				if(($_GET['page']!=1) && ($_GET['page']!='')){
				?>
					<a class="pagnNext" href="detail_product.php?id=<?php echo $_GET['id']?>&&page=<?php echo $_GET['page']-1;?>">
				<?php
					echo 'Prev';
				?>
					</a>
				<?php
				}
				echo '&nbsp;';
				while($start<=$count){
				?>
					<a href="detail_product.php?id=<?php echo $_GET['id']?>&&page=<?php echo $start?>">
				<?php
				if($_GET['page']==$start){
				?>
					<span class="pagnCur"><?php echo $start;?></span>
				<?php
				}
				else{
				?>
					<span><?php echo $start;?></span>
				<?php
				}
				?>
					</a>
				<?php
				echo '&nbsp;';
				$start++;
				}
				if($_GET['page']!=$count){
				?>
					<a class="pagnNext" href="detail_product.php?id=<?php echo $_GET['id']?>&&page=<?php echo $_GET['page']+1;?>">
				<?php
					echo 'Next';
				?>
					</a>
				<?php
				}
				echo '&nbsp;';
				if($_GET['page']!=$count){
				?>
					<a class="pagnNext" href="detail_product.php?id=<?php echo $_GET['id']?>&&page=<?php echo $count;?>">
				<?php
					echo'Last';
				?>
					</a>
				<?php
				}
				?>
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

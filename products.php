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
			<td>
				<div align="center" class="product">
					<table>
						<?php
							if($_GET['page']!=''){
								$page=($_GET['page']-1)*5;
							}
							else{
								$_GET['page']=1;
								$page='0';
							}
							$result=mysql_query("select * from product limit $page,5");
							while($row_product=mysql_fetch_array($result)){
							?>
								<tr>
									<td>
										<img src="products/<?php echo $row_product["picture"];?>"/>
									</td>
									<td class="style3">
										<strong>Judul : <?php echo $row_product["name"];?></strong>
										<br />
										<strong>Annual rent fee : Rp.<?php echo number_format($row_product["price"],2,',','.');?></strong>
										<br />
										<a class="content" href="detail_product.php?id=<?php echo $row_product["serial"];?>">Click here for book details</a>
									</td>
								</tr>
							<?php
							}
						?>
					</table>
				</div>
			</td>
		  </tr>
		  <tr bgcolor="#d0eaf8">
			<td>
			  <div class="header">
				  <div class="pagn" id="pagn">
				  <?php
					$query_page=mysql_query("select * from product");
					$sum=mysql_num_rows($query_page);
					$count=ceil($sum/5);
					$start=1;
					if(($_GET['page']!=1) && ($_GET['page']!='')){
					?>
						<a href="products.php?page=<?php echo $start;?>">
					<?php
						echo'First';
					?>
						</a>
					<?php
					}
					echo '&nbsp;';
					if(($_GET['page']!=1) && ($_GET['page']!='')){
					?>
						<a class="pagnNext" href="products.php?page=<?php echo $_GET['page']-1;?>">
					<?php
						echo 'Prev';
					?>
						</a>
					<?php
					}
					echo '&nbsp;';
					while($start<=$count){
						?>
							<a href="products.php?page=<?php echo $start?>">
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
						<a class="pagnNext" href="products.php?page=<?php echo $_GET['page']+1;?>">
					<?php
						echo 'Next';
					?>
						</a>
					<?php
					}
					echo '&nbsp;';
					if($_GET['page']!=$count){
					?>
						<a class="pagnNext" href="products.php?page=<?php echo $count;?>">
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

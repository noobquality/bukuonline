<?php
	include("includes/db.php");
	include("includes/session.php");
    list($tahun,$bulan,$tanggal)=explode('-',$row_user['user_birthday']);
	if(isset($_POST['submit'])){
		$tanggal_lahir = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
		$insert=mysql_query("insert into contact (contact_id,contact_name,contact_email,contact_gender,contact_birthday,contact_message) values('','".$_POST['nama']."','".$_POST['email']."','".$_POST['jenis_kelamin']."','$tanggal_lahir','".$_POST['pesan']."')");
		if($insert==true){
			$msg='scs';
		}
		else{
			$msg='err';
		}
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>BukuOnline.Com</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript">
		<?php
			if($msg=='scs'){
				?>
				alert("Pesan berhasil terkirim");
				<?php
			}
			else if($msg=='err'){
				?>
				alert("Pesan gagal terkirim");
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
				<div align="center" class="contact">
					<br />
					<div align="center" class="style7">Customer is our King and Queen ^^</div>
					<br />
					<div class="style1">
						<form name="contact" action="#" method="post" enctype="multipart/form-data">
							<table cellpadding="0" cellspacing="10" align="center" class="style7">
								<tr>
									<td>
										Nama
									</td>
									<td>
										:
									</td>
									<td>
										<input type="text" name="nama" size="30" value="<?php echo $row_user['user_name'];?>"/>
									</td>
								</tr>
								<tr>
									<td>
										Email
									</td>
									<td>
										:
									</td>
									<td>
										<input type="text" name="email" size="50" value="<?php echo $row_user['user_email'];?>"/>
									</td>
								</tr>
								<tr>
									<td>
										Jenis Kelamin
									</td>
									<td>
										:
									</td>
									<td>
										<?php
										if($row_user['user_gender']=='laki-laki'){
										?>
											<input type="radio" name="jenis_kelamin" value="laki-laki" checked>Laki-laki</input>
											<input type="radio" name="jenis_kelamin" value="perempuan">Perempuan</input>
										<?php
										}
										else if($row_user['user_gender']=='perempuan'){
										?>
											<input type="radio" name="jenis_kelamin" value="laki-laki">Laki-laki</input>
											<input type="radio" name="jenis_kelamin" value="perempuan" checked>Perempuan</input>
										<?php
										}
										else{
										?>
											<input type="radio" name="jenis_kelamin" value="laki-laki">Laki-laki</input>
											<input type="radio" name="jenis_kelamin" value="perempuan">Perempuan</input>
										<?php
										}
										?>
									</td>
								</tr>
								<tr>
									<td>
										Tanggal Lahir
									</td>
									<td>
										:
									</td>
									<td>
										<select name="tgl" size="1" id="tgl">
											<?php
											for ($i=1;$i<=31;$i++){
												if($tanggal==$i){
													echo "<option value=".$i." selected>".$i."</option>";
												} 
												else{
													echo "<option value=".$i.">".$i."</option>";
												}
											}
											?>
										  </select>
										  <select name="bln" size="1" id="bln">
											<?php
											$namabulan=array("","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
											for ($i=1;$i<=12;$i++){
												if($bulan==$i){
													echo "<option value=".$i." selected>".$namabulan[$i]."</option>";
												} 
												else{
													echo "<option value=".$i.">".$namabulan[$i]."</option>";
												}
											}
											?>
										  </select>
										  <input type="text" name="thn" id="thn" size="10" value="<?php echo "$tahun"?>"></input>
									</td>
								</tr>
								<tr>
									<td valign="top">
										Pesan
									</td>
									<td valign="top">
										:
									</td>
									<td>
										<textarea cols="50" rows="5" name="pesan"></textarea>
									</td>
								</tr>
								<tr>
									<td colspan="5" align="center">
										<input type="submit" name="submit" value="Kirim" />
										<input type="reset" name="reset" value="Reset" />
									</td>
									<td>
									</td>
								</tr>
							</table>
						</form>
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

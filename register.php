<?php
	include("includes/db.php");
	include("includes/session.php");
	if(isset($_POST['submit'])){
		$pola_username='/^[a-zA-Z0-9]{3,20}$/';
		$pola_password='/^.*(?=.{8,16})(?=.*\d)(?=.*[a-zA-Z]).*$/';
		$pola_email='/^[A-Za-z][\w\.]{1,30}[A-Za-z0-9]@[A-Za-z0-9][A-Za-z0-9\-]{1,61}[A-Za-z0-9](\.[A-Za-z]{2,4}){1,2}$/';
		if(!preg_match($pola_username,$_POST['username'])){
			$msg='username_error';	
		}
		else if(!preg_match($pola_password,$_POST['password'])){
			$msg='password_error';
		}
		else if(!preg_match($pola_email,$_POST['email'])){
			$msg='email_error';
		}
		else{
			$user=mysql_query("select * from user order by user_id desc");
			if(mysql_num_rows($user)!=0){
				$row_user=mysql_fetch_array($user);
				$get_id=$row_user['user_id'];
				$urut_id=substr($get_id,0,3);
				$hasil=$urut_id+1;
				$pk_n=strlen($hasil);
				if($pk_n==1){
					$id="00".$hasil;
				}
				else if($pk_n==2){
					$id="0".$hasil;
				}
				else if($pk_n==3){
					$id=$hasil;
				}
				else{
					$msg="full";
					header("Location:register.php");
				}
			}
			else{
				$id='001';
			}
			if($_FILES['avatar']['name']==""){
				$hasil=$_POST['avatar_lama'];
			}
			else{
				$get_extention=explode('.',$_FILES['avatar']['name']);
				$jml=count($get_extention);
				$nama_file_new=$id.'.'.$get_extention[$jml-1];
				$tujuan='avatar/'.$nama_file_new;
				if(move_uploaded_file($_FILES['avatar']['tmp_name'],$tujuan)){
					$hasil=$nama_file_new;
				}
				else{
					$hasil=$_POST['avatar_lama'];
				}
			}
			if($_POST['confirmpassword'] == $_POST['password']){
				$tanggal_lahir = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
				$insert=mysql_query("insert into user(user_id,user_name,user_password,user_email,user_gender,user_birthday,user_avatar) values('".$id."','".$_POST['username']."','".$_POST['password']."','".$_POST['email']."','".$_POST['jenis_kelamin']."','".$tanggal_lahir."','".$hasil."')");
				if($insert==true){
					$msg='scs';
				}
				else{
					$msg='err';
				}
			}
			else{
				$msg='fail';
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
				var f=document.register;
				if(f.username.value==""){
					alert('username harus diisi');
					f.username.focus();
					return false;
				}
				var f=document.register;
				if(f.password.value==""){
					alert('password harus diisi');
					f.password.focus();
					return false;
				}
				var f=document.register;
				if(f.confirmpassword.value==""){
					alert('confirm password harus diisi');
					f.confirmpassword.focus();
					return false;
				}
				var f=document.register;
				if(f.email.value==""){
					alert('email harus diisi');
					return false;
				}
				var f=document.register;
				if(f.thn.value==""){
					alert('tahun harus diisi');
					return false;
				}
				return;
			}
		</script>
		<script type="text/javascript"> 
		<?php
			if($msg=='username_error'){
				?> 
					alert("username hanya boleh angka dan huruf minimal 3-20 karakter"); 
				<?php
			} 
			else if($msg=='password_error'){
				?>
					alert("password harus terdiri dari huruf,angka, dan karakter khusus minimal 8-16 karakter"); 
				<?php
			} 
			else if($msg=='email_error'){
				?>
					alert("email salah! contoh : ananta.putuwijaya@gmail.com");
				<?php
			}
		?>
		</script>
		<script type="text/javascript">
		<?php
		if($msg=='full'){
			?>
				alert("member sudah penuh!");
			<?php
		}
		else if($msg=='scs'){
			?>
				alert("register berhasil!");
			<?php
		}
		else if($msg=='err'){
			?>
				alert("register gagal!");
			<?php
		}
		else if($msg=='fail'){
			?>
				alert("password dan confirm password tidak cocok!");
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
					<div align="center" class="style4">Sign Up Here and Now</div>
					<br />
					<div class="style1">
                    <form name="register" action="#" onSubmit="return validate()" method="post" enctype="multipart/form-data">
						<table border="0" cellpadding="0" cellspacing="10" align="center" class="style7">
							<tr>
								<td>
									username*
								</td>
								<td>
									:
								</td>
								<td>
									<input id="username" type="text" name="username" size="30"/>
								</td>
							</tr>
							<tr>
								<td>
									password*
								</td>
								<td>
									:
								</td>
								<td>
									<input id="password" type="password" name="password" size="30"/>
								</td>
							</tr>
							<tr>
								<td>
									confirm password*
								</td>
								<td>
									:
								</td>
								<td>
									<input id="confirmpassword" type="password" name="confirmpassword" size="30"/>
								</td>
							</tr>
							<tr>
								<td>
									Email*
								</td>
								<td>
									:
								</td>
								<td>
									<input type="text" name="email" size="50"/>
								</td>
							</tr>
							<tr>
								<td>
									Jenis Kelamin*
								</td>
								<td>
									:
								</td>
								<td>
									<input type="radio" name="jenis_kelamin" value="laki-laki">Laki-laki</input>
									<input type="radio" name="jenis_kelamin" value="perempuan">Perempuan</input>
								</td>
							</tr>
                            <tr>
								<td>
									Tanggal Lahir*
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
									  <input type="text" name="thn" id="thn" size="10" />
								</td>
							</tr>
                            <tr>
                            	<td>
                                	Avatar
                                </td>
                                <td>
                                	:
                                </td>
                                <td>
                                	<input type="file" name="avatar" />
									<input type="hidden" name="avatar_lama" value="default.jpg" />
                                </td>
                            </tr>
                            <tr>
                            	<td colspan="5" align="center">
                                	<input type="submit" name="submit" value="Daftar" />
                                    <input type="reset" name="reset" value="Reset" />
                                </td>
                                <td>
                                </td>
                            </tr>
						</table>
                    </form>
					<table width="800" border="0" cellpadding="0" cellspacing="10" align="center" class="style8">
						<tr>
							<td rowspan="5" valign="top">
								<img src="assets/img/Warning.png"/>
							</td>
						</tr>
						<tr>
							<td size="50">
								*Username hanya boleh angka dan huruf minimal 3-20 karakter
							</td>
						</tr>
						<tr>
							<td size="50">
								*Password harus terdiri dari huruf,angka, dan karakter khusus minimal 8-16 karakter
							</td>
						</tr>
						<tr>
							<td size="50">
								*Semua field kecuali avatar harus terisi
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

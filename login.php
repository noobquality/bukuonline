<?php
	include("includes/db.php");
	include("includes/session.php");
	if(isset($_POST['submit'])){
		$cekUser=mysql_query("select * from user where user_name='".$_POST['userid']."' and user_password='".$_POST['password']."'");
		if(mysql_num_rows($cekUser)==1){
			$_SESSION['bukuonline']=$_POST['userid'];
			header("location:index.php");
		}
		else{
			$msg='logerror';
		}
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>BukuOnline.Com</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
		<script language="javascript">
		<?php
			if($msg=='logerror'){
				?> 
					alert("login error user id atau password masih salah"); 
				<?php
			} 
		?>
		</script>
		<script language="javascript">
		function validate(){
			var f=document.login;
			if(f.userid.value==""){
				alert('masukkan user id');
				f.userid.focus();
				return false;
			}
			var f=document.login;
			if(f.password.value==""){
				alert('masukkan password');
				f.password.focus();
				return false;
			}
			return;
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
			<td align="center" valign="middle">
				<span class="style7">
					<form name="login" action="#" onSubmit="return validate()" method="post" enctype="multipart/form-data">
						<table cellpadding="0" cellspacing="10" align="center" class="style7">
							<tr>
								<td>
									User ID
								</td>
								<td>
									:
								</td>
								<td>
									<input id="userid" type="text" name="userid" size="30"/>
								</td>
							</tr>
							<tr>
								<td>
									Password
								</td>
								<td>
									:
								</td>
								<td>
									<input id="password" type="password" name="password" size="30"/>
								</td>
							</tr>
                            <tr>
                            	<td colspan="5" align="center">
                                	<input type="submit" name="submit" value="Sign In" />
                                    <input type="reset" name="cancel" value="Cancel" />
                                </td>
                            </tr>
						</table>
                    </form>
				</span>
			</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" class="style3">&copy; bukuonline.com | All Rights Reserved</td>
		  </tr>
		</table>
	</body>
</html>
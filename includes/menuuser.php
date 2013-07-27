<?php
	if ($_SESSION['bukuonline']!=''){
	?>
		Selamat datang, <?php echo $row_user['user_name'];?> | 
		<a id="akunku" href="akunku.php">Akunku</a> | 
	<?php 
		if($_SESSION['cart']!=''){
			echo ''.count($_SESSION['cart']).' books in <a href="rentcart.php">Rent Cart</a> | ';?> 
		<?php
		}
		?>
		<a id="history" href="renthistory.php?id=<?php echo $row_user["user_id"];?>">View Rent History</a> | 
		<a id="logout" href="logout.php">Logout</a>
	<?php
	}
	else{
	?>
		<a id="login" href="login.php">Sign In</a> | 
		<a id="register" href="register.php">Buat Akun Baru</a>	
	<?php
	}
	?>
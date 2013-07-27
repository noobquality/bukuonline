<?php
	session_start();
	unset($_SESSION['bukuonline']);
	header("location:index.php")
?>
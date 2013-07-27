<?php
include("includes/db.php");
$user=mysql_query("select * from user where user_name='".$_SESSION['bukuonline']."'");
$row_user=mysql_fetch_array($user);
session_start();
?>
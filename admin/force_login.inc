<?php
session_start();

if(!$_SESSION['username']) {
	header("Location: /admin/login.php");
	exit();
}
?>

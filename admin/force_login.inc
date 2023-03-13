<?php
if(!isset($_SESSION) || !isset($_SESSION['username'])) {
	header("Location: /admin/login.php");
	exit();
}
?>

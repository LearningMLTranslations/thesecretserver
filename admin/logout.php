<?php
if(isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
} else {
    header("Location: /admin/login.php");
    exit();
}
?>
<html>
<body>
<?php include '../header.php'; ?>
<p>You have been successfully logged out.</p>
</body>
</html>
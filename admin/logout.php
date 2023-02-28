<?php
session_start();
session_unset();
session_destroy();
?>
<html>
<body>
<?php include 'header.php'; ?>
<p>You have been successfully logged out.</p>
</body>
</html>

<?php
require_once "./admin/force_login.inc";
include 'header.php';
?>

	<h1 class="banner">Delete Product</h1>
	<form method="POST" action="crud.php">
            <label for="id">Product ID:</label>
            <input type="number" id="id" name="id" required>
            <br /> <br />
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button type="submit" name="delete" style="background-color: red; font-weight: bold;">Delete Product</button>
	</form>
<br /><br /><br />
     <p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>
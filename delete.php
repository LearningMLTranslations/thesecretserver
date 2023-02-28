<?php require_once "./admin/force_login.inc"; ?>

<body style="background-color:#f9fafc;">
<?php include 'header.php'; ?>
	<h1>Delete Product</h1>
	<form method="POST" action="crud.php">
		<div style="display:flex;">
            <label for="id">Product ID:</label>
            <input type="number" id="id" name="id" required>
            <br>
            <button type="submit" name="delete" style="background-color: red; font-weight: bold;">Delete Product</button>
	    </div>
	</form>
<br /><br /><br />
     <p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>
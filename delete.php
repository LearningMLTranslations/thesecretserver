<?php require_once "./admin/force_login.inc"; ?>
<head>
	<style>
		form {
			width: 400px;
			margin: 0 auto;
			margin-top: 50px;
		}

		label {
			display: block;
			margin-top: 10px;
			float: left;
			clear: left;
			width: 100px;
			text-align: right;
			padding-right: 10px;
		}

		input[type=text] {
			width: 250px;
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 3px;
			box-sizing: border-box;
			float: left;
		}

		button[type=submit] {
			background-color: #f44336;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			margin-top: 20px;
			float: left;
			clear: left;
		}
	</style>
</head>
<body style="background-color:#f9fafc;">
<?php include 'header.php'; ?>
	<h1>Delete Product</h1>
	<form method="POST" action="crud.php">
		<label for="id">Product ID:</label>
		<input type="number" id="id" name="id" required>
		<br>
		<button type="submit" name="delete">Delete Product</button>
	</form>
<br /><br /><br />
     <p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>

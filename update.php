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
			background-color: #4CAF50;
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
	<h1>Update Product</h1>
<?php include 'header.php'; ?>
	<form action="crud.php" method="post">
		<label for="id">ID:</label>
		<input type="number" id="id" name="id" required><br>
<br>
		<label for="price">Price:</label>
		<input type="number" id="price" name="price" step="0.01" required><br>
<br>
		<label for="servingSize">Serving Size:</label>
		<input type="text" id="servingSize" name="servingSize" required><br>
<br><br>
		<label for="calories">Calories:</label>
		<input type="number" id="calories" name="calories" required><br>
<br>
		<label for="ingredients">Ingredients:</label>
		<input type="text" id="ingredients" name="ingredients" required><br>

		<label for="description">Description:</label>
		<textarea id="description" name="description" rows="4" cols="50"></textarea><br>

		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required><br>

		<label for="image">Image:</label>
		<input type="text" id="image" name="image" required><br>
        <br>
		<button type="submit" name="update">Update Product</button>
	</form>
<br /><br /><br />
	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>

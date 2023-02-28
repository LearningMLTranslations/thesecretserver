<?php require_once "./admin/force_login.inc"; ?>
<?php include "header.php"; ?>

<body style="background-color:#f9fafc;">
	<h1>Update Product</h1>

	<form action="crud.php" method="post">
		<label for="id">ID:</label>
		<input type="number" id="id" name="id" required><br>

		<label for="price">Price:</label>
		<input type="number" id="price" name="price" step="0.01" required><br>

		<label for="servingSize">Serving Size:</label>
		<input type="text" id="servingSize" name="servingSize" required><br>

		<label for="calories">Calories:</label>
		<input type="number" id="calories" name="calories" required><br>

		<label for="ingredients">Ingredients:</label>
		<input type="text" id="ingredients" name="ingredients" required><br>

		<label for="description">Description:</label>
		<textarea id="description" name="description" rows="4" cols="50"></textarea><br>

		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required><br>

		<label for="image">Image:</label>
		<input type="text" id="image" name="image" required><br>

		<button type="submit" name="update">Update Product</button>
	</form>

	<br /><br /><br />
	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>

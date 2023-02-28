<?php require_once "./admin/force_login.inc"; ?>
<?php include "header.php"; ?>
	<h1>Create Product</h1>

	<form action="crud.php" method="post">
		<label for="price">Price:</label>
		<input type="number" id="price" name="price" step="0.01" required><br>
<br>
		<label for="servingSize">Serving Size:</label>
		<input type="text" id="servingSize" name="servingSize" required><br>
<br>
		<label for="calories">Calories:</label>
		<input type="number" id="calories" name="calories" required><br>
<br><br>
		<label for="ingredients">Ingredients:</label>
		<input type="text" id="ingredients" name="ingredients" required><br>
<br>
		<label for="description">Description:</label>
		<textarea id="description" name="description" rows="4" cols="50"></textarea><br>

		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required><br>

		<label for="image">Image:</label>
		<input type="text" id="image" name="image" required><br>
		<br>
		<button type="submit" name="create">Create Product</button>
	</form>
<br /><br /><br />
	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>

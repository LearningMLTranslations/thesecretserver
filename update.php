<?php require_once "./admin/force_login.inc"; ?>
<?php include "header.php"; ?>

<body style="background-color:#f9fafc;">
	<h1>Update Product</h1>

	<form action="crud.php" method="post">
		<div style="display:flex;">
		    <label for="id">ID:</label>
		    <input type="number" id="id" name="id" required><br>
		</div>

		<div style="display:flex;">
			<label for="price" style="width:100px;">Price:</label>
			<input type="number" id="price" name="price" step="0.01" required>
		</div>
		<div style="display:flex;">
			<label for="servingSize" style="width:100px;">Serving Size:</label>
			<input type="text" id="servingSize" name="servingSize" required>
		</div>
		<div style="display:flex;">
			<label for="calories" style="width:100px;">Calories:</label>
			<input type="number" id="calories" name="calories" required>
		</div>
		<div style="display:flex;">
			<label for="ingredients" style="width:100px;">Ingredients:</label>
			<input type="text" id="ingredients" name="ingredients" required>
		</div>
		<div style="display:flex;">
			<label for="description" style="width:100px;">Description:</label>
			<textarea id="description" name="description" rows="4" cols="50"></textarea>
		</div>
		<div style="display:flex;">
			<label for="name" style="width:100px;">Name:</label>
			<input type="text" id="name" name="name" required>
		</div>
		<div style="display:flex;">
			<label for="image" style="width:100px;">Image:</label>
			<input type="text" id="image" name="image" required>
		</div>
		<br>
		<button type="submit" name="update" style="font-weight:bold;">Update Product</button>
	</form>

	<br /><br /><br />
	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>

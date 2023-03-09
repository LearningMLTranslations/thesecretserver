<?php require_once "./admin/force_login.inc"; ?>

<head>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body style="background-color:#f9fafc;">

<?php include "header.php"; ?>

	<h1>Product List</h1>

	<?php
		$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
		$order = isset($_GET['order']) ? htmlspecialchars($_GET['order']) : '';

		$sortByName = "?order=name&search=$search";
		$sortByHighestPrice = "?order=price&search=$search";
		$sortByLowestPrice = "?order=price DESC&search=$search";
	?>

	<a href="<?= $sortByName ?>">Sort by Name</a> |
	<a href="<?= $sortByHighestPrice ?>">Sort by Highest Price</a> |
	<a href="<?= $sortByLowestPrice ?>">Sort by Lowest Price</a>

	<form action="?">
		<input type="text" name="search" value="<?= $search ?>">
		<input type="submit" value="Search" style="padding: 10px 20px; font-size: 16px; background-color: #D3D3D3; color: black; border: none; border-radius: 4px;">
	</form>

<br /> <br />
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Timestamp</th>
				<th>Price</th>
				<th>Serving Size</th>
				<th>Calories</th>
				<th>Ingredients</th>
				<th>Description</th>
				<th>Name</th>
				<th>Image</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$search = empty($search) ? "" : $search;
			include 'crud.php';
			?>
		</tbody>
	</table>

	<br /><br /><br />

	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>
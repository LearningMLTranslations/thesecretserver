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

<a href="?order=name">Sort by Name</a> | <a href="?order=price">Sort by Highest Price</a> | <a href="?order=price DESC">Sort by Lowest Price</a>
<form action="?order=name">
    <input type="text" name="search">
    <input type="submit" name="Search">
    </form>

<?php include 'header.php'; ?>
	<h1>Product List</h1>

	<table>
		<tbody>
			<?php include 'crud.php'; ?>
		</tbody>
	</table>
<br /><br /><br />
	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>

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

<?php include 'header.php'; ?>
	<h1>Product List</h1>

<a href="?order=name">Sort by Name</a> | <a href="?order=price">Sort by Highest Price</a> | <a href="?order=price%20DESC">Sort by Lowest Price</a>
<form action="?order=name">
    <input type="text" name="search">
    <input type="submit" name="Search">
</form>

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
        <?php include 'crud.php'; ?>
    </tbody>
</table>

<br /><br /><br />
	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>

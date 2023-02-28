<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to the Juice Shop!</title>
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
<header class="">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
            <div align="left">
                <div class="navbar-type">Juice Shop</div>
            </div>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/products.php">Products</a></li>
    <?php
    echo '<li><a href="/list.php">View our Products!</a></li>';
    ?>
    <?php
    if(isset($_SESSION['username']) && $_SESSION['username'] != NULL) {
    echo '<li><a href="/admin/logout.php">Logout</a></li> ';
    echo '<li><a href="/create.php">Create</a></li>';
    echo '<li><a href="/update.php">Update</a></li>';
    echo '<li><a href="/delete.php">Delete</a></li>';
    } else {
    echo '<li><a href="/admin/login.php">Login</a></li>';
        }
    ?>
    </ul>
  </nav>

</header>
<body style="background-color:#f9fafc;">

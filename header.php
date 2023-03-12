<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to the Juice Shop!</title>
		<style>
        .banner {
            background-image: url('./images/banner.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            text-align: center;
            padding: 50px 0;
        }
        .banner h1 {
            color: black;
            font-size: 36px;
        }
		.navbar {
			background-color: #4CAF50; /* change the background color of the navbar */
			font-family: Arial, sans-serif;
		}

		.navbar a {
			color: blue;
			font-size: 18px;
			padding: 15px;
		}

		.navbar a:hover {
			background-color: #3e8e41; /* add a hover effect to the navbar links */
			color: white; /* change the color of the navbar links when hovered */
		}
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

<header>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="navbar-header"></div>
		<ul class="nav navbar-nav">
			<a href="/index.php">Home</a>
			<?php
			    echo '| <a href="/list.php?search=">Products</a>';
			if(isset($_SESSION['username']) && $_SESSION['username'] != NULL) {
				echo ' | <a href="/admin/logout.php">Logout</a>';
				echo ' | <a href="/create.php">Create</a>';
				echo ' | <a href="/update.php">Update</a>';
				echo ' | <a href="/delete.php">Delete</a>';
			} else {
				echo ' | <a href="/admin/login.php">Login</a> ';
			}
			?>
		</ul>
	</nav>
</header>

<body style="background-color:#f9fafc;">

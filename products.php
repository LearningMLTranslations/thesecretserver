<!DOCTYPE HTML>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<title>Welcome to the Juice Shop!</title>
	<style>
			h2 {
					color: green;
			}
	.product-card h2 {
		color: green;
	}

	.product-card button {
		padding: 10px 20px;
		background-color: green;
		color: white;
		border-radius: 5px;
		margin-top: 10px;
	}

	.product-card {
		display: inline-block;
		width: 33%;
		text-align: center;
		margin: 10px;
		vertical-align: top;
	}
	</style>
</head>

<body style="background-color:#f9fafc;">
<?php include 'header.php'; ?>
	<h1>Enjoy our product selection!</h1>
    <br>

<div class="product-card">
	<img alt="Orange Juice" src="/images/orange_juice.jpg" width="300" height="340"/>
	<h2>Orange Juice</h2>
	<p>Serving size: 8 fl oz</p>
	<p>Calories: 120</p>
	<p>Ingredients: Orange, Water, Sugar</p>
	<button onclick="alert('Thanks for your purchase of Orange Juice!')">Buy Now ($5.99)</button>
</div>

<div class="product-card">
    <img alt="Apple Juice" src="/images/apple_juice.jpg" width="300" height="340"/>
    <h2>Apple Juice</h2>
    <p>Serving size: 8 fl oz</p>
    <p>Calories: 110</p>
    <p>Ingredients: Apple, Water, Sugar</p>
    <button onclick="alert('Thanks for your purchase of Apple Juice!')">Buy Now ($4.99)</button>
</div>

<div class="product-card">
	<img alt="Mango Juice" src="/images/mango_juice.jpg" width="300" height="340"/>
	<h2>Mango Juice</h2>
	<p>Serving size: 8 fl oz</p>
	<p>Calories: 130</p>
	<p>Ingredients: Mango, Water, Sugar</p>
	<button onclick="alert('Thanks for your purchase of Mango Juice!')">Buy Now ($6.99)</button>
</div>

<div class="product-card">
	<img alt="Lemon Juice" src="/images/lemon_juice.jpg" width="300" height="340"/>
	<h2>Lemon Juice</h2>
	<p>Serving size: 8 fl oz</p>
	<p>Calories: 90</p>
	<p>Ingredients: Lemon, Water, Sugar</p>
	<button onclick="alert('Thanks for your purchase of Lemon Juice!')">Buy Now ($3.99)</button>
</div>

	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>
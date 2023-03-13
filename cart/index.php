<?php
require_once $_SERVER['DOCUMENT_ROOT']."/admin/force_login.inc";
include "../header.php";

// Required our database connection
require_once $_SERVER['DOCUMENT_ROOT']."/admin/db.php";

// Form variables with validation
$myproduct_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
$myprice = filter_input(INPUT_GET, 'price', FILTER_VALIDATE_FLOAT);
$myquantity = filter_input(INPUT_GET, 'quantity', FILTER_VALIDATE_INT) ?? 1;

/*if (!$myproduct_id || !$myprice || !$myquantity || $myprice <= 0) {
    echo "Invalid input values.";
    exit;
}*/

$myproduct_id = filter_var($myproduct_id, FILTER_SANITIZE_NUMBER_INT);
$myprice = filter_var($myprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$myquantity = filter_var($myquantity, FILTER_SANITIZE_NUMBER_INT);

$myremove_product_id = isset($_REQUEST['remove_product_id']) ? $_REQUEST['remove_product_id'] : null;

// If the user requested an item to be removed, remove it
if(!empty($myremove_product_id)) {
	unset($_SESSION['cart'][$myremove_product_id]);
}

// If the user sent a product_id, add the quantity to the existing cart quantity or create a new item in the cart
if(!empty($myproduct_id)) {
	if (isset($_SESSION['cart'][$myproduct_id][$myprice])) {
		// Add quantity to existing item in cart
		$_SESSION['cart'][$myproduct_id][$myprice] += $myquantity;
	} else {
		// Create a new item in cart
		$_SESSION['cart'][$myproduct_id][$myprice] = $myquantity;
	}
}

// Select all of the product details from the database
$sql = "SELECT * FROM juices";
$results = $pdo->query($sql);
$product_name = array();
while($row = $results->fetch(PDO::FETCH_ASSOC)) {
	// This will produce an array where the product id shows the name; for example:
	// $product_name[1] = 'Apple Juice'
	// $product_name[2] = 'Orange Juice'
	$product_name[$row['id']] = $row['name'];
}

?>

<style>
    table {
        background-color: #eaf6ff;
    }
</style>
<!--
<head>
	<title>Juice Shop - Shopping Cart</title>
	<style>
		table {
			border-collapse: collapse;
			width: 50rem;
		}
		td, th {
			border: 1px solid black;
			padding: .5rem;
		}
		th {
			text-align: left;
		}
		td.price, th.price {
			text-align: right;
		}
		.remove {
			text-decoration: none;
		}
	</style>
</head>
-->
<h1 class="banner">Shopping Cart</h1>

<?php
// BEGIN: If-else shopping cart check
// If the shopping cart is empty, tell the user
if(empty($_SESSION['cart'])) {
	echo "<p>Your shopping cart is empty.</p>";

// Else show the cart contents
} else {
?>

<p>You've picked out some great products! Ready to check out?</p>
<div style="margin: 0 auto; width: 50%;">
	<table>
		<thead>
			<tr><th>Product</th><th class="price">Quantity / Price per item</th><th class="price">Subtotal</th></tr>
		</thead>
		<tbody>

<?php

// Loop through the items in the shopping cart
$shopping_cart_total = 0;
foreach($_SESSION['cart'] as $item_product_id => $item) {
	foreach($item as $item_price => $item_quantity) {
		// Find the item name based on our previous database query
		$item_name = $product_name[$item_product_id];
		$item_subtotal = $item_quantity * $item_price;
		$shopping_cart_total += $item_subtotal;

		// Display the table row with a subtotal
		echo "<tr><td>$item_name <a class='remove' href='?remove_product_id=$item_product_id' onclick='return confirm(\"Remove from cart?\");'>&#x1f5d1;</a></td><td class='price'>$item_quantity @ $".number_format($item_price,2)."</td><td class='price'>$".number_format($item_subtotal,2)."</td></tr>";

	}
}
?>

	</tbody>
	<tfoot>
		<tr><th colspan="2" class="price">TOTAL</th><td class="price">$<?= number_format($shopping_cart_total,2) ?></td></tr>
	</tfoot>
</table>

<?php
//END: If-else shopping cart check
}
?>

<p><a href="<?= isset($_SERVER['HTTP_REFERER']) && (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) ? $_SERVER['HTTP_REFERER'] : "/" ?>">Continue Shopping</a>


<?php
// Only show the "Checkout" button if there are contents in the cart
if(!empty($_SESSION['cart'])) {
?>

or <button onclick="document.location='checkout.php'">Checkout</button>

<?php
}
?>

</p>
</body>
</html>

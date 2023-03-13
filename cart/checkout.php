<?php
require_once $_SERVER['DOCUMENT_ROOT']."/admin/force_login.inc";
include "../header.php";

// Required our database connection
require_once $_SERVER['DOCUMENT_ROOT']."/admin/db.php";

// Check that there are contents in the cart, otherwise redirect back to show the empty cart message
if(empty($_SESSION['cart'])) {
	header("Location: /cart/");
	exit();
}


// Form variables
$myname = isset($_POST['name']) ? trim($_POST['name']) : '';
$mystreet = isset($_POST['street']) ? trim($_POST['street']) : '';
$mycity = isset($_POST['city']) ? trim($_POST['city']) : '';
$mystate = isset($_POST['state']) ? trim($_POST['state']) : '';
$myzip = isset($_POST['zip']) ? trim($_POST['zip']) : '';
$mycreditcard = isset($_POST['creditcard']) ? trim($_POST['creditcard']) : '';
$myexpiration = isset($_POST['expiration']) ? trim($_POST['expiration']) : '';
$mysecuritycode = isset($_POST['securitycode']) ? trim($_POST['securitycode']) : '';

// Set the flag variable to false
$any_field_empty = false;

// Check that all form fields have been submitted when the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $any_field_empty = false;
    foreach (array('name', 'street', 'city', 'state', 'zip', 'creditcard', 'expiration', 'securitycode') as $field) {
        if (empty($_POST[$field])) {
            $any_field_empty = true;
            break;
        }
    }

    // If one or more of the fields are empty, display an error message
    if ($any_field_empty) {
        echo "<p class='error'>Please complete all fields.</p>";
        exit();
    } else {
        $sql = "INSERT INTO orders (name, street, city, state, zip, creditcard, expiration, securitycode) VALUES (:name, :street, :city, :state, :zip, :creditcard, :expiration, :securitycode)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $myname);
        $stmt->bindParam(':street', $mystreet);
        $stmt->bindParam(':city', $mycity);
        $stmt->bindParam(':state', $mystate);
        $stmt->bindParam(':zip', $myzip);
        $stmt->bindParam(':creditcard', $mycreditcard);
        $stmt->bindParam(':expiration', $myexpiration);
        $stmt->bindParam(':securitycode', $mysecuritycode);

        $stmt->execute();
        $order_id = $pdo->lastInsertId();
    }
} else {
    if (isset($_POST['name']) || isset($_POST['street']) || isset($_POST['city']) || isset($_POST['state']) || isset($_POST['zip']) || isset($_POST['creditcard']) || isset($_POST['expiration']) || isset($_POST['securitycode'])) {
        // If the form has been submitted but there are still missing fields, display an error message
        echo "<p class='error'>ERROR: Please complete all fields.</p>";
    }
}

?>
<!DOCTYPE HTML>
<html lang=en>

<head>
	<title>Juice Shop - Checkout</title>
	<style>
		.error {
			border: 1px solid red;
			color: red;
			padding: .5rem;
			width: 50rem;
            text-align: center;
            position: absolute;
		}
		th {
			text-align: right;
		}
	</style>
</head>

<body>
<h1>Checkout</h1>

<?php

// If ALL of the fields have been submitted, enter the order
if (!empty($myname) && !empty($mystreet) && !empty($mycity) && !empty($myzip) && !empty($mycreditcard) && !empty($myexpiration) && !empty($mysecuritycode)) {
    $sql = "INSERT INTO line_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
    $stmt = $pdo->prepare($sql);

// Loop through the items in the shopping cart
$shopping_cart_total = 0;
foreach($_SESSION['cart'] as $item_product_id => $item) {
	foreach($item as $item_price => $item_quantity) {
		$shopping_cart_total += $item_quantity * $item_price;

		// Bind parameters and execute the query
		$stmt->bindParam(':order_id', $order_id);
		$stmt->bindParam(':product_id', $item_product_id);
		$stmt->bindParam(':quantity', $item_quantity);
		$stmt->bindParam(':price', $item_price);
		$stmt->execute();
	}
}

	// Now that everything is entered into the database, empty the cart
	unset($_SESSION['cart']);
?>

	<p>Thank you for your order! Your order confirmation number is <strong><?= $order_id ?></strong>, and you have been charged <strong>$<?= number_format($shopping_cart_total,2) ?></strong>. Please allow 5-30 business days to receive it in the post.</p>
	<p><em>Just when you've forgotten about it, or decide you want a refund, it'll show up for sure! (Or just wait another day or two...)</em></p>

<?php
}
?>

<p>Please enter your billing details.</p>
<form action="checkout.php" method="post">
	<table>
		<tr>
			<th><label for="name">Name</label></th>
			<td><input id="name" type="text" name="name" value="<?= $myname ?>" required /></td>
		</tr>
		<tr>
			<th><label for="street">Street</label></th>
			<td><input id="street" type="text" name="street" value="<?= $mystreet ?>" required /></td>
		</tr>
		<tr>
			<th><label for="city">City</label></th>
			<td><input id="city" type="text" name="city" value="<?= $mycity ?>" required /></td>
		</tr>
		<tr>
			<th><label for="state">State</label></th>
			<td><select id="state" name="state">
				<option></option>

<?php

$states = array(
	'AL'=>'Alabama',
	'AK'=>'Alaska',
	'AZ'=>'Arizona',
	'AR'=>'Arkansas',
	'CA'=>'California',
	'CO'=>'Colorado',
	'CT'=>'Connecticut',
	'DE'=>'Delaware',
	'DC'=>'District of Columbia',
	'FL'=>'Florida',
	'GA'=>'Georgia',
	'HI'=>'Hawaii',
	'ID'=>'Idaho',
	'IL'=>'Illinois',
	'IN'=>'Indiana',
	'IA'=>'Iowa',
	'KS'=>'Kansas',
	'KY'=>'Kentucky',
	'LA'=>'Louisiana',
	'ME'=>'Maine',
	'MD'=>'Maryland',
	'MA'=>'Massachusetts',
	'MI'=>'Michigan',
	'MN'=>'Minnesota',
	'MS'=>'Mississippi',
	'MO'=>'Missouri',
	'MT'=>'Montana',
	'NE'=>'Nebraska',
	'NV'=>'Nevada',
	'NH'=>'New Hampshire',
	'NJ'=>'New Jersey',
	'NM'=>'New Mexico',
	'NY'=>'New York',
	'NC'=>'North Carolina',
	'ND'=>'North Dakota',
	'OH'=>'Ohio',
	'OK'=>'Oklahoma',
	'OR'=>'Oregon',
	'PA'=>'Pennsylvania',
	'RI'=>'Rhode Island',
	'SC'=>'South Carolina',
	'SD'=>'South Dakota',
	'TN'=>'Tennessee',
	'TX'=>'Texas',
	'UT'=>'Utah',
	'VT'=>'Vermont',
	'VA'=>'Virginia',
	'WA'=>'Washington',
	'WV'=>'West Virginia',
	'WI'=>'Wisconsin',
	'WY'=>'Wyoming',
);


foreach($states as $key => $value)
	echo "<option value='$key'".($mystate==$key ? " selected" : "").">$value</option>\n";
?>

			</select>				
		</tr>
		<tr>
			<th><label for="zip">Zip</label></th>
			<td><input id="zip" type="text" name="zip" value="<?= $myzip ?>" required /></td>
		</tr>
		<tr>
			<th><label for="creditcard">Credit Card</label></th>
			<td><input id="creditcard" type="text" name="creditcard" value="<?= $mycreditcard ?>" required /></td>
		</tr>
		<tr>
			<th><label for="expiration">Expiration</label></th>
			<td><input id="expiration" type="month" name="expiration" value="<?= $myexpiration ?>" required /></td>
		</tr>
		<tr>
			<th><label for="securitycode">Security Code</label></th>
			<td><input id="securitycode" type="password" name="securitycode" maxlength="4" value="<?= $mysecuritycode ?>" required /></td>

		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Complete Purchase" /></td>
		</tr>
	</table>
</form>

<?php
}
?>

</body>
</html>


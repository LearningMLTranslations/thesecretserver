<?php
$username = 'root';
$password = 'L0g1n_P4s$w0rd';

// Try / Catch block to create connection to database and fail on error states
try {
    $pdo = new PDO('mysql:host=localhost;dbname=juiceshop', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

if (isset($_POST["create"])) {
    // Validate user input
    $price = filter_var($_POST["price"], FILTER_VALIDATE_FLOAT);
    $servingSize = filter_var($_POST["servingSize"], FILTER_VALIDATE_INT);
    $calories = filter_var($_POST["calories"], FILTER_VALIDATE_INT);
    $ingredients = filter_var($_POST["ingredients"], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $image = filter_var($_POST["image"], FILTER_SANITIZE_STRING);

    // Create array for various errors if the user fails to enter correct information type
    $errors = [];
    if ($price === false) {
        $errors[] = "Invalid price. Please enter a valid number.";
    }
    if ($servingSize === false) {
        $errors[] = "Invalid serving size. Please enter a valid number.";
    }
    if ($calories === false) {
        $errors[] = "Invalid calories. Please enter a valid number.";
    }
    if (empty($ingredients)) {
        $errors[] = "Ingredients cannot be empty. Please enter a list of ingredients.";
    }
    if (empty($name)) {
        $errors[] = "Name cannot be empty. Please enter a name for the product.";
    }
    if (empty($image)) {
        $errors[] = "Image URL cannot be empty. Please enter a URL for the product image.";
    }
    // Tell the user what the error was
    if (!empty($errors)) {
        die("Invalid input:<br>" . implode("<br>", $errors));
    }

    // Insert the product into the database
    $stmt = $pdo->prepare("INSERT INTO juices (timestamp, price, servingSize, calories, ingredients, description, name, image) VALUES (NOW(), :price, :servingSize, :calories, :ingredients, :description, :name, :image)");
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':servingSize', $servingSize);
    $stmt->bindParam(':calories', $calories);
    $stmt->bindParam(':ingredients', $ingredients);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':image', $image);
    if ($stmt->execute()) {
        echo "New product created successfully!";
    } else {
        echo "Error: " . $stmt->errorInfo();
    }
    header('Location: /list.php?search=');
    exit;
}

if (isset($_POST["update"])) {
    // Validate user input
    $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
    $price = filter_var($_POST["price"], FILTER_VALIDATE_FLOAT);
    $servingSize = filter_var($_POST["servingSize"], FILTER_VALIDATE_INT);
    $calories = filter_var($_POST["calories"], FILTER_VALIDATE_INT);
    $ingredients = filter_var($_POST["ingredients"], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $image = filter_var($_POST["image"], FILTER_SANITIZE_STRING);

    if ($id === false || $price === false || $servingSize === false || $calories === false || $ingredients === false || $description === false || $name === false || $image === false) {
        die("Invalid input. Please check your input and try again.");
    }

    // Create prepared statement from user inputs and update the product in the database
    if ($stmt = $pdo->prepare("UPDATE juices SET price=:price, servingSize=:servingSize, calories=:calories, ingredients=:ingredients, description=:description, name=:name, image=:image WHERE id=:id")) {
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':servingSize', $servingSize);
        $stmt->bindParam(':calories', $calories);
        $stmt->bindParam(':ingredients', $ingredients);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            echo "Product updated successfully!";
        } else {
            echo "Error updating product";
        }
    } else {
        echo "Statement error";
    }
    header('Location: /list.php?search='); // Return to product list on completion
    exit;
}
// Delete action block
if (isset($_POST["delete"])) {
    $id = filter_var($_POST["id"], FILTER_VALIDATE_INT); // Validate input
    if ($id === false) {
        die("Invalid input. Please check your input and try again.");
    }

    // Delete the product from the database
    $sql = "DELETE FROM juices WHERE id=:id";
    // Prepare delete query
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Product deleted successfully!";
    } else {
        echo "Error: Product not deleted.";
    }
    header('Location: /list.php?search='); // Return to product list on completion
    exit;
}

$order = "id ASC";

if (isset($_GET['order'])) {
    $columns = ['id', 'timestamp', 'price', 'servingSize', 'calories', 'ingredients', 'description', 'name'];
    $directions = ['ASC', 'DESC'];
    $parts = explode(' ', $_REQUEST['order']);
    $column = $parts[0];
    $direction = count($parts) > 1 ? $parts[1] : 'ASC';

    if (in_array($column, $columns) && in_array($direction, $directions)) {
        $order = "$column $direction";
    } else {
        echo "Invalid sort order";
    }
}

if (isset($_GET['search'])) {
    if (!empty($_GET['search'])) {
        $search = htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');
        $sql = "SELECT * FROM juices WHERE name LIKE '%$search%' ORDER BY $order";
    } else {
        $sql = "SELECT * FROM juices ORDER BY $order";
        echo "Please enter a search term.";
    }
} else {
    $sql = "SELECT * FROM juices ORDER BY $order";
}

$result = $pdo->query($sql);

if ($result->rowCount() != 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["id"]. "</td>";
        echo "<td>" . $row["timestamp"]. "</td>";
        echo "<td>$" . $row["price"]. "</td>";
        echo "<td>" . $row["servingSize"]. " fl oz</td>";
        echo "<td>" . $row["calories"]. " calories</td>";
        echo "<td>" . $row["ingredients"]. "</td>";
        echo "<td>" . $row["description"]. "</td>";
        echo "<td>" . $row["name"]. "</td>";
        echo "<td><img src='images/" . $row["image"] . "' width='100' height='100'></td>";
        echo "<td><form method='GET' action='./cart/index.php'>
            <input type='hidden' name='product_id' value='" . $row["id"] . "'>
            <input type='hidden' name='price' value='" . $row["price"] . "'>
            <input type='number' name='quantity' value='1' min='1'>
            <input type='submit' value='Add to Cart' style='padding: 10px 15px; font-size: 18px; font-weight: bold; background-color: #FFA500; color: white; border: none; border-radius: 4px;''></form></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No products found in the database.</td></tr>";
}

$pdo = null;

?>

<?php
$username = 'root';
$password = 'L0g1n_P4s$w0rd';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=juiceshop', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

session_start();

if (isset($_POST["create"])) {
    // Validate user input
    $price = filter_var($_POST["price"], FILTER_VALIDATE_FLOAT);
    $servingSize = filter_var($_POST["servingSize"], FILTER_VALIDATE_INT);
    $calories = filter_var($_POST["calories"], FILTER_VALIDATE_INT);
    $ingredients = filter_var($_POST["ingredients"], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $image = filter_var($_POST["image"], FILTER_SANITIZE_STRING);

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

    // Update the product in the database
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
}

if (isset($_POST["delete"])) {
    $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
    if ($id === false) {
        die("Invalid input. Please check your input and try again.");
    }

    // Delete the product from the database
    $sql = "DELETE FROM juices WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Product deleted successfully!";
    } else {
        echo "Error: Product not deleted.";
    }
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
        die("Please enter a search term.");
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
        echo "<td>" . $row["servingSize"]. "</td>";
        echo "<td>" . $row["calories"]. "</td>";
        echo "<td>" . $row["ingredients"]. "</td>";
        echo "<td>" . $row["description"]. "</td>";
        echo "<td>" . $row["name"]. "</td>";
        echo "<td><img src='images/" . $row["image"] . "' width='100' height='100'></td>";
        echo "<td><form method='POST' action='./cart/'>
                <input type='hidden' name='product_id' value='" . $row["id"] . "'>
                <input type='hidden' name='price' value='" . $row["price"] . "'>
                <input type='submit' value='Buy' style='padding: 5px 15px; font-size: 14px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;''></form></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No products found in the database.</td></tr>";
}

$pdo = null;

?>

<?php
$host = "localhost";
$username = "root";
$password = "L0g1n_P4s\$w0rd";
$dbname = "juiceshop";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["create"])) {
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $servingSize = mysqli_real_escape_string($conn, $_POST["servingSize"]);
    $calories = mysqli_real_escape_string($conn, $_POST["calories"]);
    $ingredients = mysqli_real_escape_string($conn, $_POST["ingredients"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $image = mysqli_real_escape_string($conn, $_POST["image"]);

    $sql = "INSERT INTO juices (timestamp, price, servingSize, calories, ingredients, description, name, image)
            VALUES (NOW(), '$price', '$servingSize', '$calories', '$ingredients', '$description', '$name', '$image')";

    if (mysqli_query($conn, $sql)) {
        echo "New product created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST["update"])) {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $servingSize = mysqli_real_escape_string($conn, $_POST["servingSize"]);
    $calories = mysqli_real_escape_string($conn, $_POST["calories"]);
    $ingredients = mysqli_real_escape_string($conn, $_POST["ingredients"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $image = mysqli_real_escape_string($conn, $_POST["image"]);

    $sql = "UPDATE juices SET price='$price', servingSize='$servingSize', calories='$calories', ingredients='$ingredients', description='$description', name='$name', image='$image'
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Product updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST["delete"])) {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    $sql = "DELETE FROM juices WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Product deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    } else {
        die("Please enter a search term");
    }
} else {
    die("Malformed request.");
}

$sql = empty($search) ? "SELECT * FROM juices ORDER BY $order" : "SELECT * FROM juices WHERE name LIKE '%$search%' ORDER BY $order";

/*
// Add wildcards to our search term
$search = "%{$search}%";

// Prepare the statement
$stmt = mysqli_prepare($mysqli, $sql);
mysqli_stmt_bind_param($stmt, "s", $myterm);

// Run the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
*/

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
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
        echo "<td><form method='POST' action='./cart/checkout.php'>
                <input type='hidden' name='id' value='" . $row["id"] . "'>
                <input type='hidden' name='price' value='" . $row["price"] . "'>
                <input type='submit' value='search' style='padding: 10px 20px; font-size: 16px; background-color: #D3D3D3; color: black; border: none; border-radius: 4px;'></form></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No products found in the database.</td></tr>";
}



mysqli_close($conn);
?>

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
$order = "id ASC"
if (isset($_REQUEST['order'])) {
    $order = $_REQUEST['order'];
}
if (isset($_GET['search'])) {
    if (!empty($_GET['search'])) {
        $search = $_GET['search'];
    } else {
        die("Please enter a search term");
    }
} else {
    die("Malformed request.");
}

$sql = "SELECT * FROM juices WHERE name LIKE '%$search%' ORDER BY $order";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["timestamp"]. "</td><td>$" . $row["price"]. "</td><td>" . $row["servingSize"]. "</td><td>" . $row["calories"]. "</td><td>" . $row["ingredients"]. "</td><td>" . $row["description"]. "</td><td>" . $row["name"]. "</td><td><img src='images/" . $row["image"] . "' width='100' height='100'></td></tr>";
    }
} else {
    echo "<tr><td colspan='9'>No products found in the database.</td></tr>";
}


mysqli_close($conn);
?>

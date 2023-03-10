<?php

$host = "localhost";
$username = "root";
$password = "L0g1n_P4s\$w0rd";
$dbname = "juiceshop";

    $dbhost = 'mysql:host=' . $host . ';dbname=' . $dbname;

try {
    $pdo = new PDO($dbhost, $username, $password);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<?php

$host = "localhost";
$username = "root";
$password = "L0g1n_P4s\$w0rd";
$dbname = "juiceshop";

   $dbhost = 'mysql:host=' . $host . ';dbname=' . $dbname;
   $pdo = new PDO($dbhost, $username, $password);

?>
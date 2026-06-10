<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "organization";
try {

    $connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo "Connection failed: " . $err->getMessage();
}
?>






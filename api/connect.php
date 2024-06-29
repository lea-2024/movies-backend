<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies_db";

// $servername = "sql204.infinityfree.com";
// $username = "if0_36751891";
// $password = "dk4UL5DlemS";
// $dbname = "if0_36751891_movies_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
<?php
$host = 'localhost';
$user = 'root';
$password = ''; // or your DB password
$database = 'ShopQwik';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

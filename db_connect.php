<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "pet_adoption";


$conn = mysqli_connect($hostname, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
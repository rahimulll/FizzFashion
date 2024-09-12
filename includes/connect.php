<?php

$servername = "localhost"; // Change this to your database server's hostname or IP address
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "fizz_fashion"; // Change this to the name of your MySQL database

// Create a connection to the database
$con=mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$con) {
    die(mysqli_error($con));
}

?>

<?php
$servername = "localhost";
$username = "qcadmin";
$password = "J2PKY!HrkYt*AB8dhz@rYw\$X";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
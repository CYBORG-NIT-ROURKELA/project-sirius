<?php
$servername = "localhost";
$username = "root";
$password = "";
$mydb="project_sirius";

// mysql_connect($servername,$username,$password);
// mysql_select_db($mydb);

// Create connection
$con = mysqli_connect($servername, $username, $password,$mydb);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>

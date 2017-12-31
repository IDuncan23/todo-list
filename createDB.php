<?php

$servername = "localhost";
$username = "root";
$password = "root";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE sdd320";
if (mysqli_query($conn, $sql)) {

    echo "Database created successfully";

    $dbname = "sdd320";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}    

	$sql_table = "CREATE TABLE users (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(30) NOT NULL,
	password VARCHAR(60) NOT NULL
	)";

	if (mysqli_query($conn, $sql_table)) {
	    echo "Table 'users' created successfully";
	    header("Refresh: 2; url=../../index.php");
	} else {
	    echo "Error creating table: " . mysqli_error($conn);
	    header("Refresh: 5; url=../../index.php");
	}

} else {

    echo "Error creating database: " . mysqli_error($conn);
    header("Refresh: 5; url=../../index.php");

}

mysqli_close($conn);

?>
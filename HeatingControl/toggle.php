<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT isOn, toggle FROM status WHERE id = 1')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($isOn, $toggle);
	$stmt->fetch();
}
$updatedToggle = 1-$toggle;
if ($stmt = $con->prepare("UPDATE `status` SET `toggle` = ? WHERE `status`.`id` = 1;")) {
	$stmt->bind_param('i', $updatedToggle);
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	
	$stmt->execute();
}
	$stmt->close();
}
header('Location: page1.php');
?>
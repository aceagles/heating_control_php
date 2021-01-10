<?php
session_start();
// Change this to your connection info.
require_once "config.php";
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill the password field!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id FROM accounts WHERE password = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['password']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.

		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		
		$_SESSION['id'] = $id;
		header('Location: page1.php');
	
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!';
}
	$stmt->close();
}
exit();
?>
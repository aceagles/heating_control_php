<?php
require_once "config.php";


// Check if the device has the correct password
if ($stmt = $con->prepare('SELECT id FROM accounts WHERE password = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['password']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

if ($stmt->num_rows > 0) {
    //if number of rows >0 then password is correct to execute actions

    //Check if retrieving or setting data
    if ($_POST['method'] = 'get'){
        //if get then return the current database values
        $stmt = $con -> prepare('SELECT isOn, toggle FROM status WHERE id = 1');
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        
        $stmt->bind_result($isOn, $toggle);
        $stmt->fetch();
        echo $isOn . " " . $toggle;

    } elseif ($_POST['method'] = 'set'{
        $sql = "UPDATE status". "SET isOn = $_POST['isOn'], toggle = $_POST['toggle'] ". 
        "WHERE id = 1" ;
        mysql_select_db('test_db');
        $retval = mysql_query( $sql, $conn );
        echo "data been set";
    )
} else {
	echo "No Password";
}
	$stmt->close();
}

?>
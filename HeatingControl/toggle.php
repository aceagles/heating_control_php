<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.2.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.2.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo5.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Heating Toggled</title>
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
  
</head>
<body>
  
  <section class="header6 cid-skB9uQlrN8 mbr-fullscreen" id="header6-n">

    

    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(68, 121, 217);"></div>

    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-3 display-1"><strong>Heating Toggled</strong></h1>
                
                <p class="mbr-text mbr-white mbr-fonts-style display-7">
                    Press button to return to control screen</p>
                <div class="mbr-section-btn mt-3"><a class="btn btn-danger display-4" href="page1.php">Go Back</a></div>
            </div>
        </div>
    </div>
</section><section style="background-color: #fff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; color:#aaa; font-size:12px; padding: 0; align-items: center; display: flex;"><a href="https://mobirise.site/e" style="flex: 1 1; height: 3rem; padding-left: 1rem;"></a><p style="flex: 0 0 auto; margin:0; padding-right:1rem;">Mobirise website builder - <a href="https://mobirise.site/o" style="color:#aaa;">Click here</a></p></section><script src="assets/web/assets/jquery/jquery.min.js"></script>  <script src="assets/popper/popper.min.js"></script>  <script src="assets/tether/tether.min.js"></script>  <script src="assets/bootstrap/js/bootstrap.min.js"></script>  <script src="assets/smoothscroll/smooth-scroll.js"></script>  <script src="assets/theme/js/script.js"></script>  
  
  
</body>
</html>

<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

require_once "config.php";
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


?>


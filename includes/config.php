<?php
session_start();
ob_start();


//set timezone
date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','127.0.0.1');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','artifactydatabase');

//application address
define('DIR','http://localhost/Artifacty/');
define('SITEEMAIL','noreply@domain.com');

try {

	//create PDO connection 
	$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('C:\xampp\htdocs\Artifacty\classes/user.php');
$user = new User($db); 
?>

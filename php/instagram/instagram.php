<?php
//session_start();
//session_start();
require_once ('instagram.class.php');

// Setup class
$instagram = new Instagram( array('apiKey' => '', 
								'apiSecret' => '', 
								'apiCallback' => '' 
								// must point to success.php
));
$token='';
$check='';
$code='';
// Receive OAuth code parameter
if (!isset($_SESSION["check"]) && strlen($_GET["code"]) < 50) {
	$code = $_GET["code"];
	//echo "$code<br>";
	$_SESSION["check"] = $code;
}
$code = $_SESSION["check"];
//echo "$code<br>";
//echo strlen($code);
//echo "$code<br>";

// Check whether the user has granted access
if (true === isset($code) && strlen($code) < 50) {
	//echo "true hit<br>";
	//echo "passed<br>";
	//$data = $instagram->getInstagramPhotos($code);
	//echo $data;
	// Receive OAuth token object
	if (!isset($_SESSION[$token])) {
		//echo "session not set<br>";
		$data = $instagram -> getOAuthToken($code);
		$_SESSION[$token] = $data;
		//echo "session = ".$_SESSION[$token];
		$instagram -> setAccessToken($data);
	} else {
		$var = $_SESSION[$token];
		//echo "session = ".$_SESSION[$token];
		$instagram -> setAccessToken($var);
	}
}
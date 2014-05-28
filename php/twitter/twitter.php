<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once ('twitteroauth/twitteroauth.php');
require_once ('config.php');

if(!isset($_SESSION['count'])) { // If no session var exists, we create it.
        $_SESSION['count'] = 2; // In this case, the session value start on 0.
}

/* If access tokens are not available redirect to connect page.*/
 if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
 	$login = "<a href='php/twitter/redirect.php'><img src='img/Twitter_logo_blue.png' alt='Sign in with Twitter'/>Login Twitter</a>";
	echo '<script>
    $( document ).ready(function() { 
      $(\'.login\').prepend("' . $login . '");
    });
    </script>';
	
 	//echo "empty<br>";
 }
 //echo "not empty<br>";
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];
//echo "access_token: ".$access_token."<br>";
/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection -> get('account/verify_credentials');

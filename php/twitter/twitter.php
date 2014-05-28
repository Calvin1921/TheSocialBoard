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
//echo "check acc: ".$content."<br>";
//print_r($content);

//$content = $connection -> get('statuses/home_timeline', array('count' => 30, 'contributor_details' => false, 'include_entities' => false));
//echo "get homeline<br>";
//print_r($content);
//$login = '<a href="php/twitter/redirect.php"><img src="img/lighter.png" alt="Sign in with Twitter"/></a>';
/* Some example calls */
//$connection->get('users/show', array('screen_name' => 'abraham'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));
/*echo '<script>
			console.log(' . json_encode($content) . ');
			</script>';
$reversed = array_reverse($content);
echo '<script>
			console.log(' . json_encode($reversed) . ');
			</script>';
/* Include HTML to display on the page*
//$str='';
if (is_array($content)) {
	//echo 'working';
	/*echo '<script>
	 $( document ).ready(function() {
	 ';*
	foreach ($content as $status) {
		/*$text = addslashes($status -> text);
		$text = str_replace(array("\r\n", "\n", "\r"), ' ', $text);

		echo '<script>
			$( document ).ready(function() { 
				$(\'.status\').after(post("' . addslashes($status -> user -> profile_image_url_https) . '","' . addslashes($status -> user -> name) . '","' . addslashes($status -> user -> screen_name) . '","' . addslashes($status -> created_at) . '","' . htmlspecialchars($text) . '"));
				});
	</script>';*
	
	}
	//echo $str;
	/*echo '});
	 </script>'; *
	 
	 //exit(json_encode($content));  
} else {
	//echo 'working';

}*/

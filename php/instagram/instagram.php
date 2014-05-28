<?php
//session_start();
//session_start();
require_once ('instagram.class.php');

// Setup class
$instagram = new Instagram( array('apiKey' => '5f538ec0d0234bf99122d4dba3b9c0d5', 
								'apiSecret' => 'd81438f4304449ff81720bed93c1bce5', 
								'apiCallback' => 'http://ix.cs.uoregon.edu/~kho3/index.php' 
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
	//echo "$token";
	// Store user access token

	// Now you can call all authenticated user methods
	// Get all user likes
	/*
	$insta = $instagram -> getUserFeed();
	echo "<br>instagram-------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";	
	echo json_encode($insta);
	// $likes = $instagram->getUserMedia();
	//print_r($likes);
	// Display all user likes
	/*foreach ($insta->data as $entry) {
	 $text = "<p>".$entry->likes->count." likes";
	 $likeId = $entry->id;
	 if($entry->user_has_liked){
	 $text = $text."<input type='image' id='".$entry->id."' src='_include/img/Liked' value='Like' onclick=instaLike('".$entry->id."')></p>";
	 }
	 else{
	 $text = $text."<input type='image' id='".$entry->id."' src='_include/img/Like' value='Like' onclick=instaLike('".$entry->id."')></p>";
	 }
	 foreach($entry->comments->data as $comments){
	 $text = $text."<p><b><font color=white>".$comments->from->username."</font></b>  ".$comments->text."</p>";
	 }

	 $text = $text."<input type='text' name='".$entry->id."' placeholder='Comment...' value=''><input type='image' value='Comment' src='_include/img/instagram1' onclick=instaPost('".$entry->id."') alt='button' height='40' width='40'>";
	 $caption= addslashes($entry->caption->text);
	 $text = addslashes($text);
	 $text =  str_replace ( "\"", "&quot;", $text );
	 echo '<script>
	 $( document ).ready(function() {
	 $(\'.userFeed\').after(\'<li class="item-thumbs instagram"><a class="hover-wrap fancybox" data-fancybox-group="gallery" title= "'.$caption.'" href="'. $entry->images->standard_resolution->url.'"><span class="overlay-img"></span><span class="overlay-img-thumb font-icon-plus"></span></a><img id="instagram" src="'. $entry->images->thumbnail->url.'" alt="'.$text.'"></img>\');
	 });
	 </script>';
	 }*/

} else {
	if (true === isset($_GET['error'])) {
		echo 'An error occurred: ' . $_GET['error_description'];
	} else {
		$loginUrl = $instagram -> getLoginUrl(array('likes', 'basic', 'comments'));
		$login = "<a href='" . $loginUrl . "'><img src='img/insta-login.png' alt='Sign in with Insta'/>Login Instagram</a>";
		echo '<script>
    $( document ).ready(function() { 
      $(\'.login\').prepend("'. $login .'");
    });
    </script>';
	}
}

/*
 $data = $instagram->getOAuthToken("cca03323f2134982aa1bfb04fef0e1bf");
 $instagram->setAccessToken($data);
 //$instagram->setAccessToken('2411052.5f538ec.e9d4d308f3f6438dacbab08a0124c456');
 $likes = $instagram->getUserMedia();

 // Display all user likes
 foreach ($likes->data as $entry) {
 echo '<script>
 $( document ).ready(function() {
 $(\'.userFeed\').after(\'<li class="item-thumbs instagram"><a href="'. $entry->images->thumbnail->url .'"><img src="'. $entry->images->thumbnail->url.'"></img></a>\');
 });
 </script>';
 }*/
?>
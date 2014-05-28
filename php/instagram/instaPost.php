<?php
 session_start();
     require 'instagram.class.php';
     
     // Setup class
     $instagram = new Instagram(array(
       'apiKey'      => '',
       'apiSecret'   => '',
       'apiCallback' => '' // must point to success.php
     ));
     // Receive OAuth code parameter
    $data = $_SESSION[$token];
    //echo $data."\n\n";
    // $data = $instagram->getOAuthToken($code);
    $instagram->setAccessToken($data);
    //echo "$code<br>";
    //echo strlen($code);
     //echo "$code<br>";

     // Check whether the user has granted access
    $id = $_POST['Tid'];
	$insta = $instagram -> getUserFeed();
	//echo "<br>instagram-------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";	
	echo json_encode($insta->data);
	
<?php

require_once ('twitter.php');
//header('Content-type: text/javascript');
//if(!isset($_SESSION['id'])) { // If no session var exists, we create it.
	$content = $connection -> get('statuses/home_timeline', array('count' => $_SESSION['count']++, 'contributor_details' => true, 'include_entities' => true));
//}else{
	//$content = $connection -> get('statuses/home_timeline', array('contributor_details' => false, 'include_entities' => true,'since_id'=> $_SESSION['id']));	
//}
$response = json_decode(json_encode($content), true);
/*echo "<br>response-------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
var_dump($response);
echo "<br>next-------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";*/
//var_dump($response[0]);
//$_SESSION['id'] = $response[0]["id"];
//echo "<br>response id--------------------------------------<br><br>";
//echo $response[0]["id"];
echo json_encode($response);

?>

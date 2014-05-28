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

//if (is_array($content)) {
	//echo 'array is not empty';
	/*echo '<script>
	 $( document ).ready(function() {
	 ';*/
	//foreach ($content as $status) {
		/*$text = addslashes($status -> text);
		$text = str_replace(array("\r\n", "\n", "\r"), ' ', $text);

		echo '<script>
			$( document ).ready(function() { 
				$(\'.status\').after(post("' . addslashes($status -> user -> profile_image_url_https) . '","' . addslashes($status -> user -> name) . '","' . addslashes($status -> user -> screen_name) . '","' . addslashes($status -> created_at) . '","' . htmlspecialchars($text) . '"));
				});
	</script>';*/
	
	//}
	//echo $str;
	/*echo '});
	 </script>'; */
	 /*$json;
	 $response = json_decode(json_encode($content), true);
	 $flag=true;

	 function post($response){
		 if($GLOBALS['flag']){	
			 	echo "<br>is empty";
				 $GLOBALS['json'] = $response;
				echo json_encode($response);
				$GLOBALS['flag']=false;
				post($response);
		 }else{

		 }
	}
	 post($response);*/
	 //exit(json_encode($content));  
//} else {
	//echo 'array is empty';

//}
?>

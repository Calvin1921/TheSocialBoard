<?php
require_once ('twitter.php');
//header('Content-type: text/javascript
$content = $connection -> get('statuses/home_timeline', array('count' => $_SESSION['count']++, 'contributor_details' => false, 'include_entities' => true));
$response = json_decode(json_encode($content), true);
echo json_encode($response);

/*
function objToArray($obj, &$arr){

    if(!is_object($obj) && !is_array($obj)){
        $arr = $obj;
        return $arr;
    }

    foreach ($obj as $key => $value)
    {
        if (!empty($value))
        {
            $arr[$key] = array();
            objToArray($value, $arr[$key]);
        }
        else
        {
            $arr[$key] = $value;
        }
    }
    return $arr;
}
$content = $connection -> get('statuses/home_timeline', array('count' => 3, 'contributor_details' => false, 'include_entities' => true));
//$response = json_decode(json_encode($content), true);
$arr;
$response = objToArray($content,$arr);
//echo "<script>consle.log($response);</script>";
//var_dump($response);
			//echo "<br>compare";
		 	$result=array_diff($response['0'],$_SESSION['save']['0']);
			//echo "<br>_SESSION['save']-------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
			
			//var_dump($_SESSION['save']['0']);
			//echo "<br>response-------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
			//var_dump($response['0']);
			//echo '<script>console.log('.json_encode($result).')</script>';
			//echo "<br>result-------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
			//echo "empty :".empty($result)."<br>";
			//echo "set:".isset($result)."<br>";
			if(empty($result)==''){
				echo json_encode($response);
			}
			//echo json_encode($result);
			//echo "<br>result-------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
			
			$_SESSION['save'] = $response;*/

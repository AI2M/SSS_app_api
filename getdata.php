<?php
require_once 'include/db_functions.php';
 
// json response array
$response = array("error" => FALSE);
$showroom_id = $_GET['showroom_id']=5;
 
if (isset($_GET['showroom_id'])) {
 
    // receiving the post params
 
    $showroom_id = $_GET['showroom_id'];
    
 
    // get the user by email and password
    $music_box = GetDataByID($showroom_id);
 
    if ($music_box != false) {
        // user is found

        // $response["error"] = FALSE;
		// $response["music_box"]["music_box_id"] = $music_box["music_box_id"];
        // $response["music_box"]["showroom_id"] = $music_box["showroom_id"];
        // $response["music_box"]["name"] = $music_box["name"];
        // $response["music_box"]["price"] = $music_box["price"];
        // $response["music_box"]["detail"] = $music_box["detail"];
        // $response["music_box"]["position"] = $music_box["position"];
        $response = array();
        $response["error"] = FALSE;
        $response["music_box"] = $music_box;
        
        header('Content-Type: application/json');
        //$ar =array("gg"=>"bb");
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Wrong email or password entered! Please try again!";
        echo json_encode($response);
    }
} else {
    //required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters missing :(!";
    echo json_encode($response);
}
?>
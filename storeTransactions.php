<?php
 
require_once 'include/db_functions.php';
 
// json response array
$response = array("error" => FALSE);


// $time = $_POST['time']="09:23:04";
// $date = $_POST['date']="2017-12-1";
// $showroom_id = $_POST["showroom_id"]=3333;
// $music_box_id = $_POST["music_box_id"]=3333;
// $position = $_POST["position"]=3;

//echo json_encode($_POST);
if (isset($_POST['time']) && isset($_POST['date']) && isset($_POST['showroom_id']) && isset($_POST['music_box_id']) 
&& isset($_POST['position'])) {
    // receiving the post params
    $time = $_POST['time'];
	$date = $_POST['date'];
    $showroom_id = $_POST["showroom_id"];
    $music_box_id = $_POST["music_box_id"];
    $position = $_POST["position"];

 
    // check if user already exists with the same email
    
        // create a new user
        $transactions = storeTransactions($time, $date, $showroom_id, $music_box_id, $position);
        if ($transactions) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["transactions"]["time"] = $transactions["time"];
            $response["transactions"]["date"] = $transactions["date"];
            $response["transactions"]["showroom_id"] = $transactions["showroom_id"];
            $response["transactions"]["music_box_id"] = $transactions["music_box_id"];
            $response["transactions"]["position"] = $transactions["position"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred!";
            echo json_encode($response);
        }
    
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters missing!";
    echo json_encode($response);
}
?>
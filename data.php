<?php
 
require_once 'include/db_functions.php';
 
// json response array
$response = array("error" => FALSE);

// $phone_num = $_POST['phone_num']="222";
// $age = $_POST['age']="333";
// $sex = $_POST["sex"]="333";
// $salary = $_POST["salary"]="333";
// $job = $_POST["job"]="333";
// $showroom_id = $_POST["showroom_id"]="3";

 
if (isset($_SERVER['QUERY_STRING']['phone_num']) ) {
 
    // receiving the post params
    $phone_num = $_SERVER['QUERY_STRING']['phone_num'];

 
    // check if user already exists with the same email
    if(phoneExists($phone_num)){
		// email already exists
        $response["error"] = TRUE;
        $response["error_msg"] = "phone_num already exists with " . $phone_num;
        echo json_encode($response);
	}else {
        // create a new user
        $customer = storeCustomer2($phone_num);
        if ($customer) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["customer"]["phone_num"] = $customer["phone_num"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters missing!";
    echo json_encode($response);
}
?>
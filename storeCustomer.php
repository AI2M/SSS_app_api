pj<?php
 
require_once 'include/db_functions.php';
 
// json response array
$response = array("error" => FALSE);

// $phone_num = $_POST['phone_num']="222";
// $age = $_POST['age']="333";
// $sex = $_POST["sex"]="333";
// $salary = $_POST["salary"]="333";
// $job = $_POST["job"]="333";
// $showroom_id = $_POST["showroom_id"]="3";

 
if (isset($_POST['phone_num']) && isset($_POST['age']) && isset($_POST['sex'])&& isset($_POST['salary'])
&& isset($_POST['job'])&& isset($_POST['showroom_id'])) {
 
    // receiving the post params
    $phone_num = $_POST['phone_num'];
	$age = $_POST['age'];
    $sex = $_POST["sex"];
    $salary = $_POST["salary"];
    $job = $_POST["job"];
    $showroom_id = $_POST["showroom_id"];
 
    // check if user already exists with the same email
    if(phoneExists($phone_num)){
		// email already exists
        $response["error"] = TRUE;
        $response["error_msg"] = "phone_num already exists with " . $phone_num;
        echo json_encode($response);
	}else {
        // create a new user
        $customer = storeCustomer($phone_num, $age, $sex, $salary, $job, $showroom_id);
        if ($customer) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["customer"]["phone_num"] = $customer["phone_num"];
            $response["customer"]["age"] = $customer["age"];
            $response["customer"]["sex"] = $customer["sex"];
            $response["customer"]["salary"] = $customer["salary"];
            $response["customer"]["job"] = $customer["job"];
            $response["customer"]["showroom_id"] = $customer["showroom_id"];
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
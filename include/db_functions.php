<?php require_once("include/db_connection.php");?>
<?php

	function storeUser($username, $email, $password){
		global $connection;
		
		$query = "INSERT INTO users(";
		$query .= "username, email, password) ";
		$query .= "VALUES('{$username}', '{$email}','{$password}')";

		$result = mysqli_query($connection, $query);

		if($result){
			$user = "SELECT * FROM users WHERE email = '{$email}'";
			$res = mysqli_query($connection, $user);

			while ($user = mysqli_fetch_assoc($res)){
				return $user;
			}
		}else{
				return false;
			}

	}

	function storeCustomer($phone_num, $age, $sex, $salary, $job, $showroom_id){
		global $connection;
		
		$query = "INSERT INTO Customer(";
		$query .= "phone_num, age, sex, salary, job, showroom_id) ";
		$query .= "VALUES('{$phone_num}', '{$age}','{$sex}','{$salary}','{$job}','{$showroom_id}')";

		$result = mysqli_query($connection, $query);

		if($result){
			$user = "SELECT * FROM Customer WHERE phone_num = '{$phone_num}'";
			$res = mysqli_query($connection, $user);

			while ($user = mysqli_fetch_assoc($res)){
				return $user;
			}
		}else{
				return false;
			}

	}
	function storeCustomer2($phone_num){
		global $connection;
		
		$query = "INSERT INTO Customer(";
		$query .= "phone_num) ";
		$query .= "VALUES('{$phone_num}')";

		$result = mysqli_query($connection, $query);

		if($result){
			$user = "SELECT * FROM Customer WHERE phone_num = '{$phone_num}'";
			$res = mysqli_query($connection, $user);

			while ($user = mysqli_fetch_assoc($res)){
				return $user;
			}
		}else{
				return false;
			}

	}


	function storeTransactions($time, $date, $showroom_id, $music_box_id, $position){
		global $connection;
		
		$query = "INSERT INTO Transactions(";
		$query .= "transactions_id, time, date, showroom_id, music_box_id, position) ";
		$query .= "VALUES( ' ', '{$time}', '{$date}', '{$showroom_id}', '{$music_box_id}', '{$position}')";

		$result = mysqli_query($connection, $query);

		if($result){
			$user = "SELECT * FROM Transactions WHERE showroom_id = '{$showroom_id}'";
			$res = mysqli_query($connection, $user);

			while ($user = mysqli_fetch_assoc($res)){
				return $user;
			}
		}else{
				return false;
			}

	}



	function getUserByEmailAndPassword($email, $password){
		global $connection;
		$query = "SELECT * from users where email = '{$email}' and password = '{$password}'";
	
		$user = mysqli_query($connection, $query);
		
		if($user){
			while ($res = mysqli_fetch_assoc($user)){
				return $res;
			}
		}
		else{
			return false;
		}
	}

	function GetDataByID($showroom_id){
		global $connection;
		$query = "SELECT * from Music_box where showroom_id = '{$showroom_id}' ORDER BY position ASC ";
	
		$user = mysqli_query($connection, $query);
		$data = array();
		if($user){
			while ($res = mysqli_fetch_assoc($user)){
				//$data.append($res);
				array_push($data,$res);
				
			}
			return $data;
		}
		else{
			return false;
		}
	}



	function emailExists($email){
		global $connection;
		$query = "SELECT email from users where email = '{$email}'";

		$result = mysqli_query($connection, $query);

		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}

	function phoneExists($phone_num){
		global $connection;
		$query = "SELECT * from Customer where phone_num = '{$phone_num}'";

		$result = mysqli_query($connection, $query);

		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}

?>
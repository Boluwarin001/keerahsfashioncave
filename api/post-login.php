<?php


require_once "../inc/conn.php";

$errors=array();

function login($e){
  global $conn;
  $val=uniqid();
  $exppp=time()+34608000;
  setcookie('cook_id', $val, "$exppp", '/');
  $query = mysqli_query($conn, "UPDATE user_login SET cookie_id='$val', cookie_expiry='$exppp' WHERE email='$e'");
  // die();
	$_SESSION['email']=$e;
	echo 1;
}


// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%



if (post('email') and post('type')=='login') {

  $email = softSan(strtolower($_POST['email']));
  $email=filter_var($email, FILTER_SANITIZE_EMAIL);

  $password = md5(softSan($_POST['password']));

  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  $user_check_query = "SELECT * FROM user_login WHERE email='$email' AND password='$password'";
  $query = mysqli_query($conn, $user_check_query);
  
  if ($query->num_rows==1) {
        login($email);
  }else{
      array_push($errors, "Invalid Email/Password");
  }

}




// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


if (post('email') and post('type')=='register') {

  $first_name = post('first_name');
  $last_name = post('last_name');
  $country = post('country');
  $state = post('state');
  $city = post('city');
  $zip = post('zip');
  $address = post('address');
  $phone = post('phone');

  $email = softSan(strtolower($_POST['email']));
  $email=strtolower(filter_var($email, FILTER_SANITIZE_EMAIL));

  $password_1 = softSan($_POST['password']);
  $password_2 = softSan($_POST['confirm_password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone)) { array_push($errors, "Phone is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }

 

  // $username = preg_replace("/[^a-zA-Z0-9\s]/", "", $username);


  if ($password_1 != $password_2) {
  array_push($errors, "PASSWORDS DON'T MATCH");
  }

  $user_check_query = "SELECT * FROM user_login WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    $query = $conn->prepare("INSERT INTO user_login (email, password, last_login) VALUES(?, ?, ?, ?)");

    if (mysqli_query($conn, "INSERT INTO user_login (email, password, last_login) VALUES('$email', '$password', CURRENT_TIMESTAMP)")) {

      if(mysqli_query($conn, "INSERT INTO user_info (email, first_name, last_name, phone, country, state, city, zip, address) VALUES ('$email', '$first_name', '$last_name', '$phone', '$country', '$state', '$city', '$zip', '$address')") ){


          login($email);
        }

    }else{
      array_push($errors, "Could not login");
    }
  }

}



// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


foreach ($errors as $e) {
	echo $e.'<br>';
}

?>
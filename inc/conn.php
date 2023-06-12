<?php 


session_start();

$url='https://keerahsfashioncave.com/';


$shipping_fee = 0;

$shipping_fees = array(
	"Nigeria"=>0,
);



if ($_SERVER['SERVER_NAME']=='localhost') {
	$url='http://localhost/keerah/';
	$conn = new mysqli('localhost', 'root', '', 'kirio');
}else{
	$conn = new mysqli('localhost', 'keerahsf_root', 'n}]fPr55y-gb', 'keerahsf_db');
}


    
if (!isset($_SESSION['username']) or empty($_SESSION['username'])){

if (isset($_COOKIE['cook_id'])){
    $cookit=$_COOKIE['cook_id'];
    if($coksql=mysqli_query($conn,"SELECT email, cookie_expiry FROM user_login WHERE cookie_id='$cookit'")){

        
    if ($coksql->num_rows==1){
    $cookres = array();

    while($x=mysqli_fetch_assoc($coksql)){
    $cookres[]=$x;
        }              
    $email=$cookres[0]['email'];
    $expiry=$cookres[0]['cookie_expiry'];

    $time=time();
    if ($expiry>$time) {
      $last_date_cook = date("d M h:ia", time());
      $g = mysqli_query($conn, "UPDATE user_login SET last_login ='$last_date_cook' WHERE email='$email'");
      $_SESSION['email']=$email;
      }
        }
    }
}
}




 function logged_in($r=false){
 	global $url;

 	if (isset($_SESSION['email']) or !empty($_SESSION['email'])) {
 		return true;
 	}elseif($r==false){
 		return false;
  }elseif($r==true){
 		header("Location:".$url."register.php");
 		exit();
 	}
 }


function softSan($str){
	return filter_var($str, FILTER_SANITIZE_STRING);
}

function post($str, $null=false, $san=true){
	if (isset($_POST[$str]) and !empty($_POST[$str])) {
		if ($san==true) {
			return softSan($_POST[$str]);
		}else{
			return $_POST[$str];
		}
	}elseif ($null==true) {
		return '';
	}else{
		return false;
	}
}

function get($str, $null=false, $san=true){
	if (isset($_GET[$str]) and !empty($_GET[$str])) {
		if ($san==true) {
			return softSan($_GET[$str]);
		}else{
			return $_GET[$str];
		}
	}elseif ($null==true) {
		return '';
	}else{
		return false;
	}
}

function checkpost($e, $debug=false){
		$ret = true;
	foreach ($e as $a) {
		if (!post($a)){
			$ret = false;
			if ($debug) {
				echo $a;
			}
		}
	}	
		return $ret;
 }

 function show($e){
 	echo json_encode($e);
 	// return $e;
 }


function get_cart_count(){
	global $conn;
	global $_COOKIE;

	if (isset($_COOKIE['cart']) and !empty($_COOKIE['cart'])) {
		$cart_cookie = $_COOKIE['cart'];
	}else{
		$cart_cookie = uniqid();
    	$exppp=time()+30000;
      	setcookie('cart', $cart_cookie, "$exppp", '/');
	}

	$sql = mysqli_query($conn, "SELECT COUNT(*) FROM cart WHERE cookie='$cart_cookie'");
	return $count = mysqli_fetch_assoc($sql)['COUNT(*)'];

}

function getShippingFee($e){
	global $shipping_fees;

	return isset($shipping_fees[$e]) ? $shipping_fees[$e] : '0' ;
}



?>
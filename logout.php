<?php 
require "inc/conn.php";


if (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
	$sql = mysqli_query($conn, "UPDATE user_login SET cookie_id='#' WHERE email='$email'");
}





session_destroy();

setcookie("cook_id", "", time() - 3600);
header("Location: index.php");
exit();


 ?>
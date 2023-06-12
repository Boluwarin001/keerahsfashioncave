<?php 
	require "../inc/conn.php";

	// echo "<pre>";


    if (post('id')) {
        $id = post('id');

	if (isset($_COOKIE['cart']) and !empty($_COOKIE['cart'])) {
		$cart_cookie = $_COOKIE['cart'];
	}else{
		$cart_cookie = uniqid();
    	$exppp=time()+3000000;
      	setcookie('cart', $cart_cookie, "$exppp", '/');
	}

	$sql = mysqli_query($conn, "DELETE FROM cart WHERE cookie='$cart_cookie' AND id='$id'");

    }
?>
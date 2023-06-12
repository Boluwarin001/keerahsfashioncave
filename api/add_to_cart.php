<?php 
	require "../inc/conn.php";

	// echo "<pre>";


	if (post('id') and post('qty')) {
		$id = post('id');
		$qty = post('qty');

		if (isset($_COOKIE['cart']) and !empty($_COOKIE['cart'])) {
			$cart_cookie = $_COOKIE['cart'];
		}else{
			$cart_cookie = uniqid();
	    	$exppp=time()+30000;
	      	setcookie('cart', $cart_cookie, "$exppp", '/');
		}

		if(mysqli_query($conn, "INSERT INTO cart(cookie, item_id, qty) VALUES ('$cart_cookie', '$id', '$qty')")){
			echo 'OK';
		}


	}
 ?>
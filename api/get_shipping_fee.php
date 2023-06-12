<?php 
	require "../inc/conn.php";

	// echo "<pre>";


	if (post('country')) {
		$country = post('country');
		echo getShippingFee($country);
	}


 ?>
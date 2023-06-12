<?php 
	require "../inc/conn.php";

	// echo "<pre>";

	if (get('count')) {

		$products = array();

		$count  = get('count');
		$sql = "SELECT * FROM products LIMIT 0,$count";

		$query = mysqli_query($conn, $sql);


		while ($x=mysqli_fetch_assoc($query)) {
			$id = $x['id'];

			if (file_exists("../assets/images/product-images/$id.jpg")) {
				$x['featured-image'] = "$id.jpg";
			}else if (file_exists("../assets/images/product-images/$id.png")) {
				$x['featured-image'] = "$id.png";
			}else{
				$x['featured-image'] = "default.jpg";
			}


			$check = true;
			$no=1;
			while($check==true) {
				if (file_exists("../assets/images/product-images/$id-$no.jpg")) {
					$x['images'][]="$id-$no.jpg";
				}else{
					$check = false;
				}
				$no++;
			}

			$check = true;
			$no=1;
			while($check==true) {
				if (file_exists("../assets/images/product-images/$id-$no.png")) {
					$x['images'][]="$id-$no.png";
					$no++;
				}else{
					$check = false;
				}
				$no++;
			}


			$products[]=$x;
		}






		// &&&&&&&&&&&&&&&&&&%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		// &&&&&&&&&&&&&&&&&&%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%


		$y=0;
		while(isset($products[$y])){

			print_r($products[$y]);
				$y++;

			if (isset($products[$y])) {
			print_r($products[$y]);
			}
			echo "string";
	
				$y++;

		}


	}


 ?>
<?php 

	// require_once('../../inc/conn.php');

if (checkpost(array('name', 'price'))) {
	// echo '<pre>';
	// print_r($_POST);

	$pass = $redirect = false;

	$name = post('name', true);
	$description = post('description');
	$category = post('category');
	$old_price = post('old_price');
	$price = post('price');
	$stock = post('stock');
	$sizes = post('sizes');

	// echo 'dfdfd';

	$time=time();

	$tags='';
	if (!empty($_POST['tags'])) {
		$tags = implode(',', $_POST['tags']);
	}



		if($id=post('editlisting')){

			// $sql = "UPDATE products SET name='$name', description='$description', category='$category', old_price='$old_price', price='$price', tags='$tags', stock='$stock', sizes='$sizes' WHERE id='$id'";
			// if(mysqli_query($conn, $sql)){

			$stmt = $conn->prepare("UPDATE products SET name=?, description=?, category=?, old_price=?, price=?, tags=?, stock=?, sizes=? WHERE id=?");
			$stmt->bind_param("ssssssssi", $name, $description, $category, $old_price, $price, $tags, $stock, $sizes, $id);
			if($stmt->execute()){
				$msg[]="<b>Listing Updated!</b>";
				$pass=true;
			}else{
				$msg[]="Error updating listing";
			}

		}
		else{
			$stmt = $conn->prepare("INSERT INTO products (name, description, category, old_price, price, tags, stock, sizes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssssis", $name, $description, $category, $old_price, $price, $tags, $stock, $sizes);

			if($stmt->execute()){
				$id = $conn->insert_id;;
				$pass=true;
				$redirect = true;
				$msg[] = "<b>Listing Added</b>";
			}else{
				$msg[] ="Error adding listing". $query->error;
			}
		}


	if ($pass) {

    $check = true;
    $jpg_no=1;
    $images = array();
    while($check==true) {
        $loc="../product-images/$id-$jpg_no.jpg";
        if (file_exists($loc)) {
	        $jpg_no++;
        }else{
            $check = false;
        }
    }

    $check = true;
    $png_no=1;
    while($check==true) {
        $loc="../product-images/$id-$png_no.png";
        if (file_exists($loc)) {
	        $png_no++;
        }else{
            $check = false;
        }
    }



	if (isset($id)) {
		// print_r($_FILES);

		if (!empty($_FILES['uploaded_file']['name'][0])) {
		  $fileCount = count($_FILES['uploaded_file']['name']);
		  for ($i = 0; $i < $fileCount; $i++) {

		    // Validate the file
		    $filesize = $_FILES['uploaded_file']['size'][$i];
		    $filetmp = $_FILES['uploaded_file']['tmp_name'][$i];
		    $filetype = strtolower(pathinfo($_FILES['uploaded_file']['name'][$i], PATHINFO_EXTENSION));
		    if ($filesize < 10000000) {

		    	if ($filetype=='jpg' OR $filetype=='jpeg') {
		    		$filename = $id."-".$jpg_no.".jpg";
		    		$jpg_no++;
		    	}else if ($filetype=='png') {
		    		$filename = $id."-".$jpg_no.".png";
		    		$png_no++;
		    	}
				  $upload_path = '../product-images/';

				  $upload_file = $upload_path . $filename;

				  if (move_uploaded_file($filetmp, $upload_file)) {
				  	// ! potential file name clash
				  	// $files = $files.' '.$filename;
				  } else {
				    $msg[] = "There was an error uploading the file.";
				  }


				} else {
				    $msg[] = "File is greater than 10mb";
				  }

		    }
		}

	}

	if ($redirect) {
		header("Location: edit-listing?type=success&id=".$id);
		exit();
	}


	}


}



 ?>
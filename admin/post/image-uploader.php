<?php 

	require_once("../../inc/conn.php");


if (get('filename')) {
	$name=softSan(get('filename'));
	
	$url = "product-images/"; 
	$target_dir = "../../".$url;
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$target_file = $target_dir . $name .'.'. $imageFileType;
	// Check if image file is a actual image or fake image
	if(isset($_GET["image"])) {
	    $check = getimagesize($_FILES["file"]["tmp_name"]);
	    if($check !== false) {
	        // echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        $msg = array("status"=>false, "error"=> "File is not an image.");
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    $msg = array("status"=> false, "error"=>  "Sorry, file already exists.");
	    $uploadOk = 0;
	}
	// Check file size 2mb
	if ($_FILES["file"]["size"] > 2000000) {
	    $msg = array("status"=>false, "error"=>"Sorry, your file is too large.");
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $msg = array("status"=>false, "error"=>"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    // $msg = array("status"=>false, "error"=>"Sorry, your file was not uploaded.");
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
	        // $msg = array("status"=>true, "id"=>$name, "link"=>$url . $name.".".$imageFileType, "newname"=>uniqid());
	        $msg = array("status"=>true, "id"=>$name, "link"=>$url . $name.".".$imageFileType, "newname"=>uniqid());
	    } else {
	        $msg = array("status"=>false, "error"=>"Sorry, there was an error uploading your file.");
	    }
	}


}

if (post("deleteImage")) {
	$img = post("deleteImage");
	rename("../../product-images/$img","../../product-images/0.DELETED.".date('Y m d H m .').$img);
	echo 'yes';
	exit();
}


if (isset($msg)) {

	echo json_encode($msg);

}

 ?>
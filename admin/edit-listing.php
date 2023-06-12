<?php 
// require_once('post/functions.php');
// if (post('feature')) {
// 	print_r(post('feature'));
// 	exit();
// }

	require_once("../inc/conn.php");
	require_once("post/submit-listing.php");
	require_once("nav.php"); 

$edit=false;

if(get('id')){
	$editID=get('id');
}

if (get('type')=='success') {
	$msg[] = "<b>Listing Added Successfully</b>. <a href='../product?id=$editID' target='_blank'>View</a>";
}

if (isset($editID)) {


	if (!filter_var($editID, FILTER_VALIDATE_INT) === false) {

		$sql = "SELECT * FROM products WHERE id='$editID'";
		if($query = mysqli_query($conn, $sql)){

			while ($x=mysqli_fetch_assoc($query)) {
				$listings[]=$x;
			}

			$listing=$listings[0];
			$msg[] = "Editing Listing: ".$listing['id'];
			$edit = true;

		}else{
			$msg[]="Error getting listing from database";
		}
	}

}

function showList($e){
	global $edit;
	global $listing;
	if ($edit) {
		echo $listing[$e];
	}
}

?>
<style type="text/css">
  label{cursor: pointer;}
  .form-control{margin-bottom: 30px;}
</style>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php if ($edit) { echo "Edit";}else{echo "Add";} ?> Listing</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>


 		<?php 
 			if(isset($msg)){
 				?>
      <div class="alert alert-primary" role="alert">
      	<?php echo implode('<br>', $msg); ?></div>
      	<br>
 				<?php
 			}
 		 ?>



  <div class="container">
    <div class="row">

      <div class="col">


 		


 			
 		<form method="post" action="" enctype="multipart/form-data">

		<h2>Images</h2>

		<?php 
 				if($edit){
 		 ?>
		<h6>Previously Uploaded</h6>

		  <div id="uploaded-area">

 				<?php 

        $check = true;
        $no=1;
        $images = array();
        while($check==true) {
            $loc="../product-images/$editID-$no.jpg";
            if (file_exists($loc)) {
            	$images[]="$editID-$no.jpg";
            }else{
                $check = false;
            }
            $no++;
        }

        $check = true;
        $no=1;
        while($check==true) {
            $loc="../product-images/$editID-$no.png";
            if (file_exists($loc)) {
            	$images[]="$editID-$no.jpg";
              $no++;
            }else{
                $check = false;
            }
            $no++;
        }


        $no=1;
 					foreach ($images as $i) {
 						?>

		  	<img style="width: 200px" src="../product-images/<?php echo $i;?>" data-image="<?php echo $i; ?>" class="preview-image">
		  	<!-- <button type="text" class="deleteprev" onclick="delImg('<?php echo $i;?>', 'dv<?php echo $no; ?>')"><i class="fa fa-trash"></i></button> -->
 						<?php
            $no++;
		 					}?>



		  </div>
		  <br>
		  	<div class="btn btn-sm btn-danger" onclick="deleteImage()">Delete last Image</div>

		  <br>
		  <br>
		  <br>

				<?php
		 			}
 				?>


	  <h6>Upload New Images</h6>	

		<div id="upload-form">
			<div id="input-labels"></div>
			<br>
			<button type="button" id="add-image" class="btn btn-primary btn-sm">+ Add Image</button>

			<div class="clearfix"></div>
			<br>


		  <div id="preview-area">

		  </div>


		</div>



		<script type="text/javascript">


			let imageCount = 0; // Counter to generate unique identifiers for images and input tags

// Function to handle image preview and deletion
function handleImagePreview(event, imageId) {
  const previewContainer = document.getElementById("preview-area");
  const files = event.target.files;

  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const reader = new FileReader();

    reader.onload = function (e) {
      const img = document.createElement("img");
      img.src = e.target.result;
      img.id = `image-${imageId}`;

      const deleteButton = document.createElement("div");
      deleteButton.innerHTML = "<i class='fa fa-trash'></i> Delete";
      deleteButton.addEventListener("click", function () {
        const imageElement = document.getElementById(`image-${imageId}`);
        const inputElement = document.getElementById(`input-${imageId}`);
        
        inputElement.remove();
        imageElement.remove();
        deleteButton.remove();

      });

      previewContainer.appendChild(img);
      previewContainer.appendChild(deleteButton);
    };

    reader.readAsDataURL(file);
  }
}

// Event listener for file input change
function addFileInput() {
  const fileInput = document.createElement("input");
  const imageId = imageCount++; // Generate a unique identifier for the image and input tags
  fileInput.type = "file";
  fileInput.name = "uploaded_file[]";
  fileInput.id = `input-${imageId}`;
  fileInput.accept = "image/*";
  fileInput.addEventListener("change", function (event) {
    handleImagePreview(event, imageId);
  });

  const addImageButton = document.getElementById("add-image");
  // addImageButton.parentNode.insertBefore(fileInput, addImageButton);
  document.getElementById("input-labels").appendChild(fileInput);
}

// Event listener for adding an image input
const addImageButton = document.getElementById("add-image");
addImageButton.addEventListener("click", addFileInput);






		function deleteImage(){
			var lastImage = $("#uploaded-area img:last-child");
		  var deleteImage = lastImage.data("image");
		  console.log(lastImage);
		  $.post("post/image-uploader", {deleteImage: deleteImage}, function(result){
		  	lastImage.remove();
			});
		}

		</script>


 			<br>

 			<hr>

 			<br>
 			<br>
 			
 			<h6>Name</h6>
 			<input type="text" name="name" class="form-control" value="<?php showList('name');?>">

 			<br>
 			<h6>Description</h6>
 			<textarea class="form-control" style="height:200px" name="description"><?php showList('description');?></textarea>
 			<br>


 			<h6>Category</h6>
 			<input class="form-control" list="categories" name="category" value="<?php showList('category');?>">
 			<datalist id="categories">
	      <?php 
	          $sql2=mysqli_query($conn, "SELECT DISTINCT category FROM products ORDER BY category ASC");
	          while ($y=mysqli_fetch_assoc($sql2)) {
	       ?>
	 			<option value="<?php echo $y['category']; ?>">
	      <?php } ?>
 			</datalist>

 			<br>


 			<h6>Old Price</h6>
 			<input class="form-control" type="number" name="old_price" value="<?php showList('old_price');?>">

 		
 			<h6>Current Price*</h6>
 			<input class="form-control" type="number" name="price" value="<?php showList('price');?>" required>

 		
 			<h6>Stock</h6>
 			<input class="form-control" name="stock" value="<?php showList('stock');?>">
 		
 			<h6>Sizes</h6>
 			<input class="form-control" name="sizes" value="<?php showList('sizes');?>">

 			<div class="clear"></div>


 			<br>
 			<h6>Tags</h6>
 			<input type="" id="feature" class="form-control" style="width: 50%;margin-right: 10px">
 			<div class="add-btn" id="add-btn"><i class="fa fa-plus"></i> &nbsp;Add</div>

 			<br>
 			<div id="features">
 				<?php 
				$stuff_cn=1;
 				if ($edit) {
 					$features=explode(',', $listing['tags']);
 					foreach ($features as $f) {
 						?>
						<div class="product-feature" id="feature<?php echo $stuff_cn;?>"><?php echo $f; ?><i onclick="delFeat('<?php echo $stuff_cn; ?>')" >x</i></div><input type="checkbox" name="tags[]" value="<?php echo $f; ?>" id="fea_check<?php echo $stuff_cn;?>" style="display:none;" checked>
 						<?php
 						$stuff_cn++;
 					}
 				} ?>
 				<script type="text/javascript">
 					var stuff_cn = <?php echo $stuff_cn; ?>;
 				</script>
 				<!--  -->
			</div>

			<br>
			<br>


 		<?php if ($edit): ?>
 			<input type="hidden" style="display: none;" name="editlisting" value="<?php echo $listing['id'];?>">
 		<?php endif ?>

 		
 		<div class="clear"></div>

 		<br>

        <input type="submit" class="btn" style="background: #418bca;color: #fff;font-weight: bolder" value="PUBLISH LISTING">
        </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        </div>





      </div>
  </div>

    </main>
    <div class="clearfix"></div>



<?php require_once "footer.php"; ?>
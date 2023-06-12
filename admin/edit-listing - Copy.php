<?php 
// require_once('post/functions.php');
// if (post('feature')) {
// 	print_r(post('feature'));
// 	exit();
// }
	require_once("nav.php"); 
	require_once("post/submit-listing.php");

$edit=false;

if(get('id')){
	$editID=get('id');
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


 		
 			<h6>Images*</h6>
 			<div class="h2" style="color: red" id="imageErr"></div>
 			<br>
			<form id="data" method="post" enctype="multipart/form-data">
			  <input name="file" type="file" id="fileId" required/>
			  <div id="uploadBtn">+ Upload</div>
			  <progress id="progressBar" value="0" max="100"></progress>
			</form>
			<script type="text/javascript">var filename = "<?php echo uniqid(); ?>";</script>
			<br>
			<br>


 			<div id="imgPreview">
 				<?php 
 				if($edit){

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
            }else{
                $check = false;
            }
            $no++;
        }


        $no=1;
 					foreach ($images as $i) {

 						?>
					<div class="image-edit-box" id="dv<?php echo $no; ?>"><div class="image-edit-trash" onclick="delImg('<?php echo $i;?>', 'dv<?php echo $no; ?>')"><i class="fa fa-trash"></i></div><img class="image-edit-preview" src="../product-images/<?php echo $i;?>"></div>
 						<?php
            $no++;
		 					}
		 			}
 				?>
			</div>


 			
 		<form method="post" action="edit-listing.php">



<?php if (!get('edit')){ ?>
	    <p>Add Image</p>

		<div id="upload-form">
		  <div class="drop-area">
		    <input type="file" name="uploaded_file[]" multiple id="file-input">
		    <p>Drag and drop files here or click to select files</p>
		  </div>
		  <div id="preview-area"></div>
		</div>



		<script type="text/javascript">
		const form = document.getElementById("upload-form");
		const fileInput = document.getElementById("file-input");
		const previewArea = document.getElementById("preview-area");

		const handlePreview = (file) => {
  	if (file.type.match(/image.*/)) {
		    const reader = new FileReader();
		    reader.addEventListener("load", (e) => {
		      const previewImage = document.createElement("img");
		      previewImage.src = e.target.result;
		      previewImage.classList.add("preview-image");
		      const deleteButton = document.createElement("button");
			  deleteButton.classList.add("deleteprev");
		      deleteButton.innerHTML = "<i class='fa fa-trash'></i>";
		      deleteButton.addEventListener("click", () => {
		        previewArea.removeChild(previewImage);
		        deleteButton.remove();
		      });
		      previewArea.appendChild(previewImage);
		      previewArea.appendChild(deleteButton);
		    });
		    reader.readAsDataURL(file);
		  } else {
		    const fileInfo = document.createElement("div");
		    fileInfo.innerHTML = `${file.name} (${file.type})`;
		    fileInfo.classList.add("filetype");
		    const deleteButton = document.createElement("button");
		    deleteButton.innerHTML = "<i class='icofont icofont-trash'></i>";
		    deleteButton.addEventListener("click", () => {
		      previewArea.removeChild(fileInfo);
		      deleteButton.remove();
		    });
		    previewArea.appendChild(fileInfo);
		    previewArea.appendChild(deleteButton);
		  }
		};


		form.addEventListener("drop", (e) => {
		  e.preventDefault();
		  fileInput.files = e.dataTransfer.files;
		  const files = fileInput.files;
		  for (let i = 0; i < files.length; i++) {
		    handlePreview(files[i]);
		  }
		});

		form.addEventListener("dragover", (e) => {
		  e.preventDefault();
		});

		fileInput.addEventListener("change", () => {
		  const files = fileInput.files;
		  for (let i = 0; i < files.length; i++) {
		    handlePreview(files[i]);
		  }
		});

		</script>
<?php } ?>



 			<input type="hidden" name="featured_image" value="" id="featured_image" style="display: none;">
 			<div id="img_checks" style="display: none;">
 				<?php if ($edit) {
 				if (!empty($listing['images'])) {
 					$images = explode(';', $listing['images']);
 					foreach ($images as $i) {
 						$id = explode('/', $i)[3];
 						$id = explode('.', $id)[0];
 						?>
 						<input type="checkbox" name="images[]" value="<?php echo $i; ?>" id="img_check<?php echo $id;?>" style="display:none;" checked>
				<?php
		 				}
		 			}
 				} ?>
 			</div>
 			<div class="clearfix"></div>
 			<div class="clear"></div>

 			<br>
 			<br>
 			
 			<h6>Name</h6>
 			<input type="text" name="name" class="form-control" value="<?php showList('name');?>">

 			<br>
 			<h6>Description</h6>
 			<textarea class="form-control" name="description"><?php showList('description');?></textarea>
 			<br>


 			<h6>Old Price</h6>
 			<input class="form-control" type="number" name="old-price" value="<?php showList('old_price');?>">

 			


	 		<div class="clear"></div>
 			<br>
 			<h6>Price*</h6>
 			<input class="form-control" type="number" name="price" value="<?php showList('price');?>" required> <input type="checkbox" name="negotiable">Negotiable

 			<div class="clear"></div>
 			
 			<br>

 			<h6>Description*</h6>
 			<textarea class="form-control" style="height:200px;" name="description" required><?php echo showList('description'); ?></textarea>


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
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

		$sql = "SELECT * FROM listings WHERE id='$editID'";
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
	#nav-listings{background: #718626;}
</style>
<script type="text/javascript">
	$("#nav-listings").next('.nav-row-children').slideDown('fast');
	$("#nav-listings").children('.nav-caret').css("transform", "rotate(-90deg)");
</script>

 	<div class="body">
 	<div class="body-pad">
 		<?php 
 			if(isset($msg)){
 				?>
 		<div class="msg"><?php echo implode('<br>', $msg); ?></div>
 				<?php
 			}
 		 ?>


 		<br>
 		<div class="h1"><?php if ($edit) { echo "Edit";}else{echo "Add";} ?> Listing</div>


 		
 		<div class="edit-right">
 		<div class="edit-pad" style="padding-left: 0">
 			<div class="h2">Images*</div>
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
 				if (!empty($listing['images'])) {
 					$f = $listing['featured_image'];
 					$images = explode(';', $listing['images']);
 					foreach ($images as $i) {
 						$id = explode('/', $i)[3];
 						$id = explode('.', $id)[0];
 						?>
					<div class="image-edit-box" id="<?php echo $id; ?>"><div class="image-edit-trash" onclick="delImg('<?php echo $id;?>')"><i class="fa fa-trash"></i></div><div class="image-edit-preview" style="background:url(../<?php echo $i;?>) center;background-size:cover"></div><div class="set-featured-img <?php if($f==$i){echo 'setted-featured-img'; } ?> " onclick="setImg('<?php echo $i; ?>', '<?php echo $id; ?>')" id="set<?php echo $id;?>"><i class="fa fa-check"></i> &nbsp;Set as preview Image</div></div>
 						<?php
		 					}
		 				} 
		 			}
 				?>
<!--  			<div class="image-edit-box" id="imgPrev">
 				<div class="image-edit-trash" onclick="delImg()"><i class="fa fa-trash"></i></div>
 				<div class="image-edit-preview"></div>
 				<div class="set-featured-img" onclick="setImg('fdfdcji3in')">Set as main Image</div>
 			</div> -->



			</div>


 		</div>
 		</div>



 		<div class="edit-left">
 		<div class="edit-pad" style="padding-left: 0">
 			
 		<form method="post" action="edit-listing.php">

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

 			<div class="h2">Type*</div>
 			<select name="type" class="input1" style="font-weight: bolder;" required>
 				<option value="BUY">BUY</option>
 				<option value="RENT">RENT</option>
 			</select>
 			<br>
 			<br>
 			
 			<div class="h2">Name</div>
 			<input type="text" name="name" class="input1" value="<?php showList('name');?>">
 			<br>
 			<br>
 			<div class="h2">Address*</div>
 			<textarea class="input2" name="address" required><?php showList('address');?></textarea>
 			<br>
 			<br>
 			
 			<div class="h2">State*</div>
 			<select name="state" class="input1" required>
 			<option value="<?php showList('state');?>"><?php showList('state');?></option>
 			<option value="lagos">Lagos</option>
 			<option value="ibadan">Ibadan</option>
 			</select>
 			<br>
 			<br>
 			
 			<div class="h2">Location</div>
			<input type="text" name="lga" list="lgas" class="input1" autocomplete="off">
			<datalist id="lgas">
				<option value="<?php showList('lga');?>"><?php showList('lga');?></option>

			<?php 
				$sql="SELECT * FROM locations";
				$query=mysqli_query($conn, $sql);
				$agents=array();

				while ($x=mysqli_fetch_assoc($query)) {
					$agents[]=$x;
				}
				if ($agents!==array()) {
					foreach ($agents as $a) {?>
				<option value="<?php echo $a['lga'];?>"><?php echo $a['state'].' - '.$a['lga']; ?></option>
				<?php
						}
					}
				 ?>
			</datalist>

 			<br>
 			<br>

 			<div class="h2">Coordinates</div>
 			<br>
 			<div style="float: left;width: 40%;margin-right: 20px;">
 				Longitude
 				<input type="" name="long" class="input2" style="width: 90%" value="<?php showList('longitude');?>">
 			</div>
 			<div style="float: left;width: 45%">
 				Latitude
 				<input type="" name="lat" class="input2" style="width: 90%" value="<?php showList('latitude');?>">
 			</div>
 			<div class="clear"></div>

 			<br>
 			<br>
 			<br>


 			<div style="float: left;">
 			<div><i class="fa fa-bed"></i> &nbsp; No of Beds</div>
 			<input type="number" name="beds" class="input2" style="width: 120px;" value="<?php showList('beds');?>">
	 		</div>

	 		<div style="float: left;margin-left: 20px;">
 			<div><i class="fa fa-bathtub"></i> &nbsp;Bathrooms</div>
 			<input type="number" name="bathrooms" class="input2" style="width: 120px;" value="<?php showList('bathrooms');?>">
	 		</div>

	 		<div style="float: left;margin-left: 20px;">
 			<div><i class="fa fa-square-o"></i> &nbsp;Area sqm</div>
 			<input type="number" name="area" class="input2" style="width: 120px;" value="<?php showList('area_sqm');?>">
	 		</div>


	 		<div class="clear"></div>
 			<br>
 			<div class="h2">Cost*</div>
 			<input class="input2" type="number" name="cost" value="<?php showList('cost');?>" required> <input type="checkbox" name="negotiable">Negotiable

 			<div class="clear"></div>
 			<br>
 			<div class="h2">Description*</div>
 			<textarea class="input2" style="height:200px;" name="description" required><?php echo showList('description'); ?></textarea>


 			<br>
 			<div class="h2">Features*</div>
 			<input type="" id="feature" class="input2" style="width: 50%;margin-right: 10px">
 			<div class="add-btn" id="add-btn"><i class="fa fa-plus"></i> &nbsp;Add</div>

 			<br>
 			<div id="features">
 				<?php 
				$stuff_cn=1;
 				if ($edit) {
 					$features=explode(';', $listing['features']);
 					foreach ($features as $f) {
 						?>
						<div class="product-feature" id="feature<?php echo $stuff_cn;?>"><?php echo $f; ?><i onclick="delFeat('<?php echo $stuff_cn; ?>')" >x</i></div><input type="checkbox" name="features[]" value="<?php echo $f; ?>" id="fea_check<?php echo $stuff_cn;?>" style="display:none;" checked>
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
			<div class="h2">Agent*</div>
			<br>
			<select name="agent">

				<?php if ($edit): ?>
				<option value="<?php echo $listing['agent']; ?>"><?php echo getAgent($listing['agent'])['agent_name']; ?></option>
				<?php endif ?>

				<?php if (!$edit): ?>
				<option> -- Select Agent -- </option>
				<?php endif ?>

				<?php
				$sql="SELECT * FROM agents";
				$query=mysqli_query($conn, $sql);
				$agents=array();

				while ($x=mysqli_fetch_assoc($query)) {
					$agents[]=$x;
				}
				if ($agents!==array()) {
					foreach ($agents as $a) {
						?>
				<option value="<?php echo $a['id'] ?>"><?php echo $a['agent_name']; ?></option>
				<?php } } ?>

			</select>

			<br>
			<br>

 		</div>
 		</div>

 		<?php if ($edit): ?>
 			<input type="hidden" style="display: none;" name="editlisting" value="<?php echo $listing['id'];?>">
 		<?php endif ?>

 		
 		<div class="clear"></div>

 		<br>
 		<?php if ($edit) {?>
 		<input type="submit" name="" value="UPDATE" class="submit-product">
		<?php }else{ ?>
 		<input type="submit" name="" value="SUBMIT" class="submit-product">
		<?php } ?>



	 	</form>

 	</div>
 	</div>
 	<!-- end body -->

	<script src="admin.js"></script>

 </body>

 </html>
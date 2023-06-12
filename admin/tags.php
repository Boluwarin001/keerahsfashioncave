<?php 


require_once("nav.php"); 


	if (post('tag')) {
		$tag = post('tag');
		$listings = post('listings', true);
		$url = post('blog_url', true);

		if ($listings=='') {
			$list_data=serialize(array());
		}else{
			$listings_array=explode(',', $listings);
			$list_data=serialize($listings_array);
		}

		if (post('edit_id')) {
			$edit_id=post('edit_id');
			$query = $conn->prepare("UPDATE tags SET tag_name=?, listings=?, blog_url=? WHERE id=$edit_id");
			$query->bind_param("sss", $tag, $list_data, $url);
			if($query->execute()){
				$msg = "TAG edited";
			}
		}

		else{
			$query = $conn->prepare("INSERT INTO tags (tag_name, listings, blog_url) VALUES (?,?,?)");
			$query->bind_param("sss", $tag, $list_data, $url);
			if($query->execute()){
				$msg = "TAG added";
			}
		}


	}

	if (get('del')){
		$id = get('del');
			if (!filter_var($id, FILTER_VALIDATE_INT) === false) {
				$sql="DELETE FROM tags WHERE id=$id";
				if ($query=mysqli_query($conn, $sql)){
					$msg = "Tag has been deleted";
				}
			}
	}

?>

<style type="text/css">	
	#nav-data{background: #718626;}
	.td-pad a{text-decoration: underline;}
	.edit{cursor: pointer;}
	.formsubmit{max-width: 80%;font-size: 10px !important;padding: 5px 10px;cursor: pointer;}
	textarea{max-width: 80%;height: 100px;margin-top: 0}
	.row-hide{display: none;}
</style>

<script type="text/javascript">
	$("#nav-data").next('.nav-row-children').slideDown('fast');
	$("#nav-data").children('.nav-caret').css("transform", "rotate(-90deg)");
</script>

 	<div class="body">
 	<div class="body-pad">


 		<div class="msg" id="sure" style="color: red;"></div>

 		<div class="agents-page">
 		<?php 
 			if(isset($msg)){
 				?>
 		<div class="msg"><?php echo $msg; ?></div>
 				<?php
 			}
 		 ?>
 		<div class="h1"><i class="fa fa-tag"></i> &nbsp;Tags</div>

 		<div class="location-left">
 		<div class="edit-pad" style="padding-left: 0">

 			<form method="post" action="tags.php">
	 		<div class="h2">Add Tag</div>
	 		<input type="" name="tag" class="input1" placeholder="Tag Name" required>

 			<br>
 			<br>
 			<div class="h2">Listings</div>
 			<textarea class="input2" style="height:100px;width: 90%" name="listings" placeholder="Listing ID Separated by comma"></textarea>
 			<br>
 			<br>
	 		<div class="h2">Blog Url</div>
	 		<input type="" name="blog_url" class="input1" placeholder="Wordpress Link">
	 		<br>
	 		<br>
	 		<br>

	 		<input type="submit" name="" value="ADD" class="submit-product" style="width: 200px">
		 	</form>

	 	</div>
	 	</div>

	 	<div class="location-right">
 		<div class="edit-pad">
 			<br>

	 		<div class="table">
			<div class="table-pad">

				<div class="table-row">
 				<div class="td td-10"><div class="td-pad">Edit</div></div>
				<div class="td td-25"><div class="td-pad">Tag Name</div></div>
				<div class="td td-35"><div class="td-pad">Listings</div></div>
				<div class="td td-25"><div class="td-pad">Blog URL</div></div>
				<div class="td td-5"><div class="td-pad">x</div></div>

				<div class="clear"></div>
				</div>

			<?php 
				$sql="SELECT * FROM tags";
				$query=mysqli_query($conn, $sql);
				$agents=array();

				while ($x=mysqli_fetch_assoc($query)) {
					$agents[]=$x;
				}
				if ($agents!==array()) {
					foreach ($agents as $a) {
						$listings=unserialize($a['listings']);
					?>

				<div class="table-row row-view" id="view<?php echo $a['id'];?>">
 				<div class="td td-10">
 					<div class="td-pad">
 						<div class="edit" onclick="editForm(<?php echo $a['id'];?>)"><i class="fa fa-edit"></i></div>
 					</div>
 				</div>
				<div class="td td-25"><div class="td-pad"><?php echo $a['tag_name']; ?></div></div>
				<div class="td td-35"><div class="td-pad"><?php 
				foreach ($listings as $l) {echo "<a href='#'>".$l."</a>, &nbsp;";}
				 ?></div></div>
				<div class="td td-25"><div class="td-pad"><?php echo $a['blog_url']; ?></div></div>
				<div class="td td-5"><div class="td-pad">
				<span class="delagent" data-name="<?php echo $a['tag_name']; ?>" onclick="deleteAgent(<?php echo $a['id']?>)"><i class="fa fa-trash" style="font-size: 18px !important"></i></span></div></div>

				<div class="clear"></div>
				</div>

				<div class="table-row row-hide" id="form<?php echo $a['id'];?>">
 				<div class="td td-10">
 					<div class="td-pad">
 						<div class="edit" onclick="cancelForm(<?php echo $a['id'];?>)">x</div>
 					</div>
 				</div>
				<form method="post" action="tags.php">
				<input type="hidden" style="display: none" value="<?php echo $a['id'];?>" name="edit_id">
				<div class="td td-25"><div class="td-pad">
					<textarea name="tag"><?php echo $a['tag_name']; ?></textarea></div></div>
				<div class="td td-30"><div class="td-pad">
				<textarea name="listings"><?php echo implode(',', $listings);?></textarea>
				</div></div>
				<div class="td td-25"><div class="td-pad">
					<textarea name="blog_url"><?php echo $a['blog_url']; ?></textarea></div></div>
				<div class="td td-10"><div class="td-pad"><input class="formsubmit" type="submit" value="SUBMIT"></div></div>
				</form>
				<div class="clear"></div>
				</div>

						<?php
						}
					}
				 ?>




			</div>
			</div>


 		</div>
 		</div>


 		<div class="clear"></div>
	 	</div>


 	</div>
 	</div>

 	<script type="text/javascript">
 		function editForm(e){
 			$("#view"+e).slideUp(300);
 			$("#form"+e).slideDown(300);
 		}
 		function cancelForm(e){
 			$("#form"+e).slideUp(300);
 			$("#view"+e).slideDown(300);
 		}

	 	function deleteAgent(e){
	 		var name = $(this).attr('data-name');
	 		console.log(name);
	 		$('#sure').innerHTML= $('#sure').html("Are you sure you want to delete tag? Listings will not be deleted. <br><br> <span onclick='cancelDel()'>No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='?del="+e+"'><b>Yes</b></a>");
	 		$('.agents-page').hide();
	 		$('#sure').show();
	 	}

	 	function cancelDel(){
	 		$('#sure').hide();
	 		$('.agents-page').show();
	 	}
 	</script>



 </body>

 </html>
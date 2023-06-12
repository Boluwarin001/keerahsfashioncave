<?php 


require_once("nav.php"); 

	if (post('lga') and post('state')) {
		$lga = post('lga');
		$state = post('state');
		$blog_link = post('link', true);

		$query = $conn->prepare("INSERT INTO locations (state, lga, blog_link) VALUES (?,?,?)");
		$query->bind_param("sss", $state, $lga, $blog_link);
		if($query->execute()){
			$msg = "Location added";
		}
	}

	if (get('del')){
		$id = get('del');
			if (!filter_var($id, FILTER_VALIDATE_INT) === false) {
				$sql="DELETE FROM locations WHERE id=$id";
				if ($query=mysqli_query($conn, $sql)){
					$msg = "Location has been deleted";
				}
			}
	}

?>

<style type="text/css">	
	#nav-data{background: #718626;}
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
 		<div class="h1"><i class="fa fa-globe"></i> &nbsp;Locations</div>

 		<div class="location-left">
 		<div class="edit-pad" style="padding-left: 0">

 			<form method="post" action="locations.php">
	 		<div class="h2">Add Location</div>
	 		<input type="" name="lga" class="input1" placeholder="Location Name" required>

	 		<br>
	 		<br>
	 		<div class="h2">State</div>
	 		<br>	
	 		<select name="state" required>
	 			<option value="lagos">Lagos</option>
	 			<option value="oyo">Oyo</option>
	 		</select>
	 		<br>
	 		<br>
	 		<div class="h2">Blog link</div>
	 		<input type="" name="link" class="input1" placeholder="Copy and paste wordpress url">
	 		<br>
	 		<br>
	 		<br>

	 		<input type="submit" name="" value="ADD Location" class="submit-product">
		 	</form>

	 	</div>
	 	</div>

	 	<div class="location-right">
 		<div class="edit-pad">
 			<br>

	 		<div class="table">
			<div class="table-pad">

				<div class="table-row">
				<div class="td td-5"><div class="td-pad">&nbsp;</div></div>
				<div class="td td-30"><div class="td-pad">Location Name</div></div>
				<div class="td td-20"><div class="td-pad">State</div></div>
				<div class="td td-40"><div class="td-pad">Blog URL</div></div>
				<div class="td td-5"><div class="td-pad">x</div></div>

				<div class="clear"></div>
				</div>

			<?php 
				$sql="SELECT * FROM locations";
				$query=mysqli_query($conn, $sql);
				$agents=array();

				while ($x=mysqli_fetch_assoc($query)) {
					$agents[]=$x;
				}
				if ($agents!==array()) {
					foreach ($agents as $a) {
					?>

				<div class="table-row">
				<div class="td td-5"><div class="td-pad">&nbsp;</div></div>
				<div class="td td-30"><div class="td-pad"><?php echo $a['lga']; ?></div></div>
				<div class="td td-20"><div class="td-pad"><?php echo $a['state']; ?></div></div>
				<div class="td td-40"><div class="td-pad"><?php echo $a['blog_link']; ?></div></div>
				<div class="td td-5"><div class="td-pad">
				<span class="delagent" data-name="<?php echo $a['lga']; ?>" onclick="deleteAgent(<?php echo $a['id']?>)"><i class="fa fa-trash" style="font-size: 18px !important"></i></span></div></div>

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
 	function deleteAgent(e){
 		var name = $(this).attr('data-name');
 		console.log(name);
 		$('#sure').innerHTML= $('#sure').html("Are you sure you want to delete lga? <br><br> <span onclick='cancelDel()'>No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='?del="+e+"'><b>Yes</b></a>");
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
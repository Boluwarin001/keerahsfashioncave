<?php 




	// require_once("../inc/conn.php");
	require_once("nav.php"); 
	require_once("post/submit-listing.php");


	// $tags_query=mysqli_query($conn, "SELECT * FROM tags");	
	// while ($y=mysqli_fetch_assoc($tags_query)) {
	// 	$tags[]=$y;
	// }

	function checktag($e){
		global $tags;
		$pings=array();
		foreach ($tags as $t) {
			$l_array=unserialize($t['listings']);
			if (in_array($e, $l_array)) {
				$pings[]=" ".$t['tag_name']." ";
			}
		}

		return implode(',', $pings);
	}

	if (get('del')){
		$id = get('del');
			if (!filter_var($id, FILTER_VALIDATE_INT) === false) {
				$sql="DELETE FROM listings WHERE id=$id";
				if ($query=mysqli_query($conn, $sql)){
					$msg = "Listing has been deleted";
				}
			}
	}

?>
<style type="text/css">
	img{max-width: 50px}
	a{color: inherit;}
</style>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    	<br>
    	<br>
 		<h3><i class="fa fa-home"></i> &nbsp;Listings</h3>

 		<div class="msg" id="sure" style="color: red;"></div>

 		<div class="agents-page">

 		<br>
 		<br>
 		<br>
        <div class="table-responsive">
          <table class="table">

              <thead>
                <tr>
 				<td>#List ID</td>
 				<td>Edit</td>
 				<td>Image</td>
 				<td>Title</td>
 				<td>Category</td>
 				<!-- <td>Description</td> -->
 				<td>Stock</td>
 				<td>Price</td>
 				<td>Orders</td>
 				<!-- <td>tags</td> -->
 				<!-- <td><i class="fa fa-eye"></i></td> -->
 				<!-- <td><i class="fa fa-heart"></i></td> -->
 				<td>visible</td>
 				<td>x</td>
	 			</tr>
	 		</thead>
 			
 			<?php 

 			$sql = "SELECT * FROM products";
 			$query = mysqli_query($conn, $sql);

			while ($x=mysqli_fetch_assoc($query)) {
				$listing[]=$x;
			}

			foreach ($listing as $i) {

			$id = $i['id'];
			if (file_exists("../product-images/$id-1.jpg")) {
				$img = "../product-images/$id-1.jpg";
			}else if (file_exists("../product-images/$id-1.png")) {
				$img = "../product-images/$id-1.png";
			}else{
				$img = "../assets/images/default.jpg";
			}


 			 ?>
 			<tr>
 				<td><?php echo $i['id']; ?></td>
 				<td><a href="edit-listing.php?id=<?php echo $i['id'] ?>"><div class="edit"><i class="fa fa-edit"></i></div></a></td>

 				<td><img src="<?php echo $img; ?>"></td>

 				<td><a target="_blank" href="../product.php?id=<?php echo $i['id']; ?>"><?php echo $i['name']; ?> <i class="fa fa-external-link" style="font-size: 10px !important"></i></a></td>

 				<td><?php echo $i['category']; ?></td>

 				<!-- <td><?php echo $i['description']; ?></td> -->

 				<td><?php echo $i['stock']; ?></td>

 				<td><?php echo $i['price']; ?></td>

 				<!-- <td><?php //echo checktag($i['id']);?></td> -->
 				
 				<td><?php echo $i['orders']; ?></td>

 				<!-- <td><?php echo $i['views']; ?></td> -->
 				
 				<!-- <td><?php echo $i['likes']; ?></td> -->
 				
 				<td><?php if ($i['hidden']==0){echo '<i class="fa fa-eye"></i>';} else{echo 'not visible';} ?></td>


 				<td><soan style="color: red;font-weight: bolder;cursor: pointer;" onclick="delListing(<?php echo $i['id']; ?>)"><i class="fa fa-trash" style="font-size: 18px !important"></i></soan></td>


 			</tr>
 		<?php } ?>
 			

 		</table>
 		</div>

 		<div class="clear"></div>

	 	</div>
<br>
<br>
<br>
<br>
</main>


	<script type="text/javascript">
	 	function delListing(e){
	 		var name = $(this).attr('data-name');
	 		console.log(name);
	 		$('#sure').innerHTML= $('#sure').html("Are you sure you want to delete listing? <br><br> <span onclick='cancelDel()'>No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='?del="+e+"'><b>Yes</b></a>");
	 		$('.agents-page').hide();
	 		$('#sure').show();
	 	}

	 	function cancelDel(){
	 		$('#sure').hide();
	 		$('.agents-page').show();
	 	}
	 </script>

<?php require "footer.php"; ?>
<?php 




	require_once("nav.php"); 


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
 				<td>Email</td>
 				<td>Last login</td>
 				<td>Join date</td>
	 		</thead>
 			
 			<?php 

 			$sql = "SELECT * FROM user_login";
 			$query = mysqli_query($conn, $sql);

			while ($x=mysqli_fetch_assoc($query)) {
				$listing[]=$x;
			}

			foreach ($listing as $i) {

 			 ?>
 			<tr>
 				<td><?php echo $i['id']; ?></td>

 				<td><?php echo $i['email']; ?></td>
 				<td><?php echo $i['last_login']; ?></td>
 				<td><?php echo $i['join_date']; ?></td>


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
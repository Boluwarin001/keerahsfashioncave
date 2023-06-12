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
 		<h3><i class="fa fa-home"></i> &nbsp;Orders</h3>

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
 				<td>View</td>
 				<td>Email</td>
 				<td>Full name</td>
 				<td>Status</td>
 				<td>Total Price</td>
 				<td>Cart</td>
 				<td>Shipping</td>
 				<td>Payment Method</td>
 				<td>Time added</td>
 				<td>Order Notes</td>
	 		</thead>
 			
 			<?php 

 			$sql = "SELECT * FROM orders";
 			$query = mysqli_query($conn, $sql);

			while ($x=mysqli_fetch_assoc($query)) {
				$listing[]=$x;
			}

			foreach ($listing as $i) {

 			 ?>
 			<tr>
 				<td><?php echo $i['id']; ?></td>
 				<td><a href="order?id=<?php echo $i['id']; ?>"><i class="fa fa-eye"></i></a></td>

 				<td><a href="user?email=<?php echo $i['email']; ?>"><?php echo $i['email']; ?></a></td>
 				<td><?php echo $i['full_name']; ?></td>
 				<td><?php echo $i['status']; ?></td>
 				<td><?php echo $i['total']; ?></td>
 				<td><?php 
 				$cart = json_decode($i['cart']); 
 				foreach($cart as $c){
 					echo "$c[0] ($c[2]),<br>";
 				}
 			?></td>
 				<td><?php echo $i['shipping']; ?></td>
 				<td><?php echo $i['payment_method']; ?></td>
 				<td><?php echo $i['time_added']; ?></td>
 				<td><?php echo $i['order_notes']; ?></td>


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
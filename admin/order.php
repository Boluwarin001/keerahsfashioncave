<?php 




	require_once("nav.php"); 

 			
 			$id = get('id');

 			$sql = "SELECT * FROM orders WHERE id='$id'";
 			$query = mysqli_query($conn, $sql);

			$u=mysqli_fetch_assoc($query);


?>
<style type="text/css">
	img{max-width: 50px}
	a{color: inherit;}
</style>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    	<br>
    	<br>
 		<h3><i class="fa fa-home"></i> &nbsp;Order</h3>

 		<div class="msg" id="sure" style="color: red;"></div>

 		<div class="agents-page">

 		<br>
 		<br>
 		<br>
        <div class="table-responsive">
          <table class="table">

              <thead>
                <tr>
                	<td>Email</td>
                	<td><a href="user?email=<?php echo $u['email']; ?>"><?php echo $u['email']; ?></a></td>
                </tr>
			 		</thead>
			 		<tbody>
						 		<tr>
						 			<td>Status</td>
						 			<td><?php echo $u['status'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Total Amount</td>
						 			<td><?php echo $u['total'] ?></td>
						 		</tr> 		
						 		<tr>
						 			<td>Order Notes</td>
						 			<td><?php echo $u['order_notes'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Cart</td>
						 			<td><?php 
							 				$cart = json_decode($u['cart']); 
							 				foreach($cart as $c){
							 					echo "$c[0] ($c[2]) $$c[1],<br>";
							 				} ?>
 					
					 				</td>
						 		</tr> 			
						 		<tr>
						 			<td>Shipping</td>
						 			<td><?php echo $u['shipping'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Payment Method</td>
						 			<td><?php echo $u['payment_method'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Time Added</td>
						 			<td><?php echo $u['time_added'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Full Name</td>
						 			<td><?php echo $u['full_name'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Phone</td>
						 			<td><?php echo $u['phone'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Country</td>
						 			<td><?php echo $u['country'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>State</td>
						 			<td><?php echo $u['state'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>City</td>
						 			<td><?php echo $u['city'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Zip</td>
						 			<td><?php echo $u['zip'] ?></td>
						 		</tr> 	
						 		<tr>
						 			<td>Address</td>
						 			<td><?php echo $u['address'] ?></td>
						 		</tr> 	
						 		<tr>
						 			<td>Company</td>
						 			<td><?php echo $u['company'] ?></td>
						 		</tr> 			
			 			

			 		</tbody>
 		</table>
 		</div>

 		<div class="clear"></div>

	 	</div>
<br>
<br>
<br>
<br>
</main>

<?php require "footer.php"; ?>
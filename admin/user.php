<?php 




	require_once("nav.php"); 

 			
 			$email = get('email');

 			$sql = "SELECT * FROM user_info WHERE email='$email'";
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
 		<h3><i class="fa fa-home"></i> &nbsp;User</h3>

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
                	<td><?php echo $u['email']; ?></td>
                </tr>
			 		</thead>
			 		<tbody>
						 		<tr>
						 			<td>First Name</td>
						 			<td><?php echo $u['first_name'] ?></td>
						 		</tr> 			
						 		<tr>
						 			<td>Last Name</td>
						 			<td><?php echo $u['last_name'] ?></td>
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
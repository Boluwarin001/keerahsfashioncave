<?php 
		
		require_once("nav.php"); 


		if (post('name')) {
			$agent_name = post('name');
			$agent_number = post('number', true);
			$agent_email = post('email', true);
			$agent_hours = post('hours', true);
			$agent_pic_url = post('pic_url', true);
			$agent_url = post('url', true);


			if (post('edit_id')) {
				$edit_id=post('edit_id');
				$query = $conn->prepare("UPDATE agents SET agent_name=?, agent_number=?, agent_email=?, agent_hours=?, agent_pic_url=?, agent_url=? WHERE id=$edit_id");
				$query->bind_param("ssssss", $agent_name, $agent_number, $agent_email, $agent_hours, $agent_pic_url, $agent_url);
				if($query->execute()){
					$msg = "Agent Edited!";
				}
			}
			else{
				$query = $conn->prepare("INSERT INTO agents (agent_name, agent_number, agent_email, agent_hours, agent_pic_url, agent_url) VALUES (?,?,?,?,?,?)");
				$query->bind_param("ssssss", $agent_name, $agent_number, $agent_email, $agent_hours, $agent_pic_url, $agent_url);
				if($query->execute()){
					$msg = "Agent added successfully";
				}
			}
		}

		if (get('del')){
			$id = get('del');
				if (!filter_var($id, FILTER_VALIDATE_INT) === false) {
					$sql="DELETE FROM agents WHERE id=$id";
					if ($query=mysqli_query($conn, $sql)){
						$msg = "Agent has been deleted";
					}
				}
		}

?>

<style type="text/css">	
	#nav-data{background: #718626;}
	.td-pad a{text-decoration: underline;}
	.edit{cursor: pointer;}
	.row-hide{display: none;}
	.formsubmit{max-width: 80%;font-size: 10px !important;padding: 5px 10px;cursor: pointer;}
	textarea{max-width: 80%;min-height: 4em;margin-top: 0;font-size: 14px !important}
	table{font-size: 14px !important}
	td{padding: 0}
	.form-control{border-color: #333;}
</style>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    	<br>
    	<br>

        <h1 class="h2"><i class="fa fa-user"></i> &nbsp; Agents</h1>



 		<div class="msg" id="sure" style="color: red;"></div>

 		<div class="agents-page">
 		<?php 
 			if(isset($msg)){
 				?>
 		<br>
      <div class="alert alert-primary" role="alert">
      	<?php echo $msg; ?></div>
 				<?php
 			}
 		 ?>

 		<br>

        <div class="table-responsive">
          <table class="table table-sm">

              <thead>
                <tr>
			<th>Edit</th>
			<th>Pic</th>
			<th>Agent Name</th>
			<th>Number</th>
			<th>Email</th>
			<th>Hours</th>
			<th>Wordpress Url</th>
			<th>x</th>

				</tr>
			</thead>

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

				<tr class="table-row row-view" id="view<?php echo $a['id'];?>">
				<td>
					<div class="edit" onclick="editForm(<?php echo $a['id'];?>)"><i class="fa fa-edit"></i></div>
				</td>

				<td>
					<div class="agent-pic" style="background: #333 url(<?php echo $a['agent_pic_url']; ?>) center no-repeat;background-size: cover;"></div>
				</td>

				<td><?php echo $a['agent_name']; ?></td>
				<td><?php echo $a['agent_number']; ?></td>
				<td><?php echo $a['agent_email']; ?></td>
				<td><?php echo $a['agent_hours']; ?></td>
				<td><?php echo $a['agent_url']; ?></td>
				<td>
					<span class="delagent" data-name="<?php echo $a['agent_name']; ?>" onclick="deleteAgent(<?php echo $a['id']?>)">
						<i class="fa fa-trash" style="font-size: 18px !important"></i>
					</span>
				</td>
				</tr>

			<tr class="table-row row-hide" id="form<?php echo $a['id'];?>">
				<td>
					<div class="td-pad">
						<div class="edit" onclick="cancelForm(<?php echo $a['id'];?>)">x</div>
					</div>
				</td>
			<form method="post" action="agents.php">
			<input type="hidden" style="display: none" value="<?php echo $a['id'];?>" name="edit_id">

			<td>
			<textarea name="pic_url"><?php echo $a['agent_pic_url']; ?></textarea>
			</td>

			<td><textarea name="name"><?php echo $a['agent_name']; ?></textarea></td>
			<td><textarea name="number"><?php echo $a['agent_number']; ?></textarea></td>
			<td><textarea name="email"><?php echo $a['agent_email']; ?></textarea></td>
			<td><textarea name="hours"><?php echo $a['agent_hours']; ?></textarea></td>
			<td><textarea name="url"><?php echo $a['agent_url']; ?></textarea></td>

			<td><input class="formsubmit" type="submit" value="SUBMIT"></td>
			</form>

			</tr>
					<?php
					}
				}
			 ?>

		</table>
 		</div>

 		<br>
 		<br>
 		<br>
 		<form method="post" action="agents.php">
 		<h3>Add Agent</h3>
 		<br>

 		<div class="row">
 		<div class="col-lg-5">

 		<h5>Agent Name*</h5>
 		<br>
 		<input type="" name="name" class="form-control">

 		<br>
 		<br>

 		<h5>Agent Number</h5>
 		<br>
 		<input type="" name="number" class="form-control">

 		<br>
 		<br>

 		<h5>Agent Email</h5>
 		<br>
 		<input type="" name="email" class="form-control">

 		<br>
 		<br>

 		<h5>Agent hours</h5>
 		<br>
 		<input type="" name="hours" class="form-control">

 		<br>
 		<br>

 		<h5>Agent Wordpress Link</h5>
 		<br>
 		<input type="" name="url" class="form-control">

 		<br>
 		<br>

 		<h5>Agent Pic url</h5>
 		<br>
 		<input type="" name="pic_url" class="form-control">

 		<br>
 		<br>
 		<br>
 		<br>
 		<input type="submit" name="" value="SUBMIT" class="btn btn-primary">
	 	</div>
		</div>

		<br>
		<br>
		<br>
	 	
	 	</form>
 		<div class="clear"></div>
	 	</div>


 	</div>
 	</div>

 </body>
 <script type="text/javascript">
 		function editForm(e){
 			// $("#view"+e).slideUp(300);
 			// $("#form"+e).slideDown(300);
 			$("#view"+e).hide();
 			$("#form"+e).show();

 		}
 		function cancelForm(e){
 			$("#form"+e).hide();
 			$("#view"+e).show();
 		}

 	function deleteAgent(e){
 		var name = $(this).attr('data-name');
 		console.log(name);
 		$('#sure').innerHTML= $('#sure').html("Are you sure you want to delete agent? <br><br> <span onclick='cancelDel()'>No</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='?del="+e+"'><b>Yes</b></a>");
 		$('.agents-page').hide();
 		$('#sure').show();
 	}

 	function cancelDel(){
 		$('#sure').hide();
 		$('.agents-page').show();
 	}
 </script>

 </html>
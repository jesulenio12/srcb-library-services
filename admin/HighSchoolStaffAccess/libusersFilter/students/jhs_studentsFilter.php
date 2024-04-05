<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$gender = $_POST['gender'];
		$yearLevel = $_POST['yearLevel'];
		$progtrack = $_POST['progtrack'];
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'High School Library' && departmentType = 'Junior High School Department' && userType = 'Student' && gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND progtrack LIKE '$progtrack%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
			<td align="center" class="noprint">
				<?php require_once ('delete-confirm.php');?>
				<form method="POST" action="jhs_chkboxcode.php" style="display:inline">
					<input type="hidden" name="delete" value="<?php echo $fetch['id'];  ?>">
					<button class="btn7" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Confirm Deletion">
						<i class="glyphicon glyphicon-trash"></i>
					</button>
				</form>
			</td>
			<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
			<td>
				<?php echo $fetch['firstname']?>
				<?php echo $fetch['lastname']?>
			</td>
			<td><?php echo $fetch['gender']?></td>
			<td><?php echo $fetch['yearLevel']?></td>
			<td><?php echo $fetch['classSection']?></td>
		</tr>
	<?php
				}
			}
			
		}
	
	
	else{
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'High School Library' && departmentType = 'Junior High School Department' && userType = 'Student' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td align="center" class="noprint">
			<?php require_once ('delete-confirm.php');?>
			<form method="POST" action="jhs_chkboxcode.php" style="display:inline">
				<input type="hidden" name="delete" value="<?php echo $fetch['id'];  ?>">
				<button class="btn7" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Confirm Deletion">
					<i class="glyphicon glyphicon-trash"></i>
				</button>
			</form>
		</td>
		<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
		<td>
			<?php echo $fetch['firstname']?>
			<?php echo $fetch['lastname']?>
		</td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['classSection']?></td>
	</tr>
<?php
		}
	}
?>
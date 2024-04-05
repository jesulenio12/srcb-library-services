<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$gender = $_POST['gender'];
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'High School Library' && departmentType = 'Senior High School Department' && userType = 'Teacher' && gender LIKE '$gender%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
			<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
			<td>
				<?php echo $fetch['firstname']?>
				<?php echo $fetch['lastname']?>
			</td>
			<td><?php echo $fetch['gender']?></td>
			<td align="center" class="noprint">
				<a style="color:white" href="admin.php?action=teachersShs_editTeach&&id=<?php echo $fetch['id']; ?>"><button type="button" class="btn8"><i class="glyphicon glyphicon-edit"></i> Update </button></a> 
				<?php require_once ('teach-deactivate-confirm.php');?>
				<form method="POST" action="shsTeach_deactivate.php" style="display:inline">
					<input type="hidden" name="deactivate" value="<?php echo $fetch['id'];  ?>">
					<button class="bookbtn1" type="button" data-toggle="modal" data-target="#confirmDeactivate" data-title="Confirm Deactivate">
						<i class="fa fa-ban"></i>
					</button>
				</form>
			</td>
		</tr>
	<?php
				}
			}
			
		}
	
	
	else{
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'High School Library' && departmentType = 'Senior High School Department' && userType = 'Teacher' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
		<td>
			<?php echo $fetch['firstname']?>
			<?php echo $fetch['lastname']?>
		</td>
		<td><?php echo $fetch['gender']?></td>
		<td align="center" class="noprint">
			<a style="color:white" href="admin.php?action=teachersShs_editTeach&&id=<?php echo $fetch['id']; ?>"><button type="button" class="btn8"><i class="glyphicon glyphicon-edit"></i> Update </button></a> 
			<?php require_once ('teach-deactivate-confirm.php');?>
			<form method="POST" action="shsTeach_deactivate.php" style="display:inline">
				<input type="hidden" name="deactivate" value="<?php echo $fetch['id'];  ?>">
				<button class="bookbtn1" type="button" data-toggle="modal" data-target="#confirmDeactivate" data-title="Confirm Deactivate">
					<i class="fa fa-ban"></i>
				</button>
			</form>
		</td>
	</tr>
<?php
		}
	}
?>
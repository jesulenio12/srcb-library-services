<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$gender = $_POST['gender'];
		$yearLevel = $_POST['yearLevel'];
		$classSection = $_POST['classSection'];
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'Grade School Library' && departmentType = 'Grade School Department' && userType = 'Student' && gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND classSection LIKE '$classSection%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
			<td style="width:10px; text-align: center;" class="noprint">
				<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
			</td>
			<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
			<td>
				<?php echo $fetch['firstname']?>
				<?php echo $fetch['lastname']?>
			</td>
			<td><?php echo $fetch['gender']?></td>
			<td><?php echo $fetch['yearLevel']?></td>
			<td><?php echo $fetch['classSection']?></td>
			<td align="center" class="noprint">
				<a style="color:white" href="admin.php?action=studentsElem_editStud&&id=<?php echo $fetch['id']; ?>"><button type="button" class="btn8"><i class="glyphicon glyphicon-edit"></i> Update </button></a> 
					<?php require_once ('stud-deactivate-confirm.php');?>
				<form method="POST" action="gsStud_deactivate.php" style="display:inline">
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
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'Grade School Library' && departmentType = 'Grade School Department' && userType = 'Student' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td style="width:10px; text-align: center;" class="noprint">
			<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
		</td>
		<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
		<td>
			<?php echo $fetch['firstname']?>
			<?php echo $fetch['lastname']?>
		</td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['classSection']?></td>
		<td align="center" class="noprint">
			<a style="color:white" href="admin.php?action=studentsElem_editStud&&id=<?php echo $fetch['id']; ?>"><button type="button" class="btn8"><i class="glyphicon glyphicon-edit"></i> Update </button></a> 
			<?php require_once ('stud-deactivate-confirm.php');?>
			<form method="POST" action="gsStud_deactivate.php" style="display:inline">
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
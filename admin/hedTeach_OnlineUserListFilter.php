<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$gender = $_POST['gender'];
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE departmentType='Higher Education Department' && permission != 0 && permissionRole = 6 && gender LIKE '$gender%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
			<td style="width:10px; text-align: center;" class="noprint">
				<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
			</td>
			<td><?php echo $fetch['username']?></td>
			<td>
				<?php echo $fetch['firstname']?>
				<?php echo $fetch['lastname']?>
			</td>
			<td><?php echo $fetch['gender']?></td>
			<td align="center">
				<a style="color:white" href="admin.php?action=hedTeach_view_info&&id=<?php echo $fetch['id']; ?>"><button type="button" class="btn8"><i class="glyphicon glyphicon-eye-open"></i> View </button></a> 	
			</td>
		</tr>
	<?php
				}
			}
			
		}
	
	
	else{
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE departmentType='Higher Education Department' && permission != 0 && permissionRole = 6 ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td style="width:10px; text-align: center;" class="noprint">
			<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
		</td>
		<td><?php echo $fetch['username']?></td>
		<td>
			<?php echo $fetch['firstname']?>
			<?php echo $fetch['lastname']?>
		</td>
		<td><?php echo $fetch['gender']?></td>
		<td align="center">
			<a style="color:white" href="admin.php?action=hedTeach_view_info&&id=<?php echo $fetch['id']; ?>"><button type="button" class="btn8"><i class="glyphicon glyphicon-eye-open"></i> View </button></a> 	
		</td>
	</tr>
<?php
		}
	}
?>
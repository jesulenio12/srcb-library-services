<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$gender = $_POST['gender'];
		$yearLevel = $_POST['yearLevel'];
		$classSection = $_POST['classSection'];
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE departmentType='Junior High School Department' && yearLevel != 'Graduated' && permission != 0 && permissionRole = 5 && gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND classSection LIKE '$classSection%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
			<td style="width:10px; text-align: center;" class="noprint">
				<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
			</td>
			<td><?php echo substr($fetch['username'], 3, 255); ?></td>
			<td>
				<?php echo $fetch['firstname']?>
				<?php echo $fetch['lastname']?>
			</td>
			<td><?php echo $fetch['gender']?></td>
			<td><?php echo $fetch['yearLevel']?></td>
			<td><?php echo $fetch['classSection']?></td>
			<td align="center">
				<a style="color:white" href="admin.php?action=jhs_view_info&&id=<?php echo $fetch['id']; ?>"><button type="button" class="btn8"><i class="glyphicon glyphicon-eye-open"></i> View </button></a> 	
			</td>
		</tr>
	<?php
				}
			}
			
		}
	
	
	else{
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE departmentType='Junior High School Department' && yearLevel != 'Graduated' && permission != 0 && permissionRole = 5 ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td style="width:10px; text-align: center;" class="noprint">
			<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
		</td>
		<td><?php echo substr($fetch['username'], 3, 255); ?></td>
		<td>
			<?php echo $fetch['firstname']?>
			<?php echo $fetch['lastname']?>
		</td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['classSection']?></td>
		<td align="center">
			<a style="color:white" href="admin.php?action=jhs_view_info&&id=<?php echo $fetch['id']; ?>"><button type="button" class="btn8"><i class="glyphicon glyphicon-eye-open"></i> View </button></a> 	
		</td>
	</tr>
<?php
		}
	}
?>
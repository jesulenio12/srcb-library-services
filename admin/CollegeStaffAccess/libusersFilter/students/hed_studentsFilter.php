<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$gender = $_POST['gender'];
		$yearLevel = $_POST['yearLevel'];
		$progtrack = $_POST['progtrack'];
		$status = $_POST['status'];
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Student' && gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND progtrack LIKE '$progtrack%' AND status LIKE '$status%' ORDER BY `id` DESC") or die(mysqli_error());
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
			<td><?php echo $fetch['yearLevel']?></td>
			<td><?php echo $fetch['progtrack']?></td>
			<td style="color:<?php echo getColorByStatus($fetch['status']);?>;font-family: arial;font-weight: 600"><?php echo $fetch['status']?></td>
			<td>
				<form method="POST" action="admin.php?action=hedStudView&&library_userID=<?php echo urlencode($fetch['library_userID']); ?>" style="display:inline">
					<button class="bookbtn1" type="submit" style="width:100%;">
						<i class="glyphicon glyphicon-list"></i>
					</button>
				</form>
			</td>
		</tr>
	<?php
				}
			}
			
		}
	
	
	else{
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Student' ORDER BY `id` DESC") or die(mysqli_error());
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
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['progtrack']?></td>
		<td style="color:<?php echo getColorByStatus($fetch['status']);?>;font-family: arial;font-weight: 600"><?php echo $fetch['status']?></td>
		<td>
			<form method="POST" action="admin.php?action=hedStudView&&library_userID=<?php echo urlencode($fetch['library_userID']); ?>" style="display:inline">
				<button class="bookbtn1" type="submit" style="width:100%;">
					<i class="glyphicon glyphicon-list"></i>
				</button>
			</form>
		</td>
	</tr>
<?php
		}
	}

	function getColorByStatus($status)
	{
		switch ($status) {
			case 'Active':
				return '#3db166';
			case 'Deactivated':
				return '#f70c13db';
			default:
				return '#000000'; // Default color
		}
	}

?>
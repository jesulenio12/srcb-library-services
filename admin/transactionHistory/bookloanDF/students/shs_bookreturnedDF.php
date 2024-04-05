<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && departmentType ='Senior High School Department' && userType = 'Student' && date(`transactionDate`) BETWEEN '$date1' AND '$date2' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['progtrack']?></td>
		<td><?php echo $fetch['classSection']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td><?php echo $fetch['interval2']?></td>
		<td align="center">
			<?php if($fetch['remarks'] == 'On Time'){?>
				<span class="label label-success">Returned</span>
			<?php }else{?>
				<span class="label label-danger"> Overdue</span>
			<?php }?>
		</td>
	</tr>
<?php
			}
		}
		//All
		else if(ISSET($_POST['search'])){
			$interval2 = 0;
			$duedate = 0;
			$totalfines = 0;

			$libraryClass = $_POST['libraryClass'];
			$gender = $_POST['gender'];
			$yearLevel = $_POST['yearLevel'];
			$tracks = $_POST['tracks'];
			$classSection = $_POST['classSection'];
			$bookSection = $_POST['bookSection'];
			$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && departmentType ='Senior High School Department' && userType = 'Student' && libraryClass LIKE '$libraryClass%' AND gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND tracks LIKE '$tracks%' AND classSection LIKE '$classSection%' AND bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
			$row=mysqli_num_rows($query);
			if($row>0){
				while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td><?php echo $fetch['libraryClass']?></td>
			<td><?php echo $fetch['library_userID']?></td>
			<td><?php echo $fetch['fullname']?></td>
			<td><?php echo $fetch['gender']?></td>
			<td><?php echo $fetch['yearLevel']?></td>
			<td><?php echo $fetch['progtrack']?></td>
			<td><?php echo $fetch['classSection']?></td>
			<td><?php echo $fetch['bookAccession']?></td>
			<td><?php echo $fetch['bookTitle']?></td>
			<td><?php echo $fetch['bookSection']?></td>
			<td><?php echo $fetch['transactionDate']?></td>
			<td><?php echo $fetch['interval2']?></td>
			<td align="center">
				<?php if($fetch['remarks'] == 'On Time'){?>
					<span class="label label-success">Returned</span>
				<?php }else{?>
					<span class="label label-danger"> Overdue</span>
				<?php }?>
			</td>
		</tr>
	<?php
				}
			}
			
		}

	}
	
	
	else{
		$interval2 = 0;
		$duedate = 0;
		$totalfines = 0;
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && departmentType ='Senior High School Department' && userType = 'Student' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['progtrack']?></td>
		<td><?php echo $fetch['classSection']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td><?php echo $fetch['interval2']?></td>
		<td align="center">
			<?php if($fetch['remarks'] == 'On Time'){?>
				<span class="label label-success">Returned</span>
			<?php }else{?>
				<span class="label label-danger"> Overdue</span>
			<?php }?>
		</td>
	</tr>
<?php
		}
	}
?>
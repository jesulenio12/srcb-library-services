<?php
	require 'conn.php';
	if(ISSET($_POST['search2'])){
		$date3 = date("Y-m-d", strtotime($_POST['date3']));
		$date4 = date("Y-m-d", strtotime($_POST['date4']));
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Gs-Lib' && date(`transactionDate`) BETWEEN '$date3' AND '$date4' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td align="center">
			<?php if($fetch['userType'] == 'Student' OR $fetch['userType'] == '5'){?>
				Student
			<?php }else{?>
				Teacher
			<?php }?>
		</td>
		<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td align="center">
			<?php if($fetch['yearLevel'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['yearLevel']?>
			<?php }?>
		</td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td align="center">
			<?php if($fetch['remarks'] == 'Overdue'){?>
				<span class="label label-danger"> Overdue</span>
			<?php }else{?>
				<span class="label label-success"> Returned</span>
			<?php }?>
		</td>
	</tr>
<?php
			}
		}
		//All
		else if(ISSET($_POST['search2'])){
			$yearLevel = $_POST['yearLevel'];
			$bookSection = $_POST['bookSection'];
			$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Gs-Lib' && yearLevel LIKE '$yearLevel%' AND classSet LIKE '$classSet%' AND bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
			$row=mysqli_num_rows($query);
			if($row>0){
				while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
			<td align="center">
				<?php if($fetch['userType'] == 'Student' OR $fetch['userType'] == '5'){?>
					Student
				<?php }else{?>
					Teacher
				<?php }?>
			</td>
			<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
			<td><?php echo $fetch['fullname']?></td>
			<td align="center">
			<?php if($fetch['yearLevel'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['yearLevel']?>
			<?php }?>
			</td>
			<td><?php echo $fetch['bookTitle']?></td>
			<td><?php echo $fetch['bookSection']?></td>
			<td><?php echo $fetch['transactionDate']?></td>
			<td align="center">
				<?php if($fetch['remarks'] == 'Overdue'){?>
					<span class="label label-danger"> Overdue</span>
				<?php }else{?>
					<span class="label label-success"> Returned</span>
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
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Gs-Lib' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td align="center">
			<?php if($fetch['userType'] == 'Student' OR $fetch['userType'] == '5'){?>
				Student
			<?php }else{?>
				Teacher
			<?php }?>
		</td>
		<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td align="center">
			<?php if($fetch['yearLevel'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['yearLevel']?>
			<?php }?>
		</td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td align="center">
			<?php if($fetch['remarks'] == 'Overdue'){?>
				<span class="label label-danger"> Overdue</span>
			<?php }else{?>
				<span class="label label-success"> Returned</span>
			<?php }?>
		</td>
	</tr>
<?php
		}
	}
?>
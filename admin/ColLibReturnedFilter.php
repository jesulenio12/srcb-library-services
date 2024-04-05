<?php
	require 'conn.php';
	if(ISSET($_POST['search2'])){
		$filters = array();

		// Check if each filter is set and not empty
		if (!empty($_POST['date1']) && !empty($_POST['date2'])) {
			$date1 = date("Y-m-d", strtotime($_POST['date1']));
			$date2 = date("Y-m-d", strtotime($_POST['date2']));
			$filters[] = "date(`transactionDate`) BETWEEN '$date1' AND '$date2'";
		}

		if (!empty($_POST['userType'])) {
			$userType = $_POST['userType'];
			$filters[] = "userType LIKE '$userType%'";
		}

		if (!empty($_POST['progtrack'])) {
			$progtrack = $_POST['progtrack'];
			$filters[] = "progtrack LIKE '$progtrack%'";
		}

		if (!empty($_POST['bookSection'])) {
			$bookSection = $_POST['bookSection'];
			$filters[] = "bookSection LIKE '$bookSection%'";
		}

		// Construct the WHERE clause based on the filters
		$whereClause = implode(' AND ', $filters);

		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Col-Lib' " . ($whereClause ? " AND $whereClause" : "") . " ORDER BY `id` DESC") or die(mysqli_error());
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
			<?php if($fetch['progtrack'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['progtrack']?>
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
			$progtrack = $_POST['progtrack'];
			$bookSection = $_POST['bookSection'];
			$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Col-Lib' && progtrack LIKE '$progtrack%' AND bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
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
			<?php if($fetch['progtrack'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['progtrack']?>
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
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Col-Lib' ORDER BY `id` DESC") or die(mysqli_error());
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
			<?php if($fetch['progtrack'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['progtrack']?>
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

<script type="text/javascript">
    $(function() {
        $("#articles").dataTable();
    });

	function printImg(url) {
	  var win = window.open('');
	  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
	  win.focus();
	}
</script>
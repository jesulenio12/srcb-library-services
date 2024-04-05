<?php
	require 'conn.php';
	if(ISSET($_POST['search2'])){
		$date3 = date("Y-m-d", strtotime($_POST['date3']));
		$date4 = date("Y-m-d", strtotime($_POST['date4']));
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Hs-Lib' && date(`transactionDate`) BETWEEN '$date3' AND '$date4' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td align="center">
			<?php if($fetch['userType'] == 'Student'){?>
				Student
			<?php }else{?>
				Teacher
			<?php }?>
		</td>
		<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td>
			<?php if($fetch['departmentType'] == 'Higher Education Department' OR $fetch['departmentType'] == 'Senior High School Department'){?>
				<?php echo $fetch['progtrack']?>
			<?php }elseif($fetch['departmentType'] == 'Junior High School Department'){?>
				<?php echo $fetch['yearLevel']?>
			<?php }else{?>
				---
			<?php }?>
		</td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td>
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
			$userType = $_POST['userType'];
			$progtrack = $_POST['progtrack'];
			$yearLevel = $_POST['yearLevel'];
			$bookSection = $_POST['bookSection'];
			$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Hs-Lib' && userType LIKE '$userType%' AND progtrack LIKE '$progtrack%' AND yearLevel LIKE '$yearLevel%' AND bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
			$row=mysqli_num_rows($query);
			if($row>0){
				while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
			<td align="center">
				<?php if($fetch['userType'] == 'Student'){?>
					Student
				<?php }else{?>
					Teacher
				<?php }?>
			</td>
			<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
			<td><?php echo $fetch['fullname']?></td>
			<td>
				<?php if($fetch['departmentType'] == 'Higher Education Department' OR $fetch['departmentType'] == 'Senior High School Department'){?>
					<?php echo $fetch['progtrack']?>
				<?php }elseif($fetch['departmentType'] == 'Junior High School Department'){?>
					<?php echo $fetch['yearLevel']?>
				<?php }else{?>
					---
				<?php }?>
			</td>
			<td><?php echo $fetch['bookTitle']?></td>
			<td><?php echo $fetch['bookSection']?></td>
			<td><?php echo $fetch['transactionDate']?></td>
			<td>
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
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && transactionPlace = 'Hs-Lib' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td align="center">
			<?php if($fetch['userType'] == 'Student'){?>
				Student
			<?php }else{?>
				Teacher
			<?php }?>
		</td>
		<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td>
			<?php if($fetch['departmentType'] == 'Higher Education Department' OR $fetch['departmentType'] == 'Senior High School Department'){?>
				<?php echo $fetch['progtrack']?>
			<?php }elseif($fetch['departmentType'] == 'Junior High School Department'){?>
				<?php echo $fetch['yearLevel']?>
			<?php }else{?>
				---
			<?php }?>
		</td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td>
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
<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && libraryClass = 'High School Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE) && date(`transactionDate`) BETWEEN '$date1' AND '$date2' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
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
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
	</tr>
<?php
			}
		}
		//All
		else if(ISSET($_POST['search'])){
			$progtrack = $_POST['progtrack'];
			$bookSection = $_POST['bookSection'];
			$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && libraryClass = 'High School Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE) && progtrack LIKE '$progtrack%' AND bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
			$row=mysqli_num_rows($query);
			if($row>0){
				while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
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
			<td><?php echo $fetch['bookAccession']?></td>
			<td><?php echo $fetch['bookTitle']?></td>
			<td><?php echo $fetch['bookSection']?></td>
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
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && libraryClass = 'High School Library' && MONTH(transactionDate) = MONTH(CURRENT_DATE) AND YEAR(transactionDate) = YEAR(CURRENT_DATE) ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
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
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
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
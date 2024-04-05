<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && departmentType ='Higher Education Department' && userType = 'Teacher' && date(`transactionDate`) BETWEEN '$date1' AND '$date2' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
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
			$libraryClass = $_POST['libraryClass'];
			$gender = $_POST['gender'];
			$bookSection = $_POST['bookSection'];
			$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && departmentType ='Higher Education Department' && userType = 'Teacher' && libraryClass LIKE '$libraryClass%' AND gender LIKE '$gender%' AND bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
			$row=mysqli_num_rows($query);
			if($row>0){
				while($fetch=mysqli_fetch_array($query)){
	?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
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
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && departmentType ='Higher Education Department' && userType = 'Teacher' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
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
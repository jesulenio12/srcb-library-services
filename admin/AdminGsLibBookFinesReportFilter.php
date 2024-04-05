<?php
	require 'conn.php';
	//Borrrowed Filter Date
	if(ISSET($_POST['search'])){
		$userType = $_POST['userType'];
		$gender = $_POST['gender'];
		$yearLevel = $_POST['yearLevel'];
		$progtrack = $_POST['progtrack'];
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' &&  remarks = 'Overdue' && transactionPlace = 'Gs-Lib' && userType LIKE '$userType%' AND gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND progtrack LIKE '$progtrack%' AND bookSection LIKE '$bookSection%'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['userType']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['dateBorrowed']?></td>
		<td><?php echo $fetch['dueDate']?></td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td><?php echo $fetch['interval2']?></td>
		<td>₱<?php echo substr($fetch['finesperDueDate'], 1, 255); ?></td>
		<td>₱<?php echo substr($fetch['totalFines'], 1, 255); ?></td>
		<td align="center">
			<?php if($fetch['payment'] == 0){?>
				<span class="label label-danger">Unpaid</span>
			<?php }else{?>
				<span class="label label-success"> Paid</span>
			<?php }?>
		</td>
	</tr>
<?php
			}
		}
		
		
	}//--
	
	
	else{
		$interval2 = 0;
		$dueDate = 0;
		$totalfines = 0;
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && remarks = 'Overdue' && transactionPlace = 'Gs-Lib'") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['userType']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['dateBorrowed']?></td>
		<td><?php echo $fetch['dueDate']?></td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td><?php echo $fetch['interval2']?></td>
		<td>₱<?php echo substr($fetch['finesperDueDate'], 1, 255); ?></td>
		<td>₱<?php echo substr($fetch['totalFines'], 1, 255); ?></td>
		<td align="center">
			<?php if($fetch['payment'] == 0){?>
				<span class="label label-danger">Unpaid</span>
			<?php }else{?>
				<span class="label label-success"> Paid</span>
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
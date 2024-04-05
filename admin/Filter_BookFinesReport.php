<?php
	require 'conn.php';
	//Borrrowed Filter Date
	if(ISSET($_POST['search'])){
		$interval2 = 0;
		$duedate = 0;
		$totalfines = 0;
		$libraryClass = $_POST['libraryClass'];
		$userType = $_POST['userType'];
		$gender = $_POST['gender'];
		$yearLevel = $_POST['yearLevel'];
		$program = $_POST['program'];
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE payment = 1 && totalFines != 0 && departmentType = 'Higher Education Department' && libraryClass LIKE '$libraryClass%' AND userType LIKE '$userType%' AND gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND program LIKE '$program%' AND bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
	<td><?php echo $fetch['libraryClass']?></td>
	<td><?php echo $fetch['userType']?></td>
	<td><?php echo $fetch['library_userID']?></td>
	<td>
		<?php echo $fetch['firstname']?>
		<?php echo $fetch['lastname']?>
	</td>
	<td><?php echo $fetch['gender']?></td>
	<td><?php echo $fetch['yearLevel']?></td>
	<td><?php echo $fetch['program']?></td>
	<td><?php echo $fetch['bookAccession']?></td>
	<td><?php echo $fetch['bookTitle']?></td>
	<td><?php echo $fetch['bookSection']?></td>
	<td><?php echo $fetch['dateBorrowed']?></td>
	<td>
		<?php
			$date = date_create($fetch['dateBorrowed']);
			date_add($date,date_interval_create_from_date_string("3 days"));
			echo date_format($date,"Y-m-d");
			$duedate =  date_format($date,"Y-m-d");
		?>
	</td>
	<td>
		<?php if($fetch['dateReturned'] == ''){?>
			<span align="center"> --/-------/----</span>
		<?php }else{?>
			<span> 
				<?php echo $fetch['dateReturned'] ; ?>
			</span>
		<?php }?>
	</td>
	<td>
		<?php
			$datenow = date('Y-m-d');
			$due = date_create($duedate);
			$date_now = date_create($datenow);
		
			if($date_now>$due){
				$interval = date_diff($due, $date_now);
		
				echo $interval->format('%d').' '.'Day(s)';
				
				$interval2 = (int) $interval->format('%d');
				$fines_perdue = $fetch['finesperDueDate'];
				$totalfines = $fines_perdue*$interval2;
			}
			else{
				echo '0 Day(s)';
			}
		?>
	</td>
	
	<td>₱<?php echo $fetch['finesperDueDate'] ; ?>.00</td>
	<td align="center">
		<span> ₱<?php echo $totalfines; ?>.00</span>
	</td>
	<td align="center">
		<?php if($date_now < $due){?>
			<span class="label label-primary">No Fines</span>
		<?php }elseif($date_now > $due && $fetch['payment'] == 0){?>
			<span class="label label-danger"> Unpaid</span>
		<?php }elseif($fetch['payment'] == 1){?>
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
		$duedate = 0;
		$totalfines = 0;
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE payment = 1 && totalFines != 0 && departmentType = 'Higher Education Department' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['userType']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td>
			<?php echo $fetch['firstname']?>
			<?php echo $fetch['lastname']?>
		</td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['program']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['dateBorrowed']?></td>
		<td><?php echo $fetch['dueDate']?></td>
		<td><?php echo $fetch['dateReturned']?></td>
		<td><?php echo $fetch['interval2']?></td>
		<td>₱<?php echo $fetch['finesperDueDate']?>.00</td>
		<td>₱<?php echo $fetch['totalFines']?>.00</td>
		<td align="center">
			<?php if($fetch['payment'] == 0){?>
				<span class="label label-danger"> Unpaid</span>
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
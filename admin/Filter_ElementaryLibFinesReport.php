<?php
	require 'conn.php';
	//Borrrowed Filter Date
	if(ISSET($_POST['search'])){
		$interval2 = 0;
		$dueDate = 0;
		$totalfines = 0;
		$userType = $_POST['userType'];
		$gender = $_POST['gender'];
		$yearLevel = $_POST['yearLevel'];
		$classSection = $_POST['classSection'];
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE payment = 0 && transactionPlace = 'Gs-Lib' && userType LIKE '$userType%' AND gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND classSection LIKE '$classSection%' AND bookSection LIKE '$bookSection%'") or die(mysqli_error());
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
		<td><?php echo $fetch['classSection']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td>
			<?php
				$date = date_create($fetch['transactionDate']);
				date_add($date,date_interval_create_from_date_string("3 days"));
				echo date_format($date,"Y-m-d");
				$dueDate =  date_format($date,"Y-m-d");
			?>
		</td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td>
			<?php
				$datenow = date('Y-m-d');
				$due = date_create($dueDate);
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
		<td align="center" class="noprint">
			<?php
			if (Input::exists()) {
					$booktransactions = DB:: getInstance()->get('booktransactions', array('id','=',Input::get('paid')));
					if ($booktransactions->count()){
						foreach($booktransactions->results() as $booktransactions){
							$booktransaction = new BookTransactions();
							try {
								$booktransaction->update(array(
									'totalFines' => Input::get('totalFines'),
									'interval2' => Input::get('interval2').' '.'Day(s)',
									'dueDate' => Input::get('dueDate'),
									'payment' => 1,
								),$booktransactions->id);
							} catch(Exception $e) {
							$error;
							}
						}
					}													
					
			}

			?>
			<?php require_once ('fines-confirm.php');?>
			<form method="POST" action="" style="display:inline">
				<input type="hidden" name="paid" value="<?php echo $fetch['id'];  ?>">
				<input type="hidden" name="totalFines" value="<?php echo $totalfines; ?>">
				<input type="hidden" name="interval2" value="<?php echo $interval2; ?>">
				<input type="hidden" name="dueDate" value="<?php echo $dueDate; ?>">
				<button class="btn3" type="button" data-toggle="modal" data-target="#confirmPayment" data-title="Confirm Payment" data-message="Are you sure you want to pay?">
					<i class="fa fa-money-bill"></i>
				</button>
			</form>
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
		$query=mysqli_query($conn, "SELECT * FROM `booktransactions` WHERE transactionType = 'return' && payment = 0 && transactionPlace = 'Gs-Lib'") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['userType']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['classSection']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td>
			<?php
				$date = date_create($fetch['transactionDate']);
				date_add($date,date_interval_create_from_date_string("3 days"));
				echo date_format($date,"Y-m-d");
				$dueDate =  date_format($date,"Y-m-d");
			?>
		</td>
		<td><?php echo $fetch['transactionDate']?></td>
		<td>
			<?php
				$datenow = date('Y-m-d');
				$due = date_create($dueDate);
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
		<td align="center" class="noprint">
			<?php
			if (Input::exists()) {
					$booktransactions = DB:: getInstance()->get('booktransactions', array('id','=',Input::get('paid')));
					if ($booktransactions->count()){
						foreach($booktransactions->results() as $booktransactions){
							$booktransaction = new BookTransactions();
							try {
								$booktransaction->update(array(
									'totalFines' => Input::get('totalFines'),
									'interval2' => Input::get('interval2').' '.'Day(s)',
									'dueDate' => Input::get('dueDate'),
									'payment' => 1,
								),$booktransactions->id);
							} catch(Exception $e) {
							$error;
							}
						}
					}													
					
			}

			?>
			<?php require_once ('fines-confirm.php');?>
			<form method="POST" action="" style="display:inline">
				<input type="hidden" name="paid" value="<?php echo $fetch['id'];  ?>">
				<input type="hidden" name="totalFines" value="<?php echo $totalfines; ?>">
				<input type="hidden" name="interval2" value="<?php echo $interval2; ?>">
				<input type="hidden" name="dueDate" value="<?php echo $dueDate; ?>">
				<button class="btn3" type="button" data-toggle="modal" data-target="#confirmPayment" data-title="Confirm Payment" data-message="Are you sure you want to pay?">
					<i class="fa fa-money-bill"></i>
				</button>
			</form>
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
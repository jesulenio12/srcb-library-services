<?php
	require 'conn.php';
	$query=mysqli_query($conn, "SELECT * FROM `attendance` WHERE libraryClass = 'Grade School Library' AND MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE) ORDER BY `id` DESC") or die(mysqli_error());
	while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td align="center">
			<?php if($fetch['yearLevel'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['yearLevel']?>
			<?php }?>
		</td>
		<td align="center">
			<?php if($fetch['classSet'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['classSet']?>
			<?php }?>
		</td>
		<td align="center">
			<?php if($fetch['classSection'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['classSection']?>
			<?php }?>
		</td>
		<td align="center">
			<?php if($fetch['userType'] == 'Student'){?>
				<span class="label label-primary"> Student</span>
			<?php }elseif($fetch['userType'] == 'Teacher'){?>
				<span class="label label-success"> Teacher</span>
			<?php }elseif($fetch['userType'] == '1'){?>
				<span class="label label-danger"> System Admin</span>
			<?php }elseif($fetch['userType'] == '2'){?>
				<span class="label label-info"> HED Library Staff</span>
			<?php }elseif($fetch['userType'] == '3'){?>
				<span class="label label-default"> BED Library Staff</span>
			<?php }elseif($fetch['userType'] == '4'){?>
				<span class="label label-warning"> GS Library Staff</span>
			<?php }?>
		</td>
		<td><?php echo date('d F Y | h:i A', strtotime($fetch['timeIn']));?></td>
	</tr>
<?php
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
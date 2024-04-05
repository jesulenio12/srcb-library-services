<?php
	require 'conn.php';
		if(ISSET($_POST['search'])){
		$gender = $_POST['gender'];
		$yearLevel = $_POST['yearLevel'];
		$progtrack = $_POST['progtrack'];
		$departmentType = $_POST['departmentType'];
		$query=mysqli_query($conn, "SELECT * FROM `attendance` WHERE userType = 'Student' && libraryClass = 'High School Library' && MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE) &&  gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND progtrack LIKE '$progtrack%' AND departmentType LIKE '$departmentType%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td>
			<?php if($fetch['progtrack'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['progtrack']?>
			<?php }?>
		</td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['departmentType']?></td>
	</tr>
<?php
			}
		}
		
	}
	
	else{
		$interval2 = 0;
		$duedate = 0;
		$totalfines = 0;
		$query=mysqli_query($conn, "SELECT * FROM `attendance` WHERE userType = 'Student' && libraryClass = 'High School Library' && MONTH(timeIn) = MONTH(CURRENT_DATE) AND YEAR(timeIn) = YEAR(CURRENT_DATE) ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo substr($fetch['library_userID'], 3, 100); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td>
			<?php if($fetch['progtrack'] == ''){?>
				---
			<?php }else{?>
				<?php echo $fetch['progtrack']?>
			<?php }?>
		</td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['departmentType']?></td>
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
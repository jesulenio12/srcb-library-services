<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT * FROM `attendance` WHERE departmentType = 'Junior High School Department' && userType = 'Student' && date(`timeIn`) BETWEEN '$date1' AND '$date2' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['classSection']?></td>
		<td><?php echo date('d-m-Y | h:i A', strtotime($fetch['timeIn']));?></td>
	</tr>
<?php
			}
		}
		//All
		else if(ISSET($_POST['search'])){
			$libraryClass = $_POST['libraryClass'];
			$gender = $_POST['gender'];
			$yearLevel = $_POST['yearLevel'];
			$classSection = $_POST['classSection'];
			$query=mysqli_query($conn, "SELECT * FROM `attendance` WHERE departmentType = 'Junior High School Department' && userType = 'Student' && libraryClass LIKE '$libraryClass%' AND gender LIKE '$gender%' AND yearLevel LIKE '$yearLevel%' AND classSection LIKE '$classSection%' ORDER BY `id` DESC") or die(mysqli_error());
			$row=mysqli_num_rows($query);
			if($row>0){
				while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td><?php echo $fetch['libraryClass']?></td>
			<td><?php echo $fetch['library_userID']?></td>
			<td><?php echo $fetch['fullname']?></td>
			<td><?php echo $fetch['gender']?></td>
			<td><?php echo $fetch['yearLevel']?></td>
			<td><?php echo $fetch['classSection']?></td>
			<td><?php echo date('d-m-Y | h:i A', strtotime($fetch['timeIn']));?></td>
		</tr>
	<?php
				}
			}
			
		}

	}
	
	
	else{
		$query=mysqli_query($conn, "SELECT * FROM `attendance` WHERE departmentType = 'Junior High School Department' && userType = 'Student' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['library_userID']?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['classSection']?></td>
		<td><?php echo date('d-m-Y | h:i A', strtotime($fetch['timeIn']));?></td>
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
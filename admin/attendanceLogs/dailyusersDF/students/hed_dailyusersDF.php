<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$filters = array();

		// Check if each filter is set and not empty
		if (!empty($_POST['date1']) && !empty($_POST['date2'])) {
			$date1 = date("Y-m-d", strtotime($_POST['date1']));
			$date2 = date("Y-m-d", strtotime($_POST['date2']));
			$filters[] = "date(`timeIn`) BETWEEN '$date1' AND '$date2'";
		}

		if (!empty($_POST['libraryClass'])) {
			$libraryClass = $_POST['libraryClass'];
			$filters[] = "libraryClass LIKE '$libraryClass%'";
		}

		if (!empty($_POST['userType'])) {
			$userType = $_POST['userType'];
			$filters[] = "userType LIKE '$userType%'";
		}
	
		if (!empty($_POST['gender'])) {
			$gender = $_POST['gender'];
			$filters[] = "gender LIKE '$gender%'";
		}
	
		if (!empty($_POST['yearLevel'])) {
			$yearLevel = $_POST['yearLevel'];
			$filters[] = "yearLevel LIKE '$yearLevel%'";
		}
	
		if (!empty($_POST['progtrack'])) {
			$progtrack = $_POST['progtrack'];
			$filters[] = "progtrack LIKE '$progtrack%'";
		}

		// Construct the WHERE clause based on the filters
		$whereClause = implode(' AND ', $filters);

		$query=mysqli_query($conn, "SELECT * FROM `attendance` WHERE departmentType = 'Higher Education Department' && userType = 'Student' " . ($whereClause ? " AND $whereClause" : "") . " ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['progtrack']?></td>
		<td><?php echo date('d-m-Y | h:i A', strtotime($fetch['timeIn']));?></td>
	</tr>
<?php
			}
		}
	}
	
	else{
		$query=mysqli_query($conn, "SELECT * FROM `attendance` ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo substr($fetch['library_userID'], 3, 255); ?></td>
		<td><?php echo $fetch['fullname']?></td>
		<td><?php echo $fetch['gender']?></td>
		<td><?php echo $fetch['yearLevel']?></td>
		<td><?php echo $fetch['progtrack']?></td>
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
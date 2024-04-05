<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$gender = $_POST['gender'];
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 1 && libraryClass = 'High School Library' && departmentType = 'Junior High School Department' && userType = 'Teacher' && gender LIKE '$gender%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
	?>
		<tr>
			<td>#</td>
			<td><?php echo $fetch['library_userID']?></td>
			<td>
				<?php echo $fetch['firstname']?>
				<?php echo $fetch['lastname']?>
			</td>
			<td><?php echo $fetch['gender']?></td>
			<td style="width:10px; text-align: center;" class="noprint">
				<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
			</td>
		</tr>
	<?php
				}
			}
			
		}
	
	
	else{
		$query=mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 1 && libraryClass = 'High School Library' && departmentType = 'Junior High School Department' && userType = 'Teacher' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['library_userID']?></td>
		<td>
			<?php echo $fetch['firstname']?>
			<?php echo $fetch['lastname']?>
		</td>
		<td><?php echo $fetch['gender']?></td>
		<td style="width:10px; text-align: center;" class="noprint">
			<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
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
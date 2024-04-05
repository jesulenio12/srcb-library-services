<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE bookSection != 'Periodical' && lost = 1 && remove = 0 && discarded = 0 && libraryClass = 'College Library' && bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td align="center" class="noprint">
			<form method="POST" action="admin.php?action=CollegeLostBookCard&&id=<?php echo $fetch['id']; ?>" style="display:inline">
				<button class="btnd-1" type="submit">
					<i class="glyphicon glyphicon-bookmark"></i>
				</button>
			</form>
			<?php require_once ('restore-lost-confirm.php');?>
			<form method="POST" action="restore_hed_lost-discard-book.php" style="display:inline">
				<input type="hidden" name="restore" value="<?php echo $fetch['id'];  ?>">
				<button class="btnd-1" type="button" data-toggle="modal" data-target="#confirmLost" data-title="Confirm Lost">
					<i class="glyphicon glyphicon-refresh"></i>
				</button>
			</form>
			<form method="POST" action="hed_remove-lostbooks.php" style="display:inline">
				<input type="hidden" name="remove" value="<?php echo $fetch['id'];  ?>">
				<button class="btnd-1" type="button" data-toggle="modal" data-target="#confirmRemove" data-title="Confirm Remove">
					<i class="glyphicon glyphicon-remove"></i>
				</button>
			</form>
		</td>

	</tr>
<?php
			}
		}
		// else{
		// 	echo'
		// 	<tr>
		// 		<td colspan = "4"><center>Record Not Found</center></td>
		// 	</tr>';
		// }
	}else{
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE bookSection != 'Periodical' && lost = 1 && remove = 0 && discarded = 0 && libraryClass = 'College Library' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td align="center" class="noprint">
			<form method="POST" action="admin.php?action=CollegeLostBookCard&&id=<?php echo $fetch['id']; ?>" style="display:inline">
				<button class="btnd-1" type="submit">
					<i class="glyphicon glyphicon-bookmark"></i>
				</button>
			</form>
			<?php require_once ('restore-lost-confirm.php');?>
			<form method="POST" action="restore_hed_lost-discard-book.php" style="display:inline">
				<input type="hidden" name="restore" value="<?php echo $fetch['id'];  ?>">
				<button class="btnd-1" type="button" data-toggle="modal" data-target="#confirmLost" data-title="Confirm Lost">
					<i class="glyphicon glyphicon-refresh"></i>
				</button>
			</form>
			<?php require_once ('remove-confirm.php');?>
			<form method="POST" action="hed_remove-lostbooks.php" style="display:inline">
				<input type="hidden" name="remove" value="<?php echo $fetch['id'];  ?>">
				<button class="btnd-1" type="button" data-toggle="modal" data-target="#confirmRemove" data-title="Confirm Remove">
					<i class="glyphicon glyphicon-remove"></i>
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


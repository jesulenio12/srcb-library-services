<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE discarded = '1' && remove = '0' && libraryClass = 'College Library' && bookSection != 'Periodical' && bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo substr($fetch['bookAccession'], 4, 255);?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td align="center" class="noprint">
				<form method="POST" action="admin.php?action=CollegeDiscardedBookCard&&id=<?php echo $fetch['id']; ?>" style="display:inline">
					<button class="btnd-1" type="submit">
						<i class="glyphicon glyphicon-bookmark"></i>
					</button>
				</form>
				<form method="POST" action="admin.php?action=CollegeDiscardedBookEdit&&id=<?php echo $fetch['id']; ?>" style="display:inline">
					<button class="btnd-1" type="submit">
						<i class="glyphicon glyphicon-edit"></i>
					</button>
				</form>
				<?php require_once ('restore-confirm.php');?>
				<form method="POST" action="" style="display:inline">
					<input type="hidden" name="restore" value="<?php echo $fetch['id']; ?>">
					<button class="btnd-1" type="button" data-toggle="modal" data-target="#confirmRestore" data-title="Confirm Restoration" data-message="Are you sure you want to restore this?">
						<i class="glyphicon glyphicon-refresh"></i>
					</button>
				</form>
				<?php require_once ('remove-confirm.php');?>
				<form method="POST" action="hed_remove-discardedbooks.php" style="display:inline">
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
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE discarded = '1' && remove = '0' && libraryClass = 'College Library' && bookSection != 'Periodical' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo substr($fetch['bookAccession'], 4, 255);?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td align="center" class="noprint">
				<form method="POST" action="admin.php?action=CollegeDiscardedBookCard&&id=<?php echo $fetch['id']; ?>" style="display:inline">
					<button class="btnd-1" type="submit">
						<i class="glyphicon glyphicon-bookmark"></i>
					</button>
				</form>
				<form method="POST" action="admin.php?action=CollegeDiscardedBookEdit&&id=<?php echo $fetch['id']; ?>" style="display:inline">
					<button class="btnd-1" type="submit">
						<i class="glyphicon glyphicon-edit"></i>
					</button>
				</form>
				<?php require_once ('restore-confirm.php');?>
				<form method="POST" action="" style="display:inline">
					<input type="hidden" name="restore" value="<?php echo $fetch['id']; ?>">
					<button class="btnd-1" type="button" data-toggle="modal" data-target="#confirmRestore" data-title="Confirm Restoration" data-message="Are you sure you want to restore this?">
						<i class="glyphicon glyphicon-refresh"></i>
					</button>
				</form>
				<?php require_once ('remove-confirm.php');?>
				<form method="POST" action="hed_remove-discardedbooks.php" style="display:inline">
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
	 $('#confirmRemove').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmRemove').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>


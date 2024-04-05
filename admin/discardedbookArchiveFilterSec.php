<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$libraryClass = $_POST['libraryClass'];
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE discarded = '1' && remove = '1' && lost = 0 && bookSection != 'Periodical' && bookSection LIKE '$bookSection%' AND libraryClass LIKE '$libraryClass%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td style="width:10px; text-align: center;" class="noprint">
			<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
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
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE discarded = '1' && remove = '1' && lost = 0 && bookSection != 'Periodical' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td style="width:10px; text-align: center;" class="noprint">
			<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
		</td>
	</tr>
<?php
		}
	}
?>

<script type="text/javascript">
	 $('#confirmDiscard').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDiscard').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>


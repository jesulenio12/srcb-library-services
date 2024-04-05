<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$libraryClass = $_POST['libraryClass'];
		$status = $_POST['status'];
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE status='Available' && discarded='0' && libraryClass LIKE '$libraryClass%' AND status LIKE '$status%' AND bookSection LIKE '$bookSection%' ORDER BY `id` DESC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td style="width:10px; text-align: center;" class="noprint">
			<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
		</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td align="center">
			<?php if($fetch['requested'] == 1 && $fetch['is_borrowed'] == 0){?>
				<span class="label label-danger"> Not Available</span>
			<?php }elseif($fetch['requested'] == 0 && $fetch['is_borrowed'] == 1){?>
				<span class="label label-danger"> Not Available</span>
			<?php }else{?>
				<span class="label label-success"> Available</span>
			<?php }?>
		</td>
		<td align="center" class="noprint">
			<a style="color:#3db166;" href="admin.php?action=AdminCollegeBookCard&&id=<?php echo $fetch['id']; ?>"><button class="btn8" type="submit"><i class="glyphicon glyphicon-bookmark"></i> Catalog</button></a>
		</td>
	</tr>
<?php
			}
		}
		
	}else{
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE status='Available' && discarded='0' ORDER BY `id` DESC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td>#</td>
		<td style="width:10px; text-align: center;" class="noprint">
			<input type="checkbox" name="stud_update_id[]" value="<?= $fetch['id']; ?>">
		</td>
		<td><?php echo $fetch['libraryClass']?></td>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td align="center">
			<?php if($fetch['requested'] == 1 && $fetch['is_borrowed'] == 0){?>
				<span class="label label-danger"> Not Available</span>
			<?php }elseif($fetch['requested'] == 0 && $fetch['is_borrowed'] == 1){?>
				<span class="label label-danger"> Not Available</span>
			<?php }else{?>
				<span class="label label-success"> Available</span>
			<?php }?>
		</td>
		<td align="center" class="noprint">
			<a style="color:#3db166;" href="admin.php?action=AdminCollegeBookCard&&id=<?php echo $fetch['id']; ?>"><button class="btn8" type="submit"><i class="glyphicon glyphicon-bookmark"></i> Catalog</button></a>
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


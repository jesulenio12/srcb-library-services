<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE bookSection != 'General References' AND bookSection != 'Dictionaries' AND bookSection != 'Periodicals' && status='0' && discarded='0' && libraryClass = 'Grade School Library' && bookSection LIKE '$bookSection%' ORDER BY `id` ASC") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td align="center">
			<?php if($fetch['is_borrowed'] == 1){?>
				<span class="label label-danger"> Not Available</span>
			<?php }else{?>
				<span class="label label-success"> Available</span>
			<?php }?>
		</td>
		<td align="center" class="noprint">
			<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_<?php echo ucwords($fetch['id']); ?>" > <i class="glyphicon glyphicon-qrcode"></i></button>
			<!-- Modal -->
			<div id="myModal_<?php echo ucwords($fetch['id']); ?>" class="modal fade" role="dialog">
				<div class="modal-dialog">

				<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><?php echo ucwords($fetch['bookTitle']); ?></h4>
						</div>
						<div class="modal-body" >
							<image src="admin/bookQRCodes/<?php echo ucwords($fetch['qrcode']) ?>"/>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="printImg('admin/bookQRCodes/<?php echo ucwords($fetch['qrcode']) ?>')">Print</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
			<form method="POST" action="admin.php?action=AdminElementaryBookCard&&id=<?php echo $fetch['id']; ?>" style="display:inline">
					<button class="btn btn-xs btn-primary" type="submit">
						<i class="glyphicon glyphicon-bookmark"></i>
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
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE bookSection != 'General References' AND bookSection != 'Dictionaries' AND bookSection != 'Periodicals' && status='0' && discarded='0' && libraryClass = 'Grade School Library' ORDER BY `id` ASC") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr>
		<td><?php echo $fetch['bookAccession']?></td>
		<td><?php echo $fetch['callNumber']?></td>
		<td><?php echo $fetch['isbn']?></td>
		<td><?php echo $fetch['bookSection']?></td>
		<td><?php echo $fetch['bookTitle']?></td>
		<td><?php echo $fetch['author']?></td>
		<td><?php echo $fetch['publisher']?></td>
		<td><?php echo $fetch['datePublished']?></td>
		<td align="center">
			<?php if($fetch['is_borrowed'] == 1){?>
				<span class="label label-danger"> Not Available</span>
			<?php }else{?>
				<span class="label label-success"> Available</span>
			<?php }?>
		</td>
		<td align="center" class="noprint">
			<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_<?php echo ucwords($fetch['id']); ?>" > <i class="glyphicon glyphicon-qrcode"></i></button>
			<!-- Modal -->
			<div id="myModal_<?php echo ucwords($fetch['id']); ?>" class="modal fade" role="dialog">
				<div class="modal-dialog">

				<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><?php echo ucwords($fetch['bookTitle']); ?></h4>
						</div>
						<div class="modal-body" >
							<image src="admin/bookQRCodes/<?php echo ucwords($fetch['qrcode']) ?>"/>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="printImg('admin/bookQRCodes/<?php echo ucwords($fetch['qrcode']) ?>')">Print</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
			<form method="POST" action="admin.php?action=AdminElementaryBookCard&&id=<?php echo $fetch['id']; ?>" style="display:inline">
					<button class="btn btn-xs btn-primary" type="submit">
						<i class="glyphicon glyphicon-bookmark"></i>
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


<?php
	require 'conn.php';
	if(ISSET($_POST['search'])){
		$libraryClass = $_POST['libraryClass'];
		$bookSection = $_POST['bookSection'];
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE bookSection != 'Periodical' && lost = 1 && status = 0 && discarded = 0 && bookSection LIKE '$bookSection%' AND libraryClass LIKE '$libraryClass%' ORDER BY `id` DESC") or die(mysqli_error());
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
		<td align="center" class="noprint">
				<a style="color:white" href="admin.php?action=AdminLostBookCard&&id=<?php echo $fetch['id']; ?>"><button type="button" class="catalog"><i class="glyphicon glyphicon-bookmark"></i> Card Catalog </button></a> 
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
		$query=mysqli_query($conn, "SELECT * FROM `books` WHERE bookSection != 'Periodical' && lost = 1 && status = 0 && discarded = 0 ORDER BY `id` DESC") or die(mysqli_error());
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
		<td align="center" class="noprint">
			<a style="color:white" href="admin.php?action=AdminLostBookCard&&id=<?php echo $fetch['id']; ?>"><button type="button" class="catalog"><i class="glyphicon glyphicon-bookmark"></i> Card Catalog </button></a> 
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


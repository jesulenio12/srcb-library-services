<?php
// hedBookViewCopies.php

require 'conn.php';

if (isset($_GET['bookTitle'])) {
    $bookTitle = urldecode($_GET['bookTitle']);
    $query = mysqli_query($conn, "SELECT * FROM books WHERE bookTitle = '$bookTitle' AND bookSection != 'Periodical' AND lost = 0 AND discarded = 0 AND libraryClass = 'High School Library'") or die(mysqli_error());

    while ($fetch = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td>#</td>
            <td><?php echo $fetch['bookAccession'] ?></td>
            <td><?php echo $fetch['isbn'] ?></td>
            <td><?php echo $fetch['callNumber'] ?></td>
            <td><?php echo $fetch['author'] ?></td>
            <td><?php echo $fetch['authorNumber'] ?></td>
            <td><?php echo $fetch['subject'] ?></td>
            <td><?php echo $fetch['publisher'] ?></td>
            <td><?php echo $fetch['datePublished'] ?></td>
            <td><?php echo $fetch['bookSection'] ?></td>
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
                <form method="POST" action="admin.php?action=HighSchoolBookCard&bookTitle=<?php echo urlencode($_GET['bookTitle']); ?>&id=<?php echo $fetch['id']; ?>" style="display:inline">
					<button class="bookbtn1" type="submit">
						<i class="glyphicon glyphicon-bookmark"></i>
					</button>
				</form>
				<form method="POST" action="admin.php?action=HighSchoolBookEdit&bookTitle=<?php echo urlencode($_GET['bookTitle']); ?>&id=<?php echo $fetch['id']; ?>" style="display:inline">
					<button class="bookbtn1" type="submit">
						<i class="glyphicon glyphicon-edit"></i>
					</button>
				</form>
				<?php require_once('discard-confirm.php'); ?>
				<form method="POST" action="" style="display:inline">
					<input type="hidden" name="discard" value="<?php echo urlencode($fetch['id']); ?>">
					<button class="bookbtn1" type="button" data-toggle="modal" data-target="#confirmDiscard" data-title="Confirm Discard">
						<i class="fa fa-ban"></i>
					</button>
				</form>
				<?php require_once ('lost-confirm.php');?>
				<form method="POST" action="" style="display:inline">
					<input type="hidden" name="lost" value="<?php echo urlencode($fetch['id']); ?>">
					<button class="bookbtn1" type="button" data-toggle="modal" data-target="#confirmLost" data-title="Confirm Lost">
						<i class="glyphicon glyphicon-remove"></i>
					</button>
				</form>
			</td>
        </tr>
<?php
    }
} else {
    // Handle the case where bookTitle is not set
    echo "Book title is not set.";
}
?>

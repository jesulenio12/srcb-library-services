<?php
require 'conn.php';
require_once 'core/init.php';

if (isset($_POST['filterbook'])) {
    $filters = array();

    // Check if each filter is set and not empty
    if (!empty($_POST['bookImageTitle'])) {
        $bookImageTitle = $_POST['bookImageTitle'];
        $filters[] = "bookImageTitle LIKE '$bookImageTitle%'";
    }

	if (!empty($_POST['bookImageAuthor'])) {
        $bookImageAuthor = $_POST['bookImageAuthor'];
        $filters[] = "bookImageAuthor LIKE '$bookImageAuthor%'";
    }
	if (!empty($_POST['bookdatePublished'])) {
        $bookdatePublished = $_POST['bookdatePublished'];
        $filters[] = "bookdatePublished LIKE '$bookdatePublished%'";
    }

	if (!empty($_POST['bookImageSection'])) {
        $bookImageSection = $_POST['bookImageSection'];
        $filters[] = "bookImageSection LIKE '$bookImageSection%'";
    }

    // Construct the WHERE clause based on the filters
    $whereClause = implode(' AND ', $filters);

    // Execute the query with the constructed WHERE clause
    $query = mysqli_query($conn, "SELECT * FROM `bookimages` WHERE bookImageLibClass = 'High School Library' " . ($whereClause ? " AND $whereClause" : "") . " ORDER BY `id` DESC") or die(mysqli_error($conn));
	$row = mysqli_num_rows($query);

    if ($row > 0) {
        while ($fetch = mysqli_fetch_array($query)) {
            ?>
           	<div class="row mt-5">
				<div class="col-md-4" style="margin:10px 10px 10px 10px; padding-left:40px;" class="column">
					<div class="card">
						<div class="card-body">
							<div class="card-label-button">
								<?php require_once ('delete-confirm.php');?>
								<form method="post" action="hs_delete_book_image.php">
									<input type="hidden" name="bookImageId" value="<?php echo $fetch['id']; ?>">
									<button type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Confirm Delete" class="btn btn-primary mt-2"><i class="glyphicon glyphicon-remove"></i></button>
								</form>
							</div>
							<img src="admin/hsBookImages/<?php echo $fetch['bookImage']?>" width="250px" height="350px" class="card-img-qr">
							<br><br><br>
							<p class="card-text" style="margin-top:-25px">
								<span style="font-size: 15px; font-weight: bolder;">
									<?php echo $fetch['bookImageTitle']?>
								</span>
							</p>
						</div>
					</div>
				</div>
			</div>
            <?php
        }
    } else {
        // Handle case when no rows are found
        echo "No results found.";
    }
} else {
    $query = mysqli_query($conn, "SELECT * FROM `bookimages` WHERE bookImageLibClass = 'High School Library' ORDER BY `id` DESC") or die(mysqli_error($conn));
	$row = mysqli_num_rows($query);

    if ($row > 0) {
        while ($fetch = mysqli_fetch_array($query)) {
            ?>
           	<div class="row mt-5">
				<div class="col-md-4" style="margin:10px 10px 10px 10px; padding-left:40px;" class="column">
					<div class="card">
						<div class="card-body">
							<div class="card-label-button">
								<?php require_once ('delete-confirm.php');?>
								<form method="post" action="hs_delete_book_image.php">
									<input type="hidden" name="bookImageId" value="<?php echo $fetch['id']; ?>">
									<button type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Confirm Delete" class="btn btn-primary mt-2"><i class="glyphicon glyphicon-remove"></i></button>
								</form>
							</div>
							<img src="admin/hsBookImages/<?php echo $fetch['bookImage']?>" width="250px" height="350px" class="card-img-qr">
							<br><br><br>
							<p class="card-text" style="margin-top:-25px">
								<span style="font-size: 15px; font-weight: bolder;">
									<?php echo $fetch['bookImageTitle']?>
								</span>
							</p>
						</div>
					</div>
				</div>
			</div>
            <?php
        }
    }
}

?>

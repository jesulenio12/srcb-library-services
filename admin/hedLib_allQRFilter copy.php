<?php
require 'conn.php';

if (isset($_POST['filterbook'])) {
    $filters = array();

    // Check if each filter is set and not empty
    if (!empty($_POST['date1']) && !empty($_POST['date2'])) {
        $date1 = date("Y-m-d", strtotime($_POST['date1']));
        $date2 = date("Y-m-d", strtotime($_POST['date2']));
        $filters[] = "date(`dateQRfilter`) BETWEEN '$date1' AND '$date2'";
    }

    if (!empty($_POST['bookTitle'])) {
        $bookTitle = $_POST['bookTitle'];
        $filters[] = "bookTitle LIKE '$bookTitle%'";
    }

    if (!empty($_POST['author'])) {
        $author = $_POST['author'];
        $filters[] = "author LIKE '$author%'";
    }

    if (!empty($_POST['datePublished'])) {
        $datePublished = $_POST['datePublished'];
        $filters[] = "datePublished LIKE '$datePublished%'";
    }

	if (!empty($_POST['publisher'])) {
        $publisher = $_POST['publisher'];
        $filters[] = "publisher LIKE '$publisher%'";
    }

	if (!empty($_POST['bookSection'])) {
        $bookSection = $_POST['bookSection'];
        $filters[] = "bookSection LIKE '$bookSection%'";
    }

    // Construct the WHERE clause based on the filters
    $whereClause = implode(' AND ', $filters);

    // Execute the query with the constructed WHERE clause
    $query = mysqli_query($conn, "SELECT * FROM `books` WHERE bookSection != 'Periodical' AND lost='0' AND discarded='0' AND libraryClass = 'College Library' " . ($whereClause ? " AND $whereClause" : "") . " ORDER BY `id` DESC") or die(mysqli_error());

    $row = mysqli_num_rows($query);
    if ($row > 0) {
        while ($fetch = mysqli_fetch_array($query)) {
            ?>
           	<div class="row mt-5">
				<div class="col-md-4" style="margin:10px 10px 10px 10px; padding-left:40px;" class="column">
					<div class="card">
						<div class="card-body">
							<div class="card-label-button">
								<span class="dateFilter"><?php echo date('m-d-Y', strtotime($fetch['dateQRfilter'])); ?></span>
								<form method="post" action="hed_move_library_book.php">
									<input type="hidden" name="bookAccession" value="<?php echo $fetch['bookAccession']; ?>">
									<button type="submit" class="btn btn-primary mt-2"><i class="fa fa-arrow-right"></i></button>
								</form>
							</div>
							<span style="font-family:Arial; font-size:10px">
								<?php echo substr($fetch['bookAccession'], 4, 255);?> | <?php echo $fetch['bookSection']?><br>
							</span>
							<img src="admin/hedBookQRCodes/<?php echo $fetch['qrcode']?>" width="170px" height="140px" class="card-img-qr">
							<br><br>
							<p class="card-text" style="margin-top:-25px">
								<span style="font-size:10px">
									<?php echo $fetch['bookTitle']?>
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
    $query = mysqli_query($conn, "SELECT * FROM `books` WHERE bookSection != 'Periodical' AND lost='0' AND discarded='0' AND libraryClass = 'College Library' ORDER BY `id` DESC") or die(mysqli_error());
    
    while ($fetch = mysqli_fetch_array($query)) {
        ?>
		<div class="row mt-5">
			<div class="col-md-4" style="margin:10px 10px 10px 10px; padding-left:40px;" class="column">
				
				<div class="card">
					<div class="card-body">
						<div class="card-label-button">
							<span class="dateFilter"><?php echo date('m-d-Y', strtotime($fetch['dateQRfilter'])); ?></span>
							<form method="post" action="hed_move_library_book.php">
								<input type="hidden" name="bookAccession" value="<?php echo $fetch['bookAccession']; ?>">
								<button type="submit" class="btn btn-primary mt-2"><i class="fa fa-arrow-right"></i></button>
							</form>
						</div>
						<span style="font-family:Arial; font-size:10px">
							<?php echo substr($fetch['bookAccession'], 4, 255);?> | <?php echo $fetch['bookSection']?><br>
						</span>
						<img src="admin/hedBookQRCodes/<?php echo $fetch['qrcode']?>" width="170px" height="140px" class="card-img-qr">
						<br><br>
						<p class="card-text" style="margin-top:-25px">
							<span style="font-size:10px">
								<?php echo $fetch['bookTitle']?>
							</span>
						</p>
					</div>
				</div>
			</div>
		</div>
        <?php
    }
}

?>

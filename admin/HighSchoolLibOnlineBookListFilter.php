<?php
require 'conn.php';
require_once 'core/init.php';

if (isset($_POST['filterbook'])) {
    $filters = array();

    // Check if each filter is set and not empty
    if (!empty($_POST['bookTitle'])) {
        $bookTitle = $_POST['bookTitle'];
        $filters[] = "bookTitle LIKE '$bookTitle%'";
    }

    if (!empty($_POST['bookSection'])) {
        $bookSection = $_POST['bookSection'];
        $filters[] = "bookSection LIKE '$bookSection%'";
    }

	if (!empty($_POST['author'])) {
        $author = $_POST['author'];
        $filters[] = "author LIKE '$author%'";
    }

	if (!empty($_POST['datePublished'])) {
        $datePublished = $_POST['datePublished'];
        $filters[] = "datePublished LIKE '$datePublished%'";
    }

    // Construct the WHERE clause based on the filters
    $whereClause = implode(' AND ', $filters);

    // Identify the borrowed books using bookAccession
    $borrowedBooksQuery = mysqli_query($conn, "SELECT DISTINCT bookAccession FROM books WHERE status = 'Not Available' AND libraryClass = 'High School Library'") or die(mysqli_error());
    $borrowedBooks = array();
    while ($row = mysqli_fetch_array($borrowedBooksQuery)) {
        $borrowedBooks[] = $row['bookAccession'];
    }

    // Execute the query with the constructed WHERE clause and exclude borrowed books
    $query = mysqli_query($conn, "SELECT b.*, i.bookImage, COUNT(*) as availableCopies
        FROM books b 
        LEFT JOIN bookimages i ON b.bookTitle = i.bookImageTitle
        AND b.author = i.bookImageAuthor
        AND b.datePublished = i.bookDatePublished
        WHERE b.bookSection != 'General References' AND b.bookSection != 'Dictionaries' AND libraryClass = 'High School Library'
        AND b.bookAccession NOT IN ('" . implode("','", $borrowedBooks) . "') 
        " . ($whereClause ? " AND $whereClause" : "") . " GROUP BY b.bookTitle, b.author, b.datePublished ORDER BY b.id DESC") or die(mysqli_error());

    $row = mysqli_num_rows($query);
    if ($row > 0) {
        while ($fetch = mysqli_fetch_array($query)) {
            ?>
            <div class="row mt-5">
                <div class="col-md-4" class="column">
                    <div class="card">
                        <div class="card-body">
                            <?php if (!empty($fetch['bookImage'])) { ?>
                                <img src="admin/hsBookImages/<?php echo $fetch['bookImage']; ?>" width="250px" height="350px" class="card-img-qr">
                            <?php } else { ?>
                                <img src="admin/images/default.png" width="250px" height="350px" class="card-img-qr">
                            <?php } ?>
                            <br>
                            <div class="card-text">
                                <span style="font-size:18px; font-family: fantasy"><?php echo $fetch['bookTitle']?></span><br>
                                <span style="font-family: sans-serif;"><?php echo $fetch['callNumber']?></span><br>
                                <span style="font-weight: 900; font-family: math; font-size: 16px;"><?php echo $fetch['bookSection']?></span><br>
                                <div class="line-container">
                                    <div class="line-text"><?php echo "x".$fetch['availableCopies']; ?></div>
                                </div>
                            </div>
                        </div>
						<form method="POST" action="hs_request_book_online.php" style="display:inline">
							<input type="hidden" name="libraryClass" value="<?php echo $fetch['libraryClass']  ?>">
							<input type="hidden" name="transactionPlace" value="<?php echo $fetch['transactionPlace']  ?>">
							<input type="hidden" name="bookAccession" value="<?php echo $fetch['bookAccession']  ?>">
							<input type="hidden" name="callNumber" value="<?php echo $fetch['callNumber']  ?>">
							<input type="hidden" name="bookSection" value="<?php echo $fetch['bookSection']  ?>">
							<input type="hidden" name="bookTitle" value="<?php echo $fetch['bookTitle']  ?>">
							<input type="hidden" name="author" value="<?php echo $fetch['author']  ?>">
							<input type="hidden" name="datePublished" value="<?php echo $fetch['datePublished']  ?>">
							<input type="hidden" class="form-control" id="userType" name="userType" value="<?php echo $_SESSION['permissionRole']; ?>" required>
							<input type="hidden" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" required>
							<input type="hidden" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" required>
							<input type="hidden" class="form-control" id="library_userID" name="library_userID" value="<?php echo $_SESSION['username']; ?>" required>
							<input type="hidden" class="form-control" id="gender" name="gender" value="<?php echo $_SESSION['gender']; ?>" required>
							<input type="hidden" class="form-control" id="yearLevel" name="yearLevel" value="<?php echo $_SESSION['yearLevel']; ?>" required>
							<input type="hidden" class="form-control" id="classSection" name="classSection" value="<?php echo $_SESSION['classSection']; ?>" required>
							<input type="hidden" class="form-control" id="progtrack" name="progtrack" value="<?php echo $_SESSION['progtrack']; ?>" required>
							<input type="hidden" class="form-control" id="departmentType" name="departmentType" value="<?php echo $_SESSION['departmentType']; ?>" required>
							<div class="bookButtons">
								<button class="btnreq" style="background: white; color: #3db166;" type="button" data-toggle="modal" data-target="#moreInfo" data-bookdescription="<?php echo $fetch['bookDescription']; ?>" data-bookaccession="<?php echo $fetch['bookAccession']; ?>" data-title="<?php echo $fetch['bookTitle']; ?>" data-author="<?php echo $fetch['author']; ?>" data-callnumber="<?php echo $fetch['callNumber']; ?>" data-isbn="<?php echo $fetch['isbn']; ?>" data-publisher="<?php echo $fetch['publisher']; ?>" data-datepublished="<?php echo $fetch['datePublished']; ?>" data-section="<?php echo $fetch['bookSection']; ?>" data-image="<?php echo $fetch['bookImage']; ?>">	
									<i class="fa fa-info"></i>
								</button>
								<button class="btnreq" type="button" data-toggle="modal" data-target="#confirmRequest" data-title="Request Confirmation" data-message="Are you sure you want to borrow this?">	
								<i class="fa fa-share-square"></i>
								</button>
							</div>
						</form>
                    </div>
                </div>
                <!-- MODAL -->
				<div class="modal fade" id="confirmRequest" tabindex="-1" role="dialog" aria-labelledby="confirmRequestLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
							<div class="modal-header">
								<br>
								<center>
									<div class="tb-title">
										<div class="small-box">
											<p>
												Confirm Request
											</p>
										</div>
									</div>
								</center>
							</div>
							<div class="modal-body" >
								<center>
									<p  style="font-size:30px"> Are you sure you want to request this?</p>
								</center>
							</div>
							<div class="modal-footer">
								<div class="btnrow">
									<div class="col-md-6">
										<button type="button" class="btnupdate" id="confirm">Request</button>
									</div>
									<div class="col-md-6">
										<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="moreInfo" tabindex="-1" role="dialog" aria-labelledby="moreInfoLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm">
						<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
							<div class="modal-body" >
								<center>
									<img id="bookImage" width="250px" height="350px" class="card-img-qr">
									<br>
									<div class="modal-text">
										<strong>Description:</strong><br>
										<span id="bookDescription"></span><br>
										<strong></strong><br> 
										<span id="bookAccession"></span><br>
										<strong>Title:</strong><br> 
										<span id="bookTitle"></span><br>
										<strong>Author:</strong><br> 
										<span id="author"></span><br>
										<strong>Call No.:</strong><br> 
										<span id="callNumber"></span><br>
										<strong>ISBN:</strong><br> 
										<span id="isbn"></span><br>
										<strong>Publisher:</strong><br> 
										<span id="publisher"></span><br>
										<strong>© Year:</strong><br> 
										<span id="datePublished"></span><br>
										<strong>Book Section:</strong><br> 
										<span id="bookSection"></span><br><br>
										<div class="line-container">
											<div class="line-text"><?php echo "x".$fetch['availableCopies']; ?></div>
										</div>
									</div>
								</center>
							</div>
							<!-- <div class="modal-footer">
								<div class="btnrow">
									<div class="col-md-6">
										<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div> -->
							<div class="bookButtons">
								<button class="btnreq" style="background: white; color: #3db166;" type="button" data-dismiss="modal">	
									Cancel
								</button>
							</div>
							<br>
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
    // Identify the borrowed books using bookAccession
    $borrowedBooksQuery = mysqli_query($conn, "SELECT DISTINCT bookAccession FROM books WHERE status = 'Not Available' AND libraryClass = 'High School Library'") or die(mysqli_error());
    $borrowedBooks = array();
    while ($row = mysqli_fetch_array($borrowedBooksQuery)) {
        $borrowedBooks[] = $row['bookAccession'];
    }

    // Execute the query and exclude borrowed books
    $query = mysqli_query($conn, "SELECT b.*, i.bookImage, COUNT(*) as availableCopies
        FROM books b 
        LEFT JOIN bookimages i ON b.bookTitle = i.bookImageTitle
        AND b.author = i.bookImageAuthor
        AND b.datePublished = i.bookDatePublished
        WHERE b.bookSection != 'General References' AND b.bookSection != 'Dictionaries' AND libraryClass = 'High School Library'
        AND b.bookAccession NOT IN ('" . implode("','", $borrowedBooks) . "') 
        GROUP BY b.bookTitle, b.author, b.datePublished ORDER BY b.id DESC") or die(mysqli_error());

    while ($fetch = mysqli_fetch_array($query)) {
        ?>
        <div class="row mt-5">
            <div class="col-md-4" class="column">
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty($fetch['bookImage'])) { ?>
                            <img src="admin/hsBookImages/<?php echo $fetch['bookImage']; ?>" width="250px" height="350px" class="card-img-qr">
                        <?php } else { ?>
                            <img src="admin/images/default.png" width="250px" height="350px" class="card-img-qr">
                        <?php } ?>
                        <br>
                        <div class="card-text">
                            <span style="font-size:18px; font-family: fantasy"><?php echo $fetch['bookTitle']?></span><br>
                            <span style="font-family: sans-serif;"><?php echo $fetch['callNumber']?></span><br>
                            <span style="font-weight: 900; font-family: math; font-size: 16px;"><?php echo $fetch['bookSection']?></span><br>
                            <div class="line-container">
                                <div class="line-text"><?php echo "x".$fetch['availableCopies']; ?></div>
                            </div>
                        </div>
                    </div>
					<form method="POST" action="hs_request_book_online.php" style="display:inline">
						<input type="hidden" name="libraryClass" value="<?php echo $fetch['libraryClass']  ?>">
						<input type="hidden" name="transactionPlace" value="<?php echo $fetch['transactionPlace']  ?>">
						<input type="hidden" name="bookAccession" value="<?php echo $fetch['bookAccession']  ?>">
						<input type="hidden" name="callNumber" value="<?php echo $fetch['callNumber']  ?>">
						<input type="hidden" name="bookSection" value="<?php echo $fetch['bookSection']  ?>">
						<input type="hidden" name="bookTitle" value="<?php echo $fetch['bookTitle']  ?>">
						<input type="hidden" name="author" value="<?php echo $fetch['author']  ?>">
						<input type="hidden" name="datePublished" value="<?php echo $fetch['datePublished']  ?>">
						<input type="hidden" class="form-control" id="userType" name="userType" value="<?php echo $_SESSION['permissionRole']; ?>" required>
						<input type="hidden" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" required>
						<input type="hidden" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" required>
						<input type="hidden" class="form-control" id="library_userID" name="library_userID" value="<?php echo $_SESSION['username']; ?>" required>
						<input type="hidden" class="form-control" id="gender" name="gender" value="<?php echo $_SESSION['gender']; ?>" required>
						<input type="hidden" class="form-control" id="yearLevel" name="yearLevel" value="<?php echo $_SESSION['yearLevel']; ?>" required>
						<input type="hidden" class="form-control" id="classSection" name="classSection" value="<?php echo $_SESSION['classSection']; ?>" required>
						<input type="hidden" class="form-control" id="progtrack" name="progtrack" value="<?php echo $_SESSION['progtrack']; ?>" required>
						<input type="hidden" class="form-control" id="departmentType" name="departmentType" value="<?php echo $_SESSION['departmentType']; ?>" required>
						<div class="bookButtons">
							<button class="btnreq" style="background: white; color: #3db166;" type="button" data-toggle="modal" data-target="#moreInfo" data-bookdescription="<?php echo $fetch['bookDescription']; ?>" data-bookaccession="<?php echo $fetch['bookAccession']; ?>" data-title="<?php echo $fetch['bookTitle']; ?>" data-author="<?php echo $fetch['author']; ?>" data-callnumber="<?php echo $fetch['callNumber']; ?>" data-isbn="<?php echo $fetch['isbn']; ?>" data-publisher="<?php echo $fetch['publisher']; ?>" data-datepublished="<?php echo $fetch['datePublished']; ?>" data-section="<?php echo $fetch['bookSection']; ?>" data-image="<?php echo $fetch['bookImage']; ?>">	
								<i class="fa fa-info"></i>
							</button>
							<button class="btnreq" type="button" data-toggle="modal" data-target="#confirmRequest" data-title="Request Confirmation" data-message="Are you sure you want to borrow this?">	
							<i class="fa fa-share-square"></i>
							</button>
						</div>
					</form>
                </div>
            </div>
            <!-- MODAL -->
			<div class="modal fade" id="confirmRequest" tabindex="-1" role="dialog" aria-labelledby="confirmRequestLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
						<div class="modal-header">
							<br>
							<center>
								<div class="tb-title">
									<div class="small-box">
										<p>
											Confirm Request
										</p>
									</div>
								</div>
							</center>
						</div>
						<div class="modal-body" >
							<center>
								<p  style="font-size:30px"> Are you sure you want to request this?</p>
							</center>
						</div>
						<div class="modal-footer">
							<div class="btnrow">
								<div class="col-md-6">
									<button type="button" class="btnupdate" id="confirm">Request</button>
								</div>
								<div class="col-md-6">
									<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="moreInfo" tabindex="-1" role="dialog" aria-labelledby="moreInfoLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
						<div class="modal-body" >
							<center>
								<img id="bookImage" width="250px" height="350px" class="card-img-qr">
								<br>
								<div class="modal-text">
									<strong>Description:</strong><br>
									<span id="bookDescription"></span><br>
									<strong></strong><br> 
									<span id="bookAccession"></span><br>
									<strong>Title:</strong><br> 
									<span id="bookTitle"></span><br>
									<strong>Author:</strong><br> 
									<span id="author"></span><br>
									<strong>Call No.:</strong><br> 
									<span id="callNumber"></span><br>
									<strong>ISBN:</strong><br> 
									<span id="isbn"></span><br>
									<strong>Publisher:</strong><br> 
									<span id="publisher"></span><br>
									<strong>© Year:</strong><br> 
									<span id="datePublished"></span><br>
									<strong>Book Section:</strong><br> 
									<span id="bookSection"></span><br><br>
									<div class="line-container">
										<div class="line-text"><?php echo "x".$fetch['availableCopies']; ?></div>
									</div>
								</div>
							</center>
						</div>
						<!-- <div class="modal-footer">
							<div class="btnrow">
								<div class="col-md-6">
									<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div> -->
						<div class="bookButtons">
							<button class="btnreq" style="background: white; color: #3db166;" type="button" data-dismiss="modal">	
								Cancel
							</button>
						</div>
						<br>
					</div>
				</div>
			</div>
        </div>
        <?php
    }
}
?>

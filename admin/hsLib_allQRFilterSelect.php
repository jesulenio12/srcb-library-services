<?php
require 'conn.php';

    $query = mysqli_query($conn, "SELECT * FROM `indivqrbook` WHERE libraryClass = 'High School Library' ORDER BY `id` DESC") or die(mysqli_error());
    
    while ($fetch = mysqli_fetch_array($query)) {
        ?>
		<div class="row mt-5">
			<div class="col-md-4" style="margin:10px 10px 10px 10px; padding-left:40px;" class="column">
				
				<div class="card">
					<div class="card-body">
                        <div class="card-label-button">
                            <form method="post" action="hs_return_library_book.php">
                                <input type="hidden" name="bookAccession" value="<?php echo $fetch['bookAccession']; ?>">
                                <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-arrow-left"></i></button>
                            </form>
                            <span class="dateFilter"><?php echo date('m-d-Y', strtotime($fetch['dateQRfilter'])); ?></span>
                        </div>
						<span style="font-family:Arial; font-size:10px">
							<?php echo substr($fetch['bookAccession'], 4, 255);?> | <?php echo $fetch['bookSection']?><br>
						</span>
						<img src="admin/hsBookQRCodes/<?php echo $fetch['qrcode']?>" width="170px" height="140px" class="card-img-qr">
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
?>

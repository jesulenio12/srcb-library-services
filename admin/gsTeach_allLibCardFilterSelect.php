<?php
require 'conn.php';

    $query = mysqli_query($conn, "SELECT * FROM `indivqrcard` WHERE archive = 0 && libraryClass = 'Grade School Library' && departmentType = 'Grade School Department' && userType = 'Teacher' ORDER BY `id` DESC") or die(mysqli_error());
    while ($fetch = mysqli_fetch_array($query)) {
        ?>
        <div class="row mt-5">
            <div class="col-md-4" style="margin:10px 10px 10px 10px;" class="column">
                <div class="card-label-button">
					<form method="post" action="gsTeach_return_library_card.php">
                        <input type="hidden" name="library_userID" value="<?php echo $fetch['library_userID']; ?>">
                        <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-arrow-left"></i></button>
                    </form>
                    <span class="dateFilter"><?php echo date('m-d-Y', strtotime($fetch['dateQRfilter'])); ?></span>
                </div>
                <div class="card" style="background:white; border: 5px solid; border-radius:10px; width:443px;">
                    <div class="card-body">
                        <h2 class="card-title"><img src="images/srcblogo.png" style="width:180px; height:50px; margin-top: -4px" class="card-img-logo"/></h2>
                        <hr style="border-top:2px solid #3db166; margin-top:2px"/>    
                        <p class="card-text" style="margin-top:-17px">
                            <span class="name">
                                <?php echo $fetch['firstname']?> <?php echo $fetch['lastname']?>
                            </span>
                            <br>
                            <span class="details">
                                ID No.: <?php echo substr($fetch['library_userID'], 3, 255);?><br>
                                <?php echo $fetch['userType']?><br>
                                <?php 
                                    if($fetch['departmentType'] == 'Grade School Department'){
                                        echo "Grade School Dept.";
                                    }
                                ?>
                            </span>
                        </p>
                    </div>
                    <img src="admin/gsTeachQRCodes/<?php echo $fetch['qrcode'] ?>" width="200px" height="200px" style="border-radius:10px; margin-left:10px; margin-right:-10px;" class="card-img-qr">
                    <!-- Add a delete button -->
                </div>
            </div>
        </div>
        <?php
    }
?>

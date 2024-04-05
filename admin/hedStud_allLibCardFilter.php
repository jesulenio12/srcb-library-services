<?php
require 'conn.php';

if (isset($_POST['search'])) {
    $filters = array();

    // Check if each filter is set and not empty
    if (!empty($_POST['date1']) && !empty($_POST['date2'])) {
        $date1 = date("Y-m-d", strtotime($_POST['date1']));
        $date2 = date("Y-m-d", strtotime($_POST['date2']));
        $filters[] = "date(`dateQRfilter`) BETWEEN '$date1' AND '$date2'";
    }

    if (!empty($_POST['gender'])) {
        $gender = $_POST['gender'];
        $filters[] = "gender LIKE '$gender%'";
    }

    if (!empty($_POST['yearLevel'])) {
        $yearLevel = $_POST['yearLevel'];
        $filters[] = "yearLevel LIKE '$yearLevel%'";
    }

    if (!empty($_POST['progtrack'])) {
        $progtrack = $_POST['progtrack'];
        $filters[] = "progtrack LIKE '$progtrack%'";
    }

    if (!empty($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
        $filters[] = "firstname LIKE '$firstname%'";
    }

    if (!empty($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
        $filters[] = "lastname LIKE '$lastname%'";
    }

    // Construct the WHERE clause based on the filters
    $whereClause = implode(' AND ', $filters);

    // Execute the query with the constructed WHERE clause
    $query = mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Student' " . ($whereClause ? " AND $whereClause" : "") . " ORDER BY `id` DESC") or die(mysqli_error());

    $row = mysqli_num_rows($query);
    if ($row > 0) {
        while ($fetch = mysqli_fetch_array($query)) {
            ?>
            <div class="row mt-5">
                <div class="col-md-4" style="margin:10px 10px 10px 10px;" class="column">
                    <div class="card-label-button">
                        <span class="dateFilter"><?php echo date('m-d-Y', strtotime($fetch['dateQRfilter'])); ?></span>
                        <form method="post" action="hed_move_library_card.php">
                            <input type="hidden" name="library_userID" value="<?php echo $fetch['library_userID']; ?>">
                            <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-arrow-right"></i></button>
                        </form>
                    </div>
                    <div class="card" style="background:white; border: 5px solid <?php echo getColorByProgTrack($fetch['progtrack']); ?>; border-radius:10px; width:443px;">
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
                                    <?php echo $fetch['yearLevel']?> | <?php echo $fetch['progtrack']?><br>
                                    <?php 
										if($fetch['departmentType'] == 'Higher Education Department'){
											echo "Higher Education Dept.";
										}
									?>
                                </span>
                            </p>
                        </div>
                        <img src="admin/hedStudQRCodes/<?php echo $fetch['qrcode'] ?>" width="200px" height="200px" style="border-radius:10px; margin-left:10px; margin-right:-10px;" class="card-img-qr">
                        <!-- Add a delete button -->
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
    $query = mysqli_query($conn, "SELECT * FROM `userlogin` WHERE archive = 0 && libraryClass = 'College Library' && departmentType = 'Higher Education Department' && userType = 'Student' ORDER BY `id` DESC") or die(mysqli_error());
    
    while ($fetch = mysqli_fetch_array($query)) {
        ?>
        <div class="row mt-5">
            <div class="col-md-4" style="margin:10px 10px 10px 10px;" class="column">
                <div class="card-label-button">
                    <span class="dateFilter"><?php echo date('m-d-Y', strtotime($fetch['dateQRfilter'])); ?></span>
                    <form method="post" action="hed_move_library_card.php">
                        <input type="hidden" name="library_userID" value="<?php echo $fetch['library_userID']; ?>">
                        <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-arrow-right"></i></button>
                    </form>
                </div>
                <div class="card" style="background:white; border: 5px solid <?php echo getColorByProgTrack($fetch['progtrack']); ?>; border-radius:10px; width:443px;">
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
                                <?php echo $fetch['yearLevel']?> | <?php echo $fetch['progtrack']?><br>
                                <?php 
                                    if($fetch['departmentType'] == 'Higher Education Department'){
                                        echo "Higher Education Dept.";
                                    }
                                ?>
                            </span>
                        </p>
                    </div>
                    <img src="admin/hedStudQRCodes/<?php echo $fetch['qrcode'] ?>" width="200px" height="200px" style="border-radius:10px; margin-left:10px; margin-right:-10px;" class="card-img-qr">
                    <!-- Add a delete button -->
                </div>
            </div>
        </div>
        <?php
    }
}

// Your existing code

function getColorByProgTrack($progtrack)
{
    switch ($progtrack) {
        case 'BSIT':
            return '#B73135';
        case 'BSBA':
            return '#E9E633';
        case 'BSCRIM':
            return '#3A384B';
        case 'BSED':
            return '#5C60A4';
        case 'BEED':
            return '#5C60A4';
        case 'BSHM':
            return '#EF54AF';
        default:
            return '#000000'; // Default color
    }
}
?>

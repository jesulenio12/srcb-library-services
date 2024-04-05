<?php
require 'conn.php';

// Fetch the second and third most recent records
$fetch_query = mysqli_query($conn, "SELECT a.*, u.avatar, s.logoImage
    FROM `attendance` a 
    LEFT JOIN `userlogin` u ON a.library_userID = u.library_userID 
    LEFT JOIN `srcblogo` s ON u.progtrack = s.logoName 
    WHERE a.libraryClass = 'College Library' 
    AND MONTH(a.timeIn) = MONTH(CURRENT_DATE) 
    AND YEAR(a.timeIn) = YEAR(CURRENT_DATE) 
    ORDER BY a.id DESC 
    LIMIT 1, 2") or die(mysqli_error());

// Check if there are any entries
if(mysqli_num_rows($fetch_query) > 0) {
    while ($fetch = mysqli_fetch_array($fetch_query)) {
        // Query to count the total entries for the current user
        $count_query = mysqli_query($conn, "SELECT COUNT(*) AS total_entries FROM `attendance` WHERE libraryClass = 'College Library' AND library_userID = '{$fetch['library_userID']}'") or die(mysqli_error());
        $count_fetch = mysqli_fetch_assoc($count_query);
        $total_entries = $count_fetch['total_entries'];
?>
        <div class="st-avatar-row">
            <div class="col-md-6" class="column">
                <div class="st-card" style=" background-image: url('admin/images/background.jpg'); background-size: cover; background-position: center;">
                    <div class="st-avatar">
                        <?php if (!empty($fetch['avatar'])) { ?>
                            <img src="admin/UserAvatars/<?php echo $fetch['avatar']; ?>" alt="Avatar" style="border: 5px solid <?php echo getColorByProgTrack($fetch['progtrack']); ?>">
                        <?php } else { ?>
                            <img src="admin/images/logo.png" alt="Default Avatar">
                        <?php } ?>
                    </div>
                    <div class="st-card-body">
                        <h2 class="st-user-type" style="background:<?php echo getColorByUsertype($fetch['userType']);?>; color: white"><?php echo $fetch['userType']?></h2>
                        <p>
                            <span class="st-name"><?php echo $fetch['fullname']?></span><br>
                            <?php echo substr($fetch['library_userID'], 3, 255);?><br>
                            <?php echo $fetch['yearLevel']?><br>
                            <?php echo getCourseByProgTrack($fetch['progtrack']);?><br>
                            <?php echo $fetch['departmentType']?><br>
                            Total Logged: x<?php echo $total_entries; ?><br>
                            <span class="st-time-logged" style="background:<?php echo getColorByProgTrack($fetch['progtrack']); ?>">Time Logged: <?php echo date('d F Y | h:i A', strtotime($fetch['timeIn']));?></span><br>
                           
                        </p>
                    </div>
                     <div class="logoImage">
                        <?php if (!empty($fetch['logoImage'])) { ?>
                            <img src="admin/hedLogoImages/<?php echo $fetch['logoImage']; ?>" alt="Logo">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
?>
    <div class="st-avatar-row">
        <div class="col-md-6" class="column">
            <div class="st-card" style=" background-image: url('admin/images/background.jpg'); background-size: cover; background-position: center;">
                <div class="st-avatar">
                    <img src="admin/images/logo.png" alt="Default Avatar" style="border: 8px solid #3db166">
                </div>
                <div class="st-card-body">
                    <p>
                        <span class="name">No data shown. <br> Please scan your QR Code. <br> Thank you!</span><br>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
require 'conn.php';

// Fetch images and logo names from the "srcb" logo table
$fetch_query = mysqli_query($conn, "SELECT * FROM `srcblogo` WHERE logoName != 'BSED' AND logoClass = 'College Library'") or die(mysqli_error());

// Check if there are any entries
if(mysqli_num_rows($fetch_query) > 0) {
    while ($fetch = mysqli_fetch_array($fetch_query)) {
?>
        <div class="display-logo-row">
            <img src="admin/hedLogoImages/<?php echo $fetch['logoImage']; ?>">
        </div>
<?php
    }
}
?>

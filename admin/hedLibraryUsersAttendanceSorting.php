<?php
    require 'conn.php';
    
    // Fetch the latest record
    $fetch_query = mysqli_query($conn, "SELECT a.*, u.avatar, s.logoImage
    FROM `attendance` a 
    LEFT JOIN `userlogin` u ON a.library_userID = u.library_userID 
    LEFT JOIN `srcblogo` s ON u.progtrack = s.logoName 
    WHERE a.libraryClass = 'College Library' 
    AND MONTH(a.timeIn) = MONTH(CURRENT_DATE) 
    AND YEAR(a.timeIn) = YEAR(CURRENT_DATE) 
    ORDER BY a.id DESC 
    LIMIT 1") or die(mysqli_error());
    
    // Check if there are any entries
    if(mysqli_num_rows($fetch_query) > 0) {
        $fetch = mysqli_fetch_array($fetch_query);
        
        // Query to count the total entries for the current user
        $count_query = mysqli_query($conn, "SELECT COUNT(*) AS total_entries FROM `attendance` WHERE libraryClass = 'College Library' AND library_userID = '{$fetch['library_userID']}'") or die(mysqli_error());
        $count_fetch = mysqli_fetch_assoc($count_query);
        $total_entries = $count_fetch['total_entries'];
?>
    <div class="avatar-row">
        <div class="col-md-6" class="column">
			
            <div class="card" style=" background-image: url('admin/images/background.jpg'); background-size: cover; background-position: center;">
				<div class="avatar">
                    <?php if (!empty($fetch['avatar'])) { ?>
                        <img src="admin/UserAvatars/<?php echo $fetch['avatar']; ?>" alt="Avatar" style="border: 8px solid <?php echo getColorByProgTrack($fetch['progtrack']); ?>">
                    <?php } else { ?>
                        <img src="admin/images/logo.png" alt="Default Avatar">
                    <?php } ?>
                </div>
                <div class="card-body">
						<h2 class="user-type" style="background:<?php echo getColorByUsertype($fetch['userType']);?>; color: white"><?php echo $fetch['userType']?></h2>
                    <p>
                        <span class="name"><?php echo $fetch['fullname']?></span><br>
                        <?php echo substr($fetch['library_userID'], 3, 255);?><br>
                        <?php echo $fetch['yearLevel']?><br>
                        <?php echo getCourseByProgTrack($fetch['progtrack']);?><br>
                        <?php echo $fetch['departmentType']?><br>
						Total Logged: x<?php echo $total_entries; ?><br>
                        <span class="time-logged" style="background:<?php echo getColorByProgTrack($fetch['progtrack']); ?>">Time Logged: <?php echo date('d F Y | h:i A', strtotime($fetch['timeIn']));?></span><br>
                    </p>
                </div>
				<div class="logoImageScan">
					<?php if (!empty($fetch['logoImage'])) { ?>
						<img src="admin/hedLogoImages/<?php echo $fetch['logoImage']; ?>" alt="Logo">
					<?php } ?>
				</div>
            </div>
        </div>
    </div>
<?php
    } else {
?>
    <div class="avatar-row">
        <div class="col-md-6" class="column">
            <div class="card" style=" background-image: url('admin/images/background.jpg'); background-size: cover; background-position: center;">
                <div class="avatar">
                    <img src="admin/images/logo.png" alt="Default Avatar" style="border: 8px solid #3db166">
                </div>
                <div class="card-body">
                    <p>
						<span class="name">No data shown. <br> Please scan your QR Code. <br> Thank you!</span><br>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php
    }

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

function getColorByUsertype($userType)
	{
		switch ($userType) {
			case 'Teacher':
				return '#3db166';
			case 'Student':
				return '#163269';
			default:
				return '#000000'; // Default color
		}
	}

function getCourseByProgTrack($progtrack)
	{
		switch ($progtrack) {
			case 'BSIT':
				return 'Bachelor of Science in Information Technology';
			case 'BSBA':
				return 'Bachelor of Science in Business Administration';
			case 'BSCRIM':
				return 'Bachelor of Science in Criminology';
			case 'BSED':
				return 'Bachelor of Secondary Education';
			case 'BEED':
				return 'Bachelor of Elementary Education';
			case 'BSHM':
				return 'Bachelor of Science in Hospitality and Management';
			default:
				return ''; // Default course name
		}
	}
?>

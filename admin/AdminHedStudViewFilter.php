<?php
// hedBookViewCopies.php

require 'conn.php';

if (isset($_GET['library_userID'])) {
    $library_userID = urldecode($_GET['library_userID']);
    $query = mysqli_query($conn, "SELECT ul.*, sl.logoImage 
	FROM userlogin ul
	JOIN srcblogo sl ON ul.progtrack = sl.logoName
	WHERE ul.library_userID = '$library_userID' 
	AND ul.archive = 0 
	AND ul.libraryClass = 'College Library' 
	AND ul.departmentType = 'Higher Education Department' 
	AND ul.userType = 'Student';
	") or die(mysqli_error());

    while ($fetch = mysqli_fetch_array($query)) {
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
							<span class="name"><?php echo $fetch['firstname']?> <?php echo $fetch['lastname']?></span><br>
							<?php echo substr($fetch['library_userID'], 3, 255);?><br>
							<?php echo $fetch['yearLevel']?><br>
							<?php echo getCourseByProgTrack($fetch['progtrack']);?><br>
							<?php echo $fetch['departmentType']?><br>
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
		<div class="avatar-row">
			<div class="col-md-6">
				<div class="other-info-card">
					<p>
						<span class="other-info">Other Information</span><br>
						<?php
							if($fetch['gender'] != ''){
								echo $fetch['gender'];
							}else{
								echo '---';
							}
						?>
						<br>
						<?php
							if($fetch['age'] != ''){
								echo $fetch['age'];
							}else{
								echo '---';
							}
						?>
						<br>
						<?php
							if($fetch['address'] != ''){
								echo $fetch['address'];
							}else{
								echo '---';
							}
						?>
						<br>
						<?php
							if($fetch['strtzone'] != ''){
								echo $fetch['strtzone'];
							}else{
								echo '---';
							}
						?>
						<br>
						<?php
							if($fetch['email'] != ''){
								echo $fetch['email'];
							}else{
								echo '---';
							}
						?>
						<br>
						<?php
							if($fetch['contactNum'] != ''){
								echo $fetch['contactNum'];
							}else{
								echo '---';
							}
						?>
					</p>
				</div>
				<div class="secondary-info-card">
					<a style="color: #fff;" href="admin.php?action=hedStud_OnlineUserList">
						<button type="button" class="user-btn" style="background: white; color:#3db166"><i class="fa fa-arrow-left"></i> GO BACK</button>
					</a>
					<button class="user-btn" type="button" data-toggle="modal" data-target="#confirmReset" data-title="Confirm Reset">
						<i class="glyphicon glyphicon-refresh"></i> Reset
					</button>
					<?php
						if ($fetch['status'] == 'Active') {
							echo '
								<form method="POST" action="" style="display:inline">
									<input type="hidden" name="deactivate" value="' . urlencode($fetch['id']) . '">
									<button class="user-btn" style="background: #f70c13db" type="button" data-toggle="modal" data-target="#confirmDeactivate" data-title="Confirm Deactivate">
										<i class="glyphicon glyphicon-remove"></i> Deactivate
									</button>
								</form>';
							require_once('deactivate-confirm.php');
						} elseif ($fetch['status'] == 'Deactivated') {
							echo '
								<form method="POST" action="" style="display:inline">
									<input type="hidden" name="activate" value="' . urlencode($fetch['id']) . '">
									<button class="user-btn" type="button" data-toggle="modal" data-target="#confirmActivate" data-title="Confirm Activate">
										<i class="glyphicon glyphicon-remove"></i> Activate
									</button>
								</form>';
							require_once('activate-confirm.php');
						}
					?>

					<?php require_once('delete-confirm.php'); ?>
					<form method="POST" action="" style="display:inline">
						<input type="hidden" name="delete" value="<?php echo urlencode($fetch['id']); ?>">
						<button class="user-btn" style="background: #B73135" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Confirm Delete">
							<i class="glyphicon glyphicon-trash"></i>
						</button>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="confirmReset" tabindex="-1" role="dialog" aria-labelledby="confirmResetLabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="display: flex; justify-content: center">
				<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; width: 450px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<center>
								<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 9px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
									<p id="confirmResetLabel" style="font-size:28px; transform: scale(.7, 1); text-transform:uppercase">
										Reset Password
									</p>
								</div>
							</center>
					</div>
					<div class="modal-body">
						<form id="resetPasswordForm" enctype="multipart/form-data" method="post" action="">
						<input type="hidden" name="reset" value="<?php echo urlencode($fetch['id']); ?>">
							<div class="row">
								<div class="col-md-12">
									<div class="add-input-container"> 
										<span for="newPassword">New Password</span>
										<input type="password" class="add-input" id="newPassword" name="newPassword" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="add-input-container"> 
										<span for="confirmPassword">Confirm Password</span>
										<input type="password" class="add-input" id="confirmPassword" name="confirmPassword" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<center>
										<div id="confirmPasswordError" style="color: red;"></div>
									</center>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-md-6">
								<button type="submit" class="btnupdate" id="confirm"> Reset</button>
							</div>
							<div class="col-md-6">
								<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
<?php
    }
} else {
    // Handle the case where library_userID is not set
    echo "Student name is not set.";
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

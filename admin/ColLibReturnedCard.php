<?php
    require 'conn.php';
    
    // Fetch the latest record
    $fetch_query = mysqli_query($conn, "SELECT a.*, u.avatar FROM `booktransactions` a LEFT JOIN `userlogin` u ON a.library_userID = u.library_userID WHERE a.transactionType = 'return' && a.transactionPlace = 'Col-Lib' ORDER BY a.id DESC LIMIT 1") or die(mysqli_error());
    
    // Check if there are any entries
    if(mysqli_num_rows($fetch_query) > 0) {
        $fetch = mysqli_fetch_array($fetch_query);
?>
    <div class="avatar-row">
        <div class="col-md-6" class="column">
			
            <div class="card" style=" background-image: url('admin/images/background.jpg'); background-size: cover; background-position: center;">
				<div class="avatar">
                    <?php if (!empty($fetch['avatar'])) { ?>
                        <img src="admin/UserAvatars/<?php echo $fetch['avatar']; ?>" alt="Avatar" style="border: 5px solid <?php echo getColorByProgTrack($fetch['progtrack']); ?>">
                    <?php } else { ?>
                        <img src="admin/images/logo.png" alt="Default Avatar">
                    <?php } ?>
                </div>
                <div class="card-body">
						<h2 class="user-type" style="background:<?php echo getColorByUsertype($fetch['userType']);?>; color: white"><?php echo $fetch['userType']?></h2>
                        <span class="name"><?php echo $fetch['fullname']?></span><br>
                        <span class="sub-name" style="background:<?php echo getColorByProgTrack($fetch['progtrack']); ?>"><?php echo substr($fetch['library_userID'], 3, 255);?> | <?php echo $fetch['yearLevel']?> | <?php echo $fetch['progtrack']?></span><br><br>
                        <div class="card-row">
                            <div class="col-xs-6">
                                Book Returned:
                            </div>
                            <div class="col-xs-12">
                                <div class="card-group">
                                    <?php echo $fetch['bookTitle']?> (<?php echo $fetch['bookSection']?>)
                                </div>
                            </div>
                        </div>
                        <div class="card-row">
                            <div class="col-xs-6">
                                Date Returned:
                            </div>
                            <div class="col-xs-12">
                                <div class="card-group">
                                    <?php echo date('d F Y | h:i A', strtotime($fetch['transactionDate']));?>
                                </div>
                            </div>
                        </div>
                        <div class="card-row">
                            <div class="col-xs-6">
                                Remarks:
                            </div>
                            <div class="col-xs-12">
                                <div class="card-group">
                                    <?php if($fetch['remarks'] == 'Overdue'){?>
                                        <span class="label label-danger"> Overdue</span>
                                    <?php }else{?>
                                        <span class="label label-success"> Returned</span>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
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
                    <img src="admin/images/logo.png" alt="Default Avatar" style="border: 5px solid #3db166">
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
?>

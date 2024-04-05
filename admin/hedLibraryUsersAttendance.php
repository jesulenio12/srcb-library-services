<?php
require_once 'core/init.php';
require 'conn.php';

$user = new UserLogin(); //Current
$prev_id_entry = "";

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {  
			// $qrcodevaluechek = Input::get('qrcode');
			$qrcod = Input::get('library_userID');
			
			$query=mysqli_query($conn, "SELECT * FROM attendance ORDER BY id DESC LIMIT 1") or die(mysqli_error());
			$row=mysqli_num_rows($query);
			if($row>0){
				while($fetch=mysqli_fetch_array($query)){
					$prev_id_entry = $fetch['library_userID'];
				}
			}

			$attendance = new Attendance();
            try {
				if($prev_id_entry != $qrcod){
					$attendance->create(array(
						'library_userID' => Input::get('library_userID'),
						'userType' => Input::get('userType'),
						'fullname' => Input::get('firstname') . ' ' . Input::get('lastname'),
						'gender' => Input::get('gender'),
						'yearLevel' => Input::get('yearLevel'),
						'classSection' => Input::get('classSection'),
						'departmentType' => Input::get('departmentType'),
						'progtrack' => Input::get('progtrack'),
						'libraryClass' => Input::get('libraryClass'),
					));
					Session::flash('Log', 'Welcome to the Library, thank you for coming!');
					Redirect::to('admin.php?action=hedLibraryUsersAttendance');
				}

				if($prev_id_entry == $qrcod){
					Session::flash('ScannedAlready', 'You have scanned already!');
					Redirect::to('admin.php?action=hedLibraryUsersAttendance');
				}

            } catch(Exception $e) {
               $error;
            }
    }
}
	
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- School Seal -->
<link rel="icon" type="image/png" href="images/logo.png"/>
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/user/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/dailyusers.css">
<title>Daily Users Log</title>
</head>
<style>
	.datetime {
	    background: #fff;
		padding: 10px;
		border-radius: 10px 10px 0 0;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.time {
		font-size: 16px;
		margin-right: 13px;
		background: #3db166;
		border-radius: 5px;
		padding: 5px 12px;
		color: #fff;
		font-weight: 500;
		font-family: impact;
	}

	.date {
		font-size: 16px;
		color: #3db166;
		font-weight: bolder;
		font-family: Arial Black;
	}

	video#preview {
		border-radius: 0 0 10px 10px;
		height: 247px;
	}

	.video-box {
		margin: auto;
		width: 95%;
		border: 10px solid #dcdcdc;
		background-color: white;
		margin-left: 20px;
		margin-bottom: -19px;
		border-radius: 20px;
	}

	body {
        margin: 0;
        overflow: hidden; /* Hide scroll bars */
		background: transparent;
		background-size:cover;
		background-position:center center;
		background-repeat: no-repeat;
    }

	#video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1; /* Place it behind other content */
    }

	.card {
		display: flex;
		justify-content: flex-start;
		align-items: center;
		gap: 30px;
		position: relative;
		margin-top: -105px;
		border-radius: 15px;
		padding: 0px 0 0px 40px;
		height: 323px;
    	width: 730px;
		border: 5px solid #3db166;
	}

	.avatar img {
		height: 260px;
		width: auto;
		border-radius: 50%;
	}

	span.name {
		font-size: 20px;
		font-weight: 500;
		font-family: fantasy;
	}

	.card-body p {
		font-size: 15px;
		font-family: math;
		font-weight: 500;
		color: white;
	}

	span.time-logged {
		color: white;
		padding: 2px 5px;
		border-radius: 3px;
	}

	.user-type {
		font-size: 15px;
		font-family: sans-serif;
		font-weight: 600;
		text-transform: uppercase;
		padding: 4px 6px 1px 6px;
		border-radius: 5px;
		border: 1px solid white;
		width: fit-content;
	}

	.logoImageScan {
		position: absolute;
    	display: flex;
	}

	.logoImageScan img {
		width: auto;
		height: 80px;
		position: relative;
		bottom: 85px;
    	left: 565px;
		filter: drop-shadow(10px 5px 10px black);
	}

	.small-box.bg {
		display: flex;
		justify-content: center;
		margin-bottom: 15px;
	}

	.small-box {
		background-image: url(./images/nav2.jfif);
		background-size: cover;
		background-position: center center;
		background-repeat: no-repeat;
		padding: 23px 0px 10px 0px;
		width: 98%;
		height: 110px;
		box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418);
		color: #163269;
		border-radius: 20px;
		border: 7px solid #3db166;
	}

	.small-box p {
		font-size: 30px;
		font-family: arial;
		font-weight: 900;
		transform: scale(2, 2);
		padding-top: 4px;
	}

	.small-box img {
		width: 40px;
		height: auto;
		margin-top: -8px;
	}

	.text-divider {
		--text-divider-gap: 1rem;
		display: flex;
		align-items: center;
		font-size: 25px;
		text-transform: uppercase;
		letter-spacing: 0.1em;
		font-weight: bolder;
		font-family: Arial Black;
		margin-bottom: 30px;
		color: white;
		padding: 0px 75px 0px 75px;
	}
	
	.text-divider::before, .text-divider::after {
		content: '';
		height: 6px;
		background-color: white;
		flex-grow: 1;
		border-radius: 10px;
	}

	.text-divider::before {
		margin-right: var(--text-divider-gap);
	}

	.text-divider::after {
		margin-left: var(--text-divider-gap);
	}

	.copyright {
		background-color: #163269;
		height: 50px;
		color: white;
		font-size: 12px;
		padding: 16px 0 0 0;
		text-align: center;
		position: relative;
	}

</style>
<body>

	<video id="video-background" autoplay muted loop>
        <source src="video/BackgoundVideo.mp4" type="video/mp4">
    </video>
        <!-- header logo: style can be found in header.less -->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="center">
                <!-- Content Header (Page header) -->
                <section class="center">
					<br>
					<center>
						<div class="small-box bg">
							<p style="color: #163269">
								<img src="images/logo.png"/>
									DAILY USERS LOG
								<img src="images/qrcode.jpg"/>
							</p>
						</div>
						<h1 class="text-divider"> PLEASE SCAN YOUR LIBRARY QR CODE HERE </h1>
					</center>
                </section>

                <!-- Main content -->
				
			<section class="center">
				<div class="row" style="margin-top:-15px">
					<div class="col-xs-12" style="padding: 0px 50px 0px 50px; margin-top: 13px;margin-bottom: 14px;">
						<div class="box box-attendance" style="background-color: rgba(255, 255, 255, 0.239); border-radius:20px; box-shadow: 0 4px 20px rgb(0 0 0 / 99%)">
						<br>
							<div class="box-body" style="margin-top: -18px;">
								<div class="row">
									<form enctype="multipart/form-data" method="post" action="">
										<input type="hidden" name="libraryClass" id="libraryClass" value="College Library">
										<div class="row">
											<div class="col-xs-5">
												<div class="row">
													<div class="col-xs-12">
														<div class="video-box">
															<div class="datetime">
																<div class="time"></div>
																<div class="date"></div>
															</div>
															<video width="100%" id="preview"></video>
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-xs-12">
														<span id="msg" name="msg">
															<?php if(Session::exists('Log')){ ?>
																<div class="alert alert-success">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Log'); ?>
																</div>
															<?php }?> 
															<?php if(Session::exists('Cooldown')){ ?>
																<div class="alert alert-success">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Cooldown'); ?>
																</div>
															<?php }?> 
															<?php if(Session::exists('ScannedAlready')){ ?>
																<div class="alert alert-danger">
																	<i class="glyphicon glyphicon-remove"></i> &nbsp;<?php echo Session::flash('ScannedAlready'); ?>
																</div>
															<?php }?> 
														</span>
													</div>
													<!--  -->
													<div class="col-xs-12">
														<!-- <span style="display:none"id="qrinvalid" name="qrinvalid"> QR code invalid
														</span> -->
														<div style="display:none" id="qrinvalid" name="qrinvalid" class="alert alert-danger" >
															<i class="glyphicon glyphicon-remove"></i> QR Code Error.
														</div>
													</div>
														<audio src="admin/beep.mp3" id="audio" preload="auto" controls style="display:none"></audio>
														<!-- <audio src="admin/error.mp3" id="errorAudio" preload="auto" controls style="display:none"></audio> -->
												</div>
											</div>
											<div class="col-xs-7" style="margin-top: -30px; color:white; text-transform:uppercase;">
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="library_userID">ID Number</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="library_userID" name="library_userID" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="userType">Log Type</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="userType" name="userType" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="firstname"> Firstname</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="firstname" name="firstname" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="lastname"> Lastname</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="lastname" name="lastname" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="gender"> Gender</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="gender" name="gender" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="yearLevel"> Year Level</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="yearLevel" name="yearLevel" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="classSection"> Year Level</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="classSection" name="classSection" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="departmentType"> Year Level</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="departmentType" name="departmentType" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="progtrack">Program</label> -->
													</div>
													<div class="col-xs-1">
														<div class="form-group">
															<input type="hidden" class="form-control" id="progtrack" name="progtrack" readonly onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-11">
														<input type="hidden" style="display:none;" name="token" value="<?php echo Token::generate(); ?>">
														<button type="submit" style="display:none;" name="attendancelogs" id="attendancelogs"></button>
													</div>
												</div>
											</div>
											<?php include 'hedLibraryUsersAttendanceSorting.php'?>	
										</div>
									</form>
								</div>
							</div><!-- /.box -->
						</div><!-- /.box -->
					</div><!-- /.col -->
				</div><!-- /.row (main row) -->
				<div class="copyright">
					<?php include 'includes/footer.html'; ?>
				</div>
			</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		
<script src="js/enter.js"></script>
<script src="js/jquery3.3.1.min.js"></script>
<script src="js/instascan.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#log").dataTable();
	});

	setTimeout(function(){
		document.getElementById("msg").style.display = "none";
	}, 5000);

	setTimeout(function(){
		document.getElementById("qrinvalid").style.display = "none";
	}, 5000);
</script>
<script type="text/javascript">

$(document).ready(function() {
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    scanner.addListener('scan', function(content) {
        let library_userID = content;
        let qrcodesubstring = library_userID.substring(0, 3);

        $.ajax({
            type: "POST",
            url: "attendance.php",
            dataType: "json",
            data: { library_userID: library_userID, action: 'view_users_info' },
            success: function(data) {
                $("#library_userID").val(data.userid);
                $("#userType").val(data.userType);
                $("#firstname").val(data.firstname);
                $("#lastname").val(data.lastname);
                $("#gender").val(data.gender);
                $("#yearLevel").val(data.yearLevel);
                $("#classSection").val(data.classSection);
                $("#departmentType").val(data.departmentType);
                $("#progtrack").val(data.progtrack);
                $("#msg").html(data.msg);

                // Check if user ID exists
                if (data.userid !== '') {
                    // Show attendance logs button
                    $("#attendancelogs").show();

                    // Trigger audio playback
                    document.getElementById("audio").play();
                } else {
                    // Hide attendance logs button if user ID doesn't exist
                    $("#attendancelogs").hide();
                }

                // Submit the form
                document.forms[0].submit();
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                console.error("AJAX request failed:", error);
            }
        });
    });

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });

    $(function() {
        $("#log").dataTable();
    });
});

</script>
<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Bootstrap Validator JS -->
<script src="styles/admin/js/bootstrapValidator.min.js"></script>
<script src="styles/admin/js/sweetalert.min.js"></script>
<script src="styles/admin/js/datetime.js" defer></script>
<!-- page script -->
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
</body>
</html>


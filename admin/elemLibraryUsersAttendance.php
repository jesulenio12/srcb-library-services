<?php
require_once 'core/init.php';
require 'conn.php';

$user = new UserLogin(); //Current
$prev_id_entry = "";

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {  
			// $qrcodevaluechek = Input::get('qrcode');
			$qrcod = Input::get('library_userID');

			
			$query=mysqli_query($conn, "SELECT * FROM attendance order by id DESC LIMIT 1") or die(mysqli_error());
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
						'fullname' => Input::get('firstname').' '.Input::get('lastname'),
						'gender' => Input::get('gender'),
						'yearLevel' => Input::get('yearLevel'),
						'classSet' => Input::get('classSet'),
						'classSection' => Input::get('classSection'),
						'departmentType' => Input::get('departmentType'),
						'libraryClass' => Input::get('libraryClass'),
					));
					Session::flash('Log', 'Welcome to the Library, thank you for coming!');
					Redirect::to('admin.php?action=elemLibraryUsersAttendance');
				}

				if($prev_id_entry == $qrcod){
					Session::flash('ScannedAlready', 'You have scanned already!');
					Redirect::to('admin.php?action=elemLibraryUsersAttendance');
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
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/dailyusers.css">
<title>Daily Users Log</title>
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
		font-size: 25px;
		margin-right: 13px;
		background: #3db166;
		border-radius: 5px;
		padding: 5px 12px;
		color: #fff;
		font-weight: 500;
		font-family: impact;
	}

	.date {
		font-size: 25px;
		color: #3db166;
		font-weight: bolder;
		font-family: Arial Black;
	}

	video#preview {
		border-radius: 0 0 10px 10px;
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

</style>
</head>
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
								<img src="images/logo.png" />
									DAILY USERS LOG
								<img src="images/qrcode.jpg" />
							</p>
						</div>
						<h1 class="text-divider"> PLEASE SCAN YOUR QR CODE HERE </h1>
					</center>
                </section>

                <!-- Main content -->
				
			<section class="center">
				<div class="row" style="margin-top:-15px">
					<div class="col-xs-12" style="padding: 0px 50px 0px 50px;">
						<div class="box box-attendance" style="background-color: rgba(255, 255, 255, 0.239); border-radius:20px">
						<br>
							<div class="box-body">
								<div class="row">
									<form enctype="multipart/form-data" method="post" action="">
										<input type="hidden" name="libraryClass" id="libraryClass" value="Grade School Library">
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
																<?php if(Session::exists('ScannedAlready')){ ?>
																	<div class="alert alert-danger">
																		<i class="glyphicon glyphicon-remove"></i> &nbsp;<?php echo Session::flash('ScannedAlready'); ?>
																	</div>
																<?php }?> 
															<?php }?> 
														</span>
													</div>
													<!--  -->
													<div class="col-xs-12">
														<!-- <span style="display:none"id="qrinvalid" name="qrinvalid"> QR code invalid
														</span> -->
														<div style="display:none"id="qrinvalid" name="qrinvalid" class="alert alert-danger" >
															<i class="glyphicon glyphicon-remove"></i> QR Code Error.
															<audio src="admin/beep.mp3" id="audio" controls style="display:none"></audio>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-7" style="margin-top: -15px; color:white; text-transform:uppercase;">
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="library_userID">ID Number</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="library_userID" name="library_userID" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="userType">Log Type</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="userType" name="userType" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="firstname"> Firstname</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="firstname" name="firstname" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="lastname"> Lastname</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="lastname" name="lastname" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="gender"> Gender</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="gender" name="gender" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="yearLevel"> Year Level</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="yearLevel" name="yearLevel" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="classSet"> Year Level</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="classSet" name="classSet" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="classSection"> Year Level</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="classSection" name="classSection" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="departmentType"> Year Level</label> -->
													</div>
													<div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="departmentType" name="departmentType" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-2">
														<!-- <label class="control-label" for="progtrack">Program</label> -->
													</div>
													<!-- <div class="col-xs-9">
														<div class="form-group">
															<input type="hidden" class="form-control" id="progtrack" name="progtrack" readonly onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
														</div>
													</div> -->
												</div>
												<div class="row">
													<div class="col-xs-11">
														<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
														<button type="submit" class="btn btn-info btn-lg btn-huge" style="display:none;" name="attendancelogs" id="attendancelogs"></button>
													</div>
												</div>
											</div>

											<div class="col-lg-7" style="margin-top: -120px;">
												<div class="table-row">
														<div class="box box-primary" id="loading-example" style="border-radius: 10px">
																<div class="box-header">
																	<!-- <i class="fa fa-user"></i>
																	<h3 class="box-title">Recent Daily Users Logs</h3> -->
																</div><!-- /.box-header -->
															<div class="box-body table-responsive">
																<table class="table table-striped table-hover" id="log">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>ID number </th>
																		<th>Fullname</th>
																		<th>Gender</th>
																		<th>Year Level</th>
																		<th>Class Set</th>
																		<th>Class Section</th>
																		<th>User Type</th>
																		<th>Log Date</th>
																	</tr>
																</thead>
																<tbody>
																	<?php include 'elemLibraryUsersAttendanceSorting.php'?>	
																</tbody>
															</table>
														</div>
													
												</div>
											</div>

										</div>
										<hr>
									</form>
								</div>
							</div><!-- /.box -->
						</div><!-- /.box -->
					</div><!-- /.col -->
				</div><!-- /.row (main row) -->
			</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		
	<script src="js/enter.js"></script>
	<script src="js/jquery3.3.1.min.js"></script>
	<script src="js/instascan.min.js"></script>
	<script type="text/javascript">
		setTimeout(function(){
			document.getElementById("msg").style.display = "none";
		}, 5000);

		setTimeout(function(){
			document.getElementById("$msg").style.display = "none";
		}, 5000);
	</script>

	<script type="text/javascript">

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
		var library_userID = content;
		let qrcodesubstring = library_userID.substring(0,3);
			$.ajax({
				type: "POST",
				url: "attendance.php",
				dataType: "json",
				data: {library_userID:library_userID, action:'view_users_info'},
				success : function(data){
					$("#library_userID").val(data.userid);
					$("#userType").val(data.userType);
					$("#firstname").val(data.firstname);
					$("#lastname").val(data.lastname);
					$("#gender").val(data.gender);
					$("#yearLevel").val(data.yearLevel);
					$("#classSet").val(data.classSet);
					$("#classSection").val(data.classSection);
					$("#departmentType").val(data.departmentType);
					// $("#progtrack").val(data.progtrack);
					$("#msg").html(data.msg);
					if (data.userid == '') {
						document.getElementById("attendancelogs").style.display = "none";
					}else{
						document.getElementById("attendancelogs").style.display = "block";
						document.getElementById("audio").play();
						document.forms[0].submit();
					}
				}
			});
		
		
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });	

	  $(function() {
			$("#log").dataTable();
		});
		function printImg(url) {
		  var win = window.open('');
		  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
		  win.focus();
		}
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


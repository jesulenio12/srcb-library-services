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
<link rel="stylesheet" href="buttonhover.css">
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/settings-responsive.css">
<title>QRBASEDLMS - Update Profile Information</title>
</head>
<style>
	.alert {
		padding-left: 30px;
		margin-left: 56px;
		position: relative;
		min-width: 800px;
		margin-top: 23px
	}

	@media screen and (max-width: 1080px){
		.alert {
			padding-left: 30px;
			margin-left: 15px;
			position: relative;
			min-width: 655px;
			margin-top: 23px;
		}
	}

	@media screen and (max-width: 990px){
		.alert {
			padding-left: 30px;
			margin-left: 15px;
			position: relative;
			min-width: 780px;
			margin-top: 23px;
		}
	}

	@media screen and (max-width: 768px){
		.alert {
			padding-left: 30px;
			margin-left: 15px;
			position: relative;
			min-width: 590px;
			margin-top: 23px;
		}
	}

	@media screen and (max-width: 600px){
		.alert {
			padding-left: 30px;
			margin-left: 15px;
			position: relative;
			min-width: 433px;
			margin-top: 23px;
		}
	}

	@media screen and (min-width: 501px) and (max-width: 599px){
		.alert {
			padding-left: 30px;
			margin-left: 15px;
			position: relative;
			min-width: 350px;
			margin-top: 23px;
		}
	}

	@media screen and (min-width: 360px) and (max-width: 500px){
		.alert {
			padding-left: 9px;
			margin-left: 15px;
			position: relative;
			min-width: 217px;
			margin-top: 23px;
			font-size: 12px;
		}
	}


</style>
<body class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side"  style="background-color:transparent; padding: 10px 30px 30px 30px">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="background-color:transparent">
                    <!-- <h1>
                        Update Profile Information
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Update Profile Information</li>
                    </ol> -->
                </section>

                <!-- Main content -->
                <section class="content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
					<div class="row" class="col-lg-15 connectedSortable">
                        <div class="col-xs-15">
                            <div style="background-color:transparent">
								<br><br>
								<center>
									<div class="tb-title">
										<div class="small-box bg">
											<p>
												LOGIN INFORMATION
											</p>
										</div>
									</div>
								</center>
								<br><br>
                                <div class="box-body">
									<div class="progress-table-wrap">
										<div class="progress-table">
											<?php 
												$user = DB::getInstance()->get('userlogin', array('id','=',Session::get(Config::get('sessions/session_name'))));
												foreach($user->results() as $user){
													if($user->permissionRole == '5' OR $user->permissionRole == '6'){
												?>
													<div class="second">
														<div id="changeUsernameMessage">
															<div class="rowsettings">
																<div class="col-md-12">
																	<label class="first" for="datePublished">Username</label>
																	<input type="text" class="form-control" id="library_userID" name="library_userID" value="<?php echo $user->username;?>" disabled>
																</div>
																<div class="col-md-12">
																	<button class="btn-link">Default username</button>
																</div>
															</div>
															<?php if(Session::exists('Updated')) { ?>
																<div id="alert" class="alert alert-success">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
																</div>
															<?php }?>
														</div>
													</div>
													<br>
													
													<div class="second">
														<div id="changepassmessage">
															<div class="rowsettings">
																<div class="col-md-12">
																	<label class="first" for="datePublished">Password</label>
																	<input type="password" class="form-control" id="library_userID" name="library_userID" value="<?php echo $user->password;?>" disabled>
																</div>
																<div class="col-md-12">
																	<button class="btn-link2" id="change">Change Password</button>
																</div>
															</div>
															<?php if(Session::exists('wrongPassword')) { ?>
																<div id="alert" class="alert alert-danger">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('wrongPassword'); ?>
																</div>
															<?php }?>
															<?php if(Session::exists('passwordChanged')) { ?>
																<div id="alert" class="alert alert-success">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('passwordChanged'); ?>
																</div>
															<?php }?>
														</div>
														<div id="changePass" class="collapse" style="display: none">
															<form id="changePassword" action="changePassword.php" method="post">
																<div class="rowchngepass">
																	<div class="col-md-12">
																		<label for="datePublished">Current</label>
																		<input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" >
																	</div>
																	<div class="col-md-12">
																		<label for="datePublished">New</label>
																		<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" >
																	</div>
																	<div class="col-md-12">
																		<label for="datePublished">Confirm</label>
																		<input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password" >
																	</div>
																	<input type="hidden" name="changePassToken" value="<?php echo Token::generate(); ?>">
																	<div class="passbtn">
																		<div class="col-md-12">
																			<button type="submit" class="btnupdate">Save</button>	
																			<button id="cancelPass" type="button" class="btncancel">Cancel</button>	
																		</div>
																	</div>
																</div>
																<br>
															</form>
														</div>
													</div>
												<?php 
													}else{
														?>
													<div class="second">
														<div id="changeUsernameMessage">
															<div class="rowsettings">
																<div class="col-md-12">
																	<label class="first" for="datePublished">Username</label>
																	<input type="text" class="form-control" id="library_userID" name="library_userID" value="<?php echo $user->username;?>" disabled>
																</div>
																<div class="col-md-12">
																	<button class="btn-link2" id="editUsername">Update Username</button>
																</div>
															</div>
															<?php if(Session::exists('Updated')) { ?>
																<div id="alert" class="alert alert-success">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
																</div>
															<?php }?>
														</div>
														<div id="changeUname" class="collapse" style="display: none">
															<form id="changeUsername" action="changeUsername.php" method="post" >
																<div class="rowchngepass">
																	<div class="col-md-12">
																		<label for="datePublished">Username</label>
																		<input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username;?>">
																	</div>
																	<input type="hidden" name="changeUsernameToken" value="<?php echo Token::generate(); ?>">
																	<div class="passbtn">
																		<div class="col-md-12">
																			<button type="submit" class="btnupdate">Save</button>	
																			<button id="cancelUsername" type="button" class="btncancel">Cancel</button>	
																		</div>
																	</div>
																</div>
																<br>
															</form>
														</div>
													</div>
													<br>
													<div class="second">
														<div id="changepassmessage">
															<div class="rowsettings">
																<div class="col-md-12">
																	<label class="first" for="datePublished">Password</label>
																	<input type="password" class="form-control" id="library_userID" name="library_userID" value="<?php echo $user->password;?>" disabled>
																</div>
																<div class="col-md-12">
																	<button class="btn-link2" id="change">Change Password</button>
																</div>
															</div>
															<?php if(Session::exists('wrongPassword')) { ?>
																<div id="alert" class="alert alert-danger">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('wrongPassword'); ?>
																</div>
															<?php }?>
															<?php if(Session::exists('passwordChanged')) { ?>
																<div id="alert" class="alert alert-success">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('passwordChanged'); ?>
																</div>
															<?php }?>
														</div>
														<div id="changePass" class="collapse" style="display: none">
															<form id="changePassword" action="changePassword.php" method="post">
																<div class="rowchngepass">
																	<div class="col-md-12">
																		<label for="datePublished">Current</label>
																		<input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" >
																	</div>
																	<div class="col-md-12">
																		<label for="datePublished">New</label>
																		<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" >
																	</div>
																	<div class="col-md-12">
																		<label for="datePublished">Confirm</label>
																		<input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password" >
																	</div>
																	<input type="hidden" name="changePassToken" value="<?php echo Token::generate(); ?>">
																	<div class="passbtn">
																		<div class="col-md-12">
																			<button type="submit" class="btnupdate">Save</button>	
																			<button id="cancelPass" type="button" class="btncancel">Cancel</button>	
																		</div>
																	</div>
																</div>
																<br>
															</form>
														</div>
													</div>
												<?php 
													}
											}?>
										</div>
									</div>
								</div><!-- /.box -->
								<br><br>
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
					<div class="row" class="col-lg-12 connectedSortable">
                        <div class="col-xs-12">
                            <div class="box box-primary" style="background-color:transparent">
								<br><br>
								<center>
									<div class="tb-title">
										<div class="small-box bg">
											<p>
												PERSONAL INFORMATION
											</p>
										</div>
									</div>
								</center>
								<br>
                                <div class="box-body">
									<div class="progress-table-wrap">
										<div class="progress-table" style="background-color:transparent">
											<?php 
												$user = DB::getInstance()->get('userlogin', array('id','=',Session::get(Config::get('sessions/session_name'))));
												foreach($user->results() as $user){
											?>
											<div class="personalInfo">
												<div class="row-personal-info">
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="datePublished">Firstname</label>
														<input type="text" class="form-control" id="firstname" name="firstname" value="<?php if (!$user->firstname == ''){echo $user->firstname;}?>" readonly>
													</div>
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="program">Lastname</label>
														<input type="text" class="form-control" id="lastname" name="lastname" value="<?php if (!$user->lastname == ''){echo $user->lastname;}?>" readonly>
													</div>
												</div>

												<div class="row-personal-info">
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="program">Age</label>
														<input type="text" class="form-control" id="age" name="age" value="<?php if (!$user->age == ''){echo $user->age;}?>" readonly>
													</div>
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="datePublished">Gender</label>
														<input type="text" class="form-control" id="firstname" name="firstname" value="<?php if (!$user->gender == ''){echo $user->gender;}?>" readonly>
													</div>
												</div>

												<div class="row-personal-info">
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="program">Email</label>
														<input type="text" class="form-control" id="email" name="email" value="<?php if (!$user->email == ''){echo $user->email;}?>" readonly>
													</div>
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="program">Contact No.</label>
														<input type="text" class="form-control" id="lastname" name="lastname" value="<?php if (!$user->contactNum == ''){echo $user->contactNum;}?>" readonly>
													</div>
												</div>

												<div class="row-personal-info">
													<div class="col-md-12">
														<label style="text-align: center" class="control-label" for="datePublished">Address</label>
														<input type="text" class="form-control" id="address" name="address" value="<?php if (!$user->address == ''){echo $user->address;}?>" readonly>
													</div>
												</div>

												<div class="row-personal-info">
													<div class="col-md-12">
														<label style="text-align: center" class="control-label" for="datePublished">Street/Zone</label>
														<input type="text" class="form-control" id="strtzone" name="strtzone" value="<?php if (!$user->strtzone == ''){echo $user->strtzone;}?>" readonly>
													</div>
												</div>
												
												<div class="row-personal-info-btn">
													<div class="col-md-6">
														<button type="submit" class="btn-i" data-toggle="modal" data-target="#exampleModal">Update Personal Info</button>
													</div>
													<div class="col-md-6">
														<button type="submit" class="btn-a" data-toggle="modal" data-target="#avatar">View/Update Avatar</button>	
													</div>
												</div>

												<?php if(Session::exists('userUpdated')) { ?>
													<div id="alert" class="alert alert-success">
														<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('userUpdated'); ?>
													</div>
												<?php }?>
											</div>
												
												<!-- Modal -->
											<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content"  style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<br>
														<center>
															<div class="tb-title-modal">
																<div class="small-box bg">
																	<p>
																		UPDATE INFORMATION
																	</p>
																</div>
															</div>
														</center>
														<br>
													</div>
													<div class="modal-body">
														<form enctype="multipart/form-data" name="editUserInfo" method="post" action="editUserInfo.php">
															<input type="hidden" name="editUserInfo" value="<?php echo Token::generate(); ?>">

															<div class="row-update-info">
																<div class="col-md-6">
																	<label class="control-label" for="datePublished">Firstname</label>
																	<input type="text" id="firstname" name="firstname" value="<?php echo $user->firstname;?>" placeholder="Input Firstname" required>
																</div>
																<div class="col-md-6">
																	<label class="control-label" for="program">Lastname</label>
																	<input type="text" id="lastname" name="lastname" value="<?php echo $user->lastname;?>" placeholder="Input Lastname" required>
																</div>
															</div>

															<div class="row-update-info">
																<div class="col-md-6">
																	<label class="control-label" for="age">Age</label>
																	<input type="text" id="age" name="age" value="<?php echo $user->age;?>" placeholder="Input Your Age" required>
																</div>
																<div class="col-md-6">
																	<label class="control-label" for="datePublished">Gender</label>
																	<select name="gender" id="gender" required>
																		<option value="<?php echo $user->gender;?>"><?php echo $user->gender;?></option>
																		<option value="Male">Male</option>	
																		<option value="Female">Female</option>	
																	</select>
																</div>
															</div>

															<div class="row-update-info">
																<div class="col-md-6">
																	<label class="control-label" for="email">Email</label>
																	<input type="text" id="email" name="email" value="<?php echo $user->email;?>" placeholder="Input Your Email" required>
																</div>
																<div class="col-md-6">
																	<label class="control-label" for="program">Contact</label>
																	<input type="text" id="contactNum" name="contactNum" value="<?php echo $user->contactNum;?>" placeholder="Input Contact Number" required>
																</div>
															</div>

															<div class="row-update-info">
																<div class="col-md-12">
																	<label class="control-label" for="address">Address</label>
																	<input type="text" id="address" name="address" value="<?php echo $user->address;?>" placeholder="Input Complete Address" required>
																</div>
															</div>

															<div class="row-update-info">
																<div class="col-md-12">
																	<label class="control-label" for="strtzone">Street Zone</label>
																	<input type="text" id="strtzone" name="strtzone" value="<?php echo $user->strtzone;?>" placeholder="Input Your Street/Zone" required>
																</div>
															</div>
													</div>
													<div class="modal-footer">
														<div class="rowperupdate-info-btn">
															<div class="col-md-12">
																<button type="submit" class="btnupdate" value="save">Save</button>
															</div>
															<div class="col-md-12">
																<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
															</div>
														</div>
														</form>
													</div>
													</div>
												</div>
												</div>
												<!-- Modal -->
												<div class="modal fade" id="avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content"  style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<br>
														<center>
															<div class="tb-title">
																<div class="small-box bg">
																	<p>
																		UPDATE AVATAR
																	</p>
																</div>
															</div>
														</center>
													</div>
													<br>
													<div class="modal-body">
														<form enctype="multipart/form-data" id="editUserInfo" method="post" action="editUserInfo.php">
															<center>
															<?php if (!$user->avatar == ''){
																echo '<img width="50%" src="admin/UserAvatars/'.$user->avatar.'">';
															}else{
																echo '<img width="50%" src="admin/images/logo.png" >';
															}?>
															</center>
															<hr>
															<div class="rowavatar">
																<div class="col-md-12">
																	<div> 
																		<label class="control-label" for="datePublished">Choose File</label>
																	</div>
																	<div class="form-group" style="width:100%; padding-left:40px;">
																		<input type="file" class="file-input" id="avatar" name="avatar">
																	</div>
																</div>
															</div>
															<script type="text/javascript">
																function validateFileType(){
																	var fileName = document.getElementById("fileName").value;
																	var idxDot = fileName.lastIndexOf(".") + 1;
																	var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
																	if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
																		//TO DO
																	}else{
																		alert("Only jpg/jpeg and png files are allowed!");
																	}   
																}
															</script>
													</div>
													<div class="modal-footer">
														<div class="rowavatar-btn">
															<div class="col-md-6">
																<input type="hidden" name="uploadAvatar" value="<?php echo Token::generate(); ?>">
																<button type="submit" class="btnupdate">Upload New Avatar</button>
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
											}?>
										</div>
										
									</div>
									 
								</div><!-- /.box -->
								
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Bootstrap Validator JS -->
<script src="styles/admin/js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
	setTimeout(function(){
		document.getElementById("alert").style.display = "none";
	}, 5000);
</script>
<script>
$(document).ready(function(){
	$("#cancelPass").click(function(){
		$("#change").show();
		$("#changePass").hide();
		$("#changepassmessage").show();				
	});
	
	$("#change").click(function(){
		$("#change").hide();
		$("#changePass").show();
		$("#changepassmessage").hide();			
	});
	
	$("#cancelUsername").click(function(){
		$("#editUsername").show();
		$("#changeUname").hide();
		$("#changeUsernameMessage").show();			
	});
	
	$("#editUsername").click(function(){
		$("#editUsername").hide();
		$("#changeUname").show();
		$("#changeUsernameMessage").hide();			
	});
});
</script>
<script type="text/javascript">
	$(document).ready(function() {
        var validator = $("#changePassword").bootstrapValidator({
			fields : {
				currentPassword : {
					validators : {
						notEmpty :{
							message : "Password is required."
						},
						stringLength :{
							min : 6,
							max : 35,
							message : "Password must be beetween 6 and 35 characters long"
						}
					}
				},
				newPassword : {
					validators : {
						notEmpty :{
							message : "New Password is required."
						},
						stringLength :{
							min : 6,
							max : 35,
							message : "Password must be beetween 6 and 35 characters long"
						}
					}
				},
				confirmNewPassword : {
					validators : {
						notEmpty :{
							message : "Confirm new password is required."
						},
						stringLength :{
							min : 6,
							max : 35,
							message : "Password must be beetween 6 and 35 characters long"
						},
						identical: {
                        	field: 'newPassword',
                        	message: 'This must be the same as the password'
                   	 	}
					}
				},
			}
		});
    });
</script>
</body>
</html>


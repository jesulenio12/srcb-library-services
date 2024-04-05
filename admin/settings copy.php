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
												$user = DB::getInstance()->get('userLogin', array('id','=',Session::get(Config::get('sessions/session_name'))));
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
																<div class="alert alert-success" style="width:97%">
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
																	<input type="text" class="form-control" id="library_userID" name="library_userID" value="**************" disabled>
																</div>
																<div class="col-md-12">
																	<button class="btn-link2" id="change">Change Password</button>
																</div>
															</div>
															<?php if(Session::exists('wrongPassword')) { ?>
																<div class="alert alert-danger" style="width:97%">
																	<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('wrongPassword'); ?>
																</div>
															<?php }?>
															<?php if(Session::exists('passwordChanged')) { ?>
																<div class="alert alert-success" style="width:97%">
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
													<div class="table-row" style="width:100%; background-color: rgba(57, 43, 43, 0.239); border-radius:10px; padding: 15px 15px 0px 20px;">
														<div class="second" style="width:100%; padding:0px">
															<div id="changeUsernameMessage">
																<div class="row">
																	<div class="col-md-6">
																		<div style="width:30%; height:50px; background:#163269; padding: 13px 99px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px;"> 
																			<label class="first" class="control-label" for="datePublished">Username</label>
																		</div>
																		<div class="form-group" style="width:100%; padding-left:155px;">
																			<input style="height:50px; font-size: 17px;"  type="text" class="form-control" id="library_userID" name="library_userID" value="<?php echo $user->username;?>" disabled>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div> 
																			<button style="text-decoration: none; background: #3db166; color: #fff;" class="btn-link" id="editUsername">Update Username</button>
																		</div>
																	</div>
																</div>
																<?php if(Session::exists('Updated')) { ?>
																	<div class="alert alert-success" style="width:97%">
																		<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
																	</div>
																<?php }?>
															</div>
															<div id="changeUname" style="display: none; padding: 5px 200px 0px 200px">
																<form id="changeUsername" action="changeUsername.php" method="post" >
																	<div class="col-md-12">
																		<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																			<label class="control-label" for="datePublished">Username</label>
																		</div>
																		<div class="form-group" style="width:100%; padding-left:225px;">
																			<input style="height:50px; padding-left:20px; font-size: 17px;" type="text" class="form-control" id="username" name="username" value="<?php echo $user->username;?>">
																		</div>
																	</div>
																	<input type="hidden" name="changeUsernameToken" value="<?php echo Token::generate(); ?>">
																	<div class="row" style="padding: 0px 12px 0px 12px">
																		<div class="col-md-6">
																			<button type="submit" class="btnupdate">Save</button>	
																		</div>
																		<div class="col-md-6">
																			<button id="cancelUsername" type="button" class="btncancel">Cancel</button>	
																		</div>
																	</div>
																	<br>
																</form>
															</div>
														</div>
													</div>
													<br>
													<div class="table-row" style="width:100%; background-color: rgba(57, 43, 43, 0.239); border-radius:10px; padding: 15px 15px 0px 20px;" >
														<div class="second" style="width:100%; padding:0px">
															<div id="changepassmessage">
																<div class="row">
																	<div class="col-md-6">
																		<div style="width:30%; height:50px; background:#163269; padding: 13px 99px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px;"> 
																			<label class="first" class="control-label" for="datePublished">Password</label>
																		</div>
																		<div class="form-group" style="width:100%; padding-left:155px;">
																			<input style="height:50px; font-size: 17px;"  type="text" class="form-control" id="library_userID" name="library_userID" value="************" disabled>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div> 
																			<button style="text-decoration: none; background: #3db166; color: #fff;" class="btn-link2" id="change">Change Password</button>
																		</div>
																	</div>
																</div>
																<?php if(Session::exists('wrongPassword')) { ?>
																	<div class="alert alert-danger" style="width:97%">
																		<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('wrongPassword'); ?>
																	</div>
																<?php }?>
																<?php if(Session::exists('passwordChanged')) { ?>
																	<div class="alert alert-success" style="width:97%">
																		<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('passwordChanged'); ?>
																	</div>
																<?php }?>
															</div>
															<div id="changePass" style="display: none; padding: 5px 200px 0px 200px">
																<form id="changePassword" action="changePassword.php" method="post">
																	<div class="col-md-12">
																		<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																			<label class="control-label" for="datePublished">Current Password</label>
																		</div>
																		<div class="form-group" style="width:100%; padding-left:225px;">
																			<input style="height:50px; padding-left:20px; font-size: 17px;" type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" >
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																			<label class="control-label" for="datePublished">New Password</label>
																		</div>
																		<div class="form-group" style="width:100%; padding-left:225px;">
																			<input style="height:50px; padding-left:20px; font-size: 17px;" type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" >
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div style="width:36%; height:50px; background-color:#163269; padding: 13px 8px 0px 0px; color:white; font-size: 17px;  text-align: center; position: absolute; border-radius:5px"> 
																			<label class="control-label" for="datePublished">Confirm New Password</label>
																		</div>
																		<div class="form-group" style="width:100%; padding-left:225px;">
																			<input style="height:50px; padding-left:20px; font-size: 17px;" type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password" >
																		</div>
																	</div>
																	<input type="hidden" name="changePassToken" value="<?php echo Token::generate(); ?>">
																	<div class="row" style="padding: 0px 12px 0px 12px">
																		<div class="col-md-6">
																			<button type="submit" class="btnupdate">Save</button>	
																		</div>
																		<div class="col-md-6">
																			<button id="cancelPass" type="button" class="btncancel">Cancel</button>	
																		</div>
																	</div>
																	<br>
																</form>
															</div>
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
												$user = DB::getInstance()->get('userLogin', array('id','=',Session::get(Config::get('sessions/session_name'))));
												foreach($user->results() as $user){
											?>
											<div class="personalInfo">
												<div class="row-personal-info">
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="datePublished">Firstname</label>
														<input type="text" class="form-control" id="firstname" name="firstname" value="<?php if (!$user->fname == ''){echo $user->fname;}?>"required>
													</div>
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="program">Lastname</label>
														<input type="text" class="form-control" id="lastname" name="lastname" value="<?php if (!$user->lname == ''){echo $user->lname;}?>"required>
													</div>
												</div>

												<div class="row-personal-info">
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="program">Age</label>
														<input type="text" class="form-control" id="age" name="age" value="<?php if (!$user->age == ''){echo $user->age;}?>"required>
													</div>
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="datePublished">Gender</label>
														<input type="text" class="form-control" id="firstname" name="firstname" value="<?php if (!$user->gender == ''){echo $user->gender;}?>"required>
													</div>
												</div>

												<div class="row-personal-info">
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="program">Email</label>
														<input type="text" class="form-control" id="email" name="email" value="<?php if (!$user->email == ''){echo $user->email;}?>"required>
													</div>
													<div class="col-md-6">
														<label style="text-align: center" class="control-label" for="program">Contact No.</label>
														<input type="text" class="form-control" id="lastname" name="lastname" value="<?php if (!$user->contactNum == ''){echo $user->contactNum;}?>"required>
													</div>
												</div>

												<div class="row-personal-info">
													<div class="col-md-12">
														<label style="text-align: center" class="control-label" for="datePublished">Address</label>
														<input type="text" class="form-control" id="address" name="address" value="<?php if (!$user->address == ''){echo $user->address;}?>"required>
													</div>
												</div>

												<div class="row-personal-info">
													<div class="col-md-12">
														<label style="text-align: center" class="control-label" for="datePublished">Street/Zone</label>
														<input type="text" class="form-control" id="strtzone" name="strtzone" value="<?php if (!$user->strtzone == ''){echo $user->strtzone;}?>"required>
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
													<div class="alert alert-success" style="width:97%">
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
																	<input type="text" id="fname" name="fname" value="<?php echo $user->fname;?>" placeholder="Input Firstname" required>
																</div>
																<div class="col-md-6">
																	<label class="control-label" for="program">Lastname</label>
																	<input type="text" id="lname" name="lname" value="<?php echo $user->lname;?>" placeholder="Input Lastname" required>
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
																echo '<img width="50%" src="admin/uploads/avatar/'.$user->avatar.'">';
															}else{
																echo '<img width="50%" src="admin/uploads/avatar/default.jpg" >';
															}?>
															</center>
															<hr>
															<div class="rowavatar">
																<div class="col-md-12">
																	<div> 
																		<label class="control-label" for="datePublished">Choose File</label>
																	</div>
																	<div class="form-group" style="width:100%; padding-left:40px;">
																		<input type="file" id="fileName" name='upload' accept=".jpg,.jpeg,.png" onchange="validateFileType()" required>
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
																<input type="hidden" name="avatar" value="<?php echo Token::generate(); ?>">
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


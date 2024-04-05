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
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/addInputs.css">
<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>JHS Department Students</title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}
</style>

<body class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="background-color:transparent">
                    
                </section>

                <!-- Main content -->
                <section class="col-lg-12 connectedSortable">
                    <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                        <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
                            <!-- <div class="box-header">
                                <h3 class="box-title">Edit Profile - <small><font color="#EC0003">*</font> required fields</small></h3>    
                            </div> -->
							<br>
							<center>
								<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
									<p style="font-size:35px; transform: scale(1, 2);">
										Personal Information
									</p>
								</div>
							</center>
							<br>
							<div class="box-body" style="padding: 0px 200px 0px 200px">
									<div class="progress-table-wrap" style="width:100%; background-color: rgba(57, 43, 43, 0.239); border-radius:10px; padding: 15px 20px 0px 20px;">
										<div class="progress-table" style="background-color:transparent">
											<?php 
												$users = DB:: getInstance()->query("SELECT * FROM userlogin WHERE id=".$_GET['id']."");							
												foreach($users->results() as $users){
											?>
												<div class="row">
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="firstname">Firstname</span>
															<input type="text" class="add-input" id="firstname" name="firstname" value="<?php echo $users->firstname; ?>" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="lastname">Lastname</span>
															<input type="text" class="add-input" id="lastname" name="lastname" value="<?php echo $users->lastname; ?>" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="age">Age</span>
															<input type="text" class="add-input" id="age" name="age" value="<?php echo $users->age; ?>" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="gender">Gender</span>
															<input type="text" class="add-input" id="gender" name="gender" value="<?php echo $users->gender; ?>" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="email">Email</span>
															<input type="text" class="add-input" id="email" name="email" value="<?php echo $users->email; ?>" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="add-input-container"> 
															<span for="contactNum">Contact No.</span>
															<input type="text" class="add-input" id="contactNum" name="contactNum" value="<?php echo $users->contactNum; ?>" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<div class="add-input-container"> 
															<span for="address">Address</span>
															<input type="text" class="add-input" id="address" name="address" value="<?php echo $users->address; ?>" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<div class="add-input-container"> 
															<span for="strtzone">Street/Zone</span>
															<input type="text" class="add-input" id="strtzone" name="strtzone" value="<?php echo $users->strtzone; ?>" required>
														</div>
													</div>
												</div>
											<?php 
											}?>
											<div class="clearfix"></div><hr />
												<br>
												<center>
													<div class="row">
														<div class="col-md-12">
															<a style="color: #fff;" href="admin.php?action=jhsStud_OnlineUserList"><button style="margin-bottom: 25px; margin-top:-25px" type="button" class="btncancel">BACK TO LIST</button></a> 
														</div>
													</div>
												</center>
											</div>
									</div>
									<br>
								</div><!-- /.box -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
                    
<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap Datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Bootstrap Validator JS -->
<script src="styles/admin/js/bootstrapValidator.min.js"></script>    
<script type="text/javascript">
	$(document).ready(function() {
        var validator = $("#editUser").bootstrapValidator({
			fields : {
				username : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Username cannot be empty.",
						},
					}
				},
				userRole : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Please select a User Role.",
						},
					}
			}
		});
    });
</script>
</body>
</html>
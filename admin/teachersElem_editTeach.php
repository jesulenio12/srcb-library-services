<?php
if (Input::exists()) {
			$user = new UserLogin();
			try {
				$user->update(array(
					'firstname' => Input::get('firstname'),
					'lastname' => Input::get('lastname'),
					'library_userID' => 'ID-'.Input::get('library_userID'),
					'gender' => Input::get('gender'),
					'departmentType' => Input::get('departmentType'),
					'userType' => Input::get('userType'),
                ), $_GET['id']);
			
			Session::flash('Updated', 'Library user profile has been successfully updated!');
			Redirect::to('admin.php?action=teachersElemList');
            } catch(Exception $e) {
                $error;
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
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/addInputs.css">
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>GS Department Teachers</title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}
</style>

<body class="skin-blue" class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="background-color:transparent">
                    <!-- <h1>
						HED Department Teachers
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Edit Teacher's Profile</li>
                    </ol> -->
                </section>

                <!-- Main content -->
                <section class="content" class="col-lg-12 connectedSortable">
                    <div class="col-xs-12" tyle="padding: 0px 15px 10px 15px">
                        <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
							<br>
							<center>
								<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
									<p style="font-size:35px; transform: scale(1, 2); text-transform:uppercase">
										Update Teacher's Profile
									</p>
								</div>
							</center>
                            <div class="box-body" style="padding: 0px 100px 0px 100px">
								<?php if(Session::exists('profileUpdated')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('profileUpdated'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$userlogin = DB:: getInstance()->get('userlogin', array('id','=',$_GET['id']));							
									foreach($userlogin->results() as $userlogin){
									?>
								<form id="editUser" action="" method="post">
									<div class="row" style="padding: 0px 20px 0px 20px">
										<input type="hidden" name="departmentType" id="departmentType" value="Grade School Department">
										<input type="hidden" name="userType" id="userType" value="Teacher">

										<div class="row">
											<div class="col-md-6">
												<div class="add-input-container"> 
													<span for="firstname">Firstname</span>
													<input type="text" class="add-input" id="firstname" name="firstname" value="<?php echo $userlogin->firstname; ?>" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="add-input-container"> 
													<span for="lastname">Lastname</span>
													<input type="text" class="add-input" id="lastname" name="lastname" value="<?php echo $userlogin->lastname; ?>" required>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="add-input-container"> 
													<span for="library_userID">ID Number</span>
													<input type="text" class="add-input" id="library_userID" name="library_userID" value="<?php echo substr($userlogin->library_userID, 3, 255); ?>" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="add-input-container"> 
													<span for="gender">Gender</span>
													<select class="add-input" name="gender" id="gender" required>
														<option value="<?php echo $userlogin->gender; ?>"><?php echo $userlogin->gender; ?></option>
														<option value="Male">Male</option>	
														<option value="Female">Female</option>	
													</select> 
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div><hr />
										<div class="row">
											<div class=" col-md-6">
												<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
													<button type="submit" class="btnupdate" style="color: #fff">&nbsp;UPDATE</button>
											</div>
											<div class=" col-md-6">
												<a style="color: #fff;" href="admin.php?action=teachersElemList"><button type="button" class="btncancel">CANCEL</button></a> 
											</div>
										</div>
									<br />
                                </form>
								<!-- Modal -->
									</div>
								<?php }?>                 
                            </div><!-- /.box-body -->
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
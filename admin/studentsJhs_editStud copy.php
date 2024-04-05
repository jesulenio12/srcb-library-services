<?php
if (Input::exists()) {
			$library_users = new Library_users();
			
            try {
                $library_users->update(array(
					'firstname' => Input::get('firstname'),
					'lastname' => Input::get('lastname'),
					'gender' => Input::get('gender'),
					'classSection' => Input::get('classSection'),
					'classSet' => Input::get('classSet'),
					'yearLevel' => Input::get('yearLevel'),
					'departmentType' => Input::get('departmentType'),
					'userType' => Input::get('userType'),
                ), $_GET['id']);
			
			Session::flash('Updated', 'Library user profile has been successfully updated!');
			Redirect::to('admin.php?action=studentsJhsList');
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
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>QRBASEDLMS - JHS Department Students</title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}
</style>

<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
						JHS Department Students
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Edit Student's Profile</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Profile - <small><font color="#EC0003">*</font> required fields</small></h3>    
                            </div><!-- /.box-header -->
                            <div class="box-body">
								<?php if(Session::exists('profileUpdated')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('profileUpdated'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$library_users = DB:: getInstance()->get('library_users', array('id','=',$_GET['id']));							
									foreach($library_users->results() as $library_users){
									?>
								<form id="editUser" action="" method="post">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label class="control-label" for="library_userID"><font color="#EC0003">*</font> ID Number </label>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-8 col-md-8">
														<input type="text" class="form-control" id="library_userID" name="library_userID" value="<?php echo $library_users->library_userID; ?>" disabled>
													</div>
													<div class="col-lg-4 col-md-4">
														<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editBookTitle">
															Edit  ID Number
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
												<input type="hidden" name="departmentType" id="departmentType" value="Junior High School Department">
												<input type="hidden" name="userType" id="userType" value="Student">
													<div class="col-lg-3 col-md-3">
														<label class="control-label" for="firstname"><font color="#EC0003">*</font> Firstname</label>
														<div class="form-group">
															<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Input Firstname" value="<?php echo $library_users->firstname; ?>" >
														</div>
													</div>
													<div class="col-lg-3 col-md-3">
														<label class="control-label" for="lastname"><font color="#EC0003">*</font> Lastname</label>
														<div class="form-group">
															<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Input Lastname" value="<?php echo $library_users->lastname; ?>" >
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-3 col-md-3">
														<label class="control-label" for="gender"><font color="#EC0003">*</font> Gender</label>
														<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="gender" id="gender" >
															<option value="<?php echo $library_users->gender; ?>"><?php echo $library_users->gender; ?></option>
																<option value="Male">Male</option>	
																<option value="Female">Female</option>	
														</select> 
													</div>
													<div class="col-lg-3 col-md-3">
														<label class="control-label" for="classSection"><font color="#EC0003">*</font> Class Section</label>
														<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="classSection" id="classSection" >
																<option value="<?php echo $library_users->classSection; ?>"><?php echo $library_users->classSection; ?></option>
																<option value="---------------------------- Grade 7 ----------------------------">---------------------------- Grade 7 ----------------------------</option>
																<option value="O.L of Annunciation">O.L of Annunciation</option>	
																<option value="O.L of Assumption">O.L of Assumption</option>
																<option value="O.L of Guadalupe">O.L of Guadalupe</option>	
																<option value="O.L of Immaculate Conception">O.L of Immaculate Conception</option>		
																<option value="O.L of Knots">O.L of Knots</option>
																<option value="---------------------------- Grade 8 ----------------------------">---------------------------- Grade 8 ----------------------------</option>	
																<option value="O.L of Fatima">O.L of Fatima</option>	
																<option value="O.L of Lourdes">O.L of Lourdes</option>
																<option value="O.L of Manaoag">O.L of Manaoag</option>	
																<option value="O.L of Pilar">O.L of Pilar</option>
																<option value="---------------------------- Grade 9 ----------------------------">---------------------------- Grade 9 ----------------------------</option>	
																<option value="O.L of Beaterio">O.L of Beaterio</option>	
																<option value="O.L of Holy Rosary">O.L of Holy Rosary</option>
																<option value="O.L of Miraculous Medal">O.L of Miraculous Medal</option>	
																<option value="O.L of Mt. Carmel">O.L of Mt. Carmel</option>
																<option value="O.L of Peace">O.L of Peace</option>
																<option value="---------------------------- Grade 10 ----------------------------">---------------------------- Grade 10 ----------------------------</option>	
																<option value="O.L of Mary Mediatrix of all Graces">O.L of Mary Mediatrix of all Graces</option>	
																<option value="O.L of Presentation">O.L of Presentation</option>
																<option value="O.L of Snow">O.L of Snow</option>	
																<option value="O.L of Visitation">O.L of Visitation</option>	
														</select> 
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-lg-3 col-md-3">
														<label class="control-label" for="classSet"><font color="#EC0003">*</font> Class Set</label>
														<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="classSet" id="classSet" >
																<option value="<?php echo $library_users->classSet; ?>"><?php echo $library_users->classSet; ?></option>
																<option value="Set A">Set A</option>	
																<option value="Set B">Set B</option>
														</select> 
													</div>
													<div class="col-lg-3 col-md-3">
														<label class="control-label" for="yearLevel"><font color="#EC0003">*</font> Year Level</label>
														<div class="form-group">
															<select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="yearLevel" id="yearLevel" >
																<option value="<?php echo $library_users->yearLevel; ?>"><?php echo $library_users->yearLevel; ?></option>
																<option value="Grade 7">Grade 7</option>	
																<option value="Grade 8">Grade 8</option>	
																<option value="Grade 9">Grade 9</option>	
																<option value="Grade 10">Grade 10</option>	
															</select> 
														</div>
													</div>
												</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=studentsJhsList'">Cancel</button>
                                    </div>
                                    <br />
                                </form>
								<!-- Modal -->
													<div class="modal fade" id="editBookTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-title" id="exampleModalLabel">Edit ID Number</h3>
														</div>
														<div class="modal-body">
															<form enctype="multipart/form-data" method="post" action="studentsJhs_editBookQR.php">
																<label class="control-label" for="newlibrary_userID"><font color="#EC0003">*</font>ID Number</label>
																<div class="form-group">
																	<input type="text" class="form-control" id="newlibrary_userID" name="newlibrary_userID" value="<?php echo $library_users->library_userID; ?>">													
																</div>
																<input type="hidden" name="newID" value="<?php echo $library_users->id; ?>">
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success" value="save"><i class="glyphicon glyphicon-edit"></i> Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															</form>
														</div>
														</div>
													</div>
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
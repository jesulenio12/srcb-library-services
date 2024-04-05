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
<link rel="stylesheet" type="text/css" href="css/filter-button.css">
<link rel="stylesheet" type="text/css" href="css/addInputs.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>SHS Students Walk-in Library Users List</title>
</head>

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}

	@media print{
		.noprint, .noprint * {
			display: none; !important;
		}

		div.dataTables_filter label, div.dataTables_filter label * {
			display: none; !important;
		}

		div.dataTables_length label, div.dataTables_length label * { 
			display: none; !important;
		}

		div.dataTables_info, div.dataTables_info * { 
			display: none; !important;
		}

		div.dataTables_paginate, div.dataTables_paginate * { 
			display: none; !important;
		}

		div.row, div.row * { 
			display: none; !important;
		}

	}

	.btncsv {
		font-family: "Roboto", sans-serif;
		font-size: 12px;
		border: none;
		font-weight: bold;
		background: #12f330;
		width: 25%;
		height: 30px;
		padding-top: 4px;
		text-align: center;
		text-decoration: none;
		text-transform: uppercase;
		color: #fff;
		border-radius: 25px;
		cursor: pointer;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform
	}

	.btncsv:hover,
	.btncsv:focus,
	.btncsv:active {
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	.form-paragraph {
		margin-top: 10px;
		font-size: 15px;
		color: rgb(105, 105, 105);
		text-align: center
	}

	.drop-container {
		background-color: #ffffffb8;
		position: relative;
		display: flex;
		gap: 10px;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		padding: 10px;
		margin-top: 2.1875rem;
		border-radius: 10px;
		border: 3px dashed #3db166;
		color: #444;
		cursor: pointer;
		transition: background .2s ease-in-out, border .2s ease-in-out;
	}

	.drop-container:hover {
		background: rgba(0, 140, 255, 0.164);
		border-color: rgba(17, 17, 17, 0.616);
	}

	.drop-container:hover .drop-title {
		color: #222;
	}

	.drop-title {
		color: #444;
		font-size: 20px;
		font-weight: bold;
		text-align: center;
		transition: color .2s ease-in-out;
	}

	.file-input {
		width: 465px;
		max-width: 100%;
		color: #444;
		padding: 2px;
		background: #fff;
		border-radius: 10px;
		border: 1px solid #163269;
	}

	.file-input::file-selector-button {
		margin-right: 20px;
		border: 1px solid #163269;
		background: #163269;
		padding: 13px 20px;
		border-radius: 10px 0 0 10px;
		color: #fff;
		cursor: pointer;
		transition: background .2s ease-in-out;
	}

	.file-input::file-selector-button:hover {
		background: #0d45a5;
	}

	.update-yl-btn{
		font-family: "Roboto", sans-serif;
		font-size: 15px;
		border: none;
		font-weight: bolder;
		background: #fff;
		width: 100%;
		height:60px;
		padding: 0px;
		text-align: center;
		text-decoration: none;
		text-transform: uppercase;
		color: #3db166;
		border-radius: 30px;
		cursor: pointer;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: 0.3s;
		transition-duration: 0.3s;
		-webkit-transition-property: box-shadow, transform;
		transition-property: box-shadow, transform;
	}

	.update-yl-btn:hover, .update-yl-btn:focus, .update-yl-btn:active{
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}
</style>

<body class="skin-blue" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat;">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('admin/navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="background-color:transparent">
                <!-- Content Header (Page header) -->
				<section class="content-header" style="background-color:transparent">
                  <br>
                    <center>
                    <ol class="breadcrumb" style="background-color: rgba(255, 255, 255, 0.239); border-radius:30px; margin-top:-5px;">
                        <li><a href="admin.php" style="color:white"><i class="glyphicon glyphicon-th-list"></i> Go to</a></li>
                        <a href="admin.php?action=studentsShsList"><button type="button" class="btn" style="background: #3db166; color:white">SHS Students</button></a> 
                        <a href="admin.php?action=studentsJhsList"><button type="button" class="btn" style="color:#3db166">JHS Students</button></a> 
                    </ol>
                    </center>
                </section>
                <!-- Main content -->
                <section class="col-lg-12 connectedSortable">
                        <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                        		<div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
										<br>
											<center>
												<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 30px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
													<p style="font-size:28px; transform: scale(1, 2.5);">
														SHS STUDENTS LIST
													</p>
												</div>
											</center>
											<br>
											<div class="noprint">
												<div class="conpost">
													<div class="container">
														<div class="data">
															<div class="content">
															<?php 
															$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin WHERE departmentType = 'Senior High School Department' && userType='Student'  && yearLevel != 'Graduated' && archive = 0");
															$countLibrary_users =DB:: getInstance()->count($userlogin);?>
																<div class="inner">
																	<h3>
																		<?php echo $countLibrary_users; ?>
																	</h3>
																	<p>
																	Total Students
																	</p>
																</div>
															</div>
														</div>
														<div class="data">
															<div class="content">
																<?php 
																$library_usersGender = DB:: getInstance()->query("SELECT * FROM userlogin WHERE gender='Male' AND departmentType = 'Senior High School Department' AND userType='Student' && yearLevel != 'Graduated' && archive = 0");
																$countLibrary_usersG =DB:: getInstance()->count($library_usersGender);?>
																<div class="inner">
																	<h3>
																		<?php echo $countLibrary_usersG; ?>
																	</h3>
																	<p>
																		Male
																	</p>
																</div>
															</div>
														</div>
														<div class="data">
															<div class="content">
															<?php 
															$library_usersGender = DB:: getInstance()->query("SELECT * FROM userlogin WHERE gender='Female' AND departmentType = 'Senior High School Department' AND userType='Student' && yearLevel != 'Graduated' && archive = 0");
															$countLibrary_usersG =DB:: getInstance()->count($library_usersGender);?>
																<div class="inner">
																	<h3>
																		<?php echo $countLibrary_usersG; ?>
																	</h3>
																	<p>
																		Female
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
									<div class="noprint">
										<br><br><br>
									</div>
									<hr style="border-top:1px dotted #000;"/>								    
								<div class="noprint">
										<form class="form-inline" method="POST" action="">
											<center>
												<div class="wrap-filter" class="noprint">
													<div class="filter-input-group"> 
														<label class="filter-input-label">GENDER</label>
														<select class="filter-input-box" for="gender" name="gender" id="gender">
															<option value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?>" > <?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?></option>
															<option value="">None</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">YEAR LEVEL</label>
														<select class="filter-input-box" for="yearLevel" name="yearLevel" id="yearLevel">
															<option value="<?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?>" > <?php echo isset($_POST['yearLevel']) ? $_POST['yearLevel'] : '' ?></option>
															<option value="">None</option>
															<option value="Grade 11">Grade 11</option>
															<option value="Grade 12">Grade 12</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">TRACKS</label>
														<select class="filter-input-box" for="progtrack" name="progtrack" id="progtrack">
															<option value="<?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?>" > <?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?></option>
															<option value="">None</option>
															<option value="HUMSS">HUMSS</option>	
															<option value="STEM">STEM</option>	
															<option value="ABM">ABM</option>
														</select> 
													</div>
													<div class="filter-input-group"> 
														<label class="filter-input-label">CLASS SECTION</label>
														<select class="filter-input-box" for="classSection" name="classSection" id="classSection">
															<option value="<?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?>" > <?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?></option>
															<?php
																$libusers = DB:: getInstance()->query("SELECT DISTINCT classSection FROM userlogin WHERE departmentType = 'Senior High School Department' AND classSection != 'N/A' ORDER BY id ASC");							
																foreach($libusers->results() as $libusers){
															?>
															<option value="<?php echo $libusers->classSection?>"><?php echo ucwords($libusers->classSection) ?></option>
															<?php }?>
														</select> 
													</div>

													<button class="filtersbtn" name="search"><i class="fa fa-filter"></i></button>
													<a class="filtersbtn" href="admin.php?action=studentsShsList"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
													<button class="filtersbtn" onclick="window.print();"><i class="fa fa-print"></i></button>
													<a class="filtersbtn" href="admin.php?action=shsStud_allLibCard"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="glyphicon glyphicon-qrcode"></i></button></a>
													
													<button type="button" class="btn2-1 noprint" data-toggle="modal" data-target="#exampleModal">Add Student</button>	
													<button type="button" class="btn2-1 noprint" data-toggle="modal" data-target="#uploadModal">Upload CSV</button>	
												</div>
											</center>
										</form>
										<br>
									</div>
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
									<?php if(Session::exists('Existed')){ ?>
                                             <div class="alert alert-danger" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Existed'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('Updated')){ ?>
                                             <div class="alert alert-success" id="alert">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('Added')) { ?>
										<div class="alert alert-success" id="alert">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Added'); ?>
										</div>
									<?php }?>
									<!-- <form action="shs_chkboxcode.php" method="POST"> -->
										<table class="table table-bordered table-hover" id="articles">
											<thead>
												<tr>
													<th style="width:1%">#</th>
													
													<th class="noprint">
														<center>
															<i class="glyphicon glyphicon-trash"></i>
														</center>
													</th>
													<th>ID Number</th>
													<th>Fullname</th>
													<th>Gender</th>
													<th>Year Level</th>
													<th>Tracks</th>
													<th>ClassSection</th>
												</tr>
											</thead>
											<tbody>
												<?php include 'admin/HighSchoolStaffAccess/libusersFilter/students/shs_studentsFilter.php'?>
											</tbody>
										</table>
									<!-- </form> -->
                                </div><!-- /.box-body -->

								<!-- ADD NEW MODAL -->
								
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
													<center>
														<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
															<p id="exampleModalLabel" style="font-size:28px; transform: scale(.7, 1); text-transform:uppercase">
																Add New Student
															</p>
														</div>
													</center>
											</div>
											<div class="modal-body">
												<form enctype="multipart/form-data" method="post" action="studentsShs_addStud.php">
													<input type="hidden" name="departmentType" id="departmentType" value="Senior High School Department">
													<input type="hidden" name="userType" id="userType" value="Student">
													<input type="hidden" name="libraryClass" id="libraryClass" value="High School Library">

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="firstname">Firstname</span>
																<input type="text" class="add-input" id="firstname" name="firstname" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="lastname">Lastname</span>
																<input type="text" class="add-input" id="lastname" name="lastname" required>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="library_userID">ID Number</span>
																<input type="text" class="add-input" id="library_userID" name="library_userID" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="gender">Gender</span>
																<select class="add-input" name="gender" id="gender" required>
																	<option value=""></option>
																	<option value="Male">Male</option>	
																	<option value="Female">Female</option>	
																</select> 
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="yearLevel">Year Level</span>
																<select class="add-input" name="yearLevel" id="yearLevel" required>
																	<option value=""></option>
																	<option value="Grade 11">Grade 11</option>	
																	<option value="Grade 12">Grade 12</option>	
																</select> 
															</div>
														</div>
														<div class="col-md-6">
															<div class="add-input-container"> 
																<span for="progtrack">Tracks</span>
																<select class="add-input" name="progtrack" id="progtrack" required>
																	<option value=""></option>
																	<option value="HUMSS">HUMSS</option>	
																	<option value="STEM">STEM</option>	
																	<option value="ABM">ABM</option>
																</select> 
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div class="add-input-container"> 
																<span for="classSection">Section</span>
																<select class="add-input" name="classSection" id="classSection" required>
																	<option value="<?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?>" > <?php echo isset($_POST['classSection']) ? $_POST['classSection'] : '' ?></option>
																	<?php
																		$libusers = DB:: getInstance()->query("SELECT DISTINCT classSection FROM userlogin WHERE departmentType = 'Senior High School Department' AND classSection != 'N/A' ORDER BY id ASC");							
																		foreach($libusers->results() as $libusers){
																	?>
																	<option value="<?php echo $libusers->classSection?>"><?php echo ucwords($libusers->classSection) ?></option>
																	<?php }?>
																</select> 
															</div>
														</div>
														<!-- <div class="col-md-12">
															<div class="add-input-container"> 
																<span for="classSection">Section</span>
																<select class="add-input" name="classSection" id="classSection" required>
																	<option value=""></option>
																	<option value="ST. APOLLONIA">ST. APOLLONIA</option>	
																	<option value="ST. CECILIA">ST. CECILIA</option>	
																	<option value="ST. CLARE OF ASSISI">ST. CLARE OF ASSISI</option>
																	<option value="ST. JOHN PAUL II">ST. JOHN PAUL II</option>
																	<option value="ST. MONICA">ST. MONICA</option>	
																	<option value="ST. PEDRO CALUNGSOD">ST. PEDRO CALUNGSOD</option>	
																	<option value="ST. RICHARD PAMPURI">ST. RICHARD PAMPURI</option>
																	<option value="ST. ANTHONY PADUA">ST. ANTHONY PADUA</option>
																	<option value="ST. DOMINIC OF OSMA">ST. DOMINIC OF OSMA</option>	
																	<option value="ST. HUBERT">ST. HUBERT</option>	
																	<option value="ST. JOHN XXIII">ST. JOHN XXIII</option>
																	<option value="ST. LUKE">ST. LUKE</option>
																	<option value="ST. PETER CANISIUS">ST. PETER CANISIUS</option>	
																	<option value="ST. THOMAS AQUINAS">ST. THOMAS AQUINAS</option>	
																	<option value="ST. LUCY OF SYRACUSE">ST. LUCY OF SYRACUSE</option>
																	<option value="ST. PADRE PIO">ST. PADRE PIO</option>
																</select> 
															</div>
														</div> -->
													</div>
													</div>
											<div class="modal-footer">
												<div class="row">
													<div class="col-md-6">
														<button type="submit" class="btnupdate" value="save"> Add</button>
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

								<!-- UPLOAD CSV MODAL -->
									<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<center>
														<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
															<p style="font-size:30px; transform: scale(.7, 1);">
																UPLOAD CSV FILE
															</p>
														</div>
													</center>
												</div>
												<div class="modal-body" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
													<p class="form-paragraph">
														File should be a .csv format or download this file template <a style="color:#fff" href="CSVStudentsTemplate_SHS.php"> <button class="btncsv" type="submit"> CSV Template <i class="fas fa-file-download"></i></button></a>
													</p>
													<form enctype="multipart/form-data" method="post" action="ShsStudUpload.php">
														<label for="studentcsv_file" class="drop-container">
															<span class="drop-title">Drop files here</span>
																or
															<input type="file" class="file-input" id="studentcsv_file" name="studentcsv_file">
														</label>
												</div>
												<div class="modal-footer">
													<div class="row">
														<div class="col-md-6">
															<button type="submit" name="upload" class="btnupdate" value="Upload"> Upload</button>
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
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="styles/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap Datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#articles").dataTable();
    });
	function printImg(url) {
	  var win = window.open('');
	  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
	  win.focus();
	}

	setTimeout(function(){
		document.getElementById("alert").style.display = "none";
	}, 5000);
</script>
<script type="text/javascript">
  $('#confirmDelete').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
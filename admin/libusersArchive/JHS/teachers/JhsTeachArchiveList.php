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
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- landing page css -->
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>JHS Teachers Archive List</title>
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
                        <a href="admin.php?action=HedTeachArchiveList"><button type="button" class="btn-mb" style="color:#3db166">HED Students</button></a> 
                        <a href="admin.php?action=ShsTeachArchiveList"><button type="button" class="btn-mb" style="color:#3db166">SHS Students</button></a> 
						<a href="admin.php?action=JhsTeachArchiveList"><button type="button" class="btn-mb"style="background: #3db166; color:white">JHS Students</button></a> 
                        <a href="admin.php?action=ElemTeachArchiveList"><button type="button" class="btn-mb" style="color:#3db166">GS Students</button></a> 
                    </ol>
                    </center>
                </section>
                <!-- Main content -->
                <section class="col-lg-12 connectedSortable">
                        <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
										<br>
										<center>
											<div class="small-box bg" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 25px 0px 0px 0px; width:95%; font-family: Wide Latin; height: 115px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
												<p style="font-size:35px; transform: scale(1, 2);">
													JHS TEACHERS ARCHIVE LIST
												</p>
											</div>
										</center>
										<br>
										<div class="conpost">
											<div class="container">
												<div class="data">
													<div class="content">
													<?php 
													$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin WHERE departmentType='Junior High School Department' && userType='Teacher' AND archive = 1");
													$countLibrary_users =DB:: getInstance()->count($userlogin);?>
														<div class="inner">
															<h3>
																<?php echo $countLibrary_users; ?>
															</h3>
															<p>
															Total Teachers
															</p>
														</div>
													</div>
												</div>
												<div class="data">
													<div class="content">
														<?php 
														$library_usersGender = DB:: getInstance()->query("SELECT * FROM userlogin WHERE gender='Male' AND departmentType='Junior High School Department' AND userType='Teacher' AND archive = 1");
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
													$library_usersGender = DB:: getInstance()->query("SELECT * FROM userlogin WHERE gender='Female' AND departmentType='Junior High School Department' AND userType='Teacher' AND archive = 1");
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
									<br><br><br>
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

													<button class="filtersbtn" name="search"><i class="fa fa-filter"></i></button>
													<a class="filtersbtn" href="admin.php?action=JhsTeachArchiveList"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
													<button class="filtersbtn" onclick="window.print();"><i class="fa fa-print"></i></button>
												</div>
											</center>
										</form>
										<br>
									</div>
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Updated')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('Deleted')) { ?>
										<div class="alert alert-success">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
										</div>
									<?php }?>
									<form action="archive_jhsTeach_chkboxcode.php" method="POST">
										<table class="table table-bordered table-hover" id="articles">
											<thead>
												<tr>
													<th style="width:1%">#</th>
													<th>ID Number</th>
													<th>Fullname</th>
													<th>Gender</th>
													<th style="width:6%"  class="noprint">
														<!-- UPDATE YEAR LEVEL -->
														<center>
															<button type="button" class="btn7" data-toggle="modal" data-target="#updatemultiModal"><i class="glyphicon glyphicon-refresh"></i></button>	
															<button type="button" class="btn7" data-toggle="modal" data-target="#deletemultiModal"><i class="glyphicon glyphicon-trash"></i></button>	
														</center>
														
														
															<div class="modal fade" id="updatemultiModal" tabindex="-1" role="dialog" aria-labelledby="updatemultiModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-lg" role="document">
																	<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<center>
																				<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
																					<p style="font-size:30px; transform: scale(.7, 1);">
																						Confirm Activation 
																					</p>
																				</div>
																			</center>
																		</div>
																		<div class="modal-body">
																			<center>
																				<p  style="font-size:30px"> Are you sure you want to activate teacher(s)? </p>
																			</center>
																			<div class="modal-footer">
																				<div class="row">
																					<div class="col-md-6">
																						<button type="submit" name="stud_update_multiple_btn" class="btnupdate" style="color: #fff" value="Upload">Activate</button>
																					</div>
																					<div class="col-md-6">
																						<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
																					</div>
																					</div>
																				</div>
																		</div>
																	</div>
																</div>
															</div>

															<!-- DELETE MULTIPLE -->
															<div class="modal fade" id="deletemultiModal" tabindex="-1" role="dialog" aria-labelledby="deletemultiModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-lg" role="document">
																	<div class="modal-content" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat;">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<center>
																				<div class="small-box" style="background-image: url(images/background.jpg); background-size:cover; background-position:center center; background-repeat: no-repeat; color:white; padding: 14px 0px 0px 0px; width:100%; font-family: Wide Latin; height: 80px; box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418); border-radius: 100px; border: 7px solid lightgrey;">
																					<p style="font-size:30px; transform: scale(.7, 1);">
																						Confirm Deletion 
																					</p>
																				</div>
																			</center>
																		</div>
																		<div class="modal-body">
																			<center>
																				<p  style="font-size:30px"> Are you sure you want to delete? </p>
																			</center>
																			<div class="modal-footer">
																				<div class="row">
																					<div class="col-md-6">
																						<button type="submit" name="stud_delete_multiple_btn" class="btnupdate" style="color: #fff" value="Upload">Delete</button>
																					</div>
																					<div class="col-md-6">
																						<button type="button" class="btncancel" data-dismiss="modal">Cancel</button>
																					</div>
																					</div>
																				</div>
																		</div>
																	</div>
																</div>
															</div>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php include 'admin/libusersArchive/JHS/teachers/jhs_teachlibusersArchive.php'?>
											</tbody>
										</table>
									</form>
                                </div><!-- /.box-body -->
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
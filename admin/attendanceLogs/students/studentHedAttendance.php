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
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="buttonhover.css">
<link rel="stylesheet" type="text/css" href="css/input-filter-btn.css">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
<title>HED Students Daily Users Log</title>
</head>

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

	.small-box.bg {
		display: flex;
		justify-content: center;
		margin-bottom: 15px;
	}

	.small-box {
		padding: 23px 0px 10px 0px;
		width: 98%;
		height: 110px;
		box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.418);
        background-color: #163269;
		border-radius: 20px;
		border: 7px solid #3db166;
	}

	.small-box p {
		font-size: 30px;
        color: white;
        font-family: arial;
        font-weight: 900;
        transform: scale(2, 2);
        padding-top: 3px;
        text-transform: uppercase;
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
							<a href="admin.php?action=studentHedAttendance"><button type="button" class="btn-mb" style="background: #3db166; color:white">HED Students</button></a> 
							<a href="admin.php?action=studentShsAttendance"><button type="button" class="btn-mb" style="color:#3db166;">SHS Students</button></a> 
							<a href="admin.php?action=studentJhsAttendance"><button type="button" class="btn-mb" style="color:#3db166;">JHS Students</button></a> 
							<a href="admin.php?action=studentElemAttendance"><button type="button" class="btn-mb" style="color:#3db166;">GS Students</button></a> 
						</ol>
                    </center>
                </section>

                <!-- Main content -->
                <section class="col-lg-12 connectedSortable" >
                        <div class="col-xs-12" style="padding: 0px 15px 10px 15px">
                            <div class="box box-primary" style="background-image: url(images/nav2.jfif); background-size:cover; background-position:center center; background-repeat: no-repeat; border-radius: 30px; padding:10px">
								<div class="col-md-3"></div>
									<!-- <div align="center">
										<h3 style="font-weight:bold" class="box-title">DAILY USERS LOG FOR HIGHER EDUCATION DEPARTMENT STUDENTS</h3> 
									</div> -->
									<br>
										<center>
											<div class="small-box bg">
												<p class="dynamic-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; font-size:30px; transform: scale(1.3, 2); padding: 3px;"> 
													HED STUDENTS DAILY USERS LOG 
												</p>
											</div>
										</center>
										<br>
									<div class="noprint">
										<form class="form-inline" method="POST" action="">
											<center>
													<div class="wrap-filter" class="noprint">
														<div class="filter-input-group"> 
															<label class="filter-input-label">FROM DATE</label>
															<input type="date" class="date-filter-input-box" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
														</div>
														<div class="filter-input-group"> 
															<label class="filter-input-label">TO DATE</label>
															<input type="date" class="date-filter-input-box" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>" />
														</div>
													</div>
													<br>
													<div class="wrap-filter" class="noprint">
														<div class="filter-input-group"> 
															<label class="filter-input-label">LIBRARY</label>
															<select class="filter-input-box" for="libraryClass" name="libraryClass" id="libraryClass">
																<option value="<?php echo isset($_POST['libraryClass']) ? $_POST['libraryClass'] : '' ?>" > <?php echo isset($_POST['libraryClass']) ? $_POST['libraryClass'] : '' ?></option>
																<option value="">None</option>
																<option value="College Library">College Library</option>
																<option value="High School Library">High School Library</option>
																<option value="Grade School Library">Grade School Library</option>
															</select> 
														</div>
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
																<option value="First Year">First Year</option>
																<option value="Second Year">Second Year</option>
																<option value="Third Year">Third Year</option>
																<option value="Fourth Year">Fourth Year</option>
															</select> 
														</div>
														<div class="filter-input-group"> 
															<label class="filter-input-label">PROGRAM</label>
															<select class="filter-input-box" for="progtrack" name="progtrack" id="progtrack">
																<option value="<?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?>" > <?php echo isset($_POST['progtrack']) ? $_POST['progtrack'] : '' ?></option>
																<option value="">None</option>
																<option value="BSIT">BSIT</option>	
																<option value="BSHM">BSHM</option>
																<option value="BSBA">BSBA</option>
																<option value="BSED">BSED</option>
																<option value="BEED">BEED </option>
																<option value="BSCRIM">BSCRIM</option>
															</select> 
														</div>

														<button class="filtersbtn" name="search"><i class="fa fa-filter"></i></button>
														<a class="filtersbtn" href="admin.php?action=studentHedAttendance"><button style="background:transparent; border:none; padding-top: 7px; color:#fff" type="button"><i class="fa fa-refresh"></i></button></a>
														<button class="filtersbtn" onclick="window.print();"><i class="fa fa-print"></i></button>
													</div>
											</center>
										</form>
									</div>
									<br>
									<div class="table-responsive">	
										<table class="table table-bordered table-hover" id="articles">
											<thead>
                                            <tr>
												<th>#</th>
												<th>Library</th>
												<th>ID number </th>
												<th>Fullname</th>
												<th>Gender</th>
												<th>Year Level</th>
												<th>Program</th>
												<th>Log Date</th>
                                            </tr>
											</thead>
											<tbody>
												<?php include 'admin/attendanceLogs/dailyusersDF/students/hed_dailyusersDF.php'?>	
											</tbody>
										</table>
									</div class="noprint">	
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
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#articles").dataTable();
    });
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
